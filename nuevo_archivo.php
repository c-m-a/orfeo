<?php
  define('RADICADO_SALIDA', 1);

  session_start();

  if($_POST["tipo"]) $tipo = $_POST["tipo"];
  if($_POST["numrad"]) $numrad = $_POST["numrad"];
  if($_POST["tipoLista"]) $tipoLista = $_POST["tipoLista"];
  if($_POST["tipoDocumentoSeleccionado"]) $tipoDocumentoSeleccionado = $_POST["tipoDocumentoSeleccionado"];
  if($_POST["radicado_salida"]) $radicado_salida = $_POST["radicado_salida"];
  if($_POST["tpradic"]) $tpradic = $_POST["tpradic"];
  if($_POST["aplinteg"]) $aplinteg = $_POST["aplinteg"];
  if($_POST["direccionAlterna"]) $direccionAlterna = $_POST["direccionAlterna"];
  if($_POST["descr"]) $descr = $_POST["descr"];
  if($_POST["usuar"]) $usuar = $_POST["usuar"];
  if($_POST["predi"]) $predi = $_POST["predi"];
  if($_POST["empre"]) $empre = $_POST["empre"];
  if($_POST["MAX_FILE_SIZE"]) $MAX_FILE_SIZE = $_POST["MAX_FILE_SIZE"];
  if($_POST["i_copias"]) $i_copias = $_POST["i_copias"]; 
  if($_POST["cc"]) $cc = $_POST["cc"];
  if(!$_POST["cc"] && $_GET["cc"]) $cc = $_GET["cc"];
  if(!$_POST["usua"])  $usua = $_GET["usua"];
  if(!$_POST["numrad"])  $numrad = $_GET["numrad"];
  if(!$_POST["contra"])  $contra = $_GET["contra"];
  if(!$_POST["radi"])  $radi = $_GET["radi"];
  if(!$_POST["tipo"])  $tipo = $_GET["tipo"];
  if(!$_POST["ent"])  $ent = $_GET["ent"];
  if(!$_POST["otro_us11"])  $otro_us11 = $_GET["otro_us11"];
  if(!$_POST["dpto_nombre_us11"])  $dpto_nombre_us11 = $_GET["dpto_nombre_us11"];
  if(!$_POST["muni_nombre_us11"])  $muni_nombre_us11 = $_GET["muni_nombre_us11"];
  if(!$_POST["direccion_us11"])  $direccion_us11 = $_GET["direccion_us11"];
  if(!$_POST["nombret_us11"])  $nombret_us11 = $_GET["nombret_us11"];
  if(!$_POST["otro_us2"])  $otro_us2 = $_GET["otro_us2"];
  if(!$_POST["dpto_nombre_us2"])  $dpto_nombre_us2 = $_GET["dpto_nombre_us2"];
  if(!$_POST["muni_nombre_us2"])  $muni_nombre_us2 = $_GET["muni_nombre_us2"];
  if(!$_POST["direccion_us2"])  $direccion_us2 = $_GET["direccion_us2"];
  if(!$_POST["nombret_us2"])  $nombret_us2 = $_GET["nombret_us2"];
  if(!$_POST["dpto_nombre_us3"])  $dpto_nombre_us3 = $_GET["dpto_nombre_us3"];
  if(!$_POST["muni_nombre_us3"])  $muni_nombre_us3 = $_GET["muni_nombre_us3"];
  if(!$_POST["direccion_us3"])  $direccion_us3 = $_GET["direccion_us3"];
  if(!$_POST["nombret_us3"])  $nombret_us3 = $_GET["nombret_us3"];
  if(!$_POST["tpradic"])  $tpradic = $_GET["tpradic"];
  if(!$codigo and $_GET['codigo']) $codigo=$_GET['codigo'];

  $krd        = $_SESSION["krd"];
  $dependencia= $_SESSION["dependencia"];
  $usua_doc   = $_SESSION["usua_doc"];
  $codusuario = $_SESSION["codusuario"];
  $tpNumRad   = $_SESSION["tpNumRad"];
  $tpPerRad   = $_SESSION["tpPerRad"];
  $tpDescRad  = $_SESSION["tpDescRad"];
  $tip3Nombre = $_SESSION["tip3Nombre"];

  $ruta_raiz = ".";

  include_once "$ruta_raiz/class_control/AplIntegrada.php";
  include_once "$ruta_raiz/include/db/ConnectionHandler.php";

  if (!$ent)	$ent= substr(trim($numrad),strlen($numrad)-1,1);

  $nombreTp3 = $tip3Nombre[3][$ent];

  if (!$db)
    $db = new ConnectionHandler($ruta_raiz);

  $dbAux = new ConnectionHandler($ruta_raiz);
  $dbAux->conn->SetFetchMode(ADODB_FETCH_ASSOC);
  $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
  $conexion = $db;
  $rowar = array();
  $mensaje = '';
  $tipoDocumento = explode("-", $tipoLista);
  $tipoDocumentoSeleccionado = $tipoDocumento[1];

  $isql = "SELECT usua_login,
                  usua_pasw,
                  codi_nivel
            FROM usuario
            WHERE (usua_login ='$krd') ";
  $rs = $db->conn->Execute($isql);

  if ($rs->EOF) {
    $mensaje="No tiene permisos para ver el documento";	}
  else {
    $nivel=$rs->fields["CODI_NIVEL"];
    $psql = ($tipo==0)? " where  anex_tipo_codi<80 " : " ";
    $isql = "select ANEX_TIPO_CODI,
                    ANEX_TIPO_DESC,
                    ANEX_TIPO_EXT
                from anexos_tipo 
                $psql order by anex_tipo_desc desc";
    $rs = $db->conn->Execute($isql);
  }

  if ($resp1=="OK") {
    $mensaje = ($subir_archivo)?
                '<span class="info">Archivo anexado correctamente</span></br>':
                'Anexo Modificado Correctamente<br>No se anex&oacute; ning&uacute;n archivo</br>';
  } elseif ($resp1=="ERROR") {
    $mensaje = '<span class="alarmas">Error al anexar archivos</span></br>';
  }

  include "$ruta_raiz/radicacion/crea_combos_universales.php";
  if (!function_exists(return_bytes)) {
    /**
     * Retorna la cantidad de bytes de una expresion como 7M, 4G u 8K.
     *
     * @param char $var
     * @return numeric
     */
    function return_bytes($val) {
      $val = trim($val);
      $ultimo = strtolower($val{strlen($val)-1});
      switch($ultimo)
      {// El modificador 'G' se encuentra disponible desde PHP 5.1.0
        case 'g':	$val *= 1024;
        case 'm':	$val *= 1024;
        case 'k':	$val *= 1024;
      }
      return $val;
    }
  }

  $consultaESP = "select r.EESP_CODI from radicado r where r.radi_nume_radi = $numrad";
  $rsESP = $db->conn->Execute($consultaESP);
  $codigoESP = $rsESP->fields["EESP_CODI"];
  $consultaRUPS = "select FLAG_RUPS from bodega_empresas where ARE_ESP_SECUE = $codigoESP";

  $rsESPRUPS = $db->conn->Execute( $consultaRUPS );
  $espEnRUPS = $rsESPRUPS->fields[ "FLAG_RUPS" ];
