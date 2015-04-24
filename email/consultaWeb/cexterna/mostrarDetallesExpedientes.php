<?php
	$ruta_raiz 	= "../../";
	$empresa 	= array();	// Contiene los datos de la empresa
	$expedientes 	= array(); // Contiene los expediente con sus radicados
	$showDep 	= array();
	
	if (!defined('ADODB_ASSOC_CASE')) define('ADODB_ASSOC_CASE', 1);
	include ($ruta_raiz . "include/db/ConnectionHandler.php");
	include ("./class/UsuarioExterno.class.php");
	
	//$numExp = "2002420351600002E";	// Variable que tiene el numero de expediente que se va a consultar
	$idEmpresa = $HTTP_GET_VARS["idEmpresa"];  //Variable de la empresa
	$depeCodi = $HTTP_GET_VARS["depeCodi"];
	
	// Creando objecto de conexion
	$db = new ConnectionHandler($ruta_raiz);
	$usuarioExt = new UsuarioExterno($idEmpresa, $db);
	$empresa = $usuarioExt->obtenerEmp($dep);
	$vigencia = (isset($vigencia) && $vigencia == 1) ? true : false;
	$expedientes = $usuarioExt->consultarExp($depeCodi, $vigencia);
	include ("./mostrarTablaExp.php");
?>
