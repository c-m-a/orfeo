<?php
error_reporting(7);
//importando las librerias XAJAX
require_once ("../../xajax/xajax_core/xajax.inc.php");
$xajax = new xajax("./usuarios.php");
//asociamos la función creada en index.server.php al objeto XAJAX
$xajax->registerFunction("UsuariosServer");
function UsuariosServer($DependenciaBusq, $funcionario, $DependenciaFun) {
# /*** include the xajax libraries ***/
 //include '../../xajax/xajax_core/xajax.inc.php';
  define('ADODB_ASSOC_CASE', 1);
  include_once "../../db/ConnectionHandler.php";
  $db = new ConnectionHandler("../../..");
  //$db->conn->debug = true;
  $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
	$objResponse=new xajaxResponse();
	$objResponse->script("clearOption('funcionario');");
  $ret = '';
  $iSql = "select * from usuario
      where depe_codi=$DependenciaBusq  ";
  if($DependenciaBusq==$DependenciaFun){
			$iSql .= " AND ((usua_cod_jefe_inmediato = (select u2.usua_cod_jefe_inmediato  from usuario u2 where 					u2.usua_doc='$funcionario'))
						OR (usua_codI = (select u2.usua_cod_jefe_inmediato  from usuario u2 where u2.usua_doc='$funcionario')))";
		}
    if($txAccion){
      $iSql .= " AND USUA_CODI=1 ";
    }
    $isql .= "ORDER BY USUA_NOMB";
    $rsUs = $db->conn->Execute($iSql);
    while (!$rsUs->EOF)
    {
      $usuaCodi = utf8_encode  ($rsUs->fields["USUA_CODI"]);
      $usuaNomb = utf8_encode  ($rsUs->fields["USUA_NOMB"]);
      $usuaNomb = $rsUs->fields["USUA_NOMB"];
      if($funcionario==$usuaCodi)  $datoss = " selected "; else  $datoss = " ";
      $ret .= "<option value=$usuaCodi  $datoss>$usuaNomb</option>";
      if($usuaCodi==1) $indexSelected = $j;
      $j++;
      $rsUs->MoveNext();
    }
  $objResponse->assign('funcionario', 'innerHTML', $ret);
  $objResponse->assign("nombre_us1","value",$usuaNomb);
  return $objResponse;
	}
$xajax->processRequest();
?>