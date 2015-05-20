<?php
  include('./config.php');
  include('./include/db/ConnectionHandler.php');
  
  session_start();

  $ruta_raiz = '.';
  $redirect = true;
  
  $db = new ConnectionHandler($ruta_raiz);
  $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
  
  $fecha = "'FIN  " . date("Y:m:d H:mi:s") . "'";
 
  $isql  = "update usuario 
		          set usua_sesion=" . $fecha . " 
		          where USUA_SESION like '%" . session_id() . "%'";
  
  if (!$db->conn->Execute($isql))
    exit('Ocurrio un problema en al base de datos');
  
  //  fin cierre session
  session_destroy();
  
  if ($redirect) 
    header('Location: ' . ORFEO_URL);
  else
    header('Location: ' . ORFEO_URL . 'paginaError.php');
?>
