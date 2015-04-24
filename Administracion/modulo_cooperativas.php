<?php
session_start();
/**
  * Se añadio compatibilidad con variables globales en Off
  * @autor Jairo Losada 2009-05
  * @licencia GNU/GPL V 3
  */

define('ADODB_ASSOC_CASE', 2);

foreach($_GET as $k=>$v) $$k=$v;

$krd = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
$usua_doc = $_SESSION["usua_doc"];
$codusuario = $_SESSION["codusuario"];
$tip3Nombre=$_SESSION["tip3Nombre"];
$tip3desc = $_SESSION["tip3desc"];
$tip3img =$_SESSION["tip3img"];
$ruta_raiz = "..";

$nomcarpeta=$_GET["carpeta"];
$tipo_carpt=$_GET["tipo_carpt"];
$adodb_next_page=$_GET["adodb_next_page"];
//if($_SESSION['usua_admin_sistema']!=1) die(include "$ruta_raiz/sinacceso.php");

?>
<html>
<head>
<title>Documento  sin t&iacute;tulo</title>
<link rel="stylesheet" href="../estilos/orfeo.css">
</head>
<body>
<table width="71%" align="center" border="0" cellpadding="0" cellspacing="5" class="borde_tab">
<tr bordercolor="#FFFFFF">
	<td colspan="3" class="titulos4" align="center">
          Opcional x SES
        </td>
</tr>
<tr bordercolor="#FFFFFF">
	<td align="center" class="listado2" width="38%">
		<a href='entidad/listaempresas.php?<?=$phpsession ?>&krd=<?=$krd?>' target='mainFrame'  class="vinculos">12. ENTIDADES  V.SES</a>
	</td>
	<td align="center" class="listado2" width="38%">
	<a href='usuario/listafuncionarios.php?<?=$phpsession ?>' target='mainFrame'  class="vinculos">12.1 FUNCIONARIO - ENTIDAD</a>
</td>
<td align="center" class="listado2" width="38%"><a href="tbasicas/adm_esp_usuarios.php?krd=<?=$krd?>" class="vinculos" target='mainFrame'>12. ENTIDADES</a></td>
</tr>
</table>

</body>
</html>
