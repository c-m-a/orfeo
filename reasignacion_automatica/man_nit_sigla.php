<?
session_start();
/*if (!$ruta_raiz)*/ $ruta_raiz = "..";
require_once("$ruta_raiz/include/db/ConnectionHandler.php");
include_once "$ruta_raiz/include/tx/Historico.php";
include_once ("$ruta_raiz/class_control/TipoDocumental.php");
if (!$db)
		$db = new ConnectionHandler($ruta_raiz);
$db->conn->BeginTrans();

$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);	
// $db->conn->debug=true;
$sql_expediente="SELECT SGD_SEXP_PAREXP1 FROM SGD_SEXP_SECEXPEDIENTES";
$rs_expediente=$db->query($sql_expediente);
$k=0;
while(!$rs_expediente->EOF)
	{
		$sql_bodega="SELECT SIGLA_DE_LA_EMPRESA FROM BODEGA_EMPRESAS WHERE NIT_DE_LA_EMPRESA='".$rs_expediente->fields['SGD_SEXP_PAREXP1']."'";
		$rs_bodega=$db->query($sql_bodega);
		$contador=count($rs_bodega);
		if($contador > 0)
			{
				$sql_upd="UPDATE SGD_SEXP_SECEXPEDIENTES SET SGD_SEXP_PAREXP2='".$rs_bodega->fields['SIGLA_DE_LA_EMPRESA']."' WHERE SGD_SEXP_PAREXP1='".$rs_expediente->fields['SGD_SEXP_PAREXP1']."'";
				$rs_upd=$db->query($sql_upd);
			}
			echo $sql_upd."<br>";
	$rs_expediente->MoveNext();
	$k++;
	}
echo "<strong>ACTUALIZADAS ".$k." </strong>"	
?>