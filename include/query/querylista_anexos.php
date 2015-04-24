<?

switch ($db->driver) 
	{ 
	case "oracle" :
	case 'oci8':
		$nombre = "RADI_NUME_SALIDA";
	break;	
	case "mssql":
		$nombre = "convert(varchar(14), RADI_NUME_SALIDA) as RADI_NUME_SALIDA";
	break;				   			   
	}
?>
