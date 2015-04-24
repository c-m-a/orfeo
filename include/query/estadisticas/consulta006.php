<?php
/** RADICADOS DE ENTRADA RECIBIDOS DEL AREA DE CORRESPONDENCIA
	* 
	* @autor JAIRO H LOSADA - SSPD
	* @version ORFEO 3.1
	* 
	*/
$coltp3Esp = '"'.$tip3Nombre[3][2].'"';	
if(!$orno) $orno=1;
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
{
	case 'oracle':
	case 'oci8':
	case 'oci805':
	case 'ocipo':
		{
			if ( $dependencia_busq != 99999)
			{	$condicionE = "	AND b.DEPE_CODI=$dependencia_busq AND r.RADI_DEPE_ACTU=$dependencia_busq ";	}
			
			if($tipoDocumento=='9999')
			{
				$queryE = "SELECT  b.USUA_NOMB USUARIO,b.DEPE_CODI HID_DEPE_USUA,
			 						count(r.RADI_NUME_RADI) RADICADOS
									, MIN(b.USUA_CODI) HID_COD_USUARIO
							FROM RADICADO r, USUARIO b 
							WHERE r.RADI_USUA_ACTU=b.USUA_CODI AND r.RADI_DEPE_ACTU=b.DEPE_CODI
								$condicionE	$whereTipoRadicado 
							GROUP BY b.USUA_NOMB,b.DEPE_CODI
							ORDER BY $orno $ascdesc"; 
			}
			else
			{
				$queryE = "SELECT  b.USUA_NOMB USUARIO, t.SGD_TPR_DESCRIP TIPO_DOCUMENTO, 
								count(r.RADI_NUME_RADI) RADICADOS, MIN(b.USUA_CODI)	HID_COD_USUARIO, 
								MIN(SGD_TPR_CODIGO) HID_TPR_CODIGO
							FROM RADICADO r, USUARIO b, SGD_TPR_TPDCUMENTO t
							WHERE 
								r.RADI_USUA_ACTU=b.USUA_CODI 
								AND r.tdoc_codi=t.SGD_TPR_CODIGO (+)
								AND r.RADI_DEPE_ACTU=b.DEPE_CODI
								$condicionE
								$whereTipoRadicado 
								GROUP BY b.USUA_NOMB, t.SGD_TPR_DESCRIP
							ORDER BY $orno $ascdesc"; 
			}
			/** CONSULTA PARA VER DETALLES 
	 		*/
			$condicionE = " AND b.USUA_CODI= $codUs ";

			if($tipoDocumento=='9998')
			{	$condicionE .= " AND t.SGD_TPR_CODIGO = $tipoDOCumento ";	}
			$queryEDetalle = "SELECT DISTINCT
								r.RADI_NUME_RADI RADICADO,
								TO_CHAR(r.RADI_FECH_RADI, 'DD/MM/YYYY HH24:MI:SS') FECHA_RADICACION,
								t.SGD_TPR_DESCRIP TIPO_DE_DOCUMENTO, 
								b.USUA_NOMB USUARIO_ACTUAL, 
								r.RA_ASUN ASUNTO, 
								bod.NOMBRE_DE_LA_EMPRESA ESP,
								n.par_serv_nombre SECTOR,
								(	select CAU.sgd_cau_DESCRIP
									from  sgd_dcau_causal dc, sgd_cau_causal cau
									where dc.sgd_dcau_codigo=o.sgd_dcau_codigo
									and dc.SGD_cau_codigo=cau.sgd_cau_codigo) CAUSAL,
								(	select dc.sgd_dcau_descrip
									from sgd_dcau_causal dc
									where dc.sgd_dcau_codigo=o.sgd_dcau_codigo) DETALLE_CAUSAL, 
								r.radi_usu_ante USUARIO_ANTERIOR,
								r.RADI_PATH HID_RADI_PATH{$seguridad}
							FROM RADICADO r, USUARIO b, SGD_TPR_TPDCUMENTO t, 
								bodega_empresas bod, par_serv_servicios n, sgd_caux_causales o
							WHERE 
								r.eesp_codi = bod.identificador_empresa (+)
								AND r.RADI_USUA_ACTU=b.USUA_CODI
								AND r.tdoc_codi=t.SGD_TPR_CODIGO (+)
								AND r.RADI_DEPE_ACTU=$dependencia_busq 			
								AND b.DEPE_CODI=$dependencia_busq 
								AND r.RADI_DEPE_ACTU=$dependencia_busq 
								and r.par_serv_secue=n.par_serv_codigo(+)
								and r.radi_nume_radi=o.radi_nume_radi(+) $whereTipoRadicado ";
			$orderE = "	ORDER BY $orno $ascdesc";			
				
			 /** CONSULTA PARA VER TODOS LOS DETALLES 
			 */ 
			$queryETodosDetalle = $queryEDetalle . $orderE;
			$queryEDetalle .= $condicionE . $orderE;
		}break;
	case 'mssql':
		{	// Este default trabaja con Mssql 2K, 2K5 y postgres
			if ( $dependencia_busq != 99999)
			{	$condicionE = "	AND b.DEPE_CODI=$dependencia_busq AND r.RADI_DEPE_ACTU=$dependencia_busq ";
			}
			if($tipoDocumento=='9999')
			{	$queryE = "SELECT  b.USUA_NOMB AS USUARIO, b.DEPE_CODI AS HID_DEPE_USUA,
								count($radi_nume_radi) AS RADICADOS, 
								MIN(b.USUA_CODI) AS HID_COD_USUARIO
							FROM RADICADO r, USUARIO b 
							WHERE
								r.RADI_USUA_ACTU=b.USUA_CODI AND r.RADI_DEPE_ACTU=b.DEPE_CODI
								$condicionE $whereTipoRadicado 
							GROUP BY b.USUA_NOMB,b.DEPE_CODI
							ORDER BY $orno $ascdesc"; 
			}
			else
			{	$queryE = "SELECT b.USUA_NOMB USUARIO, 
								t.SGD_TPR_DESCRIP AS TIPO_DOCUMENTO, 
								count($radi_nume_radi) AS RADICADOS, 
								MIN(b.USUA_CODI) AS HID_COD_USUARIO, 
								MIN(SGD_TPR_CODIGO) AS HID_TPR_CODIGO
							FROM RADICADO r 
								INNER JOIN USUARIO b ON r.RADI_USUA_ACTU=b.USUA_CODI AND r.RADI_DEPE_ACTU=b.DEPE_CODI  
								LEFT OUTER JOIN SGD_TPR_TPDCUMENTO t ON r.tdoc_codi=t.SGD_TPR_CODIGO
							WHERE 1=1 $condicionE $whereTipoRadicado  
							GROUP BY b.USUA_NOMB, t.SGD_TPR_DESCRIP
							ORDER BY $orno $ascdesc"; 
			}
			/** CONSULTA PARA VER DETALLES 
			 */
		
			if (!is_null($codUs))	$condicionE = " AND b.USUA_CODI= $codUs ";
			if (!is_null($tipoDOCumento))
			{	$condicionE .= " AND t.SGD_TPR_CODIGO = $tipoDOCumento ";
			}
			$queryEDetalle = "SELECT DISTINCT $radi_nume_radi AS RADICADO,
									t.SGD_TPR_DESCRIP AS TIPO_DE_DOCUMENTO, 
									b.USUA_NOMB AS USUARIO, 
									r.RA_ASUN AS ASUNTO, ".
									$db->conn->SQLDate('Y/m/d H:i:s','r.radi_fech_radi')." AS FECHA_RADICACION, 
									bod.NOMBRE_DE_LA_EMPRESA AS Entidad,
									r.RADI_PATH AS HID_RADI_PATH{$seguridad}
								FROM RADICADO r
									INNER JOIN USUARIO b ON r.RADI_USUA_ACTU=b.USUA_CODI 
									LEFT OUTER JOIN SGD_TPR_TPDCUMENTO t ON r.tdoc_codi = t.SGD_TPR_CODIGO 
									LEFT OUTER JOIN bodega_empresas bod ON r.eesp_codi = bod.identificador_empresa 
								WHERE 
									r.RADI_DEPE_ACTU=$dependencia_busq AND 
									b.DEPE_CODI=$dependencia_busq AND 
									r.RADI_DEPE_ACTU=$dependencia_busq 
									$whereTipoRadicado ";
			$orderE = "	ORDER BY $orno $ascdesc";			
						
			/** CONSULTA PARA VER TODOS LOS DETALLES 
			*/ 
			$queryETodosDetalle = $queryEDetalle . $orderE;
			$queryEDetalle .= $condicionE . $orderE;
		}break;
	case 'postgres':	
	{	if ( $dependencia_busq != 99999)
		{	$condicionE = "	b.DEPE_CODI=$dependencia_busq AND r.RADI_DEPE_ACTU=$dependencia_busq ";
		}else {
			$condicionE = "	r.radi_depe_actu=b.depe_codi";	
		}
		if($tipoDocumento=='9999')
		{	
				$queryE = "SELECT  b.USUA_NOMB 	as USUARIO,
				count($radi_nume_radi) 			as RADICADOS
				, MIN(b.USUA_CODI) 				as HID_COD_USUARIO
				FROM RADICADO r, USUARIO b 
			WHERE
				r.RADI_USUA_ACTU=b.USUA_CODI 
				AND r.RADI_DEPE_ACTU=b.DEPE_CODI AND
				$condicionE
				$whereTipoRadicado 
				GROUP BY b.USUA_NOMB
			ORDER BY $orno $ascdesc"; 
		}
		else
		{
			$queryE = "SELECT b.USUA_NOMB 		as USUARIO,
						t.SGD_TPR_DESCRIP 		as TIPO_DOCUMENTO,
						count($radi_nume_radi) 	as RADICADOS,
						MIN(b.USUA_CODI) 		as HID_COD_USUARIO, 
						MIN(SGD_TPR_CODIGO) 	as HID_TPR_CODIGO			
			FROM RADICADO r 
			INNER JOIN USUARIO b ON r.RADI_USUA_ACTU=b.USUA_CODI AND r.RADI_DEPE_ACTU=b.DEPE_CODI  
			LEFT OUTER JOIN SGD_TPR_TPDCUMENTO t ON r.tdoc_codi=t.SGD_TPR_CODIGO
			WHERE $condicionE $whereTipoRadicado  
			GROUP BY b.USUA_NOMB, t.SGD_TPR_DESCRIP
			ORDER BY $orno $ascdesc"; 
		}
		/** CONSULTA PARA VER DETALLES 
		*/

		if (!is_null($codUs))	$condicionE .= " AND b.USUA_CODI= $codUs and r.radi_usua_actu= $codUs";
		if (!is_null($tipoDOCumento))
		{	$condicionE .= " AND t.SGD_TPR_CODIGO = $tipoDOCumento ";
		}
    $redondeo="date_part('days', r.radi_fech_radi-".$db->conn->sysTimeStamp.")+floor(t.sgd_tpr_termino * 7/5)+(select count(*) from sgd_noh_nohabiles where NOH_FECHA between r.radi_fech_radi and ".$db->conn->sysTimeStamp.")";
	$queryEDetalle = "SELECT DISTINCT 
			$radi_nume_radi	as RADICADO
			,t.SGD_TPR_DESCRIP 			as TIPO_DE_DOCUMENTO
			, b.USUA_NOMB 				as USUARIO
			, r.RA_ASUN 				as ASUNTO
			, ".$db->conn->SQLDate('Y/m/d H:i:s','r.radi_fech_radi')." as FECHA_RADICACION
			, dir.SGD_DIR_NOMREMDES 	as REMITENTE
			,r.RADI_PATH 				as HID_RADI_PATH{$seguridad},
			$redondeo					as \"Dias Restantes\" 
			FROM RADICADO r
				INNER JOIN USUARIO b ON r.RADI_USUA_ACTU=b.USUA_CODI
				LEFT OUTER JOIN SGD_TPR_TPDCUMENTO t ON r.tdoc_codi = t.SGD_TPR_CODIGO 
				LEFT OUTER JOIN SGD_DIR_DRECCIONES dir ON r.radi_nume_radi = dir.radi_nume_radi
		WHERE
		  $condicionE
			$whereTipoRadicado ";
		$orderE = "	ORDER BY $orno $ascdesc";			
				
	 /** CONSULTA PARA VER TODOS LOS DETALLES 
	 */ 
	$queryETodosDetalle = $queryEDetalle . $orderE;
	$queryEDetalle .= $orderE;
		}break;
}
		
