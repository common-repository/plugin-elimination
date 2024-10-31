<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://ghostinajar.me/software/plugin-elimination/
 * @since      .9
 *
 * @package    Plugin_Elimination
 * @subpackage Plugin_Elimination/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Plugin_Elimination
 * @subpackage Plugin_Elimination/admin
 * @author     ghostinajar <support@ghostinajar.me>
 */
class Plugin_Elimination_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    .9
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    .9
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    .9
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    .9
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Elimination_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Elimination_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    .9
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Elimination_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Elimination_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Disable all active plugins.
	 */
	public function save_all_plugins() {
		$this->store_active_plugins();
		wp_die();
	}

	/**
	 * Enable all stored plugins.
	 */
	public function restore_all_plugins() {
		$plugins = get_transient('pelim_active_plugins');
		activate_plugins( $plugins, $redirect = '', $network_wide = false, $silent = true );
		delete_transient('pelim_active_plugins');


		error_log('Plugins Restored');
		wp_die();
	}

	/**
	 * Enable all stored plugins.
	 */
	public function deactivate_all_plugins() {
		$plugins = get_transient('pelim_active_plugins');
		deactivate_plugins( $plugins, $silent = true, $network_wide = null );
		error_log('Plugins Deactivated');
		wp_die();
	}

	/**
	 *
	 */
	public function add_button() {

		$button = $this->show_button();
		if ($button === '') return;

		echo sprintf(
			'<div class="pelim_button_container">%s</div>',
			$button
		);
	}

	/**  Functions below this line   */

	public function has_active_plugins($active) {
		if(in_array('plugin-elimination/plugin-elimination.php', $active) && count($active) > 1) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Determine how to display our button.
	 * @return string
	 */
	public function show_button() {

		$active = get_option('active_plugins', array());
		$active_trans = get_transient('pelim_active_plugins');
		$button = '';

		//if more than 1 active [not just us]
		if ( count($active) > 1 && empty($active_trans)){
			return '<a href="#" class="pelim-button save">' . __('Save All Active Plugins', $this->plugin_name) . '</a>';
		}

		//if there are plugins in transient
		if (!empty($active_trans) && $this->has_active_plugins($active) ) {
			return '<a href="#" class="pelim-button deactivate">' . __('Deactivate Plugins (temporarily)', $this->plugin_name) . '</a>';
		}

		//items are in transient
		if ( !empty($active_trans) ) {
			return '<a href="#" class="pelim-button restore">' . __('Restore Active Plugins', $this->plugin_name) . '</a>';
		}

		return $button;
	}

	/**
	 * Get current active plugins and store in transient.
	 */
	public function store_active_plugins() {
		$active = get_option('active_plugins', array());

		// don't store ourselves, that would be messy
		if (($key = array_search('plugin-elimination/plugin-elimination.php', $active)) !== false) {
			unset($active[$key]);
		}
		set_transient('pelim_active_plugins', $active);
	}


}