?>
<html>
<head>
<title>Informaci&oacute;n de Anexos</title>
<link rel="stylesheet" href="estilos/orfeo.css"><SCRIPT Language="JavaScript" SRC="js/crea_combos_2.js"></SCRIPT><script language="javascript">
<?php
// Convertimos los vectores de los paises, dptos y municipios creados en crea_combos_universales.php a vectores en JavaScript.
echo arrayToJsArray($vpaisesv, 'vp');
echo arrayToJsArray($vdptosv, 'vd');
echo arrayToJsArray($vmcposv, 'vm');
//$swIntegraAps = $objApl->comboRadiAplintegra($usua_doc);
//$objApl->comboRadiAplisel();
?>

function destinatario_seleccionado() {
  var campo_seleccionado = false;

  // Revision de destinatario envia false is no hay nada seleccionado
  if(document.getElementById('rusuario').checked) {
    // El remitente esta seleccionado
    campo_seleccionado = true;
  }else if(document.getElementById('rempre').checked) {
    // Entidad solidaria
    campo_seleccionado = true;
  } else if (document.getElementById('rpredi').checked) {
    // ESP
    campo_seleccionado = true;
  } else if (document.getElementById('rpredi').checked) {
    // Otro
    campo_seleccionado = true;
  }
  
  if (!campo_seleccionado) {
    alert('No ha seleccionado ningun destinatario');
  }
  return campo_seleccionado;
}


function mostrar(nombreCapa) {
  document.getElementById(nombreCapa).style.display="";
}

function continuar_grabar() {
<? if ($swIntegraAps!="0")
	{
	?>
		<!-- document.formulario.aplinteg.disabled=false; -->
	<?
	}
	?>
	document.formulario.tpradic.disabled=false;
	document.formulario.action=document.formulario.action+"&cc=GrabarDestinatario";
	document.formulario.submit();
}

function mostrarNombre(nombreCapa) {
  document.formulario.elements[nombreCapa].style.display="";
}

function ocultarNombre(nombreCapa) {
  document.formulario.elements[nombreCapa].style.display="none";
}

function ocultar(nombreCapa) {
  document.getElementById(nombreCapa).style.display="none";
}

function procEst(dato1,dato2,valor) {
}

function Start(URL, WIDTH, HEIGHT)
{
 windowprops = "top=0,left=0,location=no,status=no, menubar=no,scrollbars=yes, resizable=yes,width=1020,height=500";
 preview = window.open(URL , "preview", windowprops);
}

