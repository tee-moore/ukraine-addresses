<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @wordpress-plugin
 * Plugin Name: Ukraine Addresses
 * Plugin URI:  https://wordpress.org/address
 * Description: The plugin helps to work with the addresses of Ukraine by adding fields to the plugin Contact Form 7. The data source is API address.ua
 * Version:     1.0.0
 * Author:      wplabs
 * Author URI:  https://wplabs.com
 * Text Domain: ukraine-addresses
 * Domain Path: /languages
 * Requires at least: 5,6
 * Requires PHP: 7.0
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

use UkraineAddresses\Base\Activator;
use UkraineAddresses\Base\Deactivator;

/**
 * If this file is called directly, abort.
 */
defined('WPINC') || die();

/**
 * Require composer autoload file.
 */
if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
    require_once dirname(__FILE__) . '/vendor/autoload.php';
}

/**
 * Define constants.
 */
define('UA_PLUGIN_NAME', plugin_basename(__FILE__));
define('UA_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('UA_PLUGIN_URL', plugin_dir_url(__FILE__));
define('UA_PLUGIN_VERSION', '1.0.0');
define('UA_PLUGIN_DOMAIN', 'ua');
define('UA_PLUGIN_ADMIN_SLUG', 'ukraine-addresses-settings');
define('UA_PLUGIN_TAMPLATE_PATH', UA_PLUGIN_PATH . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR);

/**
 * Fired during plugin activation and deactivation.
 */
register_activation_hook(__FILE__, [Activator::class, 'activate']);
register_deactivation_hook(__FILE__, [Deactivator::class, 'deactivate']);

/**
 * Begins execution of the plugin.
 */
(new \UkraineAddresses\Bootstrap())->run();
