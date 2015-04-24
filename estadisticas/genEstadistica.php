<?php
session_start();
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
/*  Jairo Losada                      2009/05  Variables Globales
/******************************************************************************/
?>
<html>
<head>
<title>ORFEO - IMAGEN ESTADISTICAS </title>
		<link rel="stylesheet" href="../estilos/orfeo.css" />
</head>
<?php
define('ADODB_ASSOC_CASE', 1);

foreach ($_GET as $key => $valor)   ${$key} = $valor;
//foreach ($_POST as $key => $valor)   ${$key} = $valor;

$krd = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
$usua_doc = $_SESSION["usua_doc"];
$codusuario = $_SESSION["codusuario"];
$tip3Nombre=$_SESSION["tip3Nombre"];
$tip3desc = $_SESSION["tip3desc"];
$tip3img =$_SESSION["tip3img"];

$nomcarpeta=$_GET["carpeta"];
$tipo_carpt=$_GET["tipo_carpt"];

if($_GET["orderNo"]) $orderNo=$_GET["orderNo"];
if($_GET["orderTipo"]) $orderTipo=$_GET["orderTipo"];
if($_GET["dependencia_busq"]) $dependencia_busq=$_GET["dependencia_busq"];
if($_GET["fecha_ini"]) $fecha_ini=$_GET["fecha_ini"];
if($_GET["fecha_fin"]) $fecha_fin=$_GET["fecha_fin"];
if($_GET["codus"]) $codus=$_GET["codus"];
if($_GET["tipoRadicado"]) $tipoRadicado=$_GET["tipoRadicado"];
if($_GET["tipoEstadistica"]) $tipoEstadistica=$_GET["tipoEstadistica"];
if($_GET["codUs"]) $codUs=$_GET["codUs"];
if($_GET["fecSel"]) $fecSel=$_GET["fecSel"];
if($_GET["genDetalle"]) $genDetalle=$_GET["genDetalle"];
if($_GET["generarOrfeo"]) $generarOrfeo=$_GET["generarOrfeo"];

if(!$tipoEstadistica) $tipoEstadistica = $_SESSION["tipoEstadistica"];
$ruta_raiz = "..";

if(!$db)
{
$ruta_raiz = "..";
//include "$ruta_raiz/rec_session.php";
if($genDetalle){
?>
<body>
<center>
	<?php
}
include "$ruta_raiz/envios/paEncabeza.php";
?>
<table><tr><TD></TD></tr></table>
<?

include_once "$ruta_raiz/include/db/ConnectionHandler.php";
require_once("$ruta_raiz/class_control/Mensaje.php");
include("$ruta_raiz/class_control/usuario.php");
$db = new ConnectionHandler($ruta_raiz);	 
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
$objUsuario = new Usuario($db);


$whereDependencia = " AND DEPE_CODI=$dependencia_busq ";
	$datosaenviar = "fechaf=$fechaf&genDetalle=$genDetalle&tipoEstadistica=$tipoEstadistica&codus=$codus&dependencia_busq=$dependencia_busq&ruta_raiz=$ruta_raiz&fecha_ini=$fecha_ini&fecha_fin=$fecha_fin&tipoRadicado=$tipoRadicado&tipoDocumento=$tipoDocumento&codUs=$codUs&codEsp=$codEsp&fecSel=$fecSel"; 
}
$datosaenviar = "fechaf=$fechaf&genDetalle=$genDetalle&tipoEstadistica=".$_GET['tipoEstadistica']."&codus=$codus&dependencia_busq=$dependencia_busq&ruta_raiz=$ruta_raiz&fecha_ini=$fecha_ini&fecha_fin=$fecha_fin&tipoRadicado=$tipoRadicado&tipoDocumento=$tipoDocumento&codUs=$codUs&codEsp=$codEsp&fecSel=$fecSel"; 

$seguridad =",R.SGD_SPUB_CODIGO,B.CODI_NIVEL as  USUA_NIVEL";
$whereTipoRadicado = "";
switch($db->driver)
{
	case 'oracle':
	case 'postgres':
	if($tipoRadicado)
	{
		$whereTipoRadicado=" AND cast(a.RADI_NUME_RADI as varchar) LIKE '%$tipoRadicado'";
	}
if($tipoRadicado and ($tipoEstadistica==1 or $tipoEstadistica==6))
	{
		$whereTipoRadicado=" AND cast(r.RADI_NUME_RADI as varchar) LIKE '%$tipoRadicado'";
	}
	break;
  default:
	if($tipoRadicado)
		{
			$whereTipoRadicado=" AND a.RADI_NUME_RADI LIKE '%$tipoRadicado'";
		}
	if($tipoRadicado and ($tipoEstadistica==1 or $tipoEstadistica==6 or $tipoEstadistica==2))
		{
			$whereTipoRadicado=" AND r.RADI_NUME_RADI LIKE '%$tipoRadicado'";
		}
}	
	
if($_GET["codus"])
	{
		$whereTipoRadicado.=" AND b.USUA_CODI = $codus ";
	}elseif(!$codus and $usua_perm_estadistica<1)
	{
	    //$whereTipoRadicado.=" AND b.USUA_CODI = $codusuario ";
	}