function doc_radicado()
{
	mostrarForm();
	swSelRadic = 0;
	for (n=1;n<document.formulario.tpradic.length;n++ )
		if (document.formulario.tpradic.options[n].selected ) {
			swSelRadic=1;
		}

	if (!document.formulario.radicado_salida.checked)
	{
		document.formulario.tpradic.disabled=false;
		eval(document.formulario.elements['tpradic'].options[0]=new Option('- Tipos de Radicacion -','null' ));
		document.formulario.elements['tpradic'].options[0].selected=true;
		document.formulario.elements['tpradic'].disabled=true;
		
		<? if ($swIntegraAps!="0") { ?>
		document.formulario.aplinteg.disabled=true;
		<?}?>
	}
	else
	{
		document.formulario.tpradic.disabled=false;
		<?
		//SI Puede integrar aplicativos
		if($radi)
		{	$ent = substr(trim($radi),-1);	}
		//echo ("*** $swIntegraAps ***");
		if ($swIntegraAps!="0") { ?>
		document.formulario.aplinteg.disabled=false;
		<?//si maneja prioridades y no es el primer documento es decir el soporte

		if ($swIntegraAps!="OK" ) {
		?>
		if (swSelRadic==0) {
		for (n=0;n<document.formulario.tpradic.length;n++ ) {
		if (document.formulario.tpradic.options[n].value == '<?=$swIntegraAps?>') {
			document.formulario.tpradic.options[n].selected=true;
			//document.formulario.elements['tpradic'].disabled=true;
			//document.formulario.elements['aplinteg'].disabled=true;
		}
		}
		}
		<?} else {

		?>
		 if (swSelRadic==0) {
		  for (n=0;n<document.formulario.tpradic.length;n++ ) {
			if (document.formulario.tpradic.options[n].value == 1 ){
				document.formulario.tpradic.options[n].selected=true;
			}
		}
		 }
		<?
		}
		}else{?>

		if (swSelRadic==0) {
		for (n=0;n<document.formulario.tpradic.length;n++ ) {
			if (document.formulario.tpradic.options[n].value == 1 ){
				document.formulario.tpradic.options[n].selected=true;
			}
		}
		}

		<?}?>
		<?

		 if (($verunico==1) && ($ent!=2)) { ?>
			eval(document.formulario.elements['tpradic'].options[0]=new Option('Salida','1' ));
			document.formulario.elements['tpradic'].options[0].selected=true;
			document.formulario.elements['tpradic'].disabled=true;
			<? if ($swIntegraAps!="0" ) { ?>
			eval(document.formulario.elements['aplinteg'].options[0]=new Option('No integra','null' ));
			document.formulario.elements['aplinteg'].options[0].selected=true;

			<?}?>
		<?}?>
	}
}

function f_close(){
	//window.history.go(0);
	opener.regresar();
	window.close();
}

function regresar(){
	f_close();
}
function william()
{	if(document.getElementById('radicado_salida').checked)
	{	document.getElementById('tipo').disabled = false;
	}
	else
	{	document.getElementById('tipo').disabled = true;
	 }
}

function escogio_archivo()
{
  var largo;
  var valor;
  var extension;
  archivo_up = document.getElementById('userfile').value;
  valor=0;
  var mySplitResult = archivo_up.split(".");

  for(i = 0; i < (mySplitResult.length); i++){
    extension = mySplitResult[i]; 
  }
  extension = extension.toLowerCase();
<?
	while (!$rs->EOF)
	{
		 echo "
  if (	extension=='".$rs->fields["ANEX_TIPO_EXT"]."')
  {
      valor=".$rs->fields["ANEX_TIPO_CODI"].";
               }\n";
		$rs->MoveNext();
	}
	$anexos_isql = $isql;
?>
document.getElementById('tipo_clase').value = valor;
if(document.getElementById('radicado_salida').checked==true && valor!=14 && valor!=16)
{
    <!-- alert("Atenci\363n. Si el archivo no es ODT o XML no podr\341 realizar combinaci\363n de correspondencia. \n\n otros archivos no facilitan su acceso");  
  -->
}
}

function validarGenerico()
{
	if (document.formulario.radicado_salida.checked && document.formulario.tpradic.value=='null') <!--!docume -ricardo secr gral->
	{
		alert ("Debe seleccionar el tipo de radicacion");
		return false;
	}

	archivo=document.getElementById('userfile').value;
	if (archivo=="")
	{
      <?php
	    if($tipo==0 and !$codigo){echo "alert('Por favor escoja un archivo'); return false;";}
	    else{echo "return true;";}
	  ?>
	}

	copias = document.getElementById('i_copias').value;
	if  (copias==0 && document.getElementById('radicado_salida').checked==true && document.getElementById('rotro').checked==true  )
 	{
		document.getElementById('radicado_salida').checked=false;
	}

	return true;
}

function actualizar() {
	if (!validarGenerico())	return;
  
  if (!destinatario_seleccionado()) {
    return;
  }

	var integracion = document.formulario.tpradic.value;
	if(  integracion == '5' ) {
		//Selecciona Resolucion, luego va para sancionados
<?php
if ($swIntegraAps=="011119999") {
	if ( $espEnRUPS!='S' ) {
		//Tiene integración pero no está en RUPS
?>
		if(document.formulario.rempre.checked == true ) {
			//y Efectivamente seleccionó ESP como destinatario, no puede ingresar a sancionado por no cumplir con RUPS
			alert("No puede ingresar sancionado, porque la ESP no se encuentra en RUPS. \nCambie el tipo de radicaci\363n o el destinatario.");
			return false;
		}
		else
		{
			//No selecciona ESP, luego no puede sancionar
			//alert("Los sancionados solo pueden ir dirigidos a las ESPs.");
			return true;
		}
<?php
	}
?>
		document.formulario.aplinteg.disabled=false;
<?php
}
?>
	}
  	
  	document.formulario.radicado_salida.disabled=false;
  	document.formulario.tpradic.disabled=false;
	document.formulario.submit();
}

