<?
$sqlFecha = $db->conn->SQLDate("Y-M-d h:i A","SGD_ARCHIVO_FECH");
	switch($db->driver)
	{
	case 'mssql':
	case 'oracle':
	case 'oci8':
	case 'postgres':
		$sql="select SGD_ARCHIVO_RAD AS RADICADO,$sqlFecha AS FECHA_RADICADO, SGD_ARCHIVO_ORDEN AS NRO_ORDEN,SGD_ARCHIVO_FECHAI AS FECHA_INICIAL,SGD_ARCHIVO_FECHAF AS FECHA_FINAL,
		SGD_ARCHIVO_YEAR AS VIGENCIA,SGD_ARCHIVO_DEPE AS DEPENDENCIA,SGD_ARCHIVO_DEMANDANTE AS QUERELLANTE_O_CONTRATISTA,SGD_ARCHIVO_DEMANDADO AS QUERELLADO_O_OBJETO,
		SGD_ARCHIVO_CC_DEMANDANTE AS DOCUMENTO_DE_IDENTIDAD,SGD_ARCHIVO_DOCU2 AS DOCUMENTO_QUERELLADO,SGD_ARCHIVO_DIR AS DIRECCION,
		SGD_ARCHIVO_SRD AS SERIE,SGD_ARCHIVO_SBRD AS SUBSERIE,SGD_ARCHIVO_PROC AS TIPO,
		SGD_ARCHIVO_FOLIOS AS FOLIOS,SGD_ARCHIVO_ZONA AS ZONA,SGD_ARCHIVO_CARRO AS CARRO,SGD_ARCHIVO_CARA AS CARA,
		SGD_ARCHIVO_ESTANTE AS ESTANTE,SGD_ARCHIVO_ENTREPANO AS ENTREPANO,SGD_ARCHIVO_CAJA AS CAJA,SGD_ARCHIVO_CAJA2 AS CAJA_HASTA,SGD_ARCHIVO_UNIDOCU AS UNIDAD_DOCUMENTAL,
		SGD_ARCHIVO_NCARP AS NRO_CARPETAS,SGD_ARCHIVO_ANEXO AS OBSERVACIONES,SGD_ARCHIVO_INDER AS INDICADORES_DE_DETERIORO,
		SGD_ARCHIVO_MATA AS MATERIAL_INSERTADO,SGD_ARCHIVO_FECHAA AS AUTO,SGD_ARCHIVO_PRESTAMO AS PRESTAMO,SGD_ARCHIVO_FUNPREST AS FUNCIONARIO_PRESTAMO,
			SGD_ARCHIVO_FECHPRESTF AS FECHA_ENTREGA_PRESTAMO
			from SGD_ARCHIVO_CENTRAL where sgd_archivo_rad like '%C' $c $srds $d $sbrds $ef $pross $b $r $a $x $f $zon $g $carro $i $cara $h $estan $v $entre $t $caja $k $orden $l $depe $j $fecha $w $fecha2 $wq $fecha3 $n $deman $m $demant $o $docu $p $inder $q $mata $pt $pst $fta $fea $tic $ti $an $anex and SGD_ARCHIVO_ID !=0 $orde";

	$sqla="select usua_admin_archivo from usuario where usua_login like '$krd'";

 	$sql1="select SGD_EIT_NOMBRE from SGD_EIT_ITEMS where SGD_EIT_COD_PADRE like '$buscar_zona' order by SGD_EIT_NOMBRE";
	$sql6="select SGD_EIT_NOMBRE from SGD_EIT_ITEMS where SGD_EIT_COD_PADRE like '$buscar_ufisica' order by SGD_EIT_NOMBRE";
	$sql7="select SGD_EIT_NOMBRE from SGD_EIT_ITEMS where SGD_EIT_COD_PADRE like '$buscar_estan' order by SGD_EIT_NOMBRE";
	$sql8="select SGD_EIT_NOMBRE from SGD_EIT_ITEMS where SGD_EIT_COD_PADRE like '$buscar_entre' order by SGD_EIT_NOMBRE";
	$sql9="select SGD_EIT_NOMBRE from SGD_EIT_ITEMS where SGD_EIT_COD_PADRE like '$buscar_caja' order by SGD_EIT_NOMBRE";
 	$sql2="select SGD_EIT_SIGLA from SGD_EIT_ITEMS where SGD_EIT_CODIGO like '$caja1'";
 	$sql3="select SGD_EIT_SIGLA from SGD_EIT_ITEMS where SGD_EIT_CODIGO like '$estante1'";
 	$sql4="select SGD_EIT_SIGLA from SGD_EIT_ITEMS where SGD_EIT_CODIGO like '$piso1'";
 	$sql5="select SGD_EIT_SIGLA from SGD_EIT_ITEMS where SGD_EIT_CODIGO like '$archiva1'";
	$sql10="select SGD_EIT_SIGLA from SGD_EIT_ITEMS where SGD_EIT_CODIGO like '$carro1'";
	$sql11="select SGD_EIT_SIGLA from SGD_EIT_ITEMS where SGD_EIT_CODIGO like '$entrepa1'";
	break;
	}
