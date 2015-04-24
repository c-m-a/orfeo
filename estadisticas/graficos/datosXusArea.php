<?php
$ofc_path = "../../include/ofc-2-Kvasir";

$data = array();

for( $i=0; $i<6.2; $i+=0.2 )
{
  $tmp = sin($i) * 1.9;
  //$data[] = $tmp;
}

include "$ofc_path/php-ofc-library/open-flash-chart.php";

$chart = new open_flash_chart();
$chart->set_title( new title( 'Estadisticas de Radicados en Bandeja' ) );

//
// Make our area chart:
//
$data[] = 4;
$data[] = 10;
$area = new area();
// set the circle line width:
$area->set_width( 2 );
$area->set_default_dot_style( new hollow_dot() );
$area->set_colour( '#838A96' );
$area->set_fill_colour( '#E01B49' );
$area->set_fill_alpha( 0.4 );
$area->set_values( $data );

// add the area object to the chart:
$chart->add_element( $area );

$y_axis = new y_axis();
$y_axis->set_range( -2, 2, 2 );
$y_axis->labels = null;
$y_axis->set_offset( false );

$x_axis = new x_axis();
$x_axis->labels = $data;
$x_axis->set_steps( 2 );

$x_labels = new x_axis_labels();
$x_labels->set_steps( 4 );
$x_labels->set_vertical();
// Add the X Axis Labels to the X Axis
$x_axis->set_labels( $x_labels );



$chart->add_y_axis( $y_axis );
$chart->x_axis = $x_axis;

echo $chart->toPrettyString();
?>
