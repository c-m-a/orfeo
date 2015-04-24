<?php
  /*************************************************************************************/
  /* ORFEO GPL:Sistema de Gestion Documental		http://www.orfeogpl.org	               */
  /*	Idea Original de la SUPERINTENDENCIA DE SERVICIOS PUBLICOS DOMICILIARIOS         */
  /*				COLOMBIA TEL. (57) (1) 6913005  orfeogpl@gmail.com                         */
  /* ===========================                                                       */
  /*                                                                                   */
  /* Este programa es software libre. usted puede redistribuirlo y/o modificarlo       */
  /* bajo los terminos de la licencia GNU General Public publicada por                 */
  /* la "Free Software Foundation"; Licencia version 2. 			                         */
  /*                                                                                   */
  /* Copyright (c) 2005 por :	  	  	                                                 */
  /* SSPS "Superintendencia de Servicios Publicos Domiciliarios"                       */
  /*   Jairo Hernan Losada  jlosada@gmail.com                Desarrollador             */
  /*   Sixto Angel Pinzon Lopez --- angel.pinzon@gmail.com   Desarrollador             */
  /* C.R.A.  "COMISION DE REGULACION DE AGUAS Y SANEAMIENTO AMBIENTAL"                 */
  /*   Lucia Ojeda          lojedaster@gmail.com             Desarrolladora            */
  /* D.N.P. "Departamento Nacional de Planeacion"                                      */
  /*   Hollman Ladino       hollmanlp@gmail.com                Desarrollador           */
  /*                                                                                   */
  /* Colocar desde esta linea las Modificaciones Realizadas Luego de la Version 3.5    */
  /*  Nombre Desarrollador   Correo     Fecha   Modificacion                           */
  /* Carlos Barrero	- carlosabc81@gmail.com - SES					                             */
  /*************************************************************************************/
  
  // Usuario Activos para modificar Cooperativas
  $usuarios_modulo_coop = array('ADMON',
                               'OCSES1',
                               'OCSES2',
                               'OCSES3',
                               'OCSES4',
                               'OCSES5',
                               'OCSES6',
                               'OCSES7',
                               'OCSES8',
                               'OCSES9');
  
  $mostrar_visitas  = false;
  $usua_perm_adment = false;
  $enlace_visitas   = '';
  $usua_perm_comisiones = false;
  $enlace_control_legalidad = '';
  $mostrar_plantilla    = false;

  $variables_get = $phpsession .
                    '&krd=' . $krd .
                    '&fechah=' . $fechah .
                    '&usr=' . md5($dependencia) .
                    '&primera=1' .
                    '&ent=1';
  
  $enlace_modulo_coop  = './Administracion/modulo_cooperativas.php?' . $variables_get;
  $mostrar_modulo_coop = false;
  $usuario_sistema     = strtoupper(trim($krd));

  foreach ($usuarios_modulo_coop as $usuario) {
    if ($usuario_sistema == $usuario) {
      $mostrar_modulo_coop = true;
      break;
    }
  }
  
  // Modulo control legalidad
  $enlace_ctl_legalidad = 'control_legalidad/reportes.php?' . $variables_get;
  $mostrar_ctl_legalidad = ($krd=='UGPP')? true : false;

  // Mostrar modulo Administracion del sistema
  $mostrar_administracion = ($_SESSION["usua_admin_sistema"] == 1)? true : false;
  $enlace_admin = 'Administracion/?' . $variables_get;

  // Mostrar modulo Reasignacion Automatica
  $enlace_reasignacion = 'reasignacion_automatica/rea_aut_rad.php?' . $variables_get;
  
  // Mostrar modulo de Flujos de Proceso
  $mostrar_flujos = ($_SESSION["usua_perm_adminflujos"] == 1) ? true : false;
  $vars_admin_flujos = $phpsession;
  $enlace_admin_flujos = 'Administracion/flujos/texto_version2/mnuFlujosBasico.php?' . $vars_admin_flujos;
  
  // Mostrar modulo de Envios
  $mostrar_envios = ($_SESSION["usua_perm_envios"] >= 1)? true : false;
  $enlace_envios = 'radicacion/formRadEnvios.php?' . $variables_get;
  
  // Mostrar modulo de Modificacion
  $mostrar_modificacion = ($_SESSION["usua_perm_modifica"] >= 1)? true : false;
  $vars_modificacion  = $phpsession . '&fechah=' . $fechah . '&primera=1&ent=2';
  $enlace_modificacion = 'radicacion/edtradicado.php?' . $vars_modificacion;

  // Mostrar modulo de Firma Digital
  $mostrar_firma = ($_SESSION["usua_perm_firma"] == 1 || $_SESSION["usua_perm_firma"] == 3)? true : false;
  $vars_firma = $phpsession .
                '&krd=' . $krd .
                '&fechaf=' . $fechah .
                '&carpeta=8' .
                '&nomcarpeta=Documentos Para Firma Digital' .
                '&orderTipo=desc' .
                '&orderNo=3';
  $enlace_firma = 'firma/cuerpoPendientesFirma.php?' . $vars_firma;
  
  // Mostrar modulo de Aplicaciones integradas
  $mostrar_apsintegradas = ($_SESSION["usua_perm_intergapps"] == 1)? true : false;
  $vars_apsintegrada = $phpsession .
                        '&fechaf=' . $fechah .
                        '&carpeta=8' .
                        '&nomcarpeta=Aplicaciones integradas' .
                        '&orderTipo=desc' .
                        '&orderNo=3';
  $enlace_apsintegradas = 'aplintegra/cuerpoApLIntegradas.php?' . $vars_apsintegrada;
  
  // Mostrar modulo impresion
  $mostrar_impresion = ($_SESSION["usua_perm_impresion"] >= 1)? true : false;
  $usua_perm_impresion = $_SESSION["usua_perm_impresion"];
  
  $vars_impresion = $phpsession .
                    '&fechaf=' . $fechah .
                    '&usua_perm_impresion=' . $usua_perm_impresion .
                    '&carpeta=8' .
                    '&nomcarpeta=Documentos Para Impresion' .
                    '&orderTipo=desc' .
                    '&orderNo=3';
  $enlace_impresion = 'envios/cuerpoMarcaEnviar.php?' . $vars_impresion;
  
  // Mostrar modulo Comisiones
  $mostrar_comisiones = (isset($_SESSION["usua_perm_comisiones"]) && $_SESSION["usua_perm_comisiones"] >= 1)? true : false;
  $vars_comisiones = $phpsession . '&depeCodi=' . $_SESSION["dependencia"];
  $enlace_comisiones = URL_COMISIONES . $vars_comisiones;
  
  // Mostrar modulo Anulaciones 
  $mostrar_anulaciones = ($_SESSION["usua_perm_anu"]==3 or $_SESSION["usua_perm_anu"]==1)? true : false;
  $vars_anulaciones = $phpsession . '&tpAnulacion=1&fechah=' . $fechah;
  $enlace_anulaciones = 'anulacion/cuerpo_anulacion.php?' . $vars_anulaciones;
  
  // Mostrar modulo Sancionados
  $mostrar_sancionados = ($_SESSION["usua_perm_sancionad"] == 1)? true : false;
  $vars_sancionados = $phpsession . '&fechah=' . $fechah;
  $enlace_sancionados = 'sancionados/index.php?' . $vars_sancionados;
  
  // Mostrar modulo Tablas de Retencion Documental
  $mostrar_trd = ($_SESSION["usua_perm_trd"] == 1)? true : false;
  $vars_trd = $phpsession . '&fechah=' . $fechah;
  $enlace_trd = 'trd/menu_trd.php?' . $vars_trd;

  $vars_consultas = '&etapa=1&s_Listado=VerListado&fechah=' . $fechah;
  $enlace_consultas = 'busqueda/busquedaPiloto.php?' . $vars_consultas;
  
  // Mostrar modulo de Archivo
  $mostrar_archivo = ($_SESSION["usua_admin_archivo"] >= 1)? true : false;
  $enlace_archivo = 'archivo/archivo.php?' . $variables_get;
  
  if ($mostrar_archivo) {
    $isql = 'select count(*) as CONTADOR
                from SGD_EXP_EXPEDIENTE
                where	sgd_exp_estado = 0';
    $rs = $db->conn->Execute($isql);
    $num_exp = $rs->fields["CONTADOR"];

    $smarty->assign('MOSTRAR_ARCHIVO', $mostrar_archivo);
    $smarty->assign('ENLACE_ARCHIVO', $enlace_archivo);
    $smarty->assign('NUM_EXP', $num_exp);
  }
  
  // Mostrar modulo de Prestamo
  $mostrar_prestamo = ($_SESSION["usua_perm_prestamo"] == 1)? true : false;
  $vars_prestamo   = $phpsession .
                      '&etapa=1' .
                      '&s_Listado=VerListado' .
                      '&krd=' . $krd .
                      '&fechah=' . $fechah;
  $enlace_prestamo = 'prestamo/menu_prestamo.php?' . $vars_prestamo;
  
  // Mostrar modulo de Devolucion de Correo
  $mostrar_devolucion = ($_SESSION["usua_perm_dev"] == 1)? true : false;
  $vars_devolucion = $phpsession . '&krd=' . $krd .
                      '&fechaf=' . $fechah .
                      '&carpeta=8' .
                      '&devolucion=2' .
                      '&estado_sal=4' .
                      '&nomcarpeta=Documentos Para Impresion' .
                      '&orno=1' .
                      '&adodb_next_page=1';
  $enlace_devolucion = 'devolucion/cuerpoDevCorreo.php?' . $vars_devolucion;

  // consulta si el usuario tiene permiso para acceder a visitas descentralizadas anadido carlos barrero - ses
  $isql = "SELECT COUNT(*) as CONT
            FROM SES_PERMISOS
            WHERE USUA_LOGIN='" . $krd ."' AND
            PERMISO_VIS_DES = 1";
  $rs = $db->conn->query($isql);
  
  
  if ($rs) {
    $total = (isset($rs->fields['CONT']))? $rs->fields['CONT'] : null;
    $mostrar_visitas = ($total > 0) ? true : false;
    $enlace_visitas = './visitas/';
  }
  
  // Consulta si el usuario tiene permiso para acceder a control de legalidad anadido carlos barrero - ses
  $vars_ctl_legalidad = $phpsession .
                        '&krd=' . $krd .
                        '&fechah=' . $fechah .
                        '&usr=' . md5($dependencia) .
                        '&primera=1' .
                        '&ent=1';
  
  // Modulo de Entidades SES
  $mostrar_entidades = ($_SESSION["usua_perm_adment"] == 1)? true : false;
  $vars_entidades = $phpsession . '&krd=' . $krd;
  $enlace_entidades =  'Administracion/entidad/listaempresas.php?' . $vars_entidades;
  
  // Modulo Liquidacion Voluntaria
  $mostrar_liquidacion = ($_SESSION["dependencia"]==500 or $_SESSION["krd"]=="LFTRIANA")? true : false;
  $enlace_liquidacion = 'sesFrmAsocia/index.php?' . $variables_get;

  $mostrar_archivo_central = ($_SESSION["dependencia"] == 500 || $_SESSION["dependencia"] == 900)?
                                  true : false;
  $tipo_radicado = ENTRADA;
  $enlace_documental = 'archivo_central/chequear.php?' .
                        $phpsession . 
                        '&krd=' . $krd .
                        '&fechah=' . $fechah . 
                        '&primera=1' .
                        '&ent=' . $tipo_radicado .
                        '&depende=' . $dependencia;
  
  $smarty->assign('MOSTRAR_ARCHIVO_CENTRAL',  $mostrar_archivo_central);
  $smarty->assign('ENLACE_DOCUMENTAL',        $enlace_documental);
  $smarty->assign('MOSTRAR_LIQUIDACION',      $mostrar_liquidacion);
  $smarty->assign('ENLACE_LIQUIDACION',       $enlace_liquidacion);
  $smarty->assign('ENLACE_DOCUWARE',          $enlace_docuware);
  $smarty->assign('MOSTRAR_ENTIDADES',        $usua_perm_adment);
  $smarty->assign('ENLACE_ENTIDADES',         $enlace_entidades);
  $smarty->assign('MOSTRAR_CTL_LEGALIDAD',    $mostrar_ctl_legalidad);
  $smarty->assign('ES_DEBIAN',                $es_debian);
  $smarty->assign('ENLACE_CTL_LEGALIDAD',     $enlace_ctl_legalidad);
  $smarty->assign('ENLACE_CTL_OTRO',          $enlace_ctl_legalidad);
  $smarty->assign('MOSTRAR_VISITAS',          $mostrar_visitas);
  $smarty->assign('ENLACE_VISITAS',           $enlace_visitas);
  $smarty->assign('MOSTRAR_DEVOLUCION',       $mostrar_devolucion);
  $smarty->assign('ENLACE_DEVOLUCION',        $enlace_devolucion);
  $smarty->assign('MOSTRAR_PRESTAMO',         $mostrar_prestamo);
  $smarty->assign('ENLACE_PRESTAMO',          $enlace_prestamo);
  $smarty->assign('ENLACE_CONSULTAS',         $enlace_consultas);
  $smarty->assign('MOSTRAR_TRD',              $mostrar_trd);
  $smarty->assign('ENLACE_TRD',               $enlace_trd);
  $smarty->assign('MOSTRAR_SANCIONADOS',      $mostrar_sancionados);
  $smarty->assign('ENLACE_SANCIONADOS',       $enlace_sancionados);
  $smarty->assign('MOSTRAR_ANULACIONES',      $mostrar_anulaciones);
  $smarty->assign('ENLACE_ANULACIONES',       $enlace_anulaciones);
  $smarty->assign('MOSTRAR_COMISIONES',       $usua_perm_comisiones);
  $smarty->assign('ENLACE_COMISIONES',        $enlace_comisiones);
  $smarty->assign('MOSTRAR_IMPRESION',        $mostrar_impresion);
  $smarty->assign('ENLACE_IMPRESION',         $enlace_impresion);
  $smarty->assign('MOSTRAR_APSINTEGRADAS',    $mostrar_apsintegradas);
  $smarty->assign('ENLACE_APSINTEGRADAS',     $enlace_apsintegradas);
  $smarty->assign('MOSTRAR_FIRMA',            $mostrar_firma);
  $smarty->assign('ENLACE_FIRMA',             $enlace_firma);
  $smarty->assign('ENLACE_REASIGNACION',      $enlace_reasignacion);
  $smarty->assign('MOSTRAR_MODULO_COOP',      $mostrar_modulo_coop);
  $smarty->assign('ENLACE_MODULO_COOP',       $enlace_modulo_coop);
  $smarty->assign('MOSTRAR_CTL_LEGALIDAD',    $mostrar_ctl_legalidad);
  $smarty->assign('ENLACE_CONTROL_LEGALIDAD', $enlace_control_legalidad);
  $smarty->assign('MOSTRAR_ADMINISTRACION',   $mostrar_administracion);
  $smarty->assign('ENLACE_ADMIN',             $enlace_admin);
  $smarty->assign('MOSTRAR_FLUJOS',           $mostrar_flujos);
  $smarty->assign('ENLACE_ADMIN_FLUJOS',      $enlace_admin_flujos);
  $smarty->assign('MOSTRAR_ENVIOS',           $mostrar_envios);
  $smarty->assign('ENLACE_ENVIOS',            $enlace_envios);
  $smarty->assign('MOSTRAR_MODIFICACION',     $mostrar_modificacion);
  $smarty->assign('ENLACE_MODIFICACION',      $enlace_modificacion);
  
  if ($mostrar_plantilla) 
    $smarty->display('menu_modulos.tpl');
?>
