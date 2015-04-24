<?php
$verradicado = $verrad;
$krdOld = $krd;
$menu_ver_tmpOld = $menu_ver_tmp;
$menu_ver_Old = $menu_ver;
foreach ($_GET as $key => $valor)   ${$key} = $valor;
foreach ($_POST as $key => $valor)   ${$key} = $valor;
$nomcarpeta=$_GET["nomcarpeta"];
if($_GET["tipo_carp"])  $tipo_carp = $_GET["tipo_carp"];

define('ADODB_ASSOC_CASE', 2);

$krd = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
$usua_doc = $_SESSION["usua_doc"];
$codusuario = $_SESSION["codusuario"];
$tip3Nombre=$_SESSION["tip3Nombre"];
$tip3desc = $_SESSION["tip3desc"];
$tip3img =$_SESSION["tip3img"];

session_start();
if(!$krd) $krd = $krdOld;
$ruta_raiz = "../..";

include_once "$ruta_raiz/include/db/ConnectionHandler.php";	

if($verradicado) 
	$verrad= $verradicado; 

if(!$ruta_raiz) 

	$ruta_raiz=".";

$numrad = $verrad;

error_reporting(7);

$db = new ConnectionHandler($ruta_raiz);

$db->conn->SetFetchMode(3);


include $ruta_raiz.'/ver_datosrad.php';

?>

<html>
<table cellpadding="0" cellspacing="0" align='<?=$alineacion?>'>
<tr>
<td width="60" rowspan="4">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;
</td>
<td  height="18" align='center'>
<font  face='Free 3 of 9 Extended'><font size=6><?php print '*'.$_REQUEST['nurad'].'*'; ?></font></font>
</td>
</tr>
<tr>
<td align='center'>
</td>
</tr>
<tr>
<td align="center"><font size="-2" face="Arial, Helvetica, sans-serif">Al responder por favor citese este numero</font><br>
<font type='Arial' size="2"><?php print $_REQUEST['nurad']; ?> </font>
</td>
<tr>
<td><font size="1">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fecha Radicado <?=date("d/m/Y H:i:s")?>
&nbsp;&nbsp;<font size="-2">Radicador:
<?=$krd?>
</font><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
Se recibe para verificacion, no implica aceptaci&oacute;n
</font></td>
</tr>
<!-- 
<tr>
<td>
<span class="txtStickerWeb">
Destino: <?php print $GLOBALS['depe_nomb']; ?>
Remitente: <?php print $GLOBALS['nombre']; ?>
</span>
</td>
</tr>-->
<tr>
</tr>
</table>
</html>
