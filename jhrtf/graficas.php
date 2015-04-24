<? 
# antialiased draw_line function 1.1 (faster)

# here is a drawLine() posted by nanobot at chipx86 dot com
# on php.net and enhanced/optimized by myself :)

# here are some changes i made:
# 1. changed for true-color images (no index_var used)
# 2. changed rgb extraction to logical shift
# 3. reducing function call's
function ImageGrid(&$im,$startx,$starty,$width,$height,$xcols,$yrows,&$color) {

for ( $x=0; $x < $xcols; $x++ ) {
   for ( $y=0; $y < $yrows; $y++ ) {
      $x1 = $startx + ($width * $x);
      $x2 = $startx + ($width * ($x+1));
      $y1 = $starty + ($height * $y);
      $y2 = $starty + ($height * ($y+1));
      ImageRectangle($im, $x1, $y1, $x2, $y2, $color);
   }
}

} // end function ImageGrid
Header("Content-type: image/png");
			$picWidth=360*2;
			$picHeight=200;
			$pic=ImageCreate($picWidth+1,$picHeight+1);
			$cWhite=ImageColorAllocate($pic,255,255,255);
			$cNegro=ImageColorAllocate($pic,0,0,0);
			ImageFilledRectangle($pic,0,0,$picWidth+1,$picHeight+1,$cWhite);
			ImageFilledRectangle($pic,0,0,$picWidth+1,$picHeight+1,$cNegro);
			$cRed=ImageColorAllocate($pic,255,0,0);
			$cBlue=ImageColorAllocate($pic,0,0,255);
			$cNegro=ImageColorAllocate($pic,0,0,0);
			$curX=0;
			$curY=$picHeight;
			ImagePNG($pic);
			ImageDestroy($pic);
?>
