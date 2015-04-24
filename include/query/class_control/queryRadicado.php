<?	
	switch($db->driver)
	{
	case 'mssql':
	$qeryRadicado_codigo= "select convert(char(14), radi_nume_radi) as RADNUM, r.*, $sqlFecha as FECDOC  from radicado r 
       where radi_nume_radi=$codigo";
	break;
	case 'oracle':
	case 'oci8':
	case 'oci805':
	case 'ocipo':
	case 'postgres':
 	$qeryRadicado_codigo= "select radi_nume_radi as RADNUM, r.*, $sqlFecha as fecdoc  from radicado r 
       where radi_nume_radi=$codigo";
	break;
	}
?>
