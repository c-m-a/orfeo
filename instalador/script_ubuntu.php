<?php
  define ('OPCIONAL',   2);
  define ('NECESARIO',  0);
  define ('SUCCESS',    true);
  define ('ERROR',      false);
  
  // Verificar la version de Ubuntu instalada
  $requerimientos_os = array();
  
  // Verificar el software que esta instalado
  $requerimientos_software = array();

  // Verificar version de PHP y librerias instaladas
  $requerimientos_php = array(
      'php'   => array('PHP 5.3.0',
                          version_compare(phpversion(), '5.3.0', '>='),
                          NECESARIO),
      'xml'   => array('Extension XML',
                          extension_loaded('xml'),
                          NECESARIO),
      'zip'   => array('Extension ZipArchive (opcional)',
                          extension_loaded('zip'),
                          OPCIONAL),
      'gd'    => array('Extension GD (opcional)',
                          extension_loaded('gd'),
                          OPCIONAL),
      'xmlw'  => array('Extension XMLWriter (opcional)',
                          extension_loaded('xmlwriter'),
                          OPCIONAL),
      'xsl'   => array('Extension XSL (opcional)',
                          extension_loaded('xsl'),
                          OPCIONAL),
      'mysql' => array('Extension MySql',
                          extension_loaded('mysqli'),
                          NECESARIO),
      'postgres' => array('Extension Postgresql',
                          extension_loaded('pgsql'),
                          NECESARIO),
      'oracle'  => array('Extension Oracle',
                          extension_loaded('oci8'),
                          NECESARIO),
      );
  
  $resultados = array(ERROR   => 'no instalado',
                      SUCCESS => 'instalado');
  
  $rs_styles  = array(ERROR     => 'alert-error',
                      SUCCESS   => 'alert-success',
                      OPCIONAL  => 'alert-block');
  
  $i = 0;
  $reqs_php = array();
  
  foreach ($requerimientos_php as $key => $value) {
    list ($etiqueta, $resultado, $tipo_lib) = $value;

    if ($resultado == ERROR)
      $tipo_lib = ($tipo_lib == NECESARIO)? ERROR : OPCIONAL;
    else
      $tipo_lib = SUCCESS;
    
    $reqs_php[$i]['numeral']   = $i + 1;
    $reqs_php[$i]['resultado'] = $resultados[$resultado];
    $reqs_php[$i]['tipo_lib']  = $rs_styles[$tipo_lib];
    $reqs_php[$i]['etiqueta']  = $etiqueta;
    $i++;
  }

  $smarty->assign('REQS_PHP', $reqs_php); 
  $smarty->display('requerimientos.tpl');
?>
