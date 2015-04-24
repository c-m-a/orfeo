<? /**
 * CombinaError es la clase encargada de gestionar los mensajes de errores presentadas al tratar de combinar un documento
 * @author      Sixto Angel Pinzon
 * @version     1.0
 */
require_once("$ruta_raiz/class_control/Error.php");
define("NO_DEFINIDO", 0);
define("PLANTILLA_INCORRECTA", 1);
define("ERROR_RED", 2);

class CombinaError extends Error {	     	
		
	/** 
	* Constructor encargado de inicializar el código de error
	* @param	$code	Es el código del error
	* @return   void
	*/
   function CombinaError($code = 0) {
   		Error::Error($code);
   		Error::setMessage($this->tipoError($code));
	}

   /** 
	* Funcion encargada de obtener el mensaje de error de acuerdo al codigo del error
	* @param	$code	Es el codigo del error
	* @return   void
	*/
    function tipoError($code = 0) {
    	
    	if ($code==NO_DEFINIDO){
    		$error = "<BR> No se pudo completar la transaccion debido a posibles problemas como: ".
    				 "<BR> ".
    				 "<BR> - Su archivo de combinaci&oacute;n no corresponde a la plantilla establecida. ".
    				 "<BR> - Problemas con el servidor de combinacion de documentos. ".
    				 "<BR> - Problemas con la red. ".
	  	  			 "<BR> - Por favor verifique e intente mas tarde ";
	   	}
	   	
	    $error.="<BR> <input type='button' name='Regresar' value='Regresar' class='ebuttons2' onClick='history.go(-1);'>";
	    return $error;
    }  	
    
    /** 
     * Retorna el valor string correspondiente al atributo texto del error
     * @return   string
     */
    function getMessage(){
    	return Error::getMessage()	;
    }

}


?>
