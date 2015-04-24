<?php
// load Smarty library
$ruta_libs = "../pqr/";
define('SMARTY_DIR', $ruta_libs.'libs/');
require(SMARTY_DIR . 'Smarty.class.php');

if($_GET["rad"]) $rad = $_GET["rad"];
$smarty = new Smarty;
$smarty->template_dir = './templates';
$smarty->compile_dir = './templates_c';
$smarty->config_dir = './configs/';
$smarty->cache_dir = './cache/';

$smarty->left_delimiter = '<!--{';
$smarty->right_delimiter = '}-->';
if($rad) $smarty->assign('rad', $rad );
$Radicado = $_GET['noexiste'];
	if(($Radicado)=='1')
		$smarty->assign('radicado', 'No exite el radicado' );
$smarty->display('consulta.tpl');


 
