<?php
session_start();
$usua_email = $_SESSION["usua_email"];
$krd =  $_SESSION["krd"];
$dependencia =  $_SESSION["dependencia"];
$_SESSION['eMailAmp']="";
$_SESSION['eMailMid']="";
$_SESSION['eMailPid']="";
$_SESSION['fileeMailAtach']="";
$_SESSION['tipoMedio']="";
$usuaDoc = $_SESSION['usua_doc'];
include '../config.php';
$usuaEmail=$_SESSION['usuaEmail'];
$dominioEmail=$_SESSION['dominioEmail'];
$passwdEmail=$_SESSION['passwdEmail'];
if(!$passwdEmail)
{
	$splitEmail = split("@",$usua_email);
	$usuaEmail = $splitEmail[0];
	$dominioEmail = $splitEmail[1];
	$_SESSION['usuaEmail']=$usuaEmail;
	$_SESSION['dominioEmail']=$dominioEmail;
        $_SESSION['passwdEmail']=$passwd_mail;
}
$ruta_raiz = "..,";
//if(!$dependencia or !$krd) include "../rec_session.php";
require_once "$PEAR_PATH/Mail/IMAPv2.php";
$connection = "$protocolo_mail://$usuaEmail:$passwdEmail@$servidor_mail:$puerto_mail/$buzon_mail#notls";
//echo $connection;
//Inicio de la transaccion de correo-----------------------------------------------------
   if (!isset($_GET['dump_mid'])) 
   {
   $msg =& new Mail_IMAPv2();
   } 
   else 
   {
   include "$PEAR_PATH/Mail/IMAPv2/Debug/Debug.php";
   $msg =& new Mail_IMAP_Debug($connection);
   if ($msg->error->hasErrors()) 
	 {
   $msg->dump($msg->error->getErrors(TRUE));
   }
  }
