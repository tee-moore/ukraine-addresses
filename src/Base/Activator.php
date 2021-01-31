<?php

namespace UkraineAddresses\Base;

class Activator
{
    /**
     * Add default options during plugin activation
     */
    public function activate()
    {
        flush_rewrite_rules();

        if (get_option('ukraine_addresses_settings')) {
            return;
        }

        $defaultOptions = [
            'caption_type' => 'placeholder',
            'caption_level_one' => __('One', 'ua'),
            'caption_level_two' => __('Two', 'ua'),
            'caption_level_three' => __('Three', 'ua'),
            'caption_level_streets' => __('Streets', 'ua'),
            'caption_level_addresses' => __('Addresses', 'ua'),
            'ua_autoshow_selects' => 1,
        ];

        update_option('ukraine_addresses_settings', $defaultOptions);
    }
}
