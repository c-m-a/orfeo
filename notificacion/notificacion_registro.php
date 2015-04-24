<?
/*************************************************************************************/
/* ORFEO GPL:Sistema de Gestion Documental		http://www.orfeogpl.org	     */
/*	Idea Original de la SUPERINTENDENCIA DE SERVICIOS PUBLICOS DOMICILIARIOS     */
/*				COLOMBIA TEL. (57) (1) 6913005  orfeogpl@gmail.com   */
/* ===========================                                                       */
/*                                                                                   */
/* Este programa es software libre. usted puede redistribuirlo y/o modificarlo       */
/* bajo los terminos de la licencia GNU General Public publicada por                 */
/* la "Free Software Foundation"; Licencia version 2. 			             */
/*                                                                                   */
/* Copyright (c) 2005 por :	  	  	                                     */
/* SSPS "Superintendencia de Servicios Publicos Domiciliarios"                       */
/*   Jairo Hernan Losada  jlosada@gmail.com                Desarrollador             */
/*   Sixto Angel Pinzón López --- angel.pinzon@gmail.com   Desarrollador             */
/* C.R.A.  "COMISION DE REGULACION DE AGUAS Y SANEAMIENTO AMBIENTAL"                 */ 
/*   Liliana Gomez        lgomezv@gmail.com                Desarrolladora            */
/*   Lucia Ojeda          lojedaster@gmail.com             Desarrolladora            */
/* D.N.P. "Departamento Nacional de Planeación"                                      */
/*   Hollman Ladino       hladino@gmail.com                Desarrollador             */
/*                                                                                   */
/* Colocar desde esta lInea las Modificaciones Realizadas Luego de la Version 3.5    */
/*  Nombre Desarrollador   Correo     Fecha   Modificacion                           */
/*************************************************************************************/
?>
<?
$verradOld=$verrad;
session_start();
if (!$ruta_raiz) $ruta_raiz = "..";
include "$ruta_raiz/rec_session.php";
require_once("$ruta_raiz/include/db/ConnectionHandler.php");
require_once("$ruta_raiz/class_control/Notificacion.php");


if (!$db)
		$db = new ConnectionHandler($ruta_raiz);
$db->conn->BeginTrans();
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);	
$objNotific = & new Notificacion($db);
//$db->conn->debug=true;
if (!$krd or !$dependencia)   include "$ruta_raiz/rec_session.php";
$verrad =$verradOld;

?>
<html>
<head>
<title>Enviar Datos</title>
<link rel="stylesheet" href="<?=$ruta_raiz?>/estilos/orfeo.css">
</head>
<style type="text/css">
<!--
.textoOpcion {  font-family: Arial, Helvetica, sans-serif; font-size: 8pt; color: #000000; text-decoration: underline}
-->
</style>
<body bgcolor="#FFFFFF" topmargin="0">

<?
//$db->conn->debug=true;


// Programa que actualiza los datos de notificaci�n para un radicado
if  (count($recordSet)>0)
	array_splice($recordSet, 0);  		
if  (count($recordWhere)>0)
	array_splice($recordWhere, 0);
$fecha_hoy = Date("Y-m-d");
$sqlFechaHoy=$db->conn->OffsetDate(0,$db->conn->sysTimeStamp);

if (strlen(trim($fecha_not)))
	$sqlFechaNotif=$db->conn->DBDate($fecha_not); 
else 
	$sqlFechaNotif = "null";

if (strlen(trim($fecha_fij)))
	$sqlFechaFija=$db->conn->DBDate($fecha_fij);  
else 
	$sqlFechaFija="null";

if (strlen(trim($fecha_desfij)))
	$sqlFechaDesfi=$db->conn->DBDate($fecha_desfij);  
else 
	$sqlFechaDesfi="null";

if (!strlen(trim($edicto)))
	$edicto = "null";

$sqlExiste="select * from SGD_NTRD_NOTIFRAD where radi_nume_radi = $verrad";
$rs=$db->query($sqlExiste);
$values["sgd_not_codi"] = $notif;
$values["SGD_NTRD_FECHA_NOT"] = "$sqlFechaNotif";
$values["SGD_NTRD_FECHA_FIJA"] = "$sqlFechaFija"; 
$values["SGD_NTRD_FECHA_DESFIJA"] = "$sqlFechaDesfi"; 
$values["SGD_NTRD_NOTIFICADOR"] = "'$notificador'"; 
$values["SGD_NTRD_NOTIFICADO"] = "'$notificado'"; 
$values["SGD_NTRD_OBSERVACIONES"] = "'$observaciones'"; 

$values["SGD_NTRD_NUM_EDICTO"] = $edicto; 
$swInsertado = false;
//No se ha insertado notificaci�n todavia
if (!$rs || $rs->EOF){
	$swInsertado = true;
	
	$values["radi_nume_radi"] = $verrad;
	$rs=$db->insert("SGD_NTRD_NOTIFRAD",$values);
	
	if (!$rs){
		$db->conn->RollbackTrans();
		die ("<span class='alarmas'>ERROR TRATANDO DE INSERTAR EL REGISTRO DE NOTIFICACION </span>");
	}
}else{
	$recordWhere["radi_nume_radi"] = $verrad;
	$rs=$db->update("SGD_NTRD_NOTIFRAD", $values, $recordWhere);
	if (!$rs)
		die ("<span class='alarmas'>ERROR NO SE HA PODIDO ACTUALIZAR LA INFORMACI�N DE NOTIFICACI�N ");
}

if ($swInsertado==true){
	//Busca su existe alg�n tipo de desicion que aplique para el tipo de documento luego de actualizar notificacion
	$sql = "select * from SGD_TDEC_TIPODECISION where SGD_APLI_CODI=1 and SGD_TDEC_UPDNOTIF=1";
	$rs=$db->query($sql);
	if (count($recordWhere)>0)
		array_splice($recordWhere, 0); 

	if (count($values)>0)
		array_splice($values, 0); 
	if ($rs && !$rs->EOF){
		
		$codDecision =$rs->fields['SGD_TDEC_CODIGO'];
		$values["SGD_TDEC_CODIGO"] = $codDecision;
		$recordWhere["radi_nume_radi"] = $verrad;
		$rs=$db->update("radicado", $values, $recordWhere);
	
		if (!$rs){
			$db->conn->RollbackTrans();
			die ("<span class='alarmas'>No se ha podido actualizar la decision de notificacion en el radicado</span>"); 
		}
		array_splice($values, 0); 
		array_splice($recordWhere, 0); 
	}
}



$objNotific->notificacion_codigo($notif);
$notifDesc = $objNotific->get_sgd_not_descrip();
$values3["depe_codi"] = $dependencia;
$values3["hist_fech"] = " $sqlFechaHoy ";
$values3["usua_codi"] = $codusuario;
$values3["radi_nume_radi"]=$verrad;
$values3["hist_obse"] = "'CAMBIO DE NOTIFICACION A $notifDesc '";
$values3["usua_codi_dest"] = $codusuario;
$values3["usua_doc"] = $usua_doc;
$values3["sgd_ttr_codigo"] = 36;

$rs=$db->insert("hist_eventos",$values3);
	
if (!$rs){
			 	$db->conn->RollbackTrans();
		 	 	die ("<span class='etextomenu'>ERROR TRATANDO DE ESCRIBIR EL HISTORICO </span>");
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
	MODIFICACION DE LOS DATOS DE NOTIFICACION
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
	</table>
	<BR>
<input name='cancelar' type='button'  class='botones' id='envia22'  onClick='history.go(-1)' value='ACEPTAR'>
</form>

</body>
</html>
