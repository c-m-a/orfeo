<?php
$coltp3Esp = '"'.$tip3Nombre[3][2].'"';

switch($db->driver)
{
	case 'mssql':
	{
		$isql = '';
	}break;
	case 'postgres':
	case 'postgres7':
	case 'oci8':
	{
		$isql = 'select
					b.RADI_NUME_RADI as "IDT_Numero_Radicado",
					b.RADI_PATH as "HID_RADI_PATH",'.
					$sqlFecha.' as "DAT_Fecha Transaccion",
					b.RADI_NUME_RADI as "HID_RADI_NUME_RADI",
					h.HIST_OBSE AS "Observacion",
					UPPER(b.RA_ASUN)  as "Asunto",
					c.SGD_TPR_DESCRIP as "Tipo Documento",
					(select usActu.usua_login from usuario usActu where usActu.usua_codi=b.radi_usua_actu and usActu.depe_codi=b.radi_depe_actu) AS "Usuario_Actual",
					ttr.SGD_TTR_DESCRIP AS "Tipo Transaccion",
					b.RADI_NUME_RADI AS "CHK_CHKANULAR",
					b.RADI_LEIDO AS "HID_RADI_LEIDO",
					b.RADI_NUME_HOJA AS "HID_RADI_NUME_HOJA",
					b.CARP_PER AS "HID_CARP_PER",
					b.CARP_CODI AS "HID_CARP_CODI",
					b.SGD_EANU_CODIGO AS "HID_EANU_CODIGO",
					b.RADI_NUME_DERI AS "HID_RADI_NUME_DERI",
					b.RADI_TIPO_DERI AS "HID_RADI_TIPO_DERI"
			 from			 
			 HIST_EVENTOS h,
			 USUARIO us,
			 SGD_TTR_TRANSACCION ttr,
			 radicado b LEFT JOIN SGD_TPR_TPDCUMENTO c ON b.tdoc_codi=c.sgd_tpr_codigo
		 where
			h.USUA_DOC=us.USUA_DOC
			AND h.SGD_TTR_CODIGO=ttr.SGD_TTR_CODIGO
			AND b.RADI_NUME_RADI=h.RADI_NUME_RADI
			AND h.USUA_DOC=\''.$usua_doc.'\'
			AND b.radi_nume_radi is not null
			AND ttr.SGD_TTR_CODIGO in (9,8,13,12,16) 
			'.$whereUsuario.$whereFiltro.
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
