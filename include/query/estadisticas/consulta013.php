<?php
/** CONSULTA 011
	* Estadiscas de Numero de Radicados digitalizados y Hojas Digitalizadas.
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
if($_REQUEST['dependencia_busq']=='99999'){
	$agrupamiento="D.DEPE_CODI,D.DEPE_NOMB";                 
	$busqueda="DEPENDENCIA D INNER JOIN SGD_SEXP_SECEXPEDIENTES SE ON D.DEPE_CODI=SE.DEPE_CODI";
	$depend="";
}else{  
	$agrupamiento = "B.USUA_NOMB,SE.DEPE_CODI,B.USUA_DOC"; 
	$busqueda="USUARIO B INNER JOIN SGD_SEXP_SECEXPEDIENTES SE ON B.USUA_DOC=SE.USUA_DOC";
	$depend="DEPE_CODI=".$_REQUEST['dependencia_busq'];
	$subconsEs="";
	$subconsEs="WHERE SE.".$depend;
}

	$subcons=($depend!=null)?" WHERE ".$depend:""; 
	$usuario=isset($_GET['usua_doc'])&& $_GET['usua_doc']!=""?$subcons!=""?" AND SE.USUA_DOC='".$_GET['usua_doc']."' ":"WHERE SE.USUA_DOC='".$_GET['usua_doc']."'":"";
switch($db->driver)
{
	case 'mssql':
	$isql = '';	
	break;
	case 'oracle':
	case 'oci8':
	case 'oci805':
	case 'ocipo':
	$whereDependencia = ($dependencia_busq != 99999) ?
						 "WHERE substr(SE.SGD_EXP_NUMERO,5,3) = '" . $dependencia_busq . "'": "";
	$distinct = ($dependencia_busq != 99999) ? "DISTINCT" : "";
	$queryE = "SELECT $distinct  d.DEPE_NOMB NOMBRE_DEPENDENCIA, e.NUMERO_RADICADOS FROM 
				DEPENDENCIA D INNER JOIN 
				(SELECT SE.SGD_EXP_NUMERO,substr(SE.SGD_EXP_NUMERO, 5, 3) DEPE_CODI_CREACION, COUNT(*) NUMERO_RADICADOS
			 FROM SGD_SEXP_SECEXPEDIENTES SE INNER JOIN SGD_EXP_EXPEDIENTE EX on EX.SGD_EXP_NUMERO=SE.SGD_EXP_NUMERO
			 $whereDependencia
			 group by SE.SGD_EXP_NUMERO) E  ON D.DEPE_CODI=E.DEPE_CODI_CREACION 
			 INNER JOIN SGD_SEXP_SECEXPEDIENTES EP ON E.SGD_EXP_NUMERO=Ep.SGD_EXP_NUMERO
			";
	/** CONSULTA PARA VER DETALLES 
	 */
 	$whereDependencia = ($dependencia_busq != 99999) ?
						 "AND substr(a.SGD_EXP_NUMERO,5,3) = '" . $dependencia_busq . "'": "";
 	$andExp = (isset($HTTP_GET_VARS["expediente"])) ? "AND a.SGD_EXP_NUMERO = '$expediente'" : '';
	$queryEDetalle = "SELECT a.SGD_EXP_NUMERO EXPEDIENTE,
							a.RADI_NUME_RADI RADICADO,
							a.SGD_EXP_FECH FECHA_CREACION,
							b.USUA_NOMB USUARIO_CREADOR,
							c.DEPE_NOMB DEPENDENCIA,
							a.SGD_EXP_ESTADO ESTADO, 
							a.SGD_EXP_FECH_ARCH FECHA_ARCHIVO
						FROM SGD_EXP_EXPEDIENTE a, USUARIO b, DEPENDENCIA c
						WHERE a.USUA_DOC = b.USUA_DOC(+)
							AND a.DEPE_CODI = c.DEPE_CODI(+)
							$andExp
							$whereDependencia
						ORDER BY SGD_EXP_NUMERO, SGD_EXP_FECH";
	$queryETodosDetalle = $queryEDetalle;
	break;
}
  
$queryE="SELECT $agrupamiento,COUNT(*) EXPEDIENTES
                         FROM $busqueda $subconsEs
                        GROUP BY $agrupamiento";
      $queryEDetalle="SELECT SE.SGD_EXP_NUMERO,MINEXP.RADI_NUME_RADI,MINEXP.SGD_EXP_ESTADO,SE.SGD_SEXP_FECH,
       SE.SGD_EXP_FECH_ARCH, B.USUA_NOMB,EX.NUME_RADICADOS,SE.SGD_EXP_PRIVADO,R.RADI_FECH_RADI,R.RADI_PATH{$seguridad} 
       FROM SGD_SEXP_SECEXPEDIENTES SE INNER JOIN ( SELECT SGD_EXP_NUMERO, RADI_NUME_RADI, 
       SGD_EXP_ESTADO,MIN(SGD_EXP_FECH) FROM  SGD_EXP_EXPEDIENTE {$subcons} GROUP BY SGD_EXP_NUMERO,
       SGD_EXP_ESTADO ,RADI_NUME_RADI) MINEXP ON SE.SGD_EXP_NUMERO=MINEXP.SGD_EXP_NUMERO 
       INNER JOIN RADICADO R ON R.RADI_NUME_RADI=MINEXP.RADI_NUME_RADI 
        JOIN USUARIO B ON B.USUA_DOC=SE.USUA_DOC 
        INNER JOIN ( SELECT SGD_EXP_NUMERO,COUNT(*) NUME_RADICADOS FROM SGD_EXP_EXPEDIENTE {$subcons} 
        GROUP BY SGD_EXP_NUMERO ) EX ON EX.SGD_EXP_NUMERO=SE.SGD_EXP_NUMERO
                            {$subcons}
                            {$usuario}
                               ";


