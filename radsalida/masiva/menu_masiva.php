<?
session_start();
/**
  * Pagina Menu_Masiva.php que muestra el contenido de las Carpetas
  * Creado en la SSPD en el año 2003
  * 
  * Se añadio compatibilidad con variables globales en Off
  * @autor Jairo Losada 2009-05
  * @licencia GNU/GPL V 3
  */

foreach ($_GET as $key => $valor)   ${$key} = $valor;
foreach ($_POST as $key => $valor)   ${$key} = $valor;

$krd = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
$usua_doc = $_SESSION["usua_doc"];
$codusuario = $_SESSION["codusuario"];
$tip3Nombre=$_SESSION["tip3Nombre"];
$tip3desc = $_SESSION["tip3desc"];
$tip3img =$_SESSION["tip3img"];

/**
 * Este programa despliega el menu principal de correspondencia masiva
 * @author      Sixto Angel Pinzon
 * @version     1.0
 */

error_reporting(7);

$ruta_raiz = "../../";

require_once("$ruta_raiz/include/db/ConnectionHandler.php");
//Si no llega la dependencia recupera la sesion
if(!isset($_SESSION['dependencia']))
{	include "$ruta_raiz/rec_session.php";	}
if (!$db)	$db = new ConnectionHandler($ruta_raiz);
$phpsession = session_name()."=".session_id(); ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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
<body bgcolor="#FFFFFF" topmargin="0" onLoad="window_onload();">


<table width="47%" align="center" border="0" cellpadding="0" cellspacing="5" class="borde_tab">
<tr>
	<td height="25" class="titulos4">RADICACI&Oacute;N MASIVA DE DOCUMENTOS</td>
</tr>
<tr align="center">
	<td class="listado2" >
		<a href='upload2.php?<?=$phpsession ?>&krd=<?=$krd?>&<? echo "fechah=$fechah"; ?>' class="vinculos" target='mainFrame'>
		Generar Radicaci&oacute;n Masiva
		</a>
	</td>
</tr>
<tr align="center">
	<td class="listado2" >
		<a href="../cuerpo_masiva_recuperar_listado.php?<?=$phpsession ?>&krd=<?=$krd?>" class="vinculos">
		Recuperar Listado
	</a>
	</td>
</tr>
<tr align="center">
	<td class="listado2" >
		<a href='consulta_depmuni.php?<?=$phpsession ?>&krd=<?=$krd?>&<? echo "fechah=$fechah"; ?>' class="vinculos" target='mainFrame'>
		Consultar Divisi&oacute;n Pol&iacute;tica Administrativa de Colombia (DIVIPOLA)</a>
	</td>
</tr>
<tr align="center">
	<td class="listado2" >
		<a href='consultaESP.php?<?=$phpsession ?>&krd=<?=$krd?>&<? echo "fechah=$fechah"; ?>' target='mainFrame' class="vinculos">
		Consulta y Selecci&oacute;n destinatarios masiva
		</a>
	</td>
</tr>
</table>


<?
	include( "administradorSecuencias.php" );
?>
</body>
</html>
