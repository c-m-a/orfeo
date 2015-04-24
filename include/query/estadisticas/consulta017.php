<?php
/** RADICADOS DE ENTRADA RECIBIDOSç
  * 
  * @autor JAIRO H LOSADA - SSPD
  * @version ORFEO 3.1
  * 
  */
$coltp3Esp = '"'.$tip3Nombre[3][2].'"'; 
if(!$orno) $orno=2;
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
$whereTipoRadicado  = str_replace("A.","r.",$whereTipoRadicado);
$whereTipoRadicado  = str_replace("a.","r.",$whereTipoRadicado);
switch($db->driver)
{ 
  case 'postgres':
    { if ( $dependencia_busq != 99999)
      { $condicionE = " AND h.DEPE_CODI_DEST=$dependencia_busq AND b.DEPE_CODI=$dependencia_busq "; }
      $queryE = "
          SELECT MAX(b.USUA_NOMB) AS USUARIO
          , count($radi_nume_radi) AS RADICADOS
          , MIN(b.USUA_CODI) AS HID_COD_USUARIO
          , MIN(b.depe_codi) AS HID_DEPE_USUA
        FROM RADICADO r, USUARIO b, HIST_EVENTOS h
        WHERE 
          h.HIST_DOC_DEST=b.usua_doc
          $condicionE
          AND h.RADI_NUME_RADI=r.RADI_NUME_RADI
          AND h.SGD_TTR_CODIGO=2
          AND ".$db->conn->SQLDate('Y/m/d', 'r.radi_fech_radi')." BETWEEN '$fecha_ini' AND '$fecha_fin'  
          AND cast(r.RADI_NUME_RADI as varchar) like '%2'
        $whereTipoRadicado 
        GROUP BY b.USUA_LOGIN
        ORDER BY $orno $ascdesc";
      /** CONSULTA PARA VER DETALLES 
      */
      $queryEDetalle = "SELECT 
          $radi_nume_radi AS RADICADO
          , b.USUA_NOMB AS USUARIO_ACTUAL
          , r.RA_ASUN ASUNTO 
          , ".$db->conn->SQLDate('Y/m/d H:i:s','r.radi_fech_radi')." AS FECHA_RADICACION, 
          ".$db->conn->SQLDate('Y/m/d H:i:s','h.HIST_FECH')." AS FECHA_DIGITALIZACION
          ,r.RADI_PATH AS HID_RADI_PATH{$seguridad}
        FROM RADICADO r, USUARIO b, HIST_EVENTOS h
        WHERE 
          h.HIST_DOC_DEST=b.usua_doc
          $condicionE
          AND h.RADI_NUME_RADI=r.RADI_NUME_RADI
          AND h.SGD_TTR_CODIGO=2
          AND b.USUA_CODI=$codUs
          AND b.depe_codi = $depeUs
          AND r.RADI_NUME_RADI like '%2'
          AND ".$db->conn->SQLDate('Y/m/d','r.radi_fech_radi')." BETWEEN '$fecha_ini'  AND '$fecha_fin' 
        $whereTipoRadicado 
        ORDER BY $orno $ascdesc";
    }break;
  case 'oracle':
  case 'oci8':
  case 'oci805':
  case 'ocipo':
    { if ( $dependencia_busq != 99999)
      { $condicionE = " AND h.DEPE_CODI_DEST=$dependencia_busq AND b.DEPE_CODI=$dependencia_busq "; }
      $queryE = "
          SELECT MIN(b.USUA_NOMB) USUARIO
          , count(r.RADI_NUME_RADI) RADICADOS
          , MIN(b.USUA_CODI) HID_COD_USUARIO
          , MIN(b.depe_codi) HID_DEPE_USUA
        FROM RADICADO r, USUARIO b, HIST_EVENTOS h, SGD_TPR_TPDCUMENTO t
        WHERE 
          h.HIST_DOC_DEST=b.usua_doc
          AND r.tdoc_codi=t.sgd_tpr_codigo 
          $condicionE
          AND h.RADI_NUME_RADI=r.RADI_NUME_RADI
          AND h.SGD_TTR_CODIGO in(9)
          AND TO_CHAR(r.radi_fech_radi,'yyyy/mm/dd') BETWEEN '$fecha_ini'  AND '$fecha_fin' 
        $whereTipoRadicado 
        ";
        
      if($codEsp) $queryE .= " AND r.EESP_CODI = $codEsp ";
      $queryE .= " GROUP BY b.USUA_LOGIN  ORDER BY $orno $ascdesc ";
      /** CONSULTA PARA VER DETALLES 
      */
      $queryEDetalle = "SELECT 
          r.RADI_NUME_RADI RADICADO
          , b.USUA_NOMB USUARIO_ACTUAL
          , r.RA_ASUN ASUNTO 
          , TO_CHAR(r.RADI_FECH_RADI, 'DD/MM/YYYY HH24:MM:SS') FECHA_RADICACION
          , TO_CHAR(h.HIST_FECH, 'DD/MM/YYYY HH24:MM:SS') FECHA_DIGITALIZACION
          , r.RADI_PATH HID_RADI_PATH{$seguridad}
          , an.RADI_NUME_SALIDA
          , an.ANEX_RADI_FECH 
          , an.ANEX_FECH_ENVIO
          , t.SGD_TPR_TERMINO
          , t.SGD_TPR_DESCRIP
          , ROUND(an.anex_radi_fech-r.RADI_FECH_RADI) DIAS_TRAMITE
          , ROUND(an.anex_fech_envio-r.RADI_FECH_RADI) DIAS_TRAMITE_ENVIO
          , ROUND(sysdate-r.RADI_FECH_RADI) DIAS_RAD
	  , (Select bod.nombre_de_la_empresa from BODEGA_EMPRESAS bod where bod.identificador_empresa=r.eesp_codi) Entidad
	  , (Select bod1.nit_de_la_empresa from BODEGA_EMPRESAS bod1 where bod1.identificador_empresa=r.eesp_codi) NITENTIDAD
        FROM USUARIO b, HIST_EVENTOS h, SGD_TPR_TPDCUMENTO t
          , RADICADO r left outer join anexos an 
          ON (R.RADI_NUME_RADI=an.ANEX_RADI_NUME ANd an.anex_estado>=3) 
        WHERE 
          r.tdoc_codi=t.sgd_tpr_codigo 
          AND h.HIST_DOC_DEST=b.usua_doc
          $condicionE
          AND h.RADI_NUME_RADI=r.RADI_NUME_RADI
          AND h.SGD_TTR_CODIGO in(9)

          AND TO_CHAR(r.radi_fech_radi,'yyyy/mm/dd') BETWEEN '$fecha_ini'  AND '$fecha_fin' 
        $whereTipoRadicado ";
    if($codEsp) $queryEDetalle .= " AND r.EESP_CODI = $codEsp ";
    $condicionUS = " AND b.USUA_CODI=$codUs
                     AND b.depe_codi = $depeUs "; 
    $orderE = " ORDER BY $orno $ascdesc";
    /** CONSULTA PARA VER TODOS LOS DETALLES 
    */ 
    $queryETodosDetalle = $queryEDetalle . $orderE;
    $queryEDetalle .= $condicionUS . $orderE; 
    }break;
}
if(isset($_GET['genDetalle'])&& $_GET['denDetalle']=1)
  $titulos=array("#","1#RADICADO","2#USUARIO DIGITALIZADOR","3#ASUNTO","4#FECHA RADICACION","5#FECHA DIGITALIZACION","6#RADICADO_SALIDA","7#FECHA_ANEX_SALIDA","8#FECHA ENVIO","9#TIPO DOCUMENTO","10#TERMINO","11#DIAS DE RESPUESTA","12#DIAS A ENVIO","13#DIAS DESDE RADICACION","14#ENTIDAD","15#NIT",);
