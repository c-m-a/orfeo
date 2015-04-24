<?php
  /*
   * Lista Subseries documentales
   * @autor Cmauricio Parra
   * @fecha 2009/06 Modificacion Variables Globales.
   */
  
  session_start();
  include ('../config.php');
  include(SMARTY_TEMPLATE);
  
  foreach ($_GET as $key => $valor)   ${$key} = $valor;
  foreach ($_POST as $key => $valor)   ${$key} = $valor;

  $smarty = new Smarty();
  $smarty->template_dir = TEMPLATE_DIR;
  $smarty->compile_dir  = COMPILE_DIR;
  $smarty->cache_dir    = CACHE_DIR;

  $numero_radicado  = 0;
  $nombre_archivo   = '';
  $observacion      = 'Digitalizacion Imagen Radicado';
  $tipos_radicados[1] = 'Salida';
  $tipos_radicados[2] = 'Entrada';
  
  $ruta_archivo = (isset($_GET['ruta_archivo']))? $_GET['ruta_archivo'] : null;
  $nombre_encontrado = preg_match('/[0-9]+\.[a-zA-Z]+/', $ruta_archivo, $arreglo_nombres);

  if ($nombre_encontrado)
    $nombre_archivo = $arreglo_nombres[0];
  else
    exit('Error en el formato del archivo Consulte al administrador del sistema');
  
  $radicado_encontrado = preg_match('/[0-9]+/', $nombre_archivo, $arreglo_radicados);

  if ($radicado_encontrado)
    $numero_radicado = $arreglo_radicados[0];
  else
    exit('Error en el formato de radicado');
  
  $tipo_radicado = substr($numero_radicado, -1);
  $observacion  .= ' ' . $tipos_radicados[$tipo_radicado]; 
  
  $krd          = $_SESSION['krd'];
  $dependencia  = $_SESSION['dependencia'];
  $usua_doc     = $_SESSION['usua_doc'];
  $codusuario   = $_SESSION['codusuario'];
  $ruta_raiz    = '..';
  $nombre_usuario = $_SESSION['usua_nomb'];
  $nombre_dependencia = $_SESSION['depe_nomb'];

  require_once($ruta_raiz . '/class_control/Dependencia.php');
  
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
  
  // Inclusion de archivos para utiizar la libreria ADODB
  include_once "$ruta_raiz/include/db/ConnectionHandler.php";
  $db = new ConnectionHandler($ruta_raiz);
  $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
  $objDep = new Dependencia($db);
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
	
  $linkPagina = $PHP_SELF . '?' .
                $encabezado .
                '&orderTipo=' . $orderTipo .
                '&orderNo=';
  
  $enlace_subir_archivo = 'subir_imagen.php?' . $encabezado;
  $src_imagen_tux = $ruta_raiz . '/iconos/tuxTx.gif';
  $maximo_tamano  = return_bytes(ini_get('upload_max_filesize'));
  $max_tamano     = ini_get('upload_max_filesize');
  
  $smarty->assign('ENLACE_SUBIR_ARCHIVO', $enlace_subir_archivo);
  $smarty->assign('DEPSEL8',          $depsel8);
  $smarty->assign('CODTX',            $codTx);
  $smarty->assign('ENVIARAV',         $EnviaraV);
  $smarty->assign('FECHAAGENDA',      $fechaAgenda);
  $smarty->assign('NOMBRE_USUARIO',   $nombre_usuario);
  $smarty->assign('NOMBRE_DEPENDENCIA', $nombre_dependencia);
  $smarty->assign('SRC_IMAGEN_TUX',   $src_imagen_tux);
  $smarty->assign('OBSERVACION',      $observacion);
  $smarty->assign('MAXIMO_TAMANO',    $maximo_tamano);
  $smarty->assign('MAX_TAMANO',       $max_tamano);
  $smarty->assign('RUTA_ARCHIVO',     $ruta_archivo);
  $smarty->assign('NUMERO_RADICADO',  $numero_radicado);
  $smarty->assign('DEPSEL',           $depsel);
  $smarty->display('asociacion_rapida_imagen.tpl');
	
  /*  GENERACION LISTADO DE RADICADOS
	 *  Aqui utilizamos la clase adodb para generar el listado de los radicados
	 *  Esta clase cuenta con una adaptacion a las clases utiilzadas de orfeo.
	 *  el archivo original es adodb-pager.inc.php la modificada es adodb-paginacion.inc.php
	 */
	if(!$orderNo)
    $orderNo = 0;
	
  $order = $orderNo + 1;
	
  $sqlFecha = $db->conn->SQLDate("d-m-Y H:i A","b.RADI_FECH_RADI");
	$busq_radicados_tmp = "radi_nume_radi = $numero_radicado";
  
  include_once '../include/query/uploadFile/queryUploadFileRad.php';
	if($codTx==12)
		$isql = str_replace("Enviado Por" ,"Devolver a", $isql);
	
  $pager = new ADODB_Pager($db,
                            $query2,
                            'adodb',
                            true,
                            $orderNo,
                            $orderTipo);
	
  $pager->toRefLinks = $linkPagina;
	$pager->toRefVars = $encabezado;
	$pager->checkAll = true;
	$pager->checkTitulo = true;
	$pager->Render($rows_per_page=20,
                  $linkPagina,
                  $checkbox='chkAnulados');
?>
</form>
</body>
</html>
