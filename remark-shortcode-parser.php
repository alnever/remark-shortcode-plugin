<?php

/*
 * A simpe class to parse twig-like files
 * @link
 * @since 1.0
 *
 * @package remark-shortcode-plugin
 * @subpackage remark-shortcode-plugin
 */

namespace RemarkShortcodePlugin;

class Remark_Shortcode_Parser {

	public function __counstruct() {

	}

	/*
		A static function to parse pseudo twig template
	*/
	public static function parse($str = "", $args = array()) {
		// replace all tokens in the template with given values
		foreach($args as $key => $value) {
			$str = str_replace("{{ $key }}",$value,$str);
		}

		return $str;
	}
}