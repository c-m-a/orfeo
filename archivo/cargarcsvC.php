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
<form action="cargarcsvC.php?<?=$params?>" name="formAdjuntarArchivos" method="POST" enctype="multipart/form-data" >
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
				if($campos_d=="*VIGENCIA*") $vigencia =$dato_r;
				if($campos_d=="*NRO_ORDEN*") $orden =$dato_r;
				if($campos_d=="*FECHA_INICIAL*") $fechai =$dato_r;
				if($campos_d=="*FECHA_FINAL*") $fechaf =$dato_r;
				if($campos_d=="*DEPENDENCIA*") $dependencia =$dato_r;
				if($campos_d=="*USUARIO*") $usuario =$dato_r;
				if($campos_d=="*DOCUMENTO_DE_IDENTIDAD*") $docu =$dato_r;
				if($campos_d=="*DIRECCION*") $dir =$dato_r;
				if($campos_d=="*SERIE*") $serie =$dato_r;
				if($campos_d=="*SUBSERIE*") $subserie =$dato_r;
				if($campos_d=="*TIPO*") $tipo =$dato_r;
				if($campos_d=="*FOLIOS*") $folios =$dato_r;
				if($campos_d=="*ZONA*") $zona =$dato_r;
				if($campos_d=="*CARRO*") $carro =$dato_r;
				if($campos_d=="*CARA*") $cara =$dato_r;
				if($campos_d=="*ESTANTE*") $estante =$dato_r;
				if($campos_d=="*ENTREPANO*") $entrepano =$dato_r;
				if($campos_d=="*CAJA_DESDE*") $cajad =$dato_r;
				if($campos_d=="*CAJA_HASTA*") $cajah =$dato_r;
				if($campos_d=="*UNIDAD_DOCUMENTAL*") $ud =$dato_r;
				if($campos_d=="*NRO_CARPETAS*") $carpetas =$dato_r;
				if($campos_d=="*OBSERVACIONES*") $observ =$dato_r;
				if($campos_d=="*INDICADORES_DE_DETERIORO*") $ind =$dato_r;
				if($campos_d=="*MATERIAL_INSERTADO*") $mi =$dato_r;
				if($campos_d=="*FAUTO*") $fauto =$dato_r;
				if($campos_d=="*PRESTAMO*") $prestamo =$dato_r;
				if($campos_d=="*FUNCIONARIO_PRESTAMO*") $fprestamo =$dato_r;
			$i++;
			}
			$sec=$db->conn->nextId('SEC_CENTRAL');
			if($sec<10)$sec='0000'.$sec;
			elseif($sec<100)$sec='000'.$sec;
			elseif($sec<1000)$sec='00'.$sec;
			elseif($sec<10000)$sec='0'.$sec;
			$rad=$ano.$depe.$sec."C";
			$sqlm="insert into sgd_archivo_central(SGD_ARCHIVO_ID,SGD_ARCHIVO_RAD,SGD_ARCHIVO_FECH, SGD_ARCHIVO_ORDEN, SGD_ARCHIVO_FECHAI, SGD_ARCHIVO_FECHAF,SGD_ARCHIVO_YEAR ,SGD_ARCHIVO_DEPE,SGD_ARCHIVO_DEMANDANTE, SGD_ARCHIVO_CC_DEMANDANTE, SGD_ARCHIVO_DIR, SGD_ARCHIVO_SRD ,SGD_ARCHIVO_SBRD ,SGD_ARCHIVO_PROC,SGD_ARCHIVO_FOLIOS ,SGD_ARCHIVO_ZONA,SGD_ARCHIVO_CARRO,SGD_ARCHIVO_CARA,
SGD_ARCHIVO_ESTANTE,SGD_ARCHIVO_ENTREPANO,SGD_ARCHIVO_CAJA,SGD_ARCHIVO_CAJA2,SGD_ARCHIVO_UNIDOCU,SGD_ARCHIVO_NCARP ,SGD_ARCHIVO_ANEXO,
SGD_ARCHIVO_INDER,SGD_ARCHIVO_MATA, SGD_ARCHIVO_FECHAA,SGD_ARCHIVO_PRESTAMO ,SGD_ARCHIVO_FUNPREST) values (".$sec.",'"$rad"',current_timestamp,'".$orden."',to_date('".$fechai."','dd/mm/YYYY'),to_date('".$fechaf."','dd/mm/YYYY'),".$vigencia.",".$dependencia.",'".$usuario."','".$cedula."','".$dir."',".$serie.",".$subserie.",".$tipo.",".$folios.",'".$zona."',".$carro.",'".$cara."',".$estante.",".$entrepano.",".$cajad.",".$cajah.",'".$ud."',".$carpetas.",'"$observ"',".$ind.",".$mi.",to_date('".$fauto."','dd/mm/YYYY'),".$prestamo.",to_date('".$fprestamo."','dd/mm/YYYY'))";
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
