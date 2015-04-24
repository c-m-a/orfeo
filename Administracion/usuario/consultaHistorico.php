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
/*************************************************************************************/
?>
<?php
session_start();
$ruta_raiz = "../..";
// Modificado Infom�trika 25-Septiembre-2009
// Compatibilidad con register_globals = Off
$dependencia = $_SESSION['dependencia'];
$usuLogin = $_GET['usuLogin'];

if (!$dependencia)   include "../../rec_session.php";

?>

<html>
<head>
<link rel="stylesheet" href="../../estilos/orfeo.css">
</head>
<body bgcolor="#FFFFFF" topmargin="0" onLoad="window_onload();">

<?
 $ruta_raiz = "../..";
 include_once "$ruta_raiz/include/db/ConnectionHandler.php";
 $db = new ConnectionHandler("$ruta_raiz");	 
 $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);

//$db->conn->debug=true;

 $nomcarpeta = "Consulta Historico";

 if ($orden_cambio==1)  {
 	if (!$orderTipo)  {
	   $orderTipo="desc";
	}else  {
	   $orderTipo="";
	}
 }

 $encabezado = "".session_name()."=".session_id()."&krd=$krd&pagina_sig=$pagina_sig&usuLogin=$usuLogin&nombre=$nombre&dependencia=$dependencia&dep_sel=$dep_sel&selecdoc=$selecdoc&nomcarpeta=$nomcarpeta&orderTipo=$orderTipo&orderNo=";
 $linkPagina = "$PHP_SELF?$encabezado&usuLogin=$usuLogin&nomcarpeta=$nomcarpeta&orderTipo=$orderTipo&orderNo=$orderNo";
/* $carpeta = "nada";
 $swBusqDep = "si";
 $pagina_actual = "../usuario/cuerpoUsuarioConsulta.php";
// include "../paEncabeza.php";
 $varBuscada = "usua_login";
 include "../paBuscar.php";   
 $pagina_sig = "../usuario/consultaDatosGrales.php";
 $accion_sal = "Consultar"; 
 include "../paOpciones.php";   
*/
	error_reporting(0);
	?>
<center>
<table border=1 width=98% class=t_bordeGris>
<tr>
    <td colspan="2" class="titulos4">

<p><center><B><span class=etexto>ADMINISTRACION DE USUARIOS Y PERFILES</span></B></center> </p>
<p><center><B><span class=etexto>Consulta de Usuario</span></B></center> </p> 

</td>
</tr>
</table>

<table border=1 width=98% class=t_bordeGris>
<td align="left" class="titulos4" width="40%">
Datos Historicos
</td>
</table>

</center>
<table align="center" border=1 width=98% class=t_bordeGris>
<tr>
<td align="left" class="titulos2" width="40%">
Usuario: <?=$usuLogin?>
</td>
<td align="left" class="titulos2" width="40%">
Nombre: <?=$nombre?>
</td>
</tr>
</table>
<? 

?>
  <form name=formHistorico action='consultaHistorico.php?<?=$encabezado?>' method=post>
 <?
    if ($orderNo==98 or $orderNo==99) {
       $order=1; 
	   if ($orderNo==98)   $orderTipo="desc";

       if ($orderNo==99)   $orderTipo="";
	}  
    else  {
	   if (!$orderNo)  {
  		  $orderNo=0;
	   }
	   $order = $orderNo + 1;
    }
//	$sqlChar = $db->conn->SQLDate("d-m-Y H:i A","SGD_RENV_FECH");
	include "$ruta_raiz/include/query/administracion/queryConsultaHistorico.php";

	//$db->conn->debug = true;
    $rs=$db->conn->Execute($isql);

	$nregis = $rs->fields["ADMINISTRADOR"];		

	if (!$nregis)  {
		echo "<hr><center><b>NO se encontro nada con el criterio de busqueda</center></b></hr>";}
	else  {
		$pager = new ADODB_Pager($db,$isql,'adodb', true,$orderNo,$orderTipo);
		$pager->toRefLinks = $linkPagina;
		$pager->toRefVars = $encabezado;
		$pager->Render($rows_per_page=20,$linkPagina,$checkbox=chkEnviar);
	}
 $encabezado = "".session_name()."=".session_id()."&krd=$krd&pagina_sig=$pagina_sig&usuLogin=$usuLogin&dependencia=$dependencia&dep_sel=$dep_sel&selecdoc=$selecdoc&nomcarpeta=$nomcarpeta&orderTipo=$orderTipo&orderNo=";
 ?>

	</form>
</body>

</html>

