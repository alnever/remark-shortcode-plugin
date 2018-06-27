<?php
/*
Plugin Name: Remark Shortcode Plugin
Plugin Uri: https://github.com/alnever/remark-shortcode-plugin
Description: Adds a shortcode to include remarks into texts
Version: 1.0
Author: Alex Neverov
Author URI: http://alneverov.ru

License: GPL2

    Copyright 2018 Alex Neverov

    This program is free software; you can redistribute it and/or
    modify it under the terms of the GNU General Public License,
    version 2, as published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

*/

namespace RemarkShortcodePlugin;

/*
  Autoload function
*/
spl_autoload_register(
  function ($class_name) {
    if ( ! class_exists($class_name, FALSE) && strstr($class_name, __NAMESPACE__) !== FALSE )
    { 
      $class_name = str_replace(__NAMESPACE__."\\","",$class_name);
      $class_name = strtolower($class_name);
      $class_name = str_replace("_","-",$class_name);
      $class_name = str_replace("\\","/",$class_name);
      include $class_name . ".php";
    }
  }
);

class Remark_Shortcode_Plugin {

  private $shortcode;
  private $admin;

  public function __construct() {
    if (is_admin()) {
      // register admin part
      $this->admin = new Admin\Remark_Shortcode_Plugin_Admin();  
    } else {
      // register front-end part
      $this->shortcode = new Remark_Shortcode();
    }
  }
}

new Remark_Shortcode_Plugin();
