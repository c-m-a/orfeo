<html>
  <head>
    <title>Opciones de Usuarios y Perfiles</title>
    {include file="head.tpl"}
  </head>
  <body>
    {include file="barra_navegacion.tpl"}
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <strong>Administraci&oacute;n de Usuarios y Perfiles</strong>
        </div>
      </div>
      <!-- row -->
      <br/>

      <div class="row">
        <div class="col-md-12 text-center">
          <a class="btn btn-info" href="crear.php?usModo=1">Crear Usuario</a>
        </div>
      </div>
      <!-- row -->
      <br/>

      <div class="row">
        <div class="col-md-12 text-center">
          <a class="btn btn-info" href="cuerpoEdicion.php?usModo=2" target="mainFrame">Editar Usuario</a>
        </div>
      </div>
      <!-- row -->
      <br/>

      <div class="row">
        <div class="col-md-12 text-center">
          <a class="btn btn-info" href="cuerpoConsulta.php">Consultar Usuario</a>
        </div>
      </div>
      <!-- row -->
      <br/>

      <div class="row">
        <div class="col-md-12 text-center">
        <a class="btn btn-info" href="{$ENLACE_TRANSLADO}">Translado Usuario</a>
        </div>
      </div>
      <!-- row -->
      <br/>

      <div class="row">
        <div class="col-md-12 text-center">
          <a class="btn btn-warning" href="../.">Volver</a>
        </div>
      </div>
      <!-- row -->
    
    </div>
    <!-- container -->
  </body>
</html>
