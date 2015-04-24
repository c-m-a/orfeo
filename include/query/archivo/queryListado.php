<?
/**
* CONSULTA VERIFICACION PREVIA A LA RADICACION
*/

$where_isql2 = " WHERE SGD_ARCHIVO_DEPE = $depen AND $sqlChar = $fecha_mes ";

switch($db->driver)
{
	case 'mssql':
		{	$where_isql1 = " WHERE (c.SGD_ARCHIVO_DEPE = $depen AND c.sgd_archivo_fech >=".$db->conn->DBTimeStamp($fecha_ini)." and d.depe_codi=c.sgd_archivo_depe and p.sgd_pexp_codigo=c.sgd_archivo_proc and c.sgd_archivo_srd like '".$srd."') ";
	$query = "select distinct (convert(char(15),c.SGD_ARCHIVO_RAD))	as RADICADO,
		c.SGD_ARCHIVO_SRD as SRD,
		p.SGD_PEXP_DESCRIP AS TIPO ,
		c.SGD_ARCHIVO_DEMANDANTE as DOCUMENTO,
		c.SGD_ARCHIVO_DEMANDADO as TITULO,
		c.SGD_ARCHIVO_YEAR as PERIODO,
		c.SGD_ARCHIVO_FOLIOS as FOLIOS,
		c.SGD_ARCHIVO_CAJA as CAJA
		from SGD_ARCHIVO_CENTRAL c, DEPENDENCIA d, SGD_PEXP_PROCEXPEDIENTES p";
		}break;
	case 'oracle':
	case 'oci8':
	case 'oci805':	
	case 'postgres':
		$query ="select distinct( c.SGD_ARCHIVO_RAD ) as RADICADO,
		c.SGD_ARCHIVO_SRD as SRD,
		p.SGD_PEXP_DESCRIP AS TIPO ,
		c.SGD_ARCHIVO_DEMANDADO as TITULO,
		c.SGD_ARCHIVO_DEMANDANTE as DOCUMENTO,
		c.SGD_ARCHIVO_YEAR as PERIODO,
		c.SGD_ARCHIVO_FOLIOS as FOLIOS,
		c.SGD_ARCHIVO_CAJA as CAJA
		from SGD_ARCHIVO_CENTRAL c, DEPENDENCIA d, SGD_PEXP_PROCEXPEDIENTES p";

		$where_isql1 = " WHERE c.SGD_ARCHIVO_DEPE = $depen AND c.sgd_archivo_fech >=".$db->conn->DBTimeStamp($fecha_ini)." and d.depe_codi=c.sgd_archivo_depe and p.sgd_pexp_codigo=c.sgd_archivo_proc and c.sgd_archivo_srd = ".$srd;
		break;
	}
?>
