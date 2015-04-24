<?php
/**
 * Clase para manejar archivos OpenDocument Text (odt)
 *
 * @author  C'Mauricio Parra Romero
 *          cmauriciop@yahoo.com.mx
 * 			Modificaciones para Masiva -> Johnny Gonzalez
 *			Soporte ODT bajo Microsoft Windows -> Grupo Iyunxi Ltda.
 * @version v1.0 19/08/2005
 */

class OoXml {
  /* Variables */
  var $SO;
  var $barra;
  var $nombreOdt; // Nombre Archivo + Extension
  var $nombreCompletoOdt; // Path + Filename + Ext
  var $cacheDir; // Directorio donde se va a descomprimir
  var $directorio; // Ruta
  var $contenido; // Contenido texto del archivo
  var $fp; // Apuntador
  var $fp2; // Apuntador
  var $permiso; // Permiso del archivo
  var $_debug = false; // TRUE, FALSE
  var $workDir = './bodega/tmp/workDir/'; // Directorio de trabajo para descomprimir el ODT ruta abs
  var $archivoSalida; // Archivo de salida como se va enviar
  
  var $tempContent; //contenido temporal para reemplazos
  var $bodyTagInit = '<office:body>'; //Etiqueta Inicial cuerpo del documento
  var $bodyTagEnd = '</office:body>'; //Etiqueta Final cuerpo del documento
  var $endDocTags = '</office:body></office:document-content>'; //Etiquetas de Finalizacion de Documento ODT
  
  /* Variables privadas */
  var $_errorCode = 0;
  var $_error = '';
  var $_success = '';
  var $cache = true; // Variable para dejar el archivo en el directio
  var $stylesXml = 'word/document.xml';
  //var $cabecerasXml = 'word/styles.xml';
  var $cabecerasXml = 'word/header1.xml';
  var $cabecerasXml2 = 'word/header2.xml';
  var $cabecerasXml3 = 'word/header3.xml';
  var $contenidoCabeceras;
  var $contenidoCabeceras2;
  var $contenidoCabeceras3;
  var $debug = false;
  
  /*Methodos publicos.*/
  /**
   * OpenDocText::OpenDocText()
   * Contructor de la clase
   * @return
   **/
  function OoXml() {
    $this->nombreCompletoOdt = '';
    if (strpos($_SERVER['SERVER_SOFTWARE'], 'Win32')) {
      $this->SO    = 'W';
      $this->barra = '\\';
    } else {
      $this->SO    = 'G';
      $this->barra = '/';
    }
  }
  
  /**
   * OpenDocText::cargarOdt()
   * Carga la informacion del archivo
   * @param $nombreArchivo Nombre del archivo completo con ruta
   * @param $cache Nombre del direcorio donde se va descomprimir el odt con ruta completa
   * @return
   **/
  function cargarOdt($nombreArchivo, $archivoSalida = null) {
    $this->nombreCompletoOdt = realpath($nombreArchivo);
    //$this->archivoSalida = (isset($archivoSalida)) ? $archivoSalida . "_" . rand(0,255): 'archivoOdt' . rand();
    $nom                     = explode(".", $archivoSalida);
    $this->archivoSalida     = $nom[0];
    
    if (is_file($this->nombreCompletoOdt)) {
      $pathParts        = pathinfo($this->nombreCompletoOdt);
      $extension        = $pathParts["extension"];
      $this->directorio = $pathParts["dirname"];
      $this->nombreOdt  = $pathParts["basename"];
      $this->permiso    = fileperms($this->nombreCompletoOdt);
      $this->_success   = "Se cargo exitosamente la informacion de $this->nombreCompletoOdt.\n";
      $error            = ($this->debug == true)?
                  "<center>
                        <table class='borde_tab'>
                          <tr>
                            <td class='titulos2'>
                              Se cargo exitosamente la informacion de $this->nombreCompletoOdt.
                            </td>
                          </tr>
                        </table>" : '';
      echo $error;
      return true;
    } else {
      $this->_errorCode = 2;
      $this->_error     = "El " . $this->nombreCompleto . " no existe o no es un archivo.\n";
      $this->_debug();
      ($this->debug == true) ? ($error = "<CENTER><table class=borde_tab><tr><td class=titulosError>El $this->nombreCompletoOdt o no existe o no es un archivo.</td></tr></table>") : $error = '';
      echo $error;
      return false;
    }
  }
  
