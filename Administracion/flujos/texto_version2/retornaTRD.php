<?
//$krdOld = $krd;
error_reporting(0);
session_start();
error_reporting(7);
$ruta_raiz = "../../..";
if(!$krd) $krd=$krdOld;
include "$ruta_raiz/config.php";
	include_once "$ruta_raiz/include/db/ConnectionHandler.php";
    $db = new ConnectionHandler( "$ruta_raiz" );
    if (!defined('ADODB_FETCH_ASSOC'))define('ADODB_FETCH_ASSOC',2);
    $ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
	$db->conn->debug = true;    

$serie = isset( $_GET['serie'] )? $_GET['serie'] : null;
$subserie = isset( $_GET['subserie'] )? $_GET['subserie'] : null;
$dependencia = isset( $_GET['dep'] )? $_GET['dep'] : null;

$fecha_hoy = Date("Y-m-d");
$sqlFechaHoy=$db->conn->DBDate( $fecha_hoy );

$xmlTRD = "";

/*
Sentencias con dependencia
$querySerie = "select s.sgd_srd_codigo AS CODIGO, s.sgd_srd_descrip AS DESCRIPCION 
	         from sgd_mrd_matrird m, sgd_srd_seriesrd s
			 where m.depe_codi = '$dependencia'
			       and s.sgd_srd_codigo = m.sgd_srd_codigo
			       and ".$sqlFechaHoy." between s.sgd_srd_fechini and s.sgd_srd_fechfin
			 order by detalle";
			 
*/
if (  $subserie != null &&  $serie !=null ){
				$ent = 1;

	if ($dependencia != null) { // Habilitar filtrado por dependencia si ésta llega
		$queryTip = "select t.sgd_tpr_codigo AS CODIGO, t.sgd_tpr_descrip AS DESCRIPCION
	         from sgd_mrd_matrird m, sgd_tpr_tpdcumento t
			 where m.depe_codi = '$dependencia'
 			       and m.sgd_srd_codigo = '$serie'
			       and m.sgd_sbrd_codigo = '$subserie'
 			       and t.sgd_tpr_codigo = m.sgd_tpr_codigo
				   and t.sgd_tpr_tp$ent='1'
			 order by DESCRIPCION";	
	}else {
		$queryTip = "select t.sgd_tpr_codigo AS CODIGO, t.sgd_tpr_descrip AS DESCRIPCION
				         from sgd_mrd_matrird m, sgd_tpr_tpdcumento t
						 where 
			 			       m.sgd_srd_codigo = '$serie'
						       and m.sgd_sbrd_codigo = '$subserie'
			 			       and t.sgd_tpr_codigo = m.sgd_tpr_codigo
							   and t.sgd_tpr_tp$ent='1'
						 order by DESCRIPCION";	
	}

	
	
	
	
	$rsTipoDoc=$db->conn->query( $queryTip );
	var_dump($rsTipoDoc);
	while ( !$rsTipoDoc->EOF) {
		$tdocID = $rsTipoDoc->fields['CODIGO'];
		$tdocName = $rsTipoDoc->fields['DESCRIPCION'];
		
		$xmlTRD .= "<tipodoc id='$tdocID'>$tdocName</tipodoc>";
		$rsTipoDoc->MoveNext();
	}
	
	echo $xmlTRD;
	
}elseif ( isset( $serie ) ) {
		
		if ($dependencia != null) {// Habilitar filtrado por dependencia si ésta llega
			$querySub = "select su.sgd_sbrd_codigo AS CODIGO, su.sgd_sbrd_descrip AS DESCRIPCION
						from sgd_mrd_matrird m, sgd_sbrd_subserierd su
						where m.depe_codi = '$dependencia'
						       and m.sgd_srd_codigo = '$serie'
							   and su.sgd_srd_codigo = '$serie'
						       and su.sgd_sbrd_codigo = m.sgd_sbrd_codigo
			 			       and ".$sqlFechaHoy." between su.sgd_sbrd_fechini and su.sgd_sbrd_fechfin
						 order by DESCRIPCION";	
		}else {
			$querySub = "select sgd_sbrd_codigo AS CODIGO, sgd_sbrd_descrip AS DESCRIPCION
				         from sgd_sbrd_subserierd 
						 where sgd_srd_codigo = '$serie'
			 			       and ".$sqlFechaHoy." between sgd_sbrd_fechini and sgd_sbrd_fechfin
						 order by DESCRIPCION
						  ";
		}
		
		
	$rsSubserie=$db->conn->query($querySub);
	var_dump($rsSubserie);
	while (!$rsSubserie->EOF) {
		$subID = $rsSubserie->fields['CODIGO'];
		$subName = $rsSubserie->fields['DESCRIPCION'];
		
		$xmlTRD .= "<subserie id='$subID'>$subName</subserie>";
		$rsSubserie->MoveNext();
	}
		echo $xmlTRD;

}else {
	echo "Error obteniendo TRD";
}
?>