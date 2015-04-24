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

$status = "";

	// obtenemos los datos del archivo
	$tamano = $_FILES["archivo"]['size'];
    $tipo = $_FILES["archivo"]['type'];
    $archivo = $_FILES["archivo"]['name'];
	

        if ($archivo != "") {
            // guardamos el archivo a la carpeta files
            $destino =  "../bodega/tmp/".$archivo;
			if (copy($_FILES['archivo']['tmp_name'],$destino)) {
                $status = "Archivo subido: <b>".$archivo."</b>";
				//echo $status;
            } 	else {
                $status = "Error al subir el archivo 1";
				echo $status;
				}
		} 	else {
				//$status = "No eligio ningun archivo";
				//echo $status;
				echo "<script>alert('No adjunto ningun archivo')
    </script>";
				}


$archi=$_SESSION["archivosAdjuntos"];
$archi[count($archi)]=$archivo;
$archi = array_filter($archi);
$archi = array_unique($archi);
$archi = array_values($archi);


$_SESSION["archivosAdjuntos"] = $archi;

$smarty->assign("usuacodi", $_POST["usuacodi2"]);
$smarty->assign("usMailSelect", $_POST["usMailSelect2"]);
$smarty->assign("depecodi", $_POST["depecodi2"]);
$smarty->assign("codigoCiu", $_POST["codigoCiu2"]);
$smarty->assign("radPadre", $_POST["radPadre2"]);
$smarty->assign("usuanomb", $_POST["usuanomb2"]);
$smarty->assign("usualog", $_POST["usualog2"]);
$smarty->assign("destinatario", $_POST["destinatario2"]);
$smarty->assign("concopia", $_POST["concopia2"]);
$smarty->assign("concopiaOculta", $_POST["concopiaOculta2"]);
$smarty->assign("asunto", $_POST["respuesta2"]);
$smarty->assign("emails", $_SESSION["me"]);
$smarty->assign("adjuntos", $archi);
$smarty->display('index.tpl');

?>
