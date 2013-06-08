  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  <title>Project CarPooling | Data Base Subject</title>
  <meta http-equiv="Content-Type" content="text/html; charset=ISO 8859-1" />
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
$connection = pg_connect("host=$dbhost port=$dbport user=$dbusername password=$dbpassword dbname=$dbname") or die(pg_last_error());
$user2 = $_SESSION['username'];
$boleia = explode("+",$_POST['selected']);
$nick = $boleia[0];
$datahora = $boleia[1];
$passcond = $_POST['dropcars'];
$matricula = $_POST['via'];

if($nick && $datahora){
  $metepass = "SELECT * FROM boleia WHERE nick='$nick' AND data_hora='$datahora'";
  $condutor1 = pg_query($metepass) or die('ERROR: ' . pg_last_error());
  $condutor = pg_fetch_assoc($condutor1);
  if(($condutor['nick_condutor'] && $passcond == "passageiro")||(!$condutor['nick_condutor'])){
    if($passcond == "passageiro"){
      $abc = "BEGIN;insert into inscricaop values ('$user2','$nick','$datahora');COMMIT;";
      pg_query($abc) or die("<h2 style=\"family-font:Helvetica;font-size:14pt; color: #A29999;\">" . pg_last_error()."</h2>");
    }else{
      $econd = "SELECT count(*) FROM condutor WHERE nick = '$user2';";
      $econd1 = pg_query($econd) or die("<h2 style=\"family-font:Helvetica;font-size:14pt; color: #A29999;\">". pg_last_error()."</h2>");
      $condutor1 = pg_fetch_assoc($econd1);
      $condvazio = $condutor1['count'];
      if($condvazio == 0){
	$metepass = "BEGIN;insert into condutor values ('$user2');COMMIT;";
	pg_query($metepass) or die("<h2 style=\"family-font:Helvetica;font-size:14pt; color: #A29999;\">". pg_last_error()."</h2>");
	$abc = "update boleia SET nick_condutor='$user2', matricula='$matricula' WHERE nick='$nick' and data_hora='$datahora';COMMIT;";
	pg_query($abc) or die("<h2 style=\"family-font:Helvetica;font-size:14pt; color: #A29999;\">". pg_last_error()."</h2>");
      }else{
	$abc = "BEGIN;update boleia SET nick_condutor='$user2', matricula='$matricula' WHERE nick='$nick' and data_hora='$datahora';COMMIT;";
	pg_query($abc) or die("<h2 style=\"family-font:Helvetica;font-size:14pt; color: #A29999;\">" . pg_last_error()."</h2>");
      }
    }
    echo("<h2 style=\"family-font:Helvetica;font-size:14pt; color: #A29999;\">Aderiu Com Sucesso À Boleia <span class=\"username\">".$_SESSION['username'].".</span></h2>");
  }else{
    echo("<h2 style=\"family-font:Helvetica;font-size:14pt; color: #A29999;\">Erro Verifique Se A Boleia Tem Condutor <span class=\"username\">".$_SESSION['username'].".</span></h2>");
  }
		
}else{
  echo("<h2 style=\"family-font:Helvetica;font-size:14pt; color: #A29999;\">Selecione Uma Boleia.<br><a href=\"http://web.ist.utl.pt/ist166941/member.php\"><span class=\"username\">Voltar.</span></a></h2>");
}
  ?>
  </div> <!-- #wrapper -->
  </div> <!-- #container -->
  
  </body>
  </html>
