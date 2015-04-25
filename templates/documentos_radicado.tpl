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
      <th>Propiedades</th>
      <th>Propiedades</th>
      <th>Propiedades</th>
      <th>Propiedades</th>
      <th>Propiedades</th>
    </tr>
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
