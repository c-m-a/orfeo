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
/*  Carlos Barrero         carlosabc81@gmail.com  25/09/09                           */
/*                            Estadísticas para paz y salvos Supersolidaria  */
/*************************************************************************************/
session_start();
$krd = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
$usua_doc = $_SESSION["usua_doc"];
$codusuario = $_SESSION["codusuario"];
$ruta_raiz = "..";
include_once "$ruta_raiz/include/db/ConnectionHandler.php";
$db = new ConnectionHandler($ruta_raiz);
	//$db->conn->debug=true;
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);


$sql_ps="select a.NIT_DE_LA_EMPRESA as NIT_DE_LA_EMPRESA,a.NOMBRE_DE_LA_EMPRESA as NOMBRE_DE_LA_EMPRESA,a.SIGLA_DE_LA_EMPRESA as SIGLA_DE_LA_EMPRESA,
a.DIRECCION as DIRECCION,a.TELEFONO_1 as TELEFONO,a.SUPERVISION as SUPERVISION,b.pys_fecha as FECHA_PAZ_SALVO, b.radi_nume_radi as RADICADO,b.pys_ano as ANO,b.pys_trimestre as TRIMESTRE,c.dpto_nomb as DEPTO,d.muni_nomb as MUNICIPIO
from bodega_empresas a 
inner JOIN ses_pazysalvos_cta b ON a.IDENTIFICADOR_EMPRESA=b.IDENTIFICADOR_EMPRESA
inner join departamento c on a.codigo_del_departamento=c.dpto_codi
inner join municipio d on a.codigo_del_municipio=d.muni_codi and c.dpto_codi=d.dpto_codi
where b.PYS_FECHA > to_date('01/01/2006 00:00:00','dd/mm/yyyy hh24:mi:ss')  
and b.pys_fecha in (select max(s.pys_fecha) from ses_pazysalvos_cta s where a.identificador_empresa= s.identificador_empresa) 
order by a.nit_de_la_empresa";
?>
<html>
<link rel="stylesheet" href="../estilos/orfeo.css">
<body>
<?
		$pager = new ADODB_Pager($db,$sql_ps,'adodb', true,$orderNo,$orderTipo);
		$pager->checkAll = true;
		$pager->toRefLinks = $linkPagina;
		$pager->Render($rows_per_page=2000,$linkPagina);	

?>
</body>
</html>
