<?
	$ruta_raiz = "../..";
	session_start();
//	if( !$dependencia or !$tpDepeRad ) include "$ruta_raiz/rec_session.php";
	$phpsession = session_name()."=".session_id();
/*
	//MODIFICACION SKINA
	require_once("$ruta_raiz/include/db/ConnectionHandler.php");
	$codifica=$_SESSION['usua_nomb'];
	$db= new ConnectionHandler($ruta_raiz);
	$isql = "select USUA_LOGIN from usuario where (usua_nomb ='$codifica') ";
	$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
	$rs=$db->query($isql);
	$krd= $rs->fields["USUA_LOGIN"];

	$db->conn->debug=true;
echo("$krd");*/
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
    <td align="center" class="listado2" width="98%"><a href='./bin/crearFlujo.php?<?=$phpsession ?>&krd=<?=$krd?>' class="vinculos" target='mainFrame'>2. Crear Flujo</a></td>
  </tr>
  <tr bordercolor="#FFFFFF">
    <td align="center" class="listado2" width="98%"><a href='seleccionaProceso.php?<?=$phpsession ?>&accion=2' class="vinculos" target='mainFrame'>3. Editar Flujo</a></td>
  </tr>
  <tr bordercolor="#FFFFFF">
    <td align="center" class="listado2" width="98%"></td>
  </tr>
</table>
</form>
</body>
</html>
