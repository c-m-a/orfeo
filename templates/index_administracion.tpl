<!DOCTYPE html>
<html>
  <head>
    {include file="head.tpl"}
    <title>Modulo Administraci&oacute;n</title>
  </head>
  <body>
    {include file="barra_navegacion.tpl"}

    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center">
          <strong>M&Oacute;DULO DE ADMINISTRACI&Oacute;N</strong>
        </div>
      </div>
      <!-- row -->
      <hr/>

      <div class="row">
        <div class="col-md-4 text-center">
          <a class="btn btn-info" href="{$ENLACE_USUARIOS}">
            Usuarios y Perfiles
          </a>
        </div>
        <div class="col-md-4 text-center">
          <a class="btn btn-info" href="{$ENLACE_DEPENDENCIAS}">
            Dependencias
          </a>
        </div>
        <div class="col-md-4 text-center">
          <a class="btn btn-info" href="{$ENLACE_DIAS}">Dias No Habiles</a>
        </div>
      </div>
      <!-- row -->
      <br/>

      <div class="row">
        <div class="col-md-4 text-center">
          <a class="btn btn-info" href="{$ENLACE_ENVIOS}">
            Env&iacute;o De Correspondencia
          </a>
        </div>
        <div class="col-md-4 text-center">
          <a class="btn btn-info" href="{$ENLACE_TABLAS}">Tablas Sencillas</a>
        </div>
        <div class="col-md-4 text-center">
          <a class="btn btn-info" href="{$ENLACE_TIPOS}">Tipos De Radicaci&oacute;n</a>
        </div>
      </div>
      <!-- row -->
      <br/>

      <div class="row">
        <div class="col-md-4 text-center">
          <a class="btn btn-info" href="{$ENLACE_PAISES}">Pa&iacute;ses</a>
        </div>
        <div class="col-md-4 text-center">
          <a class="btn btn-info" href="{$ENLACE_DEPTOS}">Departamentos</a>
        </div>
        <div class="col-md-4 text-center">
          <a class="btn btn-info" href="tbasicas/adm_mcpios.php">Municipios</a>
        </div>
      </div>
      <!-- row -->
      <br/>
      
      <div class="row">
        <div class="col-md-4 text-center">
          <a class="btn btn-info" href="tbasicas/adm_tarifas.php">Tarifas</a>
        </div>
        <div class="col-md-4 text-center">
          <a class="btn btn-info" href="tbasicas/adm_contactos.php">Contactos</a>
        </div>
        <div class="col-md-4 text-center">
          <a class="btn btn-info" href="{$ENLACE_ENTIDADES}">Entidades</a>
        </div>
      </div>
      <!-- row -->
      <hr/>
      
      <div class="row">
        <div class="col-md-12 text-center">
          <a class="btn btn-info" href="{$ENLACE_AUDITORIA}">
            <strong>M&Oacute;DULO DE AUDITORIA</strong>
          </a>
        </div>
      </div>
      <!-- row -->
      <hr/>
      
      <div class="row">
        <div class="col-md-12 text-center">
          <strong>OPCIONAL</strong>
        </div>
      </div>
      <!-- row -->
      <hr/>
      
      <div class="row">
        <div class="col-md-4 text-center">
          <a class="btn btn-info" href="{$ENLACE_EMPRESAS}">Entidades SES</a>
        </div>
        <div class="col-md-4 text-center">
          <a class="btn btn-info" href="{$ENLACE_FUNCIONARIOS}">Funcionario - Entidad</a>
        </div>
        <div class="col-md-4 text-center">
          <a class="btn btn-info" href="{$ENLACE_ESP}">Entidades</a>
        </div>
      </div>
    </div>
  </body>
</html>
