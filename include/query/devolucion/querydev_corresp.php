<?
	/**
	  * CONSULTA VERIFICACION PREVIA A LA RADICACION
	  */
	switch($db->driver)
	{  
	 case 'mssql':
	 
	 $systemDate = $db->conn->sysTimeStamp;
	 $sqlOffset = $db->conn->OffsetDate("a.sgd_fech_impres");
	 $redondeo = $db->conn->round($systemDate."-".$sqlOffset);
	 $where_depe = ' and '.$db->conn->substr.'(convert(char(15),radi_nume_salida,0), 5, 3) in ('.$lista_depcod .')';
	 
	 $isqlC = 'select  count(*) Numero
		from ANEXOS
		where 
		sgd_fech_impres <= '.$db->conn->DBTimeStamp($fecha_fin).'
		and  ANEX_ESTADO=3
		'.$where_like.'
		and '.$db->conn->substr.'(convert(char(15),radi_nume_salida), 5, 3) in ('.$lista_depcod .')
		and sgd_deve_codigo is null';
		$isql = 'select  
	        convert(char(15),a.radi_nume_salida) as "Numero Radicacion"
			,a.anex_radi_nume  as "HID_anex_radi_nume"
			,'.$db->conn->substr.'(convert(char(15),radi_nume_salida), 5, 3) as "Dependencia"
			,'.$fech_devol.' as "Fecha Devolucion"
			,'.$usua_devol.' as "Usuario Realiza Devolucion"
			,'.$redondeo.' as "Tiempo de Espera (Dias)"
		from ANEXOS a
		where
		sgd_fech_impres <= '.$db->conn->DBTimeStamp($fecha_fin).'
		and a.ANEX_ESTADO=3
		'.$where_like.'
		and '.$db->conn->substr.'(convert(char(15),radi_nume_salida), 5, 3) in ('.$lista_depcod .')
		and a.sgd_deve_codigo is null';
		$isqlF = 'select  
	        convert(char(15),a.radi_nume_salida) as radi_nume_salida
			,a.anex_radi_nume 
			, a.sgd_dir_tipo
			,'.$db->conn->substr.'(convert(char(15),radi_nume_salida), 5, 3) as "Dependencia"
			,'.$redondeo.' as "Tiempo de Espera (Dias)"
		from ANEXOS a
		where 
		sgd_fech_impres <= '.$db->conn->DBTimeStamp($fecha_fin).'
		and  ANEX_ESTADO=3 
		'.$where_like.'
		and '.$db->conn->substr.'(convert(char(15),radi_nume_salida), 5, 3) in ('.$lista_depcod .')
		and sgd_deve_codigo is null';

		$isqlU = 'update ANEXOS
			set anex_estado=2,
			sgd_deve_codigo=99
			where ANEX_ESTADO=3 AND anex_radi_nume='.$anex_radi_nume.'
			and '.$db->conn->substr.'(convert(char(15),radi_nume_salida, 5), 3) in ('.$lista_depcod .')
			 and sgd_deve_codigo is null 
			 ';
	break;		
	case 'oracle':
	case 'oci8':	
	case 'oci805':		
	$where_depe = ' and '.$db->conn->substr.'(radi_nume_salida, 5, 3) in ('.$lista_depcod .')';
	$sqlConcat = $db->conn->Concat("depe_codi","'-'","depe_nomb");
	
	$isqlC = 'select  count(*) Numero
		from ANEXOS
		where 
		sgd_fech_impres <= '.$db->conn->DBTimeStamp($fecha_fin).'
		and  ANEX_ESTADO=3
		'.$where_like.'
		and '.$db->conn->substr.'(radi_nume_salida, 5, 3) in ('.$lista_depcod .')
		and sgd_deve_codigo is null
		';
		$isql = 'select  
	        a.radi_nume_salida as "Numero Radicacion"
			,a.anex_radi_nume  as "HID_anex_radi_nume"
			,'.$db->conn->substr.'(radi_nume_salida, 5, 3) as "Dependencia"
			,'.$fech_devol.' as "Fecha Devolucion"
			,'.$usua_devol.' as "Usuario Realiza Devolucion"
			,round((sysdate - a.sgd_fech_impres),1) as "Tiempo de Espera (Dias)"
		from ANEXOS a
		where
		sgd_fech_impres <= '.$db->conn->DBTimeStamp($fecha_fin).'
		and a.ANEX_ESTADO=3
		'.$where_like.'
		and '.$db->conn->substr.'(radi_nume_salida, 5, 3) in ('.$lista_depcod .')
		and a.sgd_deve_codigo is null';
		$isqlF = 'select  
	        a.radi_nume_salida 
			,a.anex_radi_nume 
			, a.sgd_dir_tipo
			,'.$db->conn->substr.'(radi_nume_salida, 5, 3) as "Dependencia"
			,round((sysdate - a.sgd_fech_impres),1) as "T_ESPERA"
		from ANEXOS a
		where 
		sgd_fech_impres <= '.$db->conn->DBTimeStamp($fecha_fin).'
		and  ANEX_ESTADO=3 
		'.$where_like.'
		and '.$db->conn->substr.'(radi_nume_salida, 5, 3) in ('.$lista_depcod .')
		and sgd_deve_codigo is null';

		$isqlU = 'update ANEXOS
			set anex_estado=2,
			sgd_deve_codigo=99
			where ANEX_ESTADO=3 AND anex_radi_nume='.$anex_radi_nume.'
			and '.$db->conn->substr.'(radi_nume_salida, 5, 3) in ('.$lista_depcod .')
			 and sgd_deve_codigo is null 
			 ';
			
	break;
	default:
		$where_depe = ' and '.$db->conn->substr.'(radi_nume_salida, 5, 3) in ('.$lista_depcod .')';
		$sqlConcat = $db->conn->Concat("depe_codi","'-'","depe_nomb");
		$fecha_hoy = $db->conn->sysTimeStamp;

		$isqlC = 'select  count(*) as Numero
			from ANEXOS
			where 
			sgd_fech_impres <= '.$db->conn->DBTimeStamp($fecha_fin).'
			and  ANEX_ESTADO=3
			'.$where_like.'
			and '.$db->conn->substr.'(radi_nume_salida, 5, 3) in ('.$lista_depcod .')
			and sgd_deve_codigo is null';
		$isql = 'select  
	        	a.radi_nume_salida as "Numero Radicacion"
			,a.anex_radi_nume  as "HID_anex_radi_nume"
			,'.$db->conn->substr.'(radi_nume_salida, 5, 3) as "Dependencia"
			,'.$fech_devol.' as "Fecha Devolucion"
			,'.$usua_devol.' as "Usuario Realiza Devolucion"
			, ('.$fecha_hoy.' - a.sgd_fech_impres) as "Tiempo de Espera (Dias)"
			from ANEXOS a
			where
			sgd_fech_impres <= '.$db->conn->DBTimeStamp($fecha_fin).'
			and a.ANEX_ESTADO=3
			'.$where_like.'
			and '.$db->conn->substr.'(radi_nume_salida, 5, 3) in ('.$lista_depcod .')
			and a.sgd_deve_codigo is null';
		$isqlF = 'select  
	        	a.radi_nume_salida 
			,a.anex_radi_nume 
			, a.sgd_dir_tipo
			,'.$db->conn->substr.'(radi_nume_salida, 5, 3) as "Dependencia"
			,('.$fecha_hoy.' - a.sgd_fech_impres) as "T_ESPERA"
			from ANEXOS a
			where 
			sgd_fech_impres <= '.$db->conn->DBTimeStamp($fecha_fin).'
			and  ANEX_ESTADO=3 
			'.$where_like.'
			and '.$db->conn->substr.'(radi_nume_salida, 5, 3) in ('.$lista_depcod .')
			and sgd_deve_codigo is null';
	
		$isqlU = 'update ANEXOS
			set anex_estado=2,
			sgd_deve_codigo=99
			where ANEX_ESTADO=3 AND anex_radi_nume='.$anex_radi_nume.'
			and '.$db->conn->substr.'(radi_nume_salida, 5, 3) in ('.$lista_depcod .')
			 and sgd_deve_codigo is null ';	
	}
?>
