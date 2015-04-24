<?php
  session_start();
  
  include ('../../config.php');
  include_once (ORFEO_PATH . '/include/db/ConnectionHandler.php');
  include_once (ORFEO_PATH . '/include/Smarty/libs/Smarty.class.php');

  $smarty = new Smarty();
  $smarty->template_dir = ORFEO_PATH . '/templates';
  $smarty->compile_dir  = ORFEO_PATH . '/templates_c';
  $smarty->cache_dir    = ORFEO_PATH . '/cache';

  // Contador para ciclos
  $i = 0;
  
  $dependencia_seleccionada = (isset($_POST['dependencia_seleccionada']))?
                                $_POST['dependencia_seleccionada'] :
                                null;

  $filtro_dependencia = (isset($dependencia_seleccionada))?
                          'WHERE DEPE_CODI = ' . $dependencia_seleccionada :
                          ' ';

  $db = new ConnectionHandler('../..');
  $db->conn->debug = true;
  $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);

  $ano_inicio = date('Y');
  $mes_inicio = substr('00' . (date('m')-1),-2);
  
  if ($mes_inicio == 0) {
    $ano_inicio = $ano_ini-1;
    $mes_inicio ="12";
  }

  if (!$fecha_inicio)
    $fecha_inicio = "$ano_ini/$mes_ini/$dia_ini";
  
  if(!$fecha_fin)
    $fecha_fin = $fecha_busq;

  $consulta_dependencias = "SELECT DEPE_CODI,
                                    DEPE_NOMB
                              FROM DEPENDENCIA";

  $consulta_usuarios = "SELECT USUA_CODI,
                                DEPE_CODI,
                                USUA_NOMB
                            FROM USUARIO" . $filtro_dependencia;

  $rs_dependencias = $db->conn->query($consulta_dependencias);
  $rs_usuarios     = $db->conn->query($consulta_usuarios);

  $arreglo_dependencias = array('0' => 'Todas las dependencias');
  
  while (!$rs_dependencias->EOF) {
    $arreglo_dependencias[$rs_dependencias->fields["DEPE_CODI"]] = $rs_dependencias->fields["DEPE_NOMB"];
    $rs_dependencias->MoveNext();
  }
  
  while (!$rs_usuarios->EOF) {
    $arreglo_usuarios[$i]["USUA_CODI"] = $rs_usuarios->fields["USUA_CODI"];
    $arreglo_usuarios[$i]["DEPE_CODI"] = $rs_usuarios->fields["DEPE_CODI"];
    $arreglo_usuarios[$i]["USUA_NOMB"] = $rs_usuarios->fields["USUA_NOMB"];
    $i++;
    $rs_usuarios->MoveNext();
  }
  
  unset($rs_dependencias);
  unset($rs_usuarios);
  
  $smarty->assign('ARREGLOS_USUARIOS',  $arreglo_usuarios);
  $smarty->assign('FECHA_INICIO',       $fecha_inicio);
  $smarty->assign('FECHA_FIN',          $fecha_fin);
  $smarty->display('index_auditoria.tpl');
?>
