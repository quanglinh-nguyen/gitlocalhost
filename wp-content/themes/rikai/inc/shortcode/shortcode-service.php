<?php
/**
 * Shortcode service
 *
 * @link 
 *
 * @package Uni_Theme
 */
class uni_service_shortcode {

	public static $args;

	public function __construct() {

		add_shortcode( 'uniservice', array( $this, 'render' ) );

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
			'style'   						=> '1',
			'posts_per_page'				=> '5',
			'categories'					=> '',
			'viewmore_text'					=> __( 'Read more', 'shtheme' ),
			'post_category'					=> '1',
			'post_link'					    => '1',
			'post_meta'						=> '1',
			'post_thumb'					=> '1',
			'post_desc'						=> '1',
			'number_character'				=> 200,
		), $atts ) );

		$args = array(
			'post_type' => 'service',
			'tax_query' => array(
				array(
					'taxonomy' 	=> 'service_cat',
					'field'     => 'id',
					'terms' 	=> $categories
				)
            ),
            'post_status'       => 'publish',
			'posts_per_page'	=> $posts_per_page,
		);

		$the_query = new WP_Query( $args );
		// The Loop
		if ( $the_query->have_posts() ) {

			$html .= '<div class="blog-shortcode style-'. $style .'">';
			switch ( $style ) {
				case '1':
					$html .= $this->blog_style_1( $the_query, $atts );
					break;
				case '2':
					$html .= $this->blog_style_2( $the_query, $atts );
					break;
				case '3':
					$html .= $this->blog_style_3( $the_query, $atts );
					break;
				case '4':
					$html .= $this->blog_style_4( $the_query, $atts );
					break;
				case '5':
					$html .= $this->blog_style_5( $the_query, $atts );
					break;
				case '6':
					$html .= $this->blog_style_6( $the_query, $atts );
					break;
				case '7':
					$html .= $this->blog_style_7( $the_query, $atts );
					break;
				case '8':
					$html .= $this->blog_style_8( $the_query, $atts );
					break;
                case 'slide':
                    $html .= $this->blog_style_slide( $the_query, $atts );
                    break;
				default:
					$html .= $this->general_post_html( $the_query, $atts );
					break;
			}
			$html .= '</div>';

		}

		return $html;
		
	}

	/**
	 *
	 * Blog style 1
	 *
	 * @param  $the_query: Query get data; $atts: attribute
	 * @return $html: html of blog style 1
	 *
	 */
	function blog_style_1 ( $the_query, $atts ) {

		$image_size 			= 'large';	
		$post_class 			= array( 'element', 'hentry', 'post-item' );
		$post_class[] 			= 'col-md-12';
		$atts['post_category'] 	= '0';
		$atts['post_desc'] 		= '0';

		$html = '';
		$html .= '<div class="row">';
		while ( $the_query->have_posts() ) { $the_query->the_post();

			$html .= $this->general_post_html( $post_class, $atts, $image_size );

		}
		wp_reset_postdata();
		$html .= '</div>';
		return $html;

	}
	
	/**
	 *
	 * Blog style 2
	 *
	 * @param  $the_query: Query get data; $atts: attribute
	 * @return $html: html of blog style 2
	 *
	 */
	function blog_style_2 ( $the_query, $atts ) {

		$image_size 			= 'large';
		$post_class 			= array( 'element', 'hentry', 'post-item' );
		$post_class[] 			= 'col-lg-6 col-md-6 col-sm-6';
		$atts['post_category'] 	= '0';
		$atts['post_meta']		= '1';

		$html = '';
		$html .= '<div class="row">';
		while ( $the_query->have_posts() ) { $the_query->the_post();

			$html .= $this->general_post_html( $post_class, $atts, $image_size );

		}
		wp_reset_postdata();
		$html .= '</div>';
		return $html;

	}

	/**
	 *
	 * Blog style 3
	 *
	 * @param  $the_query: Query get data; $atts: attribute
	 * @return $html: html of blog style 3
	 *
	 */
	function blog_style_3 ( $the_query, $atts ) {
		
		$image_size 			= 'large';
		$post_class 			= array( 'element', 'hentry', 'post-item' );
		$post_class[] 			= 'col-lg-4 col-md-6 col-sm-6';
		$atts['post_category'] 	= '0';
		$atts['post_meta']		= '2';
		
		$html = '';
		$html .= '<div class="row">';
		while ( $the_query->have_posts() ) { $the_query->the_post();

			$html .= $this->general_post_html( $post_class, $atts, $image_size );

		}
		wp_reset_postdata();
		$html .= '</div>';
		return $html;
	}

	/**
	 *
	 * Blog style 4
	 *
	 * @param  $the_query: Query get data; $atts: attribute
	 * @return $html: html of blog style 4
	 *
	 */
	function blog_style_4 ( $the_query, $atts ) {

		$image_size 			= 'large';
		$post_class 			= array( 'element', 'hentry', 'post-item' );
		$post_class[] 			= 'col-lg-3 col-md-6 col-sm-6';
		$atts['post_category'] 	= '0';
		$atts['post_meta']		= '1';

		$html = '';
		$html .= '<div class="row">';
		while ( $the_query->have_posts() ) { $the_query->the_post();

			$html .= $this->general_post_html( $post_class, $atts, $image_size );

		}
		wp_reset_postdata();
		$html .= '</div>';
		return $html;
	}

	/**
	 *
	 * Blog style 5
	 *
	 * @param  $the_query: Query get data; $atts: attribute
	 * @return $html: html of blog style 5
	 *
	 */
	function blog_style_5 ( $the_query, $atts ) {
		
		$image_size 			= 'large';
		$post_class 			= array( 'element', 'hentry', 'post-item' );
		$post_class[] 			= 'col-lg-6 col-md-6 col-sm-6';
		$atts['post_category'] 	= '0';

		$html = '';
		$html .= '<div class="row">';
		while ( $the_query->have_posts() ) { $the_query->the_post();

			$html .= $this->general_post_html( $post_class, $atts, $image_size );

		}
		wp_reset_postdata();
		$html .= '</div>';
		return $html;
	}

	/**
	 *
	 * Blog style 6
	 *
	 * @param  $the_query: Query get data; $atts: attribute
	 * @return $html: html of blog style 6
	 *
	 */
	function blog_style_6 ( $the_query, $atts ) {

		$i = 0;
		$image_size 			= 'large';
		$post_class 			= array( 'element', 'hentry', 'post-item' );
		$atts['post_category'] 	= '0';

		$html = '';
		$html .= '<div class="row">';
		while ( $the_query->have_posts() ) { $the_query->the_post(); $i++;

			if ( $i == 1 ) {
				// $image_size 					= 'large';
				$atts['post_link']			    = '0';
				$atts['post_meta']			    = '2';
				$atts['number_character']		= '270';
				
				$html .= '<div class="col-md-6 first-element-layout">';
				$html .= $this->general_post_html( $post_class, $atts, $image_size );
				$html .= '</div>';
				if( $atts['posts_per_page'] > 1 ) {
					$html .= '<div class="col-md-6 second-element-layout">';
				}
			} else {
				// $image_size 					= 'large';
				$atts['post_meta'] 				= '1';
				$atts['post_link'] 			    = '0';
				$atts['post_desc'] 				= '0';
				
				$html .= $this->general_post_html( $post_class, $atts, $image_size );
			}
			if ( $i == count( $the_query->posts ) ) {
				$html .= '</div>';
			}

		}
		wp_reset_postdata();
		$html .= '</div>';
		return $html;
	}

	/**
	 *
	 * Blog style 7
	 *
	 * @param  $the_query: Query get data; $atts: attribute
	 * @return $html: html of blog style 7
	 *
	 */
	function blog_style_7 ( $the_query, $atts ) {

		$i = 0;
		$image_size 			= 'large';
		$post_class 			= array( 'element', 'hentry', 'post-item' );
		$atts['post_category'] 	= '0';

		$html = '';
		$html .= '<div class="row">';
		while ( $the_query->have_posts() ) { $the_query->the_post(); $i++;

			if ( $i == 1 ) {
				// $image_size 					= 'large';
				$atts['post_link']			    = '1';

				$html .= '<div class="col-md-12 first-element-layout">';
				$html .= $this->general_post_html( $post_class, $atts, $image_size );
				$html .= '</div>';
				if( $atts['posts_per_page'] > 1 ) {
					$html .= '<div class="col-md-12 second-element-layout">';
				}
			} else {
				// $image_size 					= 'large';
				$atts['post_thumb'] 			= '0';
				$atts['post_meta'] 				= '0';
				$atts['post_link'] 			    = '0';
				$atts['post_desc'] 				= '0';
				
				$html .= $this->general_post_html( $post_class, $atts, $image_size );
			}
			if ( $i == count( $the_query->posts ) ) {
				$html .= '</div>';
			}

		}
		wp_reset_postdata();
		$html .= '</div>';
		return $html;
	}

	/**
	 *
	 * Blog style 8
	 *
	 * @param  $the_query: Query get data; $atts: attribute
	 * @return $html: html of blog style 8
	 *
	 */
	function blog_style_8 ( $the_query, $atts ) {

		$i = 0;
		$image_size 			= 'large';
		$post_class 			= array( 'element', 'hentry', 'post-item' );
		$atts['post_category'] 	= '0';
		$atts['post_meta'] 		= '0';
		$atts['post_link'] 	    = '0';
		$atts['post_desc'] 		= '0';

		$html = '';
		$html .= '<div class="row">';
		while ( $the_query->have_posts() ) { $the_query->the_post(); $i++;

			if ( $i == 1 ) {
				$image_size 					= 'large';
				
				$html .= '<div class="col-md-6 first-element-layout">';
				$html .= $this->general_post_html( $post_class, $atts, $image_size );
				$html .= '</div>';
				if( $atts['posts_per_page'] > 1 ) {
					$html .= '<div class="col-md-6 second-element-layout"><div class="row">';
				}
			} else {
				$image_size 			= 'large';
				$post_class[] 			= 'col-6';
				
				$html .= $this->general_post_html( $post_class, $atts, $image_size );
			}
			if ( $i == count( $the_query->posts ) ) {
				$html .= '</div></div>';
			}

		}
		wp_reset_postdata();
		$html .= '</div>';
		return $html;
	}

    /**
	 *
	 * Blog style 1
	 *
	 * @param  $the_query: Query get data; $atts: attribute
	 * @return $html: html of blog style 1
	 *
	 */
	function blog_style_slide ( $the_query, $atts ) {
		
		$image_size 			= 'large';	
		$post_class 			= array( 'element', 'hentry', 'post-item' );
		$post_class[] 			= 'slide-item';
		$atts['post_category'] 	= '0';

		$html = '';
        $html .= '<div class="slick-carousel list-blogposts" data-items="4" data-items_lg="3" data-items_md="2" data-items_sm="2" data-items_mb="1" data-row="1" data-arrows="true" data-dots="false" data-infinite="true" data-autoplay="true" data-vertical="false">';
		while ( $the_query->have_posts() ) { $the_query->the_post();

			$html .= $this->general_post_html( $post_class, $atts, $image_size );

		}
		wp_reset_postdata();
		$html .= '</div>';
		return $html;

	}

	/**
	 *
	 * General post html
	 *
	 * @param  $post_class: class of post
	 * @return $html: html of post
	 *
	 */
	function general_post_html ( $post_class = array(), $atts = array(), $image_size = 'large' ) {
		extract( shortcode_atts( array(
			'posts_per_page'				=> '5',
			'categories'					=> '',
			'viewmore_text'					=> __( 'Read more', 'shtheme' ),
			'post_category'					=> '0',
			'post_link'					    => '0',
			'post_meta'						=> '0',
			'post_thumb'					=> '1',
			'post_desc'						=> '1',
			'number_character'				=> 200,
		), $atts ) );

		$html = '';
		$html .= '<article id="post-'. get_the_ID() .'" class="'. implode( ' ', get_post_class( $post_class ) ) .'"><div class="post-info">';
		// Check display thumb of post
		if ( $post_thumb == '1' && has_post_thumbnail() ) :
			$html .= '<div class="post-info__thumb">';
				$html .= '<a class="d-block img" href="'. get_permalink() .'" title="'. get_the_title() .'" style="background-image:url('.get_the_post_thumbnail_url(get_the_ID(), $image_size ).')" ></a>';
			$html .= '</div>';
		endif;
		$html .= '<div class="post-info__content">';
			// Check display category
            if ( $post_category == '1' ) {
                $primaryID = get_primary_term('category',get_the_ID());
                if($primaryID) {
                    $html .= '<div class="post-info__category">';
                        $html .= '<a href="'. get_dm_link($primaryID,'category') .'" title="'. get_dm_name($primaryID,'category') .'"><span>'. get_dm_name($primaryID,'category') .'</span></a>';
                    $html .= '</div>';
                }
            }
			// Metadata
			if ( $post_meta == '2' ) {
				$html .= '<div class="post-info__meta">';
					$html .= '<span class="date-time">'. get_the_time('F j, Y') .'</span>';
					// $comments_count = wp_count_comments( get_the_ID() );
					// $html .= '<span class="number-comment"><i class="icon-comment"></i>'. $comments_count->approved . ' ' . __( 'Comments', 'shtheme' ) . '</span>';
				$html .= '</div>';
			}
			$html .= '<h3 class="post-info__title"><a href="'. get_permalink() .'" title="'. get_the_title() .'">'. get_the_title() .'</a></h3>';
			// Metadata
			if ( $post_meta == '1' ) {
				$html .= '<div class="post-info__meta">';
					$html .= '<span class="date-time"><i class="icon-clock"></i>'. get_the_time('F j, Y') .'</span>';
					// $comments_count = wp_count_comments( get_the_ID() );
					// $html .= '<span class="number-comment"><i class="icon-comment"></i>'. $comments_count->approved . ' ' . __( 'Comments', 'shtheme' ) . '</span>';
				$html .= '</div>';
			}
			// Check display description
			if ( $post_desc == '1' ) {
				$html .= '<div class="post-info__description">'. get_the_content_limit( $number_character,' ' ) .'</div>';
			}
			// Check display view more button
			if ( $post_link == '1' ) {
				$html .= '<div class="post-info__link"><a href="'. get_permalink() .'" title="'. get_the_title() .'">'. $viewmore_text .' <i class="icon-angle-double-right"></i></a></div>';
			}
		$html .= '</div>';
		$html .= '</div></article>';
		return $html;
	}

}
new uni_service_shortcode();