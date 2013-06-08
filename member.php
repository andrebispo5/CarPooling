  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  <title>Project CarPooling | Data Base Subject</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <link rel="stylesheet" type="text/css" media="screen" href="http://www.ist.utl.pt/css/iststyle.css" />
  <link rel="stylesheet" type="text/css" media="print" href="http://www.ist.utl.pt/css/print.css" />
  <link rel="stylesheet" type="text/css" media="screen" href="http://web.ist.utl.pt/info/css/webpages.css"/>
  <style>
  normal{
      font-size: 1.8em;
      color: #45556A;
      font-family:Helvetica;
  }
  </style>
 <style type="text/css">
input.radio {
   background-color:#3333FF;
   color: #AA33FF;
}

input.styleBtn
{
   font-size: 9pt;
   color:#45556A;
   font-family:Helvetica;
}

</style>
<script type="text/javascript" src="calendarDateInput.js"></script>
  <script>
function showData()
{
  if(document.forms["newl"].elements["freqe"].value != "unica"){
    document.getElementById('datat').style.display = 'block'; 
  }else{
    document.getElementById('datat').style.display = 'none'; 
  }
  if(document.forms["newl"].elements["freqe"].value != "unica"){
    document.getElementById('datat1').style.display = 'block'; 
  }else{
    document.getElementById('datat1').style.display = 'none'; 
  }
  return true;
}
function checkCondutor()
{
  if(document.forms["newl"].elements["tipo"].value == "condutor"){
    document.getElementById('cars').style.visibility ='visible';
  }else{
    document.getElementById('cars').style.visibility ='hidden';
  }
  return true;
}
function checkCars()
{
  if(document.forms["inscboleia"].elements["dropcars"].value == "condutor"){
    document.getElementById('cars2').style.display ='block';
  }else{
    document.getElementById('cars2').style.display ='none';
  }
  return true;
}
function show()
{
  if(document.getElementById('criab').style.display =='none'){
    document.getElementById('criab').style.display ='block';
  }else{
    document.getElementById('criab').style.display ='none';
  }
  return true;
}
function showboleias()
{
  if(document.getElementById('mostrarb').style.display =='none'){
    document.getElementById('mostrarb').style.display ='block';
  }else{
    document.getElementById('mostrarb').style.display ='none';
  }
  return true;
}
function showViaturas()
{
  if(document.getElementById('viaturas').style.display =='none'){
    document.getElementById('viaturas').style.display ='block';
  }else{
    document.getElementById('viaturas').style.display ='none';
  }
  return true;
}
function showPart()
{
  if(document.getElementById('participar').style.display =='none'){
    document.getElementById('participar').style.display ='block';
  }else{
    document.getElementById('participar').style.display ='none';
  }
  return true;
}
</script>
  </head>
  <body onload="checkCondutor();showData();checkCars();">
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
  <div id="wrapper" style="width:500;align:right">
  <?php
  session_start();