function mostrarForm(  )
{
	var tipifica = document.formulario.radicado_salida.checked;
	if(tipifica)
		document.getElementById( "anexaExp" ).style.display = 'block';
	else
		document.getElementById( "anexaExp" ).style.display = 'none';
}
</script>
</head>
<body bgcolor="#FFFFFF" topmargin="0">
<div id="spiffycalendar" class="text"></div>
<link rel="stylesheet" type="text/css" href="js/spiffyCal/spiffyCal_v2_1.css"><script language="JavaScript" src="js/spiffyCal/spiffyCal_v2_1.js"></script><script language="javascript"><!--
  var dateAvailable = new ctlSpiffyCalendarBox("dateAvailable", "formulario", "fecha_doc","btnDate1","",scBTNMODE_CUSTOMBLUE);
//--></script>
<?php
$i_copias = 0;
if ($codigo)
{
	$isql = "select CODI_NIVEL
			,ANEX_SOLO_LECT
			,ANEX_CREADOR
			,ANEX_DESC
			,ANEX_TIPO_EXT
			,ANEX_NUMERO
			,ANEX_RADI_NUME 
			,ANEX_NOMB_ARCHIVO AS nombre
			,ANEX_SALIDA,ANEX_ESTADO,SGD_DIR_TIPO,RADI_NUME_SALIDA,SGD_DIR_DIRECCION from anexos, anexos_tipo,radicado ".
			"where anex_codigo='$codigo' and anex_radi_nume=radi_nume_radi and anex_tipo=anex_tipo_codi";

	$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
	$rs=$db->conn->Execute($isql);
	if (!$rs->EOF)
	{
		$docunivel=($rs->fields["CODI_NIVEL"]);
		$sololect=($rs->fields["ANEX_SOLO_LECT"]=="S");
		$remitente=$rs->fields["SGD_DIR_TIPO"];
		$extension=$rs->fields["ANEX_TIPO_EXT"];
		$radicado_salida=$rs->fields["ANEX_SALIDA"];
		$anex_estado=$rs->fields["ANEX_ESTADO"];
		$descr=$rs->fields["ANEX_DESC"];
		$radsalida = $rs->fields["RADI_NUME_SALIDA"];
		$direccionAlterna = $rs->fields["SGD_DIR_DIRECCION"];
	}
}
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td>
<?php
$datos_envio= "&otro_us11=$otro_us11&codigo=$codigo&dpto_nombre_us11=$dpto_nombre_us11&direccion_us11=".urlencode($direccion_us11)."&muni_nombre_us11=$muni_nombre_us11&nombret_us11=$nombret_us11";
$datos_envio.="&otro_us2=$otro_us2&dpto_nombre_us2=$dpto_nombre_us2&muni_nombre_us2=$muni_nombre_us2&direccion_us2=".urlencode($direccion_us2)."&nombret_us2=$nombret_us2";
$datos_envio.="&dpto_nombre_us3=$dpto_nombre_us3&muni_nombre_us3=$muni_nombre_us3&direccion_us3=".urlencode($direccion_us3)."&nombret_us3=$nombret_us3";
$variables = "ent=$ent&".session_name()."=".trim(session_id())."&tipo=$tipo&codigo=$codigo$datos_envio";
?>
<form enctype="multipart/form-data" method="POST" name="formulario" id="formulario" action='upload2.php?<?=$variables?>'>
<input type="hidden" name="anex_origen" value="<?=$tipo?>">
<input type="hidden" name="tipo" value="<?=$tipo?>">
<input type="hidden" name="numrad" value="<?=$numrad?>">
<input type="hidden" name="tipoLista" value="<?=$tipoLista?>">
<input type="hidden" name="tipoDocumentoSeleccionado" value="<?php echo $tipoDocumentoSeleccionado ?>">
<div align="center">
<table width="100%" align="center" border="0" cellpadding="0" cellspacing="5" class="borde_tab">
<tr>
	<td  align="center" class="titulos4" colspan="2">DESCRIPCI&Oacute;N DEL DOCUMENTO</td>
	</tr>
	<tr>
		<td  colspan="2">
		<table border=0 width=100% class="borde_tab" >
		<tr>
			<td align="left" colspan="3" class="listado2">
			Tipo de Anexo:
			<select name="tipo" class="select" id="tipo_clase" >
<?php
$db->conn->SetFetchMode(ADODB_FETCH_NUM);
$rs=$db->conn->Execute($anexos_isql);
while ( !$rs->EOF)
{
	if (($extension == 'odt' && $rs->fields[0]==14) || 
		($extension == 'doc' && $rs->fields[0]==1) || 
		($extension == 'xml' && $rs->fields[0]==16))
	{
		$datoss=" selected ";
	}
	else
	{
		$datoss = "";
	}
?>
		<option value="<?=$rs->fields[0]?>" '<?=$datoss?>'>
		<?=$rs->fields[1]?>
		</option>
<?php
	$rs->MoveNext();
}
?>
			</select>
