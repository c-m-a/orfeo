<?
/**
  *  Conexion al Correo Electronico.
  *
  **/
 error_reporting(7);
 $PEAR_PATH = $_SESSION["PEAR_PATH"];
 $passwdEmail=$_SESSION['passwdEmail'];
 $usuaEmail = $_SESSION['usuaEmail'];
 $usuaDoc = $_SESSION['usua_doc'];
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
  
 }else{
  $eMailPid = $_SESSION['eMailPid'];
  $eMailMid = $_SESSION['eMailMid'];
  $eMailAmp = $_SESSION['eMailAmp'];
 }
 list($a,$b)=split("@",$usuaEmail);
 $usuaEmail1=$a;
 $connection = "$protocolo_mail://$usuaEmail1:$passwdEmail@$servidor_mail:$puerto_mail/.#notls"; 
 //$connection = "{$servidor_mail:$puerto_mail/$protocolo_mail}Inbox", "superservicios.gov.co/jlosada/jlosada","JairoH792005";
	print $connection; 
	if(imap_open ('{'.$servidor_mail.':'.$puerto_mail.'}INBOX', "jlosada","JairoH792005"))
	{
			echo 'Connection success!';
	}
	else
	{
			echo 'Connection failed';
	}
	

//$msgMng = new Mail_IMAPv2_ManageMB($connection);
 // Open up a mail connection
 if (!$msg->connect($connection)) 
 {
  echo "<span style='font-weight: bold;'>Error:</span> No se pudo realizar la conexion al serv. de correo.";
 }

?>
