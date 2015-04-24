<?php
if(!defined('IN_CB'))die('You are not allowed to access to this page.');

/**
 * upce.php
 *--------------------------------------------------------------------
 *
 * Sub-Class - UPC-E
 *
 * You can provide a UPC-A code (without dash), the code will transform
 * it into a UPC-E format if it's possible.
 * UPC-E contains
 *	- 1 system digits (not displayed but coded with parity)
 *	- 6 digits
 *	- 1 checksum digit (not displayed but coded with parity)
 *
 *--------------------------------------------------------------------
 * Revision History
 * V1.00	17 jun	2004	Jean-Sebastien Goupil
 *--------------------------------------------------------------------
 * Copyright (C) Jean-Sebastien Goupil
 * http://other.lookstrike.com/barcode/
 */
class upce extends BarCode {
	protected $keys = array(), $code = array(), $codeParity = array();
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
		// Odd Parity starting with a space
		// Even Parity is the inverse (0=0012) starting with a space
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
		// Parity, 0=Odd, 1=Even for manufacturer code. Depending on 1st System Digit and Checksum
		$this->codeParity = array(
			array(
				array(1,1,1,0,0,0),	/* 0,0 */
				array(1,1,0,1,0,0),	/* 0,1 */
				array(1,1,0,0,1,0),	/* 0,2 */
				array(1,1,0,0,0,1),	/* 0,3 */
				array(1,0,1,1,0,0),	/* 0,4 */
				array(1,0,0,1,1,0),	/* 0,5 */
				array(1,0,0,0,1,1),	/* 0,6 */
				array(1,0,1,0,1,0),	/* 0,7 */
				array(1,0,1,0,0,1),	/* 0,8 */
				array(1,0,0,1,0,1)	/* 0,9 */
			),
			array(
				array(0,0,0,1,1,1),	/* 0,0 */
				array(0,0,1,0,1,1),	/* 0,1 */
				array(0,0,1,1,0,1),	/* 0,2 */
				array(0,0,1,1,1,0),	/* 0,3 */
				array(0,1,0,0,1,1),	/* 0,4 */
				array(0,1,1,0,0,1),	/* 0,5 */
				array(0,1,1,1,0,0),	/* 0,6 */
				array(0,1,0,1,0,1),	/* 0,7 */
				array(0,1,0,1,1,0),	/* 0,8 */
				array(0,1,1,0,1,0)	/* 0,9 */
			)
		);
		$this->setText($text);
		$this->textfont = $textfont;
	}

	/**
	 * Saves Text
	 *
	 * @param string $text
	 */
	public function setText($text) {
		$this->text = $text;
	}

	private function inverse($text,$inverse=1) {
		if($inverse==true)
			$text = strrev($text);
		return $text;
	}

	private function checksum($text) {
		$odd = true;
		$checksum=0;
		for($i=strlen($this->text);$i>0;$i--) {
			if($odd==true){
				$multiplier=3;
				$odd=false;
			}
			else{
				$multiplier=1;
				$odd=true;
			}
			$checksum += $this->keys[$this->text[$i - 1]] * $multiplier;
		}
		$checksum = 10 - $checksum % 10;
		$checksum = ($checksum == 10)?0:$checksum;
		return $checksum;
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
			// Must contains 11 chars
			// Must contains 8 chars (if starting with upce directly)
			// First Chars must be 0 or 1
			if(strlen($this->text) != 11 && strlen($this->text) != 6) {
				$this->DrawError($im,'Provide an UPC-A (11 chars) or');
				$this->DrawError($im,'You can also provide UPC-E directly (6 chars).');
				$error_stop = true;
			}
			elseif($this->text[0] != '0' && $this->text[0] != '1' && strlen($this->text) != 6) {
				$this->DrawError($im,'Must starts with 0 or 1.');
				$error_stop = true;
			}

			if($error_stop == false) {
				if(strlen($this->text) != 6) {
					// Checking if UPC-A is convertible
					$upce = '';
					if(substr($this->text,3,3) == '000' || substr($this->text,3,3) == '100' || substr($this->text,3,3) == '200') { // manufacturer code ends with 100,200 or 300
						if(substr($this->text,6,2) == '00') // Product must start with 00
							$upce = substr($this->text,1,2).substr($this->text,8,3).substr($this->text,3,1);
						else
							$error_stop = true;
					}
					elseif(substr($this->text,4,2) == '00') { // manufacturer code ends with 00
						if(substr($this->text,6,3) == '000') // Product must start with 000
							$upce = substr($this->text,1,3).substr($this->text,9,2).'3';
						else
							$error_stop = true;
					}
					elseif(substr($this->text,5,1) == '0') { // manufacturer code ends with 0
						if(substr($this->text,6,4) == '0000') // Product must start with 0000
							$upce = substr($this->text,1,4).substr($this->text,10,1).'4';
						else
							$error_stop = true;
					}
					else{ // No zero leading at manufacturer code
						if(substr($this->text,6,4) == '0000' && intval(substr($this->text,10,1)) >= 5 && intval(substr($this->text,10,1)) <= 9) // Product must start with 0000 and must over by 5,6,7,8 or 9
							$upce = substr($this->text,1,5).substr($this->text,10,1);
						else
							$error_stop = true;
					}
				}
				else
					$upce = $this->text;
	
				if($error_stop == false) {
					// Calculating Checksum
					// Consider the right-most digit of the message to be in an "odd" position,
					// and assign odd/even to each character moving from right to left
					// Odd Position = 3, Even Position = 1
					// Multiply it by the number
					// Add all of that and do 10-(?mod10)
					if(strlen($this->text) != 6) 
						$checksum = $this->checksum($this->text);
					else {
						// We convert UPC-E to UPC-A to find the checksum
						if($this->text[5] == '0' || $this->text[5] == '1' || $this->text[5] == '2')
							$upca = substr($this->text,0,2).$this->text[5].'0000'.substr($this->text,2,3);
						elseif($this->text[5] == '3')
							$upca = substr($this->text,0,3).'00000'.substr($this->text,3,2);
						elseif($this->text[5] == '4')
							$upca = substr($this->text,0,4).'00000'.$this->text[4];
						else
							$upca = substr($this->text,0,5).'0000'.$this->text[5];
						$this->text = '0'.$upca;
						$checksum = $this->checksum($this->text);
					}
					// If we have to write text, we move the barcode to the right to have space to put system digit
					$this->positionX = ($this->textfont == 0)?0:10;
					// Starting Code
					$this->DrawChar($im,'000',1);
					for($i=0;$i<strlen($upce);$i++)
						$this->DrawChar($im,$this->inverse($this->findCode($upce[$i]),$this->codeParity[$this->text[0]][$checksum][$i]),2);
					// Draw Center Guard Bar
					$this->DrawChar($im,'00000',2);
					// Draw Right Bar
					$this->DrawChar($im,'0',1);
					$this->lastX = $this->positionX;
					$this->lastY = $this->maxHeight;
					$this->text = $this->text[0].$upce.$checksum;
					$this->DrawText($im);
				}
				else
					$this->DrawError($im,'Your UPC-A can\'t be converted to UPC-E.');
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
			if(!is_null($bar_color)) {
				$rememberX = $this->positionX;
				$rememberH = $this->maxHeight;
				// We increase the bars
				$this->maxHeight = $this->maxHeight + 9;
				$this->positionX = 10;
				$this->DrawSingleBar($im,$this->color1);
				$this->positionX += $this->res*2;
				$this->DrawSingleBar($im,$this->color1);
				// Last Bars
				$this->positionX += $this->res*46;
				$this->DrawSingleBar($im,$this->color1);
				$this->positionX += $this->res*2;
				$this->DrawSingleBar($im,$this->color1);

				$this->positionX = $rememberX;
				$this->maxHeight = $rememberH;
				imagechar($im,$this->textfont,1,$this->maxHeight-(imagefontheight($this->textfont)/2),$this->text[0],$bar_color);
				imagestring($im,$this->textfont,10+(4*$this->res+48*$this->res)/2-imagefontwidth($this->textfont)*(6/2),$this->maxHeight+1,substr($this->text,1,6),$bar_color);
				imagechar($im,$this->textfont,2+10+(48+4)*$this->res,$this->maxHeight-(imagefontheight($this->textfont)/2),$this->text[7],$bar_color);
			}
			$this->lastY = $this->maxHeight + imagefontheight($this->textfont);
			$this->lastX += 2 + imagefontwidth($this->textfont);
		}
	}
};
?>