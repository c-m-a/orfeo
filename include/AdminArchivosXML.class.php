<?php
/**
 * Clase para manejar archivos OpenDocument Text (odt)
 * 
 * @author  C'Mauricio Parra Romero
 *          cmauriciop@yahoo.com.mx
 * 			Modificaciones para Masiva -> Johnny Gonzalez
 * @version v1.0 19/08/2005
 */
 
 class AdminArchivosXML {
 /* Variables */
	var $nombreXML;		// Nombre Archivo + Extension
	var $nombreCompletoXML;	// Path + Filename + Ext
	var $cacheDir;		
	var $directorio;	// Ruta
	var $contenido;		// Contenido texto del archivo
	var $fp;		// Apuntador
	var $permiso;		// Permiso del archivo
	var $_debug = false;	// TRUE, FALSE
	var $workDir = '/var/www/orfeo-3.8.0/bodega/tmp/workDir/';	// Directorio de trabajo para descomprimir el ODT ruta abs
	var $archivoSalida;	// Archivo de salida como se va enviar 
	
	var $tempContent;   //contenido temporal para reemplazos

 /* Variables privadas */
    var $_errorCode	= 0;
    var $_error		= '';
    var $_success	= '';
    var $cache		= true;// Variable para dejar el archivo en el directio
    var $stylesXml 	= 'content.xml';

    /*Methodos publicos.*/
    /**
     * AdminArchivosXML::AdminArchivosXML()
     * Contructor de la clase
     * @return 
     **/
    function AdminArchivosXML () {
		$this->nombreCompletoXML = '';
    }

    /**
     * AdminArchivosXML::cargarOdt()
     * Carga la informacion del archivo 
     * @param $nombreArchivo Nombre del archivo completo con ruta
     * @param $cache Nombre del direcorio donde se va descomprimir el odt con ruta completa
     * @return 
     **/
    function cargarXML($nombreArchivo, $archivoSalida = null) {

		$this->nombreCompletoXML = realpath($nombreArchivo);

		$nom = explode( ".", $archivoSalida );
		$this->archivoSalida = $nom[0];
		
		if (is_file($this->nombreCompletoXML)) {
			$pathParts 	  	  = pathinfo($this->nombreCompletoXML);
			$extension 	  	  = $pathParts["extension"];
			$this->directorio = $pathParts["dirname"];
			$this->nombreXML  = $pathParts["basename"];
			$this->permiso    = fileperms($this->nombreCompletoXML);
			$this->_success   = "Se cargo exitosamente la informacion de $this->nombreCompletoXML.\n";

			return true;
		} else {
			$this->_errorCode = 2;
			$this->_error 	  = "El $this->nombreCompleto no existe o no es un archivo.\n";
			$this->_debug();
			echo "<br/>El $this->nombreCompleto o no existe o no es un archivo. <br />\n";
			return false;
		}
    }

    /**
     * AdminArchivosXML::setWorkDir()
     * Carga la informacion del contenido del archivo
     * @return 
     **/
	function setWorkDir ($workDir) {
		$cambio = false;
		if (is_dir($workDir)) {
			$this->workDir = $workDir;
			$cambio = chdir($this->workDir);
			if ($cambio) {
				$this->_success = "Realiz&oacute; el cambio al directorio $this->nombreCompleto.\n";
				$this->workDir = getcwd() . '/';
				$this->cacheDir = $this->workDir . 'cache/';
			}
			return true;
		}
		return false;	
	}
    
    /**
     * AdminArchivosXML::abrirOdt()
     * Carga la informacion del contenido del archivo
     * @return 
     **/
	function setCacheDir ($path = null) {
		if (is_dir($path)) {
			$this->cacheDir = $path;
			return true;
		} else {
			return $this->cacheDir;
		}
	}
    
    /**
     * AdminArchivosXML::abrirOdt()
     * Carga la informacion del contenido del archivo
     * @return 
     **/
    function abrirXML(){
		$nombreDir = array();
		$verificacion = '';
		$dirTmp = getcwd() . '/';
		$creoDir = false;
		$existeDir = false;
		if ($dirTmp == $this->workDir) {
			$verificacion = shell_exec("cp " . $this->nombreCompletoXML . " " . $this->cacheDir);
			if ($verificacion == '') {
				return true;

			} else {
				return false; 
			}
		} else {
			$this->_errorCode = 10;
			$this->_error = "No se encuentra en el directorio de trabajo $this->workDir.\n";
			$this->_debug();
			return false;	
		}
    }

    /**
     * AdminArchivosXML::cargarContenido()
     * Carga la informacion del archivo en un arreglo 
     * @param $arreglo Arreglo donde se guardara el archivo
     * @return 
     **/
    function cargarContenido(){
		$cambio = false;
		$esDir = false;
		$directorio =  $this->cacheDir;
		
			$cambio = chdir( $directorio );

			if ($cambio){
				if(is_file($this->nombreCompletoXML)) {
					$this->fp = fopen( $this->nombreCompletoXML,'r+');
					if ($this->fp) {
						$this->contenido = fread ($this->fp, filesize($this->nombreCompletoXML));
						fclose( $this->fp ) ;
					} else {
						$this->_errorCode = 10;
						$this->_error = "No se pudo abrir el archivo $this->stylesXml.\n";
						$this->_debug();
						return false;
					}
					
					if ($this->contenido) {
						$this->_success = "Se cargo exitosamente el contenido de $this->stylesXml.\n";
						$this->_debug();            
						return true;
					} else {
						$this->_errorCode = 4;
						$this->_error = "No se cargo el contenido de $this->stylesXml.\n";
						$this->_debug();
						return false;
					}
				} else {
					$this->_errorCode = 4;
					$this->_error = "No existe el archivo $this->stylesXml.\n";
					$this->_debug();
					return false;
				}
			} else {
				$this->_errorCode = 5;
				$this->_error = "No existe el directorio $this->archivoSalida.\n";
				$this->_debug();
				return false;
			}
		
    }

    /**
     * AdminArchivosXML::setVariable()
     * 
     * @return 
     **/
    function setVariable($nombreVar = array(), $valorVar = array()){
		$arregloLon = count($nombreVar);
		$nVar = '';
		$vVar = '';
		
		for($i = 0;$i < $arregloLon; $i++){
			$nVar = ($nombreVar[$i] == null) ? '' : $nombreVar[$i];
			$vVar = ($valorVar[$i] == null) ? '' : $valorVar[$i];
			$this ->contenido = str_replace( trim($nVar),trim($vVar),$this ->contenido );
			$posicion = strripos($this->contenido , $nVar);
			
		}
    }
    
   
    
    /**
     * AdminArchivosXML::salvarCambios()
     * Introduce la cadena modificada en el archivo styles.xml
     * @param string $contenido Contenido del archivo
     * @return 
     **/
    function salvarCambios( $archivoTmp, $archivoFinal ){
        $esArchivo = false;
        $ArchivoTemporal = str_replace( ".xml" , "Temp.xml", $this->nombreCompletoXML );
        exec("touch " .  $ArchivoTemporal );
        
        $esArchivo = is_file( $ArchivoTemporal );
		
        if ($esArchivo) {
	        $this->fp = fopen( $ArchivoTemporal ,'w');
	        if ($this->fp) {
	            $tamano = fwrite($this->fp,$this->contenido);
	            if ($tamano) {
	                $this->_success = "Se escibio el contenido exitosamente en $ArchivoTemporal.\n";
	                $this->_debug();    

	            }
	            fclose($this->fp);
	            
			    exec("cd " . $this->workDir );
			    $ruta = shell_exec("pwd");

			    $nuevaRuta = str_replace( "/tmp/workDir/cache", "", $ruta );
			    			    
			    if ($archivoFinal) {

			    	shell_exec("cp " . $ArchivoTemporal . " ". trim( $nuevaRuta ) . trim( $archivoFinal ) ) ;				    	

			    }
			    			   
		    	if(chdir($this->workDir)){
					exec("rm -rf ". $this->archivoSalida);
					return true;
				} else {
					$this->_errorCode =  11;
					$this->_error = "No se pudo eliminar el directorio $this->archivoSalida.\n";
					$this->_debug();
					return false;
				}
	            return true;
	        } else {
	            $this->_errorCode =  11;
	            $this->_error = "No se pudo abrir el archivo $this->nombreCompleto.\n";
	            $this->_debug();
	            return false;
	        }
        } else {
            $this->_errorCode =  11;
            $this->_error = "No se pudo abrir el archivo o no se encuentra en directorio $ArchivoTemporal.\n";
            $this->_debug();
            return false;        	
        }
    }

    /**
     * AdminArchivosXML::limpiarContenido()
     * Borra el contenido del archivo
     * @param string $contenido Contenido del archivo
     * @return 
     **/
    function limpiarContenido(){
		$this->fp = fopen($this->nombreCompletoXML,'w');
		if ($this->fp) {
		    $tamano = fwrite($this->fp,'');
		    fclose($this->fp);
		    $this->_success = "Se limpio el contenido exitosamente en $this->nombreCompleto.\n";
		    $this->_debug();
		    return TRUE;    
		} else {
		    $this->_errorCode =  12;
		    $this->_error = "No se pudo abrir el archivo $this->nombreCompleto.\n";
		    $this->_debug();
		    return FALSE;
		}
    }    
    
    function mover($nombreDestino, $remplazar = FALSE) {
        if (!($this->copiar($nombreDestino, $remplazar))) {
            return FALSE;
        } else {
            $this->borrar();
            $this->_success = "Se movio con exito $nombreDestino";
            $this->_debug();
            return TRUE;
        }
    }
    
	
	/**
	 * AdminArchivosXML::descargar()
	 * 
	 * @param $archivo
	 * @return 
	 **/
	function descargar() {
		$nombreCompleto = '';
		$file			= array();
		$mimetype 		= 'application/vnd.oasis.opendocument.text';
		$file = explode("_",$this->archivoSalida);

		
		$nombreCompleto = $this->workDir . $file[0] . ".odt";
		$partesNombre = pathinfo($nombreCompleto);
	
					
		header("Content-Length: " . filesize($nombreCompleto));
		header("Content-Type: $mimetype");
		

		if (is_file($nombreCompleto)) {
		    header("Content-Disposition: attachment; filename = " . basename($nombreCompleto));
		} else {
			header("Content-Disposition: attachment; filename=" . basename($nombreCompleto));
		}
	        
			
		$leyo = readfile($nombreCompleto);
		if ($leyo) {
			exec("rm -rf " . $this->workDir . $this->archivoSalida);
			exec("rm -rf " . $nombreCompleto);
			return true;
		} else {
			return false;
		}
	}
	
 	/* Metodos Privados */
    function _debug() {
        if ($this->_debug){
            if ($this->_errorCode) echo ("Error    :: $this->_error");
            else echo ("Success  :: $this->_success");
        }
    }
    
   	/**
	 * AdminArchivosXML::_AdminArchivosXML()
	 * Destructor 
	 * @param $tipoInfo
	 * @param $categoria
	 * @return 
	 **/
    function _AdminArchivosXML(){
        unset($this->contenido);
    }
    
    function agregarPagina($valorOriginal, $valorNuevo ){
   	
			$this->contenido = str_replace($valorOriginal,$valorNuevo,$this->contenido);
		
    }
    
    function leeryReemplazarEtiquetaDEstilo(){
    	
    	$cambio = false;
		$esDir = false;
		$directorio = $this->workDir . $this->archivoSalida;
		
		$esDir = is_dir($directorio);
		if ($esDir){
			$varTmp = chmod($directorio,0777);
			$cambio = chdir($directorio);
			
			$nVar = '<office:automatic-styles/>';
			$vVar = '<office:automatic-styles><style:style style:name="P1" style:family="paragraph" style:parent-style-name="Standard"><style:paragraph-properties fo:break-before="page"/></style:style></office:automatic-styles>';
			$this->fp = fopen($this->stylesXml ,'r+');
					if ($this->fp) {
						$this->contenido = fread ($this->fp, filesize($this->stylesXml));
						
						fclose($this->fp);
								
						$this->contenido = str_replace($nVar,$vVar,$this->contenido);
						
						$this->fp = fopen( $this->stylesXml ,'w');
						 if ($this->fp) {
				            $tamanoAP = fwrite($this->fp, $this->contenido);
					            if ($tamanoAP ){
					            }else {
					            	$this->_errorCode = 5;
									$this->_error = "No se pudo escribir en el archivo:  $this->stylesXml.\n";
									$this->_debug();
									return false;
					            }
					            fclose($this->fp);
					            
					        } else {
					           $this->_errorCode = 5;
									$this->_error = "No se pudo abrir el archivo $this->fp.\n";
									$this->_debug();
									return false;
					        }
						
					} else {
						$this->_errorCode = 5;
									$this->_error = "No se pudo abrir el archivo $this->fp.\n";
									$this->_debug();
									return false;
					}
		}else {
				$this->_errorCode = 5;
				$this->_error = "No existe el directorio $this->archivoSalida.\n";
				$this->_debug();
				return false;
		}
    }

 }
?>
