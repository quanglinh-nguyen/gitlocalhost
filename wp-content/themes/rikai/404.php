<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Uni_Theme
 */

get_header();
?>

	<div id="primary" class="content-sidebar-wrap">

		<?php do_action( 'before_main_content' ) ?>
		
		<main id="main" class="site-main" role="main">

			<?php do_action( 'before_loop_main_content' ) ?>

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><span><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'shtheme' ); ?></span></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'shtheme' ); ?></p>

					<div class="mb-5">
						<?php
							get_search_form();
						?>
					</div>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->

		<?php do_action( 'after_main_content' );?>

	</div><!-- #primary -->

<?php
get_footer();
