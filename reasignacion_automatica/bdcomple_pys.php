<?
//session_start();
$ruta_raiz = "..";
require_once("$ruta_raiz/include/db/ConnectionHandler.php");
if (!$db)
		$db = new ConnectionHandler($ruta_raiz);

$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);

$Ano =date ( "Y" );
?>
<table border=0 width='100%' align="center" class="borde_tab">
<tr>
		<td class="titulos2">AÑO</td>
		<td>
			<select id="combo_anio" name="Ano" onChange="carga_bd(this.id);">
				<option value="" selected>Seleccione A&ntilde;o</option>
				<option value="<?=$Ano-1?>"><?=$Ano-1?></option>
				<option value="<?=$Ano?>"><?=$Ano?></option>
			</select>
		</td>
		<td class="titulos2">TRIMESTRE</td>
		<td>
			<div id='carga_trimestre'>
			<select multiple="multiple">
			<option>(Seleccione Trimestre)</option>
			</select>
			</div>
		</td>
	</tr>
	
	<tr class="titulos2">
		<td colspan="4">Expediente</td>
	</tr>
	<tr>
<?
$sql = "SELECT SGD_EXP_NUMERO,SGD_SEXP_PAREXP1,SGD_SEXP_PAREXP2,SGD_SEXP_PAREXP3 FROM SGD_SEXP_SECEXPEDIENTES 
			WHERE SGD_SEXP_PAREXP1 = '$cc_documento_us3'";
			
//echo $sql;
$rs = $db->query($sql);

//echo "numero:".$rs->RecordCount();
$nexpedientes=$rs->RecordCount();
if(!$rs->RecordCount())
{
?>
	<tr>
		<td class="titulos2">Crear Expediente?</td><td> <input type="checkbox" name="expediente" value="0" onClick="check(this)"></td>
	</tr>
<?
}
else
{
?>
<tr>
	<td colspan="4"><table width="100%">
<?
	while(!$rs->EOF)
	{
?>
	<tr>
		<td class="titulos2"><?=$rs->fields["SGD_EXP_NUMERO"]?></td>
		<td><?=$rs->fields["SGD_SEXP_PAREXP1"]?></td>
		<td><?=$rs->fields["SGD_SEXP_PAREXP2"]?></td>
		<td><?=$rs->fields["SGD_SEXP_PAREXP3"]?></td>
		<td><input type="radio" name="expediente" value="<?=$rs->fields["SGD_EXP_NUMERO"]?>" ></td>
	</tr>
<?
	$rs->MoveNext();
	}
?>
	<tr>
		<td class="titulos2">NINGUNO</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><input type="radio" name="expediente" value="0" checked ></td>
	</tr>
	</table></td>
</tr>
<?
}
?>
</table>
