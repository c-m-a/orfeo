<?php
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
/* D.N.P. "Departamento Nacional de Planeaci�n"                                      */
/*   Hollman Ladino       hollmanlp@gmail.com                Desarrollador             */
/*                                                                                   */
/* Colocar desde esta lInea las Modificaciones Realizadas Luego de la Version 3.5    */
/*  Nombre Desarrollador   Correo     Fecha   Modificacion                           */
/*************************************************************************************/

session_start();

$krd = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
$usua_doc = $_SESSION["usua_doc"];
$codusuario = $_SESSION["codusuario"];
$tip3Nombre=$_SESSION["tip3Nombre"];
$tip3desc = $_SESSION["tip3desc"];
$tip3img =$_SESSION["tip3img"];

foreach ($_POST as $key => $valor)   ${$key} = $valor;

$ruta_raiz = "../..";
if(!isset($_SESSION['dependencia']))	include "$ruta_raiz/rec_session.php";
$errorValida = "";
include "$ruta_raiz/config.php";
include_once "$ruta_raiz/include/db/ConnectionHandler.php";
$db = new ConnectionHandler("$ruta_raiz");

$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
//	$db->conn->debug = false;
$rs_dep = $db->conn->Execute("SELECT DEPE_NOMB, DEPE_CODI FROM DEPENDENCIA ORDER BY DEPE_NOMB");

// Creamos la variable $arrdepsel que contine las dependecias que pueden ver a la dependencia del usuario actual.
$rs_depvis = $db->conn->Execute("SELECT DEPENDENCIA_OBSERVA FROM DEPENDENCIA_VISIBILIDAD WHERE DEPENDENCIA_VISIBLE=$dep_sel");
$arrDepSel = array();
$i = 0;
while ($tmp = $rs_depvis->FetchRow()) {
  $arrDepSel[$i] = $tmp['DEPENDENCIA_OBSERVA'];
	$i++;
}
$tPermis = ($usModo == 1) ? "Asignar Permisos" : "Editar Permisos";
?>
<html>
<head>
<SCRIPT language="Javascript">
function mensaje(vari) {
	alert("evento lanzado: " + vari);
}
</SCRIPT>
<title>Permisos de Usuario</title>
<link rel="stylesheet" href="../../estilos/orfeo.css">
</head>
<body>
<?php
/** Valida que la dependencia no tenga ya JEFE **/
$isql = "SELECT USUA_NOMB, USUA_LOGIN FROM USUARIO WHERE DEPE_CODI=$dep_sel AND USUA_CODI = 1";
$rs = $db->conn->query($isql);
$nombreJefe =  $rs->fields["USUA_NOMB"];

if ($nombreJefe && $perfil=="Jefe")
{	if ($usuLogin != $rs->fields["USUA_LOGIN"])
	{	$errorValida = "SI";
?> <center><p><span class=etexto><B><?="En la dependencia " . $dep_sel . ", ya existe un usuario jefe, " . $nombreJefe . ", por favor verifique o realice los cambios necesarios para poder continuar con este proceso"?></B></span></p></center>
<?php
	}
}

