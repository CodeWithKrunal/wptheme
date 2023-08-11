<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}


// Faq Ajax Load More and Category Ajax
add_action("wp_ajax_link_posts_load_more", "link_posts_load_more");
add_action("wp_ajax_nopriv_link_posts_load_more", "link_posts_load_more");
function link_posts_load_more()
{

    $posts_per_page = $_REQUEST['posts_per_page'];
    $post_ids = $_REQUEST['post_ids'] ? $_REQUEST['post_ids'] : false;

    $args = array(
        'post_type'      => 'post',
        'orderby'        => 'date',
        'order'          => 'DESC',
        'post_status'    => 'publish',
        'posts_per_page' => $posts_per_page,
        'post__not_in'   => $post_ids,
    );

    $posts = new WP_Query($args);
    $total = $posts->found_posts;

    if ($posts->have_posts()):
        ob_start();
        while ($posts->have_posts()): $posts->the_post();
            get_template_part( 'template-parts/posts/post', 'block' );
        endwhile;
        $html = ob_get_clean();
    endif;
    wp_reset_postdata();

    $result['html'] = $html;
    $result['total'] = $total;
    $result = json_encode($result);

    echo $result;

    die();

}