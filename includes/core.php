<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://ghostinajar.me/software/plugin-elimination/
 * @since      .9
 *
 * @package    Plugin_Elimination
 * @subpackage Plugin_Elimination/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      .9
 * @package    Plugin_Elimination
 * @subpackage Plugin_Elimination/includes
 * @author     ghostinajar <support@ghostinajar.me>
 */
class Plugin_Elimination {

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    .9
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    .9
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
	 * @since    .9
	 */
	public function __construct() {
		if ( defined( 'PLUGIN_ELIMINATION_VERSION' ) ) {
			$this->version = PLUGIN_ELIMINATION_VERSION;
		} else {
			$this->version = '.9';
		}
		$this->plugin_name = 'plugin-elimination';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Plugin_Elimination_Loader. Orchestrates the hooks of the plugin.
	 * - Plugin_Elimination_i18n. Defines internationalization functionality.
	 * - Plugin_Elimination_Admin. Defines all hooks for the admin area.
	 * - Plugin_Elimination_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    .9
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-admin.php';

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Plugin_Elimination_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    .9
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Plugin_Elimination_i18n();

		add_action( 'plugins_loaded', array($plugin_i18n, 'load_plugin_textdomain') );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    .9
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Plugin_Elimination_Admin( $this->get_plugin_name(), $this->get_version() );

		add_action( 'admin_enqueue_scripts', array($plugin_admin, 'enqueue_styles') );
		add_action( 'admin_enqueue_scripts', array($plugin_admin, 'enqueue_scripts') );

		add_action( 'pre_current_active_plugins', array($plugin_admin, 'add_button') );

		add_action( 'wp_ajax_pelim_save_plugins', array($plugin_admin, 'save_all_plugins') );
		add_action( 'wp_ajax_pelim_restore_plugins', array($plugin_admin, 'restore_all_plugins') );
		add_action( 'wp_ajax_pelim_deactivate_plugins', array($plugin_admin, 'deactivate_all_plugins') );

	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     .9
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     .9
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
