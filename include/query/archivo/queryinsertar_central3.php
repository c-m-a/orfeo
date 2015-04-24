<?
	switch($db->driver)
	{
	case 'mssql':
	case 'oracle':
	case 'oci8':
	case 'postgres':
		$sql="insert into sgd_archivo_central (sgd_archivo_id,sgd_archivo_rad,sgd_archivo_orden,sgd_archivo_fechai,sgd_archivo_fechaf,sgd_archivo_year,
	sgd_archivo_depe,sgd_archivo_demandado,sgd_archivo_demandante,sgd_archivo_cc_demandante,sgd_archivo_srd,sgd_archivo_sbrd,sgd_archivo_tipo,
	sgd_archivo_folios,sgd_archivo_zona,sgd_archivo_carro,sgd_archivo_cara,sgd_archivo_estante,sgd_archivo_entrepano,sgd_archivo_caja,
	sgd_archivo_unidocu,sgd_archivo_inder,sgd_archivo_mata,sgd_archivo_anexo,sgd_archivo_prestamo,sgd_archivo_funprest) values ($sec,'$rad',$orden,'$fechaIni','$fechaInif',$ano,'$depe','$demq','$demtq',$docu,$codiSRD,
	$codiSBRD,$proc,$folios,'$zon',$carro,'$cara',$estante,$entre,$caja,'$unidocu',$inder,$mata,'$anexo',$presta,'$funprest')";
	
	$sqlm="update sgd_archivo_central set sgd_archivo_orden=$orden,sgd_archivo_fechai='$fechaIni',sgd_archivo_fechaf='$fechaInif',sgd_archivo_year=$ano,
	sgd_archivo_depe='$depe',sgd_archivo_demandado='$demq',sgd_archivo_demandante='$demtq',sgd_archivo_cc_demandante=$docu,sgd_archivo_srd=$codiSRD
	,sgd_archivo_sbrd=$codiSBRD,sgd_archivo_tipo=$proc,sgd_archivo_folios=$folios,sgd_archivo_zona='$zon',sgd_archivo_carro=$carro,sgd_archivo_cara='$cara',
	sgd_archivo_estante=$estante,sgd_archivo_entrepano=$entre,sgd_archivo_caja=$caja,sgd_archivo_unidocu='$unidocu',sgd_archivo_inder=$inder,
	sgd_archivo_mata=$mata,sgd_archivo_anexo='$anexo',sgd_archivo_prestamo=$presta,sgd_archivo_funprest='$funprest' where sgd_archivo_rad like '$rad'";
	
	$query="select sgd_archivo_id from sgd_archivo_central where sgd_archivo_demandante like '%$demtq%' and sgd_archivo_demandado like '%$demq%' and sgd_archivo_orden like '$orden' ";
	
	$sqlqm="select * from sgd_archivo_central where sgd_archivo_rad like '$rad'";
	break;
	}
?>