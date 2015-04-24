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
/*   Hollman Ladino       hollmanlp@gmail.com                Desarrollador           */
/*                                                                                   */
/* Colocar desde esta lInea las Modificaciones Realizadas Luego de la Version 3.5    */
/*  Nombre Desarrollador   Correo     Fecha   Modificacion                           */
/*************************************************************************************/
/**
* CONSULTA VERIFICACION PREVIA A LA RADICACION
*/
switch($db->driver)
{	case 'mssql':
		{
		$query = "SELECT 
        		m.depe_codi, 
				d.depe_nomb, 
				m.sgd_srd_codigo,
				s.sgd_srd_descrip, 
				m.sgd_sbrd_codigo, 
				su.sgd_sbrd_descrip,
				m.sgd_tpr_codigo,
				t.sgd_tpr_descrip,
				(CASE m.sgd_mrd_esta WHEN '1' THEN 'A' ELSE 'I' END) AS ESTADO,
				su.SGD_SBRD_PROCEDI,
				su.sgd_sbrd_tiemag,
				su.sgd_sbrd_tiemac,
				(CASE su.SGD_SBRD_DISPFIN WHEN '1' THEN 'C. TOTAL' WHEN '2' THEN 'ELIMINACION' WHEN '3' THEN 'M.TECNICO' ELSE 'MUESTREO' END) AS DISPOSICION,
				su.sgd_sbrd_soporte
				FROM SGD_MRD_MATRIRD m,SGD_SRD_SERIESRD s,SGD_SBRD_SUBSERIERD su, SGD_TPR_TPDCUMENTO t, DEPENDENCIA d
				WHERE m.depe_codi = d.depe_codi 
				AND m.sgd_srd_codigo = s.sgd_srd_codigo 
				AND m.sgd_sbrd_codigo = su.sgd_sbrd_codigo 
				AND m.sgd_tpr_codigo = t.sgd_tpr_codigo 
				AND s.sgd_srd_codigo = su.sgd_srd_codigo
				AND m.SGD_MRD_ESTA='1'
				";				
		}break;
	case 'oracle':
	case 'oci8':
	case 'oci805':
	case 'postgres':
		{
  // Modificacion conta para funcionamiento en Postgres 8.3   Jairo Losada
	 $query = "SELECT 
        		m.depe_codi, 
				d.depe_nomb, 
				m.sgd_srd_codigo,
				s.sgd_srd_descrip, 
				m.sgd_sbrd_codigo, 
				su.sgd_sbrd_descrip,
				m.sgd_tpr_codigo,
				t.sgd_tpr_descrip,
				(CASE WHEN m.sgd_mrd_esta = '1' THEN 'A' ELSE 'I' END) AS ESTADO,
				su.sgd_sbrd_tiemag,
				su.sgd_sbrd_tiemac,
				(CASE WHEN su.SGD_SBRD_DISPFIN = '1' THEN 'C. TOTAL' ELSE CASE WHEN su.SGD_SBRD_DISPFIN = '2' THEN 'ELIMINACION' ELSE CASE WHEN su.SGD_SBRD_DISPFIN = '3' THEN 'M.TECNICO' ELSE  'MUESTREO' END END END) AS DISPOSICION,
				su.sgd_sbrd_soporte,
				su.SGD_SBRD_PROCEDI
				FROM SGD_MRD_MATRIRD m,SGD_SRD_SERIESRD s,SGD_SBRD_SUBSERIERD su, SGD_TPR_TPDCUMENTO t, DEPENDENCIA d
				WHERE m.depe_codi = d.depe_codi 
				AND m.sgd_srd_codigo = s.sgd_srd_codigo 
				AND m.sgd_sbrd_codigo = su.sgd_sbrd_codigo 
				AND m.sgd_tpr_codigo = t.sgd_tpr_codigo 
				AND s.sgd_srd_codigo = su.sgd_srd_codigo
				AND m.SGD_MRD_ESTA='1'";
		}break;		
}
?>
