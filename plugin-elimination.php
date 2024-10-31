<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://ghostinajar.me/software/plugin-elimination/
 * @since             .9
 * @package           Plugin_Elimination
 *
 * @wordpress-plugin
 * Plugin Name:       Plugin Elimination
 * Plugin URI:        ghostinajar.me
 * Description:       Easily save/restore all currently active plugins while doing plugin elimination testing.
 * Version:           .9
 * Author:            ghostinajar
 * Author URI:        http://ghostinajar.me/software/plugin-elimination/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       plugin-elimination
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version .9 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_ELIMINATION_VERSION', '.9' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/core.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    .9
 */
function run_plugin_elimination() {
	$plugin = new Plugin_Elimination();
}
run_plugin_elimination();
