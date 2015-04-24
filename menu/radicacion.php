<?php
  $opciones_menu = array();
  
  $i = (isset($i))? $i : null;
  $i++;
	
  foreach ($_SESSION["tpNumRad"] as $key => $valueTp) {
    $valueImg   = '';
    $valueDesc  = $tpDescRad[$key];
    
    $valueImg   = (isset($tpImgRad[$key]))? $tpImgRad[$key] : null;
    
    $encabezado = $phpsession .
                  '&krd=' . $krd .
                  '&fechah=' . $fechah .
                  '&primera=1' .
                  '&ent=' . $valueTp .
                  '&depende='. $dependencia;
    

    if($tpPerRad[$valueTp]==1 or $tpPerRad[$valueTp]==3) {
      $enlace_chequear = 'radicacion/chequear.php?' . $encabezado;
      $opciones_menu[$i]['valor_menu']  = $i;
      $opciones_menu[$i]['enlace']      = $enlace_chequear;
      $opciones_menu[$i]['descripcion'] = $valueDesc;
		}
		$i++;
	}

  // Realiza Link a pagina de combiancion de correspondencia masiva
  $mostrar_menu_masiva = ($_SESSION["usua_masiva"] == 1)? true : false;
  $enlace_menu_masiva = 'radsalida/masiva/menu_masiva.php?' . $phpsession .
                        '&krd=' . $krd .
                        'fechah=' . $fechah;
  $numero_menu_masiva = $i;
  $i++;

  $mostrar_menu_fax = ($_SESSION["dependencia"]==500 || $_SESSION["dependencia"]==440)? true : false;
  $enlace_menu_fax = 'fax/index.php?' . $phpsession .
                '&krd=' . $krd .
                'fechah=' . $fechah . 
                '&usr=' . md5($dependencia) .
                '&primera=1' .
                '&ent=2' .
                '&depende=' . $dependencia;
  $numero_menu_fax = $i;
  $i++;

  $mostrar_asociar_imagen = ($_SESSION["perm_radi"] >= 1)? true : false;
  $enlace_asociar_imagen = './asociar_imagen/uploadFileRadicado.php?' . $phpsession .
                            '&krd=' . $krd . 
                            'fechah=' . $fechah . 
                            '&usr=' . md5($dependencia) .
                            '&primera=1' .
                            '&ent=2' .
                            '&depende=' . $dependencia;
  $numero_menu_asociar_imagen = $i;
	$i++;
	
  $mostrar_radicacion_mail = ($_SESSION["usuaPermRadEmail"] == 1)? true : false;
  $enlace_email = 'email/index.php?' . $phpsession .
                        '&krd=' . $krd . 
                        'fechah=' . $fechah . 
                        '&usr=' . md5($dependencia) .
                        '&primera=1' .
                        '&ent=2' .
                        '&depende=' . $dependencia;
  $numero_menu_email = $i;

  $smarty->assign('OPCIONES_MENU', $opciones_menu);
  $smarty->assign('MOSTRAR_MENU_MASIVA', $mostrar_menu_masiva);
  $smarty->assign('ENLACE_MENU_MASIVA', $enlace_menu_masiva);
  $smarty->assign('NUMERO_MENU_MASIVA', $numero_menu_masiva);
  $smarty->assign('MOSTRAR_ASOCIAR_IMAGEN', $mostrar_asociar_imagen);
  $smarty->assign('ENLACE_ASOCIAR_IMAGEN', $enlace_asociar_imagen);
  $smarty->assign('NUMERO_MENU_ASOCIAR_IMAGEN', $numero_menu_asociar_imagen);
  $smarty->assign('MOSTRAR_MENU_FAX', $mostrar_menu_fax);
  $smarty->assign('ENLACE_MENU_FAX', $enlace_menu_fax);
  $smarty->assign('NUMERO_MENU_FAX', $numero_menu_fax);
  $smarty->assign('MOSTRAR_RADICACION_MAIL', $mostrar_radicacion_mail);
  $smarty->assign('ENLACE_EMAIL', $enlace_email);
  $smarty->assign('NUMERO_MENU_EMAIL', $numero_menu_email);
  
  if ($mostrar_plantilla) 
    $smarty->display('menu_radicacion.tpl');
?>
