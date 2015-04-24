<?PHP 
if (!$db->driver){	$db = $this->db; } //Esto sirve para cuando se llama este archivo dentro de clases donde no se conoce $db.
$systemDate = $db->conn->sysTimeStamp;
$tmp_substr = $db->conn->substr;
switch($db->driver) {	
 case 'mssql':
	// Ejecuta la consulta por defecto si no es DNP
	$radi_nume_radi		= " convert(varchar(14), r.radi_nume_radi) ";
	$radi_nume_deri		= " convert(varchar(14), r.radi_nume_deri) ";
	$usua_doc_c			  = " convert(varchar(8), c.USUA_DOC) ";
	$radi_nume_salida	= " convert(varchar(14), RADI_NUME_SALIDA) ";
	$radi_nume_sal		= " convert(varchar(14), RADI_NUME_SAL) ";
	$anex_radi_nume   = " convert(varchar(14), r.anex_radi_nume) ";
	$redondeo         = $db->conn->round("(r.radi_fech_radi+(td.sgd_tpr_termino * 7/5))".
                                        '-'.$systemDate.')+(select count(*) from sgd_noh_nohabiles where NOH_FECHA between r.radi_fech_radi and '.
                                        $db->conn->sysTimeStamp.")");
			$redondeo2 = $db->conn->round("(agen.SGD_AGEN_FECHPLAZO)-$systemDate");
			$diasf              = " convert(int,".$systemDate."-r.sgd_fech_impres)";
		break;
		case 'oracle':
		case 'oci8':
		case 'oci805':
		case 'ocipo':
		{	$radi_nume_radi = " r.RADI_NUME_RADI ";
			$usua_doc_c			= " convert(varchar(8), c.USUA_DOC) ";
			$radi_nume_salida = " RADI_NUME_SALIDA ";
			$radi_nume_sal = " RADI_NUME_SAL ";
			$redondeo = "round(((r.RADI_FECH_RADI+(td.SGD_TPR_TERMINO * 7/5))-".$systemDate."))+(select count(*) from sgd_noh_nohabiles where NOH_FECHA between r.radi_fech_radi and ".$db->conn->sysTimeStamp.")";
		}break;
	case 'postgres':
	case 'postgres7':
	{	
		$radi_nume_radi		= "cast(r.radi_nume_radi as varchar(15)) ";
		$usua_doc_c		= "cast(c.USUA_DOC as varchar(8)) ";
		$radi_nume_salida	= "cast(RADI_NUME_SALIDA as varchar(15)) ";
		$radi_nume_sal		= "cast(RADI_NUME_SAL as varchar(15)) ";
		$resta=" (r.RADI_FECH_RADI - ".$systemDate.") ";
		$cast = " cast(".$resta." as number(10)) ";
		$redondeo="date_part('days', r.radi_fech_radi-".$db->conn->sysTimeStamp.")+floor(td.sgd_tpr_termino * 7/5)+(select count(*) from sgd_noh_nohabiles where NOH_FECHA between r.radi_fech_radi and ".$db->conn->sysTimeStamp.")";
	}break;
 default:
		{
			$radi_nume_radi = " r.radi_nume_radi ";
			$usua_doc_c = " c.USUA_DOC ";
			$radi_nume_salida = " RADI_NUME_SALIDA ";
			$radi_nume_sal = " RADI_NUME_SAL ";
		}break;
}
?>
