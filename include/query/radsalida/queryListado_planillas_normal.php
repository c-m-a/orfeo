<?
	/**
	  * CONSULTA VERIFICACION PREVIA A LA RADICACION
	  */
switch($db->driver)
{
	case 'mssql':
		$wrc = " WHERE SGD_RENV_CODIGO = $renv_codigo AND SGD_RENV_PLANILLA = '' ";
		$where_isql2 = " WHERE (DEPE_CODI= $dependencia
							AND sgd_renv_fech BETWEEN ".$db->conn->DBTimeStamp($fecha_ini)." AND ".
							$db->conn->DBTimeStamp($fecha_fin)." AND $sqlChar = $fecha_mes
							AND SGD_FENV_CODIGO = 108
							AND SGD_RENV_PLANILLA = ''
							AND sgd_renv_tipo <2)
						OR ($sqlChar = $fecha_mes AND SGD_RENV_PLANILLA = '".$no_planilla."'
							AND SGD_FENV_CODIGO = 108 
							AND DEPE_CODI= $dependencia
							AND sgd_renv_tipo <2) ";
		$where_isql1 = " WHERE DEPE_CODI= $dependencia 
							AND $sqlChar = $fecha_mes
							AND SGD_FENV_CODIGO = 108
							AND SGD_RENV_PLANILLA='".$no_planilla."' 
							AND sgd_renv_tipo < 2 ";						 
 		$query = "select SGD_RENV_CANTIDAD as CANTIDAD,
				  	'Normal' as CERTIFICADO,
				  	".$db->conn->substr."(convert(char(15),RADI_NUME_SAL),5,10) as REGISTRO,
				  	SGD_RENV_NOMBRE as DESTINATARIO,
				  	SGD_RENV_DESTINO as DESTINO,
				  	SGD_RENV_PESO as PESO,
				  	'' as VALOR_PORTE,
				  	SGD_RENV_VALOR as CERTIFICADO,
				  	'' as VALOR_ASEGURADO,
				  	'' as TASA_DE_SEGURO,
				  	'' as VALOR_REEMBOLSABLE,
				  	'' as AVISO_DE_LLEGADA,
				  	'' as SERVICIOS_ESPECIALES,
				  	(CONVERT(numeric,SGD_RENV_VALOR) * SGD_RENV_CANTIDAD) as VALOR_TOTAL,
				  	".$db->conn->substr."(convert(char(15),RADI_NUME_GRUPO),5,10) as RADI_NUME_GRUPO
				from SGD_RENV_REGENVIO "
				;
	break;
	case 'oracle':
	case 'oci8':
	case 'oci805':
	case 'postgres':
	$wrc = " WHERE SGD_RENV_CODIGO = $renv_codigo AND ( SGD_RENV_PLANILLA IS NULL OR SGD_RENV_PLANILLA = '' ) ";
	$query = "select  SGD_RENV_CANTIDAD AS CANTIDAD,
			'Normal' AS CERTIFICADO,
			substr(RADI_NUME_SAL,5,9) AS REGISTRO,
			substr(SGD_RENV_NOMBRE,1,25) as DESTINATARIO,
			SGD_RENV_DESTINO as DESTINO,
			TO_NUMBER(SGD_RENV_PESO, '999999999') as PESO,
			'' as VALOR_PORTE,
			TO_NUMBER(SGD_RENV_VALOR, '999999999') as CERTIFICADO,
			'' as VALOR_ASEGURADO,
			'' as TASA_DE_SEGURO,
			'' as VALOR_REEMBOLSABLE,
			'' as AVISO_DE_LLEGADA,
			'' as SERVICIOS_ESPECIALES,
			TO_NUMBER(SGD_RENV_VALOR, '999999999') * SGD_RENV_CANTIDAD as VALOR_TOTAL,
			substr(RADI_NUME_GRUPO,5,9) as RADI_NUME_GRUPO
			from SGD_RENV_REGENVIO "
				;		
	$where_isql2 = " WHERE (DEPE_CODI= " . $dependencia .
 		          " AND sgd_renv_fech BETWEEN " .$db->conn->DBTimeStamp($fecha_ini).
		          " AND " .$db->conn->DBTimeStamp($fecha_fin).
                  " AND ". $sqlChar . " = " .  $fecha_mes . 
		          "  AND SGD_FENV_CODIGO = 108 
					AND ( SGD_RENV_PLANILLA IS  NULL OR SGD_RENV_PLANILLA = '' )
		            AND sgd_renv_tipo <2)
                   OR (" . $sqlChar . " = " . $fecha_mes . 
				  " AND SGD_RENV_PLANILLA = " . "'" . $no_planilla . "'" .
				  " AND	SGD_FENV_CODIGO = 108 
				    AND DEPE_CODI= " . $dependencia . 
				  " AND sgd_renv_tipo <2) ";
	$where_isql1 = " WHERE DEPE_CODI= " . $dependencia . 
                  " AND " . $sqlChar . " = "  . $fecha_mes . 
	              " AND SGD_FENV_CODIGO = 108
	                AND SGD_RENV_PLANILLA=" . "'" . $no_planilla . "'" .
			      " AND sgd_renv_tipo <2 ";
				
				 
		break;
	}
?>
