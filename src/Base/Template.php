<?php

namespace UkraineAddresses\Base;

class Template
{
    const PHP = '.php';

    /**
     * In tamplates use $args as array of variables.
     *
     * @param $page
     * @param array $data
     */
    public static function render($page, $args = [])
    {
        $path = UA_PLUGIN_TAMPLATE_PATH . $page . self::PHP;

        if (file_exists($path)) {
            return require_once($path);
        } else {
            (new Notice())->error(__('Page not found', 'ua'));
        }
    }
}