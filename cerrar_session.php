<?php
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
    echo "<p><center>No pude actualizar<p><br>";
  
  //  fin cierre session
  session_destroy();
  
  if ($redirect) 
    include ('./login_bootstrap.php');
  else
    include "./paginaError.php";
?>
