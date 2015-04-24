<?
	/**
	  * CONSULTA VERIFICACION PREVIA A LA RADICACION
	  */
	switch($db->driver)
	{  
	 case 'mssql':
			$sqlConcat = $db->conn->Concat("convert(char(4),s.sgd_srd_codigo,0)","'-'","s.sgd_srd_descrip");
	break;		
	case 'oracle':
	case 'oci8':
			$sqlConcat = $db->conn->Concat("s.sgd_srd_codigo","'-'","s.sgd_srd_descrip");
	break;		
	}
?>