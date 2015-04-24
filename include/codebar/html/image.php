<?php
if(isset($_GET['code']) && isset($_GET['t']) && isset($_GET['r']) && isset($_GET['text']) && isset($_GET['f']) && isset($_GET['o']) && isset($_GET['a1']) && isset($_GET['a2'])){
	define('IN_CB',true);
	require('../class/index.php');
	require('../class/FColor.php');
	require('../class/BarCode.php');
	require('../class/FDrawing.php');
	if(include('../class/'.$_GET['code'].'.barcode.php')){
		$color_black = new FColor(0,0,0);
		$color_white = new FColor(255,255,255);
		if(!empty($_GET['a2']))
			$code_generated = new $_GET['code']($_GET['t'],$color_black,$color_white,$_GET['r'],$_GET['text'],$_GET['f'],$_GET['a1'],$_GET['a2']);
		elseif(!empty($_GET['a1']))
			$code_generated = new $_GET['code']($_GET['t'],$color_black,$color_white,$_GET['r'],$_GET['text'],$_GET['f'],$_GET['a1']);
		else
			$code_generated = new $_GET['code']($_GET['t'],$color_black,$color_white,$_GET['r'],$_GET['text'],$_GET['f']);
		$drawing = new FDrawing(1024,1024,'',$color_white);
		$drawing->init();
		$drawing->add_barcode($code_generated);
		$drawing->draw_all();
		$im = $drawing->get_im();
		$im2 = imagecreate($code_generated->lastX,$code_generated->lastY);
		imagecopyresized($im2, $im, 0, 0, 0, 0, $code_generated->lastX, $code_generated->lastY, $code_generated->lastX, $code_generated->lastY);
		$drawing->set_im($im2);
		$drawing->finish($_GET['o']);
	}
	else{
		header('Content: image/png');
		readfile('error.png');
	}
}
else{
	header('Content: image/png');
	readfile('error.png');
}
?>