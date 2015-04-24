<?
switch ($db->driver) { 
	case 'oci8':
	case 'oracle':
	case 'mssql':

		$query1=" SELECT  $concatDocNumFe as COD,sgd_pnufe_DESCRIP as DES FROM sgd_pnufe_procnumfe where sgd_tpr_codigo=  $tdoc ".
			   "union ".
			  "(select distinct  $concatDoc as cod,a.SGD_TPR_DESCRIP as des ".
	  		     "FROM SGD_TPR_TPDCUMENTO a,SGD_MTD_MATRIZ_DOC b,SGD_MAT_MATRIZ c, SGD_MRD_MATRIRD trd  ".
	  		     "WHERE a.sgd_tpr_codigo=b.sgd_tpr_codigo AND b.sgd_mat_codigo=c.sgd_mat_codigo ".
			      " AND c.depe_codi=$dependencia AND trd.depe_codi = $dependencia 
				    and trd.sgd_tpr_codigo = a.sgd_tpr_codigo ) order by 2 asc";
	break;
	}
?>