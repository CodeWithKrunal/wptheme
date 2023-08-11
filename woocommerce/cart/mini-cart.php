<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 5.2.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_mini_cart' ); ?>

<?php if ( ! WC()->cart->is_empty() ) : ?>
	<div class="mini-cart-top">
			<h3>עגלת הקניות שלי</h3>
			<a href="javascript:;" class="mini-close"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/site/mini_close_icon.png" alt="close"></a>
</div>
<div class="mini-cart-pro-detail">
	<div class="inner inner_clog woocommerce-mini-cart cart_list product_list_widget <?php echo esc_attr( $args['list_class'] ); ?>">
		
		<?php
		do_action( 'woocommerce_before_mini_cart_contents' );

		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				$product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
				$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
				$sale_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
				$product_price     = apply_filters( 'woocommerce_get_regular_price', $_product->get_regular_price(), $cart_item, $cart_item_key );



				$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
				?>
				<div class="col woocommerce-mini-cart-item <?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>"> <a href="<?php echo esc_url( get_permalink( $product_id ) ); ?>" class="img pointer_none">
						<?php echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</a>
					<div class="mini-course-detail">
						<a href="<?php //echo esc_url( get_permalink( $product_id ) ); ?>javascript:void(0);" class="text pointer_none">
							<?php 
								echo wp_kses_post( $product_name ); 
								echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<br/><span class="quantity" data-qty="'.$cart_item['quantity'].'">' . sprintf( '%s %s', $cart_item['quantity'], $selected_var ) . '</span>', $cart_item, $cart_item_key );
							?>
						</a>
						
						<div class="product_des">
							<?php the_field( 'product_short_description',$product_id ); ?>
						</div>
						
						<div class="course-price">
							<span class="price regularPrice"><?php echo get_woocommerce_currency_symbol().$product_price; ?></span>
							<span class="price salePrice"><?php echo $sale_price; ?></span>
						</div>
						<div class="btn_col quantity">
							<a href="javascript:void(0);" class="quantity__minus">
								<img src="<?php echo get_template_directory_uri(); ?>/assets/images/site/minus.svg" alt="minus">
							</a>
							<?php
							$step = 1;
							if( $_product->is_type('simple') ) {
								$__product_id = $_product->get_parent_id() > 0 ? $_product->get_parent_id() : $_product->get_id();
								$step = get_field( 'step', $__product_id ) ? get_field( 'step', $__product_id ) : 1;
							} 
							?>
							<input type="number" name="quantity" class="mini-cart-qty qty" value="<?php echo $cart_item['quantity']; ?>" max="" min="<?php echo $step; ?>" step="<?php echo $step; ?>" data-cart-item-key="<?php echo $cart_item_key; ?>">

							<a href="javascript:void(0);" class="quantity__plus">
								<img src="<?php echo get_template_directory_uri(); ?>/assets/images/site/plus.svg" alt="plus">
							</a>
						</div>
					</div>
					<?php
						echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							'woocommerce_cart_item_remove_link',
							sprintf(
								'<a href="%s" class="remove remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">&times;</a>',
								esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
								esc_attr__( 'Remove this item', 'woocommerce' ),
								esc_attr( $product_id ),
								esc_attr( $cart_item_key ),
								esc_attr( $_product->get_sku() )
							),
							$cart_item_key
						);
						?>
				</div>
				<?php
			}
		}

		do_action( 'woocommerce_mini_cart_contents' );
		?>
	</div>

</div>
<div class="min-bot">
	<div class="int-payment d-flex justify-content-between align-items-center">
		<h4><?php echo __(' סכום ביניים', 'morekoren'); ?></h4>
		<span class="price"><?php echo WC()->cart->get_cart_total(); ?></span>
	</div>
	<div class="total-payment d-flex justify-content-between align-items-center">
		<h4><?php echo __('סה"כ', 'morekoren'); ?></h4>
		<span class="price"><?php echo wc_cart_totals_order_total_html(); ?></span>
	</div>
	<div class="bottm_col d-flex justify-content-between align-items-center">
		<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="payment">
			<?php esc_html_e( 'המשך לתשלום', 'morekoren' ); ?>
		</a>
		<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="total_price">
			<?php esc_html_e( 'מעבר לסל קניות', 'morekoren' ); ?>
		</a>
	</div>
</div>



<?php else : ?>
	<div class="mini-cart-top">
			<h3><?php echo __('עגלת הקניות שלי', 'morekoren'); ?></h3>
			<a href="javascript:;" class="mini-close"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/site/mini_close_icon.png" alt="close"></a>
</div>
	<p class="woocommerce-mini-cart__empty-message"><?php esc_html_e( 'No products in the cart.', 'woocommerce' ); ?></p>

<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>
