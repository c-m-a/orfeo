<?
$ruta_raiz = "..";
require_once("$ruta_raiz/include/db/ConnectionHandler.php");
if (!$db)
		$db = new ConnectionHandler($ruta_raiz);
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
			$sql_pre = "SELECT SGD_TAR_VALENV1,SGD_TAR_VALENV2 FROM SGD_TAR_TARIFAS WHERE SGD_FENV_CODIGO=".$_GET['empresa']." AND SGD_TAR_CODIGO=".$_GET['codigo'];
			$rs_pre = $db->conn->Execute($sql_pre);
?>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr class="listado2">
			<td align="center">Urbano ($)</td>
			<td align="center"><input  id="urbano" name="urbano" type="text" value="<?=$rs_pre->fields['SGD_TAR_VALENV1']?>" class="tex_area"></td>
			<td align="center">Nacional ($)</td>
			<td align="center"><input id="nacional" name="nacional" type="text" value="<?=$rs_pre->fields['SGD_TAR_VALENV2']?>" class="tex_area"></td>
		  </tr>
		</table>	
