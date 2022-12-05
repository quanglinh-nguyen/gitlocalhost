<?php
/**
 * Shortcode Product
 *
 * @link 
 *
 * @package Uni_Theme
 */

class uni_product_shortcode {

	public static $args;

	public function __construct() {

		add_shortcode( 'uniproduct', array( $this, 'render' ) );

	}

	/**
	 * Render the shortcode
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render( $atts, $content = '') {
		$html = '';

		extract( shortcode_atts( array(
            'style'             => 'grid',
			'categories'		=> '',
			'posts_per_page'	=> '5',
			'numcol'			=> '3',
		), $atts ) );

		$args = array(
			'post_type' => 'product',
			'tax_query' => array(
				array(
					'taxonomy' 	=> 'product_cat',
					'field'     => 'id',
					'terms' 	=> $categories
				)
            ),
            'meta_query' => array(
                array(
                    'key' => '_stock_status',
                    'value' => 'instock'
                )
            ),
			'posts_per_page'	=> $posts_per_page,
		);

		$the_query = new WP_Query( $args );

		// The Loop

		if ( $the_query->have_posts() ) {

            switch ( $style ) {
                case 'grid': 
                    $html .= '<div class="product-shortcode column-'. $numcol .'"><ul class="row list-products">';
                        ob_start();
                        while ( $the_query->have_posts() ) {
                            $the_query->the_post();
                            /**
                             * Hook: woocommerce_shop_loop.
                             *
                             * @hooked WC_Structured_Data::generate_product_data() - 10
                             */
                            do_action( 'woocommerce_shop_loop' );
                            wc_get_template_part( 'content', 'product' );
                        }
                        wp_reset_postdata();
                        $html .= ob_get_contents();
                        ob_end_clean();
                    $html .= '</ul></div>';
                break;
                case 'slide':
                    $html .= '<div class="product-shortcode product-slider-shortcode">';
                        $html .= '<div class="slick-carousel list-products" data-items="4" data-items_lg="3" data-items_md="2" data-items_sm="2" data-items_mb="1" data-row="1" data-arrows="true" data-dots="false" data-infinite="true" data-autoplay="true" data-vertical="false">';
                            ob_start();
                            while ( $the_query->have_posts() ) { 
                                $the_query->the_post();
                                /**
                                 * Hook: woocommerce_shop_loop.
                                 *
                                 * @hooked WC_Structured_Data::generate_product_data() - 10
                                 */
                                do_action( 'woocommerce_shop_loop' );
                                wc_get_template_part( 'content-slide', 'product' );
                            }
                            wp_reset_postdata();
                            $html .= ob_get_contents();
                            ob_end_clean();
                        $html .= '</div>';
                    $html .= '</div>'; 
                break;
                default: 
                    $html .= '<div class="product-shortcode column-'. $numcol .'"><ul class="row list-products">';
                        ob_start();
                            while ( $the_query->have_posts() ) {
                                $the_query->the_post();
                                /**
                                 * Hook: woocommerce_shop_loop.
                                 *
                                 * @hooked WC_Structured_Data::generate_product_data() - 10
                                 */
                                do_action( 'woocommerce_shop_loop' );
                                wc_get_template_part( 'content', 'product' );
                            }
                        wp_reset_postdata();
                        $html .= ob_get_contents();
                        ob_end_clean();
                    $html .= '</ul></div>';
                break;
            }

		}

		return $html;
		
	}

}
new uni_product_shortcode();