<?php
if(!defined('IN_CB'))die('You are not allowed to access to this page.');

/**
 * upcext5.php
 *--------------------------------------------------------------------
 *
 * Sub-Class - UPC Supplemental Barcode 2 digits
 *
 * Working with UPC-A, UPC-E, EAN-13, EAN-8
 * This includes 5 digits (normaly for suggested retail price)
 * Must be placed next to UPC or EAN Code
 * If 90000 -> No suggested Retail Price
 * If 99991 -> Book Complimentary (normally free)
 * If 90001 to 98999 -> Internal Purpose of Publisher
 * If 99990 -> Used by the National Association of College Stores to mark used books
 * If 0xxxx -> Price Expressed in British Pounds (xx.xx)
 * If 5xxxx -> Price Expressed in U.S. dollars (US$xx.xx)
 *
 *--------------------------------------------------------------------
 * Revision History
 * V1.00	17 jun	2004	Jean-Sebastien Goupil
 *--------------------------------------------------------------------
 * Copyright (C) Jean-Sebastien Goupil
 * http://other.lookstrike.com/barcode/
 */
class upcext5 extends BarCode {
	protected $keys = array(), $code = array(), $codeParity = array();
	private $starting, $ending;
	protected $text;
	protected $textfont;

	/**
	 * Constructor
	 *
	 * @param int $maxHeight
	 * @param FColor $color1
	 * @param FColor $color2
	 * @param int $res
	 * @param string $text
	 * @param int $textfont
	 */
	public function __construct($maxHeight,FColor $color1,FColor $color2,$res,$text,$textfont) {
		BarCode::__construct($maxHeight,$color1,$color2,$res);
		$this->keys = array('0','1','2','3','4','5','6','7','8','9');
		$this->code = array(
			'2100',	/* 0 */
			'1110',	/* 1 */
			'1011',	/* 2 */
			'0300',	/* 3 */
			'0021',	/* 4 */
			'0120',	/* 5 */
			'0003',	/* 6 */
			'0201',	/* 7 */
			'0102',	/* 8 */
			'2001'	/* 9 */
		);
		// Parity, 0=Odd, 1=Even. Depending Checksum
		$this->codeParity = array(
			array(1,1,0,0,0),	/* 0 */
			array(1,0,1,0,0),	/* 1 */
			array(1,0,0,1,0),	/* 2 */
			array(1,0,0,0,1),	/* 3 */
			array(0,1,1,0,0),	/* 4 */
			array(0,0,1,1,0),	/* 5 */
			array(0,0,0,1,1),	/* 6 */
			array(0,1,0,1,0),	/* 7 */
			array(0,1,0,0,1),	/* 8 */
			array(0,0,1,0,1)	/* 9 */
		);
		$this->setText($text);
		$this->textfont = $textfont;
	}

	/**
	 * Saves Text
	 *
	 * @param string $text
	 */
	public function setText($text){
		$this->text = $text;
	}

	private function inverse($text,$inverse=1) {
		if($inverse == 1)
			$text = strrev($text);
		return $text;
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
			// Must contains 5 chars
			if(strlen($this->text) != 5) {
				$this->DrawError($im,'Must contains 5 chars.');
				$error_stop = true;
			}
			if($error_stop == false) {
				// Calculating Checksum
				// Consider the right-most digit of the message to be in an "odd" position,
				// and assign odd/even to each character moving from right to left
				// Odd Position = 3, Even Position = 9
				// Multiply it by the number
				// Add all of that and do 10-(?mod10)
				$odd = true;
				$checksum=0;
				for($i=strlen($this->text);$i>0;$i--) {
					if($odd==true) {
						$multiplier=3;
						$odd=false;
					}
					else {
						$multiplier=9;
						$odd=true;
					}
					$checksum += $this->keys[$this->text[$i - 1]] * $multiplier;
				}
				$checksum = intval(substr(strval($checksum),strlen(strval($checksum))-1,1));
				// If we have to write text, we move the barcode to the bottom to put text
				$this->positionY = ($this->textfont == 0)?0:15;
				// Starting Code
				$this->DrawChar($im,'001',1);
				// Code
				for($i=0;$i<5;$i++){
					$this->DrawChar($im,$this->inverse($this->findCode($this->text[$i]),$this->codeParity[$checksum][$i]),2);
					if($i < 4)
						$this->DrawChar($im,'00',2);	// Inter-char
				}
				$this->lastX = $this->positionX;
				$this->lastY = $this->maxHeight;
				$this->DrawText($im);
			}
		}
	}

	/**
	 * Overloaded method for drawing special label
	 *
	 * @param ressource $im
	 */
	protected function DrawText($im) {
		if($this->textfont != 0) {
			$bar_color = (is_null($this->color1))?NULL:$this->color1->allocate($im);
			if(!is_null($bar_color)) 
				imagestring($im,$this->textfont,$this->positionX/2-imagefontwidth($this->textfont)*(strlen($this->text)/2),1,$this->text,$bar_color);
			$this->lastY += 15;
		}
	}
};
?>