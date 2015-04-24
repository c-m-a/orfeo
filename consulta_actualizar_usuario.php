<?php
  // Modificado SGD 20-Septiembre-2007
  /**
   * Pagina Cuerpo.php que muestra el contenido de las Carpetas
   * Creado en la SSPD en el año 2003
   * 
   * Se añadio compatibilidad con variables globales en Off
   * @autor Jairo Losada 2009-05
   * @licencia GNU/GPL V 3
   */
  
  include('./config.php');
  include_once ('./include/db/ConnectionHandler.php');
  require_once ('./class_control/Mensaje.php');

  $radicados_actualizados = array();
  
  session_start();
  
  $db = new ConnectionHandler('.');
  $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
  //$db->conn->debug = true;
  
  $sql = "SELECT RA.RADI_NUME_RADI,
                  HE.HIST_FECH
          FROM RADICADO RA
          INNER JOIN HIST_EVENTOS HE ON RA.RADI_NUME_RADI = HE.RADI_NUME_RADI
          WHERE HE.USUA_DOC='52731958'
          ORDER BY HE.RADI_NUME_RADI,
                    HE.HIST_FECH";

  $rs = $db->conn->Execute($sql);
  $d = 1;
  
  $radicados  = array();
  $promedio   = 0;
  $total_dias = 0;
  $radi_anterior = 0;
  $i = 0;
  
  $sqlFecha = $db->conn->SQLDate("d/m/y H:i:s","a.HIST_FECH");
  
  while (!$rs->EOF) {
    $radi_actual = $rs->fields['RADI_NUME_RADI'];
    $radi_fecha_actual = $rs->fields['HIST_FECH'];
	  
    $isql = "select $sqlFecha AS HIST_FECH1,
                  a.*
              from hist_eventos a
              where a.radi_nume_radi = $radi_actual
              order by hist_fech asc";
    
    $c = 0;
    
    $registros = array();
    
    $rs_hist = $db->conn->Execute($isql);
    
    while(!$rs_hist->EOF) {
      $fecha_arreglo = explode(' ', $rs_hist->fields['HIST_FECH1']);
      $fecha_actual = $fecha_arreglo[0];
      
      $fecha = DateTime::createFromFormat('d/m/Y', $fecha_actual);
      $fecha_actual = $fecha->getTimestamp();
      
      $registros[$c]['RADI_NUME_RADI']  = $rs_hist->fields['RADI_NUME_RADI'];
      $registros[$c]['USUA_DOC']        = $rs_hist->fields['USUA_DOC'];
      $registros[$c]['HIST_FECH']       = $rs_hist->fields['HIST_FECH1'];
      
      $rs_hist->MoveNext();
      $c++;
    }

    $esta_en_arreglo  = in_array($radi_actual, $radicados_actualizados);
    
    if (!$esta_en_arreglo) {
      foreach ($registros as $radicado) {
        $update_radicados = 'UPDATE HIST_EVENTOS SET ';
        
        $actualizar_usuario = 'USUA_DOC_OLD = null';
        
        if (isset($usuario_anterior)) {
          $actualizar_usuario = 'USUA_DOC_OLD = ' . $usuario_anterior . ' ';
        }
        
        $update_radicados .= $actualizar_usuario . ' WHERE RADI_NUME_RADI = ' . $radicado['RADI_NUME_RADI'] . ' AND ' .
                              "HIST_FECH = TO_DATE('" . $radicado['HIST_FECH'] . "','dd/mm/yyyy HH24:MI:SS');";
        
        $usuario_anterior = $radicado['USUA_DOC'];
        
        echo '<br>' . $update_radicados;
        //$rs_update = $db->conn->Execute($update_radicados);
      }
    }
    
    unset($registros);
    unset($usuario_anterior);
    $i++;
    
    //echo '<br>actualizado ' . $radi_actual . "\n";
    $esta_en_arreglo  = in_array($radi_actual, $radicados_actualizados);
    
    if (!$esta_en_arreglo)
      $radicados_actualizados[] = $radi_actual;
    
    $rs->MoveNext();
  }
?>
