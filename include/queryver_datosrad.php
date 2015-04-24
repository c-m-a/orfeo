<?

switch ($db->driver) 
	{ 
	case "oracle" :
	case 'oci8':
	case 'postgres'
		$numero = "RADI_NUME_DERI as RADI_NUME_DERI1";
	break;	
	case "mssql":
		$numero = "convert(varchar(14), a.RADI_NUME_DERI) as RADI_NUME_DERI1";
	break;				   			   
	}
?>
