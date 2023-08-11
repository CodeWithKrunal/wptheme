<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/* Theme Options */
if (function_exists('acf_add_options_page')) {

    acf_add_options_page(array(
        'page_title' => 'Theme General Settings',
        'menu_title' => 'Theme Settings',
        'menu_slug' => 'theme-general-settings',
        'capability' => 'edit_posts',
        'redirect' => false,
    ));
}

/** ACF Wysywig Editor Height Adjust **/
add_action('acf/input/admin_footer', 'marhiv_apply_acf_modifications');
function marhiv_apply_acf_modifications(){ ?>
    <style>
    .acf-editor-wrap iframe {
        min-height: 0;
    }
    </style>
    <script>
    (function($) {
        // (filter called before the tinyMCE instance is created)
        acf.add_filter('wysiwyg_tinymce_settings', function(mceInit, id, $field) {
            // enable autoresizing of the WYSIWYG editor
            mceInit.wp_autoresize_on = true;
            return mceInit;
        });
        // (action called when a WYSIWYG tinymce element has been initialized)
        acf.add_action('wysiwyg_tinymce_init', function(ed, id, mceInit, $field) {
            // reduce tinymce's min-height settings
            ed.settings.autoresize_min_height = 100;
            // reduce iframe's 'height' style to match tinymce settings
            $('.acf-editor-wrap iframe').css('height', '100px');
        });
    })(jQuery)
    </script>
<?php }