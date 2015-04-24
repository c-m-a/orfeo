<?php
session_start();
$krd = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
import_request_variables("gp", "");
if (!$ruta_raiz) $ruta_raiz = "..";
include_once("$ruta_raiz/include/db/ConnectionHandler.php");
$db = new ConnectionHandler("$ruta_raiz");
$encabezadol = "$PHP_SELF?".session_name()."=".session_id()."&num_exp=$num_exp";


if( trim( $orderTipo ) == "" )
{
    $orderTipo="DESC";
}
if( $orden_cambio == 1 )
{
    if( trim( $orderTipo ) != "DESC" )
    {
       $orderTipo = "DESC";
    }
    else
    {
        $orderTipo = "ASC";
    }
}

if( strlen( $orderNo ) == 0 )
{
    $orderNo = "2";
    $order = 3;
}
else
{
    $order = $orderNo +1;
}

/** Modificado Supersolidaria 14-Dic-2006
  * Mantiene la serie seleccionada para la b�squeda.
  */
if( $_POST['codserie'] != "" )
{
    $serieSel = $_POST['codserie'];
}
else
{
    $serieSel = $_GET['serieSel'];
}
/** Modificado Supersolidaria 14-Dic-2006
  * Mantiene la subserie seleccionada para la b�squeda.
  */
if( $_POST['tsub'] != "" )
{
    $subserieSel = $_POST['tsub'];
}
else
{
    $subserieSel = $_GET['subserieSel'];
}
/** Modificado Supersolidaria 14-Dic-2006
  * Mantiene el tipo documental seleccionado para la b�squeda.
  */
if( $_POST['tdoc'] != "" )
{
    $tdocSel = $_POST['tdoc'];
}
else
{
    $tdocSel = $_GET['tdocSel'];
}
/** Modificado Supersolidaria 14-Dic-2006
  * Mantiene el tipo de radicado seleccionado para la b�squeda.
  */
if( $_POST['trad'] != "" )
{
    $tradSel = $_POST['trad'];
}
else
{
    $tradSel = $_GET['tradSel'];
}

$encabezado = "".session_name()."=".session_id()."&krd=$krd&depeBuscada=$depeBuscada&filtroSelect=$filtroSelect&tpAnulacion=$tpAnulacion&carpeta=$carpeta&tipo_carp=$tipo_carp&chkCarpeta=$chkCarpeta&busqRadicados=$busqRadicados&nomcarpeta=$nomcarpeta&agendado=$agendado&";
if( $_POST['fechaIni'] != "" && $_POST['fechaInif'] != "" )
{
    $linkPagina = "$PHP_SELF?$encabezado&serieSel=".$serieSel."&subserieSel=".$subserieSel."&tdocSel=".$tdocSel."&tradSel=".$tradSel."&fechaIniSel=".$_POST['fechaIni']."&fechaInifSel=".$_POST['fechaInif']."&orderTipo=$orderTipo&orderNo=$orderNo";
    $encabezado = "".session_name()."=".session_id()."&fechaIniSel=".$_POST['fechaIni']."&fechaInifSel=".$_POST['fechaInif']."&adodb_next_page=1&krd=$krd&depeBuscada=$depeBuscada&filtroSelect=$filtroSelect&tpAnulacion=$tpAnulacion&carpeta=$carpeta&tipo_carp=$tipo_carp&nomcarpeta=$nomcarpeta&agendado=$agendado&orderTipo=$orderTipo&orderNo=";
}
else if( $_GET['fechaIniSel'] != "" && $_GET['fechaInifSel'] != "" )
{
    $linkPagina = "$PHP_SELF?$encabezado&serieSel=".$serieSel."&subserieSel=".$subserieSel."&tdocSel=".$tdocSel."&tradSel=".$tradSel."&fechaIniSel=".$_GET['fechaIniSel']."&fechaInifSel=".$_GET['fechaInifSel']."&orderTipo=$orderTipo&orderNo=$orderNo";
    $encabezado = "".session_name()."=".session_id()."&fechaIniSel=".$_GET['fechaIniSel']."&fechaInifSel=".$_GET['fechaInifSel']."&adodb_next_page=1&krd=$krd&depeBuscada=$depeBuscada&filtroSelect=$filtroSelect&tpAnulacion=$tpAnulacion&carpeta=$carpeta&tipo_carp=$tipo_carp&nomcarpeta=$nomcarpeta&agendado=$agendado&orderTipo=$orderTipo&orderNo=";
}

