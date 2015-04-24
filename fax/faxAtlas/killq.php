<?php
/*
 * $Id: killq.php,v 1.3 2002/01/30 08:04:00 nisapus Exp $
 *
 * Copyright (C) 2002 Supasin Sae-heng <nisapus@yahoo.com>
 *
 * This file is subject to the terms and conditions of the GNU General Public
 * License.  See the file "COPYING" for more details.
 */

require("include/pre.php");

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
 <title>Cancelar resultado</title>
<!-- <meta http-equiv="refresh" content="300; url=logout.php"> -->
</head>
<body bgcolor="#ffffff" marginheight="2" marginwidth="2">


<font size="+1"><b>&nbsp; Resultado de cancelaci&oacute;n de FAX</b></font>

<?php
	
$file_name = $DIR_SENDQ."/q".$var_jid;
$salida = exec("sudo $PROG_CAT $file_name | grep !postscript | awk -F : '{ print $4 }'",$output);
foreach($output as $salida)
{
	exec("sudo rm -rf ".$PROG_DIR."/".$salida,$output,$return);
}
	//exec("sudo rm  $DIR_DOCQ/doc$var_jid.* 2> /tmp/log",$out);
	exec("sudo rm -rf ".$file_name,$output,$return);
	if(!$return)
	{
		 print "<br>&nbsp;<b>Resultado OK</b>: El fax ha  enviar \"<b>$file_name</b>\" ha sido borrado.";
		
	}
	else
	{
		 print "<br>&nbsp;<b>ERROR</b>: El fax ha enviar \"<b>$file_name</b>\" no ha sido borrado.";
	}
	
?>
</body>
</html>
