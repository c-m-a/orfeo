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
<title>Registro Usuarios</title>
<link rel="stylesheet" href="../estilos/orfeo.css">
</head>

<body>
<div id="spiffycalendar" class="text"></div>
 <link rel="stylesheet" type="text/css" href="../js/spiffyCal/spiffyCal_v2_1.css">
 <script language="JavaScript" src="../js/spiffyCal/spiffyCal_v2_1.js">


 </script>
 <?
// print_r($GLOBALS);
 ?>
<form action="registro.php" method="post" name="registro">
<?
if($grabar){
	if($usua!="" and $password!="" and $password==$password2 and $nombre!="" and $cedula!=""){
		$sq="insert into usuarios_certificaciones (id,usua_login,usua_password,usua_nomb,usua_doc) values (sec_usua_cer.nextval,'".strtoupper($usua)."','".md5($password)."','".strtoupper($nombre)."','".$cedula."')";
		$rs=$db->conn->Execute($sq);
		if($rs->EOF){
			echo "El usuario ha sido creado con exito";
			?>
			<script>
				document.location.href='index.php?krd=<?=$usua?>';
			</script>
			<?
		}
		else echo "Ha habido algun error en la insercion verifique y vuelva a intentarlo";
	}
	else{
		if($nombre!="")echo "Debe colocar su nombre para el registro<br>";
		if($usua!="")echo "Debe colocar un nombre de usuario para el registro<br>";
		if($password!="")echo "Debe colocar el password para el registro<br>";
		if($password!=$password2)echo "Los dos passwords no coinciden<br>";
		if($cedula!="")echo "Debe colocar su cedula para el registro";
	}
}
?>
<center>
  <table width="300" border="0" class="borde_tab">
    <tr class="titulos4">
      <th scope="col" colspan="2">REGISTRO USUARIOS CONSTANCIAS </th>
    </tr>
    <tr class="titulos5">
      <td>USUARIO</td>
      <td ><label>
        <input name="usua" type="text" id="usua" />
      </label></td>
    </tr>
	<tr class="titulos5">
      <td >PASSWORD</td>
      <td>
	<input name="password" type="password" id="password" />
	</label></td>
    </tr>
	<tr class="titulos5">
      <td >INGRESE NUEVAMENTE EL PASSWORD</td>
      <td>
	<input name="password2" type="password" id="password2" />
	</label></td>
    </tr>
	 <tr class="titulos5">
      <td>NOMBRE</td>
      <td ><label>
        <input name="nombre" type="text" id="nombre" />
      </label></td>
    </tr>
	 <tr class="titulos5">
      <td >CEDULA</td>
      <td ><label>
        <input name="cedula" type="text" id="cedula" />
      </label></td>
    </tr>
    <tr class="titulo1">
      <td colspan="2" ><div align="center">
        <input name="grabar" type="submit" class="botones" id="grabar" value="Grabar"/>
        <input name="regresar" type="button" class="botones" id="regresar" value="Regresar" onclick="document.location.href='index.php';" />
      </div></td>
    </tr>
  </table>
</center>
</form>

</body>
</html>