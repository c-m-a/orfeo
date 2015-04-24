<?php
define('IN_CB',true);
include('header.php');

$keys = array('0','1','2','3','4','5','6','7','8','9');

$n = $table->numRows();
$table->insertRows($n, 4);
$table->addRowAttribute($n,'class','table_title');
$table->addCellAttribute($n,0,'align','center');
$table->addCellAttribute($n,0,'colspan','2');
$table->setText($n,0,'<font color="#ffffff"><b>Specifics Configs</b></font>');
$table->setText($n+1,0,'<label for="isbn">ISBN</label>');
$text2display = '<input type="checkbox" name="a1" id="isbn" value="1"';
if($a1==1)
	$text2display .= ' checked="checked"';
$text2display .= ' /> (Don\'t put dash (-))';
$table->setText($n+1,1,$text2display);
$table->setText($n+2,0,'Keys');
$text2display = '';
$c = count($keys);
for($i=0;$i<$c;$i++)
	$text2display .= '<input type="button" value="'.$keys[$i].'" style="width:25px" onclick="newkey(this.form,\''.$keys[$i].'\')" /> ';
$table->setText($n+2,1,$text2display);
$table->setText($n+3,0,'Explanation');
$table->setText($n+3,1,'<ul style="margin: 0px; padding-left: 25px;"><li>EAN means Internal Article Numbering.</li><li>It is an extension of UPC-A to include the country information.</li><li>Used with consumer products internationally.</li><li>Composed by 2 number system, 5 manufacturer code, 5 product code and 1 check digit.</li><li>You can also provide a ISBN and the code will be converted to EAN-13.</li></ul>');
$table->draw();

echo '</form>';

include('footer.php');
?>