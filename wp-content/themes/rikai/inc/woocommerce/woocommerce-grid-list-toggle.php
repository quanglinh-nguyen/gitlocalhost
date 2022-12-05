<?php
/**
 * WC_List_Grid class
 **/
if ( ! class_exists( 'WC_List_Grid' ) ) {

	class WC_List_Grid {

		public function __construct() {
			// Hooks
			add_action( 'wp' , array( $this, 'setup_gridlist' ) , 20);
		}

		// Setup
		function setup_gridlist() {
			if ( is_shop() || is_product_category() || is_product_tag() || is_product_taxonomy() ) {
				add_action( 'wp_enqueue_scripts', array( $this, 'setup_scripts_script' ), 20);
				add_action( 'woocommerce_before_shop_loop', array( $this, 'gridlist_toggle_button' ), 10);
				add_action( 'woocommerce_after_shop_loop_item', array( $this, 'gridlist_description' ), 9);
			}
		}

		// Scripts & styles
		function setup_scripts_script() {
			wp_enqueue_script( 'cookie', get_template_directory_uri() . '/assets/js/gridlist-product/jquery.cookie.min.js', array( 'jquery' ), '1.4.1', true );
			wp_enqueue_script( 'grid-list-scripts', get_template_directory_uri() . '/assets/js/gridlist-product/jquery.gridlistview.min.js', array( 'jquery' ), '1.0', true );
		}

		// Toggle button
		function gridlist_toggle_button() {

			$grid_view = __( 'Grid view', 'shtheme' );
			$list_view = __( 'List view', 'shtheme' );

			$output = sprintf( '<div class="view-mode-switcher d-none d-md-block"><a href="#" id="grid" title="%1$s"><i class="icon-th-1"></i> <em>%1$s</em></a><a href="#" id="list" title="%2$s"><i class="icon-th-list"></i> <em>%2$s</em></a></div>', $grid_view, $list_view );

			echo apply_filters( 'gridlist_toggle_button_output', $output, $grid_view, $list_view );
		}

		// Description wrap
		function gridlist_description() {
			global $post;
			echo '<div class="gridlist-description">';
				$short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );
				echo strip_tags( $short_description );
			echo '</div>';
		}

	}

	new WC_List_Grid();
}
