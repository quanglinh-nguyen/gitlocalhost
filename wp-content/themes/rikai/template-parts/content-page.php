<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Uni_Theme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if( uni_option('display-pagetitlebar') == false ) : ?>
		<section class="page-header">
			<?php the_title( '<h1 class="page-title"><span>', '</span></h1>' ); ?>
		</section><!-- .page-header -->
	<?php endif;?>

	<section class="page-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'shtheme' ),
				'after'  => '</div>',
			) );
		?>
	</section><!-- .page-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<section class="page-footer">
			<?php
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						esc_html__( 'Edit %s', 'shtheme' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</section><!-- .page-footer -->
	<?php endif; ?>
</article><!-- #post-## -->
