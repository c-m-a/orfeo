<!DOCTYPE html>
<html>
  <head>
    <title>.: Expedientes :.</title>
  <link rel="stylesheet" href="{$ORFEO_URL}estilos/orfeo.css">
  <script>
    function regresar(){
      window.location.reload();
      window.close();
    }

    function verTipoExpediente(numeroExpediente,codserie,tsub,tdoc,opcionExp) {
      window.open({$TIPIFICAR_EXPEDIENTE});
    }

    function verHistExpediente(numeroExpediente,codserie,tsub,tdoc,opcionExp) {
      window.open({$HISTORICO_EXPEDIENTE});
    }
    
    function crearProc(numeroExpediente){
      window.open({$CREAR_PROCESO});
    }
    
    function seguridadExp(numeroExpediente,nivelExp){
      window.open({$SEGURIDAD_EXPEDIENTE});
    }
    
    function verTipoExpedienteOld(numeroExpediente) {
      window.open({$VER_TIPO_EXPEDIENTE});
    }
    
    function modFlujo(numeroExpediente,texp,codigoFldExp) {
      window.open({$MODIFICAR_FLUJO});
    }

    function Responsable(numeroExpediente) {
      window.open({$ENLACE_RESPONSABLE});
    }

    function CambiarE(est,numeroExpediente) {
      window.open({$CAMBIAR_EXPEDIENTE});
    }

    function insertarExpediente() {
      window.open({$INSERT_EXPEDIENTE});
    }
    
    function crearExpediente() {
      numExpediente = document.getElementById('num_expediente').value;
      numExpedienteDep = document.getElementById('num_expediente').value.substr(4,3);
      if(numExpedienteDep==<?=$dependencia?>) {
        if(numExpediente.length==13) {
          insertarExpedienteVal = true;
        }else {
          alert("Error. El numero de digitos debe ser de 13.");
          insertarExpedienteVal = false;
        }
      } else {
        alert("Error. Para crear un expediente solo lo podra realizar con el codigo de su dependencia. ");
        insertarExpedienteVal = false;
      }

      if(insertarExpedienteVal == true) {
        respuesta = confirm("Esta apunto de crear el EXPEDIENTE No. " + numExpediente + " Esta Seguro ? ");
        insertarExpedienteVal = respuesta;
      
        if(insertarExpedienteVal == true) {
          dv = digitoControl(numExpediente);
          document.getElementById('num_expediente').value = document.getElementById('num_expediente').value + "E" + dv;
          document.getElementById('funExpediente').value = "CREAR_EXP"
          document.form2.submit();
        }
      }
    }
  </script>

  <script language="javascript">
    var varOrden = 'ASC';
    
    function ordenarPor( campo ) {
      if ( document.getElementById('orden').value == 'ASC' ) {
        varOrden = 'DESC';
      } else {
        varOrden = 'ASC';   
      }
      document.getElementById('orden').value = varOrden;
      document.getElementById('ordenarPor').value = campo + ' ' + varOrden;
      document.form2.submit();
    }

    var i = 1;
    var numRadicado;
    
    function cambiarImagen(imagen) {
      numRadicado = imagen.substr( 13 );
      if ( i == 1 ) {
        document.getElementById( 'anexosRadicado' ).value = numRadicado;
        i = 2;
      } else {
        document.getElementById( 'anexosRadicado' ).value = "";
        i = 1;
      }

      document.form2.submit();
    }

    function excluirExpediente() {
      window.open({$EXCLUIR_EXPEDIENTE});
    }

    // Incluir Anexos y Asociados a un Expediente.
    function incluirDocumentosExp() {
      var strRadSeleccionados = "";
      frm = document.form2;
      if( typeof frm.check_uno.length != "undefined" ) {
          for( i = 0; i < frm.check_uno.length; i++ ) {
              if( frm.check_uno[i].checked ) {
                  if( strRadSeleccionados == "" ) {
                      coma = "";
                  }
                  else {
                      coma = ",";
                  }
                  strRadSeleccionados += coma + frm.check_uno[i].value;
              }
          }
      } else {
          if( frm.check_uno.checked ) {
              strRadSeleccionados = frm.check_uno.value;
          }
      }

      if (strRadSeleccionados != "" ) {
        window.open({$INCLUIR_DOCS});
      } else {
        alert( "Error. Debe seleccionar por lo menos un \n\r documento a incluir en el expediente." );
        return false;
      }
    }

    // Crear Subexpediente
    function incluirSubexpediente( numeroExpediente, numeroRadicado ) {
      window.open({$INCLUIR_SUBEXP});
    }
  </script>