<?php
//Grabando el documento en formato <b>(Rich Text Format (rtf), txt, html ,pdf, . . )</b>,
//podremos realizar combinacion de correspondencia, ya que estos formatos permiten acceso al codigo.
//<br><i>El formato .doc no permite realizar este proceso. <a href='http://www.gnu.org/philosophy/no-word-attachments.es.html' target='softwarepropietario'>Mas Informacion</a></i>
?>
			</td>
		</tr>
		<tr>
		<td colspan="3" class="listado2">
			<input type="checkbox" class="select"  name="sololect" <?php  if($tipo==1){echo " checked ";}  ?> id="sololect">
			Solo lectura
		</td>
	</tr>
	<tr>
		<td colspan="3" class="listado2">
		<table border=0 width=100% cellspacing="1" cellpadding="1">
		<tr>
		<td width=50% class="listado2">
<?php
$us_1 = "";
$us_2 = "";
$us_3 = "";
$datoss = "";
if ($nombret_us11 and $direccion_us11 and $dpto_nombre_us11 and $muni_nombre_us11) {
  $us_1 = "si";
  $usuar = 1;
	if($remitente==1)	{$datoss1=" checked " ;  }
}
else
{  $datoss1=" disabled ";	}

$datoss = "";
if ($nombret_us2 and $direccion_us2 and $dpto_nombre_us2 and $muni_nombre_us2  ) {
  $us_2 = "si";
  $predi = 1;
	if($remitente==2)	$datoss2=" checked  " ;
} else {
  $datoss2 = " disabled ";
}

$datoss = "";
if ($nombret_us3 and $direccion_us3 and $dpto_nombre_us3 and $muni_nombre_us3 ) {	
	$us_3 = "si";
	$empre=1;
	
  if($remitente==3)
    $datoss3=" checked  " ;
} else {
  $datoss3=" disabled " ;
}
	
if ($remitente==7)	$datoss4=" checked  ";
else	$datoss4 = "";

if($us_1 or $us_2 or $us_3) {
  $datoss = ($radicado_salida)? " checked " : " ";
	$swDischekRad = "";

	if (strlen(trim($radsalida))>0)
    $swDischekRad = "disabled=true";
	
  $datoss = $datoss. $swDischekRad;
?>
		<input type="checkbox" class="select" name="radicado_salida" '<?=$datoss?>' value="radsalida" '
<?php
	if (!$radicado_salida and $ent==1)
    $radicado_salida=1;
	
  if($radicado_salida==1) {
    echo " checked ";
  }
?>' onChange="doc_radicado()" id="radicado_salida">	Este documento ser&aacute; radicado
<?php
}
else
{
?>

	Este documento no puede ser radicado ya que faltan datos.<br>
	(Para envio son obligatorios Nombre, Direccion, Departamento,
	Municipio)
<?php
}
?>
		</td>
		<td class="listado2">
<?php
$comboRadOps = '';

if ($ent!=1 )
	$deshab=" disabled=true ";

$comboRad="<select name='tpradic' class='select' $deshab  $eventoIntegra >";
$comboRadSelecc = "<option selected value='null'>- Tipos de Radicacion -</option>";
$sel="";

$tpradic = (!$tpradic)? RADICADO_SALIDA : $tpradic;

foreach ($tpNumRad as $key => $valueTp) {
	if(strcmp(trim($tpradic),trim($valueTp))==0) {
		$sel="selected";
		$comboIntSwSel=1;
	}
	
  //Si se definio prioridad en algun tipo de radicacion
	$valueDesc = $tpDescRad[$key];
	$comboRadOps =$comboRadOps . "<option value='".$valueTp."' $sel>".$valueDesc."</option>";
	$sel = "";
}
$comboRad = $comboRad.$comboRadSelecc.$comboRadOps."</select>";
?>
		Radicaci&oacute;n  <?=$comboRad?> <BR>
<?php
if ($swIntegraAps!="0") {
?>
		Integra
		<select name='aplinteg' class='select' disabled='true' >
		<option selected value='null'>--- Aplicacion ---</option>
		</select>
<?php
}
if ($aplinteg)
	echo ("<script>comboRadiAplisel(document.formulario,$aplinteg,'aplinteg');</script>");
if ($ent==1 )
{
	echo ("<script>doc_radicado();</script>");
}

if (strlen(trim($swDischekRad)) > 0)
{
	echo ("<script>document.formulario.tpradic.disabled=true;</script>");
}
?>
		</td>
		</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td>
		<table  width="100%" align="center" border="0" cellpadding="0" cellspacing="5" class="borde_tab" id="anexaExp" style="display:none">
		<tr>
			<td class="titulos2"  width="50%">Guardar en Expediente:</td>
			<td  valign="top" class="listado2" >
			<table border="0"  class="borde_tab" align="center" class="titulos2">
			<tr class="titulos2">
<?php
$q_exp  = "SELECT  SGD_EXP_NUMERO as valor, SGD_EXP_NUMERO as etiqueta, SGD_EXP_FECH as fecha";
$q_exp .= " FROM SGD_EXP_EXPEDIENTE ";
$q_exp .= " WHERE RADI_NUME_RADI = " . $numrad;
$q_exp .= " AND SGD_EXP_ESTADO <> 2";
$q_exp .= " ORDER BY fecha desc";
$rs_exp = $db->conn->Execute( $q_exp );
						
