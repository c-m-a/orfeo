<?php
include('./funciones_busqueda.php');
if(!$PHPSESSID) $PHPSESSID = $_GET["PHPSESSID"] ."*";
session_start();

/**
  * Modificacion para aceptar Variables GLobales
  * @autor Infometrika 2009/05 
  * @fecha 2009/05
  */
$krd = $_SESSION["krd"];
echo "<!-- Session -> " . $PHPSESSID . "* Krd ->*$krd* Session_id->>" . session_id() ."-->";
$dependencia = $_SESSION["dependencia"];
$usua_doc = $_SESSION["usua_doc"];
$codusuario = $_SESSION["codusuario"];
$nivelus = $_SESSION["nivelus"];
echo "<!-- $krd->$codusuario>$nivelus -->";

if($_REQUEST["flds_TDOC_CODI"]) $flds_TDOC_CODI=$_REQUEST["flds_TDOC_CODI"];
foreach ($_GET as $key => $valor) ${$key} = $valor;
foreach ($_POST as $key => $valor) ${$key} = $valor;

$ruta_raiz="..";

// busqueda CustomIncludes begin
include ('./common.php');
$fechah = date("ymd") . "_" . time("hms");
$sFileName = "busquedaPiloto.php";

$usu = $krd;
$niv = $nivelus;

if (strlen($niv)) {
}

//check_security();

$sAction = $_REQUEST["FormAction"];
$sForm	 = $_REQUEST["FormName"];
$flds_ciudadano = $_REQUEST["s_ciudadano"];
$flds_empresaESP= $_REQUEST["s_empresaESP"];
$flds_oEmpresa  = $_REQUEST["s_oEmpresa"];
$flds_FUNCIONARIO = $_REQUEST["s_FUNCIONARIO"];
//Proceso de vinculacion al vuelo
$indiVinculo = $_GET["indiVinculo"];
$verrad = $_GET["verrad"];
$carpAnt = $_GET["carpAnt"];
$nomcarpeta = $_GET["nomcarpeta"];
?>
<html>
<head>
<link rel="stylesheet" href="<?=$ruta_raiz?>/estilos/orfeo.css" type="text/css">
</head>
<script>
  function limpiar() {
	   document.Search.elements['s_RADI_NUME_RADI'].value = "";
		 document.Search.elements['s_RADI_NOMB'].value = "";
		 document.Search.elements['s_RADI_DEPE_ACTU'].value = "";
		 document.Search.elements['s_TDOC_CODI'].value = "9999";
        /**
          * Limpia el campo expediente
          * Fecha de modificacion: 30-Junio-2006
          * Modificador: Supersolidaria
          */
		document.Search.elements['s_SGD_EXP_SUBEXPEDIENTE'].value = "";
		 <?
			$dia = intval(date("d"));
			$mes = intval(date("m"));
			$ano = intval(date("Y"));
		 ?>
		 document.Search.elements['s_desde_dia'].value= "<?=$dia?>";
		 document.Search.elements['s_hasta_dia'].value= "<?=$dia?>";
		 document.Search.elements['s_desde_mes'].value= "<?=($mes-1)?>";
		 document.Search.elements['s_hasta_mes'].value= "<?=$mes?>";
		 document.Search.elements['s_desde_ano'].value= "<?=$ano?>";
		 document.Search.elements['s_hasta_ano'].value= "<?=$ano?>";
		 for(i=4;i<document.Search.elements.length;i++) document.Search.elements[i].checked=1;
	}
  
	function selTodas() {
		if(document.Search.elements['s_Listado'].checked==true) {
			document.Search.elements['s_ciudadano'].checked= false;
			document.Search.elements['s_empresaESP'].checked= false;
			document.Search.elements['s_oEmpresa'].checked= false;
			document.Search.elements['s_FUNCIONARIO'].checked= false;
		} else {
			document.Search.elements['s_ciudadano'].checked= true;
			document.Search.elements['s_empresaESP'].checked= false;
			document.Search.elements['s_oEmpresa'].checked= false;
			document.Search.elements['s_FUNCIONARIO'].checked= false;
		}
	}

	function delTodas() {
		document.Search.elements['s_Listado'].checked=false;
		document.Search.elements['s_ciudadano'].checked= false;
		document.Search.elements['s_empresaESP'].checked= false;
		document.Search.elements['s_oEmpresa'].checked= false;
		document.Search.elements['s_FUNCIONARIO'].checked= false;
	}
	function selListado() {
		if(document.Search.elements['s_ciudadano'].checked== true || 
          document.Search.elements['s_empresaESP'].checked== true ||
          document.Search.elements['s_oEmpresa'].checked== true ||
          document.Search.elements['s_FUNCIONARIO'].checked== true ) {
			document.Search.elements['s_Listado'].checked=false;
		}
	}

	function noPermiso() {
		alert ("No tiene permiso para acceder");
	}

	function pasar_datos(fecha,num) {
  <?php
    echo "if(num==1){";
		echo "opener.document.VincDocu.numRadi.value = fecha\n";
		echo "opener.focus(); window.close();\n }";
		echo "if(num==2){";
	  echo "opener.document.insExp.numeroExpediente.value = fecha\n";
	  echo "opener.focus(); window.close();}\n";
	?>
	}	
