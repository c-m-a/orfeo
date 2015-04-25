  <hr/>
  <div class="row">
    <div class="col-md-3">
      <strong>Usuario actual:</strong>
    </div>
    <div class="col-md-3">
      {$USUARIO_ACTUAL}
    </div>
    <div class="col-md-3">
      <strong>Dependencia actual:</strong>
    </div>
    <div class="col-md-3">
      {$DEPENDENCIA_ACTUAL}
    </div>
  </div>
  <!-- row -->
  <div class="row">
    <div class="col-md-3">
      <strong>Usuario radicador:</strong>
    </div>
    <div class="col-md-3">
      {$USUARIO_RAD}
    </div>
    <div class="col-md-3">
      <strong>Dependencia de radicaci&oacute;n:</strong>
    </div>
    
    <div class="col-md-3">
      {$DEPENDENCIA_RAD}
    </div>
  </div>
  <hr/>
  <div class="row">
    <div class="col-md-12">
      <strong>FLUJO HISTORICO DEL DOCUMENTO</strong>
    </div>
  </div>
  <!-- row -->
  <div class="row">
    <table class="table table-striped table-hover">
      <tr>
        <th class="text-center">Fecha</th>
        <th class="text-center">Us. origen | Comentario | Transacci&oacute;n</th>
        <th class="text-center">Dependencia</th>
      </tr>
      {foreach $ESTADOS as $ESTADO}
      {strip}
      <tr> 
        <td>{$ESTADO.HIST_FECH1}</td>
        <td>
          {$ESTADO.GET_USUA_NOMB}<br/>
          {if $ESTADO.GET_DESCRIPCION}
          <strong>Tipo transacci&oacute;n:</strong> {$ESTADO.GET_DESCRIPCION}<br/>
          {/if}
          <strong>Comentario:</strong><br/>&nbsp;{$ESTADO.HIST_OBSE}
        </td>
        <td>
          {$ESTADO.DEPENDENCIA_NOMBRE}<br/>
        </td>
      </tr>
      {/strip}
      {/foreach}
    </table>
  </div>
  <hr/>
  <div class="row">
    <div class="col-md-12">
      <strong>DATOS DE ENVIO.</strong>
    </div>
  </div>
  <div class="row">
    <table class="table">
      <tr>
        <th>Radicado</th>
        <th>Dependencia</th>
        <th>Fecha</th>
        <th>Destinatario</th>      
        <th>Direccion</th>
        <th>Departamento</th>
        <th>Municipio</th>
        <th>Tipo de envio</th>
        <th>No. planilla</th>
        <th>Observaciones o descri/anexos</th>      
      </tr>
      {foreach $DATOS_CORRESPONDENCIA as $DATO_CORRESPONDENCIA}
      {strip}
      <tr>
        <td>{$DATO_CORRESPONDENCIA.IMA_RAD_DEV}{$DATO_CORRESPONDENCIA.RAD_ENVIADO}</td>
        <td>{$DATO_CORRESPONDENCIA.DEPE_NOMB}</td>
        <td>
          <a href="{$DATO_CORRESPONDENCIA.LINK_VER_RADICADO}" target="verrad$radEnviado">
            <span>{$DATO_CORRESPONDENCIA.SGD_RENV_FECH}</span>
          </a>
        </td>
        <td>{$DATO_CORRESPONDENCIA.SGD_RENV_NOMBRE}</td>
        <td>{$DATO_CORRESPONDENCIA.SGD_RENV_DIR}</td>
        <td>{$DATO_CORRESPONDENCIA.SGD_RENV_DEPTO}</td>
        <td>{$DATO_CORRESPONDENCIA.SGD_RENV_MPIO}</td>
        <td>{$DATO_CORRESPONDENCIA.SGD_FENV_DESCRIP}</td>
        <td>{$DATO_CORRESPONDENCIA.SGD_RENV_PLANILLA}</td>
        <td>{$DATO_CORRESPONDENCIA.SGD_RENV_OBSERVA}</td>
      </tr>
      {/strip}
      {/foreach}
    </table>
  </div>
