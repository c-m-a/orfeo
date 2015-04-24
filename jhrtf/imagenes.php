<?
$mensaje = "22";
$ancho = 300; //$cuadro[2]-$cuadro[0]+15;
$im = imagecreate($ancho,200);
$verde = imagecolorallocate($im,192,200,95);
$oscuro = imagecolorallocate($im,999,999,999);
$transparente = imagecolortransparent ($im, $verde);
imagefill($im,0,0,$transparente);
imagefilledrectangle($im,$ancho/2-1,0,$ancho/2+10,3,$oscuro);
imagepng($im);
imagedestroy($im);
?>
