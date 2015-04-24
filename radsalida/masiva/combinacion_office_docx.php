<?php
  //Se incluye la clase que maneja la combinación masiva
  include ( "$ruta_raiz/radsalida/masiva/OpenDocText.class.php" );
  
  //Se abre archivo de insumo para lectura de los datos
  $fp = fopen("$ruta_raiz/bodega/masiva/$archInsumo",'r');
  
  if ($fp) {
    $contenidoCSV = file( "$ruta_raiz/bodega/masiva/$archInsumo" );
    fclose($fp);
  } else {
    exit("No hay acceso para crear el archivo $archInsumo");
  }
  
  $accion = false;
  $odt = new OpenDocText();
  
  //Modo debug en false, para pruebas poner true y saldran mensajes de lo que está pasando con la combinacion
  $odt->setDebugMode(false);
  //$odt->debug = true;
    
  //Se carga el archivo odt Original
  $odt->cargarOdt("$ruta_raiz/bodega/masiva/$arcPlantilla", $arcPlantilla);
  $odt->setWorkDir(WORKDIR);
  $accion = $odt->abrirOdt();
  
  if(!$accion){
    die("<center>
          <table class='borde_tab'>
            <tr>
              <td class='titulosError'>
                Problemas en el servidor abriendo archivo ODT para combinaci&oacute;n.
              </td>
            </tr>
          </table>");
  }

  $odt->cargarContenido();
  
  //Se recorre el archivo de insumo
  foreach ($contenidoCSV as $line_num => $line) {
     if ( $line_num == 4 ) { //Esta línea contiene las variables a reemplazar
        $cadaVariable = explode( ',' , $line );
     }else if ( $line_num > 4 ) { //Desde la línea 5 hasta el final del archivo de insumo están los datos de reemplazo
        $cadaValor =  explode( ",",$line ) ;
        $odt->setVariable( $cadaVariable, $cadaValor );
     }
     
     if (connection_status() != 0) {
        $objError = new CombinaError (NO_DEFINIDO);
        echo ($objError->getMessage());
        die;
     }
  }
  
  $tipoUnitario = '0';
  
  //Se guardan los cambios del archivo temporal para su descarga
  $archivoTMP = $odt->salvarCambios( $archivoTmp, null, $tipoUnitario );
  
  $intBodega = strpos($archivoTMP, "/bodega");
  $rutaTMP = ($intBodega === false)? $ruta_raiz . '/bodega' : $ruta_raiz;
  $archivoTmp = str_replace('./', '/', $archivoTmp);
  
  echo ("<BR><span class='info'> Por favor guarde el archivo y verifique que los datos de combinacion  esten correctos <br>");
  echo "<a href='$ruta_raiz/descargar_archivo_masiva.php?ruta_archivo=$archivoTmp&nombre_archivo=$archivoTmp'><span class='$radFileClass'>Guardar Archivo</span></a>";
  //echo ("<a class='vinculos' href=javascript:abrirArchivoaux('$rutaTMP$archivoTMP')>Guardar Archivo </a></span>");
  echo ("<br><br>");
  echo( "<br><input name='enviaDef' type='button'  class='botones' id='envia22'  onClick='enviar()' value='Generar Definitivo'>");
  echo( "<input name='cancel' type='button'  class='botones' id='envia22'  onClick='cancelar()' value='Cancelar'>");
?>
