  <script>
    swradics = 0;
    radicando = 0;
    function verDetalles(anexo,tpradic,aplinteg,num) {
    optAsigna = "";
    if (swradics==0) {
      optAsigna="&verunico=1";
    }
    contadorVentanas=contadorVentanas+1;
    nombreventana="ventanaDetalles"+contadorVentanas;
    url="{$ENLACE_DETALLES_ARCHIVO}" + anexo;
    url="{$ENLACE_NUEVO_ARCHIVO}"+anexo+"{$VAR_NUEVO_ARCHIVO}"+"&tpradic="+tpradic+"&aplinteg="+aplinteg+optAsigna;
    window.open(url,nombreventana,'top=0,height=580,width=640,scrollbars=yes,resizable=yes');
    return;
    }
    function borrarArchivo(anexo,linkarch,radicar_a,procesoNumeracionFechado){
      if (confirm('Estas seguro de borrar este archivo anexo ?')) {
        contadorVentanas = contadorVentanas+1;
        nombreventana = "ventanaBorrar"+contadorVentanas;
        url = "{$ENL_LISTA_ANEXOS_TRANS}"+anexo+"&linkarchivo="+linkarch+"&numfe="+procesoNumeracionFechado+"{$VARS_USUARIO}";
        window.open(url,nombreventana,'height=100,width=180');
      }
    return;
    }

    function radicarArchivo(anexo,linkarch,radicar_a,procesoNumeracionFechado,tpradic,aplinteg,numextdoc) {
      if (radicando>0) {
        alert ("Ya se esta procesando una radicacion, para re-intentarlo hagla click sobre la pestana de documentos");
        return;
      }

      radicando++;

      if (confirm('Se asignar\xe1 un n\xfamero de radicado a \xe9ste documento. Est\xe1 seguro  ?')) {
        contadorVentanas=contadorVentanas+1;
        nombreventana="mainFrame";
        
        url = {$ENL_LISTA_ANEXOS_RADI}
        window.open(url,nombreventana,'height=450,width=600');
      }
    return;
    }

    function numerarArchivo(anexo,linkarch,radicar_a,procesoNumeracionFechado){
    if (confirm('Se asignar\xe1 un n\xfamero a \xe9ste documento. Est\xe1 seguro ?')) {
        contadorVentanas = contadorVentanas + 1;
        nombreventana="mainFrame";
        url = "{$ENL_LISTA_ANEXOS_NUME}"+procesoNumeracionFechado;
        window.open(url,nombreventana,'height=450,width=600');
      }
    return;
    }

    function asignarRadicado(anexo,linkarch,radicar_a,numextdoc){
      if (radicando>0){
        alert ("Ya se esta procesando una radicacion, para re-intentarlo hagla click sobre la pesta�a de documentos");
        return;
      }

         radicando++;

      if (confirm('Esta seguro de asignarle el numero de Radicado a este archivo ?')) {
        contadorVentanas=contadorVentanas+1;
        nombreventana="mainFrame";
        url="{$ENLACE_ASIGNAR_RADICADO}"+numextdoc;
        window.open(url,nombreventana,'height=450,width=600');
      }
      return;
    }

    function ver_tipodocuATRD(anexo,codserie,tsub) {
      window.open("{$ENLACE_TRD}","height=500,width=750,scrollbars=yes");
    }

    function ver_tipodocuAnex(cod_radi,codserie,tsub) { 
      window.open("{$ENLACE_TIPO_ANEXO}","height=300,width=750,scrollbars=yes");
    }

    function vistaPreliminar(anexo,linkarch,linkarchtmp){
      contadorVentanas=contadorVentanas+1;
      nombreventana="mainFrame";
      url="{$ENLACE_GEN_ARCHIVO}";
      window.open(url,nombreventana,'height=450,width=600');
      return;
    }
    
    function nuevoArchivo(asigna){
      contadorVentanas=contadorVentanas+1;
      optAsigna="";
      if (asigna==1){
        optAsigna="&verunico=1";
      }

      nombreventana="ventanaNuevo"+contadorVentanas;
      url="{$ENLACE_NUEVO_ARCHIVO}"+optAsigna;
      window.open(url,nombreventana,'height=580,width=640,scrollbars=yes,resizable=yes');
      return;
    }

    function nuevoEditWeb(asigna){
      contadorVentanas=contadorVentanas+1;
      optAsigna="";
      if (asigna==1) {
        optAsigna="&verunico=1";
      }

      nombreventana="ventanaNuevo"+contadorVentanas;
      url="{$ENLACE_EDICION_WEB}"+optAsigna;
      window.open(url,nombreventana,'height=800,width=700,scrollbars=yes,resizable=yes');
      return;
    }

    function Plantillas(plantillaper1) {
      if(plantillaper1==0) {
        plantillaper1="";
      }
      contadorVentanas=contadorVentanas+1;
      nombreventana="ventanaNuevo"+contadorVentanas;
      urlp="{$ENLACE_PLANTILLA}"+plantillaper1;
      window.open(urlp,nombreventana,'top=0,left=0,height=800,width=850');
      return;
    }

    function Plantillas_pb(plantillaper1){
      if(plantillaper1==0) {
        plantillaper1="";
      }
      contadorVentanas=contadorVentanas+1;
      nombreventana="ventanaNuevo"+contadorVentanas;
      urlp="{$ENLACE_CREAR_PLANTILLA}"+plantillaper1;
      window.open(urlp,nombreventana,'top=0,left=0,height=800,width=850');
      return;
    }
    
    function regresar(){
      window.location.reload();
      window.close();
    }
  </script>
  <div class="row">
    {if $MOSTRAR_RESPUESTA_RAPIDA}
      <a href="{$ENLACE_RESPUESTA_RAP}">
        <font color="white">Respuesta Rapida &nbsp;</font>
      </a>
    {/if}
  </div>
  <div class="row">
    <img src="{$ORFEO_URL}/imagenes/estadoDocInfo.gif">
  </div>
  <table class="table">
    <tr>
      <th>
        <img src="{$ORFEO_URL}/imagenes/estadoDoc.gif">
      </th>
      <th>Radicado</th>
      <th>Propiedades</th>
      <th></th>
    </tr>
    {foreach $ANEXOS_RADICADO as $ANEXO_RADICADO}
    {strip}
    <tr>
      <td> 
        {$ANEXO_RADICADO.IMG_ESTADO}
      </td>
      <td>
        {if $ANEXO_RADICADO.MOSTRAR_ENL_DESCARGAR}
          <a class="vinculos" href="{$ANEXO_RADICADO.ENLACE_DESCARGA}">
            {$ANEXO_RADICADO.NUMERO_RADICADO_HIST}
          </a>
        {else}
          {$ANEXO_RADICADO.NUMERO_RADICADO_HIST}
        {/if}
        <br/>
        <strong>Descripcion:</strong> {$ANEXO_RADICADO.DESCR}
        <br/>
        <strong>Creador:</strong> {$ANEXO_RADICADO.CREA}
        <br/>
        <strong>Tama&ntilde;o (Kb):</strong>
        {$ANEXO_RADICADO.TAMA}
      </td>
      <td>
        <strong>Anexado en:</strong> {$ANEXO_RADICADO.FEANEX}
        <br/>
        <strong>Tipo:</strong> {$ANEXO_RADICADO.EXTENSION_ARCHIVO}
        <br/>
        <strong>TRD?:</strong> {$ANEXO_RADICADO.MSG_TRD}
        <br/>
        <strong>Solo lectura?:</strong> {$ANEXO_RADICADO.RO}
      </td>
      {if $ANEXO_RADICADO.MOSTRAR_SECUENCIA}
      <td>
        {$ANEXO_RADICADO.SECUENCIA_HIST}<br>{$ANEXO_RADICADO.FECDOC}
      </td>
      {/if}
      <td>
        <!-- dropdown opciones button -->
        <div class="btn-group">
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            Acciones<span class="caret"></span>
          </button>
          <ul class="dropdown-menu" role="menu">
          {if $ANEXO_RADICADO.MOSTRAR_VISTA_PRELIMINAR}
            <li>
              <a href="javascript:vistaPreliminar('$coddocu','$linkarchivo','$linkarchivotmp')">
                <img src="{$ORFEO_URL}/iconos/vista_preliminar.gif" alt="Vista Preliminar" border="0">
              </a>
            </li>
          {/if}
          {if $ANEXO_RADICADO.MOSTRAR_MODIFICAR}
            <li>
              <a href="javascript:verDetalles('{$ANEXO_RADICADO.COD_DOCU_HIST}','{$ANEXO_RADICADO.TPRADIC}','{$ANEXO_RADICADO.APLINTEG}');">
                Modificar
              </a>
            </li>
          {/if}
          {if $ANEXO_RADICADO.MOSTRAR_ATRD}
            <li>
              <a href="javascript:ver_tipodocuATRD({$ANEXO_RADICADO.RADINUMEANEXO},{$ANEXO_RADICADO.CODSERIE},{$ANEXO_RADICADO.TSUB});">
              Tipificar
              </a>
            </li>
          {/if}
          {if $ANEXO_RADICADO.MOSTRAR_ANEXO_TIPO}
            <li>
              <a href="javascript:ver_tipodocuAnex('{$ANEXO_RADICADO.COD_RADI}','{$ANEXO_RADICADO.ANEXO}',{$ANEXO_RADICADO.CODSERIE},{$ANEXO_RADICADO.TSUB});">
                Tipificar
              </a>
            </li>
          {/if}
          {if $ANEXO_RADICADO.MOSTRAR_ANEXO_TIPO_2}
            <li>
              <a href="javascript:ver_tipodocuAnex('{$ANEXO_RADICADO.COD_RADI}','{$ANEXO_RADICADO.ANEXO}',{$ANEXO_RADICADO.CODSERIE},{$ANEXO_RADICADO.TSUB});">
                Re-Tipificar
              </a>
            </li>
          {/if}
            {if $ANEXO_RADICADO.MOSTRAR_BORRAR}
            <li>
              <a href="javascript:borrarArchivo('{$ANEXO_RADICADO.COD_DOCU}','{$ANEXO_RADICADO.LINK_ARCHIVO}','{$ANEXO_RADICADO.COD_RADI}','{$ANEXO_RADICADO.SGD_PNUFE_CODI}');">Borrar</a>
            {/if}
            </li>
            {if $ANEXO_RADICADO.MOSTRAR_RADICAR}
            <li>
              <a href="javascript:radicarArchivo('{$ANEXO_RADICADO.COD_DOCU}','{$ANEXO_RADICADO.LINK_ARCHIVO}','si',{$ANEXO_RADICADO.SGD_PNUFE_CODI},'{$ANEXO_RADICADO.TP_RADICADO}','{$ANEXO_RADICADO.APLINTEG}','{$ANEXO_RADICADO.NUM_EXT_DOC}')">Radicar(-{$ANEXO_RADICADO.TP_RADICADO})</a>
            </li>
            {/if}
            {$ANEXO_RADICADO.ERROR_RADICACION}
            <li>
            {if $ANEXO_RADICADO.MOSTRAR_ASIGNAR_RADICADO}
              <a href="javascript:asignarRadicado('{$ANEXO_RADICADO.COD_DOCU}','{$ANEXO_RADICADO.LINK_ARCHIVO}','{$ANEXO_RADICADO.COD_RADI}','{$ANEXO_RADICADO.NUM_EXT_DOC}')">
                Asignar Rad
              </a>
            </li>
            {/if}
            {if $ANEXO_RADICADO.MOSTRAR_RADICAR_2}
            <li>
              <a href="javascript:radicarArchivo('{$ANEXO_RADICADO.COD_DOCU}','{$ANEXO_RADICADO.LINK_ARCHIVO}','si',{$ANEXO_RADICADO.SGD_PNUFE_CODI},'{$ANEXO_RADICADO.TP_RADICADO}','{$ANEXO_RADICADO.APLINTEG}','{$ANEXO_RADICADO.NUM_EXT_DOC}');">Radicar(-{$ANEXO_RADICADO.TP_RADICADO})</a>
            </li>
            {/if}
            {if $ANEXO_RADICADO.MOSTRAR_RADICAR_3}
                  <li>
            <a href="javascript:radicarArchivo('{$ANEXO_RADICADO.COD_DOCU}','{$ANEXO_RADICADO.LINK_ARCHIVO}','si',{$ANEXO_RADICADO.SGD_PNUFE_CODI},'{$ANEXO_RADICADO.TP_RADICADO}','{$ANEXO_RADICADO.APLINTEG}','{$ANEXO_RADICADO.NUM_EXT_DOC}');">Radicar(-{$ANEXO_RADICADO.TP_RADICADO})</a>
                  </li>
            {/if}
            {if $ANEXO_RADICADO.MOSTRAR_REGENERAR}
                  <li>
            <a href="javascript:radicarArchivo('{$ANEXO_RADICADO.COD_DOCU}','{$ANEXO_RADICADO.LINK_ARCHIVO}','{$ANEXO_RADICADO.COD_RADI}',{$ANEXO_RADICADO.SGD_PNUFE_CODI},'','',{$ANEXO_RADICADO.NUM_EXT_DOC});">
              Re-Generar
            </a>
                  </li>
            {/if}
            {if $ANEXO_RADICADO.MOSTRAR_NUMERAR}
                  <li>
            <a href="javascript:numerarArchivo('{$ANEXO_RADICADO.COD_DOCU}','{$ANEXO_RADICADO.LINK_ARCHIVO}','si',{$ANEXO_RADICADO.SGD_PNUFE_CODIGO});">
              Numerar
            </a>
                  </li>
            {/if}
            {if $ANEXO_RADICADO.MOSTRAR_BORRAR_2}
                  <li>
              <a href="javascript:borrarArchivo('{$ANEXO_RADICADO.COD_DOCU}','{$ANEXO_RADICADO.LINK_ARCHIVO}','{$ANEXO_RADICADO.COD_RADI}','{$ANEXO_RADICADO.SGD_PNUFE_CODI}');">Borrar</a>
                  </li>
            {/if}
            {if $ANEXO_RADICADO.MOSTRAR_TIPIFICAR}
                  <li>
              <a href="javascript:ver_tipodocuAnex('{$ANEXO_RADICADO.COD_RADI}','{$ANEXO_RADICADO.ANEXO}',{$ANEXO_RADICADO.COD_SERIE},{$ANEXO_RADICADO.TSUBSERIE});">Tipificar</a>
                  </li>
            {/if}
            {if $ANEXO_RADICADO.MOSTRAR_RETIPIFICAR}
                  <li>
              <a href="javascript:ver_tipodocuAnex('{$ANEXO_RADICADO.COD_RADI}','{$ANEXO_RADICADO.ANEXO}',{$ANEXO_RADICADO.COD_SERIE},{$ANEXO_RADICADO.TSUBSERIE});">Re-Tipificar</a>
                  </li>
            {/if}
          </ul>
        </div>
        <!-- end dropdown opciones button -->
      </td>
    </tr>
    {/strip}
    {/foreach}
  </table>
  {if $MOSTRAR_OPCIONES_ANEXAR}
  <br>
  <div class="row text-center">
    <a href="javascript:nuevoArchivo({$MAS_ARCHIVOS})">
      Anexar Archivo
    </a>
  </div>
  <script>
    {$NUM_ARCHIVOS}
  </script>
  {/if}
  <br>
