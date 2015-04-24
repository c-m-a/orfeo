<?
/**
 * AplIntegrada es la clase encargada de gestionar las operaciones y  los datos basicos referentes a una aplicacion integrada con Orfeo
 * @author      Sixto Angel Pinzon
 * @version     1.0
 */
class  AplIntegrada{
	/**
   * Variable que se corresponde con su par, uno de los campos de la tabla SGD_APLI_APLINTEGRA
   * @var numeric
   * @access public
   */
	var $sgd_apli_codi;
	 /**
   * Variable que se corresponde con su par, uno de los campos de la tabla SGD_APLI_APLINTEGRA
   * @var string
   * @access public
   */
	var $sgd_apli_descrip;
	 /**
   * Variable que se corresponde con su par, uno de los campos de la tabla SGD_APLI_APLINTEGRA
   * @var string
   * @access public
   */
	var $sgd_apli_lk1;
	 /**
   * Variable que se corresponde con su par, uno de los campos de la tabla SGD_APLI_APLINTEGRA
   * @var string
   * @access public
   */
	var $sgd_apli_lk2;
	 /**
   * Variable que se corresponde con su par, uno de los campos de la tabla SGD_APLI_APLINTEGRA
   * @var string
   * @access public
   */
	var $sgd_apli_lk3;
	 /**
   * Variable que se corresponde con su par, uno de los campos de la tabla SGD_APLI_APLINTEGRA
   * @var string
   * @access public
   */
	var $sgd_apli_lk4;
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
	function AplIntegrada($db) {
		$this->cursor = $db;
	}



   /**
   * Carga los datos de la instacia con un codigo de departamento suministrado
   * @param	$codigo	int	es el codigo del departamento
   */
	function AplIntegrada_codigo($codigo){

	//si se ingresa un parametro valido
		if (strlen($codigo>0)){
			//almacena el query
			$q= "select *  from SGD_APLI_APLINTEGRA
             where SGD_APLI_CODI =$codigo";
			$rs=$this->cursor->query($q);

			if  (!$rs->EOF){
				$this->sgd_apli_codi=$rs->fields['SGD_APLI_CODI'];
				$this->sgd_apli_descrip =$rs->fields['SGD_APLI_DESCRIP'];
				$this->sgd_apli_lk1=$rs->fields['SGD_APLI_LK1'];
				$this->sgd_apli_lk2=$rs->fields['SGD_APLI_LK2'];
				$this->sgd_apli_lk3=$rs->fields['SGD_APLI_LK3'];
				$this->sgd_apli_lk4=$rs->fields['SGD_APLI_LK4'];


			}
		}else{
			$this->sgd_apli_codi="";
			$this->sgd_apli_descrip="";
			$this->sgd_apli_lk1 = "";
			$this->sgd_apli_lk2 = "";
			$this->sgd_apli_lk3 = "";
			$this->sgd_apli_lk4 = "";
  		}

	}


	function get_sgd_apli_codi(){
		return $this->sgd_apli_codi;
	}


	function get_sgd_apli_descrip(){
		return  $this->sgd_apli_descrip;
	}


	function get_sgd_apli_lk1(){
		return  $this->sgd_apli_lk1;
	}


	function get_sgd_apli_lk2(){
		return  $this->sgd_apli_lk2;
	}


	function get_sgd_apli_lk3(){
		return  $this->sgd_apli_lk3;
	}


