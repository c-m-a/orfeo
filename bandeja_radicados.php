<?php
  /**
   * Modificado SGD 20-Apr-2015 por Cmauricio Parra
   * Muestra el contenido de las Carpetas
   * Creado en la SSPD en el 2003
   * 
   * Se adiciono compatibilidad con variables globales en Off
   * @autor Jairo Losada 2009-05
   * @modifcado por Cmauricio Parra cualquier pregunta o soporte enviar a cmauriciop@yahoo.com.mx
                http://cmauricio.org/orfeo4
   * @licencia GNU/GPL Ver. 2
   */
  session_start();
  
  include('./config.php');
  include(SMARTY_TEMPLATE);
  include_once ('./include/db/ConnectionHandler.php');
  
  $smarty = new Smarty();
  $smarty->template_dir = TEMPLATE_DIR;
  $smarty->compile_dir  = COMPILE_DIR;
  $smarty->cache_dir    = CACHE_DIR;

  $smarty_render = ACTIVAR_RENDER;

  foreach ($_GET as $key => $valor)
    ${$key} = $valor;
  
  foreach ($_POST as $key => $valor)
    ${$key} = $valor;
  
  $nomcarpeta = (isset($_GET['nomcarpeta'])) ? $_GET['nomcarpeta'] : null;
  $tipo_carp  = (isset($_GET['tipo_carp'])) ? $_GET["tipo_carp"] : null;
  
  $krd         = $_SESSION['krd'];
  $dependencia = $_SESSION['dependencia'];
  $usua_doc    = $_SESSION['usua_doc'];
  $codusuario  = $_SESSION['codusuario'];
  $tip3Nombre  = $_SESSION['tip3Nombre'];
  $tip3desc    = $_SESSION['tip3desc'];
  $tip3img     = $_SESSION['tip3img'];
  $ruta_raiz   = '.';
  $verrad      = '';
  
  if (empty($db))
    $db = new ConnectionHandler($ruta_raiz);
  
  $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
  
  if (!empty($orderTipo))
    $orderTipo = 'DESC';
  
  if (!empty($orden_cambio) && $orden_cambio == 1)
    $orderTipo = (trim($orderTipo) != 'DESC')? 'DESC' : 'ASC';
  
  if (empty($carpeta))
    $carpeta = 0;
  
  if (!empty($busqRadicados)) {
    $busqRadicados = trim($busqRadicados);
    $textElements  = split(',', $busqRadicados);
    $newText       = '';
    $dep_sel       = $dependencia;
    
    foreach ($textElements as $item) {
      $item = trim($item);
      if (strlen($item) != 0)
        $busqRadicadosTmp .= " b.radi_nume_radi like '%$item%' or";
    }
    
    if (substr($busqRadicadosTmp, -2) == "or")
      $busqRadicadosTmp = substr($busqRadicadosTmp, 0, strlen($busqRadicadosTmp) - 2);
    
    if (trim($busqRadicadosTmp))
      $whereFiltro .= "and ( $busqRadicadosTmp ) ";
	}

  $encabezado = session_name() . '=' . session_id() .
                  '&depeBuscada=' . $depeBuscada .
                  '&filtroSelect=' . $filtroSelect .
                  '&tpAnulacion=' . $tpAnulacion .
                  '&carpeta=' . $carpeta .
                  '&tipo_carp=' . $tipo_carp .
                  '&chkCarpeta=' . $chkCarpeta .
                  '&busqRadicados=' . $busqRadicados .
                  '&nomcarpeta=' . $nomcarpeta .
                  '&agendado=' . $agendado .
                  '&orderTipo=' . $orderTipo .
                  '&orderNo='. $orderNo;
   
   $linkPagina = basename(__FILE__) . '?' . $encabezado;
  
   $encabezado = session_name() . '=' . session_id() .
                  '&adodb_next_page=1' .
                  '&depeBuscada=' . $depeBuscada .
                  '&filtroSelect=' . $filtroSelect .
                  '&tpAnulacion=' . $tpAnulacion .
                  '&carpeta=' . $carpeta .
                  '&tipo_carp=' . $tipo_carp .
                  '&nomcarpeta=' . $nomcarpeta .
                  '&agendado=' . $agendado .
                  '&orderTipo=' . $orderTipo .
                  '&orderNo=';
    
    $accion_buscar = $_SERVER['PHP_SELF'] . '?' . $encabezado;
    
    $smarty->assign('ACCION_BUSCAR', $accion_buscar);
    $smarty->assign('BUSQRADICADOS', $busqRadicados);
  
    /**
     * Este if verifica si se debe buscar en los radicados de todas las carpetas.
     * @$chkCarpeta char  Variable que indica si se busca en todas las carpetas.
     */
    $chkValue     = ($chkCarpeta)? ' checked ' : ' ';
    $whereCarpeta = ($chkCarpeta)? ' ' : " and b.carp_codi=$carpeta ";
    
    if (!$tipo_carp)
      $tipo_carp = 0;
    
    $whereCarpeta = $whereCarpeta . " and b.carp_per=$tipo_carp ";
    $fecha_hoy    = Date("Y-m-d");
    $sqlFechaHoy  = $db->conn->DBDate($fecha_hoy);
    
    //Filtra el query para documentos agendados
    if ($agendado == AGENDADOS_NO_VENCIDOS) {
      $sqlAgendado = " and (radi_agend=1 and radi_fech_agend > $sqlFechaHoy) "; // No vencidos
    } else if ($agendado == AGENDADOS_VENCIDOS) {
      $sqlAgendado = " and (radi_agend=1 and radi_fech_agend <= $sqlFechaHoy)  "; // vencidos
    }
    
    if (isset($agendado)) {
      $colAgendado  = "," . $db->conn->SQLDate("Y-m-d H:i A", "b.RADI_FECH_AGEND") . ' as "Fecha Agendado"';
      $whereCarpeta = '';
    }
    
    //Filtra teniendo en cuenta que se trate de la carpeta Vb.
    $whereUsuario = ($carpeta == 11 && $codusuario != 1 && $_GET['tipo_carp'] != 1)?
                        " and  (b.radi_usu_ante ='$krd' OR (b.radi_usua_actu=$codusuario and b.radi_depe_actu=$dependencia))" :
                        " and b.radi_usua_actu='$codusuario' ";

    $enlace_envio = './tx/formEnvio.php?' . $encabezado;

    $smarty->assign('CHKVALUE', $chkValue);
    $smarty->assign('ENLACE_ENVIO', $enlace_envio);
    
    $controlAgenda = 1;
    $validacion = $carpeta == CARPETA_VOBO and !$tipo_carp and $codusuario != 1;
    
    include('./tx/tx_orfeo.php');

    /*  GENERACION LISTADO DE RADICADOS
     *  Aqui utilizamos la clase adodb para generar el listado de los radicados
     *  Esta clase cuenta con una adaptacion a las clases utiilzadas de orfeo.
     *  el archivo original es adodb-pager.inc.php la modificada es adodb-paginacion.inc.php
     */
    
    if (strlen($orderNo) == 0) {
      $orderNo = 2;
      $order   = 3;
    } else {
      $order = $orderNo + 1;
    }
    
    $sqlFecha   = $db->conn->SQLDate("Y-m-d H:i A", "b.RADI_FECH_RADI");
    
    $numero_max = ($dependencia == 999) ? ' rownum <= 50 AND ' : ' ';
    include ('./include/query/queryCuerpo.php');
    
    // Se limita al numero de filas ya que el usuario de archivo tiene demasiados radicados
    $rs = $db->conn->Execute($isql);
    
    $contrasena_url = './contrasena_usuario.php';

    $cerrar_session = './cerrar_session.php' .
                      '?'. session_name() . '=' .
                      session_id() .
                      '&fechah=' . $fechah;
    
    $modificar = './mod_datos.php' . '?'. 
                  session_name() . '=' . session_id() .
                  '&fechah=' . $fechah .
                  '&krd=' . $krd .
                  '&info=false';
    
    $creditos = './menu/creditos.php' . '?' .
                  session_name() . '=' . session_id() .
                  '&fechah=' . $fechah .
                  '&krd='. $krd .
                  '&info=false';

    $estadisticas = './estadisticas/vistaFormConsulta.php' . '?' .
                      session_name() . '=' . session_id() .
                      '&fechah=' . $fechah;
    
    if ($rs->EOF && $busqRadicados) {
      echo '<hr><center><b><span class="alarmas">No se encuentra ningun radicado con el criterio de busqueda</span></center></b></hr>';
    } else {
      /**
       * ACTIVAR_RENDER se encuentra en el config.php
       *   Es una bandera para decirle a ADODB que no haga el render que smarty lo va hacer
      **/
      $pager  = new ADODB_Pager($db,
                                $isql,
                                'adodb',
                                true,
                                $orderNo,
                                $orderTipo,
                                ACTIVAR_RENDER);
      
      $pager->checkAll        = false;
      $pager->checkTitulo     = true;
      $pager->toRefLinks      = $linkPagina;
      $pager->toRefVars       = $encabezado;
      $pager->descCarpetasGen = $descCarpetasGen;
      $pager->descCarpetasPer = $descCarpetasPer;
      
      if ($_GET["adodb_next_page"])
        $pager->curr_page = $_GET["adodb_next_page"];
      
      $html_rs = $pager->Render($rows_per_page = 60,
                                  $linkPagina,
                                  $checkbox = 'chkAnulados',
                                  false);
      
      $paginador = $html_rs['header'] . $html_rs['pager'];
      
      $smarty->assign('NOMBRE_BANDEJA', $nomcarpeta);
      $smarty->assign('NOMBRE_USUARIO', $_SESSION['usua_nomb']);
      $smarty->assign('NOMBRE_DEPENDENCIA', $_SESSION['depe_nomb']);
      
      // Variables de la barra de navegacion
      $smarty->assign('CONTRASENA_URL', $contrasena_url);
      $smarty->assign('CERRAR_SESSION', $cerrar_session);
      $smarty->assign('MODIFICAR',      $modificar);
      $smarty->assign('CREDITOS',       $creditos);
      $smarty->assign('ESTADISTICAS',   $estadisticas);

      $smarty->assign('TITULOS', $titulos_tabla);
      $smarty->assign('RADICADOS', $html_rs['data']);
      $smarty->assign('PAGINADOR', $paginador);
      $smarty->display('bandeja_radicados.tpl');
    }
?>