  /**
   * OpenDocText::setWorkDir()
   * Carga la informacion del contenido del archivo
   * @return
   **/
  function setWorkDir($workDir) {
    $cambio = false;
    if (is_dir($workDir)) {
      $this->workDir = $workDir;
      $cambio        = chdir($this->workDir);
      if ($cambio) {
        ($this->debug == true) ? ($error = "<CENTER><table class=borde_tab><tr><td class=titulos2>Realiz&oacute; el cambio al directorio  $this->workDir. </td></tr></table>") : $error = '';
        echo $error;
        $this->_success = "Realiz&oacute; el cambio al directorio $this->workDir.\n";
        $this->workDir  = getcwd() . $this->barra;
        $this->cacheDir = $this->workDir . 'cacheODT' . $this->barra;
      } else {
        ($this->debug == true) ? ($error = "<CENTER><table class=borde_tab><tr><td class=titulosError>NO Realiz&oacute; el cambio al directorio  $this->nombreCompletoOdt. </td></tr></table>") : $error = '';
        echo $error;
      }
      return true;
    } else {
      ($this->debug == true) ? ($error = "<CENTER><table class=borde_tab><tr><td class=titulosError>NO Existe; el directorio de trabajo temporal $this->workDir. </td></tr></table>") : $error = '';
      echo $error;
      return false;
    }
  }
  
  /**
   * OpenDocText::abrirOdt()
   * Carga la informacion del contenido del archivo
   * @return
   **/
  function setCacheDir($path = null) {
    if (is_dir($path)) {
      $this->cacheDir = $path;
      return true;
    } else {
      return $this->cacheDir;
    }
  }
  
