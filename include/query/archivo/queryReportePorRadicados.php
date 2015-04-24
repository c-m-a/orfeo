<?php
/*************************************************************************************/
/* ORFEO GPL:Sistema de Gestion Documental		http://www.orfeogpl.org	     */
/*	Idea Original de la SUPERINTENDENCIA DE SERVICIOS PUBLICOS DOMICILIARIOS     */
/*				COLOMBIA TEL. (57) (1) 6913005  orfeogpl@gmail.com   */
/* ===========================                                                       */
/*                                                                                   */
/* Este programa es software libre. usted puede redistribuirlo y/o modificarlo       */
/* bajo los terminos de la licencia GNU General Public publicada por                 */
/* la "Free Software Foundation"; Licencia version 2. 			             */
/*                                                                                   */
/* Copyright (c) 2005 por :	  	  	                                     */
/* SSPD "Superintendencia de Servicios Publicos Domiciliarios"                       */
/*   Jairo Hernan Losada  jlosada@gmail.com                Desarrollador             */
/*   Sixto Angel PinzÃ³n LÃ³pez --- angel.pinzon@gmail.com   Desarrollador           */
/* C.R.A.  "COMISION DE REGULACION DE AGUAS Y SANEAMIENTO AMBIENTAL"                 */
/*   Liliana Gomez        lgomezv@gmail.com                Desarrolladora            */
/*   Lucia Ojeda          lojedaster@gmail.com             Desarrolladora            */
/* D.N.P. "Departamento Nacional de PlaneaciÃ³n"                                     */
/*   Hollman Ladino       hladino@gmail.com                Desarrollador             */
/*                                                                                   */
/* Colocar desde esta lInea las Modificaciones Realizadas Luego de la Version 3.5    */
/*  Nombre Desarrollador   Correo     Fecha   Modificacion                           */
/*  Supersolidaria                    05-Diciembre-2006 Consulta para listar los     */
/*                                    radicados que fueron archivados                */
/*************************************************************************************/
?>
<?php
/** CONSULTA RADICADOS SIN EXPEDIENTE
	* Reporte de radicados que no están incluidos en algún expediente.
	* @autor Supersolidaria
	* @version ORFEO 3.7
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
switch( $db->driver )
	{
	case 'mssql':
	$isql = '';	
	break;
	case 'oracle':
	case 'oci8':
	case 'oci805':
	case 'ocipo':
	case 'postgres':
	if($arch==1){
	$queryUs  = "SELECT U.USUA_NOMB AS USUARIO,
					 COUNT( DISTINCT( A.SGD_ARCHIVO_RAD ) ) AS RADICADOS,
                     MIN( U.USUA_CODI ) AS HID_COD_USUARIO,
                     MIN( U.DEPE_CODI ) AS HID_DEPE_USUA,
                     SUM(A.SGD_ARCHIVO_FOLIOS) AS NUMERO_FOLIOS
                     FROM SGD_ARCHIVO_CENTRAL A, USUARIO U
                     WHERE  A.SGD_ARCHIVO_USUA=U.USUA_LOGIN
                     AND ".$db->conn->SQLDate( 'Y-m-d', 'A.SGD_ARCHIVO_FECH' );
	}
	else{
	$queryUs  = "SELECT U.USUA_NOMB AS USUARIO,
					 COUNT( DISTINCT( E.RADI_NUME_RADI ) ) AS RADICADOS,
                     MIN( U.USUA_CODI ) AS HID_COD_USUARIO,
                     MIN( U.DEPE_CODI ) AS HID_DEPE_USUA,
                     SUM(R.RADI_NUME_HOJA) AS NUMERO_FOLIOS
                     FROM SGD_EXP_EXPEDIENTE E, USUARIO U, RADICADO R
                     WHERE E.RADI_NUME_RADI=R.RADI_NUME_RADI AND E.RADI_USUA_ARCH=U.USUA_LOGIN
                     AND ".$db->conn->SQLDate( 'Y-m-d', 'E.SGD_EXP_FECH_ARCH' );
	}
        if( $_POST['fechaIni'] != "" && $_POST['fechaInif'] != "" )
        {
            $queryUs .= " BETWEEN '".$_POST['fechaIni']."' AND '".$_POST['fechaInif']."'";
        }
        else if( $_GET['fechaIniSel'] != "" && $_GET['fechaInifSel'] != "" )
        {
            $queryUs .= " BETWEEN '".$_GET['fechaIniSel']."' AND '".$_GET['fechaInifSel']."'";
        }
        else
        {
            $queryUs .= " BETWEEN '".$fechaIni."' AND '".$fechaInif."'";
        }
        if( $_POST['trad'] != 0 and $arch!=1)
        {
            $queryUs .= " AND ".$db->conn->substr."( E.RADI_NUME_RADI, -1, 1 ) = ".$_POST['trad'];
        }
        // Dependencia
        // if( $_POST['codigo'] != 0 )
        if( $_POST['codigoUsuario'] != 0 )
        {
            // $queryUs .= " AND U.USUA_CODI = ".$_POST['codigo'];
            $queryUs .= " AND U.USUA_CODI = ".$_POST['codigoUsuario'];
        }
        // Usuario
        if( $_POST['dep_sel'] != 0 )
        {
            $queryUs .= " AND U.DEPE_CODI = ".$_POST['dep_sel'];
        }
       $queryUs .= "  GROUP BY U.USUA_NOMB";
       
       /** CONSULTA PARA VER DETALLES 
         */
	if($arch==1){
	 $queryEDetalle  = "SELECT A.SGD_ARCHIVO_RAD AS RADICADO,";
        $queryEDetalle .= " A.SGD_ARCHIVO_PATH as HID_RADI_PATH,";
        $queryEDetalle .= " A.SGD_ARCHIVO_FECH AS FECHA_RADICACION,A.SGD_ARCHIVO_FECH AS FECHA_ARCHIVO,";

        $queryEDetalle .= " U.USUA_NOMB AS USUARIO,D.DEPE_NOMB AS DEPENDENCIA,";
        $queryEDetalle .= " A.SGD_ARCHIVO_FOLIOS AS NUMERO_FOLIOS";
        $queryEDetalle .= " FROM SGD_ARCHIVO_CENTRAL A, USUARIO U, DEPENDENCIA D";
        $queryEDetalle .= " WHERE A.SGD_ARCHIVO_USUA=U.USUA_LOGIN AND D.DEPE_CODI=U.DEPE_CODI";
        $queryEDetalle .= " AND ".$db->conn->SQLDate( 'Y-m-d', 'A.SGD_ARCHIVO_FECH' )." BETWEEN '".$_GET['fechaIni']."' AND '".$_GET['fechaInif']."'";
	}
	else{
        $queryEDetalle  = "SELECT E.RADI_NUME_RADI AS RADICADO,";
        $queryEDetalle .= " R.RADI_PATH as HID_RADI_PATH,";
        $queryEDetalle .= " R.RADI_FECH_RADI AS FECHA_RADICACION,E.SGD_EXP_FECH_ARCH AS FECHA_ARCHIVO,";
        $queryEDetalle .= " U.USUA_NOMB AS USUARIO,D.DEPE_NOMB AS DEPENDENCIA,";
        $queryEDetalle .= " R.RADI_NUME_HOJA AS NUMERO_FOLIOS,";
		$queryEDetalle .= " E.SGD_EXP_NUMERO AS EXPEDIENTE";
        $queryEDetalle .= " FROM SGD_EXP_EXPEDIENTE E, USUARIO U, RADICADO R, DEPENDENCIA D";
        $queryEDetalle .= " WHERE E.RADI_USUA_ARCH=U.USUA_LOGIN AND D.DEPE_CODI=U.DEPE_CODI";
        $queryEDetalle .= " AND E.RADI_NUME_RADI=R.RADI_NUME_RADI";
        $queryEDetalle .= " AND ".$db->conn->SQLDate( 'Y-m-d', 'E.SGD_EXP_FECH_ARCH' )." BETWEEN '".$_GET['fechaIni']."' AND '".$_GET['fechaInif']."'";
	}
       // Usuario
        if( $_GET['codUs'] != 0 )
        {
            $queryEDetalle .= " AND U.USUA_CODI = ".$_GET['codUs'];
        }
        // Dependencia
        if( $_GET['depeUs'] != 0 )
        {
            $queryEDetalle .= " AND U.DEPE_CODI = ".$_GET['depeUs'];
        }
        //Tipo de Radicado
        if( $_GET['trad'] != 0 and $arch!=1)
        {
            $queryEDetalle .= " AND ".$db->conn->substr."( E.RADI_NUME_RADI, -1, 1 ) = ".$_GET['trad'];
        }
        $queryETodosDetalle = $queryEDetalle;
        break;
	}/*
if($arch==1){	
if(isset($_GET['genDetalle'])&& $_GET['denDetalle']=1)
		$titulos=array("1#RADICADO","3#FECHA RADICACION","4#FECHA ARCHIVO","5#USUARIO","6#DEPENDENCIA","7#NUMERO DE FOLIOS");
	else 		
		$titulos=array("1#USUARIO","2#NUMERO FOLIOS","3#RADICADOS");
	function pintarEstadistica($fila,$indice,$numColumna){ 
                global $ruta_raiz,$_POST,$_GET,$encabezado,$krd;
				$verImg=($fila['SGD_SPUB_CODIGO']==1)?($fila['USUARIO']!=$_SESSION['usua_nomb']?false:true):($fila['USUA_NIVEL']>$_SESSION['nivelus']?false:true);
                $salida=""; 
				$numRadicado=$fila['RADICADOS'];
                switch ($numColumna){ 
                        case  1: 
                                $salida=$fila['USUARIO'];
                                break;
						case 3:
						$datosEnvioDetalle=(isset($_POST['usActivos']))?$datosEnvioDetalle."&amp;usActivos=".$_POST['usActivos']:$datosEnvioDetalle;
	        		$salida="<a href=\"genEstadistica.php?{$datosEnvioDetalle}\"  target=\"detallesSec\" >".$fila['RADICADOS']."</a>";
						break;		
                        case 2:
                              $salida=$fila['NUMERO_FOLIOS'];
						break;
			default: $salida=false;
                }
                return $salida;
        }
function pintarEstadisticaDetalle($fila,$indice,$numColumna){
                        global $ruta_raiz,$encabezado,$krd;
                        $verImg=($fila['SGD_SPUB_CODIGO']==1)?($fila['USUARIO']!=$_SESSION['usua_nomb']?false:true):($fila['USUA_NIVEL']>$_SESSION['nivelus']?false:true);
                $numRadicado=$fila['SALIDA'];
                         switch ($numColumna){ 
                        case  1: 
                                if($fila['HID_RADI_PATH'] && $verImg)
								{
									$an=substr($fila['HID_RADI_PATH'],1,4);
									$dep=substr($fila['HID_RADI_PATH'],5,3);
                                       $salida="<center><a href=\"{$ruta_raiz}bodega/".$an."/".$dep."/docs/".$fila['HID_RADI_PATH']."\">".$fila['RADICADO']."</a></center>";
									   }
								 else
                                        $salida="<center class=\"leidos\">{$numRadicado}</center>";
				$salida=$fila['RADICADO'];
                                break;
						case 2:
								$salida=$fila['FECHA_RADICACION'];
						break;		
                        case 3:
                               $salida=$fila['FECHA_ARCHIVO'];
								break;
						
                       	case 4:
                                $salida=$fila['USUARIO'];
                        break;
			case 5:
                                $salida=$fila['DEPENDEN'];
				break;
				case 6:
                                $salida=$fila['NUMERO_FOLIOS'];
				break;
			 
					default: $salida=false;
                }
                return $salida;
 }
 }*/
?>
