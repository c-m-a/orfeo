<!-- Cabeza de la Pagina -->
<div class="row">
  <div class="col-md-8">
    <form name="form_busq_rad" class="form-inline" role="form" id="form_busq_rad" action='{$PHP_SELF}?{$ENCABEZADO}' method='POST'>
      <div class="input-group">
        <input class="form-control" type="text" name="busqRadicados" placeholder="Buscar radicado(s) (Separados por coma)" value="{$BUSQRADICADOS}">
        <span class="input-group-btn">
          <button class="btn btn-success" type="button" name="Buscar" value="Buscar">Buscar</button>
        </span>
      </div>
      <input type="checkbox" name="chkCarpeta" value="xxx" {$CHKVALUE}> Todas las carpetas
    </form>
  </div>
  <div class="col-md-4">
    <strong>DEPENDENCIA:</strong> {$DEPE_NOMB}
  </div>
</div>
<div class="row">
  <div class="col-md-6">
    <input type="text" class="datepicker">
    <button type="button" class="btn btn-info btn-sm">Agendar</button>
  </div>
  <div class="col-md-6">
    <div class="btn-group btn-group-justified">
      <a href="#" class="btn btn-info btn-sm">Mover</a>
      <a href="#" class="btn btn-info btn-sm">Reasignar</a>
      <a href="#" class="btn btn-info btn-sm">Informar</a>
      <a href="#" class="btn btn-info btn-sm">Devolver</a>
      <a href="#" class="btn btn-info btn-sm">Vo Bo</a>
      <a href="#" class="btn btn-info btn-sm">Archivar</a>
      <a href="#" class="btn btn-info btn-sm">TRD</a>
    </div>
  </div
</div>
<div class="row">
  <div class="col-md-12">
    <table>
      <tr>
    {if !$swBusqDep}

    {else}
      <td>
        <table width="100%" border="0" cellspacing="5" cellpadding="0">
         <tr class="info" height="20">
          <td bgcolor="8cacc1">
            <div align="left" class="titulo1">DEPENDENCIA</div>
          </td>
         </tr>
        <tr>
        <form name="formboton" action='{$ACCION}' method='GET'>
          <input type="hidden" name="estado_sal" value='{$ESTADO_SAL}'>
            <td height="1">{$SELECT_MENU}</td>
        </form>
        </tr>
      </table>
    </td>
    {/if}
    </tr>
    </table>
    <!-- include file="cuerpo_javascript.tpl" -->
    <div class="row">
    <form name="form1" id="form1" action="./tx/formEnvio.php?{$ENCABEZADO}" method="GET">
      <div class="row">
        <div class="col-md-2">
          <h6>
            <p class="text-center">
              <input type="checkbox" name="checkAll" value="checkAll">
              <strong><a href='./cuerpo.php{$LINK_PAGINA}'>Numero Radicado</a></strong>
            </p>
          </h6>
        </div>
        <div class="col-md-2">
          <h6>
            <strong>
            <p class="text-center">
              <a href='./orfeoCmauricio/cuerpo.php{$LINK_PAGINA}'>
                <img src=./iconos/flechadesc.gif border="0">Fecha Radicado
              </a>
            </p>
            </strong>
          </h6>
        </div>
        <div class="col-md-2">
          <h6>
            <p class="text-center">
              <strong>
                <a href='./cuerpo.php{$LINK_PAGINA}'>Asunto</a>
              </strong>
            </p>
          </h6>
        </div>
        <div class="col-md-1">
          <h6>
            <p class="text-center">
              <strong>
                <a href='./cuerpo.php{$LINK_PAGINA}'>Ent Solidaria y Sigla</a>
              </strong>
            </p>
          </h6>
        </div>
        <div class="col-md-1">
          <h6>
            <p class="text-center">
              <strong>
                <a href='./cuerpo.php{$LINK_PAGINA}'>Nivel Supervision</a>
              </strong>
            </p>
          </h6>
        </div>
        <div class="col-md-1">
          <h6>
            <p class="text-center">
              <strong>
                <a href='./cuerpo.php{$LINK_PAGINA}'>Tipo Documento</a>
              </strong>
            </p>
          </h6>
        </div>
        <div class="col-md-1">
          <h6>
            <p class="text-center">
              <strong>
                <a href='./cuerpo.php{$LINK_PAGINA}'>Dias Restantes</a>
              </strong>
            </p>
          </h6>
        </div>
        <div class="col-md-1">
          <h6>
            <p class="text-center">
              <strong>
                <a href='./cuerpo.php{$LINK_PAGINA}'>Enviado Por / Funcionario</a>
              </strong>
            </p>
          </h6>
        </div>
        <div class="col-md-1">
          <h6>
            <p class="text-center">
              <strong>
                <a href='./cuerpo.php{$LINK_PAGINA}'>Grupo</a>
              </strong>
            </p>
          </h6>
        </div>
      </div>
      {foreach $RADICADOS as $RADICADO}
      {strip}
      <div class="row">
        <div class="col-md-2">
          <h6>
            <p class="text-center">
              <input type=checkbox name='checkValue[{$RADICADO.IDT_Numero_Radicado}]' value='CHKANULAR'>
              <img src='#./iconos/comentarios.gif' width=18 height=18 alt='Carpeta Actual:  -- Numero de Hojas :1' title='Carpeta Actual:  -- Numero de Hojas :1'>&nbsp;&nbsp;
              <a href='' onclick="descargar_archivo('descargar_archivo.php?ruta_archivo={$RADICADO.HID_RADI_PATH}');return false;">{$RADICADO.IDT_Numero_Radicado}</a>
            </p>
          </h6>
        </div>
        <div class="col-md-2">
          <h6>
            <p class="text-center">
              <a href="#" onclick="ver_radicado('./verradicado.php{$LINK_PAGINA}&verrad={$RADICADO.HID_RADI_NUME_RADI}');return false;">{$RADICADO.DAT_Fecha_Radicado}</a>
            </p>
          </h6>
        </div>
        <div class="col-md-2">
          <h6>{$RADICADO.Asunto}</h6>
        </div>
        <div class="col-md-1">
          <h6><strong>{$RADICADO.ENT_SOLIDARIA}</strong><br>{$RADICADO.SIGLA}</h6>
        </div>
        <div class="col-md-1">
          <h6>
            <p class="text-center">
              {$RADICADO.NIVEL_SUPERVISION}
            </p>
          </h6>
        </div>
        <div class="col-md-1">
          <h6>{$RADICADO.Tipo_Documento}</h6>
        </div>
        <div class="col-md-1">
          <h6>
            <p class="text-center">
              {$RADICADO.Dias_Restantes}
            </p>
          </h6>
        </div>
        <div class="col-md-1">
          <h6>
            <p>{$RADICADO.Enviado_Por}</p>
            <p>{$RADICADO.FUNCIONARIO}</P>
          </h6>
        </div>
        <div class="col-md-1">
          <h6>{$RADICADO.GRUPO}</h6>
        </div>
      </div>
      {/strip}
      {/foreach}
    <tr>
    </form>
  </div>
</div
