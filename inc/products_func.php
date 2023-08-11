<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}


// Faq Ajax Load More and Category Ajax
add_action("wp_ajax_link_products_load_more", "link_products_load_more");
add_action("wp_ajax_nopriv_link_products_load_more", "link_products_load_more");
function link_products_load_more()
{

    $posts_per_page = $_REQUEST['posts_per_page'];
    $posts_per_page = $_REQUEST['posts_per_page'];
    $product_cat    = $_REQUEST['product_cat'];

    $post_ids = $_REQUEST['post_ids'] ? $_REQUEST['post_ids'] : false;

    $product = new WP_Query( array( 
        'post_type'         => 'product', 
        'post_status'       => 'publish',
        'posts_per_page'    => $posts_per_page,
        'orderby'           => 'date',
        'order'             => 'DESC',
        'post__not_in'      => $post_ids,
        'tax_query'         => array(
                                'relation' => 'OR',
                                    array(
                                    'taxonomy' => 'product_cat',
                                    'field' => 'term_id',
                                    'terms' => array($product_cat)
                                    ),
                                ),
        
        ));

    $total = $product->found_posts;

    if ($product->have_posts()):
        ob_start();
        while ($product->have_posts()): $product->the_post();
            wc_get_template_part( 'content', 'product-voucher' );
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

