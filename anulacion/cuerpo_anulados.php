<?
session_start();
$ruta_raiz = "..";
if(!$dependencia) include_once "$ruta_raiz/rec_session.php";
/**
  *  ANULACION DE RADICADOS.  Sun función es presentar a los usuarios segun sus permisos el listado de radicados para realizar solicitud de anulacion de los radicados.
	*  Este permiso depende del campo existente en la tabla usuario llamado sgd_panu_codi
	*
	*/
?>
<html>
<Head><TITLE>Anulación de Radicados</TITLE>

<?
/*  INICILAIZACION DE VARIABLES
 *  @$cambioDepe Contiene codigo de la dependencia seleccionada, si esta variable no existe significa que no se realizo cambio de esta.
 *  @$depeBuscada Contiene el codigo de la dependencia sobre el cual se realiza la busqueda.  Si cambioDepe tiene un valor, depeBusqueda pasa a tener el valor de cambioDepe
 *  @$orderTipo  Tipo de ordenamiento, (asc, desc). 
 *  @$orderCambio Si se encuentra en valor 1 debe cambiar er orderTipo
 */
if($cambioDepe)
{
	$depeBuscada = $cambioDepe;
}
if(!$depeBuscada)
{
	$depeBuscada = $dependencia;
}
/*  FILTRO DE DATOS
 *  @$setFiltroSelect  Contiene los valores digitados por el usuario separados por coma.
 *  @$filtroSelect Si SetfiltoSelect contiene algunvalor la siguiente rutina realiza el arreglo de la condición para la consulta a la base de datos y lo almacena en whereFiltro.
 *  @$whereFiltro  Si filtroSelect trae valor la rutina del where para este filtro es almacenado aqui.
 *  
 */
 if($setFiltroSelect)
 {
		$filtroSelect = $setFiltroSelect;
 }
 if($filtroSelect)
 {
// En este proceso se utilizan las variabels $item, $textElements, $newText que son temporales para esta operacion.
		$filtroSelect = trim($filtroSelect);
		$textElements = split (",", $filtroSelect);
		$newText = "";
		foreach ($textElements as $item)
		{
				$item = trim ( $item );
					if ( strlen ( $item ) != 0)
			{
			if(strlen($item)<=6)
			{
				$sec = str_pad($item,6,"0",STR_PAD_left);
				//$item = date("Y") . $dep_sel . $sec;
			}else
			{
			}
					$whereFiltro .= " b.radi_nume_radi like '%$item%' or";
			}
		}
	if(substr($whereFiltro,-2)=="or") 
	{
		$whereFiltro = substr($whereFiltro,0,strlen($whereFiltro)-2);
	}
	if(trim($whereFiltro))
	{
		$whereFiltro = "and ( $whereFiltro ) ";
	}
 }
?>

  <meta http-equiv="Cache-Control" content="cache">
  <meta http-equiv="Pragma" content="public">
<?
/*
 * Inclusion de archivos para utiizar la libreria ADODB 
 *
 */
error_reporting(E_ALL); # reporta todos los errores
//ini_set("display_errors", "1"); # pero no los muestra en la pantalla
//define('ADODB_ERROR_LOG_TYPE',3);
//define('ADODB_ERROR_LOG_DEST','C:/errors.log');
include('../adodb/adodb.inc.php');
include('../adodb/tohtml.inc.php');
include_once('../adodb/adodb-paginacion.inc.php');
include('../config.php');

