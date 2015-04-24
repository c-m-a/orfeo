<?php
  // Coloca el mensaje de Informados y cuenta cuantos registros hay en informados
  $isql = "SELECT COUNT(*) AS CONTADOR
            FROM INFORMADOS
            WHERE DEPE_CODI = $dependencia AND
                  USUA_CODI = $codusuario ";
  
  $imagen = ($carpeta == $numdata and $tipo_carp = 0)? 'folder_open.gif' : 'folder_cerrado.gif';
  $rs1     = $db->conn->query($isql);
  $numerot = $rs1->fields["CONTADOR"];
  $i++;
  $data_informados = "Documentos De Informacion";
  $id_informados  = $i;
  $enlace_cuerpo_inf = 'cuerpoinf.php?' . $phpsession .
                        '&mostrar_opc_envio=1' .
                        '&orderNo=2' .
                        '&fechaf=' . $fechah .
                        '&carpeta=8' .
                        '&nomcarpeta=Informados' .
                        '&orderTipo=desc' .
                        '&adodb_next_page=1';
  
  $smarty->assign('NUMEROT', $numerot);
  $smarty->assign('DATA_INFORMADOS', $data_informados);
  $smarty->assign('ID_INFORMADOS', $id_informados);
  $smarty->assign('ENLACE_CUERPO_INF', $enlace_cuerpo_inf);
  $i++;
?>
