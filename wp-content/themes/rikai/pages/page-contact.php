<?php
/**
 * Template Name: Page Contact
 *
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Uni_Theme
 */

get_header(); 
wp_enqueue_style( 'contact-style', UNI_DIR .'/assets/css/contact.css' );
$list = get_field('list',get_the_ID());
$form = get_field('form',get_the_ID());
?>

	<div id="primary" class="content-sidebar-wrap">

		<?php do_action( 'before_main_content' ) ?>

		<main id="main" class="site-main" role="main">

			<?php do_action( 'before_loop_main_content' ) ?>
			
			<?php
			while ( have_posts() ) : the_post();

				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <?php if( uni_option('display-pagetitlebar') == false) : ?>
						<section class="contact-header">
							<?php the_title( '<h1 class="page-title"><span>', '</span></h1>' ); ?>
						</section><!-- .contact-header -->
					<?php endif;?>

					<section id="contact" class="contact-content">
						<div class="contact-wrap">
                            <div class="contact-wrap__content">
                                <div class="row">
                                    <div class="col-lg-9 mb-lg-0 mb-5">
                                        <?php 
											//echo do_shortcode( '[contact-form-7 id="5" title="Liên hệ"]' );
											if($list) {
												echo '<div class="address-list">';
													foreach ($list as $key => $value) {
														echo '<div class="address-item">';
															echo '<div class="address">';
																echo '<span class="d-block">'.$value['city'].'</span>';
																echo '<p>'.$value['address'].'</p>';
															echo '</div>';
														echo '</div>';
													}
												echo '</div>';
											}
										?>
                                    </div>
                                </div>
								<div class="form-block">
									<?php 
										echo '<div class="form-excerpt">';
											echo '<p>'.$form['excerpt'].'</p>';
											echo do_shortcode('[contact-form-7 id="'.$form['select_form']->ID.'" title="'.$form['select_form']->post_title.'"]');
										echo '</div>';
									?>
								</div>
                            </div>
                        </div>
					</section><!-- .contact-content -->
					
				</article><!-- #post-## -->
				<?php

			endwhile; // End of the loop.
			?>
		</main><!-- #main -->
		
		<?php //do_action( 'after_main_content' );?>
            
	</div><!-- #primary -->

<?php
get_footer();
