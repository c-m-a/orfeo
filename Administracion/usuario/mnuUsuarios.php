<?php
$ruta_raiz = "../..";
session_start();
if(!$_SESSION['dependencia'] or !$_SESSION['tpDepeRad']) include "$ruta_raiz/rec_session.php";
?>
<html>
<head>
<title>Documento sin t&iacute;tulo</title>
<link rel="stylesheet" href="../../estilos/orfeo.css">
</head>
<body>
<form name='frmMnuUsuarios' action='../formAdministracion.php' method="post">
  <table width="32%" align="center" border="0" cellpadding="0" cellspacing="5" class="borde_tab">
  <tr bordercolor="#FFFFFF">
    <td colspan="2" class="titulos4"><div align="center"><strong>ADMINISTRACION DE USUARIOS Y PERFILES</strong></div></td>
  </tr>
  <tr bordercolor="#FFFFFF">
    <td align="center" class="listado2" width="98%"><a href='crear.php?usModo=1' class="vinculos" target='mainFrame'>1. Crear Usuario</a></td>
  </tr>
  <tr bordercolor="#FFFFFF">
    <td align="center" class="listado2" width="98%"><a href='cuerpoEdicion.php?usModo=2' class="vinculos" target='mainFrame'>2. Editar Usuario</a></td>
  </tr>
  <tr bordercolor="#FFFFFF">
    <td align="center" class="listado2" width="98%"><a href='cuerpoConsulta.php' class="vinculos" target='mainFrame'>3. Consultar Usuario</a></td>
  </tr>
  <tr bordercolor="#FFFFFF">
    <td align="center" class="listado2" width="98%"><a href="traslado.php?<?=$phpsession;?>&krd=<?=$krd;?>" class="vinculos" target='mainFrame'>4. Translado Usuario</a></td>
  </tr>
  <tr bordercolor="#FFFFFF">
  	<td align="center" class="listado2">
	<center><input align="middle" class="botones" type="submit" name="Submit" value="Cerrar"></center>
	</td> </tr>
</table>
</form>
</body>
</html>
