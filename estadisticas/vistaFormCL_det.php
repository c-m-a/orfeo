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
/*  Carlos Barrero         carlosabc81@gmail.com  11/08/09                           */
/*                            Estadísticas para Control de legalidad Supersolidaria  */
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

$isql='

select 
	   r.RADI_NUME_RADI AS "Numero radicado", 
	   TO_CHAR(r.RADI_FECH_RADI, \'YYYY-MM-DD\') AS "Fecha radicado", r.RA_ASUN AS "Asunto",r.RADI_NUME_DERI AS "Radicado Padre", 
	   b.NOMBRE_DE_LA_EMPRESA AS "Entidad Solidaria", b.SIGLA_DE_LA_EMPRESA AS "Sigla", 
	   t.SGD_TPR_DESCRIP AS "Tipo Documento", r.RADI_USU_ANTE AS "Enviado Por", 
	   u.USUA_LOGIN AS "Funcionario", d.DEPE_NOMB AS "Grupo", t.SGD_TPR_TERMINO AS "Termino", 
	   t.SGD_TPR_TIPTERMINO AS "Tipo de Termino",a.RADI_NUME_SALIDA AS "Rad Salida", a.ANEX_RADI_FECH AS "Fech Rad Sal"


from radicado r 

left join anexos a on r.RADI_NUME_RADI=a.ANEX_RADI_NUME and a.ANEX_BORRADO=\'N\'
left join SGD_TPR_TPDCUMENTO t on t.SGD_TPR_CODIGO = r.TDOC_CODI  
left join USUARIO u on u.USUA_CODI=r.RADI_USUA_ACTU and u.DEPE_CODI = r.RADI_DEPE_ACTU 
left join DEPENDENCIA d on d.DEPE_CODI = r.RADI_DEPE_ACTU
inner join BODEGA_EMPRESAS b on r.EESP_CODI=b.IDENTIFICADOR_EMPRESA';


//escoje vector de radicados en sesion

switch($_GET['tipo'])
	{
		case 1:
		$filtro=$_SESSION['lista']; var_dump ($filtro);
		echo "<br><center><spam class='titulos3'>DETALLE SOLICITUDES</spam></center><br>";
		break;
		case 2:
		$filtro=$_SESSION['lista2'];
		echo "<br><center><spam class='titulos3'>DETALLE RESPUESTAS</spam></center><br>";
		break;
		case 3:
		$filtro=$_SESSION['tramite'];
		echo "<br><center><spam class='titulos3'>DETALLE EN TRAMITE</spam></center><br>";
		break;
	}


$isql.=" where (r.RADI_NUME_RADI=";
$i=1;
foreach($filtro as $row1)
{
	if ($i==count($filtro))
		$isql.=$row1;
	else
		$isql.=$row1." or RaDI_NUME_RADI=";
$i++;
}
$isql.=")";

?>
<head>
<title>Detalle de Radicados</title>
<link rel="stylesheet" href="../estilos/orfeo.css">
<?
$linkPagina = "$PHP_SELF?$encabezado&orderTipo=$orderTipo&orderNo=";
$pager = new ADODB_Pager($db,$isql,'adodb', true,1);
$pager->checkAll = false;
$pager->checkTitulo = true;
$pager->toRefVars = $encabezado;
$pager->Render($rows_per_page=2000,$linkPagina,$checkbox=chkEnviar);

?>
