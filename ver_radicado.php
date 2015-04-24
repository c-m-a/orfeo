<?php
  /*************************************************************************************/
  /* ORFEO GPL:Sistema de Gestion Documental		http://www.orfeogpl.org	               */
  /*	Idea Original de la SUPERINTENDENCIA DE SERVICIOS PUBLICOS DOMICILIARIOS         */
  /*				COLOMBIA TEL. (57) (1) 6913005  orfeogpl@gmail.com                         */
  /* ===========================                                                       */
  /*                                                                                   */
  /* Este programa es software libre. usted puede redistribuirlo y/o modificarlo       */
  /* bajo los terminos de la licencia GNU General Public publicada por                 */
  /* la "Free Software Foundation"; Licencia version 2. 			                         */
  /*                                                                                   */
  /* Copyright (c) 2005 por :	  	  	                                                 */
  /* SSPS "Superintendencia de Servicios Publicos Domiciliarios"                       */
  /*   Jairo Hernan Losada  jlosada@gmail.com                Desarrollador             */
  /*   Sixto Angel Pinzón López --- angel.pinzon@gmail.com   Desarrollador             */
  /* C.R.A.  "COMISION DE REGULACION DE AGUAS Y SANEAMIENTO AMBIENTAL"                 */
  /*   Liliana Gomez        lgomezv@gmail.com                Desarrolladora            */
  /*   Lucia Ojeda          lojedaster@gmail.com             Desarrolladora            */
  /* D.N.P. "Departamento Nacional de Planeación"                                      */
  /*   Hollman Ladino       hollmanlp@gmail.com                Desarrollador           */
  /*                                                                                   */
  /* Colocar desde esta lInea las Modificaciones Realizadas Luego de la Version 3.5    */
  /*  Nombre Desarrollador   Correo     Fecha   Modificacion                           */
  /*  Infometrika            info@infometrika.com  05/2009  Arreglo Variables Globales */
  /*  Jairo Losada           jlosada@gmail.com     05/2009  Eliminacion Fun - Procesos */
  /*************************************************************************************/
  
  session_start();
  include('./config.php');
  include_once ('./include/db/ConnectionHandler.php');
  include(SMARTY_TEMPLATE);

  foreach ($_GET as $key => $valor) ${$key} = $valor;
  foreach ($_POST as $key => $valor) ${$key} = $valor;

  $krd        = $_SESSION['krd'];
  $dependencia= $_SESSION['dependencia'];
  $usua_doc   = $_SESSION['usua_doc'];
  $codusuario = $_SESSION['codusuario'];
  $tip3Nombre = $_SESSION['tip3Nombre'];
  $tip3desc   = $_SESSION['tip3desc'];
  $tip3img    = $_SESSION['tip3img'];
  $tpNumRad   = $_SESSION['tpNumRad'];
  $tpPerRad   = $_SESSION['tpPerRad'];
  $tpDescRad  = $_SESSION['tpDescRad'];
  $tip3Nombre = $_SESSION['tip3Nombre'];
  $tpDepeRad  = $_SESSION['tpDepeRad'];
  $nomcarpeta = $_GET['nomcarpeta'];
  $ruta_raiz  = '.';
  $usuaPermExpediente = $_SESSION['usuaPermExpediente'];

  $verradicado = $_GET['verrad'];

  $smarty = new Smarty();
  $smarty->template_dir = TEMPLATE_DIR;
  $smarty->compile_dir  = COMPILE_DIR;
  $smarty->cache_dir    = CACHE_DIR;
  $smarty->caching = 0;

  if (empty($ent))
    $ent = substr($verradicado, -1);
  
  if (empty($carpeta))
    $carpeta = (isset($carpetaOld))? $carpetaOld : null;
  
  if (empty($menu_ver_tmp))
    $menu_ver_tmp = $menu_ver_tmpOld;
  
  if (empty($menu_ver))
    $menu_ver = (isset($menu_ver_Old))? $menu_ver_Old : null;
  
  if (empty($menu_ver))
    $menu_ver = 3;
  
  if (isset($menu_ver_tmp))
    $menu_ver = $menu_ver_tmp;
  
  if ($verradicado)
    $verrad = $verradicado;
  
  $numrad = $verrad;

  $db = new ConnectionHandler('.');
  $db->conn->SetFetchMode(3);
  
  if($carpeta == 8) {
    $info = 8;
    $nombcarpeta = 'Informados';
  }
  
  include_once (ORFEO_PATH . 'class_control/Radicado.php');
  $objRadicado = new Radicado($db);
  $objRadicado->radicado_codigo($verradicado);
  $path = $objRadicado->getRadi_path();

  // verificacion si el radicado se encuentra en el usuario Actual
  include (ORFEO_PATH . 'tx/verifSession.php');

  $vars_radicacion = session_name() . '=' . session_id . 
                      '&nurad=' . $verrad .
                      '&fechah=' . $fechah .
                      '&ent=' . $ent .
                      '&Buscar=Buscar Radicado' .
                      '&carpeta=' . $carpeta .
                      '&nomcarpeta=' . $nomcarpeta;

  $enlace_radicacion = 'radicacion/nuevo_radicado.php?' . $vars_radicacion;
  $mostrar_radicado = false;
  
  if($verradPermisos == 'Full' or $datoVer=='985') {
    $smarty->assign('MOSTRAR_RADICADO', true);
    if($datoVer=="985") {
      $smarty->assign('VER_DATO', true);
      if($verradPermisos == "Full" or $datoVer=="985") {
        $smarty->assign('MOSTRAR_RADICADO_985', true);
      }
    }
  }
  
  $mostrar_menu_ver = ($menu_ver == INFORMACION_GENERAL)? true : false;
  $mostrar_ver_causal = (isset($ver_causal))? true : false;
  $mostrar_ver_tema = (isset($ver_tema))? true : false;
  $mostrar_menu_ver_tmp = ($menu_ver_tmp != DOCUMENTOS)? true : false;

  $isqlDepR = "SELECT RADI_DEPE_ACTU,
                      RADI_USUA_ACTU
                FROM radicado 
                WHERE RADI_NUME_RADI = '$numrad'";
  
  $rsDepR = $db->conn->Execute($isqlDepR);
  $coddepe = $rsDepR->fields['RADI_DEPE_ACTU'];
  $codusua = $rsDepR->fields['RADI_USUA_ACTU'];
  $ind_ProcAnex = 'N';
  
  $vars_tipificar = 'nurad=' . $verrad . 
                    '&ind_ProcAnex=' . $ind_ProcAnex .
                    '&codusua=' . $codusua .
                    '&coddepe=' . $coddepe .
                    '&codusuario=' . $codusuario .
                    '&dependencia=' . $dependencia .
                    '&tsub="+tsub+"' . 
                    '&codserie=';
  
  $enlace_tipificar = './radicacion/tipificar_documento.php?' . $vars_tipificar;

  $vars_vinculacion = 'verrad=' . $verrad .
                      '&codusuario=' . $codusuario .
                      '&dependencia=' . $dependencia;

  $enlace_vinculacion = './vinculacion/mod_vinculacion.php?';
  
  $mostrar_tipo_doc = (isset($ver_tipodoc))? true : false;

  $body = (isset( $_GET['ordenarPor'] ) && $_GET['ordenarPor'] != '')?
            'document.location.href="#t1";' : $body;

	$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
	$fechah  = date('dmy_h_m_s') . ' ' . time('h_m_s');
	$check   = 1;
	$numeroa = 0;
  $numero  = 0;
  $numeros = 0;
  $numerot = 0;
  $numerop = 0;
  $numeroh = 0;
  
 	include ('./ver_datosrad.php');
  
  if(!($verradPermisos == 'Full' or $datoVer == "985")) {
 		$numRad = $verrad;
 		if($nivelRad==1)
      include ($ruta_raiz . '/seguridad/sinPermisoRadicado.php');
 		if($nivelRad==1) die('-');
 	}

  if($krd) {
    $isql = "SELECT *
              FROM usuario
              WHERE USUA_LOGIN ='$krd' AND
                    USUA_SESION='". substr(session_id(),0,29)."' ";
	  
    $rs = $db->conn->query($isql);
    
    $vars_radicacion = 'nurad=' . $verrad .
                        '&Buscar=BuscarDocModUS' . 
                        '&' . session_name() . '=' . session_id() .
                        '&Submit3=ModificarDocumentos' .
                        '&Buscar1=BuscarOrfeo78956jkgf';
    
    $enlace_radicacion = './radicacion/nuevo_radicado.php?' . $vars_radicacion;
    
    if ($mostrar_opc_envio == 0 and $carpeta != 8 and empty($agendado)) {
      $ent = substr($verrad, -1);
      $smarty->assign('ENLACE_RADICACION', $enlace_radicacion);
      $smarty->assign('MOSTRAR_ENLACE_RADICADO', true);
    } 
    
	  if ($numExpediente && $_GET['expIncluido'][0] == '') {
      $datos_expediente = ($_SESSION['numExpedienteSelected'] != '')?
                            $_SESSION['numExpedienteSelected'] : $numExpediente;
      $smarty->assign('MOSTRAR_EXPEDIENTE', true);
      $smarty->assign('DATOS_EXPEDIENTE', $datos_expediente);
	  } elseif ($_GET['expIncluido'][0] != '') {
      $smarty->assign('MOSTRAR_EXPEDIENTES', true);
      $smarty->assign('DATOS_EXPEDIENTES', $_GET['expIncluido'][0]);
      $_SESSION['numExpedienteSelected'] = $_GET['expIncluido'][0];
	  }
  
    $enlace_solicitados = './solicitar/Reservas.php' .
                          '?radicado=' . $verrad;
    $enlace_reservar = $enlace_solicitados . '&sAction=insert';

    $datosaenviar = 'fechaf=' . $fechaf .
                    '&mostrar_opc_envio=' . $mostrar_opc_envio .
                    '&tipo_carp=' . $tipo_carp .
                    '&carpeta=' . $carpeta .
                    '&nomcarpeta=' . $nomcarpeta .
                    '&datoVer=' . $datoVer .
                    '&ascdesc=' . $ascdesc .
                    '&orno=' . $orno;
    
    $vars_form_envio = session_name() . session_id();
    $enlace_form_envio = '/tx/formEnvio.php?' . $vars_form_envio;

    $vars_ver_radicado = session_name() . trim(session_id()) .
                          '&verrad=' . $verrad . 
                          '&datoVer=' . $datoVer .
                          '&chk1=' . $verrad .
                          '&carpeta=' . $carpeta .
                          '&nomcarpeta=' . $nomcarpeta;
    
    $enlace_ver_radicado = 'verradicado.php?';
    $ver_inf_radicado = true;
    
    if($verradPermisos == 'Full') {
      include (ORFEO_PATH . 'tx/tx_orfeo.php');
      $smarty->assign('VER_OPCIONES_RADICADO', true);
    }

    $mostrar_error = ($flag == 2)? true : false;
    
    $row  = array();
    $row1 = array();
    
    if (!$mostrar_error) {
      if($info) {
        $row['INFO_LEIDO'] = 1;
        $row1['DEPE_CODI'] = $dependencia;
        $row1['USUA_CODI'] = $codusuario;
        $row1['RADI_NUME_RADI'] = $verrad;
        $rs = $db->update('informados', $row, $row1);
      } elseif (($leido!="no" or !$leido) and $datoVer!=985) {
        $row['RADI_LEIDO'] = 1;
        $row1['radi_depe_actu'] = $dependencia;
        $row1['radi_usua_actu'] = $codusuario;
        $row1['radi_nume_radi'] = $verrad;
        $rs = $db->update('radicado', $row, $row1);
      }
    }
    
    include ('./ver_datosrad.php');
    include ('./ver_datosgeo.php');
    
    $tipo_documento .= "<input type='hidden' name='menu_ver' value='$menu_ver'>";
    $hdatos = session_name() . '=' . session_id() . 
              '&leido=' . $leido .
              '&nomcarpeta=' . $nomcarpeta .
              '&tipo_carp=' . $tipo_carp .
              '&carpeta=' . $carpeta .
              '&verrad=' . $verrad .
              '&datoVer=' . $datoVer .
              '&fechah=fechah&menu_ver_tmp=';
    
    $acciones[1]['archivo'] = 'historico_radicado';
    $acciones[2]['archivo'] = 'documentos_radicado';
    $acciones[3]['archivo'] = 'informacion_general';
    $acciones[4]['archivo'] = 'lista_expediente';
    $acciones[4]['directorio'] = 'expediente/';
    $acciones[5]['archivo'] = 'plantilla';
    
    $accion = $acciones[$menu_ver]['archivo'];
    $directorio = $acciones[$menu_ver]['directorio'];
    
    // Deacuerdo a la pestana seleccionada carga el archivo correpondiente
    include ('./' . $directorio . $accion . '.php');
    
    $smarty->assign('PLANTILLA',              $accion . '.tpl');
    $smarty->assign('BODY_SUPERSOLIDADIA',    $body);
    $smarty->assign('MOSTRAR_TIPO_DOC',       $mostrar_tipo_doc);
    $smarty->assign('ENLACE_TIPIFICAR',       $enlace_tipificar);
    $smarty->assign('ENLACE_VINCULACION',     $enlace_vinculacion);
    $smarty->assign('ENLACE_RADICACION',      $enlace_radicacion);
    $smarty->assign('MENU_VER',               $menu_ver);
    $smarty->assign('MOSTRAR_MENU_VER',       $mostrar_menu_ver);
    $smarty->assign('MOSTRAR_VER_CAUSAL',     $mostrar_ver_causal);
    $smarty->assign('MOSTRAR_VER_TEMA',       $mostrar_ver_tema);
    $smarty->assign('MOSTRAR_MENU_VER_TMP',   $mostrar_menuver_tmp);
    $smarty->assign('MOSTRAR_PESTANAS',       true);
    $smarty->assign('ENLACE_SOLICITADOS',     $enlace_solicitados);
    $smarty->assign('ENLACE_RESERVAR',        $enlace_reservar);
    $smarty->assign('NOMBRE_CARPETA',         $nomcarpeta);
    $smarty->assign('USUA_NOMBRE',            $_SESSION['usua_nomb']);
    $smarty->assign('DEPE_NOMBRE',            $_SESSION['depe_nomb']);
    $smarty->assign('ORFEO_PATH',             ORFEO_PATH . '/');
    $smarty->assign('ORFEO_URL',              ORFEO_URL);
    $smarty->assign('ENLACE_FORM_ENVIO',      $enlace_form_envio);
    $smarty->assign('ENLACE_VER_RADICADO',    $enlace_ver_radicado);
    $smarty->assign('VER_RADICADO',           $verrad);
    $smarty->assign('FECHAH',                 $fechah);
    $smarty->assign('HDATOS',                 $hdatos);
    $smarty->assign('DATOS' .                 $menu_ver, '_R');
    $smarty->assign('MOSTRAR_ERROR_CONSULTA', $mostrar_error);
    $smarty->assign('NUMERO_RADICADO',        $verrad);
    $smarty->assign('ENLACE_RADICACION',      $enlace_radicacion);
  } else {
    $smarty->assign('MOSTRAR_ERROR_SESION', true);
  }
  
  $smarty->display('ver_radicado.tpl');
?>
