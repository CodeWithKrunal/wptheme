<?php  

remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
remove_action( 'woocommerce_before_single_product', 'woocommerce_output_all_notices', 10 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );



add_action( 'woocommerce_after_single_product_summary', 'woocommerce_before_single_product_summary_infotab_start', 9 );
add_action( 'woocommerce_after_single_product_summary', 'woocommerce_before_single_product_summary_infotab_end', 11 );
function woocommerce_before_single_product_summary_infotab_start(){
?>
	<div class="moreinfo_tab">
		<div class="wrapper">
<?php
}
function woocommerce_before_single_product_summary_infotab_end(){
?>
		</div>
	</div>
<?php
}

add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products_div_start', 19 );
function woocommerce_output_related_products_div_start(){
?>
	<div class="book_store book_store_product">
        <div class="wrapper">
<?php
}

add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products_div_end', 21 );
function woocommerce_output_related_products_div_end(){
?>
	</div>
</div>
<?php
}

add_filter('woocommerce_product_tabs', 'woocommerce_product_tabs_func');
function woocommerce_product_tabs_func($arrtab){
	// unset($arrtab['additional_information']);
	$arrtab['description']['description'] = __('מידע נוסף', 'morekoren');
	unset($arrtab['reviews']);

	$arrtab['woo_support_and_help'] = array(
        'title'     => __( 'תמיכה ועזרה', 'woocommerce' ),
        'priority'  => 20,
        'callback'  => 'woo_support_and_help'
    );

	return $arrtab;
}

function woo_support_and_help(){
	$support_and_help = get_field('support_and_help');
	if ($support_and_help) {
			echo $support_and_help;
	}
}

add_action('woocommerce_single_product_summary', 'woocommerce_single_product_summary_section_start', 1); 
function woocommerce_single_product_summary_section_start(){ ?>
	
	<section class="product_detail">
		<div class="wrapper d_flex justify_content_fs flex_wrap">
			<?php woocommerce_output_all_notices(); ?>
		</div>
		<div class="wrapper d_flex justify_content_fs flex_wrap">
			<div class="right_col">
				<?php woocommerce_show_product_images(); ?>
			</div>
			<div class="left_col">
<?php }

add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title_custom', 5 );
function woocommerce_template_single_title_custom(){
	the_title( '<h3>', '</h3>' );
}

add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price_custom', 10 );
function woocommerce_template_single_price_custom(){
    if(get_field('kit_includes')):
        echo '<p>הערכה כוללת:<br>'.get_field('kit_includes').'</p>';
    endif;
    $price = get_post_meta( get_the_ID(), '_regular_price', true); // Retrive products regular price
    $sale_price = get_post_meta( get_the_ID(), '_sale_price', true); // Retrive products regular price
    if($sale_price != '' && $sale_price < $price){
        $price = '<div class="price">
			<span class="rightpr"><strong>'.wc_price( $sale_price ).'</strong></span>
			<span class="leftpr">'.wc_price( $price ).'</span>
        </div>';
    }else{
        $price = '<div class="price"><span class="rightpr"><strong>'.wc_price( $price ).'</strong></span></div>';
    }
    echo $price;
}

add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart_custom', 30 );
function woocommerce_template_single_add_to_cart_custom(){
	global $product;
	$sku = $product->get_sku();
?>
	<a href="<?php echo $product->add_to_cart_url() ?>" value="<?php echo esc_attr( $product->get_id() ); ?>" class="ajax_add_to_cart_custom add_to_cart_button btn" data-product_id="<?php echo get_the_ID(); ?>" data-product_sku="<?php echo esc_attr($sku) ?>" aria-label="Add “<?php the_title_attribute() ?>” to your cart"><span data-svg-img="<?php echo get_template_directory_uri() ?>/assets/images/site/cart.svg"></span> <?php echo __('הוספה לסל', 'woocommerce'); ?> </a>
	<span class="site-loader"></span>
<?php 
}

add_action('woocommerce_single_product_summary', 'woocommerce_single_product_summary_section_end', 100); 
function woocommerce_single_product_summary_section_end(){ ?>
	</div></div></section>
<?php }


// Custom ajax add to cart
add_action('wp_ajax_ajax_add_to_cart_custom', 'ajax_add_to_cart_custom');
add_action('wp_ajax_nopriv_ajax_add_to_cart_custom', 'ajax_add_to_cart_custom');
function ajax_add_to_cart_custom(){

	$product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
    $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
    $variation_id = absint($_POST['variation_id']);
    // This is where you extra meta-data goes in
    $cart_item_data = $_POST['meta'];
    $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
    $product_status = get_post_status($product_id);

    // Remember to add $cart_item_data to WC->cart->add_to_cart
    if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id, $cart_item_data) && 'publish' === $product_status) {

        do_action('woocommerce_ajax_added_to_cart', $product_id);

        if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
            wc_add_to_cart_message(array($product_id => $quantity), true);
        }

        WC_AJAX :: get_refreshed_fragments();
    } else {

        $data = array(
            'error' => true,
            'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id));

        echo wp_send_json($data);
    }

    wp_die();
}