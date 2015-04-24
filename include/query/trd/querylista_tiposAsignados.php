<?
	/**
	  * Crea el codigo Asignado
	  */
	switch($db->driver)
	{  
	 case 'mssql': 
			$sqlConcat = $db->conn->Concat("convert(char(5),m.depe_codi,0)","convert(char(4),m.sgd_srd_codigo,0)","convert(char(4),m.sgd_sbrd_codigo,0)","convert(char(4),m.sgd_tpr_codigo,0)");
	break;		
	case 'oracle':
	case 'oci8':
		$sqlConcat = $db->conn->Concat("m.depe_codi","m.sgd_srd_codigo","m.sgd_sbrd_codigo","m.sgd_tpr_codigo");
	break;		

	case 'postgres':
		$sqlConcat = $db->conn->Concat("cast(m.depe_codi as varchar)","cast(m.sgd_srd_codigo as varchar)","cast(m.sgd_sbrd_codigo as varchar)","cast(m.sgd_tpr_codigo as varchar)");
	break;		
}
?>
