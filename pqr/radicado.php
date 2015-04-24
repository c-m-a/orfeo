<?php
	// load Smarty library
	$ruta_raiz = "../";
	$ruta_libs = $ruta_raiz."pqr/";
	define('SMARTY_DIR', $ruta_libs . 'libs/');
	require (SMARTY_DIR . 'Smarty.class.php');
	
	$smarty = new Smarty;
	$smarty->template_dir = './templates';
	$smarty->compile_dir = './templates_c';
	$smarty->config_dir = './configs/';
	$smarty->cache_dir = './cache/';
	
	$smarty->left_delimiter = '<!--{';
	$smarty->right_delimiter = '}-->';
	
	$nurad 		= base64_decode($_GET['radicado']);
	$enlace 	= base64_decode($_GET['enlace']);
	$fecha 		= base64_decode($_GET['fecha']);
	$lugar 		= $_GET['lugar'];
	$tdoc 		= $_GET['tdoc'];
	$asu 		= base64_decode($_GET['asu']);
	$nombre 	= $_GET['nombre'];
	$direccion 	= $_GET['direccion_us'];
	$telefono 	= $_GET['telefono_us'];
	$correo 	= $_GET['mail_us'];
	
	
	$smarty->assign('radicado'	,$nurad);
	$smarty->assign('enlace'	,$enlace);
	$smarty->assign('fecha'		,$fecha);
	$smarty->assign('lugar'		,$lugar);	
	$smarty->assign('asunto'	,$asu);
	$smarty->assign('nombre'	,$nombre);
	$smarty->assign('direccion'	,$direccion);
	$smarty->assign('telefono'	,$telefono);
	$smarty->assign('correo'	,$correo);
	$smarty->assign('archivosAdjuntos'	,$archivosAdjuntos);
	$smarty->display('salida_radicado.tpl');
	
?>