if( $rs_exp->RecordCount( ) == 0 )
{
	$mostrarAlerta = "<td align=\"center\" class=\"titulos2\">";
	$mostrarAlerta .= "<span class=\"leidos2\" class=\"titulos2\" align=\"center\">
						<b>EL RADICADO PADRE NO ESTA INCLUIDO  EN UN EXPEDIENTE.</b>
						</span>
					</td>";
	$sqlt="select RADI_USUA_ACTU,RADI_DEPE_ACTU from RADICADO where RADI_NUME_RADI LIKE '$numrad'";
	$rsE=$db->conn->Execute($sqlt);
	$depe=$rsE->fields['RADI_DEPE_ACTU'];
	$usua=$rsE->fields['RADI_USUA_ACTU'];
	echo $mostrarAlerta;
}
else
{
?>
			<td align="center"  width="50%">
				<span class="leidos2"  align="center">
<?php print $rs_exp->GetMenu( 'expIncluidoAnexo', $expIncluidoAnexo, false, false, 0, "class='select'", false ); ?>
				</span>
			</td>
<?php
}
?>
			</tr>
			</table>
			</td>
		</tr>
		</table>
	</tr>
	<tr>
		<td class="titulos2"  colspan="2" >Destinatario</td>
	</tr>
	<tr valign="top">
		<td  valign="top" class="listado2" >
		<input type="radio" name="radicado_rem" value="1" id="rusuario" <?=$datoss1?> "<?php
		if(!$radicado_rem and $ent==1 and $radicado_rem != 7) $radicado_rem=1;
		echo " checked ";?>">
		<?=$tip3Nombre[1][$ent]?>
		<? if($tip3Nombre[1][$ent]) {?><br> <? } ?>
		<?=$otro_us11." - ".substr($nombret_us11,0,35)?>
		<? if($otro_us11) {?><br> <? } ?>
		<?=$direccion_us11?>
		<? if($direccion_us11) {?><br>  <? } ?>
		<?="$dpto_nombre_us11/$muni_nombre_us11" ?>
		</td>
		<td  valign="top" class="listado2">
			<input type="radio" name="radicado_rem" id="rempre" value=3 <?=$datoss3?> '<?php  if($radicado_rem==3){echo " checked ";}  ?> '>
			<?=$tip3Nombre[3][$ent]?>
			<? if($tip3Nombre[3][$ent]) {?><br> <? } ?>
			<?=substr($nombret_us3,0,35)?>
			<?=$direccion_us3?>
			<? if($direccion_us3) {?><br> <? } ?>
			<?="$dpto_nombre_us3/$muni_nombre_us3"?>
<?php
if ($direccion_us3) {
	if ($espEnRUPS == null && $swIntegraAps!="0")
	{
		echo "<font color=red> La ESP no se encuentra en RUPS, <br>por lo tanto no puede ser ingresada a Sancionados</font>";
	}
	else
	{
		 echo "<font color=blue>ESP en RUPS, se puede ingresar a Sancionados</font>"  ;				
	}
}
?>
			Notificacion a:
			( <span class="titulosError">
			<input type="text" name="direccionAlterna" value="<?=$direccionAlterna?>" size="18" readonly="readonly"></span> )
<?php
if(!empty($codigo)) {
	$anexo = $codigo;
?>
			<input name="modificarDireccion" value="Modificar Datos" class="botones" onclick="window.open('./mostrarDireccion.php?<?=session_name()?>=<?=session_id()?>&anexo=<?=$anexo?>&dptoCodi=<?=$codep_us1?>','Tipificacion_Documento','height=200,width=450,scrollbars=no')" type="button">
<?php
}
?>
		</td>
		</tr>
		<tr valign="top">
			<td valign="top" class="listado2">
				<input type="radio" name="radicado_rem" id="rpredi" value=2 <?=$datoss2?> '<?php  if($radicado_rem==2){echo " checked ";}  ?> '>
				<?=$tip3Nombre[2][$ent]?>
				<? if($tip3Nombre[2][$ent]) {?><br><? } ?>
				<?=$otro_us2." - ".substr($nombret_us2,0,35)?>
				<? if($otro_us2) {?><br><? } ?>
				<?=$direccion_us2?>
				<? if($direccion_us2) {?><br><? } ?>
				<?="$dpto_nombre_us2/$muni_nombre_us2" ?>
			</td>
			<td  valign="top" class="listado2">
				<input type="radio" name="radicado_rem" value=7 <?=$datoss4?> '<?php  if($radicado_rem==7){echo " checked ";}  ?> ' id="rotro">
				Otro
			</td>
		</tr>
		<tr valign="top" >
			<td  class='titulos2' colspan="2">Descripcion</td>
		</tr>
		<tr valign="top">
			<td  valign="top" colspan="2" height="66" class="listado2"  >
				<textarea name="descr" cols="90" rows="1" class="tex_area" id="descr"><?=$descr?></textarea>
				<input name="usuar" type="hidden" id="usuar" value="<?php echo $usuar ?>">
				<input name="predi" type="hidden" id="predi" value="<?php echo $predi ?>">
				<input name="empre" type="hidden" id="empre" value="<?php echo $empre ?>">
