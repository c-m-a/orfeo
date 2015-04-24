<?php
include_once('dataCommon.php');
	/*
	 * dataCommon.php comparte los datos mas relevantes y los 
	 * objetos mas utilizados como session,adodb, etc.
	 */	
	
	$mensaje0		= "Parametros incorrectos";
	$mensaje1		= "No se encontro el numero de Expediente";
	$mensaje12		= "No existe un tipo documental para esta serie y subserie";//Mensaje de informacion
	$mensaje13		= "No existe una subserie para esta serie";//Mensaje de informacion
	$mensaje2		= "No existe tema para este sector";//Mensaje de informacion
	
	//Seleccionar numero del expediente y texto cuando se realiza
	//la busqueda de un expediente	
	$query 			= strValido($query);
			
	$var1 			= strspn($query, "1234567890eE");
	$nuExpediente 	= trim(substr($query, 0, $var1));
	
	//Filtros para buscar y cambiar nombres de expedientes
	$com_selectSerie	=	(empty($selectSerie))? 	'' : "SE.SGD_SRD_CODIGO  =  $selectSerie 	AND";
	$com_selectSubSerie	=	(empty($selectSubSerie))?'' : "SE.SGD_SBRD_CODIGO =  $selectSubSerie AND";
	$com_ano_busq		=	(empty($ano_busq))?	'' : "SE.SGD_SEXP_ANO 	 =  $ano_busq 		AND";
	$com_selectDepe		=	(empty($selectDepe))?	'' : "SE.DEPE_CODI 	 =  $selectDepe 	AND";
	$com_todos			= 	(!empty($todos))? '' : "SE.SGD_SEXP_ESTADO = 	0 AND";	//Filtra los expedientes activos
	 
	switch ($evento) {		
		/**Consular en la base de datos las respectivas
		 * subseries que pertenecen a esta dependencia
		 * comparando la fecha actual y la de finalizacion.
		 * Retornar arreglo de subSerie 
		 */		
	    case 1:             	    
	    	
	    	//si alguno de los siguientes parametros no esta, salga.
			if (empty($depenUsua) || empty($selectSerie)){
				salirError ($mensaje0);
				return;
			}
			$sql1 = "select
					DISTINCT (cast(su.sgd_sbrd_codigo as varchar(5))||' - '||su.sgd_sbrd_descrip)AS DETALLE
					,su.sgd_sbrd_codigo AS CODIGO_SUBSERIE					
					from
						sgd_mrd_matrird m
						, sgd_sbrd_subserierd su
					where
						m.depe_codi 			= $depenUsua
						and su.sgd_srd_codigo 	= $selectSerie
						and su.sgd_sbrd_codigo 	= m.sgd_sbrd_codigo
					order by detalle";
			$salida	=	$db->conn->Execute($sql1);			
			while(!$salida->EOF) {
				$result[]= array("codigo" => $salida->fields["CODIGO_SUBSERIE"]
								,"nombre" => utf8_decode($salida->fields["DETALLE"]));
				$salida->MoveNext();
			}	
			if($result){
				$accion= array( 'respuesta' => true,
								'mensaje'	=> $result);
				print_r(json_encode($accion));				
			}else{
				salirError ($mensaje13);
			}					
	        break;
			
		/** Retorna las tipos documentales 
		 * 	Se requiere que se pase como argumento la serie y la subserie
		 *  retorna el valor con digitos de complemento y para que sea
		 *  leida por javascript  
		 */
		case 2:
			
			//si alguno de los siguientes parametros no esta, salga.
			if (empty($depenUsua) || empty($selectSerie) || empty($selectSubSerie)){
				salirError ($mensaje0);
				return;
			}
			
			$sql2 = "SELECT
				DISTINCT (cast(T.SGD_TPR_CODIGO as varchar(5))||' - '||T.SGD_TPR_DESCRIP) AS DETALLE
				,T.SGD_TPR_CODIGO AS CODIGO_SUBSERIE          	

				FROM
				    SGD_MRD_MATRIRD M
				    , SGD_TPR_TPDCUMENTO T

				WHERE
						     M.DEPE_CODI 			= $depenUsua
						    -- AND M.SGD_MRD_ESTA 	= '1'
						     AND M.SGD_SRD_CODIGO 	= $selectSerie
						     AND M.SGD_SBRD_CODIGO 	= $selectSubSerie
						     AND T.SGD_TPR_CODIGO 	= M.SGD_TPR_CODIGO
						    -- AND T.SGD_TPR_ESTADO		='1'
						
					ORDER BY DETALLE";
			$salida	=	$db->conn->Execute($sql2);
		
			while(!$salida->EOF) {
				$result[]= array("codigo" => $salida->fields["CODIGO_SUBSERIE"]
								,"nombre" => utf8_encode($salida->fields["DETALLE"]));
				$salida->MoveNext();
			}	
			
			if($result){
				$accion= array( 'respuesta' => true,
								'mensaje'	=> $result);
				print_r(json_encode($accion));				
			}else{
				salirError ($mensaje12);
			}					
	        break;
			
		/**Retornar las series dependiendo de la dependencia que seleccione 
		 * el usuario  
		 */	
	case 3:
		
	  $sql1 = "select
			  DISTINCT (cast(su.SGD_SRD_CODIGO as varchar(3))+' - '+su.SGD_SRD_DESCRIP)AS DETALLE
			  ,su.SGD_SRD_CODIGO AS CODIGO_SERIE	
			  from
				  sgd_mrd_matrird m
				  , SGD_SRD_SERIESRD su
			  where
				  m.depe_codi 			= $selectDepe
				  --and m.sgd_mrd_esta 		= 1
				  and m.SGD_SRD_CODIGO    = su.SGD_SRD_CODIGO
				  and $sqlFechaHoy between su.SGD_SRD_FECHINI
				  and su.SGD_SRD_FECHFIN		
			  order by detalle";

	  $salida=$db->conn->Execute($sql1);			
	  while(!$salida->EOF) {
		  
		  $result[]= array("codigo" => $salida->fields["CODIGO_SERIE"]
						  ,"nombre" => utf8_encode($salida->fields["DETALLE"]));
		  $salida->MoveNext();
	  }	
			  
	  if($result){
		  $accion= array( 'respuesta' => true,
						  'mensaje'	=> $result);
		  print_r(json_encode($accion));				
	  }else{
		  salirError ($mensaje13);
	  }	
		  
	  break;
		  
	  /**
		 * Buscar el expediente con su respectivo nombre
		 * dependiendo de los filtro que el usuario 
		 * envie
		 */
		
        case 4: //Buscar expedientes	
        
        	$query = preg_replace('/^\s/', '',$query);
			if (strlen($query) == 0)
				return;		
				
			$sqlE  = "
					SELECT top 30 cast(SE.SGD_EXP_NUMERO as varchar(22))
						+ ' ' + SE.SGD_SEXP_PAREXP1
						+ ' ' + SE.SGD_SEXP_PAREXP2
						+ ' ' + SE.SGD_SEXP_PAREXP3
						+ ' ' + SE.SGD_SEXP_PAREXP4
						+ ' ' + SE.SGD_SEXP_PAREXP5
						AS EXPEDIENTE
					FROM SGD_SEXP_SECEXPEDIENTES SE
					WHERE
						$com_todos
						$com_selectSerie						
						$com_selectSubSerie		
						$com_ano_busq			
						$com_selectDepe											
						(  SE.SGD_SEXP_PAREXP1 LIKE '%$query%'
						OR SE.SGD_SEXP_PAREXP2 LIKE '%$query%'
						OR SE.SGD_SEXP_PAREXP3 LIKE '%$query%'
						OR SE.SGD_SEXP_PAREXP4 LIKE '%$query%'
						OR SE.SGD_SEXP_PAREXP5 LIKE '%$query%')						
					ORDER BY 1";				

			$salida = $db->conn->Execute($sqlE);	 
			 
			while(!$salida->EOF && !empty($salida)) {
								
				$nombExp	= preg_replace('/\s/' , ' ' , str_replace("-","",$salida->fields["EXPEDIENTE"]));
								
				if(!empty($nombExp)){				
					$result[]	= utf8_encode($nombExp);						
				}																								
				$salida->MoveNext();
			}
			
			for ($i = 0; $i < count($result); $i++){
				print "$result[$i]\n";	
			}	
        					
            break;
			
		
		/**
		 * buscar nombres a partir del numero del expediente
		 * 
		 */
		case 5:
			
			if (empty($nomb_Expe_search))
				return;
							
			$nomb_Expe_search = trim(strValido($nomb_Expe_search));
			
			$var1 			= strspn($nomb_Expe_search, "1234567890eE");			
			$nuExpediente 	= trim(substr($nomb_Expe_search, 0, $var1));
							
			$sqlE  = "
					SELECT      SE.SGD_SEXP_PAREXP1
						|| ' ' || SE.SGD_SEXP_PAREXP2
						|| ' ' || SE.SGD_SEXP_PAREXP3
						|| ' ' || SE.SGD_SEXP_PAREXP4
						|| ' ' || SE.SGD_SEXP_PAREXP5
						AS EXPEDIENTE
					FROM SGD_SEXP_SECEXPEDIENTES SE
					WHERE
						$com_todos
						$com_selectSerie						
						$com_selectSubSerie		
						$com_ano_busq			
						$com_selectDepe	
						SE.SGD_EXP_NUMERO LIKE '$nuExpediente'";							
                        $sqlE  = "
                                        SELECT      SE.SGD_SEXP_PAREXP1
                                                || ' ' || SE.SGD_SEXP_PAREXP2
                                                || ' ' || SE.SGD_SEXP_PAREXP3
                                                || ' ' || SE.SGD_SEXP_PAREXP4
                                                || ' ' || SE.SGD_SEXP_PAREXP5
                                                AS EXPEDIENTE
                                        FROM SGD_SEXP_SECEXPEDIENTES SE
                                        WHERE
                                                $com_todos
                                                $com_selectSerie
                                                $com_selectSubSerie
                                                $com_ano_busq
                                                $com_selectDepe
                                                SE.SGD_EXP_NUMERO LIKE '$nuExpediente'";

			
			$salida = $db->conn->Execute($sqlE);	
				
			if(empty($salida->EOF)){
							
				$nombExp	= trim(preg_replace('/\s/' , ' ' , str_replace("-","",$salida->fields["EXPEDIENTE"])));
				$detalle	= (strlen($nombExp) > 3)? $nombExp : 'No tiene nombre asignado';
				
	        	$accion		= array( 'respuesta' => true,
									 'mensaje'	 => utf8_encode($detalle));
				print_r(json_encode($accion));
			}else{
				salirError($mensaje1);
				return;
			}		
										
		break;
		
		/**
		 * buscar temas segun el sector
		 * 
		 */
		case 6:
			
			$sql	= "	SELECT
 							cast(CU.SGD_DCAU_CODIGO as varchar(3)||' - '||CU.SGD_DCAU_DESCRIP)AS DETALLE						    ,CU.SGD_DCAU_CODIGO AS CODIGO_TEMA				    
						FROM
    						SGD_DCAU_CAUSAL CU
						WHERE
     						CU.SGD_DCAU_ESTADO 	= 1
							AND CU.SGD_CAU_CODIGO 	= $selectSector";
			
			$salida	=$db->conn->Execute($sql);			
			while(!$salida->EOF) {
				
				$result[]= array("codigo" => $salida->fields["CODIGO_TEMA"]
								,"nombre" => utf8_encode($salida->fields["DETALLE"]));
				$salida->MoveNext();
			}	
					
			if($result){
				$accion= array( 'respuesta' => true,
								'mensaje'	=> $result);
				print_r(json_encode($accion));				
			}else{
				salirError ($mensaje2);
			} 
	 break;
	 
	 /**
	 * Buscar los temas con id sector de la tabla 
	 * causal para el autocompletar de temsa/sector
	 */
	
    case 7: //Buscar expedientes	
    	$query = preg_replace('/^\s/', '',$query);
		if (strlen($query) == 0)
			return;	
			
		$sql	= "	SELECT
						CU.SGD_DCAU_DESCRIP AS DETALLE
					    ,RIGHT('000' + convert(varchar,CU.SGD_DCAU_CODIGO),3) AS CODIGO_TEMA				    
					FROM
						SGD_DCAU_CAUSAL CU
					WHERE
 						CU.SGD_DCAU_ESTADO 	= 1
						AND CU.SGD_DCAU_DESCRIP like '%$query%'";
		
		$salida	=$db->conn->Execute($sql);			
		while(!$salida->EOF) {
			
			$result[]= array("nombre" => utf8_encode($salida->fields["DETALLE"])
							,"codigo" => $salida->fields["CODIGO_TEMA"]);
			$salida->MoveNext();
		}	
		$impJson	= json_encode($result);
	
		print_r($impJson);									
	break;										
	}		
?>
