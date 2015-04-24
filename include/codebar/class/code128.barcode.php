<?php
if(!defined('IN_CB'))die('You are not allowed to access to this page.');

/**
 * code128.php
 *--------------------------------------------------------------------
 *
 * Sub-Class - Code 128, A, B, C
 *
 * # Code C Working properly only on PHP4 or PHP5.0.3+ due to bug :
 * http://bugs.php.net/bug.php?id=28862
 *
 *--------------------------------------------------------------------
 * Revision History
 * V1.00	17 jun	2004	Jean-Sebastien Goupil
 *--------------------------------------------------------------------
 * Copyright (C) Jean-Sebastien Goupil
 * http://other.lookstrike.com/barcode/
 */
class code128 extends BarCode {
	protected $keys = array(), $keysA = array(), $keysB = array(), $keysC = array(), $code = array();
	private $starting, $ending, $starting_text;
	protected $text;
	protected $textfont;
	private $currentCode;

	/**
	 * Constructor
	 *
	 * @param int $maxHeight
	 * @param FColor $color1
	 * @param FColor $color2
	 * @param int $res
	 * @param string $text
	 * @param int $textfont
	 * @param char $start
	 */
	public function __construct($maxHeight,FColor $color1,FColor $color2,$res,$text,$textfont,$start='B') {
		BarCode::__construct($maxHeight,$color1,$color2,$res);
		if($start=='A')
			$this->starting = 103;
		elseif($start=='B')
			$this->starting = 104;
		elseif($start=='C')
			$this->starting = 105;
		$this->ending = 106;
		$this->currentCode = $start;
		/* CODE 128 A */
		$this->keysA = array(' ','!','"','#','$','%','&','\'','(',')','*','+',',','-','.','/','0','1','2','3','4','5','6','7','8','9',':',';','<','=','>','?','@','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','[','\\',']','^','_','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',chr(128),chr(129));

		/* CODE 128 B */
		$this->keysB = array(' ','!','"','#','$','%','&','\'','(',')','*','+',',','-','.','/','0','1','2','3','4','5','6','7','8','9',':',';','<','=','>','?','@','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','[','\\',']','^','_','`','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','{','|','}','~','','','','',chr(128),'',chr(130));

		/* CODE 128 C */
		$this->keysC = array();
		for($i=0;$i<=99;$i++)
			$this->keysC[] = sprintf('%02d',$i);
		$this->keysC[] = chr(129);
		$this->keysC[] = chr(130);

		$this->code = array(
			'101111',	/* 00 */
			'111011',	/* 01 */
			'111110',	/* 02 */
			'010112',	/* 03 */
			'010211',	/* 04 */
			'020111',	/* 05 */
			'011102',	/* 06 */
			'011201',	/* 07 */
			'021101',	/* 08 */
			'110102',	/* 09 */
			'110201',	/* 10 */
			'120101',	/* 11 */
			'001121',	/* 12 */
			'011021',	/* 13 */
			'011120',	/* 14 */
			'002111',	/* 15 */
			'012011',	/* 16 */
			'012110',	/* 17 */
			'112100',	/* 18 */
			'110021',	/* 19 */
			'110120',	/* 20 */
			'102101',	/* 21 */
			'112001',	/* 22 */
			'201020',	/* 23 */
			'200111',	/* 24 */
			'210011',	/* 25 */
			'210110',	/* 26 */
			'201101',	/* 27 */
			'211001',	/* 28 */
			'211100',	/* 29 */
			'101012',	/* 30 */
			'101210',	/* 31 */
			'121010',	/* 32 */
			'000212',	/* 33 */
			'020012',	/* 34 */
			'020210',	/* 35 */
			'001202',	/* 36 */
			'021002',	/* 37 */
			'021200',	/* 38 */
			'100202',	/* 39 */
			'120002',	/* 40 */
			'120200',	/* 41 */
			'001022',	/* 42 */
			'001220',	/* 43 */
			'021020',	/* 44 */
			'002012',	/* 45 */
			'002210',	/* 46 */
			'022010',	/* 47 */
			'202010',	/* 48 */
			'100220',	/* 49 */
			'120020',	/* 50 */
			'102002',	/* 51 */
			'102200',	/* 52 */
			'102020',	/* 53 */
			'200012',	/* 54 */
			'200210',	/* 55 */
			'220010',	/* 56 */
			'201002',	/* 57 */
			'201200',	/* 58 */
			'221000',	/* 59 */
			'203000',	/* 60 */
			'110300',	/* 61 */
			'320000',	/* 62 */
			'000113',	/* 63 */
			'000311',	/* 64 */
			'010013',	/* 65 */
			'010310',	/* 66 */
			'030011',	/* 67 */
			'030110',	/* 68 */
			'001103',	/* 69 */
			'001301',	/* 70 */
			'011003',	/* 71 */
			'011300',	/* 72 */
			'031001',	/* 73 */
			'031100',	/* 74 */
			'130100',	/* 75 */
			'110003',	/* 76 */
			'302000',	/* 77 */
			'130001',	/* 78 */
			'023000',	/* 79 */
			'000131',	/* 80 */
			'010031',	/* 81 */
			'010130',	/* 82 */
			'003101',	/* 83 */
			'013001',	/* 84 */
			'013100',	/* 85 */
			'300101',	/* 86 */
			'310001',	/* 87 */
			'310100',	/* 88 */
			'101030',	/* 89 */
			'103010',	/* 90 */
			'301010',	/* 91 */
			'000032',	/* 92 */
			'000230',	/* 93 */
			'020030',	/* 94 */
			'003002',	/* 95 */
			'003200',	/* 96 */
			'300002',	/* 97 */
			'300200',	/* 98 */
			'002030',	/* 99 */
			'003020',	/* 100*/
			'200030',	/* 101*/
			'300020',	/* 102*/
			'100301',	/* 103*/
			'100103',	/* 104*/
			'100121',	/* 105*/
			'122000'	/*STOP*/
		);
		$this->setText($text);
		$this->textfont = $textfont;
		$this->usingCode($start);
		$this->starting_text = $start;
	}

