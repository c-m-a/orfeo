<?php
  $cual_os  = 'cat /etc/*release';
  $os_release  = shell_exec($cual_os);
  
  $rs_match = preg_match(DISTRIB_ID, $os_release, $matches);

  if ($rs_match)
    $release = $matches[$rs_match - 1];
  else // Si no encontro nada del sistema operativo
    exit('El gestor documental no soporta el sistema operativo que esta usando');
  
  foreach ($sistemas_operativos as $archivo_cargar => $os) {
    $posicion = strpos($release, $os);
    
    if ($posicion) {
      include ($archivo_cargar);
      break;
    }
  }
?>
