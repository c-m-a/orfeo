<link rel="stylesheet" type="text/css" href="{$ORFEO_URL}/js/spiffyCal/spiffyCal_v2_1.css">
<script language="JavaScript" src="{$ORFEO_URL}/js/spiffyCal/spiffyCal_v2_1.js"></script>
<!-- Funcion que activa el sistema de marcar o desmarcar todos los check  -->
<script language="javascript" type="text/JavaScript">
  setRutaRaiz ('{$ORFEO_URL}');
  function setRutaRaiz(ruta){
    var ruta_raiz=ruta;
  }
  
  function markAll() {
  if(document.form1.elements['checkAll'].checked)
    for(i=1;i<document.form1.elements.length;i++)
      document.form1.elements[i].checked=1;
  else
    for(i=1;i<document.form1.elements.length;i++)
      document.form1.elements[i].checked=0;
  }

  {include file='pestanas_ver_radicado.tpl'}
  
  // Variable que guarda la ultima opcion de la barra de herramientas de funcionalidades seleccionada
  seleccionBarra = -1;
  <!--
  function MM_swapImgRestore() { //v3.0
    var i,x,a=document.MM_sr;
    for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
  }

  function MM_preloadImages() { //v3.0
    var d = document;
    if (d.images) {
      if(!d.MM_p)
        d.MM_p = new Array();
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
    for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
    for (i=0;!x&&d.layers&&i<d.layers.length;i++)
      x=MM_findObj(n,d.layers[i].document);
    if(!x && d.getElementById)
      x=d.getElementById(n);
    return x;
  }

  function MM_swapImage() { //v3.0
    var i,j=0,x,a=MM_swapImage.arguments;
    document.MM_sr = new Array;
    for(i=0;i<(a.length-2);i+=3) {
      if ((x=MM_findObj(a[i]))!=null) {
        document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];
      }
    }
  }

  function vistoBueno() {
    changedepesel(9);
    document.getElementById('EnviaraV').value = 'VoBo';
  }

  function devolver() {
    document.getElementById('codTx').value = 12;
    changedepesel(12);
  }

  function txAgendar() {
    if (!validaAgendar('SI'))
      return;
    changedepesel(14);
    envioTx();
  }

  function txNoAgendar() {
    changedepesel(15);
    envioTx();
  }

  function archivar() {
    changedepesel(13);
    envioTx();
  }

  function nrr() {
     changedepesel(16);
     envioTx();
  }

  function envioTx() {
    sw = 0;
    {if !$verrad}
      for(i=1;i<document.form1.elements.length;i++)
      if (document.form1.elements[i].checked)
          sw=1;
      if (sw==0) {
        alert ("Debe seleccionar uno o mas radicados");
        return;
      }
    {/if}
    document.form1.submit();
  }

  function window_onload() {
    document.getElementById('depsel').style.display = 'none';
    document.getElementById('depsel8').style.display = 'none';
    document.getElementById('carpper').style.display = 'none';
    document.getElementById('Enviar').style.display = 'none';

    {if not $verrad}
      <!-- nada -->
    {else}
      window_onload2();
    {/if}

    {if $carpeta eq 11 && $codusuario eq 1}
      document.getElementById('salida').style.display = '';
      document.getElementById('enviara').style.display = '';
      document.getElementById('Enviar').style.display = '';
    {/if}

    {if $carpeta eq 11 and $codusuario neq 1}
      document.getElementById('enviara').style.display = 'none';
      document.getElementById('Enviar').style.display = 'none';
    {/if}
  }
    function masivaTRD(){
    sw = 0;
    var radicados = new Array();
    var list = new Array();

    for(i=1;i<document.form1.elements.length;i++){
      if (document.form1.elements[i].checked && document.form1.elements[i].name!="checkAll") {
        sw++;
        valor = document.form1.elements[i].name;
        valor = valor.replace("checkValue[", "");
        valor = valor.replace("]", "");
        radicados[sw] = valor;
        list.push(valor);
      }
    }

    window.open("accionesMasivas/masivaAsignarTrd.php?{$MASIVA_ASIGNAR_TRD}" + list, "Masiva_Asignación_TRD", "height=650,width=750,scrollbars=yes");
  };

  function radicadosSel() {
    sw = 0;
    var radicados = new Array();

    for(i=1;i<document.form1.elements.length;i++){
      if (document.form1.elements[i].checked) { 
        sw++;
        valor = document.form1.elements[i].name;
        valor = valor.replace("checkValue[", "");
        valor = valor.replace("]", "");
        radicados[sw] = valor;
      }
    }
    alert("---> " + sw + " -->" + radicados[1]  + " -->" + radicados[2]  );
  }
