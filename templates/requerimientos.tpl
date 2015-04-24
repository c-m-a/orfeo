  <p>
    Estos son los requerimientos que se necesitan para instalar el sistema
    <strong>Orfeo Plus</strong> en su sistema.
  </p>

  {foreach $REQS_PHP AS $REQ}
  {strip}
  <div class="alert {$REQ.tipo_lib}">
    {$REQ.numeral}. {$REQ.etiqueta} ... <strong>{$REQ.resultado}</strong>
  </div>
  {/strip}
  {/foreach}