/** Valida que la cedula NO EXISTA ya en la base de usuario **/
if (($usuDocSel != $cedula && $usModo == 2) || $usModo == 1)
{	$isql = "SELECT USUA_DOC FROM USUARIO WHERE USUA_DOC = " . "'"  . $cedula . "'";
	$rsCedula = $db->query($isql);
	$cedulaEncon = $rsCedula->fields["USUA_DOC"];
	if ($cedulaEncon)
	{	$errorValida = "SI";
?> <center><p><span class=etexto><B>El numero de cedula ya existe en la tabla de usuario, por favor verifique</B></span></p></center>
<?php
	}
}
/** Valida que el LOGIN NO EXISTA ya en la base de usuario **/
if (($usuLoginSel != $usuLogin && $usModo == 2) || $usModo == 1)
{	$isql = "SELECT usua_login FROM USUARIO WHERE usua_login = " . "'" . strtoupper($usuLogin) . "'";
	$rsLogin = $db->query($isql);
	$LoginEncon = $rsLogin->fields["USUA_LOGIN"];
	if ($LoginEncon)
	{	$errorValida = "SI";
?> <center><p><span class=etexto><B>El Login que desea asignar ya existe, por favor verifique.</B></span></p></center>
<?php
	}
}
$encabezado = "krd=$krd&usModo=$usModo&perfil=$perfil&dep_sel=$dep_sel&cedula=$cedula&usuLogin=$usuLogin&nombre=$nombre&dia=$dia&mes=$mes&ano=$ano&ubicacion=$ubicacion&piso=$piso&extension=$extension&email=$email&usuDocSel=$usuDocSel&usuLoginSel=$usuLoginSel";
if ($errorValida == "SI")
{
?>
	<span class=etexto><center>
	<a href='crear.php?<?=session_name()."=".session_id()."&$encabezado"?>'>Volver a Formulario Anterior</a>
	</center></span>
<?php
}
else
{
	$encabezado = "krd=$krd&usModo=$usModo&perfil=$perfil&perfilOrig=$perfilOrig&dep_sel=$dep_sel&cedula=$cedula&usuLogin=$usuLogin&nombre=$nombre&dia=$dia&mes=$mes&ano=$ano&ubicacion=$ubicacion&piso=$piso&extension=$extension&email=$email&usuDocSel=$usuDocSel&usuLoginSel=$usuLoginSel";
?>
<center>
<form name="frmPermisos" action='grabar.php?<?=session_name()."=".session_id()."&$encabezado"?>' method="post">
<tr>
<td>
<table border=1 width=80% class=t_bordeGris>
	<tr>
    <td colspan="2" class="titulos4">
	<center>
	<p><B><span class=etexto>ADMINISTRACI&Oacute;N DE USUARIOS Y PERFILES</span></B> </p>
<?php
echo $tPermis;
?>
</center>
	</td>
  	</tr>
<?php
	if ($usModo ==2) {
		include "traePermisos.php";
	} else {
		$usua_activo = 1;
		$usua_nuevoM = 0;
	}
?>
  	<tr>
    <td width="40%" height="26" class="listado2">
      <input type="checkbox" name="digitaliza" value="$digitaliza" <?php if ($digitaliza) echo "checked"; else echo "";?>>
      Digitalizaci&oacute;n de Documentos y Asociacion de imagenes</td>
    <td width="40%" height="26" class="listado2">
      <input type="checkbox" name="tablas" value="$tablas" <?php if ($tablas) echo "checked"; else echo "";?>>
      Tablas de Retenci&oacute;n Documental
    </td>
  	<tr>
		<td width="40%" height="26" class="listado2">
			<input name="modificaciones" type="checkbox" value="$modificaciones" <?php if ($modificaciones) echo "checked"; else echo "";?>>
			Modificaciones
		</td>
		<td width="40%" height="26" class="listado2">
			<input type="checkbox" name="masiva" value="$masiva" <?php if ($masiva) echo "checked"; else echo "";?>>
			Radicaci&oacute;n Masiva
		</td>
	</tr>
	<tr>
	    <td width="40%" height="26" class="listado2"> Impresi&oacute;n
	<?php
	$contador = 0;
	while($contador <= 2)
	{
		echo "<input name='impresion' type='radio' value=$contador ";
		if ($impresion == $contador) echo "checked"; else echo "";
		echo " >".$contador;
		$contador = $contador + 1;
	}
	?>
	</td>
    <td width="40%" height="26" class="listado2"><input type="checkbox" name="prestamo" value="$prestamo" <?php if ($prestamo) echo "checked"; else echo "";?>>
      Prestamo de Documentos.</td>
  	</tr>
  	<tr>
    <td width="40%" height="26" class="listado2"> <input type="checkbox" name="s_anulaciones" value="$s_anulaciones" <?php if ($s_anulaciones) echo "checked"; else echo "";?>>
      Solicitud de Anulaciones.</td>
    <td width="40%" height="26" class="listado2"> <input type="checkbox" name="anulaciones" value="$anulaciones" <?php if ($anulaciones) echo "checked"; else echo "";?>>
      Anulaciones.</td>
	</tr>
  	<tr>
    <td width="40%" height="26" class="listado2"> <!--input type="checkbox" name="adm_archivo" value="$adm_archivo" <?php if ($adm_archivo) echo "checked"; else echo "";?>-->
      Administrador de Archivo. 
	  <?php
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
    <td width="40%" height="26" class="listado2"> <input type="checkbox" name="dev_correo" value="$dev_correo" <?php if ($dev_correo) echo "checked"; else echo "";?>>
      Devoluciones de Correo.</td>
  	</tr>
  	<tr>
    <td width="40%" height="26" class="listado2"> <input type="checkbox" name="adm_sistema" value="$adm_sistema" <?php if ($adm_sistema) echo "checked"; else echo "";?>>
      Administrador del Sistema.</td>
    <td width="40%" height="26" class="listado2"> <input type="checkbox" name="env_correo" value="$env_correo" <?php if ($env_correo) echo "checked"; else echo "";?>>
      Envios de Correo.</td>
  	</tr>
	<tr>
	<td width="40%" height="26" class="listado2"> <input type="checkbox" name="reasigna" value="$reasigna" <?php if ($reasigna) echo "checked"; else echo "";?>>
      Usuario Reasigna.</td>
    <td width="40%" height="26" class="listado2"> Estad&iacute;sticas.
	<?php
	$contador = 0;
	while($contador <= 2)
	{
		echo "<input name='estadisticas' type='radio' value=$contador ";
		if ($estadisticas == $contador) echo "checked"; else echo "";
		echo " >".$contador;
		$contador = $contador + 1;
	}
?>
	</td>
  	</tr>
	<tr>
	<td width="40%" height="26" class="listado2"> <input type="checkbox" name="usua_activo" value="$usua_activo" <?php if ($usua_activo == 1) echo "checked"; else echo "";?>>
      Usuario Activo.
     </td>
    <td width="40%" height="26" class="listado2">Nivel de Seguridad.
	<?php
	$contador = 1;
	while($contador <= 5)
	{
		echo "<input name='nivel' type='radio' value=$contador ";
		if ($nivel == $contador) echo "checked"; else echo "";
		echo " >".$contador;
		$contador = $contador + 1;
	}
?>
	</td>
  	</tr>
  	<tr>
    <td width="40%" height="26" class="listado2"> <input type="checkbox" name="usua_nuevoM" value="$usua_nuevoM" <?php if ($usua_nuevoM == '0') echo "checked"; else echo "";?>>
      Usuario Nuevo.</td>
    <td width="40%" height="26" class="listado2">Firma Digital.
	<?php
	$contador = 0;
	while($contador <= 3)
	{
		echo "<input name='firma' type='radio' value=$contador ";
		if ($firma == $contador) echo "checked"; else echo "";
		echo " >".$contador;
		$contador = $contador + 1;
	}
	  ?>
	</td>
  	</tr>
  	<tr>
	<td height='26' width='40%' class='listado2'>
		<input type="checkbox" name="permArchivar" value="$permArchivar" <?php if ($permArchivar) echo "checked"; else echo "";?>>
      Puede Archivar Documentos
	</td>
	<td height='26' width='40%' class='listado2'>
		<input type="checkbox" name="usua_publico" value="$usua_publico" <?php if ($usua_publico) echo "checked"; else echo "";?> >
		Usuario P&uacute;blico.
	</td>
	</tr>
	<tr>
		<td width="40%" height="26" class="listado2">
			Creaci&oacute;n de expedientes.
<?php
	$contador = 0;
	while($contador <= 2)
	{
		echo "<input name='usua_permexp' type='radio' value=$contador ";
		if ($usua_permexp == $contador) echo "checked"; else echo "";
		echo " >".$contador;
		$contador = $contador + 1;
	}
?>
		</td>
		<td width="40%" height="26" class="listado2">
			<input type="checkbox" name="notifica" value="$notifica" <?php if ($notifica) echo "checked"; else echo "";?>>
			Notificaci&oacute;n de Resoluciones.
		</td>
	</tr>
	<tr>
		<td width="40%" height="26" class="listado2"> <input type="checkbox" name="usua_radmail" value="$usua_radmail" <?php if ($usua_radmail) echo "checked"; else echo "";?>>
      Radicaci&oacute;n correos electr&oacute;nicos.</td>
        <td width="40%" height="26" class="listado2">
          <input name="solidarias" type="checkbox" id="solidarias" value="1" <?=(isset($solidarias) && $solidarias==1)? 'checked' : null?>>
      Entidades Solidarias </td></tr>
<tr>
<td width="40%" height="26" class="listado2">
  <input name="usuario_internet" type="checkbox" id="usuario_internet" value="1" <?=(isset($usuario_internet) && $usuario_internet == 1)? 'checked' : null?>>
      Usuario Permiso Internet</td>
<td width="40%" height="26" class="listado2"><input name="usua_adment" type="checkbox" id="usua_adment" value="1" <? if ($usua_adment==1) echo "checked"; else echo "";?>>
      Administracion Entidades Solidarias</td>
	</tr>
</table>
<table border=1 width=80% class=t_bordeGris>
<tr>
	<td colspan="2" class="titulos4" align="center">
		<p><B><span class=etexto>Permisos Tipos de Radicados</span></B></p>
	</td>
	
</tr>
<?php
$sql = "SELECT SGD_TRAD_CODIGO,
                SGD_TRAD_DESCR
          FROM SGD_TRAD_TIPORAD
          ORDER BY SGD_TRAD_CODIGO";
$ADODB_COUNTRECS = true;
$rs_trad = $db->conn->query($sql);
if ($rs_trad->RecordCount() >= 0) {
  $i = 1;
	$cad = "perm_tp";
	while ($arr = $rs_trad->FetchRow()) {
    echo (is_int($i/2))? '' : "<TR align='left'>";
		echo "<td height='26' width='40%' class='listado2'>";
		$x = 0;
		echo "&nbsp;"."(".$arr['SGD_TRAD_CODIGO'].")&nbsp;".$arr['SGD_TRAD_DESCR']."&nbsp;&nbsp;";
		while ($x<4)
		{	($x == ${$cad.$arr['SGD_TRAD_CODIGO']}) ? $chk = "checked" : $chk = "";
			echo "<input type='radio' name='".$cad.$arr['SGD_TRAD_CODIGO']."' id='".$cad.$arr['SGD_TRAD_CODIGO']."' value='$x' $chk>".$x;
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

<?php
/*Empieza sección permisos login
*/
?>
<table border=1 width=80% class=t_bordeGris>
<tr>
	<td colspan="2" class="titulos4" align="center">
		<p><B><span class=etexto>Otros Permisos Especiales</span></B></p>
	</td>
</tr>

<tr>
	<td height='26' width='40%' class='listado2'>
		<input type="checkbox" name="permBorraAnexos" value="$permBorraAnexos" <?php if ($permBorraAnexos) echo "checked"; else echo "";?>>
      Puede borrar Anexos .tif
	</td>
	<td height='26' width='40%' class='listado2'>
		<input type="checkbox" name="permTipificaAnexos" value="$permTipificaAnexos" <?php if ($permTipificaAnexos) echo "checked"; else echo "";?>>
      Puede Tipificar Anexos .tif
	</td>
</tr>
<tr>
	<td height='26' width='40%' class='listado2'>
		<input type="checkbox" name="autenticaLDAP" value="$autenticaLDAP" <?php if ($autenticaLDAP) echo "checked"; else echo "";?>>
      Se autentica por medio de LDAP
	</td>
	<td height='26' width='40%' class='listado2'>
		<input type="checkbox" name="perm_adminflujos" value="$$perm_adminflujos" <?php if ($perm_adminflujos) echo "checked"; else echo "";?>>
      Puede utilizar el editor de Flujos
	</td>
</tr>
<tr>
<?
$sql_cl="SELECT permiso_cont_leg FROM ses_permisos where usua_login='$usuLogin'";
$rs_cl=$db->conn->query($sql_cl);
?>
	<td height='26' width='40%' class='listado2'>Control de legalidad 
	  <input name="cl" type="radio" value="0" <? if (isset($cl) && $cl==0) echo '"checked"';?> >
	  0 
	  <input name="cl" type="radio" value="1" <? if (isset($cl) && $cl==1) echo '"checked"';?>>
	  1
	  <input name="cl" type="radio" value="2" <? if (isset($cl) && $cl==2) echo '"checked"';?>>
	  2</td>
	<td height='26' width='40%' class='listado2'><input type="checkbox" name="perm_sancionados" value="$perm_sancionados" <?php if ($perm_sancionados) echo "checked"; else echo "";?>>
      Sancionados</td>
</tr>
</table>
<table border=1 width=80% class=t_bordeGris>
    <td height="30" colspan="2" class="listado2">
		<input name="login" type="hidden" value='<?=$usuLogin?>'>
          <input name="PHPSESSID" type="hidden" value='<?=session_id()?>'>
          <input name="krd" type="hidden" value='<?=$krd?>'>
          <input name="nusua_codi" type="hidden" value='<?=$nusua_codi?>'>
          <input name="cedula" type="hidden" value='<?=$cedula?>'>
          <center><input class="botones" type="submit" name="Submit3" value="Grabar"></center>
	</td>
    <td height="30" colspan="2" class="listado2">
          <center>
		  <a href='../formAdministracion.php?<?=session_name()."=".session_id()."&$encabezado"?>'>
		  <input class="botones" type="reset" name="Submit4" value="Cancelar"></a></center>
	</td>
</table>
</td>
</tr>
<?php
	$encabezado = "&krd=$krd&dep_sel=$dep_sel&usModo=$usModo&perfil=$perfil&cedula=$cedula&dia=$dia&mes=$mes&ano=$ano&ubicacion=$ubicacion&piso=$piso&extension=$extension&email=$email";
?>
 </form>
</center>
	<?php
	}
?>
</body>
</html>
