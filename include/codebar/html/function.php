<?php
if(!defined('IN_CB'))die('You are not allowed to access to this page.');

/**
 * Loads a class automatically.
 *
 * @param string $class_name
 */
function __autoload($class_name) {
	global $class_dir;
	require_once $class_dir.'/'.$class_name.'.php';
}

/**
 * Displays Select Code bar Box
 *
 * @param string $filename
 */
function display_select($filename){
	$table_value = array('codabar','code11','code39','code93','code128','ean8','ean13','i25','s25','MSI','upca','upce','upcext2','upcext5','postnet','othercode');
	$table_text = array('Codabar','Code 11','Code 39','Code 93','Code 128','EAN-8','EAN-13 / ISBN','Interleaved 2 of 5','Standard 2 of 5','MSI Plessey','UPC-A','UPC-E','UPC Extension 2 Digits','UPC Extension 5 Digits','PostNet','Other Barcode');
	$text2display = '';
	$text2display .= '<select name="barcode_type" size="1" onchange="location.href=barcode_type.options[barcode_type.selectedIndex].value + \'.php\'" style="width: 300px">';
	$c = count($table_value);
	for($i=0;$i<$c;$i++){
		$text2display .= '<option value="'.$table_value[$i].'"';
		if($table_value[$i]==$filename)
			$text2display .= ' selected="selected"';
		$text2display .= '>'.$table_text[$i].'</option>';
	}
	$text2display .= '</select>';
	return $text2display;
}

/**
 * Displays the output (PNG, JPEG)
 *
 * @param int $number
 */
function display_output($number){
	$table_value = array('1','2');
	$table_text = array('Portable Network Graphics (PNG)','Joint Photographic Experts Group (JPEG)');
	$text2display = '';
	$text2display .= '<select name="output" size="1" style="width:300px">';
	$c = count($table_value);
	for($i=0;$i<$c;$i++){
		$text2display .= '<option value="'.$table_value[$i].'"';
		if(intval($table_value[$i])==intval($number))
			$text2display .= ' selected="selected"';
		$text2display .= '>'.$table_text[$i].'</option>';
	}
	$text2display .= '</select>';
	return $text2display;
}

/**
 * Displays the thickness of the bars
 *
 * @param int $number
 */
function display_thickness($number){
	return '<input type="text" name="thickness" value="'.$number.'" size="5" />';
}

/**
 * Displays the resolution of the code
 *
 * @param int $number
 */
function display_res($number){
	$table = new LSTable(1,3,'100%',$null);
	$table->setTemplate('tpl_BLANK');
	for($i=1;$i<=3;$i++){
		$text2display = '';
		$text2display .= '<input type="radio" name="res" value="'.$i.'"';
		if($number==$i)
			$text2display .= ' checked="checked"';
		$text2display .= ' /> '.$i;
		$table->setText(0,$i-1,$text2display);
	}
	return $table;
}

/**
 * Displays the fontsize of the label
 *
 * @param int $number
 */
function display_font($number){
	$table = new LSTable(1,6,'100%',$null);
	$table->setTemplate('tpl_BLANK');
	$text2display = '';
	$text2display .= '<input type="radio" name="font" value="0"';
	if($number==0)
		$text2display .= ' checked="checked"';
	$text2display .= ' /> No';
	$table->setText(0,0,$text2display);
	for($i=1;$i<=5;$i++){
		$text2display = '';
		$text2display .= '<input type="radio" name="font" value="'.$i.'"';
		if($number==$i)
			$text2display .= ' checked="checked"';
		$text2display .= ' /> '.$i;
		$table->setText(0,$i,$text2display);
	}
	return $table;
}

/**
 * Displays the textbox
 *
 * @param string $text
 */
function display_text($text){
	return '<input type="text" name="text2display" value="'.$text.'" size="20" />';
}

/**
 * Returns the next class for a table line.
 *
 * @param int $restart If 1, then restart color to 1
 * @return string
 */
function next_color($restart=0){
	global $sys_conf;
	static $color=0;
	if($restart==1){$color = NULL;}
	if($color==1){$couleur='row2';$color=2;}
	else{$couleur='row1';$color=1;}
	return $couleur;
}
?>