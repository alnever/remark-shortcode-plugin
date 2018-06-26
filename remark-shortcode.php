<?php
/*
 * Shortcode definition
 * @link
 * @since 1.0
 *
 * @package wordpress-plugin-template
 * @subpackage wordpress-plugin-template/admin
*/

namespace RemarkShortcodePrlugin;

class Remark_Shortcode {


  public function __construct() {
    add_shortcode('remark',array($this, 'shortcode'));
  }

  public function shortcode($atts = [], $content = '', $tag) {

    // handle shortcodes attributes
    $atts = array_change_key_case((array)$atts, CASE_LOWER);
    /*
    $remark_atts = shortcode_atts(
      array('author' => 'Unknown author'),
      $atts,$tag
    );
    */

    //handle content
    if ( $content != null ) {
        $author = $atts['author'] != null ? $atts['author'] : '';
        $source = $atts['source'] != null ? $atts['source'] : '';
        $link   = $atts['link'] != null ? $atts['link'] : '';
        $link_name = $atts['link_name'] != null ? $atts['link_name'] : '';

        // parse a content
        return  Remark_Shortcode_Parser::parse(
            file_get_contents(dirname(__FILE__) . "/partial/remark-shortcode-view.twig"),
            array('content' => $content,
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
