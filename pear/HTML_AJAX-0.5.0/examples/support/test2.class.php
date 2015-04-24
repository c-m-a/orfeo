<?php
/**
 * Test class used in other examples
 * 
 * @category   HTML
 * @package    AJAX
 * @author     Joshua Eichorn <josh@bluga.net>
 * @copyright  2005 Joshua Eichorn
 * @license    http://www.opensource.org/licenses/lgpl-license.php  LGPL
 * @version    Release: @package_version@
 * @link       http://pear.php.net/package/HTML_AJAX
 */
class test2 {
	function echo_string($string) {
		return $string;
	}
	function slow_echo_string($string) {
		sleep(2);
		return $string;
	}
	function error_test($string) {
		trigger_error($string);
	}
}
?>