//------------------------Funcion Suprime caracteres extraña----------------------------//
 function sup_tilde($str)
{
 $stdchars= array(" at ","a","e","i","o","u","n","A","E","I","O","U","N"," "," ");
 $tildechars= array("@","=E1","=E9","=ED","=F3","=FA","=F1","=C1","=C9","=CD","=D3","=DA","=D1","=?iso-8859-1?Q?","?=");
 return str_replace($tildechars,$stdchars, $str);
}
//---------------------------------------------------------------------------------------//
//------------- Abre buzon y conexion y cuenta cuantos mensajes existen------------------//
if (!$msg->connect($connection))
{ 
echo $msg->alerts();
echo " Cod. ".$msg->errors()."->";
//header("location: login_email.php?err=1"); 
  echo "<span style='font-weight: bold;'>Error:</span> No se pudo establecer coneccion con el Servidor.";
$_SESSION['passwdEmail']="";
}
$msgcount = $msg->messageCount();
//----------------------------------------------------------------------------------------//
?>
<html>
<head>
<title> Entradas Pendientes </title>
<link rel="stylesheet" href="../estilos/orfeo.css" />
</head>
<body>
<span class='listado1'>
<?php
//echo " ". $msg->mailboxInfo['folder'].":(".$msgcount.") messages total.<br>.mailbox:".$msg->mailboxInfo['user'];
?>
<?php
if ($msgcount > 0)
{
 $stl=1;
 for ($mid = $_GET['mid'];$mid <= $_GET['mid']; $mid++)
  {
  // Lee las cabecera
  $msg->getHeaders($mid);
  $style = ((isset($msg->header[$mid]['Recent']) && $msg->header[$mid]['Recent'] == 'N') || (isset($msg->header[$mid]['Unseen']) && $msg->header[$mid]['Unseen'] == 'U'))? 'gray' : 'black';
  $msg->getParts($mid);
  if (!isset($msg->header[$mid]['subject']) || empty($msg->header[$mid]['subject']))
  {
  $msg->header[$mid]['subject'] = "<span style='font-style: italic;'>no subject provided</a>";
  }
 $eMailAsunto = "{$msg->header[$mid]['subject']}";
 $eMailRemitente ="{$msg->header[$mid]['from'][0]}";
 $eMailNombreRemitente = "{$msg->msg[$mid]['from_personal'][0]}";
 $eMailFecha =date('Y/mm/dd h:m:s',$msg->msg[$mid]['udate']);
 $_SESSION['eMailFecha']=$eMailFecha;
 $_SESSION['eMailAsunto'] = $eMailAsunto;
 $_SESSION['eMailRemitente'] = $eMailRemitente;
 $_SESSION['eMailNombreRemitente'] = $eMailNombreRemitente;
  echo "<span class=titulo1> - Asunto :</span> <a href='javascript: window.open(".'"'."attachement.php?mid={$mid}&amp;pid={$msg->msg[$mid]['pid']}".'"'.",".'"'."image".'"'.");
        window.open(".'"'."emailRadicar.php?mid={$mid}&amp;pid={$msg->msg[$mid]['pid']}".'"'.",".'"'."lista1".'"'."); ' target='image' style='color: {$style};' 
     onClick='javascript:window.open(frame_padre.htm,lista1);'>$emailAsunto</a>
   &nbsp; <span class=titulo1> - Remitente :</span>&nbsp;".
  " ", (isset($msg->header[$mid]['from_personal'][0]) && !empty($msg->header[$mid]['from_personal'][0]))? '<span title="'.sup_tilde($msg->header[$mid]['from'][0]).'">'.sup_tilde($msg->header[$mid]['from_personal'][0])."</span>" : sup_tilde( $msg->header[$mid]['from'][0]), "\n",
  "&nbsp;<span class=titulo1> - Fecha :</span>".date('Y/mm/dd h:i:s', $msg->header[$mid]['udate'])."\n",
  "&nbsp;<span class=titulo1> - Adjuntos :</span>&nbsp;&nbsp;&nbsp;"
  ;
	
	/*/Visualiza Inline Parts-----------------------------------------------------------------------
	  if (isset($msg->msg[$mid]['in']['pid']) && count($msg->msg[$mid]['in']['pid']) > 0)
    {
    foreach ($msg->msg[$mid]['in']['pid'] as $i => $inid)
    {
    $fname = (isset($msg->msg[$mid]['in']['fname'][$i]))? $msg->msg[$mid]['in']['fname'][$i] : "No Disponible";
    echo "<a href='attachement.php?mid=$mid&amp;pid=".$msg->msg[$mid]['in']['pid'][$i]."' target='_blank'><img src='../img/ath1.jpg' width=18 height=18 alt='".$fname."' title='".$fname."'></a><br />\n";
    }
    }
		*/
  // Visualiza attachments------------------------------------------------------------------------

  if (isset($msg->msg[$mid]['at']['pid']) && count($msg->msg[$mid]['at']['pid']) > 0)
    {
    foreach ($msg->msg[$mid]['at']['pid'] as $i => $aid)
    {
    $fname = (isset($msg->msg[$mid]['at']['fname'][$i]))? $msg->msg[$mid]['at']['fname'][$i] : "No Disponible";
    echo "<a href='attachement.php?mid={$mid}&amp;pid=".$msg->msg[$mid]['at']['pid'][$i]."' target='_blank' border=0><img src='../img/ath6.gif' width=12 height=12 alt='".$fname."' title='".$fname."' border=0></a>\n";
    }
    }
		else
		echo "";
	echo "<span class=titulo1> - Accion :</span><a href='../radicacion/chequear.php?".session_name()."=".session_id."&ent=2&eMailMid={$mid}&eMailAmp&eMailPid=".$msg->msg[$mid]['at']['pid'][$i]."&fileeMailAtach=".$fname."&tipoMedio=eMail' target='formulario'>Radicar</a>",	
       "\n";
   echo "<br>&nbsp;<span class=titulo1> - EmailRemitente :</span>&nbsp;&nbsp;&nbsp; ".$eMailRemitente;
   /*
  // In-line Parts no borrar

  if (isset($msg->msg[$mid]['in']['pid']) && count($msg->msg[$mid]['in']['pid']) > 0)
    {
    foreach ($msg->msg[$mid]['in']['pid'] as $i => $inid)
    {
    $fname = (isset($msg->msg[$mid]['in']['fname'][$i]))? $msg->msg[$mid]['in']['fname'][$i] : NULL;
    echo " Inline part: <a href='attachement.php?mid={$mid}&amp;pid=".$msg->msg[$mid]['in']['pid'][$i]."' target='_blank'>".$fname." ".$msg->msg[$mid]['in']['ftype'][$i]." ".$msg->convertBytes($msg->msg[$mid]['in']['fsize'][$i])."</a><br />\n";
    }
    }

  // Attachments no borrar

  if (isset($msg->msg[$mid]['at']['pid']) && count($msg->msg[$mid]['at']['pid']) > 0)
    {
    foreach ($msg->msg[$mid]['at']['pid'] as $i => $aid)
    {
    $fname = (isset($msg->msg[$mid]['at']['fname'][$i]))? $msg->msg[$mid]['at']['fname'][$i] : NULL;
    echo " Attachment: <a href='attachement.php?mid={$mid}&amp;pid=".$msg->msg[$mid]['at']['pid'][$i]."' target='_blank'>".$fname." ".$msg->msg[$mid]['at']['ftype'][$i]." ".$msg->convertBytes($msg->msg[$mid]['at']['fsize'][$i])."</a><br />\n";
    }
    }*/
		if($stl==1)
	  $stl=2;
		else
		$stl=1;
}
}
else
{
echo "<font-size: 30pt; text-align: center; padding: 50px 0;'>No hay Mensajes</td></tr>";
}
//echo"<div id='quota' align='center'>mailbox:".$msg->mailboxInfo['user']."<br/>";
if ($quota = $msg->getQuota())
{
echo " Quota: {$quota['STORAGE']['usage']} usedos de un total de{$quota['STORAGE']['limit']}\n";
}
//print_r($msg);
$msg->close();
?>
</div>

<div align="center" >
<p>" &copy; BT, .<br /></p>
</div>
</body>
</html>