<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Ukraine_Addresses
 * @subpackage Ukraine_Addresses/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Ukraine_Addresses
 * @subpackage Ukraine_Addresses/public
 * @author     Your Name <email@example.com>
 */
class Ukraine_Addresses_Public
{
    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $ukraine_addresses The ID of this plugin.
     */
    private $name_plugin;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    private $version_plugin;

    /**
     * Initialize the class and set its properties.
     *
     * @param string $ukraine_addresses The name of the plugin.
     * @param string $version The version of this plugin.
     * @since    1.0.0
     */
    public function __construct($name, $version)
    {
        $this->name_plugin = $name;
        $this->version_plugin = $version;
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {
        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Ukraine_Addresses_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Ukraine_Addresses_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style($this->name_plugin,
            plugin_dir_url(__FILE__) . 'css/ukraine-addresses-public.css',
            [],
            $this->version_plugin,
            'all'
        );
    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {
        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Ukraine_Addresses_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Ukraine_Addresses_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script($this->name_plugin,
            plugin_dir_url(__FILE__) . 'js/ukraine-addresses-public.js',
            ['jquery'],
            $this->version_plugin,
            false
        );
    }
}
