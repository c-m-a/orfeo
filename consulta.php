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
  include(SMARTY_TEMPLATE);
  include_once ('./include/db/ConnectionHandler.php');
  require_once ('./class_control/Mensaje.php');
  
  session_start();
  
  $smarty = new Smarty();
  $smarty->template_dir = TEMPLATE_DIR;
  $smarty->compile_dir  = COMPILE_DIR;
  $smarty->cache_dir    = CACHE_DIR;
  
  $smarty_render = ACTIVAR_RENDER;
  
  $db = new ConnectionHandler('.');
  $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
  //$db->conn->debug = true;
  
  $sql = "SELECT RA.RADI_NUME_RADI,
                  HE.HIST_FECH,
                  RADI_FECH_RADI
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
  
  //$sqlFecha = $db->conn->SQLDate("dmy H:i A","a.HIST_FECH");
  $sqlFecha = $db->conn->SQLDate("d/m/y H:i:s","a.HIST_FECH");
  
  while (!$rs->EOF) {
    $radi_actual = $rs->fields['RADI_NUME_RADI'];
    $radi_fecha_actual = $rs->fields['HIST_FECH'];
	  
    $isql = "select $sqlFecha AS HIST_FECH1,
                  a.*
              from hist_eventos a
              where a.radi_nume_radi = $radi_actual
              order by hist_fech desc";  
    
    $c = 0;
    $total_dias = 0;
    
    $registros = array();
    
    if ($radi_actual != $radi_anterior) {
      $rs_hist = $db->conn->Execute($isql);
      
      while(!$rs_hist->EOF) {
        $fecha_arreglo = explode(' ', $rs_hist->fields['HIST_FECH1']);
        $fecha_actual = $fecha_arreglo[0];
        
        $fecha = DateTime::createFromFormat('d/m/Y', $fecha_actual);
        $fecha_actual = $fecha->getTimestamp();
        
        $numero_dias = ($fecha_anterior - $fecha_actual) / 86400;
        
        if (empty($fecha_anterior))
          $numero_dias = 0;
        
        $registros[$c]['RADI_NUME_RADI']  = $rs_hist->fields['RADI_NUME_RADI'];
        $registros[$c]['HIST_FECH']       = $rs_hist->fields['HIST_FECH1'];
        
        if ($c == 0) {
          $registros[$c]['numero_dias']     = $numero_dias;    
        } else {
          $registros[$c-1]['numero_dias']   = $numero_dias;
        }
        
        $total_dias += $numero_dias;
        $fecha_anterior = $fecha_actual;
        $rs_hist->MoveNext();
        $c++;
      }
      
      foreach ($registros as $radicado) {
        $update_radicados = 'UPDATE HIST_EVENTOS SET HIST_NUMERO_DIAS = ';
        
        $dias = (empty($radicado['numero_dias']))? 0 : $radicado['numero_dias'];
        
        $update_radicados .= $dias . ' WHERE RADI_NUME_RADI = ' . $radicado['RADI_NUME_RADI'] . ' AND ' .
                              "HIST_FECH = TO_DATE('" . $radicado['HIST_FECH'] . "','dd/mm/yyyy HH24:MI:SS');";
        
        echo '<br>' . $update_radicados;
        $usuario_anterior = $radicado['HIST_DOC_DEST'];
        //$rs_update = $db->conn->Execute($update_radicados);
      }
      
      unset($registros);
      $radi_anterior = $radi_actual;
      $i++;
    }
    
    $radi_fecha_ante = $radi_fecha_actual;
    $rs->MoveNext();
  }

  $smarty->assign('RADICADOS', $radicados);
  $smarty->display('consulta.tpl');
?>
