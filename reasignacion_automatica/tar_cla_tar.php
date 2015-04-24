<?
$ruta_raiz = "..";
require_once("$ruta_raiz/include/db/ConnectionHandler.php");
if (!$db)
		$db = new ConnectionHandler($ruta_raiz);
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
			$sql_tar = "SELECT SGD_TAR_CODIGO,SGD_CLTA_DESCRIP FROM SGD_CLTA_CLSTARIF WHERE SGD_FENV_CODIGO=".$_GET['empresa'];
			$rs_tar = $db->conn->Execute($sql_tar);
?>
<select name="peso" id="peso" class="select" onchange="trae_tarifas()">
	<option value="0">--Seleccione--</option>
<?
while(!$rs_tar->EOF)
		{
?>
	<option value="<?=$rs_tar->fields["SGD_TAR_CODIGO"]?>"><?=$rs_tar->fields["SGD_CLTA_DESCRIP"]?></option>
<?
		$rs_tar->MoveNext();
		}
?>
</select>
