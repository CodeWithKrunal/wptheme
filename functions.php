<?php

class morekoren_FrameWork
{

    public function __construct()
    {
        $this->helper();
    }

    public function helper()
    {
		include_once 'inc/acf_func.php';
        include_once 'inc/breadcrumb_func.php';
        include_once 'inc/core_func.php';
        include_once 'inc/posts_func.php';
        include_once 'inc/products_func.php';
        include_once 'inc/scripts-enquer_func.php';
        include_once 'inc/security_func.php';
        include_once 'inc/svg_func.php';

        /** Include CPT Files **/
        include_once( get_template_directory() . '/post-types/job_post.php' );
        include_once( get_template_directory() . '/post-types/course_post.php' );
        include_once( get_template_directory() . '/post-types/offices_post.php' );
        include_once( get_template_directory() . '/post-types/online_courses_post.php' );
        include_once( get_template_directory() . '/post-types/psychometry_articles_post.php' );

        // check for plugin using plugin name
        if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
            include_once( get_template_directory() . '/inc/woocommerce/shop_func.php');
            include_once( get_template_directory() . '/inc/woocommerce/woo_func.php');
            include_once( get_template_directory() . '/inc/woocommerce/prod_details_func.php');
            include_once( get_template_directory() . '/inc/woocommerce/cart_func.php');
            include_once( get_template_directory() . '/inc/woocommerce/checkout_func.php');
        }

    }
    
    

}

// Install Theme
$thememorekoren = new morekoren_FrameWork();