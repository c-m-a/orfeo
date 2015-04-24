<!DOCTYPE html>
<html>
<head>
<title>Enviar Datos</title>
<link rel="stylesheet" href="../estilos/orfeo.css">
</head>
<body bgcolor="#FFFFFF" topmargin="0">
<form action="{$ENLACE_SUBIR_ARCHIVO}" method="post" name="realizarTx" enctype="multipart/form-data">
<table border=0 width=100% cellpadding="0" cellspacing="0">
	<tr>
	<td width="100%">
		<br>
		<input type="hidden" name="depsel8" value="{$DEPSEL8}">
		<input type="hidden" name="codTx" value="{$CODTX}">
		<input type="hidden" name="EnviaraV" value="{$ENVIARAV}">
		<input type="hidden" name="fechaAgenda" value="{$FECHAAGENDA}">
		<table width="98%" border="0" cellpadding="0" cellspacing="5" class="borde_tab">
			<tr>
			<td width="30%" class="titulos4">
				USUARIO:<br><br>{$NOMBRE_USUARIO}
			</td>
			<td width='30%' class="titulos4">
				DEPENDENCIA:<br><br>{$NOMBRE_DEPENDENCIA}<br>
			</td>
			<td class="titulos4">Asociacion de Imagen a Radicado<BR></td>
			</tr>
			<tr align="center">
				<td colspan="4" class="celdaGris" align="center"><br>
				<center>
          <table width="500" border=0 align="center" bgcolor="White">
            <tr bgcolor="White">
              <td width="100">
                <center>
                <img src="{$SRC_IMAGEN_TUX}" alt="Tux Transaccion" title="Tux Transaccion">
                </center>
              </td>
              <td align="left">
                Observaci&oacute;n: {$OBSERVACION}
                <input type="hidden" name="observa" id="observa" value="{$OBSERVACION}">
              </td>
            </tr>
          </table>
				</center>
				<input type="hidden" name="enviar" value="enviarsi">
				<input type="hidden" name="enviara" value="9">
				<input type="hidden" name="carpeta" value="12">
				<input type="hidden" name="carpper" value="10001">
				</td>
			</tr>
			<tr>
				<td colspan="5" align="center">
  				<input type="hidden" name="MAX_FILE_SIZE" value="{$MAXIMO_TAMANO}"><br>
				<span class="leidos">Seleccione un Archivo (pdf o tif Tama&ntilde;o Max. {$MAX_TAMANO})<br>
          La ruta del Archivo es: {$RUTA_ARCHIVO}<br><br>
          <input type="file" name="upload" size="50" class="tex_area">
        </span>
					<input type="hidden" name="replace" value="y">
					<input type="hidden" name="valRadio" value="{$NUMERO_RADICADO}">
					<input name="check" type="hidden" value="y" checked>
  				</td>
  			</tr>
      <tr>
			<td colspan="4" class="grisCCCCCC">
        <center>
          <br>
				  <input type="submit" value="Realizar" name="Realizar" align="bottom" class="botones" id="Realizar">
			    </br>
        </center>
      </td>
      </tr>
		</table>
		<br>
	</td>
	</tr>
</table>
<input type="hidden" name="depsel" value="{$DEPSEL}">
