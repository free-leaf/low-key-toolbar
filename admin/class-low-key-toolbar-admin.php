<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Low_Key_Toolbar
 * @subpackage Low_Key_Toolbar/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Low_Key_Toolbar
 * @subpackage Low_Key_Toolbar/admin
 * @author     Makoto Nakao<info@free-leaf.com>
 */
class Low_Key_Toolbar_Admin {

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
	 * Register options
	 *
	 * @since 1.0.0
	 */
	public function register_options() {

		/*
		register_setting(
			$this->plugin_name,
			$this->plugin_name,
			array(
				'type'              => 'array',
				'show_in_rest'      => array(
					'schema' => array(
						'items' => array(
							'type'       => 'object',
							'properties' => array(
								'opacity' => array(
									'type' => 'number',
								),
								'scale'   => array(
									'type' => 'number',
								),
							),
						),
					),
				),
				'sanitize_callback' => array( $this, 'validate' ),
				'default'           => array(
					'opacity' => LOW_KEY_TOOLBAR_OPACITY,
					'scale'   => LOW_KEY_TOOLBAR_SCALE,
				),
			)
		); */

		$opt_prefix = 'low_key_toolbar_';
		register_setting(
			$this->plugin_name,
			$opt_prefix . 'opacity',
			array(
				'type'              => 'number',
				'show_in_rest'      => true,
				'default'           => LOW_KEY_TOOLBAR_OPACITY,
				'sanitize_callback' => function( $value ) {
					return $this->check_number( $value );
				},
			)
		);
		register_setting(
			$this->plugin_name,
			$opt_prefix . 'scale',
			array(
				'type'              => 'number',
				'show_in_rest'      => true,
				'default'           => LOW_KEY_TOOLBAR_SCALE,
				'sanitize_callback' => function( $value ) {
					return $this->check_number( $value );
				},
			)
		);
		register_setting(
			$this->plugin_name,
			$opt_prefix . 'margin',
			array(
				'type'              => 'number',
				'show_in_rest'      => true,
				'default'           => LOW_KEY_TOOLBAR_MARGIN,
				'sanitize_callback' => function( $value ) {
					return $this->check_margin( $value, LOW_KEY_TOOLBAR_MARGIN );
				},
			)
		);
		register_setting(
			$this->plugin_name,
			$opt_prefix . 'on_flg',
			array(
				'type'         => 'boolean',
				'show_in_rest' => true,
				'default'      => LOW_KEY_TOOLBAR_ON_FLG,
			)
		);
	}

	/**
	 * 入力値を0〜1の間にサニタイズする
	 * もし不正な値の場合は最大値・最小値に設定し直す
	 *
	 * @param float $value 設定値
	 * @return float
	 */
	public function check_number( $value ) {
		$value = (float) $value;

		if ( $value <= 0 ) {
			$value = 0.1;
		} elseif ( $value > 1 ) {
			$value = 1;
		}
		return $value;
	}

	/**
	 * 入力値をサニタイズする
	 * もし不正な値の場合は最大値・最小値に設定し直す
	 *
	 * @param int $value 設定値
	 * @param int $max 最大値
	 * @return int
	 */
	public function check_margin( $value, $max ) {
		$value = (int) $value;

		if ( $value < 0 ) {
			$value = 0;
		} elseif ( $value > $max ) {
			$value = $max;
		}
		return $value;
	}

	/**
	 * ブロックは追加しないがツールバーを表示させるために登録は必要
	 *
	 * @see https://developer.wordpress.org/block-editor/tutorials/block-tutorial/writing-your-first-block-type/
	 */
	public function create_block_init() {
		// Register block editor script for backend.
		// $dependencies = array( 'wp-i18n', 'wp-blocks', 'wp-edit-post', 'wp-element', 'wp-editor', 'wp-components', 'wp-data', 'wp-plugins', 'wp-edit-post' );

		$dependencies = array( 'jquery', 'wp-api', 'wp-components', 'wp-edit-post', 'wp-element', 'wp-i18n', 'wp-plugins', 'wp-polyfill' );

		wp_register_script(
			$this->plugin_name,
			plugins_url( '/build/index.js', dirname( __FILE__ ) ),
			$dependencies,
			filemtime( plugin_dir_path( __DIR__ ) . 'build/index.js' ),
			true
		);

		register_block_type(
			'create-block/low-key-toolbar',
			array(
				'editor_script' => $this->plugin_name,
			)
		);

	}

