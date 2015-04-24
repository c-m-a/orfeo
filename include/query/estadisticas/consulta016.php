<?php
/** CONSUTLA 001 
  * Estadiscas por medio de recepcion Entrada
  * @autor JAIRO H LOSADA - SSPD
  * @version ORFEO 3.1
  * 
  */
$coltp3Esp = '"'.$tip3Nombre[3][2].'"';
if(!$orno) $orno=2;
$tmp_substr = $db->conn->substr;
 /**
   * $db-driver Variable que trae el driver seleccionado en la conexion
   * @var string
   * @access public
   */
 /**
   * $fecha_ini Variable que trae la fecha de Inicio Seleccionada  viene en formato Y-m-d
   * @var string
   * @access public
   */
/**
   * $fecha_fin Variable que trae la fecha de Fin Seleccionada
   * @var string
   * @access public
   */
/**
   * $mrecCodi Variable que trae el medio de recepcion por el cual va a sacar el detalle de la Consulta.
   * @var string
   * @access public
   */
switch($db->driver)
{
  case 'mssql':
  case 'postgresql':  
  case 'postgres':  
  { if($tipoDocumento=='9999')
    { $queryE = "SELECT b.USUA_NOMB as USUARIO, count(*) as RADICADOS, MIN(USUA_CODI) as HID_COD_USUARIO, MIN(depe_codi) as HID_DEPE_USUA 
          FROM RADICADO r 
            INNER JOIN USUARIO b ON r.radi_usua_radi=b.usua_CODI AND $tmp_substr($radi_nume_radi,5,3)=cast(b.depe_codi as varchar) 
          WHERE ".$db->conn->SQLDate('Y/m/d', 'r.radi_fech_radi')." BETWEEN '$fecha_ini' AND '$fecha_fin' 
            $whereDependencia $whereActivos $whereTipoRadicado 
          GROUP BY b.USUA_NOMB ORDER BY $orno $ascdesc";
    }
    else
    { $queryE = "SELECT b.USUA_NOMB as USUARIO, t.SGD_TPR_DESCRIP as TIPO_DOCUMENTO, count(*) as RADICADOS,
            MIN(USUA_CODI) as HID_COD_USUARIO, MIN(SGD_TPR_CODIGO) as HID_TPR_CODIGO, MIN(depe_codi) as HID_DEPE_USUA
          FROM RADICADO r 
            INNER JOIN USUARIO b ON r.RADI_USUA_RADI = b.USUA_CODI AND $tmp_substr($radi_nume_radi, 5, 3) = cast(b.DEPE_CODI as varchar) 
            LEFT OUTER JOIN SGD_TPR_TPDCUMENTO t ON r.TDOC_CODI = t.SGD_TPR_CODIGO
          WHERE ".$db->conn->SQLDate('Y/m/d', 'r.radi_fech_radi')." BETWEEN '$fecha_ini' AND '$fecha_fin' 
            $whereDependencia $whereActivos $whereTipoRadicado 
          GROUP BY b.USUA_NOMB,t.SGD_TPR_DESCRIP ORDER BY $orno $ascdesc";    
    }
    /** CONSULTA PARA VER DETALLES 
    */
    //$condicionDep = " AND depe_codi = $depeUs ";
    $condicionDep = ($dependencia_busq==99999) ? " AND depe_codi is not null " : "AND depe_codi = $dependencia_busq ";
    //$condicionDep = " AND depe_codi = $dependencia_busq ";
    $condicionE = " AND b.USUA_CODI=$codUs $condicionDep ";
    $queryEDetalle = "SELECT $radi_nume_radi as RADICADO
          ,r.RADI_FECH_RADI as FECHA_RADICADO
          ,t.SGD_TPR_DESCRIP as TIPO_DE_DOCUMENTO
          ,r.RA_ASUN as ASUNTO 
          ,r.RADI_DESC_ANEX 
          ,r.RADI_NUME_HOJA 
          ,r.sgd_id_nguia as GUIA
          ,b.usua_nomb as Usuario
          ,r.RADI_PATH as HID_RADI_PATH {$seguridad}
          , dir.SGD_DIR_NOMREMDES as REMITENTE
        FROM RADICADO r
          INNER JOIN USUARIO b ON r.radi_usua_radi=b.usua_CODI AND $tmp_substr($radi_nume_radi,5,3)=cast(b.depe_codi as varchar) 
          LEFT OUTER JOIN SGD_TPR_TPDCUMENTO t ON r.tdoc_codi=t.SGD_TPR_CODIGO 
          LEFT OUTER JOIN SGD_DIR_DRECCIONES dir ON r.radi_nume_radi = dir.radi_nume_radi 
        WHERE ".$db->conn->SQLDate('Y/m/d', 'r.radi_fech_radi')." BETWEEN '$fecha_ini' AND '$fecha_fin' 
          AND  $whereTipoRadicado ";
          $orderE = " ORDER BY $orno $ascdesc";
       /** CONSULTA PARA VER TODOS LOS DETALLES 
       */ 
    
      $queryETodosDetalle = $queryEDetalle . $condicionDep . $orderE;
      $queryEDetalle .= $condicionE . $orderE;
  }break;
  case 'oracle':
  case 'oci8':
  case 'oci805':
  case 'ocipo':
  {
    if($tema=='9999')
    {
      $queryE = 
      "SELECT b.USUA_NOMB USUARIO,
        Dcau.SGD_DCAU_DESCRIP DCAUSAL,
        count(*) RADICADOS,
        MIN(USUA_CODI) HID_COD_USUARIO,
        MIN(depe_codi) HID_DEPE_USUA,
        MIN(b.USUA_DOC) HID_USUA_DOC
      FROM RADICADO r, USUARIO b, SGD_DCAU_CAUSAL dcau, SGD_CAUX_CAUSALES caux
      WHERE 
        b.USUA_DOC=caux.USUA_DOC 
        AND caux.radi_nume_radi=r.radi_nume_radi
        AND dcau.sgd_dcau_codigo=caux.sgd_dcau_codigo
        $whereDependencia
        AND TO_CHAR(r.radi_fech_radi,'yyyy/mm/dd') BETWEEN '$fecha_ini'  AND '$fecha_fin' 
        $whereActivos
      $whereTipoRadicado 
      GROUP BY b.USUA_NOMB
      ORDER BY $orno $ascdesc";
    }
    else
    {
      $queryE = "
        SELECT b.USUA_NOMB USUARIO
        , Dcau.SGD_DCAU_DESCRIP DCAUSAL
        , count(*) RADICADOS
        , MIN(USUA_CODI) HID_COD_USUARIO
        , MIN(dcau.SGD_DCAU_CODIGO) HID_DCAU_CODIGO
        , MIN(depe_codi) HID_DEPE_USUA
        , MIN(b.USUA_DOC) HID_USUA_DOC
      FROM RADICADO r, USUARIO b, SGD_DCAU_CAUSAL dcau, SGD_CAUX_CAUSALES caux
      WHERE 
        b.USUA_DOC=caux.USUA_DOC
        AND caux.radi_nume_radi=r.radi_nume_radi
        AND dcau.sgd_dcau_codigo=caux.sgd_dcau_codigo
        $whereDependencia 
        AND TO_CHAR(r.radi_fech_radi,'yyyy/mm/dd') BETWEEN '$fecha_ini'  AND '$fecha_fin' 
        $whereActivos
      $whereTipoRadicado 
      GROUP BY  b.USUA_NOMB, Dcau.SGD_DCAU_DESCRIP
      ORDER BY $orno $ascdesc";
    }
    /** CONSULTA PARA VER DETALLES 
    */
    if($dependencia_busq!=99999) $condicionDep = " AND depe_codi = $dependencia_busq";
    //$condicionE = " AND b.USUA_CODI=$codUs $condicionDep ";
    if($dUsuaDoc) $condicionE = " AND b.USUA_DOC=$dUsuaDoc ";
    if($dcauCodi) $condicionE .= " and dcau.sgd_dcau_codi=$dDecauCodi";
    $queryEDetalle = "SELECT DISTINCT r.RADI_NUME_RADI RADICADO
      ,r.RADI_FECH_RADI FECHA_RADICADO
      ,Dcau.SGD_DCAU_DESCRIP DCAU_DESCRIP
      ,Dcau.SGD_DCAU_CODIGO HID_DCAU_CODI
      ,r.RA_ASUN ASUNTO
      ,r.RADI_DESC_ANEX ANEXOS
      ,r.RADI_NUME_HOJA N_HOJAS
      ,b.usua_nomb USUARIO
      ,r.RADI_PATH HID_RADI_PATH
      ,b.USUA_DOC HID_USUA_DOC
      FROM RADICADO r, 
        USUARIO b, SGD_DCAU_CAUSAL dcau, SGD_CAUX_CAUSALES caux
    WHERE 
      caux.radi_nume_radi=r.radi_nume_radi
      AND b.USUA_DOC=caux.USUA_DOC
      AND dcau.sgd_dcau_codigo=caux.sgd_dcau_codigo
      AND TO_CHAR(r.radi_fech_radi,'yyyy/mm/dd') BETWEEN '$fecha_ini' AND '$fecha_fin'
    $whereTipoRadicado ";
    $orderE = " ORDER BY $orno $ascdesc";     

    /** CONSULTA PARA VER TODOS LOS DETALLES 
    */ 
    $queryETodosDetalle = $queryEDetalle . $condicionDep . $orderE;
    $queryEDetalle .= $condicionE . $orderE;
  }break;
}

