<?php

/*
 * A simpe class to parse twig-like files
 * @link
 * @since 1.1
 *
 * @package remark-shortcode-plugin
 * @subpackage remark-shortcode-plugin/admin
*/

namespace RemarkShortcodePlugin\Admin;

/*

	Remark Shortcode Plugin Settings Page

*/

class Remark_Shortcode_Plugin_Admin {

	// plugin options
	private $options;


	public function __construct() {
		// register admin setting page
	    add_action('admin_menu',array($this, 'add_plugin_page'));
	    // register pluging settings
	    add_action('admin_init',array($this, 'register_plugin_settings'));

	}

	/*
		This function defines all plugin options
	*/
	public function register_plugin_settings() {
		// Register settings for the plugin
		register_setting(
			'remark_shortcode_options_group', // valid options group name
			'remark_shortcode_options' // name of the options group
		);

		// Add new section into the plugin options
		add_settings_section(
			'remark_shortcode_options_section', // name of the settings section
			'Remark Shortcode Settings', // section name
			array($this, 'settings_section'), // callback function - executed when a section shows on the settings page
			'remark-settings-admin' // page, on which the section should be shown
		);
		
		// Add a option field to the section
		add_settings_field(
			'custom_css',	// field ID
			'Custom CSS',   // Field name aka subscription 
			array($this, 'custom_css_view'), // Callback function - to show the field
			'remark-settings-admin', // page, on which the field shoud be shown
			'remark_shortcode_options_section' // the section, in which the field is included
		);
	}	

	// Add an options page into the Settings menu of the WordPress admin panel
	public function add_plugin_page() {
		add_options_page (
			'Remark Shortcode Options', // Page title
			'Remark Shortcode Options', // Menu title
			'manage_options', // capabilities - who can use the page
			'remark-settings-admin', // menu slug
			array($this,'create_admin_page') // call back function
		);
	}	

	// Call back function for the menu
	public function create_admin_page() {
		// Get options of the plugin by the slug
		$this->options = get_option('remark_shortcode_options'); 
        ?>
        <div class="wrap">
            <h1>Remark Shortcode Plugin</h1>
            <form method="post" action="options.php">
            <?php
                // Output settings fields
                settings_fields( 'remark_shortcode_options_group' );
                // Do the settings section
                do_settings_sections( 'remark-settings-admin' );
                // Crete a submit button
                submit_button();
            ?>
            </form>
        </div>
        <?php		
	}

	// Output the section on demand
	public function settings_section() {
		print '<p>Enter your custom CSS into the field below.</p>';
		print '<p style="color:red; font-weigh: bolder">Caution! Just expierncies user shoud use this option!</p>';
	}

	// output the field for editing the option / on demand
	public function custom_css_view() {
        printf(
            '<textarea id="custom_css" name="remark_shortcode_options[custom_css]" style="width:800px; height:400px;">%s</textarea>',
            isset( $this->options['custom_css'] ) ? esc_attr( $this->options['custom_css']) : ''
        );
	}


}

?>