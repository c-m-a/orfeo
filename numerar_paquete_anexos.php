<?php
if (!$ruta_raiz) $ruta_raiz= ".";
//Programa que numera un paquete de documentos de numeración y fechado
//además muestra el resultado de esta numeración
if (!$dependencia or !$depe_codi_territorial)  include "$ruta_raiz/rec_session.php";

include("$ruta_raiz/class_control/anexo.php");
require_once("$ruta_raiz/class_control/TipoDocumento.php");

if (!$db)
		$db = new ConnectionHandler($ruta_raiz);
$db->conn->BeginTrans();
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);	 
$anex = & new Anexo($db);
$anex->anexoRadicado($numrad,$anexo);
$secuenciaDocto=$anex->get_secuenciaDocto($dependencia);
?>
<link rel="stylesheet" href="./estilos_totales.css">
<?
if (strlen(trim($secuenciaDocto))<1){
	echo ("<div align='left'><span class='etextomenu'>POR FAVOR VERIFIQUE QUE LA DEPENDENCIA A LA CUAL PERTENECE TENGA COMPETENCIA SOBRE ESTE TIPO DE DOCUMENTO</span></div>");
	die;
}
	if	(!$anex->guardarSecuencia()){
		$db->conn->RollbackTrans();
		die ("<span class='etextomenu'>No se ha podido Grabar la información de numeración");
	
	}
	$tipoDocumento = & new TipoDocumento($db); 
	$tipoDocumento->TipoDocumento_codigo($anex->get_sgd_tpr_codigo());
	$descripcionDocumento=$tipoDocumento->get_sgd_tpr_descrip();
	$secuenciaFormato = $anex->get_doc_secuencia_formato($dependencia);
	$db->conn->CommitTrans();

?>

<form action="" method="post" enctype="multipart/form-data" name="formAdjuntarArchivos">
  <table width="47%" border="0" cellspacing="1" cellpadding="0" align="center" class="t_bordeGris">
    <tr align="center"> 
      <td height="25" class="grisCCCCCC"> 
        <div align="left"><span class="etextomenu"> NUMERACION EXITOSA</span></div>
      </td>
    </tr>
    <tr align="center"> 
      <td height="25" class="grisCCCCCC"> 
        <div align="left">El documento ha sido numerado:</div>
      </td>
    </tr>
    <tr align="center"> 
      <td class="celdaGris" > 
        <div align="left" class="etexto">
          <?=$descripcionDocumento?>
          <font color="#008040"><b>No. 
          <?=$secuenciaFormato?>
          </b></font></div>
      </td>
    </tr>
    <tr align="center">
      <td class="celdaGris" ><span class="celdaGris"><span class="e_texto1">
        <input name="envia" type="button"  class="ebuttons2" id="envia"  onClick="history.go(-1);" value="Aceptar">
        </span></span></td>
    </tr>
  </table>
</form>
