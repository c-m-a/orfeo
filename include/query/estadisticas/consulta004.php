<?
/** CONSUTLA 004
	* Estadiscas de Numero de Radicados digitalizados y Hojas Digitalizadas.
	* @autor JAIRO H LOSADA - SSPD
	* @version ORFEO 3.1
	* 
	*/
$coltp3Esp = '"'.$tip3Nombre[3][2].'"';	
if(!$orno) $orno=2;
 /**
   * $db-driver Variable que trae el driver seleccionado en la conexion
   * @var string
   * @access public
   */
 /**
   * $fecha_ini Variable que trae la fecha de Inicio Seleccionada  viene en formato Y-m-d
   * @var string
   * @access public
   */
/**
   * $fecha_fin Variable que trae la fecha de Fin Seleccionada
   * @var string
   * @access public
   */
/**
   * $mrecCodi Variable que trae el medio de recepcion por el cual va a sacar el detalle de la Consulta.
   * @var string
   * @access public
   */
switch($db->driver)
{	case 'mssql':
	case 'postgres':
		{	if ( $dependencia_busq != 99999)
			{	$condicionE = "	AND h.DEPE_CODI=$dependencia_busq AND b.depe_codi = $dependencia_busq";	}
			$queryE = "
	    	SELECT b.USUA_NOMB AS USUARIO
				, count(*) AS RADICADOS
				, SUM(a.RADI_NUME_HOJA) AS HOJAS_DIGITALIZADAS						
				, MIN(b.USUA_CODI) AS HID_COD_USUARIO
			FROM RADICADO a, USUARIO b, HIST_EVENTOS h
			WHERE 
				h.USUA_CODI=b.usua_CODI 
				AND b.depe_codi = h.depe_codi
				$condicionE
				AND h.RADI_NUME_RADI=a.RADI_NUME_RADI
				AND h.SGD_TTR_CODIGO IN(22,42)
				AND ".$db->conn->SQLDate('Y/m/d', 'a.radi_fech_radi')." BETWEEN '$fecha_ini'  AND '$fecha_fin' 
				$whereTipoRadicado 
			GROUP BY b.USUA_NOMB
			ORDER BY $orno $ascdesc";
 			/** CONSULTA PARA VER DETALLES 
	 		*/

			$queryEDetalle = "SELECT 
				$radi_nume_radi AS RADICADO
				, b.USUA_NOMB AS USUARIO_DIGITALIZADOR
				, h.HIST_OBSE AS OBSERVACIONES, ".
				$db->conn->SQLDate('Y/m/d H:i:s','r.radi_fech_radi')." AS FECHA_RADICACION, ".
				$db->conn->SQLDate('Y/m/d H:i:s','h.HIST_FECH')." AS FECHA_DIGITALIZACION
				, mr.mrec_desc AS MEDIO_RECEPCION
				,r.RADI_PATH AS HID_RADI_PATH{$seguridad}
				FROM RADICADO r, USUARIO b, HIST_EVENTOS h, MEDIO_RECEPCION mr
			WHERE 
				h.USUA_CODI=b.usua_CODI 
				AND b.depe_codi = h.depe_codi
				$condicionE
				AND h.RADI_NUME_RADI=r.RADI_NUME_RADI
				AND r.MREC_CODI=mr.MREC_CODI
				AND b.USUA_CODI=$codUs
				AND h.SGD_TTR_CODIGO IN(22,42)
				AND ".$db->conn->SQLDate('Y/m/d', 'r.radi_fech_radi')." BETWEEN '$fecha_ini'  AND '$fecha_fin' 
				$whereTipoRadicado 
			ORDER BY $orno $ascdesc";

      $queryETodosDetalle = "SELECT 
        $radi_nume_radi AS RADICADO
        , b.USUA_NOMB AS USUARIO_DIGITALIZADOR
        , h.HIST_OBSE AS OBSERVACIONES, ".
        $db->conn->SQLDate('Y/m/d H:i:s','r.radi_fech_radi')." AS FECHA_RADICACION, ".
        $db->conn->SQLDate('Y/m/d H:i:s','h.HIST_FECH')." AS FECHA_DIGITALIZACION
        , mr.mrec_desc AS MEDIO_RECEPCION
        ,r.RADI_PATH AS HID_RADI_PATH{$seguridad}
        FROM RADICADO r, USUARIO b, HIST_EVENTOS h, MEDIO_RECEPCION mr
      WHERE 
        h.USUA_CODI=b.usua_CODI 
        AND b.depe_codi = h.depe_codi
        $condicionE
        AND h.RADI_NUME_RADI=r.RADI_NUME_RADI
        AND r.MREC_CODI=mr.MREC_CODI
        AND h.SGD_TTR_CODIGO IN(22,42)
        AND ".$db->conn->SQLDate('Y/m/d', 'r.radi_fech_radi')." BETWEEN '$fecha_ini'  AND '$fecha_fin' 
        $whereTipoRadicado 
      ORDER BY $orno $ascdesc";
		}break;
	case 'oracle':
	case 'oci8':
	case 'oci805':
	case 'ocipo':
		{	if ( $dependencia_busq != 99999)
			{	$condicionE = "	AND h.DEPE_CODI=$dependencia_busq AND b.depe_codi = $dependencia_busq";	}
			$queryE = "
	    	SELECT b.USUA_NOMB USUARIO
				, count(*) RADICADOS
				, SUM(a.RADI_NUME_HOJA) HOJAS_DIGITALIZADAS						
				, MIN(b.USUA_CODI) HID_COD_USUARIO
			FROM RADICADO a, USUARIO b, HIST_EVENTOS h
			WHERE 
				h.USUA_CODI=b.usua_CODI 
				AND b.depe_codi = h.depe_codi
				$condicionE
				AND h.RADI_NUME_RADI=a.RADI_NUME_RADI
				AND h.SGD_TTR_CODIGO IN(22,42)
				AND TO_CHAR(a.radi_fech_radi,'yyyy/mm/dd') BETWEEN '$fecha_ini'  AND '$fecha_fin' 
				$whereTipoRadicado 
			GROUP BY b.USUA_NOMB
			ORDER BY $orno $ascdesc";
 			/** CONSULTA PARA VER DETALLES 
	 		*/

			$queryEDetalle = "SELECT 
				R.RADI_NUME_RADI RADICADO
				, b.USUA_NOMB USUARIO_DIGITALIZADOR
				, h.HIST_OBSE OBSERVACIONES
				, TO_CHAR(a.RADI_FECH_RADI, 'DD/MM/YYYY HH24:MI:SS') FECHA_RADICACION
				, TO_CHAR(h.HIST_FECH, 'DD/MM/YYYY HH24:MI:SS') FECHA_DIGITALIZACION
				, mr.mrec_desc MEDIO_RECEPCION
				,R.RADI_PATH HID_RADI_PATH{$seguridad}
				FROM RADICADO R, USUARIO b, HIST_EVENTOS h, MEDIO_RECEPCION mr
			WHERE 
				h.USUA_CODI=b.usua_CODI 
				AND b.depe_codi = h.depe_codi
				$condicionE
				AND h.RADI_NUME_RADI=a.RADI_NUME_RADI
				AND a.MREC_CODI=mr.MREC_CODI (+)
				AND b.USUA_CODI=$codUs
				AND h.SGD_TTR_CODIGO IN(22,42)
				AND TO_CHAR(a.radi_fech_radi,'yyyy/mm/dd') BETWEEN '$fecha_ini'  AND '$fecha_fin' 
				$whereTipoRadicado 
			ORDER BY $orno $ascdesc";
      $queryEDetalle = str_replace("a.", "r.", $queryEDetalle);
      $queryETodosDetalle = "SELECT 
        R.RADI_NUME_RADI RADICADO
        , b.USUA_NOMB USUARIO_DIGITALIZADOR
        , h.HIST_OBSE OBSERVACIONES
        , TO_CHAR(r.RADI_FECH_RADI, 'DD/MM/YYYY HH24:MI:SS') FECHA_RADICACION
        , TO_CHAR(h.HIST_FECH, 'DD/MM/YYYY HH24:MI:SS') FECHA_DIGITALIZACION
        , mr.mrec_desc MEDIO_RECEPCION
        ,R.RADI_PATH HID_RADI_PATH{$seguridad}
        FROM RADICADO r, USUARIO b, HIST_EVENTOS h, MEDIO_RECEPCION mr
      WHERE 
        h.USUA_CODI=b.usua_CODI 
        AND b.depe_codi = h.depe_codi
        $condicionE
        AND h.RADI_NUME_RADI=r.RADI_NUME_RADI
        AND r.MREC_CODI=mr.MREC_CODI (+)
        AND h.SGD_TTR_CODIGO IN(22,42)
        AND TO_CHAR(r.radi_fech_radi,'yyyy/mm/dd') BETWEEN '$fecha_ini'  AND '$fecha_fin' 
        $whereTipoRadicado 
      ORDER BY $orno $ascdesc";
      $queryEDetalle = str_replace("a.", "r.", $queryEDetalle);
      $queryETodosDetalle = str_replace("a.", "r.", $queryETodosDetalle);
//$db->conn->debug = true;
		}break;
}

