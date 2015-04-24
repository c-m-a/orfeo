<?
$sqlFecha = $db->conn->SQLDate("Y-M-d h:i A","SGD_ARCHIVO_FECH");
	switch($db->driver)
	{
	case 'mssql':
	case 'oracle':
	case 'oci8':
	case 'postgres':
		$sql="select $sqlFecha AS FECHR,SGD_ARCHIVO_RAD,SGD_ARCHIVO_FOLIOS,SGD_ARCHIVO_CAJA,SGD_ARCHIVO_ESTANTE,SGD_ARCHIVO_ENTREPANO,SGD_ARCHIVO_ZONA,
			SGD_ARCHIVO_ID,SGD_ARCHIVO_DEMANDANTE,SGD_ARCHIVO_DEMANDADO,SGD_ARCHIVO_TIPO,SGD_ARCHIVO_ORDEN,SGD_ARCHIVO_FECHAI,SGD_ARCHIVO_FECHAF,
			SGD_ARCHIVO_CC_DEMANDANTE,SGD_ARCHIVO_CARRO,SGD_ARCHIVO_CARA,SGD_ARCHIVO_UNIDOCU,SGD_ARCHIVO_MATA,SGD_ARCHIVO_ANEXO,
			SGD_ARCHIVO_INDER,SGD_ARCHIVO_PATH,SGD_ARCHIVO_YEAR,SGD_ARCHIVO_SRD,SGD_ARCHIVO_SBRD,SGD_ARCHIVO_PRESTAMO,SGD_ARCHIVO_FUNPREST,
			SGD_ARCHIVO_FECHPREST,SGD_ARCHIVO_DEPE,SGD_ARCHIVO_PATH,SGD_ARCHIVO_FECHPRESTF from SGD_ARCHIVO_CENTRAL where sgd_archivo_rad like '%G' $c $srds $d $sbrds $ef $pross $b $r $a $x $f $zon $g $carro $i $cara $h $estan $v $entre $t $caja $k $orden $l $depe $j $fecha $w $fecha2 $wq $fecha3 $n $deman $m $demant $o $docu $p $inder $q $mata $pt $pst $fea $fta $ti $tic $an $anex and SGD_ARCHIVO_ID !=0 $orde";

	$sqla="select usua_admin_archivo from usuario where usua_login like '$krd'";

 	$sql1="select SGD_EIT_NOMBRE from SGD_EIT_ITEMS where SGD_EIT_COD_PADRE like '$buscar_zona' order by SGD_EIT_NOMBRE";
	$sql6="select SGD_EIT_NOMBRE from SGD_EIT_ITEMS where SGD_EIT_COD_PADRE like '$buscar_ufisica' order by SGD_EIT_NOMBRE";
	$sql7="select SGD_EIT_NOMBRE from SGD_EIT_ITEMS where SGD_EIT_COD_PADRE like '$buscar_estan' order by SGD_EIT_NOMBRE";
	$sql8="select SGD_EIT_NOMBRE from SGD_EIT_ITEMS where SGD_EIT_COD_PADRE like '$buscar_entre' order by SGD_EIT_NOMBRE";
	$sql9="select SGD_EIT_NOMBRE from SGD_EIT_ITEMS where SGD_EIT_COD_PADRE like '$buscar_caja' order by SGD_EIT_NOMBRE";
 	$sql2="select SGD_EIT_SIGLA from SGD_EIT_ITEMS where SGD_EIT_CODIGO like '$caja1'";
 	$sql3="select SGD_EIT_SIGLA from SGD_EIT_ITEMS where SGD_EIT_CODIGO like '$estante1'";
 	$sql4="select SGD_EIT_SIGLA from SGD_EIT_ITEMS where SGD_EIT_CODIGO like '$piso1'";
 	$sql5="select SGD_EIT_SIGLA from SGD_EIT_ITEMS where SGD_EIT_CODIGO like '$archiva1'";
	$sql10="select SGD_EIT_SIGLA from SGD_EIT_ITEMS where SGD_EIT_CODIGO like '$carro1'";
	$sql11="select SGD_EIT_SIGLA from SGD_EIT_ITEMS where SGD_EIT_CODIGO like '$entrepa1'";
	break;
	}
?>