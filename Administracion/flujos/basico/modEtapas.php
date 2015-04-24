<?

$krdOld = $krd;
error_reporting(0);
session_start();
error_reporting(0);
$ruta_raiz = "../..";
$carpetaOld = $carpeta;
$tipoCarpOld = $tipo_carp;
if(!$tipoCarpOld) $tipoCarpOld= $tipo_carpt;
if(!$krd) $krd=$krdOld;
//if(!isset($_SESSION['dependencia']))	include "$ruta_raiz/rec_session.php";
$entrada = 0;
$modificaciones = 0;
$salida = 0;
/*if(!$fecha_busq) $fecha_busq=date("Y-m-d");
($usModo ==1) ? $tituloCrear = "Creacion de Usuario" : $tituloCrear = "Edicion de Usuario";
*/
$queryProc = $accion;
if ( $accion == 1 ) {
	$tituloCrear = "Creaci&oacute;n de flujo - seleccionar Proceso ";	
	$action =  'cuadriculaCrearFlujo.php';
}else if ( $accion == 2 ) {
	$tituloCrear = "Modificaci&oacute;n de flujo - seleccionar Proceso";		
	$action =  'cuadriculaModificarFlujo.php';
}elseif ( $accion == 3 ) {
	$tituloCrear = "Consulta de flujo - seleccionar Proceso";			
	$action =  'cuadriculaConsultarFlujo.php';
}
	
//$phpsession = session_name()."=".session_id();			
//$params=$phpsession."&procesoSelected=$procesoSelected";

?>
<html>
<head>
<title>Untitled Document</title>
<link rel="stylesheet" href="../../estilos/orfeo.css">

</head>
<body>
<?
    include "$ruta_raiz/config.php";
	include_once "$ruta_raiz/include/db/ConnectionHandler.php";
    $db = new ConnectionHandler( "$ruta_raiz" );
    if (!defined('ADODB_FETCH_ASSOC'))define('ADODB_FETCH_ASSOC',2);
    $ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
//	$db->conn->debug = false;
	//<form name='frmCrear' action='<?=$action
?>
<form name='frmCrear' action='<?=$action?>' method="post">
<table width="93%"  border="1" align="center">
  	<tr bordercolor="#FFFFFF">
    <td colspan="2" class="titulos4">
	<center>
	<p><B><span class=etexto>ADMINISTRACI&Oacute;N DE FLUJOS</span></B> </p>
	<p><B><span class=etexto> Modificaci&oacute;n de Etapas </span></B> </p></center>
	</td>
	</tr>
</table>
<table border=1 width=93% class=t_bordeGris align="center">
<?
?>
	<tr class=timparr>
			<td class="titulos2" height="26">Orden</td>
			<td class="titulos2" height="26">Etapa</td>
			<td class="titulos2" height="26">Modificar</td>
			<td class="titulos2" height="26">Eliminar</td>
	</tr>
	<tr class=timparr>
			<td class="titulos2" height="26">Etapa Final</td>
			<td class="titulos2" height="26">Etapa Final</td>
			<td class="titulos2" height="26">Etapa Final</td>
			<td class="titulos2" height="26">Etapa Final</td>
	</tr>
</table>


<table border=1 width=93% class=t_bordeGris align="center">
	<tr class=timparr>
	      <td height="30" colspan="2" class="listado2"><span class="celdaGris"> <span class="e_texto1">
		  <center> <input class="botones" type="submit" Value="Continuar"> </center> </span> </span></td>
	      <td height="30" colspan="2" class="listado2"><span class="celdaGris"> <span class="e_texto1">
	<center><a href='../formAdministracion.php?<?=session_name()."=".session_id()."&$encabezado"?>'><input class="botones" type=button name=Terminar id=Terminar Value=Terminar></a></center>  </span> </span></td>
	</tr>
</table>
</form>
</body>
</html>
