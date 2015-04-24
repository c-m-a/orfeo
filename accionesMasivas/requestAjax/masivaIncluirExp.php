<?php
include_once('dataCommon.php');
	/*
	 * dataCommon.php comparte los datos mas relevantes y los 
	 * objetos mas utilizados como session,adodb, etc.
	 */
		 
	$mensaje5		= "El expediente esta inactivo o no existe";
	$mensaje10		= "Incluir radicado en Expediente - Masiva";//Mensaje de informacion
	$mensaje4 		= "No se inserto ningun radicado en el expediente";//Mensaje de informacion
					
	/** Incluir radicados a un expediente.
	 *  Se verficia si en el arreglo enviado existe radicados 
	 *  incluidos en un expediente, y se incluyen los que no.
	 */	
	 
	if (empty($nomb_Expe_search))
		return;
							
	$nomb_Expe_search = trim(strValido($nomb_Expe_search));
	
	$var1 			= strspn($nomb_Expe_search, "1234567890eE");			
	$nuExpediente 	= trim(substr($nomb_Expe_search, 0, $var1));
	
	//Si el usuario quiere incluir a los subRadicados hijos
	if($cambExiTrd == 444){
		$radicados	.= ','.$rad_hijos;	
	} 
	$error		=$radicados;
	$radicados	= explode(",",$radicados);
	$radicados 	= array_filter($radicados);
	
	$sqlBus 	= "	SELECT 
						COUNT(1) AS TOTAL
					FROM
						SGD_SEXP_SECEXPEDIENTES SE
					WHERE
						SE.SGD_EXP_NUMERO     like  '$nuExpediente'
						AND SE.SGD_SEXP_ESTADO = 0";

	$salida = $db->conn->Execute($sqlBus);
			
	if(!$salida->EOF){					
		if($salida->fields["TOTAL"]==0){
			salirError($mensaje5);
			return;
		}
	}
				
    foreach ($radicados as $actual){    	
		// Consulta si el radicado esta incluido en el expediente.	
		
		$sqlCon = "	SELECT 
						COUNT(1) AS TOTAL
					FROM 
						SGD_EXP_EXPEDIENTE SE
					WHERE 
						SE.SGD_EXP_NUMERO like '$nuExpediente'
      					AND SE.RADI_NUME_RADI = $actual";
		
		$existeEnExp = $db->conn->Execute($sqlCon);
		
		$cant = $existeEnExp->fields["TOTAL"];
		
        if (empty($cant)){                    
            $saliExp = $expediente->insertar_expediente(
														$nuExpediente
														,$actual
														,$depenUsua
														,$codusuario
														,$usua_doc);
		};
		
		if (!empty($saliExp)){
			$rad_histo[]	= $actual;
            $rad_gragados 	.= empty($rad_gragados)? $actual : ",$actual";
        }elseif(empty($saliExp) || empty($cant)){
            $rad_error 		.= empty($rad_error)? $actual : ",$actual";
        }
    }
	
	//si existen algun radicado grabado lo registramos
	//en el historico
	
	if(!empty($rad_histo)){
		$observa = $mensaje10;                    
        $tipoTx = 53;			
        $Historico->insertarHistoricoExp($nuExpediente
        								,$rad_histo
        								,$depenUsua
        								,$codusuario
        								,$observa
        								,$tipoTx
                						,0);
		//retornamos el resultado
		$accion= array( 'respuesta' => true,
						'mensaje'	=> $rad_gragados.' ',
						'existen' 	=> $rad_error.' ');				
	}else{
		//retornamos el resultado
		$accion= array( 'respuesta' => false,
						'mensaje'	=> $mensaje4.' ',
						'existen' 	=> $error);
	}	
	
	print_r(json_encode($accion));		
?>
