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
/*   Sixto Angel Pinz�n L�pez --- angel.pinzon@gmail.com   Desarrollador             */
/* C.R.A.  "COMISION DE REGULACION DE AGUAS Y SANEAMIENTO AMBIENTAL"                 */
/*   Liliana Gomez        lgomezv@gmail.com                Desarrolladora            */
/*   Lucia Ojeda          lojedaster@gmail.com             Desarrolladora            */
/* D.N.P. "Departamento Nacional de Planeaci�n"                                      */
/*   Hollman Ladino       hollmanlp@gmail.com                Desarrollador             */
/*                                                                                   */
/* Colocar desde esta lInea las Modificaciones Realizadas Luego de la Version 3.5    */
/*  Nombre Desarrollador   Correo     Fecha   Modificacion                           */
/*************************************************************************************/

$isql = "SELECT * FROM USUARIO WHERE USUA_LOGIN = '$usuLoginSel'";
$rsCrea = $db->conn->query($isql);

$usua_activo 	= $rsCrea->fields["USUA_ESTA"];
$prestamo		= $rsCrea->fields["USUA_PERM_PRESTAMO"];
$digitaliza		= $rsCrea->fields["PERM_RADI"];
$modificaciones	= $rsCrea->fields["USUA_PERM_MODIFICA"];
$env_correo 	= $rsCrea->fields["USUA_PERM_ENVIOS"];
$estadisticas 	= $rsCrea->fields["SGD_PERM_ESTADISTICA"];
$adm_sistema 	= $rsCrea->fields["USUA_ADMIN_SISTEMA"];
$adm_archivo 	= $rsCrea->fields["USUA_ADMIN_ARCHIVO"];
$usua_nuevoM 	= $rsCrea->fields["USUA_NUEVO"];
//echo "<hr>ppppp $usua_nuevoM<hr>";
$nivel			= $rsCrea->fields["CODI_NIVEL"];
$impresion 		= $rsCrea->fields["USUA_PERM_IMPRESION"];
$masiva 		= $rsCrea->fields["USUA_MASIVA"];
$dev_correo 	= $rsCrea->fields["USUA_PERM_DEV"];
if ($rsCrea->fields["SGD_PANU_CODI"] == 1) $s_anulaciones = 1;
if ($rsCrea->fields["SGD_PANU_CODI"] == 2) $anulaciones = 1;
if ($rsCrea->fields["SGD_PANU_CODI"] == 3) {$s_anulaciones = 1; $anulaciones = 1;}
$tablas			    = $rsCrea->fields["USUA_PERM_TRD"];
$usua_publico   = $rsCrea->fields["USUARIO_PUBLICO"];
$reasigna       = $rsCrea->fields["USUARIO_REASIGNAR"];
$firma          = $rsCrea->fields["USUA_PERM_FIRMA"];
$notifica       = $rsCrea->fields["USUA_PERM_NOTIFICA"];
$usua_permexp	  = $rsCrea->fields["USUA_PERM_EXPEDIENTE"];
$permBorraAnexos = $rsCrea->fields["PERM_BORRAR_ANEXO"];
$permTipificaAnexos = $rsCrea->fields["PERM_TIPIF_ANEXO"];
$autenticaLDAP  = $rsCrea->fields["USUA_AUTH_LDAP"];
$perm_adminflujos = $rsCrea->fields["USUA_PERM_ADMINFLUJOS"];
$permArchivar 	= $rsCrea->fields["PERM_ARCHI"];
$usua_radmail   = $rsCrea->fields["USUA_PERM_RADEMAIL"];
$usua_adment    = (isset($rsCrea->fields["USUA_PERM_ADMENT"]))? $rsCrea->fields["USUA_PERM_ADMENT"] : null;
$perm_sancionados = $rsCrea->fields["USUA_PERM_SANCIONADOS"];
$cad = "perm_tp";
$sql = "SELECT SGD_TRAD_CODIGO,SGD_TRAD_DESCR FROM SGD_TRAD_TIPORAD ORDER BY SGD_TRAD_CODIGO";
$rs_trad = $db->conn->Execute($sql);
while ($arr = $rs_trad->FetchRow()) {
  if ($rsCrea->fields["USUA_PRAD_TP".$arr['SGD_TRAD_CODIGO']] >= 0) {
    ${$cad.$arr['SGD_TRAD_CODIGO']} = $rsCrea->fields["USUA_PRAD_TP".$arr['SGD_TRAD_CODIGO']];
	} else {
    ${$cad.$arr['SGD_TRAD_CODIGO']} = 0;
	}
}
  //linea adicionada carlos barrero 17-06-08 consulta permisos para control de legalidad y entidades solidarias
  $sql_permisos="SELECT *
                  FROM SES_PERMISOS
                  WHERE USUA_LOGIN = '" . $usuLoginSel . "'";
  
  $rsPermiso = $db->conn->Execute($sql_permisos);
  if ($rsPermiso) {
    $cl = $rsPermiso->fields['PERMISO_CONT_LEG'];
    $solidarias=$rsPermiso->fields['PERMISO_CON_ENT_SOL'];	
    $usuario_internet=$rsPermiso->fields['PERMISO_USU_EXTERNO'];
  }
?>
