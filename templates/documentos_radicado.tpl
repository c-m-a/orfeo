<table width="100%" class="borde_tab" border="0">
  <tr class="tpar">
  <td class="tpar">
  <table cols='21' width="100%" border="0" cellpadding="0" cellspacing="5" class="borde_tab">
    <tr>
      <th class="titulos3">
        <a href="/orfeo-3.8.0pruebas/cuerpo.php{$LINK_PAGINA}">
          <span class=titulos3>Numero Radicado</span>
        </a>
      </th>
    </tr>
{foreach $RADICADOS as $RADICADO}
{strip}
      <tr class='listado1' valign='top'>
        <td>
          <span class="leidos">
            <img src="./iconos/comentarios.gif" width="18" height="18" alt='Carpeta Actual: -- Numero de Hojas :1' title='Carpeta Actual: -- Numero de Hojas :1'>
              <a href="./descargar_archivo.php?ruta_archivo={$RADICADO.HID_RADI_PATH}">
                <span class="leidos">{$RADICADO.IDT_Numero_Radicado}</span>
              </a>
            </span>
          </td>
          <td>
            <span class="leidos">
              <a href='./verradicado.php{$LINK_PAGINA}&verrad={$RADICADO.HID_RADI_NUME_RADI}'>
                <span class=leidos>{$RADICADO.DAT_Fecha_Radicado}</span>
              </a>
            </span>
          </td>
          <td>
            <span class=leidos>{$RADICADO.Asunto}</span>
          </td>
          <td>
            <span class=leidos></span>
          </td>
          <td>
            <span class=leidos>{$RADICADO.SIGLA}</span>
          </td>
          <td>
            <span class=leidos>{$RADICADO.NIVEL_SUPERVISION}</span>
          </td>
          <td>
            <span class=leidos>{$RADICADO.Tipo_Documento}</span>
          </td>
          <td>
            <span class=leidos>{$RADICADO.Dias_Restantes}</span>
          </td>
          <td>
            <span class=leidos>{$RADICADO.Enviado_Por}</span>
          </td>
          <td>
            <span class=leidos>{$RADICADO.FUNCIONARIO}</span>
          </td>
          <td>
            <span class=leidos>{$RADICADO.GRUPO}</span>
          </td>
          <td>
            <span class=leidos>
              <input type=checkbox name='checkValue[{$RADICADO.IDT_Numero_Radicado}]' value='CHKANULAR'>
            </span>
          </td>
        </tr>
{/strip}
{/foreach}
      </table>
    </td>
  <tr>
</table>
