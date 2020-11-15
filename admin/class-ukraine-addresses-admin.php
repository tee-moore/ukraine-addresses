<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Ukraine_Addresses
 * @subpackage Ukraine_Addresses/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Ukraine_Addresses
 * @subpackage Ukraine_Addresses/admin
 * @author     Your Name <email@example.com>
 */
class Ukraine_Addresses_Admin
{
    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $ukraine_addresses The ID of this plugin.
     */
    private $name_plugin;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    private $version_plugin;

    /**
     * Initialize the class and set its properties.
     *
     * @param string $ukraine_addresses The name of this plugin.
     * @param string $version The version of this plugin.
     * @since    1.0.0
     */
    public function __construct($name, $version)
    {
        $this->name_plugin = $name;
        $this->version_plugin = $version;
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {
        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Ukraine_Addresses_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Ukraine_Addresses_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style(
            $this->name_plugin,
            plugin_dir_url(__FILE__) . 'css/ukraine-addresses-admin.css',
            [],
            $this->version_plugin,
            'all'
        );
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {
        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Ukraine_Addresses_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Ukraine_Addresses_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script(
            $this->name_plugin,
            plugin_dir_url(__FILE__) . 'js/ukraine-addresses-admin.js',
            array('jquery'),
            $this->version_plugin,
            true
        );
    }

    //modal
    function wpcf7_add_tag_generator_select_optgroup()
    {
        $tag_generator = WPCF7_TagGenerator::get_instance();
        $tag_generator->add('ukraine_addresses', 'Address', [$this, 'wpcf7_tag_generator_select_optgroup']);
    }

    function wpcf7_tag_generator_select_optgroup($contact_form, $args = '')
    {
        if (class_exists('WPCF7_TagGenerator')) {
            $args = wp_parse_args( $args, array() );
            $description = __( "Generate a form-tag for a spam-stopping honeypot field. For more details, see %s.", 'contact-form-7-honeypot' );
            $desc_link = '<a href="https://wordpress.org/plugins/contact-form-7-honeypot/" target="_blank">'.__( 'CF7 Honeypot', 'contact-form-7-honeypot' ).'</a>';
            ?>
            <div class="control-box">
                <fieldset>
                    <legend><?php echo sprintf( esc_html( $description ), $desc_link ); ?></legend>

                    <table class="form-table"><tbody>
                        <tr>
                            <th scope="row">
                                <label for="<?php echo esc_attr( $args['content'] . '-name' ); ?>"><?php echo esc_html( __( 'Name', 'contact-form-7-honeypot' ) ); ?></label>
                            </th>
                            <td>
                                <input type="text" name="name" class="tg-name oneline" id="<?php echo esc_attr( $args['content'] . '-name' ); ?>" /><br>
                                <em><?php echo esc_html( __( 'This can be anything, but should be changed from the default generated "honeypot". For better security, change "honeypot" to something more appealing to a bot, such as text including "email" or "website".', 'contact-form-7-honeypot' ) ); ?></em>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">
                                <label for="<?php echo esc_attr( $args['content'] . '-id' ); ?>"><?php echo esc_html( __( 'ID (optional)', 'contact-form-7-honeypot' ) ); ?></label>
                            </th>
                            <td>
                                <input type="text" name="id" class="idvalue oneline option" id="<?php echo esc_attr( $args['content'] . '-id' ); ?>" />
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">
                                <label for="<?php echo esc_attr( $args['content'] . '-class' ); ?>"><?php echo esc_html( __( 'Class (optional)', 'contact-form-7-honeypot' ) ); ?></label>
                            </th>
                            <td>
                                <input type="text" name="class" class="classvalue oneline option" id="<?php echo esc_attr( $args['content'] . '-class' ); ?>" />
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">
                                <label for="<?php echo esc_attr( $args['content'] . '-wrapper-id' ); ?>"><?php echo esc_html( __( 'Wrapper ID (optional)', 'contact-form-7-honeypot' ) ); ?></label>
                            </th>
                            <td>
                                <input type="text" name="wrapper-id" class="wrapper-id-value oneline option" id="<?php echo esc_attr( $args['content'] . '-wrapper-id' ); ?>" /><br>
                                <em><?php echo esc_html( __( 'By default the markup that wraps this form item has a random ID. You can customize it here. If you\'re unsure, leave blank.', 'contact-form-7-honeypot' ) ); ?></em>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">
                                <label for="<?php echo esc_attr( $args['content'] . '-validautocomplete' ); ?>"><?php echo esc_html( __( 'Use W3C Valid Autocomplete (optional)', 'contact-form-7-honeypot' ) ); ?></label>
                            </th>
                            <td>
                                <input type="checkbox" name="validautocomplete:true" id="<?php echo esc_attr( $args['content'] . '-validautocomplete' ); ?>" class="validautocompletevalue option" /><br />
                                <em><?php echo __('See <a href="https://wordpress.org/support/topic/w3c-validation-in-1-11-explanation-and-work-arounds/" target="_blank" rel="noopener">here</a> for more details. If you\'re unsure, leave this unchecked.','contact-form-7-honeypot'); ?></em>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">
                                <label for="<?php echo esc_attr( $args['content'] . '-move-inline-css' ); ?>"><?php echo esc_html( __( 'Move inline CSS (optional)', 'contact-form-7-honeypot' ) ); ?></label>
                            </th>
                            <td>
                                <input type="checkbox" name="move-inline-css:true" id="<?php echo esc_attr( $args['content'] . '-move-inline-css' ); ?>" class="move-inline-css-value option" /><br />
                                <em><?php echo __('Moves the CSS to hide the honeypot from the element to the footer of the page. May help confuse bots.','contact-form-7-honeypot'); ?></em>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row">
                                <label for="<?php echo esc_attr( $args['content'] . '-nomessage' ); ?>"><?php echo esc_html( __( 'Disable Accessibility Label (optional)', 'contact-form-7-honeypot' ) ); ?></label>
                            </th>
                            <td>
                                <input type="checkbox" name="nomessage:true" id="<?php echo esc_attr( $args['content'] . '-nomessage' ); ?>" class="messagekillvalue option" /><br />
                                <em><?php echo __('If checked, the accessibility label will not be generated. This is not recommended, but may improve spam blocking. If you\'re unsure, leave this unchecked.','contact-form-7-honeypot'); ?></em>
                            </td>
                        </tr>

                        </tbody></table>
                </fieldset>
            </div>

            <div class="insert-box">
                <input type="text" name="ukraine_addresses" class="tag code" readonly="readonly" onfocus="this.select()" />

                <div class="submitbox">
                    <input type="button" class="button button-primary insert-tag" value="<?php echo esc_attr( __( 'Insert Tag', 'contact-form-7-honeypot' ) ); ?>" />
                </div>

                <br class="clear" />
            </div>
        <?php } else { ?>
            <div id="wpcf7-tg-pane-honeypot" class="hidden">
                <form action="">
                    <table>
                        <tr>
                            <td>
                                <?php echo esc_html( __( 'Name', 'contact-form-7-honeypot' ) ); ?><br />
                                <input type="text" name="name" class="tg-name oneline" /><br />
                                <em><small><?php echo esc_html( __( 'For better security, change "honeypot" to something less bot-recognizable.', 'contact-form-7-honeypot' ) ); ?></small></em>
                            </td>
                            <td></td>
                        </tr>

                        <tr>
                            <td colspan="2"><hr></td>
                        </tr>

                        <tr>
                            <td>
                                <?php echo esc_html( __( 'ID (optional)', 'contact-form-7-honeypot' ) ); ?><br />
                                <input type="text" name="id" class="idvalue oneline option" />
                            </td>
                            <td>
                                <?php echo esc_html( __( 'Class (optional)', 'contact-form-7-honeypot' ) ); ?><br />
                                <input type="text" name="class" class="classvalue oneline option" />
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="checkbox" name="nomessage:true" id="nomessage" class="messagekillvalue option" /> <label for="nomessage"><?php echo esc_html( __( 'Don\'t Use Accessibility Message (optional)', 'contact-form-7-honeypot' ) ); ?></label><br />
                                <em><?php echo __('If checked, the accessibility message will not be generated. <strong>This is not recommended</strong>. If you\'re unsure, leave this unchecked.','contact-form-7-honeypot'); ?></em>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2"><hr></td>
                        </tr>
                    </table>

                    <div class="tg-tag"><?php echo esc_html( __( "Copy this code and paste it into the form left.", 'contact-form-7-honeypot' ) ); ?><br /><input type="text" name="honeypot" class="tag" readonly="readonly" onfocus="this.select()" /></div>
                </form>
            </div>
        <?php }
    }

    /**
     * Add form tag
     */
    function wpcf7_add_form_tag_select_group()
    {
        wpcf7_add_form_tag('ukraine_addresses', [$this, 'wpcf7_select_optgroup_form_tag_handler'], true);
    }

    /**
     * Hendle form tag
     * @param $tag
     * @return string
     */
    function wpcf7_select_optgroup_form_tag_handler($tag)
    {
        if (defined('WPCF7_AUTOP')) {
            $html = WPCF7_AUTOP ? '' : '<p>';
        }

        $html .= wpcf7_select_form_tag_handler(new WPCF7_FormTag([
            'name' => 'level-one',
            'type' => 'select',
            'options' => [
                'class:level-one-class',
                'id:level-one-id'
            ],
            'values' => [
                'one1',
                'two1',
                'three1'
            ]
        ]));

        $html .= '</p><p>';

        $html .= wpcf7_select_form_tag_handler(new WPCF7_FormTag([
            'name' => 'level-two',
            'type' => 'select',
            'options' => [
                'class:level-two-class',
                'id:level-two-id'
            ],
            'values' => [
                'one2',
                'two2',
                'three2'
            ]
        ]));

        if (defined('WPCF7_AUTOP')) {
            $html .= WPCF7_AUTOP ? '' : '</p>';
        }

        return $html;
    }
}
