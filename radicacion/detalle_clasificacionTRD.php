<?
$sqlFechaDocto =  $db->conn->SQLDate("Y-m-D H:i:s A","mf.sgd_rdf_fech");
$sqlSubstDescS =  $db->conn->substr."(s.sgd_srd_descrip, 0, 30)";
$sqlSubstDescSu = $db->conn->substr."(su.sgd_sbrd_descrip, 0, 30)";
$sqlSubstDescT =  $db->conn->substr."(t.sgd_tpr_descrip, 0, 30)";

$isqlCD = "select 
			$sqlSubstDescS   AS SERIE, 
			$sqlSubstDescSu  AS SUBSERIE, 
			$sqlSubstDescT   AS TIPO_DOCUMENTO 
			from 
	   			SGD_MRD_MATRIRD m, 
	   			SGD_SRD_SERIESRD s,
	   			SGD_SBRD_SUBSERIERD su, 
	   			SGD_TPR_TPDCUMENTO t
	   		where m.sgd_mrd_codigo = '$TRD' 
			      and m.sgd_srd_codigo = s.sgd_srd_codigo
			 	  and m.sgd_srd_codigo   = su.sgd_srd_codigo
				  and m.sgd_sbrd_codigo = su.sgd_sbrd_codigo
				  and m.sgd_tpr_codigo  = t.sgd_tpr_codigo
	   			  ";
				  $rsTRD = $db->conn->Execute($isqlCD);
				  if($rsTRD)
					{
	    				$deta_serie = $rsTRD->fields['SERIE'];
						$deta_subserie = $rsTRD->fields['SUBSERIE'];
						$deta_tipodocu = $rsTRD->fields['TIPO_DOCUMENTO'];
					}
					else
					{
	    				$deta_serie = "";
						$deta_subserie = "";
						$deta_tipodocu = "";
					
					}
					
?>