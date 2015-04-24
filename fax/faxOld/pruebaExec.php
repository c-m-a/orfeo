<?php		
exec("ssh -l orfeo 172.16.1.168 /usr/bin/faxstat -r ",$exec_output,$exec_return);
foreach($exec_output as $a)
{
	print("<pre>".$a."</pre>");
}
?>