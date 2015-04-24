<?
	switch($db->driver)
	{
	case 'mssql':
	case 'oracle':
	case 'oci8':
	case 'postgres':
		$query="select e.SGD_EXP_NUMERO, e.RADI_NUME_RADI, e.SGD_EXP_FECHFIN, e.SGD_EXP_ARCHIVO, s.SGD_SRD_CODIGO,
	s.SGD_SBRD_CODIGO, e.SGD_EXP_RETE from SGD_EXP_EXPEDIENTE e,
	SGD_SEXP_SECEXPEDIENTES s where s.SGD_EXP_NUMERO=e.SGD_EXP_NUMERO and e.SGD_EXP_FECHFIN <='$exp_fechaFin'
	and e.SGD_EXP_FECHFIN >='$exp_fechaIni' and e.SGD_EXP_NUMERO LIKE '%$expe%'";

		$query3="SELECT RADI_PATH FROM RADICADO WHERE RADI_NUME_RADI LIKE '$rad'";

		$quer="update sgd_exp_expediente set sgd_exp_rete='2' where sgd_exp_numero like '$exp'";
		$quer2="update sgd_exp_expediente set sgd_exp_rete='3' where sgd_exp_numero like '$exp'";
		$sqlConcat = $db->conn->Concat("s.sgd_srd_codigo","'-'","s.sgd_srd_descrip");
		$sqlConcat2 = $db->conn->Concat("su.sgd_sbrd_codigo","'-'","su.sgd_sbrd_descrip");
		$querySub = "select distinct ($sqlConcat2) as detalle, su.sgd_sbrd_codigo from sgd_mrd_matrird m,
 	sgd_sbrd_subserierd su where m.sgd_srd_codigo = '$codserie' and su.sgd_srd_codigo = '$codserie'
			and su.sgd_sbrd_codigo = m.sgd_sbrd_codigo and ".$sqlFechaHoy." between su.sgd_sbrd_fechini
			and su.sgd_sbrd_fechfin order by detalle ";
		$querySerie = "select distinct ($sqlConcat) as detalle, s.sgd_srd_codigo from sgd_mrd_matrird m,
 	sgd_srd_seriesrd s where s.sgd_srd_codigo = m.sgd_srd_codigo and ".$sqlFechaHoy." between s.sgd_srd_fechini
 	and s.sgd_srd_fechfin order by detalle ";
	break;
	}
?>