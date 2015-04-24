<?php
  $fecha_hoy = date('Y') . '-' . date('m') . '-' . date('d');
  
  if (!$ruta_raiz)
	  $ruta_raiz = '..';
  
  $ano_ini = date('Y');
  $mes_ini = substr('00'.(date('m')-1),-2);
  
  if ($mes_ini==0) {
    $ano_ini = $ano_ini-1;
    $mes_ini = '12';
  }
  
  $dia_ini = date('d');
  
  if(!$fecha_ini) 
    $fecha_ini = $ano_ini . '/' . $mes_ini . '/' . $dia_ini;
  
  $fecha_busq = date('Y/m/d') ;
  
  if(!$fecha_fin)
    $fecha_fin = $fecha_busq;

  /**  TRANSACCIONES DE DOCUMENTOS
   *  @depsel number  contiene el codigo de la dependcia en caso de reasignacion de documentos
   *  @depsel8 number Contiene el Codigo de la dependencia en caso de Informar el documento
   *  @carpper number Indica codigo de la carpeta a la cual se va a mover el documento.
   *  @codTx   number Indica la transaccion a Trabajar. 8->Informat, 9->Reasignar, 21->Devlver
   */

  // Si esta en la Carpeta de Visto Bueno no muestra las opciones de reenviar
  $posee_radicado = $_SESSION['codusuario'] == $radi_usua_actu;
  $dependencia_actual = $_SESSION['dependencia'] == $radi_depe_actu;
  $no_enviado     = $mostrar_opc_envio == 0;

  if (($no_enviado) || ($posee_radicado && $dependencia_actual)) {
    $smarty->assign('MOSTRAR_OPCIONES_MENU', true);
    // Modificado SGD 21-Septiembre-2007
    $sql = "SELECT  PERM_ARCHI AS PERM_ARCHI,
                    PERM_VOBO AS PERM_VOBO
              FROM  USUARIO
              WHERE USUA_CODI = " . $_SESSION['codusuario'] . " AND 
                    DEPE_CODI = " . $_SESSION['dependencia'];
    $rs = $db->conn->query($sql);

    if(!$rs->EOF) {
      $permArchi = $rs->fields["PERM_ARCHI"];
      $permVobo = $rs->fields["PERM_VOBO"];
    }
    
    //Si el esta consultando la carpeta de documentos agendados entonces muestra el boton de sacar de la agenda
    $mostrar_agendados = '';
    if ($controlAgenda==1) {
      if ($agendado) {
        $mostrar_agendados = "<img name='principal_r5_c1'  src='$ruta_raiz/imagenes/internas/noAgendar.gif' width='130' height='20' border='0' alt=''>";
        $mostrar_agendados .= "<input name='Submit2' type='button' class='botones_2' value='&gt;&gt;' onClick='txNoAgendar();'>";
      } else {
        $mostrar_agendados = "<img name='principal_r5_c1'  src='$ruta_raiz/imagenes/internas/agendar.gif' width='69' height='20' border='0' alt=''> ";
      }
    }

    if (!$agendado) {
      if (($_SESSION['depe_codi_padre'] and $_SESSION['codusuario']==1) or $_SESSION['codusuario']!=1) {
      }
      if(!empty($permArchi) && $permArchi != 0) {
      }
    }
  }

  // si esta en la Carpeta de Visto Bueno no muesta las opciones de reenviar
  if (($no_enviado) || ($posee_radicado && $dependencia_actual)) {
    $row1 = array();
    
    // Combo en el que se muestran las dependencias, en el caso  de que el usuario escoja reasignar.
    $dependencianomb = substr($dependencianomb,0,35);
    $subDependencia = $db->conn->substr ."(depe_nomb,0,50)";
    
    $whereReasignar = ($_SESSION["codusuario"] != 1 && $_SESSION["usuario_reasignacion"] != 1)?
                      " where depe_codi = $dependencia" :
                      '';
    
    $sql = "select $subDependencia,
                    depe_codi
              from DEPENDENCIA
              ORDER BY DEPE_NOMB";
    $rs = $db->conn->query($sql);
    $dependencias = $rs->GetMenu2('depsel',
                                    $dependencia,
                                    false,
                                    false,
                                    0,
                                    " id=depsel class=select ");
    // genera las dependencias para informar
    $row1 = array();

    $dependencianomb = substr($dependencianomb, 0, 35);
    $subDependencia = $db->conn->substr ."(depe_nomb,0,50)";
    $sql = "SELECT $subDependencia,
                    DEPE_CODI
              FROM DEPENDENCIA
              WHERE DEPE_ESTADO = 1
              ORDER BY DEPE_NOMB";
    $rs = $db->conn->Execute($sql);

    $depe_informar = $rs->GetMenu2('depsel8[]',
                                    $dependencia,
                                    false,
                                    true,
                                    5,
                                    " id='depsel8' class='select' ");
    
    // Aqui se muestran las carpetas Personales
    $dependencianomb = substr($dependencianomb,0,35);
    $datoPersonal = '(Personal)';
    $nombreCarpeta = $db->conn->Concat("' $datoPersonal'",'nomb_carp');
    $codigoCarpetaGen = $db->conn->Concat("'10000'",
                                          "CAST( carp_codi AS VARCHAR(2) )");
    $codigoCarpetaPer = $db->conn->Concat("'11000'",
                                          "CAST( codi_carp AS VARCHAR(3) )");
    
    $sql = "select carp_desc as nomb_carp,
                    $codigoCarpetaGen as carp_codi,
                    0 as orden
            from carpeta
            where carp_codi <> 11
                  union 
                    select $nombreCarpeta as nomb_carp,
                            $codigoCarpetaPer as carp_codi,
                            1 as orden
                    from carpeta_per
                    where usua_codi = $codusuario	and
                          depe_codi = $dependencia
                          order by orden,
                                    carp_codi";

    $rs = $db->conn->Execute($sql);
    $carpetas_per = $rs->GetMenu2('carpSel',
                                    1,
                                    false,
                                    false,
                                    0,
                                    ' id="carpper" class="select" ');
    
    $ordenar_leidos = session_name() . '=' . trim(session_id()) . $encabezado . '7&orderTipo=DESC&orderNo=10';
    $ordenar_no_leidos = session_name() . '=' . trim(session_id()) . $encabezado . '8&orderTipo=ASC&orderNo=10';
    $masivas_asignar_trd = session_name() . '=' . session_id() . '&krd=' . $krd . '?' . '&radicados=';
    $mostrar_vobo = (($_SESSION['depe_codi_padre'] and $_SESSION['codusuario']==1) or $_SESSION['codusuario']!=1)? true : false;
    $mostrar_archivar = (isset($permArchi) && $permArchi != 0)? true : false;
    
    $enlace_masivas = 'accionesMasivas/masivaAsignarTrd.php?' .
                        session_name() . '=' . session_id() .
                        '&krd=' . $krd .
                        '&radicados=';
    
    $smarty->assign('ENLACE_MASIVAS',     $enlace_masivas);
    $smarty->assign('FECHA_HOY',          $fecha_hoy);
    $smarty->assign('ORFEO_URL',          ORFEO_URL);
    $smarty->assign('VERRAD',             $verrad);
    $smarty->assign('CARPETA',            $carpeta);
    $smarty->assign('CODUSUARIO',         $codusuario);
    $smarty->assign('MASIVA_ASIGNAR_TRD', $masivas_asignar_trd);
    $smarty->assign('MOSTRAR_OPC_ENVIO',  $mostrar_opc_envio);
    $smarty->assign('CODUSUARIO',         $_SESSION['codusuario']);
    $smarty->assign('MOSTRAR_VOBO',       $mostrar_vobo);
    $smarty->assign('RADI_USUA_ACTU',     $radi_usua_actu);
    $smarty->assign('DEPENDENCIA',        $_SESSION['dependencia']);
    $smarty->assign('RADI_DEPE_ACTU',     $radi_depe_actu);
    $smarty->assign('CONTROL_AGENDA',     $controlAgenda);
    $smarty->assign('AGENDADO',           $agendado);
    $smarty->assign('PERMARCHI',          $permArchi);
    $smarty->assign('MOSTRAR_ARCHIVAR',   $mostrar_archivar);
    $smarty->assign('MENU_DEPENDENCIAS_INFORMAR', $depe_informar);
    $smarty->assign('MENU_CARPETAS_PERSONALES', $carpetas_per);
    $smarty->assign('MENU_DEPENDENCIA',   $dependencias);
    $smarty->assign('MOSTRAR_OPC_ENVIO',  $mostrar_opc_envio);
    $smarty->assign('CODUSUARIO',         $codusuario);
    $smarty->assign('RADI_USUA_ACTU',     $radi_usua_actu);
    $smarty->assign('DEPENDENCIA',        $dependencia);
    $smarty->assign('RADI_DEPE_ACTU',     $radi_depe_actu);
    $smarty->assign('ORDENAR_LEIDOS',     $ordenar_leidos);
    $smarty->assign('ORDENAR_NO_LEIDOS',  $ordenar_no_leidos);
    $smarty->assign('IMG_LEIDOS',         $img7);
  }
?>
