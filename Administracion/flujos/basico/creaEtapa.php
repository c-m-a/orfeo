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
//if(!isset($_SESSION['dependencia']))	include "$ruta_raiz/rec_session.php";


include "$ruta_raiz/config.php";
	include_once "$ruta_raiz/include/db/ConnectionHandler.php";
    $db = new ConnectionHandler( "$ruta_raiz" );
    if (!defined('ADODB_FETCH_ASSOC'))define('ADODB_FETCH_ASSOC',2);
    $ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
//	$db->conn->debug = true;    
$entrada = 0;
$modificaciones = 0;
$salida = 0;

	$subtitulo = "CREAR O MODIFICAR ETAPAS";
	$nombreBoton = "Ingresar Etapa";

?>
<html>
<head>
<title>Creación de Proceso</title>
<link rel="stylesheet" href="../../../estilos/orfeo.css">

<script language="JavaScript">
<!--
	function validarDatos()
	{ 
		if(document.frmCrearEtapa.nombreEtapa.value == "")
        {       alert("Debe ingresar nombre de la Etapa." );
                document.frmCrearEtapa.nombreEtapa.focus();
                return false;
        }
        if(document.frmCrearEtapa.ordenEtapa.value == "")
        {       alert("Debe ingresar el orden de la etapa." );
                document.frmCrearEtapa.ordenEtapa.focus();
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


	
//-->
</script>



</head>
<body>
<?
//	include "$ruta_raiz/debugger.php";

    
	//<form name='frmCrear' action='<?=$action
	$resultadoInsercion = 1;
	
	if( $_GET['proceso'] != '' ){
		$procesoSelected = $_GET['proceso'];
	}elseif ( $_POST['proceso'] != ''){
		$procesoSelected = $_POST['proceso'];
	}
	
	if( $etapaAEliminar ){
		var_dump("ET a elim: ".$etapaAEliminar);
		$queryELimina = "DELETE FROM SGD_FEXP_FLUJOEXPEDIENTES WHERE SGD_FEXP_CODIGO = " .$etapaAEliminar;
		 $rs = $db->conn->query( $queryELimina );
		 if($rs){
		 	$resultadoInsercion = "Se elimin&oacute; la etapa de forma satisfactoria";
		 }else {
		 	$resultadoInsercion = "Error eliminando la etapa";		 	
		 }
		
	}
		
	if ( $_POST['nombreEtapa'] != '' && $clickBoton && !$etapaAEliminar ){
	
//			echo "<br>Viene etapa en POST, luego debería crearla</br>";
			include "$ruta_raiz/include/tx/Proceso.php";
	 		$flujo = new EtapaFlujo( $db );

//	 		echo "<br>pasa constructor</br>";
	 		
	 		$flujo->initEtapa( $nombreEtapa, $ordenEtapa, $terminoEtapa, $procesoSelected );	
//			echo "<br>pasa initetapa</br>";
			
				$resultadoInsercion = $flujo-> insertaEtapa(  );
			
			$clickBoton = false;

//			echo "<br>Esto es lo que retorna: " . $resultadoInsercion . "</br>";

	}
?>
<form name='frmCrearEtapa' action='creaEtapa.php?&crear=<?=$crear?>' method="post">
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

<table border=1 width=93% class=t_bordeGris align="center">
	<tr class=timparr>
	      <td height="30" colspan="2" class="listado2"><span class="celdaGris"> <span class="e_texto1">
		  <center> <input class="botones" type="submit" Value=<?=$nombreBoton?> onClick=" return validarDatos();"> </center> </span> </span></td>
	      <td height="30" colspan="2" class="listado2"><span class="celdaGris"> <span class="e_texto1">
	<center><a href='mnuFlujosBasico.php?<?=session_name()."=".session_id()."&$encabezado"?>'><input class="botones" type=button name=Cancelar id=Cancelar Value=Cancelar></a></center>  </span> </span></td>
	<td height="30" colspan="2" class="listado2"><span class="celdaGris"> <span class="e_texto1">
	<center><a href='creaArista.php?<?=session_name()."=".session_id()."&$encabezado"?>&proceso=<?=$procesoSelected?>'><input class="botones" type=button name=Continuar id=Continuar Value="Crear Aristas"></a></center>  </span> </span></td>
	</tr>
</table>
<br>
<br>
<?
	include("./listadoEtapas.php");
?>


<?

	
if ( $_POST['nombreEtapa'] != '' ||  $etapaAEliminar != null  ) {
?>
	<?
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