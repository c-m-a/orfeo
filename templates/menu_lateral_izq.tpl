<html>
<head>
<link rel="stylesheet" href="{$ESTILOS_PATH}orfeo.css">
<script type="text/javascript" language="javascript">
/*     FUNCION QUE MUESTRA LA VENTANA DE NOVEDADES DE USUARIO
    Busca los radicados de entrada o internos que le llegaron al usuario.
    Además los documentos que le devolvieron,
    le reasignaron, le informaron, le dieron visto bueno.
*/
/*
 *    La funcion updateFolders es la encargada de verificar
    los contenidos de las carpetas del usuario que se
    encuentra en la sesion actual,

    El intervalo de tiempo para hacer estas consultas se
    define en la funcion setTimeout
 */
function showInBox() {
  xajax_updateInBox('{$USUA_DOC}');
    setTimeout(showInBox, 10000);
}

// refresca las carpetas de documentos
function updateFolders() {
  xajax_updateFolders('{$KRD}');
    setTimeout(updateFolders, 10000);
}
</script>
  {$XAJAX}
<script type="text/javascript">
// Variable que guarda la ultima opcion de la barra de herramientas de funcionalidades seleccionada
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr;
  for (i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d = document;
  if(d.images){
    if(!d.MM_p) d.MM_p=new Array();
    var i, j = d.MM_p.length, a = MM_preloadImages.arguments;
    for(i=0; i<a.length; i++) {
      if (a[i].indexOf("#")!=0) {
        d.MM_p[j]=new Image;
        d.MM_p[j++].src=a[i];
      }
    }
  }
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document;
  if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document;
    n=n.substring(0,p);
  }

  if(!(x=d[n])&&d.all) x=d.all[n];
  for (i=0;!x&&i<d.forms.length;i++) x = d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x = MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n);
  return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a = MM_swapImage.arguments;
  document.MM_sr = new Array;
  for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){
    document.MM_sr[j++]=x;
    if(!x.oSrc) x.oSrc=x.src;
    x.src=a[i+2];
  }
}

function reload_window($carpetano,$carp_nomb,$tipo_carp) {
    document.write("<form action='{$ENLACE_CUERPO}' method='post' name='form4' target='mainFrame'>");
    document.write("<input type='hidden' name='carpetano' value='" + $carpetano + "'>");
    document.write("<input type='hidden' name='carp_nomb' value='" + $carp_nomb + "'>");
    document.write("<input type='hidden' name='tipo_carpp' value='" + $tipo_carp + "'>");
    document.write("<input type='hidden' name='tipo_carpt' value='" + $tipo_carpt + "'>");
    document.write("</form>");
    document.form4.submit();
}
selecMenuAnt=-1;
swVePerso = 0;
numPerso = 0;
function cambioMenu(img){
    MM_swapImage('plus' + img,'','imagenes/menuraya.gif',1);

    if (selecMenuAnt!=-1 && img!=selecMenuAnt)
        MM_swapImage('plus' + selecMenuAnt,'','imagenes/menu.gif',1);
    selecMenuAnt = img;

    if (swVePerso==1 && numPerso!=img){
      document.getElementById('carpersolanes').style.display="none";
      MM_swapImage('plus' + numPerso,'','imagenes/menu.gif',1);
      swVePerso=0;
    }
}

