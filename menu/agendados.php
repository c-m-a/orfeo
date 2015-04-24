<?php
  // Bandeja Agendados
  $sqlFechaHoy = $db->conn->DBTimeStamp(time());
  $sqlAgendado = " and (agen.SGD_AGEN_FECHPLAZO >= " . $sqlFechaHoy . ")";
  $isql        = "SELECT COUNT(*) AS CONTADOR
                    FROM SGD_AGEN_AGENDADOS AGEN
                    WHERE USUA_DOC='$usua_doc' AND
                          agen.SGD_AGEN_ACTIVO = 1 $sqlAgendado";
  
  $rs               = $db->conn->query($isql);
  $total_agendados  = $rs->fields["CONTADOR"];
  $data_agendados   = 'Agendados no vencidos';
  $id_agendados     = $i;
  $enlace_agendados = 'cuerpoAgenda.php?' . $phpsession .
                        '&agendado=1' .
                        '&fechah=' . $fechah .
                        '&nomcarpeta=' . $data_agendados .
                        '&tipo_carpt=0';

  $smarty->assign('ID_AGENDADOS', $id_agendados);
  $smarty->assign('ENLACE_AGENDADOS', $enlace_agendados);
  $smarty->assign('TOTAL_AGENDADOS', $total_agendados);
  $smarty->assign('DATA_AGENDADOS', $data_agendados);
  
  $sqlAgendado = " AND (AGEN.SGD_AGEN_FECHPLAZO <= " . $sqlFechaHoy . ")";
  $isql        = "SELECT COUNT(*) AS CONTADOR
                    from SGD_AGEN_AGENDADOS AGEN
                    WHERE USUA_DOC = '$usua_doc' AND
                          AGEN.SGD_AGEN_ACTIVO = 1 $sqlAgendado";
  
  $rs      = $db->conn->query($isql);
  $num_exp = $rs->fields["CONTADOR"];
  $data_agendados_vencidos  = "Agendados vencidos";
  $i++;
  $id_agendados_vencidos    = $i;
  $enlace_agendados_vencidos = 'cuerpoAgenda.php?' . $phpsession .
                                  '&agendado=2' .
                                  'fechah=' . $fechah .
                                  '&nomcarpeta=' . $data_agendados_vencidos .
                                  '&tipo_carpt=0' . 
                                  '&adodb_next_page=1';

  $smarty->assign('DATA_AGENDADOS_VENCIDOS', $data_agendados_vencidos);
  $smarty->assign('ID_AGENDADOS_VENCIDOS', $id_agendados_vencidos);
  $smarty->assign('NUM_EXP', $num_exp);
  $smarty->assign('ENLACE_AGENDADOS_VENCIDOS', $enlace_agendados_vencidos);
?>
