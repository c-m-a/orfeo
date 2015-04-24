<form name="form_temas" method="post" action="verradicado.php?<?echo "mostrar_opc_envio=$mostrar_opc_envio&nomcarpeta=$nomcarpeta&carpeta=$carpeta&leido=$leido"?>">
<table border=0 width 100% cellpadding="0" cellspacing="5" class="borde_tab">
<input type=hidden name=ver_tema value="Si ver Causales">
<input type=hidden name=carpeta value='<?=$carpeta?>'>
<tr>
	<td class="titulos2"> Tema</td>
	<td width="323"> 
<?php
$ADODB_COUNTRECS = true;
$isql = "SELECT t.SGD_TMA_DESCRIP,
                  t.SGD_TMA_CODIGO 
            FROM SGD_TMA_TEMAS t,
                SGD_TMD_TEMADEPE td
            WHERE td.SGD_TMA_CODIGO = t.SGD_TMA_CODIGO AND
                  td.depe_codi = ".$_SESSION['dependencia'];
$rs = $db->conn->query($isql);
$ADODB_COUNTRECS = false;
//$regs = $rs->RecordCount();
if($rs) {
?>
		<select name="tema" class="select">
<?php
	do {
    $codigo_tma = $rs->fields["SGD_TMA_CODIGO"];
		$nombre_tma = $rs->fields["SGD_TMA_DESCRIP"];
		if($codigo_tma==$tema) {
      $datoss = " selected ";
    } else {
      $datoss = "  ";
    }
		echo "<option value=$codigo_tma $datoss>$nombre_tma</option>";
		$rs->MoveNext();
	} while(!$rs->EOF);
?>
		</select>
		<input type=submit name=grabar_tema value='Grabar Cambio' class='botones'>
<?php
} else {
	echo "<p class='error'>No se han generado temas en el sistema</p>";
}
if($grabar_tema) {
//  INTENTA ACTUALIZAR EL TEMA 
	if(!$tema) $tema=0;
	$recordSet["SGD_TMA_CODIGO"] = $tema;
	$recordSet["RADI_NUME_RADI"] = $verrad;
	$actualizados = $db->conn->Replace("RADICADO", $recordSet,'RADI_NUME_RADI',false);
	if($actualizados==false) {	
		echo "<span class=alarmas>No se ha podido Actualizar el tema</span>";
	} else {
		echo "<span class=info>Tema Actualizado</span>";
	}
	
// FIN ACUTALIZACION DE TEMAS
}
echo "</td>";
?>
</tr>
</table>
</form>
