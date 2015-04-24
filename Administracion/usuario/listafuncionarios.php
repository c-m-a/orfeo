<?
session_start();
/**---------------------------Lista Funcionarios -------------------------------*
 * @NOMBRE: CONSULTAR LA LISTA DE FUNCIONARIOS EN LA TABLA USUARIO
 * @FECHA DE CREACION: 20-06-06
 * @AUTOR: SUPERSOLIDARIA
 * @DESCRIPCION: Consulta los funcionarios de la tabla USUARIO, desde esta lista,
				 es posible asignar las empresas que tiene a cargo cada funcionario.
 * @AUTOR MODIFICACION: Adaptado V 3.8 SUPERSOLIDARIA -  Jairo Losada 2009-08
 *------------------------------------------------------------------------------*/

foreach ($_GET as $key => $valor)   ${$key} = $valor;
foreach ($_POST as $key => $valor)   ${$key} = $valor;

define('ADODB_ASSOC_CASE', 2);

$krd = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
$usua_doc = $_SESSION["usua_doc"];
$codusuario = $_SESSION["codusuario"];

$ruta_raiz = "../..";

$tpDepeRad = "NADA";
?>

<html>
<head>
<title>:: Lista Funcionarios - ORFEO ::</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../../estilos/orfeo.css">
</head>
<script language="JavaScript">
function consultar()
{
	location.href="consultarEntidadaCargo.php?krd=".$krd;
}
</script>

<body bgcolor="#FFFFFF" topmargin="0" onLoad="window_onload();">
<div id="spiffycalendar" class="text"></div>
<link rel="stylesheet" type="text/css" href="js/spiffyCal/spiffyCal_v2_1.css">

<?
 $ruta_raiz = "../..";
 include_once "$ruta_raiz/include/db/ConnectionHandler.php";
 $db = new ConnectionHandler("$ruta_raiz");
 if (!$dep_sel) $dep_sel = $dependencia;
 $nomcarpeta = "Funcionarios";

 if ($busq_radicados) {
    $busq_radicados = trim($busq_radicados);
    $textElements = split (",", $busq_radicados);
    $newText = "";
    $i = 0;
    foreach ($textElements as $item)  {
    	$item = trim ( $item );
        if ( strlen ( $item ) != 0 ) {
		   $i++;
		   if ($i > 1) $busq_and = " and "; else $busq_and = " ";
		      $busq_radicados_tmp .= " $busq_and radi_nume_sal like '%$item%' ";
		}
     }
	 $dependencia_busq1 .= " and $busq_radicados_tmp ";

 }else  {
    $sql_masiva = "";
 }

 if ($orden_cambio==1)  {
 	if (!$orderTipo)  {
	   $orderTipo="desc";
	}else  {
	   $orderTipo="";
	}
 }

 $encabezado = session_name()."=".session_id()."&pagina_sig=$pagina_sig&accion_sal=$accion_sal&dependencia=$dependencia&dep_sel=$dep_sel&selecdoc=$selecdoc&nomcarpeta=$nomcarpeta&orderTipo=$orderTipo&orderNo=";
 $linkPagina = "$PHP_SELF?$encabezado&accion_sal=$accion_sal&nomcarpeta=$nomcarpeta&orderTipo=$orderTipo&orderNo=$orderNo";
 $carpeta = "nada";
 $swBusqDep = "si";
 $pagina_actual = "../usuario/listafuncionarios.php";
 include "../paEncabeza.php";
 $varBuscada = "usua_login";
 include "../paBuscar.php";
 $pagina_sig = "../usuario/crear.php";
 $paginaBuscar = "consultarEntidadaCargo.php";
 $accion_sal = "Editar";
 ?>
  <table BORDER=0  cellpad=2 cellspacing='2' WIDTH=100%  align='center' class="borde_tab" cellpadding="2">
     <tr>
       <td align="center" class="titulos2">
         <a href='<?=$paginaBuscar?>?<?=$encabezado?>'>
		 <input type="button" value="Datos Entidad" name="Enviar" id="Enviar" valign='middle' class='botones_largo'></a>
       </td>
     </tr>
   </table>
<?

	/*  GENERACION LISTADO DE FUNCIONARIOS
	 *  Aqui utilizamos la clase adodb para generar el listado de los funcionarios
	 *  Esta clase cuenta con una adaptacion a las clases utiilzadas de orfeo.
	 *  el archivo original es adodb-pager.inc.php la modificada es adodb-paginacion.inc.php
	 */

	error_reporting(7);
?>
  <form name=formEnviar action='crear.php?<?=$encabezado?>&usModo=2' method=post>
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

	include "queryFuncionarios.php";

    $rs=$db->conn->Execute($isql);
	$nregis = $rs->fields["USUA_NOMB"];
	$pagEdicion="../usuario/asignarentidades.php";
	$pagConsulta="../usuario/consultarentporfuncionario.php";
	if ($nregis)  {
		echo "<hr><center><b>NO se encontro nada con el criterio de busqueda</center></b></hr>";}
	else  {
		$pager = new ADODB_Pager($db,$isql,'adodb', true,$orderNo,$orderTipo);
		$pager->toRefLinks = $linkPagina;
		$pager->toRefVars = $encabezado;
		$pager->colOptions = true;//Par�metro para colocar la columna con las opciones
		$pager->pagEdicion = $pagEdicion;
		$pager->pagConsulta = $pagConsulta;
		$pager->Render($rows_per_page=20,$linkPagina,$checkbox=chkEnviar);
	}
 ?>
  </form>
</body>
</html>
