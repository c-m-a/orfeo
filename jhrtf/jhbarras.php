<?php
define('FPDF_FONTPATH','../fpdf/font/');
class barras
{
var $code;
function EAN13($x,$y,$barcode,$h=16,$w=.35,$archivo_jpg='')
{
    $this->Barcode($x,$y,$barcode,$h,$w,13,$archivo_jpg);
}

function UPC_A($x,$y,$barcode,$h=16,$w=.35)
{
    $this->Barcode($x,$y,$barcode,$h,$w,12);
}

function GetCheckDigit($barcode)
{
    //Compute the check digit
    $sum=0;
    for($i=1;$i<=11;$i+=2)
        $sum+=3*$barcode{$i};
    for($i=0;$i<=10;$i+=2)
        $sum+=$barcode{$i};
    $r=$sum%10;
    if($r>0)
        $r=10-$r;
    return $r;
}

function TestCheckDigit($barcode)
{
    //Test validity of check digit
    $sum=0;
    for($i=1;$i<=11;$i+=2)
        $sum+=3*$barcode{$i};
    for($i=0;$i<=10;$i+=2)
        $sum+=$barcode{$i};
    return ($sum+$barcode{12})%10==0;
}

function Barcode($x,$y,$barcode,$h,$w,$len,$archivo_jpg)
{
    //Padding
    $barcode=str_pad($barcode,$len-1,'0',STR_PAD_LEFT);
    if($len==12)
        $barcode='0'.$barcode;
    //Add or control the check digit
    if(strlen($barcode)==12)
        $barcode.=$this->GetCheckDigit($barcode);
    elseif(!$this->TestCheckDigit($barcode))
        $this->Error('Incorrect check digit');
    //Convert digits to bars
    $codes=array(
        'A'=>array(
            '0'=>'0001101','1'=>'0011001','2'=>'0010011','3'=>'0111101','4'=>'0100011',
            '5'=>'0110001','6'=>'0101111','7'=>'0111011','8'=>'0110111','9'=>'0001011'),
        'B'=>array(
            '0'=>'0100111','1'=>'0110011','2'=>'0011011','3'=>'0100001','4'=>'0011101',
            '5'=>'0111001','6'=>'0000101','7'=>'0010001','8'=>'0001001','9'=>'0010111'),
        'C'=>array(
            '0'=>'1110010','1'=>'1100110','2'=>'1101100','3'=>'1000010','4'=>'1011100',
            '5'=>'1001110','6'=>'1010000','7'=>'1000100','8'=>'1001000','9'=>'1110100')
        );
    $parities=array(
        '0'=>array('A','A','A','A','A','A'),
        '1'=>array('A','A','B','A','B','B'),
        '2'=>array('A','A','B','B','A','B'),
        '3'=>array('A','A','B','B','B','A'),
        '4'=>array('A','B','A','A','B','B'),
        '5'=>array('A','B','B','A','A','B'),
        '6'=>array('A','B','B','B','A','A'),
        '7'=>array('A','B','A','B','A','B'),
        '8'=>array('A','B','A','B','B','A'),
        '9'=>array('A','B','B','A','B','A')
        );
    $code='101';
    $p=$parities[$barcode{0}];
    for($i=1;$i<=6;$i++)
        $code.=$codes[$p[$i-1]][$barcode{$i}];
    $code.='01010';
    for($i=7;$i<=12;$i++)
        $code.=$codes['C'][$barcode{$i}];
    $code.='101';
	$this->code = $code;
/*  Aqui se genera la imagen del codigo de barras
 */
	error_reporting(7);
	$x=10;$y=10;$h=60;$w=2;
	$mensaje = "22";
	$ancho = 220; //$cuadro[2]-$cuadro[0]+15;
	$im = imagecreate($ancho,80);
	$oscuro = imagecolorallocate($im,0,0,0);
	$blanco = imagecolorallocate($im,255,255,255);
	$transparente = imagecolortransparent ($im, $blanco);
	imagefill($im,0,0,$transparente);
	for($i=0;$i<strlen($code);$i++)
		{
			if($code{$i}=='1')
				imagefilledrectangle($im,($i*$w)+$x,$y,($w+($i*$w))+$x,$y+$h,$oscuro);
		}
	
	imagepng($im,$archivo_jpg,100);
	imagedestroy($im);
 
}
function drawQSLine ($image,$x1,$y1,$x2,$y2,$r,$g,$b) {
$icr=$r;
$icg=$g;
$icb=$b;
 $dcol = ImageColorAllocate ($image,$icr,$icg,$icb);
 if ($y1 == $y2) imageline ($image,$x1,$y1,$x2,$y1,$dcol);
 else if ($x1 == $x2) { 
   imageline ($image,$x1,$y1,$x1,$y2,$dcol);
 } else {
 $m = ($y2 - $y1) / ($x2 - $x1);
 $b = $y1 - $m * $x1;

 if (abs ($m) <2) {

 $x = min ($x1,$x2);
 $endx = max ($x1,$x2)+1;

 while ($x < $endx) {
 $y=$m * $x + $b;
 $y == floor ($y) ? $ya = 1 : $ya = $y - floor ($y);
 $yb = ceil ($y) - $y;
 
 $trgb = ImageColorAt($image,$x,floor($y));
 $tcr = ($trgb >> 16) & 0xFF;
 $tcg = ($trgb >> 8) & 0xFF;
 $tcb = $trgb & 0xFF;
 imagesetpixel ($image,$x,floor ($y),imagecolorallocate ($image,($tcr * $ya + $icr * $yb),
($tcg * $ya + $icg * $yb),
($tcb * $ya + $icb * $yb)));

 $trgb = ImageColorAt($image,$x,ceil($y));
 $tcr = ($trgb >> 16) & 0xFF;
 $tcg = ($trgb >> 8) & 0xFF;
 $tcb = $trgb & 0xFF;
 imagesetpixel ($image,$x,ceil ($y),imagecolorallocate ($image,($tcr * $yb + $icr * $ya),
($tcg * $yb + $icg * $ya),
($tcb * $yb + $icb * $ya)));

 $x ++;
 } # while_x_end
 } # if_end
 else { # else_abs_end

 $y = min ($y1,$y2);
 $endy = max ($y1,$y2)+1;

 while ($y < $endy) {
 $x=($y - $b) / $m;
 $x == floor ($x) ? $xa = 1 : $xa = $x - floor ($x);
 $xb = ceil ($x) - $x;

 $trgb = ImageColorAt($image,floor($x),$y);
 $tcr = ($trgb >> 16) & 0xFF;
 $tcg = ($trgb >> 8) & 0xFF;
 $tcb = $trgb & 0xFF;
 imagesetpixel ($image,floor ($x),$y,imagecolorallocate ($image,($tcr * $xa + $icr * $xb),
($tcg * $xa + $icg * $xb),
($tcb * $xa + $icb * $xb)));

 $trgb = ImageColorAt($image,ceil($x),$y);
 $tcr = ($trgb >> 16) & 0xFF;
 $tcg = ($trgb >> 8) & 0xFF;
 $tcb = $trgb & 0xFF;
 imagesetpixel ($image,ceil ($x),$y,imagecolorallocate ($image, ($tcr * $xb + $icr * $xa),
($tcg * $xb + $icg * $xa),
($tcb * $xb + $icb * $xa)));

 $y ++;
 }# while_y_end
 }# else_abs_end
 }# else_y=y_x=x_end
}# drawOSLine_end
}


$a = new barras;
$a->EAN13(100,180,"798021200001",'','',"../bodega/2003/900/docs_rad/cod_barras/79802120.jpg");
?>

