<link href="../../estilos/orfeo.css" rel="stylesheet" type="text/css">
<?php
foreach ($_GET as $key => $valor)   ${$key} = $valor;
foreach ($_POST as $key => $valor)   ${$key} = $valor;

$identificadorArchivo .= "_$anexosProceso";
if(!$prcaCodigo) $prcaCodigo = "0";
if($_POST['tipoArchivo']=="tif") {
  $tipoA = "tiff,tif";
}else{
  $tipoA = "jpg,jpeg,gif,png,zip,doc,docx,xls,xlsx,rar,odt,ods,pdf,tif,frm";
}
list($name,$result) = upload('file','../../bodega/tmp/',$tipoA, $identificadorArchivo, $prcaCodigo);
if(trim($result)) echo " <script>alert('Error, El Archivo debe ser de Tipo: ".$tipoA."');</script>";
  include_once "../../include/db/ConnectionHandler.php";
$ruta_raiz = "../..";
  require_once("$ruta_raiz/class_control/Mensaje.php");
  if (!$db) $db = new ConnectionHandler($ruta_raiz);
  $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
if($name) { // Upload Successful
	$details = stat("./");
	$size = $details['size'] / 1024;
	$resultUpload = json_encode(array(
		"success"	=>	$result,
		"failure"	=>	false,
		"file_name"	=>	$name,	// Name of the file - JS should get this value
		"size"		=>	$size	// Size of the file - JS should get this as well.
	));
} else { // Upload failed for some reason.
	$resultUpload = json_encode(array(
		"success"	=>	false,
		"failure"	=>	$result,
	));
}
//echo $resultUpload;
$archivos = explode(",",$resultUpload,5);
echo "<span class=listado2>";
echo "Archivos<br>";
?>
<table class=borde_tab width=100% cellpadding="0" cellspacing="0">
<?
if ($gestor = opendir('../../bodega/tmp/')) {

    /* Esta es la forma correcta de iterar sobre el directorio. */
    $identificadorFile = explode("_",$identificadorArchivo,2);
    while (false !== ($archivo = readdir($gestor))) {
		$archivoFile = explode("_",$archivo,3);
        if($archivoFile[0]==$identificadorFile[0]) {
           echo "<TR class=listado1 cellpadding=0 cellspacing=0><td cellpadding=0 cellspacing=0>";
           echo $archivoFile[2];
           $iSql = "select * from SGD_PRCA_PROCANEXOS where sgd_prc_codigo=$prcCodigo and sgd_prca_codigo=".$archivoFile[1];
           $rsPTipo = $db->conn->Execute($iSql);
           echo "</td><td cellpadding=0 cellspacing=0>";
           echo $rsPTipo->fields["SGD_PRCA_NOMBREARCHIVO"];
           echo "</td></tr>";
           $codigos .= $archivoFile[1].",";
        }
    }
    $codigos .= "0";

?>
</TR></table>
<?
 

    closedir($gestor);
}


echo "</span>";

/**
 * A function for easily uploading files. This function will automatically generate a new 
 *        file name so that files are not overwritten.
 * Taken From: http://www.bin-co.com/php/scripts/upload_function/
 * Arguments:    $file_id- The name of the input field contianing the file.
 *                $folder    - The folder to which the file should be uploaded to - it must be writable. OPTIONAL
 *                $types    - A list of comma(,) seperated extensions that can be uploaded. If it is empty, anything goes OPTIONAL
 * Returns  : This is somewhat complicated - this function returns an array with two values...
 *                The first element is randomly generated filename to which the file was uploaded to.
 *                The second element is the status - if the upload failed, it will be 'Error : Cannot upload the file 'name.txt'.' or something like that
 */
function upload($file_id, $folder="", $types="", $identificadorArchivo, $prcaCodigo) {
    if(!$_FILES[$file_id]['name']) return array('','No file specified');

    $file_title = $_FILES[$file_id]['name'];
    //Get file extension
    $ext_arr = split("\.",basename($file_title));
    $ext = strtolower($ext_arr[count($ext_arr)-1]); //Get the last extension

    //Not really uniqe - but for all practical reasons, it is
    $uniqer = substr(md5(uniqid(rand(),1)),0,5);
	$uniqer = $identificadorArchivo;
    $file_name = $uniqer . '_' . $file_title;//Get Unique Name

    $all_types = explode(",",strtolower($types));
    if($types) {
        if(in_array($ext,$all_types));
        else {
            $result = "'".$_FILES[$file_id]['name']."' is not a valid file."; //Show error if any.
            return array('',$result);
        }
    }

    //Where the file must be uploaded to
    if($folder) $folder .= '/';//Add a '/' at the end of the folder
    $uploadfile = $folder . $file_name;

    $result = '';
    //Move the file from the stored location to the new location
    if (!move_uploaded_file($_FILES[$file_id]['tmp_name'], $uploadfile)) {
        $result = "Cannot upload the file '".$_FILES[$file_id]['name']."'"; //Show error if any.
        if(!file_exists($folder)) {
            $result .= " : Folder don't exist. $folder";
        } elseif(!is_writable($folder)) {
            $result .= " : Folder not writable.";
        } elseif(!is_writable($uploadfile)) {
            $result .= " : File not writable.";
        }
        $file_name = '';
        
    } else {
        if(!$_FILES[$file_id]['size']) { //Check if the file is made
            @unlink($uploadfile);//Delete the Empty file
            $file_name = '';
            $result = "Empty file found - please use a valid file."; //Show the error message
        } else {
            chmod($uploadfile,0777);//Make it universally writable.
            echo '
            <script>
             window.parent.document.getElementById("imgPrc'.$prcaCodigo.'").src = "../imagenes/orfeoOk.png";
            </script>
            ';
        }
    }

    return array($file_name,$result);
}
?>

