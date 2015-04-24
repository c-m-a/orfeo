<?
session_start();
$ruta_raiz = "..";
include_once("$ruta_raiz/include/db/ConnectionHandler.php");
require_once("$ruta_raiz/include/pdf/class.ezpdf.inc");
if (!$db)	$db = new ConnectionHandler($ruta_raiz);
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
$phpsession = session_name()."=".session_id();
    $params=$phpsession."&krd=$krd&codusua=$codusua&coddepe=$coddepe";

?>
<head>
<title>Guardar en CSV</title>
<link rel="stylesheet" href="../../estilos/orfeo.css">
</head>
<body >
<CENTER>
<form action="generarcsv.php?<?=$params?>" name="form1">
<?

if (!file_exists($archivo)){
if($Gen){

	$archivo="$ruta_raiz/bodega/tmp/".$archivo.".csv";
	$com = chr(34);
	$sqli="select SGD_DEPE_CODI,SGD_DEPE_NOMB from SGD_EINV_INVENTARIO order by SGD_EINV_CODIGO";
	$rsi=$db->query($sqli);
	if(!$rsi->EOF){
	$depe=$rsi->fields['SGD_DEPE_CODI'];
	$depe_nom=$rsi->fields['SGD_DEPE_NOMB'];
	}
	$contenido="$com*DEPENDENCIA*$com,$com*OFICINA PRODUCTORA*$com,$com*CODIGO DEPENDENCIA*$com,";
	$contenido.="$com*No_EXPEDIENTE*$com,$com*TITULO*$com,$com*UNIDAD*$com,$com*FECHA_INICIAL*$com,$com*FECHA_FINAL*$com,$com*RADICADOS*$com,$com*FOLIOS_TOTAL*$com,$com*No_UNIDAD_DOCUMENTAL*$com,$com*No_UNIDAD_DOCUMENTAL_BODEGA*$com,$com*CAJA*$com,$com*CAJA_BODEGA*$com,$com*NOMBRE_SERIE*$com,$com*NUMERO_SERIE*$com,$com*NOMBRE_SUBSERIE*$com,$com*NUMERO_SUBSERIE*$com,$com*RETENCION*$com,$com*DISPOCICION_FINAL*$com,$com*UBICACION*$com,$com*OBSERVACION*$com\n";

	$sql="select * from SGD_EINV_INVENTARIO order by SGD_EINV_CODIGO";
	$rs=$db->query($sql);
	$depe=$rs->fields['SGD_DEPE_CODI'];
	$depe_nom=$rs->fields['SGD_DEPE_NOMB'];
	while(!$rs->EOF){
		$expnum=$rs->fields['SGD_EINV_EXPNUM'];
		$titulo=$rs->fields['SGD_EINV_TITULO'];
		$unidad=$rs->fields['SGD_EINV_UNIDAD'];
		$fech=$rs->fields['SGD_EINV_FECH'];
		$fechfin=$rs->fields['SGD_EINV_FECHFIN'];
		$radicados=$rs->fields['SGD_EINV_RADICADOS'];
		$folios=$rs->fields['SGD_EINV_FOLIOS'];
		$nundocu=$rs->fields['SGD_EINV_NUNDOCU'];
		$nundocub=$rs->fields['SGD_EINV_NUNDOCUBODEGA'];
		$caja=$rs->fields['SGD_EINV_CAJA'];
		$cajab=$rs->fields['SGD_EINV_CAJABODEBA'];
		$srd=$rs->fields['SGD_EINV_SRD'];
		$srd_desc=$rs->fields['SGD_EINV_NOMSRD'];
		$sbrd=$rs->fields['SGD_EINV_SBRD'];
		$sbrd_desc=$rs->fields['SGD_EINV_NOMSBRD'];
		$rete=$rs->fields['SGD_EINV_RETENCION'];
		$disfinal=$rs->fields['SGD_EINV_DISFINAL'];
		$ubicacion=$rs->fields['SGD_EINV_UBICACION'];
		$observa=$rs->fields['SGD_EINV_OBSERVACION'];
		if ($unidad==2)$unicon="AZ";
		elseif ($unidad==3)$unicon="LB";
		elseif ($unidad==4)$unicon="AR";
		else $unicon="CAR";
		if ($rete==1)$reten="AG";
		if ($rete==2)$reten="AC";
		if ($rete==3)$reten="AH";
		$contenido.="$com$depe$com,$com$depe_nom$com,$com$depe$com,";
		$contenido.="$com$expnum$com,$com$titulo$com,$com$unicon$com,$com$fech$com,$com$fechafin$com,$com$radicados$com,$com$folios$com,$com$nundocu$com,$com$nundocub$com,$com$caja$com,$com$cajab$com,$com$srd_desc$com,$com$srd$com,$com$sbrd_desc$com,$com$sbrd$com,$com$reten$com,$com$disfinal$com,$com$ubicacion$com,$com$observa$com\n";
		$rs->MoveNext();
	}
	$fp=fopen($archivo,"wb");
	fputs($fp,$contenido);
	fclose($fp);
	echo "Para ver el archivo CSV de clic aqui: ";
	?>
	<a href="<?=$archivo?>"> <?=$archivo?></a>
	<?
}
}
else echo "El archivo ya existe";
	?>

  <table width="90%" border="0" cellspacing="5" class="borde_tab">
    <tr align="center">
    <td class="titulos5">Inserte el Nombre del Archivo </td>
    <td> <input type="text" class="tiutlos5" value="<?=$archivo?>" name="archivo"> </td>
    </tr>
    <tr><td align="center"> <input type="submit" class="botones_funcion" name="Gen" value="Generar"> </td>
	<td align="center"> <input type="button" value="Cerrar" onclick="window.close();"> </td>
    </tr>
    </table>

