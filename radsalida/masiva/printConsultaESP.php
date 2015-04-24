<?
/**
 * Programa que realiza la impresión de la selección efectuada por el usuario, se invoca desde consultaESP.php
 * @author      Sixto Angel Pinzón
 * @version     1.0
 */
ini_set('register_globals',"0");
session_start();
$ruta_raiz = "../..";

require_once("$ruta_raiz/class_control/Esp.php");

if (!$db)	$db = new ConnectionHandler($ruta_raiz);
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
//$db->conn->debug=true;

//En caso de no llegar la dependencia recupera la sesión
if(!isset($_SESSION['dependencia']))	include "$ruta_raiz/rec_session.php";

$hora=date("H")."_".date("i")."_".date("s");
// var que almacena el dia de la fecha
$ddate=date('d');
// var que almacena el mes de la fecha
$mdate=date('m');
// var que almacena el año de la fecha
$adate=date('Y');
// var que almacena  la fecha formateada
$fecha=$adate."_".$mdate."_".$ddate;
//guarda el path del archivo generado
$archivo = "$ruta_raiz/bodega/masiva/tmp_$usua_doc"."_$fecha"."_$hora.$salida";
$esp = & new Esp($db);

//de acuerdo a tipo de salida seleccionado se realiza la impresión
if ($salida=="pdf")
{	$esp->generarPDF($selected0,$ruta_raiz,$archivo,$selectedctt0,$selected1,$selected2,$selectedctt1,$selectedctt2);
}else{
	$esp->generarCSV($archivo,$selected0,$selectedctt0,$selected1,$selected2,$selectedctt1,$selectedctt2);
}
	$phpsession = session_name()."=".session_id();
    $params=$phpsession."&krd=$krd&"
				."depe_nomb=$depe_nomb&usua_doc=$usua_doc&codusuario=$codusuario";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<script>
function enviar(argumento) {

	document.formMensaje.action=argumento+"?"+document.formMensaje.params.value;
	document.formMensaje.submit();

}
</script>
<head>
<title>Untitled Document</title>
<link rel="stylesheet" href="../../estilos/orfeo.css">
</head>
<body >
<CENTER>
<form action="menu_masiva.php?<?=$params?>" name="formMensaje">
  <table width="49%" border="0" cellspacing="5" class="borde_tab">
    <tr align="center">
      <td height="25" colspan="2" class="titulos2">
        RESULTADO DE LA CONSULTA
        <input type="hidden" name="documento" value="<?=$usua_doc?>">
        <input type="hidden" name="krd" value="<?=$krd ?>">
        <input type="hidden" name="selected0" value="<?=$selected0?>">
		<input type="hidden" name="selected1" value="<?=$selected1?>">
		<input type="hidden" name="selected2" value="<?=$selected2?>">
		<input type="hidden" name="selectedctt0" value="<?=$selectedctt0?>">
		<input type="hidden" name="selectedctt1" value="<?=$selectedctt1?>">
		<input type="hidden" name="selectedctt2" value="<?=$selectedctt2?>">
        <input type="hidden" name="params" value="<?=$params?>">
        </td>
    </tr>
          <tr align="left" >
            <td height="84" class=listado2 >Se
              ha generado el archivo <?=strtoupper($salida) ?> con el resultado de la consulta realizada.<BR>
              <BR>
              Para obtener el archivo guarde del destino del siguiente v&iacute;nculo
              al archivo: <a href="<?=$archivo?>" target="_blank"><?=strtoupper($salida)?> GENERADO</a>.</td>
          </tr>
		  <tr>
		  <td class="titulos5"><center>
		<input name="continuar" type="button"  class="botones_mediano" id="envia22"  value="Continuar Consulta" onClick="enviar('consultaESP.php')" >
        <input name="cerrar" type="button"  class="botones" id="envia22"  value="Cerrar"  onClick="enviar('menu_masiva.php')" >
         </center></td>
    </tr>
  </table>
</form>
</CENTER>
  <blockquote>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
  </blockquote>
</body>
</html>