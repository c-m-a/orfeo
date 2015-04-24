<?
	/**
	  * CONSULTA VERIFICACION PREVIA A LA RADICACION
	  */
	switch($db->driver)
	{
	 case 'mssql':
		$sqlConcat = $db->conn->Concat("convert(char(14),a.radi_nume_sal,0)","'-'","cast(a.sgd_renv_codigo as varchar)");
		$isql = 'select "4" AS CHU_ESTADO
            ,' . 0 . '              AS HID_DEVE_CODIGO
            ,convert(varchar(15), a.radi_nume_sal)        AS "Radicado"
			,convert(varchar(15), c.RADI_NUME_DERI)       AS "Radicado Padre"
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
			,convert(varchar(15), c.RADI_FECH_RADI)       AS HID_RADI_FECH_RADI
			,c.RA_ASUN              AS HID_RA_ASUN
			,d.USUA_NOMB            AS HID_USUA_NOMB
			,c.radi_depe_actu       AS HID_radi_depe_actu
			,a.sgd_deve_codigo
		from sgd_renv_regenvio a
			 left outer join SGD_FENV_FRMENVIO b
				on (a.sgd_fenv_codigo=b.sgd_fenv_codigo)
				,radicado c
			 ,usuario d
		where sgd_deve_codigo is null and' .
			$dependencia_busq1 . ' '.
			$db->conn->substr.'(convert(char(15),a.radi_nume_sal), 5, 3)='.$dep_sel.' '.
			$dependencia_busq2 . '
			and a.sgd_renv_estado < 8' .
			$sql_masiva . '
			and	c.radi_nume_radi= a.radi_nume_sal
  			and c.radi_depe_actu=d.depe_codi
			and c.radi_usua_actu=d.usua_codi
      order by ' . $order .$orderTipo;
	break;
	case 'oracle':
	case 'oci8':
	case 'oci805':
 	    $sqlConcat = $db->conn->Concat("a.radi_nume_sal","'-'","a.sgd_renv_codigo");

		$isql = 'select ' . "4" . '         AS CHU_ESTADO
            ,' . 0 . '              AS HID_DEVE_CODIGO
            ,a.radi_nume_sal        AS "Radicado"
			,c.RADI_NUME_DERI       AS "Radicado Padre"
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
		from sgd_renv_regenvio a,
			 sgd_fenv_frmenvio b,
             radicado c, usuario d
		where sgd_deve_codigo =0 and' .
			$dependencia_busq1 . ' '.
			$db->conn->substr.'(a.radi_nume_sal, 5, 3)='.$dep_sel.' '.
			$dependencia_busq2 . '
			and a.sgd_fenv_codigo (+) = b.sgd_fenv_codigo
			and a.sgd_renv_estado < 8
			and rownum < 550 ' .
			$sql_masiva . '
			and	c.radi_nume_radi= a.radi_nume_sal
  			    and c.radi_depe_actu=d.depe_codi
			    and c.radi_usua_actu=d.usua_codi
      order by ' . $order .$orderTipo;
	break;
	
	//Modificacion skina
	default:
		
		$sqlConcat = $db->conn->Concat("a.radi_nume_sal","'-'","a.sgd_renv_codigo");
	
		$isql = 'select ' . "4" . '         	AS "CHU_ESTADO"
				,' . 0 . '              AS "HID_DEVE_CODIGO"
				,a.radi_nume_sal        AS "Radicado"
				,c.RADI_NUME_DERI       AS "Radicado Padre"
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
				,a.sgd_dir_tipo         AS "HID_sgd_dir_tipo"
				,a.sgd_renv_cantidad    AS "HID_sgd_renv_cantidad"
				,a.sgd_renv_codigo      AS "HID_sgd_renv_codigo"
				,c.RADI_FECH_RADI       AS "HID_RADI_FECH_RADI"
				,c.RA_ASUN              AS "HID_RA_ASUN"
				,d.USUA_NOMB            AS "HID_USUA_NOMB"
				,c.radi_depe_actu       AS "HID_radi_depe_actu"
			from sgd_renv_regenvio a LEFT OUTER JOIN
				sgd_fenv_frmenvio b
				ON a.sgd_fenv_codigo = b.sgd_fenv_codigo,
				radicado c, usuario d
			where sgd_deve_codigo is null and' .
				$dependencia_busq1 . ' '.
				$db->conn->substr.'(cast(a.radi_nume_sal as varchar(18)), 5, 3)='."'".$dep_sel."'".' '.
				$dependencia_busq2 . '
				
				and a.sgd_renv_estado < 8
				' .$sql_masiva . '
				and	c.radi_nume_radi= a.radi_nume_sal
				and c.radi_depe_actu=d.depe_codi
				and c.radi_usua_actu=d.usua_codi
			order by ' . $order .$orderTipo;
	}
?>
