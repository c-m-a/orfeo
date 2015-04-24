<?php
session_start();
$ruta_raiz = "../";
$ruta_libs = "../respuestaRapida/";
define('SMARTY_DIR', $ruta_libs . 'libs/');
require (SMARTY_DIR . 'Smarty.class.php');
$smarty = new Smarty;
$smarty->template_dir = './templates';
$smarty->compile_dir = './templates_c';
$smarty->config_dir = './configs/';
$smarty->cache_dir = './cache/';
$smarty->left_delimiter = '<!--{';
$smarty->right_delimiter = '}-->';



$archi=$_SESSION["archivosAdjuntos"];
$destino =  "../bodega/tmp/".$archi[$_POST["elBorrar"]];  

			
unlink($destino);
unset ($archi[$_POST["elBorrar"]]);
$archi = array_values($archi);


$_SESSION["archivosAdjuntos"] = $archi;


$smarty->assign("usuacodi", $_POST["usuacodi3"]);
$smarty->assign("usMailSelect", $_POST["usMailSelect3"]);
$smarty->assign("depecodi", $_POST["depecodi3"]);
$smarty->assign("codigoCiu", $_POST["codigoCiu3"]);
$smarty->assign("radPadre", $_POST["radPadre3"]);
$smarty->assign("usuanomb", $_POST["usuanomb3"]);
$smarty->assign("usualog", $_POST["usualog3"]);
$smarty->assign("destinatario", $_POST["destinatario3"]);
$smarty->assign("concopia", $_POST["concopia3"]);
$smarty->assign("concopiaOculta", $_POST["concopiaOculta3"]);
$smarty->assign("asunto", $_POST["respuesta3"]);
$smarty->assign("emails", $_SESSION["me"]);
$smarty->assign("adjuntos", $archi);
$smarty->display('index.tpl');

?>