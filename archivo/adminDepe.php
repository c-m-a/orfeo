<?php
session_start();
$krd = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
import_request_variables("gp", "");
if (!$ruta_raiz) $ruta_raiz = "..";
include_once("$ruta_raiz/include/db/ConnectionHandler.php");
$db = new ConnectionHandler("$ruta_raiz");
$encabezadol = "$PHP_SELF?".session_name()."=".session_id()."&num_exp=$num_exp";

$db->debug = false;
$encabezadol = "$PHP_SELF?".session_name()."=".session_id()."&dependencia=$dependencia&krd=$krd";
?>
<script>
function regresar(){
	window.location.reload();
}
function NuevoE(){
	window.open("inDepe.php?<?=session_name()."=".session_id()?>&krd=<?=$krd?>","Ingresar Relacion Edificio-Dependencia","height=250,width=650,scrollbars=yes");

}
function Borrar(cod)
{
window.open("bortipo.php?<?=session_name()."=".session_id()?>&krd=<?=$krd?>&cod="+cod+"&tipo=5","Borrar Tipos","height=150,width=150,scrollbars=yes");
}
function Edifi(cod)
{
window.open("inDepe.php?<?=session_name()."=".session_id()?>&krd=<?=$krd?>&cod="+cod+"&edi=1","Editar Relacion Edificio-Dependencia","height=250,width=650,scrollbars=yes");
}
</script>
<html>
<head>
<title>ADMINISTRACI&Oacute;N DE RELACION DE EDIFICIOS-DEPENDENCIA</title>
<link rel="stylesheet" href="../estilos/orfeo.css">
<link href="../../../br_3.7/estilos/orfeo.css" rel="stylesheet" type="text/css">
</head>
<body bgcolor="#FFFFFF">
<form name="adminEdificio" action="<?=$encabezadol?>" method="post" >
<table border="0" width="50%" align="center" cellpadding="0"  class="borde_tab">
<tr>
  <td colspan="3" class="titulos2">
  <center>ADMINISTRACI&Oacute;N DE RELACION DE EDIFICIOS-DEPENDENCIA</center>
  </td>
</tr>
<tr>
 <td class="titulos5" colspan="3"><input type="button" name="NUEVO" value="NUEVA RELACION" onClick="NuevoE();" class="botones_funcion">
 <a href='archivo.php?<?=session_name()?>=<?=trim(session_id())?>krd=<?=$krd?>'><input name='Regresar' align="middle" type="button" class="botones_funcion" id="envia22" value="Regresar" >
    <!--a href="ingEdificio.php?<?=session_name()."=".session_id()."&krd=$krd&fechah=$fechah&$orno&adodb_next_page" ?>' target='mainFrame' class="menu_princ""><b> Nuevo Edificio </b-->
  </td>
   </tr>
<br>
</table>
<table border="0" width="50%" cellpadding="0" align="center"  class="borde_tab">
<tr>
  <td class="titulos2">DEPENDENCIA</td>
  <td class="titulos2">EDIFICIO</td>
  <td class="titulos2">ITEM</td>
  <td class="titulos2">EDITAR</td>
  <td class="titulos2">BORRAR</td>
  </tr>
<?
//$db->conn->debug=true;
$conD=$db->conn->Concat("DEPE_CODI","'-'","DEPE_NOMB");
$rs=$db->conn->Execute("select $conD AS DEPE, sgd_arch_edificio,sgd_arch_item,sgd_arch_id from dependencia, sgd_arch_depe where depe_codi=sgd_arch_depe ORDER BY SGD_ARCH_DEPE");
while(!$rs->EOF){
$nom=$rs->fields['DEPE'];
$cod=$rs->fields['SGD_ARCH_ID'];
$edi=$rs->fields['SGD_ARCH_EDIFICIO'];
$ite=$rs->fields['SGD_ARCH_ITEM'];
$rs2=$db->conn->Execute("select sgd_eit_nombre from sgd_eit_items where sgd_eit_codigo=$edi");
if(!$rs2->EOF)$edif=$rs2->fields['SGD_EIT_NOMBRE'];
$rs3=$db->conn->Execute("select sgd_eit_nombre from sgd_eit_items where sgd_eit_codigo=$ite");
if(!$rs3->EOF)$item=$rs3->fields['SGD_EIT_NOMBRE'];
else $item="N/A";
if($EDI==1)$sel="checked";
?>
<tr><td class="listado5"><?=$nom?></td>
<td class="listado5"><?=$edif?></td>
<td class="listado5"><?=$item?></td>
<td ><input type="radio" name="EDI" value="1" onClick="Edifi(<?=$cod?>);" <?=$sel?> align="absmiddle"></td>
<td><input type="radio" name="BORR" value="1" onClick="Borrar(<?=$cod?>);" <?=$sel?> align="absmiddle"></td>
</tr>
<?
$rs->MoveNext();
}

?>
</table>
</form>
</body>
</html>