<?php
$krdOld = $krd;
session_start();

if(!$krd) $krd = $krdOld;
if (!$ruta_raiz) $ruta_raiz = "..";
include "$ruta_raiz/rec_session.php";
include_once("$ruta_raiz/include/db/ConnectionHandler.php");
include_once "$ruta_raiz/include/tx/Historico.php";
$db = new ConnectionHandler( "$ruta_raiz" );
$db->debug = false;
$encabezadol = "$PHP_SELF?".session_name()."=".session_id()."&dependencia=$dependencia&krd=$krd";
?>
<script>
function regresar(){
	window.location.reload();
}
function NuevoV(codp){
	window.open("relacionTiposAlmac.php?<?=session_name()."=".session_id()?>&krd=<?=$krd?>&codp="+codp+"","Relacion Tipos de Almacenamiento","height=150,width=650,scrollbars=yes");

}
function Editar(cod,codp){
	window.open("editTiposAlmac.php?<?=session_name()."=".session_id()?>&krd=<?=$krd?>&cod="+cod+"&codp="+codp+"","Edicion Tipos de Almacenamiento","height=150,width=650,scrollbars=yes");

}
function Borrar(cod)
{
window.open("bortipo.php?<?=session_name()."=".session_id()?>&krd=<?=$krd?>&cod="+cod+"&tipo=2","Borrar Tipos","height=150,width=150,scrollbars=yes");
}
</script><head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>EDICION DE EDIFICIOS</title>
<link href="../estilos/orfeo.css" rel="stylesheet" type="text/css">
</head>



<form name="ediEdificio" action="<?=$encabezadol?>" method="post" >
<table border="0" width="90%" cellpadding="0"  class="borde_tab">
<tr>
  <td colspan="6" class="titulos2">
  <center>EDICION DE EDIFICIOS</center>
  </td>
</tr>
<?
$codp=$cod;
?>
<tr><td class="titulos5" colspan="6" align="center"><input type="button" class="botones"  align="middle" name="nuevo" value="NUEVO" onClick="NuevoV(<?=$codp?>);">
<input type="button" name="cerrar" class="botones" value="SALIR" onClick="window.close();"></td></tr>
<tr>
<td class="titulos2"><b>Codigo del Padre</b></td>
<td class="titulos2"><B>Nombre del Padre</B></td>
<td class="titulos2"><b>Codigo del Hijo</b></td>
<td class="titulos2"><B>Nombre del Hijo</B></td>
<td class="titulos2"><B>Editar</B></td>
<td class="titulos2"><B>Borrar</B></td></tr>
<?
$c=0;
$cp=0;

$sqli="select sgd_eit_nombre from sgd_eit_items where sgd_eit_codigo='$cod'";
//$db->conn->debug=true;
$rsi=$db->conn->Execute($sqli);
if(!$rsi->EOF)$nomp[$cp]=$rsi->fields['SGD_EIT_NOMBRE'];
$sql="select * from sgd_eit_items where sgd_eit_cod_padre like '$cod'";
$rs=$db->conn->Execute($sql);
while(!$rs->EOF){
$nom[$c]=$rs->fields['SGD_EIT_NOMBRE'];
$codi[$c]=$rs->fields['SGD_EIT_CODIGO'];
?>
<tr>
<td class="titulos5"><?=$cod?></td>
<td class="titulos5"><?=$nomp[$cp]?></td>
<td class="titulos5"><?=$codi[$c]?></td>
<td class="titulos5"><?=$nom[$c]?></td>
<td class="titulos5"><input type="radio" name="edit" value="1" onClick="Editar(<?=$codi[$c]?>,<?=$codp?>)" <?=$sel?> align="absmiddle"></td>
<td class="titulos5"><input type="radio" name="borr" value="1" onClick="Borrar(<?=$codi[$c]?>)" <?=$sel2?> align="absmiddle"></td></tr>
<?
$c++;
$rs->MoveNext();
}
$cp++;
$tm=$c;
for($i=0;$i<$tm;$i++){
$sqli="select sgd_eit_nombre from sgd_eit_items where sgd_eit_codigo='$codi[$i]'";
//$db->conn->debug=true;
$rsi=$db->conn->Execute($sqli);
if(!$rsi->EOF)$nomp[$cp]=$rsi->fields['SGD_EIT_NOMBRE'];
$codigo=$codi[$i];
$sql="select * from sgd_eit_items where sgd_eit_cod_padre like '$codi[$i]'";
$rs=$db->conn->Execute($sql);
while(!$rs->EOF){
$nom[$c]=$rs->fields['SGD_EIT_NOMBRE'];
$codi[$c]=$rs->fields['SGD_EIT_CODIGO'];
?>
<tr><td class="titulos5"><?=$codigo?></td>
<td class="titulos5"><?=$nomp[$cp]?></td>
<td class="titulos5"><?=$codi[$c]?></td>
<td class="titulos5"><?=$nom[$c]?></td>
<td class="titulos5"><input type="radio" name="edit" value="1" onClick="Editar(<?=$codi[$c]?>,<?=$codp?>)" <?=$sel?> align="absmiddle"></td>
<td class="titulos5"><input type="radio" name="borr" value="1" onClick="Borrar(<?=$codi[$c]?>)" <?=$sel2?> align="absmiddle"></td></tr>
<?
$c++;
$rs->MoveNext();
}
$cp++;
}

