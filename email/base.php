<?php
 require_once 'pear/Mail/IMAPv2.php';
 $connection = 'imap://mhaposai:mhaposaI321@127.0.0.1:143/INBOX#notls';
 
//Inicio de la transaccion de correo
 if (!isset($_GET['dump_mid'])) 
{
  $msg =& new Mail_IMAPv2();
 } 
 else 
 {
// LLamado a bebug.
   include 'pear/Mail/IMAPv2/Debug/Debug.php';
   $msg =& new Mail_IMAP_Debug($connection);
   if ($msg->error->hasErrors()) {
   $msg->dump($msg->error->getErrors(TRUE));
  }
}

 /*------------------------Funcion Suprime caracteres extraños--------------------------*/
 function sup_tilde($str)
{
 $stdchars= array(" at ","a","e","i","o","u","n","A","E","I","O","U","N"," "," ");
 $tildechars= array("@","=E1","=E9","=ED","=F3","=FA","=F1","=C1","=C9","=CD","=D3","=DA","=D1","=?iso-8859-1?Q?","?=");
 return str_replace($tildechars,$stdchars, $str);
}
/*---------------------------------------------------------------------------------------*/


/*------------- Abre buzon y conexion y cuenta cuantos mensajes existen------------------*/
if (!$msg->connect($connection))
{ 
echo $msg->alerts();
echo $msg->errors();
echo "<span style='font-weight: bold;'>Error:</span> NO se pudo establecer coneccion con el Servidor.";
}
$msgcount = $msg->messageCount();
/*----------------------------------------------------------------------------------------*/
?>

<html>
<head>
<title> Entradas Pendientes </title>
<link rel='stylesheet' type='text/css' href='IMAP.css' media='all' />
</head>
<body>
<div id='header'>
<h1>
Buzon :: Mail 
</h1>
</div>
<div id='inboxbody'>
<div id='msgcount'>

<?php
echo " ". $msg->mailboxInfo['folder'].":(".$msgcount.") messages total.<br>.mailbox:".$msg->mailboxInfo['user'];
?>

</div>
<table class='msg' border=1>
<thead>
<tr>
<th>
Asunto
</th>
<th>
Remitente
</th>
<th>
Fecha
</th>
<th>
Radicar
</th>
</tr>
</thead>
<tbody>

<?php
if ($msgcount > 0)
{
 for ($mid = 1; $mid <= $msgcount; $mid++)
  {
  // Get the headers
  $msg->getHeaders($mid);
  $style = ((isset($msg->header[$mid]['Recent']) && $msg->header[$mid]['Recent'] == 'N') || (isset($msg->header[$mid]['Unseen']) && $msg->header[$mid]['Unseen'] == 'U'))? 'gray' : 'black';
  // Grab inline and attachment parts relevant to top level parts.
  // See the docs for the $msg property for more information:
  // http://www.smilingsouls.net/index.php?content=Mail_IMAP/msg
  $msg->getParts($mid);
  if (!isset($msg->header[$mid]['subject']) || empty($msg->header[$mid]['subject']))
  {
  $msg->header[$mid]['subject'] = "<span style='font-style: italic;'>no subject provided</a>";
  }
  //echo var_dump($msg->header[$mid]);
  
  echo " <tr>\n",
  " <td class='msgitem'><a href='message_viewer.php?mid={$mid}&amp;pid={$msg->msg[$mid]['pid']}' target='_blank' style='color: {$style};'>{$msg->header[$mid]['subject']}</a></td>\n",
  " <td class='msgitem'>\n",
  " ", (isset($msg->header[$mid]['from_personal'][0]) && !empty($msg->header[$mid]['from_personal'][0]))? '<span title="'.sup_tilde($msg->header[$mid]['from'][0]).'">'.sup_tilde($msg->header[$mid]['from_personal'][0])."</span>" : sup_tilde( $msg->header[$mid]['from'][0]), "\n",
  " </td>\n",
  " <td class='msgitem'>".date('D d M, Y h:i:s', $msg->header[$mid]['udate'])."</td>\n",
  " <td class='msgitem'>"."<a href='' >----------</a>"."</td>\n",
  " </tr>\n",
  " <tr>\n",
  " <td colspan='4' class='msgattach'>\n";

  // Show inline parts first

  if (isset($msg->msg[$mid]['in']['pid']) && count($msg->msg[$mid]['in']['pid']) > 0)
  {
  foreach ($msg->msg[$mid]['in']['pid'] as $i => $inid)
  {
  $fname = (isset($msg->msg[$mid]['in']['fname'][$i]))? $msg->msg[$mid]['in']['fname'][$i] : NULL;
  echo " Inline part: <a href='message_viewer.php?mid={$mid}&amp;pid=".$msg->msg[$mid]['in']['pid'][$i]."' target='_blank'>".$fname." ".$msg->msg[$mid]['in']['ftype'][$i]." ".$msg->convertBytes($msg->msg[$mid]['in']['fsize'][$i])."</a><br />\n";
  }
  }

  // Now the attachments

  if (isset($msg->msg[$mid]['at']['pid']) && count($msg->msg[$mid]['at']['pid']) > 0)
  {
  foreach ($msg->msg[$mid]['at']['pid'] as $i => $aid)
  {
  $fname = (isset($msg->msg[$mid]['at']['fname'][$i]))? $msg->msg[$mid]['at']['fname'][$i] : NULL;
  echo " Attachment: <a href='guardarAttachement.php?mid={$mid}&amp;pid=".$msg->msg[$mid]['at']['pid'][$i]."' target='_blank'>".$fname." ".$msg->msg[$mid]['at']['ftype'][$i]." ".$msg->convertBytes($msg->msg[$mid]['at']['fsize'][$i])."</a><br />\n";
  }
  }
  echo " </td>\n",
  "</tr>\n";
// Clean up left over variables
// $msg->unsetParts($mid);
// $msg->unsetHeaders($mid);
}
}
else
{
echo " <tr>\n".
" <td colspan='3' style='font-size: 30pt; text-align: center; padding: 50px 0;'>No Messages</td>".
" </tr>\n";
}
echo " </tbody>\n".
" </table>\n".
" <div id='quota'>\n".
" mailbox: {$msg->mailboxInfo['user']}<br />\n";
// getQuota doesn't work for some servers
if ($quota = $msg->getQuota())
{
echo " Quota: {$quota['STORAGE']['usage']} used of {$quota['STORAGE']['limit']} total\n";
}
echo " </div>\n".
" </div>\n".
" <div id='footer'>\n".
" <p>\n".
" &copy; Copyleft 2008 Burgos-Triana, .<br />\n".
" </p>\n".
" </div>\n".
" </body>\n".
" </html>";
// Close the stream
$msg->close();
// View errors gathered by PEAR_ErrorStack
// Uncommment to see more errors.
// if ($msg->error->hasErrors()) {
// echo "<pre style='display: block; white-space: pre;'>\n";
// var_dump($msg->error->getErrors());
// echo "</pre>\n";
// }
?>


 
