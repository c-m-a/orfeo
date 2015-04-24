<?
$krdOld = $krd;
$carpetaOld = $carpeta;
$tipoCarpOld = $tipo_carp;
session_start();
if(!$krd) $krd=$krdOsld;
$ruta_raiz = "..";
if(!$dependencia or !$tpDepeRad) include "$ruta_raiz/rec_session.php";
$krdOld = $krd;
$carpetaOld = $carpeta;
$tipoCarpOld = $tipo_carp;
session_start();
if(!$krd) $krd=$krdOsld;
$ruta_raiz = "..";
if(!$dependencia or !$tpDepeRad) include "$ruta_raiz/rec_session.php";
if(!$carpeta) 
{
 $carpeta = $carpetaOld;
 $tipo_carp = $tipoCarpOld;
}
$verrad = "";
include_once "$ruta_raiz/include/db/ConnectionHandler.php";
$db = new ConnectionHandler($ruta_raiz);	 
?>
<html>
<head>
<title>:: Confirmacion de radicado ::</title>
<link rel="stylesheet" href="../estilos_totales.css">
<link rel="stylesheet" href="../estilos/orfeo.css">
</head>

<body bgcolor="#FFFFFF" text="#000000">
<?
  $var_envio=session_name()."=".trim(session_id())."&faxPath=$faxPath&leido=no&krd=$krd&ent=$ent&carp_per=$carp_per&carp_codi=$carp_codi&nurad=$nurad&depende=$depende&radi_usua_actu=radi_usua_actu";
?>
<?php
if (strlen($nurad)==14) $consecutivo =6; else  $consecutivo =5; 
$x1=substr($nurad,0,4);
$x2=substr($nurad,4,3);
$x3=substr($nurad,7,$consecutivo);
$x4=substr($nurad,-1);
if(!$aceptarBorarFax)
{
?> 
<form action="borrarFax.php?nurad=<?=$nurad?>&faxPath=<?=$faxPath?>&<?=$var_envio?>" method="POST">
<input type=hidden name=faxBorrar value='<?=$faxBorrar?>'>
<input type=hidden name=faxPath value='<?=$faxPath?>'>
<table width="100%" border="0" cellspacing="0" cellpadding="4" bordercolor="#CCCCCC" height="100%" class="t_bordeGris">
<tr>
	<td valign="middle" align="center">      <div align="center">
	<table width="98%" border="0" cellspacing="0" cellpadding="0">
		<tr> 
			<td width="52%" align="center"><br>
				
			<font face="Arial, Helvetica, sans-serif" size="5" color="#003366">
			Borrar Archivo de Fax  <?=$faxBorrar?></font><BR>
			<font face="Arial, Helvetica, sans-serif" size="2" color="#003366">
			Al Aceptar, Cargara borrara el archivo asociado al fax. <br>Por favor este seguro que este ya fue radicado o que no sea un archivo para radicacion.</font>
			</td>
		</tr>
	</table>
	<table width="500"  border=0 align="center" bgcolor="White">
	<tr><TD colspan="2" class=titulos5>Si desea escriba un comentario para borrar este fax.</TD></tr>
	<TR bgcolor="White"><TD width="100">
			<center>
			<img src="<?=$ruta_raiz?>/iconos/tuxTx.gif" alt="Tux Transaccion" title="Tux Transaccion">
			</center>
	</td><TD align="left">
			<span class="etextomenu">
			</span>
					<textarea name=faxObserva cols=60 rows=3  class=ecajasfecha></textarea>
		</TD></TR>
	</center>
	<input type=hidden name=enviar value=enviarsi>
	<input type=hidden name=enviara value='9'>
	<input type=hidden name=carpeta value=12>
	<input type=hidden name=carpper value=10001>
</td>
</tr>
</TABLE>
		<input type="submit" name="aceptarBorarFax" value="ACEPTAR BORRAR FAX" class="botones_largo">
	</div>
	</td>
</tr>
</table>
</form>
<?
}
else
{
?> 
<table width="100%" border="0" cellspacing="0" cellpadding="4" bordercolor="#CCCCCC" height="100%" class="t_bordeGris">
<tr>
	<td valign="middle" align="center">      <div align="center">
	<table width="98%" border="0" cellspacing="0" cellpadding="0">
		<tr> 
		<td width="52%" align="center"><br>
		<br>
		<font face="Arial, Helvetica, sans-serif" size="5" color="#003366">
		<?php
		$file = "../bodega/faxtmp/$faxPath";
		$newPathFax = "/$x1/$x2/$nurad".".pdf";
		//$newPathFax = "/2004/529/$nurad".".tif";
		$newPathFaxPdf = "/2004/529/$nurad".".pdf";
		$newfile = "../bodega$newPathFax";
		$cpConvert = "/usr/bin/convert -font helvetica -fill black -pointsize 22 \-draw ".chr(34)."text 1200,50 'SSPD Radicado No $nurad' text 1200,80 'Fecha Rad No ".date('Y/m/d H:i:s')."'  text 1200,110 'Rem. '".chr(34)." $file $newfile";
		//**  COPIANDO LA IMAGEN DEL REPOSITORIO DE FAX A DIRECTORIO TEMPORAL DE FAX DE ORFEO **/
		$iBorrado = "ssh -l orfeo 172.16.1.168 sudo cp /var/spool/hylafax/recvq/$faxBorrar"."tif /mnt/bodegas/prod/bodega/faxtmp/.";
		exec($iBorrado,$exec_output,$exec_return);
		//**  BORRANDO LA IMAGEN DEL REPOSITORIO DE FAX **/
		$iBorrado = "ssh -l orfeo 172.16.1.168 sudo rm /var/spool/hylafax/recvq/$faxBorrar"."tif";
		exec($iBorrado,$exec_output,$exec_return);
		error_reporting(7);
		//echo "<hr>$iBorrado<hr>-->$exec_return - $exec_output<----";
		if (!$exec_return)
		{
			error_reporting(7);
			?>
			El archivo de fax <?=$faxBorrar?>Fue borrado correctamente</font>
			<?
			$codigoFax = substr($faxBorrar,3,9);
			$faxPath = $faxBorrar . "tif";
			$iSql= " insert into SGD_RFAX_RESERVAFAX
			( sgd_rfax_codigo
			, sgd_rfax_fax
			, usua_login
			, sgd_rfax_fech
			, sgd_rfax_observa
			) values
			(
			$codigoFax
			,'$faxPath'
			,'$krd'
			,".$db->conn->OffsetDate(0,$db->conn->sysTimeStamp)."
			,'Borrado. $faxObserva'
			)
			";
			$db->conn->query($iSql);
		}
		?>
		</td>
		</tr>
	</table>
</div>
    </td>
  </tr>
</table>
<?
}
?>
</body>
</html>
