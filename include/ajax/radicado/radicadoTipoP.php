<?php
session_start();
error_reporting(7);
//importando las librerias XAJAX
require_once ("../../xajax/xajax_core/xajax.inc.php");
$xajax = new xajax("./radicadoTipoP.php");
//asociamos la función creada en index.server.php al objeto XAJAX
$xajax->registerFunction("GrabarTiposRad");

function GrabarTiposRad($codigoTipo, $datoActual,$codigoId='',$numeroExp='', $usuaDoc='79802120') {
# /*** include the xajax libraries ***/
 //include '../../xajax/xajax_core/xajax.inc.php';
  define('ADODB_ASSOC_CASE', 1);
  $_SESSION["codigoId"] = $codigoId;
  $_SESSION["usuaDoc"]= $usuaDoc;
  $_SESSION["numeroExp"]= $numeroExp;
  include_once "../../db/ConnectionHandler.php";
  $db = new ConnectionHandler("../../..");
  $db->conn->debug = true;
  $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
	$objResponse=new xajaxResponse();
	//$objResponse->script("clearOption('funcionario');");
  $ret = '';
    $radicadoNum = str_replace("tipo_", "",$datoActual);
    $iSql = "DELETE FROM SGD_PANE_PROCANEXOSASOC WHERE SGD_PANE_CODIGOP=$codigoId and RADI_NUME_RADI=$radicadoNum";
    $rs = $db->conn->query($iSql);
  for($i=0;$i<=20;$i++){
    if($codigoTipo[$i]>=1 && trim(str_replace("tipo_", "",$datoActual))){
        $iSql = "SELECT SGD_PANE_CODIGO FROM SGD_PANE_PROCANEXOSASOC ORDER BY SGD_PANE_CODIGO DESC";
        $rs = $db->conn->query($iSql);
        $paneCodigo = $rs->fields["SGD_PANE_CODIGO"];
        $paneCodigo++;
      $datos["RADI_NUME_RADI"] = $radicadoNum;
      $datos["SGD_EXP_NUMERO"] = "'".$numeroExp."'";
      $datos["SGD_TPR_CODIGO"] = $codigoTipo[$i];
      $datos["SGD_PANE_CODIGO"] = $paneCodigo;
      $datos["SGD_PANE_CODIGOP"] = $codigoId;
      $datos["USUA_DOC"] = $usuaDoc;
      $insertSQL = $db->insert("SGD_PANE_PROCANEXOSASOC", $datos, "true");
    }
    
  }

  $objResponse->assign('resGrabar', 'innerHTML', $insertSQL);
  //$objResponse->assign("nombre_us1","value",$usuaNomb);
  return $objResponse;
	}
$xajax->processRequest();
?>