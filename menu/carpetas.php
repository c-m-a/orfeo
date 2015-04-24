<?php
  $i++;
  $id_carpetas  = $i;
  $data_carpetas = "Despliegue de Carpetas Personales";
  $enlace_crear_carpeta = 'crear_carpeta.php?' . $phpsession .
                          '&krd=' . $krd .
                          '&fechah=' . $fechah .
                          '&adodb_next_page=1';

  $smarty->assign('DATA_CARPETAS', $data_carpetas);
  $smarty->assign('ID_CARPETAS', $id_carpetas);
  $smarty->assign('ENLACE_CREAR_CARPETA', $enlace_crear_carpeta);
  
  // Busca las carpetas personales de cada usuario y
  // las coloca contando el numero de documentos en cada carpeta.
  $isql = "SELECT DISTINCT CODI_CARP,
                            DESC_CARP,
                            NOMB_CARP
                      FROM CARPETA_PER
                      WHERE USUA_CODI = $codusuario AND
                            DEPE_CODI = $dependencia
                      ORDER BY CODI_CARP ";
  
  $rs = $db->conn->query($isql);
  $arreglo_carpetas = array();
  
  while (!$rs->EOF) {
    $data    = trim($rs->fields["NOMB_CARP"]);
    $numdata = trim($rs->fields["CODI_CARP"]);
    $detalle = trim($rs->fields["DESC_CARP"]);
    $data    = trim($rs->fields["NOMB_CARP"]);
    
    $isql    = "SELECT COUNT(1) AS contador
                  FROM RADICADO
                  WHERE CARP_PER = 1 AND
                        CARP_CODI = $numdata AND
                        RADI_DEPE_ACTU = $dependencia AND
                        RADI_USUA_ACTU = $codusuario ";
    
    $rs1     = $db->conn->query($isql);
    $numerot = $rs1->fields["CONTADOR"];
    $datap   = "$data(Personal)";
    $enlace_carpeta = $listar_radicados . '?' . $phpsession .
                      '&fechah=' . $fechah .
                      '&tipo_carp=1' .
                      '&carpeta=' . $numdata .
                      '&nomcarpeta=' . $data .
                      ' (Personal)';
    
    $nombre_carpeta = "$data($numerot)";

    $arreglo_carpetas[$numdata]['enlace'] = $enlace_carpeta;
    $arreglo_carpetas[$numdata]['detalle'] = $detalle;
    $arreglo_carpetas[$numdata]['nombre'] = $nombre_carpeta;
    $rs->MoveNext();
  }
  $smarty->assign('ARREGLO_CARPETAS', $arreglo_carpetas);
?>
