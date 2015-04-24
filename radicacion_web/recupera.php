<?
$ruta_raiz = "..";
$ADODB_COUNTRECS = false;
require_once("$ruta_raiz/include/db/ConnectionHandler.php");
include "../config.php";
$db = new ConnectionHandler($ruta_raiz);
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);


	$sql_radi="select * from radicado where radi_nume_radi like '2013470%'";
	$rs_radi=$db->conn->Execute($sql_radi);
	
while (!$rs_radi->EOF)
{
//	echo $rs_radi->fields['RADI_NUME_RADI'];
	exec("php -f /var/www/orfeo-3.8.0/formularioWeb_ses/formularioconf_e.php?radicado=".$rs_radi->fields['RADI_NUME_RADI']);
	$rs_radi->MoveNext();
}
?>
