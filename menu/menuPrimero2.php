
<?
/*************************************************************************************/
/* ORFEO GPL:Sistema de Gestion Documental		http://www.orfeogpl.org	     */
/*	Idea Original de la SUPERINTENDENCIA DE SERVICIOS PUBLICOS DOMICILIARIOS     */
/*				COLOMBIA TEL. (57) (1) 6913005  orfeogpl@gmail.com   */
/* ===========================                                                       */
/*                                                                                   */
/* Este programa es software libre. usted puede redistribuirlo y/o modificarlo       */
/* bajo los terminos de la licencia GNU General Public publicada por                 */
/* la "Free Software Foundation"; Licencia version 2. 			                     */
/*                                                                                   */
/* Copyright (c) 2005 por :	  	  	                                                 */
/* SSPS "Superintendencia de Servicios Publicos Domiciliarios"                       */
/*   Jairo Hernan Losada  jlosada@gmail.com                Desarrollador             */
/*   Sixto Angel PinzÃ³n LÃ³pez --- angel.pinzon@gmail.com   Desarrollador           */
/* C.R.A.  "COMISION DE REGULACION DE AGUAS Y SANEAMIENTO AMBIENTAL"                 */
/*   Lucia Ojeda          lojedaster@gmail.com             Desarrolladora            */
/* D.N.P. "Departamento Nacional de PlaneaciÃ³n"                                     */
/*   Hollman Ladino       hollmanlp@gmail.com                Desarrollador           */
/*                                                                                   */
/* Colocar desde esta lInea las Modificaciones Realizadas Luego de la Version 3.5    */
/*  Nombre Desarrollador   Correo     Fecha   Modificacion                           */
/*************************************************************************************/
?>
<body>
<table border="0" cellpadding="0" cellspacing="0" width="160">
<tr>
	<td><img src="imagenes/spacer.gif" width="10" height="1" border="0" alt=""></td>
	<td><img src="imagenes/spacer.gif" width="150" height="1" border="0" alt=""></td>
	<td><img src="imagenes/spacer.gif" width="1" height="1" border="0" alt=""></td>
</tr>
<tr>
	<td colspan="2"><img name="menu_r1_c1" src="imagenes/menu_r1_c1.gif" width="160" height="25" border="0" alt=""></td>
	<td><img src="imagenes/spacer.gif" width="1" height="25" border="0" alt=""></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td valign="top">
	<table width="150"  border="0" cellpadding="0" cellspacing="0">
	<tr>
	<td valign="top">
	<table width="150"  border="0" cellpadding="0" cellspacing="3">
<?php
if($_SESSION["usua_admin_sistema"]==1)
{
?>
	<tr valign="middle">
		<td width="25"><img src="imagenes/menu.gif" width="15" height="18"></td>
		<td width="125">
			<a href="Administracion/formAdministracion.php?<?=$phpsession ?>&<? echo "fechah=$fechah&usr=".md5($dep)."&primera=1&ent=1"; ?>" target='mainFrame' class="menu_princ">Administracion</a>
		</td>
	</tr>
<?php
}
if($_SESSION["usua_perm_adminflujos"]==1)
{
?>
	<tr valign="middle">
		<td width="25"><img src="imagenes/menu.gif" width="15" height="18"></td>
		<td width="125">
			<a href="Administracion/flujos/texto_version2/mnuFlujosBasico.php" class="menu_princ" target='mainFrame'>Editor Flujos</a>
			</td>
	</tr>				
<?php
}
if($_SESSION["usua_perm_envios"]>=1)
{
?>
	<tr valign="middle">
		<td width="25"><img src="imagenes/menu.gif" width="15" height="18"></td>
		<td width="125">
			<a href="radicacion/formRadEnvios.php?<?=$phpsession ?>&<? echo "fechah=$fechah&usr=".md5($dep)."&primera=1&ent=1"; ?>" target='mainFrame' class="menu_princ">Envios</a>
		</td>
	</tr>
<?php
}
if($_SESSION["usua_perm_modifica"] >=1)
{
?>
	<tr valign="middle">
		<td width="25"><img src="imagenes/menu.gif" width="15" height="18"></td>
		<td width="125">
			<span class="Estilo12"><a href="radicacion/edtradicado.php?<?=$phpsession ?>&krd=<?=$krd?>&<? ECHO "&fechah=$fechah&primera=1&ent=2"; ?>" target='mainFrame'  class="menu_princ">Modificaci&oacute;n</a></span>
		</td>
	</tr>
<?php
}
if($_SESSION["usua_perm_firma"]==1 || $_SESSION["usua_perm_firma"]==3)
{
?>
	<tr valign="middle">
		<td width="25"><img src="imagenes/menu.gif" width="15" height="18"></td>
		<td width="125">
			<span class="Estilo12"><a href="firma/cuerpoPendientesFirma.php?<?=$phpsession?>&<?php echo "fechaf=$fechah&carpeta=8&nomcarpeta=Documentos Para Firma Digital&orderTipo=desc&orderNo=3"; ?>" target='mainFrame' class="menu_princ">Firma Digital</a></span>
		</td>
	</tr>
<?php
}
if($_SESSION["usua_perm_intergapps"]==1 )
{
?>
	<tr valign="middle">
		<td width="25"><img src="imagenes/menu.gif" width="15" height="18"></td>
		<td width="125">
			<span class="Estilo12"><a href="aplintegra/cuerpoApLIntegradas.php?<?=$phpsession?>&<?php echo "fechaf=$fechah&carpeta=8&nomcarpeta=Aplicaciones integradas&orderTipo=desc&orderNo=3"; ?>" target='mainFrame' class="menu_princ">Aplicaciones integradas</a></span>
		</td>
	</tr>
<?php
}
if($_SESSION["usua_perm_impresion"] >= 1)
{
?>
	<tr valign="middle">
		<td width="25"><img src="imagenes/menu.gif" width="15" height="18"></td>
		<td width="125">
			<span class="Estilo12"><a href="envios/cuerpoMarcaEnviar.php?<?=$phpsession?>&krd=<?=$krd?>&<?php echo "fechaf=$fechah&usua_perm_impresion=$$usua_perm_impresion&carpeta=8&nomcarpeta=Documentos Para Impresion&orderTipo=desc&orderNo=3"; ?>" target='mainFrame' class="menu_princ">Impresi&oacute;n</a></span>
		</td>
	</tr>
<?php
}
if ($_SESSION["usua_perm_anu"]==3 or $_SESSION["usua_perm_anu"]==1)
{
?>
				<tr valign="middle">
					<td width="25"><img src="imagenes/menu.gif" width="15" height="18"></td>
					<td width="125">
						<span class="Estilo12"><a href="anulacion/cuerpo_anulacion.php?<?=$phpsession?>&krd=<?=$krd?>&krd=<?=$krd?>&tpAnulacion=1&<? echo "fechah=$fechah"; ?>" target='mainFrame' class="menu_princ">Anulaci&oacute;n</a></span>
					</td>
				</tr>
<?php
}
if ($_SESSION["usua_perm_trd"]==1)
{
?>
				<tr valign="middle">
					<td width="25"><img src="imagenes/menu.gif" width="15" height="18"></td>
					<td width="125">
						<span class="Estilo12"><a href="trd/menu_trd.php?<?=$phpsession ?>&krd=<?=$krd?>&krd=<?=$krd?>&<? echo "fechah=$fechah"; ?>" target='mainFrame' class="menu_princ">Tablas Retenci&oacute;n Documental</a></span>
					</td>
				</tr>
<?php
}
?>
				<tr valign="middle">
					<td width="25"><img src="imagenes/menu.gif" width="15" height="18"></td>
					<td width="125">
						<span class="Estilo12"><a href="busqueda/busquedaPiloto.php?<?=$phpsession ?>&etapa=1&&s_Listado=VerListado&krd=<?=$krd?>&<? echo "fechah=$fechah"; ?>" target='mainFrame' class="menu_princ">Consultas</a></span>
					</td>
				</tr>
