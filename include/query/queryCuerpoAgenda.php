<?php
$coltp3Esp = '"'.$tip3Nombre[3][2].'"';
$sqlFechaAgenda = $db->conn->SQLDate("Y-m-d H:i A","agen.SGD_AGEN_FECHPLAZO");

($agendado==1) ? $sbl = '>=' : $sbl = '<='; 
$whereAgendado = " AND agen.SGD_AGEN_FECHPLAZO".$sbl.$db->conn->sysDate;

switch($db->driver)
{
	case 'mssql':
	{
		$isql = 'select
				convert(char(14), b.RADI_NUME_RADI) as "IDT_Numero Radicado",
				b.RADI_PATH as "HID_RADI_PATH",'.
				$sqlFecha.' as "DAT_Fecha Radicado",'.
				$sqlFechaAgenda.' as "DAT_Fecha Plazo Agenda",
				convert(char(14), b.RADI_NUME_RADI) as "HID_RADI_NUME_RADI",
				UPPER(b.RA_ASUN)  as "Asunto",
				c.SGD_TPR_DESCRIP as "Tipo Documento",
				(select usua_login from usuario us where us.USUA_DOC=agen.USUA_DOC) "Agendado Por",
				convert(char(14),b.RADI_NUME_RADI) "CHK_CHKANULAR",
				b.RADI_LEIDO "HID_RADI_LEIDO",
				b.RADI_NUME_HOJA "HID_RADI_NUME_HOJA",
				b.CARP_PER "HID_CARP_PER",
				b.CARP_CODI "HID_CARP_CODI",
				b.SGD_EANU_CODIGO "HID_EANU_CODIGO",
				b.RADI_NUME_DERI "HID_RADI_NUME_DERI",
				b.RADI_TIPO_DERI "HID_RADI_TIPO_DERI"
		 from
		 SGD_AGEN_AGENDADOS AGEN,
		 radicado b
			left outer join SGD_TPR_TPDCUMENTO c
			on b.tdoc_codi=c.sgd_tpr_codigo
			left outer join BODEGA_EMPRESAS d
			on b.eesp_codi=d.identificador_empresa
    	where
    		b.RADI_NUME_RADI=agen.RADI_NUME_RADI
    		AND agen.SGD_AGEN_ACTIVO=1
			AND b.radi_nume_radi is not null
			AND b.radi_depe_actu='.$dependencia.
			$whereUsuario.$whereFiltro.$whereAgendado.'
	  	order by '.$order .' ' .$orderTipo;
	}break;
	case 'oracle':
	case 'oci8':
	case 'oci805':
	case 'ocipo':
	{
		$isql = 'select
				to_char(b.RADI_NUME_RADI) as "IDT_Numero_Radicado",
				b.RADI_PATH as "HID_RADI_PATH",'.
				$sqlFecha.' as "DAT_Fecha Radicado",
				to_char(b.RADI_NUME_RADI) as "HID_RADI_NUME_RADI",'.
				$sqlFechaAgenda.' as "Fecha Plazo Agenda",
				UPPER(agen.SGD_AGEN_OBSERVACION) Observacion,
				UPPER(b.RA_ASUN)  as "Asunto",
				c.SGD_TPR_DESCRIP as "Tipo Documento",
				round(agen.SGD_AGEN_FECHPLAZO-sysdate) as "Dias Calendario Restantes",
				us.USUA_LOGIN "Agendado Por",
				(select usActu.usua_login from usuario usActu where usActu.usua_codi=b.radi_usua_actu and usActu.depe_codi=b.radi_depe_actu) "Usuario_Actual",
				to_char(b.RADI_NUME_RADI) "CHK_CHKANULAR",
				b.RADI_LEIDO "HID_RADI_LEIDO",
				b.RADI_NUME_HOJA "HID_RADI_NUME_HOJA",
				b.CARP_PER "HID_CARP_PER",
				b.CARP_CODI "HID_CARP_CODI",
				b.SGD_EANU_CODIGO "HID_EANU_CODIGO",
				b.RADI_NUME_DERI "HID_RADI_NUME_DERI",
				b.RADI_TIPO_DERI "HID_RADI_TIPO_DERI"
			from
		 		radicado b,
		 		SGD_TPR_TPDCUMENTO c,
		 		SGD_AGEN_AGENDADOS AGEN,
		 		USUARIO us
		 	where
		 		agen.USUA_DOC=us.USUA_DOC
		 		AND b.RADI_NUME_RADI=agen.RADI_NUME_RADI
		 		AND agen.USUA_DOC='.$usua_doc.'
		 		AND agen.SGD_AGEN_ACTIVO=1
				AND b.radi_nume_radi is not null
				'.$whereUsuario.$whereFiltro.$whereAgendado.
				' AND b.tdoc_codi=c.sgd_tpr_codigo (+)
		  	order by '.$order .' ' .$orderTipo;
	}break;
	case 'postgres':
	case 'postgres7':
	{
		$isql = 'select
					b.RADI_NUME_RADI as "IDT_Numero_Radicado",
					b.RADI_PATH as "HID_RADI_PATH",'.
					$sqlFecha.' as "DAT_Fecha Radicado",
					b.RADI_NUME_RADI as "HID_RADI_NUME_RADI",'.
					$sqlFechaAgenda.' as "Fecha Plazo Agenda",
					UPPER(agen.SGD_AGEN_OBSERVACION) AS "Observacion",
					UPPER(b.RA_ASUN)  as "Asunto",
					c.SGD_TPR_DESCRIP as "Tipo Documento",
					/*(agen.SGD_AGEN_FECHPLAZO-'.$db->conn->sysDate.')::interval as "Dias Calendario Restantes",*/
					(agen.SGD_AGEN_FECHPLAZO-'.$db->conn->sysDate.') as "Dias Calendario Restantes",
					us.USUA_LOGIN AS "Agendado Por",
					(select usActu.usua_login from usuario usActu where usActu.usua_codi=b.radi_usua_actu and usActu.depe_codi=b.radi_depe_actu) AS "Usuario_Actual",
					b.RADI_NUME_RADI AS "CHK_CHKANULAR",
					b.RADI_LEIDO AS "HID_RADI_LEIDO",
					b.RADI_NUME_HOJA AS "HID_RADI_NUME_HOJA",
					b.CARP_PER AS "HID_CARP_PER",
					b.CARP_CODI AS "HID_CARP_CODI",
					b.SGD_EANU_CODIGO AS "HID_EANU_CODIGO",
					b.RADI_NUME_DERI AS "HID_RADI_NUME_DERI",
					b.RADI_TIPO_DERI AS "HID_RADI_TIPO_DERI"
			 from			 
			 SGD_AGEN_AGENDADOS AGEN,
			 USUARIO us,
			 radicado b LEFT JOIN SGD_TPR_TPDCUMENTO c ON b.tdoc_codi=c.sgd_tpr_codigo
		 where
			agen.USUA_DOC=us.USUA_DOC
			AND b.RADI_NUME_RADI=agen.RADI_NUME_RADI
			AND agen.USUA_DOC=\''.$usua_doc.'\'
			AND agen.SGD_AGEN_ACTIVO=1
			AND b.radi_nume_radi is not null
			'.$whereUsuario.$whereFiltro.$whereAgendado.
			' order by '.$order .' ' .$orderTipo;
	}break;
	default:
	{	
		$isql = 'select
					b.RADI_NUME_RADI as "IDT_Numero_Radicado",
					b.RADI_PATH as "HID_RADI_PATH",'.
					$sqlFecha.' as "DAT_Fecha Radicado",
					b.RADI_NUME_RADI as "HID_RADI_NUME_RADI",'.
					$sqlFechaAgenda.' as "Fecha Plazo Agenda",
					UPPER(agen.SGD_AGEN_OBSERVACION) AS "Observacion",
					UPPER(b.RA_ASUN)  as "Asunto",
					c.SGD_TPR_DESCRIP as "Tipo Documento",
					(agen.SGD_AGEN_FECHPLAZO-'.$db->conn->sysDate.') as "Dias Calendario Restantes",
					us.USUA_LOGIN AS "Agendado Por",
					(select usActu.usua_login from usuario usActu where usActu.usua_codi=b.radi_usua_actu and usActu.depe_codi=b.radi_depe_actu) AS "Usuario_Actual",
					b.RADI_NUME_RADI AS "CHK_CHKANULAR",
					b.RADI_LEIDO AS "HID_RADI_LEIDO",
					b.RADI_NUME_HOJA AS "HID_RADI_NUME_HOJA",
					b.CARP_PER AS "HID_CARP_PER",
					b.CARP_CODI AS "HID_CARP_CODI",
					b.SGD_EANU_CODIGO AS "HID_EANU_CODIGO",
					b.RADI_NUME_DERI AS "HID_RADI_NUME_DERI",
					b.RADI_TIPO_DERI AS "HID_RADI_TIPO_DERI"
			 from			 
			 SGD_AGEN_AGENDADOS AGEN,
			 USUARIO us,
			 radicado b LEFT JOIN SGD_TPR_TPDCUMENTO c ON b.tdoc_codi=c.sgd_tpr_codigo
		 where
			agen.USUA_DOC=us.USUA_DOC
			AND b.RADI_NUME_RADI=agen.RADI_NUME_RADI
			AND agen.USUA_DOC='.$usua_doc.'
			AND agen.SGD_AGEN_ACTIVO=1
			AND b.radi_nume_radi is not null
			'.$whereUsuario.$whereFiltro.$whereAgendado.
			' order by '.$order .' ' .$orderTipo;
	}break;
}
?>
