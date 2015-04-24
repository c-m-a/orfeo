<?php
session_start(); 
/*
 * Lista Subseries documentales
 * @autor Jairo Losada SuperSOlidaria 
 * @fecha 2009/06 Modificacion Variables Globales.
 */
foreach ($_GET as $key => $valor)   ${$key} = $valor;
foreach ($_POST as $key => $valor)   ${$key} = $valor;
$krd = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
$usua_doc = $_SESSION["usua_doc"];
$codusuario = $_SESSION["codusuario"];
$ruta_raiz = ".."; 

require_once("$ruta_raiz/class_control/Dependencia.php");

/**
 * Retorna la cantidad de bytes de una expresion como 7M, 4G u 8K.
 *
 * @param char $var
 * @return numeric
 */
function return_bytes($val) {
  $val = trim($val);
	$ultimo = strtolower($val{strlen($val)-1});
	switch($ultimo)
	{	// El modificador 'G' se encuentra disponible desde PHP 5.1.0
		case 'g':	$val *= 1024;
		case 'm':	$val *= 1024;
		case 'k':	$val *= 1024;
	}
	return $val;
}
?>
<html>
<head>
<title>Enviar Datos</title>
<link rel="stylesheet" href="../estilos/orfeo.css">
<script>
function notSupported(){ alert('Su browser no soporta las funciones Javascript de esta p�ina.'); }
function setSel(start,end){
  document.realizarTx.observa.focus();
  var t=document.realizarTx.observa;
  if(t.setSelectionRange){
    t.setSelectionRange(start,end);
    t.focus();
  //f.t.value = t.value.substr(t.selectionStart,t.selectionEnd-t.selectionStart);
  } else notSupported();
}

function valMaxChars(maxchars) {
	if(document.realizarTx.observa.value.length > 0) {
		if (document.realizarTx.observa.value.length > maxchars) {
      alert('Demasiados caracteres en el texto, solo se permiten '+ maxchars);
	 		setSel(maxchars,document.realizarTx.observa.value.length);
	 		document.realizarTx.observa.focus();
			return false;
		}
		else return true;
	}
 	else
 	{	alert('Ingrese observaciones!!');
 		document.realizarTx.observa.focus();
 		return false;
 	}
}

function validar() {
  if (valMaxChars(100)) {
    if (document.realizarTx.upload.value.length == 0) {
      alert('Seleccione la imagen a adjutar...');
			document.realizarTx.upload.focus();
			return false;
		}
		else return true;
	}
	else return false;
}

</script>
<?
/*  FILTRO DE DATOS
 *  @$setFiltroSelect  Contiene los valores digitados por el usuario separados por coma.
 *  @$filtroSelect Si SetfiltoSelect contiene algunvalor la siguiente rutina realiza el arreglo de la condici� para la consulta a la base de datos y lo almacena en whereFiltro.
 *  @$whereFiltro  Si filtroSelect trae valor la rutina del where para este filtro es almacenado aqui.
 *
 */


if (!strlen(trim ($valRadio))){
	DIE ("<TABLE><tr><td></td></tr></TABLE><center><table class='borde_tab' width=100% CELSPACING=5><tr class=titulosError><td><center>NO HAY REGISTROS SELECCIONADOS</CENTER></td></tr></table><center>");
 }
 else{
 }
/*
 * OPERACIONES EN JAVASCRIPT
 * @marcados Esta variable almacena el numeo de chaeck seleccionados.
 * @document.realizarTx  Este subNombre de variable me indica el formulario principal del listado generado.
 * @tipoAnulacion Define si es una solicitud de anulacion  o la Anulacion Final del Radicado.
 *
 * Funciones o Metodos EN JAVA SCRIPT
 * Anular()  Anula o solicita esta dependiendo del tipo de anulacin.  Previamente verifica que este seleccionado algun  radicado.
 * markAll() Marca o desmarca los check de la pagina.
 *
 */
?>
<script>

function markAll(noRad)
{
	if(document.realizarTx.elements.check_titulo.checked || noRad >=1)
	{
			for(i=3;i<document.realizarTx.elements.length;i++)
			{
					document.realizarTx.elements[i].checked=1;
			}
	}
	else
	{
			for(i=3;i<document.realizarTx.elements.length;i++)
			{
				document.realizarTx.elements[i].checked=0;
			}
	}
}

