<?
/**
 * CONSULTA VERIFICACION PREVIA A LA RADICACION
 */
switch($db->driver)
{	case 'mssql':
	{	$tmp_EspCampo = "";
		$tmp_EspTabla = "";
		/*
		if ($tpBusqueda3)
		{	$tmp_EspCampo = "c.NOMBRE_DE_LA_EMPRESA ,";
			$tmp_EspTabla = "bodega_empresas c,";
		}
		else
		{	$tmp_EspCampo = "";
			$tmp_EspTabla = "";
		}
		*/
		$query1 = " SELECT 
	  	a.RADI_NUME_HOJA ,
		a.RADI_FECH_RADI ,
		convert(varchar(15), a.radi_nume_radi) as radi_nume_radi,
		a.RA_ASUN ,
		a.RADI_PATH ,
		a.RADI_USU_ANTE ,
		$tmp_EspCampo
		$sqlFecha AS FECHA ,
		b.sgd_tpr_descrip ,
		b.sgd_tpr_codigo ,
		b.sgd_tpr_termino,
		RADI_LEIDO ,
		RADI_TIPO_DERI ,
		convert(varchar(15), radi_nume_deri) as RADI_NUME_DERI ,
		d.SGD_DIR_TIPO,
		d.SGD_DIR_NOMBRE,
		d.SGD_DIR_NOMREMDES,
		a.radi_cuentai,
		g.SGD_EXP_NUMERO
		FROM RADICADO a
			LEFT OUTER JOIN SGD_EXP_EXPEDIENTE g
				ON a.radi_nume_radi  =g.radi_nume_radi,
				SGD_TPR_TPDCUMENTO b,
				$tmp_EspTabla
				SGD_DIR_DRECCIONES d
		WHERE
		a.radi_nume_radi = convert(varchar(15), d.radi_nume_radi) AND
		a.tdoc_codi=b.sgd_tpr_codigo 
		$whereTrd
		$where_ciu
		$where_general";
	}break;
	case 'oracle':
	case 'oci8':
	{$query1 = "
		SELECT
		a.RADI_NUME_HOJA ,
		a.RADI_FECH_RADI  ,
		a.radi_nume_radi ,
		a.RA_ASUN  ,
		a.RADI_PATH ,
		a.RADI_USU_ANTE ,
		'' AS R_RADI_NOMB ,
		$sqlFecha AS FECHA ,
		b.sgd_tpr_descrip ,
		b.sgd_tpr_codigo ,
		b.sgd_tpr_termino,
		RADI_LEIDO ,
		RADI_TIPO_DERI ,
		RADI_NUME_DERI ,
		d.SGD_DIR_NOMREMDES,
		d.SGD_DIR_TIPO,
		d.SGD_DIR_NOMBRE,
		a.radi_cuentai,
		g.SGD_EXP_NUMERO
		FROM RADICADO a,SGD_TPR_TPDCUMENTO b, SGD_DIR_DRECCIONES d, SGD_EXP_EXPEDIENTE g
		WHERE
		a.radi_nume_radi =d.radi_nume_radi AND
		a.radi_nume_radi  =g.radi_nume_radi (+) AND 
		a.tdoc_codi=b.sgd_tpr_codigo
		$whereTrd
		$where_ciu
		$where_general
		and rownum <= 200
		order by radi_fech_radi desc";
	}break;
	// Modificado SGD 20-Septiembre-2007
	case 'postgres':
		$query1 = "
		SELECT
		a.RADI_NUME_HOJA ,
		a.RADI_FECH_RADI  ,
		a.radi_nume_radi ,
		a.RA_ASUN  ,
		a.RADI_PATH ,
		a.RADI_USU_ANTE ,
		'' AS R_RADI_NOMB ,
		$sqlFecha AS FECHA ,
		b.sgd_tpr_descrip ,
		b.sgd_tpr_codigo ,
		b.sgd_tpr_termino,
		RADI_LEIDO ,
		RADI_TIPO_DERI ,
		RADI_NUME_DERI ,
		d.SGD_DIR_NOMREMDES,
		d.SGD_DIR_TIPO,
		d.SGD_DIR_NOMBRE,
		a.radi_cuentai,
		g.SGD_EXP_NUMERO
		FROM SGD_TPR_TPDCUMENTO b, SGD_DIR_DRECCIONES d,
		RADICADO a LEFT JOIN SGD_EXP_EXPEDIENTE g ON a.radi_nume_radi =g.radi_nume_radi
		WHERE
		a.radi_nume_radi =d.radi_nume_radi AND
		a.tdoc_codi=b.sgd_tpr_codigo
		$whereTrd
		$where_ciu
		$where_general
		order by radi_fech_radi desc
		limit 200";
		break;
}
?>