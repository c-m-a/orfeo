<?
	switch($db->driver)
	{
	case 'mssql':
		$isql = "SELECT 
	        convert(varchar(14),b.RADI_NUME_RADI) as RADI_NUME_RADI,a.ANEX_NOMB_ARCHIVO,a.ANEX_DESC,a.SGD_REM_DESTINO,a.SGD_DIR_TIPO
  		   ,convert(varchar(14),a.ANEX_RADI_NUME) as ANEX_RADI_NUME, convert(varchar(14),a.RADI_NUME_SALIDA) as RADI_NUME_SALIDA
		 FROM ANEXOS a,RADICADO b
		 WHERE a.radi_nume_salida=b.radi_nume_radi
			and a.RADI_NUME_SALIDA  in(".$setFiltroSelect.")
			and a.sgd_dir_tipo <>7 and anex_estado=2";
		break;
	case 'oracle':
	case 'oci8':
	case 'oci805':
	$isql = "SELECT 
	        b.RADI_NUME_RADI as RADI_NUME_RADI,a.ANEX_NOMB_ARCHIVO,a.ANEX_DESC,a.SGD_REM_DESTINO,a.SGD_DIR_TIPO
  		   ,a.ANEX_RADI_NUME as ANEX_RADI_NUME, a.RADI_NUME_SALIDA as RADI_NUME_SALIDA
		 FROM ANEXOS a,RADICADO b
		 WHERE a.radi_nume_salida=b.radi_nume_radi
			and cast(a.RADI_NUME_SALIDA as varchar(18)) in(".$setFiltroSelect.")
			and a.sgd_dir_tipo <>7 and anex_estado=2";		
		break;
	default:
		
		$isql = "SELECT 
				b.RADI_NUME_RADI as RADI_NUME_RADI
				,a.ANEX_NOMB_ARCHIVO ,a.ANEX_DESC 
				,a.SGD_REM_DESTINO ,a.SGD_DIR_TIPO
				,a.ANEX_RADI_NUME as ANEX_RADI_NUME
				,a.RADI_NUME_SALIDA as RADI_NUME_SALIDA
		 	FROM ANEXOS a,RADICADO b
		 	WHERE a.radi_nume_salida=b.radi_nume_radi
				and cast(a.RADI_NUME_SALIDA as varchar(18)) in(".$setFiltroSelect.")
				and a.sgd_dir_tipo <>7 and anex_estado=2";
		break;
	}
?>