if(isset($_GET['genDetalle'])==1)
  $titulos=array("#","1#RADICADO","2#FECHA RADICADO","3#CAUSAL","4#ASUNTO","5#NO HOJAS","6#USUARIO","7#REMITENTE");
else    
  $titulos=array("#","1#Usuario","2#DCAUSAL","3#Radicados");
    
function pintarEstadistica($fila,$indice,$numColumna)
{
  global $ruta_raiz,$_POST,$_GET,$krd;
  $salida="";
  switch ($numColumna)
  {
  case  0:
    $salida=$indice;
    break;
  case 1: 
    $salida=$fila['USUARIO'];
    break;
  case 3:
  $datosEnvioDetalle="tipoEstadistica=".$_GET['tipoEstadistica']."&amp;genDetalle=1&amp;dUsuaDoc=".urlencode($fila['HID_USUA_DOC'])."&amp;dependencia_busq=".$_GET['dependencia_busq']."&amp;fecha_ini=".$_GET['fecha_ini']."&amp;fecha_fin=".$_GET['fecha_fin']."&amp;tipoRadicado=".$_GET['tipoRadicado']."&amp;tipoDocumento=".$_GET['tipoDocumento']."&amp;dCauCodi=".$fila['HID_DCAU_CODIGO']."&amp;codUs=".$fila['HID_COD_USUARIO'];
  $datosEnvioDetalle=(isset($_GET['usActivos']))?$datosEnvioDetalle."&amp;usActivos=".$_GET['usActivos']:$datosEnvioDetalle;
  $salida="<a href=\"genEstadistica.php?{$datosEnvioDetalle}&amp;krd={$krd}\"  target=\"detallesSec\" >".$fila['RADICADOS']."</a>";
  break;
  case 2:
  $salida="".$fila['DCAUSAL']."";
  break;
  default: $salida=false;
  break;
}
  return $salida;
}

