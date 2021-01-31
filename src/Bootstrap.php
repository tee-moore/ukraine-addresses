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
use UkraineAddresses\Base\Ajax;
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
            $this->defineAssetsHooks();
            $this->defineLocaleHooks();
            $this->defineContactFormTag();
            $this->defineAdminHooks();
            $this->defineAjax();
        }

        private function defineAssetsHooks()
        {
            (new Assets)->addHook();
        }

        /**
         * Define the locale for this plugin for internationalization.
         */
        private function defineLocaleHooks()
        {
            (new Translator)->addHook();
        }

        /**
         * Register all of the hooks related to the
         */
        private function defineContactFormTag()
        {
            (new AddressTag)->addHook();
        }

        /**
         * Register all of the hooks related to the admin area functionality
         * of the plugin.
         */
        private function defineAdminHooks()
        {
            (new Admin)->addHook();
        }

        /**
         * Register all of the hooks related to the Ajax functionality
         * of the plugin.
         */
        private function defineAjax()
        {
            (new Ajax())->addHook();
        }
    }
}