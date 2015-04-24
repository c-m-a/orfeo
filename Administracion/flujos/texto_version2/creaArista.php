<?
session_start();

/**
  * Paggina Cuerpo.php que muestra el contenido de las Carpetas
	* Modificaciones y Adaptciones por www.correlibre.org 
  * 
	* Se añadio compatibilidad con variables globales en Off
  * Arreglo de Funcionalidad
  *
  * @autor Jairo Losada 2009-08
  * @licencia GNU/GPL V 3
  */
echo "Post<hr>";
print_r($_POST);
echo "Get<hr>";
print_r($_GET);

if($_GET["crear"]) $crear = $_GET["crear"];
if($_GET["proceso"]) $proceso = $_GET["proceso"];
if($_GET["etapaCreaArista"]) $etapaCreaArista = $_GET["etapaCreaArista"];

if($_POST["nombreEtapa"]) $nombreEtapa = $_POST["nombreEtapa"];
if($_POST["etapaInicial"]) $etapaInicial = $_POST["etapaInicial"];
if($_POST["etapaFinal"]) $etapaFinal = $_POST["etapaFinal"];
if($_POST["terminoEtapa"]) $terminoEtapa = $_POST["terminoEtapa"];
if($_POST["nombreProceso"]) $nombreProceso = $_POST["nombreProceso"];
if($_POST["codserie"]) $codserie = $_POST["codserie"];
if($_POST["tsub"]) $tsub = $_POST["tsub"];
if($_POST["tipo"]) $tipo = $_POST["tipo"];
if($_POST["proceso"]) $proceso = $_POST["proceso"];
if($_POST["etapaAEliminar"]) $etapaAEliminar = $_POST["etapaAEliminar"];
if($_POST["clickboton"]) $clickboton = $_POST["clickboton"];
if($_POST["etapaInicial"]) $cetapaInicial = $_POST["etapaInicial"];
if($_POST["etapaFinal"]) $etapaFinal = $_POST["etapaFinal"];
if($_POST["descripcionArista"]) $descripcionArista = $_POST["descripcionArista"];
if($_POST["diasMinimo"]) $diasMinimo = $_POST["diasMinimo"];
if($_POST["diasMaximo"]) $diasMaximo = $_POST["diasMaximo"];
if($_POST["trad"]) $trad = $_POST["trad"];
if($_POST["tipificacion"]) $tipificacion = $_POST["tipificacion"];
if($_POST["automatico"]) $automatico = $_POST["automatico"];
if($_POST["ClickCrea"]) $ClickCrea = $_POST["ClickCrea"];
if($_POST["clickboton"]) $clickboton = $_POST["clickboton"];
if($_POST["Button_x"]) $Button_x = $_POST["Button_x"];
if($_POST["Button_y"]) $Button_y = $_POST["Button_y"];
if($_POST["Button"]) $Button = $_POST["Button"];


$ruta_raiz = "../../..";
$entrada = 0;
$modificaciones = 0;
$salida = 0;
$trdDisabled = false;
if ( $tipificacion ) $deshabilitado =  ""; else $deshabilitado =  "disabled=true";

 include "$ruta_raiz/config.php";
	include_once "$ruta_raiz/include/db/ConnectionHandler.php";
    $db = new ConnectionHandler( "$ruta_raiz" );
    if (!defined('ADODB_FETCH_ASSOC'))define('ADODB_FETCH_ASSOC',2);
    $ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
	//$db->conn->debug = true;
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
<title>Creaci&oacute;n de Proceso - OrfeoGPL.org</title>
<link rel="stylesheet" href="../../../estilos/orfeo.css">

<script language="JavaScript">
<!--

var nodo  =0;
	function nuevoAjax(){
        var xmlhttp=false;
        if(typeof XMLHttpRequest!='undefined'){
                xmlhttp = new XMLHttpRequest();
        }else{
                try {
                        this.xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
                } catch (e) {
                        try {
                                        this.xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                        } catch (E) {
                                xmlhttp = false;
                        }
                }
        }
        return xmlhttp;
	}
	function $(elemento){
		return document.getElementById(elemento);
		
	}


