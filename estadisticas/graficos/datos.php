<?php
session_start();
$ofc_path = "../../include/ofc-2-Kvasir/php-ofc-library";
include "$ofc_path/open-flash-chart.php";

/*
$title = new title( 'ESTADISTICAS CONTROL DE LEGALIDAD' );

$pie = new pie();
$pie->set_alpha(0.7);
$pie->set_start_angle( 35 );
$pie->add_animation( new pie_fade() );

$pie->set_tooltip( '#val# of #total#<br>#percent# of 100%' );
$pie->set_colours( array('#5FB404','#DF0101') );
$pie->set_values( array(new pie_value($_SESSION['total2'], "RESPUESTAS"),new pie_value($_SESSION['total1'], "SOLICITUDES")) );

$chart = new open_flash_chart();
$chart->set_title( $title );
$chart->add_element( $pie );
$chart->set_bg_colour('#FFFFFF');

$chart->x_axis = null;

echo $chart->toPrettyString();
*/


$title = new title( "ESTADISTICAS CONTROL DE LEGALIDAD" );

$data = array($_SESSION['total1']);
$bar = new bar_glass();
$bar->colour( '#0404B4');
$bar->key('SOLICITUDES', 12);
$bar->set_values( $data );

$data2 = array($_SESSION['total2']);
$bar2 = new bar_glass();
$bar2->colour( '#5FB404' );
$bar2->key('RESPUESTAS', 12);
$bar2->set_values( $data2 );


$data3 = array($_SESSION['total3']);
$bar3 = new bar_glass();
$bar3->colour('#BF3B69' );
$bar3->key('EN TRAMITE', 12);
$bar3->set_values( $data3 );


$y = new y_axis();
$y->set_range( 0, $_SESSION['total1'], 25);

$chart = new open_flash_chart();
$chart->set_title( $title );
$chart->set_bg_colour('#FFFFFF');
$chart->add_element( $bar );
$chart->add_element( $bar2 );
$chart->add_element( $bar3 );
$chart->add_y_axis( $y );

echo $chart->toString();

?>
