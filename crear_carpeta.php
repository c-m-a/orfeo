<?php
  session_start();
  define('ADODB_ASSOC_CASE', 2);
  /**
   * Se añadio compatibilidad con variables globales en Off
   * @autor Infometrika 2009-05
   * @licencia GNU/GPl V3
   */
  $krd         = $_SESSION["krd"];
  $dependencia = $_SESSION["dependencia"];
  $usua_doc    = $_SESSION["usua_doc"];
  $codusuario  = $_SESSION["codusuario"];
  
  $nomcarpeta      = $_GET["carpeta"];
  $tipo_carpt      = $_GET["tipo_carpt"];
  $adodb_next_page = $_GET["adodb_next_page"];
  if ($_GET["desccarp"])
    $desccarp = $_GET["desccarp"];
  if ($_GET["nombcarp"])
    $nombcarp = $_GET["nombcarp"];
  if ($_GET["crear"])
    $crear = $_GET["crear"];
  
  $ruta_raiz = ".";
  if (!isset($_SESSION['dependencia']))
    include "./rec_session.php";
  $verrad = "";
  define('ADODB_ASSOC_CASE', 1);
  include_once "$ruta_raiz/include/db/ConnectionHandler.php";
  $db = new ConnectionHandler($ruta_raiz);
  $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
?>
<html>
<head>
<title>Crear Carpeta Personal</title>
<link rel="stylesheet" href="estilos/orfeo.css">
</head>
<script language="javascript">
//Esta funci�n de Javascript valida el texto introducido por el usuario y evita que este ingrese car�cteres especiales
//Evitando de este modo el error que por esto se esta presentando
//Realizado por: Brayan Gabriel Plazas Ria�o - DNP
//Fecha: 13 de Julio de 2005
function validar_nombre()
{
var iChars = "ABCDEFGHIJKLMN�OPQRSTUVWXYZ�����abcdefghijklmn�opqrstuvwxyz�����_-1234567890";
  for (var i = 0; i < document.form1.nombcarp.value.length; i++) 
  {
  	if ((iChars.indexOf(document.form1.nombcarp.value.charAt(i)) == -1))
	{
  	alert ("El nombre de la carpeta tiene signos especiales. \n Por favor remueva estos signos especiales e intentelo de nuevo. Solamente puede contener Letras y Numeros.");
	  document.form1.nombcarp.focus();
  	return false;
  	}
  }
}
</script>
<body bgcolor="#FFFFFF">
<form name='form1' method='GET' action='crear_carpeta.php?<?= session_name() . "=" . trim(session_id()) ?>' <?
  if (!$crear)
    echo "onSubmit='return validar_nombre()'";
?>>
		<table  width="98%" border="0" cellpadding="0" cellspacing="5" class="borde_tab">
		<tr>
		<TD width='3%' class="listado2">
		  <A HREF='eliminar_carpeta.php?<?= session_name() . "=" . session_id() ?>'>
		  <img src='./iconos/carpeta_azul_eliminar.gif' border = 0 Alt='Eliminar Carpetas'>Borrar Carpeta</A>
		</TD>
		<TD width='97%' class="titulos4" align="center">
		CREACION DE CARPETAS
		</TD>
		</tr>
		</table>
		<br>
		<?
  $nombcarp = trim($nombcarp);
  if (!$nombcarp and $crear) {
    echo "<center>DEBE ESCRIBIR UN NOMBRE DE CARPETA</CENTER>";
    $crear = "";
    
  }
  if (!$crear) {
?>
  <table width='98%' border='0' cellpadding='0' cellspacing='5' class='borde_tab'>
  <tr> 
  <td  class='titulos2' align='right'>
  Nombre de carpeta</strong></td>
  <td class='listado2' >
  	<input name='nombcarp' type='text' class='tex_area' size='25' maxlength='10'></td>
  </tr>
   <tr>
    <td class='titulos2' align='right'>Descripci&oacute;n</td>
    <td class='listado2'><input name='desccarp' type='text' class='tex_area' size='25' maxlength='30'></td>
  </tr>
  <tr> 
   <td colspan='2'>
   <div align='center'>
    <input type='submit' class='botones' value='Crear Ahora!' name=crear>
    </div></td>
   </tr>
   </table>
<?
  } else {
    $isql = "select CODI_CARP from carpeta_per 
     where depe_codi=$dependencia and usua_codi=$codusuario and codi_carp!=99 order by codi_carp desc ";
    $rs            = $db->conn->query($isql);
    $isql          = "select CODI_CARP from carpeta_per 
     where depe_codi=$dependencia and usua_codi=$codusuario and codi_carp!=99 and nomb_carp='$nombcarp' order by codi_carp desc ";
    $rs1           = $db->conn->query($isql);
    $codigocarpeta = (intval($rs->fields["CODI_CARP"]) + 1);
    if ($codigocarpeta == 99) {
      $codigocarpeta = 100;
    }
    if ($rs1->EOF) {
      $isql = "INSERT INTO CARPETA_PER(codi_carp,depe_codi,usua_codi,nomb_carp,desc_carp)
	                          values ($codigocarpeta,$dependencia,$codusuario,'$nombcarp','$desccarp')";
      $rs   = $db->query($isql);
      if ($rs == -1)
        die("<center>No se ha podido crear la carpeta, Por favor intente mas tarde");
      echo "<center></b><span class='info'>Creacion de la carpeta <b>$nombcarp</b> con exito</span> ";
    } else
      echo "<center><span class='alarmas'>No se ha podido crear la carpeta por Nombres Duplicados</span>";
    
  }
?>
</form> 

<table width='98%' border='0' cellpadding='0' cellspacing='5' class='borde_tab'>
  <tr> 
    <td  class="listado2_center" height="25" >La descripci&oacute;n de la carpeta le recordara 
      el destino final de la misma. Esto se puede ver pasando el mouse sobre cada 
      una de las carpetas. </td>
  </tr>
</table>
</body>
</html>
