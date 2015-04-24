<?
/*************************************************************************************/
/* ORFEO GPL:Sistema de Gestion Documental		http://www.orfeogpl.org	     */
/*	Idea Original de la SUPERINTENDENCIA DE SERVICIOS PUBLICOS DOMICILIARIOS     */
/*				COLOMBIA TEL. (57) (1) 6913005  orfeogpl@gmail.com   */
/* ===========================                                                       */
/*                                                                                   */
/* Este programa es software libre. usted puede redistribuirlo y/o modificarlo       */
/* bajo los terminos de la licencia GNU General Public publicada por                 */
/* la "Free Software Foundation"; Licencia version 2. 			             */
/*                                                                                   */
/* Copyright (c) 2005 por :	  	  	                                     */
/* SSPS "Superintendencia de Servicios Publicos Domiciliarios"                       */
/*   Jairo Hernan Losada  jlosada@gmail.com                Desarrollador             */
/* C.R.A.  "COMISION DE REGULACION DE AGUAS Y SANEAMIENTO AMBIENTAL"                 */
/*   Lucia Ojeda          lojedaster@gmail.com             Desarrolladora            */
/* D.N.P. "Departamento Nacional de Planeaciï¿½n"                                      */
/*   Hollman Ladino       hollmanlp@gmail.com                Desarrollador           */
/*                                                                                   */
/* Colocar desde esta lInea las Modificaciones Realizadas Luego de la Version 3.5    */
/*  Nombre Desarrollador   Correo     Fecha   Modificacion                           */
/*************************************************************************************/
$krdOld = $krd;
session_start();
// Modificado Infométrika 24-Septiembre-2009
// Compatibilidad con register_globals = Off
$usuLoginSel = $_POST['usuLoginSel'];
$dep_sel = $_GET['dep_sel'];
$usModo = $_GET['usModo'];
$modificaciones = $_POST['modificaciones'];
$masiva = $_POST['masiva'];
$impresion = $_POST['impresion'];
$s_anulaciones = $_POST['s_anulaciones'];
$anulaciones = $_POST['anulaciones'];
$adm_archivo = $_POST['adm_archivo'];
$dev_correo = $_POST['dev_correo'];
$adm_sistema = $_POST['adm_sistema'];
$env_correo = $_POST['env_correo'];
$usua_activo = $_POST['usua_activo'];
$usua_nuevoM = $_POST['usua_nuevoM'];
$nivel = $_POST['nivel'];
$usuDocSel = $_POST['usuDocSel'];
$usuLogin = $_POST['usuLogin'];

error_reporting(0);
$ruta_raiz = "../..";
$carpetaOld = $carpeta;
$tipoCarpOld = $tipo_carp;
if(!$tipoCarpOld) $tipoCarpOld= $tipo_carpt;
if(!$krd) $krd=$krdOld;
if (!$_SESSION['dependencia'])   include "../../rec_session.php";
include "../../config.php";
include_once "$ruta_raiz/include/db/ConnectionHandler.php";
$db = new ConnectionHandler("$ruta_raiz");
define('ADODB_FETCH_ASSOC',2);
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
$rs_dep = $db->conn->Execute("SELECT DEPE_NOMB, DEPE_CODI FROM DEPENDENCIA ORDER BY DEPE_NOMB");

// CREAMOS LA VARIABLE $ARRDEPSEL QUE CONTINE LAS DEPENDECIAS QUE PUEDEN VER A LA DEPENDENCIA DEL USUARIO ACTUAL.
$rs_depvis = $db->conn->Execute("SELECT DEPENDENCIA_OBSERVA FROM DEPENDENCIA_VISIBILIDAD WHERE DEPENDENCIA_VISIBLE=$dep_sel");
$arrDepSel = array();
$i = 0;
while ($tmp = $rs_depvis->FetchRow())
{	$arrDepSel[$i] = $tmp['DEPENDENCIA_OBSERVA'];
	$i += 1;
}
?>
<html>
<head>
<title>Untitled Document</title>
<link rel="stylesheet" href="../../estilos/orfeo.css">
</head>
<body>
<?
//	$db->conn->debug = false;
$encabezado = "krd=$krd&usModo=$usModo&perfil=$perfil&dep_sel=$dep_sel&cedula=$cedula&usuLogin=$usuLogin&nombre=$nombre&dia=$dia&mes=$mes&ano=$ano&ubicacion=$ubicacion&piso=$piso&extension=$extension&email=$email&usuDocSel=$usuDocSel&usuLoginSel=$usuLoginSel";
?>
<table width="80%" align="center">
<form name="frmPermisos" action='consultaHistorico.php?<?=session_name()."=".session_id()."&$encabezado"?>' method="post">
<tr>
<td>
	<table border=1 width=80% class=t_bordeGris>
		<tr>
		<td colspan="2" class="titulos4">
			<center>
			<p><B><span class=etexto>ADMINISTRACI&Oacute;N DE USUARIOS Y PERFILES</span></B> </p>
			<?
 				$tPermisos = "Consulta de Permisos";
			?>
			<p><B><span class=etexto> <?=$tPermisos ?></span></B> </p></center>
		</td>
		</tr>
