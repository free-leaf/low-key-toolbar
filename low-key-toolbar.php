<?php
/**
 * Plugin Name:       Low-Key Toolbar
 * Description:       This plugin add translucent option to block editor toolbar.
 * Requires at least: 5.7
 * Requires PHP:      7.4
 * Version:           1.1.0
 * Author:            Makoto Nakao
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       low-key-toolbar
 * Domain Path        /languages
 *
 * @package           create-block
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Define constant value.
 */
define( 'LOW_KEY_TOOLBAR_VERSION', '1.0.1' );
define( 'LOW_KEY_TOOLBAR_OPACITY', 0.4 );
define( 'LOW_KEY_TOOLBAR_SCALE', 0.6 );
define( 'LOW_KEY_TOOLBAR_MARGIN', 0 ); // default margin
define( 'LOW_KEY_TOOLBAR_ON_FLG', false );
define( 'LOW_KEY_TOOLBAR_PATH', untrailingslashit( plugin_dir_path( __FILE__ ) ) );

/**
 * The code that runs during plugin activation.
 */
function activate_low_key_toolbar() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-low-key-toolbar-activator.php';
	Low_Key_Toolbar_Activator::activate();
}

/**
 * The core plugin class
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-low-key-toolbar.php';

/**
 * Begins execution of the plugin.
 *
 * @since    1.0.0
 */
function run_low_key_toolbar() {

	$plugin = new Low_Key_Toolbar();
	$plugin->run();

}
run_low_key_toolbar();
