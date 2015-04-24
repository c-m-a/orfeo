<table class="borde_tab" border="0" width="100%">
<tbody>
<tr class="tpar">
<td class="tpar">
<table class="borde_tab" border="0" cellpadding="0" cellspacing="5" cols="17" width="100%">
<tbody>
<tr>
<input type="hidden" name="PHPSESSID" value="<?=$PHPSESSID?>">
<?php
	$cont = 1;
	$style[] = "listado1";
	$style[] = "listado2";
	$tituloTarget = "Detalles de los expedientes de la Dependencia ";
	$tituloCol = array("Dependencia.",
				"Numero Expedientes.",
				"Ultima Fecha Modificaci&oacute;n");
	
	$totalCol = count($expedientes[0]);
	$thRow = "";
	// foreach para asignar titulos a las columnas
	foreach ($tituloCol as $nombre) {
		$thRow .= '<th class="titulos3">';
		$thRow .= '<a href=""><span class="titulos3">' . $nombre . '</span></a>';
		$throw .= '</th>';
	}
	
	echo $thRow;

	if (is_array($expedientes)) {
		foreach($expedientes as $fila) {
			$res = $cont % 2;
			$trExp .= "<tr class=\"".$style[$res] ."\" valign=\"top\" align\"right\">\n";
			$trExp .= "<td align=\"left\"><a href=\"./mostrarDetallesExpedientes.php?idEmpresa=". 
						$idEmpresa .
						"&depeCodi=" . $fila["DEPE_CODI"] .
						"&vigencia=" . $fila["VIGENCIA"] .
						"\" target=\"" . $tituloTarget . " " . $fila["DEPE_NOMB"] . "\">".
						$fila["DEPE_NOMB"] . "</a></td>\n";
			$trExp .= "<td align=\"center\"><span class=\"leidos\">". $fila["TOTAL_EXPEDIENTES"] ."</span></td>\n";
			$trExp .= "<td align=\"center\"><span class=\"leidos\">". $fila["ULTIMA_FECHA"] ."</span></td>\n";
			$trExp .= "</tr>";
			$cont++;
		}
	}
	echo $trExp;
?>
</table>