</script>
<body class="PageBODY" onLoad='document.getElementById("cajarad").focus();'>
<table>
	<tr>
		<td valign="top" width="80%">
			<?php Search_show(); ?>
		</td>
		<td valign="top">
		     <a class="vinculos" href="busquedaHist.php?<?=session_name()."=".session_id()."&fechah=$fechah" ?>">B&uacute;squeda por hist&oacute;rico</a><br>
		     <a class="vinculos" href="busquedaUsuActu.php?<?=session_name()."=".session_id()."&fechah=$fechah" ?>">B&uacute;squeda por Usuarios</a><br>
			 <a class="vinculos" href="../busqueda/busquedaExp.php?<?=$phpsession ?>&<? ECHO "&fechah=$fechah&primera=1&ent=2"; ?>">B&uacute;squeda Expediente</a>
		</td>
	</tr>
</table>
<table>
	<tr>
		<td valign="top">
<?php
if($Busqueda or $s_entrada) {
	if($s_Listado=="VerListado") {
?>
		<tr>
			<td valign="top">
		<?php
			if($flds_ciudadano=="CIU") $whereFlds .= "1,";
			if($flds_empresaESP=="ESP") $whereFlds .= "2,";
			if($flds_oEmpresa=="OEM") $whereFlds .= "3,";
			if($flds_FUNCIONARIO=="FUN") $whereFlds .= "4,";
			$whereFlds .= "0";
			Ciudadano_show($nivelus,9,$whereFlds);
		?>
			</td>
		</tr>
	<?php
	} else {
		if (!$etapa)
		  if($flds_ciudadano=="CIU" || ( !strlen($flds_ciudadano) && !strlen($flds_empresaESP) && !strlen($flds_oEmpresa) && !strlen($flds_FUNCIONARIO))) {
			  Ciudadano_show($nivelus,1,1);
      }
	?>
		</td>
	</tr>
	<tr>
		<td valign="top">
			<? if($flds_empresaESP=="ESP") Ciudadano_show($nivelus,3,3); ?>
		</td>
	</tr>
	<tr>
		<td valign="top">
			<? if($flds_oEmpresa=="OEM") Ciudadano_show($nivelus,2,2); ?>
		</td>
	</tr>
	<tr>
		<td valign="top">
			<? if($flds_FUNCIONARIO=="FUN") Ciudadano_show($nivelus,4,4); ?>
		</td>
	</tr>
	<?
	}
}
?>
 </table>
</body>
</html>
