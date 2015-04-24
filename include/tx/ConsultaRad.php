<?php 
require_once("$ruta_raiz/include/db/ConnectionHandler.php");
require_once("$ruta_raiz/class_control/TipoDocumento.php");
 
/**
 * ConsultaRad es la clase encargada de consultar datos sobre numeros de radicaods. Inicialmente creada para las consultas Web.
 * @author      Jairo H Losada C.
 * @version     3.0
 */

class ConsultaRad {
// Bloque de atributos que corresponden a los campos de la tabla anexos

  /**
   * Variable que se corresponde con su par, uno de los campos de la tabla anexos
   * @var numeric
   * @access public
   */
var $numeroRadicado;
  /**
   * Variable que contiene el numero de Radicado
   * @var numeric
   * @access public
   */
var $idRadicado;
  /**
   * Variable que se corresponde a la clave generada en el numero de radicado.
   * @var string
   * @access public
   */

var $db;
 /**
   * Gestor de las transacciones con la base de datos
   * @var ConnectionHandler
   * @access public
   */




/** 
* Constructor encargado de obtener la conexion
* @param	$db	ConnectionHandler es el objeto conexion
* @return   void
*/
function ConsultaRad($db) {
	$this->db = $db;
}

 /** 
     * Busca la clave de entrada del numero de radicado buscado. 
     * Retorna la clave del radicado
     * que recibe como par�metros
     * @param $radicado   es el c�digo del radica que contien el anexo
     * @param $idRad      es el Id asignado al Radicado.
     * @return Retorna la clave del numero de radicado.
     */

function idRadicado($radicado) {
	$q="select 
		 RADI_NUME_RADI
	  from 
		 radicado 
		where RADI_NUME_RADI='$radicado' ";
	$rs=$this->db->query($q);
	$idRad = 0;
	if 	(!$rs->EOF) 
 		{
			$idRad = $this->sgd_rem_destino=$rs->fields["RADI_NUME_RADI"];
		}
	$this->idRadicado = $idRad;
	return $idRad;
}


/** 
     * Retorna el valor string correspondiente al radicado de salida generado al radicar el anexo
     * @return   string
     */

function get_idRadicado(){
	return  $this->idRadicado;
}




}


?>
