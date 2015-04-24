<?php
session_start();
error_reporting(0);
$ruta_raiz = "..";
if (!isset($_SESSION['dependencia']))	include "../rec_session.php";
if (!is_object($db))
{	include_once "$ruta_raiz/include/db/ConnectionHandler.php";
	$db = new ConnectionHandler("$ruta_raiz");
}

//$db->conn->debug=true;

if (!defined('ADODB_FETCH_ASSOC'))	define('ADODB_FETCH_ASSOC',2);
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
$encabezado_i = "estado_sal=$estado_sal&motivo_devol=$motivo_devol&estado_sal_max=$estado_sal_max&pagina_sig=$pagina_sig&dep_sel=$dep_sel&krd=$krd";
?>
<head>
<link rel="stylesheet" href="../estilos/orfeo.css">
</head>
<BODY>
<center><span class=vinculos> <a href="cuerpoDevOtras.php?<?=$encabezado_i?>&<?=session_name().'='.session_id()."&devolucion=1"?>"> Devolver al Listado
 </a></span></CENTER>
<TABLE width="100%" class='borde_tab' cellspacing="5">
  <TR>
    <TD height="30" valign="middle"   class='titulos5' align="center">DEVOLUCION DE DOCUMENTOS</td>
  </tr>
</table>
<div id="spiffycalendar" class="text"></div>
<form name="new_product"  action='dev_corresp_otras.php?<?=session_name()."=".session_id()."&krd=$krd&fecha_h=$fechah&$encabezado_i"?>' method=post><center>
<?
if(!$devolver_rad or $motivo_devol== 0)
{
?>
<table><tr><td></td></tr></table>
<center>
<table width="350" class="borde_tab" cellpadding="5">
  <TR>
    <TD width="125" height="21"  class='titulos2'>Tipo de Devolucion<br></TD>
    <TD width="225" align="right" valign="top" class='listado2'>
		<?
		$ss_RADI_DEPE_ACTUDisplayValue = "----- Escoja un Motivo -----";
		$valor = 0;
		include "$ruta_raiz/include/query/devolucion/querytipo_dev_corresp.php";
		$sql = "select $sqlConcat ,SGD_DEVE_CODIGO from SGD_DEVE_DEV_ENVIO
				WHERE SGD_DEVE_CODIGO < 99
				 order by SGD_DEVE_CODIGO";
			$rsDep = $db->conn->Execute($sql);
			print $rsDep->GetMenu2("motivo_devol","$motivo_devol", $blank1stItem = "$valor:$ss_RADI_DEPE_ACTUDisplayValue", false, 0," class='select'");
	$municodi="";$muninomb="";$depto="";
	?>
   </TD>
  </TR>
  <TR>
    <TD height="26" class='titulos2'>Comentarios</TD>
    <TD valign="top" class='listado2'>
	<input type=text name=comentarios_dev value='<?=$comentarios_dev?>' class=tex_area size=70>
    </TD>
  </TR><tr>
   </tr><tr><td height="26" colspan="2" valign="top" class='titulos2'> <center>
     <input type=SUBMIT name='devolver_rad'  value = 'CONFIRMAR DEVOLUCION' class='botones_largo' ></center></td>
  </tr>
</TABLE>
</center>
<table><tr><td></td></tr></table>
<?php
}else
{//<input type=SUBMIT name='devolver_rad'  value = 'CONFIRMAR DEVOLUCION' class=ebuttons2 onclick="markDev();"></center></td>
	error_reporting(7);
	$isql = "select SGD_DEVE_DESC
		from SGD_DEVE_DEV_ENVIO
		WHERE SGD_DEVE_CODIGO = $motivo_devol
		";
	$sim = 0;
	if (!defined('ADODB_FETCH_ASSOC'))	define('ADODB_FETCH_ASSOC',2);
    $ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
	$rs = $db->conn->Execute($isql);
	$motivo = $rs->fields["SGD_DEVE_DESC"];
}
error_reporting(7);
/*
*Procediminiento que recorre el array de valores de radicados a devolver.....
*/
//print_r($GLOBALS);
if(!$radicados_dev  or $_POST['motivo_devol']==0)
{

     $num = count($_POST['checkValue']);
	$i = 0;
	while ($i < $num)
	{
	 $record_id = key($_POST['checkValue']);
	 $radicados_dev .= $record_id .",";
	 next($_POST['checkValue']);
	$i++;
	}
	$radicados_devOrginal = $radicados_dev;
	$radicados_dev = str_replace("-","",$radicados_dev);
	$radicados_dev .= "9999";
}

