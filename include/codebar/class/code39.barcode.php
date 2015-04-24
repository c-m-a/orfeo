<?php
if(!defined('IN_CB'))die('You are not allowed to access to this page.');

/**
 * code39.php
 *--------------------------------------------------------------------
 *
 * Sub-Class - Code 39
 *
 *--------------------------------------------------------------------
 * Revision History
 * v1.01	7  jul  2004	Jean-Sebastien Goupil	Correction + Sign
 * V1.00	17 jun	2004	Jean-Sebastien Goupil
 *--------------------------------------------------------------------
 * Copyright (C) Jean-Sebastien Goupil
 * http://other.lookstrike.com/barcode/
 */
class code39 extends BarCode {
	protected $keys = array(), $code = array();
	private $starting, $ending;
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
		$this->starting = $this->ending = 43;
		$this->keys = array('0','1','2','3','4','5','6','7','8','9','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','-','.',' ','$','/','+','%','*');
		$this->code = array(	// 0 added to add an extra space
			'0001101000',	/* 0 */
			'1001000010',	/* 1 */
			'0011000010',	/* 2 */
			'1011000000',	/* 3 */
			'0001100010',	/* 4 */
			'1001100000',	/* 5 */
			'0011100000',	/* 6 */
			'0001001010',	/* 7 */
			'1001001000',	/* 8 */
			'0011001000',	/* 9 */
			'1000010010',	/* A */
			'0010010010',	/* B */
			'1010010000',	/* C */
			'0000110010',	/* D */
			'1000110000',	/* E */
			'0010110000',	/* F */
			'0000011010',	/* G */
			'1000011000',	/* H */
			'0010011000',	/* I */
			'0000111000',	/* J */
			'1000000110',	/* K */
			'0010000110',	/* L */
			'1010000100',	/* M */
			'0000100110',	/* N */
			'1000100100',	/* O */
			'0010100100',	/* P */
			'0000001110',	/* Q */
			'1000001100',	/* R */
			'0010001100',	/* S */
			'0000101100',	/* T */
			'1100000010',	/* U */
			'0110000010',	/* V */
			'1110000000',	/* W */
			'0100100010',	/* X */
			'1100100000',	/* Y */
			'0110100000',	/* Z */
			'0100001010',	/* - */
			'1100001000',	/* . */
			'0110001000',	/*   */
			'0101010000',	/* $ */
			'0101000100',	/* / */
			'0100010100',	/* + */
			'0001010100',	/* % */
			'0100101000'	/* * */
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
				// Checksum (rarely used)
				if($this->checksum == true) {
					$checksum = 0;
					for($i=0;$i<strlen($this->text);$i++)
						$checksum += $this->findIndex($this->text[$i]);
					$this->DrawChar($im,$this->code[$checksum % 43],1);
				}
				// Ending *
				$this->DrawChar($im,$this->code[$this->ending],1);
				$this->lastX = $this->positionX;
				$this->lastY = $this->maxHeight;
				$this->DrawText($im);
			}
		}
	}
};
?>