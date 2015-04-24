<?
/*************************************************************************************/
/* ORFEO GPL:Sistema de Gestion Documental		http://www.orfeogpl.org	             */
/*	Idea Original de la SUPERINTENDENCIA DE SERVICIOS PUBLICOS DOMICILIARIOS         */
/*				COLOMBIA TEL. (57) (1) 6913005  yoapoyo@orfeogpl.org                   */
/* ===========================                                                       */
/*                                                                                   */
/* Este programa es software libre. usted puede redistribuirlo y/o modificarlo       */
/* bajo los terminos de la licencia GNU General Public publicada por                 */
/* la "Free Software Foundation"; Licencia version 2. 			                     */
/*                                                                                   */
/* Copyright (c) 2005 por :	  	  	                                                 */
/* SSPS "Superintendencia de Servicios Publicos Domiciliarios"                       */
/*   Jairo Hernan Losada  jlosada@gmail.com                Desarrollador             */
/*   Sixto Angel Pinzón López --- angel.pinzon@gmail.com   Desarrollador           */
/* C.R.A.  "COMISION DE REGULACION DE AGUAS Y SANEAMIENTO AMBIENTAL"                 */ 
/*   Liliana Gomez        lgomezv@gmail.com                Desarrolladora            */
/*   Lucia Ojeda          lojedaster@gmail.com             Desarrolladora            */
/* D.N.P. "Departamento Nacional de Planeación"                                     */
/*   Hollman Ladino       hollmanlp@gmail.com                Desarrollador           */
/*                                                                                   */
/* Colocar desde esta lInea las Modificaciones Realizadas Luego de la Version 3.5    */
/*  Nombre Desarrollador   Correo     Fecha   Modificacion                           */
/*************************************************************************************/
?>
<?
/**
 * Sancionados es la clase encargada de gestionar las operaciones y los datos basicos referentes a la interfaz Orfeo-Sancionados
 * @author      Sixto Angel Pinzon
 * @version     1.0
 */
