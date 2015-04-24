<!DOCTYPE html>
<html>
  <head>
  <title>.:: Sistema de Gesti&oacute;n Documental ::.</title>
  <link rel="shortcut icon" href="imagenes/arpa.gif">
  <script>
  function cerrar_ventana() {
    window.close();
  }
  </script>
  </head>
    <frameset rows="0,664*" frameborder="NO" border="0" framespacing="0" cols="*">
      <frame name="topFrame" scrolling="NO" noresize src="{$ENCABEZADO}">
        <frameset cols="175,947*" border="0" framespacing="0" rows="*">
          <frame name="leftFrame" scrolling="AUTO" src="{$MENU_IZQ}" marginwidth="0" marginheight="0" scrolling="AUTO">
          <frame name="mainFrame" src="{$DASHBOARD}" scrolling="AUTO">
          <frame src="UntitledFrame-3">
        </frameset>
    </frameset>
</html>