</script>
<?
/**
  * Inclusion de archivos para utiizar la libreria ADODB
  *
  */

   include_once "$ruta_raiz/include/db/ConnectionHandler.php";
   $db = new ConnectionHandler("$ruta_raiz");
   $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
   $objDep = new Dependencia($db);
 /*
	* Genreamos el encabezado que envia las variable a la paginas siguientes.
	* Por problemas en las sesiones enviamos el usuario.
	* @$encabezado  Incluye las variables que deben enviarse a la singuiente pagina.
	* @$linkPagina  Link en caso de recarga de esta pagina.
	*/
	$encabezado = "".session_name()."=".session_id()."&krd=$krd&depeBuscada=$depeBuscada&filtroSelect=$filtroSelect&tpAnulacion=$tpAnulacion";
	$linkPagina = "$PHP_SELF?$encabezado&orderTipo=$orderTipo&orderNo=";
?>
</head>
<body bgcolor="#FFFFFF" topmargin="0" onLoad="markAll(1);">
<form action="uploadTx.php?<?=$encabezado?>" method="post" name="realizarTx" enctype="multipart/form-data">
<table border=0 width=100% cellpadding="0" cellspacing="0">
	<tr>
	<td width=100%>
		<br>
		<input type='hidden' name=depsel8 value='<?=$depsel8?>'>
		<input type='hidden' name=codTx value='<?=$codTx?>'>
		<input type='hidden' name=EnviaraV value='<?=$EnviaraV?>'>
		<input type='hidden' name=fechaAgenda value='<?=$fechaAgenda?>'>
		<table width="98%" border="0" cellpadding="0" cellspacing="5" class="borde_tab">
			<TR>
			<TD width=30% class="titulos4">
				USUARIO:<br><br><?=$_SESSION['usua_nomb']?>
			</TD>
			<TD width='30%' class="titulos4">
				DEPENDENCIA:<br><br><?=$_SESSION['depe_nomb']?><br>
			</TD>
			<td class="titulos4">Asociacion de Imagen a Radicado<BR></td>
			<td width='5' class="grisCCCCCC">
				<input type="submit" value="Realizar" name="Realizar" align="bottom" class="botones" id="Realizar" onclick="return validar();">
			</td>
			</TR>
			<tr align="center">
				<td colspan="4" class="celdaGris" align=center><br>
        		<?
					if(($codusuario==1) || ($usuario_reasignacion == 1))
					{
				?>
			        <input type=checkbox name=chkNivel checked class=ebutton>
					<span class="info">El documento tomara el nivel del usuario destino.</span><br>
				<?
					}
				?>
				<center>
				<table width="500"  border=0 align="center" bgcolor="White">
					<TR bgcolor="White">
						<TD width="100">
							<center>
							<img src="<?=$ruta_raiz?>/iconos/tuxTx.gif" alt="Tux Transaccion" title="Tux Transaccion">
							</center>
						</td>
						<TD align="left">
        					<textarea name="observa" id="observa" cols=70 rows=3 class=tex_area></textarea>
						</TD>
					</TR>
				</table>
				</center>
				<input type=hidden name=enviar value=enviarsi>
				<input type=hidden name=enviara value='9'>
				<input type=hidden name=carpeta value=12>
				<input type=hidden name=carpper value=10001>
				</td>
			</tr>
			<tr>
				<td colspan=5 align="center">
  					<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo return_bytes(ini_get('upload_max_filesize')); ?>"><br>
					<span class="leidos">Seleccione un Archivo (pdf o tif   Tama&ntilde;o Max. <?=ini_get('upload_max_filesize')?>)<input type="file" name="upload" size="50" class=tex_area></span>
					<input type="hidden" name="replace" value="y">
					<input type="hidden" name="valRadio" value="<?=$valRadio?>">
					<input name="check" type="hidden" value="y" checked>
  				</td>
  			</tr>
		</TABLE>
		<br>
	</td>
	</tr>
</table>
<?
	/*  GENERACION LISTADO DE RADICADOS
	 *  Aqui utilizamos la clase adodb para generar el listado de los radicados
	 *  Esta clase cuenta con una adaptacion a las clases utiilzadas de orfeo.
	 *  el archivo original es adodb-pager.inc.php la modificada es adodb-paginacion.inc.php
	 */
	if(!$orderNo)  $orderNo=0;
	$order = $orderNo + 1;
	$sqlFecha = $db->conn->SQLDate("d-m-Y H:i A","b.RADI_FECH_RADI");
	$busq_radicados_tmp = "radi_nume_radi=$valRadio";
   include_once "../include/query/uploadFile/queryUploadFileRad.php";
	if($codTx==12)
	{
		$isql = str_replace("Enviado Por" ,"Devolver a",$isql);
	}
	$pager = new ADODB_Pager($db,$query2,'adodb', true,$orderNo,$orderTipo);
	$pager->toRefLinks = $linkPagina;
	$pager->toRefVars = $encabezado;
	$pager->checkAll = true;
	$pager->checkTitulo = true;
	$pager->Render($rows_per_page=20,$linkPagina,$checkbox=chkAnulados);
?>
<input type='hidden' name=depsel value='<?=$depsel?>'>
</form>
</body>
</html>
