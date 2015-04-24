<?php
	$ruta_raiz = "../..";

	//Paremetros get y pos enviados desde la aplicacion origen
	import_request_variables("gP", "");
	
	include_once	("$ruta_raiz/include/db/ConnectionHandler.php");
	//debug php ajax
	require_once	("$ruta_raiz/FirePHPCore/fb.php");	
	
	$db 			= new ConnectionHandler("$ruta_raiz");		
	$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
	
	$mensaje0		= "Dependencia y accion desconocida";
	$mensaje1		= "No se encontro el No. del expediente";	
	
	//Muestra si existe error	
	function salirError ($mensaje) {
		$accion		= 	array( 'respuesta' 	=> false,
							   'mensaje'	=> utf8_encode($mensaje));
		print_r(json_encode($accion));
	}
		
	//Filtrar caracteres extraños en textos	
	function strValido($string){
		$arr 	= array('/[^\w:()\sáéíóúÁÉÍÓÚ=#\-,.;ñÑ]+/', '/[\s]+/');
		$asu 	= preg_replace($arr[0], '',$string);		
		return    strtoupper(preg_replace($arr[1], ' ',$asu));
	}	 
	
	//Seleccionar numero del expediente y texto cuando se realiza
	//la busqueda de un expediente	
	$query 		= strValido($query);
			
	$var1 			= strspn($query, "1234567890eE");
	$nuExpediente 	= trim(substr($query, 0, $var1));
	
	//Filtros para buscar y cambiar nombres de expedientes
	$selectSerie	=	(empty($selectSerie))? 		'' : "SE.SGD_SRD_CODIGO  =  $selectSerie 	AND";
	$selectSubSerie	=	(empty($selectSubSerie))?	'' : "SE.SGD_SBRD_CODIGO =  $selectSubSerie AND";
	$ano_busq		=	(empty($ano_busq))?			'' : "SE.SGD_SEXP_ANO 	 =  $ano_busq 		AND";
	$selectDepe		=	(empty($selectDepe))?		'' : "SE.DEPE_CODI 		 =  $selectDepe 	AND";
	$todos			= 	(!empty($todos))? 			'' : "SE.SGD_SEXP_ESTADO = 	0 				AND";	//Filtra los expedientes activos
	
	//Ejecuta acciones que llegan desde adm_nombreTemasExp.js
    switch ($evento) {
        case 1: //Buscar expedientes	
        
        	$query = preg_replace('/^\s/', '',$query);
			if (strlen($query) == 0)
				return;		
				
			$sqlE  = "
					SELECT top 30 convert(varchar(20),SE.SGD_EXP_NUMERO)
						+ ' ' + SE.SGD_SEXP_PAREXP1
						+ ' ' + SE.SGD_SEXP_PAREXP2
						+ ' ' + SE.SGD_SEXP_PAREXP3
						+ ' ' + SE.SGD_SEXP_PAREXP4
						+ ' ' + SE.SGD_SEXP_PAREXP5
						AS EXPEDIENTE
					FROM SGD_SEXP_SECEXPEDIENTES SE
					WHERE
						$todos
						$selectSerie						
						$selectSubSerie		
						$ano_busq			
						$selectDepe											
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
					$result[]	= $nombExp;						
				}																								
				$salida->MoveNext();
			}
			
			for ($i = 0; $i < count($result); $i++){
				print "$result[$i]\n";	
			}	
        					
            break;
			
		
		
		case 2://buscar nombres a partir del numero del expediente
			
			if (empty($nuExpediente))
				return;		
					
			$sqlE  = "
					SELECT      SE.SGD_SEXP_PAREXP1
						+ ' ' + SE.SGD_SEXP_PAREXP2
						+ ' ' + SE.SGD_SEXP_PAREXP3
						+ ' ' + SE.SGD_SEXP_PAREXP4
						+ ' ' + SE.SGD_SEXP_PAREXP5
						AS EXPEDIENTE
					FROM SGD_SEXP_SECEXPEDIENTES SE
					WHERE
						$todos_busq
						$busq_Serie						
						$busq_SubSe			
						$ano_busq				
						$depe_busq
						SE.SGD_EXP_NUMERO LIKE '$nuExpediente'";							

			$salida = $db->conn->Execute($sqlE);	
				
			if(empty($salida->EOF)){				
				$nombExp	= trim(preg_replace('/\s/' , ' ' , str_replace("-","",$salida->fields["EXPEDIENTE"])));
				$detalle	= (strlen($nombExp) > 4)? $nombExp : 'No tiene nombre asignado';
				
	        	$accion		= array( 'respuesta' => true,
									 'mensaje'	 => $detalle);
				print_r(json_encode($accion));
			}else{
				salirError($mensaje1);
				return;
			}		
										
		break;
	}
?>