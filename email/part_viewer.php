 <?php
 error_reporting(0);
 require_once '../pear/Mail/IMAPv2.php';
// $connection = 'imap://djinete:djinete@imap.admin.gov.co:143/INBOX#notls';
 $connection = 'imap://mhaposai:mhaposaI321@200.31.196.117:143/INBOX#notls';
//Inicio de la transaccion de correo
 if (!isset($_GET['dump_mid'])) 
 {
  $msg =& new Mail_IMAPv2();
 } 
 else 
 {
// LLamado a bebug.
   include '../pear/Mail/IMAPv2/Debug/Debug.php';
   $msg =& new Mail_IMAP_Debug($connection);
   if ($msg->error->hasErrors()) 
	 {
   $msg->dump($msg->error->getErrors(TRUE));
   }
  }
/*------------- Abre buzon y conexion y cuenta cuantos mensajes existen------------------*/
if (!$msg->connect($connection))
{ 
echo $msg->alerts();
echo $msg->errors();
echo "<span style='font-weight: bold;'>Error:</span> No se pudo establecer coneccion con el Servidor.";
}
//$msgcount = $msg->messageCount();
/*----------------------------------------------------------------------------------------*/
 $body = $msg->getBody($_GET['mid'], $_GET['pid']);
 // Use this to *not* set the seen flag
 // $body = $msg->getBody($mid, $pid, 0, 'text/html', FT_PEEK);
 //
 // Must also use this in the call to getHeaders above.
 header('Content-Type: '.$body['ftype']);
 echo $body['message'];
 // Close the stream
 $msg->close();
 ?>