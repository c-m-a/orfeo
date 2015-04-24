<?
session_start();

    $ruta_raiz = "..";
    if (!$_SESSION['dependencia'])
        header ("Location: $ruta_raiz/cerrar_session.php");

// Modificado 2010 aurigadl@gmail.com

/**
* Paggina index2.php que muestra respuestaRapida y paralelamente la Imagen. 
* Creado en Correlibre en 2012
* @autor Jairo Losada 2009-05
* @licencia GNU/GPL V 3
*/


foreach ($_GET as $key => $valor)   ${$key} = $valor;
foreach ($_POST as $key => $valor)   ${$key} = $valor;


define('ADODB_ASSOC_CASE', 2);
$verrad         = "";
$krd            = $_SESSION["krd"];
$dependencia    = $_SESSION["dependencia"];
$usua_doc       = $_SESSION["usua_doc"];
$codusuario     = $_SESSION["codusuario"];
$tip3Nombre     = $_SESSION["tip3Nombre"];
$tip3desc       = $_SESSION["tip3desc"];
$tip3img        = $_SESSION["tip3img"];
$descCarpetasGen= $_SESSION["descCarpetasGen"] ;
$descCarpetasPer= $_SESSION["descCarpetasPer"];

include_once    ("$ruta_raiz/include/db/ConnectionHandler.php");
require_once    ("$ruta_raiz/class_control/Mensaje.php");

if (!$db) $db = new ConnectionHandler($ruta_raiz);
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);


$isql = "select * from radicado where radi_nume_radi=$radicadopadre";
$rs = $db->conn->query($isql);

$pathImagen = $rs->fields["radi_path"];



?>
<FRAMESET cols="60%,*"  border=4 scrolling="yes" >

    <frame name="central" src="../respuesta_rapida/index.php?PHPSESSID=<?=session_id()?>&radicadopadre=<?=$radicadopadre?>&krd=krd" />
    <!-- <frame name="alto" src='<?=$ruta_raiz ."/linkArchivo.php?&PHPSESSID=".session_id()."&numrad=$radicadopadre"?>' />  -->
    <frame name="alto" src='<?=$ruta_raiz ."/bodega/".$pathImagen?>' /> 

</FRAMESET>
