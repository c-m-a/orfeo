<?php
  session_start();
  
  include('./config.php');
  include(SMARTY_TEMPLATE);

  $smarty = new Smarty();
  $smarty->template_dir = TEMPLATE_DIR;
  $smarty->compile_dir  = COMPILE_DIR;
  $smarty->cache_dir    = CACHE_DIR;
  
  $plan_rec_finan   = 'Plantillas/RecursosFinancierosSecretariaGeneral/';
  $plan_financiera  = 'Plantillas/financiera/';
  $ruta_plantillas  = 'Plantillas/';
  $enlace_descargar = './descargar_archivo.php?ruta_archivo=' . $ruta_plantillas;
  $enlace_financieros = './descargar_archivo.php?ruta_archivo=' . $plan_rec_finan;
  $enlace_financiera = './descargar_archivo.php?ruta_archivo=' . $plan_financiera;
  
  $smarty->assign('ENLACE_DESCARGAR', $enlace_descargar);
  $smarty->assign('ORFEO_URL', ORFEO_URL);
  $smarty->assign('ENLACE_FINANCIEROS', $enlace_financieros);
  $smarty->assign('ENLACE_FINANCIERA', $enlace_financiera);

  $smarty->display('plantillas_documentos.tpl');
?>
