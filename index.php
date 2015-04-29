<?php
  if (is_file('./config.php')) {
    include ('login.php');
    //include ('mantenimiento.php');
  } else {
    //include ('./config.php');
    $nombre_servidor  = $_SERVER['SERVER_NAME'];
    $directorio_app   = 'instalador/';
    $protocolo        = $_SERVER['REQUEST_SCHEME'];
    $url_orfeo        = $protocolo . '://' . $nombre_servidor . $_SERVER['REQUEST_URI'] . $directorio_app;
    header ('Location: ' . $url_orfeo);
    exit();
  }
?>
