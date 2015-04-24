<?
/*************************************************************************************/
/* ORFEO GPL:Sistema de Gestion Documental		http://www.orfeogpl.org	     */
/*	Idea Original de la SUPERINTENDENCIA DE SERVICIOS PUBLICOS DOMICILIARIOS     */
/*				COLOMBIA TEL. (57) (1) 6913005  orfeogpl@gmail.com   */
/* ===========================                                                       */
/*                                                                                   */
/* Este programa es software libre. usted puede redistribuirlo y/o modificarlo       */
/* bajo los terminos de la licencia GNU General Public publicada por                 */
/* la "Free Software Foundation"; Licencia version 2. 			             */
/*                                                                                   */
/* Copyright (c) 2005 por :	  	  	                                     */
/* SSPS "Superintendencia de Servicios Publicos Domiciliarios"                       */
/*   Jairo Hernan Losada  jlosada@gmail.com                Desarrollador             */
/*   Sixto Angel Pinzón López --- angel.pinzon@gmail.com   Desarrollador             */
/* C.R.A.  "COMISION DE REGULACION DE AGUAS Y SANEAMIENTO AMBIENTAL"                 */ 
/*   Liliana Gomez        lgomezv@gmail.com                Desarrolladora            */
/*   Lucia Ojeda          lojedaster@gmail.com             Desarrolladora            */
/* D.N.P. "Departamento Nacional de Planeación"                                      */
/*   Hollman Ladino       hladino@gmail.com                Desarrollador             */
/*                                                                                   */
/* Colocar desde esta lInea las Modificaciones Realizadas Luego de la Version 3.5    */
/*  Nombre Desarrollador   Correo     Fecha   Modificacion                           */
/*  Martha Yaneth Mera    mymera@gmail.com     2006-05-10*/
/*************************************************************************************/
?>
<?
/** CONSUTLA 001 
	* Estadiscas por procesos
	* @autor JAIRO H LOSADA - SSPD
	* @version ORFEO 3.5
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
   * 
   */
