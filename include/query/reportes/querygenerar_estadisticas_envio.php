<?
	/**
	  * CONSULTA VERIFICACION PREVIA A LA RADICACION
	  */
	switch($db->driver)
	{  
	 case 'mssql':
	 $radi_nume_sal = "convert(varchar(14), RADI_NUME_SAL)";
	 $query = 'select  
		c.depe_nomb,
		'.$radi_nume_sal.' as radi_nume_sal,
		a.sgd_renv_nombre,
		a.sgd_renv_dir ,
		a.sgd_renv_mpio,
		a.sgd_renv_depto,
		a.sgd_renv_fech,
		a.sgd_renv_planilla,
		a.sgd_renv_cantidad,
		a.sgd_renv_valor,
		a.sgd_deve_fech,
		d.sgd_fenv_descrip,
		a.sgd_renv_peso
		from SGD_RENV_REGENVIO a, dependencia c, SGD_FENV_FRMENVIO d ';
	$fecha_mes = substr($fecha_ini,0,7);
	// Si la variable $generar_listado_existente viene entonces este if genera la planilla existente
	$where_isql = ' WHERE a.sgd_renv_fech BETWEEN
	'.$db->conn->DBTimeStamp($fecha_ini).' and '.$db->conn->DBTimeStamp($fecha_fin).'
	and '.$db->conn->substr.'('.$radi_nume_sal.',5, 3)=c.depe_codi
	and a.sgd_fenv_codigo=d.sgd_fenv_codigo';
	$order_isql = '  ORDER BY  '.$db->conn->substr.'('.$radi_nume_sal.', 5, 3), a.SGD_RENV_FECH DESC,a.SGD_RENV_PLANILLA DESC';

	break;		
	case 'oracle':
	case 'oci8':
	case 'oci805':
		$query = 'select  
			c.depe_nomb,
			a.radi_nume_sal,
			a.sgd_renv_nombre,
			a.sgd_renv_dir ,
			a.sgd_renv_mpio,
			a.sgd_renv_depto,
			a.sgd_renv_fech,
			a.sgd_renv_planilla,
			a.sgd_renv_cantidad,
			a.sgd_renv_valor,
			a.sgd_deve_fech,
			d.sgd_fenv_descrip
			from SGD_RENV_REGENVIO a, dependencia c, SGD_FENV_FRMENVIO d  ';
			$fecha_mes = substr($fecha_ini,0,7);
			// Si la variable $generar_listado_existente viene entonces este if genera la planilla existente
			$where_isql = ' WHERE a.sgd_renv_fech BETWEEN
			'.$db->conn->DBTimeStamp($fecha_ini).' and '.$db->conn->DBTimeStamp($fecha_fin).'
			and '.$db->conn->substr.'(a.radi_nume_sal, 5, 3)=c.depe_codi
			and a.sgd_fenv_codigo=d.sgd_fenv_codigo';
		$order_isql = '  ORDER BY  '.$db->conn->substr.'(a.radi_nume_sal, 5, 3), a.SGD_RENV_FECH DESC,a.SGD_RENV_PLANILLA DESC';
		break;		
	
	//Modificado skina
	default:
			$query = 'select  
				c.depe_nomb,
				a.radi_nume_sal,
				a.sgd_renv_nombre,
				a.sgd_renv_dir ,
				a.sgd_renv_mpio,
				a.sgd_renv_depto,
				a.sgd_renv_fech,
				a.sgd_renv_planilla,
				a.sgd_renv_cantidad,
				a.sgd_renv_valor,
				a.sgd_deve_fech,
				d.sgd_fenv_descrip
			from SGD_RENV_REGENVIO a, dependencia c, SGD_FENV_FRMENVIO d  ';
			
			$fecha_mes = substr($fecha_ini,0,7);
			// Si la variable $generar_listado_existente viene entonces este if genera la planilla existente
			$where_isql = ' WHERE a.sgd_renv_fech BETWEEN
					'.$db->conn->DBTimeStamp($fecha_ini).' and '.$db->conn->DBTimeStamp($fecha_fin).'
					and '.$db->conn->substr.'(a.radi_nume_sal, 5, 3)=c.depe_codi
					and a.sgd_fenv_codigo=d.sgd_fenv_codigo';
			$order_isql = '  ORDER BY  '.$db->conn->substr.'(a.radi_nume_sal, 5, 3), a.SGD_RENV_FECH DESC,a.SGD_RENV_PLANILLA DESC';
		
	}
?>
