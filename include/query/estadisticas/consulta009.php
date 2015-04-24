<?php
/*********************************************************************************
 *       Filename: Reporte Proceso Radicados de Entrada
 *		 @autor LUCIA OJEDA ACOSTA - CRA
 *		 @version ORFEO 3.5
 *       PHP 4.0 build 22-Feb-2006
 *********************************************************************************/

$coltp3Esp = '"'.$tip3Nombre[3][2].'"';	
if(!$orno) $orno=1;
$orderE = "	ORDER BY $orno $ascdesc ";

$desde = $fecha_ini. " ". "00:00:00";
$hasta = $fecha_fin. " ". "23:59:59";

$sWhereFec =  " and ".$db->conn->SQLDate('Y/m/d H:i:s', 'R.RADI_FECH_RADI')." >= '$desde'
				and ".$db->conn->SQLDate('Y/m/d H:i:s', 'R.RADI_FECH_RADI')." <= '$hasta'";

if ( $dependencia_busq != 99999)	$condicionE = "	AND r.radi_depe_radi=$dependencia_busq ";
switch($db->driver)
{	case 'mssql':
		{	$sSQL_1 = "select top 300 $radi_nume_radi AS RAD_ENTRADA, 
					".$db->conn->SQLDate('Y/m/d H:i:s', 'r.radi_fech_radi')." AS FEC_RAD_E , 
					$tmp_substr($radi_nume_salida,1,14) AS RAD_SALIDA, 
					".$db->conn->SQLDate('Y/m/d H:i:s', 'a.anex_radi_fech')." AS FEC_RAD_S,
					".$db->conn->SQLDate('Y/m/d H:i:s', 'a.sgd_fech_impres')." AS FEC_IMPRE,
					".$db->conn->SQLDate('Y/m/d H:i:s', 'a.anex_fech_envio')." AS FEC_ENVIO,
					td.sgd_tpr_descrip AS TIPO, 
					r.ra_asun AS ASUNTO, 
					d1.depe_nomb AS DEP_ACTUAL, 
					b.usua_nomb AS USU_ACTUAL, 
					r.radi_usu_ante AS USU_ANT, 
					$redondeo AS DIAS_RESTAN
					{$seguridad}
				from radicado r, anexos a, sgd_tpr_tpdcumento td, usuario b, dependencia d1
				where r.radi_nume_radi = a.anex_radi_nume 
					AND a.radi_nume_salida > 0
					AND r.radi_nume_radi like '%2' 
					AND r.tdoc_codi=td.sgd_tpr_codigo 
					AND r.codi_nivel <=5 
					AND r.radi_usua_actu=b.usua_codi 
					AND r.radi_depe_actu=b.depe_codi 
					AND b.depe_codi=d1.depe_codi 
					AND a.radi_nume_salida NOT IN(SELECT radi_nume_radi FROM SGD_ANU_ANULADOS AN)";
			$sSQL_2 = "SELECT top 300
					$radi_nume_radi AS RAD_ENTRADA, 
					".$db->conn->SQLDate('Y/m/d H:i:s', 'r.radi_fech_radi')." AS FEC_RAD_E, 
					'0' AS RAD_SALIDA,
					'' AS FEC_RAD_S, 
					'' AS FEC_IMPRE,
					'' AS FEC_ENVIO,
					td.sgd_tpr_descrip AS TIPO, 
					r.ra_asun AS ASUNTO, 
					d1.depe_nomb AS DEP_ACTUAL, 
					b.usua_nomb AS USU_ACTUAL, 
					r.radi_usu_ante AS USU_ANT,
					$redondeo AS DIAS_RESTAN
					{$seguridad}
				FROM radicado r, sgd_tpr_tpdcumento td, usuario b, dependencia d1
				WHERE  r.tdoc_codi=td.sgd_tpr_codigo 
					AND r.codi_nivel <=5 
					AND r.radi_usua_actu=b.usua_codi AND r.radi_depe_actu=b.depe_codi 
					AND b.depe_codi=d1.depe_codi 
					AND $tmp_substr($radi_nume_radi,14,1) = 2
					AND  R.RADI_NUME_RADI NOT IN(SELECT ANEX_RADI_NUME FROM ANEXOS)";
			$sSQL_3 = "
				select top 300 $radi_nume_radi AS RAD_ENTRADA, 
					".$db->conn->SQLDate('Y/m/d H:i:s', 'r.radi_fech_radi')." AS FEC_RAD_E,
					'ANEXO SIN RADICAR' AS RAD_SALIDA, 
					".$db->conn->SQLDate('Y/m/d H:i:s', 'a.anex_radi_fech')." AS FEC_RAD_S,
					".$db->conn->SQLDate('Y/m/d H:i:s', 'a.sgd_fech_impres')." AS FEC_IMPRE,
					".$db->conn->SQLDate('Y/m/d H:i:s', 'a.anex_fech_envio')." AS FEC_ENVIO,
					td.sgd_tpr_descrip AS TIPO, 
					r.ra_asun AS ASUNTO, 
					d1.depe_nomb AS DEP_ACTUAL, 
					b.usua_nomb AS USU_ACTUAL, 
					r.radi_usu_ante AS USU_ANT, 
					$redondeo AS DIAS_RESTAN
					{$seguridad}
				from radicado r, anexos a, sgd_tpr_tpdcumento td, usuario b, dependencia d1
				where r.radi_nume_radi = a.anex_radi_nume 
					AND a.radi_nume_salida is null AND a.anex_borrado = 'N'
					AND r.radi_nume_radi like '%2' 
					AND r.tdoc_codi=td.sgd_tpr_codigo 
					AND r.codi_nivel <=5 
					AND r.radi_usua_actu=b.usua_codi 
					AND r.radi_depe_actu=b.depe_codi 
					AND b.depe_codi=d1.depe_codi";
			$queryE = "SELECT ".
					$db->conn->SQLDate('Y/m/d', 'r.radi_fech_radi')." FECH_RADI, 
					count($radi_nume_radi) RADICADOS, 
					MIN(".$db->conn->SQLDate('Y/m/d', 'r.radi_fech_radi').") HID_FECH_SELEC
				from radicado r
				WHERE radi_nume_radi LIKE '%2'
				$condicionE $sWhereFec
			GROUP BY ".$db->conn->SQLDate('Y/m/d', 'r.radi_fech_radi')." ORDER BY $orno $ascdesc";
			//-------------------------------
			// Assemble full SQL statement
			//-------------------------------

		   if (!is_null($fecSel))  $sWhereFecE =  " $condicionE AND ".$db->conn->SQLDate('Y/m/d', 'r.radi_fech_radi')." = '".$fecSel."'";
		
			$sWhereC = $sWhereFecE ;
			$sSQL = $sSQL_1 . $sWhereC . $sWhereFec . " UNION " . $sSQL_2 . $sWhereC . $sWhereFec . " UNION " .  $sSQL_3 . $sWhereC . $sWhereFec . $sOrder;
			/** CONSULTA PARA VER DETALLES 
			 */
			$sSQL = $sSQL_1 . $sWhereFecE . " UNION " . $sSQL_2 . $sWhereFecE . " UNION " .  $sSQL_3 . $sWhereFecE . $sOrder;
			$queryEDetalle = $sSQL . $orderE;	
		}break;
	case 'oracle':
	case 'oci8':
	case 'oci805':
	case 'ocipo':
		{	$sSQL_1 = "select r.radi_nume_radi 										AS RAD_ENTRADA, 
					to_char(r.radi_fech_radi,'yyyy/mm/dd hh24:mi:ss') 				AS FEC_RAD_E , 
					substr(a.radi_nume_salida,1,14) 								AS RAD_SALIDA, 
					to_char(a.anex_radi_fech,'yyyy/mm/dd hh24:mi:ss') 				AS FEC_RAD_S,
				    to_char(a.sgd_fech_impres,'yyyy/mm/dd hh24:mi:ss') 				AS FEC_IMPRE,
				    to_char(a.anex_fech_envio,'yyyy/mm/dd hh24:mi:ss')				AS FEC_ENVIO,
					td.sgd_tpr_descrip 												AS TIPO, 
					r.ra_asun 														AS ASUNTO, 
					d1.depe_nomb 													AS DEP_ACTUAL, 
					b.usua_nomb 													AS USU_ACTUAL, 
					r.radi_usu_ante 												AS USU_ANT, 
					round(((r.radi_fech_radi+(td.sgd_tpr_termino * 7/5))-sysdate)) 	AS DIAS_RESTAN
					{$seguridad}
				from radicado r, anexos a, sgd_tpr_tpdcumento td, usuario b, dependencia d1
				where r.radi_nume_radi = a.anex_radi_nume 
					AND a.radi_nume_salida > 0
					AND r.radi_nume_radi like '%2' 
					AND r.tdoc_codi=td.sgd_tpr_codigo 
					AND r.codi_nivel <=5 
					AND r.radi_usua_actu=b.usua_codi 
					AND r.radi_depe_actu=b.depe_codi 
					AND b.depe_codi=d1.depe_codi 
					AND a.radi_nume_salida NOT IN(SELECT radi_nume_radi FROM SGD_ANU_ANULADOS AN)
					AND rownum <= 300";
			$sSQL_2 = "SELECT 
					r.radi_nume_radi 												AS RAD_ENTRADA, 
					to_char(r.radi_fech_radi,'yyyy/mm/dd hh24:mi:ss') 				AS FEC_RAD_E, 
					'0' 															AS RAD_SALIDA,
					to_char('','yyyy/mm/dd hh24:mi:ss') 							AS FEC_RAD_S, 
					to_char('','yyyy/mm/dd hh24:mi:ss') 							AS FEC_IMPRE,
			        to_char('','yyyy/mm/dd hh24:mi:ss') 							AS FEC_ENVIO,
					td.sgd_tpr_descrip 												AS TIPO, 
					r.ra_asun 														AS ASUNTO, 
					d1.depe_nomb 													AS DEP_ACTUAL, 
					b.usua_nomb 													AS USU_ACTUAL, 
					r.radi_usu_ante 												AS USU_ANT,
					round(((r.radi_fech_radi+(td.sgd_tpr_termino * 7/5))-sysdate)) 	AS DIAS_RESTAN
					{$seguridad}
				FROM 
					radicado r, 
					sgd_tpr_tpdcumento td, 
					usuario b, 
					dependencia d1
				WHERE  r.tdoc_codi=td.sgd_tpr_codigo 
					AND r.codi_nivel <=5 
					AND r.radi_usua_actu=b.usua_codi AND r.radi_depe_actu=b.depe_codi 
					AND b.depe_codi=d1.depe_codi 
					AND substr(r.radi_nume_radi,14,1) = 2
					AND  R.RADI_NUME_RADI NOT IN(SELECT ANEX_RADI_NUME FROM ANEXOS)
					AND rownum <= 300";
			$sSQL_3 = "
				select r.radi_nume_radi 												AS RAD_ENTRADA, 
					to_char(r.radi_fech_radi,'yyyy/mm/dd hh24:mi:ss') 					AS FEC_RAD_E,
					'ANEXO SIN RADICAR' 												AS RAD_SALIDA, 
					to_char(a.anex_radi_fech,'yyyy/mm/dd hh24:mi:ss') 					AS FEC_RAD_S, 
				    to_char(a.sgd_fech_impres,'yyyy/mm/dd hh24:mi:ss') 					AS FEC_IMPRE,
				    to_char(a.anex_fech_envio,'yyyy/mm/dd hh24:mi:ss') 					AS FEC_ENVIO,
					td.sgd_tpr_descrip 													AS TIPO, 
					r.ra_asun 															AS ASUNTO, 
					d1.depe_nomb 														AS DEP_ACTUAL, 
					b.usua_nomb 														AS USU_ACTUAL, 
					r.radi_usu_ante 													AS USU_ANT, 
					round(((r.radi_fech_radi+(td.sgd_tpr_termino * 7/5))-sysdate)) 		AS DIAS_RESTAN
					{$seguridad}
				from radicado r, anexos a, sgd_tpr_tpdcumento td, usuario b, dependencia d1
				where r.radi_nume_radi = a.anex_radi_nume 
					AND a.radi_nume_salida is null AND a.anex_borrado = 'N'
					AND r.radi_nume_radi like '%2' 
					AND r.tdoc_codi=td.sgd_tpr_codigo 
					AND r.codi_nivel <=5 
					AND r.radi_usua_actu=b.usua_codi 
					AND r.radi_depe_actu=b.depe_codi 
					AND b.depe_codi=d1.depe_codi 
					AND rownum <= 300";
			$queryE = "
				SELECT substr(to_char(r.radi_fech_radi,'yyyy/mm/dd hh24:mi:ss'),1,10 ) FECH_RADI, 
					count(r.RADI_NUME_RADI) RADICADOS, 
					MIN(radi_fech_radi) HID_FECH_SELEC
				from radicado r
				WHERE radi_nume_radi LIKE '%2'
				$condicionE $sWhereFec
			GROUP BY substr(to_char(r.radi_fech_radi,'yyyy/mm/dd hh24:mi:ss'),1,10 ) 
			ORDER BY $orno $ascdesc";
			//-------------------------------
			// Assemble full SQL statement
			//-------------------------------

		    $sWhereFecE =  " $condicionE AND substr(r.radi_fech_radi,1,10) = to_date('" . $fecSel . "', 'yyyy/mm/dd HH24:MI:ss')";
		
			$sWhereC = $sWhereFecE ;
			$sSQL = $sSQL_1 . $sWhereC . $sWhereFec . " UNION " . $sSQL_2 . $sWhereC . $sWhereFec . " UNION " .  $sSQL_3 . $sWhereC . $sWhereFec . $sOrder;
			/** CONSULTA PARA VER DETALLES 
			 */
			$sSQL = $sSQL_1 . $sWhereFecE . " UNION " . $sSQL_2 . $sWhereFecE . " UNION " .  $sSQL_3 . $sWhereFecE . $sOrder;
			$queryEDetalle = $sSQL . $orderE;	
		}break;
}


	
if(isset($_GET['genDetalle'])&& $_GET['denDetalle']=1){
		$titulos=array("#","1#RADICADODE ENTRADA","2#FECHA RADICACION DE ENTRADA","3#RADICACION DE SALIDA","4#FECHA DE RADICACION DE SALIDA","5#FECHA DE IMPRESION","6#FECHA DE ENVIO","7#TIPO","8#ASUNTO","8#DEPENDENCIA ACTUAL","9#USUARIO ACTUAL","10#USUARIO ANTERIOR","11#DIAS RESTANTES");
	}else{ 		
		$titulos=array("#","1#FECHA DE RADICACION","2#RADICADOS");
	}
		
