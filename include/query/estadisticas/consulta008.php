<?
/** REPORTE DE VENCIMIENTOS
* @autor LUCIA OJEDA ACOSTA - CRA
* @version ORFEO 3.5
* 22-Feb-2006
* 
* Optimizado por HLP. En este archivo trat�de generar las sentencias a est�dar de ADODB para que puediesen ejecutar
* en cualquier BD. En caso de no llegar a funcionar mover el contenido en tre las l�eas 18 y 60 a la secci� MSSQL y 
* descomentariar el switch.
*/
$coltp3Esp = '"'.$tip3Nombre[3][2].'"';	
if(!$orno) $orno=1;
$orderE = "	ORDER BY $orno $ascdesc ";

$desde = $fecha_ini . " ". "00:00:00";
$hasta = $fecha_fin . " ". "23:59:59";

$sWhereFec =  " and ".$db->conn->SQLDate('Y/m/d H:i:s', 'r.fech_vcmto')." >= '$desde'
				and ".$db->conn->SQLDate('Y/m/d H:i:s', 'r.fech_vcmto')." <= '$hasta'";

if ( $dependencia_busq != 99999)	$condicionE = "	AND r.RADI_DEPE_ACTU=$dependencia_busq ";
//echo $radi_nume_radi;

$sWhere = " where r.radi_nume_radi not in (select anex_radi_nume from anexos where anex_estado > 2) 
			AND r.radi_nume_radi not in 
				(select r.radi_nume_radi from hist_eventos r 
				where upper($tmp_substr(hist_obse,1,3)) = 'NRR'
					OR upper($tmp_substr(hist_obse,1,3)) = 'RSA'
					OR upper($tmp_substr(hist_obse,1,2)) = 'CE'
					OR upper($tmp_substr(hist_obse,1,3)) = 'TRA')
			AND r.radi_nume_radi like '%2' 
			AND r.tdoc_codi = td.sgd_tpr_codigo
			AND r.radi_usua_actu=b.usua_codi 
			AND r.radi_depe_actu=b.depe_codi
			AND b.depe_codi= d.depe_codi $condicionE";

$sSQL = "SELECT r.radi_nume_radi AS radicado, 
			".$db->conn->SQLDate('Y/m/d H:i:s', 'r.radi_fech_radi')." AS fech_radi, 
			td.sgd_tpr_descrip AS tipo, 
			td.sgd_termino_real AS termino,
			r.ra_asun AS asunto, 
			d.depe_nomb AS depe_actu, 
			b.usua_nomb AS nomb_actu, 
			r.radi_usu_ante AS usant,
			r.fech_vcmto AS fech_vcmto,
			r.RADI_PATH AS HID_RADI_PATH{$seguridad}
		FROM radicado r, sgd_tpr_tpdcumento td, usuario b, dependencia d ";

$queryE = "SELECT r.fech_vcmto, 
			count(r.radi_nume_radi) RADICADOS,
			r.fech_vcmto HID_FECH_SELEC
		from radicado r, sgd_tpr_tpdcumento td, usuario b, dependencia d
			$sWhere $sWhereFec GROUP BY r.fech_vcmto ORDER BY $orno $ascdesc";
	
if (!is_null($fecSel)) $sWhereFecE = " AND ".$db->conn->SQLDate('Y-m-d','r.fech_vcmto')." = '$fecSel'";

// CONSULTA PARA VER DETALLES 
$queryEDetalle = $sSQL . $sWhere . $sWhereFecE . $orderE;	

// CONSULTA PARA VER TODOS LOS DETALLES 
$queryETodosDetalle = $sSQL . $sWhere . $sWhereFec . $orderE;	


	
if(isset($_GET['genDetalle'])&& $_GET['denDetalle']=1){
		$titulos=array("#","1#RADICADO","2#FECHA RADICACION","3#TIPO","4#TERMINO","5#ASUNTO","6#DEPENDENCIA ACTUAL","7#USUARIO ACTUAL","8#USUARIO ANTERIOR");
	}else{ 		
		$titulos=array("#","1#FECHA DE VENCIMIMETO","2#RADICADOS");
	}
		
function pintarEstadistica($fila,$indice,$numColumna){
        	global $ruta_raiz,$_POST,$_GET,$krd;
        	$salida="";
        	switch ($numColumna){
        		case  0:
        			$salida=$indice;
        			break;
        		case 1:	
        			$salida=$fila['FECH_VCMTO'];
        		break;
        		case 2:
        			$datosEnvioDetalle="tipoEstadistica=".$_GET['tipoEstadistica']."&amp;genDetalle=1&amp;usua_doc=".urlencode($fila['HID_USUA_DOC'])."&amp;dependencia_busq=".$_GET['dependencia_busq']."&amp;fecha_ini=".$_GET['fecha_ini']."&amp;fecha_fin=".$_GET['fecha_fin']."&amp;tipoRadicado=".$_GET['tipoRadicado']."&amp;tipoDocumento=".$_GET['tipoDocumento']."&amp;codUs=".$fila['HID_COD_USUARIO']."&amp;fecSel=".$fila['HID_FECH_SELEC'];
	        		$datosEnvioDetalle=(isset($_GET['usActivos']))?$datosEnvioDetalle."&amp;usActivos=".$_GET['usActivos']:$datosEnvioDetalle;
	        		$salida="<a href=\"genEstadistica.php?{$datosEnvioDetalle}&amp;krd={$krd}\"  target=\"detallesSec\" >".$fila['RADICADOS']."</a>";
        	break;
        	}
        	return $salida;
        }
