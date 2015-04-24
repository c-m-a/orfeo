
<?php
$ruta_raiz = "..";
$verradicado = $idRadicado;
$dependencia = 990;
$codusuario = 300;
$verrad = $idRadicado;
$ent = substr($idRadicado,-1);
error_reporting(7);
$iTpRad = 10;
include "$ruta_raiz/ver_datosrad.php";
include "sessionWeb.php";
?>
<link rel="stylesheet" href="../estilos_totales.css" type="text/css">
<?
include "f_topWeb.php";
?>
<center>
<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center">
<tr valign="bottom"> 
 <td class="tituloListado" align="center">INFORMACION DEL RADICADO <?=$idRadicado?></td>
 <td>
<a href='SoporteChat.php?nuRad=<?=$idRadicado?>' target="SoporteEnLinea">
<img src='images/soporteEnLinea.gif'></a></td>
 </tr>
</table>
</center>
<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr valign="bottom"> 
    <td class="tituloListado"><p></p> </td>
  </tr>
</table>
<table border=0 cellspace=2 cellpad=2 WIDTH=98% align="center" class="t_bordeGris" id=tb_general>
<tr> 
<td align="right" bgcolor="#CCCCCC" height="25"><font face="Arial, Helvetica, sans-serif" class="etextomenu">TIPO 
	DOCUMENTO </font></td>
<td class='timpar' colspan="6"> 
<?
if(Trim($val_tpdoc_grb)=="///") $val_tpdoc_grb = "";
?>
	<?=$tpdoc_nombre ?>
	<font color=black>/ </font> 
	<?=$funcion_nombre ?>
	<font color=black>/ </font> 
	<?=$proceso_nombre ?>
	<font color=black>/ </font> 
	<?=$procedimiento_nombre ?>
</td>
</tr>
<tr> 
	<td align="right" bgcolor="#CCCCCC" height="25"><font face="Arial, Helvetica, sans-serif" class="etextomenu">FECHA 
		DE RADICADO</font></td>
	<td class='timpar' width="25%" height="25"> 
		<?=$radi_fech_radi ?>
	</td>
	<td bgcolor="#CCCCCC" width="25%" align="right" height="25"><font face="Arial, Helvetica, sans-serif" class="etextomenu">ASUNTO 
		</font></td>
	<td class='timpar' colspan="3" width="25%"> 
		<?=$ra_asun ?>
	</td>
</tr>
<tr> 
	<td align="right" bgcolor="#CCCCCC" height="25$dc      "><font face="Arial, Helvetica, sans-serif" class="etextomenu"> 
		<?=$tip3Nombre[1][$ent]?></font></td>
	<td class='timpar' width="25%" height="25"> 
		<?=$nombret_us1 ?>
	</td>
	<td bgcolor="#CCCCCC" width="25%" align="right" height="25"><font face="Arial, Helvetica, sans-serif" class="etextomenu">DIRECCION 
		CORRESPONDENCIA </font></td>
	<td class='timpar' width="25%"> 
		<?=$direccion_us1 ?>
	</td>
	<td bgcolor="#CCCCCC" width="25%" align="right" height="25"><font face="Arial, Helvetica, sans-serif" class="etextomenu"> 
		MUN/DPTO </font></td>
	<td class='timpar' width="25%"> 
		<?=$dpto_nombre_us1."/".$muni_nombre_us1 ?>
	</td>
</tr>
<tr> 
	<td align="right" bgcolor="#CCCCCC" height="25"><font face="Arial, Helvetica, sans-serif" class="etextomenu"> 
		<?=$tip3Nombre[2][$ent]?></font></td>
	<td class='timpar' width="25%" height="25"> 
		<?=$nombret_us2 ?>
	</td>
	<td bgcolor="#CCCCCC" width="25%" align="right" height="25"><font face="Arial, Helvetica, sans-serif" class="etextomenu">DIRECCION 
		CORRESPONDENCIA </font></td>
	<td class='timpar' width="25%"> 
		<?=$direccion_us2 ?>
	</td>
	<td bgcolor="#CCCCCC" width="25%" align="right" height="25"><font face="Arial, Helvetica, sans-serif" class="etextomenu"> 
		MUN/DPTO</font></td>
	<td class='timpar' width="25%"> 
		<?=$dpto_nombre_us2."/".$muni_nombre_us2 ?>
	</td>
</tr>
<tr> 
	<td align="right" bgcolor="#CCCCCC" height="25"><font face="Arial, Helvetica, sans-serif" class="etextomenu"> 
		<?=$tip3Nombre[3][$ent]?></font></td>
	<td class='timpar' width="25%" height="25"> 
		<?=$nombret_us3 ?>
	</td>
	<td bgcolor="#CCCCCC" width="25%" align="right" height="25"><font face="Arial, Helvetica, sans-serif" class="etextomenu">DIRECCION 
		CORRESPONDENCIA </font></td>
	<td class='timpar' width="25%"> 
		<?=$direccion_us3 ?>
	</td>
	<td bgcolor="#CCCCCC" width="25%" align="right" height="25"><font face="Arial, Helvetica, sans-serif" class="etextomenu"> 
		MUN/DPTO</font></td>
	<td class='timpar' width="25%"> 
		<?=$dpto_nombre_us3."/".$muni_nombre_us3 ?>
	</td>
