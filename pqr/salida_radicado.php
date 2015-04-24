<?php
// load Smarty library
$ruta_raiz = "../";
$ruta_libs = $ruta_raiz."pqr/";
define('SMARTY_DIR', $ruta_libs . 'libs/');
require (SMARTY_DIR . 'Smarty.class.php');
define('FPDF_FONTPATH', "$ruta_raiz/fpdf/font/");
require ($ruta_raiz . "/fpdf/fpdf.php");

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

/*
 *Se agrupan las funciones en la carpeta libs
 * */
require (SMARTY_DIR . 'funciones.php');

/*
*Se reciben las variables del  archivo Newpqr.php
**/
$coddepe = $_GET['coddepe'];
$Radicado = base64_decode($_GET['nurad']);
$grbNombresUs2 = $_GET['grbNombresUs2'];
$tdoc = $_GET['tdoc'];
$asu =base64_decode($_GET['asu']);
$apell = base64_decode($_GET['apell']);
$dep = $_GET['dep'];
$muni = $_GET['muni'];
$direccion = $_GET['direccion_us'];
$telefono =$_GET['telefono_us'];
$correo = $_GET['mail_us'];

if (empty($Radicado))header("Location: ../pqr/index.php");

if (($Radicado) != '')
	$smarty->assign('radicado', $Radicado);

$fecha1 = time();
$fecha = FechaFormateada($fecha1);
/*
*Se pasan las variables a la pagina salida_radicado.tpl
*por medio del template
**/

$tipodoc =	makeLabel($db,$tdoc);
$tdoc = $tipodoc->fields["SGD_PQR_LABEL"];
$ubica = nom_muni_dpto($muni,$dep,$db);
while(!$ubica->EOF) {
	$municip	= $ubica->fields["MUNI_NOMB"];
	$departa	= $ubica->fields["DPTO_NOMB"];
	$ubica ->MoveNext();
}

$numradicado =$Radicado;
$nombre = $grbNombresUs2." ".$apell;
$lugar = $municip." - ".$departa;
//variables para generar el pdf con l no olvidar \n para dividir filas
$remitente = "Señores\nDepartamento Nacional de Planeación\nCalle 26 # 13 – 19\nTel: 381 50 00\n ";
$referencia ="REFERENCIA: $tdoc DESDE LA PAGINA WEB DEL DEPARTAMENTO NACIONAL DE PLANEACIÓN";
$contenido = "Cordial saludo,\nEsta petición se realiza con el siguiente motivo:";
$mensaje="Atentamente";
$reseptor =$nombre."\nDirección: ".$direccion."\nTeléfono:".$telefono."\nCorreo electrónico: ".$correo;

$enlace=crearpdf($numradicado,
				 $fecha,
				 $lugar,
				 $remitente,
				 $referencia,
				 $contenido,
				 $asu,
				 $mensaje,
				 $reseptor);

$smarty->assign('enlace',$enlace);
$smarty->assign('fecha',$fecha);
$smarty->assign('lugar', strtoupper($lugar));
$smarty->assign('tdoc', strtoupper($tdoc));
$smarty->assign('asunto',$asu);
$smarty->assign('nombre',$nombre);
$smarty->assign('direccion',$direccion);
$smarty->assign('telefono',$telefono);
$smarty->assign('correo',$correo);
$smarty->display('salida_radicado.tpl');