<?php
if(!defined('IN_CB'))die('You are not allowed to access to this page.');

/**
 * postnet.php
 *--------------------------------------------------------------------
 *
 * Sub-Class - PostNet
 *
 * ################ NOT TESTED ################
 *
 *--------------------------------------------------------------------
 * Revision History
 * V1.00	17 jun	2004	Jean-Sebastien Goupil
 *--------------------------------------------------------------------
 * Copyright (C) Jean-Sebastien Goupil
 * http://other.lookstrike.com/barcode/
 */
class postnet extends BarCode {
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
		$this->keys = array('0','1','2','3','4','5','6','7','8','9');
		$this->code = array(
			'11000',	/* 0 */
			'00011',	/* 1 */
			'00101',	/* 2 */
			'00110',	/* 3 */
			'01001',	/* 4 */
			'01010',	/* 5 */
			'01100',	/* 6 */
			'10001',	/* 7 */
			'10010',	/* 8 */
			'10100'		/* 9 */
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
			// Must contains 5, 9 or 11 chars
			if(strlen($this->text) != 5 && strlen($this->text) != 9 && strlen($this->text) != 11) {
				$this->DrawError($im,'Must contains 5, 9 or 11 chars.');
				$error_stop = true;
			}
			if($error_stop == false) {
				// Checksum
				$checksum = 0;
				for($i=0;$i<strlen($this->text);$i++)
					$checksum += intval($this->text[$i]);
				$checksum = 10-($checksum % 10);
				
				// Starting Code
				$this->DrawChar($im,'1',0);
				// Code
				for($i=0;$i<strlen($this->text);$i++)
					$this->DrawChar($im,$this->findCode($this->text[$i]),0);
				// Checksum
				$this->DrawChar($im,$this->findCode($checksum),0);
				//Ending Code
				$this->DrawChar($im,'1',1);
				$this->lastX = $this->positionX;
				$this->lastY = $this->maxHeight;
				$this->DrawText($im);
			}
		}
	}

	/**
	 * Overloaded method for drawing special barcode
	 *
	 * @param ressource $im
	 * @param string $code
	 * @param int $last
	 */
	protected function DrawChar($im,$code,$last=0) {
		$first_posY = $this->positionY;
		$bar_color = (is_null($this->color1))?NULL:$this->color1->allocate($im);
		if(!is_null($bar_color)){
			for($i=0;$i<strlen($code);$i++){
				if($code[$i] == '0') {
					$this->positionY = ($first_posY+$this->maxHeight)/2;
					$height = $this->positionY+($first_posY+$this->maxHeight)/2;
				}
				else {
					$this->positionY = $first_posY;
					$height = $first_posY+$this->maxHeight;
				}

				for($j=0;$j<$this->res;$j++) 
					for($z=0;$z<$this->res;$z++)
						imageline($im,$this->positionX+$j+$z,$this->positionY,$this->positionX+$j+$z,$height,$bar_color);

				for($j=0;$j<(2*$this->res);$j++)
					$this->nextX();
			}
			$this->positionY = $first_posY;
		}
	}
};
?>