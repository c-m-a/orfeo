<?php
  include ('../../config.php');
  include (SMARTY_TEMPLATE);

  $smarty = new Smarty();
  $smarty->template_dir = TEMPLATE_DIR;
  $smarty->compile_dir  = COMPILE_DIR;
  $smarty->cache_dir    = CACHE_DIR;

  session_start();
  
  if(!$_SESSION['dependencia'] or !$_SESSION['tpDepeRad'])
    include '../../rec_session.php';
  
  $enlace_translado = 'traslado.php' . $phpsession .
                      '&krd=' . $krd;
  

  $smarty->assign('ORFEO_URL', ORFEO_URL);
  $smarty->assign('ENLACE_TRANSLADO', $enlace_translado);
  $smarty->display('menu_usuarios.tpl');
?>
