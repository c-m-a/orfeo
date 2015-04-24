<?php
  session_start();
  if (!$nomcarpeta)
    $nomcarpeta = "Entrada";
  $ruta_raiz = ".";
  if (!$krd or !$_SESSION['dependencia'])
    include "rec_session.php";
  require_once("$ruta_raiz/include/db/ConnectionHandler.php");
  $fecha = Date("Y-m-d") . "  " . Date("H:m:s");
?>
<html>
<head>
<title>Enviar Datos</title>
<link rel="stylesheet" href="estilos_totales.css">
</head>
<style type="text/css">
<!--
.textoOpcion {  font-family: Arial, Helvetica, sans-serif; font-size: 8pt; color: #000000; text-decoration: underline}
-->
</style>
<body bgcolor="#FFFFFF" topmargin="0">
<?php
  $fecha_hoy = date("Y-m-d");
  $conexion  = new ConnectionHandler;
  $vector    = array();
  $i         = 0;
  if ($chk1) {
    $vector[$i++] = $chk1;
  }
  if ($chk2) {
    $vector[$i++] = $chk2;
  }
  if ($chk3) {
    $vector[$i++] = $chk3;
  }
  if ($chk4) {
    $vector[$i++] = $chk4;
  }
  if ($chk5) {
    $vector[$i++] = $chk5;
  }
  if ($chk6) {
    $vector[$i++] = $chk6;
  }
  if ($chk7) {
    $vector[$i++] = $chk7;
  }
  if ($chk8) {
    $vector[$i++] = $chk8;
  }
  if ($chk9) {
    $vector[$i++] = $chk9;
  }
  if ($chk10) {
    $vector[$i++] = $chk10;
  }
  if ($chk11) {
    $vector[$i++] = $chk11;
  }
  if ($chk12) {
    $vector[$i++] = $chk12;
  }
  if ($chk13) {
    $vector[$i++] = $chk13;
  }
  if ($chk14) {
    $vector[$i++] = $chk14;
  }
  if ($chk15) {
    $vector[$i++] = $chk15;
  }
  if ($chk16) {
    $vector[$i++] = $chk16;
  }
  if ($chk17) {
    $vector[$i++] = $chk17;
  }
  if ($chk18) {
    $vector[$i++] = $chk18;
  }
  if ($chk19) {
    $vector[$i++] = $chk19;
  }
  if ($chk20) {
    $vector[$i++] = $chk20;
  }
  
  $fieldstable[]       = "radi_agend";
  $fieldstable[]       = "radi_fech_agend";
  $fieldstable[]       = "CARP_CODI";
  $fieldstable[]       = "CARP_PER";
  $values["CARP_PER"]  = 0;
  $values["CARP_CODI"] = 0;
  $nameid[]            = "radi_nume_radi";
  
  $fieldstable2[] = "depe_codi";
  $fieldstable2[] = "hist_fech";
  $fieldstable2[] = "usua_codi";
  $fieldstable2[] = "radi_nume_radi";
  $fieldstable2[] = "hist_obse";
  $fieldstable2[] = "usua_codi_dest";
  $fieldstable2[] = "usua_doc";
  
  $values2["depe_codi"] = $dependencia;
  $values2["hist_fech"] = " SYSDATE ";
  $values2["usua_codi"] = $codusuario;
  
  $values2["usua_codi_dest"] = $codusuario;
  $values2["usua_doc"]       = $usua_doc;
  
  if ($accion == "SI") {
    $values2["hist_obse"] = "'RADICADO AGENDADO PARA $fecha_doc '";
    
    $sw        = 0;
    $sw2       = 0;
    $afectados = " ";
    for ($j = 0; $j < $i; $j++) {
      $values["radi_agend"] = 1;
      
      $values["radi_fech_agend"] = "TO_DATE ('$fecha_doc','YY-MM-DD')";
      $idvalue["radi_nume_radi"] = $vector[$j];
      $afectados                 = $afectados . "<br>" . $vector[$j];
      //print ($vector[$j] ."  ");
      
      if (!($conexion->update("radicado", $fieldstable, $values, $nameid, $idvalue)))
        $sw = 1;
      
      $values2["radi_nume_radi"] = $vector[$j];
      
      if (!$conexion->insert("hist_eventos", $fieldstable2, $values2))
        $sw2 = 1;
      
    }
    
    if ($sw == 1)
      echo ("<span class=eerrores>ERROR TRATANDO DE AGENDAR</span>");
    else {
      echo ("<span class=tituloListado>ACCION REQUERIDA COMPLETADA </span> ");
      echo ("<p class=etexto> <span class='etextomenu'>ACCION REQUERIDA :</span> <font color=blue>AGENDAR </font></p>");
      echo ("<p class=etexto> <span class='etextomenu'>FECHA DE AGENDA :</span> <font color=blue>$fecha_doc </font></p>");
      echo ("<p class=etexto> <span class='etextomenu'>USUARIO :</span> <font color=blue>$usua_nomb </font></p>");
      echo ("<p class=etexto> <span class='etextomenu'>DEPENDENCIA :</span> <font color=blue>$depe_nomb </font></p>");
      echo ("<p class=etexto><span class='etextomenu'>FECHA Y HORA :</span> <font color=blue>$fecha </font></p>");
      echo ("<p class=etexto><span class='etextomenu'>RADICADOS INVOLUCRADOS :</span><br> <font color=blue>");
      echo ($afectados);
    }
    
    if ($sw2 == 1)
      echo ("<span class=eerrores>ERROR TRATANDO DE ESCRIBIR EL HISTORICO</span>");
  } else if ($accion == "NO") {
    $values2["hist_obse"] = "'SACADO DE LA AGENDA '";
    $sw                   = 0;
    $sw2                  = 0;
    for ($j = 0; $j < $i; $j++) {
      $values["radi_agend"]      = "null";
      $values["radi_fech_agend"] = "null";
      $idvalue["radi_nume_radi"] = $vector[$j];
      $afectados                 = $afectados . "<br>" . $vector[$j];
      
      if (!($conexion->update("radicado", $fieldstable, $values, $nameid, $idvalue)))
        $sw = 1;
      
      $values2["radi_nume_radi"] = $vector[$j];
      
      if (!$conexion->insert("hist_eventos", $fieldstable2, $values2))
        $sw2 = 1;
      
    }
    
    if ($sw == 1)
      echo ("<span class=eerrores>ERROR TRATANDO SACAR DE LA AGENDA</span>");
    else {
      echo ("<span class=tituloListado>ACCION REQUERIDA COMPLETADA </span> ");
      echo ("<p class=etexto> <span class='etextomenu'>ACCION REQUERIDA :</span> <font color=blue>SACAR DE LA AGENDA </font></p>");
      echo ("<p class=etexto> <span class='etextomenu'>USUARIO :</span> <font color=blue>$usua_nomb </font></p>");
      echo ("<p class=etexto> <span class='etextomenu'>DEPENDENCIA :</span> <font color=blue>$depe_nomb </font></p>");
      echo ("<p class=etexto><span class='etextomenu'>FECHA Y HORA :</span> <font color=blue>$fecha </font></p>");
      echo ("<p class=etexto><span class='etextomenu'>RADICADOS INVOLUCRADOS :</span><br> <font color=blue>");
      echo ($afectados);
      
    }
    
    if ($sw2 == 1)
      echo ("<span class=eerrores>ERROR TRATANDO DE ESCRIBIR EL HISTORICO</span>");
  }
?>
</body>
</html>