?>
<html height=50,width=150>
<head>
<title>Etiquetas Expediente</title>
<link rel="stylesheet" href="../estilos/orfeo.css">
<CENTER>
<body bgcolor="#FFFFFF">
<div id="spiffycalendar" class="text"></div>
 <link rel="stylesheet" type="text/css" href="../js/spiffyCal/spiffyCal_v2_1.css">
 <script language="JavaScript" src="../js/spiffyCal/spiffyCal_v2_1.js"></script>
 <?php include_once "$ruta_raiz/js/funtionImage.php"; ?>

<form name="sinexp" action='<?=$_SERVER['PHP_SELF']?>?<?=$encabezado?>' method="post">
<br>

<table border=0 width="70%" class="borde_tab">
<tr>
<TD class=titulos2 colspan="4">
		<center>Radicados Archivados Sin Expediente
	</TD></tr>
	<tr>
	<td class="titulos5" align="right">Radicado:</td>
	<td class="titulos5"><input type="text" align="absmiddle" value="<?=$rad?>" name="rad"> </td>
	</tr>
	<tr>
	<td class="titulos5" align="right" >
	Serie </td>
<td class='titulos5'>
	<?php
	if(!$codserie) $codserie = 0;
	if(!$tsub) $tsub = 0;
	if(!$tdoc) $tdoc = 0;
	$fechah=date("dmy") . " ". time("h_m_s");
	$fecha_hoy = Date("Y-m-d");
	$sqlFechaHoy=$db->conn->DBDate($fecha_hoy);
	$check=1;
	$fechaf=date("dmy") . "_" . time("hms");
	$nomb_varc = "s.sgd_srd_codigo";
	$nomb_varde = "s.sgd_srd_descrip";
	include "$ruta_raiz/include/query/trd/queryCodiDetalle.php";
	$querySerie = "select distinct ($sqlConcat) as detalle, s.sgd_srd_codigo from sgd_mrd_matrird m,
 	sgd_srd_seriesrd s where s.sgd_srd_codigo = m.sgd_srd_codigo and ".$sqlFechaHoy." between s.sgd_srd_fechini
 	and s.sgd_srd_fechfin order by detalle ";
	$rsD=$db->conn->query($querySerie);
	$comentarioDev = "Muestra las Series Docuementales";
	include "$ruta_raiz/include/tx/ComentarioTx.php";
    /** Modificado Supersolidaria 14-Dic-2006
      * Mantiene la serie seleccionada para la b�squeda.
      */
	print $rsD->GetMenu2("codserie", $serieSel, "0:-- Seleccione --", false,"","onChange='submit()' class='select'" );
	?>
	</td></tr>
	<tr><td class='titulos5' align="right" > SubSerie </td>
	<td class='titulos5'>
	<?
	$nomb_varc = "su.sgd_sbrd_codigo";
	$nomb_varde = "su.sgd_sbrd_descrip";
	include "$ruta_raiz/include/query/trd/queryCodiDetalle.php";
	$querySub = "select distinct ($sqlConcat) as detalle, su.sgd_sbrd_codigo from sgd_mrd_matrird m,
 	sgd_sbrd_subserierd su where m.sgd_srd_codigo = '".$serieSel."' and su.sgd_srd_codigo = '".$serieSel."'
			and su.sgd_sbrd_codigo = m.sgd_sbrd_codigo and ".$sqlFechaHoy." between su.sgd_sbrd_fechini
			and su.sgd_sbrd_fechfin order by detalle ";
	$rsSub=$db->conn->query($querySub);
	include "$ruta_raiz/include/tx/ComentarioTx.php";
    /** Modificado Supersolidaria 14-Dic-2006
      * Mantiene la subserie seleccionada para la b�squeda.
      */
    print $rsSub->GetMenu2("tsub", $subserieSel, "0:-- Seleccione --", false,"","onChange='submit()' class='select'" );

	if(!$codiSRD)
	{
		$codiSRD = $codserie;
		$codiSBRD =$tsub;
	}

	?>
	</td>
    <!--
    /* Modificado Supersolidaria 29-Nov-2006
     * Se incluy� el filtro de Tipo Documental.
     */
    -->
    <tr>
	<td class="titulos5" align="right" >Tipo Documental</td>
	<td class="titulos5">
<?
	$nomb_varc = "t.sgd_tpr_codigo";
	$nomb_varde = "t.sgd_tpr_descrip";
	include "$ruta_raiz/include/query/trd/queryCodiDetalle.php";
	$queryTip = "select distinct ($sqlConcat) as detalle, t.sgd_tpr_codigo,
                t.sgd_tpr_descrip
                from sgd_mrd_matrird m, sgd_tpr_tpdcumento t
                where m.sgd_mrd_esta = '1'
                    and m.sgd_srd_codigo = '".$serieSel."'
                    and m.sgd_sbrd_codigo = '".$subserieSel."'
                    and t.sgd_tpr_codigo = m.sgd_tpr_codigo
                order by t.sgd_tpr_descrip
                ";
	$rsTip=$db->conn->query($queryTip);
	$ruta_raiz = "..";
	include "$ruta_raiz/include/tx/ComentarioTx.php";
	print $rsTip->GetMenu2("tdoc", $tdocSel, "0:-- Seleccione --", false,"","class='select'" );