if(isset($_GET['genDetalle'])&& $_GET['denDetalle']=1)
		$titulos=array("#","1#RADICADO","2#USUARIO DIGITALIZADOR","3#OBSERVACIONES","4#FECHA RADICACION","5#FECHA DIGITALIZACION","6#MEDIO DE RECEPCION");
	else 		
		$titulos=array("#","1#Usuario","2#Radicados","3#HOJAS DIGITALIZADAS");

function pintarEstadistica($fila,$indice,$numColumna){
        	global $ruta_raiz,$_POST,$_GET,$krd;
        	$salida="";
        	switch ($numColumna){
        		case  0:
        			$salida=$indice;
        			break;
        		case 1:	
        			$salida=$fila['USUARIO'];
        		break;
        		case 2:
        			$datosEnvioDetalle="tipoEstadistica=".$_GET['tipoEstadistica']."&amp;genDetalle=1&amp;usua_doc=".urlencode($fila['HID_USUA_DOC'])."&amp;dependencia_busq=".$_GET['dependencia_busq']."&amp;fecha_ini=".$_GET['fecha_ini']."&amp;fecha_fin=".$_GET['fecha_fin']."&amp;tipoRadicado=".$_GET['tipoRadicado']."&amp;tipoDocumento=".$_GET['tipoDocumento']."&amp;codUs=".$fila['HID_COD_USUARIO'];
	        		$datosEnvioDetalle=(isset($_GET['usActivos']))?$datosEnvioDetalle."&amp;usActivos=".$_GET['usActivos']:$datosEnvioDetalle;
	        		$salida="<a href=\"genEstadistica.php?{$datosEnvioDetalle}&amp;krd={$krd}\"  target=\"detallesSec\" >".$fila['RADICADOS']."</a>";
        	break;
        	 case 3:
        	 	$salida=$fila['HOJAS_DIGITALIZADAS'];
        	 	break;
        	default: $salida=false;
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
							$salida="<center><a href=\"{$ruta_raiz}bodega".$fila['RADI_PATH']."\">".$fila['RADICADO']."</a></center>";
						else 
							$salida="<center class=\"leidos\">{$numRadicado}</center>";	
						break;
						case 2:
							$salida="<center class=\"leidos\">".$fila['USUARIO_DIGITALIZADOR']."</center>";
							break;
						case 3:
							$salida="<center class=\"leidos\">".$fila['OBSERVACIONES']."</center>";
						case 4:
						if($verImg)
		   					$salida="<a class=\"vinculos\" href=\"{$ruta_raiz}verradicado.php?verrad=".$fila['RADICADO']."&amp;".session_name()."=".session_id()."&amp;krd=".$_GET['krd']."&amp;carpeta=8&amp;nomcarpeta=Busquedas&amp;tipo_carp=0 \" >".$fila['FECHA_RADICACION']."</a>";
		   				else 
		   				$salida="<a class=\"vinculos\" href=\"#\" onclick=\"alert(\"ud no tiene permisos para ver el radicado\");\">".$fila['FECHA_RADICACION']."</a>";
						break;
					case 5:
						$salida="<center class=\"leidos\">".$fila['FECHA_DIGITALIZACION']."</center>";		
						break;
					case 6:
						$salida="<center class=\"leidos\">".$fila['MEDIO_RECEPCION']."</center>";
			}
			return $salida;
		}
?>
