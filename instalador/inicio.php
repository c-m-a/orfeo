<?php
  $smarty->assign('NOMBRE_APP',     NOMBRE_APP);
  $smarty->assign('URL_APP',        $url_app);
  $smarty->assign('VERSION_APP',    VERSION_APP);
  $smarty->assign('BOOTSTRAP_CSS',  BOOTSTRAP_CSS);
  $smarty->assign('BOOTSTRAP_JS',   BOOTSTRAP_JS);
  $smarty->assign('JQUERY',         JQUERY);
  $smarty->display('inicio_instalador.tpl');
?>
