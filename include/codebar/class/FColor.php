<?php
if(!defined('IN_CB'))die('You are not allowed to access to this page.');

/**
 * Holds Color in RGB Format.
 */
class FColor {
	protected $r,$g,$b;	// int Hexadecimal Value

	/**
	 * Save RGB value into the classes
	 *
	 * @param int $r
	 * @param int $g
	 * @param int $b
	 */
	public function __construct($r,$g,$b){
		$this->r = $r;
		$this->g = $g;
		$this->b = $b;
	}

	/**
	 * Returns Red Color
	 *
	 * @return int
	 */
	public function r(){
		return $this->r;
	}

	/**
	 * Returns Green Color
	 *
	 * @return int
	 */
	public function g(){
		return $this->g;
	}

	/**
	 * Returns Blue Color
	 *
	 * @return int
	 */
	public function b(){
		return $this->b;
	}

	/**
	 * Returns the int value for PHP color
	 *
	 * @return int
	 */
	public function allocate($im) {
		return imagecolorallocate($im,$this->r,$this->g,$this->b);
	}
};
?>