function consulta(componente){
		var compon;
		var param="";
		var nodo="";
		var nomcompo=componente.id.substr( 0, 4 );
		if( nomcompo == "tsub" ){
			
			nodo=componente.id.substr( 4 );
			compon="tipo";
			param="&tsub="+componente.value;
		}else{
			nodo=componente.id.substr(8);
			compon="tsub";
			param="&subserie=1";
		}
		pagina="trd.php?codserie="+$("codserie").value+param;
		ajax=nuevoAjax();
		ajax.open("GET",pagina ,true);
        ajax.onreadystatechange=function() {
        if (ajax.readyState==4) {
                     $(compon).innerHTML = ajax.responseText;
                }
        }
        ajax.send(null)
	}


	function validarDatos()
	{ 
		if(document.frmCrearArista.descripcionArista.value == "")
        {       alert("Debe ingresar la descripcion de la Conexion." );
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
        
        var tipifica = document.frmCrearArista.tipificacion.checked;
        var serieDoc = document.frmCrearArista.codserie.value;
        var subserieDoc = document.frmCrearArista.tsub.value;
        var tipoDoc = document.frmCrearArista.tipo.value;
        
        if( tipifica  && ( serieDoc == 0 || subserieDoc == 0 || tipoDoc == 0 ))
        {       alert("Si selecciona tipificacion, debe seleccionar la serie, subserie y tipo documental." );
                
                return false;
        }
        
	 	document.frmCrearArista.submit();
	}
	
function Start(URL, WIDTH, HEIGHT)
{
 windowprops = "top=0,left=0,location=no,status=no, menubar=no,scrollbars=yes, resizable=yes,width=700,height=500";
 window.open(URL , "preview", windowprops);
}

function cerrar(){
	window.opener.regresar();
	window.close();
}


function regresar(){
	window.location.reload();
	window.close();
}

	function verificaEliminacion( aristaParaEliminacion, form ){
		
				var confirmaEliminacion = confirm("Seguro que desea eliminar la conexion: " + aristaParaEliminacion);
				if( confirmaEliminacion ){
					form.submit();
					return true;
				}else{
					
						if (form.aristaAEliminar.length) 
						{ 
							 
							for (var b = 0; b < form.aristaAEliminar.length; b++) 
								if (form.aristaAEliminar[b].checked) 
								{ 
									form.aristaAEliminar[b].checked = false; break; 
								} 
						} else 
							form.aristaAEliminar.checked = false; 
					
					return false;
				}
	}

	function verificaEtapas(){
		//Verificar primero si hay etapas para el flujo, si no hay no se pueden crear aristas
		<?	
			
			if( $idEtapas < 1 ){
		?>
		alert("El flujo para el Proceso seleccionado no tiene Etapas,\npor lo tanto no puede crear Conexiones. \nSera redireccionado a la pagina de creacion de etapas.");
			window.location = 'creaEtapa.php?proceso=<?=$procesoSelected?>';
		<?	
			}else {
				
		?>
		
			return true;
		<?
			}
		?>
	}
	
//-->
</script>

</head>
<body onload="verificaEtapas()">
<?
	if( $aristaAEliminar ){
		$queryELimina = "DELETE FROM SGD_FARS_FARISTAS WHERE SGD_FARS_CODIGO = " .$aristaAEliminar;
		 $rs = $db->conn->query( $queryELimina );
		 if($rs){
		 	$resultadoInsercion = "Se elimin&oacute; la conexi&oacute;n de forma satisfactoria";
		 }else {
		 	$resultadoInsercion = "Error eliminando la conexi&oacute;n";
		 }
		
	}
	if ($_GET['etapaCreaArista']) {
		$etapaInicial = $_GET['etapaCreaArista'];	
	}elseif ($_POST['etapaCreaArista']) {
		$etapaInicial = $_POST['etapaCreaArista'];
	}
	
	if( ( $_POST['descripcionArista'] != '' &&  $_POST['codserie'] != null &&  $_POST['tsub'] != null &&  $_POST['tipo'] != null  &&  $_POST['codserie'] != 0 &&  $_POST['tsub'] != 0 &&  $_POST['tipo'] != 0 &&  $_POST['tipificacion'] != null &&  $_POST['tipificacion'] != '' && !$aristaAEliminar  && $ClickCrea == 'Crear') 
	||  ( $_POST['descripcionArista'] != '' &&  $_POST['codserie'] == 0 &&  $_POST['tsub'] == 0 &&  $_POST['tipo'] == 0 &&  $_POST['tipificacion'] == null && !$aristaAEliminar   && $ClickCrea == 'Crear')
			 ){
			include "$ruta_raiz/include/tx/Proceso.php";
	 		$flujo = new AristaFlujo( $db );
			if( $_POST['tipificacion'] != ''){
		 		$serieArista = $codserie;
		 		$subserieArista = $tsub;				
			}else {
		 		$serieArista = 0;
		 		$subserieArista = 0;								
			}

	 		$flujo->initArista( $etapaInicial, $etapaFinal, $descripcionArista, $diasMinimo, $diasMaximo, $trad,$serieArista,$subserieArista, $tipo, $procesoSelected, $_POST['automatico'], $tipificacion );	

			$resultadoInsercion = $flujo-> insertaArista(  );
	}
?>
<form name='frmCrearArista' action='creaArista.php?proceso=<?=$procesoSelected?>' method="post">
<table width="93%"  border="1" align="center">
  	<tr bordercolor="#FFFFFF">
    <td colspan="2" class="titulos4">
	<center>
	<p><B><span class=etexto>ADMINISTRACI&Oacute;N DE FLUJOS</span></B> </p>
	<p><B><span class=etexto> Crear conexi&oacute;n </span></B></p></center>
	</td>
	</tr>
</table>

<table border=1 width=93% class=t_bordeGris align="center">
	<tr class=timparr>
			<td class="titulos2" height="26">Etapa Inicial</td>
			<td class="listado2" height="1">
				<?
				$rsDep = $db->conn->Execute( $sql );
				print $rsDep->GetMenu2( "etapaInicial", $etapaInicial, false, false, 0," class='select'" );
				
				?>
		</td>
	</tr>
	<tr class=timparr>
			<td class="titulos2" height="26">Etapa Final</td>
			<td class="listado2" height="1">
				<?
				$rsDep = $db->conn->Execute( $sql );
				print $rsDep->GetMenu2( "etapaFinal", $etapaFinal, false, false, 0," class='select'" );
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
                        <input type="text" name="descripcionArista"  id="descripcionArista" value="<?=$descripcionArista?>"  size=60 lenght=100 >
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
				
				print $rsDep->GetMenu2( "trad", $trad, "0:-- Ninguno --", false, ""," class='select'" );
				
				?>
            </td>
            <td height="23" colspan="4" class="titulos2" width="25%">
            	Autom&aacute;tico:
            </td>
            <td height="23" colspan="4" class="listado2" width="25%">
             	   <input type="checkbox" name="automatico" <? if ($automatico) echo "checked"; else echo "";?> >
            </td>
        </tr>
        <tr>
        	<td height="23" colspan="4" class="titulos2" width="25%">
            	Tipificaci&oacute;n:
            </td>
            <td height="23" colspan="4" class="listado2" width="25%">
                <input type="checkbox" name="tipificacion" <? if ($tipificacion) echo "checked"; else echo "";?> onchange="submit();">
            </td>
            <td height="23" colspan="4" class="titulos2" width="25%">
            	
            </td>
            <td height="23" colspan="4" class="listado2" width="25%">
            	
            </td>
        </tr>
</table>

 <table width="93%" align="center" border="0" cellpadding="0" cellspacing="5" class="borde_tab" >
	<tr align="center">
		<td height="35" colspan="2" class="titulos4">Aplicaci&Oacute;n de la TRD para la Conexi&oacute;n</td>
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
   	
//   	$sqlConcat = $db->conn->Concat("$nomb_varde","' -- '","$nomb_varc");
	$querySerie = "select distinct ($sqlConcat) as detalle, sgd_srd_codigo 
	         from sgd_srd_seriesrd 
			 order by detalle
			  ";
	$rsD=$db->conn->query($querySerie);
	$comentarioDev = "Muestra las Series Docuementales";
	include "$ruta_raiz/include/tx/ComentarioTx.php";
	//$codserie = $_SESSION["serieProc"];
	print $rsD->GetMenu2("codserie", $codserie, "0:-- Seleccione --", false,"","onChange='consulta(this);' class='select' " . $deshabilitado." id='codserie'"  );
		?>
				</td>
	</tr>
		 	<tr align="center">
									<td width="36%" class="titulos2">SUBSERIE</td>
									<td width="64%" height="35" class="listado2">
									<select name="tsub" id="tsub"  onChange="consulta(this);" class="select">
									<option value="0" selected >"0:-- Seleccione --"</option>
									</select>
									</td>
								</tr>
							  	<tr align="center">
									<td width="36%" class="titulos2">TIPO DE DOCUMENTO</td>
									<td width="64%" height="35" class="listado2">
								<select name="tipo" id="tipo" class="select">
									<option value="0" selected >"0:-- Seleccione --"</option>
									</select>
						</tr>
</table>

<input name='proceso' type='hidden' value='<?=$procesoSelected?>'>

<table border=1 width=93% class=t_bordeGris align="center">
	<tr class=timparr>
	<td height="30" colspan="2" class="listado2"><span class="celdaGris"> <span class="e_texto1">
	<center> <input class="botones" type="submit" Value="Crear"  onClick=" return validarDatos();"  name="ClickCrea"> </center> </span> </span>
	</td>
	<td height="30" colspan="2" class="listado2"><span class="celdaGris">
	<center><input class="botones" type=button name=Cerrar id=Cerrar Value=Cerrar onclick='cerrar();'></a></center>  </span>
	</td>
	</tr>
</table>
<?
if ($_POST['descripcionArista'] != ''  ||  $aristaAEliminar != null ) {
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
<?
	include("./listadoAristas.php");
?>
</form>
</body>
</html>