else    
  $titulos=array("#","1#Usuario","2#Radicados","3#HOJAS DIGITALIZADAS");

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
    case 2:
      $datosEnvioDetalle="tipoEstadistica=".$_GET['tipoEstadistica']."&amp;genDetalle=1&amp;usua_doc=".urlencode($fila['HID_USUA_DOC'])."&amp;dependencia_busq=".$_GET['dependencia_busq']."&amp;fecha_ini=".$_GET['fecha_ini']."&amp;fecha_fin=".$_GET['fecha_fin']."&amp;tipoRadicado=".$_GET['tipoRadicado']."&amp;tipoDocumento=".$_GET['tipoDocumento']."&amp;codUs=".$fila['HID_COD_USUARIO']."&amp;depeUs=".$fila['HID_DEPE_USUA'];
      $datosEnvioDetalle=(isset($_GET['usActivos']))?$datosEnvioDetalle."&codExp=$codExp&amp;usActivos=".$_GET['usActivos']:$datosEnvioDetalle;
      $salida="<a href=\"genEstadistica.php?{$datosEnvioDetalle}&codEsp=".$_GET["codEsp"]."&amp;krd={$krd}\"  target=\"detallesSec\" >".$fila['RADICADOS']."</a>";
      break;
    case 3:
      $salida=$fila['HOJAS_DIGITALIZADAS'];
      break;
    default: $salida=false;
  }
