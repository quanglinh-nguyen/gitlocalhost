<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

$archive_object   = get_queried_object();
$archive_id 	  = $archive_object->term_id;
$archive_taxonomy = $archive_object->taxonomy;
get_header( 'shop' );

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked include_woocommerce_ajax_pagination
 */
do_action( 'woocommerce_before_main_content' );

/**
 * Hook: woocommerce_ajax_pagination.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action('woocommerce_ajax_pagination');

?>
<header class="woocommerce-products-header">
    <?php if ( apply_filters( 'woocommerce_show_page_title', true ) && uni_option('display-pagetitlebar') == false ) : ?>
		<h1 class="woocommerce-products-header__title page-title"><span><?php woocommerce_page_title(); ?></span></h1>
	<?php endif; ?>

	<?php
	/**
	 * Hook: woocommerce_archive_description.
	 *
	 * @hooked woocommerce_taxonomy_archive_description - 10
	 * @hooked woocommerce_product_archive_description - 10
	 */
	do_action( 'woocommerce_archive_description' );
	?>
</header>
<?php

// Check hierarchy in theme options
if( uni_option('display-hierarchy-woocommerce') == true && ! is_shop() && is_product_category() ) {
	// Content
	$args = array(
		'parent'     	=> $archive_id,
		'hide_empty'  	=> 0,
		'taxonomy'    	=> $archive_taxonomy,
	);
	$categories = get_categories( $args );
	if( $categories ) {
		echo '<div class="list-categories">';
			echo '<div class="row">';
			/* Start the Loop */
			foreach ( $categories as $value ) {
				echo '<div class="col-md-3">';
					echo '<div class="list-categories__item">';
						echo '<a class="img" title="' . $value->name . '" href="' . get_term_link( $value->term_id, $archive_taxonomy ) . '">' . woocommerce_category_image( $value->term_id ) . '</a>';
				    	echo '<h2><a class="" title="' . $value->name . '" href="' . get_term_link( $value->term_id, $archive_taxonomy ) . '">' . $value->name . '</a></h2>';
					echo '</div>';
				echo '</div>';
			}
			echo '</div>';
		echo '</div>';
	}
}

if ( have_posts() ) {
    echo '<div class="d-flex align-items-center switcher-wrap">';
		/**
		 * Hook: woocommerce_before_shop_loop.
		 *
		 * @hooked wc_print_notices - 10
		 * @hooked woocommerce_result_count - 20
		 * @hooked woocommerce_catalog_ordering - 30
		 */
		do_action( 'woocommerce_before_shop_loop' );
	echo '</div>';
	woocommerce_product_loop_start();
	if ( wc_get_loop_prop( 'total' ) ) {
		while ( have_posts() ) {
			the_post();
			/**
			 * Hook: woocommerce_shop_loop.
			 *
			 * @hooked WC_Structured_Data::generate_product_data() - 10
			 */
			do_action( 'woocommerce_shop_loop' );
			wc_get_template_part( 'content', 'product' );
		}
	}
	woocommerce_product_loop_end();
	/**
	 * Hook: woocommerce_after_shop_loop.
	 *
	 * @hooked woocommerce_pagination - 10
	 */
	do_action( 'woocommerce_after_shop_loop' );
} else {
    /**
     * Hook: woocommerce_no_products_found.
     *
     * @hooked wc_no_products_found - 10
     */
    do_action( 'woocommerce_no_products_found' );
}

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action( 'woocommerce_sidebar' );

get_footer( 'shop' );
