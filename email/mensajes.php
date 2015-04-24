<?php
 	 require_once '../pear/Mail_IMAPv2-0.2.0/IMAPv2.php';
	 $connection = 'imap://djinete:djinete@imap.admin.gov.co:143/INBOX#notls';
	 $msg =& new Mail_IMAPv2();

	 if (!$msg->connect($connection)) {
		  echo $msg->alerts();
		  echo $msg->errors();
		  echo "<span style='font-weight: bold;'>Error:</span> Unable to build a connection.";
 	 }
 	 $msgcount = $msg->messageCount();
 	 
 	 print("Se tienen $msgcount mensajes en {$msg->mailboxInfo['folder']}<br>");
 	 print("Se tienen {$msg->mailboxInfo['Unread']} mensajes sin leer<br><hr>");
 	 
 	 //print_r($msg->mailboxInfo);
 	 
 	 if($msgcount){
 	 	for($msgId=1;$msgId<=$msgcount;$msgId++){
 	 		
 	 			$msg->getHeaders($msgId);
	 	 		foreach($msg->header[$msgId] as $msgKey=>$msgValue){
	 	 			print("$msgKey -> $msgValue <br>");
	 	 		}
	 	 		
	 	 		$msg->getParts($msgId);
	 	 		
	 	 		print("<a href='guardarAttachement?mid={$msgId}&amp;pid={$msg->msg[$msgId]['pid']}'>Ver correo</a><br>");
	 	 		
				 if (isset($msg->msg[$msgId]['in']['pid']) && count($msg->msg[$msgId]['in']['pid']) > 0){
				  	foreach ($msg->msg[$msgId]['in']['pid'] as $i => $inid){
					  $fname = (isset($msg->msg[$msgId]['in']['fname'][$i]))? $msg->msg[$msgId]['in']['fname'][$i] : NULL;
					  print("<a href='guardarAttachement.php?mid={$msgId}&amp;pid=".$msg->msg[$msgId]['in']['pid'][$i]."'>Ver Inline</a><br/>\n");
				  	}
				  }
				 if (isset($msg->msg[$msgId]['at']['pid']) && count($msg->msg[$msgId]['at']['pid']) > 0){
						  foreach ($msg->msg[$msgId]['at']['pid'] as $i => $aid){
							  $fname = (isset($msg->msg[$msgId]['at']['fname'][$i]))? $msg->msg[$msgId]['at']['fname'][$i] : NULL;
							  print("NOMBRE ATTACHMENT : ".$fname."<br>");
							  print("TIPO DE ARCHIVO: ".$msg->msg[$msgId]['at']['ftype'][$i]."<br>");
							  print("TAMA&ntilde;O : ".$msg->msg[$msgId]['at']['fsize'][$i]."<br>");
							  print("<a href='guardarAttachement.php?mid={$msgId}&amp;pid=".$msg->msg[$msgId]['at']['pid'][$i]."'>Ver attachement</a><br/>\n");
						  }
				 }
	 	 		print("<hr>");
 	 	}
 	 	$msg->close();
 	 }
?>
