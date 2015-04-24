<?
	/**
	  * CONSULTA VERIFICACION PREVIA A LA RADICACION
	  */
	switch($db->driver)
	{  
	 case 'mssql':
			$sqlConcat = $db->conn->Concat("convert(char(4),t.sgd_tpr_codigo,0)","'-'","t.sgd_tpr_descrip");
	break;		
	case 'oracle':
	case 'oci8':
			$sqlConcat = $db->conn->Concat("t.sgd_tpr_codigo","'-'","t.sgd_tpr_descrip");
	break;		
	case 'postgres'=
			$sqlConcat = $db->conn->Concat("t.sgd_tpr_codigo","'-'","t.sgd_tpr_descrip");
	break;	
}	
?>
