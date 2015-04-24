<?php
if(!defined('IN_CB'))die('You are not allowed to access to this page.');

/**
 * code11.php
 *--------------------------------------------------------------------
 *
 * Sub-Class - Code 11
 *
 *--------------------------------------------------------------------
 * Revision History
 * V1.00	17 jun	2004	Jean-Sebastien Goupil
 *--------------------------------------------------------------------
 * Copyright (C) Jean-Sebastien Goupil
 * http://other.lookstrike.com/barcode/
 */
class code11 extends BarCode {
	protected $keys = array(), $code = array();
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
		$this->starting = $this->ending = 47;
		$this->keys = array('0','1','2','3','4','5','6','7','8','9','-');
		$this->code = array(	// 0 added to add an extra space
			'000010',	/* 0 */
			'100010',	/* 1 */
			'010010',	/* 2 */
			'110000',	/* 3 */
			'001010',	/* 4 */
			'101000',	/* 5 */
			'011000',	/* 6 */
			'000110',	/* 7 */
			'100100',	/* 8 */
			'100000',	/* 9 */
			'001000'	/* - */
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
			// Starting Code
			$this->DrawChar($im,'001100',1);
			// Chars
			for($i=0;$i<strlen($this->text);$i++)
				$this->DrawChar($im,$this->findCode($this->text[$i]),1);
			// Checksum
			// First CheckSUM "C"
			// The "C" checksum character is the modulo 11 remainder of the sum of the weighted
			// value of the data characters. The weighting value starts at "1" for the right-most
			// data character, 2 for the second to last, 3 for the third-to-last, and so on up to 20.
			// After 10, the sequence wraps around back to 1.

			// Second CheckSUM "K"
			// Same as CheckSUM "C" but we count the CheckSum "C" at the end
			// After 9, the sequence wraps around back to 1.
			$sequence_multiplier = array(10,9);
			$temp_text = $this->text;
			for($z=0;$z<2;$z++) {
				// We don't display the K CheckSum if the original text had a length less than 10
				if(strlen($temp_text)<=10 && $z==1)
					break;
				$checksum = 0;
				for($i=strlen($temp_text),$j=0;$i>0;$i--,$j++) {
					$multiplier = $i % $sequence_multiplier[$z];
					if($multiplier==0)
						$multiplier=$sequence_multiplier[$z];
					$checksum += $this->findIndex($temp_text[$j]) * $multiplier;
				}
				$this->DrawChar($im,$this->findCode($checksum % 11),1);
				$temp_text .= $this->keys[$checksum % 11];
			}
			// Ending Code
			$this->DrawChar($im,'00110',1);
			$this->lastX = $this->positionX;
			$this->lastY = $this->maxHeight;
			$this->DrawText($im);
		}
	}
};
?>