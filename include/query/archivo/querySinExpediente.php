<?php
/*************************************************************************************/
/* ORFEO GPL:Sistema de Gestion Documental		http://www.orfeogpl.org	             */
/*	Idea Original de la SUPERINTENDENCIA DE SERVICIOS PUBLICOS DOMICILIARIOS         */
/*				COLOMBIA TEL. (57) (1) 6913005  orfeogpl@gmail.com                   */
/* ===========================                                                       */
/*                                                                                   */
/* Este programa es software libre. usted puede redistribuirlo y/o modificarlo       */
/* bajo los terminos de la licencia GNU General Public publicada por                 */
/* la "Free Software Foundation"; Licencia version 2. 			                     */
/*                                                                                   */
/* Copyright (c) 2005 por :	  	  	                                                 */
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
/*                                    radicados que no están incluidos en algún      */
/*                                    expediente.                                    */
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
        $queryUs  = "SELECT DISTINCT( R.RADI_NUME_RADI ) AS \"IDT_Numero Radicado\",
                 RADI_PATH AS \"HID_RADI_PATH\",
                 RADI_FECH_RADI AS \"DAT_Fecha Radicado\",
                 R.RADI_NUME_RADI AS \"HID_RADI_NUME_RADI\",
                 SGD_SRD_DESCRIP AS \"Serie\",
                 SGD_SBRD_DESCRIP AS \"Subserie\",
                 SGD_TPR_DESCRIP AS \"Tipo Documento\"
                 FROM RADICADO R
                    LEFT JOIN SGD_RDF_RETDOCF RDF ON RDF.RADI_NUME_RADI = R.RADI_NUME_RADI
                    LEFT JOIN SGD_MRD_MATRIRD MRD ON MRD.SGD_MRD_CODIGO = RDF.SGD_MRD_CODIGO  
                    LEFT JOIN SGD_SRD_SERIESRD SRD ON SRD.SGD_SRD_CODIGO = MRD.SGD_SRD_CODIGO 
                    LEFT JOIN SGD_SBRD_SUBSERIERD SBRD ON SBRD.SGD_SBRD_CODIGO = MRD.SGD_SBRD_CODIGO AND SBRD.SGD_SRD_CODIGO = SRD.SGD_SRD_CODIGO
                    LEFT JOIN SGD_TPR_TPDCUMENTO TPR ON TPR.SGD_TPR_CODIGO = MRD.SGD_TPR_CODIGO
                 WHERE R.RADI_DEPE_ACTU = '999'
                  AND R.RADI_NUME_RADI NOT IN
                  (
                    SELECT DISTINCT( EXP.RADI_NUME_RADI )
				    FROM SGD_EXP_EXPEDIENTE EXP
				  )
                  AND R.RADI_NUME_RADI NOT IN
                  (
                    SELECT DISTINCT( R.RADI_NUME_RADI )
				    FROM ANEXOS A, RADICADO R
				    WHERE R.RADI_NUME_RADI = A.RADI_NUME_SALIDA
				    AND R.RADI_NUME_RADI <> A.ANEX_RADI_NUME
				  )
                  AND ".$db->conn->SQLDate( 'Y-m-d', 'R.RADI_FECH_RADI' );
        if( $_POST['fechaIni'] != "" && $_POST['fechaInif'] != "" )
        {
            $queryUs .= "BETWEEN '".$_POST['fechaIni']."' AND '".$_POST['fechaInif']."'";
        }
        else if( $_GET['fechaIniSel'] != "" && $_GET['fechaInifSel'] != "" )
        {
            $queryUs .= "BETWEEN '".$_GET['fechaIniSel']."' AND '".$_GET['fechaInifSel']."'";
        }
        else
        {
            $queryUs .= "BETWEEN '".$fechaIni."' AND '".$fechaInif."'";
        }
        if( $_POST['rad'] != "" )
        {
            $queryUs .= " AND R.RADI_NUME_RADI = ".$_POST['rad'];
        }
        // Serie
        if( $serieSel != 0 )
        {
            $queryUs .= " AND SRD.SGD_SRD_CODIGO = ".$serieSel;
        }
        // Subserie
        if( $subserieSel != 0 )
        {
            $queryUs .= " AND SBRD.SGD_SBRD_CODIGO = ".$subserieSel;
        }
        // Tipo Documental
        if( $tdocSel != 0 )
        {
            $queryUs .= " AND TPR.SGD_TPR_CODIGO = ".$tdocSel;
        }
        // Tipo de Radicado
        if( $tradSel != 0 )
        {
            $queryUs .= " AND to_char(R.RADI_NUME_RADI,'99999999999999') like '%".$tradSel."'";
        }
        $queryUs .= " ORDER BY ".$order." ".$orderTipo;
        // print $queryUs;
        break;
	}
?>