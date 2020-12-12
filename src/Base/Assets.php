<?php

namespace UkraineAddresses\Base;

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 */
class Assets
{
    public function addHook()
    {
        // for admin side
        add_action('admin_enqueue_scripts', [$this, 'admin_enqueue_scripts']);
        add_action('admin_enqueue_scripts', [$this, 'admin_enqueue_styles']);

        // for public side
        add_action('wp_enqueue_scripts', [$this, 'public_enqueue_scripts']);
        add_action('wp_enqueue_scripts', [$this, 'public_enqueue_styles']);
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     */
    public function public_enqueue_styles()
    {
        wp_enqueue_style(
            UA_PLUGIN_DOMAIN . 'public-style',
            UA_PLUGIN_URL . 'assets/css/ukraine-addresses-public.css',
            [],
            UA_PLUGIN_VERSION,
            'all'
        );
    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     */
    public function public_enqueue_scripts()
    {
        wp_enqueue_script(
            UA_PLUGIN_DOMAIN . 'public-script',
            UA_PLUGIN_URL . 'assets/js/ukraine-addresses-public.js',
            ['jquery'],
            UA_PLUGIN_VERSION,
            false
        );
    }

    /**
     * Register the stylesheets for the admin area.
     */
    public function admin_enqueue_styles()
    {
        wp_enqueue_style(
            UA_PLUGIN_DOMAIN . 'admin-style',
            UA_PLUGIN_URL . 'assets/css/ukraine-addresses-admin.css',
            [],
            UA_PLUGIN_VERSION,
            'all'
        );
    }

    /**
     * Register the JavaScript for the admin area.
     */
    public function admin_enqueue_scripts()
    {
        wp_enqueue_script(
            UA_PLUGIN_DOMAIN . 'admin-script',
            UA_PLUGIN_URL . 'assets/js/ukraine-addresses-admin.js',
            ['jquery'],
            UA_PLUGIN_VERSION,
            true
        );
    }
}
