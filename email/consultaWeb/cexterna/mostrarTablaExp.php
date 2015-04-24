<?php
	include("./cabez.php");
	//include("./mostrarHtml.php");
?>
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
	$verDetalles = "Ver Detalles";
	$tituloCol = array("Numero de Expediente",
				"Fecha Inicio",
				/*"Fecha Ultimo Documento",*/
				"Descripci&oacute;n");
	
	$totalCol = count($expedientes[0]);
	$thRow = "";
	// foreach para asignar titulos a las columnas
	foreach ($tituloCol as $nombre) {
		$thRow .= '<th class="titulos3">';
		$thRow .= '<a href=""><span class="titulos3">' . $nombre . '</span></a>';
		$throw .= '</th>';
	}
	
	echo $thRow;
	foreach($expedientes as $fila) {
		$res = $cont % 2;
		$trExp .= "<tr class=\"".$style[$res] ."\" valign=\"top\" align\"right\">\n";
		$trExp .= "<td align=\"center\"><a href=\"./verExpediente.php?idEmpresa=". 
					$idEmpresa .
					"&expediente=" . $fila["SGD_EXP_NUMERO"] .
					"\">".
					$fila["SGD_EXP_NUMERO"] ."</a></td>\n";
		$trExp .= "<td align=\"center\"><span class=\"leidos\">". $fila["SGD_SEXP_FECH"] ."</span></td>\n";
		//$trExp .= "<td align=\"center\"><span class=\"leidos\">". $fila["SGD_SEXP_FECH"] ."</span></td>\n";
		$trExp .= "<td align=\"center\"><span class=\"leidos\">". $fila["SGD_FEXP_DESCRIP"] ."</span></td>\n";
		$trExp .= "</tr>";
		$cont++;
	}
	echo $trExp;
?>
</table>
</body>
</html>