$db = ADONewConnection('oracle'); # eg 'mysql' o 'postgres'
$db->Connect($servidor, $usuario, $contrasena, $servicio);
 /*
	* Genreamos el encabezado que envia las variable a la paginas siguientes.
	* Por problemas en las sesiones enviamos el usuario.
	* @$encabezado  Incluye las variables que deben enviarse a la singuiente pagina. 
	* @$linkPagina  Link en caso de recarga de esta pagina.
	*/
	switch ($tpAnulacion) 
	{
	case 1:
			$whereTpAnulacion = "
					and b.SGD_EANU_CODIGO != 9
					and b.SGD_EANU_CODIGO != 2
			";
					$nombreCarpeta = "Solicitud de Anulacion de Radicados";	
					$textSubmit = "Solicitar Anulacion";	
			break;
	case 2:
			$whereTpAnulacion = "
					and b.SGD_EANU_CODIGO = 2
				";
					$nombreCarpeta = "Radicados para Anular";
					$textSubmit = "Anular";	
			break;
	case 3:
							$whereTpAnulacion = "
					and b.SGD_EANU_CODIGO = 9
					";
					$nombreCarpeta = "Radicados Anulados";
					$textSubmit = "Ver Reporte";	
	break;
}
$encabezado = "".session_name()."=".session_id()."&krd=$krd&depeBuscada=$depeBuscada&filtroSelect=$filtroSelect&tpAnulacion=$tpAnulacion";
$linkPagina = "$PHP_SELF?$encabezado&orderTipo=$orderTipo&orderNo=";
?>
<link rel="stylesheet" href="../estilos_totales.css">
<?
/* 
 * OPERACIONES EN JAVASCRIPT 
 * @marcados Esta variable almacena el numeo de chaeck seleccionados.
 * @document.formAnulados  Este subNombre de variable me indica el formulario principal del listado generado.
 * @tipoAnulacion Define si es una solicitud de anulacion  o la Anulacion Final del Radicado.
 *
 * Funciones o Metodos EN JAVA SCRIPT
 * Anular()  Anula o solicita esta dependiendo del tipo de anulacin.  Previamente verifica que este seleccionado algun  radicado.
 * markAll() Marca o desmarca los check de la pagina.
 *
 */
?>
<script>
function Anular(tipoAnulacion)
{
	marcados = 0;
	for(i=4;i<document.formAnulados.elements.length;i++)
	{
			if(document.formAnulados.elements[i].checked==1)
			{
				marcados++;
			}
	}
	if(marcados>=1)
	{
	  document.formAnulados.submit();
	}
	else
	{
		alert("Debe marcar un elemento");
	}
}
function markAll()
{
	if(document.formAnulados.elements.check_titulo.checked)
	{
			for(i=3;i<document.formAnulados.elements.length;i++)
			{
					document.formAnulados.elements[i].checked=1;
			}
	}
	else
	{
			for(i=3;i<document.formAnulados.elements.length;i++)
			{
				document.formAnulados.elements[i].checked=0;
			}
	}
}
</script>
</head>
<body bgcolor="#FFFFFF" topmargin="0" >
<br>
<table border=0 width='100%' class='t_bordeGris' align='center' bgcolor="#CCCCCC">
	<tr >
		<td height="20" >
	<table BORDER=0  cellpad=2 cellspacing='0' WIDTH=98% class='t_bordeGris' valign='top' align='center' >
		<TR >
			<TD width='35%' >
				<table width='100%' border='0' cellspacing='1' cellpadding='0'>
					<tr>
						<td height="20" class="celdaGris"><img src="../imagenes/listado.gif" width="85" height="20"></td>
					</tr>
					<tr>
						<td height="20" class="tituloListado">
						<span class="etextomenu">
						<?=$nombreCarpeta?>
					</span>
						</td>
					</tr>
				</table>
			</td>
			<TD width='32%'  >
					
					<table width="100%" border="0" cellspacing="1" cellpadding="0">
					<tr>
						<td width="10%" class="celdaGris" height="20"><img src="../imagenes/usuario.gif" width="58" height="20"></td>
					</tr><tr>
						<td width="90%" height="20"><span class='etextomenu'>
						<?=$usua_nomb?>
						</span></td>
					</tr>
				</table>
			</td>
			<td height="37" width="33%">
				<table width="100%" border="0" cellspacing="1" cellpadding="0">
					<tr>
						<td width="16%" class="celdaGris" height="20"><img src="../imagenes/dependencia.gif" width="87" height="20"></td>
					</tr><tr>
						<td width="84%" height="20">
						<span class='etextomenu'>
						<FORM method=post action='<?=$linkPagina?>'>
						<?
							if($tpAnulacion==1)
							{
								$whereMenuDep = " where depe_codi=$dependencia";
							}else
							{
								$whereMenuDep = "";
							}
							?>
						</FORM>     
						</span></td>
					</tr>
				</table>
			</TD>
		</tr>
	</table>
		<TABLE width="98%" align="center" cellspacing="0" cellpadding="0">
	<tr>
	<td>
	</td>
	</tr>
