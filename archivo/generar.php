<? $krdOld = $krd;
$per=1;
session_start();

if(!$krd) $krd = $krdOld;
if (!$ruta_raiz) $ruta_raiz = "..";
//include "$ruta_raiz/rec_session.php";
include_once("$ruta_raiz/include/db/ConnectionHandler.php");
	$db = new ConnectionHandler("$ruta_raiz");
	$encabezadol = "$PHP_SELF?".session_name()."=".session_id()."krd=$krd&Tipo=$Tipo";

?>

<html height=50,width=150>
<head>
<title>Generar Inveratario</title>
<link rel="stylesheet" href="<?=$ruta_raiz."/estilos/".$_SESSION["ESTILOS_PATH"]?>/orfeo.css">
<script>
 function GenerarCsv() {
  window.open("<?=$ruta_raiz?>/archivo/generarcsv.php?&krd=<?=$krd?>&coddepe=<?=$coddepe?>&codusua=<?=$codusua?>","Generar CSV","height=150,width=350,scrollbars=yes");
}
 </script>
<CENTER>
<body bgcolor="#FFFFFF">
<div id="spiffycalendar" class="text"></div>
 <link rel="stylesheet" type="text/css" href="../js/spiffyCal/spiffyCal_v2_1.css">
 <script language="JavaScript" src="../js/spiffyCal/spiffyCal_v2_1.js">
 </script>



<form name=generar action="<?=$encabezadol?>" method='post' action="generar.php?<?=session_name()?>=<?=trim(session_id())?>krd=<?=$krd?>">
<br>
<?
echo "<CENTER><table><tr><td class=titulosError>INVENTARIO DOCUMENTAL ARCHIVO DE GESTION</td></tr></table></center>";
$sqli="select SGD_DEPE_CODI,SGD_DEPE_NOMB from SGD_EINV_INVENTARIO order by SGD_EINV_CODIGO";
$rsi=$db->query($sqli);
if(!$rsi->EOF){
$depe=$rsi->fields['SGD_DEPE_CODI'];
$depe_nom=$rsi->fields['SGD_DEPE_NOMB'];
}
?>


<BR><BR>

<table border=0 width 100% cellpadding="1"  class="borde_tab" align="left">
<TR><TD class=titulos5 >DEPENDENCIA </td>
<td class=leidos2 ><b><span class=leidos2><? echo $depe;?></b></td>
</tr>
<tr><TD class=titulos5 >OFICINA PRODUCTORA </td>
<td class=leidos2 ><b><span class=leidos2><? echo $depe_nom;?></b></td>
</tr>
<tr><TD class=titulos5 >CODIGO DEPENDENCIA </td>
<td class=leidos2 ><b><span class=leidos2><? echo $depe;?></b></td>
</table>
<br><br><br>
<table border=0 width 100% cellpadding="1"  class="borde_tab" align="center">
<TD class=titulos5  align="center">TITULO DE LA UNIDAD DOCUMENTAL
<table border=0 width 100% cellpadding="1"  class="borde_tab">
<TD class=titulos5 >N° EXPEDIENTE
<TD class=titulos5 >TITULO
</table>
<TD class=titulos5  align="center">UNIDAD
<table border=0 width 100% cellpadding="1"  class="borde_tab">
<TD class=titulos5 >CAR
<TD class=titulos5 >AZ
<TD class=titulos5 >LB
<TD class=titulos5 >AR
</table>
<TD class=titulos5  align="center" width="80%">&nbsp;&nbsp;&nbsp;FECHAS EXTREMAS &nbsp;&nbsp;&nbsp;&nbsp;
<table border=0 width 100% cellpadding="1"  class="borde_tab">
<TD class=titulos5  width="50%">&nbsp;&nbsp;INICIAL &nbsp;&nbsp;
<TD class=titulos5  width="50%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FINAL &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</table>
<TD class=titulos5 >RADICADOS
<TD class=titulos5 >FOLIOS
<? include_once("$ruta_raiz/config.php"); ?>
<TD class=titulos5 >N° UNIDAD DOCUMENTAL <?=$entidad?>
<TD class=titulos5 >N° UNIDAD DOCUMENTAL BODEGA
<TD class=titulos5 >CAJA <?=$entidad?>
<TD class=titulos5 >CAJA BODEGA
<TD class=titulos5 >NOMBRE SERIE
<TD class=titulos5 >NUMERO SERIE
<TD class=titulos5 >NOMBRE SUBSERIE
<TD class=titulos5 >NUMERO SUBSERIE
<TD class=titulos5  align="center">RETENCION
<table border=0 width 100% cellpadding="1"  class="borde_tab">
<TD class=titulos5 >AG
<TD class=titulos5 >AC
</table>
<TD class=titulos5 width="60%">DISPOCICION FINAL
<TD class=titulos5 >UBICACION
<TD class=titulos5 >OBSERVACIONES
</tr>

