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
	case 'mssql':
	{	if ( $dependencia_busq != 99999)
			{	$condicionE = "	AND b.DEPE_CODI=$dependencia_busq AND r.RADI_DEPE_ACTU=$dependencia_busq ";
			}
			if($tipoDocumento=='9999')
			{	$queryE = "SELECT  b.USUA_NOMB USUARIO,
					count($radi_nume_radi) RADICADOS
					, MIN(b.USUA_CODI) HID_COD_USUARIO
					FROM RADICADO r, USUARIO b 
				WHERE
					r.RADI_USUA_ACTU=b.USUA_CODI 
					AND r.RADI_DEPE_ACTU=b.DEPE_CODI
					$condicionE
					$whereTipoRadicado 
					GROUP BY b.USUA_NOMB
				ORDER BY $orno $ascdesc"; 
			}
			else
			{	$queryE = "SELECT b.USUA_NOMB USUARIO
					, t.SGD_TPR_DESCRIP TIPO_DOCUMENTO
					, count($radi_nume_radi) RADICADOS
					, MIN(b.USUA_CODI) HID_COD_USUARIO
					, MIN(SGD_TPR_CODIGO) HID_TPR_CODIGO			
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
	//if ($tipoDocumento=='9998')
	if (!is_null($tipoDOCumento))
	{	$condicionE .= " AND t.SGD_TPR_CODIGO = $tipoDOCumento ";
	}
	$queryEDetalle = "SELECT 
			$radi_nume_radi RADICADO
			,t.SGD_TPR_DESCRIP TIPO_DE_DOCUMENTO
			, b.USUA_NOMB USUARIO
			, r.RA_ASUN ASUNTO
			, ".$db->conn->SQLDate('Y/m/d H:i:s','r.radi_fech_radi')." FECHA_RADICACION
			, bod.NOMBRE_DE_LA_EMPRESA ESP
			,r.RADI_PATH HID_RADI_PATH
			FROM RADICADO r
				INNER JOIN USUARIO b ON r.RADI_USUA_ACTU=b.USUA_CODI
				LEFT OUTER JOIN SGD_TPR_TPDCUMENTO t ON r.tdoc_codi = t.SGD_TPR_CODIGO 
				LEFT OUTER JOIN bodega_empresas bod ON r.eesp_codi = bod.identificador_empresa 
		WHERE 
		 	r.RADI_DEPE_ACTU=$dependencia_busq 			
			AND b.DEPE_CODI=$dependencia_busq 
			AND r.RADI_DEPE_ACTU=$dependencia_busq 
			$whereTipoRadicado ";
		$orderE = "	ORDER BY $orno $ascdesc";			
				
	 /** CONSULTA PARA VER TODOS LOS DETALLES 
	 */ 
	$queryETodosDetalle = $queryEDetalle . $orderE;
	$queryEDetalle .= $condicionE . $orderE;
		}break;
	case 'oracle':
	case 'oci8':
	case 'oci805':
	case 'ocipo':
	if ( $dependencia_busq != 99999)  {
		$condicionE = "				AND b.DEPE_CODI=$dependencia_busq 
			AND r.RADI_DEPE_ACTU=$dependencia_busq ";
	}

	if($tipoDocumento=='9999')
	{
	$queryE = "SELECT  b.USUA_NOMB USUARIO,
			count(r.RADI_NUME_RADI) RADICADOS,
			MIN(b.USUA_CODI) HID_COD_USUARIO
			FROM RADICADO r,
			USUARIO b,
			SGD_DIR_DRECCIONES dir
		WHERE	r.RADI_USUA_ACTU=b.USUA_CODI AND 
			r.RADI_DEPE_ACTU = b.DEPE_CODI AND
			r.radi_nume_radi = dir.radi_nume_radi (+) AND 
			dir.sgd_dir_tipo = 2 AND
			".$db->conn->SQLDate('Y/m/d', 'r.radi_fech_radi')." BETWEEN '$fecha_ini' AND '$fecha_fin'
			$condicionE
			$whereTipoRadicado 
			GROUP BY b.USUA_NOMB
		ORDER BY $orno $ascdesc"; 
	}
	else
{
	$queryE = "
	    SELECT  b.USUA_NOMB USUARIO
			, t.SGD_TPR_DESCRIP TIPO_DOCUMENTO
			, count(r.RADI_NUME_RADI) RADICADOS
			, MIN(b.USUA_CODI) HID_COD_USUARIO
			, MIN(SGD_TPR_CODIGO) HID_TPR_CODIGO			
			FROM RADICADO r, USUARIO b, SGD_TPR_TPDCUMENTO t, sgd_dir_drecciones dir
		WHERE 
			r.RADI_USUA_ACTU=b.USUA_CODI 
			AND r.tdoc_codi=t.SGD_TPR_CODIGO (+)
			AND r.RADI_DEPE_ACTU=b.DEPE_CODI
			AND r.radi_nume_radi = dir.radi_nume_radi (+)
                        AND dir.sgd_dir_tipo = 2
			$condicionE
			$whereTipoRadicado 
			GROUP BY b.USUA_NOMB, t.SGD_TPR_DESCRIP
		ORDER BY $orno $ascdesc"; 
	}
	/** CONSULTA PARA VER DETALLES 
	 */
	$condicionE = " AND b.USUA_CODI= $codUs ";
	$whereCarpUsua = (!empty($codUs)) ? "car.usua_codi = $codUs AND" : "";

		if($tipoDocumento=='9998')
		{	$condicionE .= " AND t.SGD_TPR_CODIGO = $tipoDOCumento ";	}
		$queryEDetalle = "SELECT DISTINCT r.radi_nume_radi RADICADO,
			TO_CHAR(r.RADI_FECH_RADI, 'DD/MM/YYYY HH24:MI:SS') FECHA_RADICACION,
			t.SGD_TPR_DESCRIP TIPO_DE_DOCUMENTO,
			r.radi_nume_deri RAD_PADRE,
			r.RADI_CUENTAI CTA_INTERNA,
			exp.sgd_exp_numero NUMERO_EXPEDIENTE,
			car.nomb_carp CARPETA_PERSONAL,
			b.USUA_NOMB USUARIO_ACTUAL,
			r.RA_ASUN ASUNTO,
			bod.NOMBRE_DE_LA_EMPRESA ESP,
			bod.DIRECCION DIR_ESP,
			r.RADI_PATH HID_RADI_PATH,
			dir1.sgd_dir_nomremdes NOMBRE_PREDIO,
			dir1.sgd_dir_direccion DIRECCION_PREDIO,
			dep1.dpto_nomb DPTO_PREDIO,
			muni1.muni_nomb MPIO_PREDIO
                         FROM  radicado r,
			usuario b,
			sgd_tpr_tpdcumento t,
			bodega_empresas bod,
			par_serv_servicios n,
			sgd_caux_causales o,
			carpeta_per car,
			sgd_exp_expediente exp,
			sgd_dir_drecciones dir1,
			sgd_dir_drecciones dir2,
			departamento dep1,
			departamento dep2,
			municipio muni1,
			municipio muni2
                         WHERE r.eesp_codi = bod.identificador_empresa (+) AND
			r.RADI_USUA_ACTU = b.USUA_CODI AND
			r.tdoc_codi = t.SGD_TPR_CODIGO (+) AND
			r.RADI_DEPE_ACTU = $dependencia_busq AND
			b.DEPE_CODI = $dependencia_busq AND
			car.depe_codi = $dependencia_busq AND
			$whereCarpUsua
			r.par_serv_secue = n.par_serv_codigo(+) AND
			r.radi_nume_radi = o.radi_nume_radi(+) AND
			car.codi_carp(+) = r.carp_codi AND
			r.radi_nume_radi = exp.radi_nume_radi(+) AND
			r.eesp_codi = bod.identificador_empresa (+) AND
			r.radi_nume_radi = dir1.radi_nume_radi (+) AND
			r.radi_nume_radi = dir2.radi_nume_radi (+) AND
			dir1.sgd_dir_tipo = 2 AND
			dir1.dpto_codi = dep1.dpto_codi AND
			dir2.dpto_codi = dep2.dpto_codi AND
                               dir1.muni_codi = muni1.muni_codi AND
			dir2.muni_codi = muni2.muni_codi AND
	                       dir1.dpto_codi = muni1.dpto_codi AND
			dir2.dpto_codi = muni2.dpto_codi
			$whereTipoRadicado";
			$orderE = "ORDER BY $orno $ascdesc";
			// Consulta para ver todos los detalles  
			$queryETodosDetalle = $queryEDetalle . $orderE;
			$queryEDetalle .= $condicionE . $orderE;
	break;
	}
