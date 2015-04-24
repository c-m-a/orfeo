<?
//$krdOld = $krd;
error_reporting(0);
session_start();
error_reporting(0);
$ruta_raiz = "../../..";
$carpetaOld = $carpeta;
$tipoCarpOld = $tipo_carp;
if(!$tipoCarpOld) $tipoCarpOld= $tipo_carpt;
if(!$krd) $krd=$krdOld;

include "$ruta_raiz/config.php";
include_once "$ruta_raiz/include/db/ConnectionHandler.php";
$db = new ConnectionHandler( "$ruta_raiz" );
if (!defined('ADODB_FETCH_ASSOC'))define('ADODB_FETCH_ASSOC',2);
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
//$db->conn->debug = true;    
$entrada = 0;
$modificaciones = 0;
$salida = 0;

	$subtitulo = "MODIFICAR ETAPA";
	$nombreBoton = "Modificar Etapa";
	$clickBoton = false;

?>
<html>
<head>
<title>Modificaci&oacute;n de Etapa</title>
<link rel="stylesheet" href="../../../estilos/orfeo.css">

<script language="JavaScript">
<!--
	function validarDatos()
	{ 
		if(document.frmCrearEtapa.nombreEtapa.value == "" || document.frmCrearEtapa.ordenEtapa.value == "" || document.frmCrearEtapa.terminoEtapa.value == "")
        {       alert("No puede dejar campos vacíos." );
                document.frmCrearEtapa.nombreEtapa.focus();
                return false;
        }
		<?  $clickBoton = true; ?>
	 	document.form1.submit();
	}
	
function Start(URL, WIDTH, HEIGHT)
{
 windowprops = "top=0,left=0,location=no,status=no, menubar=no,scrollbars=yes, resizable=yes,width=500,height=300";
 preview = window.open(URL , "preview", windowprops);
}

function f_close(){
		opener.regresar();
	window.close();
}

function regresar(){
	f_close();
}
//-->
</script>

</head>
<body>
<?
//	include "$ruta_raiz/debugger.php";
	
	if( $_GET['proceso'] != '' ){
		$procesoSelected = $_GET['proceso'];
	}
	if( $_GET['etapaAModificar'] != '' ){
		$etapaAModificar = $_GET['etapaAModificar'];
		$queryModifica = "SELECT SGD_FEXP_DESCRIP, SGD_FEXP_ORDEN, SGD_FEXP_TERMINOS FROM SGD_FEXP_FLUJOEXPEDIENTES WHERE SGD_FEXP_CODIGO = " .$etapaAModificar;
		$rs = $db->conn->query( $queryModifica );
		$nombreEtapa = $rs->fields['SGD_FEXP_DESCRIP'];
		$ordenEtapa = $rs->fields['SGD_FEXP_ORDEN'];
		$terminoEtapa = $rs->fields['SGD_FEXP_TERMINOS'];
	}
	if ( $_POST['nombreEtapa'] != '' && $clickBoton ){
			include "$ruta_raiz/include/tx/Proceso.php";
	 		$flujo = new EtapaFlujo( $db );
	 		
	 		$flujo->initEtapa( $nombreEtapa, $ordenEtapa, $terminoEtapa, $procesoSelected );	
				$resultadoInsercion = $flujo-> modificaEtapa( $etapaAModificar  );
	}
?>
<form name='frmCrearEtapa' action='modificaEtapa.php?&crear=<?=$crear?>' method="post">
<table width="93%"  border="1" align="center">
  	<tr bordercolor="#FFFFFF">
    <td colspan="2" class="titulos4">
	<center>
	<p><B><span class=etexto>ADMINISTRACI&Oacute;N DE FLUJOS</span></B> </p>
	<p><B><span class=etexto> <?=$subtitulo?></span></B> </p></center>
	</td>
	</tr>
</table>
<table border=1 width=93% class=t_bordeGris align="center">
	<tr class=timparr>
			<td class="titulos2" height="26">Nombre Etapa:</td>
			<td class="listado2" height="1">
				<input type=text name=nombreEtapa value='<?=$nombreEtapa?>'>
		</td>
		
			<td class="titulos2" height="26" width="25%"> </td>
			<td class="listado2" height="1" width="25%"> </td>
	</tr>
	<tr class=timparr>
			<td class="titulos2" height="26">Orden:</td>
			<td class="listado2" height="1">
				<input type=text name=ordenEtapa value='<?=$ordenEtapa?>'>
		</td>
		
			<td class="titulos2" height="26" width="25%"> </td>
			<td class="listado2" height="1" width="25%"> </td>
	</tr>
	<tr class=timparr>
			<td class="titulos2" height="26" width="25%">T&eacute;rminos (d&iacute;as)</td>
			<td class="listado2" height="1" width="25%">
				<input type=text name=terminoEtapa value='<?=$terminoEtapa?>'>
			</td>
			<td class="titulos2" height="26" width="25%"> </td>
			<td class="listado2" height="1" width="25%"> </td>
	</tr>
</table>

<input name='proceso' type='hidden' value='<?=$procesoSelected?>'>
<input type=hidden id="etapaAModificar" name="etapaAModificar" value='<?=$etapaAModificar?>'>


<table border=1 width=93% class=t_bordeGris align="center">
	<tr class=timparr>
	      <td height="30" colspan="2" class="listado2"><span class="celdaGris"> <span class="e_texto1">
		  <center> <input class="botones" type="submit" Value=<?=$nombreBoton?> onClick=" return validarDatos();"> </center> </span> </span></td>
	      <td height="30" colspan="2" class="listado2"><span class="celdaGris"> <span class="e_texto1">
			<center><input class="botones" type=button name=Cerrar id=Cerrar Value=Cerrar onclick='f_close()'></a></center>  </span> </span>
		  </td>
	</tr>
</table>
<br>
<?
  if( $clickBoton ){
?>
		<center>
			<table class=borde_tab>
				<tr>
					<td class=titulos2>
					   <?=$resultadoInsercion?>
					</td>
				</tr>
			</table>
		</center>
<?
}
?>
</form>
</body>
</html>