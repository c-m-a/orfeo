<?php
  // Lista las bandejas y las coloca en un arreglo y las muestra utilizando el motor de plantillas
  // Esta consulta selecciona las carpetas Basicas de DocuImage que son extraidas de la tabla Carp_Codi
  $isql   = "SELECT CARP_CODI,
                    CARP_DESC
              FROM CARPETA ORDER BY CARP_CODI";
  
  $rs     = $db->conn->query($isql);
  $addadm = '';
  $bandejas = array();
  
  while (!$rs->EOF) {
    $data    = (empty($data) || $data == '') ? 'NULL' : '';
    $numdata = trim($rs->fields["CARP_CODI"]);
    
    $sqlCarpDep = "SELECT SGD_CARP_DESCR
                    FROM SGD_CARP_DESCRIPCION
                    WHERE SGD_CARP_DEPECODI = $dependencia AND
                          SGD_CARP_TIPORAD = $numdata";
    
    $rsCarpDesc         = $db->conn->query($sqlCarpDep);
    $descripcionCarpeta = (isset($rsCarpDesc->fields["SGD_CARP_DESCR"]))? $rsCarpDesc->fields["SGD_CARP_DESCR"] : null;
    
    $data = (isset($descripcionCarpeta)) ? $descripcionCarpeta : trim($rs->fields["CARP_DESC"]);
    
    // Se realiza la cuenta de radicados en Visto Bueno VoBo
    if ($numdata == 11) {
      if ($codusuario == 1) {
        $isql = "SELECT COUNT(*) AS CONTADOR
              FROM RADICADO
              WHERE CARP_PER = 0 AND
                    CARP_CODI = $numdata and
                    RADI_DEPE_ACTU = $dependencia and
                    RADI_USUA_ACTU = $codusuario";
      } else {
        $isql = "SELECT COUNT(*) AS CONTADOR
                  FROM RADICADO
                  WHERE CARP_PER = 0 AND
                        CARP_CODI = $numdata AND
                        RADI_DEPE_ACTU = $dependencia AND
                        (radi_usu_ante = '$krd' OR
                          (RADI_USUA_ACTU = $codusuario AND
                           RADI_DEPE_ACTU = $dependencia))";
      }
      
      $addadm = '&adm=1';
    } else {
      $isql   = "SELECT COUNT(*) AS CONTADOR
              from radicado
              where carp_per = 0 and
                    carp_codi = $numdata and
                    radi_depe_actu = $dependencia and
                    radi_usua_actu = $codusuario";
      $addadm = "&adm=0";
    }
    
    $imagen = ($carpeta == $numdata) ? 'folder_open.gif' : 'folder_cerrado.gif';
    $flag   = 0;
    
    $rs1     = $db->conn->query($isql);
    $numerot = $rs1->fields["CONTADOR"];
    $enlace_bandeja = $listar_radicados . '?' . $phpsession .
                        '&adodb_next_page=1' .
                        '&fechah=' . $fechah .
                        '&nomcarpeta=' . $data .
                        '&carpeta=' . $numdata .
                        '&tipo_carpt=' . 0 . 
                        '&adodb_next_page=' . 1;
    
    $nombre_bandeja = "$data($numerot)";
    
    $bandejas[$i]['enlace_bandeja'] = $enlace_bandeja;
    $bandejas[$i]['nombre_bandeja'] = "$data($numerot)";
    $bandejas[$i]['id']             = $i;
    $bandejas[$i]['data']           = $data;

    $i++;
    $rs->MoveNext();
  }
  
  $smarty->assign('BANDEJAS', $bandejas);
?>
