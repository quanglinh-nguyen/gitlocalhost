<?php
/**
 * Template Name: Page Left Sidebar
 *
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Uni_Theme
 */

get_header(); ?>

	<div id="primary" class="content-sidebar-wrap content-sidebar-left">

		<?php do_action( 'before_main_content' ) ?>

		<main id="main" class="site-main" role="main">

			<?php do_action( 'before_loop_main_content' ) ?>

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
		
		<?php do_action( 'after_main_content' );?>

	</div><!-- #primary -->

<?php
get_footer();