</tr>
<tr> 
	<td height="25" bgcolor="#CCCCCC" align="right"> 
		<p><font face="Arial, Helvetica, sans-serif" class="etextomenu">N&ordm; 
			DE PAGINAS</font></p>
	</td>
	<td class='timpar' width="25%" height="25"> 
		<?=$radi_nume_hoja ?>
	</td>
	<td bgcolor="#CCCCCC" width="25%" height="25" align="right"> <font face="Arial, Helvetica, sans-serif" class="etextomenu">DESCRIPCION 
		ANEXOS </font></td>
	<td class='timpar'  width="25%" height="11"> 
		<?=$radi_desc_anex ?>
	</td>
	<td bgcolor="#CCCCCC" width="25%" align="right" height="25"><font face="Arial, Helvetica, sans-serif" class="etextomenu"> 
		</font></td>
	<td class='timpar' width="25%">&nbsp;</td>
</tr>
<tr> 
	<td bgcolor="#CCCCCC"--++ width="25%" align="right" height="25"><font face="Arial, Helvetica, sans-serif" class="etextomenu">REF/OFICIO/CUENTA 
		INTERNA </font></td>
	<td class='timpar' colspan="1" width="25%"> 
		<?=$cuentai ?>
	</td>
	<td align="right"--++ bgcolor="#CCCCCC" height="25"  class="etextomenu">ESTADO 
		ACTUAL <font face="Arial, Helvetica, sans-serif" class="etextomenu">&nbsp;</font></td>
	<td class='timpar' colspan="3"> 
		<?
			if(!$flujo_nombre) $funcion_nombre="En Tramite";
			echo "$flujo_nombre"
		?>
		<? 
	if($verradPermisos == "Full" or $datoVer=="985")
	{
	?>
		<input type=button name=mostrar_causal value='...' class=ebuttons2 onClick="ver_flujo();">
		<?
		}
		?>
</td></td>
</tr>
</table>
<center>
</center>   
<?
include "$ruta_raiz/flujo/flujoGrafico.php";
$isql = "select RADI_NUME_SALIDA from anexos a where a.anex_radi_nume='$verrad'";
$rs = $db->query($isql);
$radicado_d= "";
while(!$rs->EOF)
	{
		$valor = $rs->fields["RADI_NUME_SALIDA"];
		if(trim($valor))
		   {
		      $radicado_d .= "'".trim($valor) ."', ";
		   }
		$rs->MoveNext();   		  
	}  
$radicado_d .= "$verrad";
// Finaliza Historicos
?>
</table>
<?
$isql = "select 
		r.RA_ASUN,
		r.RADI_FECH_RADI,
		r.RADI_NUME_RADI,
		r.RADI_PATH
		from radicado r
		where
		r.radi_nume_deri in($radicado_d)
		AND r.radi_nume_radi like '%5'
		AND r.radi_tipo_deri = 0
		AND substr(UPPER(r.RADI_PATH), -3) = 'TIF'
		";
$rs = $db->query($isql);
$i=1;
if(!$rs->EOF)
{
?>
<table><TR><TD></TD></TR></table>
 <table width="97%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td height="25" class="tituloListado">RESOLUCIONES GENERADAS</td>
  </tr>
</table>
<?
while(!$rs->EOF)
{
?>
<table  cellspacing=2 cellpadding=2  width="97%" class="t_bordeGris" align="center"  >
<tr  class='etextomenu' align="center">
	<td width=10% class="grisCCCCCC" height="24"><font face="Arial, Helvetica, sans-serif">
		RADICADO </font></td>
	<td  width=15% class="grisCCCCCC" height="24"><font face="Arial, Helvetica, sans-serif">
		FECHA </font></td>
	<td  width=15% height="24" class="grisCCCCCC"><font face="Arial, Helvetica, sans-serif">
		Asunto</font></td>      
</tr>
  <?
	$radEnviado = $rs->fields["RADI_NUME_RADI"];
	$radFecha = $rs->fields["RADI_FECH_RADI"];
	$radiPath = $rs->fields["RADI_PATH"];
	$ra_asun = $rs->fields["RA_ASUN"];
	$pathImagen = $ruta_raiz."/bodega/$radiPath";
	str_replace("//","/",$pathImagen);
  str_replace("\\","/",$pathImagen);
	$pathImagen = "";
	if($radDev)
	{
		$imgRadDev = "<img src='$ruta_raiz/imagenes/devueltos.gif' alt='Documento Devuelto por empresa de Mensajeria' title='Documento Devuelto por empresa de Mensajeria'>";
	}else
	{
		$imgRadDev = "";
	}
if($i==1)
	{
   ?>
  <tr class='tpar'> 
	<?
		$i=1;
	}
	?>
	<td class="celdaGris" >
	<?=$imgRadDev?>
		<span class='timpar'><?=$radEnviado?></span>
		</td>
    <td class="celdaGris">
	<?=$rs->fields["RADI_FECH_RADI"]?></span>
	</td>
    <td class="celdaGris"  >
	 <?=$rs->fields["RA_ASUN"] ?> </td>
  </tr>
  <?
	$rs->MoveNext();  
  }
}
?>
</table>
<?
$isql = "select a.SGD_RENV_FECH,
		a.DEPE_CODI,
		a.USUA_DOC,
		a.RADI_NUME_SAL,
		a.SGD_RENV_NOMBRE,
		a.SGD_RENV_DIR,
		a.SGD_RENV_MPIO,
		a.SGD_RENV_DEPTO,
		a.SGD_RENV_PLANILLA,
		a.SGD_RENV_FECH,
		b.DEPE_NOMB,
		c.SGD_FENV_DESCRIP,
		a.SGD_RENV_OBSERVA,
		a.SGD_DEVE_CODIGO,
		r.RADI_PATH
		from sgd_renv_regenvio a, dependencia b, sgd_fenv_frmenvio c, radicado r
		where
		a.radi_nume_sal in($radicado_d)
		AND a.depe_codi=b.depe_codi
		AND a.sgd_fenv_codigo = c.sgd_fenv_codigo
		AND a.radi_nume_sal=r.radi_nume_radi
		order by a.SGD_RENV_FECH desc ";
