<?
//session_start();
$ruta_raiz = "..";
require_once("$ruta_raiz/include/db/ConnectionHandler.php");
if (!$db)
		$db = new ConnectionHandler($ruta_raiz);
$db->conn->BeginTrans();
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);

$sql = "SELECT * FROM SES_TIPODOC_QYD ORDER BY SGD_TPR_DESCRIP";
$rs = $db->query($sql);
?>
<table border=0 width='100%' align="center" class="borde_tab">
<tr align="center">
<td class="titulos5" align="left" width="100%">
Seleccione el (los) Tipo (s) de Documento (s) relacionado (s)
</td>
</tr>
<tr align="center">
<td class="titulos5" align="left" width="100%">
<select multiple="multiple" name="quejas" id="quejas" size="15">
<!--
<option value="42"> QUEJA O RECLAMO CONTRA LAS SUPERVISADAS </option>
<option value="232"> BUZ&Oacute;N DE QUEJAS Y SUGERENCIAS </option>
<option value="320"> OFICIO DE TRASLADO AL LIQUIDADOR Y/O AGENTE ESPECIAL DE LA CONSULTA O QUEJA </option>
<option value="321"> RESPUESTA DEL LIQUIDADOR O AGENTE ESPECIAL A LA CONSULTA O QUEJA </option>
<option value="322"> OFICIO DE CIERRE DE QUEJA </option>
<option value="397"> OFICIO DE TRASLADO DE LA QUEJA A JUNTA DE VIGILANCIA </option>
<option value="398"> RESPUESTA A LA QUEJA DE LA JUNTA DE VIGILANCIA </option>
<option value="445"> OFICIO DE TRASLADO A LA ENTIDAD DE LA CONSULTA O QUEJA </option>
<option value="446"> RESPUESTA DE LA ENTIDAD A LA CONSULTA O QUEJA </option>
<option value="456"> QUEJA O RECLAMO CONTRA LA SUPERINTENDENCIA </option>
<option value="457"> OFICIO DE REQUERIMIENTOS POR QUEJAS </option>
-->

<?

while(!$rs->EOF){
	$tpr_codigo = $rs->fields["SGD_TPR_CODIGO"];
	$tpr_desc = $rs->fields["SGD_TPR_DESCRIP"];
	?>
	<option value="<?=$tpr_codigo?>"><?=$tpr_desc?></option>
	<?
	$rs->MoveNext();
	}
	
?>

</select>
</td>
</tr>
</table>
