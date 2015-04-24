<?

	switch($db->driver)
	{
	case 'mssql':
	
	break;
	case 'oracle':
	case 'oci8':
	case 'oci805':
	case 'ocipo':
	 	$tamano = " to_number($tamano) ";
	break;
	 //Modificado skina sep-2007
        default:
                $tamano =  $tamano;

	}

?>
