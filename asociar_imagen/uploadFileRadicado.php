<?php
  /**
    * Se añadio compatibilidad con variables globales en Off
    * @autor Jairo Losada 2009-05
    * @licencia GNU/GPL V 3
    */
  session_start();
  include ('../config.php');
  
  $krd          = $_SESSION["krd"];
  $dependencia  = $_SESSION["dependencia"];
  $usua_doc     = $_SESSION["usua_doc"];
  $codusuario   = $_SESSION["codusuario"];
  $tip3Nombre   = $_SESSION["tip3Nombre"];
  $tip3desc     = $_SESSION["tip3desc"];
  $tip3img      = $_SESSION["tip3img"];

  $nomcarpeta   = (isset($_GET["carpeta"]))? $_GET["carpeta"] : null;
  $tipo_carpt   = (isset($_GET["tipo_carpt"]))? $_GET["tipo_carpt"] : null;
  $adodb_next_page = (isset($_GET["adodb_next_page"]))? $_GET["adodb_next_page"] : null;
  
  $dep_sel    = (isset($_GET['dep_sel']))? $_GET['dep_sel'] : null;
  $btn_accion = (isset($_GET["btn_accion"]))? $_GET["btn_accion"] : null;
  $orderNo    = (isset($_GET["orderNo"]))? $_GET["orderNo"] : null;
  
  $orderTipo  = (isset($_REQUEST["orderTipo"]))? $_GET["orderTipo"] : null;
  
  $busqRadicados = (isset($_REQUEST['busqRadicados']))? $_REQUEST['busqRadicados'] : null;
  
  $Buscar = (isset($_REQUEST["Buscar"]))? $_REQUEST["Buscar"] : null;
  
  $busq_radicados_tmp = (isset($_GET['busqRadicados']))? $_GET['busqRadicados'] : null;

  $ruta_raiz = '..';
  
  if(!isset($_SESSION['dependencia']))
    include '../rec_session.php';
  
  require_once('../include/db/ConnectionHandler.php');
  $db = new ConnectionHandler($ruta_raiz);
?>
<htmL>
<head>
<base href="<?=ORFEO_URL?>">
<link rel="stylesheet" href="estilos/orfeo.css">
<!-- Adicionado Carlos Barrero SES 02/10/09-->
<script>
	function borrad(ruta) {
			if(document.formulario.valRadio.checked==false) {
        alert('Seleccione un radicado.');
        return false;
			} else {
        if(confirm("Esta seguro de borrar la imágen del radicado "+formulario.valRadio.value+" ?"))
          window.location=ruta+document.formulario.valRadio.value;
        else
          return false;
			}
	}
</script>
</head>
<body>
<form action="./asociar_imagen/uploadFileRadicado.php?<?=session_name()?>=<?=session_id()?>" method="POST">
<?php
/**
  *@param $varBuscada string Contiene el nombre del campo que buscara
  *@param $busq_radicados_tmp string Almacena cadena de busqueda de radicados generada por pagina paBuscar.php
  */
$varBuscada = 'cast(RADI_NUME_RADI as varchar(15))';
include ('../envios/paEncabeza.php');
include ('../envios/paBuscar.php');

// $filtroSelect
if (isset($_GET['filtroSelect']) || isset($_POST['filtroSelect']))
  $filtroSelect = (isset($_GET['filtroSelect']))? $_GET['filtroSelect'] : $_POST['filtroSelect'];
else
  $filtroSelect = null;

$encabezado = session_name() . '=' . session_id() .
              '&carpeta=' . $carpeta .
              '&busqRadicados=' . $busqRadicados .
              '&nomcarpeta=' . $nomcarpeta;

$linkPagina = __FILE__ . '?' .
              $encabezado .
              '&orderTipo=' . $orderTipo .
              '&orderNo=' . $orderNo;

$encabezado = session_name() . '=' . session_id() .
              '&adodb_next_page=' . 1 .
              '&filtroSelect=' . $filtroSelect .
              '&carpeta=' . $carpeta .
              '&nomcarpeta=' . $nomcarpeta .
              '&orderTipo=' . $orderTipo .
              '&orderNo=';

$enlace_upload = './asociar_imagen/formUpload.php?' .
                  'krd=' . $krd .
                  '&' . session_name() . '='. session_id();
?>
</form>
<!--
Modificación Carlos Barrero -SES- permite borrar imagen vinculadas
-->
<form action="<?=$enlace_upload?>" method="POST" name="formulario">
<center>
  <input type="submit" value="Asociar Imagen del Radicado" name="asocImgRad" class="botones_largo">
  <input type="button" value="Borrar Imagen del Radicado" name="borraImgRad" class="botones_largo" onClick="return borrad('borraPath.php?krd=<?=$krd?>&<?=session_name()?>=<?=session_id()?>&numrad=');">
<?php
if($Buscar AND $busq_radicados_tmp) {
	include "$ruta_raiz/include/query/uploadFile/queryUploadFileRad.php";
	$rs = $db->conn->Execute($query);

	if ($rs->EOF) {
		echo "<hr><center><b><span class='alarmas'>No se encuentra ningun radicado con el criterio de busqueda</span></center></b></hr>";
	}
	else{
		$orderNo    = 1;
		$orderTipo  = ' Desc ';
		$pager = new ADODB_Pager($db,$query,'adodb', true,$orderNo,$orderTipo);
		$pager->checkAll        = false;
		$pager->checkTitulo     = true;
		$pager->toRefLinks      = $linkPagina;
		$pager->toRefVars       = $encabezado;
		$pager->descCarpetasGen = (isset($descCarpetasGen))? $descCarpetasGen : null;
		$pager->descCarpetasPer = (isset($descCarpetasPer))? $descCarpetasPer : null;
		$pager->Render($rows_per_page=100,$linkPagina,'chkAnulados');
	}
}
?>
</form>
</body>
</html>
