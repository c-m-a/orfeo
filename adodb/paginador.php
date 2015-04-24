<link rel="stylesheet" href="../estilos_totales.css">
<?php
error_reporting(E_ALL); # reporta todos los errores
ini_set("display_errors", "1"); # pero no los muestra en la pantalla
define('ADODB_ERROR_LOG_TYPE',3);
define('ADODB_ERROR_LOG_DEST','C:/errors.log');
include('adodb-errorpear.inc.php');
include('adodb.inc.php');
include('tohtml.inc.php');
include_once('adodb-paginacion.inc.php');
include('../config.php');
session_start();
$db = ADONewConnection('oracle'); # eg 'mysql' o 'postgres'
$db->Connect($servidor, $usuario, $contrasena, $servicio);
$order = $order_no + 1;
error_reporting(7);
$sqlFecha = $db->SQLDate("d-m-Y H:i A","b.RADI_FECH_RADI");
$sql = "select depe_nomb,depe_codi from dependencia";
$rs = $db->Execute($sql);
print $rs->GetMenu('depe_sel','Seleccion Dependencia');
	if($orden_cambio==1)
	{
	  if(!$order_tipo)
		{
		   $order_tipo="desc";
		}else
		{
			$order_tipo="";
		}
	}
	$isql = 'select
								b.RADI_NUME_RADI "IMG_Numero Radicado"
								,b.RADI_PATH "HID_RADI_PATH"
								,b.RADI_NUME_DERI "Radicado Padre"
								,b.RADI_FECH_RADI "HOR_RAD_FECH_RADI"
								,'.$sqlFecha.' "Fecha Radicado"
								,b.RA_ASUN "Descripcion"
								,a.ANEX_CREADOR "Generado Por"
								,c.SGD_TPR_DESCRIP
								,a.RADI_NUME_SALIDA "CHK_CHKANULAR"
						 from
					 	 anexos a,radicado b,SGD_TPR_TPDCUMENTO c
					 where 
						b.radi_nume_radi is not null
						and a.anex_radi_nume is not null
						and b.radi_nume_radi=a.anex_radi_nume
						and b.tdoc_codi=c.sgd_tpr_codigo
					  order by '.$order .' ' .$order_tipo;
	$db->debug = true;
$pager = new ADODB_Pager($db,$isql,'adodb', true,$order_no,$order_tipo);
$to_ref_order = "paginador.php?order_tipo=$order_tipo&order_no=";
$pager->Render($rows_per_page=35,$to_ref_order,$checkbox=chkAnulados);
	$e = ADODB_Pear_Error();
	echo '<p>',$e->message,'</p>';

?>