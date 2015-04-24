<?
/**-------------------------------Lista Empresas -------------------------------*
 * @NOMBRE: CONSULTAR LA LISTA DE EMPRESAS EN LA TABLA BODEGA_EMPRESAS PARA
 	        USUARIOS CON PRIVILEGIOS
 * @FECHA DE CREACIÓN: 24-04-08
 * @AUTOR: SUPERSOLIDARIA
 * @DESCRIPCIÓN: Se listan las empresas de la tabla BODEGA_EMPRESAS PARA USUARIOS 
 CON PRIVILEGIOS .
 *------------------------------------------------------------------------------*/
	$krdOld = $krd;
	session_start();
	error_reporting(7);
	if(!$krd) $krd=$krdOsld;
	$ruta_raiz = "..";
	include "$ruta_raiz/$ruta_raiz/rec_session.php";
?>
<html>
<head>
<title>:: Listado de Empresas - Orfeo ::</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../../estilos/orfeo.css">
<link href="../../estilos/orfeo.css" rel="stylesheet" type="text/css">
 <script>
<!--
function nuevaempresa()
{
	location.href='insbodegaempresas.php';
}
-->
 </script>
</head>
<body bgcolor="#FFFFFF" topmargin="0" onLoad="window_onload();">
<?

    include "../../config.php";
	include_once "$ruta_raiz/$ruta_raiz/include/db/ConnectionHandler.php";
    $db = new ConnectionHandler("$ruta_raiz/$ruta_raiz");
    $entidad;
    
    if ($orden_cambio==1)
	{
 	    if (!$orderTipo)
	    {
	   		$orderTipo="desc";
		}
		else
		{
	   		$orderTipo="";
		}
 	}

 	if ($orderNo==98 or $orderNo==99)
	{
       $order=1;
	   if ($orderNo==98)   $orderTipo="desc";

       if ($orderNo==99)   $orderTipo="";
	}
    else
	{
	   if (!$orderNo)
	   {
  		  $orderNo=0;
	   }
	   $order = $orderNo + 1;
    }

	if($busqEmpresas)
	{
		$busqEmpresas = strtoupper(trim($busqEmpresas));
    	$condicion .= "(NOMBRE_DE_LA_EMPRESA like '%$busqEmpresas%' or SIGLA_DE_LA_EMPRESA like '%$busqEmpresas%' or NIT_DE_LA_EMPRESA like '%$busqEmpresas%') AND ESTADO_EMPRESA=1";
	}
	$encabezado = "".session_name()."=".session_id()."&krd=$krd&usua_nomb=$usua_nomb&busqEmpresas=$busqEmpresas&";
    $linkPagina = "$PHP_SELF?$encabezado&orderTipo=$orderTipo&orderNo=$orderNo";
    $encabezado = "".session_name()."=".session_id()."&adodb_next_page=1&usua_nomb=$usua_nomb&krd=$krd&orderTipo=$orderTipo&orderNo=";
?>

<div id="spiffycalendar" class="text"></div>
<link rel="stylesheet" type="text/css" href="js/spiffyCal/spiffyCal_v2_1.css">
<FORM name=form_lista_empresas action='<?=$PHP_SELF?>?<?=$encabezado?>' method=post>
<table width="100%"  border="0" class=borde_tab >
  <tr>
    <td width="11%" bgcolor="377584" class="info"><div align="center"></div></td>
    <td width="55%" bgcolor="377584" height="20"><span class="titulo1">LISTADO DE:</span></td>
    <td width="34%" bgcolor="377584"><span class="titulo1">USUARIO </span></td>
  </tr>
  <tr class="info">
    <td><div align="center"><a href='javascript: history.back()'>Atras</a></div></td>
<?
switch($entidad)
{
	case 'SES':
?>
    <td height="20">Entidades Solidarias </td>
<?
 break;
}
?>
    <td><?=$usua_nomb?></td>
  </tr>
</table>
<table border=0  cellpad=2 cellspacing='0' width=100% class='t_bordeGris' valign='top' align='center' >
	<tr>
	<tr/>
	<tr><td width='100%'>
	<table width="100%" align="center" cellspacing="0" cellpadding="0">
	<tr class="tablas"><td class="etextomenu" >
	<span class="etextomenu">
	Buscar Entidad Solidaria
	  <input name="busqEmpresas" type="text" size="60" class="tex_area" value="<?=$busqEmpresas?>">
	<input type=submit value='Buscar' name='Buscar' valign='middle' class='botones'>
	<!--
    <input type="button" value='Nueva Entidad' name=Buscar2 valign='middle' class='botones' onClick="nuevaempresa();">
	-->
	</td></tr>
	<td/>
  <tr/>
<table><tr><td> </td></tr></table>
<tr><td class=titulos3 align=center>&nbsp;</td></tr>
<?
	include_once "lista_bodega_empresas_ug.php";
    $rs=$db->conn->Execute($isql);
//    $pagEdicion="../entidad/modificarbodegaempresa.php";
//   $pagConsulta="../entidad/consultarbodegaempresa.php";
	$db->conn->debug = false;
	$pager = new ADODB_Pager($db,$isqlC,'adodb', true,$orderNo,$orderTipo);
	$pager->checkAll = false;
	$pager->checkTitulo = true;
	$pager->colOptions = false;//Parámetro para colocar la columna con las opciones
//	$pager->pagEdicion = $pagEdicion;
//	$pager->pagConsulta = $pagConsulta;
	$pager->toRefLinks = $linkPagina;
	$pager->toRefVars = $encabezado;
	$pager->Render($rows_per_page=150,$linkPagina,$checkbox=chkEnviar);
?>
			<tr class=paginacion align=center><td><font size=1 class=tpar></font></td></tr>
</form>
</body>
</html>


