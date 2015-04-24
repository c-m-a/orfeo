<?php
 	session_start();	
	$nomfile="orfeoReport-".date("Y-m-d").".doc"; 	
	header("Content-type: application/msword; ");
	header("Content-Disposition: filename=\"$nomfile\";");
	include("adodb-basedoc.inc.php");
?>
