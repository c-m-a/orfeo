<?php 
$ruta_raiz = "../../..";
include_once "$ruta_raiz/include/db/ConnectionHandler.php";
    $db = new ConnectionHandler( "$ruta_raiz" );
    if (!defined('ADODB_FETCH_ASSOC'))define('ADODB_FETCH_ASSOC',2);
    $ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
$salida="<option value'0'> 0 : -- Seleccione --</option>";
if(isset($_GET['codserie']) || isset($_SESSION["serieProc"])){
	
	$codserie = isset($_SESSION["serieProc"]) ? $_SESSION["serieProc"] : $_GET['codserie'];
//	$codserie=$_GET['codserie'];
	
	if(isset($_GET['subserie'])){
			$fechah=date("dmy") . " ". time("h_m_s");
			$fecha_hoy = Date("Y-m-d");
			$sqlFechaHoy=$db->conn->DBDate($fecha_hoy);
			$check=1;
			$fechaf=date("dmy") . "_" . time("hms");
			
			
			$querySub = "select sgd_sbrd_descrip, sgd_sbrd_codigo 
						         from sgd_sbrd_subserierd 
								 where sgd_srd_codigo = '$codserie'
					 			       and ".$sqlFechaHoy." between sgd_sbrd_fechini and sgd_sbrd_fechfin
								 order by 1 ";
						if($rsSub=$db->conn->query($querySub)){
							while(!$rsSub->EOF){
								$salida.="<option value='".$rsSub->fields['SGD_SBRD_CODIGO']."' >".$rsSub->fields['SGD_SBRD_DESCRIP']."--".$rsSub->fields['SGD_SBRD_CODIGO']."</option>
								";
								$rsSub->MoveNext();
						 }
					}	
	}else{
		
						$tsub=$_GET['tsub'];
						$ent = 1;
						$queryTip = "select distinct t.sgd_tpr_codigo,t.sgd_tpr_descrip
							         from sgd_mrd_matrird m, sgd_tpr_tpdcumento t
									 where 
						 			       m.sgd_srd_codigo = '$codserie'
									       and m.sgd_sbrd_codigo = '$tsub'
						 			       and t.sgd_tpr_codigo = m.sgd_tpr_codigo
										   and t.sgd_tpr_tp$ent='1'
									 order by 1";
						if($rsTip=$db->conn->query($queryTip)){
							while(!$rsTip->EOF){
								$salida.="<option value='".$rsTip->fields['SGD_TPR_CODIGO']."' >".$rsTip->fields['SGD_TPR_DESCRIP']."--".$rsTip->fields['SGD_TPR_CODIGO']."</option>
								";
								$rsTip->MoveNext();
						 }
					}	
	}
}
echo $salida;
?>