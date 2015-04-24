<?php 

require_once("$ruta_raiz/include/db/ConnectionHandler.php");

/**
 * Notificacion es la clase encargada de gestionar las operaciones y  los datos básicos referentes a un tipo de Decision
 * @author      Sixto Angel Pinzón
 * @version     1.0
 */                  
class TipoDecision {

 /**
   * Variable que se corresponde con su par, uno de los campos de la tabla SGD_TDEC_TIPODECISION
   * @var numeric
   * @access public
   */
	var $sgd_tdec_codigo;
 /**
   * Variable que se corresponde con su par, uno de los campos de la tabla SGD_TDEC_TIPODECISION
   * @var string
   * @access public
   */
	var $sgd_tdec_descrip;
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
	function TipoDecision($db) {
		$this->cursor = $db;
	}


/** 
* Retorna el valor string correspondiente al atributo descripción de la notificacion, debe invocarse antes notificacion_codigo()
* @return   string
*/
	function get_sgd_tdec_descrip() {
		return  $this->sgd_tdec_descrip;
	}


/** 
* Retorna el valor entero correspondiente al atributo codigo del la notificacion, debe invocarse antes departamento_codigo()
* @return   int
*/
	function get_sgd_tdec_codigo() {
		return $this->sgd_tdec_codigo;
	}


 /** 
  * Carga los datos de la instacia con un código de departamento suministrado
  * @param	$codigo	int	es el código del departamento
  */
	function tipoDecision_codigo($codigo){

	//si se ingresó un parámetro válido
		if (strlen($codigo>0)){
			//almacena el query
			$q= "select *  from SGD_TDEC_TIPODECISION
             where SGD_TDEC_CODIGO =$codigo";
			$rs=$this->cursor->query($q);

				if  (!$rs->EOF){
		
				$this->sgd_tdec_codigo=$rs->fields['SGD_TDEC_CODIGO'];
				$this->sgd_tdec_descrip=$rs->fields['SGD_TDEC_DESCRIP']; 
		
			}
		}else{
			$this->sgd_tdec_codigo ="";
			$this->sgd_tdec_descrip =""; 
  	}
	}
	
				  
}
	

?>
