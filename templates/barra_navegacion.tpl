    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Orfeo+</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="#about">Inicio</a></li>
          </ul>
          <form class="navbar-form navbar-left" role="search" action="{$ACCION_BUSCAR}" method="POST">
            <div class="form-group">
              <input type="text" size="30" name="busqRadicados" class="form-control" placeholder="Radicados separados por comas">
              <button type="submit" value="Buscar" name="Buscar" class="btn btn-default">Buscar</button>
            </div>
          </form>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">M&oacute;dulos<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="./Administracion/">Administraci&oacute;n</a></li>
                <li><a href="#">Reasignaci&oacute;n Autom&aacute;tica</a></li>
                <li><a href="#">Modulo Cooperativas</a></li>
                <li><a href="#">Editor Flujos</a></li>
                <li><a href="#">Env&iacute;os</a></li>
                <li><a href="#">Modificaci&oacute;n</a></li>
                <li><a href="#">Firma Digital</a></li>
                <li><a href="#">Impresi&oacute;n</a></li>
                <li><a href="#">Anulaci&oacute;n</a></li>
                <li><a href="#">Tablas Retenci&oacute;n Documental</a></li>
                <li><a href="#">Consultas</a></li>
                <li><a href="#">Archivo (1)</a></li>
                <li><a href="#">Prestamo</a></li>
                <li><a href="#">Dev Correo</a></li>
                <li><a href="#">Radicación Archivo Central</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Otros modulos</li>
                <li><a href="#">Estad&iacute;sticas</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Radicaci&oacute;n <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Entrada</a></li>
                <li><a href="#">Salida</a></li>
                <li><a href="#">Memorando</a></li>
                <li><a href="#">Masiva</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Otras Opciones</li>
                <li><a href="#">Asociar Imagen</a></li>
                <li><a href="#">Plantillas</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{$NOMBRE_USUARIO}<span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="{$MODIFICAR}">Informaci&oacute;n personal</a></li>
                <li><a href="{$CONTRASENA_URL}">Contrase&ntilde;a</a></li>
                <li class="divider"></li>
                <li><a href="{$CREDITOS}">Acerca de Orfeo+</a></li>
                <li><a href="{$CERRAR_SESSION}">Cerrar</a></li>
              </ul>
            </li>
          </ul>
        </div>
        <!--/.nav-collapse -->
        </div>
      </nav>
