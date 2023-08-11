<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
add_filter( 'woocommerce_add_to_cart_validation', 'morekoren_filter_woocommerce_add_to_cart_validation', 10, 5 );
function morekoren_filter_woocommerce_add_to_cart_validation($passed, $product_id, $quantity){
	$is_course = get_field('is_it_course',$product_id);
	if( $is_course ){
		WC()->cart->empty_cart();
	}
	if( ! WC()->cart->is_empty() ){
		foreach ( WC()->cart->get_cart() as $cart_item ) {
			$product_id = $cart_item['product_id'];
			$is_course = get_field('is_it_course',$product_id);
			if( $is_course ){
				WC()->cart->empty_cart();
			}
		}
	}
	return $passed;
}

function morekoren_add_engraving_text_to_cart_item( $cart_item_data, $product_id, $variation_id ) {
	$is_course = get_field('is_it_course',$product_id);
	if( $is_course ){
		$online_course = get_field('online_course',$product_id);
		if(!empty($online_course)){
			foreach($online_course as $course){
				$cart_item_data['online_course'] = $course->ID;
			}
		}
	}
	return $cart_item_data;
}

add_filter( 'woocommerce_add_cart_item_data', 'morekoren_add_engraving_text_to_cart_item', 10, 3 );

add_action('woocommerce_add_order_item_meta', 'morekoren_add_custom_data_to_order_item_meta',1,2);
 
function morekoren_add_custom_data_to_order_item_meta( $item_id, $values ) {
    global $woocommerce,$wpdb;
 
    if(!empty($values['online_course'])){
        $online_course = $values['online_course'];
        wc_add_order_item_meta($item_id, 'online_course', $online_course);
    }
}
add_filter( 'woocommerce_order_item_get_formatted_meta_data', 'unset_specific_order_item_meta_data', 10, 2);
function unset_specific_order_item_meta_data($formatted_meta, $item){
    // Only on emails notifications
    foreach( $formatted_meta as $key => $meta ){
        if( in_array( $meta->key, array('online_course') ) )
            unset($formatted_meta[$key]);
    }
    return $formatted_meta;
}