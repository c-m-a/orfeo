<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>ORFEO : : : : Consulta web de estado de documentos</title>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-color: #000000;
}
-->
</style>
<script>
function loginTrue()
{
	document.formulario.submit();
}
</script>
</head>

<body>
<?php
error_reporting(0);
define('ADODB_ASSOC_CASE', 1);
/** FORMULARIO DE LOGIN A ORFEO
  * Aqui se inicia session 
	* @PHPSESID		String	Guarda la session del usuario
	* @db 					Objeto  Objeto que guarda la conexion Abierta.
	* @iTpRad				int		Numero de tipos de Radicacion
	* @$tpNumRad	array 	Arreglo que almacena los numeros de tipos de radicacion Existentes
	* @$tpDescRad	array 	Arreglo que almacena la descripcion de tipos de radicacion Existentes
	* @$tpImgRad	array 	Arreglo que almacena los iconos de tipos de radicacion Existentes
	* @query				String	Consulta SQL a ejecutar
	* @rs					Objeto	Almacena Cursor con Consulta realizada.
	* @numRegs		int		Numero de registros de una consulta
	*/
$ruta_raiz = "..";
if(session_id()) session_destroy();
include_once "$ruta_raiz/include/db/ConnectionHandler.php";
$db = new ConnectionHandler($ruta_raiz);
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
$db->conn->debug = false;
echo "<br>";
session_start();
$fechah = date("dmy") . "_" . time("hms");
$usua_nuevo=3;
if ($numeroRadicado)
{
	$numeroRadicado = str_replace("-","",$numeroRadicado);
	$numeroRadicado = str_replace("_","",$numeroRadicado);
	$numeroRadicado = str_replace(".","",$numeroRadicado);
	$numeroRadicado = str_replace(",","",$numeroRadicado);
	$numeroRadicado = str_replace(" ","",$numeroRadicado);
	include "$ruta_raiz/include/tx/ConsultaRad.php";	
	$ConsultaRad = new ConsultaRad($db);
	$idWeb = $ConsultaRad->idRadicado($numeroRadicado);
	if($numeroRadicado==$idWeb and substr($numeroRadicado,-1)=='2')
	{
		$ValidacionWeb="Si";
		$idRadicado = $idWeb;
	}
	else
	{
		$ValidacionWeb="No";
		$mensaje = "El numero de radicado digitado no existe o esta mal escrito.  Por favor corrijalo e intente de nuevo.";
		echo "<center><font color=red class=tpar><font color=red size=3>$mensaje</font></font>";
		echo "<script>alert('$mensaje');</script>";
	} 
}
	$krd = "usWeb";
	$datosEnvio = "$fechah&".session_name()."=".trim(session_id())."&ard=$krd";
  ?>
<form name=formulario action='principal.php?fechah=<?=$datosEnvio?>rad=200590082051111&pasar=no&verdatos=no&idRadicado=<?=$idRadicado?>&estadosTot=<?=md5(date('Ymd'));?>'  method=post >
<?
if($ValidacionWeb=="Si")	
{
?>
<script>
loginTrue();
</script>
<?
}
?>
</form>
<form action="index_web.php" method="post">
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="100%" height="100%" align="center" valign="middle"><table width="584" height="440" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="584" valign="top" background="imagenes/index_web.jpg"><table width="584" height="440" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="194" height="100">&nbsp;</td>
              <td width="177" height="100">&nbsp;</td>
              <td width="213" height="100">&nbsp;</td>
            </tr>
            <tr>
              <td height="150">&nbsp;</td>
              <td height="150">&nbsp;</td>
              <td height="150">&nbsp;</td>
            </tr>
            <tr>
              <td height="90">&nbsp;</td>
              <td height="90" valign="top"><div align="right">
                  <form name="form1" method="post" action="">
                    <p>
                      <input type="text" name="numeroRadicado" value="<?=$numeroRadicado?>" size="20" class="e_cajas" maxsize="14">
                    </p>
                    <p>
                      <input type="submit" name="Submit" value="   Ingresar   ">
                    </p>
                  </form>
              </div></td>
              <td height="90"><div align="right"></div></td>
            </tr>
            <tr>
              <td height="100">&nbsp;</td>
              <td height="100">&nbsp;</td>
              <td height="100">&nbsp;</td>
            </tr>
          </table></td>
        </tr>
    </table></td>
  </tr>
</table>
</form>
</body>
</html>
