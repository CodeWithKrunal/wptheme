<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_action( 'woocommerce_email_before_order_table', 'add_order_instruction_email', 10, 4 );
 
function add_order_instruction_email( $order, $sent_to_admin, $plain_text, $email ) {
  
    $course_id = '';
    foreach ( $order->get_items() as $item_id => $item ) {
        $product_id = $item->get_product_id();
        $is_course = get_field('is_it_course', $product_id);
        if($is_course){
            $online_course = get_field('online_course',$product_id);
            if(!empty($online_course)){
                foreach($online_course as $course){
                    $course_id = $course->ID;
                    $course_title = $course->post_title;
                    $course_link = get_permalink($course_id);
                }
            }
        }
    }
    if($course_id){
        echo '<p>'.__('אנא לחץ על הקישור למטה כדי לגשת לקורס:').'</p>';
        echo '<p><a href="'.$course_link.'">'.$course_title.'</a></p>';
    }
}