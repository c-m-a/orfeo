<?
switch ( $db->driver ) { 
	case 'oracle':
	case 'mssql':
	case 'oci8':
	//Modificado IDRD 29-abr-2008
	case 'postgres':
	
				$sqlEtapas = "select f.sgd_fexp_codigo, f.sgd_fexp_descrip, f.sgd_fexp_orden, f.sgd_fexp_terminos 
		         from sgd_fexp_flujoexpedientes f
		         where sgd_pexp_codigo = $procesoSelected
		         order by f.sgd_fexp_orden";
				
				$queryVerificaElim = "select count( sgd_fars_codigo ) as CUENTA from sgd_fars_faristas where sgd_fexp_codigoini = $codigoEtapa or sgd_fexp_codigofin = $codigoEtapa";
				
//				$sqlNombreEtapa = "select sgd_fexp_descrip from sgd_fexp_flujoexpedientes where sgd_fexp_codigo = $codigoEtapaArista";
				
	break;
	}

?>
