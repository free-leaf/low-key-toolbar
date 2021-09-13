<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * @since      1.0.0
 *
 * @package    Low-Key-Toolbar
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

$options = array(
	'opacity',
	'scale',
	'on_flg',
	'margin',
);

foreach ( $options as $value ) {
	delete_option( 'low_key_toolbar_' . $value );
}
