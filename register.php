<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Project CarPooling | Data Base Subject</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" media="screen" href="http://www.ist.utl.pt/css/iststyle.css" />
<link rel="stylesheet" type="text/css" media="print" href="http://www.ist.utl.pt/css/print.css" />
<link rel="stylesheet" type="text/css" media="screen" href="http://web.ist.utl.pt/info/css/webpages.css"/>
<script>
function checkAluno()
{

    if(document.forms["regist"].elements["isa"].value == "aluno"){
		document.getElementById('curso').style.visibility ='visible';
	}else{
		document.getElementById('curso').style.visibility ='hidden';
	}
	return true;
}
</script>
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
	<table width="350">
	<h2 align="right">Registo De Novo <span class="username">Utente</span></h2>
	<hr>
	</table>
	<br>
	<FORM id="regist" METHOD="post" ACTION="confirm_register.php">
	<table>
	<tr><td><h3 style="display:table-cell; vertical-align:middle"><font style="font-family:Helvetica">Nick:</font></h3></td><td>&nbsp;</td><td><INPUT TYPE="text" NAME="nick"></td><td>&nbsp;</td>
	<tr><td><h3 style="display:table-cell; vertical-align:middle"><font style="font-family:Helvetica">Nome:</font></h3></td><td>&nbsp;</td><td><input type="text" name="name"></td><td>&nbsp;</td>
	<tr><td><h3 style="display:table-cell; vertical-align:middle"><font style="font-family:Helvetica">Numero:</font></h3></td><td>&nbsp;</td><td><input type="text" name="num"></td><td>&nbsp;</td>
	<tr><td><h3 style="display:table-cell; vertical-align:middle"><font style="font-family:Helvetica">Saldo:</font></h3></td><td>&nbsp;</td><td><INPUT TYPE="text" NAME="saldo"></td><td>&nbsp;</td>
	<tr><td><h3 style="display:table-cell; vertical-align:middle"><font style="font-family:Helvetica">Estatuto:</font></h3></td><td>&nbsp;</td><td>
	<select id="isa" name="isa" onchange="checkAluno()">
	<option value="aluno">Aluno</option>
	<option value="docente">Docente</option>
	<option value="funcionario">Funcionario</option>
	</select></td><td>&nbsp;</td>
	<tr id="curso"><td><h3 style="display:table-cell; vertical-align:middle"><font style="font-family:Helvetica">Curso:</font></h3></td><td>&nbsp;</td><td><INPUT TYPE="text" NAME="curso"></td><td>&nbsp;</td>
	</table>
	<INPUT TYPE="submit" name="register" VALUE="Cancelar">
	<INPUT TYPE="submit" name="register" VALUE="Confirmar">

	</FORM>
</div> <!-- #wrapper -->
</div> <!-- #container -->

</body>
</html>
