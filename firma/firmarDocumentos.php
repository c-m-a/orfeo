<?php
session_start();
/**
 * Programa invoca el applet que firma los documentos correspondientes a los radicados seleccionados
 * @author      Sixto Angel Pinzon
 * @version     1.0
 */
include_once "$ruta_raiz/class_control/firmaRadicado.php";
require_once("$ruta_raiz/include/db/ConnectionHandler.php");
include_once "$ruta_raiz/class_control/usuario.php";
include_once "$ruta_raiz/class_control/Radicado.php";

?>
<html>
<head>
<title>Registro de Solicitud de Firma</title>
<link rel="stylesheet" href="../estilos_totales.css">
</head>
<body>
<?
include "../config.php";
if (!$dependencia || !$usua_doc )   
	include "../rec_session.php";
$db = new ConnectionHandler($ruta_raiz);
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
$objRadicado = new Radicado($db);

//Almacena la cantidad de radicados para firma
$num = count($checkValue);
//Iterador 
$i = 0;
//Almacena la cadena de radicados que ha de ser enviada al applet
$radicados = "";
//Almacena la cadena de paths de los radicados que se han de firmar
$paths = "";
while ($i < $num) { 
	//Almacena temporalmente la solicitud de firma
	$record_id = key($checkValue); 
	if (strlen(trim ($radicados)) > 0){
		$radicados = $radicados . ",";
		$paths = $paths . ",";
	}
	$radicados = $radicados .  $record_id;
	
	$objRadicado->radicado_codigo($record_id);
	$paths = $paths . $objRadicado->getRadi_path();
	next($checkValue); 
	$i++;
}

?>
<applet  
CODEBASE="<?=$ruta_raiz?>/firma"
CODE=ap.Firma.class
archive=prueba.jar 
width=400 height=400>
<param 	name="radicados" value="<?=$radicados?>" />
<param 	name="usua_doc" value="<?=$usua_doc?>" />
<param 	name="paths" value="<?=$paths?>" />
<param 	name="servidor" value="<?=$servFirma?>" />
<param 	name="servweb" value="<?=$servWebOrfeo."/bodega/"?>" />
<param 	name="usuario" value="<?="java:".$usuario?>" />
</applet>
</body>
</html>
