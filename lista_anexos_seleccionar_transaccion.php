<?php
  session_start();
  $krd         = $_SESSION["krd"];
  $usua_doc    = $_SESSION["usua_doc"];
  $codusuario  = $_SESSION["codusuario"];
  $tip3Nombre  = $_SESSION["tip3Nombre"];
  $tip3desc    = $_SESSION["tip3desc"];
  $tip3img     = $_SESSION["tip3img"];
  $tpNumRad    = $_SESSION["tpNumRad"];
  $tpPerRad    = $_SESSION["tpPerRad"];
  $tpDescRad   = $_SESSION["tpDescRad"];
  $tip3Nombre  = $_SESSION["tip3Nombre"];
  $tpDepeRad   = $_SESSION["tpDepeRad"];
  $dependencia = $_SESSION["dependencia"];
  
  if ($_GET["verrad"])
    $verrad = $_GET["verrad"];
  if ($_GET["verradPermisos"])
    $verradPermisos = $_GET["verradPermisos"];
  if ($_GET["numfe"])
    $numfe = $_GET["numfe"];
  if ($_GET["radicar"])
    $radicar = $_GET["radicar"];
  if ($_GET["radicar_a"])
    $radicar_a = $_GET["radicar_a"];
  if ($_GET["vp"])
    $vp = $_GET["vp"];
  if ($_GET["radicar_documento"])
    $radicar_documento = $_GET["radicar_documento"];
  if ($_GET["generar_numero"])
    $generar_numero = $_GET["generar_numero"];
  if ($_GET["numrad"])
    $numrad = $_GET["numrad"];
  if ($_GET["anexo"])
    $anexo = $_GET["anexo"];
  if ($_GET["linkarchivo"])
    $linkarchivo = $_GET["linkarchivo"];
  if ($_GET["numextdoc"])
    $numextdoc = $_GET["numextdoc"];
  if ($_GET["tpradic"])
    $tpradic = $_GET["tpradic"];
  if ($_GET["numerar"])
    $numerar = $_GET["numerar"];
  if ($_GET["borrar"])
    $borrar = $_GET["borrar"];
  
  if ($_GET["numfe"])
    $numfe = $_GET["numfe"];
  if (!$ruta_raiz)
    $ruta_raiz = ".";
  
  if ($numfe && $numfe != 0) {
    if ($numerar)
      include $ruta_raiz . '/numerar_paquete_anexos.php';
    elseif ($radicar && $radicar_a == 'si')
      include $ruta_raiz . '/radicar_paquete_anexos.php';
    elseif ($radicar)
      include $ruta_raiz . '/genarchivo.php';
    elseif ($borrar)
      include $ruta_raiz . '/borrar_paquete_anexos.php';
  } else {
    if ($radicar)
      include $ruta_raiz . '/genarchivo.php';
    elseif ($borrar)
      include $ruta_raiz . '/borrar_archivos.php';
  }
?>