function pintarEstadisticaDetalle($fila,$indice,$numColumna){
			global $ruta_raiz,$encabezado,$krd;
			$verImg=($fila['SGD_SPUB_CODIGO']==1)?($fila['USUARIO']!=$_SESSION['usua_nomb']?false:true):($fila['USUA_NIVEL']>$_SESSION['nivelus']?false:true);
        	$numRadicado=$fila['RADICADO'];	
			switch ($numColumna){
					case 0:
						$salida=$indice;
						break;
					case 1:
						if($fila['HID_RADI_PATH'] && $verImg)
							$salida="<center><a href=\"{$ruta_raiz}bodega".$fila['HID_RADI_PATH']."\">".$fila['RADICADO']."</a></center>";
						else 
							$salida="<center class=\"leidos\">{$numRadicado}</center>";	
						break;
					case 2:
						if($verImg)
		   					$salida="<a class=\"vinculos\" href=\"{$ruta_raiz}verradicado.php?verrad=".$fila['RADICADO']."&amp;".session_name()."=".session_id()."&amp;krd=".$_GET['krd']."&amp;carpeta=8&amp;nomcarpeta=Busquedas&amp;tipo_carp=0 \" >".$fila['FECH_RADI']."</a>";
		   				else 
		   				$salida="<a class=\"vinculos\" href=\"#\" onclick=\"alert(\"ud no tiene permisos para ver el radicado\");\">".$fila['FECH_RADI']."</a>";
						break;
					case 3:
						$salida="<center class=\"leidos\">".$fila['TIPO']."</center>";		
						break;
					case 4:
						$salida="<center class=\"leidos\">".$fila['TERMINO']."</center>";
						break;
					case 5:
						$salida="<center class=\"leidos\">".$fila['ASUNTO']."</center>";
						break;
					case 6:
						$salida="<center class=\"leidos\">".$fila['DEPE_ACTU']."</center>";			
						break;	
					case 7:
						$salida="<center class=\"leidos\">".$fila['NOMB_ACTU']."</center>";			
						break;	
					case 8:
						$salida="<center class=\"leidos\">".$fila['USANT']."</center>";			
						break;	
					case 9:
						$salida="<center class=\"leidos\">".$fila['FECH_VCMTO']."</center>";			
						break;	
			}
			return $salida;
		}





/*
switch($db->driver)
{	case 'mssql':
		{	
		}break;
	case 'oracle':
	case 'oci8':
	case 'oci805':
	case 'ocipo':
		{	$sWhereFec =  " AND r.fech_vcmto >= to_date('" . $desde . "','yyyy/mm/dd HH24:MI:ss')
							AND r.fech_vcmto <= to_date('" . $hasta . "','yyyy/mm/dd HH24:MI:ss')";
			$sWhere = " where r.radi_nume_radi not in (select anex_radi_nume from anexos where anex_estado > 2) 
							AND r.radi_nume_radi not in 
								(select radi_nume_radi from hist_eventos 
								where upper(substr(hist_obse,1,3)) = 'NRR'
								OR upper(substr(hist_obse,1,3)) = 'RSA'
								OR upper(substr(hist_obse,1,2)) = 'CE'
								OR upper(substr(hist_obse,1,3)) = 'TRA')
							AND r.radi_nume_radi like '%2' 
							AND r.tdoc_codi = td.sgd_tpr_codigo
							AND r.radi_usua_actu=u.usua_codi 
							AND r.radi_depe_actu=u.depe_codi
							AND u.depe_codi= d.depe_codi $condicionE";
			$sSQL = "SELECT r.radi_nume_radi							AS radicado, 
					to_char(r.radi_fech_radi,'yyyy/mm/dd hh24:mi:ss') 	AS fech_radi, 
					td.sgd_tpr_descrip 									AS tipo, 
					td.sgd_termino_real									AS termino,
					r.ra_asun 											AS asunto, 
					d.depe_nomb 										AS depe_actu, 
					u.usua_nomb 										AS nomb_actu, 
					r.radi_usu_ante 									AS usant,
					r.fech_vcmto										AS fech_vcmto,
					r.RADI_PATH 										AS HID_RADI_PATH
				FROM radicado r, sgd_tpr_tpdcumento td, usuario u, dependencia d ";
			$queryE = "SELECT r.fech_vcmto, 
					count(r.RADI_NUME_RADI) RADICADOS,
					r.fech_vcmto HID_FECH_SELEC
					from radicado r, sgd_tpr_tpdcumento td, usuario u, dependencia d
					$sWhere $sWhereFec GROUP BY fech_vcmto ORDER BY $orno $ascdesc";
	
	    	$sWhereFecE = " AND r.fech_vcmto = to_date('" . $fecSel . "','yyyy/mm/dd HH24:MI:ss')";
			// CONSULTA PARA VER DETALLES 
			$queryEDetalle = $sSQL . $sWhere . $sWhereFecE . $orderE;	
			// CONSULTA PARA VER TODOS LOS DETALLES 
			$queryETodosDetalle = $sSQL . $sWhere . $sWhereFec . $orderE;	
		}break;
}
*/
//$db->conn->debug = true;
?>
