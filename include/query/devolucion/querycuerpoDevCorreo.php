<?
/**
  * CONSULTA VERIFICACION PREVIA A LA RADICACION
  */
switch($db->driver)
{
	case 'mssql':
		{	$sqlConcat = $db->conn->Concat("convert(char(14),a.radi_nume_sal,0)","'-'","convert(char(6),a.sgd_renv_codigo,0)");
			$isql = 'select "4" AS CHU_ESTADO
				,' . 0 . '              AS HID_DEVE_CODIGO
				,convert(varchar(14),a.radi_nume_sal)        AS "Radicado"
				,convert(varchar(14),c.RADI_NUME_DERI)       AS "Radicado Padre"
				,' . $sqlChar . '       AS "Fecha Envio"
				,a.sgd_renv_planilla    AS "Planilla"
				,a.sgd_renv_nombre      AS "Destinatario"
				,a.sgd_renv_dir         AS "Direccion"
				,a.sgd_renv_depto       AS "Departamento"
				,a.sgd_renv_mpio        AS "Municipio"
				,b.sgd_fenv_descrip     AS "Empresa de Envio"
				,d.USUA_LOGIN           AS "Usuario actual"
				,'.$valor.'             AS "Valor de envio"
				, '. $sqlConcat .  '    AS "CHK_RADI_NUME_SAL"
				,a.sgd_dir_tipo         AS HID_sgd_dir_tipo
				,a.sgd_renv_cantidad    AS HID_sgd_renv_cantidad
				,a.sgd_renv_codigo      AS HID_sgd_renv_codigo
				,c.RADI_FECH_RADI       AS HID_RADI_FECH_RADI
				,c.RA_ASUN              AS HID_RA_ASUN
				,d.USUA_NOMB            AS HID_USUA_NOMB
				,c.radi_depe_actu       AS HID_radi_depe_actu
			from sgd_renv_regenvio a
				 left outer join SGD_FENV_FRMENVIO b
		         on (a.sgd_fenv_codigo=b.sgd_fenv_codigo)
	             ,radicado c
				 ,usuario d
			where
				sgd_deve_codigo is not null ' .
				$dependencia_busq1 . ' ' .
				$dependencia_busq2 . '
				and a.sgd_renv_estado < 8' .
				$sql_masiva . '
				and	c.radi_nume_radi= a.radi_nume_sal
	  			and c.radi_depe_actu=d.depe_codi
				and c.radi_usua_actu=d.usua_codi
	      order by ' . $order .$orderTipo;
		}break;
	case 'oracle':
	case 'oci8':
	case 'oci805':
		{	$sqlConcat = $db->conn->Concat("a.radi_nume_sal","'-'","a.sgd_renv_codigo");
			$isql = 'select 0         AS HID_DEVE_CODIGO
				,to_char(a.radi_nume_sal)        AS "Radicado"
				,to_char(c.RADI_NUME_DERI)       AS "Radicado Padre"
				,' . $sqlChar . '       AS "Fecha Envio"
				,e.SGD_DEVE_DESC		AS "Motivo"
				,a.sgd_renv_planilla    AS "Planilla"
				,a.sgd_renv_nombre      AS "Destinatario"
				,a.sgd_renv_dir         AS "Direccion"
				,a.sgd_renv_depto       AS "Departamento"
				,a.sgd_renv_mpio        AS "Municipio"
				,b.sgd_fenv_descrip     AS "Empresa de Envio"
				,d.USUA_LOGIN           AS "Usuario actual"
				,'.$valor.'             AS "Valor de envio"
				, '. $sqlConcat .  '    AS "CHK_RADI_NUME_SAL"
				,a.sgd_dir_tipo         AS HID_sgd_dir_tipo
				,a.sgd_renv_cantidad    AS HID_sgd_renv_cantidad
				,a.sgd_renv_codigo      AS HID_sgd_renv_codigo
				,c.RADI_FECH_RADI       AS HID_RADI_FECH_RADI
				,c.RA_ASUN              AS HID_RA_ASUN
				,d.USUA_NOMB            AS HID_USUA_NOMB
				,c.radi_depe_actu       AS HID_radi_depe_actu
			from sgd_renv_regenvio a,
				sgd_fenv_frmenvio b,
				radicado c,
				usuario d,
				sgd_deve_dev_envio e
			where
				a.sgd_deve_codigo = e.sgd_deve_codigo ' .
				$dependencia_busq1 . ' ' .
				$dependencia_busq2 . '
				and a.sgd_fenv_codigo (+) = b.sgd_fenv_codigo
				and a.sgd_renv_estado < 8
				and rownum < 550 '
				.$sql_masiva . '
				and	c.radi_nume_radi= a.radi_nume_sal
				and c.radi_depe_actu=d.depe_codi
				and c.radi_usua_actu=d.usua_codi
	      order by ' . $order .$orderTipo;
		}break;
	case 'postgres':
		{	$sqlConcat = $db->conn->Concat("a.radi_nume_sal","'-'","a.sgd_renv_codigo");
			$isql = 'select 0         		 AS "HID_DEVE_CODIGO"
				,cast(a.radi_nume_sal as varchar(15))        AS "Radicado"
				,cast(c.RADI_NUME_DERI as varchar(15))       AS "Radicado Padre"
				,' . $sqlChar . '      		 AS "Fecha Envio"
				,e.SGD_DEVE_DESC		 AS "Motivo"
				,a.sgd_renv_planilla    AS "Planilla"
				,a.sgd_renv_nombre      AS "Destinatario"
				,a.sgd_renv_dir         AS "Direccion"
				,a.sgd_renv_depto       AS "Departamento"
				,a.sgd_renv_mpio        AS "Municipio"
				,b.sgd_fenv_descrip     AS "Empresa de Envio"
				,d.USUA_LOGIN           AS "Usuario actual"
				,'.$valor.'             AS "Valor de envio"
				, '. $sqlConcat .  '    AS "CHK_RADI_NUME_SAL"
				,a.sgd_dir_tipo         AS "HID_sgd_dir_tipo"
				,a.sgd_renv_cantidad    AS "HID_sgd_renv_cantidad"
				,a.sgd_renv_codigo      AS "HID_sgd_renv_codigo"
				,c.RADI_FECH_RADI       AS "HID_RADI_FECH_RADI"
				,c.RA_ASUN              AS "HID_RA_ASUN"
				,d.USUA_NOMB            AS "HID_USUA_NOMB"
				,c.radi_depe_actu       AS "HID_radi_depe_actu"
			from sgd_renv_regenvio a LEFT OUTER JOIN sgd_fenv_frmenvio b ON a.sgd_fenv_codigo = b.sgd_fenv_codigo,
				radicado c,
				usuario d,
				sgd_deve_dev_envio e
			where
				a.sgd_deve_codigo = e.sgd_deve_codigo ' .
				$dependencia_busq1 . ' ' .
				$dependencia_busq2 . '
				and a.sgd_renv_estado < 8
				'.$sql_masiva . '
				and	c.radi_nume_radi= a.radi_nume_sal
				and c.radi_depe_actu=d.depe_codi
				and c.radi_usua_actu=d.usua_codi
	      order by ' . $order .$orderTipo;
		}break;
}
?>
