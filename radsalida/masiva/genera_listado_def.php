<?
$ruta_raiz = "../..";
require_once "$ruta_raiz/jhrtf/jhrtf.php";
session_start();
include "$ruta_raiz/rec_session.php";
$phpsession = session_name()."=".session_id();
if(!$masiva){
	 echo("ERROR ! NO LLEGA LA INFORMACION DE RADICACION MASIVA");
}
else {
	 $masiva->verListado();
}

?>