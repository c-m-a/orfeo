  <table class="table">
    <tr>
      <td>Usuario actual:</td>
      <td>{$USUARIO_ACTUAL}</td>
      <td>Dependencia actual:</td>
      <td>{$DEPENDENCIA_ACTUAL}</td>
    </tr>
    <tr>
      <td>Usuario radicador:</td>
      <td>{$USUARIO_RAD}</td>
      <td>Dependencia de radicaci&oacute;n:</td> 
      <td>{$DEPENDENCIA_RAD}</td>
    </tr>
   </table>
    <div class="row">
      <div class="col-md-12">
        FLUJO HISTORICO DEL DOCUMENTO
      </div>
    </div>
    <!-- row -->
  <table class="table">
    <tr>
      <th>Fecha</th>
      <th>Us. origen</th>
      <th>Dependencia</th>
      <th>Transacci&oacute;n | Comentario</th>
    </tr>
    {foreach $ESTADOS as $ESTADO}
    {strip}
    <tr> 
      <td>{$ESTADO.HIST_FECH1}</td>
      <td>{$ESTADO.GET_USUA_NOMB}</td>
      <td>{$ESTADO.DEPENDENCIA_NOMBRE}</td>
      <td>
        {if $ESTADO.GET_DESCRIPCION}
        <div class="row">
          <div class="col-md-8">
            <strong>Tipo transacci&oacute;n:</strong> {$ESTADO.GET_DESCRIPCION}
          </div>
        </div>
        {/if}
        <div class="row">
          <div class="col-md-8">
            <strong>Comentario:</strong><br/>&nbsp;{$ESTADO.HIST_OBSE}
          </div>
        </div>
      </td>
    </tr>
    {/strip}
    {/foreach}
  </table>
    <div class="row">
      <div class="col-md-12">
        DATOS DE ENVIO
      </div>
    </div>
  </table>
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
