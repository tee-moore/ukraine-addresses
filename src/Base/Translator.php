<?php

namespace UkraineAddresses\Base;

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 */
class Translator
{
    public function addHook()
    {
        add_action('plugins_loaded', [$this, 'load_plugin_text_domain']);
    }

    /**
     * Load the plugin text domain for translation.
     */
    public function load_plugin_text_domain()
    {
        load_plugin_textdomain(
            UA_PLUGIN_DOMAIN,
            false,
            UA_PLUGIN_PATH . 'languages/'
        );
    }
}
