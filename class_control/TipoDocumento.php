<?php 

require_once("$ruta_raiz/include/db/ConnectionHandler.php");

/**
 * TipoDocumento es la clase encargada de gestionar las operaciones y los datos basicos referentes a un tipo de documento a anexar a un radicado
 * @author      Sixto Angel Pinzon
 * @version     1.0
 */
class TipoDocumento {
	
 /**
   * Variable que se corresponde con su par, uno de los campos de la tabla sgd_tpr_tpdcumento
   * @var numeric
   * @access public
   */
	var $sgd_tpr_codigo;
/**
   * Variable que se corresponde con su par, uno de los campos de la tabla sgd_tpr_tpdcumento
   * @var string
   * @access public
   */
	var $sgd_tpr_descrip;
/**
   * Variable que se corresponde con su par, uno de los campos de la tabla sgd_tpr_tpdcumento
   * @var string
   * @access public
   */
	var $sgd_tpr_radica;
/**
   * Variables que se corresponde con su par, uno de los campos de la tabla sgd_tpr_tpdcumento
   * @var string
   * @access public
   */

	var $sgd_tpr_tp0;
	var $sgd_tpr_tp1;
	var $sgd_tpr_tp2;
	var $sgd_tpr_tp3;
	var $sgd_tpr_tp4;
	var $sgd_tpr_tp5;
	var $sgd_tpr_tp6;
	var $sgd_tpr_tp7;
	var $sgd_tpr_tp8;
	var $sgd_tpr_tp9;


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
	function TipoDocumento($db) {
		$this->cursor = $db;
	
	}


/** 
* Retorna el valor string correspondiente al atributo descripcion del tipo de archivo a anexar
* @return   string
*/
	function get_sgd_tpr_descrip() {
		return  $this->sgd_tpr_descrip;
	}


/** 
* Retorna el valor entero correspondiente al atributo codigo del registro
* @return   int
*/
	function get_sgd_tpr_codigo() {
		return $this->sgd_tpr_codigo;
	}


/**  
* Retorna el valor string correspondiente al atributo que indica si un tipo de documento es radicable
* @return   string
*/
	function get_sgd_tpr_radica(){
		return $this->sgd_tpr_radica;
	}
	
	
/**  
* Analiza el tipo de documento y si es del tipo especial que implica anexar documentos del mismos tipo (si es primer anexo) al radicado retorna 1 de lo contrario 0
* @return   int
*/
	function anexPrimIgual()
	{
		if (($this->sgd_tpr_tp0==1)||($this->sgd_tpr_tp1==1)||($this->sgd_tpr_tp2==1)||
			($this->sgd_tpr_tp3==1)||($this->sgd_tpr_tp4==1)||($this->sgd_tpr_tp5==1)||
			($this->sgd_tpr_tp6==1)||($this->sgd_tpr_tp7==1)||($this->sgd_tpr_tp8==1)||
			($this->sgd_tpr_tp9==1))
			return 1;
		else
			return 0;
	}


 /** 
  * Actualiza los atributos de la clase con los datos del tipo de documento a anexar correspondiente al  codigo del registro que recibe como parametros
  * @param	$codigo	int es el codigo del registro
  */
function TipoDocumento_codigo($codigo)
{
	if (strlen($codigo)>0)
	{
		//almacena el query
		$q= "select *  from sgd_tpr_tpdcumento where sgd_tpr_codigo=$codigo";
		//echo $q;
		//$this->cursor->conn->debug = true;
			$rs=$this->cursor->query($q);
		if  (!$rs->EOF)
		{
			$this->sgd_tpr_codigo=$rs->fields['SGD_TPR_CODIGO'];
			$this->sgd_tpr_descrip=$rs->fields['SGD_TPR_DESCRIP'];
			$this->sgd_tpr_radica=$rs->fields['SGD_TPR_RADICA'];
			$this->sgd_tpr_tp0=$rs->fields['SGD_TPR_TP0'];
			$this->sgd_tpr_tp1=$rs->fields['SGD_TPR_TP1'];
			$this->sgd_tpr_tp2=$rs->fields['SGD_TPR_TP2'];
			$this->sgd_tpr_tp3=$rs->fields['SGD_TPR_TP3'];
			$this->sgd_tpr_tp4=$rs->fields['SGD_TPR_TP4'];
			$this->sgd_tpr_tp5=$rs->fields['SGD_TPR_TP5'];
			$this->sgd_tpr_tp6=$rs->fields['SGD_TPR_TP6'];
			$this->sgd_tpr_tp7=$rs->fields['SGD_TPR_TP7'];
			$this->sgd_tpr_tp8=$rs->fields['SGD_TPR_TP8'];
			$this->sgd_tpr_tp9=$rs->fields['SGD_TPR_TP9'];
		}
	}
	else
	{
		$this->sgd_tpr_codigo="";
		$this->sgd_tpr_descrip="";
		$this->sgd_tpr_radica="";
		$this->sgd_tpr_tp0="";
		$this->sgd_tpr_tp1="";
		$this->sgd_tpr_tp2="";
		$this->sgd_tpr_tp3="";
		$this->sgd_tpr_tp4="";
		$this->sgd_tpr_tp5="";
		$this->sgd_tpr_tp6="";
		$this->sgd_tpr_tp7="";
		$this->sgd_tpr_tp8="";
		$this->sgd_tpr_tp9="";
}	}	}
?>
