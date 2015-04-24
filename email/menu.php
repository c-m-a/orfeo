<?php
session_start();
error_reporting(7);
$ruta_raiz = "..";
$encabezado = session_name()."=".session_id()."&krd=$krd&fechah=$fechah";
include "connectIMAP.php";  
?>
<html>
<body>
<?
if($msg->getMailboxes($host))
{
    $listMailBoxes = $msg->getMailboxes($host);
    foreach($listMailBoxes as $name)
	{
?>
-<font size=1>
    <a href='emailinbox.php?inboxEmail=<?=$name?>' target='formulario'><?=$name?></a>
 </font><br>
<?php
    }
}
else
{
?>
<br>
<font size=1>
    <a href='login_email.php?inboxEmail=<?=$name?>' target='formulario'>Inbox</a>
    <br><br><br>
	<a href='menu.php?inboxEmail=<?=$name?>'>Recargar Carpetas</a>
    </font>
<br>
<?php
}
?>
</body>
</html>