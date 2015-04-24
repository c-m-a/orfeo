<?php
error_reporting(0);
$krdAnt = $krd;
session_start(); 
if(!$krd)  $krd = $krdAnt;
$ruta_raiz = "..";
if (!$dependencia)   include "../rec_session.php";
error_reporting(7);
$fechah = date("ymd") ."_". time("hms");
   include("functions.php");
   $vars = session_name()."=".session_id()."&krd=$krd&ent=2";
?>
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