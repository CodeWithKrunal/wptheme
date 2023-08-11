<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;
get_template_part('template-parts/page/inner-banner');  
the_breadcrumb();

// do_action( 'woocommerce_before_cart' ); 

?>
<section class="shopping_cart_page">
    <div class="wrapper">
        <div class="cart_title d_flex justify_content_fs align_items_c">
            <a href="javascript:void(0)" class="cart_icon_page">
                <span><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                <img src="<?php echo get_template_directory_uri();?>/assets/images/site/cart_icon1.png" alt="cart_icon">
            </a>
            <h2><?php echo get_the_title();?></h2>
        </div>
        <div class="inner d_flex justify_content_sb flex_wrap ">
            <div class="right_col">
                <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
                    <div class="list_col">
                        <?php do_action( 'woocommerce_before_cart_table' ); ?>
                        <ul class="title">
                            <li class="product-remove">&nbsp;</li>
                            <li class="product-name"><?php esc_html_e( 'מוצר', 'woocommerce' ); ?></li>
                            <li class="product-price"><?php esc_html_e( 'מחיר', 'woocommerce' ); ?></li>
                            <li class="product-quantity"><?php esc_html_e( 'כמות', 'woocommerce' ); ?></li>
                            <li class="product-subtotal"><?php esc_html_e( 'סכום ביניים', 'woocommerce' ); ?></li>
                        </ul>
                        <?php do_action( 'woocommerce_before_cart_contents' ); ?>

                        <?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
					?>
                        <ul
                            class="shop_table woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

                            <li class="product-remove">
                                <?php
								echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									'woocommerce_cart_item_remove_link',
									sprintf(
										'<a href="%s" class="remove" aria-label="%s" data-svg-img="'.get_template_directory_uri().'images/site/remove.svg" data-product_id="%s" data-product_sku="%s">&times;</a>',
										esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
										esc_html__( 'Remove this item', 'woocommerce' ),
										esc_attr( $product_id ),
										esc_attr( $_product->get_sku() )
									),
									$cart_item_key
								);
							?>
                            </li>

                            <li class="product-thumbnail">
                                <?php
						$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
							printf( '<a href="%s" class="img">%s</a>', esc_url( $product_permalink ), $thumbnail );
						?>
                                <div class="text">
								<a href="<?php echo  esc_url( $product_permalink );?>"><?php echo $_product->get_name();?></a>
                                </div>
                            </li>

                            <li class="product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
                                <?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );?>
                            </li>
							<li class="qty_cart_item"><?php echo $cart_item['quantity']; ?></li>

                            <li class="product-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
                                <?php
								echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
							?>
                            </li>

                        </ul>
                        <?php
				}
			}
			?>

                        <?php do_action( 'woocommerce_cart_contents' ); ?>
                    </div>

					<div class="coupon_col d_flex justify_content_sb align_items_c">
                        <?php if ( wc_coupons_enabled() ) { ?>
                            <div class="coupon">
                                <div class="coupen_text">
                                    <label for="coupon_code"><?php esc_html_e( 'Coupon:', 'woocommerce' ); ?></label> 
                                    <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'הוסיפו קוד קופון לקבלת הנחה ברכישה', 'woocommerce' ); ?>" /> 
                                </div>
                                <button type="submit" class="btn button" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?></button>
                                <?php do_action( 'woocommerce_cart_coupon' ); ?>
                            </div>
                        <?php } ?>
					</div>

                    <?php do_action( 'woocommerce_cart_actions' ); ?>
                    <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
                    <?php do_action( 'woocommerce_after_cart_contents' ); ?>
                    <?php do_action( 'woocommerce_after_cart_table' ); ?>
                </form>
            </div>
            <div class="left_col">
                <div class="amount_col">
                    <?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

                    <div class="cart-collaterals">
                        <?php
		/**
		 * Cart collaterals hook.
		 *
		 * @hooked woocommerce_cross_sell_display
		 * @hooked woocommerce_cart_totals - 10
		 */
		do_action( 'woocommerce_cart_collaterals' );
	?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php do_action( 'woocommerce_after_cart' ); ?>