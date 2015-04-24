<?php
  // Modificado SGD 20-Septiembre-2007
  /**
   * Pagina Cuerpo.php que muestra el contenido de las Carpetas
   * Creado en la SSPD en el año 2003
   * 
   * Se añadio compatibilidad con variables globales en Off
   * @autor Jairo Losada 2009-05
   * @licencia GNU/GPL V 3
   */
  include('./config.php');
  
  session_start();
  
  foreach ($_GET as $key => $valor)
    ${$key} = $valor;
  foreach ($_POST as $key => $valor)
    ${$key} = $valor;
  
  $nomcarpeta = (isset($_GET["nomcarpeta"])) ? $_GET["nomcarpeta"] : null;
  $tipo_carp  = (isset($_GET["tipo_carp"])) ? $_GET["tipo_carp"] : null;
  
  define('ADODB_ASSOC_CASE', 2);
  
  $krd         = $_SESSION["krd"];
  $dependencia = $_SESSION["dependencia"];
  $usua_doc    = $_SESSION["usua_doc"];
  $codusuario  = $_SESSION["codusuario"];
  $tip3Nombre  = $_SESSION["tip3Nombre"];
  $tip3desc    = $_SESSION["tip3desc"];
  $tip3img     = $_SESSION["tip3img"];
  $ruta_raiz   = '.';
  $verrad      = '';
?>
<html>
  <head>
    <link rel="stylesheet" href="estilos/orfeo.css">
    <script src="js/popcalendar.js"></script>
    <script src="js/mensajeria.js"></script>
    <div id="spiffycalendar" class="text"></div>
  </head>
<?php
  include('./envios/paEncabeza.php');
?>
<body bgcolor="#FFFFFF" topmargin="0" onLoad="window_onload();">
<?php
  include_once ('./include/db/ConnectionHandler.php');
  require_once ('./class_control/Mensaje.php');
  
  if (!$db)
    $db = new ConnectionHandler($ruta_raiz);

  $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
  $objMensaje = new Mensaje($db);
  $mesajes    = $objMensaje->getMsgsUsr($_SESSION['usua_doc'], $_SESSION['dependencia']);
  
  if ($swLog == 1)
    echo ($mesajes);
  
  if (trim($orderTipo) == '')
    $orderTipo = 'DESC';
  
  if ($orden_cambio == 1)
    $orderTipo = (trim($orderTipo) != 'DESC')? 'DESC' : 'ASC';
  
  if (!$carpeta)
    $carpeta = 0;
  
  if ($busqRadicados) {
    $busqRadicados = trim($busqRadicados);
    $textElements  = split(',', $busqRadicados);
    $newText       = '';
    $dep_sel       = $dependencia;
    
    foreach ($textElements as $item) {
      $item = trim($item);
      if (strlen($item) != 0)
        $busqRadicadosTmp .= " b.radi_nume_radi like '%$item%' or";
    }
    
    if (substr($busqRadicadosTmp, -2) == "or")
      $busqRadicadosTmp = substr($busqRadicadosTmp, 0, strlen($busqRadicadosTmp) - 2);
    
    if (trim($busqRadicadosTmp))
      $whereFiltro .= "and ( $busqRadicadosTmp ) ";
	}

  $encabezado = session_name() . '=' . session_id() .
                  '&depeBuscada=' . $depeBuscada .
                  '&filtroSelect=' . $filtroSelect .
                  '&tpAnulacion=' . $tpAnulacion .
                  '&carpeta=' . $carpeta .
                  '&tipo_carp=' . $tipo_carp .
                  '&chkCarpeta=' . $chkCarpeta .
                  '&busqRadicados=' . $busqRadicados .
                  '&nomcarpeta=' . $nomcarpeta .
                  '&agendado=' . $agendado .
                  '&';
   
   $linkPagina = "$PHP_SELF?$encabezado&orderTipo=$orderTipo&orderNo=$orderNo";
   $encabezado = session_name() . '=' . session_id() .
                  '&adodb_next_page=1' .
                  '&depeBuscada=' . $depeBuscada .
                  '&filtroSelect=' . $filtroSelect .
                  '&tpAnulacion=' . $tpAnulacion .
                  '&carpeta=' . $carpeta .
                  '&tipo_carp=' . $tipo_carp .
                  '&nomcarpeta=' . $nomcarpeta .
                  '&agendado=' . $agendado .
                  '&orderTipo=' . $orderTipo .
                  '&orderNo=';
    $accion = $_SERVER['PHP_SELF'] . '?' . $encabezado;
