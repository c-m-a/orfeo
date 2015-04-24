<?php
 if(!$PHPSESSID) $PHPSESSID = $_GET["PHPSESSID"] ."*";
 session_start();$fecha=date('Ymd_his');
//$pathxml = "../bodega/tmp/consulta".$fecha.".csv";
$pathxml = "../bodega/tmp/consulta".$fecha.".csv";

//echo $pathexcel."\n"."11";  
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
//$fp = fopen($pathxml, "w");i
//echo"##############333333333333333333333333333333";
$line ="Radicado,Fecha Radicacion,Expediente,Asunto,Tipo de Documento,Tipo,Numero de Hojas,Direccion contacto,Telefono contacto,Mail Contacto,D    ignata    rio,Nombre,Documento,Usuario Actual,Dependencia Actual,Usuario Anterior,Pais,Dias Restantes,\n";
echo $line;
$fpxml= fopen($pathxml, "w");

//fwrite($fpxml, $line);
	if ($fpxml) { header('Content-type: application/vnd.ms-excel');header("Content-Disposition: attachment; filename=$pathexcel");header("Pragma: no-cache");header("Expires: 0");

$line ="Radicado,Fecha Radicacion,Expediente,Asunto,Tipo de Documento,Tipo,Numero de Hojas,Direccion contacto,Telefono contacto,Mail Contacto,D    ignatario,Nombre,Documento,Usuario Actual,Dependencia Actual,Usuario Anterior,Pais,Dias Restantes,\n";

//fwrite($fp, $line);
fwrite($fpxml, $line);

 while(!$rs->EOF){
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
   $line .= "\n"; echo ("$line");
//   fwrite($fp, $line);
//fwrite($fpxml, $line);
   $rs->MoveNext();	
 }echo ("</table>");
//fclose($fp);
fclose($fpxml);
$rs->MoveFirst();
}

}else {echo paykliaaaaas;}
?>
