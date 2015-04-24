<?php
  session_start();
  $krd          = $_SESSION["krd"];
  $dependencia  = $_SESSION["dependencia"];
  $usua_doc = $_SESSION["usua_doc"];
  $codusuario = $_SESSION["codusuario"];
  $tip3Nombre=$_SESSION["tip3Nombre"];
  $tip3desc = $_SESSION["tip3desc"];
  $tip3img =$_SESSION["tip3img"];
  $ESTILOS_PATH = $_SESSION["ESTILOS_PATH"];
  $fechah = date("Ymdhms");
  $ruta_raiz = ".";
?>
<html>
<head>
<link rel="stylesheet" href="<?=$ruta_raiz.$ESTILOS_PATH?>orfeo.css">
<script language="JavaScript" type="text/JavaScript">
  function cerrar_session() {
    if (confirm('Esta seguro de Cerrar Sesion ?')) {
      fecha = <?=date("Ymdhms") ?>;
      <?
      $fechah = date("Ymdhms");
      ?>
      nombreventana="ventanaBorrar"+fecha;
      url="login.php?adios=chao";
      document.form_cerrar.submit();
    }
  }

  function cambContrasena() {
    url = 'contraxx.php?<?=session_name()."=".session_id()."&fechah=$fechah"?>';
    document.form_cerrar.action=url;
    document.form_cerrar.submit();
  }
</script>
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
</script>
</head>
<body style="background: #1f7185" topmargin="0" leftmargin="0" onLoad="MM_preloadImages('im&#225;genes/cabezote_r1_c4.gif');MM_preloadImages('im&#225;genes/cabezote_r1_c5.gif');MM_preloadImages('im&#225;genes/cabezote_r1_c6.gif');MM_preloadImages('im&#225;genes/cabezote_r1_c7.gif')">
<form name=form_cerrar action=cerrar_session.php?<?=session_name()."=".session_id()."&fechah=$fechah"?> target=_parent method=post>
<table width="100%" height="76"  border="0" cellpadding="0" cellspacing="0" class="eFrameTop">
<tr>
	<td width="206">
    <img name="cabezote_r1_c1" src="imagenes/logo.gif" width="206" height="76" border="0" alt="">
  </td>
	<td>
    <img name="cabezote_r1_c2" src="imagenes/cabezote_r1_c2.gif" width="100%" height="76" border="0" alt="">
  </td>
	<td background="./imagenes/ayuda.gif">
  </td>
	<td width="62">
    <a href="./Manuales/ayudaorfeo/content.htm" target="Ayuda_Orfeo"><img src="imagenes/ayuda.gif" name="Image8" width="62" height="76" border="0" title="MANUAL ORFEO" ALT='Ayuda'></a>
  </td>
	<td width="61">
    <a href="mod_datos.php?<?=session_name()."=".session_id()."&fechah=$fechah&krd=$krd&info=false"?>" target=mainFrame><img src="imagenes/info.gif" name="Image9" width="61" height="76" border="0"></a>
  </td>
	<td width="61">
    <a href="menu/creditos.php?<?=session_name()."=".session_id()."&fechah=$fechah&krd=$krd&info=false"?>" target=mainFrame><img src="imagenes/creditos.gif" name="Image12" width="61" height="76" border="0"></a>
  </td>
	<td width="61">
    <a href="javascript:cambContrasena();">
      <img src="<?=$ruta_raiz?>/imagenes/contrasena.gif" name="Image10" width="61" height="76" border="0">
    </a>
<?php
  if(isset($autentica_por_LDAP)) {
    if($autentica_por_LDAP == 1) {
?>
  <a href="">
    <img src="<?=$ruta_raiz?>/imagenes/contrasena.gif" name="Image10" width="63" height="76" border="0">
  </a>
<?php
    }
  }
?>
	</td>
	<td width="66"><a href="./estadisticas/vistaFormConsulta.php?<?=session_name()."=".trim(session_id())."&fechah=$fechah"?>" target=mainFrame><img src="imagenes/estadistic.gif" name="Image11" width="66" height="76" border="0"></a></td>
	<td width="54"><a href='#' onClick="cerrar_session();"><img name="cabezote_r1_c8" src="imagenes/salir.gif" width="54" height="76" border="0" alt=""></td>
  </tr>
</table>
</form>
</body>
</html>
