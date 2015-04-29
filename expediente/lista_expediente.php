<?php
  $orden        = (!empty($_POST['orden']))?
                    $_POST['orden'] : $_GET['orden'];
  $verBorrados  = (!empty($_POST['verBorrados']))?
                    $_POST['verBorrados'] : $_GET['verBorrados'];
  $anexosRadicado = (!empty($_POST['anexosRadicado']))?
                    $_POST['anexosRadicado'] : $_GET['anexosRadicado'];
  $expIncluido  = (!empty($_POST['expIncluido'][0]))?
                    $_POST['expIncluido'][0] : $_GET['expIncluido'][0];
  $verBorrados  = (!empty($_POST['verBorrados']))?
                    $_POST['verBorrados'] : $_GET['verBorrados'];
  $ordenarPor   = (!empty($_POST['ordenarPor']))?
                    $_POST['ordenarPor'] : $_GET['ordenarPor'];
  
  $isqlDepR = "SELECT RADI_DEPE_ACTU,
                    RADI_USUA_ACTU
                FROM radicado
                WHERE RADI_NUME_RADI = '$numrad'";
  
  $rsDepR = $db->conn->Execute($isqlDepR);
  $coddepe = $rsDepR->fields['RADI_DEPE_ACTU'];
  $codusua = $rsDepR->fields['RADI_USUA_ACTU'];
  $ind_ProcAnex = 'N';
  $fechaH = Date('Ymdhis');

  $tipificar_expediente = '"' . ORFEO_URL .
                          'expediente/tipificarExpediente.php?' .
                          'opcionExp="+opcionExp+'.
                          '"&numeroExpediente="+numeroExpediente+' .
                          '"&nurad=' . $verrad .
                          '&codserie="+codserie+' .
                          '"&tsub="+tsub+' .
                          '"&tdoc="+tdoc+' .
                          '"&krd=' . $krd .
                          '&dependencia=' . $dependencia .
                          '&fechaExp=' . $radi_fech_radi .
                          '&codusua=' . $codusua .
                          '&coddepe=' . $coddepe .
                          '","MflujoExp' . $fechaH .
                          '",
                          "height=450,
                            width=750,
                            scrollbars=yes"';

  $smarty->assign('TIPIFICAR_EXPEDIENTE', $tipificar_expediente);
  
  $isqlDepR = "SELECT RADI_DEPE_ACTU,
                      RADI_USUA_ACTU
                  from radicado
                  WHERE RADI_NUME_RADI = '$numrad'";
  
  $rsDepR = $db->conn->Execute($isqlDepR);
  $coddepe = $rsDepR->fields['RADI_DEPE_ACTU'];
  $codusua = $rsDepR->fields['RADI_USUA_ACTU'];
  $ind_ProcAnex = 'N';

  $historico_expediente = '"' . ORFEO_URL .
                          'expediente/verHistoricoExp.php' .
                          '?sessid=' . session_id() .
                          '&opcionExp="+opcionExp+"' .
                          '&numeroExpediente="+numeroExpediente+' .
                          '"&nurad=' . $verrad .
                          '&krd=' . $krd .
                          '&ind_ProcAnex=' . $ind_ProcAnex .
                          '","HistExp'. $fechaH .
                          '","height=800,width=1060,scrollbars=yes"';

  $smarty->assign('HISTORICO_EXPEDIENTE', $historico_expediente);

  $crear_proceso = '"' . ORFEO_URL .
                    'expediente/crearProceso.php' .
                    '?sessid=' . session_id() .
                    '&numeroExpediente="+numeroExpediente+' .
                    '"&nurad=' . $verrad .
                    '&krd=' . $krd .
                    '&ind_ProcAnex=' . $ind_ProcAnex .
                    '","HistExp' . $fechaH .
                    '","height=320,
                      width=600,
                      scrollbars=yes"';

  $smarty->assign('CREAR_PROCESO', $crear_proceso);

  $seguridad_expediente = '"' . ORFEO_URL .
                          'seguridad/expediente.php?' .
                          session_name() . session_id() .
                          '&num_expediente="+numeroExpediente+"' .
                          '&nurad=' . $verrad .
                          '&nivelExp="+nivelExp+"' .
                          '&ind_ProcAnex' . $ind_ProcAnex .
                          '","HistExp' . $fechaH .
                          '","height=320,
                            width=600,
                            scrollbars=yes';
  
  $smarty->assign('SEGURIDAD_EXPEDIENTE', $seguridad_expediente);

  $isqlDepR = "SELECT RADI_DEPE_ACTU,
                      RADI_USUA_ACTU from radicado
                WHERE RADI_NUME_RADI = '$numrad'";
  $rsDepR = $db->conn->Execute($isqlDepR);
  $coddepe = $rsDepR->fields['RADI_DEPE_ACTU'];
  $codusua = $rsDepR->fields['RADI_USUA_ACTU'];
  $ind_ProcAnex = 'N';
	
  $ver_tipo_expediente = '"' . ORFEO_URL .
                          'expediente/tipificarExpedienteOld.php' .
                          '?numeroExpediente="+numeroExpediente+"' .
                          '&nurad=' . $verrad .
                          '&krd=' . $krd .
                          '&dependencia=' . $dependencia .
                          '&fechaExp=' . $radi_fech_radi .
                          '&codusua=' . $codusua .
                          '&coddepe='. $coddepe .
                          '",
                          "Tipificacion_Documento",
                          "height=450,
                            width=750,
                            scrollbars=yes"';
  
  $smarty->assign('VER_TIPO_EXPEDIENTE', $ver_tipo_expediente);

  $isqlDepR = "SELECT RADI_DEPE_ACTU,
                      RADI_USUA_ACTU
                from radicado
                WHERE RADI_NUME_RADI = '$numrad'";
	$rsDepR = $db->conn->Execute($isqlDepR);
	$coddepe = $rsDepR->fields['RADI_DEPE_ACTU'];
	$codusua = $rsDepR->fields['RADI_USUA_ACTU'];
	$ind_ProcAnex = 'N';
	
  $modificar_flujo = '"' . ORFEO_URL .
                      'flujo/modFlujoExp.php' .
                      '?codigoFldExp="+codigoFldExp+"' .
                      '&krd=' . $krd .
                      '&numeroExpediente="+numeroExpediente+"' .
                      '&numRad=' . $verrad .
                      '&texp="+texp+"' .
                      '&krd=' . $krd .
                      '&ind_ProcAnex=' . $ind_ProcAnex .
                      '&codusua=' . $codusua .
                      '&coddepe=' . $coddepe .
                      '","TexpE' . $fechaH .
                      '","height=250,
                        width=750,
                        scrollbars=yes"';

  $smarty->assign('MODIFICAR_FLUJO', $modificar_flujo);

  $isqlDepR = "SELECT RADI_DEPE_ACTU,
                      RADI_USUA_ACTU
                  FROM radicado
                  WHERE RADI_NUME_RADI = '$numrad'";
	$rsDepR = $db->conn->Execute($isqlDepR);
	$coddepe = $rsDepR->fields['RADI_DEPE_ACTU'];
	$codusua = $rsDepR->fields['RADI_USUA_ACTU'];

	
  $isql = "SELECT USUA_DOC_RESPONSABLE,
                  SGD_EXP_PRIVADO
              FROM SGD_SEXP_SECEXPEDIENTES
              WHERE SGD_EXP_NUMERO = '$numeroExpediente'";
	
  $rs = $db->conn->Execute($isql);
	$responsable= $rs->fields['USUA_DOC_RESPONSABLE'];
	$nivelExp= $rs->fields['SGD_EXP_PRIVADO'];

  $enlace_responsable = '"' . ORFEO_URL .
                        'expediente/responsable.php' .
                        '?numeroExpediente=" + numeroExpediente +' .
                        '&numRad=' . $verrad .
                        '&krd=' . $krd .
                        '&ind_ProcAnex=' . $ind_ProcAnex .
                        '&responsable=' . $responsable .
                        '&coddepe=' . $coddepe .
                        '&codusua=' . $codusua .
                        '",
                        "Responsable",
                        "height=300,
                          width=450,
                          scrollbars=yes"';

  $smarty->assign('ENLACE_RESPONSABLE', $enlace_responsable);
  
  $cambiar_expediente = '"' . ORFEO_URL .
                        'archivo/cambiar.php' .
                        '?krd=' . $krd .
                        '&numRad=' . $verrad .
                        '&expediente="+ numeroExpediente +"'.
                        '&est="+ est +"' .
                        '&dependencia=' . $dependencia .
                        '","Cambio Estado Expediente",
                        "height=100,
                          width=100,
                          scrollbars=yes"';
  
  $smarty->assign('CAMBIAR_EXPEDIENTE', $cambiar_expediente);
  
  $insert_expediente = '"' . ORFEO_URL .
                        'expediente/insertarExpediente.php' .
                        '?sessid=' . session_id() .
                        '&nurad=' . $verrad .
                        '&krd=' . $krd .
                        '&ind_ProcAnex=' . $ind_ProcAnex .
                        '",
                        "HistExp' . $fechaH .
                        '",
                          "height=300,
                          width=600,
                          scrollbars=yes"';

  $smarty->assign('INSERT_EXPEDIENTE', $insert_expediente);

  $excluir_expediente = '"' . ORFEO_URL .
                        'expediente/excluirExpediente.php' .
                        '?sessid=' . session_id() .
                        '&nurad=' . $verrad .
                        '&krd=' . $krd .
                        '&ind_ProcAnex=' . $ind_ProcAnex .
                        '","HistExp' . $fechaH .
                        '",
                        "height=300,
                          width=600,
                          scrollbars=yes"';
  
  $smarty->assign('EXCLUIR_EXPEDIENTE', $excluir_expediente);

  $incluir_docs = '"' . ORFEO_URL .
                  'expediente/incluirDocumentosExp.php' .
                  '?sessid=' . session_id() .
                  '&nurad=' . $verrad .
                  '&krd=' . $krd .
                  '&ind_ProcAnex=' . $ind_ProcAnex .
                  '&strRadSeleccionados="+strRadSeleccionados,' .
                  '"HistExp' . $fechaH .
                  '","height=300,
                    width=600,
                    scrollbars=yes"';
  
  $smarty->assign('INCLUIR_DOCS', $incluir_docs);

  $incluir_subexp = '"' . ORFEO_URL .
                    'expediente/datosSubexpediente.php' .
                    '?sessid=' . session_id() .
                    '&nurad="+numeroRadicado+"' .
                    '&krd=' . $krd .
                    '&num_expediente="+numeroExpediente,
                    "HistExp' . $fechaH .
                    '",
                    "height=350,
                      width=700,scrollbars=yes"';
  
  $smarty->assign('INCLUIR_SUBEXP', $incluir_subexp);
  $smarty->assign('ORDEN', $orden);

  function microtime_float() {
     list($usec, $sec) = explode(" ", microtime());
     return ((float)$usec + (float)$sec);
  }

  $time_start = microtime_float();
  
  if(!isset($verBorrados)) {
    $smarty->assign('MOSTRAR_BORRADOS', true);
    $smarty->assign('ANEXOS_RADICADOS', $anexosRadicado);
	}

	$verradicado = $verrad;

	if($menu_ver_tmp)
		$menu_ver = $menu_ver_tmp;
	
	if($verradicado)
		$verrad = $verradicado;
	
	$numrad = $verrad;

	if(!$menu_ver)
		$menu_ver = 4;
	
	$fechah = date("dmy_h_m_s") . " ". time("h_m_s");
	$check = 1;
	$numeroa = 0;
	$numero = 0;
	$numeros = 0;
	$numerot = 0;
	$numerop = 0;
	$numeroh = 0;

	if($radi_nume_deri and ($radi_tipo_deri==0 or $radi_tipo_deri==2)) {
    $smarty->assign('MOSTRAR_DOCS', true);
    $smarty->assign('NOMBRE_DERI', $nombre_deri);
    $smarty->assign('RADI_NUME_DERI', $radi_nume_deri);
		
    $isql = "SELECT a.*
              FROM radicado a
              WHERE a.radi_nume_radi = $radi_nume_deri";
		$rs = $db->conn->Execute($isql);

    $radicados = array();
    $i = 0;
		
    if(!$rs->EOF) {
			while(!$rs->EOF) {
				$radicados[$i]['radicado_d']  = $rs->fields["RADI_NUME_RADI"];
				$radicados[$i]['fechaRadicadoPadre'] = $rs->fields["RADI_FECH_RADI"];
				$radicados[$i]['radicado_path']      = $rs->fields["RADI_PATH"];
				$radicados[$i]['raAsunAnexo']        = $rs->fields["RA_ASUN"];
				$radicados[$i]['cuentaIAnexo']       = $rs->fields["RADI_CUENTAI"];
        $radicados[$i]['ano_creacion']       = substr($nombre_archivo, 0, 4);
        $radicados[$i]['ver_radicado']      = 'verradicado.php' .
                                              '?verrad=' . $radicado_d . '&'.
                                              session_name() . '=' .
                                              session_id() .
                                              '&krd=' . $krd .
                                              '" target="VERRAD' . $radicado_d;
        foreach ($arreglo_explode as $value)
          $nombre_archivo = (preg_match('/.+\.[a-z]+$/',$value, $rs_nombre))? $rs_nombre[0] : null;
        
        $radicados[$i]['ref_radicado'] = ($radicado_path)?
                          "<a href='$rutaRaiz/descargar_archivo.php?ruta_archivo=/$ano_creacion/$dependencia_creadora/$nombre_archivo&nombre_archivo=$nombre_archivo'><span class='$radFileClass'>$v</span></a>":
                          $radicado_d;
        $i++;
				$rs->MoveNext();
			}
		}
	}
  
  if($numrad) {
    $q_exp  = "SELECT SGD_EXP_NUMERO as valor,
                        SGD_EXP_NUMERO as etiqueta,
                        SGD_EXP_FECH as fecha
                FROM SGD_EXP_EXPEDIENTE
                WHERE RADI_NUME_RADI = " . $numrad . " AND
                      SGD_EXP_ESTADO <> 2 
                      ORDER BY fecha desc";
  } else {
    $q_exp  = "SELECT SGD_EXP_NUMERO as valor,
                      SGD_EXP_NUMERO as etiqueta,
                      SGD_EXP_FECH as fecha
                FROM SGD_EXP_EXPEDIENTE
                WHERE SGD_EXP_NUMERO = '" . trim($numeroExpediente) . "' AND
                      SGD_EXP_ESTADO <> 2
                      ORDER BY fecha desc";
  }
  
  $rs_exp = $db->conn->Execute($q_exp);

	if($rs_exp->RecordCount() == 0) {
		$mostrarAlerta = "<td align=\"center\" class=\"titulos2\">";
		$mostrarAlerta .= "<span class=\"leidos2\" class=\"titulos2\" align=\"center\">
				<b>ESTE DOCUMENTO NO HA SIDO INCLUIDO EN NINGUN EXPEDIENTE.</b>
			</span>
			</td>";
    $sqlt = "select RADI_USUA_ACTU,
                  RADI_DEPE_ACTU
            from RADICADO
            where RADI_NUME_RADI LIKE '$numrad'";
    $rsE = $db->conn->query($sqlt);
    $depe = $rsE->fields['RADI_DEPE_ACTU'];
    $usua = $rsE->fields['RADI_USUA_ACTU'];
	
  if($depe == '999' and $usua=='1') {
    $smarty->assign('MOSTRAR_INSERTAR_EXP', true);
	  echo '<td align="left">
            <a href="#" onClick="insertarExpediente();" ><span class="leidos2"><b> INCLUIR EN</b></span></a>';

      if ($usuaPermExpediente >= 1) {
      echo '<a href="#" onClick="verTipoExpediente(' . "'" . $num_expediente . "','" . $codserie . "','" . $tsub . "','" . $tdoc . "','MODIFICAR')>";
      echo '<span class="leidos"><b>CREAR</b></span></a>';
	  }
	}
		$smarty->assign('MOSTRAR_ALERTA', $mostrarAlerta);
	} else {
    $menu_expedientes = $rs_exp->GetMenu('expIncluido',
                            $expIncluido,
                            false,
                            true,
                            3,
                            "class='select' onChange='document.form2.submit();'",
                            false);

    if(!$codserie)
      $codserie = 0;
    
    if(!$tsub)
      $tsub = 0;
    
    if(!$tdoc)
      $tdoc = 0;
    
    if($usuaPermExpediente >= 1)
      $mostrar_opcion_crear = true;
  }
	
  include_once (ORFEO_PATH . 'include/tx/Expediente.php');
	$expediente = new Expediente($db);
	$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
  
  $verrad_padre = ($radi_tipo_deri==0 and $radi_nume_deri)?
                    $radi_nume_deri :
                    $verrad;

	// Modificado 23-Junio-2006 Supersolidaria
	// Consulta si el radicado esta archivado o ha sido excluido del expediente.
	if ($numExpediente == "")
    $numExpediente = $expediente->consulta_exp("$verrad");
  
	// Modificado Infometrika 23-Julio-2009
  if ($num_expediente != "" && !isset($expIncluido))
    $numExpediente = $num_expediente;
	elseif (isset($expIncluido) && $expIncluido != "")
		$numExpediente = $expIncluido;

  $smarty->assign('NUM_EXPEDIENTE', $numExpediente);
  $smarty->assign('DATOSS',         $datoss);
  $smarty->assign('RESPONSABLE',    $responsable);

	$expediente->expedienteArchivado( $verrad, $numExpediente );

	// Si el radicado no ha sido excluido del expediente
	if( $expediente->estado_expediente != 2 ) {
		// Si tiene expediente
 		if ($numExpediente) {
			// Modificado Supersolidaria 03-Agosto-2006
			// Asigna a $num_expediente el valor de $numExpedente recibido desde ver_datosrad.php
			$num_expediente = $numExpediente;
			$datoss = " readonly ";

			if($expediente->estado_expediente == 0) {
				//$mensaje = "<br>Expediente No Ubicado fisicamente en Archivo<br>";
			} elseif( $expediente->estado_expediente == 1 ) {
        $mensaje ="<br>El expediente se ha Ubicado fisicamente en Archivo<br>";
			}
    }
    
	} else {
    $numExpediente = "";
	}

	$isqlDepR = "SELECT USUA_DOC_RESPONSABLE,
                      SGD_EXP_PRIVADO
                  FROM SGD_SEXP_SECEXPEDIENTES
                  WHERE SGD_EXP_NUMERO = '$numExpediente'
                  ORDER BY SGD_SEXP_FECH DESC ";
	
  $rsDepR   = $db->conn->Execute($isqlDepR);
	$nivelExp = $rsDepR->fields['SGD_EXP_PRIVADO'];
	$docRes   = $rsDepR->fields['USUA_DOC_RESPONSABLE'];
	
  $isqlDepR = "SELECT USUA_NOMB
                FROM USUARIO
                WHERE USUA_DOC = '$docRes'";
	
  $rsDepR   = $db->conn->Execute($isqlDepR);
	$responsable = $rsDepR->fields['USUA_NOMB'];
	$isql     = "SELECT USUA_PERM_EXPEDIENTE
                FROM USUARIO
                WHERE USUA_LOGIN = '$krd'";
	
  $rs       = $db->conn->Execute($isql);
	$krdperm  = $rs->fields['USUA_PERM_EXPEDIENTE'];
	$sqlb     = "select sgd_exp_archivo from sgd_exp_expediente 
                where sgd_exp_numero like '$num_expediente'";
	
	$rsb      = $db->conn->Execute($sqlb);
	$arch     = $rsb->fields['SGD_EXP_ARCHIVO'];
	
	$mostar   = true;		
	$mostrar  = true;
	
  // Modificado Infometrika 23-Julio-2009
	if ( $num_expediente != "" && !isset( $expIncluido ) ) {
    $smarty->assign('mostrar_responsable', true);
		
    if ($krdperm == 2) {
      $mostrar_cerrar_exp = true;
			if ($arch!=2 && $mostar) {
        $mostrar_cerrar = true;
		  } elseif($mostrar){
        $mostrar_cambiar_exp = true;
      }
    }
  }

	// Modificado Infometrika 23-Julio-2009
	elseif ( isset( $expIncluido ) && $expIncluido != "" ) {
    $mostrar_excluido = true;
	  
    if($krdperm == 2) {
      $mostrar_exp_responsable = true;
      
      if ($mostrar)
        $mostrar_mas_basura  = true;	
      
      if ($arch==2 && $mostar) {
	    }
    }
  } else {
    // Muestra algo
  }
	
  // Consulta si el expediente tiene una clasificacion trd
	$codserie = '';
	$tsub = '';

	include_once ($ruta_raiz . '/include/tx/Expediente.php');
	$trdExp 	= new Expediente($db);
	
	$mrdCodigo 	    = $trdExp->consultaTipoExpediente($numExpediente);
	$trdExpediente 	= $trdExp->descSerie." / ".$trdExp->descSubSerie;
	$descPExpediente = $trdExp->descTipoExp;
	$procAutomatico = $trdExpediente->pAutomatico;
	$codserie       = $trdExp->codiSRD;
	$tsub           = $trdExp->codiSBRD;
	$tdoc           = $trdExp->codigoTipoDoc;
	$texp           = $trdExp->codigoTipoExp;
	$descFldExp 	  = $trdExp->descFldExp;
	$codigoFldExp 	= $trdExp->codigoFldExp;
	if(!$codserie) $codserie=0;
	if(!$tsub) $tsub=0;
	if(!$tdoc) $tdoc=0;

	$resultadoExp = 0;
	if($funExpediente == "INSERT_EXP") {
		$resultadoExp = $expediente->insertar_expediente($num_expediente,
								$verrad,
								$dependencia,
								$codusuario,
								$usua_doc);
		if($resultadoExp==1) {
			echo '<hr>Se anex&oacute; este radicado al expediente correctamente.<hr>';
		}else {
			echo '<hr><font color=red>No se anex&oacute; este radicado al expediente. V
				Verifique que el numero del expediente exista e intente de nuevo.</font><hr>';
		}
	}

	if($funExpediente == "CREAR_EXP") {
		$resultadoExp = $expediente->crearExpediente($num_expediente,
								$verrad,
								$dependencia,
								$codusuario,
								$usua_doc);
		if($resultadoExp==1) {
			echo '<hr>El expediente se creo correctamente<hr>';
		}else{
		  echo '<hr><font color=red>El expediente ya se encuentra creado.
			  <br>A continuaci&oacute;n aparece la lista de documentos pertenecientes al expediente que intento crear
			  <br>Si esta seguro de incluirlo en este expediente haga click sobre el boton  "Grabar en Expediente"
			  </font><hr>';
		}
	}
	if ($carpeta==99998) {
	} else {
	  if(!trim($num_expediente)) {
	    if($usuaPermExpediente >=1) {
      }
    } else {
      if(!$codserie and !$tsub) {
	    }
	  }
  }
	
  if($ASOC_EXP and !$funExpediente) {
    for($ii=1;$ii<$i;$ii++) {
			$expediente->num_expediente = '';
			$exp_num = $expediente->consulta_exp($radicados_anexos[$ii]);
			$exp_num = $expediente->num_expediente;

			if($exp_num=="") {
				$expediente->insertar_expediente($num_expediente,
								$radicados_anexos[$ii],
								$dependencia,
								$codusuario,
								$usua_doc);
			}
		}
	}
	echo "<br>$mensaje<br>";
  
  if (!$codigoFldExp)
    $codigoFldExp= "0";

  if ($descPExpediente){
	  $expediente->consultaTipoExpediente($num_expediente);
  }

  if ($num_expediente !="") {
    if($usuaPermExpediente) {
    
    } else {
  }
	
  // Modificado Infometrika 23-Julio-2009
	if ( $expIncluido != "" ) {
		// Modificado Infometrika 23-Julio-2009
		$arrTRDExp = $expediente->getTRDExp( $expIncluido, "", "", "" );
	} elseif( $num_expediente != "" ){
		$arrTRDExp = $expediente->getTRDExp( $num_expediente, "", "", "" );
	}
	
  // Modificado Infometrika 23-Julio-2009
	if ( $expIncluido != "" ) {
		// Modificado Infometrika 23-Julio-2009
		$arrDatosParametro = $expediente->getDatosParamExp( $expIncluido, $dependencia );
	}
	// Modificado 16-Agosto-2006 Supersolidaria
	else if( $numExpediente != "" ) {
	  $arrDatosParametro = $expediente->getDatosParamExp( $numExpediente, $dependencia );
	}
	
  if( $arrDatosParametro != "" ) {
		foreach( $arrDatosParametro as $clave => $datos ) {
?>
      <tr rowspan="4"   class="leidos2">
        <td colspan="2" class="titulos5"><? print $datos['etiqueta']; ?>:</td>
        <td colspan="2" ><? print $datos['parametro']; ?></td>
      </tr>
        <?php
        }
  }
  /*
   *  Modificado: 17-Agosto-2006 Supersolidaria
   *  Muestra el termino cuando el expediente tiene un proceso asociado .
  */
    if( $arrTRDExp['proceso'] != "" )
		  print $arrTRDExp['proceso']." / ".$arrTRDExp['terminoProceso'];
    
     // Modificado: 23-Agosto-2006 Supersolidaria
      print "<p>";
      // Modificado Infometrika 23-Julio-2009
      if( !isset( $verBorrados ) ) {
?>
        Ver Borrados:&nbsp;
<?php
        } else {
        ?>
        Ocultar Borrados:&nbsp;
        <?php
        }
        print '<input type="button" name="btnVerBorrados" value="..." class="botones_2" onclick="document.form2.submit();">';
        print '</p>';
        $enlace_descarga = './descargar_archivos_expediente.php?' .
                            'numero_expediente=' . $numExpediente;
    }
    // Modificado Infometrika 23-Julio-2009
    if ( $num_expediente != "" && !isset($expIncluido))
      $expedienteSeleccionado = $num_expediente;
    elseif ( isset( $expIncluido ) && $expIncluido != "" ) {
      $expedienteSeleccionado = $expIncluido;
    }

