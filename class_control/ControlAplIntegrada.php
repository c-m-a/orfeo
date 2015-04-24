<?

/**
 * AplIntegrada es la clase encargada de gestionar el estado de la comunicación entre yn raedicado integrado a una aplicacion y el sistema 
 * @author      Sixto Angel Pinzon
 * @version     1.0
 */                  
class  ControlAplIntegrada{
	/** 
	* Constructor encargado de obtener la conexion
	* @param	$db	ConnectionHandler es el objeto conexion
	* @return   void
	*/
	function ControlAplIntegrada($db) {
		$this->cursor = $db;
	}
	
	
  /** 
  * Consulta si un radicado puede continuar su flujo normal en un módulo de orfeo de a cuerdo 
  * a la comunicación con el aplicativo que le integra retora 1 si puede continuel el trámite normal, de lo
  * contrario retorna el mensaje que indicaría por que queda detenido.
  * @param	$codigo	string es el codigo del radicado
  * @param	$instancia	string es código del módulo de orfeo que se está consultando
  * @param	$tipo	string indica el tipo del código de referencia (1 - Radicado , 2 - Anexo
  * @return   String	
  */
	function contiInstancia($codigo,$instancia,$tipo){
		
		//Busca si tiene aplicativo integrado
		
		if ($tipo==1)
			$aplRad = $this->consultAplRad($codigo);
		else 
			$aplRad = $this->consultAplAnex($codigo);
		
		//En caso de no existir o valer 0 es decir no especificada
		if ($aplRad=="null" ||  $aplRad['codigo']==0)
			return "1";
		
			
		$q= "select *  from SGD_APLMEN_APLIMENS
             where SGD_APLMEN_REF='$codigo' and SGD_APLI_CODI = ".$aplRad['codigo'];
		$rs=$this->cursor->query($q);
		if  ($rs->EOF or !$rs)
			$aplMensaje='is null';
		else 
			$aplMensaje = "=".$rs->fields['SGD_APLMEN_HACIAORFEO']; 

			$q= "select * from SGD_ESTINST_ESTADOINSTANCIA where SGD_APLI_CODI =". $aplRad['codigo'] .
			" and SGD_INSTORF_CODI = $instancia AND SGD_ESTINST_VALOR  $aplMensaje" ;
			$rs=$this->cursor->query($q);
			
			if  (!$rs->EOF){
				if ($rs->fields['SGD_ESTINST_HABILITA'] == 1)
					return(1);
				else 
					return ($rs->fields['SGD_ESTINST_MENSAJE']);				
			} else 
				return ("No se puede continuar en proceso pues es necesario consolidar los datos del aplicativo " . $aplRad['nombre'] . " con el radicado ");
					
	}
	
	/** 
  * Consulta si un radicado está integrado con una aplicacion externa
  * retora un arreglo con los datos del apicativo integrado el código de la aplicación que le integra, de lo contrario retorna null
  * @param	$codigo	string es el codigo del radicado
  * @return   array	
  */
	function consultAplRad($codigo){
		$q= "select SGD_APLI_APLINTEGRA.SGD_APLI_CODI,SGD_APLI_APLINTEGRA.SGD_APLI_DESCRIP
			  from RADICADO,SGD_APLI_APLINTEGRA  
             where RADI_NUME_RADI=$codigo  and 
             SGD_APLI_APLINTEGRA.SGD_APLI_CODI = RADICADO.SGD_APLI_CODI
             ";
		$rs=$this->cursor->query($q);

		if  (!$rs->EOF && $rs){
			$apicativo = $rs->fields['SGD_APLI_CODI'];
			
			if (strlen(trim($apicativo))>0){
				$vecDatos['codigo']=$apicativo;
				$vecDatos['nombre']=$rs->fields['SGD_APLI_DESCRIP'];
				return $vecDatos;
			}
			
				
		}
		else 	
			return "null";
	}
	
	
		/** 
  * Consulta si un anexo está integrado con una aplicacion externa
  * retora un arreglo con los datos del apicativo integrado el código de la aplicación que le integra, de lo contrario retorna null
  * @param	$codigo	string es el codigo del radicado
  * @return   array	
  */
	function consultAplAnex($codigo){
		$q= "select SGD_APLI_APLINTEGRA.SGD_APLI_CODI,SGD_APLI_APLINTEGRA.SGD_APLI_DESCRIP
			  from ANEXOS,SGD_APLI_APLINTEGRA  
             where  ANEX_CODIGO='$codigo'  and 
             SGD_APLI_APLINTEGRA.SGD_APLI_CODI = ANEXOS.SGD_APLI_CODI
             ";
		$rs=$this->cursor->query($q);

		if  (!$rs->EOF && $rs){
			$apicativo = $rs->fields['SGD_APLI_CODI'];
			
			if (strlen(trim($apicativo))>0){
				$vecDatos['codigo']=$apicativo;
				$vecDatos['nombre']=$rs->fields['SGD_APLI_DESCRIP'];
				return $vecDatos;
			}
			
				
		}
		else 	
			return "null";
	}
	
	
	/** 
  * Consulta y ejecuta querys adicionales dentro de un modulo de orfeo para radicados asociados con aplicaciones externas
  * retorna 1 y la ejecución fué exitosa o si no tiene querys adicionales por ejecutar, de lo contrario retorna 0
  * @param	$codigo	string radicado involucrado
  * @param	$campos	array arreglo de campos vs valores sobre los que se ha de hacer los remplazamientos para los query adiconales
  * @param	$instancia	string es código del módulo de orfeo que se está consultando
  * @return   string	
  */

  function queryAdds($codigo,$campos,$instancia){
  		//Busca si tiene aplicativo integrado
		$aplRad = $this->consultAplRad($codigo);
		if ($aplRad=="null")
			return "1";
		$q= "select *  from SGD_ACTADD_ACTUALIADICIONAL
             where  SGD_APLI_CODI = ".$aplRad['codigo'] . " and SGD_INSTORF_CODI=$instancia";
		$rs=$this->cursor->query($q);
		
		while  (!$rs->EOF && $rs)	{
			$q = $rs->fields['SGD_ACTADD_QUERY']; 
			
			$num = count($campos);
			$i = 0;
			
			while ($i < $num){
	 			$record_id = key($campos);
	 			$q =str_replace ( $record_id, $campos[$record_id], $q );
	  			$i++;
	 			next($campos);
			}
			reset($campos);
			
			$rs2=$this->cursor->query($q);
				
			if (!$rs2){
			 	$this->cursor->conn->RollbackTrans();
		 	 	echo ("<span class='alarmas'>ERROR TRATANDO DE EJECUTAR LAS ACTUALIZACIONES ADICIONALES PARAMETRIZADAS PARA EL APLICATIVO ASOCIADO...".$aplRad['nombre']." en ($q)</span>");
		 	 	return ("0");
			}
			$rs->MoveNext();
		}
		
		return ("1");
			
	
  	
  }
	
	
}

?>
