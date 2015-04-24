<?php
error_reporting(7);
$EnDecryptText = new EnDecryptText();
/*
CUERPO DEL CORREO ELECTRONICO
*/
$cuerpo="<table width='100%'>";
$cuerpo.="<tr>";
$cuerpo.="<td><strong>Quejas contra entidades supervisadas</strong>";
$cuerpo.="</td>";
$cuerpo.="</tr>";
$cuerpo.="<tr>";
$cuerpo.="<td><br><br>Estimado(a) ".$_SESSION['nombre_remitente']." ".$_SESSION['apellidos_remitente'];
$cuerpo.="</td>";
$cuerpo.="</tr>";
$cuerpo.="<tr>";
$cuerpo.="<td align='justify'><br>Para continuar con el registro de su queja pulse click sobre la direcci&oacute;n Web que encontrar&aacute; a continuaci&oacute;n. <br><br><a href='http://orfeo38.supersolidaria.gov.co/orfeo-3.8.0/formularioWeb_ses/formularioconf.php?r=". $EnDecryptText->Encrypt_Text($_SESSION['numeroRadicado'])."' target='_blank'>http://orfeo38.supersolidaria.gov.co/orfeo-3.8.0/formularioWeb_ses/formularioconf.php?r=". $EnDecryptText->Encrypt_Text($_SESSION['numeroRadicado'])."</a><br><br>Si el enlace no abre una nueva p&aacute;gina Web, copie la direcci&oacute;n y peguela en su navegador de internet.<br><br>Recuerde: para consultar el estado de su queja puede ingresar a nuestra p&aacute;gina web:<br><a href='http://orfeoweb.supersolidaria.gov.co/orfeo-3.8.0/consultaWeb/' target='_blank'>http://www.supersolidaria.gov.co</a><br><br><br>Reciba un cordial saludo,<br><br><strong>Superintendencia de la Econom&iacute;a Solidaria</strong> ";
$cuerpo.="</td>";
$cuerpo.="</tr>";

$cuerpo.="</table>";

include $ruta_raiz."/conf/configPHPMailer.php";
require_once($ruta_raiz.'/include/PHPMailer_v5.1/class.phpmailer.php');
include $ruta_raiz."/include/PHPMailer_v5.1/class.smtp.php"; // optional, gets called from within class.phpmailer.php if not already loaded
$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch


$mail->AddAddress($_SESSION['email']);



  $mail->IsSMTP(); // telling the class to use SMTP
  $mail->SMTPDebug  = 1;              // enables SMTP debug information (for testing)
  $mail->SMTPAuth   = true;           // enable SMTP authentication
  $mail->Host       = $hostPHPMailer; // sets the SMTP server
  $mail->Port       = 465;             // set the SMTP port for the GMAIL server
  $mail->Username   = $userPHPMailer; // SMTP account username
  $mail->Password   = $passwdPHPMailer;
    $mail->SetFrom($admPHPMailer, $admPHPMailer);
  $mail->Subject = "QUEJAS CONTRA ENTIDADES SUPERVISADAS";
  $mail->IsHTML(true);
  $mail->Body = $cuerpo; 
  $mail->AddAddress($_SESSION['email']);
if(!$mail->Send()) 
{
	echo $mail->ErrorInfo;
}
else{
 echo "<br>ok correo<br>";
}
$mail->ClearAddresses();
?>
