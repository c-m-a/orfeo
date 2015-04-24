<html>
<head>
<TITLE>SUPERSERVICIOS - CONSULTA WEB - ORFEO</TITLE>
<script>
function loginTrue()
{
	document.formulario.submit();
}
</script>
</head>
<BODY bgcolor="#003399">
<center>
<TABLE>
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
<form name=formulario action='verDatosWeb.php?fechah=<?=$datosEnvio?>rad=200590082051111&pasar=no&verdatos=no&idRadicado=<?=$idRadicado?>&estadosTot=<?=md5(date('Ymd'));?>'  method=post >
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
<form action="logRadicado.php" method="post">
<TABLE  border=0 background="../img/consultaWeb/consultaWeb.gif"  width="800" height="600">
<TR height=230>
	<TD width="200"></TD>
	<TD width="400"></TD>
</TR>
<TR valign="top">
	<TD width="200"></TD>
	<TD>
	<table width="200" border="0" align="center">
		<tr>
		<TD colspan="2"><center><font color=white face="arial" size=2><b>Numero de Radicado</b></font></center></TD>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input type="text" name="numeroRadicado" value="<?=$numeroRadicado?>" size="20" class="e_cajas" maxsize="14">
			</div></td>
		</tr>
		<tr>
			<td colspan="2"><div align="center"></div></td>
		</tr>
		<tr>
		<td width="112">
		<div align="center">
			<input type="submit" name="Submit" value="   Ingresar   ">
		</div></td>
		<td width="112">
		<div align="center">
			<input type="submit" name="Submit2" value="   Borrar   ">
		</div></td>
		</tr>
	</table>
</form>
</TR>
</TABLE>
</center>
</BODY>
</HTML>
