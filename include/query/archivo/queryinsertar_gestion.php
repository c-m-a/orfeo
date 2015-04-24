<?
$frad=date("Y-m-d h:i:s A");
	switch($db->driver)
	{
	case 'mssql':
	case 'oracle':
	case 'oci8':
		$sql="insert into sgd_archivo_central (sgd_archivo_id,sgd_archivo_rad,sgd_archivo_orden,sgd_archivo_fechai,sgd_archivo_fechaf,sgd_archivo_year,
	sgd_archivo_depe,sgd_archivo_demandado,sgd_archivo_demandante,sgd_archivo_cc_demandante,sgd_archivo_srd,sgd_archivo_sbrd,sgd_archivo_tipo,
	sgd_archivo_folios,sgd_archivo_zona,sgd_archivo_carro,sgd_archivo_cara,sgd_archivo_estante,sgd_archivo_entrepano,sgd_archivo_caja,
	sgd_archivo_unidocu,sgd_archivo_inder,sgd_archivo_mata,sgd_archivo_anexo,sgd_archivo_prestamo,sgd_archivo_funprest,SGD_ARCHIVO_FECHPREST,
	SGD_ARCHIVO_FECHPRESTF,depe_codi,sgd_archivo_usua,sgd_archivo_fech,sgd_archivo_proc,sgd_archivo_fechaa,sgd_archivo_ncarp) values ($sec,'$rad','$orden','$fechaIni','$fechaInif','$ano','$depe','$demq','$demtq','$docu',$codiSRD,
	$codiSBRD,'$proc','$folios','$zon','$carro','$cara','$estante','$entre','$caja','$unidocu','$inder','$mata','$anexo','$presta','$funprest','$fprest','$fechaPrestf','$depeU','$krd',$dat,'$tip','$fechaa','$numCap')";//TO_DATE('$frad','YYYY-MM-DD HH:MI:SS AM'))";
	
	$sqlm="update sgd_archivo_central set sgd_archivo_orden='$orden',sgd_archivo_fechai='$fechaIni',sgd_archivo_fechaf='$fechaInif',sgd_archivo_year='$ano',
	sgd_archivo_depe='$depe',sgd_archivo_demandado='$demq',sgd_archivo_demandante='$demtq',sgd_archivo_cc_demandante='$docu',sgd_archivo_srd=$codiSRD
	,sgd_archivo_sbrd=$codiSBRD,sgd_archivo_tipo='$proc',sgd_archivo_folios='$folios',sgd_archivo_zona='$zon',sgd_archivo_carro='$carro',sgd_archivo_cara='$cara',
	sgd_archivo_estante='$estante',sgd_archivo_entrepano='$entre',sgd_archivo_caja='$caja',sgd_archivo_unidocu='$unidocu',sgd_archivo_inder='$inder',
	sgd_archivo_mata='$mata',sgd_archivo_anexo='$anexo',sgd_archivo_prestamo='$presta',sgd_archivo_funprest='$funprest',SGD_ARCHIVO_FECHPREST='$fprest',
	SGD_ARCHIVO_FECHPRESTF='$fechaPrestf',sgd_archivo_rad='$rad1',sgd_archivo_proc='$tip',sgd_archivo_fechaa='$fechaa',sgd_archivo_ncarp='$numCap'";
	$sqlm.=$qte;
       $sqlm.=" where sgd_archivo_rad like '$rad'";
	
	$query="select sgd_archivo_id from sgd_archivo_central where sgd_archivo_demandante like '%$demtq%' and sgd_archivo_demandado like '%$demq%' and sgd_archivo_orden like '$orden' ";
	
	$sqlqm="select * from sgd_archivo_central where sgd_archivo_rad like '$rad'";
	
	break;
	case 'postgres':
		$sql="insert into sgd_archivo_central (sgd_archivo_id,sgd_archivo_rad,sgd_archivo_orden,sgd_archivo_fechai,sgd_archivo_fechaf,sgd_archivo_year,
	sgd_archivo_depe,sgd_archivo_demandado,sgd_archivo_demandante,sgd_archivo_cc_demandante,sgd_archivo_srd,sgd_archivo_sbrd,sgd_archivo_tipo,
	sgd_archivo_folios,sgd_archivo_zona,sgd_archivo_carro,sgd_archivo_cara,sgd_archivo_estante,sgd_archivo_entrepano,sgd_archivo_caja,
	sgd_archivo_unidocu,sgd_archivo_inder,sgd_archivo_mata,sgd_archivo_anexo,depe_codi,sgd_archivo_usua,sgd_archivo_fech,sgd_archivo_prestamo,sgd_archivo_proc,sgd_archivo_fechaa,sgd_archivo_ncarp";
	if($prest!=0)$sql.=",sgd_archivo_funprest,SGD_ARCHIVO_FECHPREST,SGD_ARCHIVO_FECHPRESTF";
	$sql.=") values ($sec,'$rad','$orden','$fechaIni','$fechaInif','$ano','$depe','$demq','$demtq','$docu',$codiSRD,
	$codiSBRD,'$proc','$folios','$zon','$carro','$cara','$estante','$entre','$caja','$unidocu','$inder','$mata','$anexo','$depeU','$krd',TO_TIMESTAMP('$frad','YYYY-MM-DD HH:MI:SS AM'),'$presta','$tip','$fechaa','$numCap'";
	if($prest!=0)$sql.=",'$funprest','$fprest','$fechaPrestf'";
	$sql.=")";
	
	$sqlm="update sgd_archivo_central set sgd_archivo_orden='$orden',sgd_archivo_fechai='$fechaIni',sgd_archivo_fechaf='$fechaInif',sgd_archivo_year='$ano',
	sgd_archivo_depe='$depe',sgd_archivo_demandado='$demq',sgd_archivo_demandante='$demtq',sgd_archivo_cc_demandante='$docu',sgd_archivo_srd=$codiSRD
	,sgd_archivo_sbrd=$codiSBRD,sgd_archivo_tipo='$proc',sgd_archivo_folios='$folios',sgd_archivo_zona='$zon',sgd_archivo_carro='$carro',sgd_archivo_cara='$cara',
	sgd_archivo_estante='$estante',sgd_archivo_entrepano='$entre',sgd_archivo_caja='$caja',sgd_archivo_unidocu='$unidocu',sgd_archivo_inder='$inder',
	sgd_archivo_mata='$mata',sgd_archivo_anexo='$anexo',sgd_archivo_rad='$rad1',sgd_archivo_proc='$tip',sgd_archivo_fechaa='$fechaa',sgd_archivo_ncarp='$numCap'";
	if($prest!=0)$sqlm.=",sgd_archivo_prestamo='$presta',sgd_archivo_funprest='$funprest',SGD_ARCHIVO_FECHPREST='$fprest',SGD_ARCHIVO_FECHPRESTF='$fechaPrestf'";
	$sqlm.=$qte;
       $sqlm.=" where sgd_archivo_rad like '$rad'";
	
	$query="select sgd_archivo_id from sgd_archivo_central where sgd_archivo_demandante like '%$demtq%' and sgd_archivo_demandado like '%$demq%' and sgd_archivo_orden like '$orden' ";
	
	$sqlqm="select * from sgd_archivo_central where sgd_archivo_rad like '$rad'";
	break;
	}
?>