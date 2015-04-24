<?php
  include ('./config.php');
  include (SMARTY_TEMPLATE);
  include_once ('./include/db/ConnectionHandler.php');
  
  session_start();
  
  // Inicializando motor de plantillas
  $smarty = new Smarty();
  $smarty->template_dir = TEMPLATE_DIR;
  $smarty->compile_dir  = COMPILE_DIR;
  $smarty->cache_dir    = CACHE_DIR;
  $smarty->caching      = 0;
  
  $krd          = (isset($_SESSION["krd"]))? $_SESSION["krd"] : null;
  $dependencia  = $_SESSION["dependencia"];
  $usua_doc     = $_SESSION["usua_doc"];
  $nombre_servidor = $_SERVER['SERVER_NAME'];
  $enlace       = array();

  if ($krd == 'ADMIN3')
    $navegador = get_browser(null, true);

  $usuarios = array();
  $usuarios[] = 'ADMON';
  $usuarios[] = 'OCSES3';
  $usuarios[] = 'OCSES4';
  $usuarios[] = 'OCSES5';
  $usuarios[] = 'OCSES6';
  $usuarios[] = 'OCSES7';
  $usuarios[] = 'OCSES8';
  $usuarios[] = 'OCSES9';
  
  $archivos = array();
  $archivos[] = 'tif';
  $archivos[] = 'pdf';

  $es_usuario = in_array($krd, $usuarios);
  
  $permitir_descarga = PERM_DESCARGAR_ARCHIVO;
  $no_permitir = $permitir_descarga && $es_usuario;

  if (empty($krd))
    die('Error en la session del sistema por ingrese de nuevo');
  
  $db = new ConnectionHandler('.');
  $db->conn->SetFetchMode(3);
  
  $from = (isset($_GET['from']))? $_GET['from'] : 0;

  // Variable para grabar descripcion del acceso al radicado
  $auditoria_arreglo = array('radicado'    => null,
                              'asunto'     => null,
                              'usua_login' => null,
                              'unix_time'  => null,
                              'ip_cliente' => null);
 
  $radi_nume_radi = (isset($_GET['radicado']))? trim($_GET['radicado']) : null;
  
  // Se busca el numero del radicado en el nombre del archivo si esta vacio
  if (empty($radi_nume_radi) && isset($_GET['nombre_archivo'])) {
    $radi_nume_radi = trim($_GET['nombre_archivo']);
    $encontro_numero  = preg_match('/[0-9]+/', $radi_nume_radi, $arreglo_numeros);
    $radi_nume_radi   = ($encontro_numero)? $arreglo_numeros[0] : null;
  }
  
  // Variable que controla la activacion de la grabacion de la auditoria.
  $activar_auditoria = $from == 'consulta' || $from == null;
  $es_bandeja        = $activar_auditoria == false;
  $activar_auditoria = $activar_auditoria && empty($menu_ver_tmp);
  $activar_auditoria = $activar_auditoria && $krd != USUARIO_AUDITOR;
  
  // Sentencia para grabar consulta de radicados
  $desde_donde  = $enlaces[$from];
  $unix_time    = time();
  
  $sql_asunto   = "SELECT RA_ASUN
                    FROM RADICADO
                    WHERE RADI_NUME_RADI = $radi_nume_radi";

  $rs_asunto    = $db->conn->Execute($sql_asunto);

  if (!$rs_asunto->EOF)
    $asunto_radicado = $rs_asunto->fields["RA_ASUN"];
  
  $ip_cliente   = $_SERVER['REMOTE_ADDR'];

  $auditoria_arreglo['desde_donde'] = $desde_donde;
  $auditoria_arreglo['usua_login']  = $krd;
  $auditoria_arreglo['unix_time']   = $unix_time;
  $auditoria_arreglo['radicado']    = $radi_nume_radi;
  $auditoria_arreglo['asunto']      = $asunto_radicado;
  $auditoria_arreglo['ip_cliente']  = $ip_cliente;

  $auditoria_json   = json_encode($auditoria_arreglo);
  
  $sql_insert   = "INSERT INTO SGD_AUDITORIA VALUES('$usua_doc',
                                                    'do',
                                                    'RADICADO',
                                                    '$auditoria_json',
                                                    $unix_time,
                                                    '$ip_cliente',
                                                    '$radi_nume_radi')";
  
  if ($activar_auditoria)
    $db->conn->Execute($sql_insert);
  
  // Codigo para descargar la imagen del sistema.
  $orfeo_path     = BODEGA_ORFEO;
  $ruta_archivo   = (isset($_GET['ruta_archivo']))? $_GET['ruta_archivo'] : null;
  $nombre_archivo = (isset($_GET['nombre_archivo']))? $_GET['nombre_archivo'] : null;
  $ruta_archivo_completa = $orfeo_path . $ruta_archivo;
  $preg_result    = preg_match('/\.[a-z]+/', $nombre_archivo, $extension_result);
  
  $tipo_archivo	  = ltrim($extension_result[0], '.');
  $archivo_pdf    = '';
  $convert_cmd    = '/usr/bin/convert ';
  $exec_identify  = '/usr/bin/identify ' . $ruta_archivo_completa;
  $numero_paginas = 0;
  $tipo_archivo_salida = '.pdf';

  exec($exec_identify, $exec_output, $exec_return);
  $numero_paginas = count($exec_output) + 1;

  $extension_permitida = in_array($tipo_archivo, $archivos);

  if ($no_permitir) {
    if ($extension_permitida) {
      $ruta_archivo_pdf = str_replace('.' . $tipo_archivo, $tipo_archivo_salida, $ruta_archivo_completa);
      $nombre_archivo_pdf = str_replace('.' . $tipo_archivo, $tipo_archivo_salida, $ruta_archivo);
      $ls_pdf = 'ls ' . $ruta_archivo_pdf;
      
      // Verifica si existe el archivo primero para no realizar la conversion de nuevo
      exec($ls_pdf, $ls_output, $ls_return);
      $existe_pdf = (count($ls_output))? true : false;
      
      // Si la salida puede ser una imagen
      $exec_convert = $convert_cmd . $ruta_archivo_completa . ' ' . $ruta_archivo_pdf;
      
      // Si existe el no lo convierta de nuevo a pdf
      exec($exec_convert, $exec_output, $exec_return);
      
      if (is_file($ruta_archivo_pdf)) {
        $asunto_radicado = (empty($asunto_radicado))? 'Sin Asunto' : $asunto_radicado;
        $nombre_archivo = $nombre_archivo_pdf;
        $ruta_archivo = $ruta_archivo_pdf;
        $tipo_archivo = $tipo_archivo_salida;
        $url_pdf = URL_BODEGA . $nombre_archivo;
        $smarty->assign('RADI_NUME_RADI', $radi_nume_radi);
        $smarty->assign('ASUNTO_RADICADO', $asunto_radicado);
        $smarty->assign('URL_PDF', $url_pdf);
        $smarty->display('pdf_touch.tpl');
        exit();
      }
    }
  }

  if (is_file($ruta_archivo_completa)) {
    header('Pragma: public');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Cache-Control: private', false); // required for certain browsers 
    header('Content-Type: application/' . $tipo_archivo);
    header('Content-Disposition: attachment; filename="'. $nombre_archivo . '";');
    header('Content-Transfer-Encoding: binary');
    header('Content-Length: ' . filesize($ruta_archivo_completa));
  } else {
    exit('Error al cargar la imagen del radicado, no existe, por favor comunicar este error al administrador del sistema');
  }
  
  readfile($ruta_archivo_completa);
  exit();
?>
