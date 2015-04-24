<?php
error_reporting(0);
session_start();
$krd=strtoupper($krd);
$ruta_raiz = ".";
include "rec_session.php";
$fechah = date("ymd") ."_". time("hms");
?>
<html>
<head>
<meta http-equiv="DESCRIPTION" content="superservicios.gov.co: Software desarrollado por la superintendencia de servicios publicos con licencia GPL,   ORFEO es un software de gestion documental que fue desarrollado pensando en las entidades del sector publico.">
<meta http-equiv="KEYWORDS" content="superservicios.gov.co: Software desarrollado por la superintendencia de servicios publicos con licencia GPL,   ORFEO es un software de gestion documental que fue desarrollado pensando en las entidades del sector publico.">
<meta name="DESCRIPTION" content="sspd ORFEO Software de gestion documental con licencia GPL">
<title>.:: ORFEO - Sistema de Gesti&oacute;n Documental - CONSULTA DE ESTADO DE RADICADOS ::.</title>
<link rel="shortcut icon" href="imagenes/arpa.gif">
<script>
  function cerrar_ventana()
        {
           window.close();
        }
</script>
</head>
<frameset rows="60,*" frameborder="NO" border="0" framespacing="0" cols="*">
  <frame name="topFrame" scrolling="NO" noresize src='f_topWeb.php?<?=session_name()."=".session_id()?>&krd=<?=$krd?>&fechah=<?=$fechah?>' >
  <frameset >
    <frame name='mainFrame' src='verDatosWeb.php?idRadicado=<?=$idRadicado?>&<?=session_name()."=".session_id()?>&krd=<?=$krd?>&fechah=<?=$fechah?>' scrolling='AUTO'>
    <frame src="UntitledFrame-3">
  </frameset>
</frameset>
<noframes></noframes>
</frameset>
</html>