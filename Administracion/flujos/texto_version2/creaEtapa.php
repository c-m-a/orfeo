<?
session_start();

if($_POST["nombreEtapa"]) $nombreEtapa = $_POST["nombreEtapa"];
if($_POST["terminoEtapa"]) $terminoEtapa = $_POST["terminoEtapa"];
if($_POST["proceso"]) $proceso = $_POST["proceso"];
if($_POST["etapaAEliminar"]) $etapaAEliminar = $_POST["etapaAEliminar"];
if($_POST["clickboton"]) $clickboton = $_POST["clickboton"];
if($_GET["crear"]) $crear = $_GET["crear"];


import_request_variables("gp", "");

$ruta_raiz = "../../..";

include "$ruta_raiz/config.php";
include_once "$ruta_raiz/include/db/ConnectionHandler.php";
$db = new ConnectionHandler( "$ruta_raiz" );
if (!defined('ADODB_FETCH_ASSOC'))define('ADODB_FETCH_ASSOC',2);
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
//$db->conn->debug = true;    
$entrada = 0;
$modificaciones = 0;
$salida = 0;

	$subtitulo = "CREAR O MODIFICAR ETAPAS";
	$nombreBoton = "Crear";
	
	if( $_GET['proceso'] != '' ){
		$procesoSelected = $_GET['proceso'];
	}elseif ( $_POST['proceso'] != ''){
		$procesoSelected = $_POST['proceso'];
	}
	include_once "$ruta_raiz/include/query/flujos/queryProcesos.php";									
	
	$rsTRDProc=$db->query( $sqlSerie );
			
	if( $rsTRDProc )
	{
		
			$_SESSION["serieProc"] = $rsTRDProc->fields['SGD_SRD_CODIGO'];
			$_SESSION["subserieProc"] = $rsTRDProc->fields['SGD_SBRD_CODIGO'];

	}else {
		var_dump($rsTRDProc);
	}

?>
<html>
<head>
<title>Creación de Proceso</title>
<link rel="stylesheet" href="../../../estilos/orfeo.css"><script language="JavaScript">
<!--
	
	function validarDatos()
	{ 
		if(document.frmCrearEtapa.nombreEtapa.value == "")
        {       alert("Debe ingresar nombre de la Etapa." );
                document.frmCrearEtapa.nombreEtapa.focus();
                return false;
        }
        var terminos = document.frmCrearEtapa.terminoEtapa.value;
        var terminosInt = parseInt(terminos);
        
        if( terminos != '' && isNaN(terminosInt) )
        {       alert("Solo puede ingresar números en el campo de duracion de la etapa." );
                document.frmCrearEtapa.terminoEtapa.focus();
                return false;
        }
        if( terminosInt < 0 )
        {       alert("No puede ingresar valores negativos en el campo de duracion de la etapa." );
                document.frmCrearEtapa.terminoEtapa.focus();
                return false;
        }
		<?  $clickBoton = true; ?>
	 	document.frmCrearEtapa.submit();
	}
	
	function verificaEliminacion( etapaParaEliminacion, puedeEliminar, form ){
		if ( puedeEliminar ) {
		
			alert("La etapa: " + etapaParaEliminacion + ", no se puede eliminar porque hay conexiones que dependen de ella.");
			if (form.etapaAEliminar.length) 
						{ 
							 
							for (var b = 0; b < form.etapaAEliminar.length; b++) 
								if (form.etapaAEliminar[b].checked) 
								{ 
									form.etapaAEliminar[b].checked = false; break; 
								} 

						} else 
							form.etapaAEliminar.checked = false; 
			return false;
		}else{
				var confirmaEliminacion = confirm("Seguro que desea eliminar la etapa: " + etapaParaEliminacion + "?");
				if( confirmaEliminacion ){
					form.submit();
					return true;
				}else{
					//Al no confirmar la eliminación se debe desmarcar la etapa que se habia marcado para eliminación
					if (form.etapaAEliminar.length) 
						{ 
							 
							for (var b = 0; b < form.etapaAEliminar.length; b++) 
								if (form.etapaAEliminar[b].checked) 
								{ 
									form.etapaAEliminar[b].checked = false; break; 
								}

						} else 
							form.etapaAEliminar.checked = false; 
					return false;
				}
		}
		
	}
		
function Start(URL, WIDTH, HEIGHT)
{
 windowprops = "top=0,left=0,location=no,status=no, menubar=no,scrollbars=yes, resizable=yes,width=";
 windowprops += WIDTH + ",height=" + HEIGHT;
 
 window.open(URL , "preview", windowprops);
}



function regresar(){
	window.location.reload();
	window.close();

}

	function carga()
	{
		document.frmCrearEtapa.nombreEtapa.value = '';
		document.frmCrearEtapa.terminoEtapa.value = '';
	    document.frmCrearEtapa.nombreEtapa.focus();
	}
	

