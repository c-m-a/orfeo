<?php
define('IN_CB',true);
include('header.php');

$keysA_value = array(' ','!',34,'#','$','%','&amp;',39,'(',')','*','+',',','-','.','/','0','1','2','3','4','5','6','7','8','9',':',';','<','=','>','?','@','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','[',92,']','^','_',chr(128),chr(129));
$keysA_text = array(' ','!','&quot;','#','$','%','&amp;','\\\'','(',')','*','+',',','-','.','/','0','1','2','3','4','5','6','7','8','9',':',';','<','=','>','?','@','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','[','\\\\',']','^','_','Code C','Code B');
$keysB_value = array(' ','!',34,'#','$','%','&amp;',39,'(',')','*','+',',','-','.','/','0','1','2','3','4','5','6','7','8','9',':',';','<','=','>','?','@','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','[',92,']','^','_','`','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','{','|','}','~',chr(128),chr(130));
$keysB_text = array(' ','!','&quot;','#','$','%','&amp;','\\\'','(',')','*','+',',','-','.','/','0','1','2','3','4','5','6','7','8','9',':',';','<','=','>','?','@','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','[','\\\\',']','^','_','`','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','{','|','}','~','Code C','Code A');
$keysC_value = $keysC_text = array();
for($i=0;$i<=99;$i++)
	$keysC_value[] = $keysC_text[] = sprintf('%02d',$i);
$keysC_value[] = chr(129);	$keysC_text[] = 'Code B';
$keysC_value[] = chr(130);	$keysC_text[] = 'Code A';

$n = $table->numRows();
$table->insertRows($n, 4);
$table->addRowAttribute($n,'class','table_title');
$table->addCellAttribute($n,0,'align','center');
$table->addCellAttribute($n,0,'colspan','2');
$table->setText($n,0,'<font color="#ffffff"><b>Specifics Configs</b></font>');
$table->setText($n+1,0,'Starts With');
$text2display = '<select size="1" name="a1" onchange="change_start(this.form,this.options[this.selectedIndex].value)"><option value="A"';
if($a1=='A')
	$text2display .= ' selected="selected"';
$text2display .= '>Code 128-A</option><option value="B"';
if($a1=='B')
	$text2display .= ' selected="selected"';
$text2display .= '>Code 128-B</option><option value="C"';
if($a1=='C')
	$text2display .= ' selected="selected"';
$text2display .= '>Code 128-C</option></select>';
$table->setText($n+1,1,$text2display);
$table->setText($n+2,0,'Keys');
$table->setText($n+2,1,'<span id="display_key"></span>');
$table->setText($n+3,0,'Explanation');
$table->setText($n+3,1,'<ul style="margin: 0px; padding-left: 25px;"><li>Code 128 is a high-density alphanumeric symbology.</li><li>Used extensively worldwide.</li><li>Code 128 is designed to encode 128 full ASCII characters.</li><li>The symbology inclues a checksum digit.</li></ul>');
$table->draw();

echo '</form>';

?>

<script language="JavaScript" type="text/javascript">
<!-- Script Starting
var keys = new Array();
keys['A'] = <?php
$c = count($keysA_value);
for($i=0;$i<$c;$i++) {
	if(gettype($keysA_value[$i])=='integer')
		echo '\'<input type="button" value="'.$keysA_text[$i].'" style="width:50px" onclick="newkeyCode(this.form,\\\''.$keysA_value[$i].'\\\')';
	else
		echo '\'<input type="button" value="'.$keysA_text[$i].'" style="width:50px" onclick="newkey(this.form,\\\''.$keysA_value[$i].'\\\')';
	if($i==64)echo ';change_keys(\\\'C\\\')';
	if($i==65)echo ';change_keys(\\\'B\\\')';
	echo '" /> \'+'."\n";
}
?>'';

keys['B'] = <?php
$c = count($keysB_value);
for($i=0;$i<$c;$i++) {
	if(gettype($keysB_value[$i])=='integer')
		echo '\'<input type="button" value="'.$keysB_text[$i].'" style="width:50px" onclick="newkeyCode(this.form,\\\''.$keysB_value[$i].'\\\')';
	else
		echo '\'<input type="button" value="'.$keysB_text[$i].'" style="width:50px" onclick="newkey(this.form,\\\''.$keysB_value[$i].'\\\')';
	if($i==95)echo ';change_keys(\\\'C\\\')';
	if($i==96)echo ';change_keys(\\\'A\\\')';
	echo '" /> \'+'."\n";
}
?>'';
keys['C'] = <?php
$c = count($keysC_value);
for($i=0;$i<$c;$i++){
	echo '\'<input type="button" value="'.$keysC_text[$i].'" style="width:50px" onclick="newkey(this.form,\\\''.$keysC_value[$i].'\\\')';
	if($i==100)echo ';change_keys(\\\'B\\\')';
	if($i==101)echo ';change_keys(\\\'A\\\')';
	echo '" /> \'+'."\n";
}
?>'';

function change_keys(to_key){
	var IE;

	IE = (document.all) ? true : false;
	if(IE){
		document.all['display_key'].innerHTML = keys[to_key];
	}
	else{
		document.getElementById('display_key').innerHTML = keys[to_key];
	}
}

function change_start(form,to_key){
	form.text2display.value = '';
	change_keys(to_key);
}
<?php
$starting_code = $a1;
if($starting_code != 'C' && $starting_code != 'B' && $starting_code != 'A')
	$starting_code = 'A';
?>
change_keys('<?php echo $starting_code; ?>');
//-->
</script>

<?php
include('footer.php');
?>