<?php
  /*
   * Lista Subseries documentales
   * @autor Jairo Losada Supersolidaria 
   * @fecha 2009/06 Modificacion Variables Globales.
   */
  include ('../config.php');
  include (SMARTY_TEMPLATE);
  
  session_start();

  $smarty = new Smarty();
  $smarty->template_dir = TEMPLATE_DIR;
  $smarty->compile_dir  = COMPILE_DIR;
  $smarty->cache_dir    = CACHE_DIR;

  foreach ($_GET as $key => $valor)   ${$key} = $valor;
  foreach ($_POST as $key => $valor)   ${$key} = $valor;
  
  $krd          = $_SESSION["krd"];
  $dependencia  = $_SESSION["dependencia"];
  $usua_doc     = $_SESSION["usua_doc"];
  $codusuario   = $_SESSION["codusuario"];
  $ruta_raiz    = '..'; 
  $causaAccion  = "Asociar Imagen a Radicado";
  
  /**
   * Retorna la cantidad de bytes de una expresion como 7M, 4G u 8K.
   *
   * @param char $var
   * @return numeric
   */
  function return_bytes($val) {
    $val = trim($val);
    $ultimo = strtolower($val{strlen($val)-1});
    switch($ultimo) {
      // El modificador 'G' se encuentra disponible desde PHP 5.1.0
      case 'g':	$val *= 1024;
      case 'm':	$val *= 1024;
      case 'k':	$val *= 1024;
    }
    return $val;
  }

  /*  REALIZAR TRANSACCIONES
   *  Este archivo realiza las transacciones de radicados en Orfeo.
   */

  include ('../include/db/ConnectionHandler.php');
  $db = new ConnectionHandler($ruta_raiz);
 /*
	* Genreamos el encabezado que envia las variable a la paginas siguientes.
	* Por problemas en las sesiones enviamos el usuario.
	* @$encabezado  Incluye las variables que deben enviarse a la singuiente pagina.
	* @$linkPagina  Link en caso de recarga de esta pagina.
	*/
	$encabezado = session_name() . '=' . session_id() .
                '&krd=' . $krd .
                '&depeBuscada=' . $depeBuscada .
                '&filtroSelect=' . $filtroSelect .
                '&tpAnulacion=' . $tpAnulacion;

/*  FILTRO DE DATOS
 *  @$setFiltroSelect  Contiene los valores digitados por el usuario separados por coma.
 *  @$filtroSelect Si SetfiltoSelect contiene algunvalor la siguiente rutina realiza el arreglo de la condicion para la consulta a la base de datos y lo almacena en whereFiltro.
 *  @$whereFiltro  Si filtroSelect trae valor la rutina del where para este filtro es almacenado aqui.
 *
 */
if($checkValue) {
	$num = count($checkValue);
	$i = 0;

	while ($i < $num) {
		$record_id = key($checkValue);
		$setFiltroSelect .= $record_id ;
		$radicadosSel[] = $record_id;
		
    if($i<=($num-2)) {
			$setFiltroSelect .= ",";
		}
  	next($checkValue);
	$i++;
	}

	if ($radicadosSel) {
		$whereFiltro = " and b.radi_nume_radi in($setFiltroSelect)";
	}
}

if($setFiltroSelect) {
	$filtroSelect = $setFiltroSelect;
}

$smarty->assign('FILTROSELECT', $filtroSelect);

/**
 * Aqui se intenta subir el archivo al sitio original
 *
 */
$ruta_raiz = "..";
include ("$ruta_raiz/include/upload/upload_class.php"); //classes is the map where the class file is stored (one above the root)
$max_size = return_bytes(ini_get('upload_max_filesize')); // the max. size for uploading
$my_upload = new file_upload();
$my_upload->language="es";
$my_upload->upload_dir = "$ruta_raiz/bodega/tmp/"; // "files" is the folder for the uploaded files (you have to create this folder)
$my_upload->extensions = array(".tif", ".pdf",  ".jpg", ".odt"); // specify the allowed extensions here
$my_upload->max_length_filename = 50; // change this value to fit your field length in your database (standard 100)
$my_upload->rename_file = true;