</script>

<body onload="MM_preloadImages('{$ORFEO_URL}/imagenes/internas/overVobo.gif','{$ORFEO_URL}/imagenes/internas/overNRR.gif','{$ORFEO_URL}/imagenes/internas/overMoverA.gif','{$ORFEO_URL}/imagenes/internas/overReasignar.gif','{$ORFEO_URL}/imagenes/internas/overInformar.gif','{$ORFEO_URL}/imagenes/internas/overDevolver.gif','{$ORFEO_URL}/imagenes/internas/overArchivar.gif')">
  <!-- si esta en la Carpeta de Visto Bueno no muesta las opciones de reenviar -->
  {if $mostrar_opc_envio eq 0 || ($codusuario == $radi_usua_actu && $dependencia == $radi_depe_actu)}
  <table width="100%" border="1" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <table width="100%" height="51" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="730" valign="bottom">
        {if $CONTROL_AGENDA eq 1}
          {if $AGENDADO}
          <img name="principal_r5_c1" src='{$ORFEO_URL}/imagenes/internas/noAgendar.gif' width='130' height='20' border='0' alt=''>
          <input name='Submit2' type='button' class='botones_2' value='&gt;&gt;' onClick='txNoAgendar();'>
          {else}
            {if $MOSTRAR_OPCIONES}
          <img name="principal_r5_c1"  src='{$ORFEO_URL}/imagenes/internas/agendar.gif' width="69" height="20" border="0" alt="">
          <script language="javascript">
            var dateAvailable = new ctlSpiffyCalendarBox("dateAvailable",
                                                          "form1",
                                                          "fechaAgenda",
                                                          "btnDate1",
                                                          "",
                                                          scBTNMODE_CUSTOMBLUE);
            dateAvailable.date = "2003-08-05";
            dateAvailable.writeControl();
            dateAvailable.dateFormat="yyyy-MM-dd";
          </script>
			    <input name="Submit2" type="button" class="botones_2" value="&gt;&gt;" onClick='txAgendar();'>
            {/if}
          {/if}
        {/if}
		</td>
    {if not $AGENDADO and $MOSTRAR_OPCIONES}
      <td width="25" valign="bottom">
        <img name="principal_r4_c3" src="{$ORFEO_URL}/imagenes/internas/principal_r4_c3.gif" width="25" height="51" border="0" alt="">
      </td>
      <td width="63" valign="bottom">
        <a href="#" onMouseOut="MM_swapImgRestore()" onClick="seleccionBarra = 10;changedepesel(10);" onMouseOver="MM_swapImage('Image8','','{$ORFEO_URL}/imagenes/internas/overMoverA.gif',1)">
          <img src="{$ORFEO_URL}/imagenes/internas/moverA.gif" name="Image8" width="63" height="51" border="0">
        </a>
      </td>
      <td width="64" valign="bottom">
        <a href="#" onMouseOut="MM_swapImgRestore()" onClick="seleccionBarra = 9;changedepesel(9);" onMouseOver="MM_swapImage('Image9','','{$ORFEO_URL}/imagenes/internas/overReasignar.gif',1)">
          <img src="{$ORFEO_URL}/imagenes/internas/reasignar.gif" name="Image9" width="64" height="51" border="0"  >
        </a>
      </td>
      <td width="66" valign="bottom">
        <a href="#" onMouseOut="MM_swapImgRestore()" onClick="seleccionBarra = 8;changedepesel(8);" onMouseOver="MM_swapImage('Image10','','{$ORFEO_URL}/imagenes/internas/overInformar.gif',1)">
          <img src="{$ORFEO_URL}/imagenes/internas/informar.gif" name="Image10" width="66" height="51" border="0">
        </a>
      </td>
      <td width="58" valign="bottom">
        <a href="#" onMouseOut="MM_swapImgRestore()" onClick="seleccionBarra = 12;changedepesel(12);" onMouseOver="MM_swapImage('Image11','','{$ORFEO_URL}/imagenes/internas/overDevolver.gif',1)">
          <img src="{$ORFEO_URL}/imagenes/internas/devolver.gif" name="Image11" width="58" height="51" border="0">
        </a>
      </td>
      {if $MOSTRAR_VOBO}
      <td width="55" valign="bottom">
        <a href="#" onmouseout="MM_swapImgRestore()" onclick="seleccionBarra = 14;vistoBueno();" onmouseover="MM_swapImage('Image12','','{$ORFEO_URL}/imagenes/internas/overVobo.gif',1)">
          <img src="{$ORFEO_URL}/imagenes/internas/vobo.gif" name="Image12" width="55"  border="0">
        </a>
      </td>
      {/if}
      {if $MOSTRAR_ARCHIVAR}
      <td width="61" valign="bottom">
        <a href="#" onMouseOut="MM_swapImgRestore()" onClick="seleccionBarra = 13;changedepesel(13);" onMouseOver="MM_swapImage('Image13','','{$ORFEO_URL}/imagenes/internas/overArchivar.gif',1)">
          <img src="{$ORFEO_URL}/imagenes/internas/archivar.gif" name="Image13" width="61" height="51" border="0">
        </a>
      </td>
      {/if}
      {if $codusuario eq 1}
      <td width="61" valign="bottom">
        <a href="#" onmouseout="MM_swapImgRestore()" onclick="seleccionBarra = 14;changedepesel(16);" onmouseover="MM_swapImage('Image14','','{$ORFEO_URL}/imagenes/internas/overNRR.gif',1)"><img src="{$ORFEO_URL}/imagenes/internas/NRR.gif" name="Image14" width="61" height="51" border="0" />
        </a>
      </td>
      {/if}
    {/if}
    {if $MOSTRAR_OPCIONES}
      <td valign="bottom">
        <a href= "#" title="Asignar TRD" src="{$ORFEO_URL}/imagenes/internas/masTRDO.gif" onClick="masivaTRD();">
          <img name="ejemplo1"  alt="Asignar Trd masiva" src="{$ORFEO_URL}/imagenes/internas/masTRD.gif"  border="0">
        </a>
      </td>
    {/if}
	  </tr>
	</table>
  {/if}
  </td>