  /**
   * OpenDocText::abrirOdt()
   * Carga la informacion del contenido del archivo
   * @return
   **/
  function abrirOdt() {
    $nombreDir    = array();
    $verificacion = '';
    $dirTmp       = getcwd() . $this->barra;
    $creoDir      = false;
    $existeDir    = false;
    if ($dirTmp == $this->workDir) {
      $cmd_cp = "cp " . $this->nombreCompletoOdt . " " . $this->cacheDir;
      switch ($this->SO) {
        case 'W':
          $cmd_cp       = "cmd /C copy /Y " . $this->nombreCompletoOdt . " " . $this->cacheDir;
          $WshShell     = new COM('wscript.shell');
          $verificacion = $WshShell->Run($cmd_cp, 0, false);
          $WshShell     = null;
          break;
        default:
          $verificacion = shell_exec($cmd_cp);
          break;
      }
      
      if ($verificacion == '') {
        $nombreDir = explode('.', $this->nombreOdt);
        ($this->debug == true) ? ($error = "<CENTER><table class=borde_tab><tr><td class=titulos2>Copia el archivo : " . $this->nombreCompletoOdt . " a " . $this->cacheDir . "</td></tr></table>") : $error = '';
        echo $error;
        
        $existeDir = is_dir($this->cacheDir . $nombreDir[0]);
        
        if (!$existeDir) {
          $error = ($this->debug == true) ? "<center>
                        <table class='borde_tab'>
                          <tr>
                            <td class='info'>No existe DIR: " . $this->cacheDir . $nombreDir[0] . " luego se crea</td>
                          </tr>
                        </table>" : '';
          echo $error;
          
          $crear_directorio = $this->cacheDir . $nombreDir[0];
          $creoDir = mkdir($crear_directorio, 0777);
          
          if ($creoDir) {
            $error = ($this->debug == true) ? "<center>
                          <table class='borde_tab'>
                            <tr>
                              <td class='titulos2'>Cre&oacute el directorio: " . $this->cacheDir . $nombreDir[0] . " todo ok</td>
                            </tr>
                            </table>" : '';
            echo $error;

            $varTemp = "unzip " . $this->cacheDir . $this->nombreOdt . " -d " . $this->cacheDir . $nombreDir[0];
            
            // Verificacion sistema operativo W = Windows
            switch ($this->SO) {
              case 'W':
                $varTemp      = "cmd /C unzip " . $this->cacheDir . $this->nombreOdt . " -d " . $this->cacheDir . $nombreDir[0];
                $WshShell     = new COM("WScript.Shell");
                $verificacion = $WshShell->Run($varTemp, 0, true);
                $WshShell     = null;
                break;
              default:
                $verificacion = shell_exec($varTemp);
                break;
            }
            
            $error = ($this->debug == true) ? "<center>
                            <table class='borde_tab'>
                              <tr>
                                <td class='titulos2'>$result: Descomprime : " . $varTemp . "</td>
                              </tr>
                            </table>" : '';
            echo $error;
            
            $varTemp = "cp -Rf " . $this->cacheDir . $nombreDir[0] . " " . $this->workDir . $this->archivoSalida;
            
            switch ($this->SO) {
              case 'W':
                $varTemp      = "cmd /C xcopy " . $this->cacheDir . $nombreDir[0] . " " . $this->workDir . $this->archivoSalida . " /E /H /I";
                $WshShell     = new COM("WScript.Shell");
                $verificacion = $WshShell->Run($varTemp, 0, true);
                $WshShell     = null;
                break;
              default:
                $verificacion = shell_exec($varTemp);
                break;
            }
            
            $error = ($this->debug == true) ? "<center>
                              <table class='borde_tab'>
                                <tr>
                                  <td class='titulos2'>Copia : " . $varTemp . "</td>
                                </tr>
                              </table>" : '';
            echo $error;
          } else {
            $error = ($this->debug == true) ? "<center>
                          <table class='borde_tab'>
                            <tr>
                              <td class='titulosError'>No Cre&oacute; el directorio: " . $this->cacheDir . $nombreDir[0] . " Problemas</td>
                            </tr>
                          </table>" : '';
            echo $error;
            
            $this->_errorCode = 10;
            $this->_error     = "No ha sido posible crear el directorio" . $this->cacheDir . $nombreDir[0] . ".\n";
            $this->_debug();
            return false;
          }
        } else {
          chmod($this->cacheDir . $nombreDir[0], 0777);
        }
        
        $varTemp = "cp -rf " . $this->cacheDir . $nombreDir[0] . " " . $this->workDir . $this->archivoSalida;
        switch ($this->SO) {
          case 'W': {
            $varTemp      = "cmd /C xcopy /E /Y /I " . $this->cacheDir . $nombreDir[0] . " " . $this->workDir . $this->archivoSalida;
            $WshShell     = new COM("WScript.Shell");
            $verificacion = $WshShell->Run($varTemp, 0, true);
            $WshShell     = null;
          }
            break;
          default: {
            $verificacion = shell_exec($varTemp);
          }
            break;
        }
        ($this->debug == true) ? ($error = "<CENTER><table class=borde_tab><tr><td class=titulos2>Copia Archivo salida: " . $varTemp . " </td></tr></table>") : $error = '';
        echo $error;
        return true;
      } else {
        return false;
      }
    } else {
      $this->_errorCode = 10;
      $this->_error     = "No se encuentra en el directorio de trabajo $this->workDir.\n";
      $this->_debug();
      return false;
    }
  }
  