return $salida;
}
//$db->conn->debug = true;
function pintarEstadisticaDetalle($fila,$indice,$numColumna){
      global $ruta_raiz,$encabezado,$krd;
      $verImg=($fila['SGD_SPUB_CODIGO']==1)?($fila['USUARIO']!=$_SESSION['usua_nomb']?false:true):($fila['USUA_NIVEL']>$_SESSION['nivelus']?false:true);
      $numRadicado=$fila['RADICADO']; 
      switch ($numColumna){
          case 0:
            $salida=$indice;
            break;
          case 1:
            if($fila['HID_RADI_PATH'] && $verImg)
              $salida="<center><a href=\"{$ruta_raiz}bodega".$fila['RADI_PATH']."\">".$fila['RADICADO']."</a></center>";
            else 
              $salida="<center class=\"leidos\">{$numRadicado}</center>"; 
            break;
            case 2:
              $salida="<center class=\"leidos\">".$fila['USUARIO_ACTUAL']."</center>";
              break;
            case 3:
              $salida="<center class=\"leidos\">".$fila['ASUNTO']."</center>";
              break;
            case 4:
            if($verImg)
                $salida="<a class=\"vinculos\" href=\"{$ruta_raiz}verradicado.php?verrad=".$fila['RADICADO']."&amp;".session_name()."=".session_id()."&amp;krd=".$_GET['krd']."&amp;carpeta=8&amp;nomcarpeta=Busquedas&amp;tipo_carp=0 \" >".$fila['FECHA_RADICACION']."</a>";
              else 
              $salida="<a class=\"vinculos\" href=\"#\" onclick=\"alert(\"ud no tiene permisos para ver el radicado\");\">".$fila['FECHA_RADICACION']."</a>";
            break;
          case 5:
            $salida="<center class=\"leidos\">".$fila['FECHA_DIGITALIZACION']."</center>";    
            break;
          case 6:
            $salida="<center class=\"leidos\">".$fila['RADI_NUME_SALIDA']."</center>";    
            break;
          case 7:
            $salida="<center class=\"leidos\">".$fila['ANEX_RADI_FECH']."</center>";    
            break;
          case 8:
            $salida="<center class=\"leidos\">".$fila['ANEX_FECH_ENVIO']."</center>";    
            break;
          case 9:
            $salida="<center class=\"leidos\">".$fila['SGD_TPR_DESCRIP']."</center>";    
            break;
          case 10:
            $salida="<center class=\"leidos\">".$fila['SGD_TPR_TERMINO']."</center>";
            break;
          case 11:
            $salida="<center class=\"leidos\">".$fila['DIAS_TRAMITE']."</center>";    
            break;
          case 12:
            $salida="<center class=\"leidos\">".$fila['DIAS_TRAMITE_ENVIO']."</center>";    
            break;
          case 13:
            $salida="<center class=\"leidos\">".$fila['DIAS_RAD']."</center>";    
            break;
          case 14:
            $salida="<center class=\"leidos\">".$fila['ENTIDAD']."</center>";    
            break;
          case 15:
            $salida="<center class=\"leidos\">".$fila['NITENTIDAD']."</center>";    
            break;
      }
      return $salida;
    }
//echo $queryEDetalle;
?>
