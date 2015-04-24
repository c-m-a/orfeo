<?php
session_start();
/*
 * Lista Subseries documentales
 * @autor Jairo Losada SuperSOlidaria 
 * @fecha 2009/06 Modificacion Variables Globales.
 */
	foreach ($_GET as $key => $valor)   ${$key} = $valor;
	foreach ($_POST as $key => $valor)   ${$key} = $valor;
	$krd = $_SESSION["krd"];
	$dependencia = $_SESSION["dependencia"];
	$usua_doc = $_SESSION["usua_doc"];
	$codusuario = $_SESSION["codusuario"];
if (!$ruta_raiz) $ruta_raiz= "..";
$sqlFechaDocto =  $db->conn->SQLDate("Y-m-D H:i:s A","mf.sgd_rdf_fech");
$sqlSubstDescS =  $db->conn->substr."(SGD_SRD_DESCRIP, 0, 40)";
$sqlFechaD = $db->conn->SQLDate("Y-m-d H:i A","SGD_SRD_FECHINI");
$sqlFechaH = $db->conn->SQLDate("Y-m-d H:i A","SGD_SRD_FECHFIN");
$isqlC = 'select 
			  SGD_SRD_CODIGO          AS "CODIGO",
			'. $sqlSubstDescS .  '    AS "SERIE",
			'.$sqlFechaD.' 			  as "DESDE",
			'.$sqlFechaH.' 			  as "HASTA" 
			from 
				SGD_SRD_SERIESRD
				'.$whereBusqueda.'
			order by  '. $sqlSubstDescS;
     error_reporting(7);
?>
<table class=borde_tab width='100%' cellspacing="5"><tr><td class=titulos2><center>SERIES DOCUMENTALES</center></td></tr></table>
<table><tr><td></td></tr></table>
<br>
<TABLE width="850" class="borde_tab" cellspacing="5">
  <tr class=tpar> 
   <td class=titulos3 align=center>CODIGO </td>
   <td class=titulos3 align=center>DESCRIPCION </td>
   <td class=titulos3 align=center>DESDE </td>
   <td class=titulos3 align=center>HASTA </td>
  </tr>
  	<?php
	 	$rsC=$db->query($isqlC);
   		while(!$rsC->EOF)
			{
      			$codserie  =$rsC->fields["CODIGO"];
	  			$dserie   =$rsC->fields["SERIE"]; 
				$fini     =$rsC->fields["DESDE"];
				$ffin     =$rsC->fields["HASTA"];				
		?> 
    		  <tr class=paginacion>
				<td> <?=$codserie?></td>
				<td align=left> <?=$dserie?> </td>
				<td> <?=$fini?> </td>
				<td> <?=$ffin?> </td>
		 	  </tr>
	<?
				$rsC->MoveNext();
  		}
		//<font face="Arial, Helvetica, sans-serif" class="etextomenu">
		 ?>
   </table>