  /**
   * OpenDocText::cargarContenido()
   * Carga la informacion del archivo en un arreglo
   * @param $arreglo Arreglo donde se guardara el archivo
   * @return
   **/
  function cargarContenido() {
    $cambio     = false;
    $esDir      = false;
    $directorio = $this->workDir . $this->archivoSalida;
    $esDir      = is_dir($directorio);
    $error      = ($this->debug == true) ? "<CENTER><table class=borde_tab><tr><td class=info>Directorio y archivo salida: $directorio </td></tr></table>" : '';
    echo $error;
    if ($esDir) {
      $varTmp = chmod($directorio, 0777);
      $cambio = chdir($directorio);
      if ($cambio) {
        //Cargo contenido del documento
        if (is_file($this->stylesXml)) {
          ($this->debug == true) ? ($error = "<CENTER><table class=borde_tab><tr><td class=titulos2>Conoce archivo contenido. </td></tr></table>") : $error = '';
          echo $error;
          $this->fp = fopen($this->stylesXml, 'r+');
          if ($this->fp) {
            $this->contenido   = fread($this->fp, filesize($this->stylesXml));
            fclose($this->fp);
            /**$contenido = substr($this->contenido, ($initIndex + strlen( $this -> bodyTagInit )) , strlen( $this -> contenido ));
            ( $this->debug == true) ? ( $error = "<CENTER><table class=borde_tab><tr><td class=titulos2>Contenido leido! $this->contenido </td></tr></table>" ) : $error = '' ; **/
            $this->contenido = $this->contenido;
          } else {
            $this->_errorCode = 10;
            $this->_error     = "No se pudo abrir el archivo $this->stylesXml.\n";
            $this->_debug();
            return false;
          }
        } else {
          $this->_errorCode = 4;
          $this->_error     = "No existe el archivo $this->stylesXml.\n";
          $this->_debug();
          return false;
        }
        
        //Cargo contenido de las cabeceras
        if (is_file($this->cabecerasXml)) {
          $this->fp3 = fopen($this->cabecerasXml, 'r+');
          if ($this->fp3) {
            $this->contenidoCabeceras = fread($this->fp3, filesize($this->cabecerasXml));
            fclose($this->fp3);
          } else {
            $this->_errorCode = 10;
            $this->_error     = "No se pudo abrir el archivo $this->cabecerasXml.\n";
            $this->_debug();
            if ($this->debug == true)
              $error = "<br><b>No existe el archivo de cabeceras.</b>";
            return false;
          }
          
          if (is_file($this->cabecerasXml2)) {
            $this->fp2                 = fopen($this->cabecerasXml2, 'r+');
            $this->contenidoCabeceras2 = (filesize($this->cabecerasXml2)) ? fread($this->fp2, filesize($this->cabecerasXml2)) : $this->contenidoCabeceras2;
            fclose($this->fp2);
          }
          
          if (is_file($this->cabecerasXml3)) {
            $this->fp2                 = fopen($this->cabecerasXml3, 'r+');
            $this->contenidoCabeceras3 = fread($this->fp2, filesize($this->cabecerasXml3));
            fclose($this->fp2);
          }
          
          if ($this->contenidoCabeceras) {
            $this->_success = "Se cargo exitosamente el contenido de $this->cabecerasXml.\n";
            $this->_debug();
            return true;
          } else {
            $this->_errorCode = 4;
            $this->_error     = "No se cargo el contenido de $this->cabecerasXml.\n";
            $this->_debug();
            return false;
          }
        } else {
          $this->_errorCode = 4;
          $this->_error     = "No existe el archivo $this->cabecerasXml.\n";
          $this->_debug();
          return false;
        }
      } else {
        $this->_errorCode = 5;
        $this->_error     = "No existe el directorio $this->archivoSalida.\n";
        $this->_debug();
        return false;
      }
    } else {
      $this->_errorCode = 5;
      $this->_error     = "No existe el directorio $directorio.\n";
      $this->_debug();
      return false;
    }
  }
  
  /**
   * OpenDocText::setVariable()
   *
   * @return
   **/
  function setVariable($nombreVar = array(), $valorVar = array()) {
    $arregloLon  = count($nombreVar);
    $nVar        = '';
    $vVar        = '';
    $tempContent = $this->contenido;
    $tempCab     = $this->contenidoCabeceras;
    $tempCab2    = $this->contenidoCabeceras2;
    $tempCab3    = $this->contenidoCabeceras3;
    
    for ($i = 0; $i < $arregloLon; $i++) {
      $nVar        = ($nombreVar[$i] == null) ? '' : $nombreVar[$i];
      $vVar        = ($valorVar[$i] == null) ? '' : $valorVar[$i];
      $tempContent = str_replace(trim($nVar), trim($vVar), $tempContent);
      $tempContent = str_replace("<br>", "</w:t></w:r></w:p><w:p><w:r><w:t>", $tempContent);
      $tempCab     = str_replace(trim($nVar), trim($vVar), $tempCab);
      $tempCab2    = str_replace(trim($nVar), trim($vVar), $tempCab2);
      $tempCab3    = str_replace(trim($nVar), trim($vVar), $tempCab3);
    }
    
    $this->contenido           = $tempContent;
    $this->contenidoCabeceras  = $tempCab;
    $this->contenidoCabeceras2 = $tempCab2;
    $this->contenidoCabeceras3 = $tempCab3;
    
  }
  
