<?
	/**
	  * CONSULTA VERIFICACION PREVIA A LA RADICACION
	  */
	switch($db->driver)
	{
	case 'mssql':
	    $wplanilla = " SGD_RENV_PLANILLA = '' ";
		
	 	$where_isql2 = ' WHERE (DEPE_CODI= ' . $dependencia .
				         ' AND sgd_renv_fech BETWEEN '.$db->conn->DBTimeStamp($fecha_ini).
				         ' AND '.$db->conn->DBTimeStamp($fecha_fin).
	                     ' AND '. $sqlChar . ' = ' . $fecha_mes .'  
						   AND SGD_FENV_CODIGO = 109
						   AND SGD_RENV_PLANILLA = ""
						   AND sgd_renv_tipo <2)
						   OR ('. $sqlChar . ' = ' . $fecha_mes . 
						 ' AND SGD_RENV_PLANILLA = ' . $no_planilla . 
						 ' AND SGD_FENV_CODIGO = 109 
						   AND DEPE_CODI= ' . $dependencia . 
						 ' AND sgd_renv_tipo <2) ';
		$where_isql1 = ' WHERE DEPE_CODI= ' . $dependencia .
			              ' AND '. $sqlChar . ' = '  . $fecha_mes . '
							AND SGD_FENV_CODIGO = 109
							AND SGD_RENV_PLANILLA=' . $no_planilla .
						  ' AND sgd_renv_tipo <2 ';				 
 	$query = "select SGD_RENV_CANTIDAD CANTIDAD,
			'Cert.Acuse de Recibo' CERTIFICADO,
			".$db->conn->substr."(convert(char(15),RADI_NUME_SAL),5,10) as REGISTRO,
			".$db->conn->substr."(SGD_RENV_NOMBRE,1,25) as DESTINATARIO,
            	".$db->conn->substr."(SGD_RENV_DIR,1,50) as DIRECCION,			
			SGD_RENV_MPIO as MUNICIPIO, 
			".$db->conn->substr."(SGD_RENV_DEPTO,1,10) as DEPARTAMENTO,
			CONVERT(numeric,SGD_RENV_PESO) as PESO,
			SGD_RENV_VALOR as VALOR_PORTE,
			CONVERT(numeric,SGD_RENV_VADICIONAL) as VACUSE,
			SGD_RENV_VALISTAMIENTO as VALOR_ALISTAMIENTO,
			SGD_RENV_VDESCUENTO as VALOR_DESCUENTO,
			SGD_RENV_VALOR + SGD_RENV_VALISTAMIENTO + SGD_RENV_VDESCUENTO as VALOR_TOTAL,
  		    ".$db->conn->substr."(convert(char(15),RADI_NUME_GRUPO),5,10) as RADI_NUME_GRUPO
			from SGD_RENV_REGENVIO ";  
	break;
	case 'oracle':
	case 'oci8':
	case 'postgres':
	    $wplanilla = " ( SGD_RENV_PLANILLA IS  NULL OR SGD_RENV_PLANILLA = '' ) ";

		$query = "select  SGD_RENV_CANTIDAD AS CANTIDAD,
			'Cert.Acuse de Recibo' AS CERTIFICADO,
			substr(RADI_NUME_SAL,5,9) AS REGISTRO,
			substr(SGD_RENV_NOMBRE,1,25) as DESTINATARIO,
            substr(SGD_RENV_DIR,1,50) as DIRECCION,			
			SGD_RENV_MPIO as MUNICIPIO, 
			substr(SGD_RENV_DEPTO,1,10) as DEPARTAMENTO,
			TO_NUMBER(SGD_RENV_PESO, '999999999') as PESO,
			SGD_RENV_VALOR as VALOR_PORTE,
			/*TO_NUMBER(SGD_RENV_VADICIONAL, '999999999') as VACUSE,*/
			CASE WHEN SGD_RENV_VADICIONAL <> '' AND SGD_RENV_VADICIONAL IS NOT NULL
				THEN TO_NUMBER(SGD_RENV_VADICIONAL, '999999999')
			END as VACUSE,
			SGD_RENV_VALISTAMIENTO as VALOR_ALISTAMIENTO,
			SGD_RENV_VDESCUENTO as VALOR_DESCUENTO,
			/*SGD_RENV_VALOR + TO_NUMBER( SGD_RENV_VALISTAMIENTO, '999999999' ) + TO_NUMBER( SGD_RENV_VDESCUENTO, '999999999' ) as VALOR_TOTAL,*/
			CASE WHEN SGD_RENV_VALISTAMIENTO IS NOT NULL AND SGD_RENV_VALISTAMIENTO <> '' AND SGD_RENV_VDESCUENTO IS NOT NULL AND SGD_RENV_VDESCUENTO <> ''
				THEN  SGD_RENV_VALOR + TO_NUMBER( SGD_RENV_VALISTAMIENTO, '999999999' ) + TO_NUMBER( SGD_RENV_VDESCUENTO, '999999999' )
			END AS VALOR_TOTAL,
  		    substr(RADI_NUME_GRUPO,5,9) as RADI_NUME_GRUPO
			from SGD_RENV_REGENVIO 
			";  		
	
		$where_isql2 = ' WHERE (DEPE_CODI= ' . $dependencia .
				         ' AND sgd_renv_fech BETWEEN '.$db->conn->DBTimeStamp($fecha_ini).
				         ' AND '.$db->conn->DBTimeStamp($fecha_fin).
	                     ' AND '. $sqlChar . ' = ' . $fecha_mes .'  
						   AND SGD_FENV_CODIGO = 109
						   AND ( SGD_RENV_PLANILLA IS NULL OR SGD_RENV_PLANILLA = \'\' )
						   AND sgd_renv_tipo <2)
						   OR ('. $sqlChar . ' = ' . $fecha_mes . 
						 ' AND SGD_RENV_PLANILLA = ' . "'" . $no_planilla . "'" .
						 ' AND SGD_FENV_CODIGO = 109 
						   AND DEPE_CODI= ' . $dependencia . 
						 ' AND sgd_renv_tipo <2) ';
	$where_isql1 = ' WHERE DEPE_CODI= ' . $dependencia .
			              ' AND '. $sqlChar . ' = '  . $fecha_mes . '
							AND SGD_FENV_CODIGO = 109
							AND SGD_RENV_PLANILLA=' . "'" . $no_planilla . "'" .
						  ' AND sgd_renv_tipo <2 ';

				 
		break;
	}
?>
