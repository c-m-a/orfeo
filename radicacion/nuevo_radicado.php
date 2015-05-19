<?php
session_start();

foreach ($_GET as $key => $valor)
  ${$key} = $valor;
foreach ($_POST as $key => $valor)
  ${$key} = $valor;

$krd          = $_SESSION["krd"];
$dependencia  = $_SESSION["dependencia"];
$usua_doc     = $_SESSION["usua_doc"];
$codusuario   = $_SESSION["codusuario"];
$tpNumRad     = $_SESSION["tpNumRad"];
$tpPerRad     = $_SESSION["tpPerRad"];
$tpDescRad    = $_SESSION["tpDescRad"];
$tip3Nombre   = $_SESSION["tip3Nombre"];
$tip3img      = $_SESSION["tip3img"];
$tpDepeRad    = $_SESSION["tpDepeRad"];
$tip3desc     = $_SESSION["tip3desc"];
$tip3img      = $_SESSION["tip3img"];
$ruta_raiz    = '..';

$tipoMedio = (isset($_SESSION['tipoMedio']))? $_SESSION['tipoMedio'] : null;

if($tipoMedio=="eMail") {
	if(!$asu) { 
	 $body =$msg->getBody($_GET['eMailMid'], $_GET['eMailPid']);
	 $msg->getHeaders($eMailMid);
		$asu = $msg->header[$eMailMid]['subject'];
    $mail_us1= $msg->header[$eMailMid]['from_personal'][0]." <".$msg->header[$eMailMid]['from'][0].">";
	}
	}
$ruta_raiz = "..";
include_once "../include/db/ConnectionHandler.php";
include_once "../class_control/AplIntegrada.php";
$db = new ConnectionHandler("$ruta_raiz");
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
include "crea_combos_universales.php";
$objApl = new AplIntegrada($db);
$nurad = (isset($nurad))? $nurad : null;

if($nurad) {
	$nurad=trim($nurad);
	$ent = substr($nurad,-1);
}

$no_tipo  = "true";
$imgTp1   = str_replace(".jpg", "",$tip3img[1][$ent]);
$imgTp2   = str_replace(".jpg", "",$tip3img[2][$ent]);
$imgTp3   = str_replace(".jpg", "",$tip3img[3][$ent]);
$descTp1  = "alt='".$tip3desc[1][$ent]."' title='".$tip3desc[1][$ent]."'";
$descTp2  = "alt='".$tip3desc[2][$ent]."' title='".$tip3desc[2][$ent]."'";
$descTp3  = "alt='".$tip3desc[3][$ent]."' title='".$tip3desc[3][$ent]."'";
$nombreTp1 = $tip3Nombre[1][$ent];
$nombreTp2 = $tip3Nombre[2][$ent];
$nombreTp3 = $tip3Nombre[3][$ent];
?>
<html>
<head>
<title>.:: Orfeo Modulo de Radicaci&acuoteo;n::.</title>
<base href="<?=ORFEO_URL?>">
<meta http-equiv="expires" content="99999999999">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="estilos/tabber.css" TYPE="text/css" MEDIA="screen">
<link rel="stylesheet" href="estilos/orfeo.css" type="text/css">
<script Language="JavaScript" src="js/crea_combos_2.js"></script>
<script type="text/javascript" src="js/tabber.js"></script>
<script language="JavaScript">
document.write('<style type="text/css">.tabber{display:none;}<\/style>');
<?
// Convertimos los vectores de los paises, dptos y municipios creados en crea_combos_universales.php a vectores en JavaScript.
echo arrayToJsArray($vpaisesv, 'vp');
echo arrayToJsArray($vdptosv, 'vd');
echo arrayToJsArray($vmcposv, 'vm');
?>

function cambIntgAp(valor){
	fecha_hoy =  '<?=date('d')."-".date('m')."-".date('Y')?>';

	if (valor!=0){
		if  (document.formulario.fecha_gen_doc.value.length==0)
			document.formulario.fecha_gen_doc.value=fecha_hoy;
	} else
		document.formulario.fecha_gen_doc.value="";

}

function fechf(formulario,n)
{
  var fechaActual = new Date();
	fecha_doc = document.formulario.fecha_gen_doc.value;
	dias_doc=fecha_doc.substring(0,2);
	mes_doc=fecha_doc.substring(3,5);
	ano_doc=fecha_doc.substring(6,10);
	var fecha = new Date(ano_doc,mes_doc-1, dias_doc);
  var tiempoRestante = fechaActual.getTime() - fecha.getTime();
  var dias = Math.floor(tiempoRestante / (1000 * 60 * 60 * 24));
  
  if (dias >60 && dias < 1500) {
    alert("El documento tiene fecha anterior a 60 dias!!");
	} else {
 	  if (dias > 1500) {
      sftp://jlosada@172.16.0.168/home/orfeodev/jlosada/public_html/orfeointer/radicacion/NEW.php
      alert("Verifique la fecha del documento!!");
		  fecha_doc = "";
		} else {
				fecha_doc = "ok";
				if (dias < 0) {
          alert("Verifique la fecha del documento !!, es Una fecha Superior a la Del dia de Hoy");
          fecha_doc = "asdfa";
				}
			}
		}
	return fecha_doc;
}

function radicar_doc() {
  if(fechf ("formulario",16)=="ok") {
		if (
			document.formulario.documento_us1.value != 0 &&
			document.formulario.muni_us1.value != 0 &&
			document.formulario.direccion_us1.value != 0 &&
			document.formulario.coddepe.value != 0) 
  		{
			   document.formulario.submit();
		}
	 else
	 	{	
		alert("El tipo de Documento, Remitente/Destinatario, Direccion y Dependencia son obligatorios ");	}
	 }
}

function modificar_doc() {
  if (document.formulario.documento_us1.value) {
       document.formulario.submit();
	} else {
	  alert("Remitente/Destinatario son obligatorios ");
	}
}

function pestanas(pestana) {
<?php
   if($ent==1) $ver_pestana=""; else $ver_pestana="";
?>
	document.getElementById('remitente').style.display = "";
  document.getElementById('predio').style.display = "<?=$ver_pestana?>";
  document.getElementById('empresa').style.display = "<?=$ver_pestana?>";
  
  if(pestana==1) {
   document.getElementById('pes1').style.display = "";
  } else {
    document.getElementById('pes1').style.display = "none";
  }
  
  if(pestana==2) {
    document.getElementById('pes2').style.display = "";
  } else {
    document.getElementById('pes2').style.display = "none";
  }
  
  if(pestana==3) {
    document.getElementById('pes3').style.display = "";
  } else {
    document.getElementById('pes3').style.display = "none";
  }
}

function pb1() {
  dato1 = document.forma.no_documento.value;
}

function Start(URL, WIDTH, HEIGHT) {
  windowprops = "top=0,left=0,location=no,status=no, menubar=no,scrollbars=yes, resizable=yes,width=1100,height=550";
  preview = window.open(URL , "preview", windowprops);
}

function doPopup() {
  url = "popup.htm";
  width = 800; // ancho en pixels
  height = 320; // alto en pixels
  delay = 2; // tiempo de delay en segundos
  timer = setTimeout("Start(url, width, height)", delay*1000);
}

function buscar_usuario() {
   document.write('<form target="Buscar_Usuario" name="formb" action="/radicacion/buscar_usuario.php?envio_salida=true&ent=<?=$ent?>" method="POST">');
   document.write("<input type='hidden' name=no_documento value='" + documento +"'>");
   document.write("</form> ");
}

function regresar() {
  i=1;
}
</script>
</head>
<body bgcolor="#FFFFFF">
   <div id="spiffycalendar" class="text"></div>
   <link rel="stylesheet" type="text/css" href="js/spiffyCal/spiffyCal_v2_1.css">
 <script language="JavaScript" src="js/spiffyCal/spiffyCal_v2_1.js"></script>
<link rel="stylesheet" href="estilos/tabber.css" TYPE="text/css" MEDIA="screen">
<script type="text/javascript" src="js/tabber.js"></script>
<?php
  $ddate = date('d');
  $mdate = date('m');
  $adate = date('Y');
  $nurad = trim($nurad);
  $hora = date('H:i:s');
  $fechaf = $ddate . $mdate . $adate . $hora;
  
  // aqui se busca el radicado para editar si viene la variable $Buscar
  if(isset($Buscar)) {
		$docDia = $db->conn->SQLDate('d','a.RADI_FECH_OFIC');
		$docMes = $db->conn->SQLDate('m','a.RADI_FECH_OFIC');
		$docAno = $db->conn->SQLDate('Y','a.RADI_FECH_OFIC');
		$fRad = $db->conn->SQLDate('Y-m-d','a.RADI_FECH_RADI');
		
    if (!$nurad || strlen(trim($nurad))==0)
			$nurad="NULL";
		
    $query = "select a.*
							,$docDia AS DOCDIA
							,$docMes AS DOCMES
							,$docAno AS DOCANO
							,a.EESP_CODI
							,a.RA_ASUN
							,$fRad AS FECHA_RADICADO
						from radicado a
						where a.radi_nume_radi=$nurad";
	$rs = $db->conn->query($query);
	$varQuery = $query;
  $busqueda = $nurad;
	
  if(!$rs->EOF and is_numeric($busqueda)) {
			if($cursor)
				$Submit4 = "Modificar";
			
			$asu      = $rs->fields["RA_ASUN"];
			$tip_doc  = $rs->fields["TDID_CODI"];
			$radicadopadre = $rs->fields["RADI_NUME_DERI"];
			$ane      = $rs->fields["RADI_DESC_ANEX"];
			$codep    = $rs->fields["DEPTO_CODI"];
			$pais     = $rs->fields["RADI_PAIS"];
			$carp_codi = $rs->fields["CARP_CODI"];
			$cuentai  = $rs->fields["RADI_CUENTAI"];
			$carp_per = $rs->fields["CARP_PER"];
			$depende  = $rs->fields["RADI_DEPE_ACTU"];
			$tip_rem  = $rs->fields["TRTE_CODI"]+1;
			$tdoc     = $rs->fields["TDOC_CODI"];
			$med      = $rs->fields["MREC_CODI"];
			$cod      = $rs->fields["MUNI_CODI"];
			$coddepe  = $rs->fields["RADI_DEPE_ACTU"];
			$codusuarioActu = $rs->fields["RADI_USUA_RADI"];
			$coddepe  = $rs->fields["RADI_DEPE_ACTU"];
			$fechproc12 = $rs->fields["DOCDIA"];
			$fechproc22 = $rs->fields["DOCMES"];
			$fechproc32 = $rs->fields["DOCANO"];
			$fechaRadicacion = $rs->fields["FECHA_RADICADO"];
			$espcodi    = $rs->fields["EESP_CODI"];
			$fecha_gen_doc = "$fechproc12/$fechproc22/$fechproc32";
			include "busca_direcciones.php";
		} else {
			echo "<p><center><table width='90%' class=borde_tab celspacing=5><tr><td class=titulosError><center>No se han encontrado registros con numero de radicado <font color=blue>$nurad</font> <br>Revise el radicado escrito, solo pueden ser Numeros de 14 digitos <br><p><hr><a href='edtradicado.php?fechaf=$fechaf&krd=$krd&drde=$drde'><font color=red>Intente de Nuevo</a></center></td></tr></table></center>";
			if(!$rsJHLC) die("<hr>");
	 }
	}
	
  // Fin de Busqueda del Radicado para editar

  echo '<script language="javascript">';

  if(empty($fecha_gen_doc) || $fecha_gen_doc == '//') {
    $fecha_busq = date("d-m-Y");
    $fecha_gen_doc = $fecha_busq;
  }
