<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Low_Key_Toolbar
 * @subpackage Low_Key_Toolbar/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Low_Key_Toolbar
 * @subpackage Low_Key_Toolbar/includes
 * @author     Makoto Nakao<info@free-leaf.com>
 */
class Low_Key_Toolbar_i18n {

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'low-key-toolbar',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}

	/**
	 * set translations script
	 *
	 * @return void
	 */
	public function set_script_translations() {
		wp_set_script_translations(
			'low-key-toolbar',
			'low-key-toolbar',
			LOW_KEY_TOOLBAR_PATH . '/languages'
		);
	}
}
