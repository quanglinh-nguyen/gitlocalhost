<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Uni_Theme
 */

get_header(); 
wp_enqueue_style( 'single-style', UNI_DIR .'/assets/css/single.css' );
?>

	<div id="primary" class="content-sidebar-wrap">

		<?php do_action( 'before_main_content' ) ?>

		<main id="main" class="site-main" role="main">

			<?php do_action( 'before_loop_main_content' ) ?>
			
			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content' );

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->

		<?php do_action( 'after_main_content' );?>
		
	</div><!-- #primary -->

<?php
get_footer();
