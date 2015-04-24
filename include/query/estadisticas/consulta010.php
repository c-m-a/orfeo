<?php
/*********************************************************************************
 *       Filename: Reporte Asignacion de Radicados
 *		 @autor LUCIA OJEDA ACOSTA - CRA
 *		 @version ORFEO 3.5
 *       PHP 4.0 build 22-Feb-2006
 * 
 * Optimizado por HLP. En este archivo trat�de generar las sentencias a est�dar de ADODB para que puediesen ejecutar
 * en cualquier BD. En caso de no llegar a funcionar mover el contenido en tre las l�eas 26 y 75 a la secci� MSSQL y 
 * descomentariar el switch. Modificado idrd para BD Postgres 
 *
 *********************************************************************************/

$coltp3Esp = '"'.$tip3Nombre[3][2].'"';	
if(!$orno) $orno=1;
$orderE = "	ORDER BY $orno $ascdesc ";

$desde = $fecha_ini . " ". "00:00:00";
$hasta = $fecha_fin . " ". "23:59:59";

$sWhereFec =  " and ".$db->conn->SQLDate('Y/m/d H:i:s', 'R.RADI_FECH_RADI')." >= '$desde'
				and ".$db->conn->SQLDate('Y/m/d H:i:s', 'R.RADI_FECH_RADI')." <= '$hasta'";

if ( $dependencia_busq != 99999)  $condicionE = " AND d.depe_codi=$dependencia_busq ";

if($tipoDocumento=='9999')
{	$queryE = "
		SELECT count(r.radi_nume_radi) as  Asignados
		FROM dependencia d, hist_eventos h, radicado r
		WHERE h.sgd_ttr_codigo = '9' 
			AND r.radi_nume_radi LIKE '%2'
			AND r.radi_nume_radi = h.radi_nume_radi 
			and d.depe_codi= h.depe_codi
			$condicionE $sWhereFec 
		GROUP BY d.depe_codi";
}
else
{	if($tipoDocumento!='9998')	$condicionE .= " AND t.SGD_TPR_CODIGO = $tipoDocumento ";
	$queryE = "
		SELECT MIN(t.sgd_tpr_descrip) 	as TIPO, 
			count(r.radi_nume_radi) as Asignados, 
			SGD_TPR_CODIGO 		as HID_TPR_CODIGO
		FROM dependencia d, hist_eventos h, radicado r, sgd_tpr_tpdcumento t
		WHERE h.sgd_ttr_codigo = '9' 
			AND r.radi_nume_radi LIKE '%2'
			AND r.radi_nume_radi = h.radi_nume_radi 
			AND r.tdoc_codi = t.sgd_tpr_codigo 
			and d.depe_codi= h.depe_codi
			$sWhereFec $condicionE
		GROUP BY t.sgd_tpr_codigo";
}
//-------------------------------
// Assemble full SQL statement
//-------------------------------

/** CONSULTA PARA VER DETALLES 
*/
$condicionE = "";
if($tipoDocumento!='9999')	$condicionE = " AND t.SGD_TPR_CODIGO = $tipoDOCumento "; 
if(!is_null($tipoDOCumento))	$condicionE = " AND t.SGD_TPR_CODIGO = $tipoDOCumento "; 
if(!$tipoDOCumento)  $condicionE = " "; 
$redondeo="date_part('days', r.radi_fech_radi-".$db->conn->sysTimeStamp.")+floor(t.sgd_tpr_termino * 7/5)+(select count(*) from sgd_noh_nohabiles where NOH_FECHA between r.radi_fech_radi and ".$db->conn->sysTimeStamp.")";



if ($dependencia_busq != 99999)  $condicionE .= " and h.depe_codi =$dependencia_busq ";
		
$queryEDetalle = "
	SELECT r.radi_nume_radi 	as	RADICADO, 
		r.radi_fech_radi 	as FECH_RAD, 
		".$redondeo." as DIAS_RESTANTES, 
		r.radi_depe_actu as DEPE_ACTU, 
		t.sgd_tpr_descrip 	as TIPO,
		r.RADI_PATH 		as HID_RADI_PATH
		{$seguridad}
	FROM hist_eventos h, radicado r, sgd_tpr_tpdcumento t, USUARIO B
	WHERE h.sgd_ttr_codigo = '9' 
		AND r.radi_nume_radi LIKE '%2'
		AND r.radi_nume_radi = h.radi_nume_radi 
		AND r.tdoc_codi = t.sgd_tpr_codigo
		AND r.radi_usua_actu=b.usua_codi 
		AND r.radi_depe_actu=b.depe_codi 
		AND r.TDOC_CODI=t.SGD_TPR_CODIGO
		$sWhereFec";
$queryE .= $orderE;
$queryEDetalle .= $condicionE . $orderE;

	
if(isset($_GET['genDetalle'])&& $_GET['denDetalle']=1)
{
	$titulos=array("#","1#RADICADO","2#FECHA RADICACION","3#TIPO", "4#DIAS RESTANTES");
}
else
{
	$titulos=($tipoDocumento=='9999')?array("#","1#ASIGNADOS"):array("#","1#TIPO","2#ASIGNADOS");
}
		