  /**
   * Archivo::crear()
   *
   * @param $nombreCompleto
   * @return
   **/
  function crear($nombreCompleto) {
    if ($this->fp = fopen($nombreCompleto, 'w')) {
      $this->tamano = fwrite($this->fp, $this->contenido);
      fclose($this->fp);
      if (get_class($this) == 'ManejoArchivo') {
        $this->cargarInformacion($nombreCompleto);
      } else {
        ManejoArchivo::cargarInformacion($nombreCompleto);
      }
      $this->_success = "Se creo exitosamente $this->nombreCompleto.\n";
      
      
      $this->_debug();
      return TRUE;
    } else {
      $this->_errorCode = 13;
      $this->_error     = "No se pudo crear $this->nombreCompleto.\n";
      $this->_debug();
      return FALSE;
    }
  }
  
  /**
   * OpenDocText::borrar()
   * Borra un archivo fisico
   * @return
   **/
  function borrar() {
    exec("rm -rf " . $this->cacheDir . "/*");
    exec("rm -rf " . $this->workDir . "/*");
    return TRUE;
  }
  
  /**
   * 
   * Elimina una carpeta incluyendo TODO su contenido
   *
   * @param Char $folderPath
   * @return Boolean
   */
  function RecursiveFolderDelete($folderPath) {
    if (is_dir($folderPath)) {
      foreach (scandir($folderPath) as $value) {
        if ($value != "." && $value != "..") {
          $value = $folderPath . "/" . $value;
          
          if (is_dir($value)) {
            RecursiveFolderDelete($value);
          } elseif (is_file($value)) {
            @unlink($value);
          }
        }
      }
      return rmdir($folderPath);
    } else {
      return FALSE;
    }
  }
  
  /**
   * OpenDocText::copiar()
   * Crea una copia del archivo
   * @param $nombreDestino nombre completo donde se
   * @return
   **/
  function copiar($nombreDestino, $remplazar = FALSE) {
    if (file_exists($nombreDestino) && !($remplazar)) {
      $this->_errorCode = 7;
      $this->_error     = "No se pudo copiar  el contenido de $this->nombreCompleto.\n" . "El archivo  ya existe en el directorio";
      $this->_debug();
      return FALSE;
    } else {
      if (copy($this->nombreCompleto, $nombreDestino)) {
        $this->_success = "Se copio exitosamente el contenido de  $this->nombreCompleto.\n";
        $this->_debug();
        return TRUE;
      } else {
        $this->_errorCode = 7;
        $this->_error     = "No se pudo copiar  el contenido de $this->nombreCompleto.\n";
        $this->_debug();
        return FALSE;
      }
    }
  }
  
