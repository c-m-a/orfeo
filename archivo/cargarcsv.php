<?
session_start();
$ruta_raiz = "..";
include_once("$ruta_raiz/include/db/ConnectionHandler.php");
include_once("$ruta_raiz/include/combos.php");

/**
 * Retorna la cantidad de bytes de una expresion como 7M, 4G u 8K.
 *
 * @param char $var
 * @return numeric
 */
function return_bytes($val)
{	$val = trim($val);
	$ultimo = strtolower($val{strlen($val)-1});
	switch($ultimo)
	{	// El modificador 'G' se encuentra disponible desde PHP 5.1.0
		case 'g':	$val *= 1024;
		case 'm':	$val *= 1024;
		case 'k':	$val *= 1024;
	}
	return $val;
}
if (!$db)	$db = new ConnectionHandler($ruta_raiz);
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
$phpsession = session_name()."=".session_id();
    $params=$phpsession."&krd=$krd&codusua=$codusua&coddepe=$coddepe";
    $hora=date("H")."_".date("i");
    // var que almacena el dia de la fecha
$ddate=date('d');
// var que almacena el mes de la fecha
$mdate=date('m');
// var que almacena el a�o de la fecha
$adate=date('Y');
// var que almacena  la fecha formateada
$fecha=$adate."_".$mdate."_".$ddate;
$arcCsv=$fecha."_".$hora;
$p=1;
?>
<head>
<title>Cargar en CSV</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="<?=$ruta_raiz."/estilos/".$_SESSION["ESTILOS_PATH"]?>/orfeo.css">
</head>

<body bgcolor="#FFFFFF" topmargin="0" onLoad="window_onload();">
<script language="JavaScript" type="text/JavaScript">

function validar() {

	archCSV = document.formAdjuntarArchivos.archivoCsv.value;

	if ( (archCSV.substring(archCSV.length-1-3,archCSV.length)).indexOf(".csv") == -1 ){
		alert ("El archivo de datos debe ser .csv");
		return false;
	}

	if (document.formAdjuntarArchivos.archivoCsv.value.length<1){
		alert ("Debe ingresar el archivo CSV");
		return false;
	}
	return true;
}

function enviar() {

	if (!validar()){
	<?$carga_tmp=true;?>
		return;
	}
	//document.formAdjuntarArchivos.accion.value="PRUEBA";
	document.formAdjuntarArchivos.submit();
}

</script>
<CENTER>
<form action="cargarcsv.php?<?=$params?>" name="formAdjuntarArchivos" method="POST" enctype="multipart/form-data" >
<?
if ($archivoCsv_size >= 10000000 )
{	echo "el tama&nacute;o de los archivos no es correcto. <br><br><table><tr><td><li>se permiten archivos de 100 Kb m&aacute;ximo.</td></tr></table>";
}
include ("$ruta_raiz/include/upload/upload_class.php");
$max_size = return_bytes(ini_get('upload_max_filesize')); // the max. size for uploading
$my_upload = new file_upload;
 $my_upload->language="es";
$my_upload->upload_dir = "$ruta_raiz/bodega/tmp/"; // "files" is the folder for the uploaded files (you have to create this folder

