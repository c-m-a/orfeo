      $(document).ready(function() {
        
        var opciones = ['#opciones_mover',
                        '#opciones_reasignar',
                        '#opciones_informar',
                        '#opciones_devolver',
                        '#opciones_vobo',
                        '#opciones_archivar',
                        '#opciones_agendar',
                        '#opciones_trd'];
        
        // Toggle the dropdown menu's
        $(".dropdown .button, .dropdown button").click(function () {
          $(this).parent().find('.dropdown-slider').slideToggle('fast');
          $(this).find('span.toggle').toggleClass('active');
          return false;
        });

        $('#select_all').click(function(event) {  //on click
          $('#tabla_radicados input:checkbox').prop('checked', this.checked);
        });

        // Funcion Mover
        $('#mover').click(function() {
          arreglo_radicados = [];
          $('#tabla_radicados :checked').each(function() {
            arreglo_radicados.push($(this).val());
          });

          if (arreglo_radicados.length == 0) {
            alert('No ha seleccionado ningun radicado');
          } else {
            for (i = 0; i < opciones.length; i++) 
              if (opciones[i] != '#opciones_mover')
                $(opciones[i]).hide();
            
            $('#opciones_mover').toggle();
          }
        });
        
        $('#reasignar').click(function() {
          arreglo_radicados = [];
          $('#tabla_radicados :checked').each(function() {
            arreglo_radicados.push($(this).val());
          });

          if (arreglo_radicados.length == 0) {
            alert('No ha seleccionado ningun radicado');
          } else {
            for (i = 0; i < opciones.length; i++) 
              if (opciones[i] != '#opciones_reasignar')
                $(opciones[i]).hide();
            
            $('#opciones_reasignar').toggle();
          }
        });
        
        $('#informar').click(function() {
          arreglo_radicados = [];
          $('#tabla_radicados :checked').each(function() {
            arreglo_radicados.push($(this).val());
          });

          if (arreglo_radicados.length == 0) {
            alert('No ha seleccionado ningun radicado');
          } else {
            for (i = 0; i < opciones.length; i++) 
              if (opciones[i] != '#opciones_informar')
                $(opciones[i]).hide();
            
            $('#opciones_informar').toggle();
          }
        });
        
        $('#devolver').click(function() {
          arreglo_radicados = [];
          $('#tabla_radicados :checked').each(function() {
            arreglo_radicados.push($(this).val());
          });

          if (arreglo_radicados.length == 0) {
            alert('No ha seleccionado ningun radicado');
          } else {
            for (i = 0; i < opciones.length; i++) 
              if (opciones[i] != '#opciones_devolver')
                $(opciones[i]).hide();
            
            $('#opciones_devolver').toggle();
          }
        });
        
        $('#vobo').click(function() {
          arreglo_radicados = [];
          $('#tabla_radicados :checked').each(function() {
            arreglo_radicados.push($(this).val());
          });

          if (arreglo_radicados.length == 0) {
            alert('No ha seleccionado ningun radicado');
          } else {
            for (i = 0; i < opciones.length; i++) 
              if (opciones[i] != '#opciones_vobo')
                $(opciones[i]).hide();
            
            $('#opciones_vobo').toggle();
          }
        });
        
        $('#archivar').click(function() {
          arreglo_radicados = [];
          $('#tabla_radicados :checked').each(function() {
            arreglo_radicados.push($(this).val());
          });

          if (arreglo_radicados.length == 0) {
            alert('No ha seleccionado ningun radicado');
          } else {
            for (i = 0; i < opciones.length; i++) 
              $(opciones[i]).hide();
          }
        });
        
        $('#agendar').click(function() {
          arreglo_radicados = [];
          $('#tabla_radicados :checked').each(function() {
            arreglo_radicados.push($(this).val());
          });

          if (arreglo_radicados.length == 0) {
            alert('No ha seleccionado ningun radicado');
          } else {
            for (i = 0; i < opciones.length; i++) 
              if (opciones[i] != '#opciones_agendar')
                $(opciones[i]).hide();
            
            $('#opciones_agendar').toggle();
          }
        });

        $('#archivar').click(function() {
          arreglo_radicados = [];
          $('#tabla_radicados :checked').each(function() {
            arreglo_radicados.push($(this).val());
          });

          if (arreglo_radicados.length == 0) {
            alert('No ha seleccionado ningun radicado');
          } else {
            for (i = 0; i < opciones.length; i++) 
              $(opciones[i]).hide();

            $('#ejecutar_opcion').append('<input name="codTx" value="13" type="hidden">');
            $('#ejecutar_opcion').submit();
          }
        });
          

        $('#trd').click(function() {
          arreglo_radicados = [];
          $('#tabla_radicados :checked').each(function() {
            arreglo_radicados.push($(this).val());
          });

          if (arreglo_radicados.length == 0) {
            alert('No ha seleccionado ningun radicado');
          } else {
            for (i = 0; i < opciones.length; i++) 
              $(opciones[i]).hide();
          }
        });

        $('#boton_mover').click(function() {
          codigo_carpeta = $( "#carpper" ).val();
          $('#ejecutar_opcion').append('<input name="carpSel" value="' + codigo_carpeta + '" type="hidden">');
          $('#ejecutar_opcion').append('<input name="codTx" value="10" type="hidden">');
          $('#ejecutar_opcion').submit();
        });

        $('#boton_reasignar').click(function() {
          codigo_dependencia = $( "#depsel" ).val();
          $('#ejecutar_opcion').append('<input name="depsel" value="' + codigo_dependencia + '" type="hidden">');
          $('#ejecutar_opcion').append('<input name="enviara" value="9" type="hidden">');
          $('#ejecutar_opcion').append('<input name="codTx" value="9" type="hidden">');
          $('#ejecutar_opcion').submit();
        });
        
        $('#boton_informar').click(function() {
          arreglo_dependencias = $("#depsel8").val();
          $('#ejecutar_opcion').append('<input name="depsel8[]" value="' + arreglo_dependencias + '" type="hidden">');
          $('#ejecutar_opcion').append('<input name="enviara" value="9" type="hidden">');
          $('#ejecutar_opcion').append('<input name="codTx" value="8" type="hidden">');
          $('#ejecutar_opcion').append('<input name="EnviaraV" value="VoBo" type="hidden">');
          $('#ejecutar_opcion').submit();
        });

        $('#boton_devolver').click(function() {
          codigo_dependencia = $( "#depsel" ).val();
          $('#ejecutar_opcion').append('<input name="depsel" value="' + codigo_dependencia + '" type="hidden">');
          $('#ejecutar_opcion').append('<input name="enviara" value="9" type="hidden">');
          $('#ejecutar_opcion').append('<input name="EnviaraV" value="VoBo" type="hidden">');
          $('#ejecutar_opcion').append('<input name="codTx" value="12" type="hidden">');
          $('#ejecutar_opcion').submit();
        });
        
        $('#boton_vobo').click(function() {
          codigo_dependencia = $( "#depsel" ).val();
          $('#ejecutar_opcion').append('<input name="depsel" value="' + codigo_dependencia + '" type="hidden">');
          $('#ejecutar_opcion').append('<input name="enviara" value="9" type="hidden">');
          $('#ejecutar_opcion').append('<input name="EnviaraV" value="VoBo" type="hidden">');
          $('#ejecutar_opcion').append('<input name="codTx" value="12" type="hidden">');
          $('#ejecutar_opcion').submit();
        });
        
      });

      // Close open dropdown slider/s by clicking elsewhwere on page
      $(document).bind('click', function (e) {
        if (e.target.id != $('.dropdown').attr('class')) {
          $('.dropdown-slider').slideUp();
          $('span.toggle').removeClass('active');
        }
      }); // END document.bind
