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
 * @package WooCommerce/Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_mini_cart' ); ?>

<?php if ( ! WC()->cart->is_empty() ) : ?>
	<div class="shopping-cart-side-content">
		<div class="shopping-cart-side-body uni-scroll">
			<div class="uni-scroll-content">
						
				<ul class="woocommerce-mini-cart cart_list product_list_widget <?php echo esc_attr( $args['list_class'] ); ?>">
					<?php
					do_action( 'woocommerce_before_mini_cart_contents' );

					foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
						$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
						$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

						if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
							$product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
							$thumbnail         = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
							$product_price     = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
							$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
							?>
							<li class="woocommerce-mini-cart-item clearfix <?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">
								<?php
								echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
									'<a href="%s" class="remove remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">&times;</a>',
									esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
									__( 'Remove this item', 'woocommerce' ),
									esc_attr( $product_id ),
									esc_attr( $cart_item_key ),
									esc_attr( $_product->get_sku() )
								), $cart_item_key );
								?>
								<?php if ( empty( $product_permalink ) ) : ?>
									<div class="shopping-cart-menu-product-media">
										<?php echo $thumbnail; ?>
									</div>
									<div class="shopping-cart-menu-product-wrap">
										<?php echo $product_name; ?>
										<div class="shopping-cart-menu-product-price">
											<?php echo wc_get_formatted_cart_item_data( $cart_item ); ?>
											<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?>
										</div>
									</div>
								<?php else : ?>
									<div class="shopping-cart-menu-product-media">
										<a class="d-block" href="<?php echo esc_url( $product_permalink ); ?>">
											<?php echo $thumbnail; ?>
										</a>
									</div>
									<div class="shopping-cart-menu-product-wrap">
										<a href="<?php echo esc_url( $product_permalink ); ?>">
											<?php echo $product_name; ?>
										</a>
										<div class="shopping-cart-menu-product-price">
											<?php echo wc_get_formatted_cart_item_data( $cart_item ); ?>
											<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?>
										</div>
									</div>
									
								<?php endif; ?>
								
							</li>
							<?php
						}
					}

					do_action( 'woocommerce_mini_cart_contents' );
					?>
				</ul>
			</div>
		</div>
		<div class="shopping-cart-side-footer cart-footer">
			<p class="woocommerce-mini-cart__total total">
				<?php
				/**
				 * Woocommerce_widget_shopping_cart_total hook.
				 *
				 * @hooked woocommerce_widget_shopping_cart_subtotal - 10
				 */
				do_action( 'woocommerce_widget_shopping_cart_total' );
				?>
			</p>

			<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

			<p class="woocommerce-mini-cart__buttons buttons"><?php do_action( 'woocommerce_widget_shopping_cart_buttons' ); ?></p>

			<?php do_action( 'woocommerce_widget_shopping_cart_after_buttons' ); ?>
		</div>
	</div>
<?php else : ?>
	<div class="content-cart-body">
		<p class="woocommerce-mini-cart__empty-message empty"><?php esc_html_e( 'No products in the cart.', 'woocommerce' ); ?></p>
		<?php if ( wc_get_page_id( 'shop' ) > 0 ) : ?>
		<p class="return-to-shop">
			<a class="button wc-backward" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
				<?php esc_html_e( 'Return To Shop', 'shtheme' ) ?>
			</a>
		</p>
	<?php endif; ?>
	</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_mini_cart' ); ?>
