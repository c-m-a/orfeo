<?
	/**
	  * CONSULTA TIPO RADICACION
	  */
	switch($db->driver)
	{  
	 case 'mssql':
		$whereTipoRadi = ' and '.$db->conn->substr.'(convert(char(15),b.radi_nume_radi), 14, 1) = ' .$tipoRadicado;
	break;		
	case 'oracle':
	case 'oci8':
	case 'oci805':	
		$whereTipoRadi = ' and '.$db->conn->substr.'(b.radi_nume_radi, 14, 1) = ' .$tipoRadicado;
	break;		
	//Modificacion skina
	default:
		// Modificado Infométrika 28-Agosto-2009
		// Compatibilidad con PostgreSQL 8.3.
		// Se usa expresión regular para verificar que el número de radicado termina en $tipoRadicado.
		//$whereTipoRadi = ' and '.$db->conn->substr.'(b.radi_nume_radi, 14, 1) = ' .$tipoRadicado;
		$whereTipoRadi = ' and CAST( b.radi_nume_radi AS VARCHAR ) ~ \'' .$tipoRadicado.'$\'';
	}
?>