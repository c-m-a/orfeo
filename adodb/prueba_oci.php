<?php
include('adodb-errorpear.inc.php');
include('adodb.inc.php');
include('tohtml.inc.php');
error_reporting(7);
$c = NewADOConnection('oci8');
if($c->PConnect('atlas','fldoc','Fldoc','bdprueba'))
{
 echo "entro";
 $rs=$c->Execute('select * from usuario');
}else
{
$e = ADODB_Pear_Error();
	echo '<p>',$e->message,'</p>';
} #invalid table productsz');
if ($rs) rs2html($rs);
else {
	$e = ADODB_Pear_Error();
	echo '<p>',$e->message,'</p>';
}
?>