<?
	if ($usModo ==2) {
		include "traePermisos.php";
	} else {
		$usua_activo = 1;
		$usua_nuevoM = 0;
	}
?>
  	<tr>
    <td width="40%" height="26" class="listado2"> <input disabled type="checkbox" name="digitaliza" value="$digitaliza" <? if ($digitaliza) echo "checked"; else echo "";?>>
      Digitalizaci&oacute;n de Documentos</td>
    <td width="40%" height="26" class="listado2"> <input disabled type="checkbox" name="tablas" value="$tablas" <? if ($tablas) echo "checked"; else echo "";?>>
      Tablas de Retenci&oacute;n Documental</td>
	</tr>

  	<tr>
    <td width="40%" height="26" class="listado2"> <input disabled name="modificaciones" type="checkbox" value="$modificaciones" <? if ($modificaciones) echo "checked"; else echo "";?>>
      Modificaciones</td>
    <td width="40%" height="26" class="listado2"> <input disabled type="checkbox" name="masiva" value="$masiva" <? if ($masiva) echo "checked"; else echo "";?>>
      Radicaci&oacute;n Masiva</td>
	</tr>

	<tr>
    <td width="40%" height="26" class="listado2">
      Impresi&oacute;n
	  <?
		$contador = 0;
		while($contador <= 2)
		{
			echo "<input disabled name='impresion' type='radio' value=$contador ";
			if ($impresion == $contador) echo "checked"; else echo "";
			echo " >".$contador;
			$contador = $contador + 1;
		}
	  ?>
	</td>
    <td width="40%" height="26" class="listado2"><input disabled type="checkbox" name="prestamo" value="$prestamo" <? if ($prestamo) echo "checked"; else echo "";?>>
      Prestamo de Documentos</td>
  	</tr>

	<tr>
    <td width="40%" height="26" class="listado2"> <input disabled type="checkbox" name="s_anulaciones" value="$s_anulaciones" <? if ($s_anulaciones) echo "checked"; else echo "";?>>
      Solicitud de Anulaciones</td>
    <td width="40%" height="26" class="listado2"> <input disabled type="checkbox" name="anulaciones" value="$anulaciones" <? if ($anulaciones) echo "checked"; else echo "";?>>
      Anulaciones</td>
	</tr>

	<tr>
    <td width="40%" height="26" class="listado2"> <!--input disabled type="checkbox" name="adm_archivo" value="$adm_archivo" <? if ($adm_archivo) echo "checked"; else echo "";?>-->
     
	  Administrador de Archivo
	  <?
// Modificado por Fabian Mauricio Losada
	$contador = 0;
	while($contador <= 5)
	{
		echo "<input name='adm_archivo' type='radio' value=$contador ";
		if ($adm_archivo == $contador) echo "checked"; else echo "";
		echo " >".$contador;
		$contador = $contador + 1;
	}
?>
	  </td>
    <td width="40%" height="26" class="listado2"> <input disabled type="checkbox" name="dev_correo" value="$dev_correo" <? if ($dev_correo) echo "checked"; else echo "";?>>
      Devoluciones de Correo</td>
  	</tr>

  	<tr>
    <td width="40%" height="26" class="listado2"> <input disabled type="checkbox" name="adm_sistema" value="$adm_sistema" <? if ($adm_sistema) echo "checked"; else echo "";?>>
      Administrador del Sistema</td>
    <td width="40%" height="26" class="listado2"> <input disabled type="checkbox" name="env_correo" value="$env_correo" <? if ($env_correo) echo "checked"; else echo "";?>>
      Env&iacute;os de Correo</td>
  	</tr>
	  	<tr>
	<td width="40%" height="26" class="listado2"> <input disabled type="checkbox" name="reasigna" value="$reasigna" <? if ($reasigna) echo "checked"; else echo "";?>>
      Usuario Reasigna</td>
    <td width="40%" height="26" class="listado2">
      Estad&iacute;sticas
	  <?
		$contador = 0;
		while($contador <= 2)
		{
			echo "<input disabled name='estadisticas' type='radio' value=$contador ";
			if ($estadisticas == $contador) echo "checked"; else echo "";
			echo " >".$contador;
			$contador = $contador + 1;
		}
	  ?>
	</td>
  	</tr>
	<tr>
    <td width="40%" height="26" class="listado2"> <input disabled type="checkbox" name="usua_activo" value="$usua_activo" <? if ($usua_activo == 1) echo "checked"; else echo "";?>>
      Usuario Activo</td>
    <td width="40%" height="26" class="listado2">Nivel de Seguridad

	<?
	$contador = 1;
	while($contador <= 5)
	{
		echo "<input disabled name='nivel' type='radio' value=$contador ";
		if ($nivel == $contador) echo "checked"; else echo "";
		echo " >".$contador;
		$contador = $contador + 1;
	}
