<?php

namespace UkraineAddresses\Base;

class AddressTag
{
    private $fields = [];

    private $levels = [
        'one' => 'select',
        'two' => 'select',
        'three' => 'select',
        'streets' => 'select',
        'addresses' => 'select',
        'room' => 'text',
    ];

    /**
     * AddressTag constructor.
     */
    public function __construct()
    {
        $this->createAddressesTag();
    }

    public function addHook()
    {
        add_action('wpcf7_init', [$this, 'addAddressesTagToContactForm'], 9);
        add_action('wpcf7_admin_init', [$this, 'addAddressesTagModal'], 25);
        add_filter('wpcf7_validate_ukraine_addresses', [$this, 'validateUkraineAddresses'], 20, 2);
        add_filter('wpcf7_validate_ukraine_addresses*', [$this, 'validateUkraineAddresses'], 20, 2);
    }

    function addAddressesTagToContactForm()
    {
        wpcf7_add_form_tag(['ukraine_addresses', 'ukraine_addresses*'], [$this, 'renderAddressesFields'], true);
    }

    function addAddressesTagModal()
    {
        $tagGenerator = \WPCF7_TagGenerator::get_instance();
        $tagGenerator->add('ukraine_addresses', __('Address', 'ua'), [$this, 'renderAddressesTagModal']);
    }

    public function createAddressesTag()
    {
        $captionType = Helper::getValue('caption_type');
        $autoshow = Helper::getValue('ua_autoshow_selects');
        $required = Helper::getValue('ua_required_fields');
        $captionOption = ($captionType == 'placeholder') ? 'first_as_label' : 'include_blank';

        foreach ($this->levels as $level => $type) {
            if ($captionType == 'placeholder') {
                $label = [Helper::getValue('caption_level_' . $level)];
                $textValues = [$label[0]];
                $value = [0];
            }

            if ($captionType == 'label') {
                $textValues = [];
                $label = [];
                $value = [];
            }

            if (in_array($type, ['select', 'select*'])) {
                $tag = [
                    'type'    => ($required == '1') ? 'select*' : 'select',
                    'name'    => "ua_level_$level",
                    'values'  => $value,
                    'labels'  => $label,
                    'options' => [
                        'class:ua-fields',
                        'class:ua-text-level',
                        'class:ua-select-level',
                        "id:ua-select-level-$level",
                        $captionOption
                    ],
                ];
            }

            if (in_array($type, ['text', 'text*'])) {
                $tag = [
                    'basetype' => 'text',
                    'type'     => ($required == '1') ? 'text*' : 'text',
                    'name'     => "ua_level_$level",
                    'values'   => $textValues,
                    'options' => [
                        'class:ua-fields',
                        'class:ua-text-level',
                        "id:ua-select-level-$level",
                        'placeholder',

                    ],
                ];
            }

            if ($autoshow && $captionType == 'placeholder' && $tag['name'] != 'ua_level_one') {
                $tag['options'][] = 'class:ua-hidden';
            } else {
                $tag['options'][] = 'class:ua-open';
            }

            $field = new \WPCF7_FormTag($tag);

            $this->fields[] = $field;
        }

        //echo "<script>let autoshow = $autoshow</script>";
    }

    function validateUkraineAddresses($result, $tag)
    {
        foreach ($this->fields as $field) {
            $name = $field->name;
            $has_value = isset($_POST[$name]) && '' !== $_POST[$name];
            $required = Helper::getValue('ua_required_fields');
            if ($required == '1' and !$has_value) {
                $result->invalidate($field, wpcf7_get_message('invalid_required'));
            }
        }

        return $result;
    }

    function renderAddressesFields()
    {
        $fields = [];
        $captionType = Helper::getValue('caption_type');
        $autoshow = Helper::getValue('ua_autoshow_selects');

        foreach ($this->fields as $field) {
            $array = explode('_', $field->name);
            $name = end($array);
            $caption = Helper::getValue('caption_level_' . $name);

            if (in_array($field->type, ['select', 'select*'])) {
                $field = wpcf7_select_form_tag_handler($field);
            } elseif(in_array($field->type, ['text', 'text*'])) {
                $field = wpcf7_text_form_tag_handler($field);
            }

            $class = '';
            if ($autoshow == '1' && $name != 'one') {
                $class = "class = 'ua-hidden'";
            }

            if ($captionType == 'label') {
                $field = "<label for='ua-select-level-$name' $class>$caption<br>$field</label>";
            }

            $fields[] = $field;
        }

        return $this->htmlWithAutoWrapP($fields);
    }

    public function htmlWithAutoWrapP($fields)
    {
        $html = implode('</p><p>', $fields);

        if (!defined('WPCF7_AUTOP')) {
            $html .= '<p>' . $html . '</p>';
        }

        return $html;
    }

    function renderAddressesTagModal($contact_form, $args = '')
    {
        return Template::render('modal', $args);
    }
}