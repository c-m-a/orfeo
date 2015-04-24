<table border="0" id="mod_sector" align="center" cellpadding="0" cellspacing="5" class="borde_tab"></table>
<table border="0" id="mod_causales" cellpadding="0" cellspacing="5" class="borde_tab" ></table>
<table border="0" id="mod_temas" align="center" cellpadding="0" cellspacing="5" class="borde_tab">
  <tr>
    <td align="center"  class="titulos2" >MODIFICAR TEMA</td>
  </tr>
  <tr>
    <td>
      {include file="mod_temas.tpl"}
      <form name="form_temas" method="post" action="{$ENLACE_OPC_ENVIO}">
        <table border="0" width="100%" cellpadding="0" cellspacing="5" class="borde_tab">
          <input type="hidden" name="ver_tema" value="Si ver Causales">
          <input type="hidden" name="carpeta" value="{$CARPETA}">
          <tr>
            <td class="titulos2"> Tema</td>
            <td width="323"> 
            {if $MOSTRAR_OPCIONES}
              <select name="tema" class="select">
                {$MOSTRAR_CODIGOS}
              </select>
            <input type="submit" name="grabar_tema" value="Grabar Cambio" class="botones">
            {else}
              {$MOSTRAR_ERROR}
            {/if}
            {if $ACTUALIZADO}
              <span class="info">Tema Actualizado</span>
            {else}
              <span class="alarmas">No se ha podido Actualizar el tema</span>
            {/if}
            </td>
          </tr>
        </table>
      </form>
    </td>
  </tr>
</table>
<table border="0" id="mod_bd_comple" cellpadding="0" cellspacing="5" class="borde_tab">
  <tr>
    <td align="center" class="titulos2">
      <p>BD COMPLEMENTARIAS </p>
    </td>
  </tr>
  <tr> 
    <td>
    {include file="db_complementarias.tpl"}
    </td>
  </tr>
</table>
