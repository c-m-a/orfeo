<?php
  include('./config.php');
  include('./include/db/ConnectionHandler.php');
  
  session_start();
  
  $consulta_anexos   = '';
  $cadena_archivos   = '';
  $arreglo_radicados = array();
  $arreglo_anexos    = array();
  $i = 0;
  
  $db = new ConnectionHandler('.');
  $db->conn->SetFetchMode(3);
  
  $krd        = (isset($_SESSION["krd"]))? $_SESSION["krd"] : null;
  $dependencia= $_SESSION["dependencia"];
  $usua_doc   = $_SESSION["usua_doc"];
  $from               = (isset($_GET['from']))? $_GET['from'] : 0;
  $numero_expediente  = (isset($_GET['numero_expediente']))? $_GET['numero_expediente'] : null;

  if (empty($krd))
    die('Error en la session del sistema por favor ingrese de nuevo');

  $consulta_radicados = "SELECT R.RADI_NUME_RADI, 
                                a.RADI_PATH
                            FROM RADICADO a, 
                                SGD_TPR_TPDCUMENTO c, 
                                SGD_EXP_EXPEDIENTE r
                                LEFT JOIN SGD_PRD_PRCDMENTOS PRD ON PRD.SGD_PRD_CODIGO = r.SGD_PRD_CODIGO
                                LEFT JOIN SGD_PRC_PROCESO PRC ON PRC.SGD_PRC_CODIGO = PRD.SGD_PRC_CODIGO
                            WHERE
                                r.sgd_exp_numero = '$numero_expediente' and
                                r.radi_nume_radi = a.radi_nume_radi and
                                a.tdoc_codi = c.sgd_tpr_codigo AND
                                r.SGD_EXP_ESTADO <> 2
                            ORDER BY a.radi_fech_radi desc";

  if (isset($numero_expediente)) {
    $rs_radicados_exp = $db->conn->Execute($consulta_radicados);
    
    while (!$rs_radicados_exp->EOF) {
      $arreglo_radicados[$i]['numero_radicado'] = $rs_radicados_exp->fields['RADI_NUME_RADI'];
      $arreglo_radicados[$i]['ruta_radicado'] = trim($rs_radicados_exp->fields['RADI_PATH']);
      $arreglo_radicados[$i]['es_archivo'] = is_file(BODEGA_ORFEO . $arreglo_radicados[$i]['ruta_radicado']);
      $i++;
      $rs_radicados_exp->MoveNext();
    }
    
    $i = 0;
    
    foreach ($arreglo_radicados as $radicado) {
      $numero_radicado  = $radicado['numero_radicado'];
      $consulta_anexos  = "SELECT ANEX_CODIGO,
                                   ANEX_NOMB_ARCHIVO
                              FROM ANEXOS WHERE ANEX_BORRADO <> 'S' AND
                              ANEX_RADI_NUME = " . $numero_radicado;
      
      $rs_anexos = $db->conn->Execute($consulta_anexos);
      
      while (!$rs_anexos->EOF) {
        $arreglo_anexos[$i]['numero_anexo'] = $rs_anexos->fields['ANEX_CODIGO'];
        $arreglo_anexos[$i]['nombre_completo_archivo'] = $rs_anexos->fields['ANEX_NOMB_ARCHIVO'];
        $ruta_anexo = BODEGA_ORFEO .
                      substr($numero_radicado, 0, 4) . '/' .
                      substr($numero_radicado, 4, LONGITUD_DEPENDENCIA) . '/docs/' .
                      $arreglo_anexos[$i]['nombre_completo_archivo'];
        
        $existe_anexo = is_file($ruta_anexo);
        $arreglo_anexos[$i]['ruta_anexo'] = ($existe_anexo)? $ruta_anexo : null;
        
        $i++;
        $rs_anexos->MoveNext();
      }
    }

    
    // Busqueda de los archivos asociados al expediente en la bodega
    // Para radicados
    foreach ($arreglo_radicados as $radicado) {
      $es_archivo = $radicado['es_archivo'];
      
      if ($es_archivo)
        $cadena_archivos .= BODEGA_ORFEO . ltrim($radicado['ruta_radicado'], '/') . ' ';

    }
    
    foreach ($arreglo_anexos as $anexo) {
      if ($anexo['ruta_anexo'])
        $cadena_archivos .= $anexo['ruta_anexo'] . ' ';
    }
    
    $cadena_archivos     = trim($cadena_archivos);
    $nombre_archivo_zip = $numero_expediente . '-' . time() . '.zip';
    $ruta_archivo_zip   = BODEGA_TMP . $nombre_archivo_zip;

    // La opcion -j sirve para que no incluya la ruta completa donde se encuentra la imagen o archivo
    $commando_zip = 'zip -j ' . $ruta_archivo_zip . ' ' .
                            $cadena_archivos;
    
    $exito_comando = shell_exec($commando_zip) != null;
    $existe_archivo = is_file($ruta_archivo_zip);
    
    if ($exito_comando && $existe_archivo) {
      header('Pragma: public');
      header('Expires: 0');
      header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
      header('Cache-Control: private', false); // required for certain browsers 
      header('Content-Type: application/zip');
      header('Content-Disposition: attachment; filename="'. $nombre_archivo_zip . '"');
      header('Content-Transfer-Encoding: binary');
      header('Content-Length: ' . filesize($ruta_archivo_zip));
      ob_end_flush();
      @readfile($ruta_archivo_zip);
    } else {
      exit('Error al comprimir el archivo en el servidor por favor contacte al administrador del sistema');
    }
  } else {
    exit('Error no se envio el numero de expediente');
  }
?>
