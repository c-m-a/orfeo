<?php
  session_start();
  define('ADODB_ASSOC_CASE', 2);
  
  $ruta_raiz 		= '../..';
  include('../../config.php');
  include(SMARTY_TEMPLATE);
  include(ORFEO_PATH . 'include/db/ConnectionHandler.php');
  require('./php-barcode.php');
  
  foreach ($_GET as $key=>$valor)
    ${$key} = $valor;
  
  foreach ($_POST as $key=>$valor)
    ${$key} = $valor;
  
  $smarty = new Smarty();
  $smarty->template_dir = ORFEO_PATH . '/templates';
  $smarty->compile_dir  = ORFEO_PATH . '/templates_c';
  $smarty->cache_dir    = ORFEO_PATH . '/cache';
  
  $escala_imagen      = 1;  // Tamano codigo barras
  $codificacion       = null;
  $modo               = 'png'; // resultado en archivo png
  $db                 = new ConnectionHandler($ruta_raiz);    
  $verradicado        = $verrad;
  $krdOld             = $krd;
  $menu_ver_tmpOld    = $menu_ver_tmp;
  $menu_ver_Old       = $menu_ver;
  $which_cmd          = 'which qrencode';
  $qrencodes_path     = shell_exec($which_cmd);
  $qrencodes_path     = trim($qrencodes_path);
  $nomcarpeta         = $_GET["nomcarpeta"];

  if ($_GET["tipo_carp"])
    $tipo_carp = $_GET["tipo_carp"];

  $krd            = $_SESSION["krd"];
  $dependencia    = $_SESSION["dependencia"];
  $usua_doc       = $_SESSION["usua_doc"];
  $codusuario     = $_SESSION["codusuario"];
  $tip3Nombre     = $_SESSION["tip3Nombre"];
  $tip3desc       = $_SESSION["tip3desc"];
  $tip3img        = $_SESSION["tip3img"];

  if ($verradicado)  
    $verrad = $verradicado;

  $numrad = $verrad;

  include $ruta_raiz.'/ver_datosrad.php';    
  
  $noRad = $_REQUEST['nurad'];
  $radicado_separado = substr($noRad,0,4) . "-" .
                        substr($noRad,4,3) . "-" .
                        substr($noRad,7,6) . "-" .
                        substr($noRad,13,1);
  
  $numero_radicado  = $_REQUEST['nurad'];
  $numero_documento = substr($docDir,0,20);
  $remitente        = substr($nombret_us1,0,20);
  $ruta_imagen      = BODEGA_TMP;
  $grabar_archivo   = true;
  $url_radicado     = ORFEO_URL_BUSCAR . $numero_radicado;
  $qrcode_imagen    = $ruta_imagen . 'qr' . $numero_radicado . '.' . $modo;

  if (isset($qrencodes_path)) {
    $qrencodes_exec = $qrencodes_path  . ' ' . $url_radicado .
                        ' -o ' . $qrcode_imagen;
    shell_exec($qrencodes_exec);
    $grabo_qrcode   = is_file($qrcode_imagen);
  }

  $grabo_imagen = barcode_print($numero_radicado,
                $codificacion,
                $escala_imagen,
                $modo,
                $grabar_archivo,
                $numero_radicado,
                $ruta_imagen);
  
  if ($grabo_imagen)
    $url_imagen   = URL_TMP . $numero_radicado . '.' . $modo; 

  if ($grabo_qrcode)
    $url_qrcode = URL_TMP . 'qr' . $numero_radicado . '.' . $modo;

  $smarty->assign('RADICADO_SEPARADO',  $radicado_separado);
  $smarty->assign('URL_IMAGEN',         $url_imagen);
  $smarty->assign('URL_QRCODE',         $url_qrcode);
  $smarty->assign('NUMERO_DOCUMENTO',   $numero_documento);
  $smarty->assign('REMITENTE',          $remitente);
  $smarty->assign('NUMERO_RADICADO',    $numero_radicado);
  $smarty->assign('RADI_FECH_RADI',     $radi_fech_radi);
  $smarty->assign('RADI_DEPE_ACTU',     $radi_depe_actu);
  $smarty->assign('URL_ENTIDAD_STICKER', URL_ENTIDAD_STICKER);
  $smarty->display('sticker_orfeo.tpl');
?>
