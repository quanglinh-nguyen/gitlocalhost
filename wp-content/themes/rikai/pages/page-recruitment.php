<?php
/**
 * Template Name: Page Recruitment
 *
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Uni_Theme
 */

get_header(); 
wp_enqueue_style( 'recruitment-style', UNI_DIR .'/assets/css/recruitment.css' );
?>

	<div id="primary" class="content-sidebar-wrap">

		<?php do_action( 'before_main_content' ) ?>

		<main id="main" class="site-main" role="main">

			<?php do_action( 'before_loop_main_content' ) ?>

			<?php

				if( get_field('dp_intro') == true ) {
					$tt_intro = get_field('tt_intro');
					$desc_intro = get_field('desc_intro');
					$bg_intro = get_field('bg_intro');
					echo '<div id="intro" class="recruitment">';
						echo '<div class="intro-wrap" style="background-image:url('.$bg_intro.')">';
							echo '<div class="intro-box">';
								if($tt_intro) {
									echo '<span>'.$tt_intro.'</span>';
								}
							echo '</div>';
						echo '</div>';
						echo '<div class="intro-foot">';
							echo '<div class="container">';
								echo '<div class="intro-desc">';
									if($desc_intro) {
										echo ''.$desc_intro.'';
									}	
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}

				if( get_field('dp_recruitment') == true ) {
					$tt_recruitment = get_field('tt_recruitment');
					$cat_recruitment = get_field('cat_recruitment');
					$bg_recruitment = get_field('bg_recruitment');
					echo '<div id="recruitment" class="recruitment" style="background-image:url('.$bg_recruitment.')">';
						echo '<div class="container">';
							if($tt_recruitment) {
								echo '<h2 class="heading"><span>'.$tt_recruitment.'</span></h2>';
							}
							echo do_shortcode('[ajax_pagination_post posts_per_page="6" style="3" categories="'.$cat_recruitment.'"]');
						echo '</div>';
					echo '</div>';
				}

				if( get_field('dp_new') == true ) {
					echo '<div id="new" class="recruitment">';
						echo '<div class="cir1"></div>';
						echo '<div class="cir2"></div>';
						echo '<div class="cir3"></div>';
						$tt_new = get_field('tt_new');
						$text_blur_new = get_field('text_blur_new');
						$cat_new = get_field('cat_new');
						echo '<div class="container">';
							echo '<div class="wrap">';
								if($tt_new) {
									echo '<h2 class="heading"><span subtitle="'.$text_blur_new.'">'.$tt_new.'</span></h2>';
								}
								if($cat_new) {
									echo do_shortcode('[uniblog posts_per_page="6" categories="'.$cat_new.'" number_character="120" style="3"]');
								}
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
				if( get_field('dp_why') == true ) {
					echo '<div id="why" class="recruitment">';
						$tt_why = get_field('tt_why');
						$text_blur_why = get_field('text_blur_why');
						$list_why = get_field('list_why');
						echo '<div class="container">';
							echo '<div class="wrap">';
								if($tt_why) {
									echo '<h2 class="heading"><span subtitle="'.$text_blur_why.'">'.$tt_why.'</span></h2>';
								}
								if($list_why) {
									echo '<div class="why-list">';
										foreach ($list_why as $key => $value) {
											echo '<div class="item">';
												echo '<div class="item-info">';
													echo '<div class="item-image">';
														echo '<img class="w-100" src="'.$value['image'].'" alt="'.$value['title'].'" />';
													echo '</div>';
													echo '<div class="item-content">';
														echo '<div class="item-inner">';
															echo '<h3>'.$value['title'].'</h3>';
															echo '<p>'.$value['description'].'</p>';
														echo '</div>';
													echo '</div>';
												echo '</div>';
											echo '</div>';
										}	
									echo '</div>';
								}
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
			?>

		</main><!-- #main -->
		
		<?php //do_action( 'after_main_content' );?>

	</div><!-- #primary -->

<?php
get_footer();
