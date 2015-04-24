<?
require_once($ruta_raiz.'/include/PHPMailer_v5.1/class.phpmailer.php');
$query = "select u.USUA_EMAIL
		from usuario u
		where u.USUA_CODI ='$usuaCodiMail' and  u.depe_codi='$depeCodiMail'";
//$db->conn->debug = true;
$rs=$db->conn->query($query);
$mailDestino = $rs->fields["USUA_EMAIL"];
//echo "$mailDestino";
//$db->conn->debug = true;
include $ruta_raiz."/conf/configPHPMailer.php";
include($ruta_raiz.'/include/PHPMailer_v5.1/class.smtp.php'); // optional, gets called from within class.phpmailer.php if not already loaded
$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch

try {
  $mail->Host       = $hostPHPMailer; // SMTP server
  $mail->IsSMTP(); // telling the class to use SMTP
  $mail->SMTPDebug  = 1;              // enables SMTP debug information (for testing)
  $mail->SMTPAuth   = true;           // enable SMTP authentication
  $mail->Host       = $hostPHPMailer; // sets the SMTP server
  $mail->Port       = $portPHPMailer;             // set the SMTP port for the GMAIL server
  $mail->Username   = $userPHPMailer; // SMTP account username
  $mail->Password   = $passwdPHPMailer;        // SMTP account password
//  $mail->AddReplyTo('name@yourdomain.com', 'First Last');
  $mail->AddAddress($mailDestino, "$mailDestino");
  //$mail->From = "orfeo@supersolidaria.gov.co";
  $mail->SetFrom($admPHPMailer, $admPHPMailer);
  //$mail->AddAddress($mailDestino, "$mailDestino");
  //$mail->AddBcc("jlosada@gmail.com", "jlosada@gmail.com");
  //$mail->AddBcc("mfelizzola@supersolidaria.gov.co", "mfelizzola@supersolidaria.gov.co");
  
//  $mail->AddReplyTo('name@yourdomain.com', 'First Last');
  $mensaje = file_get_contents($ruta_raiz."/conf/MailRadicado.html");
  $asuntoMail =  $asuntoMailRadicado;
  if($codTx==8) {
    $mensaje = file_get_contents($ruta_raiz."/conf/MailInformado.html");
	$asuntoMail =  $asuntoMailInformado;
  }
  if($codTx==9){
   $mensaje = file_get_contents($ruta_raiz."/conf/MailReasignado.html");
	 $asuntoMail =  $asuntoMailReasignado;
   if($EnviaraV=="VoBo"){
    $mensaje = file_get_contents($ruta_raiz."/conf/MailVoBo.html");
    $asuntoMail =  $asuntoMailVoBo;
   }
  }
  $mail->Subject = "OrfeoGPL: $asuntoMail"; 
  $mail->AltBody = 'Para ver correctamente el mensaje, por favor use un visor de mail compatible con HTML!'; // optional - MsgHTML will create an alternate automatically
  $mensaje = str_replace("*RAD_S*", $radicadosSelText, $mensaje);
  $mensaje = str_replace("*USUARIO*", $krd, $mensaje);
  $linkImagenes = str_replace("*SERVIDOR_IMAGEN*",$servidorOrfeoBodega,$linkImagenes);
  $mensaje = str_replace("*IMAGEN*", $linkImagenes, $mensaje);
  $mensaje = str_replace("*ASUNTO*", $asu, $mensaje);
  $nom_r = $nombre_us1 ." ". $prim_apel_us1." ". $seg_apel_us1. " - ". $otro_us1;
  $mensaje = str_replace("*NOM_R*", $nom_r, $mensaje);
  $mensaje = str_replace("*RADICADO_PADRE*", $radicadopadre, $mensaje);
  $mensaje = str_replace("*MENSAJE*", $observa, $mensaje);
  $mensaje .= "<hr>Sistema de gestion Orfeo. http://www.orfeogpl.org - http://www.correlibre.org";
  $mail->MsgHTML($mensaje);
  //$mail->AddAttachment('images/phpmailer.gif');      // attachment
  //$mail->AddAttachment('images/phpmailer_mini.gif'); // attachment
  if($mail->Send()){
  echo "Enviado correctamente a:  $mailDestino</br>\n"; 
  }else{
    echo "<font color=red>No se envio Correo a $mailDestino</font>";
  }
} catch (phpmailerException $e) {
  echo $e->errorMessage() . " " .$mailDestino; //Pretty error messages from PHPMailer
} catch (Exception $e) {
  echo $e->getMessage() . " " .$mailDestino; //Boring error messages from anything else!
}
?>