$tm1=$c;
for($i=$tm;$i<$tm1;$i++){
$sqli="select sgd_eit_nombre from sgd_eit_items where sgd_eit_codigo='$codi[$i]'";
//$db->conn->debug=true;
$rsi=$db->conn->Execute($sqli);
if(!$rsi->EOF)$nomp[$cp]=$rsi->fields['SGD_EIT_NOMBRE'];
$codigo=$codi[$i];
$sql="select * from sgd_eit_items where sgd_eit_cod_padre like '$codi[$i]'";
$rs=$db->conn->Execute($sql);
while(!$rs->EOF){
$nom[$c]=$rs->fields['SGD_EIT_NOMBRE'];
$codi[$c]=$rs->fields['SGD_EIT_CODIGO'];
?>
<tr><td class="titulos5"><?=$codigo?></td>
<td class="titulos5"><?=$nomp[$cp]?></td>
<td class="titulos5"><?=$codi[$c]?></td>
<td class="titulos5"><?=$nom[$c]?></td>
<td class="titulos5"><input type="radio" name="edit" value="1" onClick="Editar(<?=$codi[$c]?>,<?=$codp?>)" <?=$sel?> align="absmiddle"></td>
<td class="titulos5"><input type="radio" name="borr" value="1" onClick="Borrar(<?=$codi[$c]?>)" <?=$sel2?> align="absmiddle"></td></tr>
<?
$c++;
$rs->MoveNext();
}
$cp++;
}

$tm2=$c;
for($i=$tm1;$i<$tm2;$i++){
$sqli="select sgd_eit_nombre from sgd_eit_items where sgd_eit_codigo='$codi[$i]'";
//$db->conn->debug=true;
$rsi=$db->conn->Execute($sqli);
if(!$rsi->EOF)$nomp[$cp]=$rsi->fields['SGD_EIT_NOMBRE'];
$codigo=$codi[$i];
$sql="select * from sgd_eit_items where sgd_eit_cod_padre like '$codi[$i]'";
$rs=$db->conn->Execute($sql);
while(!$rs->EOF){
$nom[$c]=$rs->fields['SGD_EIT_NOMBRE'];
$codi[$c]=$rs->fields['SGD_EIT_CODIGO'];
?>
<tr><td class="titulos5"><?=$codigo?></td>
<td class="titulos5"><?=$nomp[$cp]?></td>
<td class="titulos5"><?=$codi[$c]?></td>
<td class="titulos5"><?=$nom[$c]?></td>
<td class="titulos5"><input type="radio" name="edit" value="1" onClick="Editar(<?=$codi[$c]?>,<?=$codp?>)" <?=$sel?> align="absmiddle"></td>
<td class="titulos5"><input type="radio" name="borr" value="1" onClick="Borrar(<?=$codi[$c]?>)" <?=$sel2?> align="absmiddle"></td></tr>
<?
$c++;
$rs->MoveNext();
}
$cp++;
}

$tm3=$c;
for($i=$tm2;$i<$tm3;$i++){
$sqli="select sgd_eit_nombre from sgd_eit_items where sgd_eit_codigo='$codi[$i]'";
//$db->conn->debug=true;
$rsi=$db->conn->Execute($sqli);
if(!$rsi->EOF)$nomp[$cp]=$rsi->fields['SGD_EIT_NOMBRE'];
$codigo=$codi[$i];
$sql="select * from sgd_eit_items where sgd_eit_cod_padre like '$codi[$i]'";
$rs=$db->conn->Execute($sql);
while(!$rs->EOF){
$nom[$c]=$rs->fields['SGD_EIT_NOMBRE'];
$codi[$c]=$rs->fields['SGD_EIT_CODIGO'];
?>
<tr><td class="titulos5"><?=$codigo?></td>
<td class="titulos5"><?=$nomp[$cp]?></td>
<td class="titulos5"><?=$codi[$c]?></td>
<td class="titulos5"><?=$nom[$c]?></td>
<td class="titulos5"><input type="radio" name="edit" value="1" onClick="Editar(<?=$codi[$c]?>,<?=$codp?>)" <?=$sel?> align="absmiddle"></td>
<td class="titulos5"><input type="radio" name="borr" value="1" onClick="Borrar(<?=$codi[$c]?>)" <?=$sel2?> align="absmiddle"></td></tr>
<? 
$c++;
$rs->MoveNext();
}
$cp++;
}

$tm4=$c;
for($i=$tm3;$i<$tm4;$i++){
$sqli="select sgd_eit_nombre from sgd_eit_items where sgd_eit_codigo='$codi[$i]'";
//$db->conn->debug=true;
$rsi=$db->conn->Execute($sqli);
if(!$rsi->EOF)$nomp[$cp]=$rsi->fields['SGD_EIT_NOMBRE'];
$codigo=$codi[$i];
$sql="select * from sgd_eit_items where sgd_eit_cod_padre like '$codi[$i]'";
$rs=$db->conn->Execute($sql);
while(!$rs->EOF){
$nom[$c]=$rs->fields['SGD_EIT_NOMBRE'];
$codi[$c]=$rs->fields['SGD_EIT_CODIGO'];
?>
<tr><td class="titulos5"><?=$codigo?></td>
<td class="titulos5"><?=$nomp[$cp]?></td>
<td class="titulos5"><?=$codi[$c]?></td>
<td class="titulos5"><?=$nom[$c]?></td>
<td class="titulos5"><input type="radio" name="edit" value="1" onClick="Editar(<?=$codi[$c]?>,<?=$codp?>)" <?=$sel?> align="absmiddle"></td>
<td class="titulos5"><input type="radio" name="borr" value="1" onClick="Borrar(<?=$codi[$c]?>)" <?=$sel2?> align="absmiddle"></td></tr>
<?
$c++;
$rs->MoveNext();
}
$cp++;
}
