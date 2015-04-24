<?php

session_start();
$ruta_raiz = "..";
foreach ($_GET as $key => $valor)   ${$key} = $valor;
foreach ($_POST as $key => $valor)   ${$key} = $valor;
define('ADODB_ASSOC_CASE', 1);

$verrad         = "";

$krd            = $_SESSION["krd"];
$dependencia    = $_SESSION["dependencia"];
$usua_doc       = $_SESSION["usua_doc"];
$codusuario     = $_SESSION["codusuario"];
$digitosDependencia = $_SESSION["digitosDependencia"];

define('SMARTY_DIR', './libs/');
	
	//inicio de de ododb
include_once    ("$ruta_raiz/include/db/ConnectionHandler.php");
require_once    ("$ruta_raiz/class_control/Mensaje.php");
if (!$db) $db = new ConnectionHandler($ruta_raiz);
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
$fecha_hoy 		= 	Date("Y-m-d");
$sqlFechaHoy	=	$db->conn->DBDate($fecha_hoy);
//echo SMARTY_DIR . 'Smarty.class.php';	
require_once(SMARTY_DIR . 'Smarty.class.php');
//Se configuran los parametros de smarty
$smarty = new Smarty;
$smarty->template_dir = './templates';
$smarty->compile_dir = './templates_c';
$smarty->left_delimiter = '<!--{';
$smarty->right_delimiter = '}-->';
	
$dependencia 	= trim($_SESSION['depecodi']);
$codusuario		= trim($_SESSION['codusuario']);
$usua_doc		= trim($_SESSION['usua_doc']);
	
	$smarty->assign("krd"	,$krd);			//recarga de session con el krd 
?>