if($_SESSION['username']){
  $user="ist166941";		// -> substituir pelo nome de utilizador
  $host="db.ist.utl.pt";	// o Postgres está disponível nesta máquina
  $port=5432;				// por omissão, o Postgres responde nesta porta
  $password="scpv0000";	// -> substituir pela password dada pelo psql_reset
  $dbname = $user;		// a BD tem nome idêntico ao utilizador
  $connection = pg_connect("host=$host port=$port user=$user password=$password dbname=$dbname") or die(pg_last_error());
  $sessionuser = $_SESSION['username'];
  $saldoquery = "SELECT saldo FROM utente WHERE nick = '$sessionuser';";
  $saldo = pg_query($saldoquery) or die('ERROR: ' . pg_last_error());
  $saldofinal = pg_fetch_assoc($saldo);

  echo('<table border="0" width=450px><tr><td>
	<h2 align="right">Bem-vindo <span class="username">'.$_SESSION['username'].'</span></h2>
	<h3 align="right">Saldo: '.$saldofinal['saldo'].'&euro;</h3>
	</td></tr></table>');
  echo('<div style=" font-family:Helvetica;font-size: 5pt;color: #45556A;"><hr><table width=450px><tr></tr></table>');

       
  
      

      
  /*MOSTRA BOLEIAS ONDE ESTA INSCRITO*/
  $sql = "SELECT * FROM boleia B, inscricaop I WHERE I.nick_organizador = B.nick and I.data_hora = B.data_hora and I.nick_passageiro = '$sessionuser'";
  $condutores = "SELECT * FROM boleia WHERE nick_condutor = '$sessionuser';";
  $result = pg_query($sql) or die('ERROR: ' . pg_last_error());
  $condres = pg_query($condutores) or die('ERROR: ' . pg_last_error());
  $num = pg_num_rows($result);
  $numcond = pg_num_rows($condres);
  if($num || $numcond){  
    echo('<div><h2><table ><tr><td width="450">Boleias Em Que Esta Inscrito:</td><td><input type="button" value="Abrir/Fechar" class="styleBtn" onclick="showboleias()"></td></table></h2>');
    echo('<div id="mostrarb" style="display:none"><table border="0" width=450px >');
    echo("<tr bgcolor=\"#D7D9DA\" style=\"font-size: 10pt;color: #45556A;\">
          <td><b>Organizador</b></td>
          <td><b>Data e Hora</b></td>
          <td><b>Condutor</b></td>
          <td><b>Origem</b></td>
          <td><b>Destino</b></td>
          <td><b>Custo</b></td>
      </tr>");

    if($num){
      while ($row = pg_fetch_assoc($result))
	{
          echo("<tr bgcolor=\"#FAFAFA\" style=\"font-size:10pt; color: #A29999;\">
                <td>".$row['nick'].			"</td>");
          echo("<td>".substr($row['data_hora'], 0, -3)."</td>");
          echo("<td>".$row['nick_condutor'].	"</td>");
          echo("<td>".$row['nome_origem'].	"</td>");
          echo("<td>".$row['nome_destino'].	"</td>");
	  echo("<td align=\"right\">".$row['custo_passageiro'].	"&euro;</td></tr>");
	}
    }
    if($numcond){
      while ($row = pg_fetch_assoc($condres))
	{
          echo("<tr bgcolor=\"#FAFAFA\" style=\"font-size:10pt; color: #A29999;\">
                <td>".$row['nick'].			"</td>");
          echo("<td>".substr($row['data_hora'], 0, -3)."</td>");
          echo("<td>".$row['nick_condutor'].	"</td>");
          echo("<td>".$row['nome_origem'].	"</td>");
          echo("<td>".$row['nome_destino'].	"</td>");
	  echo("<td align=\"right\">".$row['custo_passageiro'].	"&euro;</td></tr>");
	}
    }
    echo("</table></div></div>");
  }else{
    echo('<table border="0" width=450px ><tr>');
    echo('<h2 style="font-size:13pt; color: #A29999;">Nao est&aacute; inscrito em nenhuma boleia.</h2>');
    echo('</table></tr>');
  }
	
	
	  
	  
  /*CRIAR UMA NOVA BOLEIA */
  $sql = "SELECT * FROM trajeto";
  $result = pg_query($sql) or die('ERROR: ' . pg_last_error());
  echo('<div><h2><hr><table><tr><td width="450">Criar Nova Boleia:</td><td><input type="button" value="Abrir/Fechar" class="styleBtn" onclick="show()"></td></tr></table></h2>');
  echo('<normal>');
  echo('<div id="criab" style="display:none"><table>');
  echo('<FORM id="newl" METHOD="post" ACTION="newlift.php">
      <tr><td>Data Inicio:</td><td><script>DateInput(\'data\', true, \'DD-MON-YYYY\')</script></td></tr>
      <tr><td>Hora:</td><td><INPUT TYPE="time" NAME="hora" min="00:01:00"></td></tr>
	  
	  <tr><td>Frequencia:</td><td><select id="freqe" name="freq" onchange="showData()">');
  echo('<option value="unica">Unica</option>');
  echo('<option value="diaria">Diaria</option>');
  echo('<option value="semanal">Semanal</option>');
  echo('<option value="mensal">Mensal</option>');
  echo('</select></td></tr>
	  <tr ><td><div id="datat">Data Termino:</div></td><td><div id="datat1"><script>DateInput(\'datat\', true, \'DD-MON-YYYY\')</script></div></td></tr>
	  <tr><td>Custo:</td><td><INPUT TYPE="text" NAME="custo"></td></tr>
      <tr><td>Origem:</td><td><select name="traj">');
  while ($row = pg_fetch_assoc($result)){
    echo('<option value="'.$row['nome_origem'].'-'.$row['nome_destino'].'">'.$row['nome_origem'].'-'.$row['nome_destino'].'</option>');
  }
  echo('</select></tr>
      <tr><td>Estatuto:</td><td><select id="tipo" name="tipo" onchange="checkCondutor()">>');  
  $sql2 = "SELECT * FROM viatura WHERE nick = '$sessionuser'";
  $result2 = pg_query($sql2) or die('ERROR: ' . pg_last_error());
  $num2 = pg_num_rows($result2);
  if($num2){
    echo('<option value="tipo">Passageiro</option>
			<option value="condutor">Condutor</option>');
  }else{
    echo('<option value="passageiro">Passageiro</option>');
  }
	  
  $viaturas = "SELECT * FROM viatura WHERE nick = '$sessionuser'";
  $viat = pg_query($viaturas) or die('ERROR: ' . pg_last_error());
  echo('</select></td></tr>
	  
	  
	    <tr id="cars"><td>Viatura:</td><td><select name="via">');
  while ($row3 = pg_fetch_assoc($viat)){
    echo('<option value="'.$row3['matricula'].'">'.$row3['marca'].' '.$row3['modelo'].' '.$row3['matricula'].'</option>');
  }
  echo('</select></tr>
      <tr><td><INPUT TYPE="submit" name="newlift" VALUE="Criar"></td></tr>
      </FORM>');
  echo('</table></div><hr>');
  echo('</normal>');
  echo('</div>');
		
  /*ADERIR A UMA BOLEIA EXISTENTE*/
  $sql = "SELECT * FROM boleia;";
  $result = pg_query($sql) or die('ERROR: ' . pg_last_error());
  echo('<div><h2><table><tr><td width="450">Participar Numa Boleia Existente:</td><td><input type="button" value="Abrir/Fechar" class="styleBtn" onclick="showPart()"></td></tr></table></h2>');
  echo('<div id="participar" style="display:none"><table>');
  $date = date('Y-m-d H:i:s');
  $qboleias = "(SELECT nick,data_hora,nick_condutor,nome_origem,nome_destino,custo_passageiro FROM boleia EXCEPT
					SELECT B.nick,B.data_hora,B.nick_condutor,B.nome_origem,B.nome_destino,B.custo_passageiro boleia FROM boleia B, inscricaop I 
					WHERE (B.nick ='$sessionuser') or (B.nick_condutor = '$sessionuser') or (B.data_hora < '$date'))
					
					EXCEPT
					SELECT nick,B.data_hora,nick_condutor,nome_origem,nome_destino,custo_passageiro FROM boleia B, inscricaop I WHERE I.nick_organizador = B.nick and I.data_hora = B.data_hora and I.nick_passageiro = '$sessionuser'
					
					ORDER BY custo_passageiro ASC ";
  $rboleias = pg_query($qboleias) or die('ERROR: ' . pg_last_error());
	  
  echo('<table border="0" width=450px >');
  echo("<tr bgcolor=\"#D7D9DA\" style=\"font-size: 10pt;color: #45556A;\">
          <td><b>Organizador</b></td>
          <td><b>Data Hora</b></td>
          <td><b>Condutor</b></td>
          <td><b>Origem</b></td>
          <td><b>Destino</b></td>
		  <td><b>Custo</b></td>
		  <td><b>  </b></td>
          
      </tr>");

	  
  echo('<FORM id="inscboleia" METHOD="post" ACTION="join_lift.php"> ');
  while ($rowboleias = pg_fetch_assoc($rboleias))
    {
      echo("<tr bgcolor=\"#FAFAFA\" style=\"font-size:10pt; color: #A29999;\">
                <td>".$rowboleias['nick'].			"</td>");
      echo("<td>".substr($rowboleias['data_hora'], 0, -3)."</td>");
      echo("<td>".$rowboleias['nick_condutor'].	"</td>");
      echo("<td>".$rowboleias['nome_origem'].	"</td>");
      echo("<td>".$rowboleias['nome_destino'].	"</td>");
      echo("<td align=\"right\">".$rowboleias['custo_passageiro'].	"&euro;</td>");
      echo('<td><input type="radio" class="radio" name="selected" value="'.$rowboleias['nick'].'+'.$rowboleias['data_hora'].'"></td></tr>');
    }
  echo('</table></table>');
		
  //PASS OU COND?
  $viaturas2 = "SELECT * FROM viatura WHERE nick = '$sessionuser'";
  $viat2 = pg_query($viaturas2) or die('ERROR: ' . pg_last_error());
  echo('<normal>');
  echo('<table><tr ><td width="70px" >Estatuto:</td><td>');
  if($viat2){
    echo('<select id="dropcars" name="dropcars" onchange="checkCars()">
				<option value="passageiro">Passageiro</option>
				<option value="condutor">Condutor</option>
				</select></td></tr></table>');
  }else{
    echo('<select id="dropcars" name="dropcars" onchange="checkCars()"">
				<option value="passageiro">Passageiro</option>
				</select></td></tr></table>');
  }
		
  echo('<table><tr id="cars2" ><td width="70px">Viatura:</td><td><select name="via">');
  while ($row3 = pg_fetch_assoc($viat2)){
    echo('<option value="'.$row3['matricula'].'">'.$row3['marca'].' '.$row3['modelo'].' '.$row3['matricula'].'</option>');
  }
  echo('</select></td></tr></table></normal>');
		 
  echo('</table>');
  echo('<input type="submit" class="styleBtn" value="Escolher"></form></div><hr>');
  echo('</div>');
	  
  /*ADICIONAR VIATURAS*/
  $sql = "SELECT * FROM boleia;";
  $result = pg_query($sql) or die('ERROR: ' . pg_last_error());
  echo('<div><h2><table><tr><td width="450">Adicionar Viatura:</td><td><input type="button" value="Abrir/Fechar" class="styleBtn" onclick="showViaturas()"></td></tr></table></h2><normal>');
  echo('<div id="viaturas" style="display:none"><table>
		<FORM METHOD="post" ACTION="new_car.php">
		
		<tr><td>Matricula:</td><td><input type="text" name="matricula" value="XX-XX-XX"></td></tr>
		<tr><td>Marca:</td><td><input type="text" name="marca"></td></tr>
		<tr><td>Modelo:</td><td><input type="text" name="modelo"></td></tr>
		<tr><td>Max.Ocupantes:</td><td><input type="text" name="ocupantes"></td></tr></h3>
	');
  echo('</table></table><input type="submit" class="styleBtn" value="Escolher"></form> </div></normal><hr>');
  echo('</div>');
	  
  /*BOTAO DE LOG OUT*/
  echo("<br><br><br>");
  echo("<FORM METHOD=\"post\" ACTION=\"logout.php\">
      <INPUT class=\"styleBtn\" TYPE=\"submit\" name=\"logout\" VALUE=\"Logout\">
      </FORM>
      ");
}else{
  echo("<h2>Sem sessao iniciada por favor <a href=\"http://web.ist.utl.pt/ist166941/\"><span class=\"username\">Entrar.</span></a></h2>");
}
  ?>
  </div> <!-- #wrapper -->
  </div> <!-- #container -->
  
  </body>
  </html>