<tr/>
<tr>
	<td height="59" colspan="3" >
	<table border="0" width="100%" align="center" class="borde_tab" bgcolor="a8bac6">
	<tr>
		<td width='40%'>
    {if $CONTROL_AGENDA eq 1}
			<table width="100%"  border="0" cellpadding="0" cellspacing="5" class="titulos2">
			<tr>
				<td width="15%" class="titulos2">LISTAR POR: </td>
				<td width="60%" class="titulos2">
					<a href='{$ORFEO_URL}/cuerpo.php?{$ORDENAR_LEIDOS}' alt='Ordenar Por Leidos'>
					  <span class='leidos'>Le&iacute;dos</span>
          </a>
          {$IMG_LEIDOS}&nbsp;
					<a href='{$ORFEO_URL}/cuerpo.php?{$ORDENAR_NO_LEIDOS}' alt='Ordenar Por Le&iacute;dos' class="tparr">
            <span class='no_leidos'>No le&iacute;dos</span>
          </a>
				</td>
			</tr>
			</table>
    {/if}
		</td>
    {if $MOSTRAR_OPCIONES_MENU}
		<td width="55%"  align="right" class="titulos2">
      {$MENU_DEPENDENCIAS_INFORMAR}
      {$MENU_CARPETAS_PERSONALES}
      {$MENU_DEPENDENCIA}
		<input type="hidden" name="enviara" value="9">
		<input type="hidden" name="EnviaraV" id="EnviaraV" value="">
		</td>
		<td width='5%' align="right">
			<input type="button" value='>>' name="Enviar" id="Enviar" valign="middle" class="botones_2" onClick="envioTx();">
			<input type="hidden" name="codTx" id="codTx" value="9">
		</td>
    {/if}
</tr>
</table>
