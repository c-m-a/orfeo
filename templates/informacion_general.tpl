  <script>
    function regresar() {
      window.location.reload();
    }
  </script>
  <table class="table">
    <tr> 
      <td>ASUNTO:</td>
      <td>{$ASUNTO_RADICADO}</td>
      <td>FECHA DE RADICADO:</td>
      <td>{$RADI_FECH_RADI}</td>
    </tr>
    <tr> 
      <td>{$NOMBRE_ENTIDAD_TIP1}:</td>
      <td>{$NOMBRE_ENTIDAD_TITULO1} -- {$DOCUMENTO_ENTIDAD_TIP1}</td>
      <td>DIRECCI&Oacute;N CORRESPONDENCIA:</td>
      <td>{$DIRECCION_CORRES_TIP1}</td>
      <td>MUN/DPTO</td>
      <td>{$DEPARTAMENTO_TIP1}/{$MUNICIPIO_TIP1}</td>
    </tr>
    <tr> 
      <td>{$NOMBRE_ENTIDAD_TIP2}:</td>
      <td>{$NOMBRE_ENTIDAD_TITULO2}</td>
        <td>DIRECCI&Oacute;N CORRESPONDENCIA:</td>
        <td>{$DIRECCION_CORRES_TIP2}</td>
        <td>MUNICIPIO/DPTO:</td>
        <td>{$DEPARTAMENTO_TIP2}/{$MUNICIPIO_TIP2}</td>
    </tr>
    <tr>
      <td>{$NOMBRE_ENTIDAD_TIP3}</td>
      <td> {$NOMBRE_ENTIDAD_TITULO3} -- {$DOCUMENTO_ENTIDAD_TIP3}
      {if $MOSTRAR_LIQUIDACION}
        <strong>
          <font color="red">INCURSA EN DISOLUCION Y LIQUIDACION</font>
        </strong>
      {/if}	
      </td>
        <td>DIRECCI&Oacute;N CORRESPONDENCIA </td>
        <td>{$DIRECCION_CORRES_TIP3}</td>
        <td>MUN/DPTO</td>
        <td>{$DEPARTAMENTO_TIP3}/{$MUNICIPIO_TIP3}</td>
    </tr>
    <tr>
      <td> <p>N&ordm; DE PAGINAS</p></td>
        <td>{$RADI_NUME_HOJA}</td>
        <td> DESCRIPCION ANEXOS </td>
        <td>{$RADI_DESC_ANEXOS}</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr> 
      <td>DOCUMENTO<br>Anexo/Asociado</td>
      <td>
      {if $MOSTRAR_RADICADO}
        {$RADI_NUME_DERI}
          <br>(<a href="{$ORFEO_URL}{$ENLACE_VER_RAD_GEN}" target="VERRAD{$RADI_NUME_DERI}{$FECHA_RADICADO}">Ver Datos</a>)
        {if $MOSTRAR_VINCULO_RAD}
        <input type="button" name="mostrar_anexo" value="..." class="botones_2" onClick="verVinculoDocto();">
        {/if}
      {/if}
      </td>
        <td>REF/OFICIO/CUENTA INTERNA </td>
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
      <td>IMAGEN</td>
      <td class="listado2" colspan="1">
        <span class='vinculos'>{$IMAGENV}</span>
      </td>
      <td>ESTADO ACTUAL</td>
      <td>
        {$FLUJO_NOMBRE}
        {if $MOSTRAR_FLUJO} 
          <input type="button" name="mostrar_causal" value="..." onClick="ver_flujo();">
        {/if}
      </td>
      <td>Nivel de Seguridad</td>
      <td colspan="3">
        {$TIPO_RADICADO}
        {if $VER_SEGURIDAD}
          <input type="button" name="mostrar_causal" value="..." onClick="window.open('{$ENLACE_SEGURIDAD}','Cambio Nivel de Seguridad Radicado', 'height=220, width=300,left=350,top=300,scroll:yes')">
        {/if}
      </td>
    </tr>
    <tr> 
      <td>TRD</td>
      <td colspan="6">
        {$SERIE_NOMBRE}<font color=black>/</font>{$SUB_SERIE_NOMBRE}<font color=black>/</font>{$TPDOC_NOMBRE_TRD}
        {if MOSTRAR_TRD}
        <input type="button" name="mosrtar_tipo_doc2" value="..." onClick="ver_tipodocuTRD({$COD_SERIE},{$SUBSERIE});">
        {/if}
      </td>
    </tr>
    <tr>
    <td>SECTOR</td>
    <td colspan="6">
      {$SECTOR_NOMBRE}
      <input type="button" name="mostrar_causal" value="..." onClick="window.open({$ENLACE_TIPIFICACION},'Tipificacion_Documento','height=300,width=750,scrollbars=no')">
        <input type="hidden" name="mostrarCausal" value="N">
      </td>
    </tr>
    <tr> 
      <td>CAUSAL</td>
      <td colspan="6"> 
        {$CAUSAL_NOMBRE}/{$DCAUSAL_NOMBRE}/{$DDCAUSAL_NOMBRE}
        {if $MOSTRAR_TIPIFICACION}
          <input type="button" name="mostrar_causal" value="..." onClick="window.open({$ENLACE_TIPIFICACION},'Tipificacion_Documento','height=300,width=750,scrollbars=no')">
        {/if} 
      </td>
    </tr>
  </table>
  </form>
  <table>
  <tr>
    <td>
    </td>
  </tr>
  <tr>
    <td align="center"></td>
  </tr>
  </table>
