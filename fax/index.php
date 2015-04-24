<?php
   session_start();
   //$dependencia = "";

  // if(!$dependencia or !$krd) 
   include ('../rec_session.php');
   $carpeta = (isset($carpetano))? $carpetano : $carpeta;
   $tipo_carp = $tipo_carpp;
   $encabezado = session_name()."=".session_id()."&krd=$krd&fechah=$fechah";
?>
<html>
<head>
	<title>Fax</title>
</head>
<frameset rows="60%,40%" border="5" name="filas">
<frame name="image" src="./image.php?<?=$encabezado?>" name="columnas">
	<frameset cols="150,947" name="secundario">
		<frame name="lista" src="lista.php?<?=$encabezado?>" parent="secundario" resize="true" border="1">
		<frame name="formulario" src="form.php?<?=$encabezado?>" parent="secundario" resize="true">
	</frameset>
<frame src="UntitledFrame-1"></frameset><noframes></noframes>
</html>
