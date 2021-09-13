<?php
/**
 * Fired during plugin activation
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Low_Key_Toolbar
 * @subpackage Low_Key_Toolbar/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Low_Key_Toolbar
 * @subpackage Low_Key_Toolbar/includes
 * @author     Makoto Nakao<info@free-leaf.com>
 */
class Low_Key_Toolbar_Activator {

	/**
	 * Initialize plugin options.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		$lkb_defaults = apply_filters(
			'lkb_defaults',
			array(
				'opacity' => LOW_KEY_TOOLBAR_OPACITY,
				'scale'   => LOW_KEY_TOOLBAR_SCALE,
				'margin'  => LOW_KEY_TOOLBAR_MARGIN,
				'on_flg'  => LOW_KEY_TOOLBAR_ON_FLG,
			)
		);

		foreach ( $lkb_defaults as $key => $value ) {
			$key_name = 'low_key_toolbar_' . $key;
			if ( ! get_option( $key_name ) ) {
				add_option( $key_name, $value );
			}
		}
	}
}
