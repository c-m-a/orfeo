<?php
  include('barcode/php-barcode.php');

  //                  PROPERTIES
  
  // download a ttf font here for example : http://www.dafont.com/fr/nottke.font
  $font     = './nottke.font';
  
  $fontSize = 10;   // GD1 in px ; GD2 in point
  $marge    = 10;   // between barcode and hri in pixel
  $x        = 110;  // barcode center
  $y        = 30;   // barcode center
  $height   = 50;   // barcode height in 1D ; module size in 2D
  $width    = 2;    // barcode height in 1D ; not use in 2D
  $angle    = 0;    // rotation in degrees : nb : non horizontable barcode might not be usable because of pixelisation
  
  $code     = '20145001234561'; // barcode, of course ;)
  $type     = 'ean13';
  
  //            ALLOCATE GD RESSOURCE
  $im     = imagecreatetruecolor(220, 63);
  $black  = ImageColorAllocate($im,0x00,0x00,0x00);
  $white  = ImageColorAllocate($im,0xff,0xff,0xff);
  $red    = ImageColorAllocate($im,0xff,0x00,0x00);
  $blue   = ImageColorAllocate($im,0x00,0x00,0xff);
  imagefilledrectangle($im, 0, 0, 300, 300, $white);
  
  //                      BARCODE
  $data = Barcode::gd($im, $black, $x, $y, $angle, $type, array('code'=>$code), $width, $height);
  
  // genera imagen
  imagepng($im, '/var/www/orfeo-3.8.0/bodega/tmp/barcode_images/test.png');
?>
<html>
  <head>
    <title></title>
    <base href="http://orfeo.supersolidaria.gov.co/">
  </head>
  <body>
    <img alt="imagen" src="./bodega/tmp/barcode_images/test.png" height="63" width="250">
  </body>
</html>
