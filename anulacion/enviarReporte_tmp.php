<html>
<head>
<title>Enviar Datos</title>
<link rel="stylesheet" href="../estilos_totales.css">

</head><style type="text/css">
<!--
.textoOpcion {  font-family: Arial, Helvetica, sans-serif; font-size: 8pt; color: #000000; text-decoration: underline}
-->
</style>

<body bgcolor="#FFFFFF" topmargin="0">
<?
/*  RADICADOS SELECCIONADOS
 *  @$setFiltroSelect  Contiene los valores digitados por el usuario separados por coma.
 *  @$filtroSelect Si SetfiltoSelect contiene algunvalor la siguiente rutina realiza el arreglo de la condición para la consulta a la base de datos y lo almacena en whereFiltro.
 *  @$whereFiltro  Si filtroSelect trae valor la rutina del where para este filtro es almacenado aqui.
 *  
 */
if($checkValue)
{
	$num = count($checkValue);
	echo "-->$num";
	$i = 0;
	while ($i < $num)
	{
	  $record_id = key($checkValue);
		$setFiltroSelect .= $record_id ;
		$radicadosSel[$i] = $record_id;
		echo $record_id;
		if($i<=($num-2))
		{
			$setFiltroSelect .= ",";
		}
  	next($checkValue);
	$i++;
	}
	if ($radicadosSel)
	{
		$whereFiltro = " and b.radi_nume_radi in($setFiltroSelect)";
	}
}
 print_r(array_values($radicadosSel));
 
	/**
		* Inclusion de archivos para utiizar la libreria ADODB 
		*
		*/
	error_reporting(E_ALL); # reporta todos los errores
	ini_set("display_errors", "1"); # pero no los muestra en la pantalla
	define('ADODB_ERROR_LOG_TYPE',3);
	//define('ADODB_ERROR_LOG_DEST','C:/errors.log');
	include('../adodb/adodb-errorpear.inc.php');
	include('../adodb/adodb.inc.php');
	include('../adodb/tohtml.inc.php');
	include_once('../adodb/adodb-paginacion.inc.php');
	include('../config.php');
	error_reporting(7);
	include_once "Anulacion.php";
	include_once "Historico.php";
	$db = ADONewConnection('oracle'); 
	$db->Connect($servidor, $usuario, $contrasena, $servicio);	
	error_reporting(7);
	$db->debug=true;
  $Historico = new Historico($db);
	/** Funcion Insertar Historico 
	 *
	 * ($radicados,  $depeOrigen, $depeDest, $usDocOrigen , $usDocDest, $usCodOrigen, $usCodDest, $observacion, $tipoTx)
	 *
	 */
	$radicados = $Historico->insertarHisorico( $radicadosSel,$dependencia,$depe_codi_territorial,$usua_doc,'',$codusuario,1,$observa,10);
	
?>
<table border=0 width=100% cellpadding="0" cellspacing="0">
  <tr ><td width=100%>
	 <br>
  <form action='enviardatos.php?PHPSESSID=172o16o0o154oJH&krd=JH' method=post name=formulario>

		<br>
	<span class="tituloListado">ACCION REQUERIDA COMPLETADA</span>
		<p>
	<span class="etextomenu">ACCION REQUERIDA :</span> 
	 <br> <font color=blue>Solicitud de Anulacion de Radicados</font>
	<p>
	<span class="etextomenu"><br>RADICADOS INVOLUCRADOS :</span><br>
				<font color=blue>
				<?
				foreach($radicados as $noRadicado)
				{
					echo "<br>$noRadicado";
				}
				?>
				</font>
				<p>
	<span class="etextomenu">USUARIO DESTINO :</span><p>
	<font color=blue> Usuario Anulador</font><p>
	<span class="etextomenu">FECHA Y HORA :</span><br>
	<font color=blue><?=date("d-m-Y h:i:s")?></font>
	<p>
	</form>
	</td>
	</tr>
</table>
<span class="etextomenu">ORIGEN :</span> 
		<table BORDER=0 WIDTH=98% cellspace=1 align="center" class="t_bordeGris">
	<TR>
		<TD width=30% class="grisCCCCCC"><span class='etextomenu'>USUARIO</span><br>

			<span class='etextou'><?=$usua_nomb?></span> </TD>
		<TD  width='30%' class="grisCCCCCC"><span class='etextomenu'> DEPENDENCIA</span><br>
				<span class=etextou><?=$depe_nomb?></span><br></TD>
		</TR>
	</table>
     &nbsp; </body>
</html>
