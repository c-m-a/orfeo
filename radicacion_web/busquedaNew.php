<?
session_start();
/**
  * Se añadio compatibilidad con variables globales en Off
  * @autor Jairo Losada 2009-05
  * @Fundacion CorreLibre.org
  * @licencia GNU/GPL V 3
  */

foreach ($_GET as $key => $valor)   ${$key} = $valor;
foreach ($_POST as $key => $valor)   ${$key} = $valor;
$ruta_raiz = "..";
require_once("$ruta_raiz/include/db/ConnectionHandler.php");
$db = new ConnectionHandler($ruta_raiz);
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
include('formulario_sql.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- CSS -->
<!-- <link rel="stylesheet" href="css/structure.css" type="text/css" /> -->
<link rel="stylesheet" href="../estilos/orfeo.css">
<link rel="stylesheet" href="css/form.css" type="text/css" />
<!--funciones--><script type="text/javascript" src="ajax.js"></script>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title>&nbsp;B&uacute;squeda avanzada de entidades</title>
</head>
<body id="public">
<div id="container"  >
<br>
<form method="POST" class=listado2>
  <font size=2>Ingrese Nombre, SIGLA o NIT de la Entidad.</font><input type="text" name="entidad" size="50"/>
  <input type="submit" value='Buscar' name='Buscar' valign='middle' class=botones_3 />
  <input type="button" value='Cancelar' name="Buscar2" valign='middle' onclick="window.close();"  class=botones_3  />
  <input type="hidden" name="busca" value="busca" class=botones_3 />
</form>
<br />
<?
if(isset($_POST['busca']))
{
?>
  <font size=2>&nbsp;Resultados de la b&uacute;squeda
  </font>
<form name="busqueda" id="busqueda">  
  <table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" >
      <tr class=listado2>
        <td width="80%" class=listado2><div align="center"><strong>Nombre</strong></div></td>
        <td width="15%" class=listado2><div align="center"><strong>Nit</strong></div></td>
        <td width="5%" class=listado2> <div align="center"><strong>Seleccione</strong></div></td>
      </tr>
<?
if(($rs_bodega->RecordCount()) != 0)
{
while (!$rs_bodega->EOF)
{
?>    
      <tr class=listado2>
        <td  class=listado2><?= $rs_bodega->fields['NOMBRE_DE_LA_EMPRESA']?></td>
        <td  class=listado2><?= $rs_bodega->fields['NIT_DE_LA_EMPRESA']?></td>
        <td  align="center" class=listado2>
      <input type="radio" name="nit" value="<?= $rs_bodega->fields['NIT_DE_LA_EMPRESA']?>" id="nit" onclick="pasa_nit();" /></td>
      </tr>
<?
$rs_bodega->MoveNext();
}
}
else
{
?>
<tr><td bgcolor="#FFFFFF" colspan="3" align="center"><font color="RED">LA B&Uacute;SQUEDA NO ARROJO NINGUN RESULTADO</font><br><br>
De acuerdo con lo establecido en el art&iacute;culo 34 ley 454 de 1998. Verifique que la entidad buscada es vigilada por la Superintendencia de la Econom&iacute;a Solidaria. 

<br><a href="busqueda.php">Intente nuevamente.</a></td></tr>
<?
}
?>    
  </table><br />&nbsp;
</form>
<?
}
?>
</div>
</body>
</html>
