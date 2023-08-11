<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

add_filter('the_generator', 'no_generator');
if (!function_exists('no_generator')) {
    /**
     * Removes the generator tag with WP version numbers. Hackers will use this to find weak and old WP installs
     *
     * @return string
     */
    function no_generator()
    {
        return '';
    }
} // endif function_exists( 'no_generator' ).

/*
Clean up wp_head() from unused or unsecure stuff
 */
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);
remove_action('wp_head', 'wp_shortlink_wp_head', 10);

add_filter('login_errors', 'show_less_login_info');
if (!function_exists('show_less_login_info')) {
    /**
     * Show less info to users on failed login for security.
     * (Will not let a valid username be known.)
     *
     * @return string
     */
    function show_less_login_info()
    {
        return '<strong>ERROR</strong>: Stop guessing!';
    }
}

add_action('after_setup_theme', 'remove_api');
function remove_api()
{
    remove_action('wp_head', 'rest_output_link_wp_head', 10);
    remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
    remove_action('template_redirect', 'rest_output_link_header', 11);
}

// Disalbe access to author page
// add_action('template_redirect', 'cs_disable_author_page');
function cs_disable_author_page()
{
    global $wp_query;

    if (is_author()) {
        $wp_query->set_404();
        status_header(404);
        nocache_headers();
    }
}