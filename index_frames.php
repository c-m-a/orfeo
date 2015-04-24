<?php
  include ('./config.php');
  include (SMARTY_TEMPLATE);
  $fechah = (isset($_GET['fechah']))? $_GET['fechah'] : null;
  $usuario = strtoupper($_GET['krd']);

  session_start();
  $ruta_raiz = '.';
  $smarty = new Smarty();
  $smarty->template_dir = TEMPLATE_DIR;
  $smarty->compile_dir  = COMPILE_DIR;
  $smarty->cache_dir    = CACHE_DIR;

  $vars_session = session_name() . '=' . session_id() . '&fechah=' . $fechah;
  $encabezado   = 'cabezote.php?' . $vars_session;
  $menu_izq     = 'menu_general.php?' . $vars_session;
  $dashboard    = 'alertas/index.php?' . $vars_session . '&tipo_alerta=1';

  $smarty->assign('ENCABEZADO', $encabezado);
  $smarty->assign('MENU_IZQ', $menu_izq);
  $smarty->assign('DASHBOARD', $dashboard);
  $smarty->display('index_frames.tpl');
?>
