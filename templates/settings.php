<div class="wrap">
    <h1><?= __('Ukraine Addresses', 'ua') ?></h1>
    <form method="post" action="options.php">
        <?php
        settings_fields('ua-plugin-settings');
        do_settings_sections(UA_PLUGIN_ADMIN_SLUG);
        submit_button();
        ?>
    </form>
</div>
