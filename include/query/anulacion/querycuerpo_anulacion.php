<?php
// CONSULTA VERIFICACION PREVIA A LA RADICACION
switch($db->driver) {  
	case 'mssql':
		$isql = 'select
				convert(varchar(14), b.RADI_NUME_RADI) "IMG_Numero Radicado",
				b.RADI_PATH "HID_RADI_PATH",
				convert(varchar(14),b.RADI_NUME_DERI) "Radicado Padre",
				b.RADI_FECH_RADI "HOR_RAD_FECH_RADI",'.
				$sqlFecha.' "Fecha Radicado",
				b.RA_ASUN "Descripcion",
				c.SGD_TPR_DESCRIP "Tipo Documento",
				convert(varchar(14),b.RADI_NUME_RADI) "CHK_CHKANULAR"
			from
				radicado b, SGD_TPR_TPDCUMENTO c
			where 
				b.radi_nume_radi is not null
				and '.$db->conn->substr.'(convert(char(15),b.radi_nume_radi), 5, 3)='.$dep_sel.'
				and b.tdoc_codi=c.sgd_tpr_codigo
				and sgd_eanu_codigo is null '.
				$whereTpAnulacion.' '.$whereFiltro.'
			order by '.$order .' ' .$orderTipo;
		break;
	case 'oracle':
	case 'oci8':
	case 'oci805':
	//MODIFICADO CARLOS BARRERO 07-12-09
	//if($_SESSION['entidad']!="SES")
	//{
		$isql = 'select
				to_char(b.RADI_NUME_RADI) "IMG_Numero Radicado",
				b.RADI_PATH "HID_RADI_PATH",
				to_char(b.RADI_NUME_DERI) "Radicado Padre",
				b.RADI_FECH_RADI "HOR_RAD_FECH_RADI",
				b.RADI_FECH_RADI "Fecha Radicado",
				b.RA_ASUN "Descripcion",
				c.SGD_TPR_DESCRIP "Tipo Documento",
				b.RADI_NUME_RADI "CHK_CHKANULAR"
			from
				radicado b, SGD_TPR_TPDCUMENTO c
			where 
				b.radi_nume_radi is not null
				and '.$db->conn->substr.'(b.radi_nume_radi, 14, 1) <> 2 
				and b.tdoc_codi=c.sgd_tpr_codigo
				and sgd_eanu_codigo is null'.
				$whereTpAnulacion.' '.$whereFiltro.'
			order by '.$order .' ' .$orderTipo;
	//}
/*	
else
	{
		$isql = 'select
				to_char(b.RADI_NUME_RADI) "IMG_Numero Radicado",
				b.RADI_PATH "HID_RADI_PATH",
				to_char(b.RADI_NUME_DERI) "Radicado Padre",
				b.RADI_FECH_RADI "HOR_RAD_FECH_RADI",
				b.RADI_FECH_RADI "Fecha Radicado",
				b.RA_ASUN "Descripcion",
				c.SGD_TPR_DESCRIP "Tipo Documento",
				b.RADI_NUME_RADI "CHK_CHKANULAR"
			from
				radicado b, SGD_TPR_TPDCUMENTO c
			where 
				b.radi_nume_radi is not null
				-- and '.$db->conn->substr.'(b.radi_nume_radi, 5, 1)='.$v_dep_sel.'
				and '.$db->conn->substr.'(b.radi_nume_radi, 14, 1) <> 2 
				and b.tdoc_codi=c.sgd_tpr_codigo
				and sgd_eanu_codigo is null'.
				$whereTpAnulacion.' '.$whereFiltro.'
			order by '.$order .' ' .$orderTipo;

	}*/
		break;
	default:
		$isql = 'select
				b.RADI_NUME_RADI as "IMG_Numero Radicado",
				b.RADI_PATH as "HID_RADI_PATH",
				b.RADI_NUME_DERI as "Radicado Padre",'.
				$db->conn->SQLDate('Y-m-d H:i:s', 'b.RADI_FECH_RADI').' as "HOR_RAD_FECH_RADI",'.
				$db->conn->SQLDate('Y-m-d H:i:s', 'b.RADI_FECH_RADI').' as "Fecha Radicado",
				b.RA_ASUN as "Descripcion",
				c.SGD_TPR_DESCRIP as "Tipo Documento",
				b.RADI_NUME_RADI as "CHK_CHKANULAR"
			from
				radicado b, SGD_TPR_TPDCUMENTO c
			where 
			 	b.radi_nume_radi is not null
				and '.$db->conn->substr.'( CAST( b.radi_nume_radi AS VARCHAR(15) ), 5, 3)= \''.$dep_sel.'\'
				and '.$db->conn->substr.'( CAST( b.radi_nume_radi AS VARCHAR(15) ), 14, 1) not in (\'2\') 
				and b.tdoc_codi=c.sgd_tpr_codigo
				and sgd_eanu_codigo is null '.
				$whereTpAnulacion.' '.$whereFiltro.'
         	order by '.$order .' ' .$orderTipo;
}
?>
