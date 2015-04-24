<?php
  /************************************************************************************/
  /* ORFEO GPL:Sistema de Gestion Documental		http://www.orfeogpl.org	              */
  /*	Idea Original de la SUPERINTENDENCIA DE SERVICIOS PUBLICOS DOMICILIARIOS        */
  /*				COLOMBIA TEL. (57) (1) 6913005  orfeogpl@gmail.com                        */
  /* ===========================                                                      */
  /*                                                                                  */
  /* Este programa es software libre. usted puede redistribuirlo y/o modificarlo      */
  /* bajo los terminos de la licencia GNU General Public publicada por                */
  /* la "Free Software Foundation"; Licencia version 2. 			                        */
  /*                                                                                  */
  /* Copyright (c) 2005 por :	  	  	                                                */
  /* SSPS "Superintendencia de Servicios Publicos Domiciliarios"                      */
  /*   Jairo Hernan Losada  jlosada@gmail.com                Desarrollador            */
  /*   Sixto Angel Pinzón López --- angel.pinzon@gmail.com   Desarrollador            */
  /* C.R.A.  "COMISION DE REGULACION DE AGUAS Y SANEAMIENTO AMBIENTAL"                */ 
  /*   Liliana Gomez        lgomezv@gmail.com                Desarrolladora           */
  /*   Lucia Ojeda          lojedaster@gmail.com             Desarrolladora           */
  /* D.N.P. "Departamento Nacional de Planeación"                                     */
  /*   Hollman Ladino       hollmanlp@gmail.com                Desarrollador          */
  /*                                                                                  */
  /* Colocar desde esta lInea las Modificaciones Realizadas Luego de la Version 3.5   */
  /*  Nombre Desarrollador   Correo     Fecha   Modificacion                          */
  /************************************************************************************/

  $lkGenerico = '&usuario=' . $krd .
                '&nsesion=' . trim(session_id()) .
                '&nro=' . $verradicado . $datos_envio;

  $smarty->assign('RADI_FECH_RADI', $radi_fech_radi);
  $smarty->assign('ASUNTO_RADICADO', $ra_asun);

  $smarty->assign('NOMBRE_ENTIDAD_TIP1', $tip3Nombre[1][$ent]);
  $smarty->assign('NOMBRE_ENTIDAD_TITULO1', $nombret_us1);
  $smarty->assign('DOCUMENTO_ENTIDAD_TIP1',$cc_documento_us1);
  $smarty->assign('DIRECCION_CORRES_TIP1', $direccion_us1);
  $smarty->assign('DEPARTAMENTO_TIP1', $dpto_nombre_us1);
  $smarty->assign('MUNICIPIO_TIP1', $muni_nombre_us1);

  $smarty->assign('NOMBRE_ENTIDAD_TIP2', $tip3Nombre[2][$ent]);
  $smarty->assign('NOMBRE_ENTIDAD_TITULO2', $nombret_us2);
  $smarty->assign('DOCUMENTO_ENTIDAD_TIP2', $cc_documento_us2);
  $smarty->assign('DIRECCION_CORRES_TIP2', $direccion_us2);
  $smarty->assign('DEPARTAMENTO_TIP2', $dpto_nombre_us2);
  $smarty->assign('MUNICIPIO_TIP2', $muni_nombre_us2);

  $smarty->assign('NOMBRE_ENTIDAD_TIP3', $tip3Nombre[3][$ent]);
  $smarty->assign('NOMBRE_ENTIDAD_TITULO3', $nombret_us3);
  $smarty->assign('DOCUMENTO_ENTIDAD_TIP3',$cc_documento_us3);
  $smarty->assign('DIRECCION_CORRES_TIP3', $direccion_us3);
  $smarty->assign('DEPARTAMENTO_TIP3', $dpto_nombre_us3);
  $smarty->assign('MUNICIPIO_TIP3', $muni_nombre_us3);

	// Verifica si la entidad esta en causal de liquidacion
	$sl="SELECT count(*) k
        FROM bodega_empresas b,
              cta.indice i
        WHERE b.nit_de_la_empresa=i.nit and 
              i.nit='".$cc_documento_us3."' AND
              i.solicitud_minprot = 0 AND
              solicitud_ses = 0 AND
              codigo_camara <> 60";
	
  $rs = $db->conn->Execute($sl);
	
	if($rs->fields['K']==1)
    $smarty->assign('MOSTRAR_LIQUIDACION', true);

  $smarty->assign('RADI_NUME_HOJA', $radi_nume_hoja);
  $smarty->assign('RADI_DESC_ANEXOS', $radi_desc_anex);
	
  if($radi_tipo_deri!=1 and $radi_nume_deri) {
    $vars_ver_radicado = 'verrad=' . $radi_nume_deri .
                          '&' . session_name() . '=' . session_id() .
                          '&krd=' . $krd;
    $enlace_ver_rad_gen = '/verradicado.php?' . $vars_ver_radicado;
    
    $smarty->assign('RADI_NUME_DERI', $radi_nume_deri);
    $smarty->assign('ENLACE_VER_RAD_GEN', $enlace_ver_rad_gen);
    $smarty->assign('FECHA_RADICADO', date('Ymdhi'));
	
    if($verradPermisos == "Full" or $datoVer=="985") {
      $smarty->assign('MOSTRAR_VINCULO_RAD', true);
    }
	}
	
  $col = ($carpeta==5 && $_SESSION['usua_perm_sancionad']==1)? 2 : 3;

  $smarty->assign('COL', $col);
  $smarty->assign('CUENTA_INT', $cuentai);
  
  $muniCodiFac = '';
	$dptoCodiFac = '';
	
  if($sector_grb==6 and $cuentai and $espcodi) {
    if($muni_us2 and $codep_us2) {
      $muniCodiFac = $muni_us2;
      $dptoCodiFac = $codep_us2;
		} else {
      if($muni_us1 and $codep_us1) {
        $muniCodiFac = $muni_us1;
        $dptoCodiFac = $codep_us1;
			}
		}
  }
    
  $smarty->assign('MOSTRAR_FACTURACION', true);
  $vars_facturacion = 'cuentai=' . $cuentai .
                      '&muniCodi=' . $muniCodiFac .
                      '&deptoCodi=' . $dptoCodiFac .
                      '&espCodi=' . $espcodi;
  
  $enlace_facturacion = './consultaSUI/facturacionSUI.php?';
  $smarty->assign('ENLACE_FACTURACION', $enlace_facturacion);
  
  $smarty->assign('IMAGENV', $imagenv);
  $smarty->assign('FLUJO_NOMBRE', $flujo_nombre);
  
  if($verradPermisos == "Full" or $datoVer=="985") {
    $smarty->assign('MOSTRAR_FLUJO', true);
  }

  $tipo_radicado = ($nivelRad==1)? 'Privado' : 'P&uacute;blico';
  $smarty->assign('TIPO_RADICADO', $tipo_radicado);

  if($verradPermisos == "Full" or $datoVer=="985") {
    $vars_seguridad = "krd=$krd&numRad=$verrad&nivelRad=$nivelRad";
    $enlace_seguridad = ORFEO_URL . '/seguridad/radicado.php?' . $vars_seguridad;
    $smarty->assign('VER_SEGURIDAD', true);
    $smarty->assign('ENLACE_SEGURIDAD', $enlace_seguridad);
  }
  
  if(empty($codserie)) $codserie = 0;
  if(empty($tsub)) $tsub = 0;
  if(trim($val_tpdoc_grbTRD)=='///') $val_tpdoc_grbTRD = '';

  $smarty->assign('SERIE_NOMBRE', $serie_nombre);
  $smarty->assign('SUB_SERIE_NOMBRE', $subserie_nombre);
  $smarty->assign('TPDOC_NOMBRE_TRD', $tpdoc_nombreTRD);
  
  if($verradPermisos == "Full" or $datoVer=="985") {
    $smarty->assign('MOSTRAR_TRD', true);
    $smarty->assign('COD_SERIE',$codserie);
    $smarty->assign('SUBSERIE', $tsub);
  }

  $smarty->assign('SECTOR_NOMBRE', $sector_nombre);
  $nombreSession = session_name();
  $idSession = session_id();

  if ($verradPermisos == "Full" or $datoVer=="985") {
    $sector_grb = (isset($sector_grb))? $sector_grb : 0;
    $causal_grb = (isset($causal_grb) ||$causal_grb !='')? $causal_grb : 0;
    $deta_causal_grb = (isset($deta_causal_grb) || $deta_causal_grb!='')? $deta_causal_grb : 0;
    
    $enlace_causal = "'" . ORFEO_URL . '/causales/mod_causal.php?' . 
                      $nombreSession . '=' . $idSession .
                      '&krd=' . $krd . 
                      '&verrad=' . $verrad . 
                      '&sector=' . $sector_grb . 
                      '&sectorCodigoAnt=' . $sector_grb . 
                      '&sectorNombreAnt=' . $sector_nombre . 
                      '&causal_grb=' . $causal_grb . 
                      '&causal_nombre=' . $causal_nombre . 
                      '&deta_causal_grb=' . $deta_causal_grb . 
                      '&dcausal_nombre=' . $dcausal_nombre . "'";

    $smarty->assign('ENLACE_CAUSAL', $enlace_causal);
  }

  $causal_nombre_grb = $causal_nombre;
  $dcausal_nombre_grb = $dcausal_nombre;

  $smarty->assign('CAUSAL_NOMBRE', $causal_nombre);
  $smarty->assign('DCAUSAL_NOMBRE', $dcausal_nombre);
  $smarty->assign('DDCAUSAL_NOMBRE', $ddcausal_nombre);

  $enlace_tipificacion = "'" . ORFEO_URL . '/causales/mod_causal.php?' . 
                  $nombreSession . '=' . $idSession .
                  '&krd=' . $krd . 
                  '&verrad=' . $verrad . 
                  '&sector=' . $sector_grb . 
                  '&sectorCodigoAnt=' . $sector_grb . 
                  '&sectorNombreAnt=' . $sector_nombre . 
                  '&causal_grb=' . $causal_grb . 
                  '&causal_nombre=' . $causal_nombre . 
                  '&deta_causal_grb=' . $deta_causal_grb . 
                  '&dcausal_nombre=' . $dcausal_nombre . "'";

  if ($verradPermisos == "Full"  or $datoVer=="985" ) {
    $smarty->assign('MOSTRAR_TIPIFICACION', true);
    $smarty->assign('ENLACE_TIPIFICACION', $enlace_tipificacion);
  }

  $smarty->assign('TEMA_NOMBRE', $tema_nombre);
  
  if ($verradPermisos == "Full"  or $datoVer=="985")
    $smarty->assign('MOSTRAR_TEMAS', true);
	
  $ruta_raiz = '.';
  
  // Base de datos complementarias desarrollo supersolidaria
  //if($verradPermisos=="Full" or $datoVer=="985")
 	  //include ('./tipo_documento.php');
?>
