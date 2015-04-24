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
$entrada = 0;
$modificaciones = 0;
$salida = 0;

?>
<html>
<head>
<title>Creación de Proceso</title>
<link rel="stylesheet" href="../../../estilos/orfeo.css">

<script language="JavaScript">
<!--
	function validarDatos()
	{ 
		
		if(document.frmCrearProceso.nombreProceso.value == "")
                {       alert("Debe ingresar nombre del Proceso." );
                        document.frmCrearProceso.nombreProceso.focus();
                        return false;
                }
        if(document.frmCrearProceso.codigoProceso.value == "")
        {       alert("Debe ingresar el codigo del Proceso." );
                document.frmCrearProceso.codigoProceso.focus();
                return false;
        }
	 	if(document.frmCrearProceso.codigoProceso.value == "")
        {       alert("Debe ingresar el codigo del Proceso." );
                document.frmCrearProceso.codigoProceso.focus();
                return false;
        }
	 	document.form1.submit();
	}

	
//-->
</script>



</head>
<body>
<?
    include "$ruta_raiz/config.php";
	include_once "$ruta_raiz/include/db/ConnectionHandler.php";
    $db = new ConnectionHandler( "$ruta_raiz" );
    if (!defined('ADODB_FETCH_ASSOC'))define('ADODB_FETCH_ASSOC',2);
    $ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
//	$db->conn->debug = true;
	//<form name='frmCrear' action='<?=$action
	$resultadoInsercion = 1;
//		include "$ruta_raiz/debugger.php";

	if( ( $_POST['nombreProceso'] != '' &&  $_POST['codserie'] != 0 &&  $_POST['tsub'] != 0  ) ||  ( $_POST['nombreProceso'] != '' &&  $_POST['codserie'] == 0 &&  $_POST['tsub'] == 0 )){
//			echo "<br>Viene Proceso en POST, luego debería crearlo</br>";
			include "$ruta_raiz/include/tx/Proceso.php";
	 		$flujo = new Proceso( $db,  $nombreProceso,$codserie, $tsub, $flujoAutomatico,  $terminosProceso );	
			$resultadoInsercion = $flujo-> insertaProceso();
//			echo "<br>Esto es lo que retorna: " . $resultadoInsercion . "</br>";

	}
?>
<form name='frmCrearProceso' action='creaProceso.php' method="post">
<table width="93%"  border="1" align="center">
  	<tr bordercolor="#FFFFFF">
    <td colspan="2" class="titulos4">
	<center>
	<p><B><span class=etexto>ADMINISTRACI&Oacute;N DE FLUJOS</span></B> </p>
	<p><B><span class=etexto> Crear Proceso </span></B> </p></center>
	</td>
	</tr>
</table>
<table border=1 width=93% class=t_bordeGris align="center">
	<tr class=timparr>
			<td class="titulos2" height="26" width="25%" colspan="-1">Nombre Proceso</td>
			<td class="listado2" height="1" width="75%" colspan="3">
				<input type=text name=nombreProceso value='<?=$nombreProceso?>' maxlength="100" size="90">
			</td>
	</tr>
	<tr class=timparr>
			<td class="titulos2" height="26" width="25%">Flujo Autom&aacute;tico</td>
			<td class="listado2" height="1" width="25%">
				<input type="checkbox" name="flujoAutomatico" value="$automatico" <? if ($flujoAutomatico) echo "checked"; else echo "";?>>
			</td>
			<td class="titulos2" height="26" width="25%">T&eacute;rminos (en d&iacute;as)</td>
			<td class="listado2" height="1" width="25%">
				<input type=text name=terminosProceso value='<?=$terminosProceso?>'>
			</td>
	</tr>
	<tr align="center">
		<td width="25%" class="titulos2">SERIE</td>
		<td width="25%" height="35" class="listado2">
			<?php
			    include "$ruta_raiz/trd/actu_matritrd.php";  
			    if(!$codserie) $codserie = 0;
				$fechah=date("dmy") . " ". time("h_m_s");
				$fecha_hoy = Date("Y-m-d");
				$sqlFechaHoy=$db->conn->DBDate($fecha_hoy);
				$check=1;
				$fechaf=date("dmy") . "_" . time("hms");
				$num_car = 4;
				$nomb_varc = "sgd_srd_codigo";
				$nomb_varde = "sgd_srd_descrip";
			   	include "$ruta_raiz/include/query/trd/queryCodiDetalle.php";
				$querySerie = "select distinct ($sqlConcat) as detalle, sgd_srd_codigo 
				         from sgd_srd_seriesrd 
						 order by detalle
						  ";
				$rsD=$db->conn->query($querySerie);
				$comentarioDev = "Muestra las Series Docuementales";
				include "$ruta_raiz/include/tx/ComentarioTx.php";
				print $rsD->GetMenu2("codserie", $codserie, "0:-- Seleccione --", false,"","onChange='submit()' class='select'" );
			 ?>
				</td>
		 	
				<td width="25%" class="titulos2">SUBSERIE</td>
				<td width="25%" height="35" class="listado2">
				<?
					$nomb_varc = "sgd_sbrd_codigo";
					$nomb_varde = "sgd_sbrd_descrip";
					include "$ruta_raiz/include/query/trd/queryCodiDetalle.php"; 
				   	$querySub = "select distinct ($sqlConcat) as detalle, sgd_sbrd_codigo 
					         from sgd_sbrd_subserierd 
							 where sgd_srd_codigo like '$codserie'
				 			 
							 order by detalle
							  ";
							  $db->conn->debug=true;
					$rsSub=$db->conn->query($querySub);
					include "$ruta_raiz/include/tx/ComentarioTx.php";
					print $rsSub->GetMenu2("tsub", $tsub, "0:-- Seleccione --", false,""," class='select'" );
				
				?> 
				</td>
			</tr>
</table>


<table border=1 width=93% class=t_bordeGris align="center">
	<tr class=timparr>
	      <td height="30" colspan="2" class="listado2"><span class="celdaGris"> <span class="e_texto1">
		  <center> <input class="botones" type="submit" Value="Continuar" onClick=" return validarDatos();"> </center> </span> </span></td>
	      <td height="30" colspan="2" class="listado2"><span class="celdaGris"> <span class="e_texto1">
	<center><a href='mnuFlujosBasico.php?<?=session_name()."=".session_id()."&$encabezado"?>'><input class="botones" type=button name=Cancelar id=Cancelar Value=Cancelar></a></center>  </span> </span></td>
	</tr>
</table>

<?
if (( $_POST['nombreProceso'] != '' &&  $_POST['codserie'] != 0 &&  $_POST['tsub'] != 0  ) ||  ( $_POST['nombreProceso'] != '' &&  $_POST['codserie'] == 0 &&  $_POST['tsub'] == 0 )) {
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