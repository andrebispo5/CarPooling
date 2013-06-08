<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Project CarPooling | Data Base Subject</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" media="screen" href="http://www.ist.utl.pt/css/iststyle.css" />
<link rel="stylesheet" type="text/css" media="print" href="http://www.ist.utl.pt/css/print.css" />
<link rel="stylesheet" type="text/css" media="screen" href="http://web.ist.utl.pt/info/css/webpages.css"/>
<meta http-equiv="refresh" content="3; url=member.php">
</head>
<body>
<p class="skipnav"><a href="#main">Saltar men&uacute; de navega&ccedil;&atilde;o</a></p>
<!-- START HEADER -->
    <div id="logoist">
        <h1><a href="http://www.ist.utl.pt">Instituto Superior Técnico</a></h1>
        <!-- <img alt="[Logo] Instituto Superior Técnico" height="51" src="http://www.ist.utl.pt/img/wwwist.gif" width="234" /> -->
    </div>
    <div id="header_links"><a href="https://fenix.ist.utl.pt/loginPage.jsp">Login .IST</a> | <a href="https://ciist.ist.utl.pt/contactos.php">Contactos</a></div>
<!-- END HEADER -->
<!--START MAIN CONTENT -->
<div id="container">
<div id="wrapper">
<?php
 session_start();
$dbusername="ist166941";		// -> substituir pelo nome de utilizador
$dbhost="db.ist.utl.pt";	// o Postgres está disponível nesta máquina
$dbport=5432;				// por omissão, o Postgres responde nesta porta
$dbpassword="scpv0000";	// -> substituir pela password dada pelo psql_reset
$dbname = $dbusername;		// a BD tem nome idêntico ao utilizador

$errormsg = "<h2 style=\"family-font:Helvetica;font-size:14pt; color: #A29999;\">Ocurreu Um Erro. Verifique Todos Os Dados Inseridos.</h2>";

$nick = $_SESSION['username'];
$data = $_POST['data'];
$hora = $_POST['hora'];
$custo = $_POST['custo'];
$origem = $_POST['traj'];
$estatuto = $_POST['tipo'];
$matricula = $_POST['via'];
$frequencia = $_POST['freq'];
$datatermino = $_POST['datat'];
$trajeto= explode("-",$origem);
$tempo= "$data $hora";
if($data && $hora && $custo && $estatuto){
  if($estatuto == 'condutor'){/*SE ESTIVER A CRIAR COMO CONDUTOR*/
    if($matricula){
		$connection = pg_connect("host=$dbhost port=$dbport user=$dbusername password=$dbpassword dbname=$dbname") or die(pg_last_error());

		$econd = "SELECT count(*) FROM condutor WHERE nick = '$nick';";
		$econd2 = pg_query($econd) or die($errormsg);
		$condutor1 = pg_fetch_assoc($econd2);
		$condvazio = $condutor1['count'];

		if($condvazio == 0){/*CASO NAO EXISTA O UTENTE NA TABELA CONDUTORES*/
			$metepass = "BEGIN;insert into condutor values ('$nick');";
			pg_query($metepass) or die($errormsg);
			$sql = "insert into boleia values ('$nick','$tempo','$custo','$trajeto[0]','$trajeto[1]','$nick','$matricula');";
			$query = pg_query($sql) or die($errormsg);

			if($frequencia == "unica"){
				$sqlu = "insert into boleiaunica values ('$nick','$tempo');COMMIT;";
				$queryu = pg_query($sqlu) or die($errormsg);
				echo("<h2 style=\"family-font:Helvetica;font-size:14pt; color: #A29999;\">Boleia Criada Com Sucesso!</h2>");
			}else{
				$sqlf = "insert into boleiafrequente values ('$nick','$tempo','$datatermino','$frequencia');COMMIT;";
				$queryf = pg_query($sqlf) or die($errormsg);
				echo("<h2 style=\"family-font:Helvetica;font-size:14pt; color: #A29999;\">Boleia Criada Com Sucesso!</h2>");
			}
		}else{/*CASO O UTENTE JA SE ENCONTRE NA TABELA CONDUTORES*/
			$sql = "BEGIN;insert into boleia values ('$nick','$tempo','$custo','$trajeto[0]','$trajeto[1]','$nick','$matricula');";
			$query = pg_query($sql) or die($errormsg);
			if($frequencia == "unica"){
				$sqlu = "insert into boleiaunica values ('$nick','$tempo');COMMIT;";
				$queryu = pg_query($sqlu) or die($errormsg);
				echo("<h2 style=\"family-font:Helvetica;font-size:14pt; color: #A29999;\">Boleia Criada Com Sucesso!</h2>");
			}else{
			$sqlf = "insert into boleiafrequente values ('$nick','$tempo','$datatermino','$frequencia');COMMIT;";
			$queryf = pg_query($sqlf) or die($errormsg);
			echo("<h2 style=\"family-font:Helvetica;font-size:14pt; color: #A29999;\">Boleia Criada Com Sucesso!</h2>");
			}
		}				
    }else{
		echo("<h2 style=\"family-font:Helvetica;font-size:14pt; color: #A29999;\">Por Favor Selecionar Uma Viatura.</h2>");			
    }
  }else{/*CASO SEJA PASSAGEIRO*/
	$connection = pg_connect("host=$dbhost port=$dbport user=$dbusername password=$dbpassword dbname=$dbname") or die(pg_last_error());

    $sql = "BEGIN;insert into boleia(nick,data_hora,custo_passageiro,nome_origem,nome_destino) values ('$nick','$tempo','$custo','$trajeto[0]','$trajeto[1]');";
    $query = pg_query($sql) or die($errormsg);
    $inscricaop = "insert into inscricaop values ('$nick','$nick','$tempo');";
    $inscp = pg_query($inscricaop) or die($errormsg);
			
    if($frequencia == "unica"){
		$sqlu = "BEGIN;insert into boleiaunica values ('$nick','$tempo');COMMIT;";
		$queryu = pg_query($sqlu) or die($errormsg);
		echo("<h2 style=\"family-font:Helvetica;font-size:14pt; color: #A29999;\">Boleia Criada Com Sucesso!</h2>");
    }else{
		$sqlf = "insert into boleiafrequente values ('$nick','$tempo','$datatermino','$frequencia');COMMIT;";
		$queryf = pg_query($sqlf) or die($errormsg);
		echo("<h2 style=\"family-font:Helvetica;font-size:14pt; color: #A29999;\">Boleia Criada Com Sucesso!</h2>");
    }
  }
}else{ 
	echo("<h2 style=\"family-font:Helvetica;font-size:14pt; color: #A29999;\">Por Favor Preencha Todos Os Campos.<br><a href=\"http://web.ist.utl.pt/ist166941/member.php\"><span class=\"username\">Voltar.</span></a></h2>");
}
?>
</div> <!-- #wrapper -->
</div> <!-- #container -->
  
</body>
</html>