?>
   var dateAvailable1 = new ctlSpiffyCalendarBox("dateAvailable1", "formulario", "fecha_gen_doc","btnDate1","<?=$fecha_gen_doc?>",scBTNMODE_CUSTOMBLUE);
  </script>
<?php

	if($rad1 || $rad0 || $rad2) {
    if(isset($rad1)) $tpRadicado = "1";
    if(isset($rad2)) $tpRadicado = "2";
    if(isset($rad0)) $tpRadicado = "0";
    
    echo "<input type='hidden' name='tpRadicado' value='$tpRadicado'>";
    
    $docDia = $db->conn->SQLDate('D','a.RADI_FECH_OFIC');
    $docMes = $db->conn->SQLDate('M','a.RADI_FECH_OFIC');
    $docAno = $db->conn->SQLDate('Y','a.RADI_FECH_OFIC');
    
    if (empty($radicadopadre) || strlen(trim($radicadopadre))==0)
        $radicadopadre="NULL";
    
    $query = "select a.*
							,$docDia AS DOCDIA
							,$docMes AS DOCMES
							,$docAno AS DOCANO
							,a.EESP_CODI from radicado a
						where a.radi_nume_radi=$radicadopadre";
    $varQuery = $query;
    $ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
    $rs=$db->conn->query($query);
	
    if(!$rs->EOF)
      echo "<!-- No hay datos: $query -->";

    if(empty($Buscar) && empty($Submit4)) {
      $varQuery = $query;
      $comentarioDev = 'Entro a Anexar un radicado ';
      $cuentaii = $rs->fields["RADI_CUENTAI"];
      
      if($cuentaii)
        $cuentai=$cuentaii;
      
      $pnom   = $rs->fields["RADI_NOMB"];
      $papl   = $rs->fields["RADI_PRIM_APEL"];
      $sapl   = $rs->fields["RADI_SEGU_APEL"];
      $numdoc = $rs->fields["RADI_NUME_IDEN"];
      $asu    = $rs->fields["RA_ASUN"];
      $tel    = $rs->fields["RADI_TELE_CONT"];
      $rem2   = $rs->fields["RADI_REM"];
      $adress = $rs->fields["RADI_DIRE_CORR"];
    }

    $depende  = $rs->fields["RADI_DEPE_ACTU"];
    $radi_usua_actu_padre = $rs->fields["RADI_USUA_ACTU"];
    $radi_depe_actu_padre = $rs->fields["RADI_DEPE_ACTU"];
    $tip_doc  = $rs->fields["TDID_CODI"];
    $ane      = $rs->fields["RADI_DESC_ANEX"];
    $cod      = $rs->fields["MUNI_CODI"];
    $codep    = $rs->fields["DPTO_CODI"];
    $pais     = $rs->fields["RADI_PAIS"];
    $espcodi  = $rs->fields["EESP_CODI"];
    
    if(isset($noradicar2)) {
			$fecha_gen_doc = $rs->fields["DOCDIA"] ."-".$rs->fields["DOCMES"] ."-".$rs->fields["DOCANO"];
			$fechproc12=$rs->fields["DOCDIA"];
			$fechproc22=$rs->fields["DOCMES"];
			$fechproc32=$rs->fields["DOCANO"];
		}
    $ruta_raiz = '..';
    $no_tipo = true;
    include ('./busca_direcciones.php');
	}
	
  if (isset($rad1)) {
	  $encabezado = "<center><b>Copia de datos del Radicado  $radicadopadre ";
	  $tipoanexo = "1";
	}

	if (isset($rad0)) {
	  $encabezado = "<center><b>Anexo de $radicadopadre ";
	  $tipoanexo = "0";
	  $radicadopadre_exist=1;
	}

	if (isset($rad2)) {
	  $encabezado = "<center><b>Documento Asociado de $radicadopadre ";
	  
    if(empty($Submit4) and empty($Submit3))
      $cuentai = '';

	  $tipoanexo = 2;
 	  $radicadopadre_exist = 1;
	}
	
  if(isset($noradicar1))
	  $radicadopadre_exist = 0;
 ?>
  <script>
function procEst2(formulario,tb) {
	var lista = document.formulario.codep.value;
	i = document.formulario.codep.value;
	if (i != 0) {
		var dropdownObjectPath = document.formulario.tip_doc;
		var wichDropdown = "tip_doc";
		var d=tb;
		var withWhat = document.formulario.codep.value;
		populateOptions2(wichDropdown, withWhat,tb);
	  }
}

function populateOptions2(wichDropdown, withWhat,tbres) {
	r = new Array;
	i=0;
  
  if (withWhat == "2") {
    r[i++]=new Option("NIT", "1");
  }
  
  if (withWhat == "1") {
    document.formulario.submit();
    r[i++]=new Option("NIT","4");
    r[i++]=new Option("NUIR","5");
	}

  if (withWhat == "3") {
		r[i++]=new Option("CC", "0");
		r[i++]=new Option("CE", "2");
		r[i++]=new Option("TI", "1");
		r[i++]=new Option("PASAPORTE", "3");
  }
	
  if (i==0) {
		alert(i + " " + "Error!!!");
	} else{
		dropdownObjectPath = document.formulario.tip_doc;
		eval(document.formulario.tip_doc.length=r.length);
		largestwidth=0;
		for (i=0; i < r.length; i++)
			{
			  eval(document.formulario.tip_doc.options[i]=r[i]);
			  if (r[i].text.length > largestwidth) {
			     largestwidth=r[i].text.length;    }
	        }
		eval(document.formulario.tip_doc.length=r.length);
		//eval(document.myform.cod.options[0].selected=true);
	   }
}

function vnum(formulario,n)
{
	valor = formulario.elements[n].value;
	if (isNaN(valor))
      {
		alert ("Dato incorrecto..");
		formulario.elements[n].value="";
		formulario.elements[n].focus();
		return false;
      }
	else
		return true;
}

