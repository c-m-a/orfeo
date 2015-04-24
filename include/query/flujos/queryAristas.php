<?
switch ( $db->driver ) { 
	case 'mssql':
		$codDescrip = "f.sgd_fexp_codigo || ' - ' || f.sgd_fexp_descrip";
		$codDescrip = $db->conn->Concat("convert(char(6),'f.sgd_fexp_codigo',0)","'-'","f.sgd_fexp_descrip");
		break;
	case 'oracle':
	case 'oci8':
	//Modificado IDRD 29-abr-2008
	case 'postgres':
		/*$conversion = 'sgd_fars_codigo';
		$query="select f.sgd_fars_codigo,f.sgd_fars_desc
	         from sgd_fars_faristas f
	         order by f.sgd_fars_codigo
			 ";
		if ( $queryProc == 1) {
					$criterioSelecProc = 'p.sgd_pexp_tieneflujo = 0';
		}else if ( $queryProc == 2 ) {
			$criterioSelecProc = 'p.sgd_pexp_tieneflujo = 1';
		}elseif ( $queryProc == 3 ) {
			$criterioSelecProc = 'p.sgd_pexp_tieneflujo = 1';
		}
		*/
		$codDescrip = "f.sgd_fexp_codigo || ' - ' || f.sgd_fexp_descrip";
		$codDescrip = $db->conn->Concat("f.sgd_fexp_codigo","' -- '","f.sgd_fexp_descrip");
	
		/*$sqlListadoAristasSalida = "select * from sgd_fars_faristas where sgd_pexp_codigo = $procesoSelected  ";
		$sqlListadoAristasSalida .= " and sgd_fexp_codigoini = $codigoEtapa order by  sgd_fars_codigo";
		
		$sqlListadoAristasEntrada = "select * from sgd_fars_faristas where sgd_pexp_codigo = $procesoSelected  ";
		$sqlListadoAristasEntrada .= " and sgd_fexp_codigofin = $codigoEtapa order by  sgd_fars_codigo";*/
		
		
	break;
	}
	$sql = "select $codDescrip, f.sgd_fexp_codigo 
         from sgd_fexp_flujoexpedientes f
         where sgd_pexp_codigo = $procesoSelected
         order by $codDescrip
		 ";
		
		$sqlMax = "select f.sgd_fexp_codigo as MAXETAPAS  from sgd_fexp_flujoexpedientes f
         where sgd_pexp_codigo = $procesoSelected  order by $codDescrip ";
		
		$sqlListadoAristas = "select * from sgd_fars_faristas where sgd_pexp_codigo = $procesoSelected  order by  sgd_fars_codigo";
		
?>
