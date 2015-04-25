<!DOCTYPE html>
<html>
  <head>
    {include file="head.tpl"}
    <title>Datos del Radicado</title>
  </head>
  <body>
    <!-- Fixed navbar -->
    {include file="barra_navegacion.tpl"}
    <!-- end navbar -->
    
    <div class="container">
      <!-- cabecera de informacion tpl -->
      {include file="cabecera_informacion.tpl"}
      <!-- end cabecera de informacion tpl -->
      <div class="row">
        <div class="col-md-3">
          <a class="btn btn-info" href="javascript:history.back();">Volver</a>
        </div>
        <div class="col-md-6 text-center">
          <strong>DATOS DEL RADICADO No.</strong>
          {if $MOSTRAR_ENLACE_RADICADO}
            <a title='Click para modificar el Documento' href='{$ENLACE_RADICACION}'>{$NUMERO_RADICADO}</a>
          {else}
            {$NUMERO_RADICADO}
          {/if}
        </div>
        
        <div class="col-md-3 text-right">
            <a href="{$ENLACE_SOLICITADOS}">Solicitados</a>
            <a href="{$ENLACE_RESERVAR}">Solicitar Fisico</a>
        </div>
      </div>

      {if $MOSTRAR_EXPEDIENTE}
      <div class="row">
        <div class="col-md-6 col-md-offset-3 text-center">
            <strong>PERTENECIENTE AL EXPEDIENTE No.</strong> {$DATOS_EXPEDIENTE}
        </div>
      </div>
      {/if}
      <form name="form1" id="form1" action="{$ORFEO_URL}{$ENLACE_FORM_ENVIO}" method="GET">
        <!-- menu de opciones radicado -->
        {if $VER_OPCIONES_RADICADO}
          {include file="opciones_radicado.tpl"}
        {/if}
        <!-- end menu de opciones radicado -->
        <br/>
        <br/>
        <input type="hidden" name="checkValue[{$VER_RADICADO}]" value="CHKANULAR">
        <input type="hidden" name="enviara" value="9">
      </form>
      <div class="row">
        <div class="col-md-12">
          <div class="btn-group" role="group" aria-label="...">
            <a class="btn btn-sm btn-default" href="./ver_radicado.php?{$HDATOS}3" role="button">
              Informaci&oacute;n General
            </a>
            <a class="btn btn-sm btn-default" href="ver_radicado.php?{$HDATOS}1" role="button">
              Hist&oacute;rico
            </a>
            <a class="btn btn-sm btn-default" href="ver_radicado.php?{$HDATOS}2" role="button">
              Documentos
            </a>
            <a class="btn btn-sm btn-default" href="ver_radicado.php?{$HDATOS}4" role="button">
              Expedientes
            </a>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          {if $MOSTRAR_ERROR_CONSULTA}
          <strong>NO SE HA PODIDO REALIZAR LA CONSULTA</strong>
          {/if}
          {if $MOSTRAR_PESTANAS}
          <!-- carga la plantilla segun la pestana que este activa -->
          {include file="$PLANTILLA"}
          <input type="hidden" name="menu_ver" value="{$MENU_VER}">
        </div>
      </div>
          {else}
      <div class="row">
        <div class="col-md-12">
        <form name="form1" action="enviar.php" method='GET'>
          <input type="hidden" name="depsel">
          <input type="hidden" name="depsel8">
          <input type="hidden" name="carpper">
          SU SESION HA TERMINADO O HA SIDO INICIADA EN OTRO EQUIPO
        </form>
        </div>
      </div>
        {/if}
        {if $MOSTRAR_ERROR_SESION}
      <div class="row">
        <div class="col-md-12">
          <strong>NO TIENE AUTORIZACION PARA INGRESAR</strong>
          <a href="./index.php" target="_parent">Por Favor intente validarse de nuevo. Presione aca!</a>
        </div>
      </div>
        {/if}
    </div>
    <!-- footer -->
    {include file="footer.tpl"}
    <!-- end footer -->
  </body>
</html>
