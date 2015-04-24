  function markAll() {
    if(document.form1.elements['checkAll'].checked)
      for(i=1;i<document.form1.elements.length;i++)
        document.form1.elements[i].checked=1;
    else
      for(i=1;i<document.form1.elements.length;i++)
        document.form1.elements[i].checked=0;
  }

  function validaAgendar(argumento) {
    fecha_hoy =  '{$FECHA_HOY}';
    fecha = document.form1.elements['fechaAgenda'].value;

    if (fecha==""&&argumento=="SI") {
      alert("Debe suministrar la fecha de agenda");
      return false;
    }
    if (!fechas_comp_ymd(fecha_hoy,fecha) && argumento=="SI") {
      alert("La fecha de agenda debe ser mayor que la fecha de hoy");
      return false;
    }
    return true;
  }

  // Esta funcion esconde el combo de las dependencia e inforados Se activan cuando el menu envie una senal de cambio.
  // Cuando existe una senan de cambio el program ejecuta esta funcion mostrando el combo seleccionado
  function changedepesel(enviara) {
    document.form1.codTx.value = enviara;
    document.getElementById('depsel').style.display = 'none';
    document.getElementById('carpper').style.display = 'none';
    document.getElementById('depsel8').style.display = 'none';
    document.getElementById('Enviar').style.display = 'none';
    
    //mover
    if(enviara==10) {
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
    if (enviara==13) {    
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
    
    if (enviara==16) {    
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
    if (enviara==12) {    
      document.getElementById('depsel').style.display = '';
      document.getElementById('Enviar').style.display = '';
      MM_swapImage('Image9','','{$ORFEO_URL}/imagenes/internas/reasignar.gif',1);
      MM_swapImage('Image10','','{$ORFEO_URL}/imagenes/internas/informar.gif',1);
      MM_swapImage('Image8','','{$ORFEO_URL}/imagenes/internas/moverA.gif',1);
      MM_swapImage('Image12','','{$ORFEO_URL}/imagenes/internas/vobo.gif',1);
      MM_swapImage('Image14','','{$ORFEO_URL}/imagenes/internas/NRR.gif',1);
      MM_swapImage('Image13','','{$ORFEO_URL}/imagenes/internas/archivar.gif',1);
    }
       
    if (enviara==11) {
    }

    //Reasignar
    if (enviara==9) {
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
    if (enviara==14) {
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
    if (enviara==8) {
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
