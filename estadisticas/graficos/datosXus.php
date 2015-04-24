<?php
session_start();
/**
  * Genera Datos para Grafico tipo torta de OFC (open flash chart)
  * 
  * @autor Por Jairo Losada 2009-07 en IDRD-INFOMETRIKA
  * @licencia GNU/GPL V 3
  */
$ruta_raiz = "../..";
foreach ($_GET as $key => $valor)   ${$key} = $valor;
foreach ($_POST as $key => $valor)   ${$key} = $valor;

define('ADODB_ASSOC_CASE', 1);
$krd = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
$usua_doc = $_SESSION["usua_doc"];
$codusuario = $_SESSION["codusuario"];
 
include_once "$ruta_raiz/include/db/ConnectionHandler.php";
require_once("$ruta_raiz/class_control/Mensaje.php");

$db = new ConnectionHandler($ruta_raiz);

/*
 * Indica si el Radicado Ya tiene asociado algun TRD
 */

	$redondeo="round((radi_fech_radi-".$db->conn->sysTimeStamp.")+floor(c.sgd_tpr_termino * 7/5)+(select count(*) from sgd_noh_nohabiles where NOH_FECHA between radi_fech_radi and ".$db->conn->sysTimeStamp."))";

if($db->driver =='postgres')
{
$redondeo="date_part('days', radi_fech_radi-".$db->conn->sysTimeStamp.")+floor(c.sgd_tpr_termino * 7/5)+(select count(*) from sgd_noh_nohabiles where NOH_FECHA between radi_fech_radi and ".$db->conn->sysTimeStamp.")";
}

	$isql = "select
	count(*) as RADS
	from
	radicado b
	left outer join SGD_TPR_TPDCUMENTO c
	on b.tdoc_codi=c.sgd_tpr_codigo
  where 
	b.radi_nume_radi is not null
	and b.radi_depe_actu=$dependencia
  and $redondeo <=0 ";
  if($xUsuario==0)
	{
 	 $isql .= " and b.radi_usua_actu=$codusuario";
  }
	

//$db->conn->debug = true;
$rs = $db->conn->CacheExecute(36000,$isql);
$alertaRoja = $rs->fields["RADS"];
//echo "<hr>$alertaRoja<hr>";

$isql = "select
	count(*) as RADS
	from
	radicado b
	left outer join SGD_TPR_TPDCUMENTO c
	on b.tdoc_codi=c.sgd_tpr_codigo
  where 
	b.radi_nume_radi is not null
	and b.radi_depe_actu=$dependencia
	and $redondeo >0 and $redondeo<=10 ";
  if($xUsuario==0)
	{
 	 $isql .= " and b.radi_usua_actu=$codusuario";
  }


$rs = $db->conn->Execute($isql);
$alertaAmarilla = $rs->fields["RADS"];
//echo "<hr>$alertaAmarilla<hr>";

$isql = "select
	count(*) as RADS
	from
	radicado b
	left outer join SGD_TPR_TPDCUMENTO c
	on b.tdoc_codi=c.sgd_tpr_codigo
  where 
	b.radi_nume_radi is not null
	and b.radi_depe_actu=$dependencia
	and $redondeo >10 ";
  if($xUsuario==0)
	{
 	 $isql .= " and b.radi_usua_actu=$codusuario";
  }

$rs = $db->conn->CacheExecute(36000,$isql);
$alertaVerde = $rs->fields["RADS"];
//echo "<hr>$alertaVerde<hr>";

$ofc_path = "../../include/ofc-2-Kvasir/php-ofc-library";
include "$ofc_path/open-flash-chart.php";
$d = array();
$rads = $alertaVerde + $alertaRoja + $alertaAmarilla;
//echo "$alertaVerde + $alertaRoja + $alertaAmarilla <hr>";
$d[] = new pie_value(round($alertaVerde), "<10");
$d[] = new pie_value(round($alertaRoja), "<0");
$slice = new pie_value(round($alertaAmarilla), ">10");
$slice->on_click('http://');
$d[] = $slice;
if(!$rads) $rads = 1;
$d[] = new pie_value(1*100/$rads, "");

$pie = new pie();

$title = new title('Estado de Radicados En Bandeja');
$title->set_style( "{font-size: 9px; color: #F24062; text-align: center;}" );

$pie->set_animate( true );
$pie->set_label_colour( '#432BAF' );
$pie->set_alpha( 1 );
$pie->set_start_angle( 0 );
$pie->add_animation( new pie_fade() );
$pie->set_tooltip( '#label#<br>Numero de Radicados #val# (#percent#)' );
//
// default on-click event
//
$pie->on_click('pie_slice_clicked');
//
//
//
$pie->set_colours(
    array(
        '#77CC6D',    // income (green)
        '#f9022b',    // spend (Rojo)
        '#f6ed05'    // profit (Amarillo)
    ) );

$pie->set_values( $d );

$chart = new open_flash_chart();

$chart->set_bg_colour('#FFFFFF');

$chart->add_element( $pie );
$chart->set_title( $title );
echo $chart->toPrettyString();
?>
