<?php 
require_once("$ruta_raiz/include/db/ConnectionHandler.php");

/**
 * Departamento es la clase encargada de gestionar las operaciones y  los datos basicos referentes a un Departamento
 * @author      Sixto Angel Pinz�n
 * @version     1.0
 */
class Departamento {

 /**
   * Variable que se corresponde con su par, uno de los campos de la tabla departamento
   * @var numeric
   * @access public
   */
	var $dpto_codi;
 /**
   * Variable que se corresponde con su par, uno de los campos de la tabla departamento
   * @var string
   * @access public
   */
	var $dpto_nomb;
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
	function Departamento($db) {
		$this->cursor = $db;
	}


/**
* Retorna el valor string correspondiente al atributo nombre del Departamento, debe invocarse antes departamento_codigo()
* @return   string
*/
	function get_dpto_nomb() {
		return  $this->dpto_nomb;
	}


/**
* Retorna el valor entero correspondiente al atributo codigo del Departamento, debe invocarse antes departamento_codigo()
* @return   int
*/
	function get_dpto_codi() {
		return $this->dpto_codi;
	}


/**
 * Carga los datos de la instacia con un codigo de departamento suministrado
 * @param	$codigo	int	es el codigo del departamento
*/
function departamento_codigo($codigo)
{	//si se ingresa un parametro valido
	if (strlen($codigo>0))
	{	if (strpos($codigo,'-'))
		{	$codigo = explode('-', $codigo);
			$codigo_pai = $codigo[0];
			$codigo_dep = $codigo[1];
			$q = "SELECT DPTO_NOMB,DPTO_CODI FROM DEPARTAMENTO,SGD_DEF_PAISES WHERE DEPARTAMENTO.id_pais = SGD_DEF_PAISES.ID_PAIS AND ".
				"DEPARTAMENTO.DPTO_CODI= $codigo_dep AND DEPARTAMENTO.ID_PAIS=$codigo_pai";
		}
		else
		{	//almacena el query
			$q= "select *  from departamento where dpto_codi =$codigo";
		}
		$rs=$this->cursor->query($q);
		if  (!$rs->EOF)
		{	$this->dpto_codi=$rs->fields['DPTO_CODI'];
			$this->dpto_nomb=$rs->fields['DPTO_NOMB'];
		}
	}
	else
	{
		$this->dpto_codi="";
		$this->dpto_nomb="";
  	}
}


   /**
  * Escribe el javascript que permite cargar los municipios en una lista desplegable, de acuerdo a los seleccionado en una de departamentos
  */
	function comboDeptoMuni(){

  	echo "function loadMunicipios(forma,codDepto,comboMpio)";
    echo "{";
		echo "o = new Array;";
		echo "i=0;";
		//almacena el query
    $dbsql ="select * from departamento";
		$rs=$this->cursor->query($dbsql);
    while(!$rs->EOF){
    	echo "if (codDepto == ". $rs->fields['DPTO_CODI'].")";
      echo "{";
      $codDepto= $rs->fields['DPTO_CODI'];
			//almacena el query
      $dbsql2="SELECT * FROM municipio WHERE dpto_codi=$codDepto order by muni_nomb";
			$rs2=$this->cursor->query($dbsql2);

      while(!$rs2->EOF){
      	$descripcion = chop ($rs2->fields['MUNI_NOMB']);
				echo "o[i++]=new Option('$descripcion',". $rs2->fields['MUNI_CODI'] .");";
				$rs2->MoveNext();

      }
      echo"}";
			$rs->MoveNext();
		}
    echo "if (i==0)";
		echo "{";
		echo " i=0; ";
    echo "}";
    echo "else";
		echo "{";
    echo " largestwidth=0;";
    echo " for (i=0; i < o.length; i++)";
    echo " {";
    echo "   eval(forma.elements[comboMpio].options[i+1]=o[i]);";
    echo "   if (o[i].text.length > largestwidth)";
		echo "   {";
    echo "     largestwidth=o[i].text.length;";
		echo "   }eval(forma.elements[comboMpio].length=o.length+1)";
    echo " }";
    echo "}";
		echo "}";
	}

}


?>
