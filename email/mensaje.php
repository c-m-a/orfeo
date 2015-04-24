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
<table width="50%"><TR><TD>
<b><font size=3><a href='../radicacion/chequear.php?<?=session_name()?>=<?=session_id()?>&ent=2&eMailMid=<?=$eMailMid?>&eMailAmp=<?=$eMailAmp?>&eMailPid=<?=$eMailPid?>&fileeMailAtach=<?=$fname?>&tipoMedio=eMail' target='formulario'>Radicar Este Correo</a></font></b>
</td><td><b><font size=3><a href='forwardMail.php?<?=session_name()?>=<?=session_id()?>&ent=2&eMailMid=<?=$eMailMid?>&eMailAmp=<?=$eMailAmp?>&eMailPid=<?=$eMailPid?>&fileeMailAtach=<?=$fname?>&tipoMedio=eMail' >Reenviar</a></font></b>
</TD></TR></table>
<?
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
  $eMailRemitente = $_SESSION['eMailRemitente'];
  $eMailNombreRemitente = $_SESSION['eMailNombreRemitente'];
	if($body['ftype']=="text/html") $nl="</br>"; 
		else{

		 $nl="<br>";
		 
		}
	
//---Encabezado de email------------------------------------------------------//
       //print_r ($msg->header[$mid] );
  $contenidoEmail = $head;
  $contenidoEmail .= $body['message'];
	$headRadicado = "
<TABLE width=\"80%\" cellspacing=\"0\" border=\"0\" cellpadding=\"0\" >
  <tr><td width=60%>&nbsp;</td>
  <td>
		<FONT face='Code3of9,free3of9,FREE3OF9, FREE3OF9X' SIZE=12>*$nurad*</FONT><br>
		Radicado No. $nurad<br>
		Fecha : ".$msg->header[$mid]['Date']."
  </td></tr>
 </TABLE>";

  $head="De :". sup_tilde($msg->header[$mid]['from_personal'][0])." <".sup_tilde($msg->header[$mid]['from'][0]).">$nl";
	$head .="Asunto :". $msg->header[$mid]['Subject'] ."<BR>";
	$iMail = 0;
 if(count($msg->header[$mid]['to_personal'])>=1)
 {
  foreach($msg->header[$mid]['to_personal'] as $key => $value)
	{
	   if($iMail==0) 
		{
		  $head.="Para :";
		} 
		else
		{
		  $head.=", ";
		}
	   $head.="".sup_tilde($msg->header[$mid]['to_personal'][$iMail])."";
	   $head.="< ".$msg->header[$mid]['to'][$iMail]." >";
	   $iMail++;
	}
 }
  $head.="$nl    Enviado Desde Serv :". $msg->header[$mid]['sender_host'][0]."";
//----------------------------------------------------------------------------//
	$head =$headRadicado . $head;

  echo $head;
  echo str_replace("\n","<br>",$body['message']);
  $content = "". $head . $body['message'];
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
