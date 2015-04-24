<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="{$ORFEO_URL}/estilos/orfeo.css">
    <script language="JavaScript" type="text/JavaScript">
      function cerrar_session() {
        if (confirm('Esta seguro de Cerrar Sesion ?')) {
          fecha = {$DATE_SESSION};
          $fechah = {$DATE_SESSION};
          nombreventana="ventanaBorrar"+fecha;
          url="login.php?adios=chao";
          document.form_cerrar.submit();
        }
      }
    </script>
  </head>
  <body style="background: #1f7185" topmargin="0" leftmargin="0">
    <form name="form_cerrar" action="{$CERRAR_SESSION}" target="_parent" method="post">
      <table width="100%" height="76"  border="0" cellpadding="0" cellspacing="0" class="eFrameTop">
        <tr>
          <td width="206">
            <img name="cabezote_r1_c1" src="imagenes/logo.gif" width="206" height="76" border="0" alt="">
          </td>
        <td>
          <img name="cabezote_r1_c2" src="imagenes/cabezote_r1_c2.gif" width="100%" height="76" border="0" alt="">
        </td>
        <td width="62">
          <a href="./Manuales/ayudaorfeo/content.htm" target="Ayuda_Orfeo">
            <img src="imagenes/ayuda.gif" name="Image8" width="62" height="76" border="0" title="MANUAL ORFEO" ALT="Ayuda">
          </a>
        </td>
        <td width="61">
          <a href="{$MODIFICAR}" target="mainFrame">
            <img src="./imagenes/info.gif" width="61" height="76" border="0"></a>
        </td>
        <td width="61">
          <a href="{$CREDITOS}" target="mainFrame">
            <img src="./imagenes/creditos.gif" width="61" height="76" border="0"></a>
        </td>
        <td width="61">
          <a href="{$CONTRASENA_URL}" target="mainFrame">
            <img src="./imagenes/contrasena.gif" width="61" height="76" border="0">
          </a>
        </td>
        <td width="66">
          <a href="{$ESTADISTICAS}" target="mainFrame">
            <img src="imagenes/estadistic.gif" width="66" height="76" border="0">
          </a>
        </td>
        <td width="54">
          <a href='#' onClick="cerrar_session();">
            <img name="cabezote_r1_c8" src="./imagenes/salir.gif" width="54" height="76" border="0" alt="Cerrar Sesi&oacute;n">
        </a>
      </td>
    </tr>
  </table>
  </form>
</body>
</html>
