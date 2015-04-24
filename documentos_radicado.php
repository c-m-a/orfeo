<?php
  session_start();
  
  // Anexos por Julian Rolon
  // lista los documentos del radicado y proporciona links para ver historicos de cada documento
  // este archivo se incluye en la pagina ver_radicado.php
  
  if (!$ruta_raiz)
    $ruta_raiz= '.';
  
  include_once ($ruta_raiz . '/class_control/anexo.php');
  include_once ($ruta_raiz . '/include/db/ConnectionHandler.php');
  require_once ($ruta_raiz . '/class_control/TipoDocumento.php');
  include_once ($ruta_raiz . '/class_control/firmaRadicado.php');
  include_once ($ruta_raiz . '/config.php');
  require_once ($ruta_raiz . '/class_control/ControlAplIntegrada.php');
  require_once ($ruta_raiz . '/class_control/AplExternaError.php');

  $db = new ConnectionHandler('.');
  $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
  
  $objTipoDocto = new TipoDocumento($db);
  $objTipoDocto->TipoDocumento_codigo($tdoc);
  
  $objFirma     = new FirmaRadicado($db);
  $objCtrlAplInt= new ControlAplIntegrada($db);
  $num_archivos = 0;
  $anexos_radicado = array();
  $contador = 0;

  $anex = &new Anexo($db);
  $sqlFechaDocto = $db->conn->SQLDate('Y-m-D H:i:s A','sgd_fech_doc');
  $sqlFechaAnexo = $db->conn->SQLDate('Y-m-D H:i:s A','anex_fech_anex');
  $sqlSubstDesc =  $db->conn->substr . '(anex_desc, 0, 50)';
  include_once('./include/query/busqueda/busquedaPiloto1.php');

  // Modificado SGD 06-Septiembre-2007
  $isql = "select anex_codigo AS DOCU,
                anex_tipo_ext AS EXT,
                anex_tamano AS TAMA,
                anex_solo_lect AS RO,
                usua_nomb AS CREA,
                $sqlSubstDesc AS DESCR,
                anex_nomb_archivo AS NOMBRE,
                ANEX_CREADOR,
                ANEX_ORIGEN,
                ANEX_SALIDA,
                $radi_nume_salida as RADI_NUME_SALIDA,
                ANEX_ESTADO,
                SGD_PNUFE_CODI,
                SGD_DOC_SECUENCIA,
                SGD_DIR_TIPO,
                SGD_DOC_PADRE,
                SGD_TPR_CODIGO,
                SGD_APLI_CODI,
                SGD_TRAD_CODIGO,
                SGD_TPR_CODIGO,
                ANEX_TIPO,
                $sqlFechaDocto as FECDOC,
                $sqlFechaAnexo as FEANEX,
                ANEX_TIPO as NUMEXTDOC
            from anexos,
                anexos_tipo,
                usuario
            where anex_radi_nume = $verrad and
                  anex_tipo = anex_tipo_codi and
                  anex_creador = usua_login and
                  anex_borrado='N'
            order by anex_codigo,
                      radi_nume_salida,
                      sgd_dir_tipo,
                      anex_numero ";

  $enlace_detalles_archivo = 'detalle_archivos.php?' .
                              'usua=' . $krd .
                              '&radi=' . $verrad .
                              '&anexo=';
  
  $enlace_nuevo_archivo = ORFEO_URL . '/nuevo_archivo.php?codigo=';
  $vars_nuevo_archivo = session_name() . '=' . trim(session_id()) .
                        '&usua=' . $krd .
                        '&numrad=' . $verrad .
                        '&contra=' . $drde .
                        '&radi=' . $verrad .
                        '&tipo=' . $tipo .
                        '&ent=' . $ent . $datos_envio .
                        '&ruta_raiz=' . $ruta_raiz;
  
  $enlace_borrar_archivo = 'borrar_archivos.php?' .
                            'usua=' . $krd .
                            '&contra=' . $drde .
                            '&radi=' . $verrad;
  
  $enl_lista_anexos_trans = 'lista_anexos_seleccionar_transaccion.php?' .
                            'borrar=1' .
                            '&usua=' . $krd .
                            '&numrad=' . $verrad .
                            '&contra=' . $drde .
                            '&radi=' . $verrad .
                            '&anexo=';
  
  $vars_usuario = '&dependencia=' .
                  $dependencia .
                  '&codusuario=' . $codusuario;

  $enl_lista_anexos_radi = '"/lista_anexos_seleccionar_transaccion.php?' .
                            'radicar=1' .
                            '&radicar_a="+radicar_a+"' .
                            '&vp=n' .
                            '&' . session_name() . '=' . trim(session_id()) . 
                            '&radicar_documento=' . $verrad .
                            '&numrad=' . $verrad .
                            '&anexo="+anexo+"' .
                            '&linkarchivo="+linkarch+"' . $datos_envio . '+' .
                            '&ruta_raiz=' . $ruta_raiz .
                            '&numfe="+procesoNumeracionFechado+"' . 
                            '&tpradic="+tpradic+"' .
                            '&aplinteg="+aplinteg+"' .
                            '&numextdoc="+numextdoc;';

  $enl_lista_anexos_nume = ORFEO_URL . 'lista_anexos_seleccionar_transaccion.php?' .
                            'numerar=1"+"' .
                            '&vp=n' .
                            '&krd=' . $krd .
                            '&'. session_name() . '=' . trim(session_id()) .
                            '&radicar_documento=' . $verrad .
                            '&numrad=' . $verrad .
                            '&anexo="+anexo+"' .
                            '&linkarchivo="+linkarch+"' . $datos_envio .
                            '"+"' .
                            '&ruta_raiz=' . $orfeo_url .
                            '&numfe=';

  $enlace_asignar_radicado = ORFEO_URL . 'genarchivo.php?' .
                              'generar_numero=no' .
                              '&radicar_a="+radicar_a+"' .
                              '&vp=n' .
                              '&' . session_name() . '=' . trim(session_id()) .
                              '&radicar_documento=' . $verrad .
                              '&numrad=' . $verrad .
                              '&anexo="+anexo+"' .
                              '&linkarchivo="+linkarch+"' . $datos_envio .
                              '"+"' .
                              '&ruta_raiz=' . $ruta_raiz . '"+"' .
                              '&numextdoc=';

  $smarty->assign('ENLACE_DETALLES_ARCHIVO',  $enlace_detalles_archivo);
  $smarty->assign('ENLACE_NUEVO_ARCHIVO',     $enlace_nuevo_archivo);
  $smarty->assign('VAR_NUEVO_ARCHIVO',        $vars_nuevo_archivo);
  $smarty->assign('ENL_LISTA_ANEXOS_TRANS',   $enl_lista_anexos_trans);
  $smarty->assign('VARS_USUARIO',             $vars_usuario);
  $smarty->assign('ENL_LISTA_ANEXOS_RADI',    $enl_lista_anexos_radi);
  $smarty->assign('ENL_LISTA_ANEXOS_NUME',    $enl_lista_anexos_nume);
  $smarty->assign('ENLACE_ASIGNAR_RADICADO',  $enlace_asignar_radicado);
  
  $isqlDepR = "SELECT RADI_DEPE_ACTU,
                      RADI_USUA_ACTU
                from RADICADO
                WHERE RADI_NUME_RADI = '$numrad'";
  
  $rsDepR  = $db->conn->Execute($isqlDepR);
  $coddepe = $rsDepR->fields['RADI_DEPE_ACTU'];
  $codusua = $rsDepR->fields['RADI_USUA_ACTU'];
  $ind_ProcAnex = 'S';

  $enlace_trd = ORFEO_URL . 'radicacion/tipificar_documento.php?' .
                'krd=' . $krd .
                '&nurad="+anexo+"' .
                '&ind_ProcAnex=' . $ind_ProcAnex .
                '&codusua=' . $codusua .
                '&coddepe=' . $coddepe .
                '&tsub="+tsub+"' .
                '&codserie="+codserie+"' .
                '&texp=' . $texp .
                '","Tipificacion_Documento_Anexos';

  $enlace_tipo_anexo = ORFEO_URL . 'radicacion/tipificar_anexo.php?' .
                        'krd=' . $krd .
                        '&nurad="+cod_radi+"' .
                        '&ind_ProcAnex=' . $ind_ProcAnex .
                        '&codusua=' . $codusua .
                        '&coddepe=' . $coddepe .
                        '&tsub="+tsub+"' .
                        '&codserie="+codserie,"Tipificacion_Documento_Anexos';

  $enlace_gen_archivo = ORFEO_URL . 'genarchivo.php?' .
                        'vp=s'.
                        '&krd=' . $krd .
                        '&' . session_name() . '=' . trim(session_id()) .
                        '&radicar_documento=' . $verrad .
                        '&numrad=' . $verrad .
                        '&anexo="+anexo+"' .
                        '&linkarchivo="+linkarch+"' .
                        '&linkarchivotmp="+linkarchtmp+"' .
                        $datos_envio . '"+"' .
                        '&ruta_raiz=' . $orfeo_url;
  
  $enlace_nuevo_archivo = ORFEO_URL . 'nuevo_archivo.php?' .
                          'codigo=&' .
                          'krd=' . $krd .
                          '&' . session_name() . '=' . trim(session_id()) .
                          '&usua=' . $krd .
                          '&numrad=' . $verrad .
                          '&contra=' . $drde .
                          '&radi=' . $verrad .
                          '&tipo=' . $tipo .
                          '&ent=' . $ent . '"+"' .
                          $datos_envio .
                          '"+"&ruta_raiz=' . $orfeo_url .
                          '&tdoc=' . $tdoc;

  $enlace_edicion_web = ORFEO_URL . '/edicionWeb/editorWeb.php?' .
                        'codigo=' .
                        '&krd=' . $krd .
                        '&' . session_name() . '=' . trim(session_id()) .
                        '&usua=' . $krd .
                        '&numrad=' . $verrad .
                        '&contra=' . $drde .
                        '&radi=' . $verrad .
                        '&tipo=' . $tipo .
                        '&ent=' . $ent .
                        '"+"' . $datos_envio .
                        '"+"' .
                        '&ruta_raiz=' . $ruta_raiz .
                        '&tdoc=' . $tdoc;

  
  $enlace_plantilla = 'plantilla.php?' .
                        'krd=$krd' .
                        '&' . session_name() . '=' . trim(session_id()) .
                        '&verrad=' . $verrad .
                        '&numrad=' . $numrad .
                        '&plantillaper1=';

  
  $enlace_crear_plantilla = 'crea_plantillas/plantilla.php? ' .
                            'krd=' . $krd .
                            '&' . session_name() . '=' . trim(session_id()) .
                            '&verrad=' . $verrad .
                            '&numrad=' . $numrad . '&plantillaper1=';

  $enlace_respuesta_rap = './respuesta_rapida/index.php?' . 
                          'PHPSESSID=' . session_id() .
                          '&radicado=' . $numrad .
                          '&krd=' . $krd .
                          '&asunto=' . $ra_asun .
                          '&nombreCompleto=' . $nombreCompleto;

  if($_GET["verrad"] and ($dependencia==500 || $dependencia==121 || $dependencia==370 || $dependencia==371)) {
    $smarty->assign('MOSTRAR_RESPUESTA_RAPIDA', true);
    $smarty->assign('ENLACE_RESPUESTA_RAP', $enlace_respuesta_rap);
  }


  $rowan = array();
  $rs = $db->conn->query($isql);
  
  if (!$ruta_raiz_archivo) $ruta_raiz_archivo = $ruta_raiz;
  
  $directoriobase = "$ruta_raiz_archivo/bodega/";
  
  //Flag que indica si el radicado padre fue generado desde esta Area de anexos
  $swRadDesdeAnex = $anex->radGeneradoDesdeAnexo($verrad);
  
  $smarty->assign('ENLACE_CREAR_PLANTILLA', $enlace_crear_plantilla);
  $smarty->assign('ENLACE_PLANTILLA', $enlace_plantilla);
  $smarty->assign('ENLACE_EDICION_WEB', $enlace_edicion_web);
  $smarty->assign('ENLACE_NUEVO_ARCHIVO', $enlace_nuevo_archivo);
  $smarty->assign('ENLACE_GEN_ARCHIVO', $enlace_gen_archivo);
  $smarty->assign('ENLACE_TIPO_ANEXO', $enlace_tipo_anexo);
  $smarty->assign('ENLACE_TRD', $enlace_trd);
  
  if($rs) {
    while(!$rs->EOF) {
	    $aplinteg = $rs->fields["SGD_APLI_CODI"];
      $numextdoc = $rs->fields["NUMEXTDOC"];
      $tpradic = $rs->fields["SGD_TRAD_CODIGO"];
      $coddocu = $rs->fields["DOCU"];
      $origen  = $rs->fields["ANEX_ORIGEN"];
      
      if ($rs->fields["ANEX_SALIDA"] == 1) $num_archivos++;
      
      $puedeRadicarAnexo = $objCtrlAplInt->contiInstancia($coddocu,
                                                          $MODULO_RADICACION_DOCS_ANEXOS,
                                                          2);
      $linkarchivo 	= $directoriobase.substr(trim($coddocu),0,4) . '/' .
                      substr(trim($coddocu),4,3) . '/docs/' .
                      trim($rs->fields["NOMBRE"]);
      
      $ruta_archivo 	= substr(trim($coddocu),0,4) . '/' . 
                        substr(trim($coddocu),4,3) . '/docs/' .
                        trim($rs->fields["NOMBRE"]);
      
      $nombre_archivo = trim($rs->fields['NOMBRE']);
      
      $linkarchivo_vista= $ruta_raiz . '/bodega/' .
                          substr(trim($coddocu),0,4) . '/' .
                          substr(trim($coddocu),4,3) . '/docs/' .
                          trim($rs->fields["NOMBRE"]) .
                          '?time=' . time();
      
      $linkarchivotmp = $directoriobase . substr(trim($coddocu),0,4) . '/' .
                        substr(trim($coddocu),4,3) . '/docs/tmp' . trim($rs->fields["NOMBRE"]);
      
      if(!trim($rs->fields["NOMBRE"])) $linkarchivo = '';

      if($origen==1) {
        echo " class='timpar' ";
        if ($rs->fields["NOMBRE"] == 'No') {
          $linkarchivo= "";
        }
        echo "";
      }

      $cod_radi = ($rs->fields["RADI_NUME_SALIDA"] != 0)? $rs->fields["RADI_NUME_SALIDA"] : $coddocu;
      $anex_estado = $rs->fields["ANEX_ESTADO"];

      if($anex_estado <= ANEXO_RECIBIDO) 
        $img_estado = '<img src="' . ORFEO_URL . '/imagenes/docRecibido.gif">';

      if($anex_estado == ANEXO_RADICADO) {
        $estadoFirma = $objFirma->firmaCompleta($cod_radi);
        if ($estadoFirma == "NO_SOLICITADA")
          $img_estado = '<img src="' . ORFEO_URL . '/imagenes/docRadicado.gif" border="0">';
        elseif ($estadoFirma == "COMPLETA") {
          $img_estado = '<img src="' . ORFEO_URL . '/imagenes/docFirmado.gif" border="0">';
        }elseif ($estadoFirma == "INCOMPLETA") {
          $img_estado = '<img src="' . ORFEO_URL . '/imagenes/docEsperaFirma.gif" border="0">';
        }
      }

      if($anex_estado == ANEXO_IMPRESO)
        $img_estado = '<img src="' . ORFEO_URL . '/imagenes/docImpreso.gif">';

      if($anex_estado == ANEXO_ENVIADO)
        $img_estado = '<img src="' . ORFEO_URL . '/imagenes/docEnviado.gif">';
      
      $anexos_radicado[$contador]['IMG_ESTADO'] = $img_estado;
      
      $extension_archivo = strtolower($rs->fields["EXT"]);
      $valida_archivo = trim($linkarchivo) && 
                  ($verradPermisos == 'Full' ||
                    ($extension_archivo != 'doc' &&
                      $extension_archivo != 'odt' &&
                      $extension_archivo != 'ocx' &&
                      $extension_archivo != 'docx') ||
                      (($krd=="ADOMINGUEZ" || $krd=="ADMIN3")));
      
      if($valida_archivo) {
        $enlace_descarga = './descargar_archivo.php?' .
                            'ruta_archivo=' . $ruta_archivo .
                            '&nombre_archivo=' . $nombre_archivo;
        
        $numero_radicado = trim(strtolower($cod_radi));
        $anexos_radicado[$contador]['MOSTRAR_ENL_DESCARGAR'] = true;
        $anexos_radicado[$contador]['ENLACE_DESCARGA'] = $enlace_descarga;
        $anexos_radicado[$contador]['NUMERO_RADICADO_HIST'] = $numero_radicado;
      } else {
        $numero_radicado = trim(strtolower($cod_radi));
      }
      
      $anexos_radicado[$contador]['NUMERO_RADICADO_HIST'] = $numero_radicado;
      
      $extension_archivo = null;

      $extension_archivo = ($valida_archivo)? $rs->fields["EXT"] : $msg;
      
      $anexos_radicado[$contador]['EXTENSION_ARCHIVO'] = $extension_archivo;

      $msg = ($rs->fields["SGD_DIR_TIPO"] == 7)? 'Otro Destinatario' :
                                                  'Otro Destinatario';
      
      $anexos_radicado[$contador]['MSG_DESTINATARIO'] = $msg;

      // Indica si el Radicado Ya tiene asociado algun TRD
      $isql_TRDA = "SELECT *
                    FROM SGD_RDF_RETDOCF
                    WHERE RADI_NUME_RADI = '$cod_radi'";
      $rs_TRA = $db->conn->Execute($isql_TRDA);
      $radiNumero = $rs_TRA->fields["RADI_NUME_RADI"];

      $msg_TRD = ($radiNumero != '')? 'S' : '';

      $anexos_radicado[$contador]['MSG_TRD'] = $msg_TRD;
      
      /**
      *  $perm_radi_sal  Viene del campo PER_RADI_SAL y Establece permiso en la rad. de salida
      *  1 Radicar documentos,  2 Impresion de Doc's, 3 Radicacion e Impresion.
      *  Ademas verifica que el documento no este radicado con $rowwan[9] y [10]
      *  El jefe con $codusuario = 1 siempre podra radicar
      */
      // se agrega docx ricardo
      $es_valida_ext =  $rs->fields["EXT"] == 'rtf' ||
                        $rs->fields["EXT"] == 'doc' ||
                        $rs->fields["EXT"] == 'docx' ||
                        $rs->fields["EXT"] == 'odt' ||
                        $rs->fields["EXT"] == 'xml';
      
      $es_usuario_valido = $es_valida_ext;
      
      $es_valido_anex_estado = $es_usuario_valido &&
                                $rs->fields["ANEX_ESTADO"] <= 3;

      if ($es_valido_anex_estado) {
        $anexos_radicado[$contador]['COD_DOCU_HIST'] = $coddocu;
        $anexos_radicado[$contador]['LINK_ARCHIVO_HIST'] = $linkarchivo;
        $anexos_radicado[$contador]['LINK_ARCHIVO_TMP'] = $linkarchivotmp;
        $radicado = "false";
        $anexo = $cod_radi;
      }
      
      $anexos_radicado[$contador]['TAMA']   = $rs->fields["TAMA"];
      $anexos_radicado[$contador]['RO']     = $rs->fields["RO"];
      $anexos_radicado[$contador]['CREA']   = $rs->fields["CREA"];
      $anexos_radicado[$contador]['DESCR']  = $rs->fields["DESCR"];
      $anexos_radicado[$contador]['FEANEX'] = $rs->fields["FEANEX"];
      
      $mostrar_historico = $rs->fields["SGD_PNUFE_CODI"] &&
                            strcmp($cod_radi,
                            $rs->fields["SGD_DOC_PADRE"]) == 0 &&
                            strlen($rs->fields["SGD_DOC_SECUENCIA"]) > 0;
      
      if ($mostrar_historico) {
        $anex->anexoRadicado($verrad,$rs->fields["DOCU"]);
        $anexos_radicado[$contador]['MOSTRAR_SECUENCIA'] = true;
        $anexos_radicado[$contador]['SECUENCIA_HIST'] = $anex->get_doc_secuencia_formato($dependencia);
        $anexos_radicado[$contador]['FECDOC'] = $rs->fields["FECDOC"];
      }
    
      if($origen!=1 and $linkarchivo and $verradPermisos == 'Full') {
        if ($anex_estado<4) {
          $anexos_radicado[$contador]['MOSTRAR_MODIFICAR'] = true;
          $anexos_radicado[$contador]['COD_DOCU_HIST'] = $coddocu;
          $anexos_radicado[$contador]['TPRADIC'] = $tpradic;
          $anexos_radicado[$contador]['APLINTEG'] = $aplinteg;
        }
      }
    
      //Estas variables se utilizan para verificar si se debe mostrar la opcion de tipificacion de anexo .TIF
      $anexTipo = $rs->fields["ANEX_TIPO"];
      $anexTPRActual = $rs->fields["SGD_TPR_CODIGO"];
      
      $todos_permisos = $verradPermisos == 'Full';
      
      $permisos_tip = $perm_tipif_anexo == 1 &&
                        $anexTipo == 4 &&
                        $anexTPRActual == '';

      $permisos_tip_act = $perm_tipif_anexo == 1 &&
                            $anexTipo == 4 &&
                            $anexTPRActual != '';
      
      
    if ($todos_permisos) {
      $radiNumeAnexo = $rs->fields["RADI_NUME_SALIDA"];
      
      if($radiNumeAnexo>0 and trim($linkarchivo)) {
        if(!$codserie) $codserie = '0';
        if(!$tsub) $tsub = '0';
        $anexos_radicado[$contador]['MOSTRAR_ATRD'] = true;
        $anexos_radicado[$contador]['RADINUMEANEXO'] = $radiNumeAnexo;
        $anexos_radicado[$contador]['CODSERIE'] = $codserie;
        $anexos_radicado[$contador]['TSUB'] = $tsub;
      } elseif ($permisos_tip) {
        //Es un anexo de tipo tif (4) y el usuario tiene permiso para Tipificar, ademas el anexo no ha sido tipificado
        if(!$codserie) $codserie = 0;
        if(!$tsub) $tsub = 0;
        $anexos_radicado[$contador]['MOSTRAR_ANEXO_TIPO'] = true;
        $anexos_radicado[$contador]['COD_RADI'] = $cod_radi;
        $anexos_radicado[$contador]['ANEXO'] = $anexo;
        $anexos_radicado[$contador]['CODSERIE'] = $codserie;
        $anexos_radicado[$contador]['TSUB'] = $tsub;
      } elseif ($permisos_tip_act) {
        //Es un anexo de tipo tif (4) y el usuario tiene permiso para Tipificar, ademas el anexo YA ha sido tipificado antes
        if(!$codserie) $codserie = 0;
        if(!$tsub) $tsub = 0;
        $anexos_radicado[$contador]['MOSTRAR_ANEXO_TIPO_2'] = true;
        $anexos_radicado[$contador]['COD_RADI'] = $cod_radi;
        $anexos_radicado[$contador]['ANEXO'] = $anexo;
        $anexos_radicado[$contador]['CODSERIE'] = $codserie;
        $anexos_radicado[$contador]['TSUB'] = $tsub;
      }

      $es_admin = $rs->fields["RADI_NUME_SALIDA"] == 0 &&
                    $ruta_raiz != '..' &&
                      (trim($rs->fields["ANEX_CREADOR"]) == trim($krd) ||
                        $codusuario == 1);
      
      if ($es_admin) {
        if($origen!=1 and $linkarchivo) {
          $anexos_radicado[$contador]['MOSTRAR_BORRAR'] = true;
          $anexos_radicado[$contador]['SGD_PNUFE_CODI'] = $rs->fields["SGD_PNUFE_CODI"];
          $anexos_radicado[$contador]['COD_DOCU'] = $coddocu;
          $anexos_radicado[$contador]['LINK_ARCHIVO'] = $linkarchivo;
          $anexos_radicado[$contador]['COD_RADI'] = $cod_radi;
        }
      }
      
      $tiene_permisos = $tpPerRad[$tpradic] == 2 || $tpPerRad[$tpradic] == 3;

      // Sirve para verificar si puede regenerar el radicado
      $es_formato_valido = strtolower($rs->fields["EXT"]) == 'doc' ||
                            strtolower($rs->fields["EXT"]) == 'docx' ||
                            strtolower($rs->fields["EXT"]) == 'odt' ||
                            strtolower($rs->fields["EXT"]) == 'ocx';
      
      $es_valido = $tiene_permisos && $es_formato_valido;
      
      if ($es_valido) {
          if(!$rs->fields["RADI_NUME_SALIDA"]) {
            if(substr($verrad,-1)==2 && $puedeRadicarAnexo==1) {
              $rs->fields["SGD_PNUFE_CODI"] = 0;
              $anexos_radicado[$contador]['MOSTRAR_RADICAR'] = true;
              $anexos_radicado[$contador]['COD_DOCU'] = $coddocu;
              $anexos_radicado[$contador]['LINK_ARCHIVO'] = $linkarchivo;
              $anexos_radicado[$contador]['TP_RADICADO'] = $tpradic;
              $anexos_radicado[$contador]['APLINTEG'] = $aplinteg;
              $anexos_radicado[$contador]['NUM_EXT_DOC'] = $numextdoc;
              $anexos_radicado[$contador]['SGD_PNUFE_CODI'] = $rs->fields["SGD_PNUFE_CODI"];
              $radicado = false;
              $anexo = $cod_radi;
            }	elseif ($puedeRadicarAnexo!=1) {
              $objError = new AplExternaError();
              $objError->setMessage($puedeRadicarAnexo);
              $anexos_radicado[$contador]['ERROR_RADICACION'] = $objError->getMessage();
            }	else {
              $esta_validado = (substr($verrad,-1)!=2) &&
                            $num_archivos == 1 && 
                            !$rs->fields["SGD_PNUFE_CODI"] &&
                            $swRadDesdeAnex == false;
              
              $permitir_opc = $rs->fields["SGD_PNUFE_CODI"] &&
                              strcmp($cod_radi,$rs->fields["SGD_DOC_PADRE"]) == 0 &&
                              !$anex->seHaRadicadoUnPaquete($rs->fields["SGD_DOC_ PADRE"]);
              
              if($esta_validado) {
                $anexos_radicado[$contador]['MOSTRAR_ASIGNAR_RADICADO'] = true;
                $anexos_radicado[$contador]['COD_DOCU'] = $coddocu;
                $anexos_radicado[$contador]['LINK_ARCHIVO'] = $linkarchivo;
                $anexos_radicado[$contador]['COD_RADI'] = $cod_radi;
                $anexos_radicado[$contador]['NUM_EXT_DOC'] = $numextdoc;
                $radicado = false;
                $anexo = $cod_radi;
              } elseif ($permitir_opc) {
                $anexos_radicado[$contador]['MOSTRAR_RADICAR_2'] = true;
                $anexos_radicado[$contador]['SGD_PNUFE_CODI'] = $rs->fields["SGD_PNUFE_CODI"];
                $anexos_radicado[$contador]['COD_DOCU'] = $coddocu;
                $anexos_radicado[$contador]['LINK_ARCHIVO'] = $linkarchivo;
                $anexos_radicado[$contador]['TP_RADICADO'] = $tpradic;
                $anexos_radicado[$contador]['APLINTEG'] = $aplinteg;
                $anexos_radicado[$contador]['NUM_EXT_DOC'] = $numextdoc;
                $radicado = false;
                $anexo = $cod_radi;
              }	elseif ($puedeRadicarAnexo == 1) {
                $rs->fields["SGD_PNUFE_CODI"] = 0;
                $anexos_radicado[$contador]['MOSTRAR_RADICAR_3'] = true;
                $anexos_radicado[$contador]['SGD_PNUFE_CODI'] = $rs->fields["SGD_PNUFE_CODI"];
                $anexos_radicado[$contador]['COD_DOCU'] = $coddocu;
                $anexos_radicado[$contador]['LINK_ARCHIVO'] = $linkarchivo;
                $anexos_radicado[$contador]['TP_RADICADO'] = $tpradic;
                $anexos_radicado[$contador]['APLINTEG'] = $aplinteg;
                $anexos_radicado[$contador]['NUM_EXT_DOC'] = $numextdoc;
                $radicado = false;
                $anexo = $cod_radi;
              }
            }
          }	else {
            if (!$rs->fields["SGD_PNUFE_CODI"])
              $rs->fields["SGD_PNUFE_CODI"] = 0;
            if ($anex_estado < 4) {
              $rs->fields["SGD_PNUFE_CODI"] = 0;
              $anexos_radicado[$contador]['MOSTRAR_REGENERAR'] = true;
              $anexos_radicado[$contador]['SGD_PNUFE_CODI'] = $rs->fields["SGD_PNUFE_CODI"];
              $anexos_radicado[$contador]['COD_DOCU'] = $coddocu;
              $anexos_radicado[$contador]['LINK_ARCHIVO'] = $linkarchivo;
              $anexos_radicado[$contador]['NUM_EXT_DOC'] = $numextdoc;
              $radicado = true;
            }
          }
        } elseif ($rs->fields["SGD_PNUFE_CODI"] &&
                ($usua_perm_numera_res==1) &&
                $ruta_raiz != '..' &&
                !$rs->fields["SGD_DOC_SECUENCIA"] &&
                strcmp($cod_radi,$rs->fields["SGD_DOC_PADRE"]) == 0) {
          // Si es paquete de documentos y el usuario tiene permisos
          $anexos_radicado[$contador]['MOSTRAR_NUMERAR'] = true;
          $anexos_radicado[$contador]['COD_DOCU']        = $coddocu;
          $anexos_radicado[$contador]['LINK_ARCHIVO']    = $linkarchivo;
          $anexos_radicado[$contador]['SGD_PNUFE_CODI']  = $rs->fields["SGD_PNUFE_CODI"];
        }

        if ($rs->fields["RADI_NUME_SALIDA"]) 
          $radicado = true;
      } else { 
        if ($origen!=1 && $linkarchivo && $perm_borrar_anexo == 1 && $anexTipo == 4) {
          $anexos_radicado[$contador]['MOSTRAR_BORRAR_2'] = true;
          $anexos_radicado[$contador]['COD_DOCU'] = $coddocu;
          $anexos_radicado[$contador]['LINK_ARCHIVO'] = $linkarchivo;
          $anexos_radicado[$contador]['COD_RADI'] = $cod_radi;
        }
        
        if ($perm_tipif_anexo == 1 && $anexTipo == 4 && $anexTPRActual == '')  {
          //Es un anexo de tipo tif (4) y el usuario tiene permiso para Tipificar, ademas el anexo no ha sido tipificado
          if(!$codserie) $codserie = 0;
          if(!$tsub) $tsub = 0;
          $anexos_radicado[$contador]['MOSTRAR_TIPIFICAR'] = true;
          $anexos_radicado[$contador]['COD_RADI'] = $cod_radi;
          $anexos_radicado[$contador]['ANEXO'] = $anexo;
          $anexos_radicado[$contador]['COD_SERIE'] = $codserie;
          $anexos_radicado[$contador]['TSUBSERIE'] = $tsub;
        } elseif ($perm_tipif_anexo == 1 && $anexTipo == 4 && $anexTPRActual != '') {
          //Es un anexo de tipo tif (4) y el usuario tiene permiso para Tipificar, ademas el anexo YA ha sido tipificado antes
          if(!$codserie) $codserie = 0;
          if(!$tsub) $tsub = 0;
          $anexos_radicado[$contador]['COD_RADI'] = $cod_radi;
          $anexos_radicado[$contador]['ANEXO'] = $anexo;
          $anexos_radicado[$contador]['COD_SERIE'] = $codserie;
          $anexos_radicado[$contador]['TSUBSERIE'] = $tsub;
        }
      }
      $contador++;
      $rs->MoveNext();
    }
  }
  
  $todos_permisos = $verradPermisos == 'Full';
  $es_usuario = $todos_permisos;
                
  if($es_usuario) {
    $smarty->assign('MOSTRAR_OPCIONES_ANEXAR', true);
    $mas_archivos = ($num_archivos == 0 && $swRadDesdeAnex == false)? 1
                    : 0;
    $smarty->assign('MAS_ARCHIVOS',$mas_archivos);
    $smarty->assign('NUM_ARCHIVOS',$num_archivos);
  }
  
  $smarty->assign('ANEXOS_RADICADO', $anexos_radicado);
?>
