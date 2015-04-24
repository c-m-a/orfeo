<?
session_start();
/**
  * Se añadio compatibilidad con variables globales en Off
  * @autor 201201 Correlibre.org
  *        Liliana G, Ricardo P, Jairo L
  * @licencia GNU/GPL V 3
  */
define('ADODB_ASSOC_CASE', 2);
$nomcarpeta=$_GET["carpeta"];
$tipo_carpt=$_GET["tipo_carpt"];
$adodb_next_page=$_GET["adodb_next_page"];
if($_GET["orderNo"]) $orderNo=$_GET["orderNo"];
if($_GET["orderTipo"]) $orderTipo=$_GET["orderTipo"];
if($_GET["busqRadicados"]) $busqRadicados=$_GET["busqRadicados"];
if($_GET["busq_radicados"]) $busq_radicados=$_GET["busq_radicados"];
if($_GET["depeBuscada"]) $depeBuscada=$_GET["depeBuscada"];
if($_GET["filtroSelect"]) $filtroSelec=$_GET["filtroSelec"];
if($_GET["checkValue"]) $checkValue=$_GET["checkValue"];
if($_GET["radicadosSel"]) $radicadosSel=$_GET["radicadosSel"];
foreach ($_POST as $key => $valor)   ${$key} = $valor;

$krd = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
$usua_doc = $_SESSION["usua_doc"];
$codusuario = $_SESSION["codusuario"];
$usua_nomb = $_SESSION['usua_nomb'];
$depe_nomb = $_SESSION['depe_nomb'];
$checkValue = $_POST['checkValue'];
$depe_codi_territorial = $_SESSION['depe_codi_territorial'];
$ruta_raiz 	= "..";
	// Variable para de vigencia del radicado
	$vigente = true;
