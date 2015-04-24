<?
session_start();

/**
  * Modificacion Variables Globales Fabian losada 2009-07
  * Licencia GNU/GPL 
  */

foreach ($_GET as $key => $valor)   ${$key} = $valor;
foreach ($_POST as $key => $valor)   ${$key} = $valor;


$ruta_raiz = "..";
include_once("$ruta_raiz/include/db/ConnectionHandler.php");
$db = new ConnectionHandler("$ruta_raiz");
	$encabezadol = "$PHP_SELF?".session_name()."=".session_id()."&dependencia=$dependencia&krd=$krd&sel=$sel";
	$encabezado = session_name()."=".session_id()."&krd=$krd&tipo_archivo=1&nomcarpeta=$nomcarpeta";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Constancia de Vigilancia</title>
<!-- Meta Tags -->
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="../estilos/orfeo.css">
<style type="text/css">
<!--
body {
	background-color: #006699;
}
.Estilo1 {font-size: 18px}
-->
</style></head>

<body>
 <?
// print_r($GLOBALS);
 ?>
<form action="gen.php" method="post" name="san">
<?
	if($krd!=""){
		$usua=$krd;
	}
?>
<center>
  <p><img src='../logoEntidad.gif' ></p>
  <p>&nbsp;</p>
</center>
<center>
  <table width="500" border="0" class="borde_tab">
    <tr class="titulos4">
      <th height="30" colspan="2" scope="col"><span class="Estilo1">CONSTANCIAS DE VIGILANCIA</span></th>
    </tr>
    <tr class="titulos5">
      <td >USUARIO</td>
      <td ><label>
        <input name="usua" type="text" id="usua" value="<?=$usua?>"/>
      </label></td>
    </tr>
	<tr class="titulos5">
      <td >PASSWORD</td>
      <td>
	<input name="password" type="password" id="password"/>
	</label></td>
    </tr>
	  <tr class="titulos5">
      <td >NIT ENTIDAD SOLIDARIA(Sin puntos ni rayas)</td>
      <td ><label>
        <input name="nit" type="text" id="nit" />
      </label></td>
    </tr>
	<tr class="titulos5">
      <td>ENTIDAD SOLIDARIA </td>
      <td ><label>
        <input name="entidad" type="text" id="entidad" />
      </label></td>
    </tr>
	<tr class="titulos5">
      <td>A QUIEN VA DIRIGIDA </td>
      <td ><label>
        <input name="diri" type="text" id="diri" />
      </label></td>
    </tr>
    <tr class="titulo1">
      <td colspan="2" ><div align="center">
        <label>
        <input name="solicitar" type="submit" class="botones"id="solicitar" value="Solicitar"/>
        </label>
        <input name="registro" type="button" class="botones" id="registro" value="Registro" onclick="document.location.href='registro.php';"/>
      </div></td>
    </tr>
  </table>
</center>
</form>

</body>
</html>