<?php
include_once('dataCommon.php');
	/*
	 * dataCommon.php comparte los datos mas relevantes y los 
	 * objetos mas utilizados como session,adodb, etc.
	 */
			 
	$mensaje4 		= "No se realizo la solicitud";//Mensaje de informacion
					
	/** 
	 * Solicitar prestados documentos de manera masiva.
	 */	
	 
	if (empty($radLibre))
		return;	
	
	//Datos enviados desde el formulario
	$radicad		= explode(",",$radLibre);
		
	foreach ($radicad as $radi_nume){
		
		// Obtiene la ubicacion fisica de los documentos
		// Esta seccion se toma igual como esta en solicitar/reservas.php ln 110
		
		$depenRad	= substr($radi_nume,4,3);	
		
		$sqlCon		="	SELECT 
							UBIC_DEPE_ARCH
						FROM 
							UBICACION_FISICA
						WHERE 
							UBIC_DEPE_RADI = $depenRad"; 
		
		$rs 		= $db->conn->Execute($sqlCon);
		
		$depenArch 	= $rs->fields['UBIC_DEPE_ARCH'];	
			
		$idPres		= "	UPDATE
							SEC_PRESTAMO 
						with (tablock, holdlock) 
						set id = id + 1";
		
		$db->conn->Execute($idPres);
	
		$consec 	= $db->conn->nextId('SEC_PRESTAMO');
			
		$sqlIns		= "	INSERT INTO 
							PRESTAMO(
				                   PRES_ID
				                 , RADI_NUME_RADI
				                 , USUA_LOGIN_ACTU
				                 , DEPE_CODI
				                 , PRES_FECH_PEDI
				                 , PRES_DEPE_ARCH
				                 , PRES_ESTADO
				                 , PRES_REQUERIMIENTO
				                 , USUA_DOC)
				
					    	VALUES (
					               $consec
					             , $radi_nume
					             , '$login'
					             , $depenUsua
					             , (GetDate()+0)
					             , $depenArch
					             , 1
					             , 3
					             , '$usua_doc')";
			
		$result 	= $db->conn->Execute($sqlIns);

		if(empty($result->EOF)) {
			$rad_error 		.= empty($rad_error)? $radi_nume : ",$radi_nume";						
      	}else{
      		$rad_histo[]	= $radi_nume;
            $rad_gragados 	.= empty($rad_gragados)? $radi_nume : ",$radi_nume";
      	}
		
	};
	
    	
	//si existen algun radicado grabado lo registramos
	//en el historico
	
	if(!empty($rad_histo)){
			
		$observa   = "Solicitud de prestamo de forma masiva";		
		$radiModi  = $Historico->insertarHistorico(	$rad_histo,
                                                    $depenUsua,
                                                    $codusuario,
                                                    $depenUsua,
                                                    $codusuario,
                                                    $observa,
                                                    69);
														
		//retornamos el resultado
		$accion= array( 'respuesta' => true,
						'mensaje'	=> $rad_gragados.' ',
						'existen' 	=> $rad_error.' ');				
	}else{
		//retornamos el resultado
		$accion= array( 'respuesta' => false,
						'mensaje'	=> $mensaje4);
	}				
				
	print_r(json_encode($accion));		
?>