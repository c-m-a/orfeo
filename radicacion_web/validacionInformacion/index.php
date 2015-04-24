<?
session_start();
$nitSes = $_POST["nitSes"];
$verificarInf = $_POST["verificarInf"];
error_reporting(7);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<link rel="stylesheet" href="../../estilos/orfeo.css">
<script src="js/popcalendar.js"></script>
<script src="js/mensajeria.js"></script>
 <div id="spiffycalendar" class="text"></div>
</head>
  <body>
<?
if($verificarInf){
	$ruta_raiz = '../../control_legalidad';
	require_once('../../control_legalidad/session_orfeo.php');
	$db->conn->debug = true;
  echo "paso";
	$iSql = "SELECT  *  FROM MOVIMIENTOS_INTERNET
            MVI_NROIDENT='$nitSes'";
	$db->conn->query($iSql);


}
?>
<FORM ACTION="index.php" method=POST>
		<table width="400" border=0 class=borde_tab>
  <tbody>
    <tr>
      <th colspan="2" class=titulos2>VALIDACION INFORMACION CERTIFICADOS</th>
    </tr>
    <tr>
      <td class=titulos2>Nit</td>
      <td class=listado2><input type=text name=nitSes value='<?=$nitSes?>'></td>
      <td></td>
    </tr>
    <tr>
      <td class=titulos2>Codigo de Verifcacion / Codigo de Barras</td>
      <td  class=listado2><input type=text name=codVerificacionSes value='<?=$codVerificacionSes?>' size=14></td>
      <td></td>
    </tr>
    <tr>
      <td class=titulos2>Fecha</td>
      <td  class=listado2>
        <input type=text name=anoSes value='<?=$anoSes?>' size=2>/
        <input type=text name=mesSes value='<?=$mesSes?>' size=2>/
        <input type=text name=diaSes value='<?=$diaSes?>' size=4>
			</td>
      <td></td>
    </tr>
    <tr>
    <tr>
      <th colspan="2" class=titulos2><INPUT TYPE=SUBMIT name=verificarInf VALUE="Verificar Informacion" class="ebuttons2"></th>
    </tr>
    </tr>
  </tbody>
</table>
</FORM>

  </body>
</html>