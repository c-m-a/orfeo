<!DOCTYPE>
<html>
  <head>
    <title>Adm - Contrase&ntilde;as - ORFEO 3 </title>
    <link rel="stylesheet" href="estilos/orfeo.css">
  </head>
  <body bgcolor="#<?=$colorFondo?>">
    <center>
      <font face='Verdana, Arial, Helvetica, sans-serif' SIZE=3 color=white>
      <p>
        <a href="<?=$ruta_raiz?>/index.php" target="_parent">
        <img border="0" src="<?=$ruta_raiz?>/imagenes/logo2.gif" width="206" height="76"></a>
      </p>
      <p> Su sesion ha <strong>expirado</strong> o ha ingresado en otro equipo!!</p>
      <p> Por favor cierre su navegador e intente de nuevo.</p>
    </font>
    </center>
  <?php
  if (session_id())
    session_destroy();
  ?>	
  </body>
</html>