if(isset($_GET['genDetalle'])&& $_GET['denDetalle']==1){ 
                $titulos=array("#","1#RADICADO","2#FECHA RADICACION","3#TIPO DOCUMENTO ","4#RAD PADRE","5#CTA INTERNA","6#NUMERO EXPEDIENTE","7#CARPETA PERSONAL","8#USUARIO ACTUAL","9#ASUNTO","10#ESP","11#DIR ESP","12#NOMBRE PERDIO","13#DIRECCION PREDIO","14#DEPTO PREDIO","MPIO PREDIO");
        }else{           
                $titulos=("#","1#USUARIO","2#RADICADO");
} 

function pintarEstadisticaDetalle($fila,$indice,$numColumna)
{
	global $ruta_raiz,$encabezado,$krd;
	$verImg=($fila['SGD_SPUB_CODIGO']==1)?($fila['USUARIO']!=$_SESSION['usua_nomb']?false:true):($fila['USUA_NIVEL']>$_SESSION['nivelus']?false:true);
	$verImg=$verImg&&($fila['SGD_EXP_PRIVADO']!=1);
	$numRadicado=$fila['RADICADO'];
	switch ($numColumna)
	{
		case 0:
			$salida=$indice;
			break;
		case 1:
			$salida=$salida="<center class=\"leidos\">".$numRadicado."</center>";
			break;
		case 2:
			$salida="<center class=\"leidos\">".$fila['FECHA_RADICACION']."</center>";
			break;
		case 3:
			$salida="<center class=\"leidos\">".$fila['TIPO_DE_DOCUMENTO']."</center>";
			break;
		case 4:
			$salida="<center class=\"leidos\">".$fila['RAD_PADRE']."</center>";
			break;
		case 5:
			$salida="<center class=\"leidos\">".$fila['CTA_INTERNA']."</center>";
			break;
		case 6:
			$salida="<center class=\"leidos\">".$fila['NUMERO_EXPEDIENTE']."</center>";
			break;
		case 7:
			$salida="<center class=\"leidos\">".$fila['CARPETA_PERSONAL']."</center>";
			break;
		case 8:
			$salida="<center class=\"leidos\">".$fila['USUARIO_ACTUAL']."</center>";
			break;
		case 9:
			$salida="<center class=\"leidos\">".$fila['ASUNTO']."</center>";
			break;
		case 10:
			$salida="<center class=\"leidos\">".$fila['ESP']."</center>";
			break;
		case 11:
			$salida="<center class=\"leidos\">".$fila['DIR_ESP']."</center>";
			break;	                       
		case 12:
			$salida="<center class=\"leidos\">".$fila['NOMBRE_PREDIO']."</center>";
			break;
		case 13:
			$salida="<center class=\"leidos\">".$fila['DIRECCION_PREDIO']."</center>";
			break;
		case 14:
			$salida="<center class=\"leidos\">".$fila['DPTO_PREDIO']."</center>";
			break;
		case 15:
			$salida="<center class=\"leidos\">".$fila['MPIO_PREDIO']."</center>";
	}
	return $salida;
}

?>
