<?
switch ( $db->driver ) { 
	case 'oracle':
	case 'mssql':
	case 'oci8':
	//Modificado IDRD 29-abr-2008
	case 'postgres':
	
		
				$sql = "select t.sgd_trad_descr, t.sgd_trad_codigo 
		         from sgd_trad_tiporad t
		         order by  t.sgd_trad_codigo
				 ";
	break;
	}

?>