<?php
if($tipo==999999)
{	echo " <div align='left'>
			<font size='1' color='#000000'><b>Ubicaci&oacute;n F&iacute;sica:</b></font>
			<input type='text' name='anex_ubic' value='$anex_ubic'>
			";
}
?>
			</td>
		</tr>
		</table>
	</td>
</tr>
</table>
</div>
<div align="center">
<table width="100%" align="center" border="0" cellpadding="0" cellspacing="5" class="borde_tab" >
<?php
if($codigo)
{
?>
<tr>
	<td width="100%" class='titulos2'  > 
	<font size="1" class="etextomenu">
  Otro Destinatario <?  $busq_salida="true"; ?>
	</font>
	</td>
	<td width="25%" >
		<input type="button" name="Button" value="BUSCAR" class="botones" onClick="Start('<?=$ruta_raiz?>/radicacion/buscar_usuario.php?busq_salida=<?=$busq_salida?>&nombreTp3=<?=$nombreTp3?>&krd=<?=$krd?>',1024,500);">
	</td>
</tr>
<tr>
	<td class='celdaGris'  colspan="2">
	<table  width="100%" border="0" cellpadding="0" cellspacing="5" class="borde_tab" >
	<tr align="center" >
		<td width="203" CLASS=titulos2 >Documento</td>
		<td CLASS=titulos2  >Nombre</td>
		<td CLASS=titulos2 >Dirigido a</td>
		<td CLASS=titulos2 width="103">Direccion</td>
		<td CLASS=titulos2 width="68">Email</td>
		<td CLASS=titulos2 width="68">Otros</td>
	</tr>
	<tr class='<?=$grilla ?>'>
		<TD align="center" class="listado2">
			<input type="hidden" name="telefono_us1" value='' class="tex_area"  size="10">
			<input type="hidden" name="tipo_emp_us1" class="tex_area" size="3" value='<?=$tipo_emp_us1?>' >
			<input type="hidden" name="documento_us1" class="tex_area" size="3" value='<?=$documento_us1?>' >
			<input type="hidden" name="idcont1" id="idcont1" value='<?=$idcont1 ?>' class=e_cajas size=4 >
			<input type="hidden" name="idpais1" id="idpais1" value='<?=$idpais1 ?>' class=e_cajas size=4 >
			<input type="hidden" name="codep_us1" id="codep_us1" value='<?=$codep_us1 ?>' class=e_cajas size=4 >
			<input type="hidden" name="muni_us1" id="muni_us1"  value='<?=$muni_us1 ?>' class=e_cajas size=4 >
			<input type=text name=cc_documento_us1 value='<?=$cc_documento_us1 ?>' class=e_cajas size=8 >
		</TD>
		<TD width="329" align="center" class="listado2">
			<input type=text name=nombre_us1 value=''  size=3 class=tex_area>
			<input type=text name=prim_apel_us1 value=''   size=3 class=tex_area>
			<input type=text name=seg_apel_us1 value=''   size=3 class=tex_area>
		</TD>
		<TD width="140" align="center" class="listado2">
			<input type=text name=otro_us7 value='' class=tex_area   size=20 maxlength="45">
		</TD>
		<TD align="center" class="listado2">
			<input type=text name=direccion_us1 value='' class=tex_area  size=6>
		</TD>
		<TD width="68" align="center" class="listado2" colspan="2">
			<input type=text name=mail_us1 value='' class=tex_area size=11>
		<input type=text name=otro_us1 value='' class=tex_area size=11>
		</TD>
	</tr>
	<tr>
		<td colspan="3" class="listado2" align="center">
			<center><input type="button" name="cc" value="Grabar Destinatario" class="botones_mediano"  onClick="continuar_grabar()" ></center>
		</td>
		<td colspan="3" class="listado2" align="center">
<?php
	/* Si viene la variable cc(Boton de destino copia) envia al modulo de grabacion de datos
	 */
	$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);

	if($cc)
	{
		echo "$nombre_us1 or $prim_apel_us1 or $seg_apel_us2) and  $direccion_us1 and $muni_us1 and $codep_us1";
		if (($nombre_us1 or $prim_apel_us1 or $seg_apel_us2) and  $direccion_us1 and $muni_us1 and $codep_us1)
		{
			$isql = "select sgd_dir_tipo NUM
					from sgd_dir_drecciones
					where
						sgd_dir_tipo like '7%' and sgd_anex_codigo='$codigo'
						order by sgd_dir_tipo desc";
			$rs=$db->conn->Execute($isql);
			if (!$rs->EOF)	$num_anexos = substr($rs->fields["NUM"],1,2);
			if(!$nurad) $nurad = $numrad;
			include "$ruta_raiz/radicacion/grb_direcciones.php";
			echo "<font size=1>Ha sido agregado el destinatario.</font>";
		}
		else
		{
			echo "<font size=1>No se pudo guardar el documento, ya que faltan datos.(Los datos m&iacute;nimos de envio so Nombre, direccion, departamento, municipio)";
		}
	}
?>
		</td>
	</tr>
	<tr class='<?=$grilla ?>'>
