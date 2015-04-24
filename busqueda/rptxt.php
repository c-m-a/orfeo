<?php
 if(!$PHPSESSID) $PHPSESSID = $_GET["PHPSESSID"] ."*";
 session_start();$fecha=date('Ymd_his');
//$pathxml = "../bodega/tmp/consulta".$fecha.".csv";
$pathtxt = "../bodega/tmp/consulta".$fecha.".html";

echo $path."\n"."11";  
$ADODB_COUNTRECS = false;
$ruta_raiz="..";
include_once("$ruta_raiz/config.php");                  // incluir configuracion.
include_once("$ruta_raiz/include/db/ConnectionHandler.php");
//include_once("$ruta_raiz/adodb/adodb-paginacion.inc.php");^M
        
$db = new ConnectionHandler("$ruta_raiz");
if ($db){       
        $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
        $query=unserialize($_SESSION['array']);//var_dump ($query);
        $rs=$db->conn->execute($query);//echo "888888888";
//        echo $_SESSION['array']."8888888888888bnsession"; 

/*
function array_recibe($url_array) {
     $tmp = stripslashes($url_array);
     $tmp = urldecode($tmp);
     $tmp = unserialize($tmp);

    return $tmp;
}
if (!$_POST['array']){echo 'paiiilas';}else {var_dump ($_POST['array']);}echo "bn";
$array=$_POST['array'];
$rs=array_recibe($array); echo $rs."qq";
var_dump ($rs);
//foreach ($array as $indice => $valor){
//echo $indice." = ".$valor."<br>";    } */
//$fp = fopen($pathxml, "w");
$fptxt= fopen($pathtxt, "w");

fwrite($fptxt, $line);
	if ($fptxt) { header('Content-type: application/vnd.ms-word');header("Content-Disposition: attachment; filename='$pathtxt'.");header("Pragma: no-cache");header("Expires: 0");echo ("<table border=1>");


//fwrite($fp, $line);
fwrite($fptxt, $line);

 while(!$rs->EOF){echo ("<tr>");
   $line = $rs->fields["RADI_NUME_RADI"].",";
   $line .= $rs->fields["RADI_FECH_RADI"].",";
   $line .= $rs->fields["RA_ASUN"].",";
   $line .= $rs->fields["SGD_TPR_DESCRIP"].",";
   $line .= $rs->fields["DIASR"].",";
   $line .= $rs->fields["RADI_NUME_HOJA"].",";
   $line .= $rs->fields["SGD_DIR_DIRECCION"].",";
   $line .= $rs->fields["SGD_DIR_MAIL"].",";
   $line .= $rs->fields["SGD_DIR_NOMREMDES"].",";
   $line .= $rs->fields["SGD_DIR_TELEFONO"].",";
   $line .= $rs->fields["SGD_DIR_DOC"].",";
   $line .= $rs->fields["RADI_USU_ANTE"].",";
   $line .= $rs->fields["RADI_PAIS"].",";
   $line .= $rs->fields["SGD_DIR_NOMBRE"].",";
   $line .= "\n"; echo ("<td>$line</td>");
//   fwrite($fp, $line);
fwrite($fptxt, $line);
   $rs->MoveNext();	
 }echo ("</table>");
//fclose($fp);
fclose($fptxt);
$rs->MoveFirst();
}

}else {echo 'No realiza consulta. Favor comunicarse con el Admin del sistema';}
?>
