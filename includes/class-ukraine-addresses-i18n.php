<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Ukraine_Addresses
 * @subpackage Ukraine_Addresses/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Ukraine_Addresses
 * @subpackage Ukraine_Addresses/includes
 * @author     Your Name <email@example.com>
 */
class Ukraine_Addresses_i18n
{
    /**
     * The current domain of the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string $domain The current domain of the plugin.
     */
    protected $domain;

    /**
     * Initialize the plugins domain
     *
     * @since    1.0.0
     */
    public function __construct()
    {
        $this->domain = defined('UKRAINE_ADDRESSES_DOMAIN') ? UKRAINE_ADDRESSES_DOMAIN : 'ukraine-addresses';
    }

    /**
     * Load the plugin text domain for translation.
     *
     * @since    1.0.0
     */
    public function load_plugin_textdomain()
    {
        load_plugin_textdomain(
            $this->domain,
            false,
            dirname(dirname(plugin_basename(__FILE__))) . '/languages/'
        );
    }
}
