<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Ukraine_Addresses
 * @subpackage Ukraine_Addresses/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Ukraine_Addresses
 * @subpackage Ukraine_Addresses/admin
 * @author     Your Name <email@example.com>
 */
class Ukraine_Addresses_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $ukraine_addresses    The ID of this plugin.
	 */
	private $ukraine_addresses;

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
	 * @param      string    $ukraine_addresses       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $ukraine_addresses, $version ) {

		$this->ukraine_addresses = $ukraine_addresses;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

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

		wp_enqueue_style( $this->ukraine_addresses, plugin_dir_url( __FILE__ ) . 'css/ukraine-addresses-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

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

		wp_enqueue_script( $this->ukraine_addresses, plugin_dir_url( __FILE__ ) . 'js/ukraine-addresses-admin.js', array( 'jquery' ), $this->version, false );

	}

}