<?php
/**
 *  $usua_admin_archivo Viene del campo con el mismo nombre en usuario y Establece permiso para ver informaci&oacute;n de
 *  documentos que tienen que bicarse fisicamente en Archivo
 *  (Por. Jh 20031101)
 */
if($_SESSION["usua_admin_archivo"]>=1)
{
	$isql = "select count(*) as CONTADOR
				from SGD_EXP_EXPEDIENTE
				where
				sgd_exp_estado=0 ";
    $rs=$db->conn->Execute($isql);
    $num_exp = $rs->fields["CONTADOR"];
?>
				<tr>
					<td>
						<img src='imagenes/menu.gif' alt='Documentos para archivar' title='Documentos para archivar' border=0 align='absmiddle'></td><td><span class="Estilo12"><a href='archivo/archivo.php?<?=$phpsession?>&krd=<?=$krd?>&<?="fechaf=$fechah&carpeta=8&nomcarpeta=Expedientes&orno=1&adodb_next_page=1"; ?>' target='mainFrame' class="menu_princ"><b>Archivo (<?=$num_exp?>)</a></span>
					</td>
				</tr>
<?php
}
if ($_SESSION["usua_perm_prestamo"]==1)
{
?>
				<tr valign="middle">
					<td width="25"><img src="imagenes/menu.gif" width="15" height="18"></td>
					<td width="125">
						<span class="Estilo12"><a href="prestamo/menu_prestamo.php?<?=$phpsession ?>&etapa=1&&s_Listado=VerListado&fechah=<?=$fechah?>" target='mainFrame' class="menu_princ">Prestamo</a></span>
					</td>
				</tr>
<?php
}
/**
 *  $usua_perm_dev  Permiso de ver documentos de devolucion de documentos enviados.
 *  (Por. Jh)
 */
if($_SESSION["usua_perm_dev"]==1)
{
?>
	<tr>
		<td>
			<img src='imagenes/menu.gif' alt='Documentos para archivar' title='Documentos para archivar' border=0 align='absmiddle'>
		</td>
		<TD>
			<span class="Estilo12">
			<a href='devolucion/cuerpoDevCorreo.php?<?=$phpsession?>&<?php echo "fechaf=$fechah&carpeta=8&devolucion=2&estado_sal=4&nomcarpeta=Documentos Para Impresion&orno=1&adodb_next_page=1"; ?>' target='mainFrame' class="menu_princ" >Dev Correo</span></a>
		</td>
	</tr>
<?php
}
/*usua_perm_emp  Permiso de insertar y modificar empresas 
 * Modificacdo idrd 
 */
//echo " usua $usua_perm_emp";
if($_SESSION["usua_perm_dev"]==1)
{
?>
	<tr>
	<td>
					<img src='imagenes/menu.gif' alt='Documentos para archivar' title='Documentos para archivar' border=0 align='absmiddle'>
	</td>
	<TD>
	<span class="Estilo12">
	<a href='devolucion/cuerpoDevCorreo.php?<?=$phpsession?>&<?php echo "fechaf=$fechah&carpeta=8&devolucion=2&estado_sal=4&nomcarpeta=Documentos Para Impresion&orno=1&adodb_next_page=1"; ?>' target='mainFrame' class="menu_princ" >Dev Correo</span></a>
	</td>
	</tr>
				</table>
			</td>
		</tr>
		</table>
	</td>
</tr>
</table>
