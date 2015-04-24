<?
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
</head>

<body bgcolor="#FFFFFF" text="#000000" topmargin="0">
<?
  $var_envio=session_name()."=".trim(session_id())."&faxPath=$faxPath&leido=no&krd=$krd&ent=$ent&carp_per=$carp_per&carp_codi=$carp_codi&nurad=$nurad&depende=$depende&radi_usua_actu=radi_usua_actu";
?>
<?php
if (strlen($nurad)==14) $consecutivo =6; else  $consecutivo =5; 
$x1=substr($nurad,0,4);
$x2=substr($nurad,4,3);
$x3=substr($nurad,7,$consecutivo);
$x4=substr($nurad,-1);
if(!$uploadFax and !$uploadDelFax)
{
?> 
<form action="uploadFax.php?nurad=<?=$nurad?>&faxPath=<?=$faxPath?>&faxRemitente=<?=$faxRemitente?>&<?=$var_envio?>" method="POST">
<table width="100%" border="0" cellspacing="0" cellpadding="4" bordercolor="#CCCCCC" height="100%" class="t_bordeGris">
  <tr>
    <td valign="middle" align="center">      <div align="center">
        <table width="98%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="52%" align="center"><br>
              <img src="../imagenes/uploadFax.jpg" w><br>
            <font face="Arial, Helvetica, sans-serif" size="5" color="#003366">
						ASOCIAR IMAGEN A RADICADO No. <? echo "$x1-$x2-$x3-$x4";?></font><BR>
						<font face="Arial, Helvetica, sans-serif" size="2" color="#003366">
						Al Aceptar, Cargara a la Bodega y asociar&aacute; la imagen al radicado y luego borrara el fax de la lista de entrada</font>						
						</td>
          </tr>
        </table>
        <input type="submit" name="uploadFax" value="ACEPTAR" onClick="datos_generales()" class="ebuttons2">
				<input type="submit" name="Submit" value="CERRAR VENTANA" onClick="window.close()" class="ebuttons2"> </div>
    </td>
  </tr>
</table>
</form>
<?
}
else
{
?> 
<form action="uploadFax.php?nurad=<?=$nurad?>&faxPath=<?=$faxPath?>&var_envio=<?=$var_envio?>" method="POST">
<table width="100%" border="0" cellspacing="0" cellpadding="4" bordercolor="#CCCCCC" height="100%" class="t_bordeGris">
  <tr>
    <td valign="middle" align="center">      <div align="center">
		<table width="98%" border="0" cellspacing="0" cellpadding="0">
			<tr> 
				<td width="52%" align="center"><br>
					<img src="../imagenes/uploadFax.jpg"><br>
				<font face="Arial, Helvetica, sans-serif" size="3" color="#003366">
<?php
$file = "../bodega/faxtmp/$faxPath";
$newPathFax = "/$x1/$x2/$nurad".".pdf";
//$newPathFax = "/2004/529/$nurad".".tif";
$newPathFaxPdf = "/faxtmp/$nurad".".pdf";
$newPathFaxTif = "/$x1/$x2/$nurad".".tif";
$newfile = "../bodega$newPathFaxTif";
if($convertiImg=="Ok")
{
$sshExec = "/usr/bin/convert $file ../bodega/faxtmp/$nurad-%d".".png";
exec($sshExec,$execOutput,$execReturn);	
	if($execReturn==0)
	{
		$faxRemitente = substr($faxRemitente,0,30);
		//$cpConvert = "/usr/bin/convert -font helvetica -fill black -pointsize 20 \-draw ".chr(34)."text 1300,50 'SSPD Radicado No $x1-$x2-$x3-$x4' text 1300,70 'Fecha Rad No ".date('Y/m/d H:i:s')."'  text 1300,90 'Rem. $faxRemitente'".chr(34)." ../bodega/faxtmp/$nurad"."-0.jpg ../bodega/faxtmp/$nurad"."-0.jpg";
			$fax_tmp = "../bodega/faxtmp/$nurad-0.png";
			$image = imagecreatefrompng("../bodega/faxtmp/$nurad-0.png");
			$negro = imagecolorallocate($image,0,0,0);
			$posX=(imagesx($image)/2)+(imagesx($image)/4);
			imagerectangle($image,$posX-5,35,$posX+300,90,$negro);
			imagestring($image,5,$posX,40,"SSPD Rad No. $x1-$x2-$x3-$x4",$negro);
			imagestring($image,5,$posX,55,"Fecha Rad No ".date('Y/m/d H:i:s')."",$negro);
			imagestring($image,5,$posX,70,"Rem. $faxRemitente",$negro);
			imagepng($image,$fax_tmp);
			imagedestroy($image);		
//		exec($cpConvert,$execOutput,$execReturn);	
	if($execReturn==0)
		{
		}
		else
		{
			echo "<script>alert('No coloco stiker  --- $cpConvert');</script>";
		}
	}
	else
	{
		echo "<script>alert('Convirtio Mal  --- $sshExec');</script>";
	}
	$sshExec = "/usr/bin/convert "."../bodega/faxtmp/$nurad*.png ../bodega$newPathFaxPdf";
	exec($sshExec,$execOutput,$execReturn);	
	if($execReturn==0)
	{

	}
	else
	{
		echo "<script>alert('Convirtio Mal  pngs->pdf --- ');</script>";
	}
   $sshExec = "/usr/bin/convert "."../bodega$newPathFaxPdf ../bodega$newPathFaxTif";
	exec($sshExec,$execOutput,$execReturn);	
	if($execReturn==0)
	{

	}
	else
	{
		echo "<script>alert('Convirtio Mal  pdf->tif --- ');</script>";
	}
error_reporting(7);	
if (!$cpOutput)
{
	echo "<a href='$newfile'  target=newFax$nurad>Imagen</a><br>";
	$qw="update radicado
			SET 
			RADI_PATH='$newPathFaxTif'
			,RADI_NUME_HOJA=0
	where radi_nume_radi='$nurad' ";
	$rs = $db->conn->query($qw);
		$observa = "Anexo de Imagen de Fax.";
	$codusdp = str_pad($dependencia, 3, "0", STR_PAD_LEFT).str_pad($codusuario, 3, "0", STR_PAD_LEFT);
	$isql_hl= "insert into hist_eventos(DEPE_CODI    ,HIST_FECH,USUA_CODI   ,RADI_NUME_RADI,HIST_OBSE ,USUA_DOC   ,USUA_CODI_DEST, SGD_TTR_CODIGO)
	values ($dependencia , sysdate ,$codusuario ,$nurad        ,'$observa','$usua_doc','$codusdp', 24)";
	$rs = $db->conn->query($isql_hl);
	?>
	IMAGEN ASOCIADA CORRECTAMENTE AL RADICADO No. <? echo "$x1-$x2-$x3-$x4";?></font>
	<?
				$codigoFax = substr($faxPath,3,9);
				$iSql= " UPDATE  
					SGD_RFAX_RESERVAFAX
				set 
					SGD_RFAX_FECHRADI=SYSDATE
					,RADI_NUME_RADI=$nurad
				WHERE 
					SGD_RFAX_FAX='$faxPath'
					AND USUA_LOGIN='$krd'
			";
			$db->conn->query($iSql);
			$iBorrado = "ssh -l orfeo 172.16.1.168 sudo rm /var/spool/hylafax/recvq/$faxPath";
			exec($iBorrado,$exec_output,$exec_return);
			error_reporting(7);
      //echo "<hr>$iBorrado<hr>-->$exec_return - $exec_output<----";
			if (!$exec_return)
			{
				error_reporting(7);
				?>
				<br><font color=red size=2>El archivo <?=$faxPath?> Fue borrado correctamente de la lista de fax entrantes.</font>
				<?
			}else
			{
				?>
				<br><font color=red size=1>El archivo <?=$faxPath?> No fue borrado correctamente de la lista de fax entrantes.</font>
				<?
			}
	$sshExec = "rm ../bodega/faxtmp/$nurad*png";
	exec($sshExec,$execOutput,$execReturn);
	if($execReturn==0)
	{

	}
	else
	{
		echo "<hr> No Borradas Imagens Temporales<hr> ";
	} 
	if($uploadDelFax)
	{

		
	}
}
// ciere del if de convertif Fax.
}
	$sshExec = "cp $file $newfile";
	exec($sshExec,$execOutput,$execReturn);
	if($execReturn==0)
	{
	echo "<a href='$newfile'  target=newFax$nurad>Imagen</a><br>";
	$qw="update radicado
			SET 
			RADI_PATH='$newPathFaxTif'
			,RADI_NUME_HOJA=0
	where radi_nume_radi='$nurad' ";
	$rs = $db->conn->query($qw);
		$observa = "Anexo de Imagen de Fax.";
	$codusdp = str_pad($dependencia, 3, "0", STR_PAD_LEFT).str_pad($codusuario, 3, "0", STR_PAD_LEFT);
	$isql_hl= "insert into hist_eventos(DEPE_CODI    ,HIST_FECH,USUA_CODI   ,RADI_NUME_RADI,HIST_OBSE ,USUA_DOC   ,USUA_CODI_DEST, SGD_TTR_CODIGO)
	values ($dependencia , sysdate ,$codusuario ,$nurad        ,'$observa','$usua_doc','$codusdp', 24)";
	$rs = $db->conn->query($isql_hl);
	?>
	IMAGEN ASOCIADA CORRECTAMENTE AL RADICADO No. <? echo "$x1-$x2-$x3-$x4";?></font>
	<?
				$codigoFax = substr($faxPath,3,9);
				$iSql= " UPDATE  
					SGD_RFAX_RESERVAFAX
				set 
					SGD_RFAX_FECHRADI=SYSDATE
					,RADI_NUME_RADI=$nurad
				WHERE 
					SGD_RFAX_FAX='$faxPath'
					AND USUA_LOGIN='$krd'
			";
			$db->conn->query($iSql);
			$iBorrado = "ssh -l orfeo 172.16.1.168 sudo rm /var/spool/hylafax/recvq/$faxPath";
			exec($iBorrado,$exec_output,$exec_return);
			error_reporting(7);
      //echo "<hr>$iBorrado<hr>-->$exec_return - $exec_output<----";
			if (!$exec_return)
			{
				error_reporting(7);
				?>
				<br><font color=red size=2>El archivo <?=$faxPath?> Fue borrado correctamente de la lista de fax entrantes.</font>
				<?
			}else
			{
				?>
				<br><font color=red size=1>El archivo <?=$faxPath?> No fue borrado correctamente de la lista de fax entrantes.</font>
				<?
			}
	}
	else
	{
		echo "<hr> No Borradas Imagens Temporales<hr> ";
	}
?>
			</td>
			</tr>
		</table>
		<input type="button" name="Submit" value="CERRAR VENTANA" onClick="window.close()" class="ebuttons2"> </div>
    </td>
  </tr>
</table>
</form>
<?
}
?>
</body>
</html>
