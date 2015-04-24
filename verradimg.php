	<html>
	
	<?php 
	  $verradi = $verrad;
	  session_start();
	?>
  <frameset rows="149,*" cols="*" framespacing="3" frameborder="YES" border="4" frameborder="YES">
  <? $variables = session_name()."=".session_id()."&verrad=$verradi&fechah=$fechah&verrad=$verradi&carpeta=$carpeta&drde=$drde&krd=$krd&order=trte_codi"; ?>
  <frame src='verradicado.php?<?=$variables?>' name="topFrame2" scrolling="yes">
  	<?php   
	 IF (substr($urlimagen,0,7)!="bodega?")
		{
	       $ruta = "$urlimagen?verrad=$verrad&numrad=$verradi&verrad=$verradi&numrad=$verradi&"; 
		}else
		{
		   $ruta = "imagennodisponible.php?verrad=$verrad&numrad=$numrad&".session_name()."=".session_id();
		}	  
	?>
	<frame src='<?=$ruta ?>' name="mainFrame1">
</frameset>
<noframes>
</html>
