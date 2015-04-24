<?
/**
 * Este programa despliega el men� principal de correspondencia masiva
 * @author      Sixto Angel Pinz�n
 * @version     1.0
 */
//error_reporting(7);
session_start();
$ruta_raiz = "../../";

//require_once("$ruta_raiz/include/db/ConnectionHandler.php");
include_once "$ruta_raiz/include/db/ConnectionHandler.php" ;
//Si no llega la dependencia recupera la sesi�n
if(!isset($_SESSION['dependencia']))
{	include "$ruta_raiz/rec_session.php";	}
if (!$db)	$db = new ConnectionHandler($ruta_raiz);

$phpsession = session_name()."=".session_id();
$db->conn->debug = true;

?>
<html>
<head>
<link rel="stylesheet" href="../../estilos/orfeo.css">
<script language="JavaScript">
<!--

function Start(URL, WIDTH, HEIGHT)
{
 windowprops = "top=0,left=0,location=no,status=no, menubar=no,scrollbars=yes, resizable=yes,width=";
 windowprops += WIDTH + ",height=" + HEIGHT;

 preview = window.open(URL , "preview", windowprops);
}

//-->
</script>

</head>
<body bgcolor="#FFFFFF" topmargin="0" onLoad="window_onload();>
<form id="frmGeneraSecuenciasMasiva" action='upload2.php?<?=$phpsession ?>&krd=<?=$krd?>&<? echo "fechah=$fechah"; ?>' method="POST">
<table width="47%" align="center" border="0" cellpadding="0" cellspacing="5" class="borde_tab">
<tr>
	<td height="25" class="titulos4" colspan="2">ADMINISTRACI&Oacute;N DE SECUENCIAS</td>
</tr>
<tr align="center">
	<td class="listado2" >
		<a href='javascript:Start("generarSecuencias.php?<?=$phpsession ?>&krd=<?=$krd?>&<? echo "fechah=$fechah"; ?>",500,300)' class="vinculos" target='mainFrame'>
			Separar secuencia</a>
	</td>
</tr>
<tr align="center">
	<td class="listado2" colspan="2" >
<!--		<center>-->
			<a href='upload2PorExcel.php?<?=$phpsession ?>&krd=<?=$krd?>&<? echo "fechah=$fechah"; ?>' class="vinculos" target='mainFrame'>
			Cargar Lista de Documentos generados</a>
<!--			<input type="button" value="Generar" class="botones" onclick="return advertencia();">-->
<!--		</center>-->
	</td>
</tr>
</table>
</form>
</body>
</html>
