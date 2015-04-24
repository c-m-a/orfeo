<?	
	switch($db->driver)
	{
	case 'mssql':
		$qeryObtenerGrupo = "select  convert(char(14), RADI_NUME_SAL) as RADI_NUME_SAL ,SGD_RENV_CODIGO    from sgd_renv_regenvio 
			   WHERE sgd_renv_planilla = '00' and sgd_renv_tipo = 1
				 and radi_nume_grupo=$grupo
			   and sgd_depe_genera  = '$dependencia'
				 $qFiltro 
				 order by radi_nume_sal asc ";
	break;
	case 'oracle':
	case 'oci8':
	case 'oci805':
	case 'ocipo':
		$qeryObtenerGrupo = "select  RADI_NUME_SAL,SGD_RENV_CODIGO    from sgd_renv_regenvio 
			   WHERE sgd_renv_planilla = '00' and sgd_renv_tipo = 1
				 and radi_nume_grupo=$grupo
			   and sgd_depe_genera  = '$dependencia'
				 $qFiltro 
				 order by radi_nume_sal asc ";
	break;
default:
	$qeryObtenerGrupo = 
		"select  RADI_NUME_SAL,SGD_RENV_CODIGO    from sgd_renv_regenvio 
		   WHERE sgd_renv_planilla = '00' and sgd_renv_tipo = 1
				and radi_nume_grupo=$grupo
				and sgd_depe_genera  = $dependencia
				$qFiltro order by radi_nume_sal asc ";
	break;
	}
?>