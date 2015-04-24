<?php 
error_reporting(7);

/**
 * Esp es la clase encargada de gestionar las operaciones y los datos básicos referentes a una Transacción Orfeo
 * @author	Sixto Angel Pinzón
 * @version	1.0
 */
class Transaccion {      
	
 /**
   * Variable que se corresponde con su par, uno de los campos de la tabla sgd_ttr_transaccion
   * @var numeric
   * @access public
   */
	var $sgd_ttr_codigo;
/**
   * Variable que se corresponde con su par, uno de los campos de la tabla sgd_ttr_transaccion
   * @var string
   * @access public
   */
	var $sgd_ttr_descrip;
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
	function Transaccion($db) {
		$this->cursor = $db;
	}

/** 
* Retorna el valor string correspondiente al atributo descripcion de la transaccion, debe invocarse antes Transaccion_codigo()
* @return	string
*/
	function getDescripcion() {
		return  $this->sgd_ttr_descrip;
	}


/** 
* Retorna el valor entero correspondiente al atributo indentificados de la transaccion, debe invocarse antes Transaccion_codigo() 
* @return	int
*/
	function getIdentificador() {
		return $this->sgd_ttr_codigo;
	}


/** 
* Carga los datos de la instacia con con  referencia a un código de ESP suministrado retorna falso si no lo encuentra, de lo contrario true
* @param	$codigo	string es el código del departamento
* @return   boolean
*/
	function Transaccion_codigo($codigo){
  //almacena el query
		$q= "select *  from sgd_ttr_transaccion where sgd_ttr_codigo =$codigo";
		$rs=$this->cursor->query($q);

		if  ($rs&&!$rs->EOF){
		
			$this->sgd_ttr_codigo = $rs->fields['SGD_TTR_CODIGO'];
			$this->sgd_ttr_descrip = $rs->fields['SGD_TTR_DESCRIP']; 
			return true;
		
		}else{
			$this->sgd_ttr_codigo = "";
			$this->sgd_ttr_descrip = ""; 
		}
		return false;
	}	

	
}


?>
