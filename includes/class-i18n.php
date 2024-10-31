<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://ghostinajar.me/software/plugin-elimination/
 * @since      .9
 *
 * @package    Plugin_Elimination
 * @subpackage Plugin_Elimination/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      .9
 * @package    Plugin_Elimination
 * @subpackage Plugin_Elimination/includes
 * @author     ghostinajar <support@ghostinajar.me>
 */
class Plugin_Elimination_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    .9
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'plugin-elimination',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
