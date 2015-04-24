
<?php
error_reporting(7); 
$k_localizacion++;
class BD {
 var $campo;
  
  function BD($consulta,$no_campo,$ruta_raiz) {
	  if($consulta)
	  {
	  $isql = $consulta;
	  if (!$ruta_raiz) $ruta_raiz=".";
   	  include "$ruta_raiz/config.php";
	  error_reporting(0);
      $cursor1 = ora_open($handle);
      ora_parse($cursor1,$isql) ;
	  ora_exec($cursor1);
      ora_fetch($cursor1);
	  $dato=trim(ora_getcolumn($cursor1, $no_campo));
	  $this->campo=$dato;
	  }else
	  {
	  $this->campo=""; 
	  }
   }
}


?>
