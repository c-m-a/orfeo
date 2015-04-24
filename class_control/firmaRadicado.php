<?php

/**
 * Esp es la clase encargada de gestionar las operaciones y los datos basicos referentes a la firma digital de un radicado
 * @author	Sixto Angel Pinzon
 * @version	1.0
 */

class firmaRadicado {
  /**
   * Gestor de las transacciones con la base de datos
   * @var ConnectionHandler
   * @access public
  */
 	var $cursor;
 	
  /** 
	* Constructor encargado de obtener la conexion
	* @param	$db	ConnectionHandler es el objeto conexion
	* @return   void
	*/	
	function firmaRadicado($db) {
		$this->cursor = $db;
	}
	
	
	/** 
  	* Consulta si se ha solicitado firma digital de una usuario para un radicado especifico
  	* @param	$radicado	string	Radicado a consultar
  	* @param	$usuaDocto	string	Documento del usuario
	* @return   boolean
  	*/
	function existeFirma($radicado,$usuaDocto) {
		$retorno = false;
		$sql="select * from SGD_FIRRAD_FIRMARADS where USUA_DOC='$usuaDocto' and RADI_NUME_RADI=$radicado";
		$rs=$this->cursor->query($sql);

		if  ($rs && !$rs->EOF){
			$retorno=true;
		}
		
		return $retorno;
	}
	
	
	/** 
  	* Consulta si se ha solicitado firma digital para un radicado, si y ya se ha firmado completamente retorna COMPLETA, si no retorna INCOMPLETA, si no se ha solicitado retorna NO_SOLICITADA.
  	* @param	$radicado	string	Radicado a consultar
  	* @return   string 
  	*/
	function firmaCompleta($radicado) {
		$retorno = "NO_SOLICITADA";
		$sql="select SGD_FIRRAD_FIRMA from SGD_FIRRAD_FIRMARADS where RADI_NUME_RADI=$radicado ";
		$rs=$this->cursor->query($sql);

		while  ($rs && !$rs->EOF){
				$retorno = "COMPLETA";
			if (strlen(trim($rs->fields['SGD_FIRRAD_FIRMA']))==0){
				$retorno = "INCOMPLETA";
				break;
			}
			$rs->MoveNext();
		}
		
		return $retorno;
	}
	
	
	/** 
  	* Consulta una solicitud de firma de acuerdo a un id de solicitud
  	* @param	$id	string	Id de firma
  	* @return   Array con toda la informacion de la firma
  	*/
	function firmaId($id) {
		$retorno = true;
		$sql="select * from SGD_FIRRAD_FIRMARADS where SGD_FIRRAD_ID = $id";
		$rs=$this->cursor->query($sql);
		$retorno = array();
		if  ($rs && !$rs->EOF){
			$retorno['RADI_NUME_RADI'] = $rs->fields['RADI_NUME_RADI'];
			$retorno['USUA_DOC'] = $rs->fields['USUA_DOC'];
			$retorno['SGD_FIRRAD_FIRMA'] = $rs->fields['SGD_FIRRAD_FIRMA'];
			$retorno['SGD_FIRRAD_FECHA'] = $rs->fields['SGD_FIRRAD_FECHA'];
			$retorno['SGD_FIRRAD_DOCSOLIC'] = $rs->fields['SGD_FIRRAD_DOCSOLIC'];
			$retorno['SGD_FIRRAD_FECHSOLIC'] = $rs->fields['SGD_FIRRAD_FECHSOLIC'];
			
		}
		
		return $retorno;
	}
	
	
	/** 
  	* Consulta y debuelve los nombres de los usuarios que han firmado un documento
  	* @param	$radicado	string	Radicado a consultar
  	*/
	function nombresFirmsRad($radicado) {
		
		$sql="select  f.SGD_FIRRAD_FIRMA,
                  u.USUA_NOMB
            from  SGD_FIRRAD_FIRMARADS f, 
                  USUARIO u
            where f.RADI_NUME_RADI = $radicado AND
                  f.USUA_DOC = u.USUA_DOC";
		$rs=$this->cursor->query($sql);
		$retorno="";	
		while  ($rs && !$rs->EOF){
			if (strlen(trim($rs->fields['SGD_FIRRAD_FIRMA']))>=0){
				$retorno = $retorno . strtoupper(trim($rs->fields['USUA_NOMB'])) . "<BR>";
							}
			$rs->MoveNext();
		}
		
		return $retorno;
	}
	
	/** 
  	* Anula las firmas previamente realizadas sobre un radicado
  	* @param	$radicado	string	Radicado cuya firma ha de anularse
  	*/
	function anularFirmaRad($radicado) {
		
		$sql="update SGD_FIRRAD_FIRMARADS set SGD_FIRRAD_FIRMA=null,SGD_FIRRAD_FECHA=null where RADI_NUME_RADI=$radicado ";
		$rs=$this->cursor->query($sql);
		
		if  (!$rs){
			echo ("<BR>No se pudo actualizar la tabla de firmas ($sql) <BR>");	
		}
	}
}
?>