if(isset($_GET['genDetalle'])&& $_GET['genDetalle']==1)
{ 
	$titulos=array("#","1#EXPEDIENTE","2#PRIMER RADICADO","9#FECHA RADICACION ","4#FECHA EXPEDIENTE","5#FECHA DE ARCHIVADO","6#RESPONSABLE","3#ESTADO");
}
else
{
	$titulos=$agrupamiento=="B.DEPE_CODI"?array("#","2#DEPENDENCIA","2#NUMERO DE EXPEDIENTES"):array("#","1#USUARIO","2#NUMERO DE EXPEDIENTES");
} 

function pintarEstadistica($fila,$indice,$numColumna)
{
	global $ruta_raiz,$_POST,$_GET;
	$numColumna=isset($fila['DEPE_NOMB'])&&($numColumna==1)?3:$numColumna;
	$salida="";
	switch ($numColumna)
	{	case  0:
			$salida=$indice;
			break;
		case 1:
			$salida=$fila['USUA_NOMB'];
			break;
		case 2:
			$genDetalle=(isset($fila['USUA_NOMB']))?1:0;
			$dependecia=isset($fila['DEPE_CODI'])?$fila['DEPE_CODI']:$_POST['dependencia_busq'];
			$datosEnvioDetalle="tipoEstadistica=".$_REQUEST['tipoEstadistica']."&amp;genDetalle={$genDetalle}&amp;usua_doc=".urlencode($fila['USUA_DOC'])."&amp;dependencia_busq=".$dependecia."&amp;fecha_ini=".$_POST['fecha_ini']."&amp;fecha_fin=".$_POST['fecha_fin']."&amp;tipoRadicado=".$_POST['tipoRadicado']."&amp;tipoDocumento=".$_POST['tipoDocumento']."&amp;codUs=".$fila['HID_COD_USUARIO']."&amp;depeUs=".$fila['HID_DEPE_USUA'];
			$datosEnvioDetalle=(isset($_POST['usActivos']))?$datosEnvioDetalle."&amp;usActivos=".$_POST['usActivos']:$datosEnvioDetalle;
			$salida="<a href=\"genEstadistica.php?{$datosEnvioDetalle}&amp;krd={$krd}\" target=\"detallesSec\" >".$fila['EXPEDIENTES']."</a>";
			break;
		case 3:
			$salida=$fila['DEPE_NOMB'];
			break;
		default: $salida=false;
	}
	return $salida;
}

function pintarEstadisticaDetalle($fila,$indice,$numColumna)
{
	global $ruta_raiz,$encabezado,$krd;
	$verImg=($fila['SGD_SPUB_CODIGO']==1)?($fila['USUARIO']!=$_SESSION['usua_nomb']?false:true):($fila['USUA_NIVEL']>$_SESSION['nivelus']?false:true);
	$verImg=$verImg&&($fila['SGD_EXP_PRIVADO']!=1);
	$numRadicado=$fila['RADI_NUME_RADI'];
	switch ($numColumna)
	{
		case 0:
			$salida=$indice;
			break;
		case 1:
			$salida=$salida="<center class=\"leidos\">".$fila['SGD_EXP_NUMERO']."</center>";
			break;
		case 2:                                                
			if($fila['RADI_PATH'] && $verImg)
				$salida="<center><a href=\"{$ruta_raiz}bodega".$fila['RADI_PATH']."\">".$fila['RADI_NUME_RADI']."</a></center>";
			else
				$salida="<center class=\"leidos\">{$numRadicado}</center>";
			break;
		case 4:
			$salida="<center class=\"leidos\">".$fila['SGD_SEXP_FECH']."</center>";
			break;
		case 5:
			$salida="<center class=\"leidos\">".$fila['SGD_EXP_FECH_ARCH']."</center>";
			break;
		case 6:
			$salida="<center class=\"leidos\">".$fila['USUA_NOMB']."</center>";
			break;
		case 3:
			if($verImg)
				$salida="<center class=\"leidos\"><a class=\"vinculos\" href=\"{$ruta_raiz}verradicado.php?verrad=".$fila['RADI_NUME_RADI']."&amp;".session_name()."=".session_id()."&amp;krd=".$_GET['krd']."&amp;carpeta=8&amp;nomcarpeta=Busquedas&amp;tipo_carp=0 \" >".$fila['RADI_FECH_RADI']."</a></center>";
			else   
				$salida="<center class=\"leidos\"> <a class=\"vinculos\" href=\"#\" onclick=\"alert(\"ud no tiene permisos para ver el radicado\");\">".$fila['RADI_FECH_RADI']."</a></center>";
			break;
		case 7:
			$salida="<center class=\"leidos\">".$fila['SGD_EXP_ESTADO']."</center>";
			break;
	}
	return $salida;
}
?>
