<?
$ruta_raiz = "../../..";
$carpetaOld = $carpeta;
$tipoCarpOld = $tipo_carp;
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
function Start(URL, WIDTH, HEIGHT)
{
 windowprops = "top=0,left=0,location=no,status=no, menubar=no,scrollbars=yes, resizable=yes,width=700,height=500";
 preview = window.open(URL , "preview", windowprops);
}

function f_close(){
	window.close();
}

function regresar(){
	f_close();
}	
	
//-->
</script>



</head>
<body>
<?
//	include "$ruta_raiz/debugger.php";

?>
<table border=1 width=93% class=t_bordeGris align="center">
<tr align='middle'><td height="25" class="titulos4" colspan="10">CONEXIONES QUE TIENE EL FLUJO ACTUALMENTE </td></tr>
</table>
<table border=1 width=93% class=t_bordeGris align="center">
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
<!--	<th  width='5%' class="titulos2">MODIFICAR</th> -->
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
 	<center><? echo $etapaInicialList ?></center>
 </td>
 <td width="10%" class='listado2' ><font size=1>
 <center>	<? echo $etapaFinalList ?></center>
 </td>
 <td width="80%" class='listado2' ><font size=1>
 <center>	<? echo $descripcionAristaList ?></center>
 </td>
 <td width="10%" class='listado2' ><font size=1>
 	<center><? echo $diasMinimoList ?></center>
 </td>
 <td width="10%" class='listado2' ><font size=1>
 <center>	<? echo $diasMaximoList ?></center>
 </td>
 <td width="80%" class='listado2' ><font size=1>
 	<center><? echo $tradList ?></center>
 </td>
 <td width="10%" class='listado2' ><font size=1>
 	<center><? echo ( $automaticoList == 1 ? "si" : "no" ) ?></center>
 </td>
 <td width="10%" class='listado2' ><font size=1>
 	<center><? echo ( $tipificacionList == 1 ? "si" : "no" )?>
 </td>
 <td width="80%" class='listado2' ><font size=1>
 	<center><? echo $serieList ?></center>
 </td>
 <td width="10%" class='listado2' ><font size=1>
 	<center><? echo $subserieList ?></center>
 </td>
 <td width="10%" class='listado2' ><font size=1>
 	<center><? echo $tprList ?></center>
 </td>
 
 <?
//Eliminación y modificacion
 ?>
 <td width="60%" class='listado2' ><font size=1>
 			<center>
				<input type="radio" name="aristaAEliminar" value="<?=$codigoArista?>" onchange="verificaEliminacion( <?=$codigoArista?>, this.form );"> 			
			</center>

 		</td>
 		 <td width="60%" class='listado2' ><font size=1>
 			<center>
 				<!--<input type="image" name="Button" value="Crear" src="../../../imagenes/modificar.gif"  onClick="Start('modificaArista.php?<?=$phpsession ?>&aristaAModificar=<?=$codigoArista?>&proceso=<?=$procesoSelected?>',700,600);">-->
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