function fech(formulario,n) {
  m=n-1;
  s=m-1;
  var f=document.formulario.elements[n].value;
  var meses=parseInt(document.formulario.elements[m].value);
  eval(lona=document.formulario.elements[n].length);
  eval(lonm=document.formulario.elements[m].length);
  eval(lond=document.formulario.elements[s].length);

  if(lona==44 || lonm==44 || lond==44) {
    alert("Fecha incorrecta  debe ser DD/MM/AAAA !!!");
    document.formulario.elements[s].value="";
    document.formulario.elements[m].value="";
    document.formulario.elements[n].value="";
    document.formulario.elements[s].focus();
  } else {
if ((f%4)==0){
if(document.formulario.elements[m].value<13){
switch(meses){
case 12 : if(document.formulario.elements[s].value>31)
{
	alert ("Fecha incorrecta..");
	document.formulario.elements[s].value="";
	document.formulario.elements[m].value="";
	document.formulario.elements[n].value="";
	document.formulario.elements[s].focus();
	return false;
}break;
case 11 : if(document.formulario.elements[s].value>30)
{
	alert ("Fecha incorrecta..");
	document.formulario.elements[s].value="";
	document.formulario.elements[m].value="";
	document.formulario.elements[n].value="";
	document.formulario.elements[s].focus();
	return false;
}break;
case 10 : if(document.formulario.elements[s].value>31)
{
	alert ("Fecha incorrecta..");
	document.formulario.elements[s].value="";
	document.formulario.elements[m].value="";
	document.formulario.elements[n].value="";
	document.formulario.elements[s].focus();
	return false;
}break;
case 9 : if(document.formulario.elements[s].value>30)
{
	alert ("Fecha incorrecta..");
	document.formulario.elements[s].value="";
	document.formulario.elements[m].value="";
	document.formulario.elements[n].value="";
	document.formulario.elements[s].focus();
	return false;
}break;
case 8 : if(document.formulario.elements[s].value>31)
{
	alert ("Fecha incorrecta..");
	document.formulario.elements[s].value="";
	document.formulario.elements[m].value="";
	document.formulario.elements[n].value="";
	document.formulario.elements[s].focus();
	return false;
}break;
case 7 : if(document.formulario.elements[s].value>31)
{
	alert ("Fecha incorrecta..");
	document.formulario.elements[s].value="";
	document.formulario.elements[m].value="";
	document.formulario.elements[n].value="";
	document.formulario.elements[s].focus();
	return false;
}break;
case 6 : if(document.formulario.elements[s].value>30)
{
	alert ("Fecha incorrecta..");
	document.formulario.elements[s].value="";
	document.formulario.elements[m].value="";
	document.formulario.elements[n].value="";
	document.formulario.elements[s].focus();
	return false;
}break;
case 5 : if(document.formulario.elements[s].value>31)
{
	alert ("Fecha incorrecta..");
	document.formulario.elements[s].value="";
	document.formulario.elements[m].value="";
	document.formulario.elements[n].value="";
	document.formulario.elements[s].focus();
	return false;
}break;
case 4 : if(document.formulario.elements[s].value>30)
{
	alert ("Fecha incorrecta..");
	document.formulario.elements[s].value="";
	document.formulario.elements[m].value="";
	document.formulario.elements[n].value="";
	document.formulario.elements[s].focus();
	return false;
}break;
case 3 : if(document.formulario.elements[s].value>31)
{
	alert ("Fecha incorrecta..");
	document.formulario.elements[s].value="";
	document.formulario.elements[m].value="";
	document.formulario.elements[n].value="";
	document.formulario.elements[s].focus();
	return false;
}break;
case 2 : if(document.formulario.elements[s].value>29)
{
	alert ("Fecha incorrecta..");
	document.formulario.elements[s].value="";
	document.formulario.elements[m].value="";
	document.formulario.elements[n].value="";
	document.formulario.elements[s].focus();
	return false;
}break;
case 1 : if(document.formulario.elements[s].value>31)
{
	alert ("Fecha incorrecta..");
	document.formulario.elements[s].value="";
	document.formulario.elements[m].value="";
	document.formulario.elements[n].value="";
	document.formulario.elements[s].focus();
	return false;
}break;
}
}
else {alert("Fecha mes inexistente!!");
	document.formulario.elements[s].value="";
	document.formulario.elements[m].value="";
	document.formulario.elements[n].value="";
	document.formulario.elements[s].focus();
}
}
else {
if(document.formulario.elements[m].value<13){
switch(meses){
case 12 : if(document.formulario.elements[s].value>31)
				{
	alert ("Fecha incorrecta..");
	document.formulario.elements[s].value="";
	document.formulario.elements[m].value="";
	document.formulario.elements[n].value="";
	document.formulario.elements[s].focus();
	return false;
	}break;
case 11 : if(document.formulario.elements[s].value>30)
{
	alert ("Fecha incorrecta..");
	document.formulario.elements[s].value="";
	document.formulario.elements[m].value="";
	document.formulario.elements[n].value="";
	document.formulario.elements[s].focus();
	return false;
}break;
case 10 : if(document.formulario.elements[s].value>31)
{
alert ("Fecha incorrecta..");
document.formulario.elements[s].value="";
document.formulario.elements[m].value="";
document.formulario.elements[n].value="";
document.formulario.elements[s].focus();
return false;
}break;
case 9 : if(document.formulario.elements[s].value>30)
{
	alert ("Fecha incorrecta..");
	document.formulario.elements[s].value="";
	document.formulario.elements[m].value="";
	document.formulario.elements[n].value="";
	document.formulario.elements[s].focus();
			return false;
}break;
case 8 : if(document.formulario.elements[s].value>31)
{
	alert ("Fecha incorrecta..");
	document.formulario.elements[s].value="";
	document.formulario.elements[m].value="";
	document.formulario.elements[n].value="";
	document.formulario.elements[s].focus();
	return false;
}break;
case 7 : if(document.formulario.elements[s].value>31)
{
	alert ("Fecha incorrecta..");
	document.formulario.elements[s].value="";
	document.formulario.elements[m].value="";
	document.formulario.elements[n].value="";
	document.formulario.elements[s].focus();
	return false;
}break;
case 6 : if(document.formulario.elements[s].value>30)

{
	alert ("Fecha incorrecta..");
	document.formulario.elements[s].value="";
	document.formulario.elements[m].value="";
	document.formulario.elements[n].value="";
	document.formulario.elements[s].focus();
	return false;
}break;
case 5 : if(document.formulario.elements[s].value>31)
{
	alert ("Fecha incorrecta..");
	document.formulario.elements[s].value="";
	document.formulario.elements[m].value="";
	document.formulario.elements[n].value="";
	document.formulario.elements[s].focus();
	return false;
}break;
case 4 : if(document.formulario.elements[s].value>30)
{
	alert ("Fecha incorrecta..");
	document.formulario.elements[s].value="";
	document.formulario.elements[m].value="";
	document.formulario.elements[n].value="";
	document.formulario.elements[s].focus();
	return false;
}break;
case 3 : if(document.formulario.elements[s].value>31)
{
	alert ("Fecha incorrecta..");
	document.formulario.elements[s].value="";
	document.formulario.elements[m].value="";
	document.formulario.elements[n].value="";
	document.formulario.elements[s].focus();
	return false;
}break;
case 2 : if(document.formulario.elements[s].value>28)
{
	alert ("Fecha incorrecta..");
	document.formulario.elements[s].value="";
	document.formulario.elements[m].value="";
	document.formulario.elements[n].value="";
	document.formulario.elements[s].focus();
	return false;
}break;
case 1 : if(document.formulario.elements[s].value>31)
{
	alert ("Fecha incorrecta..");
	document.formulario.elements[s].value="";
	document.formulario.elements[m].value="";
	document.formulario.elements[n].value="";
	document.formulario.elements[s].focus();
	return false;
}break;
}
}
	else {
	alert("Fecha mes inexistente!!");
	document.formulario.elements[s].value="";
	document.formulario.elements[m].value="";
	document.formulario.elements[n].value="";
	document.formulario.elements[s].focus();
	}
	}
}
}
var contadorVentanas=0
</script>
<?php
  if (isset($Buscar1)) {
	  include "busca_direcciones.php";
  }
  
  $enviar_carp_per = (isset($carp_per))? 
                      '&carp_per=' . $carp_per :
                      null;
  
  $enviar_carp_codi = (isset($carp_codi))? 
                      '&carp_codi=' . $carp_codi :
                      null;

  $enviar_coddepe = (isset($coddepe))? 
                      '&coddepe=' . $coddepe :
                      null;
  
  $var_envio = session_name() . '=' . trim(session_id()) .
                '&ent=' . $ent .
                $enviar_carp_per .
                $enviar_carp_codi .
                '&rad=' . $nurad .
                $enviar_coddepe .
                '&depende=' . $depende;
?>

<form action='radicacion/nuevo_radicado.php?<?=$var_envio?>'  method="post" name="formulario" id="formulario" class="borde_tab">
<?php 
  if (isset($radicadopadre))
    echo '<input type="hidden" name="radicadopadre" value="' . $radicadopadre . '">';

  if (isset($tipoanexo))
    echo '<input type="hidden" name="tipoanexo" value="' . $tipoanexo . '">';
  
  if (isset($noradicar))
    echo '<input type="hidden" name="noradicar" value="' . $noradicar . '">';
  
  if (isset($noradicar1))
    echo '<input type="hidden" name="noradicar1" value="' . $noradicar1 . '">';
  
  if (isset($noradicar))
    echo '<input type="hidden" name="noradicar2" value="' . $noradicar2 . '">';
  
  if (isset($rad0))
    echo '<input type="hidden" name="atrasRad0" value="' . $rad0 . '">';
  
  if (isset($rad1))
    echo '<input type="hidden" name="atrasRad1" value="' . $rad1 . '">';
  
  if (isset($rad2))
    echo '<input type="hidden" name="atrasRad2" value="' . $rad2 . '">';
  
  if (isset($faxPath))
    echo '<input type="hidden" name="faxPath" value="' . $faxPath . '">';
  
  if(isset($tpRadicado))
    echo '<input type="hidden" name="tpRadicado" value="' . $tpRadicado . '">';
  
  $enviar_rad0 = (isset($atrasRad0))? '&rad0=' . $atrasRad0 : null;
  $enviar_rad1 = (isset($atrasRad1))? '&rad1=' . $atrasRad1 : null;
  $enviar_rad2 = (isset($atrasRad2))? '&rad2=' . $atrasRad2 : null;
  
  $enviar_noradicar = (isset($noradicar))? '&noradicar=' . $noradicar : null;
  $enviar_noradicar1 = (isset($noradicar1))? '&noradicar1=' . $noradicar1 : null;
  $enviar_noradicar2 = (isset($noradicar2))? '&noradicar2=' . $noradicar2 : null;

  $enlace_nuevo_radicado = 'radicacion/nuevo_radicado.php?' .
                            session_name() . '=' . session_id() .
                            '&rad2=Asociado' .
                            '&krd=' . $krd .
                            '&ent=' . $ent .
                            $enviar_rad0 .
                            $enviar_rad1 .
                            $enviar_rad2 .
                            '&radicadopadre=' . $radicadopadre .
                            $enviar_noradicar .
                            $enviar_noradicar1 .
                            $enviar_noradicar2;
?>
<table width="99%"  border="0" align="center" cellpadding="1" cellspacing="1" class="borde_tab">
<tr>
	<td width="6" class="titulos2">
    <a href="<?=$enlace_nuevo_radicado?>">Atras</a></td>
    <td width="94%" align="center"  valign="middle" class="titulos2"><b>
<?php
  $query = "select SGD_TRAD_CODIGO,
                    SGD_TRAD_DESCR
              from sgd_trad_tiporad
              where SGD_TRAD_CODIGO = $ent";

  $ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
  $rs = $db->conn->query($query);
  $tRadicacionDesc = $rs->fields["SGD_TRAD_DESCR"];
?>
      MODULO DE RADICACION
      <?=$tRadicacionDesc?>
      (Dep
      <?=$dependencia ?>
      ->
      <?=$tpDepeRad[$ent]?>
      )</b>
        <?php if($nurad)
		{
			echo "<b>Rad No" . $nurad;
			$ent = substr($nurad,-1);
		}
	?>
        <br>
        <?=$encabezado ?>
	</td>
</tr>
</table>
<table  width=99% border="0" align="center" cellspacing="1" cellpadding="1" class="borde_tab" >
	<tr valign="middle">
		<td class="titulos5" width="15%" align="right">
			<font color="" face="Arial, Helvetica, sans-serif">
			<span class="titulos5">Fecha: dd/mm/aaaa</span></font>
		</td>
		<td class="listado5" width="15%"><font color="" face="Arial, Helvetica, sans-serif">
			<input name="fechproc1" type="text"  readonly="true" id="fechproc13" size="2" maxlength="2" value="<?php echo $ddate;?>" class="tex_area">/
			<input name="fechproc2" type="text"  readonly="true" id="fechproc23" size="2" maxlength="2" value="<?php echo $mdate;?>" class="tex_area">/
			<input name="fechproc3" readonly="true" type="text" id="fechproc33" size="4" maxlength="4" value="<?php echo $adate;?>" class="tex_area">
			</font>
	</td>
		<td width="15%" class="titulos5" align="right"><font color="" face="Arial, Helvetica, sans-serif" class="titulos5">Fecha Doc. dd/mm/aaaa </font>
	</td>
		<td width="15%" class="listado5"><font color="" face="Arial, Helvetica, sans-serif">
			<script language="javascript">
				dateAvailable1.date = "<?=date('Y-m-d');?>";
				dateAvailable1.writeControl();
				dateAvailable1.dateFormat="dd-MM-yyyy";
			</script>
			</font> <font color="" face="Arial, Helvetica, sans-serif">&nbsp;</font>
		</td>
		<td width="15%" class="titulos5" align="right">Cuenta Interna, Oficio, Referencia</td>
		<td width="15%" class="listado5">
			<font face="Arial, Helvetica, sans-serif">
			  <input name="cuentai" type="text"  maxlength="20" class="tex_area" value='<?=(isset($cuentai))? $cuentai : null?>'>
			</font>
	</td>
	</tr>
