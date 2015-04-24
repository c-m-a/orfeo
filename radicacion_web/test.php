<?php
require("../include/phpmailer/class.phpmailer.php");
$mail = new PHPMailer();
//$mail->IsSMTP();
$mail->Host = "sirio.supersolidaria.gov.co";
$mail->From = "cau@supersolidaria.gov.co";
$mail->FromName = "Comunicaciones Supersolidaria <cau@supersolidaria.gov.co>";
//$mail->Mailer = "smtp";
//$mail->SMTPAuth = true;
//$mail->Username = 'cbarrero';
///$mail->Password = '0822cabc';
$mail->Subject = "BOLETIN VIRTUAL 09-10-09 09:22";
$mail->IsHTML(true);
$mail->Body = "envio de correo e"; 
$mail->AddAddress("carlos_albertobarrero@hotmail.com");
//$mail->SMTPDebug = true;

if(!$mail->Send()) 
{
	echo $mail->ErrorInfo;
}
else
	echo "ok correo";
$mail->ClearAddresses();
?>