  /**
   * OpenDocText::salvarCambios()
   * Introduce la cadena modificada en el archivo styles.xml
   * @param string $contenido Contenido del archivo
   * @return
   **/
  function salvarCambios($archivoTmp, $archivoFinal, $tipoUnitario) {
    $esArchivo = false;
    $esArchivo = is_file($this->stylesXml);
    
    $esArchivoStyles = false;
    $esArchivoStyles = is_file($this->cabecerasXml);
    
    $esArchivoStyles2 = false;
    $esArchivoStyles2 = is_file($this->cabecerasXml2);
    
    //$this->contenido = $this -> contenido . $this -> endDocTags;
    $this->contenido = $this->contenido;
    $error           = '';
    
    if ($esArchivo) {
      ($this->debug == true) ? ($error = "<CENTER><table class=borde_tab><tr><td class=titulos2>Existe el archivo del contenido XML docx! $this->stylesXml </td></tr></table>") : $error = '';
      echo $error;
      $this->fp = fopen($this->stylesXml, 'w');
      
      if ($this->fp) {
        //Escribo contenido
        $tamano = fwrite($this->fp, $this->contenido);
        if ($tamano) {
          ($this->debug == true) ? ($error = "<CENTER><table class=borde_tab><tr><td class=titulos2>Se escribi&oacute; el contenido XML docx! $this->stylesXml </td></tr></table>") : $error = '';
          echo $error;
          
          $this->_success = "Se escribio el contenido exitosamente en $this->stylesXml.\n";
          $this->_debug();
        } else {
          ($this->debug == true) ? ($error = "<CENTER><table class=borde_tab><tr><td class=titulosError>NO SE PUDO escribi&oacute; el contenido XML docx! $this->stylesXml </td></tr></table>") : $error = '';
          echo $error;
        }
        fclose($this->fp);
        
        $tamano = '';
        if ($esArchivoStyles) {
          //Escribo cabeceras
          if ($tipoUnitario == '1') {
            $filePointer = fopen($this->cabecerasXml, 'w');
            $tamano      = fwrite($filePointer, $this->contenidoCabeceras);
            
            $filePointer2 = fopen($this->cabecerasXml2, 'w');
            $tamano2      = fwrite($filePointer2, $this->contenidoCabeceras2);
            fclose($filePointer2);
            if (is_file($this->cabecerasXml3)) {
              $filePointer3 = fopen($this->cabecerasXml3, 'w');
              $tamano3      = fwrite($filePointer3, $this->contenidoCabeceras3);
              fclose($filePointer3);
            }
            if ($tamano) {
              ($this->debug == true) ? ($error = "<CENTER><table class=borde_tab><tr><td class=titulos2>======Se escribi&oacute; el contenido de las cabeceras XML docx! $this->cabecerasXml</td></tr></table>") : $error = '';
              echo $error;
              
              $this->_success = "Se escribio el contenido exitosamente en $this->cabecerasXml.\n";
              $this->_debug();
              
              fclose($filePointer);
              
            } else {
              ($this->debug == true) ? ($error = "<CENTER><table class=borde_tab><tr><td class=titulosError>NO SE PUDO escribir el contenido de las cabeceras XML docx! $this->cabecerasXml </td></tr></table>") : $error = '';
              echo $error;
            }
          }
          ($this->debug == true) ? ($error .= "<CENTER><table class=borde_tab><tr><td class=titulos2>Ya paso por verificacion unitario</td></tr></table>") : $error = '';
        }
        
        $nombreZip = explode(".", $this->archivoSalida);
        $varTemp   = "zip -r " . $this->workDir . $nombreZip[0] . ".docx *";
        $varTempRm = "rm -rf " . $this->workDir . $nombreZip[0] . "/" . $nombreZip[0] . "";
        
        switch ($this->SO) {
          case 'W':
            $varTemp      = "cmd /C chdir /D " . $this->workDir . $nombreZip[0] . " && zip -rq " . $this->workDir . $nombreZip[0] . ".docx *";
            $WshShell     = new COM("WScript.Shell");
            $verificacion = $WshShell->Run($varTemp, 0, false);
            $WshShell     = null;
            break;
          default:
            $verificacion = shell_exec($varTempRm);
            $verificacion = shell_exec($varTemp);
        }
        
        exec("cd " . $this->workDir);
        $ruta = shell_exec("pwd");
        
        if ($archivoTmp != null) {
          ($this->debug == true) ? ($error .= "<CENTER><table class=borde_tab><tr><td class=titulos2> Viene temp</td></tr></table>") : $error = '';
          $vieneTemp = 1;
        } else {
          ($this->debug == true) ? ($error .= "<CENTER><table class=borde_tab><tr><td class=titulos2> No viene temp sino definitivo</td></tr></table>") : $error = '';
          
          $vieneTemp = null;
        }
        
        $intBodega = strpos($this->workDir, $this->barra . "bodega");
        
        if ($intBodega === false) {
          $workDIR      = str_replace($this->barra . "tmp" . $this->barra . "workDir", "", $this->workDir);
          $archivoTmp   = str_replace("." . $this->barra . "bodega", "", $archivoTmp);
          $archivoFinal = str_replace("." . $this->barra . "bodega", "", $archivoFinal);
        } else {
          $workDIR      = str_replace($this->barra . "bodega" . $this->barra . "tmp" . $this->barra . "workDir", "", $this->workDir);
          $archivoTmp   = str_replace("." . $this->barra . "bodega", $this->barra . "bodega", $archivoTmp);
          $archivoFinal = str_replace("." . $this->barra . "bodega", $this->barra . "bodega", $archivoFinal);
        }
        
        if ($vieneTemp != null) {
          ($this->debug == true) ? ($error .= "<CENTER><table class=borde_tab><tr><td class=info>Estamos en pruebas  </td></tr></table>") : $error = '';
          ($this->debug == true) ? ($error .= "<CENTER><table class=borde_tab><tr><td class=info>Exec Copia: " . "cp " . $workDIR . $nombreZip[0] . ".docx " . $workDIR . $archivoTmp . " </td></tr></table>") : $error = '';
          exec("cp " . $this->workDir . $nombreZip[0] . ".docx " . $workDIR . $archivoTmp);
          echo $error;
        } else {
          ($this->debug == true) ? ($error .= "<CENTER><table class=borde_tab><tr><td class=info> Estamos en definitivo  </td></tr></table>") : $error = '';
          ($this->debug == true) ? ($error .= "<CENTER><table class=borde_tab><tr><td class=info> WorkDir: " . $this->workDir . "  </td></tr></table>") : $error = '';
          ($this->debug == true) ? ($error .= "<CENTER><table class=borde_tab><tr><td class=info> Archivo Final: " . $archivoFinal . "  </td></tr></table>") : $error = '';
          
          if ($tipoUnitario == '1') {
            $cmd_cp = "cp " . $this->workDir . $nombreZip[0] . ".docx " .
                          str_replace($this->barra . "tmp" . $this->barra . "workDir",
                                      "",
                                      $this->workDir) . str_replace(".".
                                                                      $this->barra,
                                                                      '',
                                                                      $archivoFinal);
            switch ($this->SO) {
              case 'W':
                $cmd_cp       = str_replace('/', $this->barra, $cmd_cp);
                $cmd_cp       = str_replace('cp ', 'cmd /C move /Y ', $cmd_cp);
                $WshShell     = new COM("WScript.Shell");
                $verificacion = $WshShell->Run($cmd_cp, 0, false);
                $WshShell     = null;
                break;
              default:
                exec($cmd_cp);
            }
          } else {
            $cmd_cp = "cp " . $this->workDir . $nombreZip[0] . ".docx " . $workDIR . str_replace('/', $this->barra, $archivoFinal);
            switch ($this->SO) {
              case 'W':
                $cmd_cp       = "cmd /C copy /Y " . $this->workDir . $nombreZip[0] . ".docx " . $workDIR . $archivoFinal;
                $WshShell     = new COM("WScript.Shell");
                $verificacion = $WshShell->Run($cmd_cp, 0, false);
                $WshShell     = null;
                break;
              default:
                exec($cmd_cp);
                break;
            }
          }
          ($this->debug == true) ? ($error .= "<CENTER><table class=borde_tab><tr><td class=info>Exec Copia: " . $cmd_cp . " </td></tr></table>") : $error = '';
        }
        
        if (chdir($this->workDir)) {
          switch ($this->SO) {
            case 'W': {
              $cmd_del      = "cmd /C rd /S /Q " . $this->workDir . $this->archivoSalida;
              $WshShell     = new COM("WScript.Shell");
              $verificacion = $WshShell->Run($cmd_del, 0, false);
              $WshShell     = null;
            }
              break;
            default: {
              exec("rm -rf " . $this->archivoSalida);
            }
              break;
          }
          if ($archivoTmp)
            return $archivoTmp;
          else if ($archivoFinal)
            return $archivoFinal;
        } else {
          $this->_errorCode = 11;
          $this->_error     = "No se pudo eliminar el directorio $this->archivoSalida.\n";
          $this->_debug();
          return false;
        }
        if ($archivoTmp)
          return $archivoTmp;
        else if ($archivoFinal)
          return $archivoFinal;
      } else {
        $this->_errorCode = 11;
        $this->_error     = "No se pudo abrir el archivo $this->stylesXml.\n";
        $this->_debug();
        return false;
      }
    } else {
      ($this->debug == true) ? ($error = "<CENTER><table class=borde_tab><tr><td class=titulos2>NO Existe el archivo del contenido XML docx! $this->stylesXml No guarda nada.</td></tr></table>") : $error = '';
      echo $error;
      
      //        	( $this->debug == true) ? ( $error = "<br><b>No archivo de Texto, no guarda nada! $this->stylesXml</b>";
      
      $this->_errorCode = 11;
      $this->_error     = "No se pudo abrir el archivo o no se encuentra en directorio $this->stylesXml.\n";
      $this->_debug();
      return false;
    }
  }
  
