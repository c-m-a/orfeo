<?php
/**
  * Consulta para paEncabeza.php
  */
switch($db->driver)
{
	case 'mssql':
		$conversion = "CONVERT (CHAR(5), depe_codi)"; 		
		break;
	default:
		$conversion = "depe_codi";
		break;

	 case 'postgres':
                //$conversion = "CONVERT (CHAR(5), depe_codi)";
                $conversion = "CAST(depe_codi as varchar(5))";
                break;
        default:
                $conversion = "depe_codi";
                break;

}
?>