</head>
<body>
  <input type="hidden" name="ordenarPor" id="ordenarPor" value="">
  <input type="hidden" name="orden" id="orden" value="{$ORDEN}">
  <input type="hidden" name="verAnexos" id="verAnexos" value="">
  <input type="hidden" name="anexosRadicado" id="anexosRadicado" value="">

  {if $MOSTRAR_BORRADOS eq true}
		<input type="hidden" name="verBorrados" id="verBorrados" value="{$ANEXOS_RADICADOS}">
	{/if}
  <script>
    function digitoControl(cadena) {
      var cifras = new Array(71,67,59,53,47,43,41,37,29,23,19,17,13,7,3);
      var chequeo = 0;
      digito = cadena;
      digitosFalta =  15 - digito.length;

      for (var i=14; i >= 0; i--)
        chequeo += digito.charAt(i - digitosFalta) * cifras[i];

      chequeo = 11 - (chequeo % 11);
      
      if (chequeo == 11)
        chequeo = 0;
      
      if (chequeo == 10) 
        chequeo = 1;
      
      return chequeo;
    }
  </script>
	
  {if $MOSTRAR_DOCS}
  <input type="hidden" name="menu_ver_tmp" value="4">
  <input type="hidden" name="menu_ver" value="4">
  <table  cellspacing="5" width="98%" align="center" class="borde_tab">
    <tr>
      <td class="titulos5">
        <span class="leidos"> DOCUMENTO {$NOMBRE_DERI} <b>{$RADI_NUME_DERI}</b></span>
      </td>
    </tr>
  </table>
  <table border="0" width="98%" cellspacing="4" class="borde_tab" align="center">
  <!-- foreach -->
	<tr class="leidos2">
    <td class="listado5">
      <span class="leidos2">{$REF_RADICADO}</span>
	  </td>
	  <td class="listado5">
      <span class="leidos2">Fecha Rad:
	      <a href="{$ver_radicado}">{$fechaRadicadoPadre}</a>
      </span>
    </td>
    <td class="listado5">
      <span class="leidos2">Asunto:{$raAsunAnexo}</span>
    </td>
    <td class="listado5">
      <span class="leidos2">Ref:{$cuentaIAnexo}</span>
    </td>
  </tr>
  <!-- //foreach -->
</table>
	{/if}
<table border="0" width="98%" class="borde_tab" align="center" class="titulos2">
  <tr class="titulos2">
  {if $MOSTRAR_INSERTAR_EXP}
    <td align="left">
    <a href="#" onClick="insertarExpediente();" ><span class="leidos2"><b> INCLUIR EN</b></span></a>
  {if $PERMISO_EXPEDIENTE}
    <a href="#" onClick="verTipoExpediente('{$num_expediente}','{$codserie}','{$tsub}','{$tdoc}','MODIFICAR')" >
    <span class="leidos"><b>CREAR</b></span></a>
		{$MOSTRAR_ALERTA}
	{else}
    <td align="center" class="titulos2">
      <span class="titulos2" align="center">
        <b>ESTE DOCUMENTO SE ENCUENTRA INCLUIDO EN EL(LOS) SIGUIENTE(S) EXPEDIENTE(S).</b>
      </span>
    </td>
    <td align="center">
    </td>
    <td align="center" nowrap>
      <a href="#" onClick="insertarExpediente();" >
        <span class="leidos2"><b>INCLUIR EN</b></span>
      </a>
      <br/>
      <br/>
      <a href="#" onClick="excluirExpediente();" >
        <span class="leidos2"><b>EXCLUIR DE</b></span>
      </a>
      <br/>
      <br/>
      <a href="#" onClick="verTipoExpediente('{$num_expediente}',{$codserie},{$tsub},{$tdoc},'MODIFICAR')" >
        <span class="leidos"><b>CREAR</b></span>
      </a>
    </td>
  {/if}
  {/if}
  </tr>
</table>

<table border="0" width="98%" class='borde_tab' align="center" cellspacing=1 >
<tr>
  <td class="listado5" colspan="6">
    Nombre de Expediente
    <input name="num_expediente" type="text" size="30" maxlength="18" id="num_expediente" value="{$NUM_EXPEDIENTE}" class="tex_area" "{$DATOSS}">
    Responsable:
    <b>
      <span class="leidos2">
        {$RESPONSABLE}
      </span>
      </b>
			<input type="button" value="Cambiar" class="botones_3" onClick="Responsable('{$NUM_EXPEDIENTE}');">
			<input type="button" class="botones_mediano2" value="Cerrar Expediente" onClick=" CambiarE(2,'{$num_expediente}')">
			<input type="button" class="botones_mediano2" value="Reabrir Expediente" onClick=" CambiarE(1,'{$num_expediente}')">
    Nombre de Expediente
    <input name="num_expediente" type="text" size="30" maxlength="18" id='num_expediente' value="{$expIncluido}" class="tex_area" "{$datoss}">
      Responsable:<b>
      <span class="leidos2">
    {$responsable}</b>
