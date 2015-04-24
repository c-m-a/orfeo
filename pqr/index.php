<?php

	// load Smarty library
	$ruta_raiz = "../";
	$ruta_libs =$ruta_raiz."pqr/";
	define('SMARTY_DIR', $ruta_libs.'libs/');
	require(SMARTY_DIR . 'Smarty.class.php');
	
	$smarty = new Smarty;
	$smarty->template_dir = './templates';
	$smarty->compile_dir = './templates_c';
	$smarty->config_dir = './configs/';
	$smarty->cache_dir = './cache/';
	
	$smarty->left_delimiter = '<!--{';
	$smarty->right_delimiter = '}-->';
	
	include_once("$ruta_raiz/include/db/ConnectionHandler.php");
	$db = new ConnectionHandler("$ruta_raiz");
	$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
	
	require (SMARTY_DIR . 'funciones.php');
	
	//Tambien se debe colocar en el archivo racicacion_pqr.php
	//tipo documental para la nueva opcion e ingreso desde el enlace alterno
	//$tipo_doc_especial = 2155 ;
	//para pruebas
	$tipo_doc_especial = 61 ;
	
	$Radicado = $_GET['error'];
		if(($Radicado)=='1')
			$smarty->assign('error', 'No se pudo generar el radicado !Verifique los datos del formulario&iexcl;' );
	
	
		elseif(($Radicado)=='2')
			$smarty->assign('error', 'No se pudo generar el radicado !Numero x Incorrecto' );
	
	//si se escribe este nombre en la direccion mostrar
	//solamente un obcion para seleccionar.
	if(isset($_GET['dosxfort'])){
		$tipos = especial($db, $tipo_doc_especial);
		$especial = "aceptar";
	}else {
		$tipos = etiqueta($db,$tipo_doc_especial);		
	}
	
	$result = descrip($db);
	$descrip = array();
	$i=1;
	while(!$result->EOF) {
		$SGD_PQR_DESCRIP 	= $result->fields["SGD_PQR_DESCRIP"];
		$descrip[$i] = ucfirst(htmlentities(StrValido($SGD_PQR_DESCRIP)));
		$i++;
		$result->MoveNext();
	}
	
	$result = makeList($db);
	$mis_ciudades = array();
	while(!$result->EOF) {
		$dpto_codi 	= $result->fields["dpto_codi"];
		$dpto_nomb	= $result->fields["dpto_nomb"];
		$mis_ciudades[$dpto_codi] = ucwords(htmlentities(StrValido($dpto_nomb)));
		$result->MoveNext();
	}
	
	$result = makeListMun($db);
	while(!$result->EOF) {
		$DPTO_CODI 	= $result->fields["DPTO_CODI"];
		$MUNI_CODI	= $result->fields["MUNI_CODI"];
		$MUNI_NOMB	= $result->fields["MUNI_NOMB"];
		$mis_municipios[] = array('DPTO_CODI'=>$DPTO_CODI,'MUNI_CODI'=>$MUNI_CODI, 'MUNI_NOMB'=>ucwords(htmlentities(StrValido($MUNI_NOMB))));
		$result->MoveNext();
	}
	if(trim($_GET["wp"])=="sigov" || trim($_GET["wp"])=="sigob" || trim(strtolower($_GET["wp"]))=="sismeg") $mrecCodi=7;
	$identificadorArchivo = substr(md5(uniqid(rand(),1)),0,5);
	if($_SERVER["REQUEST_URI"]) $paginaOrigen=$_SERVER["REQUEST_URI"];
	$smarty->assign("especial", $especial);
	$smarty->assign("identificadorArchivo", $identificadorArchivo);
	$smarty->assign("tipos", $tipos);
	$smarty->assign("descrip",$descrip);
	$smarty->assign("Departamento", $mis_ciudades);
	$smarty->assign("Municipio", $mis_municipios);
	$smarty->assign("mrecCodi", $mrecCodi);
	$smarty->assign("paginaOrigen", $paginaOrigen);
	
	$smarty->display('index.tpl');
	//include "../include/uploadAjax/uploadFile.php";
?>