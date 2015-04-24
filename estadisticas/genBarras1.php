<?php
session_start($PHPSESSID);
// $Id: bar_csimex3.php,v 1.3 2002/08/31 20:03:46 aditus Exp $
// Horiontal bar graph with image maps
$rutaJpGraph = "../jpgraph/src";
error_reporting(7);
include ("$rutaJpGraph/jpgraph.php");
include ("$rutaJpGraph/jpgraph_bar.php");

//$data1y=array(5,8,19,3,10,5,3,4,5,5,6,7,5,2,3,3,3,3,33);
//$nombUs=array("jairo losada","Martha Mera",19,3,10,5,19,3,10,5,19,3,10,5,19,3,10,5,19,3,10,5,19,3,10,5);
// Setup the basic parameters for the graph
$data2y=array(0);
$graph = new Graph(540,700);
$graph->SetAngle(90);
$graph->SetScale("textlin");

// The negative margins are necessary since we
// have rotated the image 90 degress and shifted the 
// meaning of width, and height. This means that the 
// left and right margins now becomes top and bottom
// calculated with the image width and not the height.
$graph->img->SetMargin(-10,-20,210,210);

$graph->SetMarginColor('white');

// Setup title for graph
$graph->title->Set($tituloGraph);
$graph->title->SetFont(FF_FONT2,FS_BOLD);
$graph->subtitle->Set($notaSubtitulo);

// Setup X-axis.
$graph->xaxis->SetTitle($nombXAxis);
$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->title->SetAngle(90);
$graph->xaxis->SetTitleMargin(10);
$graph->xaxis->SetLabelMargin(1);
$graph->xaxis->SetLabelAlign('right','center');
$graph->xaxis->SetTickLabels($nombUs);
// Setup Y-axis

// First we want it at the bottom, i.e. the 'max' value of the
// x-axis
$graph->yaxis->SetPos('max');

// Arrange the title
// Modificado SGD 03-Septiembre-2007
//$graph->yaxis->SetTitle("Numero de Radicados",'center');
$graph->yaxis->SetTitle($nombYAxis,'center');
$graph->yaxis->SetTitleSide(SIDE_RIGHT);
$graph->yaxis->title->SetFont(FF_FONT2,FS_BOLD);
$graph->yaxis->title->SetAngle(0);
$graph->yaxis->title->Align('center','top');
$graph->yaxis->SetTitleMargin(30);

// Arrange the labels
$graph->yaxis->SetLabelSide(SIDE_RIGHT);
$graph->yaxis->SetLabelAlign('center','top');

// Create the bar plots with image maps
$b1plot = new BarPlot($data1y);
$b1plot->SetFillColor("orange");
$targ=array("bar_clsmex2.php#123","bar_clsmex2.php#2","bar_clsmex2.php#3",
            "bar_clsmex2.php#4","bar_clsmex2.php#5","bar_clsmex2.php#6");
$alts=array("val=%d","val=%d","val=%d","val=%d","val=%d","val=%d");
//$alts=array("val='Usuario 1'","val='Usuario 1'","val=111","val=%d","val=%d","val=%d");
$b1plot->SetCSIMTargets($targ,$alts);

$b2plot = new BarPlot($data2y);
$b2plot->SetFillColor("blue");
$targ=array("bar_clsmex2.php#7","bar_clsmex2.php#8","bar_clsmex2.php#9",
            "bar_clsmex2.php#10","bar_clsmex2.php#11","bar_clsmex2.php#12");
$alts=array("val='Usuario 1'","val='Usuario 1'","val=111","val=%d","val=%d","val=%d");
$alts=array("val=%d","val=%d","val=%d","val=%d","val=%d","val=%d");
$b2plot->SetCSIMTargets($targ,$alts);

// Create the accumulated bar plot
$abplot = new AccBarPlot(array($b1plot));
$abplot->SetShadow();

// We want to display the value of each bar at the top
$abplot->value->Show();
$abplot->value->SetFont(FF_FONT1,FS_NORMAL);
$abplot->value->SetAlign('left','center');
$abplot->value->SetColor("black","darkred");
$abplot->value->SetFormat('%d ');

// ...and add it to the graph
$graph->Add($abplot);

// Send back the HTML page which will call this script again
// to retrieve the image.
$graph->Stroke($nombreGraficaTmp);
/** $im=$graph->Stroke(_IMG_HANDLER); 
  $filename="chart"; 
  $file_type = "image/png"; 
  $file_ending = "png"; 
  $filename=$filename.".".$file_ending; 
  header("Content-Type: application/$file_type"); 
  header("Content-Disposition: attachment; filename=".$filename); 
  header("Pragma: no-cache"); header("Expires: 0"); 
  ImagePNG($im); */
?>