if($tipoDocumento and ($tipoDocumento!='9999' and $tipoDocumento!='9998' and $tipoDocumento!='9997'))
	{
		$whereTipoRadicado.=" AND t.SGD_TPR_CODIGO = $tipoDocumento ";
	}elseif ($tipoDocumento=="9997")	
	{
		$whereTipoRadicado.=" AND t.SGD_TPR_CODIGO = 0 ";
	}
	include_once($ruta_raiz."/include/query/busqueda/busquedaPiloto1.php");
//if(!$_SESSION["tipoEstadistica"]) $_SESSION["tipoEstadistica"] = $_GET["tipoEstadistica"]; 

//$db->conn->debug = true;
switch($tipoEstadistica)
	{
		case "1";
	include "$ruta_raiz/include/query/estadisticas/consulta001.php";
	$titulo="Radicacion- Consulta de Radicacion por Usuarios";
  var_dump('C1');
	$generar = "ok";
	break;
		case "2";
	include "$ruta_raiz/include/query/estadisticas/consulta002.php";
	$titulo="Radicacion- Estadisticas por medio de Recepcion-envios";
	$generar = "ok";
	break;
		case "3";
	include "$ruta_raiz/include/query/estadisticas/consulta003.php";
	$titulo="Radicacion- Estadisticas de Medio Envio Final de Documentos";
	$generar = "ok";
	break;
		case "4";
	include "$ruta_raiz/include/query/estadisticas/consulta004.php";
	$titulo="Radicacion- Estadisticas Digitalizacion de Documentos";
	$generar = "ok";
	break;
		case "5";
	include "$ruta_raiz/include/query/estadisticas/consulta005.php";
	$titulo="Radicados de Entrada Recibidos del area de Correspondencia";
	$generar = "ok";
	break;		
		case "6";
	include "$ruta_raiz/include/query/estadisticas/consulta006.php";
	$titulo="Radicados Actuales en la Dependencia";
	$generar = "ok";
	break;				
		case "7";
	include "$ruta_raiz/include/query/estadisticas/consulta007.php";
	$titulo="";
	$generar = "ok";
	break;				
		case "8";
	include "$ruta_raiz/include/query/estadisticas/consulta008.php";
	$titulo="";
	$generar = "ok";
	break;				
		case "9";
	include "$ruta_raiz/include/query/estadisticas/consulta009.php";
	$titulo="";
	$generar = "ok";
	break;				
		case "10";
	include "$ruta_raiz/include/query/estadisticas/consulta010.php";
	$titulo="";
	$generar = "ok";
	break;				
		case "11";
	include "$ruta_raiz/include/query/estadisticas/consulta011.php";
	$titulo="Estadisticas de Digitalizacion";
	$generar = "ok";
	break;				
		case "12";
	include "$ruta_raiz/include/query/estadisticas/consulta012.php";
	$titulo="";
	$generar = "ok";
	break;
		case "13";
	include "$ruta_raiz/include/query/estadisticas/consulta013.php";
	$titulo="";
	$generar = "ok";
	break;
		case "14";
	include "$ruta_raiz/include/query/estadisticas/consulta014.php";
	$generar = "ok";
	break;
    case "16";
  include "$ruta_raiz/include/query/estadisticas/consulta016.php";
  $generar = "ok";
  break;
    case "17";
  include "$ruta_raiz/include/query/estadisticas/consulta017.php";
  $generar = "ok";
  break;
    case "18";
  include "$ruta_raiz/include/query/estadisticas/consulta018.php";
  $generar = "ok";
  break;
	}

/*********************************************************************************
Modificado Por: Supersolidaria
Fecha: 15 diciembre de 2006
Descripcion: Se incluye el reporte de radicados archivados reporte_archivo.php
**********************************************************************************/
	if($tipoReporte==1)
	{
	include "$ruta_raiz/include/query/archivo/queryReportePorRadicados.php";
	$generar = "ok";
	}

	if($generar == "ok") {
		if($genDetalle==1) $queryE = $queryEDetalle;

		if($genTodosDetalle==1) $queryE = $queryETodosDetalle;
		$rsE = $db->conn->Execute($queryE);

    if($tipoEstadistica==1)
      include "tablaHtml2.php";
    else
      include "tablaHtml.php";				

		Exportar($ruta_raiz,$queryE,$titulo);
	}
	
	function Exportar($ruta_raiz,$queryE,$titulo){	
?>
<table align="center" class="borde_tab" ><tr>
	<td align="center">
<?php
	$xsql = serialize ( $queryE ); // SERIALIZO EL QUERY CON EL QUE SE QUIERE GENERAR EL REPORTE
		$_SESSION ['xheader'] = "<center><b>$titulo</b></center><br><br>"; // ENCABEZADO DEL REPORTE
		$_SESSION ['xsql'] = $xsql; // SUBO A SESION EL QUERY// CREO LOS LINKS PARA LOS REPORTES
		echo "<b><a href='$ruta_raiz/adodb/adodb-doc.inc.php' target='_blank'><img src='$ruta_raiz/adodb/compfile.png' width='40' heigth='40' border='0'></a></b> - "; //
		echo "<a href='$ruta_raiz/adodb/adodb-xls.inc.php' target='_blank'><img src='$ruta_raiz/adodb/spreadsheet.png' width='40' heigth='40' border='0'></a>";
	?>
	</td>
</tr>
</table>
<?php 
	}
?>
