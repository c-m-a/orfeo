<?

	/**
	  * CONSULTA DE UPLOAD FILE 
	  * @author JAIRO LOSADA DNP - SSPD 2006/03/01
	  * @version 3.5.1
	  * 
	  * @param $query String Almacena Consulta que se enviara
	  * @param $sqlFecha String  Almacena fecha en  formato Y-m-d que devuelve ADODB para la base de datos escogida
	  */
	//$db->conn->debug = true;
	$sqlFecha = $db->conn->SQLDate("Y-m-d H:i A","RADI_FECH_RADI");
	switch($db->driver)
	{
	case 'mssql':
		$query = "SELECT 
			convert(char(15), RADI_NUME_RADI) as IDT_Numero_Radicado,
			RADI_PATH as HID_RADI_PATH,		
			$sqlFecha as DAT_Fecha_Radicado,
			RADI_NUME_DERI RADICADO_PADRE,
			convert(char(14), RADI_NUME_RADI) as HID_RADI_NUME_RADI,
			RA_ASUN ASUNTO,
			convert(varchar(15), radi_nume_radi) CHR_DATO
			FROM RADICADO
			 WHERE
			 $busq_radicados_tmp
			 ORDER BY RADI_FECH_RADI DESC";
		$query2 = "SELECT 
			convert(char(15), RADI_NUME_RADI) as IDT_Numero_Radicado,
			RADI_PATH as HID_RADI_PATH,		
			$sqlFecha as DAT_Fecha_Radicado,
			RADI_NUME_DERI RADICADO_PADRE,
			convert(char(14), RADI_NUME_RADI) as HID_RADI_NUME_RADI,
			RA_ASUN ASUNTO
			FROM RADICADO
			 WHERE
			 	 $busq_radicados_tmp
			 ";
	break;
//	case 'oracle':
//	case 'oci8':
//	case 'oci805':	
//	Modificado skina para postgres
	default:	
	$query = 'SELECT 
			RADI_NUME_RADI as "IDT_Numero_Radicado",
			RADI_PATH as "HID_RADI_PATH",
			'.$sqlFecha.' as "DAT_Fecha_Radicado",
			RADI_NUME_DERI as "RADICADO_PADRE",
			RADI_NUME_RADI as "HID_RADI_NUME_RADI",
			RA_ASUN as "ASUNTO",
			RADI_NUME_RADI as "CHR_DATO"
			FROM RADICADO
			 WHERE
			 '.$busq_radicados_tmp.'
			 ORDER BY RADI_FECH_RADI DESC';
	$query2 = 'SELECT 
			RADI_NUME_RADI as "IDT_Numero_Radicado",
			RADI_PATH as "HID_RADI_PATH",
			'.$sqlFecha.' as "DAT_Fecha_Radicado",
			RADI_NUME_DERI as "RADICADO_PADRE",
			RADI_NUME_RADI as "HID_RADI_NUME_RADI",
			RA_ASUN as "ASUNTO"
			FROM RADICADO
			 WHERE
			 '.$busq_radicados_tmp.'
			 ORDER BY RADI_FECH_RADI DESC';
	//break;
	}
?>