if($expedienteSeleccionado) {
	include_once($ruta_raiz.'/include/query/queryver_datosrad.php');
	$fecha = $db->conn->SQLDate("d-m-Y H:i A","a.RADI_FECH_RADI");

    // Modificacion: 14-Junio-2006 Supersolidaria Opcion para ordenar los registros
	$isql = "select ";
  if($driver=="oci8") {
		$isql .= " /*+ all_rows */ ";
	}
  
  // Modificado Carlos Barrero - Supersolidaria
	$isql = "SELECT R.*,
                  c.sgd_tpr_descrip,
                  " . $fecha . "as FECHA_RAD ,
                  a.RADI_CUENTAI,
                  a.RA_ASUN,
                  a.RADI_PATH,
                  a.SGD_SPUB_CODIGO,
                  a.*,
                  PRC.SGD_PRC_DESCRIP,
                  PRD.SGD_PRD_DESCRIP
              FROM RADICADO a,
                    SGD_TPR_TPDCUMENTO c,
                    SGD_EXP_EXPEDIENTE r
                  LEFT JOIN SGD_PRD_PRCDMENTOS PRD ON PRD.SGD_PRD_CODIGO = r.SGD_PRD_CODIGO
                  LEFT JOIN SGD_PRC_PROCESO PRC ON PRC.SGD_PRC_CODIGO = PRD.SGD_PRC_CODIGO
              WHERE
                  /*r.sgd_exp_numero='$num_expediente'*/
                  r.sgd_exp_numero='$expedienteSeleccionado' and
                  r.radi_nume_radi=a.radi_nume_radi and
                  a.tdoc_codi=c.sgd_tpr_codigo AND
                  r.SGD_EXP_ESTADO <> 2
                  /*order by TO_CHAR(a.RADI_FECH_RADI, 'YYYY-MM-DD HH24:MI AM') desc*/";

  $isql .= " order by a.radi_fech_radi desc";
  $rs = $db->conn->query($isql);
  $i = 0;
  while(!$rs->EOF) {
    $radicado_d     = "";
    $radicado_path  = "";
    $radicado_fech  = "";
    $radi_cuentai   = "";
    $rad_asun       = "";
    $tipo_documento_desc = "";
    $radicado_d     = $rs->fields["RADI_NUME_RADI"];
    $radicado_path  = $rs->fields["RADI_PATH"];
    $radicado_fech  = $rs->fields["FECHA_RAD"];
    $radi_cuentai   = $rs->fields["RADI_CUENTAI"];
    $rad_asun       = $rs->fields["RA_ASUN"];
    $tipo_documento_desc = $rs->fields["SGD_TPR_DESCRIP"];
    $subexpediente  = $rs->fields["SGD_PRC_DESCRIP"]."/".$rs->fields["SGD_PRD_DESCRIP"];
    $seguridadRadicado = $rs->fields["SGD_SPUB_CODIGO"];
    $usu_cod        = $rs->fields["RADI_USUA_ACTU"];
    $radi_depe      = $rs->fields["RADI_DEPE_ACTU"];
    $nivelRadicado  = $rs->fields["CODI_NIVEL"];
    $isqlSExp       = "select *
                          from sgd_exp_expediente 
                          where radi_nume_radi=$radicado_d and
                                sgd_exp_numero <> '$num_expediente'";
    $rsSExp = $db->conn->query($isqlSExp);
    $sExp = "";
    while(!$rsSExp->EOF){
      $sExp .= $rsSExp->fields["SGD_EXP_NUMERO"].  "<br>";
      $rsSExp->MoveNext();
    }
    
    $verImg = ($seguridadRadicado==1)?
                (($usu_cod!=$_SESSION['codusuario'] || $radi_depe!=$_SESSION['dependencia'])? false:true):($nivelRadicado >$nivelus?false:true);
    
    if($verImg <= 9999999999999999999999999) {
      $arreglo_explode = explode('/', $radicado_path);
      
      foreach ($arreglo_explode as $value) 
        $nombre_archivo = (preg_match('/.+\.[a-z]+$/',$value, $rs_nombre))? $rs_nombre[0] : null;
        $ano_creacion = substr($nombre_archivo, 0, 4);
        $dependencia_radicadora = substr($nombre_archivo, 4, 3);
        
        $enlace_descarga = $ruta_raiz . '/descargar_archivo.php?' .
                            'ruta_archivo=/' . $ano_creacion .
                            '/' . $dependencia_radicadora .
                            '/' . $nombre_archivo .
                            '&nombre_archivo=' . $nombre_archivo;
        $ref_radicado = "<a href='$enlace_descarga'><span class=leidos>$radicado_d</span></a>";
      $radicado_fech = "<a href='$ruta_raiz/verradicado.php?verrad=$radicado_d&PHPSESSID=".session_id()."&krd=$krd&carpeta=8&nomcarpeta=Busquedas&tipo_carp=0&menu_ver_tmp=3' target=".$radicado_fech."><span class=leidos>$radicado_fech</span></a>";
    }else{
        $ref_radicado = "$radicado_d";
        $radicado_fech = "<a href='#' onclick=\"alert('El documento posee seguridad y no posee los suficientes permisos'); return false;\"><span class=leidos>$radicado_fech</span></a>";
    }
  
  // Modificado Infometrika 23-Julio-2009
  if (!isset($verBorrados)) {
    if( ( $anexosRadicado != $radicado_d ) ) {
    }
    else if( ( $anexosRadicado == $radicado_d)) {
    }
  }
  
  if( isset( $verBorrados ) ) {
    if( ( $verBorrados == $radicado_d ) ) {
    }
    else if( ( $verBorrados != $radicado_d ) )
    {
    }
  }
 if( $usuaPermExpediente and $verradPermisos == "Full" ) {
    
   }
      echo $sExp;
	/**
	  *   Carga los anexos del radicado indicado en la variable $radicado_d
		*   incluye la clase anexo.php
		**/
	include_once "$ruta_raiz/class_control/anexo.php";
	include_once "$ruta_raiz/class_control/TipoDocumento.php";
	$a = new Anexo($db->conn);
	$tp_doc = new TipoDocumento($db->conn);
    $num_anexos = $a->anexosRadicado($radicado_d);
    $anexos_radicado=$a->anexos;
    if(isset($verBorrados)) {
        $num_anexos = $a->anexosRadicado( $radicado_d, true );
    }
	if($num_anexos>=1) {
	for($iia=0;$iia<=$num_anexos;$iia++) {

	$codigo_anexo = $a->codi_anexos[$iia];
	if($codigo_anexo and substr($anexDirTipo,0,1)!='7') {
		$tipo_documento_desc  = "";
		$fechaDocumento       = "";
		$anex_desc            = "";
		$a->anexoRadicado($radicado_d,$codigo_anexo);
		$secuenciaDocto       = $a->get_doc_secuencia_formato($dependencia);
		$fechaDocumento       = $a->get_sgd_fech_doc();
		$anex_nomb_archivo    = $a->get_anex_nomb_archivo();
		$anex_desc            = $a->get_anex_desc();
		$dependencia_creadora = substr($codigo_anexo,4,3);
		$ano_creado= substr($codigo_anexo,0,4);
		$sgd_tpr_codigo       = $a->get_sgd_tpr_codigo();
		// Trae la descripcion del tipo de Documento del anexo
		if($sgd_tpr_codigo) {
		  $tp_doc->TipoDocumento_codigo($sgd_tpr_codigo);
		  $tipo_documento_desc = $tp_doc->get_sgd_tpr_descrip();
		}
	$anexBorrado = $a->anex_borrado;
	$anexSalida = $a->get_radi_anex_salida();
	$ext = substr($anex_nomb_archivo,-3);

	if(trim($anex_nomb_archivo) or $anexSalida!=1 or $ii) {
	?>
	<tr  class='timpar'>
      <td valign="baseline" class='listado5'>&nbsp;</td>
  <td valign="baseline"  class='listado5'>
  <?php
  if($anexBorrado == 'S') {
  ?>
    <img src="iconos/docs_tree_del.gif">
  <?php
  }
  elseif($anexBorrado == 'N') {
  ?>
    <img src="iconos/docs_tree.gif">
  <?php
  }
  $rut = "bodega";
  $enlace_descarga = $ruta_raiz . '/descargar_archivo.php?' .
                    'ruta_archivo=/' . $ano_creado .
                                  '/' . $dependencia_creadora .
                                  '/docs/' . $anex_nomb_archivo .
                                  '&nombre_archivo='. $anex_nomb_archivo .
                                  '&from=expediente';
	echo "<a href='$enlace_descarga'>" . substr($codigo_anexo,-4)."</a>";
  ?>
  <!--<a href='<?=$rut."/".$ano_creado."/$dependencia_creadora/docs/$anex_nomb_archivo"?>'>
	  <?=substr($codigo_anexo,-4).""?> 
	</a>-->
  </td>
  <td valign="baseline" class='listado5'><?=$fechaDocumento ?></td>
  <td valign="baseline" class='listado5'><?=$tipo_documento_desc ?></TD>
  <TD valign="baseline" class='listado5'><span class='leidos2'><?=substr($anex_desc,0,30)?></span></td>
  <TD valign="baseline" class='leidos2'><?=$otroExpediente ?></TD>
  <TD valign="baseline"  class='listado5'></TD>
  </tr>
<?php
   	} // Fin del if que busca si hay link de archivo para mostrar o no el doc anexo
	}
}  // Fin del For que recorre la matriz de los anexos de cada radicado perteneciente al expediente
}
	 
	 $rs->MoveNext();
	}
} // Fin del While que Recorre los documentos de un expediente.
  if( $usuaPermExpediente and $verradPermisos == "Full" or $dependencia=='999') {
}
    $arrAnexoAsociado = $expediente->expedienteAnexoAsociado( $verrad );

    if(is_array($arrAnexoAsociado)) {
        include_once "$ruta_raiz/include/tx/Radicacion.php";
        $rad = new Radicacion( $db );

        foreach( $arrAnexoAsociado as $clave => $datosAnexoAsociado ) {
            if( $datosAnexoAsociado['radPadre'] != "" && $datosAnexoAsociado['radPadre'] != $verrad && $datosAnexoAsociado['anexo'] == $verrad ) {
                $arrDatosRad = $rad->getDatosRad( $datosAnexoAsociado['radPadre'] );
                if($arrDatosRad['ruta'] != "") {
		    if(substr($datosAnexoAsociado['radPadre'],0,4)=='2007')$rut="bodega2007/";
		    elseif(substr($datosAnexoAsociado['radPadre'],0,4)=='2008')$rut="bodega2008/";
		    else $rut="bodega/";
                    $rutaRadicado = "<a href='".$rut.$arrDatosRad['ruta']."' >".$datosAnexoAsociado['radPadre']."</a>";
                }
                else
                {
                    $rutaRadicado = $datosAnexoAsociado['radPadre'];
                }
                $radicadoAnexo = $datosAnexoAsociado['radPadre'];
                $tipoRelacion = "ANEXO DE (PADRE)";
            }
            else if( $datosAnexoAsociado['radPadre'] == $verrad && $datosAnexoAsociado['anexo'] != "" ) {
                $arrDatosRad = $rad->getDatosRad( $datosAnexoAsociado['anexo'] );
                if( $arrDatosRad['ruta'] != "" ) {
		              $rut="bodega/";
                  $rutaRadicado = "<a href='".$rut.$arrDatosRad['ruta']."' >".$datosAnexoAsociado['anexo']."</a>";
                } else {
                  $rutaRadicado = $datosAnexoAsociado['anexo'];
                }
                $radicadoAnexo = $datosAnexoAsociado['anexo'];
                $tipoRelacion = "ANEXO";
            }
            else if( $datosAnexoAsociado['radPadre'] == $verrad && $datosAnexoAsociado['asociado'] != "" ) {
                $arrDatosRad = $rad->getDatosRad( $datosAnexoAsociado['asociado'] );
                if( $arrDatosRad['ruta'] != "" ) {
		              $rut="bodega/";
                    $rutaRadicado = "<a href='".$rut.$arrDatosRad['ruta']."' >".$datosAnexoAsociado['asociado']."</a>";
                }
                else
                {
                    $rutaRadicado = $datosAnexoAsociado['asociado'];
                }
                $radicadoAnexo = $datosAnexoAsociado['asociado'];
                $tipoRelacion = "ASOCIADO";
            }
        print $rutaRadicado;
            print $arrDatosRad['fechaRadicacion'];
        print $arrDatosRad['tipoDocumento'];
        print $arrDatosRad['asunto'];
        print $tipoRelacion;
        }
    }
    $time_end = microtime_float();
    $time = $time_end - $time_start;
    echo "<span class='info'>";  
    echo "<br><b>Se demor&oacute;: $time segundos la Operaci&oacute;n total.</b>";
    echo "</span>"; 	
?>
