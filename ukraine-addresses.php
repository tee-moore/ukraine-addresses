<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           Ukraine_Addresses
 *
 * @wordpress-plugin
 * Plugin Name: Ukraine Addresses for CF7
 * Plugin URI:  https://wordpress.org/address
 * Description: The plugin helps to work with the addresses of Ukraine by adding fields to the plugin Contact Form 7. The data source is API address.ua
 * Version:     1.0.0
 * Author:      wplabs
 * Author URI:  https://wplabs.com
 * Text Domain: address
 * Domain Path: /languages
 * Requires at least: 5.0
 * Requires PHP: 7.0
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'UKRAINE_ADDRESSES_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-ukraine-addresses-activator.php
 */
function activate_ukraine_addresses() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ukraine-addresses-activator.php';
	Ukraine_Addresses_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-ukraine-addresses-deactivator.php
 */
function deactivate_ukraine_addresses() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ukraine-addresses-deactivator.php';
	Ukraine_Addresses_Deactivator::deactivate();
}

/**
 * The code that runs during plugin removal.
 * This action is documented in includes/class-ukraine-addresses-uninstaller.php
 */
function uninstall_ukraine_addresses() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-ukraine-addresses-uninstaller.php';
    Ukraine_Addresses_Uninstaller::uninstall();
}

register_activation_hook( __FILE__, 'activate_ukraine_addresses' );
register_deactivation_hook( __FILE__, 'deactivate_ukraine_addresses' );
register_uninstall_hook(__FILE__, 'uninstall_ukraine_addresses' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-ukraine-addresses.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_ukraine_addresses() {

	$plugin = new Ukraine_Addresses();
	$plugin->run();

}
run_ukraine_addresses();