	/**
	 * Add class to admin body
	 *
	 * @param array $classes admin body classes
	 * @return array
	 */
	public function add_admin_body_class( $classes ) {
		$screen = get_current_screen();
		$on_flg = get_option( 'low_key_toolbar_on_flg' );

		if ( 'edit' === $screen->base || 'post' === $screen->base ) {
			if ( $on_flg ) {
				$classes .= 'low_key_toolbar is_hover_effect';
			} else {
				$classes .= 'low_key_toolbar';
			}
		}
		return $classes;
	}

	/**
	 * Enqueue inline CSS for block editor
	 *
	 * @link https://rfs.jp/sb/wordpress/wp-lab/wp_add_inline_style.html
	 */
	public function enqueue_inline_style() {

		$css = $this->inline_css();

		$depth = array();

		wp_register_style(
			$this->plugin_name . '-inline',
			false,
			$depth,
			$this->version
		);
		wp_enqueue_style( $this->plugin_name . '-inline' );
		wp_add_inline_style( $this->plugin_name . '-inline', $css );
	}

	/**
	 * Inline css for block editor
	 *
	 * @return string
	 */
	public function inline_css() {
		global $post,$pagenow;

		if ( 'post.php' !== $pagenow && 'post-new.php' !== $pagenow ) {
			return;
		}

		if ( apply_filters( 'replace_editor', false, $post ) === true ) {
			return;
		} else {
			if ( function_exists( 'use_block_editor_for_post' ) && ! use_block_editor_for_post( $post ) ) {
				return;
			}
		}

		$opacity = get_option( 'low_key_toolbar_opacity' );
		$scale   = get_option( 'low_key_toolbar_scale' );
		$margin  = get_option( 'low_key_toolbar_margin' );

		ob_start();
		?>
		<style>
			body {
				--toolbar_opacity: <?php echo esc_attr( $opacity ); ?>;
				--toolbar_scale:<?php echo esc_attr( $scale ); ?>;
				--toolbar_margin:<?php echo esc_attr( $margin ); ?>;
			}
			.low_key_toolbar .block-editor-block-contextual-toolbar:not(.is-fixed) {
				opacity : var(--toolbar_opacity);
				transform: scale(var(--toolbar_scale));
				transform-origin: left bottom;
				transition: all 0.2s;
				margin-bottom: calc( var(--toolbar_margin) * 1px )!important;
			}
			.low_key_toolbar.is_hover_effect .block-editor-block-contextual-toolbar:not(.is-fixed):hover {
				transform:scale(1);
			}
			.low_key_toolbar .block-editor-block-contextual-toolbar:not(.is-fixed):hover {
				opacity: 1;
			}
		</style>
		<?php
		$inline_css = ob_get_clean();
		return $this->minify_css( $inline_css );
	}

	/**
	 * Minify CSS
	 *
	 * @link https://bluehacker.net/php%E3%81%A7css%E3%82%92%E5%9C%A7%E7%B8%AE%E3%81%99%E3%82%8B/
	 * @param string $data row css data
	 * @param string $debug Change minify mode
	 * @return string minified css
	 */
	public static function minify_css( $data, $debug = '' ) {
		if ( 'debug' !== $debug ) {
			// Delete comment.
			$data = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $data );

			// Delete space after ':'.
			$data = str_replace( ': ', ':', $data );

			// Delete tabs, spaces, line breaks etc
			$data = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $data );
		}

		// Delete <style> and </style>.
		$data = str_replace( array( '<style>', '</style>' ), '', $data );

		return $data;
	}

	/**
	 * Set option values to js value for block editor
	 *
	 * @return void
	 */
	public function option_to_js_variable() {

		$lktb_var = array(
			'opacity' => get_option( 'low_key_toolbar_opacity' ),
			'scale'   => get_option( 'low_key_toolbar_scale' ),
			'on_flg'  => (bool) get_option( 'low_key_toolbar_on_flg' ),
			'margin'  => get_option( 'low_key_toolbar_margin' ),
		);
		wp_localize_script( $this->plugin_name, 'lktb_opt', $lktb_var );
	}

}
