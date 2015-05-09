<?php
  if (is_file('./config.php')) {
    include ('login.php');
    //include ('mantenimiento.php');
  } else {
    //include ('./config.php');
    header ('Location: ' . 'instalador');
    exit();
  }
?>
