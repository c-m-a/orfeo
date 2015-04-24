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

if ( $tipificacion ) $deshabilitado =  ""; else $deshabilitado =  "disabled=true";


 include "$ruta_raiz/config.php";
	include_once "$ruta_raiz/include/db/ConnectionHandler.php";
    $db = new ConnectionHandler( "$ruta_raiz" );
    if (!defined('ADODB_FETCH_ASSOC'))define('ADODB_FETCH_ASSOC',2);
    $ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
//	$db->conn->debug = true;
	if( $_GET['proceso'] != '' ){
		$procesoSelected = $_GET['proceso'];
	}elseif ( $_POST['proceso'] != ''){
		$procesoSelected = $_POST['proceso'];
	}
	include_once "$ruta_raiz/include/query/flujos/queryAristas.php";	
	$rsDepMax = $db->conn->Execute( $sqlMax );
	$idEtapas = $rsDepMax->fields['MAXETAPAS'];
?>
<html>
<head>
<title>Modificaci&oacute;n de Arista</title>
<link rel="stylesheet" href="../../../estilos/orfeo.css">

<script language="JavaScript">
<!--
	function validarDatos()
	{ 
		if(document.frmCrearArista.descripcionArista.value == "")
        {       alert("Debe ingresar la descripcion de la Arista." );
                document.frmCrearArista.descripcionArista.focus();
                return false;
        }
        
		var minimo = document.frmCrearArista.diasMinimo.value;
		var maximo = document.frmCrearArista.diasMaximo.value;
		var enteroMin = parseInt(minimo);
		var enteroMax = parseInt(maximo);
			
        if( enteroMin < 0 || enteroMin > 999 )
        {       alert("El valor para Dias Minimo debe estar entre 0 y 999" );
                document.frmCrearArista.diasMinimo.focus();
                return false;
        }
        if( enteroMax < 0 || enteroMax > 999 )
        {       alert("El valor para Dias Maximo debe estar entre 0 y 999" );
                document.frmCrearArista.diasMaximo.focus();
                return false;
        }
        
        if( minimo != '' && isNaN(enteroMin) )
        {
               alert( "Solo debe ingresar numeros en dias minimo" );
                document.frmCrearArista.diasMinimo.focus();
                return false;
        }

        if( maximo != '' && isNaN(enteroMax) )
        {
               alert( "Solo debe ingresar numeros en dias maximo" );
                document.frmCrearArista.diasMaxnimo.focus();
                return false;
        }
        <?  $clickBoton = true; ?>
	 	document.form1.submit();
	}
		
function Start(URL, WIDTH, HEIGHT)
{
 windowprops = "top=0,left=0,location=no,status=no, menubar=no,scrollbars=yes, resizable=yes,width=700,height=500";
 preview = window.open(URL , "preview", windowprops);
}

function f_close(){
	window.close();
}

function regresar(){
	f_close();
}
	
//-->
</script>



</head>
<body >
<?
//	include "$ruta_raiz/debugger.php";

	if( $_GET['proceso'] != '' ){

		$procesoSelected = $_GET['proceso'];
	}
	if( $_GET['aristaAModificar'] != '' ){
		$aristaAModificar = $_GET['aristaAModificar'];
		$queryModifica = "SELECT * FROM SGD_FARS_FARISTAS WHERE SGD_FARS_CODIGO = " .$aristaAModificar;
		$rs = $db->conn->query( $queryModifica );
		$descripcionArista = $rs->fields['SGD_FARS_DESC'];
		$diasMinimo = $rs->fields['SGD_FARS_DIASMINIMO'];
		$diasMaximo = $rs->fields['SGD_FARS_DIASMAXIMO'];
		$automatico = ( $rs->fields['SGD_FARS_AUTOMATICO'] == 1 ? "automatico" : null );
		$tipificacion = ( $rs->fields['SGD_FARS_TIPIFICACION'] == 1 ? "tipificacion" : null );
		$etapaInicioID =  $rs->fields['SGD_FEXP_CODIGOINI'];
		$etapaFinID =  $rs->fields['SGD_FEXP_CODIGOFIN'];
		$trad =  $rs->fields['SGD_TRAD_CODIGO'];
		
		$codserie = $rs->fields['SGD_SRD_CODIGO'];
		$tsub = $rs->fields['SGD_SBRD_CODIGO'];
		$tipo = $rs->fields['SGD_TPR_CODIGO'];
		
	}

	if( ( $_POST['descripcionArista'] != '' &&  $_POST['codserie'] != null &&  $_POST['tsub'] != null &&  $_POST['tipo'] != null  &&  $_POST['codserie'] != 0 &&  $_POST['tsub'] != 0 &&  $_POST['tipo'] != 0 &&  $_POST['tipificacion'] != null &&  $_POST['tipificacion'] != '' ) 
	||  ( $_POST['descripcionArista'] != '' &&  $_POST['codserie'] == 0 &&  $_POST['tsub'] == 0 &&  $_POST['tipo'] == 0 &&  $_POST['tipificacion'] == null )
			 ){
			include "$ruta_raiz/include/tx/Proceso.php";
	 		$flujo = new AristaFlujo( $db );

	 		$flujo->initArista( $etapaInicial, $etapaFinal, $descripcionArista, $diasMinimo, $diasMaximo, $trad,$codserie,$tsub, $tipo, $procesoSelected, $_POST['automatico'], $tipificacion );	
			$resultadoInsercion = $flujo-> modificaArista( $aristaAModificar );
	}
