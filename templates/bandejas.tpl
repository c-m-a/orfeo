<ul class="nav nav-pills nav-stacked">
  {foreach $BANDEJAS as $BANDEJA}
  <li class="{$BANDEJA.ACTIVE}">
    <a href="#" onclick="cargar_bandeja('{$BANDEJA.ENLACE}');return false;" id="{$BANDEJA.NOMBRE_BANDEJA}">{$BANDEJA.NOMBRE_BANDEJA}<span class="badge">{$BANDEJA.TOTAL_RADICADOS}</span></a>
  </li>
  {/foreach}
</ul>
