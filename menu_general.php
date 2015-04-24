<?php
  /*
   * Modifica por Cmauricio Parra email: cmauriciop@yahoo.com.mx
   *    http://cmauricio.org/orfeo4
   */
  
  include('./config.php');
  include(SMARTY_TEMPLATE);
  
  session_start();
  
  $smarty = new Smarty();
  $smarty->template_dir = TEMPLATE_DIR;
  $smarty->compile_dir  = COMPILE_DIR;
  $smarty->cache_dir    = CACHE_DIR;
  
  foreach ($_GET as $key => $valor)
    ${$key} = $valor;
  foreach ($_POST as $key => $valor)
    ${$key} = $valor;
  
  $tipo_carp = (isset($_GET['tipo_carp']))? $_GET['tipo_carp'] : null;
  $carpetano = (isset($_GET['carpetano']))? $_GET['carpetano'] : null;
  
  $krd          = (isset($_SESSION['krd']))? $_SESSION['krd'] : null;
  $dependencia  = (isset($_SESSION['dependencia']))? $_SESSION['dependencia'] : null;
  $usua_doc     = (isset($_SESSION['usua_doc']))? $_SESSION['usua_doc'] : null;
  $codusuario   = (isset($_SESSION['codusuario']))? $_SESSION['codusuario'] : null;
  $tip3Nombre   = (isset($_SESSION['tip3Nombre']))? $_SESSION['tip3Nombre'] : null;
  $tip3desc     = (isset($_SESSION['tip3desc']))? $_SESSION['tip3desc'] : null;
  $tip3img      = (isset($_SESSION['tip3img']))? $_SESSION['tip3img'] : null;
  $tpNumRad     = (isset($_SESSION['tpNumRad']))? $_SESSION['tpNumRad'] : null;
  $tpPerRad     = (isset($_SESSION['tpPerRad']))? $_SESSION['tpPerRad'] : null;
  $tpDescRad    = (isset($_SESSION['tpDescRad']))? $_SESSION['tpDescRad'] : null;
  $tip3Nombre   = (isset($_SESSION['tip3Nombre']))? $_SESSION['tip3Nombre'] : null;
  $ESTILOS_PATH = (isset($_SESSION['ESTILOS_PATH']))? $_SESSION['ESTILOS_PATH'] : null;
  $ruta_raiz    = '.';

  // Valida para mandar al usuario a otra direccion
  $listar_radicados = './bandeja_radicados.php';
  
  if (empty($_SESSION['dependencia']))
    include('./rec_session.php');
  
  $carpeta = $carpetano;
  
  include('./include/db/ConnectionHandler.php');
  $db = new ConnectionHandler($ruta_raiz);
  $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
  
  $ruta_estilos = $ruta_raiz . ORFEO_ESTILOS;

	$enlace_cuerpo = $listar_radicados . '?' .
                    session_name() . '=' . session_id() .
                    '&krd=' . $krd .
                    '&ascdesc=desFc';
  
  // transacciones del cursor de consulta primaria
  // Coloca de direccion ip del equipo desde el cual se esta entrando a la pagina.
  $logo = (!$db->imagen())? 'logoEntidad.gif' : $db->imagen();
  $direccion_ip = $_SERVER['REMOTE_ADDR'];
  
  $smarty->assign('ORFEO_URL', ORFEO_URL);
  $smarty->assign('LOGO', $logo);
  $smarty->assign('DIRECCION_IP', $direccion_ip);
  $smarty->assign('RUTA_ESTILOS', $ruta_estilos);
  $smarty->assign('USUA_DOC', $usua_doc);
  $smarty->assign('KRD', $krd);
  $smarty->assign('ENLACE_CUERPO', $enlace_cuerpo);
  $smarty->assign('ENLACE_MENU_GENERAL', './menu_general.php');
  
  $fechah  = date("dmy") . "_" . time("hms");
  $carpeta = $carpetano;
  
  // Cambia a Mayuscula el login-->krd -- Permite al usuario escribir su login en mayuscula o Minuscula
  $numeroa = 0;
  $numero  = 0;
  $numeros = 0;
  $numerot = 0;
  $numerop = 0;
  $numeroh = 0;
  $fechah  = date('dmy') . time('hms');
  
  //Realiza la consulta del usuarios y de una vez cruza con la tabla dependencia
  $isql    = "SELECT A.*,
                      B.DEPE_NOMB
                FROM USUARIO A,
                    DEPENDENCIA B
                 WHERE A.DEPE_CODI = B.DEPE_CODI
                 AND USUA_LOGIN ='$krd' ";
  
  $rs         = $db->conn->query($isql);
  $phpsession = session_name() . '=' . session_id();

  $es_usuario = trim($rs->fields['USUA_LOGIN']) == trim($krd);
  $smarty->assign('ES_USUARIO', $es_usuario);
  
  // Valida Login y contrasena encriptada con funcion md5()
  if ($es_usuario) {
    $contraxx = $rs->fields["USUA_PASW"];
    if (trim($contraxx)) {
      $codusuario      = $rs->fields["USUA_CODI"];
      $dependencianomb = $rs->fields["DEPE_NOMB"];
      $fechah          = date("dmy") . "_" . time("hms");
      $contraxx        = $rs->fields["USUA_PASW"];
      $nivel           = $rs->fields["CODI_NIVEL"];
      $iusuario        = " and us_usuario='$krd'";
      $perrad          = $rs->fields["PERM_RADI"];
      
      // Si el usuario tiene permiso de radicar el prog. muestra los iconos de radicacion
      include ('./menu/menuPrimero.php');
      include ('./menu/radicacion.php');
      include ('./menu/bandejas.php');
      include ('./menu/agendados.php');
      include ('./menu/informados.php');
      include ('./menu/historico.php');
      include ('./menu/carpetas.php');
    }

    $smarty->display('menu_general.tpl');
  }
?>