?>
	</td>
  	</tr>

  	<tr>
    <td width="40%" height="26" class="listado2"> <input disabled type="checkbox" name="usua_nuevoM" value="$usua_nuevoM" <? if ($usua_nuevoM == '0') echo "checked"; else echo "";?>>
      Usuario Nuevo</td>
     <td width="40%" height="26" class="listado2">Firma Digital
	<?
	$contador = 0;
	while($contador <= 3)
	{
		echo "<input disabled name='firma' type='radio' value=$contador ";
		if ($firma == $contador) echo "checked"; else echo "";
		echo " >".$contador;
		$contador = $contador + 1;
	}
?>
	</td>
  	</tr>
	<tr>
	<td height='26' width='40%' class='listado2'>
		<input disabled type="checkbox" name="permArchivar" value="$permArchivar" <? if ($permArchivar) echo "checked"; else echo "";?>>
      Puede Archivar Documentos
	</td>
	<td height='26' width='40%' class='listado2'>
		<input disabled type="checkbox" name="usua_publico" value="$usua_publico" <? if ($usua_publico) echo "checked"; else echo "";?> >
		Usuario P&uacute;blico.
	</td>
	</tr>
	<tr>
		<td width="40%" height="26" class="listado2">
			Creaci&oacute;n de expedientes.
<?
	$contador = 0;
	while($contador <= 2)
	{
		echo "<input disabled name='usua_permexp' type='radio' value=$contador ";
		if ($usua_permexp == $contador) echo "checked"; else echo "";
		echo " >".$contador;
		$contador = $contador + 1;
	}
?>
		</td>
		<td width="40%" height="26" class="listado2">
			<input disabled type="checkbox" name="notifica" value="$notifica" <? if ($notifica) echo "checked"; else echo "";?>>
			Notificaci&oacute;n de Resoluciones.
		</td>
	</tr>
</table>
<table border=1 width=80% class=t_bordeGris>
<tr>
	<td colspan="2" class="titulos4" align="center">
		<p><B><span class=etexto>Permisos Tipos de Radicados</span></B></p>
	</td>
</tr>
<?php
$sql = "SELECT SGD_TRAD_CODIGO,SGD_TRAD_DESCR FROM SGD_TRAD_TIPORAD ORDER BY SGD_TRAD_CODIGO";
$ADODB_COUNTRECS = true;
$rs_trad = $db->query($sql);
if ($rs_trad->RecordCount() >= 0)
{	$i = 1;
	$cad = "perm_tp";
	while ($arr = $rs_trad->FetchRow())
	{	(is_int($i/2)) ? print "" : print "<TR align='left'>";
		echo "<td height='26' width='40%' class='listado2'>";
		$x = 0;
		echo "&nbsp;"."(".$arr['SGD_TRAD_CODIGO'].")&nbsp;".$arr['SGD_TRAD_DESCR']."&nbsp;&nbsp;";
		while ($x<4)
		{	($x == ${$cad.$arr['SGD_TRAD_CODIGO']}) ? $chk = "checked" : $chk = "";
			echo "<input disabled type='radio' name='".$cad.$arr['SGD_TRAD_CODIGO']."' id='".$cad.$arr['SGD_TRAD_CODIGO']."' value='$x' $chk>".$x;
			$x ++;
		}
		echo "</td>";
		(is_int($i/2)) ? print "</TR>" : print "";
		$i += 1;
}	}
else echo "<tr><td align='center'> NO SE HAN GESTIONADO TIPOS DE RADICADOS</td></tr>";
$ADODB_COUNTRECS = false;
?>
</table>
<table border=1 width=80% class=t_bordeGris>
   <td height="30" colspan="2" class="listado2">
		<input name="login" type="hidden" value='<?=$usuLogin?>'>
          <input name="PHPSESSID" type="hidden" value='<?=session_id()?>'>
          <input name="krd" type="hidden" value='<?=$krd?>'>
          <input name="cedula" type="hidden" value='<?=$cedula?>'>
          <center><input class="botones" type="submit" name="Submit3" value="Historico"></center>
   </td>
   <td height="30" colspan="2" class="listado2">
          <center>
		  <a href='../formAdministracion.php?<?=session_name()."=".session_id()."&$encabezado"?>'>
		  <input class="botones" type="reset" name="Submit4" value="Cancelar"></a></center>
   </td>
</table>
</td>
</tr>
<?
	$encabezado = "&krd=$krd&dep_sel=$dep_sel&usModo=$usModo&perfil=$perfil&cedula=$cedula&dia=$dia&mes=$mes&ano=$ano&ubicacion=$ubicacion&piso=$piso&extension=$extension&email=$email";
?>
</form>
</table>
</body>
</html>
