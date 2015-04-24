<?

$idToChar =  $db->conn->numToString("fr.SGD_FIRRAD_ID"); 

switch ($db->driver) { 
	case 'oci8':
	case 'oracle':
	
		$query= ' 
				 select  1 as "HID_1",
				 to_char(r.RADI_NUME_RADI) as "IDT_Numero Radicado",
				 r.RADI_PATH as "HID_RADI_PATH",
				 uf.USUA_NOMB as "Fimante",
				  us.USUA_NOMB as "Solicitado Por",
				  fr.SGD_FIRRAD_FECHSOLIC as "Desde", 
				   to_char (r.RADI_NUME_RADI) AS "CHK_SOL_FIRMA"  
		         from usuario uf, usuario us,SGD_FIRRAD_FIRMARADS fr, radicado r
		         where  
		         fr.USUA_DOC = uf.USUA_DOC and
		         fr.SGD_FIRRAD_DOCSOLIC = us.USUA_DOC and
		         r.RADI_NUME_RADI = fr.RADI_NUME_RADI  
		         and fr.USUA_DOC = '."'$usua_doc'  
				 and SGD_FIRRAD_FIRMA is null 
		         ".
		         $whereFiltro;
	break;
	case 'mssql': 
		$query= ' 
				 select  1 as "HID_1",
				  uf.USUA_NOMB as "Fimante",
				  us.USUA_NOMB as "Solicitado Por",
				  fr.SGD_FIRRAD_FECHSOLIC as "Desde", 
				  convert(char(14),fr.SGD_FIRRAD_ID) AS "CHK_SOL_FIRMA"  
		         from usuario uf, usuario us,SGD_FIRRAD_FIRMARADS fr
		         where  
		         fr.USUA_DOC = uf.USUA_DOC and
		         fr.SGD_FIRRAD_DOCSOLIC = us.USUA_DOC '.
		         $filtroSelect;
		break;
	}
	
?>
