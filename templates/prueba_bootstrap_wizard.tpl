<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, install-scale=1">
    <title>Instalacion de Sistema de Gestion Documental {$NOMBRE_APP}</title>
    <base href="{$URL_APP}">
    <!-- <link href="{$BOOTSTRAP_CSS}" rel="stylesheet"> -->
    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet">-->
    <link href="http://vadimg.com/twitter-bootstrap-wizard-example/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!--<link href="../css/bootstrap-wizard.css" rel="stylesheet">-->

  </head>
  <body>
    <div class="container">
      <h1>Hola Mundo</h1>
      <div id="wizard">
        <div class="navbar">
          <div class="navbar-inner">
            <div class="container">
              <ul>
                <li><a href="#tab1" data-toggle="tab">Primero</a></li>
                <li><a href="#tab2" data-toggle="tab">Segundo</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="tab-content">
          <div class="tab-pane" id="tab1">Uno es de los elegidos</div>
          <div class="tab-pane" id="tab2">Segundo primeros</div>
        </div>
      </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's Javascript pluins) -->
    <script src="{$JQUERY}"></script>
    <!--<script src="{$BOOTSTRAP_JS}"></script>-->
    <script src="http://vadimg.com/twitter-bootstrap-wizard-example/bootstrap/js/bootstrap.min.js"></script>
    <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>-->
    <script src="http://vadimg.com/twitter-bootstrap-wizard-example/jquery.bootstrap.wizard.js"></script>
    <script>
      $(document).ready(function() {
        $('#wizard').bootstrapWizard();
      });
    </script>
  </body>
</html>
