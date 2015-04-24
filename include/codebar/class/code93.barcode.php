<?php
if(!defined('IN_CB'))die('You are not allowed to access to this page.');

/**
 * code93.php
 *--------------------------------------------------------------------
 *
 * Sub-Class - Code 93
 *
 *--------------------------------------------------------------------
 * Revision History
 * V1.00	17 jun	2004	Jean-Sebastien Goupil
 *--------------------------------------------------------------------
 * Copyright (C) Jean-Sebastien Goupil
 * http://other.lookstrike.com/barcode/
 */
class code93 extends BarCode {
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
		$this->keys = array('0','1','2','3','4','5','6','7','8','9','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','-','.',' ','$','/','+','%','($)','(%)','(/)','(+)','*');
		$this->code = array(
			'020001',	/* 0 */
			'000102',	/* 1 */
			'000201',	/* 2 */
			'000300',	/* 3 */
			'010002',	/* 4 */
			'010101',	/* 5 */
			'010200',	/* 6 */
			'000003',	/* 7 */
			'020100',	/* 8 */
			'030000',	/* 9 */
			'100002',	/* A */
			'100101',	/* B */
			'100200',	/* C */
			'110001',	/* D */
			'110100',	/* E */
			'120000',	/* F */
			'001002',	/* G */
			'001101',	/* H */
			'001200',	/* I */
			'011001',	/* J */
			'021000',	/* K */
			'000012',	/* L */
			'000111',	/* M */
			'000210',	/* N */
			'010011',	/* O */
			'020010',	/* P */
			'101001',	/* Q */
			'101100',	/* R */
			'100011',	/* S */
			'100110',	/* T */
			'110010',	/* U */
			'111000',	/* V */
			'001011',	/* W */
			'001110',	/* X */
			'011010',	/* Y */
			'012000',	/* Z */
			'010020',	/* - */
			'200001',	/* . */
			'200100',	/*   */
			'210000',	/* $ */
			'001020',	/* / */
			'002010',	/* + */
			'100020',	/* % */
			'010110',	/*($)*/
			'201000',	/*(%)*/
			'200010',	/*(/)*/
			'011100',	/*(+)*/
			'000030'	/* * */
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
		$this->text = strtoupper($text);	// Only Capital Letters are Allowed
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
			// The * is not allowed
			if(is_int(strpos($this->text,'*'))) {
				$this->DrawError($im,'Char \'*\' not allowed.');
				$error_stop = true;
			}

			if($error_stop == false) {
				// Starting *
				$this->DrawChar($im,$this->code[$this->starting],1);
				// Chars
				for($i=0;$i<strlen($this->text);$i++)
					$this->DrawChar($im,$this->findCode($this->text[$i]),1);
				// Checksum
				// First CheckSUM "C"
				// The "C" checksum character is the modulo 47 remainder of the sum of the weighted
				// value of the data characters. The weighting value starts at "1" for the right-most
				// data character, 2 for the second to last, 3 for the third-to-last, and so on up to 20.
				// After 20, the sequence wraps around back to 1.

				// Second CheckSUM "K"
				// Same as CheckSUM "C" but we count the CheckSum "C" at the end
				// After 15, the sequence wraps around back to 1.
				$sequence_multiplier = array(20,15);
				$temp_text = $this->text;
				for($z=0;$z<2;$z++) {
					$checksum = 0;
					for($i=strlen($temp_text),$j=0;$i>0;$i--,$j++) {
						$multiplier = $i % $sequence_multiplier[$z];
						if($multiplier==0)
							$multiplier = $sequence_multiplier[$z];
						$checksum += $this->findIndex($temp_text[$j]) * $multiplier;
					}
					$this->DrawChar($im,$this->code[$checksum % 47],1);
					$temp_text .= $this->keys[$checksum % 47];
				}
				// Ending *
				$this->DrawChar($im,$this->code[$this->ending],1);
				// Draw a Final Bar
				$this->DrawChar($im,'0',1);
				$this->lastX = $this->positionX;
				$this->lastY = $this->maxHeight;
				$this->DrawText($im);
			}
		}
	}
};
?>