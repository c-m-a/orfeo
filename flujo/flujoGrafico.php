<?php
$no_tipo = false;
	$isql = "select a.SGD_FLD_CODIGO,
		 a.SGD_FLD_DESC
		 , b.SGD_TPR_TERMINO
		 ,a.SGD_FLD_IMAGEN
		 ,a.SGD_FLD_GRUPOWEB
		 FROM SGD_FLD_FLUJODOC a, SGD_TPR_TPDCUMENTO B
		 where
		 a.sgd_tpr_codigo=b.SGD_TPR_CODIGO
		 AND a.sgd_tpr_codigo='$tdoc'
		 AND a.sgd_fld_codigo=a.sgd_fld_grupoweb
		 order by a.SGD_FLD_CODIGO";
	$rs = $db->conn->query($isql);
?>
<TABLE><TR><TD></TD></TR></TABLE>
<center>
<table width="1%"  border="0" cellspacing="0" cellpadding="0" hspace="0">
<tr>
	<td colspan="20" class="titulo1">ESTADO DEL DOCUMENTO </td>
  </tr>
<?
  $imgFlecha = "<img src='$ruta_raiz/img/flujo/flechaAzul.gif' >";
  $imgFlechaGris = "<img src='$ruta_raiz/img/flujo/flechaGris.gif' >";
?>
<tr>
<?
$iFld = 0;

if(!$rs->EOF)
	{
	$flujo = $flujo_grb;
	$flujo = $rs->fields["SGD_FLD_GRUPOWEB"];
  $tramiteOk = "No";
	$tLegal = $rs->fields["SGD_TPR_TERMINO"];
	do
		{
		$codigo_flujo = $rs->fields["SGD_FLD_CODIGO"];
		$nombre_flujo = $rs->fields["SGD_FLD_DESC"];
		$imagenFlujo = $rs->fields["SGD_FLD_IMAGEN"];
		if(!trim($imagenFlujo) and $codigo_flujo==0)  $imagenFlujo = "imgTramite0.gif";
		if(!trim($imagenFlujo))  $imagenFlujo = "fldEnTramite.gif";
		if($codigo_flujo==$flujo ) 
		{
			$color = "BGCOLOR=GREEN  ";
			$imagenFlujo = str_replace(".gif","a.gif",$imagenFlujo);
			$imagenFlujo = str_replace(".jpg","a.jpg",$imagenFlujo);
			$imgTramite = "$imagenFlujo";
			$Mostrar = "Si";
		}
		else
		{
			$color = "";
			$imgTramite = "$imagenFlujo";
			$Mostrar = "Si";
		}
		$nombresFlujo[$iFld] = $nombre_flujo;
		if ($Mostrar=="Si")
		{
			 echo "<td width=1><img src='$ruta_raiz/img/flujo/$imgTramite' ></td>"; 
			 $tramiteOk = "Si";
		}
		$iFld++;
		$rs->MoveNext();
		}while(!$rs->EOF);
	}
	if($radi_depe_actu==999) $flujo=$iFld-1;
	if($tramiteOk != "Si")
	{
		$imagenFlujoIni = "fldTramite0.gif";
		$imagenFlujoFin = "fldFinalizado.gif";
		$imagenFlujo = "fldEnTramitea.gif";
		$imagen = "docEnTramite_color.gif";
		$flujo = 1;
		if($radi_depe_actu==999) 
			{
				$imagenFlujoFin = "fldFinalizadoa.gif";
				$imagenFlujo = "fldEnTramite.gif";
				$flujo =2;
			}
		echo "<td width=1><img src='$ruta_raiz/img/flujo/$imagenFlujoIni'></td>";
		$nombresFlujo[0] = "Radicacion";
		echo "<td width=1><img src='$ruta_raiz/img/flujo/$imagenFlujo'></td>"; 
		$nombresFlujo[1] = "En Tramite";
		echo "<td width=1><img src='$ruta_raiz/img/flujo/$imagenFlujoFin'></td>";
		$nombresFlujo[2] = "Finalizado";
		$iFld = 2;
	}
		
if($radi_depe_actu==999)
{
	$colorTramite = "  ";
	$imagenArchivado = "docListo_naranj.gif";
  $imgFlechaFin = $imgFlecha;
}else
{
	$colorTramite = "";
  $imagenArchivado = "docListo_i.gif";
  $imgFlechaFin = $imgFlechaGris;
}

	?>
</tr>
<tr class="info" width=10>
<?
	for($i=0;$i<=$iFld;$i++)
	{
	?>
	<td width=1  align="center">
	<?=$nombresFlujo[$i]?>
	</td>
	<?
	}
?>
</tr>
<tr class="info" width=10>
<?
	for($i=0;$i<=$iFld;$i++)
	{
		$bFondo = "";
		if($flujo==$i)
		{
		  $bFondo=$ruta_raiz."/img/flujo/estadoAqui.gif";
		}
	?>
	<td height=20 align="center" background="<?=$bFondo?>">
	</td>
	<?
	}
?>
</tr>
<tr><td></td></tr>
<tr class="info" width=10>
<?
for($i=0;$i<=$iFld;$i++)
{
?>
<td height="10" background='<?=$ruta_raiz."/img/flujo/plazo1.gif"?>'></td>
<?
}
?>
<td >
<?
if($tLegal>=1)	
{
	echo $tLegal;
?>Dias
<?
}	
?>
</td>
</tr>
<tr><TD></TD></tr>
<tr><TD></TD></tr>
<tr class="info" width=10>
<?
	for($i=0;$i<$iFld;$i++)
	{
	if($i<=$flujo)
	{
	?>
	<td background='<?=$ruta_raiz."/img/flujo/plazo2.gif"?>' height='10'>
	</td>
	<?
	}
	}
    if($radi_depe_actu!=999)
		{
		include_once "$ruta_raiz/tx/diasHabiles.php";
		$a = new FechaHabil($db);
		$tReal = $a->diasHabiles($radi_fech_radi,date("Y-m-d"));
	?>
	<td align="center"><?=$tReal?> Dias</td>
<?
		}
?>
</tr>
</table>
<br><br>
<table width="100%" border="0">
  <tr>
    <th scope="col"><table width="90%" border="0" cellpadding="0" cellspacing="5" class="borde_tab" align="left">
      <tr>
        <td width="94" valign="middle"><img src="imagenes/plazo1.gif" width="80" height="10"></td>
        <td width="290" class="info">TIEMPO DE TRAMITE LEGAL</td>
      </tr>
      <tr>
        <td width="94" valign="middle"><img src="imagenes/plazo2.gif" width="80" height="10"></td>
        <td class="info">TIEMPO DE TRAMITE QUE LLEVA DE SU PROCESO</td>
      </tr>
    </table></th>
    <th scope="col"><table width="90%" class="borde_tab" align="center" >
      <tr>
        <td height="25"  align="center"><a href='#' onclick="Start('./verHistorico.php?verrad=<?=$verrad?>&cmp=<?=$password?>&fechah=<?=$fechah?>',300,400);"> <span class=titulo1>VER HISTORICO DEL DOCUMENTO</span></a></td>
      </tr>
    </table></th>
  </tr>
</table>
</tr>
</TABLE>