?>
<form name='frmCrearArista' action='modificaArista.php?proceso=<?=$procesoSelected?>' method="post">
<table width="93%"  border="1" align="center">
  	<tr bordercolor="#FFFFFF">
    <td colspan="2" class="titulos4">
	<center>
	<p><B><span class=etexto>ADMINISTRACI&Oacute;N DE FLUJOS</span></B> </p>
	<p><B><span class=etexto> Modificar Arista </span></B></p></center>
	</td>
	</tr>
</table>

<table border=1 width=93% class=t_bordeGris align="center">
	<tr class=timparr>
			<td class="titulos2" height="26">Etapa Inicial</td>
			<td class="listado2" height="1">
				<?
				$rsDep = $db->conn->Execute( $sql );
				print $rsDep->GetMenu2( "etapaInicial", $etapaInicioID, false, false, 0," class='select'" );
				?>
		</td>
	</tr>
	<tr class=timparr>
			<td class="titulos2" height="26">Etapa Final</td>
			<td class="listado2" height="1">
				<?
				$rsDep = $db->conn->Execute( $sql );
				print $rsDep->GetMenu2( "etapaFinal", $etapaFinID, false, false, 0," class='select'" );
				?>
		</td>
	</tr>
</table>
<table border=1 width=93% class=t_bordeGris align="center">
                <tr>
                <td height="23" align="left" colspan="3" class="titulos2" width="25%">
                Descripci&oacute;n:
                        </td>
                        <td height="23" colspan="3" class="listado2" width="75%">
                        <input type="text" name="descripcionArista"  id="descripcionArista" value="<?=$descripcionArista?>"  size=60 lenght=80 >
                </td>
                </tr>
        </td>
  </tr>
</table>
<table border=1 width=93% class=t_bordeGris align="center">
	   <tr>
	        <td height="23" colspan="4" class="titulos2" width="25%">
	        	D&iacute;as M&iacute;nimo:
	        </td>
	        <td height="23" colspan="4" class="listado2" width="25%">
	        	<input type="text" name="diasMinimo" value="<?=$diasMinimo?>" size="15" lenght="3" >
	        </td>
	        <td height="23" colspan="4" class="titulos2" width="25%">
	        	D&iacute;as M&aacute;ximo:
	        </td>
	        <td height="23" colspan="4" class="listado2" width="25%">
	        	<input type="text" name="diasMaximo" value="<?=$diasMaximo?>" size="15" lenght="3">
	        </td>
        </tr>
        <tr>
            <td height="23" colspan="4" class="titulos2" width="25%">
            	Tipo de Radicado:
            </td>
            <td height="23" colspan="4" class="listado2" width="25%">
            	<?
			 	include_once "$ruta_raiz/include/query/flujos/queryTiposDoc.php";									
				$rsDep = $db->conn->Execute( $sql );
				print $rsDep->GetMenu2( "trad", $trad, ("0:-- Ninguno --"), false, ""," class='select'" );
				?>
            </td>
            <td height="23" colspan="4" class="titulos2" width="25%">
            	Autom&aacute;tico:
            </td>
            <td height="23" colspan="4" class="listado2" width="25%">
             	   <input type="checkbox" name="automatico" value="$automatic" <? if ($automatico) echo "checked"; else echo "";?> >
            </td>
        </tr>
        <tr>
        	<td height="23" colspan="4" class="titulos2" width="25%">
            	Tipificaci&oacute;n:
            </td>
            <td height="23" colspan="4" class="listado2" width="25%">
                <input type="checkbox" name="tipificacion" value="$tipificacion" <? if ($tipificacion) echo "checked"; else echo "";?> onchange="submit();">
            </td>
            <td height="23" colspan="4" class="titulos2" width="25%">
            	
            </td>
            <td height="23" colspan="4" class="listado2" width="25%">
            	
            </td>
        </tr>