	function get_sgd_apli_lk4(){
		return  $this->sgd_apli_lk4;
	}


/**
* Genera el javascript que ha de permitir llenar un combo con las aplicaciones que un usuario puede o integrar a la hora de generar cierto tipo de radicacion
* @param	$usua_doc	string	es el documento del usuario que integraría los aplicativos
* @return   integer	Retorna OK si el usuario tiene perfil de integrar aplicativos o el código del tipo de radicación para el que se haya establecido prioriad
*/
	function comboRadiAplintegra($usua_doc){
		$retorno="0";
		echo " function comboRadiAplintegra(forma,radicacion,combo)";
        echo "{";
			 //   echo " alert ('entra a nivel educativo']; ";
				echo "o = new Array;";
				echo "oPrioridad = new Array;";
				echo "i=0;";
				echo "swPrioridad=0;";
				echo "j=1;";
			//	 echo " o[i++]=new Option('----- seleccione -----', 'null',true,true); ";

     // $this->cursor->conn->debug=true;
     $dbsql2 = "SELECT u.SGD_TRAD_CODIGO, a.SGD_APLI_DESCRIP, a.SGD_APLI_CODI, u.SGD_APLUS_PRIORIDAD
				FROM SGD_APLI_APLINTEGRA a, SGD_APLUS_PLICUSUA u
				WHERE a.SGD_APLI_CODI = u.SGD_APLI_CODI AND (u.USUA_DOC = '$usua_doc') AND (a.SGD_APLI_CODI <> 0)";
		 $rs=$this->cursor->query($dbsql2);


          while	($rs && !$rs->EOF)
			{
			$retorno="OK";
			echo " if (radicacion == ". $rs->fields['SGD_TRAD_CODIGO'] . " ) { ";

			$descripcion = chop ($rs->fields['SGD_APLI_DESCRIP']);
			$descripcion=str_replace("'", "", $descripcion);
			echo "o[i++]=new Option('$descripcion','". $rs->fields['SGD_APLI_CODI'] ."' );";

			if ($rs->fields['SGD_APLUS_PRIORIDAD'] == 1){
				$retorno=$rs->fields['SGD_TRAD_CODIGO'];
				echo "swPrioridad=1;";
				echo "oPrioridad[0]=new Option('$descripcion','". $rs->fields['SGD_APLI_CODI'] ."' );";
			}

           echo ("}");
           $rs->MoveNext();
          }


        echo " if (swPrioridad == 1) { ";
        	echo "j=0;";

        echo "} else  ";
        echo "   eval(forma.elements[combo].options[0]=new Option('No integra aplicativo','null' )); ";

        //Aplicacion


        echo " for (i=0; i < o.length; i++) ";
        echo " { ";
	 // echo "  alert( '!!!entra1!!!'];";
        echo "   eval(forma.elements[combo].options[i+j]=o[i]); ";
 	 // echo "  alert( '!!!entra2!!!'];";

        echo " } ";

      	echo " eval(forma.elements[combo].length=o.length+j); ";



			echo " } ";

		return $retorno;
	}


/**
* Genera el javascript que ha de permitir seleccionar cierto tipo de aplicativo integrado
* @return   integer	Retorna OK si el usuario tiene perfil de integrar aplicativos o el código del tipo de radicación para el que se haya establecido prioriad
*/
	function comboRadiAplisel(){
		$retorno="0";
		echo " function comboRadiAplisel(forma,aplicacion,combo)";
        echo "{";
			 //   echo " alert ('entra a nivel educativo']; ";
				echo "o = new Array;";
				echo "oPrioridad = new Array;";
				echo "i=0;";
				echo "swPrioridad=0;";
				echo "j=1;";
			//	 echo " o[i++]=new Option('----- seleccione -----', 'null',true,true); ";

     // $this->cursor->conn->debug=true;
     $dbsql2=  "select a.SGD_APLI_DESCRIP,a.SGD_APLI_CODI from SGD_APLI_APLINTEGRA a where
		               a.SGD_APLI_CODI<> 0  ";
		 $rs=$this->cursor->query($dbsql2);


          while	($rs && !$rs->EOF)
			{
			$retorno="OK";
			echo " if (aplicacion == ". $rs->fields['SGD_APLI_CODI'] . " ) { ";

			$descripcion = chop ($rs->fields['SGD_APLI_DESCRIP']);
			$descripcion=str_replace("'", "", $descripcion);
			echo "o[i++]=new Option('$descripcion','". $rs->fields['SGD_APLI_CODI'] ."' );";



           echo ("}");
           $rs->MoveNext();
          }




        //Aplicacion


        echo " for (i=0; i < o.length; i++) ";
        echo " { ";
	 // echo "  alert( '!!!entra1!!!'];";
        echo "   eval(forma.elements[combo].options[i]=o[i]); ";
 	 // echo "  alert( '!!!entra2!!!'];";

        echo " } ";

      	echo " eval(forma.elements[combo].length=1); ";



			echo " } ";

		return $retorno;
	}
}



?>
