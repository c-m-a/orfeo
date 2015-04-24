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

$xUsuario = $_GET["xUsuario"];
 
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
  $terminoIni = 0;
  $terminoFin = 0;
	$isqlIni = "select c.SGD_TPR_DESCRIP
	 ,count(*) as RADS
	from
	radicado b
	left outer join SGD_TPR_TPDCUMENTO c
	on b.tdoc_codi=c.sgd_tpr_codigo
  where 
	b.radi_nume_radi is not null
	and b.radi_depe_actu=$dependencia
 ";
  if($xUsuario==0)
	{
 	 $isqlIni .= " and b.radi_usua_actu=$codusuario";
  }

	$isqlFin = " AND $redondeo<$terminoIni
		group by c.SGD_TPR_DESCRIP";
$isql = $isqlIni . $isqlFin;
//$db->conn->debug = true;
$rs = $db->conn->CacheExecute(36000,$isql);

if ($rs) 
{
  $rs->MoveFirst();
	while (!$rs->EOF) {
	 $tipoDoc = $rs->fields["SGD_TPR_DESCRIP"];
	 $rads = $rs->fields["RADS"];
	 $infoXtipoRojo[$tipoDoc] = $rads;
	 $infoXtipoAmarillo[$tipoDoc] = 0;
	 $infoXtipoVerde[$tipoDoc] = 0;
		//echo "<hr> $tipoDoc  ".$infoXtipo[$tipoDoc][0];    // 5
		$rs->MoveNext();
	} 
}

  $terminoIni = 0;
  $terminoFin = 10;
	$isqlFin = " AND $redondeo>$terminoIni AND $redondeo<=$terminoFin
		group by c.SGD_TPR_DESCRIP";
$isql = $isqlIni . $isqlFin;
//$db->conn->debug = true;
$rs = $db->conn->CacheExecute(36000,$isql);

if ($rs) 
{
  $rs->MoveFirst();
	while (!$rs->EOF) {
	 $tipoDoc = $rs->fields["SGD_TPR_DESCRIP"];
	 $rads = $rs->fields["RADS"];
	 $infoXtipoRojo[$tipoDoc] = $infoXtipoRojo[$tipoDoc]+0;
	 $infoXtipoAmarillo[$tipoDoc] = $rads;
	 $infoXtipoVerde[$tipoDoc] = 0;
		//echo "<hr> $tipoDoc  ".$infoXtipo[$tipoDoc][0];    // 5
		$rs->MoveNext();
	} 
}

  $terminoIni = 0;
  $terminoFin = 10;
	$isqlFin = " AND $redondeo>$terminoFin
		group by c.SGD_TPR_DESCRIP";
$isql = $isqlIni . $isqlFin;
//$db->conn->debug = true;
$rs = $db->conn->Execute($isql);

if ($rs) 
{
    $rs->MoveFirst();
	while (!$rs->EOF) {
	 $tipoDoc = $rs->fields["SGD_TPR_DESCRIP"];
	 $rads = $rs->fields["RADS"];
	 $infoXtipoRojo[$tipoDoc] = $infoXtipoRojo[$tipoDoc]+0;
	 $infoXtipoAmarillo[$tipoDoc] = $infoXtipoAmarillo[$tipoDoc]+0;
	 $infoXtipoVerde[$tipoDoc] = $rads;
		//echo "<hr> $tipoDoc  ".$infoXtipo[$tipoDoc][0];    // 5
		$rs->MoveNext();
	} 
}

$ofc_path = "../../include/ofc-2-Kvasir/php-ofc-library";
include "$ofc_path/open-flash-chart.php";

$title = new title( 'Radicados Discriminados por Tipo Documental ');
$title->set_style( "{font-size: 9px; color: #F24062; text-align: center;}" );

$noTotalRadsTMP = 0;
$i = 1;
$bar_stack = new bar_stack();
$bar_stack->set_colours( array( '#ff0000', '#50284A', '#77CC6D' ) );

foreach ($infoXtipoRojo as $key => $value) {

	$bar_stack->append_stack( array( $infoXtipoRojo[$key]+0, $infoXtipoAmarillo[$key]+0, $infoXtipoVerde[$key]+0 ) );

	$arrayTipos[] = $key;
	// Suma el total de Radicados
	 $noTotalRadsTMP = $noTotalRadsTMP + $infoXtipoRojo[$key] + $infoXtipoAmarillo[$key] + $infoXtipoVerde[$key];

	 if($noTotalRadsTMP >$noTotalRads) $noTotalRads = $noTotalRadsTMP;
   $noTotalRadsTMP = 0;

}
// set a cycle of 3 colours:


// add 3 bars:



// add 4 bars, the fourth will be the same colour as the first:
//$bar_stack->append_stack( array( 2.5, 5, 1.25, 1.25 ) );


//$bar_stack->append_stack( array( 5, new bar_stack_value(5, '#ff0000') ) );
//$bar_stack->append_stack( array( 2, 2, 2, 2, new bar_stack_value(2, '#ff00ff') ) );

$bar_stack->set_keys(
    array(
        new bar_stack_key( '#C4D318', 'En Peligro de Vencer', 12 ),
        new bar_stack_key( '#77CC6D', 'Tiempo Ok', 12 ),
        new bar_stack_key( '#ff0000', 'Vencidos', 12 ),
        )
    );
$bar_stack->set_tooltip( 'X label [#x_label#], Radicados [#val#]<br>Total [#total#]' );




$y = new y_axis();
$y->set_range( 0, $noTotalRads , 2 );

$x = new x_axis();

$animation_1= 'pop';
$delay_1    = 0.25;
$cascade_1    = 10;
//$x->set_labels->set_vertical();
 $bar_stack->set_on_show(new bar_on_show($animation_1, $cascade_1, $delay_1));
$x_labels = new x_axis_labels();
//$x_labels->set_steps( 1 );
$x_labels->rotate(15);

$x_labels->set_labels( $arrayTipos ) ;

$x->set_labels($x_labels);
//$x->rotate(90);
$tooltip = new tooltip();
$tooltip->set_hover();

$chart = new open_flash_chart();
$chart->set_bg_colour('#FFFFFF');
$chart->set_title( $title );
$chart->add_element( $bar_stack );
$chart->set_x_axis( $x );
$chart->add_y_axis( $y );
$chart->set_tooltip( $tooltip );


echo $chart->toPrettyString();
?>
