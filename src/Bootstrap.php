<?php
/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Ukraine_Addresses
 * @subpackage Ukraine_Addresses/src
 * @author     Your Name <email@example.com>
 */
namespace UkraineAddresses;

use UkraineAddresses\Base\Activator;
use UkraineAddresses\Base\AddressTag;
use UkraineAddresses\Base\Assets;
use UkraineAddresses\Base\Deactivator;
use UkraineAddresses\Base\Translator;
use UkraineAddresses\Base\Admin;

defined('WPINC') or die;

if (!class_exists( Bootstrap::class)) {
    final class Bootstrap
    {
        /**
         * Run UkraineAddresses plugin
         */
        public function run()
        {
            $this->define_activation_and_deactivation_hooks();
            $this->define_assets_hooks();
            $this->define_locale();
            $this->define_admin_hooks();
            $this->define_public_hooks();
        }

        /**
         * Fired during plugin activation and deactivation.
         */
        private function define_activation_and_deactivation_hooks()
        {
            register_activation_hook(Activator::class, 'activate');
            register_deactivation_hook(Deactivator::class, 'deactivate');
        }

        private function define_assets_hooks()
        {
            (new Assets)->addHook();
        }

        /**
         * Define the locale for this plugin for internationalization.
         */
        private function define_locale()
        {
            (new Translator)->addHook();
        }

        /**
         * Register all of the hooks related to the admin area functionality
         * of the plugin.
         */
        private function define_admin_hooks()
        {
            (new Admin)->addHook();
        }

        /**
         * Register all of the hooks related to the public-facing functionality
         * of the plugin.
         */
        private function define_public_hooks()
        {
            (new AddressTag)->addHook();
        }
    }
}