<?php
  include('./config.php');
  include(SMARTY_TEMPLATE);

  $smarty = new Smarty();
  $smarty->template_dir = TEMPLATE_DIR;
  $smarty->compile_dir  = COMPILE_DIR;
  $smarty->cache_dir    = CACHE_DIR;
  
  $css_viewerjs = VIEWERJS . 'viewer.css';
  $js_viewerjs  = VIEWERJS . 'viewer.js';
  $loader       = VIEWERJS . 'PluginLoader.js';
  
  $smarty->assign('CSS_VIEWERJS', $css_viewerjs);
  $smarty->assign('JS_VIEWERJS', $js_viewerjs);
  $smarty->assign('LOADER', $loader);

  $smarty->display('viewerjs.tpl');
?>
