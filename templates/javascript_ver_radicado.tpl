<!-- seleccionar todos los checkboxes-->
<script language="JavaScript">
  function datosBasicos() {
    window.location='{$ENLACE_RADICACION}';
  }

  function mostrar(nombreCapa) {
    document.getElementById(nombreCapa).style.display="";
  }

  function ocultar(nombreCapa) {
    document.getElementById(nombreCapa).style.display="none";
  }
  
  var contadorVentanas = 0;
  {if $MOSTRAR_RADICADO}
    {if $VER_DATO}
  function  window_onload() {
      {if $MOSTRAR_RADICADO_985}
    window_onload2();
      {/if}
  }
    {/if}
    {include file='pestanas_ver_radicado.tpl'}
  {else}
  function changedepesel(xx) {
  }
  {/if}

  function window_onload2() {
  {if $MOSTRAR_VER_CAUSAL}
    ocultar_mod();
    {if $MOSTRAR_VER_CAUSAL}
    ver_causales();
    {/if}
    {if $MOSTRAR_VER_TEMA}
    ver_temas();
    {/if}
    {if $MOSTRAR_VER_SECTOR}
    ver_sector();
    {/if}
    {if $MOSTRAR_VER_FLUJO}
    ver_flujo();
    {/if}
    {if $MOSTRAR_VINANEXO}
    verVinculoDocto();}
    {/if}
  {/if}
  }

  function verNotificacion() {
     mostrar("mod_notificacion");
     ocultar("tb_general");
     ocultar("mod_causales");
     ocultar("mod_temas");
     ocultar("mod_sector");
     ocultar("mod_flujo");
  }

  function ver_datos() {
     mostrar("tb_general");
     ocultar("mod_causales");
     ocultar("mod_temas");
     ocultar("mod_sector");
     ocultar("mod_flujo");
  }

  function ocultar_mod() {
     ocultar("mod_causales");
     ocultar("mod_temas");
     ocultar("mod_sector");
     ocultar("mod_flujo");
  }

  function ver_tipodocumental() {
  {if $MOSTRAR_MENU_VER_TMP}
    ocultar("tb_general");
    ocultar("mod_causales");
    ocultar("mod_temas");
    ocultar("mod_flujo");
  {/if}
  }

  function ver_tipodocumento() {
    ocultar("tb_general");
    ocultar("mod_causales");
    ocultar("mod_temas");
    ocultar("mod_flujo");
  }

  function verDecision() {
     ocultar("tb_general");
     ocultar("mod_causales");
     ocultar("mod_temas");
     ocultar("mod_flujo");
  }

  function ver_tipodocuTRD(codserie,tsub) {
     window.open("{$ENLACE_TIPIFICAR}"+codserie,"Tipificacion_Documento","height=500,width=750,scrollbars=yes");
   }

  function verVinculoDocto() {
    window.open("{$ENLACE_VINCULACION}","Vinculacion_Documento","height=500,width=750,scrollbars=yes");
  }

  function verResolucion() {
     ocultar("tb_general");
     ocultar("mod_causales");
     ocultar("mod_temas");
     ocultar("mod_flujo");
     ocultar("mod_tipodocumento");
     mostrar("mod_resolucion");
     ocultar("mod_notificacion");
  }

  function ver_temas() {
     ocultar("tb_general");
     ocultar("mod_tipodocumento");
     ocultar("mod_causales");
     ocultar("mod_sector");
     ocultar("mod_flujo");
     ocultar("mod_tipodocumento");
     mostrar("mod_temas");
     ocultar("mod_resolucion");
     ocultar("mod_notificacion");
  }

  function ver_flujo() {
     mostrar("mod_flujo");
     ocultar("tb_general");
     ocultar("mod_tipodocumento");
     ocultar("mod_causales");
     ocultar("mod_temas");
     ocultar("mod_sector");
     mostrar("mod_flujo");
     ocultar("mod_resolucion");
     ocultar("mod_notificacion");
  }

  function hidden_tipodocumento() {
    {if $MOSTRAR_TIPO_DOC}
    //ocultar_mod();
    {/if}
  }

  function mostrar(nombreCapa) {
    objeto=document.getElementById(nombreCapa);
    if(objeto)
      objeto.style.display="";
  }

  function ocultar(nombreCapa) {
    objeto = document.getElementById(nombreCapa);
    if(objeto)
      objeto.style.display="none";
  }

  function ver_complementos(complemento) {
    var Complementos = new Array("tb_general",
                              "mod_tipodocumento",
                              "mod_causales",
                              "mod_temas",
                              "mod_sector",
                              "mod_resolucion",
                              "mod_notificacion",
                              "mod_flujo",
                              "mod_decision",
                              "mod_bd_comple");
    
    for(i=0; i<Complementos.length; i++) {
      if(complemento==Complementos[i]) {
        mostrar(Complementos[i]);
      } else {
        ocultar(Complementos[i]);
      }
    }
  }

  /**
    * FUNCION DE JAVA SCRIPT DE LAS PESTANAS
    * Esta funcion es la que produce el efecto de pertanas de mover a,
    * Reasignar, Informar, Devolver, Vobo y Archivar
    */
</script>
