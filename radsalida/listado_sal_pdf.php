<?php
define('FPDF_FONTPATH','../fpdf/font/');
require('../fpdf/fpdf.php');

class PDF extends FPDF
{
function PDF($orientation='L',$unit='mm',$format='A4')
{
    //Call parent constructor
    $this->FPDF($orientation,$unit,$format);
    //Initialization
    $this->B=0;
    $this->I=0;
    $this->U=0;
    $this->HREF='';
}
//Load data
function LoadData($file)
{
    //Read file lines
    $lines=file($file);
    $data=array();
    foreach($lines as $line)
       $data[]=explode(';',chop($line));
    return $data;
}

//Simple table
function BasicTable($header,$data)
{
    //Header
    foreach($header as $col)
    $this->Cell(40,7,$col,1);
    $this->Ln();
    //Data
    foreach($data as $row)
    {
        foreach($row as $col)
            $this->Cell(40,6,$col,1);
        $this->Ln();
    }
}

//Better table
function ImprovedTable($header,$data)
{
    //Column widths
    //Header
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C');
    $this->Ln();
    //Data
    foreach($data as $row)
    {
        $this->Cell($w[0],6,$row[0],'LR');
        $this->Cell($w[1],6,$row[1],'LR');
        $this->Cell($w[2],6,number_format($row[2]),'LR',0,'R');
        $this->Cell($w[3],6,number_format($row[3]),'LR',0,'R');
        $this->Ln();
    }
    //Closure line
    $this->Cell(array_sum($w),0,'','T');
}

//Colored table
function FancyTable($header,$data,$w)
{
    //Colors, line width and bold font
    $this->SetFillColor(255,0,0);
    $this->SetTextColor(255);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('','B');
    //Header
    for($i=0;$i<count($header);$i++)
    $this->Cell($w[$i],7,$header[$i],1,0,'C',1);
    $this->Ln();
    //Color and font restoration
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
    //Data
    $fill=0;
    foreach($data as $row)
    {   
	   for($i=0; $i<count($row);$i++)
	   {
	    $celda = strlen(chop($row[$i]))*5;
		echo "$celda  - ";
        $this->Cell($w[$i],6,chop($row[$i]),'LR',0,'C',$fill);
echo "<" .$w[$i].">";
	   } 
	    
		echo "<br>";	    
        $this->Ln();
        $fill=!$fill;
    }
    $this->Cell(array_sum($w),0,'','T');
}
}

$pdf=new PDF();
$pdf->Open();
$this->Orientation="L";
//Column titles
$pdf->SetFont('Arial','',4);
$header=array('CANTIDAD','CAT','NUM REGISTRO FFFFFFFFFFFFFFFF <Ln> FFFFFFFFFFFFF FFFFFFFFFFFFFFFF FFFFFFFFFFFFFFFF FFF','DESTINATARIO','DESTINO','PESO EN GRAMO','VALOR PORTE','CERTIFICADO','VALOR ASEGURADO','TASA DE SEGURO','VALOR REEMBOLSABLE','AVISO DE LLEGADA	SERVICIOS ESPECIALES','VALOR TOTAL','PORTES Y TASAS');
$k = array();
for($i=0; $i<count($header); $i++)
{
   $w[$i] = strlen($header[$i]) * 10 *.15;  
   //w[$i] = strlen($header[$i]); 
}
//Data loading
//$data=$pdf->LoadData('countries.txt');
$pdf->SetFont('Arial','',8);
/*$pdf->AddPage();
$pdf->BasicTable($header,$data);
$pdf->AddPage();
$pdf->ImprovedTable($header,$data);*/
/*  *************************
   ***************************
   */
  $isql = "select SGD_RENV_CODIGO, 
		  SGD_FENV_CODIGO, 
		  SGD_RENV_FECH,
		  SGD_RENV_FECH, 
		  RADI_NUME_SAL, 
		  SGD_RENV_DESTINO, 
		  SGD_RENV_TELEFONO, 
		  SGD_RENV_MAIL, 
		  SGD_RENV_PESO, 
		  SGD_RENV_VALOR, 
		  SGD_RENV_CERTIFICADO, 
		  SGD_RENV_ESTADO, 
		  USUA_DOC from SGD_RENV_REGENVIO ";
          include "../config.php";		  
		  $cursor = ora_open($handle);
		  $resultado = ora_parse($cursor,$isql);
		  $resultado = ora_exec($cursor);	
    $line=0;
    $data=array();
	$numCols = ora_numcols( $cursor );
    while(ora_fetch($cursor))
	{
	    $line = "";
        for( $i = 0; $i < $numCols; $i++ ) 
		{  
		  if($i>=1) $line .=";";
          $line .= ora_getcolumn( $cursor, $i ) ;

        }	
		//  echo $line . "<br>";		
	    $data[]=explode(';',chop($line));
   }
$pdf->AddPage(); 
$pdf->FancyTable($header,$data,$w);
    $arpdf_tmp = "../rad_salida/tmp_pdf/22l_jhlc.pdf";
	$pdf->Output($arpdf_tmp); 
//$pdf->Output();
?> 
