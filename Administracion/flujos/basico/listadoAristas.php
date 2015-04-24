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
include_once "$ruta_raiz/include/query/flujos/queryAristas.php";									


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
<tr align='middle'><td height="25" class="titulos4" colspan="10">ARISTAS QUE TIENE EL FLUJO ACTUALMENTE </td></tr>
</table>
<table WIDTH="90%" align="center" border="0" cellpadding="0" cellspacing="5" class="borde_tab" >

<tr bgcolor='#6699cc' class='etextomenu' align='middle'>
    <th width='15%'  class="titulos2">ET. INICIAL</th>
    <th width='15%'  class="titulos2">ET. FINAL</th>
    <th  width='5%' class="titulos2">DESCRIPCI&Oacute;N</th>
    <th width='15%'  class="titulos2">DIAS MIN.</th>
    <th width='15%'  class="titulos2">DIAS MAX.</th>
    <th  width='5%' class="titulos2">TIPO RAD</th>
    <th width='15%'  class="titulos2">AUTO.</th>
    <th width='15%'  class="titulos2">TIPIF.</th>
    <th  width='5%' class="titulos2">SERIE</th>
    <th  width='5%' class="titulos2">SUBSERIE</th>
    <th  width='5%' class="titulos2">TIPO DOC</th>
    <th width='15%'  class="titulos2">ELIMINAR</th>
	<th  width='5%' class="titulos2">MODIFICAR</th> 
</tr>
<?php

$rs=$db->query($sqlListadoAristas);


while(!$rs->EOF)
{
	$etapaInicialList = $rs->fields["SGD_FEXP_CODIGOINI"];
	$etapaFinalList = $rs->fields["SGD_FEXP_CODIGOFIN"];
	$descripcionAristaList  = $rs->fields["SGD_FARS_DESC"];
	$diasMinimoList = $rs->fields["SGD_FARS_DIASMINIMO"];
	$diasMaximoList = $rs->fields["SGD_FARS_DIASMAXIMO"];
	$tradList  = $rs->fields["SGD_TRAD_CODIGO"];
	$automaticoList = $rs->fields["SGD_FARS_AUTOMATICO"];
	$tipificacionList = $rs->fields["SGD_FARS_TIPIFICACION"];
	$serieList  = $rs->fields["SGD_SRD_CODIGO"];
	$subserieList = $rs->fields["SGD_SBRD_CODIGO"];
	$tprList = $rs->fields["SGD_TPR_CODIGO"];
	$codigoArista = $rs->fields["SGD_FARS_CODIGO"];
	
?>
<tr align='middle'>
 <td width="10%" class='listado2' ><font size=1>
 	<? echo $etapaInicialList ?>
 </td>
 <td width="10%" class='listado2' ><font size=1>
 	<? echo $etapaFinalList ?>
 </td>
 <td width="80%" class='listado2' ><font size=1>
 	<? echo $descripcionAristaList ?>
 </td>
 <td width="10%" class='listado2' ><font size=1>
 	<? echo $diasMinimoList ?>
 </td>
 <td width="10%" class='listado2' ><font size=1>
 	<? echo $diasMaximoList ?>
 </td>
 <td width="80%" class='listado2' ><font size=1>
 	<? echo $tradList ?>
 </td>
 <td width="10%" class='listado2' ><font size=1>
 	<? echo ( $automaticoList == 1 ? "si" : "no" ) ?>
 </td>
 <td width="10%" class='listado2' ><font size=1>
 	<? echo ( $tipificacionList == 1 ? "si" : "no" )?>
 </td>
 <td width="80%" class='listado2' ><font size=1>
 	<? echo $serieList ?>
 </td>
 <td width="10%" class='listado2' ><font size=1>
 	<? echo $subserieList ?>
 </td>
 <td width="10%" class='listado2' ><font size=1>
 	<? echo $tprList ?>
 </td>
 <?
//Eliminación y modificacion
 ?>
 <td width="60%" class='listado2' ><font size=1>
 			<center>
				<input type="radio" name="aristaAEliminar" value="<?=$codigoArista?>" onchange="submit();"> 			
			</center>

 		</td>
 		 <td width="60%" class='listado2' ><font size=1>
 			<center>
 				<input type="button" name="Button" value="Modificar" class="botones" onClick="Start('modificaArista.php?<?=$phpsession ?>&aristaAModificar=<?=$codigoArista?>&proceso=<?=$procesoSelected?>',700,600);">
			</center>
 			
 		</td>
</tr>
<?php
	$rs->MoveNext();
}
?>
</table>

</body>
</html>