class Sancionados{
	/**
   * Variable que se corresponde con su par, uno de los campos de la tabla sgd_san_sancionados
   * @var String
   * @access public
   */
	var $sgd_san_decision;
	/**
   * Variable que se corresponde con su par, uno de los campos de la tabla sgd_san_sancionados
   * @var numeric
   * @access public
   */
	var $sgd_san_cargo;
		/**
   * Variable que se corresponde con su par, uno de los campos de la tabla sgd_san_sancionados
   * @var String
   * @access public
   */
	var $sgd_san_expediente;
		/**
   * Variable que se corresponde con su par, uno de los campos de la tabla sgd_san_sancionados
   * @var String
   * @access public
   */
	var $sgd_san_tipo_sancion;
		/**
   * Variable que se corresponde con su par, uno de los campos de la tabla sgd_san_sancionados
   * @var String
   * @access public
   */
	var $sgd_san_plazo;
		/**
   * Variable que se corresponde con su par, uno de los campos de la tabla sgd_san_sancionados
   * @var numeric
   * @access public
   */
	var $sgd_san_valor ;
		/**
   * Variable que se corresponde con su par, uno de los campos de la tabla sgd_san_sancionados
   * @var String
   * @access public
   */
	var $sgd_san_radicacion;
		/**
   * Variable que se corresponde con su par, uno de los campos de la tabla sgd_san_sancionados
   * @var String
   * @access public
   */
	var $sgd_san_fecha_radicado;
   	/**
   * Variable que se corresponde con su par, uno de los campos de la tabla sgd_san_sancionados
   * @var String
   * @access public
   */
	var $sgd_san_valorletras;
		/**
   * Variable que se corresponde con su par, uno de los campos de la tabla sgd_san_sancionados
   * @var String
   * @access public
   */
	var $sgd_san_nombreempresa;
	/**
   * Variable que se corresponde con su par, uno de los campos de la tabla sgd_san_sancionados
   * @var String
   * @access public
   */
	var $sgd_san_motivos;
	/**
   * Variable que se corresponde con su par, uno de los campos de la tabla sgd_san_sancionados
   * @var String
   * @access public
   */
	var $sgd_san_sectores;
		/**
	*/
	/**
   * Variable que se corresponde con su par, uno de los campos de la tabla sgd_san_sancionados
   * @var String
   * @access public
   */
	var $sgd_san_padre;
	/**	
		
	
	/**
   * Variable que se corresponde con su par, uno de los campos de la tabla sgd_san_sancionados
   * @var String
   * @access public
   */
	var $sgd_san_fecha_padre;
	/**
	
		/**
   * Variable que se corresponde con su par, uno de los campos de la tabla sgd_san_sancionados
   * @var String
   * @access public
   */
	var $sgd_san_notificado;
	
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
	function Sancionados($db) {
		$this->cursor = $db;
	}
	
	
	/** 
	* Carga los atributos de la clase con la informacion de sancionados existente para un numero de radicado
	* @param	$radi	String Es el numero delradicado.
	* @return   void
	*/
function sancionadosRad($radi)
{	switch ($this->cursor->driver)
	{
	case 'mssql':	$tmp_conv ="CONVERT(varchar(21), CAST(SGD_SAN_VALOR AS money), 1)";
					break;
	case 'oracle':
	case 'oci8':	
	// Modificado SGD 06-Septiembre-2007
	case 'postgres':	
					$tmp_conv ="to_char(SGD_SAN_VALOR, '99,999,999,999,999.99')";
					break;
	default:		break;
	}
	
	// Modificado SGD 06-Septiembre-2007
	$sql = "select $tmp_conv AS S_VALOR_FORMATO, s.*  from sgd_san_sancionados s where s.sgd_san_ref  ='$radi'";
	$rs =$this->cursor->query($sql);
	if  ($rs && !$rs->EOF)
	{	$this->sgd_san_decision = $rs->fields['SGD_SAN_DECISION'];
		$this->sgd_san_cargo = $rs->fields['SGD_SAN_CARGO']; 
		$this->sgd_san_expediente = $rs->fields['SGD_SAN_EXPEDIENTE']; 
		$this->sgd_san_tipo_sancion = $rs->fields['SGD_SAN_TIPO_SANCION']; 
		$this->sgd_san_plazo  = $rs->fields['SGD_SAN_PLAZO']; 
		$this->sgd_san_valor  = $rs->fields['S_VALOR_FORMATO']; 
		$this->sgd_san_radicacion  = $rs->fields['SGD_SAN_RADICACION']; 
		$this->sgd_san_fecha_radicado  = $rs->fields['SGD_SAN_FECHA_RADICADO']; 
		$this->sgd_san_valorletras  = $rs->fields['SGD_SAN_VALORLETRAS']; 
		$this->sgd_san_nombreempresa  = $rs->fields['SGD_SAN_NOMBREEMPRESA']; 
		$this->sgd_san_motivos = $rs->fields['SGD_SAN_MOTIVOS']; 
		$this->sgd_san_sectores = $rs->fields['SGD_SAN_SECTORES']; 
		$this->sgd_san_padre = $rs->fields['SGD_SAN_PADRE']; 
		$this->sgd_san_fecha_padre = $rs->fields['SGD_SAN_FECHA_PADRE']; 
		$this->sgd_san_notificado = $rs->fields['SGD_SAN_NOTIFICADO']; 
		$this->identificador =  $codigo;
		return true;
	}
	else
	{	$this->sgd_san_decision = "";
		$this->sgd_san_cargo = ""; 
		$this->sgd_san_expediente = ""; 
		$this->sgd_san_tipo_sancion = ""; 
		$this->sgd_san_plazo  = ""; 
		$this->sgd_san_valor  = ""; 
		$this->sgd_san_radicacion  = ""; 
		$this->sgd_san_fecha_radicado  = ""; 
		$this->sgd_san_valorletras  = ""; 
		$this->sgd_san_nombreempresa  = "";
		$this->sgd_san_motivos = "";
		$this->sgd_san_sectores = "";
		$this->sgd_san_padre="";
		$this->sgd_san_fecha_padre="";
		$this->sgd_san_notificado="";
}	}
	
	
	/** 
     * Busca los campos de combinacion que han de incluirse teniendo en cuenta la informacion de sanciondos  y los adiciona a los arreglos que ha de procesar luego la funcion de  combinacion de correspondencia. Debe invocarse antes sancionadosRad()
   	 * @param $campos	arreglo	Etiquetas a combinar
	 * @param $datos	arreglo	Valores de las etiquetas a combinar
	*/
	function obtenerCampos (&$campos,&$datos) {
		$campos[] = "*SAN_DECISION*";
		$datos[] = $this->sgd_san_decision;
		
		$campos[] = "*SAN_CARGO*";
		$datos[] = $this->sgd_san_cargo;
		
		$campos[] = "*SAN_EXPEDIENTE*";
		$datos[] = $this->sgd_san_expediente;
		
		$campos[] = "*SAN_TIPO_SANCION*";
		$datos[] = $this->sgd_san_tipo_sancion;
		
		$campos[] = "*SAN_PLAZO*";
		$datos[] = $this->sgd_san_plazo;
		
		$campos[] = "*SAN_VALOR*";
		$datos[] = $this->sgd_san_valor;
		
		$campos[] = "*SAN_RADICACION*";
		$datos[] = $this->sgd_san_radicacion;
		
		$campos[] = "*SAN_FECHA_RADICADO*";
		$datos[] = $this->sgd_san_fecha_radicado;
		
		$campos[] = "*SAN_VALOR_LETRAS*";
		$datos[] = $this->sgd_san_valorletras;
		
		$campos[] = "*SAN_NOMBRE_EMPRESA*";
		$datos[] = $this->sgd_san_nombreempresa;
		
		$campos[] = "*SAN_MOTIVOS*";
		$datos[] = $this->sgd_san_motivos;
		
		$campos[] = "*SAN_SECTORES*";
		$datos[] = $this->sgd_san_sectores;
		
		$campos[] = "*SAN_PADRE*";
		$datos[] = $this->sgd_san_padre;
		
		$campos[] = "*SAN_FECHA_PADRE*";
		$datos[] = $this->sgd_san_fecha_padre;
		
		$campos[] = "*SAN_NOTIFICADO*";
		$datos[] = $this->sgd_san_notificado;		
		
		
		
	}
	

	
}

?>
