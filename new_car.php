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
$dbname = $user;		// a BD tem nome idêntico ao utilizador
      
$matricula = $_POST['matricula'];
$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$ocupantes = $_POST['ocupantes'];
$nick = $_SESSION['username'];
if($matricula && $marca && $modelo && $ocupantes){
  $connection = pg_connect("host=$dbhost port=$dbport user=$dbusername password=$dbpassword dbname=$dbname") or die(pg_last_error());
  $sql = "BEGIN;insert into viatura values ('$matricula','$marca','$modelo','$ocupantes','$nick');COMMIT;";
  $query = pg_query($sql) or die("<h2 style=\"family-font:Helvetica;font-size:14pt; color: #A29999;\">Viatura Já Existente Ou Dados Mal Inseridos.<br>Por Favor  <span class=\"username\">Volte A Tentar.</span></h2>");
  echo("<h2 style=\"family-font:Helvetica;font-size:14pt; color: #A29999;\">Viatura Registada Com Sucesso <span class=\"username\">".$_SESSION['username'].".</span></h2>");	         			
}else{ 
  echo("<h2 style=\"family-font:Helvetica;font-size:14pt; color: #A29999;\">Por Favor Preencha Todos Os Campos.<br><a href=\"http://web.ist.utl.pt/ist166941/member.php\"><span class=\"username\">Voltar.</span></a></h2>");
}
  ?>
  </div> <!-- #wrapper -->
  </div> <!-- #container -->
  
  </body>
  </html>