	/**
	 * Saves Text
	 *
	 * @param string $text
	 */
	public function setText($text) {
		$this->text = $text;
	}

	private function usingCode($code) {
		if($code=='A')
			$this->keys = $this->keysA;
		elseif($code=='B')
			$this->keys = $this->keysB;
		elseif($code=='C')
			$this->keys = $this->keysC;
		$this->currentCode = $code;
	}

	/**
	 * Draws the barcode
	 *
	 * @param ressource $im
	 */
	public function draw($im) {
		$error_stop = false;

		$this->usingCode($this->starting_text);
		// Checking if all chars are allowed
		for($i=0;$i<strlen($this->text);$i++) {
			if($this->currentCode=='C') {
				if(isset($this->text[$i+1]) && $this->check_int($this->text[$i+1])) {
					$value_test = array_search($this->text[$i].$this->text[$i+1],$this->keys);
					$i++;
				}
				else {
					$this->DrawError($im,'With Code C, you must provide always pair of two integers.');
					$error_stop = true;
				}
			}
			else
				$value_test = array_search($this->text[$i],$this->keys);
			if(!is_int($value_test)) {
				$this->DrawError($im,'Char \''.$this->text[$i].'\' not allowed.');
				$error_stop = true;
			}
			if($this->findIndex($this->text[$i]) == 99 && $this->currentCode != 'C')
				$this->usingCode('C');
			elseif($this->findIndex($this->text[$i]) == 100 && $this->currentCode != 'B')
				$this->usingCode('B');
			elseif($this->findIndex($this->text[$i]) == 101 && $this->currentCode != 'A')
				$this->usingCode('A');
		}
		if($error_stop == false) {
			// The START-A, START-B, START-C, STOP are not allowed
			if(is_int(strpos($this->text,chr(135))) || is_int(strpos($this->text,chr(136))) || is_int(strpos($this->text,chr(137))) || is_int(strpos($this->text,chr(138)))) {
				$this->DrawError($im,'Chars START-A, START-B, START-C, STOP not allowed.');
				$error_stop = true;
			}
			if($error_stop == false) {
				$this->usingCode($this->starting_text);
				// Starting Code
				$this->DrawChar($im,$this->code[$this->starting],1);
				// Chars
				for($i=0;$i<strlen($this->text);$i++) {
					if($this->currentCode=='C') {
						$this->DrawChar($im,$this->findCode($this->text[$i].$this->text[$i+1]),1);
						$i++;
					}
					else
						$this->DrawChar($im,$this->findCode($this->text[$i]),1);
					if($this->findIndex($this->text[$i]) == 99 && $this->currentCode != 'C')
						$this->usingCode('C');
					elseif($this->findIndex($this->text[$i]) == 100 && $this->currentCode != 'B')
						$this->usingCode('B');
					elseif($this->findIndex($this->text[$i]) == 101 && $this->currentCode != 'A')
						$this->usingCode('A');
				}
				// Checksum
				// First Char (START)
				// + Starting with the first data character following the start character,
				// take the value of the character (between 0 and 102, inclusive) multiply
				// it by its character position (1) and add that to the running checksum.
				// Modulated 103
				if($this->starting == 103)
					$this->usingCode('A');
				elseif($this->starting == 104)
					$this->usingCode('B');
				elseif($this->starting == 105)
					$this->usingCode('C');
				$checksum = 0;
				$checksum += $this->starting;
				for($position=1,$i=0;$i<strlen($this->text);$position++,$i++) {
					if($this->currentCode=='C') {
						$checksum += intval($this->text[$i].$this->text[$i+1]) * $position;
						$i++;
					}
					else
						$checksum += $this->findIndex($this->text[$i]) * $position;

					if($this->findIndex($this->text[$i]) == 99 && $this->currentCode != 'C')
						$this->usingCode('C');
					elseif($this->findIndex($this->text[$i]) == 100 && $this->currentCode != 'B')
						$this->usingCode('B');
					elseif($this->findIndex($this->text[$i]) == 101 && $this->currentCode != 'A')
						$this->usingCode('A');
				}
				$this->DrawChar($im,$this->code[$checksum % 103],1);
				// Ending Code
				$this->DrawChar($im,$this->code[$this->ending],1);
				// Draw a Final Bar
				$this->DrawChar($im,'1',1);
				$this->lastX = $this->positionX;
				$this->lastY = $this->maxHeight;
				// Removing Special Code
				$this->text = ereg_replace(chr(128),'',$this->text);
				$this->text = ereg_replace(chr(129),'',$this->text);
				$this->text = ereg_replace(chr(130),'',$this->text);
				$this->DrawText($im);
			}
		}
	}

	private function check_int($var) {
		if(intval($var)>=0 || intval($var)<=9)
			return true;
		else
			return false;
	}
};
?>