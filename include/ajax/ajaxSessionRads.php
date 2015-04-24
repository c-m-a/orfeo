<? 
    $accionSession  = $_GET["accionSession"];
    $krd            = $_GET["krd"];
   
    $archivo = "sessR$krd";
    $fila = "../../bodega/tmp/$archivo";
    
    if ($accionSession == "activar") {
        $fp = fopen($fila, "r");
        $contents = fread($fp, filesize($fila));
        fclose($fp);
       
        if (substr($contents, 0, strlen($archivo)) == $archivo) {
            //si ya existia session
            echo "ok!";
        } else {
            $fp = fopen($fila, 'w');
            $contents = $archivo.",";
            fwrite($fp, $contents);
            fclose($fp);
            //Si la session esta activa.
            echo "ok";
        }
    } else {
        $fp = fopen($fila, 'w');
        $contents = "No Hay Session";
        fwrite($fp, $contents);
        fclose($fp);
        echo " ";
    }
?>
