<?php
	/**
	  * CONSULTA VERIFICACION PREVIA A LA RADICACION
	  */
	switch($db->driver)
	{  
	 case 'mssql':
		$sqlConcat = $db->conn->Concat("convert(char(2),SGD_DEVE_CODIGO,0)","'-'","SGD_DEVE_DESC");
		break;		
	case 'oracle':
	case 'oci8':
	case 'oci805':
		$sqlConcat = $db->conn->Concat("SGD_DEVE_CODIGO","'-'","SGD_DEVE_DESC");
		break;		
	default:
		$sqlConcat = $db->conn->Concat("SGD_DEVE_CODIGO","'-'","SGD_DEVE_DESC");
		break;
	}
?>
