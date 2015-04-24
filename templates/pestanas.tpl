<!-- Funcion que activa el sistema de marcar o desmarcar todos los check -->
<script>
  setRutaRaiz ('{$ORFEO_URL}');
  function markAll() {
    if(document.form1.elements['checkAll'].checked)
      for(i=1;i<document.form1.elements.length;i++)
        document.form1.elements[i].checked=1;
    else
      for(i=1;i<document.form1.elements.length;i++)
        document.form1.elements[i].checked=0;
  }
</script>

<script>
  function validaAgendar(argumento){
    fecha_hoy =  '{$FECHA_HOY}';
    fecha = document.form1.elements['fechaAgenda'].value;

    if (fecha==""&&argumento=="SI"){
      alert("Debe suministrar la fecha de agenda");
      return false;
    }
    if (!fechas_comp_ymd(fecha_hoy,fecha) && argumento=="SI") {
      alert("La fecha de agenda debe ser mayor que la fecha de hoy");
      return false;
    }
    return true;
  }
  
  // JavaScript Document
  // Esta funcion esconde el combo de las dependencia e inforados Se activan cuando el menu envie una senal de cambio.
  // Cuando existe una senan de cambio el program ejecuta esta funcion mostrando el combo seleccionado
  function changedepesel(enviara) {
    document.form1.codTx.value = enviara;
    document.getElementById('depsel').style.display = 'none';
    document.getElementById('carpper').style.display = 'none';
    document.getElementById('depsel8').style.display = 'none';
    document.getElementById('Enviar').style.display = 'none';
    
    //mover
    if(enviara == 10) {
      document.getElementById('depsel').style.display = 'none';
      document.getElementById('carpper').style.display = '';
      document.getElementById('depsel8').style.display = 'none';
      MM_swapImage('Image9','','{$ORFEO_URL}/imagenes/internas/reasignar.gif',1);
      MM_swapImage('Image10','','{$ORFEO_URL}/imagenes/internas/informar.gif',1);
      MM_swapImage('Image11','','{$ORFEO_URL}/imagenes/internas/devolver.gif',1);
      MM_swapImage('Image12','','{$ORFEO_URL}/imagenes/internas/vobo.gif',1);
      MM_swapImage('Image14','','{$ORFEO_URL}/imagenes/internas/NRR.gif',1);
      MM_swapImage('Image13','','{$ORFEO_URL}/imagenes/internas/archivar.gif',1);
      document.getElementById('Enviar').style.display = '';
    }
    
    //Archivar
    if (enviara == 13) {    
      document.getElementById('depsel').style.display = 'none';
      document.getElementById('depsel8').style.display = 'none';
      document.getElementById('carpper').style.display = 'none';

      MM_swapImage('Image10','','{$ORFEO_URL}/imagenes/internas/informar.gif',1);
      MM_swapImage('Image11','','{$ORFEO_URL}/imagenes/internas/devolver.gif',1);
      MM_swapImage('Image9','','{$ORFEO_URL}/imagenes/internas/reasignar.gif',1);
      MM_swapImage('Image12','','{$ORFEO_URL}/imagenes/internas/vobo.gif',1);
      MM_swapImage('Image8','','{$ORFEO_URL}/imagenes/internas/moverA.gif',1);
      MM_swapImage('Image14','','{$ORFEO_URL}/imagenes/internas/NRR.gif',1);
      envioTx();
    }
    
    if (enviara == 16) {    
      document.getElementById('depsel').style.display = 'none';
      document.getElementById('depsel8').style.display = 'none';
      document.getElementById('carpper').style.display = 'none';
      MM_swapImage('Image10','','{$ORFEO_URL}/imagenes/internas/informar.gif',1);
      MM_swapImage('Image11','','{$ORFEO_URL}/imagenes/internas/devolver.gif',1);
      MM_swapImage('Image9','','{$ORFEO_URL}/imagenes/internas/reasignar.gif',1);
      MM_swapImage('Image12','','{$ORFEO_URL}/imagenes/internas/vobo.gif',1);
      MM_swapImage('Image8','','{$ORFEO_URL}/imagenes/internas/moverA.gif',1);
      MM_swapImage('Image13','','{$ORFEO_URL}/imagenes/internas/archivar.gif',1);
      envioTx();
    }
     
    //Devolver
    if (enviara == 12) {    
      document.getElementById('depsel').style.display = '';
      document.getElementById('Enviar').style.display = '';
      MM_swapImage('Image9','','{$ORFEO_URL}/imagenes/internas/reasignar.gif',1);
      MM_swapImage('Image10','','{$ORFEO_URL}/imagenes/internas/informar.gif',1);
      MM_swapImage('Image8','','{$ORFEO_URL}/imagenes/internas/moverA.gif',1);
      MM_swapImage('Image12','','{$ORFEO_URL}/imagenes/internas/vobo.gif',1);
      MM_swapImage('Image14','','{$ORFEO_URL}/imagenes/internas/NRR.gif',1);
      MM_swapImage('Image13','','{$ORFEO_URL}/imagenes/internas/archivar.gif',1);
    }
       
    if (enviara == 11) {
    }

    //Reasignar
    if (enviara == 9) {
      document.getElementById('depsel').style.display = '';
      document.getElementById('carpper').style.display = 'none';
      document.getElementById('depsel8').style.display = 'none';
      MM_swapImage('Image8','','{$ORFEO_URL}/imagenes/internas/moverA.gif',1);
      MM_swapImage('Image10','','{$ORFEO_URL}/imagenes/internas/informar.gif',1);
      MM_swapImage('Image11','','{$ORFEO_URL}/imagenes/internas/devolver.gif',1);
      MM_swapImage('Image12','','{$ORFEO_URL}/imagenes/internas/vobo.gif',1);
      MM_swapImage('Image14','','{$ORFEO_URL}/imagenes/internas/NRR.gif',1);
      MM_swapImage('Image13','','{$ORFEO_URL}/imagenes/internas/archivar.gif',1);
      document.getElementById('Enviar').style.display = '';
    }  
    
    //Visto bueno
    if (enviara == 14) {
      document.getElementById('depsel').style.display = '';
      document.getElementById('carpper').style.display = 'none';
      document.getElementById('depsel8').style.display = 'none';
      MM_swapImage('Image8','','{$ORFEO_URL}/imagenes/internas/moverA.gif',1);
      MM_swapImage('Image10','','{$ORFEO_URL}/imagenes/internas/informar.gif',1);
      MM_swapImage('Image11','','{$ORFEO_URL}/imagenes/internas/devolver.gif',1);
      MM_swapImage('Image9','','{$ORFEO_URL}/imagenes/internas/reasignar.gif',1);
      MM_swapImage('Image14','','{$ORFEO_URL}/imagenes/internas/NRR.gif',1);
      MM_swapImage('Image13','','{$ORFEO_URL}/imagenes/internas/archivar.gif',1);
      document.getElementById('Enviar').style.display = '';
    }
    
    //Informar
    if (enviara == 8) {
      document.getElementById('depsel').style.display = 'none';
      document.getElementById('depsel8').style.display = '';
      document.getElementById('carpper').style.display = 'none';
      MM_swapImage('Image8','','{$ORFEO_URL}/imagenes/internas/moverA.gif',1);
      MM_swapImage('Image11','','{$ORFEO_URL}/imagenes/internas/devolver.gif',1);
      MM_swapImage('Image9','','{$ORFEO_URL}/imagenes/internas/reasignar.gif',1);
      MM_swapImage('Image12','','{$ORFEO_URL}/imagenes/internas/vobo.gif',1);
      MM_swapImage('Image14','','{$ORFEO_URL}/imagenes/internas/NRR.gif',1);
      MM_swapImage('Image13','','{$ORFEO_URL}/imagenes/internas/archivar.gif',1);
      document.getElementById('Enviar').style.display = '';
    }
  }
