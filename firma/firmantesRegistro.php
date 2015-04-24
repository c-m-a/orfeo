<?php
/**
 * Programa que registra las firmas solicitadas para un radicado
 * @author      Sixto Angel Pinzon
 * @version     1.0
 */
session_start();

if (!$dependencia || strlen(trim($usua_doc))==0 )   
	include "../rec_session.php";

//PRINT ("DOCTO....($usua_doc)");
if (!$ruta_raiz)
	$ruta_raiz="..";
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
//Se crea la conexi�n con la b ase de datos
$db = new ConnectionHandler($ruta_raiz);
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
//$db->conn->debug=true;
$db->conn->StartTrans();

//Se crea el objeto de an�lisis de firmas
$objFirma = new  FirmaRadicado($db);
//Se crea el objeto de gestion de historicos
$objHist = new Historico($db);
//Se crea el objeto usuario para traer los nombres.
$objUsuario =  new Usuario($db);
$sqlFechaHoy=$db->conn->OffsetDate(0,$db->conn->sysTimeStamp);
$fecha_hoy = Date("Y-m-d");
//Var que almacena el n�mero de firmas seleccionadas
$num = count($firmas);
//Contador de bucle
$i = 0; 
$arrRads = explode(",",$radicados);
//Contiene los radicados cuya firma se solicit� efectivamente
$radsActs="";

//Se recorre el arreglo de firmas
//Se obtien el proximo ID de registro a insertar
$sql = "select max(SGD_FIRRAD_ID) as MAX  from SGD_FIRRAD_FIRMARADS ";
$rs = $db->conn->query($sql); 
	
if  ($rs && !$rs->EOF){
	$maxValue = $rs->fields['MAX']; 
}else 
	$maxValue = 1;
//Var que almacena el n�mero de radicados seleccionados
	$numRads = count($arrRads);
//Almacena los nombres de quenes habr�n de firmar
$nombFirmas = "";
		
while ($i < $num) {
	//Var que guarda temporalmente el documento del usuario a analizar
	$doctoFirma  = $firmas[$i];
	
	//Contador de bucle interno
	$j=0;
	
	//Se llena el string con los nombres de los firmantes 
	$objUsuario->usuarioDocto($doctoFirma); 
	$nombFirmas = $nombFirmas. $objUsuario->get_usua_nomb() . "<BR>";
	
	while ($j < $numRads) {
		//$db->conn->debug=true;
		$radicado = $arrRads[$j];
		//Arreglo simple de un radicado para gestion de historicos
		$arrRad = array();
		$arrRad[]=$arrRads[$j];
		//Indaga si no se ha solicitado firma al usuario, en caso de no haberlo hecho, se registra
		if (!$objFirma->existeFirma($radicado,$doctoFirma)){
			//Sellena el arreglo con los valores a insertar
			$maxValue++;
			$values["RADI_NUME_RADI"] = $radicado;
			$values["USUA_DOC"] = "'$doctoFirma'";
			$values["SGD_FIRRAD_DOCSOLIC"] = "'$usua_doc'";
			$values["SGD_FIRRAD_FECHSOLIC"] = $sqlFechaHoy;
			$values["SGD_FIRRAD_ID"] = $maxValue;
			//PRINT ("INSERTA.................");
			//Se inserta el registro		
			if (!$db->insert("SGD_FIRRAD_FIRMARADS",$values)) {
				$db->conn->RollbackTrans();
				die ("<span class=eerrores>ERROR TRATANDO DE SOLICITAR FIRMA</span>");
			}
			
			if  (count($recordWhere)>0)
				array_splice($recordWhere, 0);  		
				
			$values2["ANEX_ESTADO"] = 2;
			$recordWhere["RADI_NUME_SALIDA"] = $radicado;
			$rs=$db->update("ANEXOS", $values2, $recordWhere);
			if (!$rs){
				$db->conn->RollbackTrans();
				die ("<span class='etextomenu'>No se ha podido actualizar la informaci�n ANEXOS"); 
			}
			//PRINT ("HISTO......($usua_doc)....");
			$objHist->insertarHistorico($arrRad,$dependencia,$codusuario,$objUsuario->depe_codi,$objUsuario->usua_codi,"Solicitud de firma digital a (".$objUsuario->get_usua_nomb().")",39);
//			($radicados,  $depeOrigen , $usCodOrigen, $depeDestino,$usCodDestino, $observacion, $tipoTx)
		
		}
		$j++; 
	}
	$i++;
	
	
}
      
$db->conn->CompleteTrans();
//Genera el texto de la opetaci�n efectuada, si es necesario
if (count($num)>0) {
?>
<table border=0 cellspace=2 cellpad=2 WIDTH=50%  class="t_bordeGris" id=tb_general align="left">
	<tr>
	<td colspan="2" class="titulos4">ACCION REQUERIDA </td>
	</tr>
	<tr>
	<td align="right" bgcolor="#CCCCCC" height="25" class="titulos2">ACCION REQUERIDA :
	</td>
	<td  width="65%" height="25" class="listado2_no_identa">
	SOLICITUD DE FIRMA
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
	<tr>
	<td align="right" bgcolor="#CCCCCC" height="25" class="titulos2">DEPENDENCIA :
	</td>
	<td  width="65%" height="25" class="listado2_no_identa">
	<?=$depe_nomb?>
	</td>
	</tr>
	<tr>
	<td align="right" bgcolor="#CCCCCC" height="25" class="titulos2">FIRMAS SOLICITADAS :
	</td>
	<td  width="65%" height="25" class="listado2_no_identa">
	<?=$nombFirmas?>
	</td>
	</tr>
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
