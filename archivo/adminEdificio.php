<?php
session_start();
$krd = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
error_reporting(0);
import_request_variables("gp", "");
if (!$ruta_raiz) $ruta_raiz = "..";
define('ADODB_ASSOC_CASE',1);
include_once("$ruta_raiz/include/db/ConnectionHandler.php");
$db = new ConnectionHandler( "$ruta_raiz" );
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
//$db->conn->debug = true;
//$db->debug = true;
$encabezadol = "$PHP_SELF?".session_name()."=".session_id()."&dependencia=$dependencia";
?>
<script>
function regresar(){
	window.location.reload();
}
function NuevoE(){
	window.open("ingEdificio.php?<?=session_name()."=".session_id()?>","Ingresar Edificios","height=250,width=650,scrollbars=yes");

}
function Borrar(cod)
{
window.open("bortipo.php?<?=session_name()."=".session_id()?>&cod="+cod+"&tipo=1","Borrar Tipos","height=150,width=150,scrollbars=yes");
}
function Edifi(cod)
{
window.open("ediEdificio.php?<?=session_name()."=".session_id()?>&cod="+cod+"","Editar Edificios","height=750,width=650,scrollbars=yes");
}
</script>
<html>
<head>
<title>ADMINISTRACI&Oacute;N DE EDIFICIOS</title>
<link rel="stylesheet" href="../estilos/orfeo.css">
<link href="../estilos/orfeo.css" rel="stylesheet" type="text/css">
</head>
<body bgcolor="#FFFFFF">
<form name="adminEdificio" action="<?=$encabezadol?>" method="post" >
<table border="0" width="50%" align="center" cellpadding="0"  class="borde_tab">
<tr>
  <td colspan="3" class="titulos2">
  <center>ADMINISTRACI&Oacute;N DE EDIFICIOS</center>
  </td>
</tr>
<tr>
 <td class="titulos5"><input type="button" name="NUEVO" value="NUEVO EDIFICIO" onClick="NuevoE();" class="botones_funcion">
    <!--a href="ingEdificio.php?<?=session_name()."=".session_id()."&fechah=$fechah&$orno&adodb_next_page" ?>' target='mainFrame' class="menu_princ""><b> Nuevo Edificio </b-->
  </td>
   </tr>
<br>
</table>
<table border="0" width="50%" cellpadding="0" align="center"  class="borde_tab">
<tr>
  <td class="titulos2">EDIFICIO</td>
  <td class="titulos2">EDITAR</td>
  <td class="titulos2">BORRAR</td>
  </tr>
<?
$sqlp="select sgd_eit_nombre,sgd_eit_codigo from sgd_eit_items where sgd_eit_cod_padre ='0'";
define('ADODB_ASSOC_CASE',1);
$rs=$db->conn->Execute($sqlp);
while(!$rs->EOF){
 $nom=$rs->fields['SGD_EIT_NOMBRE'];
 $cod=$rs->fields['SGD_EIT_CODIGO'];
if($EDI==1)$sel="checked";
?>
<tr><td class="listado5"><?=$nom?></td>
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
