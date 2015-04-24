<?php
/**
  * CONSULTA VERIFICACION PREVIA A LA RADICACION
  */
switch($db->driver)
{
	case 'mssql':
		$isql = 'select 
             a.anex_estado CHU_ESTADO
		 	,a.sgd_deve_codigo HID_DEVE_CODIGO
			,a.sgd_deve_fech AS "HID_SGD_DEVE_FECH" 
			,convert(char(14),a.radi_nume_salida) AS "IMG_Radicado Salida"
			,c.RADI_PATH "HID_RADI_PATH"
            ,'.$db->conn->substr.'(convert(char(3),a.sgd_dir_tipo),2,3) AS "Copia"
			,convert(char(14),a.anex_radi_nume) AS "Radicado Padre"
			,c.radi_fech_radi AS "Fecha Radicado"
			,a.anex_desc AS "Descripcion"
			,a.sgd_fech_impres AS "Fecha Impresion"
			,a.anex_creador AS "Generado Por"
	        ,convert(char(14), a.radi_nume_salida) AS "CHK_RADI_NUME_SALIDA" 
			,a.sgd_deve_codigo HID_DEVE_CODIGO1
			,a.anex_estado HID_ANEX_ESTADO1
	        ,a.anex_nomb_archivo AS "HID_ANEX_NOMB_ARCHIVO" 
	        ,a.anex_tamano AS "HID_ANEX_TAMANO"
			,a.anex_radi_fech AS "HID_ANEX_RADI_FECH" 
			,' . "'WWW'" . ' AS "HID_WWW" 
			,' . "'9999'" . ' AS "HID_9999"     
			,a.anex_tipo AS "HID_ANEX_TIPO" 
			,a.anex_radi_nume AS "HID_ANEX_RADI_NUME" 
			,a.sgd_dir_tipo AS "HID_SGD_DIR_TIPO"
			,a.sgd_deve_codigo AS "HID_SGD_DEVE_CODIGO" 
		from anexos a,usuario b, radicado c
	    where a.ANEX_ESTADO = ' . "'3'" .
				$dependencia_busq2 .
				$where_tipRadi . 
				$where_fecha . '
				and a.radi_nume_salida=c.radi_nume_radi
				and a.anex_creador=b.usua_login
				and a.anex_borrado= ' . "'N'" . '
				and a.sgd_dir_tipo <> 7
				AND
				((c.SGD_EANU_CODIGO <> 2
				AND c.SGD_EANU_CODIGO <> 1) 
				or c.SGD_EANU_CODIGO IS NULL)
		        ';
		break;
	case 'oracle':
	case 'oci8':
	case 'oci805':
		$isql = 'select 
			a.anex_estado CHU_ESTADO
		 	,a.sgd_deve_codigo HID_DEVE_CODIGO
			,a.sgd_deve_fech AS "HID_SGD_DEVE_FECH" 
	    ,a.radi_nume_salida AS "IMG_Radicado Salida"
			,c.RADI_PATH "HID_RADI_PATH"
            ,substr(trim(a.sgd_dir_tipo),2,3) AS "Copia"
			,a.anex_radi_nume AS "Radicado Padre"
			,c.radi_fech_radi AS "Fecha Radicado"
			,a.anex_desc AS "Descripcion"
			,a.sgd_fech_impres AS "Fecha Impresion"
			,a.anex_creador AS "Generado Por"
	        ,a.radi_nume_salida AS "CHK_RADI_NUME_SALIDA" 
			,a.sgd_deve_codigo HID_DEVE_CODIGO1
			,a.anex_estado HID_ANEX_ESTADO1
	    ,a.anex_nomb_archivo AS "HID_ANEX_NOMB_ARCHIVO" 
	    ,a.anex_tamano AS "HID_ANEX_TAMANO"
			,a.anex_radi_fech AS "HID_ANEX_RADI_FECH" 
			,' . "'WWW'" . ' AS "HID_WWW" 
			,' . "'9999'" . ' AS "HID_9999"     
			,a.anex_tipo AS "HID_ANEX_TIPO" 
			,a.anex_radi_nume AS "HID_ANEX_RADI_NUME" 
			,a.sgd_dir_tipo AS "HID_SGD_DIR_TIPO"
			,a.sgd_deve_codigo AS "HID_SGD_DEVE_CODIGO"
		from anexos a,usuario b, radicado c
	    where a.ANEX_ESTADO = ' . "'3'" .
				$dependencia_busq2 .
				$where_tipRadi . 
				$where_fecha . '
				and a.radi_nume_salida=c.radi_nume_radi
				and a.anex_creador=b.usua_login
				and a.anex_borrado= ' . "'N'" . '
				and a.sgd_dir_tipo != 7
				and (a.sgd_deve_codigo >= 90 or a.sgd_deve_codigo =0 or a.sgd_deve_codigo is null)
				AND
				((c.SGD_EANU_CODIGO != 2
				AND c.SGD_EANU_CODIGO != 1) 
				or c.SGD_EANU_CODIGO IS NULL)
		        ';
		break;
	default:
		$isql = 'select 
			a.anex_estado AS "CHU_ESTADO"
		 	,a.sgd_deve_codigo AS "HID_DEVE_CODIGO"
			,a.sgd_deve_fech AS "HID_SGD_DEVE_FECH" 
	    		,a.radi_nume_salida AS "IMG_Radicado Salida"
			,c.RADI_PATH AS "HID_RADI_PATH"
            		,substr(trim(a.sgd_dir_tipo),2,3) AS "Copia"
			,a.anex_radi_nume AS "Radicado Padre"
			,c.radi_fech_radi AS "Fecha Radicado"
			,a.anex_desc AS "Descripcion"
			,a.sgd_fech_impres AS "Fecha Impresion"
			,a.anex_creador AS "Generado Por"
	        	,a.radi_nume_salida AS "CHK_RADI_NUME_SALIDA" 
			,a.sgd_deve_codigo AS "HID_DEVE_CODIGO1"
			,a.anex_estado AS "HID_ANEX_ESTADO1"
	    		,a.anex_nomb_archivo AS "HID_ANEX_NOMB_ARCHIVO" 
	    		,a.anex_tamano AS "HID_ANEX_TAMANO"
			,a.anex_radi_fech AS "HID_ANEX_RADI_FECH" 
			,' . "'WWW'" . ' AS "HID_WWW" 
			,' . "'9999'" . ' AS "HID_9999"     
			,a.anex_tipo AS "HID_ANEX_TIPO" 
			,a.anex_radi_nume AS "HID_ANEX_RADI_NUME" 
			,a.sgd_dir_tipo AS "HID_SGD_DIR_TIPO"
			,a.sgd_deve_codigo AS "HID_SGD_DEVE_CODIGO"
			from anexos a,usuario b, radicado c
	    		where a.ANEX_ESTADO = ' . "'3'" .
				$dependencia_busq2 .
				$where_tipRadi . 
				$where_fecha . '
				and a.radi_nume_salida=c.radi_nume_radi
				and a.anex_creador=b.usua_login
				and a.anex_borrado= ' . "'N'" . '
				and a.sgd_dir_tipo != 7
				and (a.sgd_deve_codigo >= 90 or a.sgd_deve_codigo =0 or a.sgd_deve_codigo is null)
				AND
				((c.SGD_EANU_CODIGO != 2
				AND c.SGD_EANU_CODIGO != 1) 
				or c.SGD_EANU_CODIGO IS NULL)
		        ';
		break;
}
?>