</table>
<table width="600" border="0" cellspacing="0" cellpadding="0">
	<tr>
	<td height="0">
    <input name="VERIFICAR" type='hidden' class="ebuttons2" value="Verifique Radicaci&oacute;n">
	</td>
	</tr>
</table>
  
<table width="99%" align="center" border="0" cellspacing="0" cellpadding="0">
	<tr valign="bottom">
		<td height="10">
		<table width="99%" align="center" border="0" cellspacing="0" cellpadding="0">
		<tr>
		<?php
      $img_remitente = ($ent!=2)? 'destinatario' : 'remitente';
		?>
	<td width="523"  valign="bottom" >
	</td>
		<?
		if($ent!=2) $busq_salida="true"; else  $busq_salida=""; ?>
		</tr>
		</table>
		</td>
	</tr>
	<tr valign="top">
	<td class="titulos5">
<div class="tabber" id="tab1" border="1">
	<?php
	for($i=1;$i<=3;$i++) {
    if($i==1) {
      $nombre_us1 = (isset($nombre_us1))? $nombre_us1 : null;
      $prim_apel_us1 = (isset($prim_apel_us1))? $prim_apel_us1 : null;
      $seg_apel_us1 = (isset($seg_apel_us1))? $seg_apel_us1 : null;
      
      $nombre     = $nombre_us1;
      $documento  = $documento_us1;
      $papel      = (isset($prim_apel_us1))? $prim_apel_us1 : null;
      $grbNombresUs1 = trim($nombre_us1) . ' ' .
                        trim($prim_apel_us1) . ' ' .
                        trim($seg_apel_us1);
      $sapel      = (isset($seg_apel_us1))? $seg_apel_us1 : null;
      $tel        = (isset($telefono_us1))? $telefono_us1 : null;
      $dir        = (isset($direccion_us1))? $direccion_us1 : null;
      $mail       = (isset($mail_us1))? $mail_us1 : null;
      $muni       = (isset($muni_us1))? $muni_us1 : null;
      $codep      = (isset($codep_us1))? $codep_us1 : null;
      $idp        = (isset($idpais1))? $idpais1 : null;
      $idc        = (isset($idcont1))? $idcont1 : null;
      $tipo       = (isset($tipo_emp_us1))? $tipo_emp_us1 : null;
      $cc_documento = (isset($cc_documento_us1))? $cc_documento_us1 : null;
      $otro       = (isset($otro_us1))? $otro_us1 : null;
    }

    if($i==2) {
      $nombre_us2 = (isset($nombre_us2))? $nombre_us2 : null;
      $prim_apel_us2 = (isset($prim_apel_us2))? $prim_apel_us2 : null;
      $seg_apel_us2 = (isset($seg_apel_us2))? $seg_apel_us2 : null;

      $nombre     = $nombre_us2;
      $papel      = $prim_apel_us2;
      $sapel      = $seg_apel_us2;
      $documento  = (isset($documento_us2))? $documento_us2 : null;
      $cc_documento = (isset($cc_documento_us2))? $cc_documento_us2 : null;
      $grbNombresUs2 = trim($nombre_us2) . " " . trim($prim_apel_us2) . " ". trim($seg_apel_us2);
      $tel        = (isset($telefono_us2))? $telefono_us2 : null;
      $dir        = (isset($direccion_us2))? $direccion_us2 : null;
      $mail       = (isset($mail_us2))? $mail_us2 : null;
      $muni       = (isset($muni_us2))? $muni_us2 : null;
      $codep      = (isset($codep_us2))? $codep_us2 : null;
      $idp        = (isset($idpais2))? $idpais2 : null;
      $idc        = (isset($idcont2))? $idcont2 : null;
      $tipo       = (isset($tipo_emp_us2))? $tipo_emp_us2 : null;
      $otro       = (isset($otro_us2))? $otro_us2 : null;
    }

    if($i==3) {
      $nombre_us3 = (isset($nombre_us3))? $nombre_us3 : null;
      $prim_apel_us3 = (isset($prim_apel_us3))? $prim_apel_us3 : null;
      $seg_apel_us3 = (isset($seg_apel_us3))? $seg_apel_us3 : null;
      
      $nombre     = $nombre_us3;
      $papel      = $prim_apel_us3;
      $sapel      = $seg_apel_us3;
      $documento  = (isset($documento_us3))? $documento_us3 : null;
      $cc_documento = (isset($cc_documento_us3))? $cc_documento_us3 : null;
      $grbNombresUs3 = trim($nombre_us3) . ' ' .
                        trim($prim_apel_us3) . ' ' .
                        trim($seg_apel_us3);
      $tel        = (isset($telefono_us3))? $telefono_us3 : null;
      $dir        = (isset($direccion_us3))? $direccion_us3 : null;
      $mail       = (isset($mail_us3))? $mail_us3 : null;
      $muni       = (isset($muni_us3))? $muni_us3 : null;
      $codep      = (isset($codep_us3))? $codep_us3 : null;
      $idp        = (isset($idpais3))? $idpais3 : null;
      $idc        = (isset($idcont3))? $idpais3 : null;
      $tipo       = (isset($tipo_emp_us3))? $tipo_emp_us3 : null;
      $otro       = (isset($otro_us3))? $otro_us3 : null;
    }

    if($tipo == 1 or $i == 3) {
      $lbl_nombre = "Raz&oacute;n Social";
      $lbl_apellido = "Sigla";
      $lbl_nombre2 = "Rep. Legal";
    } else {
      $lbl_nombre = "Nombres";
      $lbl_apellido = "Primer Apellido";
      $lbl_nombre2 = "Segundo Apellido";
    }

    $bloqEdicion="";
    
    if ($i==3) {
      $bloqEdicion = "readonly='true'";
    }

    $titulo = $tip3Nombre[$i][$ent];
    
    if(empty($titulo))  $titulo = "?? $i";

    if (empty($cc_documento))
      $cc_documento = null;

    if (empty($documento))
      $documento = null;
?>
<div class="tabbertab" title="<?=$titulo?>">
<table width="100%" name='pes<?=$i?>' id='pes<?=$i?>' class="t_bordeGris" align="center" cellpadding="0" cellspacing="1">
<tr class="listado2">
	<td class="titulos5"  align="right">Documento</td>
	<td bgcolor="#FFFFFF"  class="listado5">
		<input type=text name='cc_documento_us<?=$i?>' value='<?=$cc_documento?>' readonly="true" class="tex_area">
	<input typ=etext name='documento_us<?=$i ?>' value='<?=$documento?>' readonly="true" class="tex_area" size="1">
	</td>
	<td class="titulos5"  align="right"><font face="Arial, Helvetica, sans-serif" class="etextomenu">Tipo</font></td>
	<td width="45%"  bgcolor="#FFFFFF" class="listado5">
<select name="tipo_emp_us<?=$i?>" class="select">
<?php
	if ($i == 1)
    $datos = (isset($tipo_emp_us1) && $tipo_emp_us1 == 0)? ' selected ' : null;
	
  if ($i == 2)
    $datos = (isset($tipo_emp_us2) && $tipo_emp_us2 == 0)? ' selected ' : null;
	
  if ($i == 3)
    $datos = (isset($tipo_emp_us3) && $tipo_emp_us3 == 0)? ' selected ' : null;

  echo '<option value="0" ' . $datos . '>USUARIO</option>';
	
  if ($i==1)
    $datos = (isset($tipo_emp_us1) && $tipo_emp_us1 == 1)? ' selected ' : null;
	
  if ($i==2)
    $datos = (isset($tipo_emp_us2) && $tipo_emp_us2 == 1)? ' selected ' : null;
	
  if ($i==3)
    $datos = (isset($tipo_emp_us3) && $tipo_emp_us3 == 1)? ' selected ' : null;
  
  echo '<option value="1" ' . $datos . '>ENTIDADES</option>';
	
  if ($i==1)
    $datos = (isset($tipo_emp_us1) && $tipo_emp_us1 == 2)? ' selected ' : null;
	
  if ($i==2)
    $datos = (isset($tipo_emp_us2) && $tipo_emp_us2 == 2)? ' selected ' : null;
	
  if ($i==3)
    $datos = (isset($tipo_emp_us3) && $tipo_emp_us3 == 2)? ' selected ' : null;
  
  echo '<option value="2" ' . $datos . '>EMPRESAS</option>';
	
  if ($i==1)
    $datos = (isset($tipo_emp_us1) && $tipo_emp_us1 == 6)? ' selected ' : null;
	
  if ($i==2)
    $datos = (isset($tipo_emp_us2) && $tipo_emp_us2 == 6)? ' selected ' : null;
	
  if ($i==3)
    $datos = (isset($tipo_emp_us3) && $tipo_emp_us3 == 6)? ' selected ' : null;
  
  echo '<option value="6" ' . $datos . '>FUNCIONARIOS</option>';

  $enlace_buscar_usuario = './radicacion/buscar_usuario.php?' .
                            '&nombreTp1=' . $nombreTp1 .
                            '&nombreTp2=' . $nombreTp2 .
                            '&nombreTp3=' . $nombreTp3 .
                            '&busq_salida=' . $busq_salida .
                            '&ent=' . $ent;
?>
   </select>
	</td>
	<td align="right">
	<input type="button" name="Button" value="BUSCAR" class="botones_funcion" onClick="Start('<?=$enlace_buscar_usuario?>',1024,400);" align="right">
	<input type='hidden' name='depende22' value="<?=$depende?>">
	</td>
</tr>
<tr class="e_tablas">
	<td width="13%" class="titulos5" align="right">
    <font face="Arial, Helvetica, sans-serif" class="etextomenu"><?=$lbl_nombre ?></font>
  </td>
	<td width="30%" bgcolor="#FFFFFF" class="listado5">
		<INPUT type=text name='nombre_us<?=$i ?>' value='<?=$nombre ?>'  readonly="true"  class="tex_area" size=40>
		 
	</td>
	<td width="10%" class="titulos5" align="right">
 <font face="Arial, Helvetica, sans-serif" class="etextomenu">
 <?=$lbl_apellido ?></font></td>
	<td colspan="3" bgcolor="#FFFFFF" class="listado5">
<?
if($i==4)
{	$ADODB_COUNTRECS = true;
	$query ="select PAR_SERV_NOMBRE,PAR_SERV_CODIGO FROM PAR_SERV_SERVICIOS order by PAR_SERV_NOMBRE";
	$rs=$db->conn->query($query);
	$numRegs = "! ".$rs->RecordCount();
	$varQuery = $query;
	print $rs->GetMenu2("sector_us$i", "sector_us$i", "0:-- Seleccione --", false,"","onChange='procEst(formulario,18,$i )' class='ecajasfecha'");
	$ADODB_COUNTRECS = false;
	?>
	<select name="sector_us<?=$i ?>" class="select">
<?
while(!$rs->EOF)
{
	  $codigo_sect = $rs->fields["PAR_SERV_CODIGO"];
	  $nombre_sect = $rs->fields["PAR_SERV_NOMBRE"];
	  echo "<option value=$codigo_sect>$nombre_sect</option>";
	$rs->MoveNext();
}
	?>
	</select>
	<?
	}else
	{
	?>
	<INPUT type=text name='prim_apel_us<?=$i ?>' value='<?=$papel ?>' class="tex_area"  readonly="true"  size="35">
	<?
	}
	?>
	</td>
	</tr>
	<tr class=e_tablas>
		<td width="10%" class="titulos5"  align="right"><font face="Arial, Helvetica, sans-serif" class="etextomenu"><?=$lbl_nombre2 ?></font></td>
		<td width="30%" bgcolor="#FFFFFF" class="listado5">
		<input type=text name='seg_apel_us<?=$i ?>' value='<?=$sapel ?>'  readonly="true"  class="tex_area" size=40>
	</td>
  <td width="10%" class="titulos5"  align="right"><font face="Arial, Helvetica, sans-serif" class="etextomenu">Tel&eacute;fono
		</font></td>
		<td  colspan="3" bgcolor="#FFFFFF"  class="listado5">
		<input type=text name='telefono_us<?=$i ?>' value='<?=$tel ?>' <?=$bloqEdicion?> class="tex_area" size=35>
	</td>
</tr>
<tr class=e_tablas>
	<td width="10%" class="titulos5"  align="right"><font face="Arial, Helvetica, sans-serif" class="etextomenu">Direcci&oacute;n
	</font>
	</td>
	<td width="30%" bgcolor="#FFFFFF"  class="listado5">
		<INPUT type=text name='direccion_us<?=$i ?>' value='<?=$dir ?>' <?=$bloqEdicion?> class="tex_area" size=40>
	</td>
	<td width="10%" class="titulos5"  align="right"><font face="Arial, Helvetica, sans-serif" class="etextomenu">Mail
		</font></td>
	<td  colspan="3" bgcolor="#FFFFFF"  class="listado5">
		<INPUT type=text name='mail_us<?=$i ?>' value='<?=$mail ?>' <?=$bloqEdicion?> class="tex_area" size=35>
	</td>
</tr>
<?
	if($i!=3)
	{
?>
<tr class=e_tablas>
	<td width="13%" class="titulos5"  align="right" ><font face="Arial, Helvetica, sans-serif" class="etextomenu">Dignatario</font></td>
	<td bgcolor="#FFFFFF"  class="listado5" colspan="3">
	<input type='text' name='otro_us<?=$i ?>' value="<?php echo htmlspecialchars(stripcslashes($otro)); ?>" class='tex_area' size='40' maxlength='50'>
	</td>
</tr>
<?
	}
?>
<tr class=e_tablas>
	<td width="10%" class="titulos5"  align="right"><font face="Arial" class="etextomenu">Continente</font></td>
	<td width="20%" bgcolor="#FFFFFF"  class="listado5">
<?php
	/*  En este segmento trabajaremos macrosusticion, lo que en el argot php se denomina Variables variables.
	*	El objetivo es evitar realizar codigo con las mismas asignaciones y comparaciones cuya diferencia es el
	*	valor concatenado de una variable + $i.
	*/
	$var_cnt = "idcont".$i;
	$var_pai = "idpais".$i;
	$var_dpt = "codep_us".$i;
	$var_mcp = "muni_us".$i;

	/*	Se crean las variables cuyo contenido es el valor por defecto para cada combo, esto segï¿½n el siguiente orden:
	*	1. Se pregunta si existe idcont1, idcont2 e idcont3 (segï¿½n iteracciï¿½n del ciclo), si es asï¿½ se asigna a $contcodi.
	*	2. Sino existe (osea que no viene de buscar_usuario.php) se pregunta si existe "localidad" y se asigna el
	*	   respectivo codigo; de ser negativa la "localidad", $contcodi toma el valor de 0. Esto para cada
	*	   variable de continente, pais, dpto y mncpio respectivamente.
	*/

  if (isset(${$var_cnt}))
    $contcodi = ${$var_cnt};
  else
    $contcodi = (isset($_SESSION['cod_local']))? substr($_SESSION['cod_local'],0,1) * 1 : 0;
	
  if (isset(${$var_pai}))
    $paiscodi = ${$var_pai};
  else
    $paiscodi = (isset($_SESSION['cod_local']))? substr($_SESSION['cod_local'],2,3) * 1 : 0;
	
  if (isset(${$var_dpt}))
    $deptocodi = ${$var_dpt};
  else
    $deptocodi = (isset($_SESSION['cod_local']))? $paiscodi . '-' . substr($_SESSION['cod_local'],6,3) * 1 : 0;
	
  if (isset(${$var_mcp}))
    $municodi = ${$var_mcp};
  else
    $municodi = (isset($_SESSION['cod_local']))? $deptocodi . '-' . substr($_SESSION['cod_local'],10,3) * 1 : 0;

	//	Visualizamos el combo de continentes.
	echo $Rs_Cont->GetMenu2("idcont$i",
                            $contcodi,
                            "0:<< seleccione >>",
                            false,
                            0,
                            " id=\"idcont$i\" CLASS=\"select\" onchange=\"cambia(this.form, 'idpais$i', 'idcont$i')\" ");
	$Rs_Cont->Move(0);
?>
	</td>
	<td width="10%" class="titulos5"  align="right"><font face="Arial" class="etextomenu">Pa&iacute;s</font></td>
	<td  colspan="3" bgcolor="#FFFFFF"  class="listado5">
<?php
	//	Visualizamos el combo de paises.
	echo "<SELECT NAME=\"idpais$i\" ID=\"idpais$i\" CLASS=\"select\" onchange=\"cambia(this.form, 'codep_us$i', 'idpais$i')\">";
	while (!$Rs_pais->EOF && empty($Submit4)) {
		if (isset($_SESSION['cod_local']) && ($Rs_pais->fields['ID0'] == $contcodi)) {
      
      //Si hay local Y pais pertenece al continente
      $s = ($paiscodi == $Rs_pais->fields['ID1'])? " selected='selected'" : '';
			
      echo "<option".$s." value='".$Rs_pais->fields['ID1']."'>".$Rs_pais->fields['NOMBRE']."</option>";
	  }
		$Rs_pais->MoveNext();
	}
	echo "</SELECT>";
	$Rs_pais->Move(0);
?>
</td>
<tr>
	<td width="10%" class="titulos5"  align="right"><font face="Arial" class="etextomenu">Departamento</font>
	</td>
	<td width="20%" bgcolor="#FFFFFF"  class="listado5">
<?php
	echo "<SELECT NAME=\"codep_us$i\" ID=\"codep_us$i\" CLASS=\"select\" onchange=\"cambia(this.form, 'muni_us$i', 'codep_us$i')\">";
	while (!$Rs_dpto->EOF && empty($Submit4)) {
    //Si hay local Y dpto pertenece al pais.
    if ($_SESSION['cod_local'] and ($Rs_dpto->fields['ID0'] == $paiscodi)) {
      ($deptocodi == $Rs_dpto->fields['ID1'])? $s = " selected='selected'" : $s = "";
			echo "<option".$s." value='".$Rs_dpto->fields['ID1']."'>".$Rs_dpto->fields['NOMBRE']."</option>";
	}
		$Rs_dpto->MoveNext();
	}
	echo "</SELECT>";
	$Rs_dpto->Move(0);
?>
	</td>
	<td width="10%" class="titulos5"  align="right"><font face="Arial" class="etextomenu">Municipio</font></td>
	<td  colspan="3" bgcolor="#FFFFFF"  class="listado5">
<?php
	echo "<SELECT NAME=\"muni_us$i\" ID=\"muni_us$i\" CLASS=\"select\" >";
	while (!$Rs_mcpo->EOF && empty($Submit4))
	{	if ($_SESSION['cod_local'])	//Si hay local
		{	($municodi == $Rs_mcpo->fields['ID1'])? $s = " selected='selected'" : $s = "";
			echo "<option".$s." value='".$Rs_mcpo->fields['ID1']."'>".$Rs_mcpo->fields['NOMBRE']."</option>";
		}
		$Rs_mcpo->MoveNext();
	}
	echo "</SELECT>";
	$Rs_mcpo->Move(0);

  $municodi = 0;
  $muninomb = '';
  $deptocodi= 0;
?>
</td>
</tr>
</table>
</div>
<?php
  }
  unset($contcodi);
  unset($paiscodi);
  unset($deptocodi);
  unset($municodi);