<input type="button" value="Cambiar" class="botones_3" onClick="Responsable('{$num_expediente}')">
<br/>
			<input type="button" class="botones_mediano" value="Cerrar Expediente" onClick=" CambiarE(2,'{$num_expediente}');">
  <input type="button" class="botones_mediano" value="Reabrir Expediente" onClick=" CambiarE(1,'{$num_expediente}')">
    <input name="num_expediente" type="hidden" id='num_expediente' value="">
    <input type="hidden" name='funExpediente' id='funExpediente' value="">
    <input type="hidden" name='menu_ver_tmp' id='menu_ver_tmp' value="4">
    <a href="#" onClick="insertarExpediente();" >
      <span class="leidos">
        <strong>Incluir en</strong>
      </span>
    </a> &nbsp;
	  <a href="#" onClick="verTipoExpediente('{$num_expediente}',{$codserie},{$tsub},{$tdoc},'MODIFICAR')" >
		  <span class="leidos"><b>Crear</b></span>
	  </a>
	    <a href="#" onClick="verTipoExpedienteOld('{$num_expediente}')" ><span class="leidos"><b>Tipificar Expediente</b></span></a>
	//<input type="button" name="ASOC_EXP" value="Asociar Anexos a Este Expediente" class="botones_largo" >
	<br>{$mensaje}<br>
</td>
</tr>
<tr class="listado5">
<td class="listado5" width="42%" colspan="2">
&nbsp;&nbsp;&nbsp;&nbsp;Estado :<span class=leidos2> {$descFldExp}</span>&nbsp;&nbsp;&nbsp;
<input type="button" value="..." class=botones_2 onClick="modFlujo('{$num_expediente}',{$texp},{$codigoFldExp})"></td>
   <td colspan="2">Historia del Expediente :<span class=leidos2> </span>&nbsp;&nbsp;&nbsp;
	 <input type="button" value="..." class=botones_2 onClick="verHistExpediente('{$num_expediente}');">
	 </td>
  <td nowrap>Adicionar Proceso :<span class="leidos2"> </span>&nbsp;&nbsp;&nbsp;
    <input type="button" value="..." class=botones_2 onClick="crearProc('{$num_expediente}');">
  </td>
<td  nowrap>Seguridad Exp ({$nivelExp}) :<span class=leidos2> </span>&nbsp;&nbsp;&nbsp;
    <input type="button" value="..." class=botones_2 onClick="seguridadExp('{$num_expediente}','{$nivelExp}');">
  </td>
	<td>&nbsp;</td>	
</tr>
<tr>
  <td class="titulos5">
    TRD:
  </td>
  <td class="leidos2">
    {$arrTRDExp} / {$arrTRDExp}
  </td>
  <td rowspan="3">
    <table border="0" height="200%" cellspacing="1">
      <tr rowspan="4"   class="leidos2">
        <td colspan="2" class="titulos5">{$datos}:</td>
        <td colspan="2" >{$datos}</td>
      </tr>
    </table>
  </td>
</tr>
<tr >
  <td class="titulos5">
    Proceso:
  </td>
  <td colspan="4" class='leidos2'>
  </td>
</tr>
<tr >
  <td class="titulos5" nowrap>
    Fecha Inicio:
  </td>
  <td colspan="4" class='leidos2'>
    {$arrTRDExp}
  </td>
</tr>

<tr class='timparr'>
<td colspan="6" class="titulos5">
  <p>Documentos Pertenecientes al expediente &nbsp;</p>
        <p>
          <center>
            <a href="{$enlace_descarga}">
              <span class="leidos">
                DESCARGAR TODOS LOS DOCUMENTOS DEL EXPEDIENTE EN UN ARCHIVO COMPRIMIDO
              </span>
            </a>
          </center>
        </p>
        <table border="0" width="98%" class="borde_tab" align="center" cellpadding="0" cellspacing="0">
  <tr class="listado5" >
    <td>&nbsp;</td>
    <td align="center">
      <a href="#" onClick="javascript:ordenarPor( 'a.RADI_NUME_RADI' );">
      Radicado
      </a>
    </td>
  <td align="center">
    <a href="#" onClick="javascript:ordenarPor( 'a.RADI_FECH_RADI' );">
	Fecha Radicaci&oacute;n / Doc
    </a>
	</td>
	<TD align="center">
      <a href="#" onClick="javascript:ordenarPor( 'c.SGD_TPR_DESCRIP' );">
      Tipo<br> Documento
      </a>
    </TD>
	<TD align="center">
      <a href="#" onClick="javascript:ordenarPor( 'a.RA_ASUN' );">
      Asunto
      </a>
    </TD>
    <TD align="center">
      <a href="#" onClick="javascript:ordenarPor( 'r.SGD_EXP_SUBEXPEDIENTE' );">
      Subexpediente
      </a>
	</TD>
	</tr>
