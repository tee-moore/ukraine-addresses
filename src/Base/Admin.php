<?php

namespace UkraineAddresses\Base;

class Admin
{
    public function addHook()
    {
        add_action('admin_menu', [$this, 'addSettingsPage']);
        add_filter('plugin_action_links_' . UA_PLUGIN_NAME, [$this, 'addSettingsLink']);
        add_action('admin_init', [$this, 'addTokenSettingsFields']);
        add_action('admin_init', [$this, 'addLabelSettingsFields']);
        add_action('admin_init', [$this, 'addAutoShowSettingsFields']);
    }

    public function addSettingsPage()
    {
        add_options_page(
            __('UA Addresses', 'ua'),
            __('UA Addresses', 'ua'),
            'manage_options',
            UA_PLUGIN_ADMIN_SLUG,
            function () {
                return Template::render('settings');
            }
        );
    }

    public function addSettingsLink($links)
    {
        $text = __('Settings', 'ua');
        $slug = UA_PLUGIN_ADMIN_SLUG;
        $link = '<a href="options-general.php?page=%s">%s</a>';
        $settings_link = sprintf($link, $slug, $text);
        array_unshift($links, $settings_link);

        return $links;
    }

    public function addTokenSettingsFields()
    {
        register_setting('ua-plugin-settings', 'ukraine_addresses_settings');
        register_setting('ua-plugin-settings', 'ukraine_addresses_secret_token');
        register_setting('ua-plugin-settings', 'ukraine_addresses_refresh_token');

        add_settings_section(
            'ua-api-tokens-settings',
            __('API Tokens Settings', 'ua'),
            function () {
                $link = '<a href="address.ua" target="_blank">address.ua</a>';
                $description = __('Get secret tokens on %s website and insert them into the fields below. 
                                   <br>Plugin receives addresses from API. Without tokens, 
                                   the plugin will not be able to receive addresses data.');
                echo sprintf($description, $link);
            },
            UA_PLUGIN_ADMIN_SLUG
        );

        add_settings_field(
            'ukraine-addresses-secret-token',
            __('Secret token', 'ua'),
            function () {
                $value = esc_attr(get_option('ukraine_addresses_secret_token'));
                echo "<input type='text' name='ukraine_addresses_secret_token' class='regular-text' value='$value' />";
            },
            UA_PLUGIN_ADMIN_SLUG,
            'ua-api-tokens-settings'
        );

        add_settings_field(
            'ukraine-addresses-refresh-token',
            __('Refresh token', 'ua'),
            function () {
                $value = esc_attr(get_option('ukraine_addresses_refresh_token'));
                echo "<input type='text' name='ukraine_addresses_refresh_token' class='regular-text' value='$value' />";
            },
            UA_PLUGIN_ADMIN_SLUG,
            'ua-api-tokens-settings'
        );
    }

    public function addLabelSettingsFields()
    {
        add_settings_section(
            'ua-api-caption-settings',
            __('Captions Settings', 'ua'),
            function () {
                echo __('Select the caption type for the address fields and fill in the fields below
                 as you would like to name them.');
            },
            UA_PLUGIN_ADMIN_SLUG
        );

        add_settings_field(
            'caption-type',
            __('Captions type', 'ua'),
            function () {
                $placeholderChecked = $labelChecked = '';
                $value = Helper::getValue('caption_type');

                if ($value == 'placeholder') {
                    $placeholderChecked = 'checked';
                } elseif ($value == 'label') {
                    $labelChecked = 'checked';
                }

                echo "<fieldset><label>
                            <input type='radio' name='ukraine_addresses_settings[caption_type]' value='placeholder' $placeholderChecked/>
                            <span>" . __('Placeholders', 'ua') . "</span>
                      </label><br>";
                echo "<label>
                            <input type='radio' name='ukraine_addresses_settings[caption_type]' value='label' $labelChecked/>
                            <span>" . __('Labels', 'ua') . "</span>
                      </label></fieldset>";
            },
            UA_PLUGIN_ADMIN_SLUG,
            'ua-api-caption-settings'
        );

        add_settings_field(
            'caption-level-one',
            __('Caption for level one', 'ua'),
            function () {
                $value = Helper::getValue('caption_level_one');
                echo "<input type='text' name='ukraine_addresses_settings[caption_level_one]' class='regular-text' value='$value' />";
            },
            UA_PLUGIN_ADMIN_SLUG,
            'ua-api-caption-settings'
        );
        add_settings_field(
            'caption-level-two',
            __('Caption for level two', 'ua'),
            function () {
                $value = Helper::getValue('caption_level_two');
                echo "<input type='text' name='ukraine_addresses_settings[caption_level_two]' class='regular-text' value='$value' />";
            },
            UA_PLUGIN_ADMIN_SLUG,
            'ua-api-caption-settings'
        );
        add_settings_field(
            'caption-level-three',
            __('Caption for level three', 'ua'),
            function () {
                $value = Helper::getValue('caption_level_three');
                echo "<input type='text' name='ukraine_addresses_settings[caption_level_three]' class='regular-text' value='$value' />";
            },
            UA_PLUGIN_ADMIN_SLUG,
            'ua-api-caption-settings'
        );
        add_settings_field(
            'caption-level-streets',
            __('Caption for streets', 'ua'),
            function () {
                $value = Helper::getValue('caption_level_streets');
                echo "<input type='text' name='ukraine_addresses_settings[caption_level_streets]' class='regular-text' value='$value' />";
            },
            UA_PLUGIN_ADMIN_SLUG,
            'ua-api-caption-settings'
        );
        add_settings_field(
            'caption-level-addresses',
            __('Caption for addresses', 'ua'),
            function () {
                $value = Helper::getValue('caption_level_addresses');
                echo "<input type='text' name='ukraine_addresses_settings[caption_level_addresses]' class='regular-text' value='$value' />";
            },
            UA_PLUGIN_ADMIN_SLUG,
            'ua-api-caption-settings'
        );
        add_settings_field(
            'caption-level-room',
            __('Caption for room', 'ua'),
            function () {
                $value = Helper::getValue('caption_level_room');
                echo "<input type='text' name='ukraine_addresses_settings[caption_level_room]' class='regular-text' value='$value' />";
            },
            UA_PLUGIN_ADMIN_SLUG,
            'ua-api-caption-settings'
        );
    }

    public function addAutoShowSettingsFields()
    {
        add_settings_section(
            'ua-api-autoshow-settings',
            __('Field display rules', 'ua'),
            function () {
                echo __('Show all fields with addresses at once or load the required field as you select.');
            },
            UA_PLUGIN_ADMIN_SLUG
        );

        add_settings_field(
            'ua-autoshow-selects',
            __('Auto show selects', 'ua'),
            function () {
                $value = Helper::getValue('ua_autoshow_selects');
                $checked = ($value) ? 'checked' : '';
                echo "<input type='checkbox' name='ukraine_addresses_settings[ua_autoshow_selects]' value='1' $checked/>";
            },
            UA_PLUGIN_ADMIN_SLUG,
            'ua-api-autoshow-settings'
        );

        add_settings_field(
            'ua-required-fields',
            __('All fields required', 'ua'),
            function () {
                $value = Helper::getValue('ua_required_fields');
                $checked = ($value) ? 'checked' : '';
                echo "<input type='checkbox' name='ukraine_addresses_settings[ua_required_fields]' value='1' $checked/>";
            },
            UA_PLUGIN_ADMIN_SLUG,
            'ua-api-autoshow-settings'
        );
    }
}