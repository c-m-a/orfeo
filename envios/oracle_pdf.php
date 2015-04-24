<?php
define(FPDF_FONTPATH,'../fpdf/font/');
require('../fpdf/fpdf.php');

class PDF extends FPDF {

var $tablewidths;
var $headerset;
var $footerset;
var $numrows;
var $planilla;
var $usuario;
var $depe_municipio;
var $btt;
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
        $this->Cell(475,$col,1);
    $this->Ln();
    //Data
    foreach($data as $row)
    {
		$row = $row - 1;
        foreach($row as $col)
            $this->Cell(50,50,$col,1);
        $this->Ln();
    }
}
function _beginpage($orientation) {
    $this->page++;
    if(!$this->pages[$this->page]) // solved the problem of overwriting a page, if it already exists
        $this->pages[$this->page]='';
    $this->state=2;
    $this->x=$this->lMargin;
    $this->y=$this->tMargin;
    $this->lasth=0;
    $this->FontFamily=''; 
    //Page orientation
    if(!$orientation)
        $orientation=$this->DefOrientation;
    else
    {
        $orientation=strtoupper($orientation{0});
        if($orientation!=$this->DefOrientation)
            $this->OrientationChanges[$this->page]=true;
    }
    if($orientation!=$this->Cuientation)
    {
        //Change orientation
        if($orientation=='P')
        {
            $this->wPt=$this->fwPt;
            $this->hPt=$this->fhPt;
            $this->w=$this->fw;
            $this->h=$this->fh;
        }
        else
        {
            $this->wPt=$this->fhPt;
            $this->hPt=$this->fwPt;
            $this->w=$this->fh;
            $this->h=$this->fw;
        }
        $this->PageBreakTrigger=$this->h-$this->bMargin;
        $this->CurOrientation=$orientation;
    }
}

function Header()
{
	
    global $maxY;
	$l = 28;
	$margen = 20;
	$this->SetFont('Arial','',12);	
    $this->SetXY($l,20+$margen);
 	$this->Cell(407,14,'SUPERINTENDENCIA DE SERVICIOS PUBLICOS',1,1,'L');
    $this->SetXY($l,34+$margen);
 	$this->Cell(407,13,'DOMICILIARIOS',1,1,'L');
    $this->SetXY($l,47+$margen);
 	$this->Cell(407,13,'CONTRATO 256 - 03',1,1,'L');
	$l = 435;
	$this->SetXY($l,20+$margen);
 	$this->Cell(590,14,'ADMINISTRACION  POSTAL NACIONAL',1,1,'C');
    $this->SetXY($l,34+$margen);
 	$this->Cell(590,13,'PLANILLA PARA  CONSIGNACION',1,1,'C');
    $this->SetXY($l,47+$margen);
 	$this->Cell(590,13,'ENVIOS CON CONTRATO',1,1,'C');
	$l = 1025;
	$this->SetXY($l,20+$margen);
 	$this->Cell(154,14,'',1,1,'C');
    $this->SetXY($l,34+$margen);
 	$this->Cell(154,13,"PLANILLA No " . $this->planilla,1,1,'C');
    $this->SetXY($l,47+$margen);
 	$this->Cell(154,13,$this->depe_municipio. " " .date("d/m/Y"),1,1,'C');		
	$this->SetFont('Arial','',10);   
	
	$l = 28;
    if(!$this->headerset[$this->page]) {
	    $ii=0;
		foreach($this->tablewidths as $width) {
        if($ii<=8)
			{
                $fullwidth += $width;
			}
			$ii++;
        }
        $this->SetY(($this->tMargin) - ($this->FontSizePt/$this->k));
        $this->cellFontSize = $this->FontSizePt ;
        $this->SetFont('Arial','',( ( $this->titleFontSize) ? $this->titleFontSize : $this->FontSizePt ));
        $this->Cell(0,$this->FontSizePt,trim($this->titleText),0,1,'C');
        $l = ($this->lMargin);
        $this->SetFont('Arial','',$this->cellFontSize);
		$ii = 0;
        foreach($this->colTitles as $col => $txt) {
            if($ii<=12)
			{
			$this->SetXY($l,($this->tMargin+10+$margen));
            $this->MultiCell($this->tablewidths[$col], $this->FontSizePt,$txt);
            $l += $this->tablewidths[$col] ;
            $maxY = ($maxY < $this->getY()) ? $this->getY() : $maxY ;
			}
			$ii++;
        }
        $this->SetXY($this->lMargin,$this->tMargin+10+$margen);
        $this->setFillColor(200,200,200);
        $l = ($this->lMargin);
		$ii=0;
        foreach($this->colTitles as $col => $txt) {
            if($ii<=12)
			{		
            $this->SetXY($l,$this->tMargin+10+$margen);
            $this->cell($this->tablewidths[$col],$maxY-($this->tMargin+30),'',1,0,'C',1);
            $this->SetXY($l,$this->tMargin+10+$margen);
            $this->MultiCell($this->tablewidths[$col],$this->FontSizePt,$txt,0,'C');
            $l += $this->tablewidths[$col];
			
			}
			$i++;
        }
        $this->setFillColor(0,0,0);
        // set headerset
        $this->headerset[$this->page] = 1;
    }
    $this->SetY($maxY);
	$this->SetFont('Arial','',8);

	
}
// Aki se coloca la Pagina
function Footer() {
    // Check if footer for this page already exists
	$margen = -15;
    if(!$this->footerset[$this->page]) {
        $this->SetY(-90+$margen);
        $this->Cell(615,60,'',1,1,'C');	
        $this->SetY(-45+$margen);
        $this->Cell(615,15,strtoupper($this->usuario),0,1,'C');	
        $this->SetY(-30+$margen);
        $this->Cell(615,20,'AUXILIAR ADMINISTRATIVO',1,1,'C');
 	// AL LADO 
        $this->SetY(-90+$margen);
		$this->SetX(642);		
        $this->Cell(535,60,'',1,1,'C');	
        $this->SetY(-30+$margen);
        $this->SetX(642);				
        $this->Cell(535,20,'',1,1,'C');
       $this->footerset[$this->page] = 1;		
   }
}