function pintarEstadistica($fila,$indice,$numColumna){
        	global $ruta_raiz,$_POST,$_GET,$krd;
        	$salida="";
        	switch ($numColumna){
        		case  0:
        			$salida=$indice;
        			break;
        		case 1:	
        			$salida=$fila['FECH_RADI'];
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
        	$numRadicado=$fila['RAD_ENTRADA'];	
			switch ($numColumna){
					case 0:
						$salida=$indice;
						break;
					case 1:
							$salida="<center class=\"leidos\">{$numRadicado}</center>";	
						break;
					case 2:
						if($verImg)
		   					$salida="<a class=\"vinculos\" href=\"{$ruta_raiz}verradicado.php?verrad=".$numRadicado."&amp;".session_name()."=".session_id()."&amp;krd=".$_GET['krd']."&amp;carpeta=8&amp;nomcarpeta=Busquedas&amp;tipo_carp=0 \" >".$fila['FEC_RAD_E']."</a>";
		   				else 
		   				$salida="<a class=\"vinculos\" href=\"#\" onclick=\"alert(\"ud no tiene permisos para ver el radicado\");\">".$fila['FEC_RADI_E']."</a>";
						break;
					case 3:
						$salida="<center class=\"leidos\">".$fila['RAD_SALIDA']."</center>";		
						break;
					case 4:
						$salida="<center class=\"leidos\">".$fila['FEC_RAD_S']."</center>";		
						break;
					case 5:
						$salida="<center class=\"leidos\">".$fila['FEC_IMPRE']."</center>";		
						break;
					case 6:
						$salida="<center class=\"leidos\">".$fila['FEC_ENVIO']."</center>";		
						break;
					case 7:
						$salida="<center class=\"leidos\">".$fila['TIPO']."</center>";		
						break;
					case 8:
						$salida="<center class=\"leidos\">".$fila['ASUNTO']."</center>";
						break;
					case 9:
						$salida="<center class=\"leidos\">".$fila['DEP_ACTUAL']."</center>";			
						break;	
					case 10:
						$salida="<center class=\"leidos\">".$fila['USU_ACTUAL']."</center>";			
						break;	
					case 11:
						$salida="<center class=\"leidos\">".$fila['USU_ANT']."</center>";			
						break;	
					case 12:
						$salida="<center class=\"leidos\">".$fila['DIAS_RESTAN']."</center>";			
						break;	
			}
			return $salida;
		}




?>