echo "<input type=hidden name=radicados_dev value='".$radicados_dev."'>";
echo "<input type=hidden name=radicados_devOrginal value='$radicados_devOrginal'>";
if($_post['devolver_rad']  and  $_POST['motivo_devol']==0)
{
 echo "
		 <script>
		 alert('Elija un Motivo de devolucion.');
		 </script>
		 ";
}
if($_POST['devolver_rad']  and $_POST['motivo_devol'])
{
  if($_POST['motivo_devol'] != 0)
    {
	 $systemDate = $db->conn->OffsetDate(0,$db->conn->sysTimeStamp);
	$sqlConcat = $db->conn->Concat("'".$_POST['comentarios_dev']."'","'-'","sgd_renv_observa");
	include "$ruta_raiz/include/query/devolucion/querydev_corresp_otras.php";
 $radicados_devOrginal2 = $radicados_devOrginal;
 $radicados_devOrginal = $radicados_devOrginal . ")";
 $radicados_devOrginal = str_replace(",)","", $radicados_devOrginal);
 $radicados_devOrginal = str_replace("-"," and SGD_RENV_CODIGO=",$radicados_devOrginal );
 $radicados_devOrginal = str_replace(",",") or (radi_nume_sal=",$radicados_devOrginal );
 $radicados_devOrginal = "((radi_nume_sal=$radicados_devOrginal))";
 $condicion = $radicados_devOrginal;
	$isqlu = "update sgd_renv_regenvio
		set
		sgd_deve_fech=$systemDate,
		sgd_deve_codigo = ".$_POST['motivo_devol'].",
		sgd_renv_observa = ".$db->conn->substr."($sqlConcat,0,199)
	  where $condicion ";

    $rs = $db->conn->Execute($isqlu);
    $num = count($_POST['checkValue']);
		$radicados_devOrginal = substr($radicados_devOrginal2,0,14);
	   $i = 0;
		while ($i < $num)
	 	{
	   	$record_id = key($_POST['checkValue']);
	   	$radicados_sel = $record_id;
		$radicados_lis .= $record_id .",";
 	   	$chkt = $radicados_sel;
		 $systemDate = $db->conn->OffsetDate(0,$db->conn->sysTimeStamp);
	  	$isql = "update anexos
			set anex_estado=3,
			sgd_deve_fech=$systemDate,
			sgd_deve_codigo = ".$_POST['motivo_devol']."
			where radi_nume_salida=$radicados_devOrginal";
		$ADODB_COUNTRECS = true;
    	$rs = $db->conn->Execute($isql);
		if ($rs)
		{
		  $anexos_act = $rs->recordcount();
		 }
		else
		{
		$anexos_act = 0;
		}
    	$ADODB_COUNTRECS = false;
		//select DEPE_CODI   ,HIST_FECH,USUA_CODI  ,RADI_NUME_RADI   ,HIST_OBSE         ,USUA_CODI_DEST,USUA_DOC   ,SGD_TTR_CODIGO from hist_eventos where RADI_NUME_RADI
		$isql_hl= "insert
		into hist_eventos(DEPE_CODI, HIST_FECH, USUA_CODI, RADI_NUME_RADI, HIST_OBSE, USUA_CODI_DEST, USUA_DOC, SGD_TTR_CODIGO)
		values (".$_SESSION['dependencia'].", $systemDate ,".$_SESSION['codusuario'].",$radicados_devOrginal,'Devolucion ($motivo). ".$_POST['comentarios_dev']."',NULL,'".$_SESSION['usua_doc']."',28)";

		$rs = $db->conn->Execute($isql_hl);

		if($radi_nume_padre != $radi_nume_deri and  $radi_nume_padre)
		{
			 $isql_hl= "insert
			into hist_eventos(DEPE_CODI   ,HIST_FECH,USUA_CODI  ,RADI_NUME_RADI   ,HIST_OBSE         ,USUA_CODI_DEST,USUA_DOC   ,SGD_TTR_CODIGO)
			values (".$_SESSION['dependencia'].", $systemDate ,".$_SESSION['codusuario'].",$radi_nume_padre,'Devolucion($radicados_devOrginal, $motivo).".$_POST['comentarios_dev']."',''            ,'".$_SESSION['usua_doc']."','28')";
			$rs = $db->conn->Execute($isql_hl);
		}
		next($_POST['checkValue']);
	   $i++;
	 }
	?>
	<table><tr><td></td></tr></table>
	<table><tr><td></td></tr></table>
	<TABLE width="100%" class='borde_tab' cellspacing="5"><TR><TD height="30" valign="middle"   class='listado2' align="center">
		<center><b>Se ha realizado la devolución de los siguientes registros enviados<br>
		<?=$radicados_lis?></b></center>
	</td></tr></table>
	<table><tr><td></td></tr></table>
	<table><tr><td></td></tr></table>
	<?
	//echo "DEVUELTOS  ".$radicados_dev;
	$sqlFecha = $db->conn->SQLDate("d-m-Y H:i A","a.SGD_RENV_FECH");
	include "$ruta_raiz/include/query/devolucion/querydev_corresp_otras.php";
 $radicados_devOrginal = $_POST['radicados_devOrginal'] . ")";
 $radicados_devOrginal = str_replace(",)","", $radicados_devOrginal);
 $radicados_devOrginal = str_replace("-"," and SGD_RENV_CODIGO=",$radicados_devOrginal );
 $radicados_devOrginal = str_replace(",",") or (radi_nume_sal=",$radicados_devOrginal );
 $radicados_devOrginal = "and ((radi_nume_sal=$radicados_devOrginal))";
 $condicion = "and $sqlConcatC in($radicados_dev)";
 $condicion = $radicados_devOrginal;
 $isql = 'select
			 '.$nombre.'    as "DAT_Numero Radicado",
			 sgd_renv_planilla  as "Planilla",
			 '.$sqlFecha.'      as "FECHA ENVIO",
			 sgd_renv_nombre    as "Destinatario",
			 sgd_renv_dir       as "Direccion",
			 sgd_renv_depto     as "Departamento",
       			 sgd_renv_mpio	    as "Municipio",
			 sgd_renv_cantidad  as "Documentos",
			 sgd_renv_valor     as "Valor Unitario",
       			 a.sgd_renv_codigo  as "HID_sgd_renv_codigo"
	 		 from SGD_RENV_REGENVIO a , radicado b
			 where
			 a.radi_nume_sal=b.radi_nume_radi
			 '.$condicion.'';
  $rs = $db->conn->Execute($isql);
  $pager = new ADODB_Pager($db,$isql,'adodb', true,$orderNo,$orderTipo);
	$pager->toRefLinks = $linkPagina;
	$pager->toRefVars = $encabezado;
	$pager->checkAll = true;
	$pager->checkTitulo = false;
	$pager->Render($rows_per_page=20,$linkPagina);
		//echo $radicados_dev;
   }
   else {
	echo "<span class=etexto><b>No se actualizaron los registros <br>Debe seleccionar un tipo de devolución<br>";
	echo "<input type=hidden name=devolucion_rad value=si>";
  }
 }
 if(!$_POST['devolver_rad']  or !$_POST['motivo_devol'])
 {
 $sqlFecha = $db->conn->SQLDate("d-m-Y H:i A","a.SGD_RENV_FECH");
 include "$ruta_raiz/include/query/devolucion/querydev_corresp_otras.php";
 $radicados_dev = str_replace(",9999", "", $radicados_dev);
 //$radicados_devOrginal = ",9999";
 $radicados_devOrginal = $radicados_devOrginal . ")";
 $radicados_devOrginal = str_replace(",)","", $radicados_devOrginal);
 $radicados_devOrginal = str_replace("-"," and SGD_RENV_CODIGO=",$radicados_devOrginal );
 $radicados_devOrginal = str_replace(",",") or (radi_nume_sal=",$radicados_devOrginal );
 $radicados_devOrginal = "and ((radi_nume_sal=$radicados_devOrginal))";

 $condicion = "and $sqlConcatC in($radicados_dev)";
 $condicion = $radicados_devOrginal;

//Modificacion skina 
$isql = 'select
			 '.$nombre.'    as  "DAT_Numero Radicado",
			 sgd_dir_codigo     as "HID_Codigo Destinatario",
			 sgd_renv_planilla  as "Planilla",
			 '.$sqlFecha.'      as "FECHA ENVIO",
			 sgd_renv_nombre    as "Destinatario",
			 sgd_renv_dir       as  "Direccion",
			 sgd_renv_depto     as  "Departamento",
			 sgd_renv_mpio	    as   "Municipio",
			 sgd_renv_cantidad  as  "Documentos",
			 sgd_renv_valor     as  "Valor Unitario",
			a.sgd_renv_codigo   as "HID_sgd_renv_codigo",
			 '.$nombre.'  AS "CHK_CHKANULAR"
	 		 from SGD_RENV_REGENVIO a , radicado b
			 where
			 a.radi_nume_sal=b.radi_nume_radi
			 '.$condicion.'';
  $rs = $db->conn->Execute($isql);
  $pager = new ADODB_Pager($db,$isql,'adodb', false,$orderNo,$orderTipo);
	$pager->toRefLinks = $linkPagina;
	$pager->toRefVars = $encabezado;
	$pager->checkAll = true;
	$pager->checkTitulo = false;
	$pager->Render($rows_per_page=20,$linkPagina,$checkbox=chkEnviar);

}
?>
</form>
<script>
function markDev()
{
	for(i=1;i<document.new_product.elements.length;i++)
	document.new_product.elements[i].checked=1;
}
</script>
</html>
