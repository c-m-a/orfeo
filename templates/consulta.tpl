<html>
  <head>
    <title>Consulta</title>
  </head>
  <body>
    Promedio de dias de tramite de un radicado = {$PROMEDIO}
    <table>
      <tr>
        <td>No</td>
        <td>Radicado</td>
        <td>Fecha</td>
      </tr>
    {foreach $RADICADOS as $RADICADO}
    {strip}
      <tr>
        <td>{$RADICADO.contador}</td>
        <td>{$RADICADO.numero}</td>
        <td>{$RADICADO.dias}</td>
      </tr>
    {/strip}
    {/foreach}
    </table>
  </body>
</html>