/*function pintarEstadistica($fila,$indice,$numColumna){
        	global $ruta_raiz,$_POST,$_GET;
        	$salida="";
        	switch ($numColumna){
        		case  0:
        			$salida="<a href=\"insertar_central.php?".session_name()."=".session_id()."&krd=".$krd."&fechah=".$fechah."&$orno&adodb_next_page&edi=1&rad=".$fila['RADICADO']."\" >".$fila['RADICADO']."</a>";
        			break;
        		case 1:	
				$salida="<a href=\"verHistoricoArch.php?".session_name()."=".session_id()."&krd=".$krd."&fechah=".$fechah."&$orno&adodb_next_page&rad=".$fila['RADICADO']."\" >".$fila['FECHA_RADICADO']."</a>";
				break;
        		case 2:
        			$salida=$fila['NRO'];
			break;
			case 3:
        			$salida=$fila['FECHA_INICIAL'];
			break;
			case 4:
        			$salida=$fila['FECHA_FINAL'];
			break;
			case 5:
        			$salida=$fila['YEAR'];
			break;
			case 6:
        			$salida=$fila['DEPENDENCIA'];
			break;
			case 7:
        			$salida=$fila['QUERELLANTE'];
			break;
			case 8:
        			$salida=$fila['QUERELLADO'];
			break;
			case 9:
        			$salida=$fila['DOCUMENTO_DE_IDENTIDAD'];
			break;
			case 10:
        			$salida=$fila['SERIE'];
			break;
			case 11:
        			$salida=$fila['SUBSERIE'];
			break;
			case 12:
        			$salida=$fila['TIPO'];
			break;
			case 13:
        			$salida=$fila['FOLIOS'];
			break;
			case 14:
        			$salida=$fila['ZONA'];
			break;
			case 15:
        			$salida=$fila['CARRO'];
			break;
			case 16:
        			$salida=$fila['CARA'];
			break;
			case 17:
        			$salida=$fila['ESTANTE'];
			break;
			case 18:
        			$salida=$fila['ENTREPANO'];
			break;
			case 19:
        			$salida=$fila['CAJA'];
			break;
			case 20:
        			$salida=$fila['UNIDAD_DOCUMENTAL'];
			break;
			case 21:
        			$salida=$fila['NRO_CARPETAS'];
			break;
			case 22:
        			$salida=$fila['OBSERVACIONES'];
			break;
			case 23:
        			$salida=$fila['INDICADORES_DE_DETERIORO'];
			break;
			case 24:
        			$salida=$fila['MATERIAL_AGREGADO'];
			break;
			case 25:
        			$salida=$fila['AUTO'];
			break;
			case 26:
        			$salida=$fila['PRESTAMO'];
			break;
			case 27:
        			$salida=$fila['FUNCIONARIO_PRESTAMO'];
			break;
			case 28:
        			$salida=$fila['FECHA_ENTREGA_PRESTAMO'];
			break;
			
			
        	default: $salida=false;
        	}
        	return $salida;
        }
function pintarEstadisticaDetalle($fila,$indice,$numColumna){
			global $ruta_raiz,$_POST,$_GET;
        	$salida="";
        	switch ($numColumna){
        		case  0:
        			$salida="<a href=\"'insertar_central.php?".session_name()."=".session_id()."&krd=".$krd."&fechah=".$fechah."&$orno&adodb_next_page&edi=1&rad=".$fila['RADICADO']."\" >".$fila['RADICADO']."</a>";
        			break;
        		case 1:	
				$salida="<a href=\"verHistoricoArch.php?".session_name()."=".session_id()."&krd=".$krd."&fechah=".$fechah."&$orno&adodb_next_page&rad=".$fila['RADICADO']."\" >".$fila['FECHA_RADICADO']."</a>";
				break;
        		case 2:
        			$salida=$fila['NRO'];
			break;
			case 3:
        			$salida=$fila['FECHA_INICIAL'];
			break;
			case 4:
        			$salida=$fila['FECHA_FINAL'];
			break;
			case 5:
        			$salida=$fila['YEAR'];
			break;
			case 6:
        			$salida=$fila['DEPENDENCIA'];
			break;
			case 7:
        			$salida=$fila['QUERELLANTE'];
			break;
			case 8:
        			$salida=$fila['QUERELLADO'];
			break;
			case 9:
        			$salida=$fila['DOCUMENTO_DE_IDENTIDAD'];
			break;
			case 10:
        			$salida=$fila['SERIE'];
			break;
			case 11:
        			$salida=$fila['SUBSERIE'];
			break;
			case 12:
        			$salida=$fila['TIPO'];
			break;
			case 13:
        			$salida=$fila['FOLIOS'];
			break;
			case 14:
        			$salida=$fila['ZONA'];
			break;
			case 15:
        			$salida=$fila['CARRO'];
			break;
			case 16:
        			$salida=$fila['CARA'];
			break;
			case 17:
        			$salida=$fila['ESTANTE'];
			break;
			case 18:
        			$salida=$fila['ENTREPANO'];
			break;
			case 19:
        			$salida=$fila['CAJA'];
			break;
			case 20:
        			$salida=$fila['UNIDAD_DOCUMENTAL'];
			break;
			case 21:
        			$salida=$fila['NRO_CARPETAS'];
			break;
			case 22:
        			$salida=$fila['OBSERVACIONES'];
			break;
			case 23:
        			$salida=$fila['INDICADORES_DE_DETERIORO'];
			break;
			case 24:
        			$salida=$fila['MATERIAL_AGREGADO'];
			break;
			case 25:
        			$salida=$fila['AUTO'];
			break;
			case 26:
        			$salida=$fila['PRESTAMO'];
			break;
			case 27:
        			$salida=$fila['FUNCIONARIO_PRESTAMO'];
			break;
			case 28:
        			$salida=$fila['FECHA_ENTREGA_PRESTAMO'];
			break;
			
			default: $salida=false;
        	}
        	return $salida;
		}*/
?>