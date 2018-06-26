<?php

/*
 * A simpe class to parse twig-like files
 * @link
 * @since 1.0
 *
 * @package wordpress-plugin-template
 * @subpackage wordpress-plugin-template/admin
*/

namespace RemarkShortcodePrlugin;

class Remark_Shortcode_Parser {

	public function __counstruct() {

	}

	public static function parse($str = "", $args = array()) {

		foreach($args as $key => $value) {
			$str = str_replace("{{ $key }}",$value,$str);
		}

		return $str;
	}
}