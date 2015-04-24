<? 
session_start();
error_reporting(0);
?>
<html>
<HEAD>
  <STYLE TYPE="text/css">
    #flotante { position: absolute; top:100; left: 550px; visibility: visible;}
  </STYLE>
</HEAD>
<BODY>
<?
$ruta_raiz = "..";
include($ruta_raiz.'/config.php');
//if(!$dependencia or !$krd) include ("../rec_session.php");
 $encabezado = session_name()."=".session_id()."&krd=$krd&fechah=$fechah";
 include "connectIMAP.php";
?>

<?
//------------------------Funcion Suprime caracteres no imprimibles----------------------------//
 function sup_tilde($str)
{
 $stdchars= array("@","a","e","i","o","u","n","A","E","I","O","U","N"," "," ");
 $tildechars= array("@","=E1","=E9","=ED","=F3","=FA","=F1","=C1","=C9","=CD","=D3","=DA","=D1","=?iso-8859-1?Q?","?=");
 return str_replace($tildechars,$stdchars, $str);
}
//---------------------------------------------------------------------------------------//
 if(isset($_GET['eMailMid'])&&isset($_GET['eMailPid'])){
  $body =$msg->getBody($_GET['eMailMid'], $_GET['eMailPid']);
  //lectura cabeceras----
  $msg->getHeaders($eMailMid);
  $eMailRemitente = $_SESSION['eMailRemitente'];
  $eMailNombreRemitente = $_SESSION['eMailNombreRemitente'];
	if($body['ftype']=="text/html") $nl="</br>"; 
		else{

		 $nl="<br>";
		 
		}
$reeAsuntoO = "Reenvio:".$msg->header[$eMailMid]['Subject'];

//---Encabezado de email------------------------------------------------------//
       //print_r ($msg->header[$mid] );
  $contenidoEmail = $head;
  $contenidoEmail .= $body['message'];
	$headRadicado = "Fecha : ".$msg->header[$eMailMid]['Date']."";

  $head="De :". sup_tilde($msg->header[$eMailMid]['from_personal'][0])." <".sup_tilde($msg->header[$eMailMid]['from'][0]).">$nl";
	$head .="Asunto :". $msg->header[$eMailMid]['Subject'] ."<BR>";
	$iMail = 0;
 if(count($msg->header[$eMailMid]['to_personal'])>=1)
 {
  foreach($msg->header[$eMailMid]['to_personal'] as $key => $value)
	{
	   if($iMail==0) 
		{
		  $head.="Para :";
		} 
		else
		{
		  $head.=", ";
		}
	   $head.="".sup_tilde($msg->header[$eMailMid]['to_personal'][$iMail])."";
	   $head.="< ".$msg->header[$eMailMid]['to'][$iMail]." >";
	   $iMail++;
	}
 }
  $head.="$nl    Enviado Desde Serv :". $msg->header[$eMailMid]['sender_host'][0]."";
//----------------------------------------------------------------------------//
  $reeContent = $head . "\r\n". $body['message'];
	$head =$headRadicado . $head;

if(!$reeAsunto) $reeAsunto = $reeAsuntoO;
if($reenviar=='ok')
{
		$headers .= "From: ". $_SESSION['pagina_web']."\r\n";
		
		//dirección de respuesta, si queremos que sea distinta que la del remitente
		$headers .= "Reply-To: sspd@superservicios.gov.co\r\n";
		
		//ruta del mensaje desde origen a destino
		$headers .= "Return-path: sspd@superservicios.gov.co\r\n";
		
			$motivo = $reeAsunto;
			$texto = $reeTexto . "\r\n ---------- Mensaje  Reenviado ----------\r\n" . $contenidoEmail;
			$destinatario = $reeDestinatarios;
			$envioMail = mail("$destinatario",$motivo, $texto,$headers);
			echo "<hr>";
			if(!$envioMail)
			{
			echo "<br>Fallo el Envio de Correo respuesta $destinatario ->".$envioMail;
			}else{
			echo "<br>Se envio el Correo a $destinatario ->".$envioMail;
		}
 }else{
?>
<form method='GET' action='forwardMail.php'>
<input type=hidden name=eMailMid value='<?=$eMailMid?>'>
<input type=hidden name=eMailPid value='<?=$eMailPid?>'>
<input type=hidden name=reenviar value='ok'>

Destinatarios <input type=text name=reeDestinatarios value='' size=100><br><font size=1>(para varios separelos por coma  ej. aaa@gmail, yoapoyo@orfeogpl.org,)</font><br>
Asunto <input type=text name=reeAsunto value='<?=$reeAsunto?>' size=100><br>
Mensaje<br>
<textarea cols="80" rows="5" name="reeTexto">
</textarea><br>
<input type=submit value="Enviar . . . ">
</form>
<?	
}

  echo $head;
  echo str_replace("\n","<br>",$body['message']);
  
   error_reporting(7);
 }
 else
 {
 	print("No hay Correo disponible");
 }
$fn=$body['fname'];
//--Variable con la Cabecera en formato html----------------------------------//
$nl="<br>";
error_reporting(7);

?>
</BODY>
</html>