?>
</div>
<table width=100% border="0" class="borde_tab" align="center">
	<tr>
	<td  class="titulos5" width="25%" align="right" > <font color="" face="Arial, Helvetica, sans-serif" class="etextomenu">Asunto
		</font></td>
	<td width="75%" class="listado5" >
	<textarea name="asu" cols="70" class="tex_area" rows="2" ><?php echo htmlspecialchars(stripcslashes($asu)); ?></textarea>
	</td>
	</tr>
</table>
<table width=100% border="0" cellspacing="1" cellpadding="1" class="borde_tab" align="center">
	<!--DWLayoutTable-->
<tr>
	<td width="25%" class="titulos5" align="right">
		<font color="" face="Arial, Helvetica, sans-serif" class="etextomenu">
<?php

    echo ($ent==2)? "Medio Recepci&oacute;n" : "Medio Env&iacute;o";
/** Si la variable $faxPath viene significa que el tipo de recepcion es fax
	* Por eso $med se coloca en 2
	*/
	if($faxPath) $med=2;
	if($tipoMedio) $med=4;
?>
	</font>
</td>
<td width="25%" valign="top" class="listado5"><font color="">
<?php
	$query = "Select MREC_DESC, MREC_CODI from MEDIO_RECEPCION ";
	$rs     = $db->conn->query($query);
  $varQuery = $query;
  
  if (empty($med))
    $med = null;

  if (empty($opcMenu))
    $opcMenu = null;

  if($rs)
    print $rs->GetMenu2("med", $med, $opcMenu, false,"","class='select' " );
