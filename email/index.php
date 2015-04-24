<?php
session_start();
$carpeta=$carpetano;
$tipo_carp = $tipo_carpp;
?>
<html>
<head>
	<title>Email Entrante</title>
</head>
<frameset rows="50%,50%" border="3" name="filas">
	<frame name="image" src="image.php" name="columnas">
	<frameset cols="100,*" name="secundario">
		<frame name="lista" src="menu.php" parent="secundario" resize=true border=1> 
		<frame name="formulario" src="login_email.php" parent="secundario" resize=true>
	</frameset>
</frameset>
</html>