function pintarEstadistica($fila,$indice,$numColumna){
        	global $ruta_raiz,$_POST,$_GET,$krd;
        	$numColumna=isset($fila['TIPO'])?$numColumna:2;
        	$salida="";
        	switch ($numColumna){
        		case  0:
        			$salida=$indice;
        			break;
        		case 1:	
        			$salida=$fila['TIPO'];
        		break;
        		case 2:
        			$datosEnvioDetalle="tipoEstadistica=".$_GET['tipoEstadistica']."&amp;genDetalle=1&amp;usua_doc=".urlencode($fila['HID_USUA_DOC'])."&amp;dependencia_busq=".$_GET['dependencia_busq']."&amp;fecha_ini=".$_GET['fecha_ini']."&amp;fecha_fin=".$_GET['fecha_fin']."&amp;tipoRadicado=".$_GET['tipoRadicado']."&amp;tipoDocumento=".$_GET['tipoDocumento']."&amp;codUs=".$fila['HID_COD_USUARIO']."&amp;&tipoDOCumento=".$fila['HID_TPR_CODIGO'];
	        		$datosEnvioDetalle=(isset($_GET['usActivos']))?$datosEnvioDetalle."&amp;usActivos=".$_GET['usActivos']:$datosEnvioDetalle;
	        		$salida="<a href=\"genEstadistica.php?{$datosEnvioDetalle}&amp;krd={$krd}\"  target=\"detallesSec\" >".$fila['ASIGNADOS']."</a>";       	break;
        	break;
        	}
        	return $salida;
        }
function pintarEstadisticaDetalle($fila,$indice,$numColumna)
{
	global $ruta_raiz,$encabezado,$krd;
	$verImg=($fila['SGD_SPUB_CODIGO']==1)?($fila['USUARIO']!=$_SESSION['usua_nomb']?false:true):($fila['USUA_NIVEL']>$_SESSION['nivelus']?false:true);
	$numRadicado=$fila['RADICADO'];	
	switch ($numColumna)
	{	case 0:
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
				$salida="<a class=\"vinculos\" href=\"{$ruta_raiz}verradicado.php?verrad=".$fila['RADICADO']."&amp;".session_name()."=".session_id()."&amp;krd=".$_GET['krd']."&amp;carpeta=8&amp;nomcarpeta=Busquedas&amp;tipo_carp=0 \" >".$fila['FECH_RAD']."</a>";
			else 
				$salida="<a class=\"vinculos\" href=\"#\" onclick=\"alert(\"ud no tiene permisos para ver el radicado\");\">".$fila['FECH_RAD']."</a>";
			break;
		case 3:
			$salida="<center class=\"leidos\">".$fila['TIPO']."</center>";
			break;
		case 4:
			if($fila['DEPE_ACTU']!=999)
				$salida="<center class=\"leidos\">".$fila['DIAS_RESTANTES']."</center>";		
			else 
				$salida="<center class=\"leidos\">Sal</center>";
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
		{	$sWhereFec =  " and R.RADI_FECH_RADI >= to_date('" . $desde . "','yyyy/mm/dd HH24:MI:ss')
    			    		and R.RADI_FECH_RADI <= to_date('" . $hasta . "','yyyy/mm/dd HH24:MI:ss')";
			if ( $dependencia_busq != 99999)  $condicionE = "	AND d.depe_codi=$dependencia_busq ";
			if($tipoDocumento=='9999')
			{	$queryE = "
					SELECT count(r.radi_nume_radi) 	as Asignados
					FROM dependencia d, hist_eventos h, radicado r
					WHERE hist_obse = 'Rad.' 
						AND r.radi_nume_radi LIKE '%2'
						AND r.radi_nume_radi = h.radi_nume_radi 
						AND substr(h.usua_codi_dest,1,3) = d.depe_codi 
						$condicionE $sWhereFec 
					GROUP BY d.depe_codi";
	
			}
			else
			{	if($tipoDocumento!='9998')	$condicionE .= " AND t.SGD_TPR_CODIGO = $tipoDocumento ";
				$queryE = "
					SELECT MIN(t.sgd_tpr_descrip)	as TIPO, 
						count(r.radi_nume_radi) as Asignados, 
						SGD_TPR_CODIGO as		HID_TPR_CODIGO
					FROM dependencia d, hist_eventos h, radicado r, sgd_tpr_tpdcumento t
					WHERE h.hist_obse = 'Rad.' 
						AND r.radi_nume_radi LIKE '%2'
						AND r.radi_nume_radi = h.radi_nume_radi 
						AND substr(h.usua_codi_dest,1,3) = d.depe_codi
						AND r.tdoc_codi = t.sgd_tpr_codigo 
						$sWhereFec $condicionE
					GROUP BY t.sgd_tpr_codigo";
			}
			//-------------------------------
			// Assemble full SQL statement
			//-------------------------------
		
			// CONSULTA PARA VER DETALLES 
			$condicionE = "";
			if($tipoDocumento!='9999')	$condicionE = " AND t.SGD_TPR_CODIGO = $tipoDOCumento "; 
			if ($dependencia_busq != 99999)  $condicionE .= " AND substr(h.usua_codi_dest,1,3)=$dependencia_busq ";
		
			$queryEDetalle = "
				SELECT r.radi_nume_radi as 	RADICADO, 
					r.radi_fech_radi as 		FECH_RAD, 
					t.sgd_tpr_descrip as		TIPO,
					r.RADI_PATH 			HID_RADI_PATH
				FROM hist_eventos h, radicado r, sgd_tpr_tpdcumento t
				WHERE h.hist_obse = 'Rad.' 
					AND r.radi_nume_radi LIKE '%2'
					AND r.radi_nume_radi = h.radi_nume_radi 
					AND r.tdoc_codi = t.sgd_tpr_codigo
					$sWhereFec";
			$queryE .= $orderE;
			$queryEDetalle .= $condicionE . $orderE;
		}break;
}
*/
?>
