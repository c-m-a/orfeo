<?php
  include ('../../config.php');
  include_once (ORFEO_PATH . '/include/db/ConnectionHandler.php');
  include_once (SMARTY_TEMPLATE);
  
  $i = 0;
  $numero_radicado = (isset($_POST['numero_radicado']))? trim($_POST['numero_radicado']) : null;
  $datos_auditoria = array();
  $arreglo_acciones = array();
  $arreglo_acciones['s'] = 'Consultado';
  $arreglo_acciones['do'] = 'Descargado';

  $smarty = new Smarty();
  $smarty->template_dir = TEMPLATE_DIR;
  $smarty->compile_dir  = COMPILE_DIR;
  $smarty->cache_dir    = CACHE_DIR;
  
  $db = new ConnectionHandler('../..');
  
  $consulta_radicado = "SELECT TIPO, ISQL FROM SGD_AUDITORIA
                          WHERE RADI_NUME_RADI LIKE '%$numero_radicado%' AND
                                (TIPO = 's' OR TIPO = 'do')";
  
  
  if (isset($numero_radicado)) {
    $rs = $db->conn->Execute($consulta_radicado);

    while (!$rs->EOF) {
      $datos_auditoria[$i]  = json_decode($rs->fields['ISQL'], true);
      $time_stamp           = $datos_auditoria[$i]['unix_time'];
      $fecha_formateada     = gmdate('d-M-Y', $time_stamp);
      $datos_auditoria[$i]['tipo'] = $arreglo_acciones[$rs->fields['TIPO']];
      $datos_auditoria[$i]['unix_time'] = $fecha_formateada;
      $datos_auditoria[$i]['numero'] = $i + 1;
      $i++;
      $rs->MoveNext();
    }
    
    $smarty->assign('DATOS_AUDITORIA', $datos_auditoria);
    $smarty->display('resultado_auditoria.tpl');
  } else {
    echo 'Digite un numero de radicado';
  }
?>
