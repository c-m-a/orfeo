<!DOCTYPE html>
<html>
  <head>
    <script language="JavaScript">
    <!--
      function Actual()
      {
      var Obj = document.getElementById('idpais');
      var i = Obj.selectedIndex;
      document.getElementById('txtModelo').value = Obj.options[i].text;
      document.getElementById('txtIdPais').value = Obj.value;
      }

      function rightTrim(sString)
      {	while (sString.substring(sString.length-1, sString.length) == ' ')
        {	sString = sString.substring(0,sString.length-1);  }
        return sString;
      }

      function ver_listado()
      {
        window.open('listados.php?var=pai','','scrollbars=yes,menubar=no,height=600,width=800,resizable=yes,toolbar=no,location=no,status=no');
      }
    //-->
    </script>
    {include file="head.tpl"}
    <title>Orfeo - Admor de paises.</title>
  </head>
  <body>
    <!-- Fixed navbar -->
    {include file="barra_navegacion.tpl"}
    <!-- end navbar -->
    <form name="form1" method="post" action="{$ENLACE_EJECUTAR}">
    <input type="hidden" name="hdBandera" value="">
    <div class="container">
    <table class="table">
<tr>
	<td colspan="3" height="40" align="center" class="titulos4" valign="middle"><b><span class=etexto>ADMINISTRADOR DE PAISES</span></b></td>
</tr>
<tr bordercolor="#FFFFFF"> 
	<td width="3%" align="center" class="titulos2"><b>1.</b></td>
	<td width="25%" align="left" class="titulos2"><b>&nbsp;Seleccione Continente</b></td>
	<td width="72%" class="listado2">
	  {$CONTINENTES}
  </td>
</tr>
<tr bordercolor="#FFFFFF"> 
	<td align="center" class="titulos2"><strong>2.</strong></td>
	<td align="left" class="titulos2"><b>&nbsp;Seleccione Pa&iacute;s</b></td>
  <td align="left" class="listado2">
    {$PAISES}
  </td>
</tr>
<tr bordercolor="#FFFFFF"> 
	<td rowspan="2" valign="middle" class="titulos2"><strong>3.</strong></td>
	<td align="left" class="titulos2"><b>&nbsp;Ingrese c&oacute;digo de pa&iacute;s</b></td>
	<td class="listado2"><input name="txtIdPais" id="txtIdPais" type="text" size="10" maxlength="3"></td>
</tr>
<tr bordercolor="#FFFFFF"> 
	<td align="left" class="titulos2">
    <b>&nbsp;Ingrese nombre pa&iacute;s</b></td>
	<td class="listado2"><input name="txtModelo" id="txtModelo" type="text" size="50" maxlength="30"></td>
</tr>
<tr bordercolor="#FFFFFF"> 
	<td width="3%" align="justify" class="info" colspan="3" bgcolor="#FFFFFF"><b>NOTA: </b> Para una estandarizaci&oacute;n en los c&oacute;digos de pa&iacute;ses utilicemos los sugeridos por la ISO.  <a href="http://es.wikipedia.org/wiki/ISO_3166-1" target="_blank" class="vinculos">enlace</a></td>
</tr>
{$MSG_ERROR}
</table>
<table class="table">
<tr bordercolor="#FFFFFF">
	<td width="10%" class="listado2">&nbsp;</td>
	<td width="20%"  class="listado2">
		<span class="celdaGris"> <span class="e_texto1"><center>
		<input name="btn_accion" type="button" class="btn btn-warning" id="btn_accion" value="Listado" onClick="ver_listado();">
		</center></span>
	</td>
	<td width="20%" class="listado2">
		<span class="e_texto1"><center>
		<input name="btn_accion" type="submit" class="btn btn-warning" id="btn_accion" value="Agregar" onClick="document.form1.hdBandera.value='A'; return ValidarInformacion();">
		</center></span>
	</td>
	<td width="20%" class="listado2">
		<span class="e_texto1"><center>
		<input name="btn_accion" type="submit" class="btn btn-warning" id="btn_accion" value="Modificar" onClick="document.form1.hdBandera.value='M'; return ValidarInformacion();">
		</center></span>
	</td>
	<td width="20%" class="listado2">
		<span class="e_texto1"><center>
		<input name="btn_accion" type="submit" class="btn btn-warning" id="btn_accion" value="Eliminar" onClick="document.form1.hdBandera.value='E'; return ValidarInformacion();">
		</center></span>
	</td>
	<td width="10%" class="listado2">&nbsp;</td>
</tr>
</table>
</div>
</form>

<script ID="clientEventHandlersJS" LANGUAGE="JavaScript">
<!--
function ValidarInformacion() {
  var strMensaje = "Por favor ingrese las datos.";
	
	if (document.form1.idcont.value == "0") {
    alert("Debe seleccionar el continente.\n" + strMensaje);
		document.form1.idcont.focus();
		return false;
	}
	
	if ( rightTrim(document.form1.txtIdPais.value) <= "0") {
    alert("Debe ingresar el Codigo de Pais.\n" + strMensaje);
		document.form1.txtIdPais.focus();
		return false;
	} else if(isNaN(document.form1.txtIdPais.value)) {
    alert("El Codigo de Pais debe ser numerico.\n" + strMensaje);
		document.form1.txtIdPais.select();
		document.form1.txtIdPais.focus();
		return false; 
	}
	
	if (document.form1.hdBandera.value == "A") {
    if(rightTrim(document.form1.txtModelo.value) == "") {
      alert("Debe ingresar nombre del Pais.\n" + strMensaje);
			document.form1.txtModelo.focus();
			return false; 
		} else {
      document.form1.submit();	
		}
	}
	else if(document.form1.hdBandera.value == "M") {
    if(rightTrim(document.form1.txtModelo.value) == "") {
      alert("Primero debe seleccionar el Pais a modificar.\n" + strMensaje);	
			return false; 
		} else {
      document.form1.submit();	
		}
	}

	else if(document.form1.hdBandera.value == "E") {
    if(confirm("Esta seguro de borrar el registro ?\n La eliminaci\xf3n de este pais incluye sus Dptos y municipios.")) {
      document.form1.submit();
    } else {
      return false;
    }
	}
}
//-->
</script>
</body>
</html>
