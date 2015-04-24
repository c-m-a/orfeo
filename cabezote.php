<?php
  session_start();
  include('./config.php');
  include(SMARTY_TEMPLATE);
  
  $krd        = $_SESSION['krd'];
  $dependencia= $_SESSION['dependencia'];
  $usua_doc   = $_SESSION['usua_doc'];
  $codusuario = $_SESSION['codusuario'];
  $tip3Nombre = $_SESSION['tip3Nombre'];
  $tip3desc   = $_SESSION['tip3desc'];
  $tip3img    = $_SESSION['tip3img'];
  $fechah     = date('Ymdhms');
  $date_session = date('Ymdhms');
  $ruta_raiz  = '.';
  
  $smarty = new Smarty();
  $smarty->template_dir = TEMPLATE_DIR;
  $smarty->compile_dir  = COMPILE_DIR;
  $smarty->cache_dir    = CACHE_DIR;
  
  $contrasena_url = './contrasena_usuario.php';

  $cerrar_session = './cerrar_session.php' .
                    '?'. session_name() . '=' .
                    session_id() .
                    '&fechah=' . $fechah;
  
  $modificar = './mod_datos.php' . '?'. 
                session_name() . '=' . session_id() .
                '&fechah=' . $fechah .
                '&krd=' . $krd .
                '&info=false';
  
  $creditos = './menu/creditos.php' . '?' .
                session_name() . '=' . session_id() .
                '&fechah=' . $fechah .
                '&krd='. $krd .
                '&info=false';

  $estadisticas = './estadisticas/vistaFormConsulta.php' . '?' .
                    session_name() . '=' . session_id() .
                    '&fechah=' . $fechah;

  $smarty->assign('CONTRASENA_URL', $contrasena_url);
  $smarty->assign('CERRAR_SESSION', $cerrar_session);
  $smarty->assign('MODIFICAR',      $modificar);
  $smarty->assign('CREDITOS',       $creditos);
  $smarty->assign('ESTADISTICAS',   $estadisticas);
  $smarty->assign('DATE_SESSION',   $date_session);

  $smarty->display('cabezote.tpl');
?>
