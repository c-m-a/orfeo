<?

switch ($db->driver) 
	{ 
	case "oracle" :
	case 'oci8':
	case 'postgres':
		$numero_salida = "RADI_NUME_SALIDA";
		$numero_sal = "a.RADI_NUME_SAL"; 
	break;	
	case "mssql":
		$numero_salida = "convert(varchar(14), a.RADI_NUME_SALIDA) as RADI_NUME_SALIDA"; 	
		$numero_sal= "convert(varchar(14), a.RADI_NUME_SAL) as RADI_NUME_SAL";
	break;				   			   
	}
?>