$my_upload->extensions = array(".csv"); // specify the allowed extensions here
//$my_upload->extensions = "de"; // use this to switch the messages into an other language (translate first!!!)
$my_upload->max_length_filename = 50; // change this value to fit your field length in your database (standard 100)
$my_upload->rename_file = true;
$archivoCsv = $_POST['cargarArchivo'];
if(isset($archivoCsv)) {
	$tmpFile = trim($_FILES['archivoCsv']['name']);
	$newFile = $arcCsv;
	$uploadDir = "$ruta_raiz/bodega/tmp/";
	$fileGrb = $arcCsv;
	$my_upload->upload_dir = $uploadDir;

	$my_upload->the_temp_file = $_FILES['archivoCsv']['tmp_name'];
	$my_upload->the_file = $_FILES['archivoCsv']['name'];
	$my_upload->http_error = $_FILES['archivoCsv']['error'];
	$my_upload->replace = (isset($_POST['replace'])) ? $_POST['replace'] : "n"; // because only a checked checkboxes is true
	$my_upload->do_filename_check = (isset($_POST['check'])) ? $_POST['check'] : "n"; // use this boolean to check for a valid filename
	//$new_name = (isset($_POST['name'])) ? $_POST['name'] : "";
	if ($my_upload->upload($newFile)) {
		// new name is an additional filename information, use this to rename the uploaded file
		$full_path = $my_upload->upload_dir.$my_upload->file_copy;
		$info = $my_upload->get_uploaded_file_info($full_path);
		// ... or do something like insert the filename to the database
		$h = fopen($full_path,"r") ;
		if (!$h)
		{	echo "<BR> No hay un archivo csv llamado *". $full_path."*";
		}
		else
		{	$alltext_csv = "";
			$encabezado = array();
			$datos = array();
			$j=-1;
			while ($line=fgetcsv ($h, 10000, ","))
			//	Comentariada por HLP. Para puebas de arhivo csv delimitado por ;
			//while ($line=fgetcsv ($h, 10000, ";"))
			{
				$j++;
				if ($j==0)
					$encabezado = array_merge ($encabezado,array($line));
				else
					$datos=  array_merge ($datos,array($line));
			} // while get

			//	echo ("El encabezado es " . $this->encabezado[0][0] .", ". $this->encabezado[0][1] .", ". $this->encabezado[0][2] .", ");
			//  echo ("Las lineas de datos son " . count ($this->datos));
			$c=0;
			while ($c < count ($datos))
			{	$c++;	}
		}
		for($ii=0; $ii < count ($datos) ; $ii++)
			{   $i=0;
			$numeroExpediente = "";
 			// Aqui se accede a la clase class_control para actualizar expedientes.
			$ruta_raiz = $ruta_raiz;

			// Por cada etiqueta de los campos del encabezado del CSV efect�a un reemplazo
			foreach($encabezado[0] as $campos_d)
			{
				if (strlen(trim($datos[$ii][$i]))<1 )
					$datos[$ii][$i]="<ESPACIO>";
				$dato_r = $datos[$ii][$i];
				$texto_tmp = str_replace($campos_d,$dato_r,$texto_tmp);
				if($campos_d=="*No_UNIDAD_DOCUMENTAL_BODEGA*") $nun_doc =$dato_r;
				if($campos_d=="*RADICADOS*") $rad =$dato_r;
				if($campos_d=="*CAJA_BODEGA*") $caja =$dato_r;
				if($campos_d=="*UBICACION*") $ubica =$dato_r;
				if($campos_d=="*OBSERVACION*") $observa =$dato_r;
				if($campos_d=="*No_EXPEDIENTE*") $numeroExpediente =$dato_r;
			$i++;
			}

			$sqlm="update sgd_exp_expediente set SGD_EXP_CAJA_BODEGA='$caja', SGD_EXP_CARPETA_BODEGA='$nun_doc',
			SGD_EXP_ASUNTO='$observa' where SGD_EXP_NUMERO LIKE '$numeroExpediente' AND RADI_NUME_RADI LIKE '$rad'";
			$rs3=$db->query($sqlm);
			if($rs3->EOF)$p++;
		}

		if ($p==1)echo "El archivo no pudo ser cargado";
			else echo "El archivo fue cargado con exito";
	}else
	{
	die("<table class=borde_tab><tr><td class=titulosError>Ocurrio un Error la Fila no fue cargada Correctamente <p>".$my_upload->show_error_string()."<br><blockquote>".nl2br($info)."</blockquote></td></tr></table>");
	}



}

	?>
<table width="90%" border="0" cellspacing="5" class="borde_tab">
    <tr align="center">
    <td class="titulos5" colspan="2">Inserte el Nombre del Archivo CSV </td></tr>
<tr>
    <td> <input name="archivoCsv" type="file" class="tex_area" id=archivoCsv  value='<?=$archivoCsv?>'>
<input type=hidden value='cargarArchivo' name=cargarArchivo>
    </td>
    </tr>
    <tr><td align="center"> <input type="button" class="botones_funcion" onClick="enviar();" id="envia22" name="Cargar" value="Cargar">

    <input type="button" class="botones_funcion" value="Cerrar" onclick="window.close();"> </td>
    </tr>
    </table>
</FORM>
