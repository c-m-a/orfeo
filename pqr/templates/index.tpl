<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <link href="../estilos/orfeo.css" rel="stylesheet" type="text/css">
        <script language="javascript" src="./js/jquery-1.2.6.min.js">
        </script>
        <script language="javascript" src="./js/funcion.js">
        </script>
	<!-- Include the javascript -->
	<script src="../include/multiple-file-element/multifile_compressed.js"></script>
<script>
function validarEmail() {
valor = document.getElementById('txtCorr').value;
   if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3,4})+$/.test(valor)){
    alert("La direcci�n de email >" + valor + " es correcta.");
  } else {
    alert("La direcci�n de email es incorrecta.");
  }
}
</script>
<SCRIPT>
var upArchivos;
function init() {
	document.getElementById('file_upload_form').onsubmit=function() {
		document.getElementById('file_upload_form').target = 'upload_target'; //'upload_target' is the name of the iframe
	}
}
window.onload=init;
function varArchivos(newArchivo){
  
	upArchivos = "," +newArchivo;
	<!-- document.getElementById("archivosUp").innerHTML = "<table>--></table>"; -->
}
</SCRIPT>
    </head>
    <body>
        <form id="form1" name="form1" method="post" action="radicacion_pqr.php" onSubmit="return validar_contacto(this);">
            <table width="530" border="1" align="center" cellpadding="0" cellspacing="00" class="tablas">
                <tr bordercolor="#FFFFFF">
                    <td colspan="3" class='titulos5'cellpadding="6">
                        En esta secci&oacute;n usted puede formular las Peticiones, Quejas, Reclamos, Consultas, Solicitudes,
                        Sugerencias y/o Tramites sobre los temas de competencia del DNP.
                        Escriba sus datos y el detalle de la solicitud, aseg&uacute;rese de dejarnos
                        la informaci&oacute;n necesaria para responderle. Para enviar el mensaje,
                        haga clic en el recuadro &quot;Enviar&quot;
                    <input type="hidden" name="paginaOrigen" value='<!--{$paginaOrigen}-->'  />
                    <input type="hidden" name="mrecCodi" value='<!--{$mrecCodi}-->'  />
                    </td>
                </tr>
                <tr bordercolor="#FFFFFF">
                    <td width="3%" align="center" class="titulos2">
                        <b>1.</b>
                    </td>
                    <td width="25%" align="left" class="titulos2">
                        <b>Tipo de solicitud</b>
                    </td>
                    <td width="72%" class="listado2">
                        <!--{if $especial neq ""}-->
                        <select name="tipoSolicitud" id="tipoSolicitud" onchange="mostrar(this.selectedIndex)" onmouseover="ocultar(this.selectedIndex)">
                            <!--{foreach key=key item=item from=$tipos}--><option value=<!--{$key}-->><!--{$item}--></option>
                            <!--{/foreach}-->
                        </select>
                        Numero xx: <input name="numerox" id="numerox" type="text" size="20" maxlength="20"><span class="porExcluir">*</span>
                        <br>
                        <!--{foreach key=key item=item from=$descrip}-->
                        <div id='<!--{$key}-->' name='capa<!--{$key}-->' style="position:absolute;visibility:hidden;width:370px;float:left;background-color: #FF9900;color:#ffffff;">
                            <!--{$item}-->
                        </div>
                        <!--{/foreach}--><!--{else}-->
                        <select name="tipoSolicitud" id="tipoSolicitud" onchange="mostrar(this.selectedIndex)" onmouseover="ocultar(this.selectedIndex)">
                            <option value="0" selected="selected">-- Seleccione un tipo --</option>
                            <!--{foreach key=key item=item from=$tipos}--><option value=<!--{$key}-->><!--{$item}--></option>
                            <!--{/foreach}-->
                        </select>
                        <span class="porExcluir">*</span>
                        <br>
                        <!--{foreach key=key item=item from=$descrip}-->
                        <div id='<!--{$key}-->' name='capa<!--{$key}-->' style="position:absolute;visibility:hidden;width:370px;float:left;background-color: #FF9900;color:#ffffff;">
                            <!--{$item}-->
                        </div>
                        <!--{/foreach}--><!--{/if}-->
                        <br>
                        <br>
                        <br>
                    </td>
                </tr>
                <tr bordercolor="#FFFFFF">
                    <td width="3%" align="center" class="titulos2">
                        2.
                    </td>
                    <td class="titulos2">
                        Nombres
                    </td>
                    <td width="72%" class="listado2">
                        <input name="txtNomb" id="txtNomb" type="text" size="50" maxlength="80"><span class="porExcluir">*</span>
                    </td>
                </tr>
                <tr bordercolor="#FFFFFF">
                    <td width="3%" align="center" class="titulos2">
                        3.
                    </td>
                    <td class="titulos2">
                        Apellidos
                    </td>
                    <td width="72%" class="listado2">
                        <input name="txtApell" id="txtApell" type="text" size="50" maxlength="50"><span class="porExcluir">*</span>
                    </td>
                </tr>
                <tr bordercolor="#FFFFFF">
                    <td width="3%" align="center" class="titulos2">
                        4.
                    </td>
                    <td class="titulos2">
                        Departamento
                    </td>
                    <td width="72%" class="listado2">
                        <select name="parent" id="parent">
                            <option value="0" selected="selected">-- Seleccione un Departamento
                                --</option>
                            <!--{foreach key=key item=item from=$Departamento}--><option value=<!--{$key}-->><!--{$item}--></option>
                            <!--{/foreach}-->
                        </select>
                    </td>
                </tr>
                <tr bordercolor="#FFFFFF">
                    <td width="3%" align="center" class="titulos2">
                        5.
                    </td>
                    <td class="titulos2">
                        Municipio
                    </td>
                    <td width="72%" class="listado2">
                        <select name="child" id="child">
                            <!--{section name=arreglo loop=$Municipio}--><option class="sub_<!--{$Municipio[arreglo].DPTO_CODI}-->" value=<!--{$Municipio[arreglo].MUNI_CODI}-->><!--{$Municipio[arreglo].MUNI_NOMB}--></option>
                            <!--{/section}-->
                        </select>
                    </td>
                </tr>
                <tr bordercolor="#FFFFFF">
                    <td width="3%" align="center" class="titulos2">
                        6.
                    </td>
                    <td class="titulos2">
                        Direcci&oacute;n
                    </td>
                    <td width="72%" class="listado2">
                        <input name="txtDir" id="txtDir" type="text" size="50" maxlength="100">
                    </td>
                </tr>
                <tr bordercolor="#FFFFFF">
                    <td width="3%" align="center" class="titulos2">
                        7.
                    </td>
                    <td class="titulos2">
                        Tel&eacute;fono
                    </td>
                    <td width="72%" class="listado2">
                        <input name="txtTel" id="txtTel" type="text" size="50" maxlength="50">
                    </td>
                </tr>
                <tr bordercolor="#FFFFFF">
                    <td width="3%" align="center" class="titulos2">
                        8.
                    </td>
                    <td class="titulos2">
                        Correo Electr&oacute;nico
                    </td>
                    <td width="72%" class="listado2">
                        <input name="txtCorr" id="txtCorr" type="text" size="50" maxlength="50"><span class="porExcluir">*</span>
                    </td>
                </tr>
            </table>
            <table width="530" border="1" align="center" cellpadding="0" cellspacing="0" class="tablas">
                <tr bordercolor="#FFFFFF">
                    <td colspan="3" height="40" align="center" class="titulos4" valign="middle">
                        <b><span class=etexto>Pregunta o comentario con menos de 800 letras. los caracteres adicionales seran eliminados</span></b>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div align="center" class="error">
                            <!--{$error}-->
                        </div>
                    </td>
                </tr>
                <tr bordercolor="#FFFFFF">
                    <td width="3%" align="center" class="info" colspan="3" bgcolor="#FFFFFF">
                        <textarea name="txInfo" id="txInfo" cols="80" onKeyUp="return maximaLongitud(this,800)" rows="15" wrap="virtual" class="tex_area"></textarea>
                    </td>
                </tr>
            </table>
            <table width="530" border="1" align="center" cellpadding="0" cellspacing="0" class="tablas">
                <tr bordercolor="#FFFFFF">
                    <td width="50%" class="listado2">
                        <span class="e_texto1">
                            <center>
                                <input type="submit" name="Submit" value="Enviar"   class="botones"  />
                            </center>
                        </span>
                    </td>
                    <td width="50%" class="listado2">
                        <span class="e_texto1">
                            <center>
                                <input type="reset" name="Submit2"  value="Limpiar"  class="botones" />
                            </center>
                        </span>
                    </td>
                </tr>
            </table>
			<input type=hidden name=identificadorArchivos value="<!--{$identificadorArchivo}-->">
        </form>
		
		<table width="530" border="1" align="center" cellpadding="0" cellspacing="0" class="tablas">
    <tr bordercolor="#FFFFFF">
        <td width="100%" class="listado2" >
<form id="file_upload_form" method="post" enctype="multipart/form-data" action="../include/uploadAjax/upload.php?identificadorArchivo=<!--{$identificadorArchivo}-->">
<input name="file" id="file" size="50" type="file" />
<input type="submit" name="action" value="Adjuntar" /><br />
<iframe id="upload_target" name="upload_target" src="" style="border:0px solid #fff;">Archivos 
</iframe>
<div id='archivosUp' name=archivosUp>
 aaa
</div>
</form>
		</td></tr>
</table>
    </body>
</html>