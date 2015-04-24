<?php
if(!defined('IN_CB'))die('You are not allowed to access to this page.');

/**
 * i25.php
 *--------------------------------------------------------------------
 *
 * Sub-Class - Interleaved 2 of 5
 *
 *--------------------------------------------------------------------
 * Revision History
 * V1.00	17 jun	2004	Jean-Sebastien Goupil
 *--------------------------------------------------------------------
 * Copyright (C) Jean-Sebastien Goupil
 * http://other.lookstrike.com/barcode/
 */
class i25 extends BarCode {
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
	 * @param bool $checksum
	 */
	public function __construct($maxHeight,FColor $color1,FColor $color2,$res,$text,$textfont,$checksum=false) {
		BarCode::__construct($maxHeight,$color1,$color2,$res);
		$this->keys = array('0','1','2','3','4','5','6','7','8','9');
		$this->code = array(
			'00110',	/* 0 */
			'10001',	/* 1 */
			'01001',	/* 2 */
			'11000',	/* 3 */
			'00101',	/* 4 */
			'10100',	/* 5 */
			'01100',	/* 6 */
			'00011',	/* 7 */
			'10010',	/* 8 */
			'01010'		/* 9 */
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
			// Must be even
			if(strlen($this->text) % 2 != 0 && $this->checksum == false) {
				$this->DrawError($im,'i25 must be even if checksum is false.');
				$error_stop = true;
			}
			elseif(strlen($this->text) % 2 == 0 && $this->checksum == true) {
				$this->DrawError($im,'i25 must be odd if checksum is true.');
				$error_stop = true;
			}
			if($error_stop == false) {
				// We calculate checksum first
				// Odd Number has a weight of 1, even number has a weight of 3
				// Multiply to position
				// Sum all of that and mod 10
				if($this->checksum == true) {
					$checksum = 0;
					for($i=1;$i<=strlen($this->text);$i++) {
						$multiplier = (intval($this->text[$i-1])%2!=0)?1:3;
						$checksum += $i*$multiplier;
					}
					$this->text .= $this->keys[$checksum%10];
				}
				// Starting Code
				$this->DrawChar($im,'0000',1);
				// Chars
				for($i=0;$i<strlen($this->text);$i+=2) {
					$temp_bar = '';
					for($j=0;$j<strlen($this->findCode($this->text[$i]));$j++) {
						$temp_bar .= substr($this->findCode($this->text[$i]),$j,1);
						$temp_bar .= substr($this->findCode($this->text[$i + 1]),$j,1);
					}
					$this->DrawChar($im,$temp_bar,1);
				}
				// Ending Code
				$this->DrawChar($im,'100',1);
				$this->lastX = $this->positionX;
				$this->lastY = $this->maxHeight;
				$this->DrawText($im);
			}
		}
	}
};
?>