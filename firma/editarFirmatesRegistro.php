<?session_start();
/**
 * Programa que borra firmas solicitadas para un radicado
 * @author      Sixto Angel Pinz�n
 * @version     1.0
 */
include_once "$ruta_raiz/class_control/firmaRadicado.php";
require_once("$ruta_raiz/include/db/ConnectionHandler.php");
include_once "$ruta_raiz/class_control/usuario.php";
include_once($ruta_raiz."/include/tx/Historico.php");
?>
<html>
<head>
<title>Registro de Solicitud de Firma</title>
<link rel="stylesheet" href="../estilos/orfeo.css">
</head>
<body>
<?
if (!$dependencia || strlen(trim($usua_doc))==0  )   
	include "../rec_session.php";

if (!$db)
	$db = new ConnectionHandler($ruta_raiz);	
$db->conn->StartTrans();

//Se crea el objeto de an�lisis de firmas
$objFirma = new  FirmaRadicado($db);
//Se crea el objeto usuario para traer los nombres.
$objUsuario =  new Usuario($db);
//Se crea el objeto de gestion de historicos
$objHist = new Historico($db);
	
//$db->conn->debug=true;
//Almacena la cantidad de firmas solicitadas para borrado
$num = count($checkValue);
//Iterador 
$i=0;
//almacena los nombres de quiens firman
$nombFirmas = "";


while ($i < $num) { 
	//Almacena temporalmente la solicitud de firma a borrar
	$record_id = key($checkValue); 
	$values["SGD_FIRRAD_ID"] = $record_id;
	$datosFirma = $objFirma->firmaId($record_id);
	$objUsuario->usuarioDocto($datosFirma["USUA_DOC"]);
	$nombFirmas = $nombFirmas . $objUsuario->get_usua_nomb() . "<BR>";
	$arrRad = array();
	$arrRad[] = $datosFirma["RADI_NUME_RADI"];
	
	//Se elimina el registro		
	if (!$db->delete("SGD_FIRRAD_FIRMARADS",$values)) {
		$db->conn->RollbackTrans();
		die ("<span class=eerrores>ERROR TRATANDO DE ELIMINAR SOLICITUD DE FIRMA</span>");
	}
	$retorno['RADI_NUME_RADI'];
	$objHist->insertarHistorico($arrRad,$dependencia,$codusuario,$objUsuario->depe_codi,$objUsuario->usua_codi,"Eliminar Solicitud de firma digital a (".$objUsuario->get_usua_nomb().")",41);
	$i++;
	
	next($checkValue); 
}
$db->conn->CompleteTrans();
if ($num>0) {
?>
<table border=0 cellspace=2 cellpad=2 WIDTH=50%  class="t_bordeGris" id=tb_general align="left">
	<tr>
	<td colspan="2" class="titulos4">ACCION REQUERIDA </td>
	</tr>
	<tr>
	<td align="right" bgcolor="#CCCCCC" height="25" class="titulos2">ACCION REQUERIDA :
	</td>
	<td  width="65%" height="25" class="listado2_no_identa">
	BORRAR SOLICITUD DE FIRMA PARA RADICADO
	</td>
	</tr>
	<tr>
	<td align="right" bgcolor="#CCCCCC" height="25" class="titulos2">RADICADOS INVOLUCRADOS :
	</td>
	<td  width="65%" height="25" class="listado2_no_identa"><?=$radicados ?>
	</td>
	</tr>
	<tr>
	<td align="right" bgcolor="#CCCCCC" height="25" class="titulos2">USUARIO :
	</td>
	<td  width="65%" height="25" class="listado2_no_identa">
	<?=$usua_nomb?>
	</td>
	</tr>
	<tr>
	<td align="right" bgcolor="#CCCCCC" height="25" class="titulos2">FECHA Y HORA :
	</td>
	<td  width="65%" height="25" class="listado2_no_identa">
	<?=$fecha_hoy?>
	</td>
	</tr>
	</table>
	<?
}else{
	echo ("<span class=tituloListado>NO HUBO CAMBIOS PARA EFECTUAR </span> ");

}

?>
<BR> 
<input name="envia" type="button"  class="botones" id="envia"   value="Aceptar" onclick="opener.recargar();window.close();">
</body>
</html>
