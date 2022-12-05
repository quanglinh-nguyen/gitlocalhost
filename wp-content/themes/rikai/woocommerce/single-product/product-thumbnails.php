<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.5.1
 */

defined( 'ABSPATH' ) || exit;

global $product;

$attachment_ids = $product->get_gallery_image_ids();

if ( has_post_thumbnail() ) {
	$thumbnails_id   = array( get_post_thumbnail_id() );
	$attachment_ids = array_merge( $thumbnails_id, $attachment_ids );
}

if ( $attachment_ids && count( $attachment_ids ) > 0 ) {
	echo '<section id="unidev-gallery" class="slider unidev-slider-nav">';
		foreach ( $attachment_ids as $attachment_id ) {
			$full_size_image  = wp_get_attachment_image_src( $attachment_id, 'full' );
			$thumbnail        = wp_get_attachment_image_src( $attachment_id, 'woocommerce_thumbnail' );

			$attributes = array(
				'title'                   => get_post_field( 'post_title', $attachment_id ),
				'data-caption'            => get_post_field( 'post_excerpt', $attachment_id ),
				'data-src'                => $full_size_image[0],
				'data-large_image'        => $full_size_image[0],
				'data-large_image_width'  => $full_size_image[1],
				'data-large_image_height' => $full_size_image[2],
			);

			$html  = '<li class="product-image-wrap">';
				$html .= '<div class="gallery-item" data-thumb="' . esc_url( $thumbnail[0] ) . '">';
					$html .= wp_get_attachment_image( $attachment_id, 'large', false, $attributes );
				$html .= '</div>';
			$html .= '</li>';

			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $attachment_id ); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped
		}
	echo '</section>';
} else {
	$image_link       = wp_get_attachment_url( get_post_thumbnail_id() );
	echo '<section id="unidev-gallery" class="slider unidev-slider-nav">';

			$html  = '<li class="product-image-wrap"><span data-thumb="' . esc_url( $thumbnail[0] ) . '" class="woocommerce-product-gallery__image">';
				$html .= '<img src="'.$image_link.'" alt="'.get_the_title().'">';
	 		$html .= '</span></li>';

			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, get_post_thumbnail_id() ); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped
	// 	}
	echo '</section>';
}