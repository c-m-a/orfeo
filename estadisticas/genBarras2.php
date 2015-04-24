<?php
// A medium complex example of JpGraph
// Note: You can create a graph in far fewwr lines of code if you are
// willing to go with the defaults. This is an illustrative example of
// some of the capabilities of JpGraph.

$rutaJpGraph = "../jpgraph/src";
include ("$rutaJpGraph/jpgraph.php");
include ("$rutaJpGraph/jpgraph_bar.php");
include ("$rutaJpGraph/jpgraph_line.php");

// Some data
//$databary=array(12,7,16,5,7,14,9,3);
$databary = $data1y;

// New graph with a drop shadow
$graph = new Graph(640,750,'auto');
$graph->SetShadow();

// Use a "text" X-scale
$graph->SetScale("textlin");
$graph->xaxis->SetTickLabels($nombUs);

// Set title and subtitle
$graph->title->Set("Elementary barplot with a text scale");

// Use built in font
$graph->title->SetFont(FF_FONT1,FS_BOLD);
$graph->yaxis->title->SetAngle(90);
$graph->yaxis->SetTitleSide(SIDE_RIGHT);
// Create the bar plot
$b1 = new BarPlot($databary);
$b1->SetLegend("Temperature");
//$b1->SetAbsWidth(6);
//$b1->SetShadow();

// The order the plots are added determines who's ontop
$graph->Add($b1);

// Finally output the  image
$graph->Stroke($nombreGraficaTmp);
?>