</table>

 <table width="93%" align="center" border="0" cellpadding="0" cellspacing="5" class="borde_tab" >
	<tr align="center">
		<td height="35" colspan="2" class="titulos4">Aplicaci&Oacute;n de la TRD para la Arista</td>
	</tr>
	<tr align="center">
		<td width="36%" class="titulos2">SERIE</td>
		<td width="64%" height="35" class="listado2">
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
	
	print $rsD->GetMenu2("codserie", $codserie, "0:-- Seleccione --", false,"","onChange='submit()' class='select' " . $deshabilitado );
		?>
				</td>
		 	<tr align="center">
				<td width="36%" class="titulos2">SUBSERIE</td>
				<td width="64%" height="35" class="listado2">
				<?
	$nomb_varc = "sgd_sbrd_codigo";
	$nomb_varde = "sgd_sbrd_descrip";
	include "$ruta_raiz/include/query/trd/queryCodiDetalle.php"; 
   	$querySub = "select distinct ($sqlConcat) as detalle, sgd_sbrd_codigo 
	         from sgd_sbrd_subserierd 
			 where sgd_srd_codigo = '$codserie'
 			       and ".$sqlFechaHoy." between sgd_sbrd_fechini and sgd_sbrd_fechfin
			 order by detalle
			  ";
	$rsSub=$db->conn->query($querySub);
	include "$ruta_raiz/include/tx/ComentarioTx.php";
			print $rsSub->GetMenu2("tsub", $tsub, "0:-- Seleccione --", false,"","onChange='submit()' class='select' " . $deshabilitado );
		?>
				</td>
			</tr>
		  	<tr align="center">
				<td width="36%" class="titulos2">TIPO DE DOCUMENTO</td>
				<td width="64%" height="35" class="listado2">
		<?
			$ent = 1;
			$nomb_varc = "t.sgd_tpr_codigo";
			$nomb_varde = "t.sgd_tpr_descrip";
			include "$ruta_raiz/include/query/trd/queryCodiDetalle.php";
			$queryTip = "select distinct ($sqlConcat) as detalle, t.sgd_tpr_codigo
				         from sgd_mrd_matrird m, sgd_tpr_tpdcumento t
						 where 
			 			       m.sgd_srd_codigo = '$codserie'
						       and m.sgd_sbrd_codigo = '$tsub'
			 			       and t.sgd_tpr_codigo = m.sgd_tpr_codigo
							   and t.sgd_tpr_tp$ent='1'
						 order by detalle";
			$rsTip=$db->conn->query($queryTip);
			include "$ruta_raiz/include/tx/ComentarioTx.php";
			print $rsTip->GetMenu2("tipo", $tipo, "0:-- Seleccione --", false,""," class='select' " . $deshabilitado);
		?>
	</tr>
</table>

<input name='proceso' type='hidden' value='<?=$procesoSelected?>'>
<input type=hidden id="aristaAModificar" name="aristaAModificar" value='<?=$aristaAModificar?>'>

<table border=1 width=93% class=t_bordeGris align="center">
	<tr class=timparr>
	      <td height="30" colspan="2" class="listado2"><span class="celdaGris"> <span class="e_texto1">
		  <center> <input class="botones" type="submit" Value="Modificar Arista"  onClick=" return validarDatos();"> </center> </span> </span></td>
	      <td height="30" colspan="2" class="listado2"><span class="celdaGris"> <span class="e_texto1">
			<center><input class="botones" type=button name=Cerrar id=Cerrar Value=Cerrar onclick='f_close()'></a></center>  </span> </span>
		  </td>
	</tr>
</table>
<?
if ( $clickBoton ) {
  ?>
		<center>
			<table class=borde_tab>
				<tr>
					<td class=titulosError>
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