?>
</font>
</td>
	<td width="25%"  class="titulos5" align="right"> <font face="Arial, Helvetica, sans-serif" class="etextomenu">Tipo Doc</font>
	</td>
	<td width="25%" valign="top" class="listado5"> <font color="">
	<input name="hoj" type=hidden value="<? echo $hoj; ?>">
	<?php
	 $query = "select SGD_TPR_DESCRIP
	 ,SGD_TPR_CODIGO 
	from SGD_TPR_TPDCUMENTO 
	WHERE SGD_TPR_TP$ent='1'
	 and SGD_TPR_RADICA='1' 
	ORDER BY SGD_TPR_DESCRIP ";
	$opcMenu = "0:-- Seleccione un tipo --";
	$fechaHoy = date("Y-m-d");
	$fechaHoy = $fechaHoy . "";
	$ADODB_COUNTRECS = true;
	
  $rs = $db->conn->query($query);
	if ($rs && !$rs->EOF ) {
    $numRegs = "!".$rs->RecordCount();
		$varQuery = $query;

    if (empty($tdoc))
      $tdoc = null;

		print $rs->GetMenu2("tdoc", $tdoc, $opcMenu, false,"","class='ecajasfecha' " );
	} else {
		$tdoc = 0;
	}
	$ADODB_COUNTRECS = false;
?>
</font>
</td>
</tr>
</table>
<table width=100% border="0" cellspacing="1" cellpadding="1" class="borde_tab" align="center">
<!--DWLayoutTable-->
<tr>
		<td  class="titulos5" width="25%" align="right"> <font color="" face="Arial, Helvetica, sans-serif" class="etextomenu">
		Desc Anexos</font>
		</td>
		<td width="75%" class="listado5">
      <font color="" face="Arial, Helvetica, sans-serif">
		    <input name="ane" id="ane" type="text" size="70" class="tex_area" value="<?=htmlspecialchars(stripcslashes($ane))?>">
		  </font>
    </td>
	</tr>

   <!--
      /** Modificado Supersolidaria 01-Nov-2006
        * Datos del funcionario que tiene a cargo una entidad y la dependencia a la
        * que pertenece.
        */
    -->
    <?php
        switch($db->entidad) {
            case 'SES':
    ?>
                <tr>
                    <td  class="titulos5" width="25%" align="right">
                      <font color="" face="Arial, Helvetica, sans-serif" class="etextomenu">
                        Funcionario Encargado
                      </font>
                    </td>
                    <td width="75%" class="listado5">
                      <font color="" face="Arial, Helvetica, sans-serif">
                        <input name="supervisor_us" type="text" size="80" class="tex_area" value="<?=(isset($supervisor_us))? $supervisor_us : null?>" readonly>
                      </font>
                    </td>
                </tr>
    <?php
                break;
        }
    ?>

<tr>
	<td class="titulos5" width="25%" align="right"><font color="" face="Arial, Helvetica, sans-serif" class="etextomenu">
	Dependencia</font>
	</td>
	<td colspan="3" width="75%" class="listado5">
    <font color="" face="Arial, Helvetica, sans-serif">
    <?
// Busca las dependencias existentes en la Base de datos...
if($radi_depe_actu_padre and $tipoanexo==0 and !$coddepeinf)
  $coddepe = $radi_depe_actu_padre;
	
  if(empty($coddepe))
		$coddepe = $dependencia;
	
  /** Solo los documentos de entrada (ent=2) muestra la posibilidad de redireccion a otras dependencias
		* @queryWhere String opcional para la consulta.
		*/

  $queryWhere = ($ent!=2)? " where depe_codi = $dependencia" : null;
	
  // Modificado SGD 11-Jul-2007
	//$query = "select DEPE_NOMB,DEPE_CODI from dependencia $queryWhere order by depe_nomb";
	switch(isset($GLOBALS['entidad'])) {
		case 'SGD':
			$query = "SELECT ".$db->conn->Concat( "DEPE_CODI", "'-'", "DEPE_NOMB" ).", DEPE_CODI
			FROM DEPENDENCIA
			$queryWhere
			ORDER BY DEPE_CODI, DEPE_NOMB";
			break;
		default:
			$query = "select DEPE_NOMB,DEPE_CODI from dependencia $queryWhere order by depe_nomb";
	}
	$ADODB_COUNTRECS = true;
	$rs=$db->conn->query($query);
	$numRegs = "!".$rs->RecordCount();
	$varQuery = $query;
	$comentarioDev = "Muestra las dependencias";
	//Modificado IDRD 7-May-2008 para diferencias entre ent=2 o ent=1
	if ($ent!=2)
		print $rs->GetMenu2("coddepe",$coddepe, "0:-- Seleccione una Dependencia --", false,false,"class='select'");
	else
		print $rs->GetMenu2("coddepe","", "0:-- Seleccione una Dependencia --", false,false,"class='select'");
	
	$ADODB_COUNTRECS = false;
?>
    </font>
</td>
</tr>
<?php
  // Comprueba si el documento es una radicacion nueva de entrada....
  if($tipoanexo==0 and $radicadopadre and !$radicadopadreseg and (!$Submit3  and !$Submit4)) {
?>
<tr>
	<td class="titulos5" width="25%" align="right"><font color="" face="Arial, Helvetica, sans-serif" class="etextomenu">
	Usuario Destino
	</font>
	</td>
	<td colspan="3" width="75%" class="listado5">
<?
	if($radi_depe_actu_padre==999)
	{
		echo "<font color=red >Documento padre se encuentra en Archivo</font>";
	}
	elseif($radi_depe_actu_padre and $rad0)
	{
		$query= "select USUA_NOMB, USUA_CODI from usuario where depe_codi=$radi_depe_actu_padre and usua_codi=$radi_usua_actu_padre";
		$ADODB_COUNTRECS = true;
    //$db->conn->debug = true;
		$rs=$db->conn->query($query);
		$numRegs = "!".$rs->RecordCount();
		$ADODB_COUNTRECS = false;
		$varQuery = $query;
		$comentarioDev = "Muestra las dependencias";
		$usuario_padre = $rs->fields["USUA_NOMB"];
		$cod_usuario_inf = $rs->fields["USUA_CODI"];
		echo $usuario_padre;
    $coddepeinf = $radi_depe_actu_padre;
    $informar_rad = "Informar";
    $observa_inf = "(Se ha generado un anexo pero ha sido enviado a la dependencia $coddepe)";
?>
		<input type="hidden" name="radi_depe_actu_padre" value="<?=$radi_depe_actu_padre?>">
		<input type="hidden" name="coddepeinf" value="<?=$coddepeinf?>">
		<input type="hidden" name="cod_usuario_inf" value="<?=$cod_usuario_inf?>">
<?php
	}
?>
</td>
</tr>
<?
}
	?>
	<tr align="center">
	<td height="23" colspan="4" class="listado5"> <font color="" face="Arial, Helvetica, sans-serif">
<?php

if (empty($radi_usua_actu))
  $radi_usua_actu = null;

echo "<!-- Dependencia - Usuario Actual  $coddepe / $radi_usua_actu  -->";
include ('../include/tx/Tx.php');
include ('../include/tx/Radicacion.php');
include ('../class_control/Municipio.php');
$hist = new Historico($db);
$Tx = new Tx($db);

