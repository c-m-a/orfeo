<html>
<head>
<link rel="stylesheet" href="./estilos/orfeo.css">
<script src="./js/popcalendar.js"></script>
<script src="./js/mensajeria.js"></script>
<div id="spiffycalendar" class="text"></div>
</head>
<body bgcolor="#FFFFFF" topmargin="0" onLoad="window_onload();">
  {include file="encabezado.tpl"}
  <table width="100%" align="center" cellspacing="0" cellpadding="0" class="borde_tab">
    <tr class="tablas">
      <td>
	      <span class="etextomenu">
	        <form name="form_busq_rad" id="form_busq_rad" action='{$PHP_SELF}?{$ENCABEZADO}' method='POST'>
            Buscar radicado(s) (Separados por coma)
            <span class="etextomenu">
	   	        <input name="busqRadicados" type="text" size="40" class="tex_area" value="{$BUSQRADICADOS}">
	            <input type="submit" value="Buscar" name="Buscar" valign="middle" class="botones">
            </span>
            <input type="checkbox" name="chkCarpeta" value='xxx' {$CHKVALUE}> Todas las carpetas
	        </form>
        </span>
			</td>
		</tr>
  </table>
  <form name="form1" id="form1" action="./tx/formEnvio.php?{$ENCABEZADO}" method="GET">
  {include file="cuerpo_javascript.tpl"}
  {$LISTA_RADICADOS}