function pintarEstadisticaDetalle($fila,$indice,$numColumna)
{
  global $ruta_raiz,$encabezado,$krd;
  $verImg=($fila['SGD_SPUB_CODIGO']==1)?($fila['USUARIO']!=$_SESSION['usua_nomb']?false:true):($fila['USUA_NIVEL']>$_SESSION['nivelus']?false:true);
    $numRadicado=$fila['RADICADO']; 
  switch ($numColumna)
  {
  case 0:
    $salida=$indice;
    break;
  case 1:
    if($fila['HID_RADI_PATH'] && $verImg)
      $salida="<center><a href=\"{$ruta_raiz}bodega".$fila['HID_RADI_PATH']."\">".$fila['RADICADO']."</a></center>";
    else 
      $salida="<center class=\"leidos\">{$numRadicado}</center>"; 
    break;
  case 2:
    if($verImg)
      $salida="<a class=\"vinculos\" href=\"{$ruta_raiz}verradicado.php?verrad=".$fila['RADICADO']."&amp;".session_name()."=".session_id()."&amp;krd=".$_GET['krd']."&amp;carpeta=8&amp;nomcarpeta=Busquedas&amp;tipo_carp=0 \" >".$fila['FECHA_RADICADO']."</a>";
    else 
      $salida="<a class=\"vinculos\" href=\"#\" onclick=\"alert(\"ud no tiene permisos para ver el radicado\");\">".$fila['FECHA_RADICADO']."</a>";
    break;
  case 3:
    $salida="<center class=\"leidos\">".$fila['DCAU_DESCRIP']."</center>";   
    break;
  case 4:
    $salida="<center class=\"leidos\">".$fila['ASUNTO']."</center>";
    break;
  case 5:
    $salida="<center class=\"leidos\">".$fila['N_HOJAS']."</center>";     
    break;  
  case 6:
    $salida="<center class=\"leidos\">".$fila['USUARIO']."</center>";     
    break;  
  case 7:
    $salida="<center class=\"leidos\">".$fila['REMITENTE']."</center>";     
    break;  
  }
  return $salida;
}
?>
