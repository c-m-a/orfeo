<?
	switch($db->driver)
	{
	case 'mssql':
	case 'oracle':
	case 'oci8':
	case 'postgres':

		$quer="update SGD_EXP_EXPEDIENTE set SGD_EXP_ENTREPA='$entrepano',SGD_EXP_CAJA='$caja',SGD_EXP_EDIFICIO='$exp_edificio' where SGD_EXP_NUMERO LIKE '$expedientes[$t]' and SGD_EXP_ESTADO = '1'";
		$query="update SGD_EXP_EXPEDIENTE set SGD_EXP_ENTREPA='$entrepano',SGD_EXP_CAJA='$caja',SGD_EXP_EDIFICIO='$exp_edificio' where SGD_EXP_NUMERO
	LIKE '$expedientes[$t]' and SGD_EXP_ESTADO like '1' and SGD_EXP_CARPETA >='$unidoc' and SGD_EXP_CARPETA <='$unidoc2'";
		$sqlInv="insert into SGD_EINV_INVENTARIO (SGD_EINV_CODIGO,SGD_DEPE_NOMB,SGD_DEPE_CODI,SGD_EINV_EXPNUM,
	SGD_EINV_TITULO,SGD_EINV_UNIDAD,SGD_EINV_FECH,SGD_EINV_FECHFIN,SGD_EINV_RADICADOS,SGD_EINV_FOLIOS,
	SGD_EINV_NUNDOCU,SGD_EINV_NUNDOCUBODEGA,SGD_EINV_CAJA,SGD_EINV_CAJABODEGA,SGD_EINV_SRD,SGD_EINV_NOMSRD,
	SGD_EINV_SBRD,SGD_EINV_NOMSBRD,SGD_EINV_RETENCION,SGD_EINV_DISFINAL,SGD_EINV_UBICACION,SGD_EINV_OBSERVACION)
	VALUES ('$sec','$depe_nom','$depe','$expediente','$Titulo','$Unidad','$Fini','$Ffin',
	'$radicado','$Folio','$nundocus',0,'$Caja',0,'$srd','$srd_desc',
	'$sbrd','$sbrd_desc','$rete','$disfinal','$ubicacion','$observa')";
	
	$sqpl="select count(sgd_eit_codigo) as COU from sgd_eit_items where sgd_eit_nombre like 'CAJA%'";
	$sqpl2="select count(sgd_eit_codigo) as COU from sgd_eit_items where sgd_eit_nombre like 'ENTREPANO%'";
	$sqpl3="select count(sgd_eit_codigo) as COU from sgd_eit_items where sgd_eit_nombre like 'ESTANTE%'";

		$sql13="select RADI_NUME_HOJA from radicado where radi_nume_radi = '$radicado'";
		$isqlus = "SELECT u.USUA_NOMB,u.USUA_CODI,u.USUA_ESTA FROM USUARIO u
					   WHERE $whereUsua $whereUsSelect $whereDependencia
					   ORDER BY u.USUA_NOMB";
		$sql1="select SGD_EIT_NOMBRE from SGD_EIT_ITEMS where SGD_EIT_COD_PADRE='$exp_piso' ORDER BY SGD_EIT_NOMBRE";
		$sql2="select SGD_EIT_NOMBRE from SGD_EIT_ITEMS where SGD_EIT_COD_PADRE='$exp_edificio' ORDER BY SGD_EIT_NOMBRE";
		$sql3="select SGD_EIT_NOMBRE,SGD_EIT_CODIGO from SGD_EIT_ITEMS WHERE SGD_EIT_COD_PADRE ='$exp_edificio'";
		$sql4="select SGD_EIT_NOMBRE,SGD_EIT_CODIGO from SGD_EIT_ITEMS WHERE SGD_EIT_COD_PADRE ='$exp_piso'";
		$sql17="select SGD_EIT_NOMBRE,SGD_EIT_CODIGO from SGD_EIT_ITEMS WHERE SGD_EIT_COD_PADRE ='$exp_item11'";
		$sql18="select SGD_EIT_NOMBRE,SGD_EIT_CODIGO from SGD_EIT_ITEMS WHERE SGD_EIT_COD_PADRE ='$entre'";
		$sql19="select SGD_EIT_NOMBRE,SGD_EIT_CODIGO from SGD_EIT_ITEMS WHERE SGD_EIT_COD_PADRE ='$estan'";
		$sql20="select SGD_EIT_NOMBRE,SGD_EIT_CODIGO from SGD_EIT_ITEMS WHERE SGD_EIT_COD_PADRE ='$item'";
		$sql23="select SGD_EIT_NOMBRE,SGD_EIT_CODIGO from SGD_EIT_ITEMS WHERE SGD_EIT_COD_PADRE ='$item2'";
		$sql5="select DEPE_NOMB FROM DEPENDENCIA WHERE DEPE_CODI=$depe";
		$sqld="select * from sgd_exp_expediente WHERE SGD_EXP_NUMERO like '$expe%' and sgd_exp_estado='1' and SGD_EXP_RETE='1' and SGD_EXP_FECHFIN>='$fechaInii' and SGD_EXP_FECHFIN<='$fechaInif'";
		$sqlr="select SGD_SRD_CODIGO,SGD_SBRD_CODIGO FROM SGD_SEXP_SECEXPEDIENTES WHERE SGD_EXP_NUMERO like '$expediente'";
		$sqlsr="select sgd_srd_descrip from sgd_srd_seriesrd where sgd_srd_codigo=$srd";
		$sqltsb="select sgd_sbrd_descrip,sgd_sbrd_tiemag,sgd_sbrd_dispfin from sgd_sbrd_subserierd where sgd_sbrd_codigo=$sbrd and sgd_srd_codigo=$srd";
		$sql7="select SGD_EIT_NOMBRE,SGD_EIT_CODIGO from SGD_EIT_ITEMS where SGD_EIT_COD_PADRE=0 order by SGD_EIT_SIGLA";
		$sql8="select SGD_EIT_NOMBRE from SGD_EIT_ITEMS where SGD_EIT_COD_PADRE='$exp_item11' ORDER BY SGD_EIT_NOMBRE";
		$sql16="select SGD_EIT_NOMBRE from SGD_EIT_ITEMS where SGD_EIT_COD_PADRE='$entre' ORDER BY SGD_EIT_NOMBRE";
		$sql9="select SGD_EIT_EDIFICIO,SGD_EIT_CODIGO from SGD_EIT_ITEMS where SGD_EIT_MUNI like '$codMuni2'
				and SGD_EIT_DPTO like '$codDpto2' order by SGD_EIT_EDIFICIO";
		$sql0="select SGD_EIT_NOMBRE from SGD_EIT_ITEMS where SGD_EIT_COD_PADRE='$exp_edificio' ORDER BY SGD_EIT_NOMBRE";
		$sql10="select SGD_EIT_NOMBRE from SGD_EIT_ITEMS where SGD_EIT_COD_PADRE='$estan' ORDER BY SGD_EIT_NOMBRE";
		$sql21="select SGD_EIT_NOMBRE from SGD_EIT_ITEMS where SGD_EIT_COD_PADRE='$item' ORDER BY SGD_EIT_NOMBRE";
		$sql22="select SGD_EIT_NOMBRE from SGD_EIT_ITEMS where SGD_EIT_COD_PADRE='$item2' ORDER BY SGD_EIT_NOMBRE";
		$sql11="select SGD_EIT_NOMBRE from SGD_EIT_ITEMS where SGD_EIT_COD_PADRE='$exp_item11' ORDER BY SGD_EIT_NOMBRE";
		$sql12="select SGD_PAR_ITEMSN from SGD_PAR_PARAM where SGD_PAR_ITEMSO like 'CAJA'";
		$queryDpto = "select distinct(d.DPTO_NOMB),d.DPTO_CODI FROM DEPARTAMENTO d, SGD_EIT_ITEMS i WHERE d.DPTO_CODI=i.CODI_DPTO ORDER BY DPTO_NOMB";
		$queryMuni = "select distinct(m.MUNI_NOMB),m.MUNI_CODI FROM MUNICIPIO m , SGD_EIT_ITEMS i WHERE m.MUNI_CODI=i.CODI_MUNI and DPTO_CODI='$codDpto' ORDER BY MUNI_NOMB";
		$queryMuni2 = "select distinct(MUNI_NOMB),MUNI_CODI FROM MUNICIPIO WHERE DPTO_CODI='$codDpto2' ORDER BY MUNI_NOMB";
		$sqli="select sgd_eit_nombre,sgd_eit_codigo from sgd_eit_items where sgd_eit_cod_padre = '$exp_edificio' order by sgd_eit_codigo";
		$sqlie="select sgd_eit_nombre,sgd_eit_codigo from sgd_eit_items where sgd_eit_cod_padre = '$pisocod'";
		$sqliD="select sgd_eit_nombre,sgd_eit_codigo from sgd_eit_items where sgd_eit_cod_padre = '$item1_cod' order by sgd_eit_codigo";
		$sqliR="select sgd_eit_nombre,sgd_eit_codigo from sgd_eit_items where sgd_eit_cod_padre = '$item2_cod' order by sgd_eit_codigo";
		$sqliQ="select sgd_eit_nombre,sgd_eit_codigo from sgd_eit_items where sgd_eit_cod_padre = '$item3_cod' order by sgd_eit_codigo";
		$sqliT="select sgd_eit_nombre,sgd_eit_codigo from sgd_eit_items where sgd_eit_cod_padre = '$item4_cod' order by sgd_eit_codigo";
		$sqliw="select count(sgd_eit_nombre) AS CO from sgd_eit_items where sgd_eit_cod_padre = '$item1_cod'";
		$sqli1="select count(sgd_eit_nombre) AS CO from sgd_eit_items where sgd_eit_cod_padre = '$item2_cod'";
		$sqli2="select count(sgd_eit_nombre) AS CO from sgd_eit_items where sgd_eit_cod_padre = '$item3_cod'";
		$sqli3="select count(sgd_eit_nombre) AS CO from sgd_eit_items where sgd_eit_cod_padre = '$item4_cod'";
		$sqli4="select count(sgd_eit_nombre) AS CO from sgd_eit_items where sgd_eit_cod_padre = '$pisocod'";
		$sqlConcat = $db->conn->Concat("s.sgd_srd_codigo","'-'","s.sgd_srd_descrip");
		$sqlConcat2 = $db->conn->Concat("su.sgd_sbrd_codigo","'-'","su.sgd_sbrd_descrip");
		$querySub = "select distinct ($sqlConcat2) as detalle, su.sgd_sbrd_codigo from sgd_mrd_matrird m,
 	sgd_sbrd_subserierd su where m.sgd_srd_codigo = '$codserie' and su.sgd_srd_codigo = '$codserie'
			and su.sgd_sbrd_codigo = m.sgd_sbrd_codigo and ".$sqlFechaHoy." between su.sgd_sbrd_fechini
			and su.sgd_sbrd_fechfin order by detalle ";
		$querySerie = "select distinct ($sqlConcat) as detalle, s.sgd_srd_codigo from sgd_mrd_matrird m,
 	sgd_srd_seriesrd s where s.sgd_srd_codigo = m.sgd_srd_codigo and ".$sqlFechaHoy." between s.sgd_srd_fechini
 	and s.sgd_srd_fechfin order by detalle ";
		$sqle="select sgd_exp_numero from sgd_exp_expediente where sgd_exp_numero like '$expe%'
		 order by sgd_exp_caja";
		$sqlc="select count(distinct(sgd_exp_caja)) as CAJA from sgd_exp_expediente where sgd_exp_numero like '$expe%' order by CAJA";
		$bexp="select max(sgd_exp_numero) as EXPE from sgd_exp_expediente where sgd_exp_numero like '$expe%' and sgd_exp_rete=1 and SGD_EXP_FECHFIN>='$fechaInii' and SGD_EXP_FECHFIN<='$fechaInif'";
		$sqlex="select max(cast(sgd_exp_carpeta as int)) AS CARP from sgd_exp_expediente where sgd_exp_numero like '$expde'";
		$sqlex2="select sgd_exp_entrepa,sgd_exp_caja,sgd_exp_edificio from sgd_exp_expediente where sgd_exp_numero like '$expde'";
		$queryed = "select CODI_DPTO,CODI_MUNI from SGD_EIT_ITEMS where SGD_EIT_CODIGO = '$exp_edificio'";
		$quernom="select SGD_EIT_SIGLA from SGD_EIT_ITEMS where SGD_EIT_CODIGO = '$tem'";
		/*$sqlo2="select count(distinct(sgd_exp_caja)) as ITS from sgd_exp_expediente where sgd_exp_numero like '$exp%' and sgd_exp_isla like '$pisocod' and sgd_exp_estado=1 and depe_codi != 1 and depe_codi != 905 and depe_codi != 900 and depe_codi != 999";
		$sqlo3="select count(distinct(sgd_exp_entrepa)) as ITS from sgd_exp_expediente where sgd_exp_numero like '$exp%' and sgd_exp_isla like '$pisocod' and sgd_exp_estado=1 and depe_codi != 1 and depe_codi != 905 and depe_codi != 900 and depe_codi != 999";
		$sqlo31="select count(distinct(sgd_exp_entrepa)) as  ITE from sgd_exp_expediente where sgd_exp_numero like '$exp%' and sgd_exp_isla like '$pisocod' and sgd_exp_estado=1 and depe_codi != 1 and depe_codi != 905 and depe_codi != 900 and depe_codi != 999";
		$sqlo41="select count(distinct(sgd_eit_codigo)) as  ITE from sgd_eit_items where sgd_eit_cod_padre like '(select distinct(sgd_exp_entrepa) from sgd_exp_expediente where sgd_exp_numero like '$exp%' and sgd_exp_isla like '$pisocod' and sgd_exp_estado=1 )'";//and depe_codi != 1 and depe_codi != 905 and depe_codi != 900 and depe_codi != 999";
		$sqlo4="select count(distinct(sgd_exp_estante)) as ITE from sgd_exp_expediente where sgd_exp_numero like '$exp%' and sgd_exp_isla like '$pisocod' and sgd_exp_estado=1 and depe_codi != 1 and depe_codi != 905 and depe_codi != 900 and depe_codi != 999";*/
		$sqlo2="SELECT SGD_EIT_CODIGO AS CODIGO, SGD_EIT_NOMBRE AS NOMBRE
		  FROM SGD_EIT_ITEMS, SGD_EXP_EXPEDIENTE where
		  SGD_EXP_EDIFICIO like '".$exp_edificio."'
		  and SGD_EXP_ESTADO = 1 
		  AND ( SGD_EIT_CODIGO = to_number(SGD_EXP_CAJA,'99999999')
		  OR SGD_EIT_CODIGO = SGD_EXP_ENTREPA )
		  OR ( SGD_EIT_CODIGO = to_number(SGD_EXP_CAJA,'999999999')
		  AND SGD_EIT_CODIGO = SGD_EXP_ENTREPA ) " ;
		$sqlo3="select distinct(sgd_exp_entrepa) from sgd_exp_expediente where sgd_exp_numero like '$exp%' and sgd_exp_estado=1";
		$sqlo31="select count(distinct(sgd_exp_entrepa)) as  ITE from sgd_exp_expediente where sgd_exp_numero like '$exp%' and sgd_exp_isla like '$pisocod' and sgd_exp_estado=1 and depe_codi != 1 and depe_codi != 905 and depe_codi != 900 and depe_codi != 999";
		$sqlo41="select count(distinct(sgd_eit_codigo)) as  ITE from sgd_eit_items where sgd_eit_cod_padre like '(select distinct(sgd_exp_entrepa) from sgd_exp_expediente where sgd_exp_numero like '$exp%' and sgd_exp_isla like '$pisocod' and sgd_exp_estado=1 )'";//and depe_codi != 1 and depe_codi != 905 and depe_codi != 900 and depe_codi != 999";
		$sqlo4="select count(distinct(sgd_exp_estante)) as ITE from sgd_exp_expediente where sgd_exp_numero like '$exp%' and sgd_exp_isla like '$pisocod' and sgd_exp_estado=1 and depe_codi != 1 and depe_codi != 905 and depe_codi != 900 and depe_codi != 999";
		$sqlo5="select sgd_eit_nombre from sgd_eit_items where sgd_eit_codigo='$gpr'";
		break;
	}
?>