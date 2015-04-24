<?

if(!$edifi) $edifi=0;
if(!$estan) $estan=0;
if(!$entre) $entre=0;
if(!$carro) $carro=0;
if(!$zona) $zona=0;
if(!$caja) $caja=0;
if(!$piso) $piso=0;
	switch($db->driver)
	{
	case 'mssql':
		$redondeo = $db->conn->round(((radi_fech_radi+(b.sgd_tpr_termino * 7/5))-$sqlFechaHoy));
		$isql = "select d.sgd_exp_numero as sgd_exp_numero ,
	   				d.sgd_exp_estado,
	   				a.radi_path,
	   				convert(varchar(15),d.RADI_NUME_RADI) as RADI_NUME_RADI,
	   				a.RADI_NUME_HOJA,
	   				a.RADI_FECH_RADI,
	   				convert(varchar(15),a.RADI_NUME_RADI) as RADI_NUME_RADI,
	   				a.RA_ASUN  ,
	   				a.RADI_PATH ,
	   				a.RADI_USUA_ACTU ,".
					$sqlfecha." AS FECHA ,
					b.sgd_tpr_descrip,
					b.sgd_tpr_codigo,
					b.sgd_tpr_termino,
					$redondeo AS diasr,	
					RADI_LEIDO,RADI_TIPO_DERI,RADI_NUME_DERI,a.radi_depe_actu,
					e.depe_nomb,
					f.usua_nomb,
					d.sgd_exp_fech_arch,
					d.sgd_exp_fech
			   from radicado a,sgd_tpr_tpdcumento b,SGD_EXP_EXPEDIENTE d, DEPENDENCIA e,USUARIO f
			   where 
			    f.usua_codi=a.radi_usua_actu and f.depe_codi=a.radi_depe_actu
				and e.depe_codi=a.radi_depe_actu 
				and a.tdoc_codi=b.sgd_tpr_codigo
				AND a.radi_nume_radi=d.radi_nume_radi
				$dependencia_busq1
				order by $order	";
		$isqlCount = "select count(1) REGS
				from radicado a,sgd_tpr_tpdcumento b,SGD_EXP_EXPEDIENTE d, DEPENDENCIA e,USUARIO f
				where 
				f.usua_codi=a.radi_usua_actu and f.depe_codi=a.radi_depe_actu
			and e.depe_codi=a.radi_depe_actu 
			and a.tdoc_codi=b.sgd_tpr_codigo
			AND a.radi_nume_radi=d.radi_nume_radi
			$dependencia_busq1
			";
			if($estado==2)$isqlCount.=" and d.SGD_EXP_FECH_ARCH !='' ";

		$sqlr="select m.sgd_tpr_descrip from sgd_tpr_tpdcumento m,radicado r where
	cast(r.radi_nume_radi as varchar(22)) like '$data' and m.sgd_tpr_codigo=r.tdoc_codi";
		$sqle="select SGD_EXP_CAJA,SGD_EXP_ESTANTE,RADI_USUA_ARCH,SGD_EXP_ISLA from
		SGD_EXP_EXPEDIENTE where SGD_EXP_NUMERO like '$num_expediente' order by '$order2'";
		
if(!$edifi) $edifi=0;
if(!$estan) $estan=0;
if(!$entre) $entre=0;
if(!$carro) $carro=0;
if(!$zona) $zona=0;
if(!$caja) $caja=0;
if(!$piso) $piso=0;
		 $tm="select sgd_eit_sigla from sgd_eit_items where sgd_eit_codigo=$edifi";
		 $tm1="select sgd_eit_sigla from sgd_eit_items where sgd_eit_codigo=$estan";
		 $tm2="select sgd_eit_sigla from sgd_eit_items where sgd_eit_codigo=$entre";
		 $tm3="select sgd_eit_sigla from sgd_eit_items where sgd_eit_codigo=$carro";
		 $tm4="select sgd_eit_sigla from sgd_eit_items where sgd_eit_codigo=$zona";
		 $tm5="select sgd_eit_sigla from sgd_eit_items where sgd_eit_codigo=$caja";
		 $tm6="select sgd_eit_sigla from sgd_eit_items where sgd_eit_codigo=$piso";
	break;
	case 'oracle':
	case 'oci8':
$isql = "select d.sgd_exp_numero,
				d.sgd_exp_estado,
				a.radi_path,
				d.RADI_NUME_RADI ,
				a.RADI_NUME_HOJA,
				a.RADI_FECH_RADI,
				a.RADI_NUME_RADI,
				a.RA_ASUN  ,
				a.RADI_PATH ,
				a.RADI_USUA_ACTU ,".
				$sqlfecha." AS FECHA ,
				b.sgd_tpr_descrip,
				b.sgd_tpr_codigo,
				b.sgd_tpr_termino,
				RADI_LEIDO,RADI_TIPO_DERI,RADI_NUME_DERI,a.radi_depe_actu,
				e.depe_nomb,
				f.usua_nomb,
				d.sgd_exp_fech_arch,
				d.sgd_exp_fech
				,d.SGD_EXP_ASUNTO
				from radicado a,sgd_tpr_tpdcumento b,SGD_EXP_EXPEDIENTE d, DEPENDENCIA e,USUARIO f
				where 
				f.usua_codi=a.radi_usua_actu and f.depe_codi=a.radi_depe_actu
			and e.depe_codi=a.radi_depe_actu 
			and a.tdoc_codi=b.sgd_tpr_codigo
			AND a.radi_nume_radi=d.radi_nume_radi
			$dependencia_busq1
			order by $order	";
		$isqlCount = "select count(1) CONTADOR
			from radicado a,SGD_EXP_EXPEDIENTE d, DEPENDENCIA e
			where 
			e.depe_codi=a.radi_depe_actu 
			AND a.radi_nume_radi=d.radi_nume_radi
			$dependencia_busq1
			";
			
			if($estado==2)$isqlCount.=" and d.SGD_EXP_FECH_ARCH !='' ";

		$sqlr="select m.sgd_tpr_descrip from sgd_tpr_tpdcumento m,radicado r where
	r.radi_nume_radi like '$data' and m.sgd_tpr_codigo=r.tdoc_codi";
		$sqle="select SGD_EXP_CAJA,SGD_EXP_ESTANTE,RADI_USUA_ARCH,SGD_EXP_UFISICA,SGD_EXP_ISLA from SGD_EXP_EXPEDIENTE where SGD_EXP_NUMERO like '$num_expediente' and sgd_exp_estado=1";
		$tm="select sgd_eit_sigla from sgd_eit_items where sgd_eit_codigo=$edifi";
		$tm1="select sgd_eit_sigla from sgd_eit_items where sgd_eit_codigo=$estan";
		$tm2="select sgd_eit_sigla from sgd_eit_items where sgd_eit_codigo=$entre";
		$tm3="select sgd_eit_sigla from sgd_eit_items where sgd_eit_codigo=$carro";
		$tm4="select sgd_eit_sigla from sgd_eit_items where sgd_eit_codigo=$zona";
		$tm5="select sgd_eit_sigla from sgd_eit_items where sgd_eit_codigo=$caja";
		$tm6="select sgd_eit_sigla from sgd_eit_items where sgd_eit_codigo=$piso";
break;
	case 'postgres':
		$isql = "select d.sgd_exp_numero,
				d.sgd_exp_estado,
				a.radi_path,
				d.RADI_NUME_RADI ,
				a.RADI_NUME_HOJA,
				a.RADI_FECH_RADI,
				a.RADI_NUME_RADI,
				a.RA_ASUN  ,
				a.RADI_PATH ,
				a.RADI_USUA_ACTU ,".
				$sqlfecha." AS FECHA ,
				b.sgd_tpr_descrip,
				b.sgd_tpr_codigo,
				b.sgd_tpr_termino,
				RADI_LEIDO,RADI_TIPO_DERI,RADI_NUME_DERI,a.radi_depe_actu,
				e.depe_nomb,
				f.usua_nomb,
				d.sgd_exp_fech_arch,
				d.sgd_exp_fech
				,d.SGD_EXP_ASUNTO
				from radicado a,sgd_tpr_tpdcumento b,SGD_EXP_EXPEDIENTE d, DEPENDENCIA e,USUARIO f
				where 
				f.usua_codi=a.radi_usua_actu and f.depe_codi=a.radi_depe_actu
			and e.depe_codi=a.radi_depe_actu 
			and a.tdoc_codi=b.sgd_tpr_codigo
			AND a.radi_nume_radi=d.radi_nume_radi
			$dependencia_busq1
			order by $order	";
		$isqlCount = "select count(1) CONTADOR
			from radicado a,SGD_EXP_EXPEDIENTE d, DEPENDENCIA e
			where 
			e.depe_codi=a.radi_depe_actu 
			AND a.radi_nume_radi=d.radi_nume_radi
			$dependencia_busq1
			";
			
			if($estado==2)$isqlCount.=" and d.SGD_EXP_FECH_ARCH !='' ";

		$sqlr="select m.sgd_tpr_descrip from sgd_tpr_tpdcumento m,radicado r where
	cast(r.radi_nume_radi as varchar(22)) like '$data' and m.sgd_tpr_codigo=r.tdoc_codi";
		$sqle="select SGD_EXP_CAJA,SGD_EXP_ESTANTE,RADI_USUA_ARCH,SGD_EXP_ENTREPA,SGD_EXP_UFISICA,SGD_EXP_ISLA from SGD_EXP_EXPEDIENTE where SGD_EXP_NUMERO like '$num_expediente' and sgd_exp_estado=1";
		$tm="select sgd_eit_sigla from sgd_eit_items where sgd_eit_codigo=$edifi";
		$tm1="select sgd_eit_sigla from sgd_eit_items where sgd_eit_codigo=$estan";
		$tm2="select sgd_eit_sigla from sgd_eit_items where sgd_eit_codigo=$entre";
		$tm3="select sgd_eit_sigla from sgd_eit_items where sgd_eit_codigo=$carro";
		$tm4="select sgd_eit_sigla from sgd_eit_items where sgd_eit_codigo=$zona";
		$tm5="select sgd_eit_sigla from sgd_eit_items where sgd_eit_codigo=$caja";
		$tm6="select sgd_eit_sigla from sgd_eit_items where sgd_eit_codigo=$piso";
	//$db->conn->debug = true;
	break;
	}
?>
