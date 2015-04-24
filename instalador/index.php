<?php

  if (is_file('../config.inc.php'))
    exit('Orfeo ya se encuentra instalado');

  // Nombre Applicacion
  define ('NOMBRE_APP', 'Orfeo Plus');
  define ('VERSION_APP', '4.0.0');

  // Revision del sistema operativo
  define ('DISTRIB_ID',       '/DISTRIB_ID=[a-zA-Z]+/');
  define ('DISTRIB_RELEASE',  '/DISTRIB_RELEASE=14.04/');
  define ('DIR_ORFEO',        rtrim(__DIR__, 'instalador'));
  define ('MIN_VER_DEBIAN',   '/7/');
  define ('MIN_VER_UBUNTU',   '/14.04/');
  define ('MIN_VER_REDHAT',   '/9/');
  define ('MIN_VER_CENTOS',   '/9/');
  
  // Configuracion bootstrap
  define ('BOOTSTRAP_CSS',    '../js/bootstrap/css/bootstrap.css');
  define ('BOOTSTRAP_JS',     '../js/bootstrap/js/bootstrap.min.js');
  define ('BOOTSTRAP_WIZARD', '../bootstrap/js/bootstrap.min.js');
  define ('JQUERY',           'http://code.jquery.com/jquery-latest.js');
  
  // Configuracion motor de plantillas Smarty
  define('SMARTY_TEMPLATE', DIR_ORFEO . '/include/Smarty/libs/Smarty.class.php');
  define('TEMPLATE_DIR',    DIR_ORFEO . '/templates');
  define('COMPILE_DIR',     DIR_ORFEO . '/templates_c');
  define('CACHE_DIR',       DIR_ORFEO . '/cache');

  include (SMARTY_TEMPLATE);

  $sistemas_operativos = array('./script_ubuntu.php'   => 'Ubuntu',
                                './script_debian.php'   => 'Debian',
                                './script_readhat.php'  => 'RedHat',
                                './script_centos.php'   => 'Centos');  
  
  $estados = array( 0 => './inicio.php',
                    1 => './requerimientos.php',
                    2 => './base_de_datos.php',
                    3 => './instalacion.php',
                    4 => './configuracion.php',
                    5 => './finalizacion.php');

  $smarty = new Smarty();
  
  $smarty->template_dir = TEMPLATE_DIR;
  $smarty->compile_dir  = COMPILE_DIR;
  $smarty->cache_dir    = CACHE_DIR;
  
  // Datos Servidor
  $nombre_servidor  = $_SERVER['SERVER_NAME'];
  $directorio_app   = rtrim($_SERVER['REQUEST_URI'], 'instalador/');
  $protocolo        = $_SERVER['REQUEST_SCHEME'];
  $url_app          = $protocolo . '://' . $nombre_servidor . $directorio_app . '/';

  $estado = (isset($_GET['estado']))? $_GET['estado'] : 0;
  
  if (isset($estado)) {
    $archivo_proceso = $estados[$estado];
    $existe_archivo = is_file($archivo_proceso);

    if ($existe_archivo) {
      include ($archivo_proceso);
    } else {
      var_dump($archivo_proceso);
      exit('No existe archivo para continuar el proceso de intalacion');
    }
  }
  // Revision de las librerias de php.
  // Configuracion de las bases de datos.
  // Configuracion extras.
?>
