<?
/**
 * Guarda un nuevo radicado o lo elimina del archivo de session
 * del carrito
 */

    //variables enviadas desde js/ajaxSessionRads.js
    $rad        = $_GET["rad"];
    $krd        = $_GET["krd"];
    $accion     = $_GET["accion"];
    
    //ruta y nombre con el que se creara el archivo de session
    $fila       = "../../bodega/tmp/sessR$krd";
    
    //El archivo llevara el nombre del login 
    $archivo    = "sessR$krd";
    
    //Recoger datos del archivo
    $fp         = fopen($fila, "r");    
    $contents   = fread($fp, filesize($fila));    
    fclose($fp);
    
    //Separar el contenido en un array
    $result     = explode(",", $contents);
    //Extraer solo los datos numericos
    $arrayData  = array_filter($result, "is_numeric");
    //Contar la cantidad de radicados que tiene el archivo
    $radActuales= count($arrayData);
    
    //Si existe el archivo y corresponde al usuario calcule No Radicados.
    if ((substr($contents, 0, strlen($archivo)) == $archivo) && file_exists($fila)) {
        //Si deselecciona el radicado eliminelo        
        if ($accion == "false") {           
            $contents = str_replace( "$rad,", "" ,$contents);
            $fp = fopen($fila, 'w');            
            fwrite($fp, $contents);
            //si el archivo esta sin datos no descuente
            if(!empty($radActuales))
            $radActuales--;            
        } else {
            $fp = fopen($fila, 'a');
            fwrite($fp, "$rad,");
            $radActuales++;                                              
        }
        fclose($fp);   
        //Numero de radicados que contiene el archivo.   
        echo $radActuales;                        
    } else {
        //Si no exite session muestre blanco
        echo " ";
    }       
?>