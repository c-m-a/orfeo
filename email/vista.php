<?php
 require_once '../pear/Mail/IMAPv2.php';
// $connection = 'imap://djinete:djinete@imap.admin.gov.co:143/INBOX#notls';
 $connection = 'imap://mhaposai:mhaposaI321@200.31.196.117:143/INBOX#notls';
//Inicio de la transaccion de correo
 if (!isset($_GET['dump_mid'])) 
{
  $msg =& new Mail_IMAPv2();
 } 
 else 
 {
// LLamado a bebug.
   include '../pear/Mail/IMAPv2/Debug/Debug.php';
   $msg =& new Mail_IMAP_Debug($connection);
   if ($msg->error->hasErrors()) 
	 {
   $msg->dump($msg->error->getErrors(TRUE));
   }
  }
/*------------- Abre buzon y conexion y cuenta cuantos mensajes existen------------------*/

if (!$msg->connect($connection))
{ 
echo $msg->alerts();
echo $msg->errors();
echo "<span style='font-weight: bold;'>Error:</span> No se pudo establecer coneccion con el Servidor.";
}
/*----------------------------------------------------------------------------------------*/
 
 // Obtenemos las  cabeceras
 $mid = $_GET['mid'];
 $pid = $_GET['pid'];
 
 $msg->getParts($mid, $pid);
 $msg->getHeaders($mid, $pid);
 
 function Mail_IMAP_do_address_line(&$msg, &$mid, $line)
 {
  $rtn = (string) '';
  if (!empty($msg->header[$mid][$line])) 
	  {
     foreach ($msg->header[$mid][$line] as $i => $address) 
		 {
       if (isset($msg->header[$mid][$line.'_personal'][$i]) && !empty($msg->header[$mid][$line.'_personal'][$i])) 
		   {
  	   $rtn .= "<span title='".str_replace('@', ' at ', $msg->header[$mid][$line][$i])."'>".$msg->header[$mid][$line.'_personal'][$i]."</span> ;\n";
       } 
		   else 
		   {
  	   $rtn .= str_replace('@', ' at ', $msg->header[$mid][$line][$i])."; \n";
       }
     }
    }
  return $rtn;
 }
 
 function Mail_IMAP_do_parts(&$msg, &$mid, $disp)
 {
  $rtn = (string) '';
  if (isset($msg->msg[$mid][$disp]['pid']) && count($msg->msg[$mid][$disp]['pid']) > 0)
     {
     foreach ($msg->msg[$mid][$disp]['pid'] as $i => $inid)
       {
       $rtn .= "<a href='{$_SERVER['PHP_SELF']}?mid={$mid}&amp;pid=".$msg->msg[$mid][$disp]['pid'][$i]."' target='top'>".$msg->msg[$mid][$disp]['fname'][$i]." ".$msg->msg[$mid][$disp]['ftype'][$i]." ".$msg->convertBytes($msg->msg[$mid][$disp]['fsize'][$i])."</a><br />\n";
       }
     }
  return $rtn;
 }
 ?>
  
  <html>
  <head>
  <title> ENTRADA RADICACION </title>
  <link rel='stylesheet' type='text/css' href='IMAP.css' media='all' />
  </head>
  <body>
  <table id='headerviewer'>
  <tbody>
  <tr>
  <td class='header'> Subject: </td>
  <td>
	<?php
	echo $msg->header[$mid]['subject'];
	?>
	</td>
  </tr>
  <tr>
  <td class='header'> To: </td>
  <td>
	<?php
	echo Mail_IMAP_do_address_line($msg, $mid, 'to');
	?>
  </td>
  </tr>
  <tr>
  <td class='header'> Cc: </td>
  <td>
	<?php
	echo Mail_IMAP_do_address_line($msg, $mid, 'cc');
  ?>
	</td>
  </tr>
  <tr>
  <td class='header'> From: </td>
  <td>
	<?php
	echo Mail_IMAP_do_address_line($msg, $mid, 'from');
  ?>
	</td>
  </tr>
  <tr>
  <td class='header'> Received: </td>
  <td>
	<?php
	echo date('D d M, Y h:i:s', $msg->header[$mid]['udate']);
	?>
	</td>
  </tr>
  <tr>
  <td class='header'> Inline Parts: </td>
  <td>
	<?php
	echo Mail_IMAP_do_parts($msg, $mid, 'in');
	?>
	</td>
  </tr>
  <tr>
  <td class='header'> Attachments: </td>
  <td>
	<?php
	echo Mail_IMAP_do_parts($msg, $mid, 'at');
	?>
	</td>
  </tr>
  </tbody>
  </table>
  <iframe src='part_viewer.php?mid=
	<?php echo $mid; ?>
	&pid=
	<?php  echo $pid; ?>
	' name='part' style='width: 100%; height: 400px;'></iframe>
  </body>
  </html>
