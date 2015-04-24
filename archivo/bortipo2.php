<?
$krdOld = $krd;
session_start();

if(!$krd) $krd = $krdOld;
if (!$ruta_raiz) $ruta_raiz = "..";
include "$ruta_raiz/rec_session.php";
include_once("$ruta_raiz/include/db/ConnectionHandler.php");
include_once "$ruta_raiz/include/tx/Historico.php";
include_once "$ruta_raiz/include/tx/Expediente.php";
$db = new ConnectionHandler( "$ruta_raiz" );
//$db->debug = true;
$encabezadol = "$PHP_SELF?".session_name()."=".session_id()."&dependencia=$dependencia&krd=$krd&cod=$cod&tipo=3";
$encabezado2 = "$PHP_SELF?".session_name()."=".session_id()."&dependencia=$dependencia&krd=$krd&cod=$cod&tipo=4";
?>
<html>
<head>
<title>BORRAR TIPOS</title>
<link rel="stylesheet" href="../estilos/orfeo.css">
</head>
<body bgcolor="#FFFFFF">
<?
if($tipo==1){
?>
<form name="borrar" action="<?=$encabezadol?>" method="POST" >
<table width="90%" align="center" >
<tr><td class="titulos5">Esta seguro de borrar este edificio, con toda su informacion?</td></tr>
<tr><td><input type="submit" name="borrar" value="Borrar" align="middle" class="botones">
</td></tr>
</table>
<?
}
if($tipo==3){
$sql="delete from sgd_eit_items where sgd_eit_codigo like '$cod'";
//$db->conn->debug=true;
$rs=$db->conn->Execute($sql);
$sqli="select sgd_eit_codigo from sgd_eit_items where sgd_eit_cod_padre like '$cod'";
$rsi=$db->conn->Execute($sqli);
while(!$rsi->EOF){
$codi=$rsi->fields['SGD_EIT_CODIGO'];
$sql="delete from sgd_eit_items where sgd_eit_codigo like '$codi'";
$rs=$db->conn->Execute($sql);
$sqli2="select sgd_eit_codigo from sgd_eit_items where sgd_eit_cod_padre like '$codi'";
$rsi2=$db->conn->Execute($sqli2);
while(!$rsi2->EOF){
$codi2=$rsi2->fields['SGD_EIT_CODIGO'];
$sql="delete from sgd_eit_items where sgd_eit_codigo like '$codi2'";
$rs=$db->conn->Execute($sql);
$sqli3="select sgd_eit_codigo from sgd_eit_items where sgd_eit_cod_padre like '$codi2'";
$rsi3=$db->conn->Execute($sqli3);
while(!$rsi3->EOF){
$codi3=$rsi3->fields['SGD_EIT_CODIGO'];
$sql="delete from sgd_eit_items where sgd_eit_codigo like '$codi3'";
$rs=$db->conn->Execute($sql);
$sqli4="select sgd_eit_codigo from sgd_eit_items where sgd_eit_cod_padre like '$codi3'";
$rsi4=$db->conn->Execute($sqli4);
while(!$rsi4->EOF){
$codi4=$rsi4->fields['SGD_EIT_CODIGO'];
$sql="delete from sgd_eit_items where sgd_eit_codigo like '$codi4'";
$rs=$db->conn->Execute($sql);
$sqli5="select sgd_eit_codigo from sgd_eit_items where sgd_eit_cod_padre like '$codi4'";
$rsi5=$db->conn->Execute($sqli5);
while(!$rsi5->EOF){
$codi5=$rsi5->fields['SGD_EIT_CODIGO'];
$sql="delete from sgd_eit_items where sgd_eit_codigo like '$codi5'";
$rs=$db->conn->Execute($sql);
$sqli6="select sgd_eit_codigo from sgd_eit_items where sgd_eit_cod_padre like '$codi5'";
$rsi6=$db->conn->Execute($sqli4);
while(!$rsi6->EOF){
$codi6=$rsi6->fields['SGD_EIT_CODIGO'];
$sql="delete from sgd_eit_items where sgd_eit_codigo like '$codi6'";
$rs=$db->conn->Execute($sql);
$rsi6->MoveNext();
}
$rsi5->MoveNext();
}
$rsi4->MoveNext();
}
$rsi3->MoveNext();
}
$rsi2->MoveNext();
}
$rsi->MoveNext();
}
echo "Toda la informacion del edificio fue borrada";
?>
<input name="Cerrar" type="button" class="botones" id="envia22" onClick="opener.regresar();window.close();" value=" Cerrar " >
<?
}
?>
</form>
<?
if($tipo==2){
?>
<form name="borrar2" action="<?=$encabezado2?>" method="POST" >
<table width="90%" align="center" >
<tr><td class="titulos5">Esta seguro de borrar este tipo?</td></tr>
<tr><td><input type="submit" name="borrar" value="Borrar" align="middle" class="botones">
</td></tr>
</table>
<?
}
if($tipo==4){
$sql="delete from sgd_eit_items where sgd_eit_codigo like '$cod'";
$rs=$db->conn->Execute($sql);
echo "Registro borrado";
?>
<input name="Cerrar" type="button" class="botones" id="envia22" onClick="opener.regresar();window.close();" value=" Cerrar " >
<?
}
?>
</form>