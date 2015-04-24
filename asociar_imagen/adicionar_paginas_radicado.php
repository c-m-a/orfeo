<?php
  session_start(); 
  /*
   * Lista Subseries documentales
   * @autor Cmauricio Parra
   * @fecha 2009/06 Modificacion Variables Globales.
   */
  foreach ($_GET as $key => $valor)   ${$key} = $valor;
  foreach ($_POST as $key => $valor)   ${$key} = $valor;
  
  $numero_radicado  = 0;
  $nombre_archivo   = '';
  $observacion      = 'Digitalizacion Imagen Radicado';
  $tipos_radicados[1] = 'Salida';
  $tipos_radicados[2] = 'Entrada';
  
  $ruta_archivo = (isset($_GET['ruta_archivo']))? $_GET['ruta_archivo'] : null;
  $nombre_encontrado = preg_match('/[0-9]+\.[a-zA-Z]+/', $ruta_archivo, $arreglo_nombres);

  if ($nombre_encontrado)
    $nombre_archivo = $arreglo_nombres[0];
  else
    exit('Error en el formato del archivo Consulte al administrador del sistema');
  
  $radicado_encontrado = preg_match('/[0-9]+/', $nombre_archivo, $arreglo_radicados);

  if ($radicado_encontrado)
    $numero_radicado = $arreglo_radicados[0];
  else
    exit('Error en el formato de radicado');
  
  $tipo_radicado = substr($numero_radicado, -1);
  $observacion  .= ' ' . $tipos_radicados[$tipo_radicado]; 
  
  $krd          = $_SESSION['krd'];
  $dependencia  = $_SESSION['dependencia'];
  $usua_doc     = $_SESSION['usua_doc'];
  $codusuario   = $_SESSION['codusuario'];
  $ruta_raiz    = '..';
  $nombre_usuario = $_SESSION['usua_nomb'];
  $nombre_dependencia = $_SESSION['depe_nomb'];

  require_once($ruta_raiz . '/class_control/Dependencia.php');
  
  /**
   * Retorna la cantidad de bytes de una expresion como 7M, 4G u 8K.
   *
   * @param char $var
   * @return numeric
   */
  function return_bytes($val) {
    $val = trim($val);
    $ultimo = strtolower($val{strlen($val)-1});
    switch($ultimo) {
      // El modificador 'G' se encuentra disponible desde PHP 5.1.0
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
</script>
<?php
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
	$encabezado = session_name() . '=' . session_id() .
                  '&krd=' . $krd .
                  '&depeBuscada=' . $depeBuscada .
                  '&filtroSelect=' . $filtroSelect .
                  '&tpAnulacion=' . $tpAnulacion;
	$linkPagina = "$PHP_SELF?$encabezado&orderTipo=$orderTipo&orderNo=";
?>
</head>
<body bgcolor="#FFFFFF" topmargin="0">
<form action="uploadTx.php?<?=$encabezado?>" method="post" name="realizarTx" enctype="multipart/form-data">
<table border=0 width=100% cellpadding="0" cellspacing="0">
	<tr>
	<td width=100%>
		<br>
		<input type='hidden' name="depsel8" value='<?=$depsel8?>'>
		<input type='hidden' name="codTx" value='<?=$codTx?>'>
		<input type='hidden' name="EnviaraV" value='<?=$EnviaraV?>'>
		<input type='hidden' name="fechaAgenda" value='<?=$fechaAgenda?>'>
		<table width="98%" border="0" cellpadding="0" cellspacing="5" class="borde_tab">
			<tr>
			<td width=30% class="titulos4">
				USUARIO:<br><br><?=$_SESSION['usua_nomb']?>
			</td>
			<td width='30%' class="titulos4">
				DEPENDENCIA:<br><br><?=$_SESSION['depe_nomb']?><br>
			</td>
			<td class="titulos4">Asociacion de Imagen a Radicado<BR></td>
			</tr>
			<tr align="center">
				<td colspan="4" class="celdaGris" align="center"><br>
				<center>
				<table width="500"  border=0 align="center" bgcolor="White">
					<TR bgcolor="White">
						<TD width="100">
							<center>
							<img src="<?=$ruta_raiz?>/iconos/tuxTx.gif" alt="Tux Transaccion" title="Tux Transaccion">
							</center>
						</td>
						<TD align="left">
              Observaci&oacute;n: <?=$observacion?>
        			<input type="hidden" name="observa" id="observa" value="<?=$observacion?>"></textarea>
						</TD>
					</TR>
				</table>
				</center>
				<input type="hidden" name="enviar" value="enviarsi">
				<input type="hidden" name="enviara" value="9">
				<input type="hidden" name="carpeta" value="12">
				<input type="hidden" name="carpper" value="10001">
				</td>
			</tr>
			<tr>
				<td colspan="5" align="center">
  				<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo return_bytes(ini_get('upload_max_filesize')); ?>"><br>
				<span class="leidos">Seleccione un Archivo (pdf o tif Tama&ntilde;o Max. <?=ini_get('upload_max_filesize')?>)<br>
          La ruta del Archivo es: <?=$ruta_archivo?> <br>
          <input type="file" name="upload" size="50" class="tex_area">
        </span>
					<input type="hidden" name="replace" value="y">
					<input type="hidden" name="valRadio" value="<?=$numero_radicado?>">
					<input name="check" type="hidden" value="y" checked>
  				</td>
  			</tr>
      <tr>
			<td colspan="4" class="grisCCCCCC">
        <center>
          <br>
				  <input type="submit" value="Realizar" name="Realizar" align="bottom" class="botones" id="Realizar">
			    </br>
        </center>
      </td>
      </tr>
		</table>
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
	$busq_radicados_tmp = "radi_nume_radi = $numero_radicado";
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
