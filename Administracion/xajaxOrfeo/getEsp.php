<?php
session_start();
/**
  * Funcion que Trae los valores de las Entidades u ESP o el valor de la # pestaña segun conifguracion.
  * @autor Jairo Losada 2009-08
  * @Fundacion CorreLibre.org
  * @licencia GNU/GPL V 3
  */

$krd = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
$usua_doc = $_SESSION["usua_doc"];
$codusuario = $_SESSION["codusuario"];


$ADODB_COUNTRECS = false;

$ruta_raiz = "../..";
include_once($ruta_raiz.'/config.php'); // incluir configuracion.
 if(!isset($_SESSION['dependencia']))	include "$ruta_raiz/rec_session.php";
if ($_SESSION['usua_admin_sistema'] != 1) die(include "$ruta_raiz/sinacceso.php");
include_once($ruta_raiz."/include/db/ConnectionHandler.php");

$db = new ConnectionHandler("$ruta_raiz");
$db->conn->debug = true;

//incluímos la clase ajax
require ('../../include/xajax/xajax.inc.php');

//instanciamos el objeto de la clase xajax
$xajax = new xajax();

function si_no($entrada){
   if ($entrada=="true"){
       $salida = "Marcado";
   }else{
       $salida = "No marcado";
   }

   //instanciamos el objeto para generar la respuesta con ajax
   $respuesta = new xajaxResponse();
   //escribimos en la capa con id="respuesta" el texto que aparece en $salida
   $respuesta->addAssign("respuesta","innerHTML",$salida);

   //tenemos que devolver la instanciación del objeto xajaxResponse
   return $respuesta;
} 

?>

