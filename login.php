<?php
  /** 
   * OrfeoGPL
   * Es un Software Mantenido por la Fundacion sin Animo de Lucro Correlibre.org [http://correlibre.org]
   * Version 3.8.0 
   * Licencia GNU/GPL.
   *
   *
   * Formulario de login a orfeo
   * Aqui se inicia session 
   * @PHPSESID        String  Guarda la session del usuario
   * @db              Objeto  Objeto que guarda la conexion Abierta.
   * @iTpRad          int     Numero de tipos de Radicacion
   * @$tpNumRad       array   Arreglo que almacena los numeros de tipos de radicacion Existentes
   * @$tpDescRad      array   Arreglo que almacena la descripcion de tipos de radicacion Existentes
   * @$tpImgRad       array   Arreglo que almacena los iconos de tipos de radicacion Existentes
   * @query           String  Consulta SQL a ejecutar
   * @rs              Objeto  Almacena Cursor con Consulta realizada.
   * @numRegs         int     Numero de registros de una consulta
   */
  
  $ruta_raiz = '.';

  include('./config.php');
  include('./include/db/ConnectionHandler.php');
  include(SMARTY_TEMPLATE);
  
  $krd = (isset($_POST['krd']))? $_POST['krd'] : null;
  $drd = (isset($_POST['drd']))? $_POST['drd'] : null;
  
  // Enruta a login web para usuarios externos
  $usua_nuevo            = null;
  $fechah                = date('dmy') . '_' . time('hms');
  $serv                  = str_replace('.', '.', $_SERVER['REMOTE_ADDR']);
  $datos_envio           = $fechah . '&' .
                            session_name() . '=' . trim(session_id()) .
                            '&krd=' . $krd;
  $enviar_inicio         = 'Location: ' . ORFEO_URL;
  $arrancar_orfeo        = $enviar_inicio . 'index_frames.php?fechah=' . $datos_envio;
  
  $smarty = new Smarty();
  $krd    = strtoupper(trim($krd));
  
  if (isset($krd) && isset($drd)) {
    $db = new ConnectionHandler($ruta_raiz);
    $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
    $password = substr(md5($drd), 1, 26);
    
    //consulta para verificar si el usuario tiene acceso publico
    $sql_usu_ext = "SELECT USUA_NUEVO
                      FROM USUARIO
                      WHERE USUA_LOGIN ='$krd'";
                      
    $verifica_pass = " AND USUA_PASW = '$password'";
    
    $rs_usu_ext = $db->conn->query($sql_usu_ext);
    
    $usua_nuevo = ($rs_usu_ext)? $rs_usu_ext->fields['USUA_NUEVO'] : null;
    
    $sql_usu_ext = "SELECT COUNT(*) AS PASSWD_VALIDO
                      FROM USUARIO
                      WHERE USUA_LOGIN ='$krd'";
    
    $es_nuevo = $usua_nuevo != null && $usua_nuevo == ES_NUEVO;
    
    if ($es_nuevo) {
      header('Location: ' . ORFEO_URL . 'contrasena_usuario.php?krd=' . $krd);
      exit();
    } else {
      // Autenticar
      $rs_usu_ext = $db->conn->query($sql_usu_ext . $verifica_pass);
      $passwd_valido = $rs_usu_ext->fields['PASSWD_VALIDO'];
      
      if (!$passwd_valido) {
          $accion         = './login.php?fecha=' . $datos_envio;
          $smarty->assign('_ACCION', $accion);
          $smarty->display('login.tpl');
        exit();
      } else {
        // Autorizacion validad tiene acceso al sistema.
        include($ruta_raiz . '/session_orfeo.php');
        header($arrancar_orfeo);
        exit();
      }
    }
  }
  
  $accion         = './login.php?fecha=' . $datos_envio;
  $smarty->assign('_ACCION', $accion);
  $smarty->display('login.tpl');
?>
