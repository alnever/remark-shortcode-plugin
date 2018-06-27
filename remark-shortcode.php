<?php
/*
 * Shortcode definition
 * @link
 * @since 1.0
 *
 * @package remark-shortcode-plugin
 * @subpackage remark-shortcode-plugin
*/

namespace RemarkShortcodePlugin;

class Remark_Shortcode {


  public function __construct() {
    add_action('wp_enqueue_scripts', array($this, 'enqueue_styles'));
    add_shortcode('remark',array($this, 'shortcode'));
  }

  public function shortcode($atts = [], $content = '', $tag = null) {

    // handle shortcodes attributes
    $atts = array_change_key_case((array)$atts, CASE_LOWER);

    //handle content
    if ( $content != null ) {
        $author = isset($atts['author']) && $atts['author'] != null ? $atts['author'] : '';
        $source = isset($atts['source']) && $atts['source'] != null ? $atts['source'] : '';
        $link   = isset($atts['link']) && $atts['link'] != null ? $atts['link'] : '';
        $link_name = isset($atts['link_name']) && $atts['link_name'] != null ? $atts['link_name'] : '';

        // parse a content and return as a result of the shortcode
        // during the content parsing, the custom CSS is token form the plugin options
        // and injected into the remark view

        return  Remark_Shortcode_Parser::parse(
            file_get_contents(dirname(__FILE__) . "/partial/remark-shortcode-view.twig"),
            array('custom_css' => isset(get_option('remark_shortcode_options')['custom_css']) ? get_option('remark_shortcode_options')['custom_css'] : "",
                  'content' => $content,
                  'author' => $author,
                  'source' => $source,
                  'link'   => $link,
                  'link_name' => $link_name
              )
          );


    }
  }

  public function enqueue_styles() {
    wp_enqueue_style('remark-shortcode-style', plugin_dir_url(__FILE__).'/css/remark-shortcode.css', null, null, all);
  }
}


?>