if(isset($_POST['Realizar'])) {
	$tmpFile = trim($_FILES['upload']['name']);
	$newFile = $valRadio;
  $uploadDir = "$ruta_raiz/bodega/".substr($valRadio,0,4)."/".substr($valRadio,4,3)."/";
	$fileGrb = substr($valRadio,0,4)."/".substr($valRadio,4,3)."/$valRadio".".".substr($tmpFile,-3);
	$my_upload->upload_dir = $uploadDir;

	$my_upload->the_temp_file = $_FILES['upload']['tmp_name'];
	$my_upload->the_file = $_FILES['upload']['name'];
	$my_upload->http_error = $_FILES['upload']['error'];
	$my_upload->replace = (isset($_POST['replace'])) ? $_POST['replace'] : "n"; // because only a checked checkboxes is true
	$my_upload->do_filename_check = (isset($_POST['check'])) ? $_POST['check'] : "n"; // use this boolean to check for a valid filename
	//$new_name = (isset($_POST['name'])) ? $_POST['name'] : "";
	if ($my_upload->upload($newFile)) {
		// new name is an additional filename information, use this to rename the uploaded file
		$full_path = $my_upload->upload_dir.$my_upload->file_copy;
		$info = $my_upload->get_uploaded_file_info($full_path);
	} else {
	  die("<table class='borde_tab'>
          <tr>
            <td class='titulosError'>
              Ocurrio un Error la Fila no fue cargada Correctamente
              <p>".$my_upload->show_error_string()."<br>
                <blockquote>".nl2br($info)."</blockquote>
              </p>
            </td>
          </tr>
         </table>");
	}
}

  $fecha_transaccion  = date("m-d-Y  g:i A");
  $nombre_usuario     = $_SESSION['usua_nomb'];
  $nombre_dependencia = $_SESSION['depe_nomb'];

  $smarty->assign('CAUSAACCION',  $causaAccion);
  $smarty->assign('VALRADIO',     $valRadio);
  $smarty->assign('INFO',         $info);
  $smarty->assign('FECHA_TRANSACCION', $fecha_transaccion);
  $smarty->assign('NOMBRE_USUARIO', $nombre_usuario);
  $smarty->assign('NOMBRE_DEPENDENCIA', $nombre_dependencia);
  
  $query = "update radicado
  			      set radi_path='$fileGrb'
  			      where radi_nume_radi= $valRadio";

  if($db->conn->Execute($query)) {
    $radicadosSel[] = $valRadio;
    $codTx = 42;	//Código de la transacción
    include "$ruta_raiz/include/tx/Historico.php";
    $hist = new Historico($db);
    $hist->insertarHistorico($radicadosSel,
                              $dependencia,
                              $codusuario,
                              $dependencia,
                              $codusuario,
                              $observa,
                              $codTx);
    
    $consultar_radicado = 'SELECT RA_ASUN
                            FROM RADICADO
                            WHERE RADI_NUME_RADI = ' . $valRadio;
    
    $rs_radicado = $db->conn->Execute($consultar_radicado);

    if (!$rs_radicado->EOF) {
      $asunto_radicado = $rs_radicado->fields['RA_ASUN'];
    }
	}else{
    exit("<hr>No actualizo la imagen <hr>");
  }
  
  $ruta_completa_tif = BODEGA_ORFEO . $fileGrb;
  $ruta_pdf_url      = str_replace('.tif', '.pdf', $fileGrb);
  $ruta_completa_pdf = str_replace('.tif', '.pdf', $ruta_completa_tif);
  $exec_convert = '/usr/bin/convert ' . $ruta_completa_tif . ' ' .
                  $ruta_completa_pdf;
  
  $nombre_servidor = $_SERVER['SERVER_NAME'];
  $url_pdf         = 'http://' . $nombre_servidor . '/bodega/' . $ruta_pdf_url;
  $url_base_orfeo  = 'http://' . $nombre_servidor . '/';

  exec($exec_convert, $exec_output, $exec_return);
  $existe_archivo = is_file($ruta_completa_pdf);

  if (!$existe_archivo) {
    exit('Error Archivo No Existe');
  }
  
  $smarty->assign('URL_BASE_ORFEO', $url_base_orfeo);
  $smarty->assign('RADI_NUME_RADI', $valRadio);
  $smarty->assign('URL_PDF', $url_pdf);
  $smarty->assign('ASUNTO_RADICADO', $asunto_radicado);
  $smarty->display('subir_imagen.tpl');
?>
