<?
	/**
	  * CONSULTA VERIFICACION PREVIA A LA RADICACION
	  */
	switch($db->driver)
	{  
	 case 'mssql':
			$sqlConcat = $db->conn->Concat("convert(char(4),su.sgd_sbrd_codigo,0)","'-'","su.sgd_sbrd_descrip");
	break;		
	case 'oracle':
	case 'oci8':
			$sqlConcat = $db->conn->Concat("su.sgd_sbrd_codigo","'-'","su.sgd_sbrd_descrip");
	break;		
	}
?>