<?php
 
 /**
 * This example provides a basic demonstration of how Mail_IMAP can be used to
 * view multipart messages. See {@link connect} for extended documentation on
 * how to set the connection URI.
 *
 * This example is part of the message viewer. Here the headers are retrieved for
 * a message part and the message part itself is displayed using an inline frame.
 *
 *
 * @author Richard York <rich_y@php.net>
 * @copyright (c) Copyright 2004, Richard York, All Rights Reserved.
 * @package Mail_IMAP
 * @subpackage examples
 *
 */
 
 // Use an existing imap resource stream, or provide a URI abstraction.
 // Example of URI:
 // pop3://user:pass@mail.example.com:110/INBOX#notls
 //
 // If you are unsure of the URI syntax to use here,
 // use the Mail_IMAP_connection_wizard to find the right URI.
 // Or see docs for Mail_IMAP::connect
 //
 // The connection URI must also be set in:
 // IMAP.inbox.php.
 // IMAP.message_viewer.php
 // IMAP.part_viewer.php
 
 require_once '../pear/Mail_IMAPv2-0.2.0/IMAPv2.php';
 
 //$connection = 'imap://user:pass@mail.example.net:143/INBOX';
 $connection = 'imap://djinete:djinete@imap.admin.gov.co:143/INBOX#notls';
 
 if (!isset($_GET['dump_mid'])) {
  $msg =& new Mail_IMAPv2();
 } else {
  // Call on debuging automatically.
  include 'Mail/IMAPv2/Debug/Debug.php';
  $msg =& new Mail_IMAP_Debug($connection);
  if ($msg->error->hasErrors()) {
  $msg->dump($msg->error->getErrors(TRUE));
  }
 }
 
 // Open up a mail connection
 if (!$msg->connect($connection)) {
  echo $msg->alerts();
  echo $msg->errors();
  echo "<span style='font-weight: bold;'>Error:</span> Unable to build a connection.";
 }
 
 // Get parts and headers
 $mid = $_GET['mid'];
 $pid = $_GET['pid'];
 
 $msg->getParts($mid, $pid);
 $msg->getHeaders($mid, $pid);
 
 function Mail_IMAP_do_address_line(&$msg, &$mid, $line)
 {
  $rtn = (string) '';
 
  if (!empty($msg->header[$mid][$line])) {
  foreach ($msg->header[$mid][$line] as $i => $address) {
  if (isset($msg->header[$mid][$line.'_personal'][$i]) && !empty($msg->header[$mid][$line.'_personal'][$i])) {
  	$rtn .= "<span title='".str_replace('@', ' at ', $msg->header[$mid][$line][$i])."'>".$msg->header[$mid][$line.'_personal'][$i]."</span> ;\n";
  } else {
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
 
 echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
  <html>
  <head>
  <title> Mail_IMAP Inbox </title>
  <link rel='stylesheet' type='text/css' href='IMAP.css' media='all' />
  </head>
  <body>
  <table id='headerviewer'>
  <tbody>
  <tr>
  <td class='header'> Subject: </td>
  <td> {$msg->header[$mid]['subject']} </td>
  </tr>
  <tr>
  <td class='header'> To: </td>
  <td>\n".Mail_IMAP_do_address_line($msg, $mid, 'to')."
  </td>
  </tr>
  <tr>
  <td class='header'> Cc: </td>
  <td>\n".Mail_IMAP_do_address_line($msg, $mid, 'cc')."
  </td>
  </tr>
  <tr>
  <td class='header'> From: </td>
  <td>\n".Mail_IMAP_do_address_line($msg, $mid, 'from')."
  </td>
  </tr>
  <tr>
  <td class='header'> Received: </td>
  <td>".date('D d M, Y h:i:s', $msg->header[$mid]['udate'])."</td>
  </tr>
  <tr>
  <td class='header'> Inline Parts: </td>
  <td>".Mail_IMAP_do_parts($msg, $mid, 'in')."</td>
  </tr>
  <tr>
  <td class='header'> Attachments: </td>
  <td>".Mail_IMAP_do_parts($msg, $mid, 'at')."</td>
  </tr>
  </tbody>
  </table>
  <iframe src='IMAP.part_viewer.php?mid={$mid}&amp;pid={$pid}' name='part' style='width: 100%; height: 400px;'></iframe>
  </body>
  </html>";
 ?>
