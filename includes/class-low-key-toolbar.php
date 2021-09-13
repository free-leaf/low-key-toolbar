<?php
/**
 * The file that defines the core plugin class
 *
 * @since      1.0.0
 *
 * @package    Low_Key_Toolbar
 * @subpackage Low_Key_Toolbar/includes
 */

/**
 * The core plugin class.
 *
 * @since      1.0.0
 * @package    Low_Key_Toolbar
 * @subpackage Low_Key_Toolbar/includes
 * @author     Makoto Nakao <info@free-leaf.org>
 */
class Low_Key_Toolbar {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Low_Key_Toolbar_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'LOW_KEY_TOOLBAR_VERSION' ) ) {
			$this->version = LOW_KEY_TOOLBAR_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'low-key-toolbar';

		$this->load_dependencies();
		$this->set_locale();
		// $this->set_initial_value();
		$this->define_admin_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Low_Key_Toolbar_Loader. Orchestrates the hooks of the plugin.
	 * - Low_Key_Toolbar_i18n. Defines internationalization functionality.
	 * - Low_Key_Toolbar_Admin. Defines all hooks for the admin area.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-low-key-toolbar-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-low-key-toolbar-i18n.php';

		/**
		 * The class responsible for defining initail values of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-low-key-toolbar-initialize.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-low-key-toolbar-admin.php';

		$this->loader = new Low_Key_Toolbar_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Low_Key_Toolbar_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Low_Key_Toolbar_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
		$this->loader->add_action( 'enqueue_block_editor_assets', $plugin_i18n, 'set_script_translations' );


	}

	/**
	 * Register initaial option values of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_initial_value() {

		$plugin_admin = new Low_Key_Toolbar_Initializer( $this->get_low_key_toolbar(), $this->get_version() );

		$this->loader->add_action( 'init', $plugin_admin, 'initialize' );
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Low_Key_Toolbar_Admin( $this->get_low_key_toolbar(), $this->get_version() );

		$this->loader->add_action( 'init', $plugin_admin, 'register_options' );
		$this->loader->add_action( 'init', $plugin_admin, 'create_block_init' );
		$this->loader->add_filter( 'admin_body_class', $plugin_admin, 'add_admin_body_class' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_inline_style' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'option_to_js_variable' );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_low_key_toolbar() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Low_Key_Toolbar_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
