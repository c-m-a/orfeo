<?php
session_start();
foreach ($_GET as $key => $valor)   ${$key} = $valor;
foreach ($_POST as $key => $valor)   ${$key} = $valor;

$usCodSelect = (isset($_POST["usCodSelect"]))? $_POST["usCodSelect"] : null;
$krd = $_SESSION["krd"];

$dependencia = $_SESSION["dependencia"];
$depe_nomb = $_SESSION["depe_nomb"];
$usua_nomb = $_SESSION["usua_nomb"];
$usua_doc = $_SESSION["usua_doc"];
$codusuario = $_SESSION["codusuario"];

$ruta_raiz = '..';
/*  REALIZAR TRANSACCIONES
 *  Este archivo realiza las transacciones de radicados en Orfeo.
 */
?>
<html>
<head>
<title>Realizar Transaccion - Orfeo </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../estilos/orfeo.css">
</head>
<?
/**
  * Inclusion de archivos para utiizar la libreria ADODB
  *
  */
   include_once $ruta_raiz . '/include/db/ConnectionHandler.php';
   $db = new ConnectionHandler($ruta_raiz);
 
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

/*  FILTRO DE DATOS
 *  @$setFiltroSelect  Contiene los valores digitados por el usuario separados por coma.
 *  @$filtroSelect Si SetfiltoSelect contiene algunvalor la siguiente rutina realiza el arreglo de la condici� para la consulta a la base de datos y lo almacena en whereFiltro.
 *  @$whereFiltro  Si filtroSelect trae valor la rutina del where para este filtro es almacenado aqui.
 *
 */
if($checkValue) {
	$num = count($checkValue);
	$i = 0;
	while ($i < $num) {
		$record_id = key($checkValue);
		$setFiltroSelect .= $record_id ;
		$radicadosSel[] = $record_id;
		
    if($i<=($num-2)) 
			$setFiltroSelect .= ',';
  	
    next($checkValue);
    $i++;
	}
	if ($radicadosSel) 
		$whereFiltro = " and b.radi_nume_radi in($setFiltroSelect)";
}

if($setFiltroSelect) 
  $filtroSelect = $setFiltroSelect;
?>
<body>
<?php
  $txSql = '';
  $tomarNivel = ($chkNivel and $codusuario==1)? 'si' : 'no';

include $ruta_raiz . '/include/tx/Tx.php';
$rs = new Tx($db);

foreach($radicadosSel as $rad){				
	$radicadosSelText .= $rad. ", ";
	$rutaImagen = substr($rad,0,4)."/".substr($rad,4,3)."/".$rad.".tif";
	$linkImagenes .= "<a href='*SERVIDOR_IMAGEN*".$rutaImagen."'>$rad</a> - ";
}
//include("$ruta_raiz/class_control/Param_admin.php"); 
//$param=Param_admin::getObject($db,'%','ALERT_FUNCTION');
switch ($codTx) {
	case 7:
		$nombTx = "Borrar Informados";
		$observa = "($krd) $observa";
		$radicadosSel = $rs->borrarInformado($radicadosSel,
                                          $krd,
                                          $depsel8,
                                          $_SESSION['dependencia'],
                                          $_SESSION['codusuario'],
                                          $codusuario,
                                          $observa);
		break;
	case 8:
			if (is_array($_POST['usCodSelect']))
			while (list(,$var)=each($_POST['usCodSelect'])) {
        $depsel8 = split('-',$var);
				$usCodSelect = $depsel8[1];
				$depsel8 = $depsel8[0];
				$nombTx = "Informar Documentos";
				$usCodDestino .= $rs->informar($radicadosSel,
                                        $krd,
                                        $depsel8,
                                        $dependencia,
                                        $usCodSelect,
                                        $codusuario,
                                        $observa,
                                        $_SESSION['usua_doc']).", ";
			}
			$usCodDestino = substr($usCodDestino,0,strlen(trim($usCodDestino))-1);
		break;
	case 9:
		$depsel = split('-',$usCodSelect);
		$usCodSelect = $depsel[1];
		$depsel = $depsel[0];
		if($EnviaraV=="VoBo") {
			$codTx = 16;
			$carp_codi = 11;
		}else{
			$codTx = 9;
			$carp_codi = 0;
		}
		$nombTx = 'Reasignar Documentos ';
		$usCodDestino = $rs->reasignar($radicadosSel,
                                    $krd,
                                    $depsel,
                                    $dependencia,
                                    $usCodSelect,
                                    $codusuario,
                                    $tomarNivel,
                                    $observa,
                                    $codTx,
                                    $carp_codi);
		/*$nombTx = "Reasignar Documentos ";
		$depsel = split('-',$_GET['usCodSelect']);
		$usCodSelect = $depsel[1];
		$depsel = $depsel[0];
		$usCodDestino = $rs->reasignar( $radicadosSel, $krd,$depsel,$dependencia,$usCodSelect, $codusuario,$tomarNivel, $observa,$codTx,$carp_codi);*/
		break;
	case 10:
		$nombTx = "Movimiento a Carpeta $carpetaNombre";
		$okTx = $rs->cambioCarpeta($radicadosSel,
                                $krd,
                                $carpetaCodigo,
                                $carpetaTipo,
                                $tomarNivel,
                                $observa);
		$depSel = $dependencia;
		$usCodSelect = $codusuario;
		$usCodDestino = $usua_nomb;

		break;
	case 12:
    $depsel = split('-',$usCodSelect);
    $usCodSelect = $depsel[1];
    $depsel = $depsel[0];
		$nombTx = "Devolucion de Documentos";
    $carp_codi = 12;
		//$usCodDestino = $rs->devolver( $radicadosSel, $krd,$dependencia, $codusuario,$tomarNivel, $observa);
    $usCodDestino = $rs->reasignar($radicadosSel,
                                    $krd,
                                    $depsel,
                                    $dependencia,
                                    $usCodSelect,
                                    $codusuario,
                                    $tomarNivel,
                                    $observa,
                                    $codTx,
                                    $carp_codi);
		break;
	case 13:
		$nombTx = "Archivo de Documentos";
		$txSql = $rs->archivar($radicadosSel,
                            $krd,
                            $dependencia,
                            $codusuario,
                            $observa);
		break;
	case 14:
		$nombTx = "Agendar Documentos";
		$txSql = $rs->agendar($radicadosSel,
                          $krd,
                          $dependencia,
                          $codusuario,
                          $observa,
                          $fechaAgenda);
		break;
	case 15:
		$nombTx = "Sacar de 'Agendar Documentos'";
		$txSql = $rs->noAgendar($radicadosSel,
                            $krd,
                            $dependencia,
                            $codusuario,
                            $observa);
		break;
	case 16:
		$nombTx = "Radicados NRR";
		$txSql = $rs->nrr($radicadosSel,
                      $krd,
                      $dependencia,
                      $codusuario,
                      $observa);
		break;
}
if($okTx== -1)  $okTxDesc = " No ";