<tr class='tpar'>
  <td valign="baseline" class='listado1'>
    <img name="imgVerAnexos_{$radicado_d}" src="imagenes/menu.gif" border="0">
    <img name="imgVerAnexos_{$radicado_d}" src="imagenes/menuraya.gif" border="0">
    <img name="imgVerAnexos_{$radicado_d}" src="imagenes/menuraya.gif" border="0">
    <img name="imgVerAnexos_{$radicado_d}" src="imagenes/menu.gif" border="0">
  </td>
  <td valign="baseline" class='listado1'>
    <span class="leidos">{$ref_radicado}</span>
  </td>
<td valign="baseline" class='listado1' align="center" width="100">
  <span class="leidos2">
    {$radicado_fech}
  </span>
</td>
<TD valign="baseline" class='listado1' >
  <span class="leidos2">{$tipo_documento_desc}</span></TD>
<TD valign="baseline" class='listado1'>
  <span class="leidos2">
    {$rad_asun}
  </span>
</TD>
<td valign="baseline" class='listado1'>
<a href="#" onClick="incluirSubexpediente( '{$numExpediente}', {$radicado_d});">
    <span class="leidos2"> 
    </span>
  </a>
</td>
</tr>
	<tr  class='timpar'>
      <td valign="baseline" class='listado5'>&nbsp;</td>
  <td valign="baseline"  class='listado5'>
    <img src="iconos/docs_tree_del.gif">
    <img src="iconos/docs_tree.gif">
	  <a href="{$enlace_descarga}"></a>;
  </td>
  <td valign="baseline" class='listado5'>{$fechaDocumento}</td>
  <td valign="baseline" class='listado5'>{$tipo_documento_desc}</TD>
  <TD valign="baseline" class='listado5'><span class='leidos2'>{$anex_desc}</span></td>
  <TD valign="baseline" class='leidos2'>{$otroExpediente}</TD>
  <TD valign="baseline"  class='listado5'></TD>
  </tr>
</table>
  </td>
</tr>
<tr>
  <td class="titulosError" colspan="6" align="center">
    Nota.  En el momento de Grabar el expediente este aparecera en la pantalla de archivo para su re-ubicacion fisica. (Si no esta seguro de esto por favor no lo realice)
  </td>
</tr>
</table>
<p>
<table width="98%" class='borde_tab' cellspacing="0" cellpadding="0" align="center" id="tblAnexoAsociado">
  <tr>
    <td class="titulos5">Y ESTA RELACIONADO CON EL(LOS) SIGUIENTE(S) DOCUMENTOS:</td>
    <td class="titulos5" align="center">
      <a href="#tblAnexoAsociado" onClick="incluirDocumentosExp();" >
        <span class="leidos2"><b>INCLUIR DOCUMENTOS EN EXPEDIENTE</b></span>
      </a>
  </td>
  </tr>
</table>
<span class="tituloListado"> </span>
<table border="0" width="98%" class="borde_tab" align="center">
  <tr class='titulos5'>
    <td class="titulos5">
	  <input type="checkbox" name="check_todos" value="checkbox" onClick="todos( document.forms[1] );">
	</td>
    <td align="center">RADICADO</td>
    <td align="center">FECHA RADICACION</td>
    <td align="center">TIPO DOCUMENTO</td>
    <td align="center">ASUNTO</td>
    <td align="center">TIPO DE RELACION</td>
  </tr>
  <tr class="listado5">
    <td>
	  <input type="checkbox" name="check_uno" value="{$radicadoAnexo}" onClick="uno( document.forms[1] );">
	</td>
    <td>
    </td>
    <td>
      <a href="{$ruta_raiz}/verradicado.php?verrad={$radicadoAnexo}&krd={$krd}" target="VERRAD{$radicadoAnexo}">
          {$arrDatosRad}
      </a>
    </td>
    <td>
        {$arrDatosRad}
    </td>
    <td>
        {$arrDatosRad}
    </td>
    <td>
        {$tipoRelacion}
    </td>
  </tr>
</table>
</body>
</html>
