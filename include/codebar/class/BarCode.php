<?php
if(!defined('IN_CB'))die('You are not allowed to access to this page.');

/**
 * Holds all type of barcodes
 * You must call init().
 * You can use get_im() to add other kind of form not held into these classes.
 */
class BarCode {
	protected $maxHeight;
	protected $color1,$color2;
	protected $positionX, $positionY, $res;
	public $lastX, $lastY;
	private $error;

	/**
	 * Constructor
	 *
	 * @param int $maxHeight
	 * @param FColor $color1
	 * @param FColor $color2
	 * @param int $res
	 */
	protected function __construct($maxHeight,FColor $color1,FColor $color2,$res){
		$this->maxHeight = $maxHeight;
		$this->color1 = $color1;
		$this->color2 = $color2;
		$this->res = $res;
		$this->error = 0;
		$this->positionY = 0;
	}

	/**
	 * Returns the index in $keys (useful for checksum)
	 *
	 * @param mixed $var
	 * @return mixed
	 */
	protected function findIndex($var){
		return array_search($var,$this->keys);
	}

	/**
	 * Returns the code of the char (useful for drawing bars)
	 *
	 * @param mixed $var
	 * @return string
	 */
	protected function findCode($var){
		return $this->code[$this->findIndex($var)];
	}

	/**
	 * Draws a Bar of $color depending of the resolution
	 *
	 * @param ressource $img
	 * @param FColor $color
	 */
	protected function DrawSingleBar($im,FColor $color){
		$bar_color = (is_null($color))?NULL:$color->allocate($im);
		if(!is_null($bar_color))
			for($i=0;$i<$this->res;$i++)
				imageline($im,$this->positionX+$i,$this->positionY,$this->positionX+$i,$this->positionY+$this->maxHeight,$bar_color);
	}

	/**
	 * Writes the Error on the picture
	 *
	 * @param ressource $img
	 * @param string $text
	 */
	protected function DrawError($im,$text){
		$text_color = (is_null($this->color1))?NULL:$this->color1->allocate($im);
		imagestring($im,5,0,$this->error*15,$text,$text_color);
		$this->error++;
		$this->lastX = (imagefontwidth(5)*strlen($text)>$this->lastX)?imagefontwidth(5)*strlen($text):$this->lastX;
		$this->lastY = $this->error*15;
	}

	/**
	 * Moving the pointer right to write a bar
	 */
	protected function nextX(){
		$this->positionX+=$this->res;
	}

	/**
	 * Draws all chars thanks to $code. if $start==1, the line begins by a bar.
	 * if $start==2, the line begins by a space.
	 *
	 * @param ressource $im
	 * @param string $code
	 * @param int $start
	 */
	protected function DrawChar($im,$code,$start=1){
		$currentColor = ($start==1)?$this->color1:$this->color2;
		$colornumber = $start;
		for($i=0;$i<strlen($code);$i++){
			for($j=0;$j<intval($code[$i])+1;$j++){
				$this->DrawSingleBar($im,$currentColor);
				$this->nextX();
			}
			if($colornumber==1){
				$currentColor=$this->color2;
				$colornumber=2;
			}
			else{
				$currentColor=$this->color1;
				$colornumber=1;
			}
		}
	}

	/**
	 * Draws the label under the barcode
	 *
	 * @param ressource $im
	 */
	protected function DrawText($im) {
		if($this->textfont != 0) {
			$xPosition = ($this->positionX / 2) - (strlen($this->text)/2)*imagefontwidth($this->textfont);
			$text_color = (is_null($this->color1))?NULL:$this->color1->allocate($im);
			imagestring($im,$this->textfont,$xPosition,$this->maxHeight,$this->text,$text_color);
			$this->lastY = $this->maxHeight + imagefontheight($this->textfont);
		}
	}
};
?>