?>
<table width="100%" align="center" cellspacing="0" cellpadding="0" class="borde_tab">
<tr class="tablas">
	<td>
	<span class="etextomenu">
	<form name="form_busq_rad" id="form_busq_rad" action="<?=$accion?>" method='POST'>
	  Buscar radicado(s) (Separados por coma)
    <span class="etextomenu">
	   	<input name="busqRadicados" type="text" size="40" class="tex_area" value="<?= $busqRadicados ?>">
	    <input type=submit value='Buscar ' name=Buscar valign='middle' class='botones'>
    </span>
<?php
  /**
   * Este if verifica si se debe buscar en los radicados de todas las carpetas.
   * @$chkCarpeta char  Variable que indica si se busca en todas las carpetas.
   *
   */

  $chkValue     = ($chkCarpeta)? ' checked ' : ' ';
  $whereCarpeta = ($chkCarpeta)? ' ' : " and b.carp_codi=$carpeta ";
  
  if (!$tipo_carp)
    $tipo_carp = 0;
  
  $whereCarpeta = $whereCarpeta . " and b.carp_per=$tipo_carp ";
  $fecha_hoy    = Date("Y-m-d");
  $sqlFechaHoy  = $db->conn->DBDate($fecha_hoy);
  
  //Filtra el query para documentos agendados
  /*$sqlAgendado = ($agendado == 1)?
                  " and (radi_agend=1 and radi_fech_agend > $sqlFechaHoy) " : // No vencidos
                  " and (radi_agend=1 and radi_fech_agend <= $sqlFechaHoy) "; // vencidos
  */
  if ($agendado == AGENDADOS_NO_VENCIDOS) {
    $sqlAgendado = " and (radi_agend=1 and radi_fech_agend > $sqlFechaHoy) "; // No vencidos
  } else if ($agendado == AGENDADOS_VENCIDOS) {
    $sqlAgendado = " and (radi_agend=1 and radi_fech_agend <= $sqlFechaHoy)  "; // vencidos
  }
  
  if ($agendado) {
    $colAgendado  = "," . $db->conn->SQLDate("Y-m-d H:i A", "b.RADI_FECH_AGEND") . ' as "Fecha Agendado"';
    $whereCarpeta = '';
  }
  
  //Filtra teniendo en cuenta que se trate de la carpeta Vb.
  $whereUsuario = ($carpeta == 11 && $codusuario != 1 && $_GET['tipo_carp'] != 1)?
                      " and  (b.radi_usu_ante ='$krd' OR (b.radi_usua_actu=$codusuario and b.radi_depe_actu=$dependencia))" :
                      " and b.radi_usua_actu='$codusuario' ";

  $enlace_envio = './tx/formEnvio.php?' . $encabezado;
?>
   <input type="checkbox" name="chkCarpeta" value="xxx" <?= $chkValue ?> >
   Todas las carpetas
	</form>
	</span>
			</td>
		  </tr>
	 </table>
<form name="form1" id="form1" action="<?=$enlace_envio?>" method="GET">
<?php
  $controlAgenda = 1;
  $validacion = $carpeta == CARPETA_VOBO and !$tipo_carp and $codusuario != 1;
  
  include('./tx/txOrfeo.php');

  /*  GENERACION LISTADO DE RADICADOS
   *  Aqui utilizamos la clase adodb para generar el listado de los radicados
   *  Esta clase cuenta con una adaptacion a las clases utiilzadas de orfeo.
   *  el archivo original es adodb-pager.inc.php la modificada es adodb-paginacion.inc.php
   */
  
  if (strlen($orderNo) == 0) {
    $orderNo = "2";
    $order   = 3;
  } else {
    $order = $orderNo + 1;
  }
  
  $sqlFecha   = $db->conn->SQLDate("Y-m-d H:i A", "b.RADI_FECH_RADI");
  
  $numero_max = ($dependencia == 999) ? ' rownum <= 50 AND ' : ' ';
  include ('./include/query/queryCuerpo.php');
  
  // Se limita al numero de filas ya que el usuario de archivo tiene demasiados radicados
  $rs = $db->conn->Execute($isql);
  
  if ($rs->EOF and $busqRadicados) {
    echo "<hr><center><b><span class='alarmas'>No se encuentra ningun radicado con el criterio de busqueda</span></center></b></hr>";
  } else {
    $pager                  = new ADODB_Pager($db, $isql, 'adodb', true, $orderNo, $orderTipo);
    $pager->checkAll        = false;
    $pager->checkTitulo     = true;
    $pager->toRefLinks      = $linkPagina;
    $pager->toRefVars       = $encabezado;
    $pager->descCarpetasGen = $descCarpetasGen;
    $pager->descCarpetasPer = $descCarpetasPer;
    
    if ($_GET["adodb_next_page"])
      $pager->curr_page = $_GET["adodb_next_page"];
    
    $html_rs = $pager->Render($rows_per_page = 60, $linkPagina, $checkbox = chkAnulados, false);
  }
?>
<?=$html_rs?>
          </form>
        </tr>
      </td>
    </table>
  </body>
</html>
