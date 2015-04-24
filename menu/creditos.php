<?php
  include('../config.php');
  include(SMARTY_TEMPLATE);

  $smarty = new Smarty();
  $smarty->template_dir = TEMPLATE_DIR;
  $smarty->compile_dir  = COMPILE_DIR;
  $smarty->cache_dir    = CACHE_DIR;
  
  $smarty->assign('NOMBRE_SW', NOMBRE_SW);
  $smarty->assign('VERSION',    VERSION);
  
  $smarty->display('creditos.tpl');
?>
