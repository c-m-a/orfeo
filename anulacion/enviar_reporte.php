<?
echo "<hr>ssssss";
session_start();
  $ruta_raiz = ".."; 
    if (!$_SESSION['dependencia'])
        header ("Location: $ruta_raiz/cerrar_session.php");
// Modificado 2010 aurigadl@gmail.com
/**
* Paggina Cuerpo.php que muestra el contenido de las Carpetas
* Creado en la SSPD en el año 2003
* Se añadio compatibilidad con variables globales en Off
* @autor Jairo Losada 2009-05
* @licencia GNU/GPL V 3
*/
foreach ($_GET as $key => $valor)   ${$key} = $valor;
foreach ($_POST as $key => $valor)   ${$key} = $valor;

$nomcarpeta     =$_GET["nomcarpeta"];
if($_GET["tipo_carp"])  $tipo_carp = $_GET["tipo_carp"];

define('ADODB_ASSOC_CASE', 2);

$verrad         = "";

$krd            = $_SESSION["krd"];
$dependencia    = $_SESSION["dependencia"];
$usua_doc       = $_SESSION["usua_doc"];
$codusuario     = $_SESSION["codusuario"];

?>
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
<?
/*  RADICADOS SELECCIONADOS
 *  @$setFiltroSelect  Contiene los valores digitados por el usuario separados por coma.
 *  @$filtroSelect Si SetfiltoSelect contiene algunvalor la siguiente rutina realiza el arreglo de la condición para la consulta a la base de datos y lo almacena en whereFiltro.
 *  @$whereFiltro  Si filtroSelect trae valor la rutina del where para este filtro es almacenado aqui.
 *  
 */
 include_once "$ruta_raiz/include/db/ConnectionHandler.php";
 require_once("$ruta_raiz/class_control/ControlAplIntegrada.php");
 include('../config.php');
 $db = new ConnectionHandler("$ruta_raiz");	
 //$db->conn->debug=true;
 $db->conn->BeginTrans();
 $objCtrlAplInt = new ControlAplIntegrada($db); 
 var_dump($checkValue);
if($checkValue)
{
	$num = count($checkValue);
	$i = 0;
	while ($i < $num)
	{
	  $record_id = key($checkValue);
		$setFiltroSelect .= $record_id ;
		$radicadosSel[$i] = $record_id;
		
		$campos["P_RAD_E"]=$record_id;
		$estQueryAdd=$objCtrlAplInt->queryAdds($record_id,$campos,$MODULO_ANULACION);
		if ($estQueryAdd==0){
				$db->conn->RollbackTrans();
		    	die;
		}
		

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
	echo "<hr>$whereFiltro<hr>";
}
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
				<font color=blue>20049000000812</font>
				<p>
	<span class="etextomenu">USUARIO DESTINO :</span><p>
	<font color=blue>
	JAIRO PRUEBAS </font><p>
	<span class="etextomenu">FECHA Y HORA :</span><br>
	<font color=blue>2004-10-07  14:10:38</font>
	<p>
	</form>
	</td>
	</tr>
</table>
<span class="etextomenu">ORIGEN :</span> 
		<table BORDER=0 WIDTH=98% cellspace=1 align="center" class="t_bordeGris">
	<TR>
		<TD width=30% class="grisCCCCCC"><span class='etextomenu'>USUARIO</span><br>

			<span class='etextou'>JH</span> </TD>
		<TD  width='30%' class="grisCCCCCC"><span class='etextomenu'> DEPENDENCIA</span><br>
				<span class=etextou>Z DEP PRUEBA JH2</span><br></TD>
		</TR>
	</table>
     &nbsp; </body>
</html>