  /**
   * OpenDocText::limpiarContenido()
   * Borra el contenido del archivo
   * @param string $contenido Contenido del archivo
   * @return
   **/
  function limpiarContenido() {
    $this->fp = fopen($this->nombreCompletoOdt, 'w');
    if ($this->fp) {
      $tamano = fwrite($this->fp, '');
      fclose($this->fp);
      $this->_success = "Se limpio el contenido exitosamente en $this->nombreCompleto.\n";
      $this->_debug();
      return TRUE;
    } else {
      $this->_errorCode = 12;
      $this->_error     = "No se pudo abrir el archivo $this->nombreCompleto.\n";
      $this->_debug();
      return FALSE;
    }
  }
  
  function mover($nombreDestino, $remplazar = FALSE) {
    if (!($this->copiar($nombreDestino, $remplazar))) {
      return false;
    } else {
      $this->borrar();
      $this->_success = "Se movio con exito $nombreDestino";
      $this->_debug();
      return false;
    }
  }
  
  
  /**
   * OpenDocText::descargar()
   *
   * @param $archivo
   * @return
   **/
  function descargar() {
    $nombreCompleto = '';
    $file           = array();
    $mimetype       = 'application/vnd.oasis.opendocument.text';
    //$mimetype		= 'text/plan';
    //$mimetype		= '';
    $file           = explode("_", $this->archivoSalida);
    
    $nombreCompleto = $this->workDir . $file[0] . ".docx";
    $partesNombre   = pathinfo($nombreCompleto);
    
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
    if ($this->_debug) {
      if ($this->_errorCode)
        ("Error    :: $this->_error");
      else
        ("Success  :: $this->_success");
    }
  }
  