function verPersonales(img){
    if (swVePerso!=1){
      document.getElementById('carpersolanes').style.display="";
      swVePerso=1;
    } else {
      document.getElementById('carpersolanes').style.display="none";
      MM_swapImage('plus' + selecMenuAnt,'','imagenes/menu.gif',1);
      selecMenuAnt = img;
      swVePerso = 0;
    }
    numPerso = img;
}
</script>
</head>
<body onload="{$PARAM_VALOR}">
<form action="./correspondencia.php" method="get">
  <font size="1" face="verdana">
    {$MENU_PRIMERO}
    {$RADICACION}
  <table border="0" cellpadding="0" cellspacing="0" width="160">
    <tr>
      <td><img src="imagenes/spacer.gif" width="10" height="1" border="0" alt=""></td>
      <td><img src="imagenes/spacer.gif" width="150" height="1" border="0" alt=""></td>
      <td><img src="imagenes/spacer.gif" width="1" height="1" border="0" alt=""></td>
    </tr>
  <tr>
    <td colspan="2">
      <a href="#" onClick="window.location.reload()">
        <img name="menu_r3_c1" src="./imagenes/menu_r5_c1.gif" alt="Presione para actualizar las carpetas." width="148" height="31" border="0" >
      </a>
    </td>
    <td><img src="./imagenes/spacer.gif" width="1" height="25" border="0" alt=""></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td valign="top">
    <table width="150" border="0" cellpadding="0" cellspacing="0" class="eMenu">
  <tr>
    <td valign="top">
      <table width="150"  border="0" cellpadding="0" cellspacing="3">
        <tr valign="middle">
          <td width="25">
            <img src="imagenes/menu.gif" width="15" height="18" alt="{$DATA_AGENDADO}" title="{$DATA_AGENDADO}"  name="{$NUM_AGENDADOS}">
          </td>
          <td width="125">
            <a onclick="cambioMenu({$NUMERO});" href="{$ENLACE_CUERPO}" class="menu_princ" target="mainFrame" alt="Seleccione una Carpeta">
              {$NUMEROT}
            </a>
          </td>
        </tr>
        <tr valign="middle">
          <td width="25">
            <img src="imagenes/menu.gif" width="15" height="18" alt="{$DATA_NO_AGENDADO}" title="{$DATA_NO_AGENDADO}"  name="{$NUM_NO_AGENDADOS}">
          </td>
          <td width="125">
            <a onclick="cambioMenu({$NUMERO_AGENDADO});" href="{$ENLACE_AGENDA}" class="menu_princ" target="mainFrame" alt="Seleccione una Carpeta">
            Agendado({$NUM_AGENDADOS})</a>
          </td>
        </tr>
        <tr  valign="middle">
          <td width="25">
            <img src="imagenes/menu.gif" width="15" height="18" alt="" title="" name="">
          </td>
          <td width="125">
            <a onclick="cambioMenu({$NUMERO});" href='{$ENLACE_AGENDADO_VENC}' class="menu_princ" target="mainFrame" alt="Seleccione una Carpeta">
              Agendado Vencido(<font color='#990000'>{$NUM_AGENDADO_VENC}</font>)
            </a>
          </td>
        </tr>
        <tr valign="middle">
          <td width="25">
            <img src="imagenes/menu.gif" width="15" height="18" alt="{$DATA_INFORMADOS}" title="{$DATA_INFORMADOS}" name="{$PLUS_NUM}">
          </td>
          <td width="125">
            <a onclick="cambioMenu({$NUMERO});" href="{$ENLACE_INFORMADOS}" class="menu_princ" target="mainFrame" alt='Documentos De Informacion' title="Documentos De Informacion">
              Informados ({$NUMERO_INFORMADOS})
            </a>
          </td>
        </tr>
        <tr valign="middle">
          <td width="25">
            <img src="imagenes/menu.gif" width="15" height="18" alt='<?= $data ?>' title='<?= $data ?>'  name="plus<?= $i ?>">
          </td>
          <td width="125">
            <a onclick="cambioMenu({$NUMERO});" href="{$ENLACE_TRANSACCIONES}" class="menu_princ" target="mainFrame" alt="Transaccines del Usuario">
              Transacciones
            </a>
          </td>
        </tr>
        <tr valign="middle">
          <td width="25">
            <img src="./imagenes/menu.gif" width="15" height="18" alt='<?= $data ?> ' title='<?= $data ?>' name="plus<?= $i ?>">
    </td>
    <td width="125">
        <a onclick="cambioMenu(<?= $i ?>);verPersonales(<?= $i ?>);" href='#marcaPersonales";' class="menu_princ"  alt="Despliegue de Carpetas Personales" title="Despliegue de Carpetas Personales" name="marcaPersonales">
        PERSONALES
        </a>
    </td>
    </tr>
    </table>
        <div id="folders"></div>
        <table width="100%"  border="0" cellpadding="0" cellspacing="0" bgcolor="cacac9" id=carpersolanes style="display:none"  >
        <tr>
        <td>
            <a class="vinculos" href="crear_carpeta.php?<?= $phpsession ?>&krd=<?= $krd ?>&<?
      echo "fechah=$fechah&adodb_next_page=1";
?>" class="menu_princ" target='mainFrame' alt='Creacion de Carpetas Personales'  title='Creacion de Carpetas Personales'>
            <font size=2>Nueva carpeta</font>
            </a>
        </td>
        </tr>
        <tr>
          <td height="18">
            <a href="{$ENLACE_CARPETAS}" alt="{$DETALLE}" title="{$DETALLE}" class="menu_princ" target="mainFrame">
            {$NOMBRE_CARPETA}({$NUMERO_TOTAL})
            </a>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</td>
</tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0"  class="t_bordeVerde">
  <tr align="center">
    <td height="35">
      <img width=80 src="{$LOGO}" alt="Logo">
    </td>
  </tr>
  <tr align="center">
    <td height="20">
      <font size="1" face="Verdana, Arial, Helvetica, sans-serif">
        Equipo:{$DIRECCION_IP}
      </font>
    </td>
  </tr>
</table>
</form>
</body>
</html>
