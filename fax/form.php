<?php
  session_start();

  include('../config.php');

  /**
    * Se añadio a la 3.8.0 por
    * @autor CARLOS BARRERO 2009-10-07
    * @licencia GNU/GPL
    */
  foreach ($_GET as $key => $valor)   ${$key} = $valor;
  foreach ($_POST as $key => $valor)   ${$key} = $valor;
  
  $krd = (isset($_SESSION['krd'])) ? $_SESSION['krd'] : null;
  $_SESSION['servfax'] = (empty($_SESSION['servfax']))? $servidor_fax : $_SESSION['servfax'];
  $password = null;
  
  $ruta_raiz = "..";
  
  define('ADODB_ASSOC_CASE', 1); 
  include_once ('../include/db/ConnectionHandler.php');

  $db = new ConnectionHandler($ruta_raiz);
  $db->conn->SetFetchMode(ADODB_FETCH_NUM);

  $fechah = date("ymd") ."_". time("hms");
  include('./functions.php');
  $vars = session_name()."=".session_id()."&krd=$krd&ent=2";
?>
<html>
<head>
  <title>form</title>
  <meta name="GENERATOR" content="Quanta Plus">
  <link rel="stylesheet" href="../estilos/orfeo.css">
</head>
<body>
<?php
	switch($lista) {
		case "inbox":
	 		recvq_list($db, $krd, USUARIO_ADMIN_FAX, $vars, SERVIDOR_FAX, PASSWORD);
	 	break;
		case "historico":
	 		recvq_list_historico($db, $krd, $vars);
	 	break;
	 	case "outbox":
	 		doneq_list(SERVIDOR_FAX, USUARIO_ADMIN_FAX);
	 	break;
	 	case "process":
	 		sendq_list(SERVIDOR_FAX);
	 	break;
	 	case "faxStat":
	 		faxStat_list(SERVIDOR_FAX, $vars, USUARIO_ADMIN_FAX);
	 	break;
	 	default:
	 		recvq_list($db, $krd, USUARIO_ADMIN_FAX, $vars, SERVIDOR_FAX);
	 	break;
	}
?>
</body>
</html>
