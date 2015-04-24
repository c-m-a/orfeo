<?
session_start();
/*
 * Lista Subseries documentales
 * @autor Jairo Losada
 * @fecha 2009/06 Modificacion Variables Globales.
 */
foreach ($_GET as $key => $valor)   ${$key} = $valor;
foreach ($_POST as $key => $valor)   ${$key} = $valor;
$krd = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
$usua_doc = $_SESSION["usua_doc"];
$codusuario = $_SESSION["codusuario"];
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
error_reporting(7);
$anoActual = date("Y");
if(!$fecha_busq) $fecha_busq=date("Y-m-d");
if(!$fecha_busq2) $fecha_busq2=date("Y-m-d");
$ruta_raiz = "..";
if (!$_SESSION['dependencia'] and !$_SESSION['depe_codi_territorial'])	include "../rec_session.php";
include_once "$ruta_raiz/include/db/ConnectionHandler.php";
$db = new ConnectionHandler("$ruta_raiz");	
if (!defined('ADODB_FETCH_ASSOC'))	define('ADODB_FETCH_ASSOC',2);
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
?>
<head>
<link rel="stylesheet" href="../estilos/orfeo.css">
</head>
<BODY>
<div id="spiffycalendar" class="text"></div>
<link rel="stylesheet" type="text/css" href="../js/spiffyCal/spiffyCal_v2_1.css">
<TABLE width="100%" class='borde_tab' cellspacing="5" border=1>
<TR><TD height="30" valign="middle"   class='titulos5' align="center">INFORME TABLAS DE RETENCION DOCUMENTAL</td></tr>
</table>
<table><tr><td></td></tr></table>
<form name="inf_trd"  action='../trd/informe_trd.php?<?=session_name()."=".session_id()."&krd=$krd&fecha_h=$fechah"?>' method=post>
<TABLE width="550" class='borde_tab' align="center" border=1>
  <!--DWLayoutTable-->
  <TR>
    <TD height="26" class='titulos5'>Dependencia</TD>
    <TD valign="top">
	<?
	error_reporting(7);
	$ss_RADI_DEPE_ACTUDisplayValue = "--- TODAS LAS DEPENDENCIAS ---";
	$valor = 0;
	include "$ruta_raiz/include/query/devolucion/querydependencia.php";
	$sqlD = "select $sqlConcat ,depe_codi from dependencia where depe_estado=1
							order by depe_codi";
	//$db->conn->debug = true;
			$rsDep = $db->conn->Execute($sqlD);
	       print $rsDep->GetMenu2("dep_sel","$dep_sel",$blank1stItem = "$valor:$ss_RADI_DEPE_ACTUDisplayValue", false, 0," onChange='submit();' class='select'");	
	?>
  </TR>
  <tr>
    <td height="26" colspan="2" valign="top" class='titulos5'> <center>
		<input type=SUBMIT name=generar_informe value=' Generar Informe pdf' class=botones_mediano>
		<input type=SUBMIT name=generar_archicsv value=' Generar Archivo CSV' class=botones_mediano>
    </center>
		</td>
	</tr>
</TABLE>

