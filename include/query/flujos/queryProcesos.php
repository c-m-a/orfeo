<?
switch ( $db->driver ) { 
	case 'oracle':
	case 'mssql':
		$codDescrip = "p.sgd_pexp_codigo || ' - ' || p.sgd_pexp_descrip";
		$codDescrip = $db->conn->Concat("convert(char(6),'p.sgd_pexp_codigo',0)","'-'","p.sgd_pexp_descrip");
		break;
	case 'oci8':
		
		
		$codDescrip = "p.sgd_pexp_codigo || ' - ' || p.sgd_pexp_descrip";
		$codDescrip = $db->conn->Concat("p.sgd_pexp_codigo","' -- '","p.sgd_pexp_descrip");
		
			break;

	//Modificado IDRD 29-abr-2008
	case 'postgres':
		$codDescrip = "p.sgd_pexp_codigo || ' - ' || p.sgd_pexp_descrip";
		$codDescrip = $db->conn->Concat("p.sgd_pexp_codigo","' -- '","p.sgd_pexp_descrip");
		
			break;
	}


	
	$conversion = 'sgd_pexp_codigo';
	$query="select p.sgd_pexp_codigo,p.sgd_pexp_descrip
	         from sgd_pexp_procexpedientes p
	         order by p.sgd_pexp_codigo
			 ";
		if ( $queryProc == 1) {
					$criterioSelecProc = 'p.sgd_pexp_tieneflujo = 0';
		}else if ( $queryProc == 2 ) {
			$criterioSelecProc = 'p.sgd_pexp_tieneflujo = 1';
		}elseif ( $queryProc == 3 ) {
			$criterioSelecProc = 'p.sgd_pexp_tieneflujo = 1';
		}
			$sql = "select $codDescrip, p.sgd_pexp_codigo 
		         from sgd_pexp_procexpedientes p
		         where $criterioSelecProc
		         order by $codDescrip
				 ";
				
		$sqlSerie = "select SGD_SRD_CODIGO, SGD_SBRD_CODIGO from sgd_pexp_procexpedientes where sgd_pexp_codigo = $procesoSelected";
	

?>
