<br>
<center>
  <table width="100%">
    <tr>
      <th class="titulos3">No.</th>
      <th class="titulos3">RADICADO</th>
      <th class="titulos3">ASUNTO</th>
      <th class="titulos3">USUARIO</th>
      <th class="titulos3">FECHA</th>
      <th class="titulos3">ACCESO</th>
      <th class="titulos3">ACCION</th>
      <th class="titulos3">DIRECCION IP</th>
    </tr>
    {foreach $DATOS_AUDITORIA as $AUDITORIA}
    {strip}
    <tr class="{cycle values="listado1,listado2"}">
      <td>
        <span class="leidos">
          <center>{$AUDITORIA.numero}</center>
        </span>
      </td>
      <td>
        <span class="leidos">
          <center>{$AUDITORIA.radicado}</center>
        </span>
      </td>
      <td>
        {if $AUDITORIA.asunto}
        <span class="leidos">
          <center>{$AUDITORIA.asunto}</center>
        </span>
        {else}
        <span class="leidos">Sin Asunto</span>
        {/if}
      </td>
      <td>
        <span class="leidos">
          <center>{$AUDITORIA.usua_login}</center>
        </span>
      </td>
      <td>
        <span class="leidos">
          <center>{$AUDITORIA.unix_time}</center>
        </span>
      </td>
      {if $AUDITORIA.desde_donde}
      <td><span class="leidos">{$AUDITORIA.desde_donde}</span></td>
      {else}
      <td>
        <span class="leidos">
          <center>desde estad&iacute;sticas u<br> otro modulo</center>
        </span>
      </td>
      {/if}
      <td>
        <span class="leidos">
          <center>{$AUDITORIA.tipo}</center>
        </span>
      </td>
      <td>
        <span class="leidos">
          <center>{$AUDITORIA.ip_cliente}</center>
        </span>
      </td>
    </tr>
    {/strip}
    {/foreach}
  </table>
</center>
