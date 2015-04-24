<?php
include_once('dataCommon.php');
	/*
	 * dataCommon.php comparte los datos mas relevantes y los 
	 * objetos mas utilizados como session,adodb, etc.
	 */
	
	$mensaje1		= "No se cambio el el tema para el radicado ";
	$mensaje2		= "Se agregaron los temas a los radicados ";	
	$mensaje3		= "No se grabaron los radicados ";
	$mensaje4		= "No se guardo el registro en el historico";
	
	$observa = "Se inserto el tema seleccionado ";	
	
	if($cambExiSecTem == 555){
		$radSinTemaSec	.= ', '.$radcontemaSec;
	} 	
	
	$radicados	= explode(",",$radSinTemaSec);	
	
	$tema		= empty($selectTema)? $autoTemaSect : $selectTema; 

	foreach ($radicados as $value){
		
		$sqlBus 	= "	SELECT
							COUNT(1) AS TOTAL
						FROM 
							SGD_CAUX_CAUSALES SE
						WHERE 
							SE.RADI_NUME_RADI 		= $value
						    AND SE.SGD_DCAU_CODIGO 	= $tema";

		$salida = $db->conn->Execute($sqlBus);				
		
		//Si ya esta no realize la accion
		if($salida->fields["TOTAL"]==0){
			
			$codNuevo = "	SELECT(SGD_CAUX_CODIGO + 1) as NEXT_CODIGO
	                		FROM 
								SGD_CAUX_CAUSALES 
							ORDER BY SGD_CAUX_CODIGO DESC";
							
			$rscodNuevo = $db->conn->Execute($codNuevo);
			
			$nextCauxCodigo = $rscodNuevo->fields["NEXT_CODIGO"];
			
			//Guarda el registro en la tabla que 
			//relacion radicado tema		
			$queryGrabar	= "	INSERT INTO SGD_CAUX_CAUSALES(											
	                                        RADI_NUME_RADI,
											SGD_DCAU_CODIGO,
											SGD_CAUX_FECHA,
											USUA_DOC,
											SGD_CAUX_CODIGO)
								VALUES(
									$value,
									$tema,								
									$sqlFechaHoy,    							
									'$usua_doc',
									$nextCauxCodigo)";
						
			if ($db->conn->Execute($queryGrabar) === false) {
				//retornamos el resultado
				$error	= empty($error)? $value : ', '.$value;			
			}else{
				$correc[]	= $value;	
			}
		}
	}
 
 	$radiModi  = $Historico->insertarHistorico(	$correc,
                                                $depenUsua,
                                                $codusuario,
                                                $depenUsua,
                                                $codusuario,
                                                $observa,
                                                17);	
 
 	if (empty($radiModi)){
 		$accion= array( 'respuesta' => false,
						'mensaje'	=> $mensaje2.'\n'.$mensaje4); 	
 	}
 
 	if(empty($error)){
 		$accion= array( 'respuesta' => true,
						'mensaje'	=> $mensaje2); 		
 	}else{
		$accion= array( 'respuesta' => false,
						'mensaje'	=> $mensaje3 . $error);
	}			
	
	print_r(json_encode($accion));		
?>