?>
<html>
<head>
<title>Enviar Datos</title>
<link rel="stylesheet" href="../estilos/orfeo.css">
</head><style type="text/css">
<!--
.textoOpcion {  font-family: Arial, Helvetica, sans-serif; font-size: 8pt; color: #000000; text-decoration: underline}
-->
</style>

<body bgcolor="#FFFFFF" topmargin="0">
<?
	/*  RADICADOS SELECCIONADOS
	 *  @$setFiltroSelect  Contiene los valores digitados por el usuario separados por coma.
	 *  @$filtroSelect Si SetfiltoSelect contiene algun valor la siguiente rutina 
	 *  realiza el arreglo de la condificacion para la consulta a la base de datos y lo almacena en whereFiltro.
	 *  @$whereFiltro  Si filtroSelect trae valor la rutina del where para este filtro es almacenado aqui.
	 */
	$radicadosXAnular = "";
	include_once "$ruta_raiz/include/db/ConnectionHandler.php";
	$db = new ConnectionHandler("$ruta_raiz");
	//$db->conn->debug = true;
	if($checkValue) {
		$num = count($checkValue);
		$i = 0;
		while ($i < $num) {
			$estaRad   = false;
			$record_id = key($checkValue);
		  	$estaRad= false;
		  	// Si esta el radicado entonces verificar vigencia
			if ($estaRad) {
				// Si se encuentra vigente entonces no se puede anular
				if($vigente) {
					$arregloVigentes[] = $record_id;
				} else {
					$setFiltroSelect .= $record_id;
                                        $radicadosSel[] = $record_id;
					$radicadosXAnular .= "'" . $record_id . "'";
				}
			} else {
				$setFiltroSelect .= $record_id;
				$radicadosSel[] = $record_id;
			}
			
			if($i<=($num-2)) {
				if (!$vigente || !$estaRad) {
					$setFiltroSelect .= ",";
				}
				if ($estaRad && !empty($radicadosXAnular)) {
					$radicadosXAnular .= ",";
				}
			}
  			next($checkValue);
			$i++;
			// Inicializando los valores de comprobacion
			$estaRad = false;
			$vigente = true;
		}
		if ($radicadosSel) {
			$whereFiltro = " and b.radi_nume_radi in($setFiltroSelect)";
		}
	}
	// ystemDate = $db->conn->OffsetDate(0,$db->conn->sysTimeStamp);
	$systemDate = $db->conn->OffsetDate(0,$db->conn->sysTimeStamp);
	//echo "<hr>$systemDate <hr>";
	include('../config.php');
	include_once "$ruta_raiz/include/tx/Anulacion.php";
	include_once "$ruta_raiz/include/tx/Historico.php";
	// Se vuelve crear el objeto por que saca un error con el anterior 
	$db = new ConnectionHandler("$ruta_raiz");
	$Anulacion = new Anulacion($db);
	$observa = "Solicitud Anulacion.$observa";

	/* Sentencia para consultar en sancionados el estado en que se encuentra el radicado
	 * A = Anulado, V = Vigente, B = Estado temporal 
	 * Si el estado del radicado en sancionados es diferente de V puede realizar la sancion
	 */
	// Si por lo menos hay un radicado por anular
	if (!empty($radicadosSel[0])) {
		// $db->conn->debug = true;
		$radicados = $Anulacion->solAnulacion($radicadosSel,
						$dependencia,
						$usua_doc,
						$observa,
						$codusuario,
						$systemDate);
		$fecha_hoy =date("Y-m-d");
		$dateReplace = $db->conn->OffsetDate(0);
		//		$db->conn->SQLDate("Y-m-d","$fecha_hoy");
		$Historico = new Historico($db);
		/** 
		 * Funcion Insertar Historico 
		 * insertarHistorico($radicados,  
		 * 			$depeOrigen, 
		 *			$usCodOrigen,
		 *			$depeDestino,
		 *			$usCodDestino,
		 *			$observacion,
		 *			$tipoTx)
		 */
		
		//echo "<hr> $radicadosSel,$dependencia,$codusuario,$depe_codi_territorial,1,$observa,25";
		// $db->conn->debug = true;
		$radicados = $Historico->insertarHistorico($radicadosSel,
								$dependencia,
								$codusuario,
								$depe_codi_territorial,
								1,
								$observa,
								25); 
	}
	
?>
<table border="0"><TR><TD><p></p></TD></TR></table>
<table class='borde_tab' width=60% cellpadding="0" cellspacing="5">
  <form action='enviardatos.php<?=session_name()."=".session_id()."&krd=$krd" ?>' method=post name=formulario>
	<tr><td class="titulos4" colspan="3">ACCION REQUERIDA COMPLETADA</td></tr>
	<tr><td class="titulos2">ACCION REQUERIDA :</td>
	<td class="listado2"><span class=leidos>Solicitud de Anulacion de Radicados</span></td></tr>
	<tr><td class="titulos2">RADICADOS INVOLUCRADOS</td>
	<td class="listado2"><span class=leidos>
	<?
	if (!empty($radicados[0])) {
		foreach($radicados as $noRadicado) {
			echo "<br>$noRadicado";
		}
	}
	if (!empty($arregloVigentes[0]) && $arregloVigentes[0] != "") {
		echo '<p>
			<font color="red">
			Lista de Radicados que No se pueden Anular ya que se encuentran vigentes en sancionados
			</font>
			</p>';
		echo '<font color="red">';
		foreach ($arregloVigentes as $radicado) {
			echo "<br>$radicado";
		}
		echo '</font>';
	}
	?>
	</span></td></tr>
	<tr><td class="titulos2">USUARIO DESTINO :</td>
	<td class="listado2"><span class=leidos>Usuario Anulador</span></td></tr>
	<tr><td class="titulos2">FECHA Y HORA</span></td>
	<td class="listado2"><span class=leidos><?=date("d-m-Y h:i:s")?></span></td>
	</form>
	<TR>
		<TD width=30% class="titulos2">USUARIO ORIGEN</TD>
		<td class="listado2"><span class=leidos><?=$usua_nomb?></span></TD>
		<tr><td class="titulos2"> DEPENDENCIA ORIGEN</td>
		<td class="listado2"><span class=leidos><?=$depe_nomb?></span></TD>
		</TR>
	</table>
</body>
