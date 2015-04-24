<?
session_start();
error_reporting(7);
$ruta_raiz = "..";
//if(!$dependencia or !$tpDepeRad) include "$ruta_raiz/rec_session.php";
define('ADODB_ASSOC_CASE', 1); 
include_once "../include/db/ConnectionHandler.php";
$tipoMed = $_SESSION['tipoMedio'];
$db = new ConnectionHandler("$ruta_raiz");
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
$eMailMid = $_SESSION['eMailMid'];
//$db->conn->debug =true;
//$sqlFechaHoy=$db->conn->query("select * from usuario");
$tmpNameEmail = $_SESSION['tmpNameEmail']; 
include "connectIMAP.php";


$chequeo = imap_mailboxmsginfo($buzonImap);
echo "Mensajes antes de borrar: " . $chequeo->Nmsgs . "<br />\n";
echo "a Borrar $eMailMid ";
imap_delete($buzonImap, $eMailMid);

$chequeo = imap_mailboxmsginfo($buzonImap);
echo "Mensajes después de borrar: " . $chequeo->Nmsgs . "<br />\n";

imap_expunge($buzonImap);

$chequeo = imap_mailboxmsginfo($buzonImap);
echo "Mensajes después de purgar: " . $chequeo->Nmsgs . "<br />\n";

imap_close($buzon);


?>
<html>
<head>
<title>:: Confirmacion Borrado de Mail ::</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../estilos_totales.css">
</head>

<body bgcolor="#FFFFFF" text="#000000" topmargin="0">
Borrando el Correo Electronico . . ..
<form method=post action="deleteMail.php??nurad=<?=$nurad?>&faxPath=<?=$faxPath?>&faxRemitente=<?=$faxRemitente?>&<?=$var_envio?>">
	<input type=submit value='Borrar este Correo' name=deleteMail>
</form>
<?
error_reporting(7);
$msg->imap_expunge();

 $krd = $_SESSION['krd'];
 $dependencia = $_SESSION['dependencia'];
 // echo "<hr>$dependencia<hr>";
  $var_envio=session_name()."=".trim(session_id())."&faxPath=$faxPath&leido=no&krd=$krd&ent=$ent&carp_per=$carp_per&carp_codi=$carp_codi&nurad=$nurad&depende=$depende&radi_usua_actu=radi_usua_actu";
if (strlen($nurad)==14) $consecutivo =6; else  $consecutivo =5; 
$x1=substr($nurad,0,4);
$x2=substr($nurad,4,3);
$x3=substr($nurad,7,$consecutivo);
$x4=substr($nurad,-1);
?> 
<center />

</center>
</body>
</html>
