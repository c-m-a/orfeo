<?
/**
 * Este programa despliega el formulario con los parámetro de selección que para consultar departamento y municipio
 * @author      Sixto Angel Pinzón
 * @version     1.0
 */
session_start();
$ruta_raiz = "../..";

//Si no llega la dependencia recupera la sesión	
if(!$_SESSION['dependencia'])	include "$ruta_raiz/rec_session.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Untitled Document</title>
<link rel="stylesheet" href="../../estilos/orfeo.css">
<script language="JavaScript" type="text/JavaScript">
/**
* Valida que el formulario desplegado se encuentre adecuadamente diligenciado y si lo está entonces envía el formulario
*/
function enviar()
{	if (document.consultar.consulta.value.length >0)
	{	document.consultar.submit();	}
	else
	{	alert("Debe ingresar el dato a consultar");	}
}
</script>
</head>
<body>
<form action="resultado_consulta_depmuni.php?<?=$phpsession?>&krd=<?=$krd?>&dependencia=<?=$dependencia?>" method="post" enctype="multipart/form-data" name="consultar" id="consultar">
<table width="45%" border="0" cellspacing="5" cellpadding="0" align="center" class="borde_tab">
	<tr align="center"  class="titulos2"> 
		<td height="25" class="titulos2">
			RADICACION MASIVA <BR>CONSULTA DE LA DIVISION POLITICA ADMINISTRATIVA<BR>(DIVIPOLA)
		</td>
	</tr>
	<tr align="center" class='listado2'> 
		<td class='listado2' height="12"><span class="etextomenu">
			<BR>Efect&uacute;e la b&uacute;squeda por el nombre del departamento o municipio.<BR><BR>
			<center><input name="consulta" type="input" size="50" class="tex_area"  id="consulta"></center>
		</td>
	</tr>
	<tr align="center" class="listado2"> 
		<td height="30" class="listado2">
        	<center><input name="enviaPrueba" type="button"  class="botones" id="enviaPrueba"  onClick="enviar();" value="Consultar"></center>
        </td>
	</tr>
</table>
</form>
</body>
</html>
