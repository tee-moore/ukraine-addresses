<?php

namespace UkraineAddresses\Base;

class Admin
{
    public function addHook()
    {
        add_action('admin_menu', [$this, 'add_settings_page']);
        add_filter('plugin_action_links_' . UA_PLUGIN_NAME, [$this, 'add_settings_link']);
    }

    public function add_settings_page()
    {
        add_options_page(
            __('UA Addresses', 'ua'),
            __('UA Addresses', 'ua'),
            'manage_options',
            UA_PLUGIN_ADMIN_SLUG,
            [$this, 'render_settings_page']
        );
    }

    public function render_settings_page()
    {
        require_once UA_PLUGIN_PATH . 'templates/settings.php';
    }

    public function add_settings_link($links)
    {
        $text = __('Settings', 'ua');
        $slug = UA_PLUGIN_ADMIN_SLUG;
        $link = "<a href='options-general.php?page=%s'>%s</a>";
        $settings_link = sprintf($link, $slug, $text);
        array_unshift( $links, $settings_link );

        return $links;
    }
}