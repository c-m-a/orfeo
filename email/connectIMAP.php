<?php
/**
  *  Conexion al Correo Electronico.
  *
  **/
error_reporting(7);
$PEAR_PATH = $_SESSION["PEAR_PATH"];
require_once "$PEAR_PATH/Mail/IMAPv2.php";
$passwdEmail=$_SESSION['passwdEmail'];
$usuaEmail = $_SESSION['usuaEmail'];
$usuaDoc = $_SESSION['usua_doc'];
$usuario_mail=$_SESSION['usua_email'];//HLP
$servidor_mail = $_SESSION['servidor_mail'];
$puerto_mail = $_SESSION['puerto_mail'];
$protocolo_mail = $_SESSION['protocolo_mail'];
$tmpNameEmail = "tmpEmail_".$usuaDoc."_".md5(date("dmy hms")).".html";
$_SESSION['tmpNameEmail'] = $tmpNameEmail;
$tmpNameEmail = $_SESSION['tmpNameEmail']; 
if(!$_SESSION['eMailPid'])
{
    $_SESSION['eMailAmp']=$_GET['mid'];
    $_SESSION['eMailPid']=$_GET['pid'];
    $eMailPid = $_GET['pid'];
    $eMailMid = $_GET['mid'];
}else
{
    $eMailPid = $_SESSION['eMailPid'];
    $eMailMid = $_SESSION['eMailMid'];
    $eMailAmp = $_SESSION['eMailAmp'];
}
list($a,$b)=split("@",$usuaEmail);
$usuaEmail1=$a;
$buzon_mail = $_SESSION['buzon_mail'];
$connection = "$protocolo_mail://$usuario_mail:$passwdEmail@$servidor_mail:$puerto_mail/$buzon_mail#ssl/novalidate-cert";
$buzonImap = imap_open("{".$servidor_mail.":".$puerto_mail."/ssl/novalidate-cert}INBOX", $usuario_mail, $passwdEmail) or die("No es posible conectarse: " . imap_last_error());
if (!isset($_GET['dump_mid']))
{
    $msg =& new Mail_IMAPv2();
}else
{
    include  "$PEAR_PATH/Mail/IMAPv2/Debug/Debug.php";
    $msg =& new Mail_IMAP_Debug($connection);
    if ($msg->error->hasErrors())
    {
        $msg->dump($msg->error->getErrors(FALSE));
    }
}
// Open up a mail connection
if (!$msg->connect($connection)) 
{
    echo "<span style='font-weight: bold;'>Error:</span> No se pudo realizar la conexion al serv. de correo.";
}
?>