<?php
if($_POST['generar_informe'])
{
  if ($_POST['dep_sel'] == 0)
    {
      /*
      *Seleccionar todas las dependencias
      */
      $where_depe = '';
     }
   else
     {
      
//parametro solo de la SSPD
				if($entidad == "SSPD")
				{
					if($dep_sel=="527" || $dep_sel=="810" || $dep_sel=="820" || $dep_sel=="830" || $dep_sel=="840" || $dep_sel=="850") 
					{
						
						$where_depe = " AND ( ( m.depe_codi = ". $_POST['dep_sel'] ."  AND m.SGD_SRD_CODIGO = 15) OR (m.depe_codi = " . $_POST['dep_sel'] . " AND m.SGD_SRD_CODIGO <> 15))";
					}else {
						$where_depe = " AND m.depe_codi = ". $_POST['dep_sel'] ." AND m.SGD_SRD_CODIGO <> 15 ";
					}
				}else {
					 $where_depe = " and m.depe_codi = ".$_POST['dep_sel'];
				}
     }
    $generar_informe = 'generar_informe';
	error_reporting(7);
	$guion     = "' '";
	include "$ruta_raiz/include/query/trd/queryinforme_trd.php";
	$order_isql = " order by m.depe_codi, m.sgd_srd_codigo,m.sgd_sbrd_codigo,m.sgd_tpr_codigo ";
	$query_t = $query . $where_depe . $order_isql ;
	$ruta_raiz = "..";
	error_reporting(7);
	$rs = $db->query($query_t);
echo "<hr>---<hr>";
?>
<table class='borde_tab' border=1>
<?
$nSRD_ant = "";
$nSBRD_ant = "";
$openTR = "";
?>
<tr class=titulos5>
<td colspan="3" align="center">Codigo</td>
<td align="center" rowspan="2">Series Y Tipos Documentales</td>
<td colspan="2" align="center">Retencion<br> A&#241;os</td>
<td colspan="4" align="center">Disposicion<br> Final</td>
<td colspan="3" align="center">Soporte</td>
<td rowspan="2" align="center" width=30%>Procedimiento </td>
</tr>
<tr class=titulos5>
<td Aign="center">D</td><td Aign="center">S</td><td Aign="center">Sb</td>
<td align="center">AG</td><TD>AC</TD>
<td>CT</TD><TD>E</TD><TD>I</TD><TD>S</TD>
<td>P</td><td>EL</td><td>O</td>
</tr>
<?
	while(!$rs->EOF and $rs)
	{
			
			$nSRD = strtoupper($rs->fields['SGD_SRD_DESCRIP']);	//Nombre Serie
			$depTDR = $rs->fields['DEPE_CODI'];					//Dependencia
			$nSBRD = $rs->fields['SGD_SBRD_DESCRIP'];			//Nombre SubSerie
			$cSRD = $rs->fields['SGD_SRD_CODIGO'];				//Codigo Serie
			$cSBRD = $rs->fields['SGD_SBRD_CODIGO'];			//Codigo Subserie
			$nTDoc = lcfirst1($rs->fields['SGD_TPR_DESCRIP']);	//Nombre Tipo Documental
			if($nSRD==$nSRD_ant)
			{
				$pSRD=""; 
			}else{
				$pSRD = "$nSRD";
				if($openTR=="Si")
				{
					echo "$colFinales";
				}
			  echo "<tr class=listado5><td><font size=2 face='Arial'>$depTDR</font></td>
			  <td>&nbsp;<font size=2 face='Arial'>$cSRD</font></td>
			  <td>&nbsp;</td><td colspan=11><font size=2 face='Arial'>$pSRD</font></td>";
				echo "</tr><tr>";
				$openTR = "No";
				
			}
			if($nSBRD==$nSBRD_ant)
			{
				 $pSBRD="&nbsp;&nbsp;&nbsp;- <font size=2 face='Arial'>$nTDoc</font><br>"; 
				 echo "<font size=2 face='Arial'>$pSBRD</font>";
			}else
			{
				if($openTR=="Si")
				{
					echo "<font size=2 face='Arial'>$colFinales</font>";
				}
				$conservCT="&nbsp;";
				$conservE="&nbsp;";
				$conservI="&nbsp;";
				$conservS="&nbsp;";
				$soporteP = "&nbsp;";
				$soporteEl = "&nbsp;";
				$soporteO = "&nbsp;";
				$conserv = strtoupper(substr(trim($rs->fields['DISPOSICION']),0,1));
				$soporte = strtoupper(substr(trim($rs->fields['SGD_SBRD_SOPORTE']),0,1));
				$pSBRD = "<a href=#><font size=2 face='Arial'>$nSBRD</font></a><br>&nbsp;&nbsp;&nbsp;- 
				<font size=2 face='Arial'>$nTDoc</font>";
				echo "<tr valign=top class=leidos>
				<td><font size=2 face='Arial'>$depTDR</font></td>
				<td>&nbsp;<font size=2 face='Arial'>$cSRD</font></td>
				<td>.<font size=2 face='Arial'>$cSBRD</font></td>
				<td><font size=2 face='Arial'>$pSBRD</font><br>";
				$openTR = "Si";
				if($conserv=="C") $conservCT="X";
				if($conserv=="E") $conservE="X";
				if($conserv=="I") $conservI="X";
				if($conserv=="M") $conservS="X";
				if($soporte=="P") $soporteP = "X";
				if($soporte=="E") $soporteEl = "X";
				if($soporte=="O") $soporteO = "X";
				 $tiemag = $rs->fields['SGD_SBRD_TIEMAG'];
				 $tiemac = $rs->fields['SGD_SBRD_TIEMAC'];
				 $nObservacion = $rs->fields['SGD_SBRD_PROCEDI'];
				$conservacion = "<td><font size=2 face='Arial'><font size=2 face='Arial'>$conservCT</font></td>
				<td><font size=2 face='Arial'>$conservE</font></td>
				<td><font size=2 face='Arial'>$conservI</td>
				<td><font size=2 face='Arial'>$conservS</td>";
				$soporte = "<td><font size=2 face='Arial'>$soporteP</td>
				<td><font size=2 face='Arial'>$soporteEl</td><td>
				<font size=2 face='Arial'>$soporteO</td>";
				$colFinales = "<td><font size=2 face='Arial'>&nbsp;$tiemag</td>
				<td>&nbsp;<font size=2 face='Arial'>$tiemac</font></td>
				<font size=2 face='Arial'>$conservacion $soporte</font>
				<td>&nbsp;<font size=2 face='Arial'>".strtoupper($nObservacion)."</font>
				</td>";
			}
			$nSRD_ant = $nSRD;
			$nSBRD_ant = $nSBRD;
			$rs->MoveNext();
	}
	if($openTR=="Si")
	{
		echo "$colFinales";
	}
?>
</table>
<?
}

function lcfirst1($str)
{
   return strtoupper(substr($str, 0, 1)) . strtolower(substr($str, 1));
}
?>
<hr>
---
<hr>
</form>
<HR>
