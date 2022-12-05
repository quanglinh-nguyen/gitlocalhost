<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $related_products ) : ?>

	<?php
	$display_relatedpro = uni_option('display-relatedpro');
	$numcol_pro_related = uni_option('number-product-related');
	if( $display_relatedpro == '1' ) {
        // woocommerce_product_loop_start();
        ?>
        <section class="related product-shortcode">
	        <h2 class="heading-related"><span><?php _e( 'Related Products', 'shtheme' ); ?></span></h2>
        	<ul class="slick-carousel list-products related-slider" data-items="3" data-items_lg="3" data-items_md="3" data-items_sm="2" data-items_mb="2" data-row="1" data-dots="false" data-arrows="false" data-infinite="false" data-autoplay="true" data-vertical="false">
				<?php
					foreach ( $related_products as $related_product ) : 
					 	$post_object = get_post( $related_product->get_id() );
						setup_postdata( $GLOBALS['post'] =& $post_object );
						wc_get_template_part( 'content', 'product' );
					endforeach;
				?>
			</ul>
		</section>
        <?php
        // woocommerce_product_loop_end();
	}
    ?>

<?php endif;

wp_reset_postdata();
