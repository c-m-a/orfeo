<?
//$krdOld = $krd;
error_reporting(0);
session_start();
error_reporting(0);
$ruta_raiz = "../../..";
$carpetaOld = $carpeta;
$tipoCarpOld = $tipo_carp;
if(!$tipoCarpOld) $tipoCarpOld= $tipo_carpt;
if(!$krd) $krd=$krdOld;
//if(!isset($_SESSION['dependencia']))	include "$ruta_raiz/rec_session.php";
$entrada = 0;
$modificaciones = 0;
$salida = 0;
include_once "$ruta_raiz/include/query/flujos/queryEtapas.php";									


?>
<html>
<head>
<title>Creación de Proceso</title>
<link rel="stylesheet" href="../../../estilos/orfeo.css">

<script language="JavaScript">
<!--
	
	
//-->
</script>



</head>
<body>
<?
/*
//	include "$ruta_raiz/debugger.php";

	*/
?>
<table width="90%" align="center" border="0" cellspacing="0" cellpadding="0">
<tr align='middle'><td height="25" class="titulos4" colspan="10">ETAPAS QUE TIENE EL FLUJO ACTUALMENTE </td></tr>
</table>
<table WIDTH="90%" align="center" border="0" cellpadding="0" cellspacing="5" class="borde_tab" >

<tr bgcolor='#6699cc' class='etextomenu' align='middle'>
    <th width='15%'  class="titulos2">ORDEN</th>
    <th width='15%'  class="titulos2">C&Oacute;DIGO</th>
    <th  width='60%' class="titulos2">DESCRIPCI&Oacute;N</th>
    <th width='10%'  class="titulos2">TERMINOS</th>
    <?php
    if ($crear == 0) {
    ?>
    	<th width='15%'  class="titulos2">ELIMINAR</th>
    	<th  width='5%' class="titulos2">MODIFICAR</th> 
    <?php
    }
    ?>
</tr>
<?php

$rs=$db->query($sql);

while(!$rs->EOF)
{
	$nombreEtapa = $rs->fields["SGD_FEXP_DESCRIP"];
	$ordenEtapa = $rs->fields["SGD_FEXP_ORDEN"];
	$codigoEtapa  = $rs->fields["SGD_FEXP_CODIGO"];
	$terminos = $rs->fields["SGD_FEXP_TERMINOS"];
?>
<tr>
 <td width="10%" class='listado2' ><font size=1>
 	<? echo $ordenEtapa ?>
 </td>
 <td width="10%" class='listado2' ><font size=1>
 	<? echo $codigoEtapa ?>
 </td>
 <td width="60%" class='listado2' ><font size=1>
 	<? echo $nombreEtapa ?>
 </td>
 <td width="10%" class='listado2' ><font size=1>
 	<? echo $terminos ?>
 </td>
  <?php
    if ($crear == 0) {
    ?> 
    	<td width="60%" class='listado2' ><font size=1>
 			<center>
				<input type="radio" name="etapaAEliminar" value="<?=$codigoEtapa?>" onchange="submit();"> 			
			</center>

 		</td>
 		 <td width="60%" class='listado2' ><font size=1>
 			<center>
 				<input type="image" name="Button" value="Modificar" src="../../../imagenes/modificar.gif" onClick="Start('modificaEtapa.php?<?=$phpsession ?>&etapaAModificar=<?=$codigoEtapa?>&proceso=<?=$procesoSelected?>',500,500);" >
			</center>
 			
 		</td>
    <?php
    }
    ?>
</tr>
<?php
	$rs->MoveNext();
}
?>
</table>

</body>
</html>