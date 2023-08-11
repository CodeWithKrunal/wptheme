<?php

if (!defined('ABSPATH')) {

    exit; // Exit if accessed directly

}





/** Call to JS & CSS **/

add_action('wp_enqueue_scripts', 'morekoren_style_and_scripts');

function morekoren_style_and_scripts(){



    $version = '1.0.0';



    wp_enqueue_style( 'morekoren-style', get_stylesheet_uri() );

    wp_enqueue_style( "morekoren-stylesheet", get_stylesheet_directory_uri() . "/assets/fonts/stylesheet.css", '', $version );



    // Css Enqueue

    $enqueueCss = [

        'owl'           => 'owl',

        'shadowbox'     => 'shadowbox',

        'screen'        => 'screen',
        'screen_s'        => 'screen_s',

        'screen_d'      => 'screen_d',

        'responsive'    => 'responsive',

    ];



    foreach ($enqueueCss as $key => $value) {

        wp_enqueue_style( "morekoren-{$key}", get_stylesheet_directory_uri() . "/assets/css/{$value}.css", '', $version );

    }



    // Js Enqueue

    $enqueueJs = [

        'owl'           => 'owl',

        'shadowbox'     => 'shadowbox',

        'script'        => 'script',

        'custom'        => 'custom',
        'ajax_script'        => 'ajax_script',

    ];



    foreach ($enqueueJs as $key => $value) {

        wp_enqueue_script( "morekoren-{$key}", get_stylesheet_directory_uri() . "/assets/js/{$value}.js", array('jquery'), '', $version );

    }

    

    wp_localize_script( 'morekoren-custom', 'jsObj', array('ajax_url' => site_url() . '/wp-admin/admin-ajax.php'));
    wp_localize_script( 'morekoren-ajax_script', 'AjaxObj', array('ajax_url' => site_url() . '/wp-admin/admin-ajax.php'));



}