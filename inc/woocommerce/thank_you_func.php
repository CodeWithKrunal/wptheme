<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

remove_action( 'woocommerce_thankyou', 'woocommerce_order_details_table', 10 );
remove_action( 'woocommerce_thankyou_', 'thankyou_page' );

/** Add Div Before Checkout */
add_action('woocommerce_before_thankyou','marhiv_thank_you_opener_div', 1);
function marhiv_thank_you_opener_div(){
    global $woocommerce;
    echo '<div class="order-thank-you">';
    echo '<div class="steps">
            <ul>
                <li><a href="' . esc_url( wc_get_cart_url() ) . '">עגלת קניות</a></li>
                <li><a href="' . esc_url( wc_get_checkout_url() ) . '">פרטי הזמנה</a></li>
                <li><a href="javascript:void(0);">הזמנה הושלמה</a></li>
            </ul>
        </div>';
    echo '<div class="thank-you-inner">';
}

/** Cloe Div After Cart */
add_action('woocommerce_thankyou','marhiv_thank_you_closer_div');
function marhiv_thank_you_closer_div(){
    echo '</div>';
    echo '</div>';
}