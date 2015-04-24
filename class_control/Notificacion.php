<?php 

require_once("$ruta_raiz/include/db/ConnectionHandler.php");

/**
 * Notificacion es la clase encargada de gestionar las operaciones y  los datos básicos referentes a un tipo de Notificacion
 * @author      Sixto Angel Pinzón
 * @version     1.0
 */                  
class Notificacion {

 /**
   * Variable que se corresponde con su par, uno de los campos de la tabla sgd_not_notificacion
   * @var numeric
   * @access public
   */
	var $sgd_not_codi;
 /**
   * Variable que se corresponde con su par, uno de los campos de la tabla sgd_not_notificacion
   * @var string
   * @access public
   */
	var $sgd_not_descrip;
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
	function Notificacion($db) {
		$this->cursor = $db;
	}


/** 
* Retorna el valor string correspondiente al atributo descripción de la notificacion, debe invocarse antes notificacion_codigo()
* @return   string
*/
	function get_sgd_not_descrip() {
		return  $this->sgd_not_descrip;
	}


/** 
* Retorna el valor entero correspondiente al atributo codigo del la notificacion, debe invocarse antes departamento_codigo()
* @return   int
*/
	function get_sgd_not_codi() {
		return $this->sgd_not_codi;
	}


 /** 
  * Carga los datos de la instacia con un código de departamento suministrado
  * @param	$codigo	int	es el código del departamento
  */
	function notificacion_codigo($codigo){

	//si se ingresó un parámetro válido
		if (strlen($codigo>0)){
			//almacena el query
			$q= "select *  from sgd_not_notificacion
             where SGD_NOT_CODI =$codigo";
			$rs=$this->cursor->query($q);

				if  (!$rs->EOF){
		
				$this->sgd_not_codi=$rs->fields['SGD_NOT_CODI'];
				$this->sgd_not_descrip=$rs->fields['SGD_NOT_DESCRIP']; 
		
			}
		}else{
			$this->sgd_not_codi="";
			$this->sgd_not_descrip=""; 
  	}
	}
	
				  
}
	

?>
