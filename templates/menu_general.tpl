<!doctype html>
<html>
  <head>
    <base href="{$ORFEO_URL}">
    <link rel="stylesheet" href="{$RUTA_ESTILOS}">
      <script type="text/javascript">
      // Variable que guarda la ultima opcion de la barra de herramientas de funcionalidades seleccionada
      function MM_swapImgRestore() { //v3.0
        var i,x,a=document.MM_sr;
        for (i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
      }

      function MM_preloadImages() { //v3.0
        var d=document;
        if(d.images) {
          if(!d.MM_p)
            d.MM_p=new Array();
          
          var i,j=d.MM_p.length,a=MM_preloadImages.arguments;
          
          for(i=0; i<a.length; i++) {
            if (a[i].indexOf("#")!=0) {
              d.MM_p[j]=new Image;
              d.MM_p[j++].src=a[i];
            }
          }
        }
      }

      function MM_findObj(n, d) { //v4.01
        var p,i,x;
        
        if(!d)
          d = document;
        
        if((p=n.indexOf("?"))>0&&parent.frames.length) {
          d=parent.frames[n.substring(p+1)].document;
          n=n.substring(0,p);
        }
        
        if(!(x=d[n])&&d.all) x=d.all[n];
        
        for (i=0;!x&&i<d.forms.length;i++)
          x=d.forms[i][n];
        
        for(i=0;!x&&d.layers&&i<d.layers.length;i++)
          x=MM_findObj(n,d.layers[i].document);
        
        if(!x && d.getElementById)
          x = d.getElementById(n);
        return x;
      }

      function MM_swapImage() { //v3.0
        var i, j = 0, x, a = MM_swapImage.arguments;
        document.MM_sr = new Array; 
        for(i=0;i<(a.length-2);i+=3)
         if ((x=MM_findObj(a[i]))!=null){
          document.MM_sr[j++]=x;
          if(!x.oSrc)
            x.oSrc=x.src;
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

      function verPersonales(img) {
        if (swVePerso!=1){
          document.getElementById('carpersolanes').style.display="";
          swVePerso=1;
        }else{
          document.getElementById('carpersolanes').style.display="none";
          MM_swapImage('plus' + selecMenuAnt,'','imagenes/menu.gif',1);
          selecMenuAnt = img;
          swVePerso=0;
        }
        numPerso = img;
      }
    </script>
  </head>
  <body>
  <form action="{$ENLACE_MENU_GENERAL}" method="get">
    <font size="1" face="verdana">
    {if $ES_USUARIO}
      {include file="menu_modulos.tpl"}
      {include file="menu_radicacion.tpl"}
    <table border="0" cellpadding="0" cellspacing="0" width="160">
      <tr>
        <td><img src="imagenes/spacer.gif" width="10" height="1" border="0" alt=""></td>
        <td><img src="imagenes/spacer.gif" width="150" height="1" border="0" alt=""></td>
        <td><img src="imagenes/spacer.gif" width="1" height="1" border="0" alt=""></td>
      </tr>
      <tr>
        <td colspan="2">
          <a href="menu_general.php" onClick="window.location.reload()">
            <img name="menu_r3_c1" src="./imagenes/menu_r5_c1.gif" alt="Presione para actualizar las carpetas." width="148" height="31" border="0">
          </a>
        </td>
        <td>
          <img src="./imagenes/spacer.gif" width="1" height="25" border="0" alt="">
        </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td valign="top">
          <table width="150" border="0" cellpadding="0" cellspacing="0" class="eMenu">
            <tr>
              <td valign="top">
                <table width="150"  border="0" cellpadding="0" cellspacing="3">
                {foreach $BANDEJAS as $BANDEJA}
                {strip}
                  <tr valign="middle">
                      <td width="25">
                        <img src="imagenes/menu.gif" width="15" height="18" alt="{$BANDEJA.data}" title="{$BANDEJA.data}" name="plus{$BANDEJA.id}">
                      </td>
                      <td width="125">
                          <a onclick="cambioMenu({$BANDEJA.id});" href="{$BANDEJA.enlace_bandeja}" class="menu_princ" target="mainFrame" alt="Seleccione una Carpeta">
                            {$BANDEJA.nombre_bandeja}
                          </a>
                      </td>
                  </tr>
                {/strip}
                {/foreach}
                  <tr  valign="middle">
                    <td width="25">
                      <img src="imagenes/menu.gif" width="15" height="18" alt="{$DATA_AGENDADOS}" title="{$DATA_AGENDADOS}"  name="plus{$ID_AGENDADOS}">
                    </td>
                    <td width="125">
                      <a onclick="cambioMenu({$ID_AGENDADOS});" href="{$ENLACE_AGENDADOS}" class="menu_princ" target="mainFrame" alt="Seleccione una Carpeta">
                        Agendado({$TOTAL_AGENDADOS})
                      </a>
                    </td>
                  </tr>
                  <tr  valign="middle">
                    <td width="25">
                      <img src="imagenes/menu.gif" width="15" height="18" alt="{$DATA_AGENDADOS_VENCIDOS}" title="{$DATA_AGENDADOS_VENCIDOS}" name="plus{$ID_AGENDADOS_VENCIDOS}">
                    </td>
                    <td width="125">
                      <a onclick="cambioMenu({$ID_AGENDADOS_VENCIDOS});" href="{$ENLACE_AGENDADOS_VENCIDOS}" class="menu_princ" target="mainFrame" alt="Seleccione una Carpeta">
                    Agendado Vencido(<font color='#990000'>{$NUM_EXP}</font>)
                      </a>
                    </td>
                  </tr>
                  <tr valign="middle">
                    <td width="25">
                      <img src="imagenes/menu.gif" width="15" height="18" alt="{$DATA_INFORMADOS}" title="{$DATA_INFORMADOS}" name="plus{$ID_INFORMADOS}">
                    </td>
                    <td width="125">
                      <a onclick="cambioMenu({$ID_INFORMADOS});" href="{$ENLACE_CUERPO_INF}" class="menu_princ" target="mainFrame" alt='Documentos De Informacion' title="Documentos De Informacion">
                  Informados ({$NUMEROT})
                      </a>
                    </td>
                  </tr>
                  <tr  valign="middle">
                    <td width="25">
                      <img src="imagenes/menu.gif" width="15" height="18" alt="{$DATA_CUERPO_TX}" title="{$DATA_CUERPO_TX}"  name="plus{$ID_CUERPO_TX}">
                    </td>
                    <td width="125">
                      <a onclick="cambioMenu({$ID_CUERPO_TX});" href="{$ENLACE_CUERPO_TX}" class="menu_princ" target="mainFrame" alt="Transaccines del Usuario">
                      Transacciones
                      </a>
                    </td>
                  </tr>
                  <tr valign="middle">
                    <td width="25">
                      <img src="./imagenes/menu.gif" width="15" height="18" alt="{$DATA_CARPETAS}" title="{$DATA_CARPETAS}" name="plus{$ID_CUERPO_TX}">
                    </td>
                    <td width="125">
                      <a onclick="cambioMenu({$ID_CUERPO_TX});verPersonales({$ID_CUERPO_TX});" href="{$ORFEO_URL}menu_general.php#marcaPersonales" class="menu_princ"  alt="Despliegue de Carpetas Personales" title="Despliegue de Carpetas Personales" name="marcaPersonales">
                      PERSONALES
                      </a>
                    </td>
                  </tr>
	              </table>
		            <div id="folders"></div>
		            <table width="100%"  border="0" cellpadding="0" cellspacing="0" bgcolor="cacac9" id="carpersolanes" style="display:none">
		              <tr>
		                <td>
                      <a class="vinculos" href="{$ENLACE_CREAR_CARPETA}" class="menu_princ" target="mainFrame" alt="Creacion de Carpetas Personales" title="Creacion de Carpetas Personales">
                        <font size="2">Nueva carpeta</font>
                      </a>
                    </td>
                  </tr>
                  {foreach $ARREGLO_CARPETAS as $CARPETA}
                  {strip}
                  <tr>
                    <td height="18">
                      <a href="{$CARPETA.enlace}" alt="{$CARPETA.detalle}" title="{$CARPETA.detalle}" class="menu_princ" target="mainFrame">
                        {$CARPETA.nombre}
                      </a>
                    </td>
                  </tr>
                  {/strip}
                  {/foreach}
                </table>
              </td>
            </tr>
	        </table>
        </td>
      </tr>
    </table>
    {/if}
    <table width="100%" border="0" cellspacing="0" cellpadding="0"  class="t_bordeVerde">
      <tr align="center">
        <td height="35">
          <img width="80" src="{$LOGO}" alt="Logo">
        </td>
      </tr>
      <tr align="center">
        <td height="20">
          <font size="1" face="Verdana, Arial, Helvetica, sans-serif">Equipo: {$DIRECCION_IP}</font>
        </td>
      </tr>
    </table>
  </form>
</body>
</html>
