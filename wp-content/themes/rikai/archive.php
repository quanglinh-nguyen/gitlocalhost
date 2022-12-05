<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Uni_Theme
 */

$blogpost_style = uni_option('blogpost-style');
$archive_object     = get_queried_object();
$archive_id         = $archive_object->term_id;
$archive_taxonomy   = $archive_object->taxonomy;

get_header(); 
wp_enqueue_style( 'category-style', UNI_DIR .'/assets/css/category.css' );
?>

	<div class="wrap-content">
		<div class="news-postview">
			<div class="container">
				<?php 
					wp_enqueue_script( 'slick-js');
					wp_enqueue_style( 'slick-style');
					wp_enqueue_style( 'slick-theme-style');
					$args = array(
						'post_type'         	=> 'post',
						'tax_query' => array(
							array(
								'taxonomy' 		=> $archive_taxonomy,
								'field' 		=> 'id',
								'terms' 		=> $archive_id,
							)
						),
						'posts_per_page'        => 4,
						'meta_key'              => 'postview_number',
						'orderby'               => 'meta_value_num',
						'order'                 => 'DESC',
					);
					$the_query = new WP_Query($args);
					echo '<div class="news-wrap">';
						echo '<div class="slick-carousel list-blogposts" data-items="2" data-items_lg="2" data-items_md="2" data-items_sm="1" data-items_mb="1" data-row="1" data-arrows="true" data-dots="true" data-infinite="false" data-autoplay="true" data-vertical="false">';
						while($the_query->have_posts()):
							$the_query->the_post();
							echo '<div class="news-item">';
								echo '<div class="news-info">';
									echo '<div class="news__icon">';
										echo '<a href="'.get_the_permalink().'"> <img src="'.get_stylesheet_directory_uri(  ).'/assets/img/icon/ic-newspaper.svg" alt="Icon"> </a>';
									echo '</div>';
									echo '<div class="news__content">';
										echo '<div class="news__meta">';
											echo '<span class="date-time">'. get_the_time('F j, Y') .'</span>';
										echo '</div>';
										echo '<h3 class="news__title">';
											echo '<a href="'.get_the_permalink().'">'.get_the_title().'</a>';
										echo '</h3>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
						endwhile;
						echo '</div>';
					echo '</div>';
					wp_reset_postdata();
				?>
			</div>
		</div>
		<div class="container">
			<div id="primary" class="content-sidebar-wrap">

			<?php do_action( 'before_main_content' ) ?>

			<main id="main" class="site-main" role="main">

				<?php do_action( 'before_loop_main_content' ) ?>
				<?php
					if ( have_posts() ) : 

						// Title 
						// if( uni_option('display-pagetitlebar') == false ) {
							echo '<h2 class="category-name"><span>';
								single_term_title();
							echo '</span></h2>';
						// }
						the_archive_description( '<div class="archive-description">', '</div>' );

						// Check hierarchy in theme options
						if( uni_option('blogpost-hierarchy') == true ) {
							/*get posts website*/
							get_template_part( 'template-parts/portfolio/portfolio-child');
							
						} else {
							if($blogpost_style == 1) {
								/*get posts website*/
								get_template_part( 'template-parts/portfolio/portfolio-pagination' );
							} else {
								/** Thêm js vào website */
								wp_enqueue_script( 'univn-ajax', UNI_DIR . '/assets/js/ajax-loadmore/ajax-loadmore-post.js', array('jquery'), '1.0', true );
								wp_localize_script( 'univn-ajax', 'uni_array_ajaxp', array('url' => admin_url( 'admin-ajax.php' )) );

								/*get posts website*/
								get_template_part( 'template-parts/portfolio/portfolio-loadmore');
							}
						}
						
					else :
						echo '<div class="alert alert-info">' . __('The content is being updated','shtheme') . '</div>';
						
					endif; 
				?>

			</main><!-- #main -->

			<?php do_action( 'after_main_content' );?>
			</div><!-- #primary -->
		</div>
	</div>

<?php
get_footer();