function morepagestable($lineheight=10,$query,$row_ini,$row_fin) {
    // some things to set and 'remember'
    $l = $this->lMargin;
    $startheight = $h = $this->GetY();
    $startpage = $currpage = $this->page;
    // calculate the whole width
    foreach($this->tablewidths as $width) {
        $fullwidth += $width;
    }
    // Now let's start to write the table
    $row = 1;
	error_reporting(7);
	$this->connect('localhost','root','','register');
	//echo "<hr>".$query."<hr>";
	$this->query($query);
	if (!$rs->EOF)  {
//	$data=ora_fetch($this->cursor);
//	if($data)
//	{
     $i_datos = 0;
	 $i_total = 0;
	 $total =0;
	 $subtotal =0;
	 $grupo = "";
	do while (!$rs->EOF)
	{
//	   if($i_datos>=$row_ini and $i_datos<=($row_fin))
	   {
        $this->page = $currpage;
        // write the horizontal borders
		$this->Line($l,$h,$fullwidth+$l,$h); 
        // write the content and remember the height of the highest col

		define('ADODB_FETCH_NUM',1);
	    $ADODB_FETCH_MODE = ADODB_FETCH_NUM;
		
      $gp    = $rs->fields[14];    //	   $gp = trim(ora_getcolumn($this->cursor,14));
      $gp1   = $rs->fields[2]; //  $gp1 =trim(ora_getcolumn($this->cursor,2));
      $gptot = $rs->fields[13];	 //  $gptot = trim(ora_getcolumn($this->cursor,13));
	   $registro++;
	   if($gptot!=0)
		{		
        for($col=0;$col<$rs->FieldCount()-1;$col++) //  for($col=0;$col<ora_numcols($this->cursor)-1;$col++)
        {	
            $txt = $rs->fields[$col];	//$txt = ora_getcolumn ($this->cursor,$col);
  			if($col==2)  $txt .= $grupo;
			if($col==7)  $subtotal = $txt + $subtotal;
			if($col==13) $total = $txt + $total;			 
		    if($col==0  ) 
			{
			if ($rs->fields[0] == 1)  //	if( ora_getcolumn($this->cursor,0)==1)
			    {
				$rs->FetchInto(&$txt);			//	    $txt=$row; 
				}
			}
            $this->page = $currpage;
            $this->SetXY($l,$h); 
			// Aki se iimprimen los datos de la tabla.  por jhlosada
             $this->MultiCell($this->tablewidths[$col],$lineheight,$txt,0,$this->colAlign[$col]);
            $l += $this->tablewidths[$col];
            if($tmpheight[$row.'-'.$this->page] < $this->GetY()) {
                $tmpheight[$row.'-'.$this->page] = $this->GetY();
            }
            if($this->page > $maxpage)
                $maxpage = $this->page;
            unset($data[$col]);

        }
  
  	     if($registro>=30)   $this->Footer();			
	     // get the height we were in the last used page
         $h = $tmpheight[$row.'-'.$maxpage];
	     // set the "pointer" to the left margin
         $l = $this->lMargin;
         // set the $currpage to the last page
         $currpage = $maxpage;
		 unset($datas[$row]);
		 $row++ ;
		 $grupo = "";
		}else
			{
			    $grupo .= " $gp1 ";
			}				
        		$i_datos++;
		}
		$i_total++;
		$rs->MoveNext();
		}
//    }while($data=ora_fetch($this->cursor));
	   for($i=$i_datos;$i<=31;$i++)
	   { 
		$this->page = $currpage;
		$this->Line($l,$h,$fullwidth+$l,$h); 
       for($col=0;$col<$rs->FieldCount()-1;$col++)    //for($col=0;$col<ora_numcols($this->cursor)-1;$col++)
        {	

		    $txt = "";
			if($col==7)  $txt = $subtotal;
			if($col==13) $txt = $total;	
		    if($col==0) $rs->FetchInto(&$txt);		//$txt=$row; 
            $this->page = $currpage;
            $this->SetXY($l,$h); 
            $this->MultiCell($this->tablewidths[$col],$lineheight,'',0,$this->colAlign[$col]);
            $l += $this->tablewidths[$col];
            if($tmpheight[$row.'-'.$this->page] < $this->GetY()) {
                $tmpheight[$row.'-'.$this->page] = $this->GetY();
            }
            if($this->page > $maxpage)
                $maxpage = $this->page;
            unset($data[$col]);
        }	
		        $h = $tmpheight[$row.'-'.$maxpage];
	    // set the "pointer" to the left margin
        $l = $this->lMargin;
        // set the $currpage to the last page
        $currpage = $maxpage;
	 }
	    
	    $this->page = $currpage;
		$this->Line($l,$h,$fullwidth+$l,$h); 
       for($col=0;$col<$rs->FieldCount()-1;$col++) //for($col=0;$col<ora_numcols($this->cursor)-1;$col++)
        {	
		    $txt = "";
			if($col==7) $txt = $subtotal;
			if($col==13) $txt = $total;			
            $this->page = $currpage;
            $this->SetXY($l,$h); 
			
            $this->MultiCell($this->tablewidths[$col],$lineheight,$txt,0,$this->colAlign[$col]);
            $l += $this->tablewidths[$col];
            if($tmpheight[$row.'-'.$this->page] < $this->GetY()) {
                $tmpheight[$row.'-'.$this->page] = $this->GetY();
            }
            if($this->page > $maxpage)
                $maxpage = $this->page;
            unset($data[$col]);
        }
        // get the height we were in the last used page
        $h = $tmpheight[$row.'-'.$maxpage];
	    // set the "pointer" to the left margin
        $l = $this->lMargin;
        // set the $currpage to the last page
        $currpage = $maxpage;
	    $this->numrows = $i_total;
		
		        $this->page = $currpage;
        // write the horizontal borders
		$this->Line($l,$h,$fullwidth+$l,$h); 
        // write the content and remember the height of the highest col
        //foreach($data as $col => $txt) {
	}
    // draw the borders
    // we start adding a horizontal line on the last page
    $this->page = $maxpage;
    //$this->Line($l,$h,$fullwidth+$l,$h+50);
	$this->SetFont('Arial','',8);
    // now we start at the top of the document and walk down
    for($i = $startpage; $i <= $maxpage; $i++) {
        $this->page = $i;
        $l = $this->lMargin;
		
        $t = ($i == $startpage) ? $startheight : $this->tMargin;
        $lh = ($i == $maxpage) ? $h : $this->h-$this->bMargin;
        $this->Line($l,$t,$l,$lh);
        foreach($this->tablewidths as $width) {
            $l += $width;
            $this->Line($l,$t,$l,$lh);
        }
    }
    // set it to the last page, if not it'll cause some problems
    $this->page = $maxpage;
}
function connect($host='localhost',$username='',$passwd='',$db='$db'){
    include "../config.php";
//    $this->conn = $handle or die(ora_error());
//	$this->cursor = ora_open($handle); 
  $this->conn = $db;
    return true;
}
function query($query){
  
	$rs = $db->conn->Execute($query);
//    $this->results = ora_parse($this->cursor,$query);
//	$this->results = ora_exec($this->cursor);
//    $this->numFields = ora_numcols($this->cursor);
}
function oracle_report($query,$dump=false,$attr=array(),$head_table=array(),$head_table_size=array(),$file_pdf,$row_ini,$row_fin)
{
    foreach($attr as $key=>$val){
        $this->$key = $val ;
    }

    $this->query($query);

    // if column widths not set
    if(!isset($this->tablewidths)){
        // starting col width
		if($this->numFields == 0 )
		{
           $this->sColWidth = (($this->w-$this->lMargin-$this->rMargin));
		 }else
		 {
		    $this->sColWidth = (($this->w-$this->lMargin-$this->rMargin))/$this->numFields;
		 }
        // loop through results header and set initial col widths/ titles/ alignment
        // if a col title is less than the starting col width / reduce that column size
     		
        for($i=0;$i<$this->numFields-1;$i++){

           $stringWidth = $this->getstringwidth($rs->FetchField(i)) + 6 ;   // $stringWidth = $this->getstringwidth(Ora_ColumnName($this->cursor,$i)) + 6 ;
			$stringWidth = $head_table_size[$i];
			$this->sColWidth = $head_table_size[$i];
			$colFits[$i]  = $head_table_size[$i];
	            if( ($stringWidth) < $this->sColWidth){
                $colFits[$i] = $stringWidth ;
                // set any column titles less than the start width to the column title width
            }
            $this->colTitles[$i] =  $rs->FetchField($i)-1;  //Ora_ColumnName($this->cursor,$i)-1;
            $this->colTitles[$i] =$head_table[$i];
  		    $nombCampo = $rs->FetchField($i);
	        $tipoCampo = $rs->MetaType($nombCampo->type);

			switch ($tipoCampo){ //switch (Ora_ColumnType($this->cursor,$i)){
                case 'N': // case 'NUMBER':
                    $this->colAlign[$i] = 'R';
                    break;
                default:
                    $this->colAlign[$i] = 'L';
            }
        }
		foreach($colFits as $key=>$val){
            // set fitted columns to smallest size
            $this->tablewidths[$key] = $val ;
            // to work out how much (if any) space has been freed up
            $totAlreadyFitted += $val;
        }
        $surplus = (sizeof($colFits)*$this->sColWidth) - ($totAlreadyFitted);
		
        for($i=0;$i<$this->numFields-1;$i++){
            if(!in_array($i,array_keys($colFits))){
			    $this->sColWidth = $head_table_size[$i];
                $this->tablewidths[$i] = $this->sColWidth + ($surplus/(($this->numFields-1)-sizeof($colFits)));
            }
        }
        ksort($this->tablewidths);
        if($dump){
            Header('Content-type: text/plain');
            for($i=0;$i<$this->numFields-1;$i++){
            if(strlen($rs->FetchField(i))>$flength){  //if(strlen(Ora_ColumnName($this->cursor,$i))>$flength){
                $flength = strlen($rs->Fields[$i]);  //$flength = strlen(Ora_ColumnName($this->results,$i));
                }
            }
            switch($this->k){
                case 72/25.4:
                    $unit = 'millimeters';
                    break;
                case 72/2.54:
                    $unit = 'centimeters';
                    break;
                case 72:
                    $unit = 'inches';
                    break;
                default:
                    $unit = 'points';
            }
            print "All measurements in $unit\n\n";
            for($i=0;$i<$this->numFields-1;$i++){
/*
                printf("%-{$flength}s : %-10s : %10f\n",
                    Ora_ColumnName($this->results,$i),
                    Ora_ColumnType($this->results,$i),
                    $this->tablewidths[$i] );
*/					
                printf("%-{$flength}s : %-10s : %10f\n",
                    $rs->Fields[$i],                      
       		        $nombCampo = $rs->FetchField($i),
	                $tipoCampo = $rs->MetaType($nombCampo->type);
                    $this->tablewidths[$i] );

            }
            print "\n\n";
            print "\$pdf->tablewidths=\n\tarray(\n\t\t";
            for($i=0;$i<$this->numFields;$i++){
                ($i<($this->numFields-1)) ?
               print $this->tablewidths[$i].", /* ".$rs->FetchField(i)." */\n\t\t":      //   print $this->tablewidths[$i].", /* ".Ora_ColumnName($this->cursor,$i)." */\n\t\t":
               print $this->tablewidths[$i]." /* ".$rs->FetchField(i)." */\n\t\t";      //   print $this->tablewidths[$i]." /* ".Ora_ColumnName($this->cursor,$i)." */\n\t\t";
            }
            print "\n\t);\n";
            exit;
        }

    } else { // end of if tablewidths not defined
   for($i=0;$i<$this->numFields-1;$i++){
          $this->colTitles[$i] = $rs->FetchField(i) ; // $this->colTitles[$i] = Ora_ColumnName($this->cursor,$i) ;
    	
		    $nombCampo = $rs->FetchField($i);
	        $tipoCampo = $rs->MetaType($nombCampo->type);

	    switch ($tipoCampo){	//    switch (Ora_Columntype($this->cursor,$i)){
                case 'I':      // case 'int':
                    $this->colAlign[$i] = 'R';
                    break;
                default:
                    $this->colAlign[$i] = 'L';
            }
        }
    }
    //mysql_data_seek($this->cursor,0);
    $this->Open();
	$this->tMargin=50;
    $this->setY($this->tMargin);
	$this->AddPage();
    $this->morepagestable($this->FontSizePt+11,$query,$row_ini,$row_fin);
	
}
}


?> 
