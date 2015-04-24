<?php
	if(isset($var_filename))
	{
		if(!file_exists("../bodega/fax/$var_filename"."pdf"))
		{
			exec("rsh -l nobody 172.16.1.168 sudo /usr/bin/convert  /var/spool/hylafax/recvq/$var_filename"."tif /var/spool/hylafax/recvq/$var_filename"."pdf",$exec_output,$exec_return);	
		}
		header("Content-type: application/pdf");
		readfile("../bodega/fax/$var_filename"."pdf");
	}
	else
	{
		print("<center><img src=\"warning.png\"><h1>No hay Imagen Cargada</h1></center>");
	}
?>
