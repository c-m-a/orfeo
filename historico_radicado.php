<?php
  require_once($ruta_raiz . '/class_control/Transaccion.php');
  require_once($ruta_raiz . '/class_control/Dependencia.php');
  require_once($ruta_raiz . '/class_control/usuario.php');

  $trans  = new Transaccion($db);
  $objDep = new Dependencia($db);
  $objUs  = new Usuario($db);
  $isql   = "SELECT USUA_NOMB
                FROM USUARIO
                WHERE DEPE_CODI = $radi_depe_actu AND
                      USUA_CODI = $radi_usua_actu";
  
  $rs = $db->conn->query($isql);			      	   
  $usuario_actual = $rs->fields["USUA_NOMB"];
  
  $isql = "select DEPE_NOMB
              from dependencia
              where depe_codi = $radi_depe_actu";
  
  $rs = $db->conn->query($isql);			      	   
  $dependencia_actual = $rs->fields["DEPE_NOMB"];
  $isql = "select USUA_NOMB
              from usuario
              where depe_codi = $radi_depe_radicacion and
              usua_codi = $radi_usua_radi";
  
  $rs = $db->conn->query($isql);			      	   
  $usuario_rad = $rs->fields["USUA_NOMB"];
  
  $isql = "select DEPE_NOMB 
            from dependencia
            where depe_codi = $radi_depe_radicacion";
  
  $rs = $db->conn->query($isql);			      	   
  $dependencia_rad = $rs->fields["DEPE_NOMB"];

  $smarty->assign('USUARIO_ACTUAL', $usuario_actual);
  $smarty->assign('DEPENDENCIA_ACTUAL', $dependencia_actual);
  $smarty->assign('USUARIO_RAD', $usuario_rad);
  $smarty->assign('DEPENDENCIA_RAD', $dependencia_rad);

  $sqlFecha = $db->conn->SQLDate("d-m-Y H:i A","a.HIST_FECH");

	$isql = "select $sqlFecha AS HIST_FECH1,
                  a.DEPE_CODI,
                  a.USUA_CODI,
                  a.RADI_NUME_RADI,
                  a.HIST_OBSE,
                  a.USUA_CODI_DEST,
                  a.USUA_DOC,
                  a.HIST_OBSE,
                  a.SGD_TTR_CODIGO
              from hist_eventos a
              where a.radi_nume_radi = $verrad
              order by hist_fech desc";
	
	$rs = $db->conn->query($isql);
  $contador = 0;
  $estados_radicado = array();
	
  if($rs) {
    while(!$rs->EOF) {
      $usua_doc_dest = '';
      $usua_doc_hist = '';
      $usua_nomb_historico = '';
      $usua_destino = '';
      $numdata =  trim($rs->fields["CARP_CODI"]);
      if ($data =="") $rs1->fields["USUA_NOMB"];
      $data = "NULL";
      $numerot    = $rs->fields["NUM"];
      $usua_doc_hist = $rs->fields["USUA_DOC"];
      $usua_codi_dest = $rs->fields["USUA_CODI_DEST"];
      $usua_dest  = intval(substr($usua_codi_dest,3,3));
      $depe_dest  = intval(substr($usua_codi_dest,0,3));
      $usua_codi  = $rs->fields["USUA_CODI"];
      $depe_codi  = $rs->fields["DEPE_CODI"];
      $codTransac = $rs->fields["SGD_TTR_CODIGO"];
      $descTransaccion = $rs->fields["SGD_TTR_DESCRIP"];
      
      if(!$codTransac) $codTransac = "0";
      
      $trans->Transaccion_codigo($codTransac);
      $objUs->usuarioDocto($usua_doc_hist);
      $objDep->Dependencia_codigo($depe_codi);
      
      $imagen = ($carpeta == $numdata)? 'usuarios.gif' : 'usuarios.gif';

      $estados_radicado[$contador]['DEPENDENCIA_NOMBRE'] = $objDep->getDepe_nomb();
      $estados_radicado[$contador]['HIST_FECH1'] = $rs->fields["HIST_FECH1"];
      $estados_radicado[$contador]['GET_DESCRIPCION'] = $trans->getDescripcion();
      $estados_radicado[$contador]['GET_USUA_NOMB'] = $objUs->get_usua_nomb();
      $estados_radicado[$contador]['HIST_OBSE'] = utf8_decode($rs->fields["HIST_OBSE"]);

      $contador++;
      $rs->MoveNext();
    }
  } // Finaliza Historicos
  $smarty->assign('ESTADOS', $estados_radicado);

  //empieza datos de envio
  include ($ruta_raiz . '/include/query/queryver_historico.php');

  $isql = "select $numero_salida
            from anexos a
            where a.anex_radi_nume = $verrad";
  $rs = $db->conn->query($isql);			      	   	
  $radicado_d = '';
  $contador = 0;
  
  while(!$rs->EOF) {
		$valor = $rs->fields["RADI_NUME_SALIDA"];
    if(trim($valor))
		  $radicado_d .= "'".trim($valor) ."', ";
		$rs->MoveNext();
  }  

  $radicado_d .= $verrad;

  include ($ruta_raiz . '/include/query/queryver_historico.php');
  $sqlFechaEnvio = $db->conn->SQLDate("d-m-Y H:i A","a.SGD_RENV_FECH");
  $isql = "select $sqlFechaEnvio AS SGD_RENV_FECH,
              a.DEPE_CODI,
              a.USUA_DOC,
              a.RADI_NUME_SAL,
              a.SGD_RENV_NOMBRE,
              a.SGD_RENV_DIR,
              a.SGD_RENV_MPIO,
              a.SGD_RENV_DEPTO,
              a.SGD_RENV_PLANILLA,
              b.DEPE_NOMB,
              c.SGD_FENV_DESCRIP,
              $numero_sal,
              a.SGD_RENV_OBSERVA,
              a.SGD_DEVE_CODIGO
            from sgd_renv_regenvio a,
                  dependencia b,
                  sgd_fenv_frmenvio c
            where a.radi_nume_sal in($radicado_d) AND
                  a.depe_codi=b.depe_codi AND
                  a.sgd_fenv_codigo = c.sgd_fenv_codigo
            order by a.SGD_RENV_FECH desc";
  //$db->conn->debug = true;
  $rs = $db->conn->query($isql);
  $datos_correspondencia = array();
  
  while(!$rs->EOF) {
    $radDev = $rs->fields["SGD_DEVE_CODIGO"];
    $radEnviado = $rs->fields["RADI_NUME_SAL"];

    $imgRadDev = ($radDev)?
              "<img src='$ruta_raiz/imagenes/devueltos.gif' alt='Documento Devuelto por empresa de Mensajeria' title='Documento Devuelto por empresa de Mensajeria'>" :
              '';
    
    $numdata = trim($rs->fields["CARP_CODI"]);
    if($data == "") 
      $data = "NULL";

    $imagen = ($carpeta == $numdata)? 'usuarios.gif' : 'usuarios.gif';
    
    $link_ver_radicado = './verradicado.php?verrad=' . $radEnviado . '&krd='. $krd;

    $datos_correspondencia[$contador]['IMA_RAD_DEV']  = $imgRadDev;
    $datos_correspondencia[$contador]['RAD_ENVIADO']  = $radEnviado;
    $datos_correspondencia[$contador]['DEPE_NOMB']    = $rs->fields["DEPE_NOMB"];
    $datos_correspondencia[$contador]['SGD_RENV_FECH']= $rs->fields["SGD_RENV_FECH"];
    $datos_correspondencia[$contador]['LINK_VER_RADICADO'] = $link_ver_radicado;
    $datos_correspondencia[$contador]['SGD_RENV_NOMBRE'] = $rs->fields["SGD_RENV_NOMBRE"];
    $datos_correspondencia[$contador]['SGD_RENV_DIR']   = $rs->fields["SGD_RENV_DIR"];
    $datos_correspondencia[$contador]['SGD_RENV_DEPTO'] = $rs->fields["SGD_RENV_DEPTO"];
    $datos_correspondencia[$contador]['SGD_RENV_MPIO']  = $rs->fields["SGD_RENV_MPIO"];
    $datos_correspondencia[$contador]['SGD_FENV_DESCRIP']  = $rs->fields["SGD_FENV_DESCRIP"];
    $datos_correspondencia[$contador]['SGD_RENV_PLANILLA'] = $rs->fields["SGD_RENV_PLANILLA"];
    $datos_correspondencia[$contador]['SGD_RENV_OBSERVA']  = $rs->fields["SGD_RENV_OBSERVA"];
    $contador++;
	  $rs->MoveNext();  
  } // Finaliza Historicos
  $smarty->assign('DATOS_CORRESPONDENCIA', $datos_correspondencia);
?>
