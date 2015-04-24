<?php
if(!defined('IN_CB'))die('You are not allowed to access to this page.');

/**
 * msi.php
 *--------------------------------------------------------------------
 *
 * Sub-Class - MSI Plessey
 *
 *--------------------------------------------------------------------
 * Revision History
 * V1.00	17 jun	2004	Jean-Sebastien Goupil
 *--------------------------------------------------------------------
 * Copyright (C) Jean-Sebastien Goupil
 * http://other.lookstrike.com/barcode/
 */
class msi extends BarCode {
	protected $keys = array(), $code = array();
	protected $text;
	protected $textfont;
	private $checksum;

	/**
	 * Constructor
	 *
	 * @param int $maxHeight
	 * @param FColor $color1
	 * @param FColor $color2
	 * @param int $res
	 * @param string $text
	 * @param int $textfont
	 * @param int $checksum
	 */
	public function __construct($maxHeight,FColor $color1,FColor $color2,$res,$text,$textfont,$checksum=0) {
		BarCode::__construct($maxHeight,$color1,$color2,$res);
		$this->keys = array('0','1','2','3','4','5','6','7','8','9');
		$this->code = array(
			'01010101',	/* 0 */
			'01010110',	/* 1 */
			'01011001',	/* 2 */
			'01011010',	/* 3 */
			'01100101',	/* 4 */
			'01100110',	/* 5 */
			'01101001',	/* 6 */
			'01101010',	/* 7 */
			'10010101',	/* 8 */
			'10010110'	/* 9 */
		);
		$this->setText($text);
		$this->textfont = $textfont;
		$this->checksum = $checksum;
	}

	/**
	 * Saves Text
	 *
	 * @param string $text
	 */
	public function setText($text) {
		$this->text = $text;
	}

	/**
	 * Draws the barcode
	 *
	 * @param ressource $im
	 */
	public function draw($im) {
		$error_stop = false;

		// Checking if all chars are allowed
		for($i=0;$i<strlen($this->text);$i++) {
			if(!is_int(array_search($this->text[$i],$this->keys))) {
				$this->DrawError($im,'Char \''.$this->text[$i].'\' not allowed.');
				$error_stop = true;
			}
		}
		if($error_stop == false) {
			// We calculate checksum first
			// Forming a new number
			// If the original number is even, we take all even position
			// If the original number is odd, we take all odd position
			// 123456 = 246
			// 12345 = 135
			// Multiply by 2
			// Add up all the digit in the result (270 : 2+7+0)
			// Add up other digit not used.
			// 10 - (? Modulo 10). If result = 10, change to 0
			$last_checksum = $this->checksum;
			$last_text = $this->text;
			$checksum = array();
			for($i=0;$i<$last_checksum;$i++){
				$new_text = '';
				$new_number = 0;
				if(strlen($last_text) % 2 == 0) // Even
					$starting = 1;
				else
					$starting = 0;
				for($j=$starting;$j<strlen($last_text);$j+=2)
					$new_text .= $last_text[$j];
				$new_text = strval(intval($new_text)*2);
				for($j=0;$j<strlen($new_text);$j++)
					$new_number += intval($new_text[$j]);
				for($j=($starting==0)?1:0;$j<strlen($last_text);$j+=2){
					$new_number += intval($last_text[$j]);
				}
				$new_number = 10 - $new_number % 10;
				$new_number = ($new_number == 10)?0:$new_number;
				$checksum[] = $new_number;
				$last_text .= $new_number;
			}
			// Starting Code
			$this->DrawChar($im,'10',1);
			// Chars
			for($i=0;$i<strlen($this->text);$i++)
				$this->DrawChar($im,$this->findCode($this->text[$i]),1);
			for($i=0;$i<count($checksum);$i++)
				$this->DrawChar($im,$this->findCode($checksum[$i]),1);
			// Ending Code
			$this->DrawChar($im,'010',1);
			$this->lastX = $this->positionX;
			$this->lastY = $this->maxHeight;
			$this->DrawText($im);
		}
	}
};
?>