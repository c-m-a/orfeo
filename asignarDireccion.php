<?php
  $pearLib   = "./pear/";
  $ruta_raiz = ".";
  require_once($pearLib . "HTML/Template/IT.php");
  // Crea una instancia de para el manejo de plantilla
  $tpl           = new HTML_Template_IT($ruta_raiz . "/tpl");
  $municipio     = array();
  $departamentos = array();
  $municipios    = array();
  global $anexCodi;
  $muniCodi  = (isset($HTTP_POST_VARS["municipio"]["codigo"])) ? $HTTP_POST_VARS["municipio"]["codigo"] : null;
  $direccion = (isset($HTTP_POST_VARS["radicado"]["direccion"])) ? $HTTP_POST_VARS["radicado"]["direccion"] : null;
  $dptoCodi  = (isset($HTTP_POST_VARS["departamento"]["depto_codi"])) ? $HTTP_POST_VARS["departamento"]["depto_codi"] : null;
  $anexCodi  = (isset($HTTP_POST_VARS["anexo"])) ? $HTTP_POST_VARS["anexo"] : null;
  //unset($HTTP_POST_VARS);
  /* 
   * Eliminacion de variables 
   * para que en la carga no afecte en el archivo asignarDireccion
   */
  //unset($HTTP_POST_VARS["departamento"]["depto_codi"]);
  //unset($HTTP_POST_VARS["radicado"]["direccion"]);
  /*$muniCodi = 
  $anexCodi =*/
  $krdOld    = $krd;
  session_start();
  
  if (!isset($_SESSION['dependencia']) && !isset($_SESSION['cod_local']))
    include "../rec_session.php";
  $HTTP_GET_VARS["anexo"] = $anexCodi;
  $ruta_raiz              = ".";
  define('ADODB_ASSOC_CASE', 0);
  include_once($ruta_raiz . "/include/db/ConnectionHandler.php");
  $db = new ConnectionHandler("$ruta_raiz");
  $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
  
  if (isset($direccion) && isset($muniCodi) && isset($dptoCodi) && isset($anexCodi)) {
    if (!empty($borrarDireccion) && $borrarDireccion == "borrar") {
      $sql = "UPDATE anexos SET sgd_dir_direccion = '', 
							muni_codi ='', 
							dpto_codi ='' 
					WHERE anex_codigo = '" . $anexCodi . "'";
    } else {
      $sql = "UPDATE anexos SET sgd_dir_direccion = '" . $direccion . "', muni_codi ='" . $muniCodi . "', dpto_codi ='" . $dptoCodi . "' WHERE anex_codigo = '" . $anexCodi . "'";
    }
    /*$sql = "UPDATE ANEXOS SET SGD_DIR_DIRECCION = '" . $direccion . 
    "', MUNI_CODI ='" . $muniCodi . 
    "', DPTO_CODI ='" . $dptoCodi . 
    "' WHERE ANEX_CODIGO = '" . $anexCodi . "'";
    */
    $recordSet["SGD_DIR_DIRECCION"] = "'" . $direccion . "'";
    $recordSet["MUNI_CODI"]         = "'" . $muniCodi . "'";
    $recordSet["DPTO_CODI"]         = "'" . $dptoCodi . "'";
    $recordWhere["ANEX_CODIGO"]     = "'" . $anexCodi . "'";
    $db->conn->Execute($sql);
    //$res = $db->update("ANEXOS", $recordSet, $recordWhere);
  } else {
    $error = "No ha podido Actualizar la direccion";
  }
  require_once($ruta_raiz . "/mostrarDireccion.php");
?>
