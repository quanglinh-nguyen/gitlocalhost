<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Uni_Theme
 */
get_header(); ?>

	<div id="primary" class="content-sidebar-wrap">

		<?php do_action( 'before_main_content' ) ?>

		<main id="main" class="site-main" role="main">

			<?php do_action( 'before_loop_main_content' ) ?>

			<?php
			if ( have_posts() ) : ?>

				<h1 class="page-title"><span><?php printf( esc_html__( 'Search for keyword: %s', 'shtheme' ), '<span>' . get_search_query() . '</span>' ); ?></span></h1>

				<?php

                // Settings Loop
                $blogpost_layout                = 5;
                $blogpost_style                 = 1;
                $posts_per_page                 = 10;
                $new_post                       = new uni_service_shortcode();
                $image_size                     = 'large';
                $post_type                      = array('service');
                $paged                          = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $post_class                     = array( 'element', 'hentry', 'post-item' );

                $atts['post_thumb']                 = '0';
                $atts['post_category']              = '0';
                $atts['post_desc']                  = '0';
                $atts['post_meta']                  = '0';
                $atts['post_link']                  = '0';
                $atts['number_character']           = '120';

                // Settings Style
                switch ( $blogpost_layout ) {
                    case '1':
                        $post_class[]               = 'col-md-12';
                        $style                      = 'style-1';
                        break;
                    case '2':
                        $post_class[]               = 'col-lg-4 col-md-6 col-sm-6';
                        $style                      = 'style-2';
                        break;
                    case '3':
                        $post_class[]               = 'col-lg-4 col-md-6 col-sm-6';
                        $style                      = 'style-3';
                        break;
                    case '4':
                        $post_class[]               = 'col-lg-3 col-md-6 col-sm-6';
                        $style                      = 'style-4';
                        break;
                    case '5':
                        $post_class[]               = 'col-lg-6 col-md-6 col-sm-6';
                        $style                      = 'style-5';
                        break;
                    default:
                        $post_class[]               = 'col-md-12';
                        $style                      = 'style-1';
                        break;
                }

                $keyword = $_GET['s'];
                $args = array(
                    's'     			=> $keyword,
                    'post_type' 		=> $post_type,
                    'post_status'       => 'publish',
                    'posts_per_page'	=> $posts_per_page,
                    'paged'             => $paged,
                );
				
				/* Start the Loop */
                $the_query = new WP_Query( $args );

                /*Tổng bài viết trong query trên*/
                $total_records = $the_query->found_posts;
            
                /*Tổng số page*/
                $total_pages = ceil($total_records/$posts_per_page);

				echo '<div id="result_pagination">';
                    echo  '<div class="blog-shortcode '.$style.'"><div class="row">';
                        while($the_query->have_posts()):$the_query->the_post();
                            echo $new_post->general_post_html( $post_class, $atts, $image_size );
                        endwhile;
                        wp_reset_postdata();
                    echo '</div></div>';
                    wp_reset_postdata();
                    uni_pagination($the_query);
                echo  '</div>';
                wp_reset_query();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif; ?>

		</main><!-- #main -->

		<?php //do_action( 'after_main_content' );?>
		
	</div><!-- #primary -->

<?php
get_footer();
