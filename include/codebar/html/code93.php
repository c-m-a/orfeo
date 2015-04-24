<?php
define('IN_CB',true);
include('header.php');

$keys = array('0','1','2','3','4','5','6','7','8','9','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','-','.',' ','$','/','+','%');

$n = $table->numRows();
$table->insertRows($n, 3);
$table->addRowAttribute($n,'class','table_title');
$table->addCellAttribute($n,0,'align','center');
$table->addCellAttribute($n,0,'colspan','2');
$table->setText($n,0,'<font color="#ffffff"><b>Specifics Configs</b></font>');
$table->setText($n+1,0,'Keys');
$text2display = '';
$c = count($keys);
for($i=0;$i<$c;$i++)
	$text2display .= '<input type="button" value="'.$keys[$i].'" style="width:25px" onclick="newkey(this.form,\''.$keys[$i].'\')" /> ';
$table->setText($n+1,1,$text2display);
$table->setText($n+2,0,'Explanation');
$table->setText($n+2,1,'<ul style="margin: 0px; padding-left: 25px;"><li>Known also as USS Code 93.</li><li>Code 93 was designed to provide a higher density and data security enhancement to Code39.</li><li>Used primarily by Canadian postal office to encode supplementary delivery information.</li><li>Similar to Code 39, Code 93 has the same 43 characters plus 5 special ones.</li><li>This symbology composed of 2 check digits ("C" and "K").</li></ul>');
$table->draw();

echo '</form>';

include('footer.php');
?>