</script>
<script>
  // Variable que guarda la ultima opcion de la barra de herramientas de funcionalidades seleccionada
  seleccionBarra = -1;
  
  function MM_swapImgRestore() { //v3.0
    var i,x,a=document.MM_sr;
    for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
  }

  function MM_preloadImages() { //v3.0
    var d=document;
    if(d.images) {
      if(!d.MM_p) d.MM_p=new Array();
      var i,j=d.MM_p.length,a=MM_preloadImages.arguments;
      
      for(i=0; i<a.length; i++)
        if (a[i].indexOf("#")!=0) {
          d.MM_p[j]=new Image;
          d.MM_p[j++].src=a[i];
        }
    }
  }

  function MM_findObj(n, d) { //v4.01
    var p,i,x;
    if(!d) d=document;
    if((p=n.indexOf("?"))>0&&parent.frames.length) {
      d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);
    }
    
    if(!(x=d[n])&&d.all) x=d.all[n];
    for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
    for (i=0;!x&&d.layers&&i<d.layers.length;i++)
      x=MM_findObj(n,d.layers[i].document);
    
    if(!x && d.getElementById)
      x=d.getElementById(n); return x;
  }

  function MM_swapImage() { //v3.0
    var i,j=0,x,a=MM_swapImage.arguments;
    document.MM_sr=new Array;
    for(i=0;i<(a.length-2);i+=3)
      if ((x=MM_findObj(a[i]))!=null) {
        document.MM_sr[j++]=x;
        if(!x.oSrc)
          x.oSrc=x.src; x.src=a[i+2];
      }
  }