  /**
   * OpenDocText::_OpenDocText()
   * Destructor
   * @param $tipoInfo
   * @param $categoria
   * @return
   **/
  function _OpenDocText() {
    unset($this->contenido);
  }
  
  function agregarPagina($valorOriginal, $valorNuevo) {
    
    $this->contenido = str_replace($valorOriginal, $valorNuevo, $this->contenido);
    
  }
  
  function leeryReemplazarEtiquetaDEstilo() {
    
    $cambio     = false;
    $esDir      = false;
    $directorio = $this->workDir . $this->archivoSalida;
    
    $esDir = is_dir($directorio);
    if ($esDir) {
      $varTmp = chmod($directorio, 0777);
      $cambio = chdir($directorio);
      
      //$nVar = '<office:automatic-styles/>';
      //$vVar = '<office:automatic-styles><style:style style:name="P1" style:family="paragraph" style:parent-style-name="Standard"><style:paragraph-properties fo:break-before="page"/></style:style></office:automatic-styles>';
      $nVar     = "";
      $this->fp = fopen($this->stylesXml, 'r+');
      if ($this->fp) {
        $this->contenido = fread($this->fp, filesize($this->stylesXml));
        
        fclose($this->fp);
        
        $this->contenido = str_replace($nVar, $vVar, $this->contenido);
        
        $this->fp = fopen($this->stylesXml, 'w');
        if ($this->fp) {
          $tamanoAP = fwrite($this->fp, $this->contenido);
          if ($tamanoAP) {
          } else {
            $this->_errorCode = 5;
            $this->_error     = "No se pudo escribir en el archivo:  $this->stylesXml.\n";
            $this->_debug();
            return false;
          }
          fclose($this->fp);
          
        } else {
          $this->_errorCode = 5;
          $this->_error     = "No se pudo abrir el archivo $this->fp.\n";
          $this->_debug();
          return false;
        }
        
        //exit();
      } else {
        $this->_errorCode = 5;
        $this->_error     = "No se pudo abrir el archivo $this->fp.\n";
        $this->_debug();
        return false;
      }
    } else {
      $this->_errorCode = 5;
      $this->_error     = "No existe el directorio $this->archivoSalida.\n";
      $this->_debug();
      return false;
    }
  }
  
  function unhtmlspecialchars($string) {
    $string = str_replace('Ã¡', '&aacute;', $string);
    $string = str_replace('Ã©', '&eacute;', $string);
    $string = str_replace('Ã­', '&iacute;', $string);
    $string = str_replace('Ã³', '&oacute;', $string);
    $string = str_replace('Ãº', '&uacute;', $string);
    $string = str_replace('ï¿½?', '&Aacute;', $string);
    $string = str_replace('Ã‰', '&Eacute;', $string);
    $string = str_replace('ï¿½?', '&Iacute;', $string);
    $string = str_replace('Ã“', '&Oacute;', $string);
    $string = str_replace('Ãš', '&Uacute;', $string);
    $string = str_replace('Ã±', '&ntilde;', $string);
    $string = str_replace('Ã‘', '&Ntilde;', $string);
    
    return $string;
  }
  
  function setDebugMode($debugMode) {
    $this->debug = $debugMode;
  }
}
?>
