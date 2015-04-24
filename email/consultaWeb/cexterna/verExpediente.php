<?php
	$ruta_raiz = "../../";
	$numDiaMax = 300;
	$tmpRad =  array();
	$nombreExpediente = $expediente;
	if (!defined('ADODB_ASSOC_CASE')) define('ADODB_ASSOC_CASE', 1);
	include ($ruta_raiz . "include/db/ConnectionHandler.php");
	include ("./class/UsuarioExterno.class.php");
	$db = new ConnectionHandler($ruta_raiz);
	$tituloPagina = "Detalles de Expediente";
	include_once ("./class/UsuarioExterno.class.php");
	$idEmpresa = $HTTP_GET_VARS["idEmpresa"];
	$usuarioExt = new UsuarioExterno($idEmpresa, $db);
	$expediente = $usuarioExt->detalleExp($expediente,$numDiaMax);
	$dirServBodega = "";
	include ("./cabez.php");
?>
<html>
<head>
<title><?=$tituloPagina?></title>
<link rel="stylesheet" href="../../estilos/orfeo.css">
<style type="text/css">
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
</style>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_swapImgRestore() { //v3.0
 var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
    var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
    var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
    if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
    for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
    if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
  if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->

function cerrar_session() {
     	if (confirm('�Esta seguro de Cerrar Sesion ?'))
	{
		fecha = 20060911040952;
		nombreventana="ventanaBorrar"+fecha;
		url="index_web.php?adios=chao&20060911";
		document.form_cerrar.submit();
	}
}
</script>
</head>
<body bgcolor="#ffffff" onLoad="MM_preloadImages('../../imagenes/cabezote_r1_c4.gif','./imagenes/cabezote_r1_c5.gif','./imagenes/cabezote_r1_c6.gif','./imagenes/cabezote_r1_c7.gif')">
<table class="borde_tab" align="center" bgcolor="#a8bac6" border="0" width="100%">
<tbody>
 <tr class="titulos5">
 <td colspan="6"><center>DETALLES EXPEDIENTE</center>
 </td>
 </tr>
  <tr class="titulos5">
  <td class="titulos5" colspan="6">
        Nombre de Expediente: &nbsp; <?=$nombreExpediente?>
        <input name="funExpediente" id="funExpediente" value="" type="hidden">
    <input name="menu_ver_tmp" id="funExpediente" value="4" type="hidden">
    <input type="hidden" name="PHPSESSID" value="<?=$PHPSESSID?>">
</tr>
<tr class="titulos5">
 <td class="titulos5" colspan="6" width="42%"><tab>Estado :<span class="leidos">
  <?php
  	// Mostrar Etapa del proceso
	echo $expediente[0]["SGD_FEXP_DESCRIP"]; 
  ?></span>
 </td>
</tr>
<tr class="titulos5">
  <td width="9%">
    TRD:
  </td>  
  <td colspan="4" class="titulos5">
    <?php
	echo $expediente[0]["SGD_SRD_DESCRIP"] . " / ". $expediente[0]["SGD_SBRD_DESCRIP"];
    ?>
  </td>
  <!--
  <td rowspan="3" colspan = "3">
    <table border="0" height="100%" width="100%">
     <tbody>
      <tr class="titulos5">
        <td>DEPENDENCIA:</td>
        <td class="titulos5"></td>
      </tr>
      <tr class="titulos5">
        <td>ESP:</td>
        <td class="titulos5"></td>
      </tr>
     </tbody>
    </table>
   </td>-->
</tr>
<tr class="titulos5">
  <td>
    PROCESO:
  </td>
  <td colspan="4" class="titulos5">
	<?php
		// Mostrar Proceso
		echo $expediente[0]["SGD_PEXP_DESCRIP"]; 
	?>
  </td>
</tr>
<tr class="titulos5">
  <td nowrap="nowrap">
    FECHA INIC:
  </td>
  <td colspan="4" class="titulos5">
  <?php
  	// Mostrar Fecha
	echo $expediente[0]["SGD_SEXP_FECH"]; 
  ?>
  </td>
</tr>
<tr class="timparr">
<td colspan="6" class="titulos5">
  <p>Documentos Pertenecientes al expediente &nbsp;</p>
  <tbody>
   <tr class="listado5">
    <td align="center">No.</td>
    <td align="center">
      <a href="#" onclick="javascript:ordenarPor( 'b.RADI_NUME_RADI' );">Radicado</a>
    </td>
  <td align="center">
    <a href="#" onclick="javascript:ordenarPor( 'b.RADI_FECH_RADI' );">Fecha Radicaci&oacute;n</a>
	</td>
	<td align="center">
      <a href="#" onclick="javascript:ordenarPor( 'c.SGD_TPR_DESCRIP' );">Tipo<br>Documento</a>
    </td>
    <td align="center">
      <a href="#" onclick="javascript:ordenarPor( 'b.RA_ASUN' );">Asunto</a>
   </tr>
<?php
	$radicados = array();
	$style[] = "listado1";
	$style[] = "listado2";
	$radicados = $expediente["radicados"];
	if (!empty($radicados[0])) {
		foreach($radicados as $radicado){
			$res = $cont % 2;
			$radNum = $cont + 1;
			$trExp .= "<tr class=\"".$style[$res] ."\" valign=\"top\" align\"right\">\n";
			$trExp .= "<td align=\"center\">$radNum</td>";
			$trExp .= "<td align=\"center\"><a href=\"../../bodega" . trim($radicado["RADI_PATH"]) . 
						 $fila["SGD_EXP_NUMERO"] . "\">" .
						$radicado["RADI_NUME_RADI"] ."</a></td>\n";
			$trExp .= "<td align=\"center\"><span class=\"leidos\">". $radicado["FECHA_RAD"] ."</span></td>\n";
			$trExp .= "<td align=\"center\"><span class=\"leidos\">". $radicado["SGD_TPR_DESCRIP"] ."</span></td>\n";
			$trExp .= "<td align=\"left\"><span class=\"leidos\">&nbsp;&nbsp;&nbsp;". $radicado["RA_ASUN"] ."</span></td>\n";
			$trExp .= "</tr>";
			$cont++;
		}
	}
	echo $trExp;
?>
</tbody></table>
</body>
</html>
