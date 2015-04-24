<?php

include 'HTML/AJAX/Server.php';
include 'support/xml.class.php';

$server = new HTML_AJAX_Server();
// register an instance of the class were registering
$xml =& new TestXml();
$server->registerClass($xml);
$server->setSerializer('XML');
$server->handleRequest();
?>
