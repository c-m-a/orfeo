<?php
if(!defined('IN_CB'))die('You are not allowed to access to this page.');

/**
 * ean13.php
 *--------------------------------------------------------------------
 *
 * Sub-Class - EAN-13
 *
 * You can provide a ISBN code (without dash), the code will transform
 * it into a EAN13 format.
 * EAN-13 contains
 *	- 2 system digits (1 not displayed but coded with parity)
 *	- 5 manufacturer code digits
 *	- 5 product digits
 *	- 1 checksum digit
 *
 *--------------------------------------------------------------------
 * Revision History
 * V1.00	17 jun	2004	Jean-Sebastien Goupil
 *--------------------------------------------------------------------
 * Copyright (C) Jean-Sebastien Goupil
 * http://other.lookstrike.com/barcode/
 */
class ean13 extends BarCode {
	protected $keys = array(), $code = array(), $codeParity = array();
	private $text;
	private $textfont;
	private $book;

	/**
	 * Constructor
	 *
	 * @param int $maxHeight
	 * @param FColor $color1
	 * @param FColor $color2
	 * @param int $res
	 * @param string $text
	 * @param int $textfont
	 * @param bool $book
	 */
	public function __construct($maxHeight,FColor $color1,FColor $color2,$res,$text,$textfont,$book=false) {
		BarCode::__construct($maxHeight,$color1,$color2,$res);
		$this->keys = array('0','1','2','3','4','5','6','7','8','9');
		// Left-Hand Odd Parity starting with a space
		// Left-Hand Even Parity is the inverse (0=0012) starting with a space
		// Right-Hand is the same of Left-Hand starting with a bar
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
		// Parity, 0=Odd, 1=Even for manufacturer code. Depending on 1st System Digit
		$this->codeParity = array(
			array(0,0,0,0,0),	/* 0 */
			array(0,1,0,1,1),	/* 1 */
			array(0,1,1,0,1),	/* 2 */
			array(0,1,1,1,0),	/* 3 */
			array(1,0,0,1,1),	/* 4 */
			array(1,1,0,0,1),	/* 5 */
			array(1,1,1,0,0),	/* 6 */
			array(1,0,1,0,1),	/* 7 */
			array(1,0,1,1,0),	/* 8 */
			array(1,1,0,1,0)	/* 9 */
		);
		$this->setText($text);
		$this->textfont = $textfont;
		$this->book = $book;
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
			if($this->book == true && strlen($this->text) != 10) {
				$this->DrawError($im,'Must contains 10 chars if ISBN is true.');
				$error_stop = true;
			}

			// If it's a book, we change the code to the right one
			if($this->book==true && strlen($this->text)==10)
				$this->text = '978'.substr($this->text,0,strlen($this->text)-1);
			
			// Must contains 12 chars
			if(strlen($this->text) != 12) {
				$this->DrawError($im,'Must contains 12 chars, the 13th digit is automatically added.');
				$error_stop = true;
			}
			if($error_stop == false) {
				// Calculating Checksum
				// Consider the right-most digit of the message to be in an "odd" position,
				// and assign odd/even to each character moving from right to left
				// Odd Position = 3, Even Position = 1
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
						$multiplier=1;
						$odd=true;
					}
					$checksum += $this->keys[$this->text[$i - 1]] * $multiplier;
				}
				$checksum = 10 - $checksum % 10;
				$checksum = ($checksum == 10)?0:$checksum;
				$this->text .= $this->keys[$checksum];
				// If we have to write text, we move the barcode to the right to have space to put system digit
				$this->positionX = ($this->textfont == 0)?0:10;
				// Starting Code
				$this->DrawChar($im,'000',1);
				// Draw Second Code
				$this->DrawChar($im,$this->findCode($this->text[1]),2);
				// Draw Manufacturer Code
				for($i=0;$i<5;$i++)
					$this->DrawChar($im,$this->inverse($this->findCode($this->text[$i + 2]),$this->codeParity[$this->text[0]][$i]),2);
				// Draw Center Guard Bar
				$this->DrawChar($im,'00000',2);
				// Draw Product Code
				for($i=7;$i<13;$i++){
					$this->DrawChar($im,$this->findCode($this->text[$i]),1);
				}
				// Draw Right Guard Bar
				$this->DrawChar($im,'000',1);
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
			if(!is_null($bar_color)) {
				$rememberX = $this->positionX;
				$rememberH = $this->maxHeight;
				// We increase the bars
				$this->maxHeight = $this->maxHeight + 9;
				$this->positionX = 10;
				$this->DrawSingleBar($im,$this->color1);
				$this->positionX += $this->res*2;
				$this->DrawSingleBar($im,$this->color1);
				// Center Guard Bar
				$this->positionX += $this->res*44;
				$this->DrawSingleBar($im,$this->color1);
				$this->positionX += $this->res*2;
				$this->DrawSingleBar($im,$this->color1);
				// Last Bars
				$this->positionX += $this->res*44;
				$this->DrawSingleBar($im,$this->color1);
				$this->positionX += $this->res*2;
				$this->DrawSingleBar($im,$this->color1);

				$this->positionX = $rememberX;
				$this->maxHeight = $rememberH;
				imagechar($im,$this->textfont,1,$this->maxHeight-(imagefontheight($this->textfont)/2),$this->text[0],$bar_color);
				imagestring($im,$this->textfont,10+(3*$this->res+48*$this->res)/2-imagefontwidth($this->textfont)*(6/2),$this->maxHeight+1,substr($this->text,1,6),$bar_color);
				imagestring($im,$this->textfont,10+46*$this->res+(3*$this->res+46*$this->res)/2-imagefontwidth($this->textfont)*(6/2),$this->maxHeight+1,substr($this->text,7,6),$bar_color);
			}
			$this->lastY = $this->maxHeight + imagefontheight($this->textfont);
		}
	}
};
?>