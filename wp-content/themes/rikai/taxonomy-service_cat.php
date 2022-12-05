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
		<div class="container">
			<div id="primary" class="content-sidebar-wrap">

			<?php do_action( 'before_main_content' ) ?>

			<main id="main" class="site-main" role="main">

				<?php do_action( 'before_loop_main_content' ) ?>
				<?php
					if ( have_posts() ) : 

						// Title 
						// if( uni_option('display-pagetitlebar') == false ) {
							// echo '<h2 class="category-name"><span>';
							// 	single_term_title();
							// echo '</span></h2>';
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