</script>
<script>
  function vistoBueno() {
    changedepesel(9);
    document.getElementById('EnviaraV').value = 'VoBo';
  }

  function devolver() {
    document.getElementById('codTx').value=12;
    changedepesel(12);
  }

  function txAgendar() {
    if (!validaAgendar('SI'))
      return;
    changedepesel(14);
    envioTx();
  }

  function txNoAgendar() {
    changedepesel(15);
    envioTx();
  }

  function archivar() {
    changedepesel(13);
    envioTx();
  }

  function nrr() {
     changedepesel(16);
     envioTx();
  }

  function envioTx() {
    sw = 0;
    {if not $VERRAD}
    for(i=1;i<document.form1.elements.length;i++)
      if (document.form1.elements[i].checked)
        sw=1;
    
    if (sw==0) {
      alert ("Debe seleccionar uno o mas radicados");
      return;
    }
    {/if}
    document.form1.submit();
  }

  function window_onload() {
    document.getElementById('depsel').style.display = 'none';
    document.getElementById('depsel8').style.display = 'none';
    document.getElementById('carpper').style.display = 'none';
    document.getElementById('Enviar').style.display = 'none';

    {if not $VERRAD}
      // No hace nada mal programado
    {else}
     window_onload2();
    {/if}
    
    /*if($carpeta==11 and $_SESSION['codusuario']==1){
      echo "document.getElementById('salida').style.display = ''; ";
      echo "document.getElementById('enviara').style.display = ''; ";
      echo "document.getElementById('Enviar').style.display = ''; ";
    } else {
      echo ' ';
    }
    if($carpeta==11 and $_SESSION['codusuario']!=1){
     echo "document.getElementById('enviara').style.display = 'none'; ";
     echo "document.getElementById('Enviar').style.display = 'none'; ";
    }*/
  }
    
  function masivaTRD() {
    sw=0;
    var radicados = new Array();
    var list = new Array();
    for(i=1;i<document.form1.elements.length;i++) {
      if (document.form1.elements[i].checked && document.form1.elements[i].name!="checkAll") {
        sw++;
        valor = document.form1.elements[i].name;
        valor = valor.replace("checkValue[", "");
        valor = valor.replace("]", "");
        radicados[sw] = valor;
        list.push(valor);
      }
    }
    
    window.open("{$ENLACE_MASIVAS}" + list, "Masiva_Asignación_TRD", "height=650,width=750,scrollbars=yes");
  }
</script>
<script>
  function radicadosSel() {
    sw=0;
    var radicados = new Array();
    
    for(i=1;i<document.form1.elements.length;i++){
      if (document.form1.elements[i].checked) { 
         sw++;
         valor = document.form1.elements[i].name;
         valor = valor.replace("checkValue[", "");
         valor = valor.replace("]", "");
         radicados[sw] = valor;
       }
    }
    alert("---> " + sw + " -->" + radicados[1]  + " -->" + radicados[2]);
  }
</script>
