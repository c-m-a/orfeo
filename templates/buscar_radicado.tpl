<html>
  <head>
    <title>Modulo de Auditoria</title>
    <link rel="stylesheet" type="text/css" href="../../js/spiffyCal/spiffyCal_v2_1.css">
    <link rel="stylesheet" href="../../estilos/orfeo.css">
    
  </head>
  <body>
    <table width="100%"  border="0" cellpadding="0" cellspacing="5" class="borde_tab">
      <tr>
        <td colspan="2" class="titulos4">
          <center>
            MODULO DE AUDITORIA DE USUARIOS
          </center>
        </td>
      </tr>
      <tr>
        <td width="30%" class="titulos2">
          BUSCAR EL RADICADO :
        </td>
        <td class="listado2" align="left">
          <input id="numero_radicado" type="text" name="numero_radicado" value="">
          <input id="buscar_auditoria" type="submit" class="botones_funcion" value="Buscar Registros" name="accion">
        </td>
      </tr>
    </table>
    <div id="resultado"></div>
  </body>
  <!-- jQuery -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/jquery-1.9.1.min.js"><\/script>')</script> 
  <script>
    $(document).ready(function() {
      $('#buscar_auditoria').click(function(){
        $.ajax({
          type: "POST",
          url: "{$AJAX_ARCHIVO_EJECUTAR}",
          data: 'numero_radicado=' + $('#numero_radicado').val(),
          success: function(datos) {
            $("#resultado").empty();
            $("#resultado").append(datos);           
          }
        }); // Ajax Call
      }); //event handler
    }); //document.ready
  </script>
</html>
