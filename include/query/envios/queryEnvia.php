<?
/**
* CONSULTA VERIFICACION PREVIA A LA RADICACION
*/
switch($db->driver)
{
	case 'mssql':
	{	$sql = "select ".$db->conn->Concat("RTRIM(SGD_FENV_CODIGO)","' '", "SGD_FENV_DESCRIP").
				",SGD_FENV_CODIGO from SGD_FENV_FRMENVIO WHERE SGD_FENV_ESTADO=1 order by SGD_FENV_CODIGO";
		$RADI_NUME_SALIDA = "convert(varchar(14), a.RADI_NUME_SALIDA)";
		$radi_nume_deri = "convert(varchar(14), b.RADI_NUME_DERI)";
	}break;
	case 'oracle':
	case 'oci8':
	{	$sql = "select concat(concat(SGD_FENV_CODIGO,' '), SGD_FENV_DESCRIP) 
			    ,SGD_FENV_CODIGO from SGD_FENV_FRMENVIO WHERE SGD_FENV_ESTADO=1 order by SGD_FENV_CODIGO";
		$RADI_NUME_SALIDA = "a.RADI_NUME_SALIDA";
		$radi_nume_deri = "b.RADI_NUME_DERI";
	}break;
	default:
	{
		$sql = "select ".$db->conn->Concat("RTRIM(cast(SGD_FENV_CODIGO as varchar))","' '", "SGD_FENV_DESCRIP").
				",SGD_FENV_CODIGO from SGD_FENV_FRMENVIO WHERE SGD_FENV_ESTADO=1 order by SGD_FENV_CODIGO";
		$RADI_NUME_SALIDA = "a.RADI_NUME_SALIDA";
		$radi_nume_deri = "b.RADI_NUME_DERI";
	}break;
}
?>
