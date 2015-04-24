<?
	$ruta_raiz = "..";
	include_once "../include/db/ConnectionHandler.php";
	$db = new ConnectionHandler($ruta_raiz);	 
	$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
error_reporting(0);
//-------------------------------
// FUNCION PARA CALCULAR LA FECHA DE VENCIMIENTO
//-------------------------------  
CLASS FechaHabil
{
var $db;
function FechaHabil($db)
{
	$this->db = $db;
}
function diasHabiles($fechaIni,$fechaFin)
{	
	$cDiasAdicionL = 0;
	$termino = $fldTERMINO;
	$fechVenc = $fldF1;
	$cDiasCalen = 1;
	$cDiasHabil = 0;
	$fechaIni = str_replace("-","/",$fechaIni);
  $fechaFin = str_replace("-","/",$fechaFin);
		$isql_busca = "
			select count(*) DIASH
			from sgd_noh_nohabiles
			where to_char(noh_fecha,'YYYY/MM/DD') >= '$fechaIni'
			and to_char(noh_fecha,'YYYY/MM/DD') <= '$fechaFin'
		";
		//$this->db->conn->debug = true;
		$rs = $this->db->query($isql_busca);
	$diasFestivos = 0;
	if(!$rs->EOF )
  	{
		 $diasFestivos =  $rs->fields["DIASH"];
		}
	$fechaTMP = $fechaIni;
 $ii = 0;
 $diasFinSemana = 0;
 $kDia = 0;
 $diasCalendario = 0;
	while($fechaTMP<$fechaFin and $ii<=300)
	{
		$dia = substr($fechaTMP,-2);
		$mes = substr($fechaTMP,5,2);
		$ano = substr($fechaTMP,0,4);
		$fechaTMP = mktime(0, 0, 0, (float)$mes  , (float)$dia+$kDia, $ano,0);
		$diaDelMes = date("w",mktime(0, 0, 0, $mes  , $dia+$kDia, $ano,0));
		$fechaTMP1 = date('m/d/Y', $fechaTMP);
		$fechaTMP = date('Y/m/d', $fechaTMP);
		//echo "$fechaTMP<=$fechaFin<hr>";	
		if($diaDelMes==0 or $diaDelMes==6) 
			{
				$diasFinSemana++;
			}
		$kDia = 1;
		$diasCalendario++;
		$ii++;
	}
  //echo "$fechaTMP<=$fechaFin --> $diasCalendario - ($diasFestivos + $diasFinSemana)";
	$cDiasSumar = $diasCalendario - ($diasFestivos + $diasFinSemana);
	return $cDiasSumar ;
}
function diaFinHabil($fechaIni,$diasTermino)
{	
	$cDiasAdicionL = 0;
	$termino = $fldTERMINO;
	$fechVenc = $fldF1;
	$cDiasCalen = 1;
	$cDiasHabil = 0;
	

	$fechaTMP = $fechaIni;
 $ii = 0;
 $diasFinSemana = 0;
 $diasTMP = 0;
	while($diasTMP<=$diasTermino and $ii<=50)
	{
		$dia = substr($fechaTMP,-2);
		$mes = substr($fechaTMP,5,2);
		$ano = substr($fechaTMP,0,4);
		$fechaTMP = mktime(0, 0, 0, $mes  , $dia+1, $ano);
		$fechaTMP = date('Y/m/d', $fechaTMP);
		if(date('w',$fechaTMP)==0 or date('w',$fechaTMP)==6) $diasTMP++;
	
		$isql_busca = "
			select count(*) DIASH
			from sgd_noh_nohabiles
			where to_char(noh_fecha,'YYYY/MM/DD') >= '$fechaIni'
			and to_char(noh_fecha,'YYYY/MM/DD') <= '$fechaFin'
		";
		//$this->db->conn->debug = true;
		$rs = $this->db->query($isql_busca);
	$diasFestivos = 0;
	if(!$rs->EOF )
  	{
		 $diasFestivos =  $rs->fields["DIASH"];
		}

		$diasFinSemana++;
	}
	
	$cDiasSumar = $diasFestivos + $diasFinSemana;
	return $cDiasSumar;
}
function suma_fechas($fecha,$ndias)
{
	//list($dia,$mes,$a?o)=split("-",$fecha);
	$dia="01";
	$mes="02";
	$dia="2005";
	if ($mes == 'JAN') $mesn = 1;
	elseif ($mes == 'FEB') $mesn = 2;
	elseif ($mes == 'MAR') $mesn = 3;
	elseif ($mes == 'APR') $mesn = 4;
	elseif ($mes == 'MAY') $mesn = 5;
	elseif ($mes == 'JUN') $mesn = 6;
	elseif ($mes == 'JUL') $mesn = 7;
	elseif ($mes == 'AUG') $mesn = 8;
	elseif ($mes == 'SEP') $mesn = 9;
	elseif ($mes == 'OCT') $mesn = 10;
	elseif ($mes == 'NOV') $mesn = 11;
	elseif ($mes == 'DEC') $mesn = 12;
	

   return ($nuevafecha);
}
}

?>
