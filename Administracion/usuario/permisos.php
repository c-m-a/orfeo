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
/*   Sixto Angel Pinzón López --- angel.pinzon@gmail.com   Desarrollador             */
/* C.R.A.  "COMISION DE REGULACION DE AGUAS Y SANEAMIENTO AMBIENTAL"                 */ 
/*   Liliana Gomez        lgomezv@gmail.com                Desarrolladora            */
/*   Lucia Ojeda          lojedaster@gmail.com             Desarrolladora            */
/* D.N.P. "Departamento Nacional de Planeación"                                      */
/*   Hollman Ladino       hladino@gmail.com                Desarrollador             */
/*                                                                                   */
/* Colocar desde esta lInea las Modificaciones Realizadas Luego de la Version 3.5    */
/*  Nombre Desarrollador   Correo     Fecha   Modificacion                           */
/*************************************************************************************/
?>
<?
	$ruta_raiz = "../..";
	session_start();
	if(!$dependencia or !$tpDepeRad or !$codusuario) include "$ruta_raiz/rec_session.php";	
	include_once "$ruta_raiz/include/db/ConnectionHandler.php";	
	$db = new ConnectionHandler("$ruta_raiz");	
	//$db->conn->debug = true;
	error_reporting(0);
	$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
	$sqlFechaHoy=$db->conn->DBTimeStamp(time());			
?>	 
<html>
<head>
<title></title>
<style type="text/css">
<!--
.Estilo1 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
}
-->
</style>
</head>
<SCRIPT LANGUAGE="JavaScript" SRC="CalendarPopup.js"></SCRIPT>
<body style="background-color:#FFFFFF">
<?
$encabezado = "krd=$krd&usModo=$usModo&nivel=$nivel&dep_sel=$dep_sel&perfil=$perfil&cedula=$cedula&usuLogin=$usuLogin&nombre=$nombre&entrada=$entrada&dia=$dia&mes=$mes&ano=$ano&ubicacion=$ubicacion&piso=$piso&extension=$extension&email=$email";
?>
<center>
<form name="frmPermisos" action='grabar.php?<?=session_name()."=".session_id()."&$encabezado"?>' method="post">
<tr>
<td>  
<table border=1 width=80% class=t_bordeGris>
	<tr>
    <td colspan="2">
	<center>
	<p><B><span class=etexto>ADMINISTRACION DE USUARIOS Y PERFILES</span></B> </p>
	<p><B><span class=etexto>Asignacion de Permisos</span></B> </p></center>
	</td>
  	</tr>
<?
	if ($usModo ==2) {			
	} else {
		$usua_activo = 1;
		$usua_nuevo = 0;
	}
?>  
  	<tr>
    <td align="left" class="vbmenu_control"> <input type="checkbox" name="entrada" value="$entrada" <? if ($entrada) echo "checked"; else echo "";?>>
      Radicaci&oacute;n de Entrada</td>
    <td align="left" class="vbmenu_control"> <input name="modificaciones" type="checkbox" value="$modificaciones" <? if ($modificaciones) echo "checked"; else echo "";?>> 
      Modificaciones</td>
	</tr>
  
  	<tr>
    <td align="left" class="vbmenu_control"> <input type="checkbox" name="salida" value="$salida" <? if ($salida)  echo "checked"; else echo "";?>>
      Radicaci&oacute;n de Salida </td>
    <td align="left" class="vbmenu_control"> <input type="checkbox" name="masiva" value="$masiva" <? if ($masiva) echo "checked"; else echo "";?>> 
      Radicaci&oacute;n Masiva</td>
	</tr>
  
	<tr>
    <td align="left" class="vbmenu_control"><input type="checkbox" name="impresion" value="$impresion" <? if ($impresion) echo "checked"; else echo "";?>>
      Impresi&oacute;n </td>
    <td align="left">&nbsp;</td>
  	</tr>  

	<tr>
    <td align="left" class="vbmenu_control"> <input type="checkbox" name="memorandos" value="$memorandos" <? if ($memorandos) echo "checked"; else echo "";?>>
      Radicaci&oacute;n Memorandos</td>
    <td align="left" class="vbmenu_control"> <input type="checkbox" name="resoluciones" value="$resoluciones" <? if ($resoluciones) echo "checked"; else echo "";?>> 
      Radicaci&oacute;n Resoluciones</td>
  	</tr>	  

	<tr>
    <td align="left" class="vbmenu_control"> <input type="checkbox" name="s_anulaciones" value="$s_anulaciones" <? if ($s_anulaciones) echo "checked"; else echo "";?>> 
      Solicitud de Anulaciones</td>
    <td align="left" class="vbmenu_control"> <input type="checkbox" name="anulaciones" value="$anulaciones" <? if ($anulaciones) echo "checked"; else echo "";?>> 
      Anulaciones</td>
	</tr>	  
  
  	<tr>
    <td align="left" class="vbmenu_control"> <input type="checkbox" name="adm_archivo" value="$adm_archivo" <? if ($adm_archivo) echo "checked"; else echo "";?>>
      Administrador de Archivo</td>
    <td align="left" class="vbmenu_control"> <input type="checkbox" name="dev_correo" value="$dev_correo" <? if ($dev_correo) echo "checked"; else echo "";?>> 
      Devoluciones de Correo</td>
  	</tr>
  
  	<tr>
    <td align="left" class="vbmenu_control"> <input type="checkbox" name="adm_sistema" value="$adm_sistema" <? if ($adm_sistema) echo "checked"; else echo "";?>>
      Administrador del Sistema</td>
    <td align="left" class="vbmenu_control"> <input type="checkbox" name="env_correo" value="$env_correo" <? if ($env_correo) echo "checked"; else echo "";?>>
      Envios de Correo</td>
  	</tr>
</table>
</td>
</tr>

<tr>
<td>
<table border=1 width=80% class=t_bordeGris>
	<tr>
    <td width="50%" align="left" class="vbmenu_control"> <input type="checkbox" name="usua_activo" value="$usua_activo" <? if ($usua_activo == 1) echo "checked"; else echo "";?>>
      Usuario Activo</td>
    <td align="left" class="vbmenu_control">Nivel de Seguridad</td>
  	</tr>  
  
  	<tr>
    <td align="left" class="vbmenu_control"> <input type="checkbox" name="usua_nuevo" value="$usua_nuevo" <? if ($usua_nuevo != 1) echo "checked"; else echo "";?>>
      Usuario Nuevo</td>
    <td align="left" class="vbmenu_control">
	<?
	$contador = 1;
	while($contador <= 5)	
	{
		echo "<input name='nivel' type='radio' value=$contador ";
		if ($rs->fields["CODI_NIVEL"] == $contador) echo "checked"; else echo "";
		echo " >".$contador;
		$contador = $contador + 1; 
	}
?>		
	</td>
  	</tr> 
    <td colspan="2"><div align="center">
		<input name="login" type="hidden" value='<?=$usuLogin?>'>	
          <input name="PHPSESSID" type="hidden" value='<?=session_id()?>'> 		  
          <input name="krd" type="hidden" value='<?=$krd?>'> 		
          <input name="cedula" type="hidden" value='<?=$cedula?>'> 		
          <input type="submit" name="Submit3" value="Grabar">
          <input type="reset" name="Submit4" value="Cancelar">
    </div></td>
</table>
</td>
</tr>

 </form> 

</body>
</html>
