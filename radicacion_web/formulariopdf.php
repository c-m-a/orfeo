<?php
session_start();
//var_dump( $_SESSION);
/**
  * Se añadio compatibilidad con variables globales en Off
  * @autor Jairo Losada 2009-05
  * @Fundacion CorreLibre.org
  * @licencia GNU/GPL V 3
  */

foreach ($_GET as $key => $valor)   ${$key} = $valor;
foreach ($_POST as $key => $valor)   ${$key} = $valor;

require('barcode.php');
//include('funciones.php');

error_reporting(7);
function nombremes($mes)
{
	switch($mes)
	{
		case "01":
			return "enero";
		case "02":
			return "febrero";
		case "03":
			return "marzo";
		case "04":
			return "abril";
		case "05":
			return "mayo";
		case "06":
			return "junio";
		case "07":
			return "julio";
		case "08":
			return "agosto";
		case "09":
			return "septiembre";
		case "10":
			return "octubre";
		case "11":
			return "noviembre";
		case "12":
			return "diciembre";
	}
}
$pdf=new PDF_Code39();
$pdf->AddPage();
$pdf->Code39(110,45,$_SESSION['radcom'],1,10);
/*
$pdf->Image('../imagenes/PIEDEPAGINA_1.gif',30,275,160,19);
$pdf->Image('../logoEntidadWeb.gif',55,10,100,24);
*/
$pdf->Text(110,63,"Supersolidaria Rad No. ".$_SESSION['radcom']);
$pdf->Text(110,67,"Fecha : ".$_SESSION['fecha']);
$pdf->Text(110,71,utf8_decode(strtoupper($_SESSION['sigla'])));
$pdf->Text(110,75,$_SESSION['nit']);
//$pdf->Text(12,87,utf8_decode("Bogotá, ").date('d')." de ".nombremes(date('m'))." de ".date('Y'));
$pdf->Text(12,87,utf8_decode("Bogotá, ").$_SESSION['fecha']);
$pdf->Text(12,101,utf8_decode("Señores"));
$pdf->SetFont('','B');
$pdf->Text(12,105,utf8_decode("Superintendencia de la Economía Solidaria"));
$pdf->SetFont('','');
$pdf->Text(12,109,"Ciudad");
$pdf->Text(12,119,"Asunto : ".utf8_decode(strtoupper($_SESSION['asunto'])));
$pdf->SetXY(11,125);
$pdf->MultiCell(0,4,htmlspecialchars($_SESSION['desc']),0);
$pdf->Text(12,236,"Atentamente,");
$pdf->SetFont('','B');
$pdf->Text(12,246,strtoupper($_SESSION['nombre_remitente'])." ".strtoupper($_SESSION['apellidos_remitente']));
$pdf->SetFont('','');
$pdf->Text(12,250,$_SESSION['cedula']);
$pdf->Text(12,254,$_SESSION['direccion_remitente']);
$pdf->Text(12,258,$_SESSION['telefono_remitente']);
$pdf->Text(12,262,$_SESSION['email']);
//guarda documento en un SERVIDOR
$anopdf = substr($_SESSION['radcom'],0,4);
$pdf->Output("../bodega/".$anopdf."/".$_SESSION['dependencia']."/".$_SESSION['radcom'].".pdf",'F');
// muestra el pdf

//echo "../bodega/".$anopdf."/".$_SESSION['dependencia']."/".$_SESSION['radcom'].".pdf";
$pdf->Output();
?>
