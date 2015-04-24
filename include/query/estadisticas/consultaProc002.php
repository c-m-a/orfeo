<?
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
/* SSPS "Superintendencia de Servicios Publicos Domiciliarios"                       */
/*   Jairo Hernan Losada  jlosada@gmail.com                Desarrollador             */
/*   Sixto Angel Pinzón López --- angel.pinzon@gmail.com   Desarrollador             */
/* C.R.A.  "COMISION DE REGULACION DE AGUAS Y SANEAMIENTO AMBIENTAL"                 */ 
/*   Liliana Gomez        lgomezv@gmail.com                Desarrolladora            */
/*   Lucia Ojeda          lojedaster@gmail.com             Desarrolladora            */
/* D.N.P. "Departamento Nacional de Planeación"                                      */
/*   Hollman Ladino       hladino@gmail.com                Desarrollador             */
/*                                                                                   */
/* Colocar desde esta lInea las Modificaciones Realizadas Luego de la Version 3.5    */
/*  Nombre Desarrollador   Correo     Fecha   Modificacion                           */
/*  Martha Yaneth Mera    mymera@gmail.com     2006-05-10*/
/*************************************************************************************/
?>
<?
/** CONSUTLA 001 
	* Estadiscas por procesos
	* @autor JAIRO H LOSADA - SSPD
	* @version ORFEO 3.5
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
switch($db->driver)
	{
	case 'mssql':
	$isql = '';	
	break;
	case 'oracle':
	case 'oci8':
	case 'oci805':
	case 'ocipo':
//AND TO_CHAR(a.radi_fech_radi,'yyyy/mm/dd') BETWEEN '$fecha_ini'  AND '$fecha_fin' 
	$whereProceso = (isset($codProceso) && $codProceso != '') ? "AND sExp.SGD_PEXP_CODIGO = $codProceso" : '';
	$whereDependencia = ($dependencia_busq != 99999) ? "WHERE sExp.DEPE_CODI = 1$dependencia_busq" : '';
	$andUsua = ($codus != 0) ? "AND u.USUA_DOC = sExp.USUA_DOC_RESPONSABLE AND u.USUA_CODI = $codus" : '';
	$tablaUs = ($codus != 0) ? ", USUARIO u" : '';
	
	$queryE = "SELECT sExp.SGD_EXP_NUMERO EXPEDIENTE 
				FROM SGD_SEXP_SECEXPEDIENTES sExp $tablaUs
				$whereDependencia
				$whereProceso
				$andUsua
				$whereAnoExp";
	
	/** CONSULTA PARA VER DETALLES 
	 */
	$orderE = "	ORDER BY $orno $ascdesc";
	$whereEstadoProc = "";
	if ($estadoProc) {
		$whereEstadoProc = " AND sExp.SGD_FEXP_CODIGO=$estadoProc";
	}
	$expedienteStr = $db->conn->Concat("'_&nbsp;&nbsp;&nbsp;&nbsp;'","sExp.sgd_exp_numero");
	$queryEDetalle = "SELECT b.USUA_NOMB USUARIO
				,$expedienteStr Numero_Expediente
				,sExp.sgd_sexp_fech Fecha_Expediente
				,fExp.sgd_fexp_descrip Estado_Expediente
				,(select min(radi_nume_radi) from sgd_exp_expediente exp where exp.sgd_exp_numero=sExp.sgd_exp_numero) Primer_Radicado
				,(select count(*) from sgd_exp_expediente exp where exp.sgd_exp_numero=sExp.sgd_exp_numero) Nro_de_Radicados
			FROM SGD_SEXP_SECEXPEDIENTES sExp
			, USUARIO b 
			, SGD_FEXP_FLUJOEXPEDIENTES fExp
		WHERE 
			sExp.usua_doc_responsable=b.usua_doc
			AND fExp.SGD_FEXP_CODIGO = sExp.SGD_FEXP_CODIGO
			and sExp.usua_doc_responsable=$usuaDocProc
			$whereEstadoProc
			$whereAnoExp";
			// AND sExp.depe_codi=b.depe_codi	
 	/** CONSULTA PARA VER TODOS LOS DETALLES 
	 */ 
 	
	$queryETodosDetalle = $queryEDetalle . $condicionDep . $orderE;
	$queryEDetalle .= $condicionE . $orderE;
	break;
	}
?>