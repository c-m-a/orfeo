<html>
<head>
<title>ORFEO</title>
<link rel="stylesheet" href="<?=$ruta_raiz;?>/estilos/orfeo.css">
<!-- Fireworks MX Dreamweaver MX target.  Created Tue Sep 27 13:32:55 GMT-0500 (Hora est. del Pac�fico de SA) 2005-->
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
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
		fecha = <?=date("Ymdhms") ?>;
		<?
		$fechah = date("Ymdhms");
		?>
		nombreventana="ventanaBorrar"+fecha;
		url="index_web.php?adios=chao&<?=date("Ymd")?>";
		document.form_cerrar.submit();
	}
}

</script>
</head>
<body bgcolor="#ffffff" onLoad="MM_preloadImages('<?=$ruta_raiz?>/imagenes/cabezote_r1_c4.gif','<?=$ruta_raiz?>cabezote_r1_c5.gif','<?=$ruta_raiz?>cabezote_r1_c6.gif','<?=$ruta_raiz?>cabezote_r1_c7.gif')">
<table width="100%" height="76"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="206"><img name="cabezote_r1_c1" src="<?=$ruta_raiz?>imagenes/logo.gif" width="206" height="76" border="0" alt=""></td>
    <td><img name="cabezote_r1_c2" src="<?=$ruta_raiz?>imagenes/cabezote_r1_c2.gif" width="100%" height="76" border="0" alt=""></td>
    <td width="271"><img name="cabezote_r1_c3" src="<?=$ruta_raiz?>imagenes/cabezote_r1_c3.gif" width="271" height="76" border="0" alt=""></td>
    <td width="62"><a href="<?=$ruta_raiz?>Manuales/ayudaorfeo/consulta_web.htm" target="COnsultaCiud4" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image37','','../imagenes/cabezote_r1_c4.gif',1)"><img src="../imagenes/cabezote_over_r1_c4.gif" name="Image37" width="62" height="76" border="0"></a></td>
    <td width="61"><a href="SoporteChat.php?nuRad=<?=$idRadicado?>" target='chatSSPDOrfeo<?=$idRadicado?>' onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image38','','../imagenes/CALLa.jpg',1)"><img src="../imagenes/CALL.jpg" name="Image38" width="61" height="76" border="0"></a></td>
    <td width="54"><a href='#' onClick="cerrar_session();"><img name="cabezote_r1_c8" src="../imagenes/cabezote_r1_c8.gif" width="54" height="76" border="0" title="Salir" alt="Salir"></a></td>
  </tr>
</table>
