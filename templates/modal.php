<?php
if (class_exists('WPCF7_TagGenerator')) {
    $args = wp_parse_args($args, array());
    $description = __('Get secret tokens on the %s website and insert them into the fields on the %s of Ukraine Addresses plugin. Without tokens, the plugin will not be able to receive addresses data.');
    $link_api = '<a href="address.ua" target="_blank">address.ua</a>';
    $link_settings = '<a href="' . UA_PLUGIN_ADMIN_SLUG . '" target="_blank">settings page</a>';
    ?>
    <div class="control-box">
        <fieldset>
            <legend><?php echo sprintf(esc_html($description), $link_api, $link_settings); ?></legend>
            <table class="form-table">
                <tbody>
                    <tr>
                        <th scope="row"><?php echo esc_html( __( 'Field type', 'contact-form-7' ) ); ?></th>
                        <td>
                            <fieldset>
                                <legend class="screen-reader-text"><?php echo esc_html( __( 'Field type', 'contact-form-7' ) ); ?></legend>
                                <label><input type="checkbox" name="required" /> <?php echo esc_html( __( 'Required field', 'contact-form-7' ) ); ?></label>
                            </fieldset>
                        </td>
                    </tr>
                </tbody>
            </table>
        </fieldset>
    </div>

    <div class="insert-box">
        <input type="text" name="ukraine_addresses" class="tag code" readonly="readonly" onfocus="this.select()" />
        <div class="submitbox">
            <input type="button" class="button button-primary insert-tag" value="<?php echo esc_attr( __( 'Insert Tag', 'contact-form-7' ) ); ?>" />
        </div>
        <br class="clear" />
        <p class="description mail-tag">
            <label for="<?php echo esc_attr( $args['content'] . '-mailtag' ); ?>"><?php echo sprintf( esc_html( __( "To use the value input through this field in a mail field, you need to insert the corresponding mail-tag (%s) into the field on the Mail tab.", 'contact-form-7' ) ), '<strong><span class="mail-tag"></span></strong>' ); ?><input type="text" class="mail-tag code hidden" readonly="readonly" id="<?php echo esc_attr( $args['content'] . '-mailtag' ); ?>" />
            </label>
        </p>
    </div>
<?php }
