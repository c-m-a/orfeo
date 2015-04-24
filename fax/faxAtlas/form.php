<?php
error_reporting(7);
$krdAnt = $krd;
session_start(); 
if(!$krd)  $krd = $krdAnt;
$ruta_raiz = "..";
if (!$dependencia)   include "../rec_session.php";
$fechah = date("ymd") ."_". time("hms");
   include("functions.php");
   $vars = session_name()."=".session_id()."&krd=$krd&ent=2";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <title>form</title>
  <meta name="GENERATOR" content="Quanta Plus">
  <link rel="stylesheet" href="../estilos_totales.css">
</head>
<body>
<?php
	switch($lista)
	{
		case "inbox":
	 		recvq_list();
	 	break;
	 	case "outbox":
	 		doneq_list();
	 	break;
	 	case "process":
	 		sendq_list();
	 	break;
	 	default:
	 		recvq_list();
	 	break;
	}
?>
</body>
</html>