<?php
	if($borrar) {
	    $isql = "delete from sgd_dir_drecciones
		         where sgd_anex_codigo='$codigo' and sgd_dir_tipo = $borrar ";
		$rs=$db->conn->Execute($isql);
	}
	
	include_once "$ruta_raiz/include/query/queryNuevo_archivo.php";
	$isql = $query1;
	
	$rs=$db->conn->Execute($isql);
	// $i_copias  Indica cuantas copias se han anadido
	$i_copias = 0;
	while($rs && !$rs->EOF) {
		$i_copias++;
		$sgd_ciu_codigo = '';
    $sgd_esp_codi = '';
    $sgd_oem_codi = '';
		$sgd_ciu_codi = $rs->fields["SGD_CIU_CODIGO"];
		$sgd_esp_codi = $rs->fields["SGD_ESP_CODI"];
		$sgd_oem_codi = $rs->fields["SGD_OEM_CODIGO"];
		$sgd_dir_tipo = $rs->fields["SGD_DIR_TIPO"];
		$sgd_doc_fun = $rs->fields["SGD_DOC_FUN"];
	
		if($sgd_ciu_codi>0) {
			$isql = "select SGD_CIU_NOMBRE AS NOMBRE,SGD_CIU_APELL1 AS APELL1,SGD_CIU_APELL2 AS APELL2,SGD_CIU_CEDULA AS IDENTIFICADOR,SGD_CIU_EMAIL AS MAIL,SGD_CIU_DIRECCION  AS DIRECCION from sgd_ciu_ciudadano where sgd_ciu_codigo=$sgd_ciu_codi";
		}
		if($sgd_esp_codi>0)
		{
			$isql = "select nombre_de_la_empresa AS NOMBRE, identificador_empresa AS IDENTIFICADOR,EMAIL AS MAIL,DIRECCION AS DIRECCION from bodega_empresas where identificador_empresa=$sgd_esp_codi";
		}
		if($sgd_oem_codi>0)
		{
			$isql = "select sgd_oem_oempresa AS NOMBRE, SGD_OEM_DIRECCION AS DIRECCION, sgd_oem_codigo AS IDENTIFICADOR from sgd_oem_oempresas  where sgd_oem_codigo=$sgd_oem_codi";
		}
if($sgd_doc_fun>0)
{
 $isql = "select usua_nomb AS NOMBRE,
                  d.depe_nomb AS DIRECCION,
                  usua_doc AS IDENTIFICADOR,
                  usua_email AS MAIL
            from usuario u,
                  dependencia d
            where usua_doc='$sgd_doc_fun' and
                  u.DEPE_CODI = d.DEPE_CODI ";
}
	
$rs2=$db->conn->Execute($isql);
$nombre_otros = "";
if($rs2 && !$rs2->EOF)
$nombre_otros =$rs2->fields["NOMBRE"]."".$rs2->fields["APELL1"]." ".$rs2->fields["APELL2"];
?>
		<TD align="center" class="listado2"> <font size=1>
			<?=$rs2->fields["IDENTIFICADOR"];?> </font>
		</TD>
		<TD align="center" class="listado2" colspan="1">&nbsp;<font size=1>
			<?=$nombre_otros?> </font>
		</TD>
		<TD align="center" class="listado2" colspan="1">&nbsp;<font size=1>
			<?=$rs->fields["SGD_DIR_NOMBRE"];?>
			&nbsp;</font></TD>
		<TD align="center" class="listado2">&nbsp; <font size=1>
			<?=$rs2->fields["DIRECCION"];?> </font>
		</TD>
		<TD width="68" align="center" class="listado2">&nbsp; <font size=1>
			<?=$rs2->fields["MAIL"];?></font>
		</TD>
		<TD width="68" align="center" class="listado2">&nbsp; <font size=1>
			<a href='nuevo_archivo.php?<?=$variables?>&borrar=<?=$sgd_dir_tipo?>&tpradic=<?=$tpradic?>&aplinteg=<?=$aplinteg?>'>Borrar</a> </font> </TD>
	</tr>
<?php
		$rs->MoveNext();
	}
?>
	</table>
</font></td>
</tr>
<?php
}
?>
<tr>
	<td class='celdaGris' align="center" colspan="2">&nbsp;</td>
</tr>
</table>
</div>
<table width="100%"  border="0" class="borde_tab">
<tr align="center">
	<td width="20%" class="listado1">
		<input type="hidden" name="MAX_FILE_SIZE" value="50000000">Adjuntar Archivo
	</td>
	<td>
		<input name="userfile1" type="file" class="tex_area" onChange="escogio_archivo();" id="userfile" value="valor">
	</td>
	</tr>
	<tr>
		<td colspan="2" align="center">
		<input name="button" type="button" class="botones_largo" onClick="actualizar()" value="ACTUALIZAR <?=$codigo?>">
<?php
	if($radicado_rem==7 and $i_copias==0)
	{ ?>
		 <?=$mensaje?> 
			<b><span  class='alarmas' >No puede generar envio, No se ha anexado destinatario </span></b>
		<?
	}
	else
	{?>
		<?=$mensaje?>
		<input type='button' class ='botones' value='cerrar' onclick='f_close()'> 
	 <?
	}
?>
	</td>
</tr>
</table>
<input type=hidden name=i_copias value='<?=$i_copias?>' id="i_copias" >
</form>
</td>
</tr>
</table>
</body>
</html>
