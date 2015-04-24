<?php		
error_reporting(7);
exec("ssh -l orfeo 172.16.1.168 ls -l ",$exec_output,$exec_return);
foreach($exec_output as $a)
{
	print("<pre>".$a."</pre>");
}
?>