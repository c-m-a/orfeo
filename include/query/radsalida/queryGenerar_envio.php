<?
	/**
	  * CONSULTA VERIFICACION PREVIA A LA RADICACION
	  */
	switch($db->driver)
	{
	case 'mssql':
		
 	$query = "
		select sgd_renv_planilla, sgd_renv_fech from sgd_renv_regenvio
		WHERE DEPE_CODI= $dependencia 
		AND ". $sqlChar . " = '$fecha_mes'
		AND RTRIM(sgd_renv_planilla) != '' 
		AND sgd_fenv_codigo = $codigo_envio
		ORDER BY sgd_renv_fech desc, SGD_RENV_PLANILLA desc 
		";

	break;

	case 'oracle':
	case 'oci8':
	case 'oci805':	

		$query = "
		select sgd_renv_planilla, sgd_renv_fech from sgd_renv_regenvio
		WHERE DEPE_CODI=$dependencia 
		AND ". $sqlChar . " = '$fecha_mes'
		AND sgd_renv_planilla is not null 
		AND sgd_fenv_codigo = $codigo_envio
		ORDER BY sgd_renv_fech desc, SGD_RENV_PLANILLA desc 
		";

	break;
	}
?>