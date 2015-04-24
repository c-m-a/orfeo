<?

$idToChar =  $db->conn->numToString("fr.SGD_FIRRAD_ID"); 

switch ($db->driver) { 
	case 'oci8':
	case 'oracle':
	
		$query= ' 
				 select  1 as "HID_1",
				  uf.USUA_NOMB as "Fimante",
				  us.USUA_NOMB as "Solicitado Por",
				  fr.SGD_FIRRAD_FECHSOLIC as "Desde", 
				  fr.SGD_FIRRAD_FECHA   as "Firmado", 
				   to_char (fr.SGD_FIRRAD_ID) AS "CHK_SOL_FIRMA"  
		         from usuario uf, usuario us,SGD_FIRRAD_FIRMARADS fr
		         where  
		         fr.USUA_DOC = uf.USUA_DOC and
		         fr.SGD_FIRRAD_DOCSOLIC = us.USUA_DOC '.
		         $filtroSelect;
	break;
	case 'mssql': 
		$query= ' 
				 select  1 as "HID_1",
				  uf.USUA_NOMB as "Fimante",
				  us.USUA_NOMB as "Solicitado Por",
				  fr.SGD_FIRRAD_FECHSOLIC as "Desde", 
				  fr.SGD_FIRRAD_FECHA   as "Firmado", 
				  convert(char(14),fr.SGD_FIRRAD_ID) AS "CHK_SOL_FIRMA"  
		         from usuario uf, usuario us,SGD_FIRRAD_FIRMARADS fr
		         where  
		         fr.USUA_DOC = uf.USUA_DOC and
		         fr.SGD_FIRRAD_DOCSOLIC = us.USUA_DOC '.
		         $filtroSelect;
		break;
	}
	
?>
