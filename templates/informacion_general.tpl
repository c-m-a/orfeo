  <script>
    function regresar() {
      window.location.reload();
    }
  </script>
  <table class="table">
    <tr>
      <td colspan="2">
      <strong>ASUNTO:</strong>
      <br/>
      {$ASUNTO_RADICADO}
    </td>
    <td></td>
    <td colspan="3">
      <strong>Fecha de radicado:</strong>
      <br/>
      {$RADI_FECH_RADI}
    </td>
    </tr>
    <tr> 
      <td colspan="2">
        <strong>{$NOMBRE_ENTIDAD_TIP1}:</strong>
        <br/>
        {$NOMBRE_ENTIDAD_TITULO1} -- {$DOCUMENTO_ENTIDAD_TIP1}
      </td>
      <td colspan="2">
        <strong>Direcci&oacute;n correspondencia:</strong>
        <br/>
        {$DIRECCION_CORRES_TIP1}
      </td>
      <td colspan="2">
        <strong>Municipio/Depto</strong>
        <br/>
        {$DEPARTAMENTO_TIP1}/{$MUNICIPIO_TIP1}
      </td>
    </tr>
    <tr> 
      <td colspan="2">
        <strong>{$NOMBRE_ENTIDAD_TIP2}:</strong>
        <br/>
        {$NOMBRE_ENTIDAD_TITULO2}
      </td>
      <td colspan="2">
        <strong>Direcci&oacute;n Correspondencia:</strong>
        <br/>
        {$DIRECCION_CORRES_TIP2}
      </td>
      <td colspan="2">
        <strong>Municipio/Depto:</strong>
        <br/>
        {$DEPARTAMENTO_TIP2}/{$MUNICIPIO_TIP2}
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <strong>{$NOMBRE_ENTIDAD_TIP3}</strong>
        <br/>
        {$NOMBRE_ENTIDAD_TITULO3} - {$DOCUMENTO_ENTIDAD_TIP3}
        {if $MOSTRAR_LIQUIDACION}
          <strong>
            INCURSA EN DISOLUCI&Oacute;N Y LIQUIDACI&Oacute;N
          </strong>
        {/if}	
      </td>
        <td colspan="2">
          <strong>Direcci&oacute;n correspondencia:</strong>
          <br/>
          {$DIRECCION_CORRES_TIP3}
        </td>
        <td colspan="2">
          <strong>Municipio/Depto:</strong>
          <br/>
          {$DEPARTAMENTO_TIP3}/{$MUNICIPIO_TIP3}
        </td>
      </tr>
    <tr>
      <td><strong>N&ordm; de paginas:</strong></td>
      <td>{$RADI_NUME_HOJA}</td>
      <td colspan="4">
        <strong>Descripci&oacute;n anexos:</strong>
        <br/>
        {$RADI_DESC_ANEXOS}
      </td>
    </tr>
    <tr> 
      <td>
        <strong>Documento: <br>Anexo/Asociado</strong>
      </td>
      <td>
      {if $MOSTRAR_RADICADO}
        {$RADI_NUME_DERI}
          <br>(<a href="{$ORFEO_URL}{$ENLACE_VER_RAD_GEN}" target="VERRAD{$RADI_NUME_DERI}{$FECHA_RADICADO}">Ver Datos</a>)
        {if $MOSTRAR_VINCULO_RAD}
        <input type="button" name="mostrar_anexo" value="..." class="botones_2" onClick="verVinculoDocto();">
        {/if}
      {/if}
      </td>
        <td>
          <strong>
            Referencia/Oficio/Cuenta Interna
          </strong>
        </td>
        <td colspan="{$COL}"> {$CUENTA_INT}
        {if $MOSTRAR_FACTURACION}
          <a href="{$ENLACE_FACTURACION}" target="FacSUI{$CUENTA_INT}>">
            <span class="vinculos">Ver Facturacion</span>
          </a>
        {/if}
        </td>
      {if $MOSTRAR_SANCIONADOS}
      <td>
        <a href="{$ENLACE_SANCIONADOS}">Sancionados</a>	
      </td>
      {/if}
      </tr>
      <tr> 
      <td><strong>Imagen:</strong></td>
      <td class="listado2" colspan="1">
        {$IMAGENV}
      </td>
      <td><strong>Estado actual:</strong></td>
      <td>
        {$FLUJO_NOMBRE}
        {if $MOSTRAR_FLUJO} 
          <input type="button" name="mostrar_causal" value="..." onClick="ver_flujo();">
        {/if}
      </td>
      <td>
        {if $VER_SEGURIDAD}
        <input class="btn btn-warning" type="button" name="mostrar_causal" value="Nivel de Seguridad" onClick="window.open('{$ENLACE_SEGURIDAD}','Cambio Nivel de Seguridad Radicado', 'height=220, width=300,left=350,top=300,scroll:yes')">
        {else}
        <strong>Nivel de Seguridad:</strong>
        {/if}
      </td>
      <td colspan="3">
        {$TIPO_RADICADO}
      </td>
    </tr>
    <tr> 
      <td>
        {if MOSTRAR_TRD}
        <input class="btn btn-warning" type="button" name="mosrtar_tipo_doc2" value="TRD" onClick="ver_tipodocuTRD({$COD_SERIE},{$SUBSERIE});">
        {else}
        <strong>TRD:</strong>
        {/if}
      </td>
      <td colspan="6">
        {$SERIE_NOMBRE}/{$SUB_SERIE_NOMBRE}/{$TPDOC_NOMBRE_TRD}
      </td>
    </tr>
    <tr>
      <td>
        <input class="btn btn-warning" type="button" name="mostrar_causal" value="Sector" onClick="window.open({$ENLACE_TIPIFICACION},'Tipificacion_Documento','height=300,width=750,scrollbars=no')">
      </td>
      <td colspan="6">
      {$SECTOR_NOMBRE}
      <input type="hidden" name="mostrarCausal" value="N">
      </td>
    </tr>
    <tr> 
      <td>
        {if $MOSTRAR_TIPIFICACION}
        <input class="btn btn-warning" type="button" name="mostrar_causal" value="Causal" onClick="window.open({$ENLACE_TIPIFICACION},'Tipificacion_Documento','height=300,width=750,scrollbars=no')">
        {else}
        <strong>Sector:</strong>
        {/if} 
      </td>
      <td colspan="6"> 
        {$CAUSAL_NOMBRE}/{$DCAUSAL_NOMBRE}/{$DDCAUSAL_NOMBRE}
      </td>
    </tr>
  </table>
  </form>
