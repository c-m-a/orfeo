<?php
/**
 * @author Aquiles Canto 
 * @copyright GPL 
 * @package DAO
 * @uses clase encargada de abstraer la sinaxis de las diferentes funciones utilizadas 
 * en el sistema de gestión documental Orfeo 
 *
 */
$ruta_raiz=(isset($ruta_raiz))?((substr($ruta_raiz,-1)==".")?$ruta_raiz."/":$ruta_raiz):"../";
/**
 * paginador ispirado en la version de adodb,flexibilizando la forma de pintar la grilla
 * y la muestra de los titulos dependiendo de una funcion definida por el usuario, o en caso 
 * de no definir una funcion personalizada tomatra la idea de adodb  
 * flexibilizando la 
 */
require_once($ruta_raiz."include/db/ConnectionHandler.php");
	
class FuncionesDb{
	var $driver;
	/**
	 * constructo de la clase DbFunction
	 *
	 * @param ConectionHandler $db 
	 * @return void 
	 */
	function FuncionesDb($db){
		$this->driver=&$db->driver;
	}
	/**
	 * funcion que recibe como parametros opcionales el nombre de la tabla
	 * y retorna la función para cada uno de los sbrd disponibles 
	 *
	 * @param string $nomCampo nombre del campo de la tabla sobre la cual se genera la funcion
	 * @param string $offset  posicisón desde la cual se inicia el conteo 
	 * @param string $limit el número de pocisiones que se desplaza 
	 * @return string con la cadena que representa en la base de datos la función si no se es
	 * 			ingresado un campo se retorna solamente el nombre la funcion correspondiente a 
	 * 			a cada sgbd soportado
	 */
	function substr($nomCampo=false,$offset=false,$limit=false,$esNumero=false){
		
		$salida="";
		switch ($this->driver){
			case 'mssql':
				$salida="SUBSTRING";
				break;
			case 'oracle':
			case 'oci8':
			case 'postgres':
			case 'mysql':
			case 'sybase':
			case 'firebird':
				$salida="SUBSTR";
			break;	
		}
		$offset==($offset==false || !is_integer($offset))?0:$offset;
		$limit=($limit!=false && is_integer($limit))?",".$limit:"";
		if($nomCampo!=false)
			$salida=($esNumero && $this->driver=='mssql')?$salida."(str({$nomCampo}),{$offset}{$limit})":$salida."({$nomCampo},{$offset}{$limit})";	
		return $salida;
	}
	/**
	 * método que abstrae la funcion concatenar de los diferentes 
	 * sgdb
	 *
	 * @param array  $array array con los nombre de los campos a concatenar
	 * 				si se desaea concatenar ua cadena en espacifico se debe pasar con ' 
	 *@return string $salida cadena con la sintaxis de cada sgbd. 				
	 */
	function concatenar($array=null){
		$salida="";
		$driver=(!is_array($array))?"error":$this->driver;
		switch ($driver){
			case 'mssql':
			case 'sybase':
					$salida.=implode("+",$array);
				break;
			case 'oracle':
			case 'oci8':
			case 'postgres':
			case 'firebird':	
				$salida.=implode("||",$array);
				break;
			case 'mysql':
			 	$salida.="CONCAT(".implode(",",$array).")";
			break;	
		}
		return $salida;
	}
	/**
	 * realiza el cast de una campo o valor 
	 *
	 * @param string  $campo campoa a realizar cast
	 * @param string  $nuevoTipo tipo en el que se convertira
	 * @return  cadena con la funcion cast especifica de cada SGBD soportado
	 */
	function cast($campo,$nuevoTipo){
		$salida="";
		switch ($this->driver){
			case 'mssql':
				$salida="convert({$nuevoTipo},{$campo})";
				break;
			case 'oracle':
			case 'oci8':
				$salida="cast({$nuevoTipo},{$campo})";
				break;
			case 'postgres':
			case 'sybase':	
			case 'mysql':
			case 'firebird':
				$salida="cast({$campo} as {$nuevoTipo})";
				break;
		}
		return $salida;	
	}
	/**
	 * funcion que retorna la funcion roun query de cada motor
	 *
	 * @param string $campo valor a generar en el query 
	 * @return string cadena que se utilizara en el query 
	 */
	function round($valor){
		switch ($this->driver){
			case'oci8':
			case 'mssql':
			case 'oracle':
			case 'postgres':
			case 'mysql':	
			$salida="round({$valor})";
			break;
		}
		return $salida;
	}
}
?>
