<?php
  session_start();
  /**
   * Modificacion Variables Globales Infometrika 2009-05
   * Licencia GNU/GPL 
   */
  
  
  
  if ($_POST["tipo"])
    $tipo = $_POST["tipo"];
  if ($_POST["numrad"])
    $numrad = $_POST["numrad"];
  if ($_POST["tipoLista"])
    $tipoLista = $_POST["tipoLista"];
  if ($_POST["tipoDocumentoSeleccionado"])
    $tipoDocumentoSeleccionado = $_POST["tipoDocumentoSeleccionado"];
  if ($_POST["radicado_salida"])
    $radicado_salida = $_POST["radicado_salida"];
  if ($_POST["tpradic"])
    $tpradic = $_POST["tpradic"];
  if ($_POST["aplinteg"])
    $aplinteg = $_POST["aplinteg"];
  if ($_POST["direccionAlterna"])
    $direccionAlterna = $_POST["direccionAlterna"];
  if ($_POST["descr"])
    $descr = $_POST["descr"];
  if ($_POST["usuar"])
    $usuar = $_POST["usuar"];
  if ($_POST["predi"])
    $predi = $_POST["predi"];
  if ($_POST["empre"])
    $empre = $_POST["empre"];
  if ($_POST["MAX_FILE_SIZE"])
    $MAX_FILE_SIZE = $_POST["MAX_FILE_SIZE"];
  if ($_POST["i_copias"])
    $i_copias = $_POST["i_copias"];
  if ($_POST["anex_origen"])
    $anex_origen = $_POST["anex_origen"];
  if ($_POST["radicado_rem"])
    $radicado_rem = $_POST["radicado_rem"];
  if ($_POST["descr"])
    $descr = $_POST["descr"];
  if ($_POST["telefono_us1"])
    $telefono_us1 = $_POST["telefono_us1"];
  if ($_POST["tipo_emp_us1"])
    $tipo_emp_us1 = $_POST["tipo_emp_us1"];
  if ($_POST["documento_us1"])
    $documento_us1 = $_POST["documento_us1"];
  if ($_POST["idcont1"])
    $idcont1 = $_POST["idcont1"];
  if ($_POST["idpais1"])
    $idpais1 = $_POST["idpais1"];
  if ($_POST["codep_us1"])
    $codep_us1 = $_POST["codep_us1"];
  if ($_POST["muni_us1"])
    $muni_us1 = $_POST["muni_us1"];
  if ($_POST["cc_documento_us1"])
    $cc_documento_us1 = $_POST["cc_documento_us1"];
  if ($_POST["nombre_us1"])
    $nombre_us1 = $_POST["nombre_us1"];
  if ($_POST["prim_apel_us1"])
    $prim_apel_us1 = $_POST["prim_apel_us1"];
  if ($_POST["seg_apel_us1"])
    $seg_apel_us1 = $_POST["seg_apel_us1"];
  if ($_POST["otro_us7"])
    $otro_us7 = $_POST["otro_us7"];
  if ($_POST["direccion_us1"])
    $direccion_us1 = $_POST["direccion_us1"];
  if ($_POST["mail_us1"])
    $mail_us1 = $_POST["mail_us1"];
  if ($_POST["otro_us1"])
    $otro_us1 = $_POST["otro_us1"];
  
  if (!$_POST["usua"])
    $usua = $_GET["usua"];
  if (!$_POST["numrad"])
    $numrad = $_GET["numrad"];
  if (!$_POST["contra"])
    $contra = $_GET["contra"];
  if (!$_POST["radi"])
    $radi = $_GET["radi"];
  if (!$_POST["tipo"])
    $tipo = $_GET["tipo"];
  if (!$_POST["ent"])
    $ent = $_GET["ent"];
  if (!$_POST["otro_us11"])
    $otro_us11 = $_GET["otro_us11"];
  if (!$_POST["dpto_nombre_us11"])
    $dpto_nombre_us11 = $_GET["dpto_nombre_us11"];
  if (!$_POST["muni_nombre_us11"])
    $muni_nombre_us11 = $_GET["muni_nombre_us11"];
  if (!$_POST["direccion_us11"])
    $direccion_us11 = $_GET["direccion_us11"];
  if (!$_POST["nombret_us11"])
    $nombret_us11 = $_GET["nombret_us11"];
  if (!$_POST["otro_us2"])
    $otro_us2 = $_GET["otro_us2"];
  if (!$_POST["dpto_nombre_us2"])
    $dpto_nombre_us2 = $_GET["dpto_nombre_us2"];
  if (!$_POST["muni_nombre_us2"])
    $muni_nombre_us2 = $_GET["muni_nombre_us2"];
  if (!$_POST["direccion_us2"])
    $direccion_us2 = $_GET["direccion_us2"];
  if (!$_POST["nombret_us2"])
    $nombret_us2 = $_GET["nombret_us2"];
  if (!$_POST["dpto_nombre_us3"])
    $dpto_nombre_us3 = $_GET["dpto_nombre_us3"];
  if (!$_POST["muni_nombre_us3"])
    $muni_nombre_us3 = $_GET["muni_nombre_us3"];
  if (!$_POST["direccion_us3"])
    $direccion_us3 = $_GET["direccion_us3"];
  if (!$_POST["nombret_us3"])
    $nombret_us3 = $_GET["nombret_us3"];
  if (!$_POST["tpradic"])
    $tpradic = $_GET["tpradic"];
  if (!$codigo and $_GET['codigo'])
    $codigo = $_GET['codigo'];
  
  $krd         = $_SESSION["krd"];
  $dependencia = $_SESSION["dependencia"];
  $usua_doc    = $_SESSION["usua_doc"];
  $codusuario  = $_SESSION["codusuario"];
  $tpNumRad    = $_SESSION["tpNumRad"];
  $tpPerRad    = $_SESSION["tpPerRad"];
  $tpDescRad   = $_SESSION["tpDescRad"];
  
  $ruta_raiz = ".";
  
  
  /**
   * Retorna la cantidad de bytes de una expresion como 7M, 4G u 8K.
   *
   * @param char $var
   * @return numeric
   */
  function return_bytes($val) {
    $val    = trim($val);
    $ultimo = strtolower($val{strlen($val) - 1});
    switch ($ultimo) { // El modificador 'G' se encuentra disponible desde PHP 5.1.0
      case 'g':
        $val *= 1024;
      case 'm':
        $val *= 1024;
      case 'k':
        $val *= 1024;
    }
    return $val;
  }
  $userfile1_Size = $_FILES['userfile1']['size'];
  if ((!$codigo && $_FILES['userfile1']['size'] == 0) || ($codigo && $_FILES['userfile1']['size'] >= return_bytes(ini_get('upload_max_filesize')))) {
    die("<table><tr><td>El tama&ntilde;o del archivo no es correcto.</td></tr><tr><td><li>se permiten archivos de " . ini_get('upload_max_filesize') . " m&aacute;ximo.</td></tr><tr><td><input type='button' value='cerrar' onclick='opener.regresar();window.close();'></td></tr></table>");
  }
  /*
  if(($_POST['radicado_salida']=='radsalida') &&($_FILES['userfile1']['type']<>'application/vnd.openxmlformats-officedocument.wordprocessingml.document'))
  {
  die("<table><tr><td>El formato del archivo no es correcto. Para radicar documentos debe usar formato DOCX. Por favor intente de nuevo.</td></tr><tr><td><input type='button' value='cerrar' onclick='opener.regresar();window.close();'></td></tr></table>");
  }
  */
  $fechaHoy = Date("Y-m-d");
  if (!$ruta_raiz)
    $ruta_raiz = ".";
  include_once("$ruta_raiz/class_control/anexo.php");
  include_once("$ruta_raiz/class_control/anex_tipo.php");
  
  if (!isset($_SESSION['dependencia']))
    include "./rec_session.php";
  
  if (!$db)
    $db = new ConnectionHandler($ruta_raiz);
  
  $sqlFechaHoy = $db->conn->OffsetDate(0, $db->conn->sysTimeStamp);
  $anex =& new Anexo($db);
  $anexTip =& new Anex_tipo($db);
  
  if (!$aplinteg)
    $aplinteg = 'null';
  if (!$tpradic)
    $tpradic = 'null';
  if (!$cc) {
    session_start();
    if ($codigo)
      $nuevo = "no";
    else
      $nuevo = "si";
    if ($sololect)
      $auxsololect = "S";
    else
      $auxsololect = "N";
    $db->conn->BeginTrans();
    if ($nuevo == "si") {
      $auxnumero = $anex->obtenerMaximoNumeroAnexo($numrad);
      do {
        $auxnumero += 1;
        $codigo = trim($numrad) . trim(str_pad($auxnumero, 5, "0", STR_PAD_LEFT));
      } while ($anex->existeAnexo($codigo));
    } else {
      $bien      = true;
      $auxnumero = substr($codigo, -4);
      $codigo    = trim($numrad) . trim(str_pad($auxnumero, 5, "0", STR_PAD_LEFT));
    }
    if ($radicado_salida) {
      $anex_salida = 1;
    } else {
      $anex_salida = 0;
    }
    
    $bien = "si";
    
    if ($bien and $tipo) {
      $anexTip->anex_tipo_codigo($tipo);
      
      $ext               = $anexTip->get_anex_tipo_ext();
      $ext               = strtolower($ext);
      $auxnumero         = str_pad($auxnumero, 5, "0", STR_PAD_LEFT);
      $archivo           = trim(trim($numrad) . "_" . trim($auxnumero) . "." . trim($ext));
      $archivoconversion = trim("1") . trim(trim($numrad) . "_" . trim($auxnumero) . "." . trim($ext));
    }
    
    if (!$radicado_rem)
      $radicado_rem = 7;
    if ($_FILES['userfile1']['size']) {
      $tamano = ($_FILES['userfile1']['size'] / 1000);
    } else {
      $tamano = 0;
    }
    if ($nuevo == "si") {
      // $radi = radicado padre
      // $radicado_rem = Codigo del tipo de remitente = sgd_dir_tipo
      // $codigo = ID UNICO DE LA TABLA
      // $tamano = tamano del archivo
      // $auxsololect = solo lectura?
      // $usua = usuario creador
      // $descr = Descripcion, el asunto
      // $auxnumero = Es codigo del consecutivo del anexo al radicado
      // Esta borrado?
      // $anex_salida = marca con 1 si es un radicado de salida
      
      include "$ruta_raiz/include/query/queryUpload2.php";
      if ($expIncluidoAnexo) {
        $expAnexo = $expIncluidoAnexo;
      } else {
        $expAnexo = null;
      }
      if (!$anex_salida && $tpradic)
        $anex_salida = 1;
      $isql          = "insert into anexos (sgd_rem_destino,
                                            anex_radi_nume,
                                            anex_codigo,
                                            anex_tipo,
                                            anex_tamano,
                                            anex_solo_lect,
                                            anex_creador,
                                            anex_desc,
                                            anex_numero,
                                            anex_nomb_archivo,
                                            anex_borrado,
                                            anex_salida,
                                            sgd_dir_tipo,
                                            anex_depe_creador,
                                            sgd_tpr_codigo,
                                            anex_fech_anex,
                                            SGD_APLI_CODI,
                                            SGD_TRAD_CODIGO,
                                            SGD_EXP_NUMERO)
                                    values ($radicado_rem,
                                            $numrad,
                                            '$codigo',
                                            $tipo,
                                            $tamano,
                                            '$auxsololect',
                                            '$krd',
                                            '$descr',
                                            $auxnumero,
                                            '$archivoconversion',
                                            'N',
                                            $anex_salida,
                                            $radicado_rem,
                                            $dependencia,
                                            null,
                                            $sqlFechaHoy,
                                            $aplinteg,
                                            $tpradic,
                                            '$expAnexo' ) ";
      $subir_archivo = "si ...";
    } else {
      if ($_FILES['userfile1']['size']) {
        $subir_archivo = " anex_nomb_archivo='1$archivo',anex_tamano = $tamano,anex_tipo=$tipo, ";
      } else {
        $subir_archivo = "";
      }
      $isql = "update anexos
                  set $subir_archivo
                  anex_salida = $anex_salida,
                  sgd_rem_destino = $radicado_rem,
                  sgd_dir_tipo = $radicado_rem,
                  anex_desc = '$descr',
                  SGD_TRAD_CODIGO = $tpradic,
                  SGD_APLI_CODI = $aplinteg
                where anex_codigo='$codigo'";
    }
    
    $bien = $db->query($isql);
    
    
    if ($bien) {
      //Si actualizo BD correctamente
      $respUpdate = "OK";
      $bien2      = false;
      if ($subir_archivo) {
        $directorio = "./bodega/" . substr(trim($archivo), 0, 4) . "/" . substr(trim($archivo), 4, 3) . "/docs/";
        $userfile1_Temp = trim($_FILES['userfile1']['tmp_name']);
        $bien2          = move_uploaded_file($userfile1_Temp, $directorio . trim(strtolower($archivoconversion)));
        if ($bien2) //Si intento anexar archivo y Subio correctamente
          {
          $resp1 = "OK";
          $db->conn->CommitTrans();
        } else {
          $resp1 = "ERROR";
          $db->conn->RollbackTrans();
        }
      } else {
        $db->conn->CommitTrans();
        
      }
    } else {
      $db->conn->RollbackTrans();
    }
  }
  include 'nuevo_archivo.php';
?>
