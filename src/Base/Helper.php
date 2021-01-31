<?php

namespace UkraineAddresses\Base;

class Helper
{
    public static function getValue($name)
    {
        $option = get_option('ukraine_addresses_settings');
        return esc_attr(isset($option[$name]) ? $option[$name] : null);
    }
}