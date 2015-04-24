<?

session_start();

$verradOld=$verrad;

$ruta_raiz = "..";

require_once("$ruta_raiz/include/db/ConnectionHandler.php");
include_once "$ruta_raiz/include/tx/Historico.php";
include_once ("$ruta_raiz/class_control/TipoDocumental.php");


if (!$db)
	$db = new ConnectionHandler($ruta_raiz);

$db->conn->BeginTrans();

$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);	

if (!$krd or !$dependencia)   
	include "$ruta_raiz/rec_session.php";

if (!$krd or !$dependencia or !$usua_doc)   include "$ruta_raiz/rec_session.php";
$verrad =$verradOld;


?>
<html>
<head>
<title>Enviar Datos</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

</head>
<link rel="stylesheet" href="<?=$ruta_raiz?>/estilos/orfeo.css">

<style type="text/css">
<!--
.textoOpcion {  font-family: Arial, Helvetica, sans-serif; font-size: 8pt; color: #000000; text-decoration: underline}
-->
</style>
<body bgcolor="#FFFFFF" topmargin="0">

<?

$fecha_hoy = Date("Y-m-d");
$sqlFechaHoy = $db->conn->OffsetDate(0, $db->conn->sysTimeStamp);

$values["NIT_DE_LA_EMPRESA"] = $nit;
$values["QYD_FECHA"] = $sqlFechaHoy;
$values["RADI_NUME_RADI"] = $verrad;
$quejas = $_GET['quejas'];

if(isset($quejas))
{
	$queja = split(',', $quejas);
	for ($i = 0; $i < sizeof($queja); $i ++)
	{
		/*
		$sql = "INSERT INTO SES_QUEJAYDERECHO_CTA (NIT_DE_LA_EMPRESA, QYD_FECHA, SGD_TPR_CODIGO, RADI_NUME_RADI, QYD_ANO, QYD_TRIMESTRE)
  				VALUES ($nit, $sqlFechaHoy, $queja[$i], $verrad, $ano, $trimestre)";

		$rs = $db->conn->Execute($sql);
		*/
		$values["SGD_TPR_CODIGO"] = $queja[$i];
		
		$rs = $db->insert("SES_QUEJAYDERECHO", $values);
		
		if (!$rs)
		{
			$db->conn->RollbackTrans();
			die ("<span class='alarmas'>No se ha podido actualizar la información de Quejas y Derechos de Petici&oacute;n"); 	
		}
	}

$values2["depe_codi"] = $dependencia;
$values2["hist_fech"] = " $sqlFechaHoy ";
$values2["usua_codi"] = $codusuario;
$values2["radi_nume_radi"]=$verrad;
$values2["hist_obse"] = "'Incluir a bases de datos de quejas y derechos de peticion '";
$values2["usua_codi_dest"] = $codusuario;
$values2["usua_doc"] = $usua_doc;
//La  transacción 35 es la tipificación de la transacción
$values2["SGD_TTR_CODIGO"] = 201;
$rs=$db->insert("hist_eventos",$values2);
	
if (!$rs)
{
			 	$db->conn->RollbackTrans();
		 	 	die ("<span class='alarmas'>ERROR TRATANDO DE ESCRIBIR EL HISTORICO");
}
else
{
//	echo("historico");
}
}
$db->conn->CommitTrans();
?>
<form action='enviardatos.php?PHPSESSID=172o16o0o154oJH&krd=JH' method=post name=formulario>
<br>
<table border=0 cellspace=2 cellpad=2 WIDTH=50%  class="t_bordeGris" id=tb_general align="left">
	<tr>
	<td colspan="2" class="titulos4">ACCION REQUERIDA </td>
	</tr>
	<tr>
	<td align="right" bgcolor="#CCCCCC" height="25" class="titulos2">ACCION REQUERIDA :
	</td>
	<td  width="65%" height="25" class="listado2_no_identa">
	BASE DE DATOS QUEJAS Y DERECHOS DE PETICI&Oacute;N
	</td>
	</tr>
	<tr>
	<td align="right" bgcolor="#CCCCCC" height="25" class="titulos2">RADICADOS INVOLUCRADOS :
	</td>
	<td  width="65%" height="25" class="listado2_no_identa"><?=$verrad ?>
	</td>
	</tr>
	<tr>
	<td align="right" bgcolor="#CCCCCC" height="25" class="titulos2">USUARIO :
	</td>
	<td  width="65%" height="25" class="listado2_no_identa">
	<?=$usua_nomb?>
	</td>
	</tr>
	<tr>
	<td align="right" bgcolor="#CCCCCC" height="25" class="titulos2">FECHA Y HORA :
	</td>
	<td  width="65%" height="25" class="listado2_no_identa">
	<?=$fecha_hoy?>
	</td>
	</tr>
<tr><td colspan="2" align="center">
<BR>
<input name='cancelar' type='button'  class='botones' id='envia22'  onClick='window.close()' value='Cerrar'>
<br>

</td></tr>

	</table>
	<BR>
</form>
</body>
</html>