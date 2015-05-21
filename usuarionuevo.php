<?php
  session_start();

  foreach ($_GET as $key => $valor)   ${$key} = $valor;
  foreach ($_POST as $key => $valor)   ${$key} = $valor;
  $ruta_raiz = ".";
  $krd = $_SESSION["krd"];
  $dependencia = $_SESSION["dependencia"];
  $usua_doc = $_SESSION["usua_doc"];
  $codusuario = $_SESSION["codusuario"];

  include_once($ruta_raiz . '/include/db/ConnectionHandler.php');
  $db = new ConnectionHandler($ruta_raiz);	
?>
<html>
<title>Adm - Contrase&ntilde;as - ORFEO </title>
<HEAD>
<link rel="stylesheet" href="estilos/orfeo.css">
</HEAD>
	<body bgcolor="#207385">
	<CENTER>
	<a href="<?=$ruta_raiz?>">
	<img border="0" src="<?=$ruta_raiz?>/imagenes/logo2.gif">
	</a>
<?
 if(!$depsel) $depsel = $dependencia;
 if($aceptar=="grabar") {
  $isql = "update usuario set usua_nuevo='1',
                              usua_pasw='".substr(md5($contraver),1,26)."',
                              depe_codi='$depsel',
                              USUA_SESION='CAMBIO PWD(".date("Ymd")."'
                        WHERE usua_login='$usuarionew'";
	
  $rs = $db->conn->query($isql);
	
  if($rs==-1) {
		echo "<P><P><center><font color=white>No se ha podido cambiar la contrase&ntilde;a, Verifique los datos e intente de nuevo</center>";
	} else {
		echo "<center><font color=white>Su contrase&ntilde;a ha sido cambiada correctamente</center><p>";
		session_destroy();
	}
 } else {
   if($contradrd==$contraver) {
  ?>
	</p>
   <form action="usuarionuevo.php?krd=<?=$krd?>&<?=session_name()?>=<?=session_id()?>" method="post">
   <center>
   <table border="0">
		<tr><td ><center><font color="white" face='Verdana, Arial, Helvetica, sans-serif' SIZE=4 ><B>CONFIRMAR DATOS</font>  </td></tr>
	</table>
	<BR>
	<table border="0" class='borde_tab'>
		 
		<tr><td class=titulos2><center>Usuario <?=$usuarionew ?></td></tr>
		 <input type=hidden name=usuarionew value='<?=$usuarionew?>'></td></tr>
		 <input type=hidden name=contraver value='<?=$contraver?>'></td></tr>
		 <input type=hidden name=depsel value='<?=$depsel?>'></td></tr>		 		 
		<tr><td class=titulos2><center><center>Dependencia <?=$depsel?> </td></tr>
		<tr><td class=titulos2><center><center>Esta Seguro de estos datos ? </td></tr>
	 </table>
		<input type=submit value='grabar' name=aceptar class=botones> 
	 </form>
<?php
	 } else {
?>
	  <span class="alarmas">
	   <center></p>CONTRASE&Ntilde;AS NO COINCIDEN </P><b>Por favor oprima  atras y repita la operacion<b></P>
	 	 <CENTER><B>GRACIAS</span>
<?php
		}
	}
?>	
</body>
</html>
