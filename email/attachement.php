<?php
session_start();
error_reporting(0);
include('../config.php');
//if(!$dependencia or !$krd) include ("../rec_session.php");
require_once "$PEAR_PATH/Mail/IMAPv2.php";
 $encabezado = session_name()."=".session_id()."&krd=$krd&fechah=$fechah";
 $passwdEmail=$_SESSION['passwdEmail'];
 $usuaEmail = $_SESSION['usuaEmail'];
 $krd = $_SESSION['krd'];
 $usuaDoc = $_SESSION['usua_doc'];
 $tmpNameEmail = "tmpEmail_".$usuaDoc."_".md5(date("dmy hms")).".html";
 $_SESSION['tmpNameEmail'] = $tmpNameEmail;
 $tmpNameEmail = $_SESSION['tmpNameEmail'];
 //echo var_dump($_SESSION);
 //echo $encabezado;
 list($a,$b)=split("@",$usuario_mail);
 $usuaEmail1=$a;
 $connection = "$protocolo_mail://$usuaEmail1:$passwdEmail@$servidor_mail:$puerto_mail/$buzon_mail#notls"; 
//echo $connection;
 if (!isset($_GET['dump_mid'])) {
  $msg =& new Mail_IMAPv2();
 } else {
  include  "$PEAR_PATH/Mail/IMAPv2/Debug/Debug.php";
  $msg =& new Mail_IMAP_Debug($connection);
  if ($msg->error->hasErrors()) {
  $msg->dump($msg->error->getErrors(FALSE));
  }
 }
 // Open up a mail connection
 if (!$msg->connect($connection)) 
 {
  echo "<span style='font-weight: bold;'>Error:</span> Unable to build a connection.";
 }
 //ho "<a href='../radicacion/chequear.php?".session_name()."=".session_id()."&ent=2&eMailMid={$mid}&eMailAmp&eMailPid=".$msg->msg[$mid]['at']['pid'][$i]."&fileeMailAtach=".$fname."&tipoMedio=eMail' target='formulario'>Radicar</a>
// <hr>";
//------------------------Funcion Suprime caracteres no imprimibles----------------------------//
 function sup_tilde($str)
{
 $stdchars= array("@","a","e","i","o","u","n","A","E","I","O","U","N"," "," ");
 $tildechars= array("@","=E1","=E9","=ED","=F3","=FA","=F1","=C1","=C9","=CD","=D3","=DA","=D1","=?iso-8859-1?Q?","?=");
 return str_replace($tildechars,$stdchars, $str);
}
//---------------------------------------------------------------------------------------//
 if(isset($_GET['mid'])&&isset($_GET['pid'])){
 	$body =$msg->getBody($_GET['mid'], $_GET['pid']);
	//lectura cabeceras----
	$msg->getHeaders($mid);
 	header('Content-Type: '.$body['ftype']);
  $eMailRemitente = $_SESSION['eMailRemitente'];
  $eMailNombreRemitente = $_SESSION['eMailNombreRemitente'];
	if($body['ftype']=="text/html") $nl="</br>"; else $nl="\n";
	
//---Encabezado de email------------------------------------------------------//
       //print_r ($msg->header[$mid] );
//----------------------------------------------------------------------------//
  echo $head;
  echo $body['message'];
 	//$msg->close();	
  $content = "". $head . $body['message'];
   $file = "correoEj";
   error_reporting(7);
   $dirTmp = "../bodega/tmp/";
   $fd = fopen($dirTmp.$file . ".html", "a+");
        fwrite($fd, "$content");
        fclose($fd);
 }
 else
 {
 	print("No hay Correo disponible");
 }
$fn=$body['fname'];

//-----Almacena temporalmente el archivo en formato html-----//
$fileEmailMsg = "../bodega/tmp/".$tmpNameEmail;
$file1=fopen($fileEmailMsg,'w');
fputs($file1,$head);
fclose($file1);
//-----------------------------------------------------------//
//--Adiciona el mensage--------//
$file1=fopen($fileEmailMsg,'a');
fwrite($file1,$body['message']);
fclose($file1);
//-----------------------------//
error_reporting(7);

?>
