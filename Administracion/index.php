<?php
  /**
    * Se adicion compatibilidad con variables globales en Off
    * @autor Jairo Losada 2009-05
    * @modificado por Cmauricio Parra
    * @licencia GNU/GPL V 3
    */
  
  session_start();

  include ('../config.php');
  include (SMARTY_TEMPLATE);
  foreach($_GET as $k=>$v) $$k=$v;

  $smarty = new Smarty();
  $smarty->template_dir = TEMPLATE_DIR;
  $smarty->compile_dir  = COMPILE_DIR;
  $smarty->cache_dir    = CACHE_DIR;
  
  $krd          = $_SESSION['krd'];
  $dependencia  = $_SESSION['dependencia'];
  $usua_doc     = $_SESSION['usua_doc'];
  $codusuario   = $_SESSION['codusuario'];
  $tip3Nombre   = $_SESSION['tip3Nombre'];
  $tip3desc     = $_SESSION['tip3desc'];
  $tip3img      = $_SESSION['tip3img'];
  $ruta_raiz    = '..';

  $nomcarpeta   = (isset($_GET['carpeta']))? $_GET['carpeta'] : null;
  $tipo_carpt   = (isset($_GET['tipo_carpt']))? $_GET['tipo_carpt'] : null;
  $adodb_next_page = (isset($_GET['adodb_next_page']))? $_GET['adodb_next_page'] : null;
  
  // Sin acceso a usuario que no sea administrador
  if($_SESSION['usua_admin_sistema'] != 1)
    die(include '../sinacceso.php');

  $enlace_usuarios      = './usuario/mnuUsuarios.php' . '?krd=' . $krd;
  $enlace_dependencias  = './tbasicas/adm_dependencias.php';
  $enlace_dias          = './tbasicas/adm_nohabiles.php';
  $enlace_envios        = '../bdcompleme/tar_env.php';
  $enlace_tablas        = './tbasicas/adm_tsencillas.php';
  $enlace_tipos         = './tbasicas/adm_trad.php' . '?krd=' . $krd;
  $enlace_paises        = './tbasicas/adm_paises.php';
  $enlace_deptos        = 'tbasicas/adm_dptos.php';
  $enlace_entidades     = 'tbasicas/adm_esp.php' . '?krd=' . $krd;
  $enlace_auditoria     = './auditoria/' . '?krd=' . $krd;
  $enlace_empresas      = 'entidad/listaempresas.php?' .
                          session_name() . '=' . session_id() .
                          '&krd=' . $krd;
  $enlace_funcionarios  = 'usuario/listafuncionarios.php?' . 
                          session_name() . '=' . session_id();
  $enlace_esp           = 'tbasicas/adm_esp.php'. '?' . 'krd=' . $krd;

  $smarty->assign('ENLACE_USUARIOS', $enlace_usuarios);
  $smarty->assign('ENLACE_DEPENDENCIAS', $enlace_dependencias);
  $smarty->assign('ENLACE_DIAS', $enlace_dias);
  $smarty->assign('ENLACE_ENVIOS', $enlace_envios);
  $smarty->assign('ENLACE_TABLAS', $enlace_tablas);
  $smarty->assign('ENLACE_TIPOS', $enlace_tipos);
  $smarty->assign('ENLACE_PAISES', $enlace_paises);
  $smarty->assign('ENLACE_DEPTOS', $enlace_deptos);
  $smarty->assign('ENLACE_ENTIDADES', $enlace_entidades);
  $smarty->assign('ENLACE_AUDITORIA', $enlace_auditoria);
  $smarty->assign('ENLACE_EMPRESAS', $enlace_empresas);
  $smarty->assign('ENLACE_FUNCIONARIOS', $enlace_funcionarios);
  $smarty->assign('ENLACE_ESP', $enlace_esp);
  $smarty->assign('ORFEO_URL', ORFEO_URL);

  $smarty->display('index_administracion.html');
?>