if(isset($_GET['genDetalle'])&& $_GET['denDetalle']=1)
{
	$titulos=array("#","1#RADICADO","2#FECHA RADICACION","3#TIPO DE DOCUMENTO","4#USUARIO ACTUAL","5#ASUNTO","6#ESP","7#SECTOR","8#CAUSAL","9#DETALLE CAUSAL","10#USUARIO ANTERIOR");
}
else
{
	$titulos=($tipoDocumento=='9999')?array("#","1#Usuario","2#Radicados"):array("#","1#Usuario","3#TIPO DE DOCUMENTO","2#Radicados");
}
		
function pintarEstadistica($fila,$indice,$numColumna)
{
 global $ruta_raiz,$_POST,$_GET,$krd;
 $salida="";
 switch ($numColumna)
 {
	case  0:
	 $salida=$indice;
	 break;
	case 1:	
	 $salida=$fila['USUARIO'];
	break;
	case 2:
	if(isset($fila['TIPO_DOCUMENTO']))
	{
	$salida=$fila['TIPO_DOCUMENTO']; 
	}else
	{
	 $dependecia=isset($fila['HID_DEPE_USUA'])?$fila['HID_DEPE_USUA']:$_GET['dependencia_busq'];
	 $datosEnvioDetalle="tipoEstadistica=".$_GET['tipoEstadistica']."&amp;genDetalle=1&amp;usua_doc=".urlencode($fila['HID_USUA_DOC'])."&amp;dependencia_busq=".$dependecia."&amp;fecha_ini=".$_GET['fecha_ini']."&amp;fecha_fin=".$_GET['fecha_fin']."&amp;tipoRadicado=".$_GET['tipoRadicado']."&amp;tipoDocumento=".$_GET['tipoDocumento']."&amp;codUs=".$fila['HID_COD_USUARIO']."&amp;";
	 $datosEnvioDetalle=(isset($_GET['usActivos']))?$datosEnvioDetalle."&amp;usActivos=".$_GET['usActivos']:$datosEnvioDetalle;
	 $salida="<a href=\"genEstadistica.php?{$datosEnvioDetalle}&amp;krd={$krd} \"  target=\"detallesSec\" >".$fila['RADICADOS']."</a>";
	}
	break;
	case 3:
	 $dependecia=isset($fila['HID_DEPE_USUA'])?$fila['HID_DEPE_USUA']:$_GET['dependencia_busq'];
	 $datosEnvioDetalle="tipoEstadistica=".$_GET['tipoEstadistica']."&amp;genDetalle=1&amp;usua_doc=".urlencode($fila['HID_USUA_DOC'])."&amp;dependencia_busq=".$dependecia."&amp;fecha_ini=".$_GET['fecha_ini']."&amp;fecha_fin=".$_GET['fecha_fin']."&amp;tipoRadicado=".$_GET['tipoRadicado']."&amp;tipoDocumento=".$_GET['tipoDocumento']."&amp;codUs=".$fila['HID_COD_USUARIO']."&amp;tipoDOCumento=".$fila['HID_TPR_CODIGO'];
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
			$salida="<center><a class=\"vinculos\" href=\"{$ruta_raiz}verradicado.php?verrad=".$fila['RADICADO']."&amp;".session_name()."=".session_id()."&amp;krd=".$_GET['krd']."&amp;carpeta=8&amp;nomcarpeta=Busquedas&amp;tipo_carp=0 \" >".$fila['FECHA_RADICACION']."</a></center>";
			else 
			$salida="<center><a class=\"vinculos\" href=\"#\" onclick=\"alert('ud no tiene permisos para ver el radicado'); return false;\">".$fila['FECHA_RADICACION']."</a></center>";
		break;
	case 3:
		$salida="<span class=\"leidos\">".htmlentities($fila['TIPO_DE_DOCUMENTO'])."</span>";		
		break;
	case 4:
		$salida="<span class=\"leidos\">".$fila['USUARIO_ACTUAL']."</span>";
		break;
	case 5:
		$salida="<span class=\"leidos\">".$fila['ASUNTO']."</span>";
		break;
	case 6:
		$salida="<span class=\"leidos\">".$fila['ESP']."</span>";			
		break;	
	case 7:
		$salida="<span class=\"leidos\">".$fila['SECTOR']."</span>";			
		break;	
	case 8:
		$salida="<span class=\"leidos\">".$fila['CAUSAL']."</span>";			
		break;	
	case 9:
		$salida="<span class=\"leidos\">".$fila['DETALLE_CAUSAL']."</span>";			
		break;	
	case 10:
		$salida="<span class=\"leidos\">".$fila['USUARIO_ANTERIOR']."</span>";			
		break;
		}
		return $salida;
	}	
?>
