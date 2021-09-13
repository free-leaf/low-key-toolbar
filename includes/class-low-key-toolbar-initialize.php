<?php
/**
 * Initialize options for the plugin
 *
 * @since      1.0.0
 *
 * @package    Low_Key_Toolbar
 * @subpackage Low_Key_Toolbar/includes
 */

/**
 * Save initaial values to option for the plugin.
 *
 * @package    Low_Key_Toolbar
 * @subpackage Low_Key_Toolbar/includes
 * @author     Makoto Nakao<info@free-leaf.com>
 */
class Low_Key_Toolbar_Initializer {
	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}


	/**
	 * Initialize the collections used to maintain the actions and filters.
	 *
	 * @since    1.0.0
	 */
	public function initialize() {

	}
}
