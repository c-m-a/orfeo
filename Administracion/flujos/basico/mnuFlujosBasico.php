<?
	$ruta_raiz = "../..";
	session_start();
//	if( !$dependencia or !$tpDepeRad ) include "$ruta_raiz/rec_session.php";
//	$phpsession = session_name()."=".session_id();
?>
<html>
<head>
<title>Documento sin t&iacute;tulo</title>
<link rel="stylesheet" href="../../../estilos/orfeo.css">
</head>
<body>
<form name='frmMnuFlujos' action='../../formAdministracion.php?<?=session_name()."=".session_id()?>&krd=<?=$krd?>' method="post">
  <table width="32%" align="center" border="0" cellpadding="0" cellspacing="5" class="borde_tab">
  <tr bordercolor="#FFFFFF">
    <td colspan="2" class="titulos4"><div align="center"><strong>ADMINISTRACI&Oacute;N DE FLUJOS</strong></div></td>
  </tr>
  <tr bordercolor="#FFFFFF">
    <td align="center" class="listado2" width="98%"><a href='creaProceso.php?<?=$phpsession ?>&accion=1' class="vinculos" target='mainFrame'>1. Crear Proceso</a></td>
  </tr>
  <tr bordercolor="#FFFFFF">
    <td align="center" class="listado2" width="98%"><a href='seleccionaProceso.php?<?=$phpsession ?>&accion=1' class="vinculos" target='mainFrame'>2. Crear Flujo</a></td>
  </tr>
  <tr bordercolor="#FFFFFF">
    <td align="center" class="listado2" width="98%"><a href='seleccionaProceso.php?<?=$phpsession ?>&accion=2' class="vinculos" target='mainFrame'>3. Editar Flujo</a></td>
  </tr>
  <tr bordercolor="#FFFFFF">
    <td align="center" class="listado2" width="98%"></td>
  </tr>
  <tr bordercolor="#FFFFFF">
  	<td align="center" class="listado2">
	<center><input align="middle" class="botones" type="submit" name="Submit" value="Cerrar"></center>
	</td> </tr>
</table>
</form>
</body>
</html>
