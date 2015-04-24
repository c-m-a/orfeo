<?php
session_start();
if (!$ruta_raiz) $ruta_raiz= "..";
$sqlFechaDocto =  $db->conn->SQLDate("Y-m-D H:i:s A","mf.sgd_rdf_fech");
$sqlSubstDescS =  $db->conn->substr."(s.sgd_srd_descrip, 0, 30)";
$sqlSubstDescSu = $db->conn->substr."(su.sgd_sbrd_descrip, 0, 30)";
$sqlSubstDescT =  $db->conn->substr."(t.sgd_tpr_descrip, 0, 30)";
$sqlSubstDescD =  $db->conn->substr."(d.depe_nomb, 0, 30)";

include "$ruta_raiz/include/query/trd/querylista_tiposAsignados.php"; 
$isqlC = 'select 
			  '. $sqlConcat .  '      AS "CODIGO" 
			, '. $sqlSubstDescS .  '  AS "SERIE" 
			, '. $sqlSubstDescSu .  ' AS "SUBSERIE" 
			, '. $sqlSubstDescT .  '  AS "TIPO_DOCUMENTO" 
			, '. $sqlSubstDescD .  '  AS "DEPENDENCIA"
			, m.sgd_mrd_codigo        AS "CODIGO_TRD"
			, mf.usua_codi             AS "USUARIO"
			, mf.depe_codi             AS "DEPE"
			from 
				SGD_RDF_RETDOCF mf,
	   			SGD_MRD_MATRIRD m, 
	   			DEPENDENCIA d,
	   			SGD_SRD_SERIESRD s,
	   			SGD_SBRD_SUBSERIERD su, 
	   			SGD_TPR_TPDCUMENTO t
	   		where d.depe_codi     = mf.depe_codi 
	   			and s.sgd_srd_codigo  = m.sgd_srd_codigo 
	   			and su.sgd_sbrd_codigo = m.sgd_sbrd_codigo 
				and su.sgd_srd_codigo = m.sgd_srd_codigo
	  			and t.sgd_tpr_codigo  = m.sgd_tpr_codigo
	   			and mf.sgd_mrd_codigo = m.sgd_mrd_codigo
			    and mf.radi_nume_radi = '. $nurad;
     error_reporting(7);
?>
    <br>
	<br>
	<TABLE class="borde_tab"><tr><td>
   CLASIFICACION DEL RADICADO No. <?=$nurad ?></td></tr></table>
	<br>
	<table class=borde_tab width="100%" cellpadding="0" cellspacing="5">
  	<tr class="titulo5" align="center">
    	<td width="10%"  class="titulos5">CODIGO</td>
		<td width="20%"  class="titulos5">SERIE</td>
		<td width="20%"  class="titulos5">SUBSERIE</td>
 		<td width="20%"  class="titulos5">TIPO DE 
				DOCUMENTO</td>
    	<td width="20%"  class="titulos5">DEPENDENCIA</td>
   	   	<td width="20%"  class="titulos5">ACCION</td>
  		</tr>
  	<?php
	 	$rsC=$db->query($isqlC);
   		while(!$rsC->EOF)
			{
      			$coddocu  =$rsC->fields["CODIGO"];
	  			$dserie   =$rsC->fields["SERIE"]; 
				$dsubser  =$rsC->fields["SUBSERIE"];
				$dtipodo  =$rsC->fields["TIPO_DOCUMENTO"];
                $ddepend  =$rsC->fields["DEPENDENCIA"];
				$codiTRDEli  =$rsC->fields["CODIGO_TRD"];
				$codiTRDModi =$codiTRDEli;
				
		?> 
				<td class="listado5"> <font size=-3><?=$coddocu?></font> </td>
				<td class="listado5"> <font size=-3><?=$dserie?></font> </td>
				<td class="listado5"> <font size=-3><?=$dsubser?></font> </td>
				<td class="listado5"> <font size=-3><?=$dtipodo?></font> </td>
				<td class="listado5"> <font size=-3><?=$ddepend?></font> </td>
	 			<td  <? if (!$rsC->fields["CODIGO"]) echo " class='celdaGris ' "; else echo " class='e_tablas ' "; ?>  > <font size=2>
		<?php 
	      		if($coddocu && $rsC->fields["USUARIO"]==$codusua && $rsC->fields["DEPE"] == $coddepe)
				{
					echo "<a href=javascript:borrarArchivo('$codiTRDEli','si')><span class='botones_largo'>Borrar</a> ";
		  		} 
		  ?> 
		 
	</font>
	</td>
	</tr>
	<?
				$rsC->MoveNext();
  		}
		//<font face="Arial, Helvetica, sans-serif" class="etextomenu">
		 ?>
   </table>