/*if($txSql and codTx != 12 and  $txSql and codTx != 13) {
	include "$ruta_raiz/include/tx/Historico.php";
	$hist = new Historico($db);
  var_dump($hist);
	$hist->insertarHistorico($radicadosSel,  $dependencia , $codusuario, $depsel, $usCodSelect, $observa, $codTx);
}*/

//  IMPRESION DE RESULTADOS DE LA Transaccion
?>
<form action='enviardatos.php?PHPSESSID=172o16o0o154oJH&krd=JH' method=post name=formulario>
<br>
<center>
<table border=0 cellspace=2 cellpad=2 WIDTH=50%  class="t_bordeGris" id=tb_general align="left">
	<tr>
	<td colspan="2" class="titulos4"><center>ACCION REQUERIDA <?=$accionCompletada?>  <?=$okTxDesc?> COMPLETADA <?=$causaAccion ?></center></td>
	</tr>
	<tr>
	<td align="right" bgcolor="#CCCCCC" height="25" class="titulos2">ACCION REQUERIDA :
	</td>
	<td  width="65%" height="25" class="listado2_no_identa">
	<?=$nombTx?>
	</td>
	</tr>
	<tr>
	<td align="right" bgcolor="#CCCCCC" height="25" class="titulos2">RADICADOS INVOLUCRADOS :
	</td>
	<td  width="65%" height="25" class="listado2_no_identa"><?=join("<BR> ",$radicadosSel)?>
	</td>
	</tr>
	<tr>
	<td align="right" bgcolor="#CCCCCC" height="25" class="titulos2">USUARIO DESTINO :
	</td>
	<td  width="65%" height="25" class="listado2_no_identa">
	<?=$usCodDestino?>
	</td>
	</tr>
	<tr>
	<td align="right" bgcolor="#CCCCCC" height="25" class="titulos2">FECHA Y HORA :
	</td>
	<td  width="65%" height="25" class="listado2_no_identa">
	<?=date("m-d-Y  H:i:s")?>
	</td>
	</tr>
	<tr>
	<td align="right" bgcolor="#CCCCCC" height="25" class="titulos2">USUARIO ORIGEN:
	</td>
	<td  width="65%" height="25" class="listado2_no_identa">
	<?=$usua_nomb?>
	</td>
	</tr>
	<tr>
	<td align="right" bgcolor="#CCCCCC" height="25" class="titulos2">DEPENDENCIA ORIGEN:
	</td>
	<td  width="65%" height="25" class="listado2_no_identa">
	<?=$depe_nomb?>
	</td>
	</tr>
<?php
  // apagado de correo por problemas con el servidor SMTP
  $_SESSION["enviarMailMovimientos"] = 0;
  if($_SESSION["enviarMailMovimientos"]==1) {
    if($codTx==9 || $codTx==8){
      if (is_array($_POST['usCodSelect'])) { 
        foreach($_POST['usCodSelect'] as $value) {
          $depsel8 = split('-',$value);
          $usuaCodiMail = $depsel8[1];
          $depeCodiMail = $depsel8[0];
          include "../include/mail/mailInformar.php";
        }
      } else {
        $depsel8 = split('-',$_POST['usCodSelect']);
        $usuaCodiMail = $depsel8[1];
        $depeCodiMail = $depsel8[0];
        include "../include/mail/mailInformar.php";
      }
    }
  }
?>
</table>
</form>
</body>
</html>
