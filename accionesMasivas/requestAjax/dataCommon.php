<?php
session_start();
	
	$ruta_raiz = "../..";

	//Paremetros get y pos enviados desde la aplicacion origen
	import_request_variables("gP", "");	

	//Confirmar existencia de session
		if(!isset($_SESSION['dependencia']))
			include "$ruta_raiz/rec_session.php";

	include_once	("$ruta_raiz/include/db/ConnectionHandler.php");
	$db 			= new ConnectionHandler("$ruta_raiz");	
	include_once	("$ruta_raiz/include/tx/Historico.php");	
	include_once 	("$ruta_raiz/class_control/TipoDocumental.php");
	include_once	("$ruta_raiz/include/query/busqueda/busquedaPiloto1.php");	
	include_once 	("$ruta_raiz/include/tx/Expediente.php");
	
	//require_once	("$ruta_raiz/FirePHPCore/fb.php");		
	
	
	$Historico 		= new Historico($db);
	$trd 			= new TipoDocumental($db);
	$expediente 	= new Expediente($db);   
	
	$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);	

	header("Content-Type: application/json");
	//require_once('../../FirePHPCore/fb.php');	
	
	//Declaracion de la variables comunes a lor archivos de este directorio
	$depenUsua		= $_SESSION['dependencia'];
	$codusuario		= $_SESSION["codusuario"];
	$usua_nomb		= $_SESSION["usua_nomb"];
	$usua_doc		= $_SESSION["usua_doc"];
	$login			= $_SESSION["krd"];
	
	$fecha_hoy 		= Date("Y-m-d");
	$sqlFechaHoy	= $db->conn->DBDate($fecha_hoy);
		
	//Funcion error : Retorna valor para ser leido por el javascript	
	function salirError ($mensaje) {
		$accion		= 	array( 'respuesta' 	=> false,
							   'mensaje'	=> utf8_encode($mensaje));
		print_r(json_encode($accion));
		return;
	}	
	
	//Filtrar caracteres extraños en textos	
	function strValido($string){
		$arr 	= array('/[^\w:()\sáéíóúÁÉÍÓÚ=#\-,.;ñÑ]+/', '/[\s]+/');
		$asu 	= preg_replace($arr[0], '',$string);		
		return    trim(strtoupper(preg_replace($arr[1], ' ',$asu)));
	}	 
?>
