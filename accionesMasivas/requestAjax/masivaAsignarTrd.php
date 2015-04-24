<?php
include_once('dataCommon.php');
  /*
    * dataCommon.php comparte los datos mas relevantes y los 
    * objetos mas utilizados como session,adodb, etc.
    */	
  
  $mensaje0		= "Parametros incorrectos";	 
  $mensaje1		= "NO SE MODIFICO LA TRD DE NINGUN RADICADO";	 
				  
  /** Retorna los radicados a los cuales se le cambia la trd
    *  Cambio y registro en el historico de trd se los radicados
    *  seleccionados 	 
    */	
	  
  if (empty($depenUsua) || empty($selectTipoDoc) || empty($selectSubSerie)){
	  salirError ($mensaje0);
	  return;
  }		
  
  //Buscamos en la matriz el valor que une a la dependencia, serie, subserie, tipoDoc.
  $isqlTRD = "
  select 
  SGD_MRD_CODIGO
	  from 
	  SGD_MRD_MATRIRD
	  where 
	  DEPE_CODI	= $depenUsua
      and SGD_SRD_CODIGO 	= $selectSerie
      and SGD_SBRD_CODIGO = $selectSubSerie
      and SGD_TPR_CODIGO 	= $selectTipoDoc";
  
  $rsTRD = $db->conn->Execute($isqlTRD);			
	  
  //Se crean dos variables por que la clase esta creada de esta manera
  //y no se cambiara en este momento.
  $codiTRDS[] = $codiTRD = $rsTRD->fields['SGD_MRD_CODIGO'];    
  
  //Proceso de asginacion de trd para los radicados que no tienen
  if(!empty($radSinTrd)){
	  
    $radSinTrdArr= explode(",",$radSinTrd);		

    foreach ($radSinTrdArr as $value){										
      $trd->insertarTRD($codiTRDS,$codiTRD,$value,$depenUsua, $codusuario);			
      //guardar el registro en el historico de tipo documental.
      //permite controlar cambios del TD de un radicado
      
      $queryGrabar	= "INSERT INTO SGD_HMTD_HISMATDOC(											
			  SGD_HMTD_FECHA,
			  RADI_NUME_RADI,
			  USUA_CODI,
			  SGD_HMTD_OBSE,
			  USUA_DOC,
			  DEPE_CODI,
			  SGD_MRD_CODIGO)
			      VALUES(
			      $sqlFechaHoy,
			      $value,
			      $codusuario,
			      'El usuario: $usua_nomb Cambio el tipo de documento',
			      $usua_doc,
			      $depenUsua,
			      '$codiTRD')";
      $db->conn->Execute($queryGrabar);
      
      //Actulizar la TD en el radicado					
      $upRadiTdoc	="UPDATE 
			      RADICADO
		      SET  
			      TDOC_CODI = $selectTipoDoc
		      WHERE 
			      radi_nume_radi =  $value";
      
      $db->conn->Execute($upRadiTdoc);
	    
    }
    $observa   = "Asignar TRD de forma masiva";
    
    $radiModi  = $Historico->insertarHistorico(	$radSinTrdArr,
					$depenUsua,
					$codusuario,
					$depenUsua,
					$codusuario,
					$observa,
					32);	
	  $result = $radSinTrd;		
  }			
	
	
  //Proceso de asginacion de trd para los radicados que SI tienen
  //y se quiere es modificar.
  if(!empty($radConTrd) && $cambExiTrd == 111){
	  
    $radConTrdArr		= explode(",",$radConTrd);		
    
    foreach ($radConTrdArr as $radicadoCon){
	    
    //Buscamos los datos anteriores de la trd y los
    //colocamos en el mensaje del historico
    
    $sqlhis="	SELECT
		  SE.SGD_SRD_DESCRIP ||
		  '/'|| SU.SGD_SBRD_DESCRIP ||
		  '/'|| TD.SGD_TPR_DESCRIP AS TRD_ANTERIOR
		FROM
		  SGD_RDF_RETDOCF      SG
		,SGD_MRD_MATRIRD      MR
		,SGD_SBRD_SUBSERIERD  SU
		,SGD_SRD_SERIESRD     SE
		,SGD_TPR_TPDCUMENTO   TD
		WHERE
		  SG.RADI_NUME_RADI      = $radicadoCon
		  AND MR.SGD_MRD_CODIGO  = SG.SGD_MRD_CODIGO
		  AND MR.SGD_SBRD_CODIGO = SU.SGD_SBRD_CODIGO
		  AND MR.SGD_SRD_CODIGO  = SU.SGD_SRD_CODIGO
		  AND MR.SGD_SRD_CODIGO  = SE.SGD_SRD_CODIGO
		  AND MR.SGD_TPR_CODIGO  = TD.SGD_TPR_CODIGO";
    
    $resultHis	= $db->conn->Execute($sqlhis);			
    $histTrd 	= $resultHis->fields['TRD_ANTERIOR'];			

    $sqlUA 		= "	UPDATE 
					    SGD_RDF_RETDOCF 
				    SET 
					    SGD_MRD_CODIGO 	= '$codiTRD',
				    USUA_CODI 		= '$codusuario'
			    WHERE 
			      RADI_NUME_RADI 	= '$radicadoCon' 
			      AND DEPE_CODI 	= '$depenUsua'";
					    
    $rsUp 		= $db->conn->query($sqlUA);
	    
    //guardar el registro en el historico de tipo documental.
    //permite controlar cambios del TD de un radicado
    
    $queryGrabar	= "INSERT INTO SGD_HMTD_HISMATDOC(											
			SGD_HMTD_FECHA,
			RADI_NUME_RADI,
			USUA_CODI,
			SGD_HMTD_OBSE,
			USUA_DOC,
			DEPE_CODI,
			SGD_MRD_CODIGO
			)
			  VALUES(
			  $sqlFechaHoy,
			  $radicadoCon,
			  $codusuario,
				  'El usuario: $usua_nomb Cambio el tipo de documento',
				  $usua_doc,
				  $depenUsua,
				  '$codiTRD')";					
    
    $db->conn->Execute($queryGrabar);	
    
    //Actulizar la TD en el radicado					
    $upRadiTdoc	=	"UPDATE 
			  RADICADO
			  SET  
			    TDOC_CODI = $selectTipoDoc
			  WHERE 
			    radi_nume_radi = $radicadoCon";
    
    $db->conn->Execute($upRadiTdoc);										
    }			
    
    $observa 	= "	Cambio masivo TRD por: Usuario: $usua_nomb - Dependencia: $depenUsua
				    TRD Anterior: $histTrd";
    
    $radiModi 	= $Historico->insertarHistorico(
			    $radConTrdArr
			    ,$depenUsua
			    ,$codusuario
			    ,$depenUsua
			    ,$codusuario
			    ,$observa
			    ,32);	
    $result 	.= $radConTrd;
						  
  }			
	
	$result = (empty($result))? $mensaje1 : $result;
	
	$accion= array( 'respuesta' => true,
					'mensaje'	=> $result);
	print_r(json_encode($accion));
?>
