<?php
  include('./config.php');
  
  $ruta_archivo   = (isset($_GET['ruta_archivo']))? $_GET['ruta_archivo'] : null;
  $nombre_archivo = (isset($_GET['nombre_archivo']))? $_GET['nombre_archivo'] : null;
  $ruta_archivo   = ORFEO_PATH . $ruta_archivo;
  $preg_result    = preg_match('/\.[a-z]+/', $nombre_archivo, $extension_result);
  $tipo_archivo	  = ltrim($extension_result[0], '.');
  
  header('Pragma: public');
  header('Expires: 0');
  header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
  header('Cache-Control: private', false); // required for certain browsers 
  header('Content-Type: application/' . $tipo_archivo);
  header('Content-Disposition: attachment; filename="'. $nombre_archivo . '";');
  header('Content-Transfer-Encoding: binary');
  header('Content-Length: ' . filesize($ruta_archivo));
  
  // Se puede utilizar la funcion readfile o tambien fopen
  //readfile($filename);
  //$fp = fopen($ruta_archivo, 'rb');
  //fpassthru($fp);
  readfile($ruta_archivo);
  exit();
?>
