<?php
/**
 * Template Name: Page Our Promise
 *
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Uni_Theme
 */

get_header(); 
wp_enqueue_style( 'promise-style', UNI_DIR .'/assets/css/promise.css' );
?>

	<div id="primary" class="content-sidebar-wrap">

		<?php do_action( 'before_main_content' ) ?>

		<main id="main" class="site-main" role="main">

			<?php do_action( 'before_loop_main_content' ) ?>

			<?php
				if( get_field('dp_intro') == true ) {
					$tt_intro = get_field('tt_intro');
					$desc_intro = get_field('desc_intro');
					$description = get_field('description_intro');
					$bg_intro = get_field('bg_intro');
					echo '<div id="intro" class="promise">';
						echo '<div class="intro-wrap" style="background-image:url('.$bg_intro.')">';
							echo '<div class="intro-box">';
								if($tt_intro) {
									echo '<h3><span><img src="'.$tt_intro.'" alt=""></span></h3>';
								}
								if($desc_intro) {
									echo '<div class="desc_intro">'.$desc_intro.'</div>';
								}
							echo '</div>';
						echo '</div>';
						echo '<div class="intro-foot">';
							echo '<div class="container">';
								echo '<div class="intro-content">';
									if($description) {
										echo $description;
									}
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
				if( get_field('dp_ss2') == true ) { 
					$tt_ss2 = get_field('tt_ss2');
					$text_blur_ss2 = get_field('text_blur_ss2');
					$excerpt_ss2 = get_field('excerpt_ss2');
					$img_ss2 = get_field('img_ss2');
					$list_ss2 = get_field('list_ss2');
					echo '<div id="ss2" class="promise">';
						echo '<div class="container">';
							echo '<div class="wrap">';
								if($tt_ss2) {
									echo '<h2 class="heading"><span subtitle="'.$text_blur_ss2.'">'.$tt_ss2.'</span></h2>';
								}
								if($excerpt_ss2) {
									echo '<div class="excerpt_ss2">'.$excerpt_ss2.'</div>';
								}
								if($list_ss2) {
									echo '<div class="list_ss2">';
										echo '<div class="row">';
											$stt = 1;
											foreach ($list_ss2 as $key => $value) {
												if( $stt == 2 ) {
													echo '<div class="col-md-4 mb-md-0 mb-5 text-md-left text-center">';
														echo '<img src="'.$img_ss2.'" alt="IMG" />';
													echo '</div>';
												}
												echo '<div class="col-md-4 mb-md-0 mb-5">';
													echo '<div class="ss2-text text-md-left text-center">';
														echo $value['content'];
													echo '</div>';
												echo '</div>';
												$stt++;
											}
										echo '</div>';
									echo '</div>';
								}
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
				if( get_field('dp_ss3') == true ) { 
					$tt_ss3 = get_field('tt_ss3');
					$text_blur_ss3 = get_field('text_blur_ss3');
					$list_ss3 = get_field('list_ss3');
					echo '<div id="ss3" class="promise">';
						echo '<div class="container">';
							echo '<div class="wrap">';
								if($tt_ss3) {
									echo '<h2 class="heading"><span>'.$tt_ss3.'</span></h2>';
								}
								if($text_blur_ss3) {
									echo '<span class="text_blur">'.$text_blur_ss3.'</span>';
								}
								if($list_ss3) {
									echo '<div class="ss3-content">';
										echo '<div class="row">';
											foreach ($list_ss3 as $key => $value) {
												echo '<div class="col-md-6 mb-5">';
													echo '<div class="ss3-line">';
														if($value['icon']) {
															echo '<div class="ss3-icon">';
																echo '<img src="'.$value['icon'].'" />';
															echo '</div>';
														}
														echo '<div class="ss3-description">';
															if($value['title']) {
																echo '<h3 class="ss3-title">';
																	echo $value['title'];
																echo '</h3>';
															}
															if($value['description']) {
																echo '<p class="ss3-desc">';
																	echo $value['description'];
																echo '</p>';
															}
														echo '</div>';
													echo '</div>';
												echo '</div>';
											}
										echo '</div>';
									echo '</div>';
								}
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
				if( get_field('dp_ss4') == true ) {
					$tt_ss4 = get_field('tt_ss4');
					$excerpt_ss4 = get_field('excerpt_ss4');
					$bg_ss4 = get_field('bg_ss4');
					echo '<div id="ss4" class="promise" style="background-image:url('.$bg_ss4.')">';
						echo '<div class="container">';
							echo '<div class="wrap">';
								if($tt_ss4) {
									echo '<h2 class="heading"><span>'.$tt_ss4.'</span></h2>';
								}
								echo '<div class="ss4-content">';
									if($excerpt_ss4) {
										echo '<div class="description">'.$excerpt_ss4.'</div>';
									}
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
				if( get_field('dp_ss5') == true ) { 
					$img_ss5 = get_field('img_ss5');
					echo '<div id="chart" class="promise">';
						echo '<div class="container">';
							echo '<div class="wrap text-center">';
								if($img_ss5) {
									echo '<img src="'.$img_ss5.'" alt="IMG">';
								}
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
				if( get_field('dp_ss6') == true ) { 
					echo do_shortcode('[company_profile]');
				}
			?>

		</main><!-- #main -->
		
		<?php //do_action( 'after_main_content' );?>

	</div><!-- #primary -->

<?php
get_footer();
