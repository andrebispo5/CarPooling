<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Project CarPooling | Data Base Subject</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" media="screen" href="http://www.ist.utl.pt/css/iststyle.css" />
<link rel="stylesheet" type="text/css" media="print" href="http://www.ist.utl.pt/css/print.css" />
<link rel="stylesheet" type="text/css" media="screen" href="http://web.ist.utl.pt/info/css/webpages.css"/>
<meta http-equiv="refresh" content="3; url=index.html"> 
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
if($_SESSION['username']){
  echo("<h2 style=\"family-font:Helvetica;font-size:14pt; color: #A29999;\">Obrigado por utilizar o CarPooling <span class=\"username\">".$_SESSION['username'].". </span><br>At&eacute; &aacute; pr&oacute;xima!</h2>");
}else{
  echo("<h2 style=\"family-font:Helvetica;font-size:14pt; color: #A29999;\">Sem sessao iniciada por favor entre na sua conta.<span class=\"username\"></span></h2>");
}
session_destroy();
?>
</div> <!-- #wrapper -->
</div> <!-- #container -->

</body>
</html>
