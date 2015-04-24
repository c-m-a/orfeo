<?php
if(!defined('IN_CB'))die('You are not allowed to access to this page.');

if(version_compare(phpversion(),'5.0.0','>=')!=1)
	exit('Sorry, but you have to run this script with PHP5... You currently have the version <b>'.phpversion().'</b>.');

$class_dir = '../class';

require('function.php');

echo '<?xml version="1.0" encoding="iso-8859-1"?>'."\n";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>Drawing Barcode</title>
<link type="text/CSS" rel="stylesheet" href="./style.css" />
<script language="JavaScript" type="text/javascript">
function newkey(form,variable){
	form.text2display.value += variable;
}
function newkeyCode(form,variable){
	form.text2display.value += String.fromCharCode(variable);
}
</script>
</head>
<body bgcolor="#ffffff">

<?php
// FileName & Extension
$system_temp_array = explode('/',$_SERVER['PHP_SELF']);
$system_temp_array2 = explode('.',$system_temp_array[count($system_temp_array)-1]);
$filename = $system_temp_array2[0];

$default_value = array();
$default_value['output'] = 1;
$default_value['thickness'] = 30;
$default_value['res'] = 1;
$default_value['font'] = 2;
$default_value['text2display'] = '';
$default_value['a1'] = '';
$default_value['a2'] = '';

$output = intval((isset($_POST['output']))?$_POST['output']:$default_value['output']);
$thickness = intval((isset($_POST['thickness']))?$_POST['thickness']:$default_value['thickness']);
$res = intval((isset($_POST['res']))?$_POST['res']:$default_value['res']);
$font = intval((isset($_POST['font']))?$_POST['font']:$default_value['font']);
$text2display = (isset($_POST['text2display']))?$_POST['text2display']:$default_value['text2display'];
$a1 = (isset($_POST['a1']))?$_POST['a1']:$default_value['a1'];
$a2 = (isset($_POST['a2']))?$_POST['a2']:$default_value['a2'];
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" name="barcode_drawer" method="post">
<?php
$table = new LSTable(8,2,'500',$null);
$table->setTitle('Configs for ' . $filename);
$table->addRowAttribute(0,'class','table_title');
$table->addCellAttribute(0,0,'colspan','2');
$table->addCellAttribute(0,0,'align','center');
$table->setText(0,0,'<font color="#ffffff"><b>General Configs</b></font>');
$table->addCellAttribute(1,0,'width','100');
$table->setText(1,0,'Type');
$table->setText(1,1,display_select($filename));
$table->setText(2,0,'Output');
$table->setText(2,1,display_output($output));
$table->setText(3,0,'Thickness');
$table->setText(3,1,display_thickness($thickness));
$table->setText(4,0,'Resolution');
$table->setText(4,1,display_res($res));
$table->setText(5,0,'Font Size');
$table->setText(5,1,display_font($font));
$table->setText(6,0,'Text');
$table->setText(6,1,display_text($text2display));
$table->addCellAttribute(7,0,'align','center');
$table->addCellAttribute(7,0,'colspan','2');
$table->setText(7,0,'<input type="submit" value="Generate" />');

if(!empty($text2display)){
	$table->insertRows(8,1);
	$table->addCellAttribute(8,0,'align','center');
	$table->addCellAttribute(8,0,'colspan','2');
	$table->addRowAttribute(8,'style','background-color: #ffffff');
	$table->setText(8,0,'<img src="image.php?code='.$filename.'&o='.$output.'&t='.$thickness.'&r='.$res.'&text='.urlencode($text2display).'&f='.$font.'&a1='.$a1.'&a2='.$a2.'" alt="Error? Can\'t display image!" />');
}
?>