?>
	</td>
	</tr>
	<tr>
	<td class="titulos5" align="right" >Tipo de Radicado</td>
	<td class="titulos5">
<?
	$sql="select sgd_trad_descr,sgd_trad_codigo from sgd_trad_tiporad order by sgd_trad_codigo";
	$rs=$db->query($sql);
	print $rs->GetMenu2("trad", $tradSel, "0:-- Seleccione --", false,"","class='select'" );
?>
	</td>
	</tr>
<?php
/* Modificado Supersolidaria 29-Nov-2006
 * El rango inicial de fechas se estableci� en 1 mes.
 */
// Fecha inicial
if( $_GET['fechaIniSel'] == "" && $_POST['fechaIni'] == "" )
{
    $fechaIni = date( 'Y-m-d', strtotime( "-1 month" ) );
}
else if( $_POST['fechaIni'] != "" )
{
    $fechaIni = $_POST['fechaIni'];
}
else if(  $_GET['fechaIniSel'] != "" )
{
    $fechaIni = $_GET['fechaIniSel'];
}
// Fecha final
if( $_GET['fechaInifSel'] == "" && $_POST['fechaInif'] == "" )
{
    $fechaInif = date( 'Y-m-d' );
}
else if( $_POST['fechaInif'] != "" )
{
    $fechaInif = $_POST['fechaInif'];
}
else if( $_GET['fechaInifSel'] != "" )
{
    $fechaInif = $_GET['fechaInifSel'];
}
?>
	<tr>
	<td class="titulos5" align="right">Fecha Radicado Inicial</td>
	<td class="titulos5">
	<script language="javascript">
   	var dateAvailable1 = new ctlSpiffyCalendarBox("dateAvailable1", "sinexp", "fechaIni","btnDate1","<?=$fechaIni?>",scBTNMODE_CUSTOMBLUE);
  				dateAvailable1.date = "<?=date('Y-m-d');?>";
				dateAvailable1.writeControl();
				dateAvailable1.dateFormat="yyyy-MM-dd";
			</script>
	</td></tr>
	<tr><td class="titulos5" align="right">Fecha Radicado Final</td>
	<td class="titulos5">
	<script language="javascript">
	var dateAvailable2 = new ctlSpiffyCalendarBox("dateAvailable2", "sinexp", "fechaInif","btnDate2","<?=$fechaInif?>",scBTNMODE_CUSTOMBLUE);
  				dateAvailable2.date = "<?=date('Y-m-d');?>";
				dateAvailable2.writeControl();
				dateAvailable2.dateFormat="yyyy-MM-dd";
			</script>
	</td>
	</tr>
	<tr>
	<td align="center" colspan="2"><input type="submit" class="botones" value="Buscar" name="Buscar"></td>
	</tr>
	</table>
<?
if($Buscar){
if($rad!=""){$brad="radi_nume_radi like '$rad'";$a="and";}
else {$brad="";$a="";}
if ($tdoc!='0'){$bdoc="radi_nume_radi like '%$tdoc'";$b="and";}
else {$bdoc="";$b="";}
if($codiSRD!='0'){$srds="m.SGD_SRD_CODIGO LIKE '$codiSRD'";$c="and";}
else {$srds="";$c="";}
if($codiSBRD!='0'){$sbrds="m.SGD_SBRD_CODIGO LIKE '$codiSBRD'";$d="and";}
else {$sbrds="";$d="";}
/* Modificado Supersolidaria 29-Nov-2006
 * Modificaci�n a la consulta de radicados sin expediente.
 */
include_once( "$ruta_raiz/include/query/archivo/querySinExpediente.php" );
$rsb = $db->query( $queryUs );
if ( $rsb->EOF )
{
    echo "<hr><center><b><span class='alarmas'>No se encuentra ningun radicado con el criterio de busqueda</span></center></b></hr>";
}
else
{
    $pager = new ADODB_Pager( $db, $queryUs, 'adodb', true, $orderNo, $orderTipo );
    $pager->checkAll = false;
    $pager->checkTitulo = true;
    $pager->toRefLinks = $linkPagina;
    $pager->toRefVars = $encabezado;
    $pager->descCarpetasGen = $descCarpetasGen;
    $pager->descCarpetasPer = $descCarpetasPer;
    $pager->Render( $rows_per_page = 20, $linkPagina, $checkbox = chkAnulados );
    $rsb->Close();
}
$db->conn->Close();
}
?>
</form>
</CENTER>
</html>