$rs = $db->query($isql);
$i=1;
if(!$rs->EOF)
{
?>
 <table width="97%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td height="25" class="tituloListado">DATOS DE ENVIOS REALIZADOS</td>
  </tr>
</table>
<table  cellspacing=2 cellpadding=2  width="97%" class="t_bordeGris" align="center"  >
  <tr  class='etextomenu' align="center">
    <td width=10% class="grisCCCCCC" height="24"><font face="Arial, Helvetica, sans-serif">
      RADICADO </font></td>
    <td  width=15% class="grisCCCCCC" height="24"><font face="Arial, Helvetica, sans-serif">
      FECHA </font></td>
    <td  width=15% class="grisCCCCCC" height="24"><font face="Arial, Helvetica, sans-serif">
      Destinatario</font></td>      
    <td  width=15% class="grisCCCCCC" height="24" ><font face="Arial, Helvetica, sans-serif">
      DIRECCION </font></td>
    <td  width=15% class="grisCCCCCC" height="24" ><font face="Arial, Helvetica, sans-serif">
      DEPARTAMENTO </font></td>
    <td  width=15% class="grisCCCCCC" height="24" ><font face="Arial, Helvetica, sans-serif">
      MUNICIPIO </font></td>
    <td  width=15% class="grisCCCCCC" height="24" ><font face="Arial, Helvetica, sans-serif">
      TIPO DE ENVIO </font></td>
    <td  width=5% height="24" class="grisCCCCCC"><font face="Arial, Helvetica, sans-serif">
      No. PLANILLA</font></td>
    <td  width=15% height="24" class="grisCCCCCC"><font face="Arial, Helvetica, sans-serif">
      OBSERVACIONES</font></td>      
  </tr>
<?
while(!$rs->EOF)
{
	$radDev = $rs->fields["SGD_DEVE_CODIGO"];
	$radEnviado = $rs->fields["RADI_NUME_SAL"];
	$radiPath = $rs->fields["RADI_PATH"];
	$pathImagen = $ruta_raiz."/bodega/$radiPath";
	str_replace("//","/",$pathImagen);
  str_replace("\\","/",$pathImagen);
	$pathImagen = "";
	if($radDev)
	{
		$imgRadDev = "<img src='$ruta_raiz/imagenes/devueltos.gif' alt='Documento Devuelto por empresa de Mensajeria' title='Documento Devuelto por empresa de Mensajeria'>";
	}else
	{
		$imgRadDev = "";
	}
if($i==1)
	{
   ?>
  <tr class='tpar'> 
	<?
		$i=1;
	}
	?>
	<td class="celdaGris" >
	<?=$imgRadDev?>
    <span class='timpar'><?=$radEnviado?></span>
		</td>
    <td class="celdaGris">
	<?=$rs->fields["SGD_RENV_FECH"]?></span>
	</td>
    <td class="celdaGris">
	<?=$rs->fields["SGD_RENV_NOMBRE"]
	?> </td>
    <td class="celdaGris"  >
	<?=$rs->fields["SGD_RENV_DIR"]?> </td>
    <td class="celdaGris"  >
	 <?=$rs->fields["SGD_RENV_DEPTO"] ?> </td>
    <td class="celdaGris"  >
	 <?=$rs->fields["SGD_RENV_MPIO"] ?> </td>
    <td class="celdaGris"  >
	 <?=$rs->fields["SGD_FENV_DESCRIP"] ?> </td>
    <td class="celdaGris"  >
	 <?=$rs->fields["SGD_RENV_PLANILLA"] ?> </td>
    <td class="celdaGris"  >
	 <?=$rs->fields["SGD_RENV_OBSERVA"] ?> </td>
  </tr>
  <?
	$rs->MoveNext();
  }
}
else
{
?>
<tr><td colspan="10">
<?
echo "<center></center>";
?>
</td></tr>
<?
}