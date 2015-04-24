<?php
if(!defined('IN_CB'))die('You are not allowed to access to this page.');

/**
 * codabar.php
 *--------------------------------------------------------------------
 *
 * Sub-Class - Codabar
 *
 *--------------------------------------------------------------------
 * Revision History
 * V1.00	17 jun	2004	Jean-Sebastien Goupil
 *--------------------------------------------------------------------
 * Copyright (C) Jean-Sebastien Goupil
 * http://other.lookstrike.com/barcode/
 */
class codabar extends BarCode {
	protected $keys = array(), $code = array();
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
		$this->keys = array('0','1','2','3','4','5','6','7','8','9','-','$',':','/','.','+','A','B','C','D');
		$this->code = array(	// 0 added to add an extra space
			'00000110',	/* 0 */
			'00001100',	/* 1 */
			'00010010',	/* 2 */
			'11000000',	/* 3 */
			'00100100',	/* 4 */
			'10000100',	/* 5 */
			'01000010',	/* 6 */
			'01001000',	/* 7 */
			'01100000',	/* 8 */
			'10010000',	/* 9 */
			'00011000',	/* - */
			'00110000',	/* $ */
			'10001010',	/* : */
			'10100010',	/* / */
			'10101000',	/* . */
			'00111110',	/* + */
			'00110100',	/* A */
			'00010110',	/* B */
			'01010010',	/* C */
			'00011100'	/* D */
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
			// Must Start By A, B, C or D
			if($this->text[0] != 'A' && $this->text[0] != 'B' && $this->text[0] != 'C' && $this->text[0] != 'D') {
				$this->DrawError($im,'You must start by char A, B, C or D.');
				$error_stop = true;
			}
			// Must Over By A, B, C or D
			if($this->text[strlen($this->text)-1] != 'A' && $this->text[strlen($this->text)-1] != 'B' && $this->text[strlen($this->text)-1] != 'C' && $this->text[strlen($this->text)-1] != 'D') {
				$this->DrawError($im,'You must end by char A, B, C or D.');
				$error_stop = true;
			}
			if($error_stop == false) {
				for($i=0;$i<strlen($this->text);$i++)
					$this->DrawChar($im,$this->findCode($this->text[$i]),1);
				$this->lastX = $this->positionX;
				$this->lastY = $this->maxHeight;
				$this->DrawText($im);
			}
		}
	}
};
?>