if (isset($Submit3) && $Submit3 == 'Radicar') {
	$ddate = date("d");
	$mdate = date("m");
	$adate = date("Y");
	$fechproc4 = substr($adate,2,4);
	$fechrd = $ddate.$mdate.$fechproc4;
	if($fechproc12=='') {
    $fechproc12=date('d');
    $fechproc22=date('m');
    $fechproc32=date('y');
	}
	//$fechrdoc=$fechproc12."-".$fechproc22."-".$fechproc32;
	$fechrdoc=$fecha_gen_doc;
	$apl .="";$apl=trim(substr($apl,0,50));
	$sapl .="";$sapl=trim(substr($sapl,0,50));
	$pnom .="";$pnom =trim(substr($pnom,0,89));
	$adress .="";
	$tip_rem +=0;
	$tip_doc +=0;
	$numdoc .='';$numdoc =trim(substr($numdoc,0,13));
	$long=strlen($cod);
	$codep +=0;
	$tel +=0;
	$cod +=0;
	$radicadopadre .='';
	$asu.='';
	$tip_rem=$tip_rem-1;
	$rem2.='';
	$dep +=0;
	$hoj +=0;
	$codieesp +=0;
	$ane .='';
	$med +=0;
	$acceso = 1;
	if($acceso==0) {
    // Mal programado
  } else {
    if($tip_rem<0) {
      $tip_rem=0;
    }
		if(!$documento_us3) {
      $documento_us3=0;
    }
		/**  En esta linea si la dependencia es 999 ke es la dep. de salida envia el radicado a una
			*	 carpeta con el codigo de los dos primeros digitos de la dependencia
			*/
		if($ent != 2)
		{
			$carp_codi =$ent;
			$carp_per = "0";
			$radi_usua_actu = $codusuario;
		}
		else
		{
			$carp_codi ="0";
			$carp_per = "0";
			if($cod_usuario_inf!=1 and $coddepeinf==$coddepe)
			{
				$radi_usua_actu = $cod_usuario_inf;
			}
			else
			{
				$radi_usua_actu = 1;
			}
		}
		if(!$radi_usua_actu and $ent == 2) $radi_usua_actu = $codusuario;
		if(!$radi_usua_actu) $radi_usua_actu = 1;
			if($coddepe==999)
			{
				$carp_codi=substr($dependencia,0,2);
				$carp_per=1;
				$radi_usua_actu = 1;
			}

		if(!$radi_usua_actu) $radi_usua_actu==1;
		if($radi_usua_actu_padre and $radi_depe_actu_padre)
		{
					$radi_usua_actu= "$radi_usua_actu_padre";
					$coddepe= "$radi_depe_actu_padre";
		}

		// Buscamos Nivel de Usuario Destino
		$tmp_mun = new Municipio($db);
		$tmp_mun->municipio_codigo($codep_us1,$muni_us1);
		$rad = new Radicacion($db);
		$rad->radiTipoDeri = $tpRadicado;
		$rad->radiCuentai = "'".trim($cuentai)."'";
		$rad->eespCodi =  $documento_us3;
		$rad->mrecCodi =  $med; // "dd/mm/aaaa"
		$fecha_gen_doc_YMD = substr($fecha_gen_doc,6 ,4)."-".substr($fecha_gen_doc,3 ,2)."-".substr($fecha_gen_doc,0 ,2);
		$rad->radiFechOfic =  "'".$fecha_gen_doc_YMD."'";
		if(!$radicadopadre)  $radicadopadre = null;
		$rad->radiNumeDeri = trim($radicadopadre);
		$rad->radiPais =  $tmp_mun->get_pais_codi();
		$rad->descAnex = $ane;
		//$rad->raAsun = $asu;
		$rad->raAsun = iconv( 'ISO-8859-1', 'UTF8', $asu );	
		// Modificado SGD 11-Jul-2007
		//$rad->radiDepeActu = $coddepe;
		//$rad->radiDepeRadi = $coddepe;
		$rad->radiDepeActu = "'".$coddepe."'";
		$rad->radiDepeRadi = "'".$coddepe."'";
		$rad->radiUsuaActu = $radi_usua_actu ;
		$rad->trteCodi     = $tip_rem;
		$rad->tdocCodi     = $tdoc;
		$rad->tdidCodi     = $tip_doc;
		$rad->carpCodi     = $carp_codi;
		$rad->carPer       = $carp_per;
		$rad->trteCodi     = $tip_rem;
		$rad->ra_asun      = htmlspecialchars(stripcslashes($asu)); // HLP Este si sirve? Para radicar se utiliza la variable $rad->raAsun (linea 1342)
		$rad->radiPath     = 'null';
		if (strlen(trim($aplintegra)) == 0)
			$aplintegra = "0";
		$rad->sgd_apli_codi = $aplintegra;
		$codTx = 2;
		$flag = 1;
    
		$noRad = $rad->newRadicado($ent, $tpDepeRad[$ent]);
	if ($noRad=="-1")
		die("<hr><b><font color=red><center>Error no genero un Numero de Secuencia o Inserto el radicado<br>SQL </center></font></b><hr>");

	if(!$noRad) echo "<hr>RADICADO GENERADO <HR>$noRad<hr>";
	$radicadosSel[0] = $noRad;
	$hist->insertarHistorico($radicadosSel,  $dependencia , $codusuario, $coddepe, $radi_usua_actu, " ", $codTx);
	$nurad = $noRad;
	echo "<INPUT TYPE=HIDDEN NAME=nurad value=$nurad>";
	echo "<INPUT TYPE=HIDDEN NAME=flag value=$flag>";
	
  if($noRad) {
			$var_envio = session_name()."=".session_id()."&faxPath&leido=no&krd=$krd&verrad=$nurad&ent=$ent";
		?>
		</p><center><img src='../iconos/img_alerta_2.gif'><font face='Arial' size='3'><b>
		Se ha generado el radicado No.<b></font>
		<font face='Arial' size='4' color='red'><b><u>
		<?=$nurad?>
		
		</u></b></font><br>
		<?
		  if($_SESSION["enviarMailMovimientos"]==1)
		  { echo "Entro a Inf.";
		   $rutaImagen = substr($nurad,0,4)."/".substr($nurad,4,3)."/".$nurad.".tif";
		   $linkImagenes = "<a href='*SERVIDOR_IMAGEN*".$rutaImagen."'> Documento</a>";
		   $radicadosSelText = $nurad;
		   $usuaCodiMail = $radi_usua_actu;
		   $depeCodiMail = $coddepe;
		   include "../include/mail/mailInformar.php";
		  }
		?>
		<font face='Arial' size='4' color='red'>
		<?
		if($faxPath)
		{
		$varEnvio = session_name()."=".session_id()."&faxPath&leido=no&krd=$krd&faxPath=$faxPath&nurad=$nurad&ent=$ent";
		?>
		<center>
		<input class="botones_largo" value ="SUBIR IMAGEN DE FAX" type=button target= 'UploadFax' onclick="window.open('uploadFax.php?<?=$varEnvio?>','Cargar Archivos de Fax', 'height=300, width=400,left=350,top=300')">
		</center>
		<?
		}
	/*  
	 *  Sitio en el cual se incluyen botones de acceso al boton de eMail para asociar archivos al radicado generado.
	 *@autor Orlando Burgos
	 *@fecha 2008
	 */
	  if($tipoMedio=="eMail") {
		$varEnvio = session_name()."=".session_id()."&nurad=$nurad";
		?>
		<center>
		<input class="botones_largo" value ="ASOCIAR EMAIL A RADICADO" type=button target= 'UploadFax' onclick="window.open('../email/uploadMail.php?<?=$varEnvio?>','formulario', 'height=400, width=640,left=350,top=300')">
		</center>
<?php
	  }
	}
	else
	{
		echo "<font color=red >Ha ocurrido un Problema<br>Verfique los datos e intente de nuevo</font>";
	}
	$sgd_dir_us2=2;
	$conexion = $db;
	
  include "grb_direcciones.php";
	$verradicado = $nurad;
  $enlace_radicado = './ver_radicado.php' .
                      '?verrad=' . $nurad .
                      '&var_envio=' . $var_envio .
                      $datos_envio .
                      '&datoVer=985' .
                      '&ruta_raiz=' . $ruta_raiz;

	echo "<script>window.open('$enlace_radicado', 'Modificaciï¿½n_de_Datos', 'height=700,width=650,scrollbars=yes');</script>";
	}
	echo "<input type='hidden' name='nurad' value='$nurad'>";
	echo "<input type='hidden' name='codusuarioActu' value='$codusuarioActu'>";
	echo "<input type='hidden' name='codieesp' value='$codieesp'>";
	echo "<input type='hidden' name='flag' value='$flag'>";
}
  $vector = (isset($coddepeinf))? $coddepeinf : null;
  
  if($vector) {
    foreach ($vector as $key => $coddepeinf) {

    if( ($coddepeinf!=999) and ($Submit3 or $Submit4)) {
	$flag = 0;
	if(($coddepeinf!=$coddepe or ($cod_usuario_inf!=1 and $coddepeinf==$coddepe)) and $Submit3 and $ent==2) {

	/**
		* INFORMACION DE ENVIO DE UN RADICADO EL CUAL EL PADRE ESTA EN UNA DEPENDENCIA DIFERENTE
		* $observa_add   contiene el mensaje que se enviara al informado
		* El mensaje cambia dependiendo a la persona que va.
		* Si va a un funcinario le informa al jefe de lo contrario informa a la otra dependencia
		**/
	if($cod_usuario_inf!=1 and $coddepeinf==$coddepe and $ent==2)
	{
		$observa_inf = "El documento Anexo del Radicado $radicadopadre se envio directamente al funcionario";
		$cod_usuario_inf = 1;
	}
	else
	{
		$observa_inf = "El documento Anexo del Radicado $radicadopadre se envio a la dep. $coddepe";
		$cod_usuario_inf = 1;
	}
}
else
{
	if(!$Submit4)
	{
	$observa_add = "";
	$coddepeinf="";
	}
}

// Aqui se entra a modificar el radicado
if(( ($Submit4 and $coddepeinf!=$coddepe)) ) {

/**
	*	La siguiente decicion pregunta si la dependencia con la cual sale el radicado es
	* a misma que se pretende informar, ademas si es el jefe. En este caso no informa.
	*/
		$observa = "$observa_inf";
		if(!$cod_usuario_inf) $cod_usuario_inf=1;
		$nombTx = "Informar Documentos";
		$radicadoSel[0] = $nurad;
		// Modificado SGD 11-Jul-2007

		// Modificado Infometrika 18-Septiembre-2009
		// Se pasa el valor $ruta_raiz a la funcion informar. Requerido por implementaci�n de alertas. Soluciona el error generado al informar a una
		// dependencia desde el formulario de radicacion de entrada.
		$txSql = $Tx->informar($radicadoSel,
                            $krd,
                            "'".$coddepeinf."'",
                            "'".$dependencia."'",
                            $cod_usuario_inf,
                            $codusuario,
                            $observa,
                            $_SESSION['usua_doc'],
                            $ruta_raiz);
		$flagHistorico = true;
}
}}
}
$coddepeinf = $vector;
if(isset($Submit4) && empty($Buscar)) {
	$secuens=str_pad($consec,6,"0",STR_PAD_LEFT);
	$fechproc4=substr($adate,2,4);
	$fechrd=$ddate.$mdate.$fechproc4;
	$fechrdoc=$fechproc12.$fechproc22.$fechproc32;
	$apl .=' ';$apl=trim(substr($apl,0,50));
	$sapl .=' ';$sapl=substr($sapl,0,50);
	$pnom .=' ';$pnom =substr($pnom,0,89);
	$adress .=' ';
	$tip_rem +=0;$tip_doc +=0;$numdoc .='';$numdoc =trim(substr($numdoc,0,13));
	$codieesp +=0;$radicadopadre +=0;$long=strlen($cod);
	$codep +=0;$tel +=0;$cod +=0;$asu.='';$tip_rem=$tip_rem-1;
	$rem2.='';
	$dep +=0;
	$hoj +=0;
	$ane .='';
	$med +=0;
	if($tip_rem<0)
	{
		$tip_rem=0;
	}
	if(!$documento_us3)
	{
		$documento_us3 = 0;
	}
	/**  En esta linea si la dependencia es 999 ke es la dep. de salida envia el radicado a una
		*	 carpeta con el codigo de los dos primeros digitos de la dependencia
		*/
	$carp_codi=$ent;
	$carp_per=0;
	if(!$radi_usua_actu) $radi_usua_actu = 1;
	if($coddepe==999)
	{
		$carp_codi=substr($dependencia,0,2);
		$carp_per=1;
		$radi_usua_actu = 1;
	}

	$rad = new Radicacion($db);
	$rad->radiTipoDeri = $tpRadicado;
	$rad->radiCuentai = "'$cuentai'";
	$rad->eespCodi =  $documento_us3;
	$rad->mrecCodi =  $med;
	$rad->radiFechOfic =  $fecha_gen_docF;
  $fecha_gen_doc_YMD = substr($fecha_gen_doc,6 ,4)."-".substr($fecha_gen_doc,3 ,2)."-".substr($fecha_gen_doc,0 ,2);
	$rad->radiFechOfic =  $fecha_gen_doc_YMD;

	if(!$radicadopadre)  $radicadopadre = null;
	$rad->radiNumeDeri = $radicadopadre;
	$rad->radiPais =  "'$pais'";
	$rad->descAnex = $ane;
	$rad->raAsun = $asu;
	$rad->radiDepeActu = $coddepe ;
	$rad->radiUsuaActu = $radi_usua_actu ;
	$rad->trteCodi =  $tip_rem;
	$rad->tdocCodi=$tdoc;
	$rad->tdidCodi=$tip_doc;
	$rad->carPer = $carp_per;
	$rad->trteCodi=$tip_rem;
	$rad->ra_asun = $asu;

	if (strlen(trim($aplintegra)) == 0)
		$aplintegra = "0";

	$rad->sgd_apli_codi = $aplintegra;
	$resultado = $rad->updateRadicado($nurad);
	$conexion = $db;
	include "grb_direcciones.php";
	if($resultado)
	{
		echo "<center><font color=green>Radicado No $nurad fue Modificado Correctamente, </font></center>";
		$radicadosSel[] = $nurad;
		$codTx = 11;
		$hist->insertarHistorico($radicadosSel,
                              $dependencia,
                              $codusuario,
                              $coddepe,
                              $radi_usua_actu,
                              "Modificacion Documento.",
                              $codTx);
	}
if($borrarradicado) {
	$flag=0;
	$observa = "Se borro de Inf. ($krd)";
	$depbrr = substr($borrarradicado,0,3);
	$fechbrr = substr($borrarradicado,3,20);
	$data6 = substr($borrarradicado,3,50);
	$radicadosSel [0] = $nurad;
	$nombTx = "Borrar Informados";
	$codTx = 7;
	//$txSql = $rs->borrarInformado( $radicadosSel, $krd,$depbrr,$dependencia,$usCodSelect, $codusuario);
	$isql_inf= "delete from informados where depe_codi=$depbrr and radi_nume_radi=$nurad and info_desc like '%$data6%'";
	$rs=$db->conn->query($isql_inf);
	$hist->insertarHistorico($radicadosSel,  $dependencia , $codusuario, $coddepe, $radi_usua_actu, $observa, $codTx);
		if($flag==1)
		{
			echo "No se ha borrado la inf. de la dependencia $depbrr<br>";
		}else
		{
			echo "<font color=red><center>Se ha borrado un Inf. y registrado en eventos</center><br></font><br>";
		}
}
}
  if (isset($codusuarioActu))
	  echo '<input type="hidden" name="codusuarioActu" value="' . $codusuarioActu . '">';
	
  if (isset($radicadopadre))
    echo "<input type='hidden' name='radicadopadre' value=$radicadopadre>";
  
  if (isset($codieesp))
    echo "<input type='hidden' name='codieesp' value='$codieesp'>";

  if (isset($consec))
    echo "<input type='hidden' name='consec' value='$consec'>";
	
  if (isset($seri_tipo))
    echo "<input type='hidden' name='seri_tipo' value='$seri_tipo'>";
	
  if (isset($radi_usua_actu))
    echo "<input type='hidden' name='radi_usua_actu' value='$radi_usua_actu'>";
	
  echo '<input type="hidden" name="radicadopadreseg" value="2">';

  if(empty($Submit3) and empty($Submit4)){
?>
	<center>
    <input type="button" onClick="radicar_doc()" name="Submit33" value="Radicar" class="botones_largo">
	  <input type="hidden" name="Submit3" value="Radicar" class="ebuttons2">
  </center>
</font>
<?php
  } else {
	  $varEnvio = session_name() . '=' . session_id() .
                '&leido=no' .
                '&krd=' . $krd .
                '&faxPath=' . $faxPath .
                '&verrad=' . $nurad .
                '&nurad=' . $nurad .
                '&ent=' . $ent;
?>
<center>
<input type='button' onClick='modificar_doc()' name='Submit44' value='MODIFICAR DATOS' class="botones_largo">
<font face='Arial' size='2' color='red'><b><u>
<a href="hojaResumenRad.php?<?=$varEnvio?>" target="HojaResumen<?=$nurad?>" class=vinculos>Ver Hoja Resumen </a>
</u></b></font><br>
<a href="./radicacion/stickerWeb/index.php?<?=$varEnvio?>&alineacion=left" target="Sticker<?=$nurad?>" class=vinculos>Ver Sticker </a> - 
<a href="./radicacion/stickerWeb/index.php?<?=$varEnvio?>&alineacion=Center" target="Sticker<?=$nurad?>" class=vinculos>StickerCentrado </a>
<input type='hidden' name='Submit4' value='MODIFICAR DATOS' class='ebuttons2'>
<input type='hidden' name='nurad' value='<?=$nurad?>'></center>
<?php
}
?> </td>
</tr>
<?php
	// Aqui valida si ya radico para dejar informar o Anexat archivos para ras. de Salida.
  
	if ((isset($Submit4) || isset($Submit3)) && empty($Buscar)){
	if($ent==1 && empty($Submit3)) {
	?>
	<tr bgcolor="white">
	<td class="titulos5" colspan="5" align="center">
	<font color="" face="Arial, Helvetica, sans-serif" class="etextomenu">
	</td>
	</tr>
	<tr>
	<td colspan="5">
<?php
	$ruta_raiz = '..';
	$radicar_documento = true;
	if($num_archivos==1 && $radicado=="false") {
			$generar_numero = "no";
			$vp = "n";
			$radicar_a="$nurad";
		}
		?>
	</TD></tr>
	<?
	}
	?>
	<tr bgcolor=white>
	<td class="titulos5">
	Informar a </td><td class="listado5">
	<?php
	// Modificado SGD 11-Jul-2007
	//$query ="select  DEPE_NOMB, DEPE_CODI from DEPENDENCIA ORDER BY DEPE_NOMB";
	switch( $GLOBALS['entidad'] )
	{
		case 'SGD':
			$query = "SELECT  ".$db->conn->Concat( "DEPE_CODI", "' - '", "DEPE_NOMB" ).", DEPE_CODI
			FROM DEPENDENCIA
			ORDER BY DEPE_CODI, DEPE_NOMB";
			break;
		default:
			$query ="select  DEPE_NOMB, DEPE_CODI from DEPENDENCIA ORDER BY DEPE_NOMB";
	}
	$rs=$db->conn->query($query);
	$varQuery = $query;
	print $rs->GetMenu2("coddepeinf", $coddepeinf, false, true,5," class='select'" );
	?>
	</td>
	</tr>
	</table>
	<table border=0  width=100% class="borde_tab">
	<tr>
	<td></td><td class="titulos5"><b>SE HA INFORMADO A:<b></td><td class=listado2>Seleccione un doc. de Informado para borrar</td></tr>
	</table>
	<table border=0 class='borde_tab' width=100%>
	<?php
	$query2 = "select b.depe_nomb
					,a.INFO_DESC
					,b.DEPE_NOMB
					,a.DEPE_CODI
					,a.info_fech as INFO_FECH
					,INFO_DESC
					from informados a,dependencia b
					where a.depe_codi=b.depe_codi and cast(a.radi_nume_radi as varchar)='$nurad'
					order by info_fech desc ";
	$k = 1;
	$rs=$db->conn->query($query2);
	if ($rs)
	{
		while (!$rs->EOF){
			$data = $rs->fields['INFO_DESC'];
			$data2 = $rs->fields['DEPE_NOMB'];
			$data3 = $rs->fields['DEPE_CODI'];
			$data4 = date("dMy",$rs->fields['INFO_FECH']);
			// Modificado SGD 11-Jul-2007
			//$data5 = date("d-m-Y",$rs->fields['INFO_FECH']);
			$data5 = date( "d-m-Y", $db->conn->UnixTimeStamp( $rs->fields['INFO_FECH'] ) );
			$data6 = $db->conn->UnixTimeStamp( $rs->fields['INFO_DESC'] );
			?>
			<tr  class='listado5'>
			<td><input type='radio' name='borrarradicado' value='<?=$data3.$data6?>'></td>
			<td class="listado5"><b><?=$data?></td><td class="listado5"> <center><?=$data2?></td><td class="listado5"><?=$data5?></td></tr>
			<?
			$k = $k +1;
			$rs->MoveNext();
		}
	}
	$verrad = $nurad;
	?>
	<tr><td>
	</td></tr>
	<?
	}
	?>
	</table>
	<input type='hidden' name='depende' value='<?php echo $depende; ?>'><BR>
	  </td>
	</tr>
  </table>
	<br>
</form>
<?php
	$verrad = $nurad;
	$radi = $nurad;
	$contra = $drde;
	$tipo = 1;

  $ha_enviado = isset($Submit3) or isset($Submit4) or
                isset($rad0) or isset($rad1) or
                isset($rad2);
	
  if ($ha_enviado) {
    echo "<script language='JavaScript'>";
		for ($i=1; $i<=3; $i++) {
      $var_pai = "idpais".$i;
			$var_dpt = "codep_us".$i;
			$var_mcp = "muni_us".$i;
			$muni_tmp = ${$var_mcp};
			if (!(is_null($muni_tmp))) {
        echo "\n";
				echo "cambia(document.formulario, 'idpais$i', 'idcont$i');
					
        formulario.idpais$i.value = ${$var_pai};
        cambia(document.formulario, 'codep_us$i', 'idpais$i');
        formulario.codep_us$i.value = '${$var_dpt}';
        cambia(document.formulario, 'muni_us$i', 'codep_us$i');
        formulario.muni_us$i.value = '${$var_mcp}';";
			}
		}
		echo "</script>";
	}
?>
</body>
</html>
