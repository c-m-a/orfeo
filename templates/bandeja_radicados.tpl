<!DOCTYPE html>
<html>
  <head>
    {include file="head.tpl"}
    <title>Orfeo Bandeja de {$NOMBRE_BANDEJA}</title>
  </head>
  
  <body>
    <!-- Fixed navbar -->
    {include file="barra_navegacion.tpl"}
    <!-- end navbar -->
    
    <div class="container">
      <!-- cabecera de informacion tpl -->
      {include file="cabecera_informacion.tpl"}
      <!-- end cabecera de informacion tpl -->
      <hr/>
      <!-- menu de opciones radicado -->
      {include file="opciones_radicado.tpl"}
      <!-- end menu de opciones radicado -->
      <form name="ejecutar_opcion" id="ejecutar_opcion" action="{$ENLACE_ENVIO}" method="GET">
        <div class="row">
          <div class="col-md-12">
            &nbsp;
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            {include file="tabla_radicados.tpl"}
          </div>
        </div>
      </form>
    </div>
    <!-- container -->
    
    <!-- footer -->
    {include file="footer.tpl"}
    <!-- end footer -->
  </body>
</html>
