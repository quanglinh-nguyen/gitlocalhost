<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.1
 */

defined( 'ABSPATH' ) || exit;

global $post, $product;
?>
<div class="images woocommerce-product-gallery woocommerce-product-gallery--with-images" style="opacity: 0; transition: opacity .25s ease-in-out;">
	<div class="woocommerce-product-gallery__wrapper">
		<?php
			if ( has_post_thumbnail() ) {
				$attachment_ids = $product->get_gallery_image_ids();
				
				$attachment_count = count( $attachment_ids);
				
				$image_link       = wp_get_attachment_url( get_post_thumbnail_id() );
				$props            = wc_get_product_attachment_props( get_post_thumbnail_id(), $post );
				$image            = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
					'title'	 => $props['title'],
					'alt'    => $props['alt'],
				) );
				
				$fullimage        = get_the_post_thumbnail( $post->ID, 'full', array(
					'title'	 => $props['title'],
					'alt'    => $props['alt'],
				) );

				// Uni FOR SLIDER
				$html  = '<section class="unidev-slider-for">';

				if($attachment_ids) {
					$html .= '<div class="zoom"><div class="gallery-item"><span><img src="'.$image_link.'" alt="'.$props['title'].'"></span></div><a class="unidev-popup" href="'.$image_link.'" data-fancybox="product-gallery"><i class="icon-resize-full"></i> </a></div>';
					foreach( $attachment_ids as $attachment_id ) {
						$imgfull_src = wp_get_attachment_image_src( $attachment_id,'full');
						$image_src   = wp_get_attachment_image_src( $attachment_id,'shop_single');
						$html .= '<div class="zoom"><div class="gallery-item"><span><img src="' . $imgfull_src[0] . '" /></span></div><a href="' . $imgfull_src[0] . '" class="unidev-popup" data-fancybox="product-gallery"><i class="icon-resize-full"></i></a></div>';
					}
				} else {
					$html .= '<div class="zoom"><div class="gallery-item"><span><img src="'.$image_link.'" alt="'.$props['title'].'"></span></div><a class="unidev-popup" href="'.$image_link.'" data-fancybox="product-gallery"><i class="icon-resize-full"></i> </a></div>';
				}
				
				$html .= '</section>';
				
				echo apply_filters(
					'woocommerce_single_product_image_html',
					$html,
					$post->ID
				);
			} else {
				echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), __( 'Placeholder', 'woocommerce' ) ), $post->ID );
			}

			do_action( 'woocommerce_product_thumbnails' );
		?>
	</div>
</div>