</table>

<TABLE width="98%" align="center" cellspacing="0" cellpadding="0">
	<tr>
	  <TD class="grisCCCCCC" >
			<FORM name=formFiltro action='<?=$linkPagina?>' method=post>
			Buscar radicado(s) (Separados por coma)
			<input name="setFiltroSelect" type="text" size="70" class="ecajasfecha" value="<?=$filtroSelect?>">
			<input type=submit value='Buscar ' name=Buscar valign='middle' class='ebuttons2'>
			</form>
		</td>
	</tr>

</table>
<form name=formAnulados action='solAnulacion.php?<?=$encabezado?>' method="POST">
		<TABLE width="98%" align="center" cellspacing="0" cellpadding="0">
		<tr>
		<TD class="grisCCCCCC" height="58">
				<table BORDER=0  cellpad=2 cellspacing='2' WIDTH=98% class='t_bordeGris' valign='top' align='center' cellpadding="2" >
				<tr bgcolor="#CCCCCC">
					<td width='10%' align='left' height="40" class="grisCCCCCC"  >
                        
                      </td>
					<td width='5%' align="right">
					<input type=button value='<?=$textSubmit?>' name=Enviar valign='middle' class='ebuttons2' onClick='Anular(1);'>
					</td>
				</TR>
				</TABLE>
		</td>
	</tr>
	<tr>
		<td class="grisCCCCCC">
				<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center">
				<tr valign="bottom">
					<td><img src="../imagenes/estadoDocInfo.gif" width="340" height="25"></td>
				</tr>
				</table>
	</td>
	</tr>
	<TR><TD>
	<?
	/*  GENERACION LISTADO DE RADICADOS
	 *  Aqui utilizamos la clase adodb para generar el listado de los radicados
	 *  Esta clase cuenta con una adaptacion a las clases utiilzadas de orfeo.
	 *  el archivo original es adodb-pager.inc.php la modificada es adodb-paginacion.inc.php
	 */
	error_reporting(7);
	if(!$orderNo)  $orderNo=0;
	$order = $orderNo + 1;
	if($orden_cambio==1)
	{
	  if(!$orderTipo)
		{
		   $orderTipo="desc";
		}else
		{
			$orderTipo="";
		}
	}
	$sqlFecha = $db->SQLDate("d-m-Y H:i A","b.RADI_FECH_RADI");
	$isql = 'select
								b.RADI_NUME_RADI "IMG_Numero Radicado"
								,b.RADI_PATH "HID_RADI_PATH"
								,b.RADI_NUME_DERI "Radicado Padre"
								,b.RADI_FECH_RADI "HOR_RAD_FECH_RADI"
								,'.$sqlFecha.' "Fecha Radicado"
								,b.RA_ASUN "Descripcion"
								,c.SGD_TPR_DESCRIP
								,b.RADI_NUME_RADI "CHK_CHKANULAR"
						 from
						 radicado b,
						 SGD_TPR_TPDCUMENTO c
					 where 
						b.radi_nume_radi is not null
						and '.$db->substr.'(b.radi_nume_radi, 5, 3)='.$depeBuscada.'
						and b.tdoc_codi=c.sgd_tpr_codigo
						'.$whereTpAnulacion.'
						'.$whereFiltro.'
					  order by '.$order .' ' .$orderTipo;
	$db->debug = true;
	$pager = new ADODB_Pager($db,$isql,'adodb', true,$orderNo,$orderTipo);
	$pager->toRefLinks = $linkPagina;
	$pager->Render($rows_per_page=10,$linkPagina,$checkbox=chkAnulados);
	?>
	</TD></TR>
	</TABLE>
	</td>
	</tr>
	</table>
	</form>
	

<br><script>
function  prueba(Button)
{
	if (event.button == 2)
	{
		alert("Botón derecho pulsado");
	}
}
 </script>
</body>
</html>
