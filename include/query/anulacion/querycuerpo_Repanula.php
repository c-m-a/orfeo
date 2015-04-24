<?
	/**
	  * CONSULTA VERIFICACION PREVIA A LA RADICACION
	  */
	switch($db->driver)
	{  
	 case 'mssql':
	  $isql = 'select
								convert(varchar(15), b.RADI_NUME_RADI) "IMG_Numero Radicado"
								,b.RADI_PATH "HID_RADI_PATH"
								,convert(varchar(15),b.RADI_NUME_DERI) "Radicado Padre"
								,b.RADI_FECH_RADI "HOR_RAD_FECH_RADI"
								,'.$sqlFecha.' "Fecha Radicado"
								,b.RA_ASUN "Descripcion"
								,c.SGD_TPR_DESCRIP "Tipo Documento"
								,d.usua_anu_acta "IMG_No Acta"
								,d.sgd_anu_path_acta "HID_PATH_ACTA"
						 from
						 radicado b,
						 SGD_TPR_TPDCUMENTO c,
						 sgd_anu_anulados d
					 where 
					 	b.radi_nume_radi is not null
						and b.radi_nume_radi=d.radi_nume_radi
						and '.$db->conn->substr.'(convert(char(15),b.radi_nume_radi), 5, 3)='.$dep_sel.'
						and b.tdoc_codi=c.sgd_tpr_codigo
						'.$whereTpAnulacion.'
						'.$whereFiltro.'
					  order by '.$order .' ' .$orderTipo;
	break;		
	case 'oracle':
	case 'oci8':
	case 'oci805':	
	//Modificacion skina
	case 'postgres':
	 $isql = 'select
								b.RADI_NUME_RADI	 as "IMG_Numero Radicado"
								,b.RADI_PATH 	       	as "HID_RADI_PATH"
								,b.RADI_NUME_DERI 	as "Radicado Padre"
								,b.RADI_FECH_RADI 	as "HOR_RAD_FECH_RADI"
								,b.RADI_FECH_RADI 	as "Fecha Radicado"
								,b.RA_ASUN 		as "Descripcion"
								,c.SGD_TPR_DESCRIP 	as "Tipo Documento"
								,d.usua_anu_acta 	as "IMG_No Acta"
								,d.sgd_anu_path_acta 	as "HID_PATH_ACTA"
						 from
						 radicado b,
						 SGD_TPR_TPDCUMENTO c,
						 sgd_anu_anulados d
					 where 
					 	b.radi_nume_radi is not null
						and b.radi_nume_radi=d.radi_nume_radi
						and '.$db->conn->substr.'(b.radi_nume_radi, 5, 3)='.$_GET['dep_sel'].'
						and b.tdoc_codi=c.sgd_tpr_codigo
						'.$whereTpAnulacion.'
						'.$whereFiltro.'
					  order by '.$order .' ' .$orderTipo;
				break;		
	}
?>