switch($db->driver)
	{
	case 'mssql':
	$isql = '';	
	break;
	case 'oracle':
	case 'oci8':
	case 'oci805':
	case 'ocipo':
	$queryE = "
	    SELECT b.USUA_NOMB USUARIO
			, count(*) TOTAL_PROCESOS
			, MIN(b.USUA_CODI) HID_COD_USUARIO
			, MIN(b.depe_codi) HID_DEPE_USUA
			, MIN(b.USUA_DOC) HID_USUA_DOC
			FROM SGD_SEXP_SECEXPEDIENTES sExp
			, USUARIO b 
		WHERE 
			sExp.usua_doc_responsable=b.usua_doc

			$whereDependencia
			$whereTipoRadicado 
			$whereAnoExp
		GROUP BY b.USUA_NOMB
		ORDER BY $orno $ascdesc";
//AND TO_CHAR(a.radi_fech_radi,'yyyy/mm/dd') BETWEEN '$fecha_ini'  AND '$fecha_fin' 
			//AND sExp.depe_codi=b.depe_codi	
 /** CONSULTA PARA VER DETALLES 
	 */
	//$condicionDep = " AND b.depe_codi = $depeUs ";
	//$condicionE = " AND b.USUA_CODI=$codUs $condicionDep ";
	
	$orderE = "	ORDER BY $orno $ascdesc";
	$whereAnoExp = ($fechaano != '') ? "AND sExp.SGD_SEXP_FECH BETWEEN TO_DATE('01/01/$fechaano','DD/MM/YYYY') AND TO_DATE('31/12/$fechaano','DD/MM/YYYY')" : '';
	if($estadoProc)
	{
		$whereEstadoProc = " AND sExp.SGD_FEXP_CODIGO=$estadoProc";
	}
	$expedienteStr = "sExp.sgd_exp_numero"; //$db->conn->Concat("'_&nbsp;&nbsp;&nbsp;&nbsp;'","sExp.sgd_exp_numero");
	$queryEDetalle = "SELECT b.USUA_NOMB USUARIO, 
				$expedienteStr Numero_Expediente,
				sExp.sgd_sexp_fech Fecha_Expediente
				,fExp.sgd_fexp_descrip Estado_Expediente
				,(select min(radi_nume_radi) 
					from sgd_exp_expediente exp 
					where exp.sgd_exp_numero = sExp.sgd_exp_numero) DAT_Primer_Radicado
				,(select count(*) from sgd_exp_expediente exp where exp.sgd_exp_numero=sExp.sgd_exp_numero) Nro_de_Radicados
			FROM SGD_SEXP_SECEXPEDIENTES sExp
				, USUARIO b 
				, SGD_FEXP_FLUJOEXPEDIENTES fExp
			WHERE 	sExp.usua_doc_responsable=b.usua_doc
				AND fExp.SGD_FEXP_CODIGO=sExp.SGD_FEXP_CODIGO
				and sExp.usua_doc_responsable='$usuaDocProc'
				$whereAnoExp
				$whereEstadoProc";
	
 /** CONSULTA PARA VER TODOS LOS DETALLES 
  * AND sExp.depe_codi=b.depe_codi
	 */ 

	$queryETodosDetalle = $queryEDetalle . $condicionDep . $orderE;
	$queryEDetalle .= $condicionE . $orderE;
	break;
	}
	//$db->conn->debug = true;
  	function pintarEstadProc($fila,$indice,$numColumna){
        	global  $ubicacion,$titulos,$ruta_raiz,$_POST,$_GET,$db,$whereAnno;
        	$salida="";
        	$usuaResponsable=$fila['HID_USUA_DOC'];
        	switch ($numColumna){
        		case  0:
        			$salida=$indice;
        			break;
        		case 1:	
        			$salida=$fila['USUARIO'];
        		break;
        		case 2:
        			$datosEnvioDetalle="tipoEstadistica=".$_POST['tipoEstadistica']."&amp;genDetalle=1&amp;usua_doc=".urlencode($fila['HID_USUA_DOC'])."&amp;dependencia_busq=".$_POST['dependencia_busq'];
	        		$datosEnvioDetalle=(isset($_POST['usActivos']))?$datosEnvioDetalle."&amp;usActivos=".$_POST['usActivos']:$datosEnvioDetalle;
	        		$datosEnvioDetalle=(isset($_POST['codus']))?$datosEnvioDetalle."&amp;codus=".$_POST['codus']:$datosEnvioDetalle;					$datosEnvioDetalle.="&amp;usuaDocProc={$usuaResponsable}";
	        		$datosEnvioDetalle=isset($_POST['codProceso']) && $_POST['codProceso']!=""?$datosEnvioDetalle."&amp;codProceso=".$_POST['codProceso']:$datosEnvioDetalle;
        			
        			
        			$salida="<a href=\"genEstadisticaProc.php?{$datosEnvioDetalle}\"  target=\"detallesSec\" >".$fila['TOTAL_PROCESOS']."</a>";
        			
        			if(isset($_POST['codProceso']) && $_POST['codProceso']!=""){
	        			$salida.="</td>";
				        $consulta="  SELECT EX.SGD_FEXP_CODIGO,FL.SGD_FEXP_ORDEN,count(*) TOTAL 
	        						FROM SGD_SEXP_SECEXPEDIENTES EX INNER JOIN SGD_FEXP_FLUJOEXPEDIENTES FL 
	        						     ON EX.SGD_PEXP_CODIGO=FL.SGD_PEXP_CODIGO  and  EX.SGD_FEXP_CODIGO=FL.SGD_FEXP_CODIGO  
	        						WHERE EX.DEPE_CODI=".$_POST['dependencia_busq']."
	        						        AND EX.SGD_PEXP_CODIGO=".$_POST['codProceso']."
	        						        AND USUA_DOC_RESPONSABLE='{$usuaResponsable}' 
	        						        {$whereAnno}
	        						GROUP BY EX.SGD_FEXP_CODIGO,FL.SGD_FEXP_ORDEN 
	        						ORDER BY FL.SGD_FEXP_ORDEN ";
	        			$anterior=3;
	        			$resultado=$db->query($consulta);
	        			$posicion=$anterior;
	        			//$datosEnvioDetalle.="&usuaDocProc={$usuaResponsable}&codProceso=".$_POST['codProceso'];
	        			while (!$resultado->EOF){
	        				$etapa=$resultado->fields['SGD_FEXP_CODIGO'];
	        				$posicion=$ubicacion[$etapa];
	        				
	        				for($i=$anterior;$i<($posicion);$i++){
	        			    	$salida.="<td><img src=\"{$ruta_raiz}imagenes/investigaciones.jpeg\" width=10 height=10  
	        			    	alt=\"Expediente en Etapa: ".$titulos[$i]." \" title=\"Expediente en Etapa: ".$titulos[$i]."\" ></td> \n";
	        			    }
	        			    
	        			    $salida.="<td><img src=\"{$ruta_raiz}imagenes/investigaciones.jpeg\" width=10 height=10  
	        			    alt=\"Expediente en Etapa: ".$titulos[$i]." \" title=\"Expediente en Etapa: ".$titulos[$i]."\">
	        			    <a href=\"genEstadisticaProc.php?{$datosEnvioDetalle}&amp;etapaProc={$etapa}\" target=\"detallesSec\">".$resultado->fields['TOTAL']."</a></td> \n";
	        			  $anterior=$posicion+1;
	        			$resultado->MoveNext();
	        			}
	        			for($i=$posicion+1;$i<((count($titulos)));$i++){
	        			    	$salida.="<td><img src=\"{$ruta_raiz}imagenes/investigaciones.jpeg\" width=10 height=10  alt=\"Expediente en Etapa: ".$titulos[$i]." \" title=\"Expediente en Etapa: ".$titulos[$i]."\" ></td> \n";
	        			    }
	        			    
	        			 $salida=substr($salida,0,-5);
        		}
        	break;
        	default: $salida=false;
        	}
        	return $salida;
        }
	function pintarEstaDetalle($fila,$indice,$numColumna){
			global $ruta_raiz,$encabezado,$krd;
			$numRadicado=$fila['DAT_PRIMER_RADICADO'];	
			switch ($numColumna){
					case 0:
						$salida=$indice;
						break;
					case 1:
						$salida=$fila['USUARIO'];
						break;
					case 2:
						$salida="<center>".$fila['NUMERO_EXPEDIENTE']."</center>";
						break;
					case 3:
						$salida="<center><a href=\"{$ruta_raiz}/verradicado.php?verrad=$numRadicado&krd=$krd&".$encabezado."\" target=\"".$numRadicado."\">".urlencode($fila['FECHA_EXPEDIENTE'])."</a></center>";		
						break;
					case 4:
						$salida=$fila['ESTADO_EXPEDIENTE'];
						break;
					case 5:
						if($fila['RADI_PATH'])
							$salida="<center><a href=\"{$ruta_raiz}/bodega/".$fila['RADI_PATH']."\">{$numRadicado}</a></center>";
						else 
							$salida="<center>{$numRadicado}</center>";	
						break;
					case 6:
						$salida=$fila['NRO_DE_RADICADOS'];			
				}
			return $salida;
		}
        
	
	
	?>
