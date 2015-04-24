<?php
 	session_start();	
	$nomfile="orfeoReport-".date("Y-m-d").".xls"; 	
	header("Content-type: application/msexcel; ");
	header("Content-Disposition: filename=\"$nomfile\";");
	include("adodb-basedoc.inc.php");
?>