<?
$sql="select * from SGD_EINV_INVENTARIO order by SGD_EINV_CODIGO";
$rs=$db->query($sql);
$depe=$rs->fields['SGD_DEPE_CODI'];
$depe_nom=$rs->fields['SGD_DEPE_NOMB'];
while(!$rs->EOF){
?><tr><?
	$expnum=$rs->fields['SGD_EINV_EXPNUM'];

	$unidad=$rs->fields['SGD_EINV_UNIDAD'];
	$fech=$rs->fields['SGD_EINV_FECH'];
	$fechfin=$rs->fields['SGD_EINV_FECHFIN'];
	$radicados=$rs->fields['SGD_EINV_RADICADOS'];
	$folios=$rs->fields['SGD_EINV_FOLIOS'];
	$nundocu=$rs->fields['SGD_EINV_NUNDOCU'];
	$nundocub=$rs->fields['SGD_EINV_NUNDOCUBODEGA'];
	$caja=$rs->fields['SGD_EINV_CAJA'];
	$cajab=$rs->fields['SGD_EINV_CAJABODEBA'];
	$srd=$rs->fields['SGD_EINV_SRD'];
	$srd_desc=$rs->fields['SGD_EINV_NOMSRD'];
	$sbrd=$rs->fields['SGD_EINV_SBRD'];
	$sbrd_desc=$rs->fields['SGD_EINV_NOMSBRD'];
	$rete=$rs->fields['SGD_EINV_RETENCION'];
	$disfinal=$rs->fields['SGD_EINV_DISFINAL'];
	$ubicacion=$rs->fields['SGD_EINV_UBICACION'];
	$observa=$rs->fields['SGD_EINV_OBSERVACION'];
$sqme="select sgd_sexp_parexp1 from sgd_sexp_secexpedientes where sgd_exp_numero like '$expnum'";
$rse=$db->query($sqme);
if(!$rse->EOF)$titulo=$rse->fields['SGD_SEXP_PAREXP1'];
else $titulo="";

?>



<td class=leidos2 ><b><span class=leidos2><? echo $expnum;?></b>
<b><span class=leidos2><? echo $titulo;?></b></td>
<td class=leidos2 ><b><span class=leidos2>&nbsp;&nbsp;<? if($unidad==1)echo "X";?></b>
 <b><span class=leidos2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<? if($unidad==2)echo "   X";?></b>
 <b><span class=leidos2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<? if($unidad==3)echo "       X";?></b>
 <b><span class=leidos2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<? if($unidad==4)echo "           X";?></b></td>
<td class=leidos2  width="80"><? echo $fech;?>&nbsp;<? echo $fechfin;?></td>
<td class=leidos2 align="center" ><b><span class=leidos2><? echo $radicados;?></b></td>
<td class=leidos2 align="center"><b><span class=leidos2><? echo $folios;?></b></td>
<td class=leidos2 align="center"><b><span class=leidos2><? echo $nundocu;?></b></td>
<td class=leidos2 align="center"><b><span class=leidos2><? echo $nundocub;?></b></td>
<td class=leidos2 align="center"><b><span class=leidos2><? echo $caja;?></b></td>
<td class=leidos2 align="center"><b><span class=leidos2><? echo $cajab;?></b></td>
<td class=leidos2 align="center"><b><span class=leidos2><? echo $srd_desc;?></b></td>
<td class=leidos2 align="center"><b><span class=leidos2><? echo $srd;?></b></td>
<td class=leidos2 align="center"><b><span class=leidos2><? echo $sbrd_desc;?></b></td>
<td class=leidos2 align="center"><b><span class=leidos2><? echo $sbrd;?></b></td>
<td class=leidos2 ><b><span class=leidos2>&nbsp;&nbsp;<? if($rete==1)echo "X";?></b>
 <b><span class=leidos2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?if($rete==2)echo "    X";?></b></td>
<td class=leidos2 align="center"><b><span class=leidos2><? echo $disfinal;?></b></td>
<td class=leidos2 align="center"><b><span class=leidos2><? echo $ubicacion;?></b></td>
<td class=leidos2 align="center" ><b><span class=leidos2><? echo $observa;?></b></td>

</tr>

<?
$rs->MoveNext();
}?>
</table>

	<input name="Cerrar" type="button" class="botones_funcion" id="envia22" onClick="window.close();" value=" Cerrar " >
	<input name="GenerarCSV" type="button" class="botones_funcion" onClick="GenerarCsv();" value=" GenerarCSV " >

</form>
</CENTER>

</html>