//-->
</script>

</head>
<body onload="carga();">
<?
//	include "$ruta_raiz/debugger.php";
	$resultadoInsercion = 1;
	
	if( $_GET['proceso'] != '' ){
		$procesoSelected = $_GET['proceso'];
	}elseif ( $_POST['proceso'] != ''){
		$procesoSelected = $_POST['proceso'];
	}
	
	if( $etapaAEliminar ){
		$queryELimina = "DELETE FROM SGD_FEXP_FLUJOEXPEDIENTES WHERE SGD_FEXP_CODIGO = " .$etapaAEliminar;
		 $rs = $db->conn->query( $queryELimina );
		 if($rs){
		 	$resultadoInsercion = "Se elimin&oacute; la etapa de forma satisfactoria";
		 }else {
		 	$resultadoInsercion = "Error eliminando la etapa";		 	
		 }
		
	}
		
	if ( $_POST['nombreEtapa'] != '' && $clickBoton && !$etapaAEliminar ){
			include "$ruta_raiz/include/tx/Proceso.php";
	 		$flujo = new EtapaFlujo( $db );
	 		
	 		$flujo->initEtapa( $nombreEtapa, $ordenEtapa, $terminoEtapa, $procesoSelected );	
			
			$resultadoInsercion = $flujo-> insertaEtapa(  );
			
			$clickBoton = false;
	}
?>
<form name='frmCrearEtapa' action='creaEtapa.php?&crear=<?=$crear?>' method="post">
<table width="93%"  border="1" align="center">
  	<tr bordercolor="#FFFFFF">
    <td colspan="2" class="titulos4">
	<center>
	<p><B><span class=etexto>ADMINISTRACI&Oacute;N DE FLUJOS</span></B></p>
	<p><B><span class=etexto> <?=$subtitulo?></span></B></p></center>
	</td>
	</tr>

</table>


<table border=1 width=93% class=t_bordeGris align="center">
	<tr class=timparr>
			<td class="titulos2" height="26">Nombre Etapa:</td>
			<td class="listado2" height="1">
				<input type=text name=nombreEtapa value='<?=$nombreEtapa?>'>
		</td>
		
			<td class="titulos2" height="26" width="100%" colspan="2"> Convenciones para listado de conexiones</td>
			
	</tr>
	<tr class=timparr>
			<td class="titulos2" height="26" width="25%">Duraci&oacute;n (d&iacute;as)</td>
			<td class="listado2" height="1" width="25%">
				<input type=text name=terminoEtapa value='<?=$terminoEtapa?>'>
			</td>
		</td>
		
			<td class="titulos2" height="26" width="25%"><img src="../../../imagenes/FlechasEntrada2b.gif">  </td>
			<td class="listado2" height="1" width="75%">Indica que la conexi&oacute;n es de entrada a dicha etapa </td>
	</tr>
	<tr class=timparr>
			<td class="titulos2" height="26" width="25%">Serie del Proceso: &nbsp;&nbsp;<font color="Green" size="3"><?=$_SESSION["serieProc"]?></font></td>
			<td class="listado2" height="1" width="25%">SubSerie del Proceso: &nbsp;&nbsp;<font color="Green" size="3"><?=$_SESSION["subserieProc"]?>
			</font></td>
			<td class="titulos2" height="26" width="25%"><img src="../../../imagenes/FlechasSalida.gif"> </td>
			<td class="listado2" height="1" width="75%">Indica que la conexi&oacute;n es de salida a dicha etapa </td>
	</tr>
</table>

<input name='proceso' type='hidden' value='<?=$procesoSelected?>'>
<input name='clickboton' type='hidden' value='<?=$clickBoton?>'>


<table border=1 width=93% class=t_bordeGris align="center">
	<tr class=timparr>
	      <td height="30" colspan="2" class="listado2"><span class="celdaGris"> <span class="e_texto1">
		  <center> <input class="botones" type="button" Value=<?=$nombreBoton?> onClick=" return validarDatos();"> </center> </span></td>
	      <td height="30" colspan="2" class="listado2"><span class="celdaGris"> <span class="e_texto1">
	<center><a href='mnuFlujosBasico.php?<?=session_name()."=".session_id()."&$encabezado"?>'>
	<input class="botones" type=button name=Cancelar id=Cancelar Value=Cancelar></center>  </span></td>
	<td height="30" colspan="2" class="listado2">
  <span class="celdaGris">
	</span></td>
	</tr>
</table>
<br>
<?
if ( ( $_POST['nombreEtapa'] != '' ||  $etapaAEliminar != null )) {
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
<?
	include("./listadoEtapas.php");
?>




</form>
</body>
</html>
