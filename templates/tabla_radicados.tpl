  <div class="row">
    <table class="table table-striped table-hover" id="tabla_radicados">
      <tr>
        {foreach $TITULOS as $TITULO}
        {strip}
        {if $TITULO.nombre eq 'Radicado'}
        <th class="text-center" colspan="2">
          <a href="{$TITULO.enlace}">
            <span>{$TITULO.nombre}</span>
          </a>
        </th>
        {else}
        <th class="text-center">
          <a href="{$TITULO.enlace}">
            <span class="titulos3">{$TITULO.nombre}</span>
          </a>
        </th>
        {/if}
        {/strip}
        {/foreach}
      </tr>
      {foreach $RADICADOS as $RADICADO}
      {strip}
      <tr>
        <td>
          <span class="{$RADICADO.HID_RADI_LEIDO}">
            <center>
              <input type="checkbox" name="checkValue[{$RADICADO.IDT_NUMERO_RADICADO}]" value="CHKANULAR">
            </center>
          </span>
        </td>
        <td>
          <span class="{$RADICADO.HID_RADI_LEIDO}">
            {if $RADICADO.ruta_imagen}
            <a href="{$RADICADO.ruta_imagen}">
              <span class="{$RADICADO.HID_RADI_LEIDO}">{$RADICADO.IDT_NUMERO_RADICADO}</span>
            </a>
            {else}
            <span class="{$RADICADO.HID_RADI_LEIDO}">{$RADICADO.IDT_NUMERO_RADICADO}</span>
            {/if}
            &nbsp; | &nbsp;
          </span> 
          <a href="{$RADICADO.enlace_ver_radicado}" style="text-decoration:none;">
            <span class="{$RADICADO.HID_RADI_LEIDO}">
              {if $RADICADO.ASUNTO}
                {$RADICADO.ASUNTO}
              {else}
                (Sin Asunto!!)
              {/if}
            </span>
            {if $RADICADO.entidad}
            <span class="{$RADICADO.HID_RADI_LEIDO}">
              <br>&nbsp;&nbsp;&nbsp;Entidad: {$RADICADO.entidad}
               &nbsp;({$RADICADO.sigla})
              {if $RADICADO.nivel_supervision}
                <br>&nbsp;&nbsp;&nbsp;Nivel Supervision: {$RADICADO.nivel_supervision}
              {else}
                <br>
              {/if}
              {if $RADICADO.funcionario}
                &nbsp;&nbsp; | &nbsp;&nbsp Funcionario encargado: {$RADICADO.funcionario}
              {/if}
            </span>
            {else}
            <span class="{$RADICADO.HID_RADI_LEIDO}">&nbsp;</span>
            {/if}
            <span class="{$RADICADO.HID_RADI_LEIDO}">
              {if $RADICADO.REMITENTE}
                <br>&nbsp;&nbsp;&nbsp;<strong>Remitente:</strong> {$RADICADO.REMITENTE}
              {/if}
            </span>
          </a>
        </td>
        <td class="text-center">
          <a href="{$RADICADO.enlace_ver_radicado}" style="text-decoration:none;display:block;">
            <span class="{$RADICADO.HID_RADI_LEIDO}">
              {$RADICADO.TIPO_DOCUMENTO} <br>
            </span>
          </a>
        </td>
        <td>
          <span class="{$RADICADO.HID_RADI_LEIDO}" style="text-align: right;">
            <center>
              <a href="{$RADICADO.enlace_ver_radicado}" style="text-decoration:none;">
                <span class="{$RADICADO.HID_RADI_LEIDO}">
                  {$RADICADO.DAT_FECHA_RADICADO} <br>
                  {if $RADICADO.DIAS_RESTANTES}
                    ({$RADICADO.DIAS_RESTANTES}) D. restantes
                  {/if}
                </span>
              </a>
            </center>
          </span>
        </td>
      </tr>
    {/strip}
    {/foreach}
    </table>
  </div>
  <center>{$PAGINADOR}</center>
