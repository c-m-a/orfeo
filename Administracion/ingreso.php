<?
/*************************************************************************************/
/* ORFEO GPL:Sistema de Gestion Documental		http://www.orfeogpl.org	     */
/*	Idea Original de la SUPERINTENDENCIA DE SERVICIOS PUBLICOS DOMICILIARIOS     */
/*				COLOMBIA TEL. (57) (1) 6913005  yoapoyo@orfeogpl.org */
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
/* Colocar desde esta linea las Modificaciones Realizadas Luego de la Version 3.5    */
/*  Nombre Desarrollador   Correo     Fecha   Modificacion                           */
/*************************************************************************************/
?>
<?
	$ruta_raiz = "..";
	session_start();
	if(!$dependencia or !$tpDepeRad) include "$ruta_raiz/rec_session.php";	
	$phpsession = session_name()."=".session_id();
?>
<html>
<head>
<title>Documento sin t&iacute;tulo</title>
</head>
<body>
<table width="40%"  border="1" align="center">
  <tr>
    <td colspan="2"><div align="center"><strong>Modulo de Administraci&oacute;n</strong></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="6%">1.</td>
    <td width="94%"><a href='usuario/listado.php?<?=$phpsession ?>&krd=<?=$krd?>&<? echo "fechah=$fechah"; ?>' target='mainFrame'>Usuarios y Perfiles</a></td>
  </tr>
  <tr>
    <td>2.</td>
    <td width="94%"><a href='dependencia/listado.php?>&krd=<?=$krd?>&<? echo "fechah=$fechah"; ?>' target='mainFrame'>Dependencias</a></td>
  </tr>
  <tr>
    <td>3.</td>
    <td>Carpetas</td>
  </tr>
  <tr>
    <td>4.</td>
    <td>Env&iacute;os de Correspondencia </td>
  </tr>
  <tr>
    <td>5.</td>
    <td>Tipos Documentales </td>
  </tr>
  <tr>
    <td>6.</td>
    <td>Servicios</td>
  </tr>
  <tr>
    <td>7.</td>
    <td>Tipos de Radicaci&oacute;n </td>
  </tr>
</table>
</body>
</html>
