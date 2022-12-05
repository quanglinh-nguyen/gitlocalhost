<?php
/**
 * Template Name: Page Company Info
 *
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Uni_Theme
 */

get_header(); 
wp_enqueue_style( 'company-style', UNI_DIR .'/assets/css/company.css' );
?>

	<div id="primary" class="content-sidebar-wrap">

		<?php do_action( 'before_main_content' ) ?>

		<main id="main" class="site-main" role="main">

			<?php do_action( 'before_loop_main_content' ) ?>

			<?php
				if( get_field('dp_ss1') == true ) { 
					$list_ss1 = get_field('list_ss1');
					echo '<div id="ss1" class="company">';
						echo '<div class="wrap-abs">';
							echo '<div class="container">';
								echo '<div class="wrap">';
									echo '<div class="row">';
										foreach ($list_ss1 as $key => $value) {
											$info = $value['info'];
											echo '<div class="col-md-4 mb-md-0 mb-5">';
												echo '<div class="company-info">';
													echo '<div class="company-inner">';
														echo '<h4>'.$value['title'].'</h4>';
														echo '<span class="text_blur">'.$value['text_blur'].'</span>';
														echo '<div class="company-info__list">';
															foreach ($info as $key => $value) {
																echo '<div class="company-info__block">';
																	if($value['icon']) {
																		echo '<div class="company-info__icon"><img src="'.$value['icon'].'" alt="Icon"></div>';
																	}
																	if($value['description']) {
																		echo '<div class="company-info__description">'.$value['description'].'</div>';
																	}
																echo '</div>';
															}
														echo '</div>';
													echo '</div>';
												echo '</div>';
											echo '</div>';
										}
									echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
				if( get_field('dp_ss2') == true ) { 
					$tt_ss2 = get_field('tt_ss2');
					$list_ss2 = get_field('list_ss2');
					echo '<div id="ss2" class="company">';
						echo '<div class="container">';
							echo '<div class="wrap">';
								if($tt_ss2) {
									echo '<h2 class="heading"><span>'.$tt_ss2.'</span></h2>';
								}
								if($list_ss2) {
									echo '<div class="ss2-content">';
										echo '<div class="row">';
											foreach ($list_ss2 as $key => $value) {
												echo '<div class="col-md-6 mb-5">';
													echo '<div class="ss2-line">';
														if($value['icon']) {
															echo '<div class="ss2-icon">';
																echo '<img src="'.$value['icon'].'" />';
															echo '</div>';
														}
														echo '<div class="ss2-description">';
															if($value['title']) {
																echo '<h3 class="ss2-title">';
																	echo $value['title'];
																echo '</h3>';
															}
															if($value['description']) {
																echo '<p class="ss2-desc">';
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
				if( get_field('dp_ss3') == true ) {
					echo '<div id="history" class="company">';
						$tt_ss3 = get_field('tt_ss3');
						$text_blur_ss3 = get_field('text_blur_ss3');
						$list_ss3 = get_field('list_ss3');
						echo '<div class="container">';
							echo '<div class="wrap">';
								if($tt_ss3) {
									echo '<h2 class="heading"><span subtitle="'.$text_blur_ss3.'">'.$tt_ss3.'</span></h2>';
								}
								if($list_ss3) {
									echo '<div class="history-block">';
										echo '<div class="history-box">';
											foreach ($list_ss3 as $key => $value) {
												$title = $value['title'];
												$list_history = $value['list_history'];
												echo '<div class="history-item">';
													echo '<div class="history-inner">';
														echo '<div class="history-title">';
															echo '<span>'.$value['title'].'</span>';
														echo '</div>';
														echo '<div class="history-process">';
															echo '<div class="history-process-inner">';
																foreach ($list_history as $key => $value) {
																	echo '<div class="history-timeline">';
																		echo '<h4 class="d-block">'.$value['title'].'</h4>';
																		echo '<p>'.$value['excerpt'].'</p>';
																	echo '</div>';
																}
															echo '</div>';
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
					$list_ss4 = get_field('list_ss4');
					echo '<div id="map" class="company">';
						echo '<div class="container">';
							echo '<div class="wrap">';
								if($tt_ss4) {
									echo '<h2 class="heading"><span>'.$tt_ss4.'</span></h2>';
								}
								if($list_ss4) {
									echo '<div class="list-map">';
										echo '<div class="row list-row justify-content-center">';
											foreach ($list_ss4 as $key => $value) {
												echo '<div class="col-md-6 col-sm-6 mb-5">';
													echo '<div class="item-map">';
														echo '<div class="item-info">';
															if($value['image']) {
																echo '<div class="item-image">';
																	echo '<span class="d-block" style="background-image:url('.$value['image'].')"></span>';
																echo '</div>';
															}
															echo '<div class="item-content">';
																if($value['title']) {
																	echo '<h3 class="item-title">';
																		echo $value['title'];
																	echo '</h3>';
																}
																if($value['excerpt']) {
																	echo '<p class="item-desc">';
																		echo $value['excerpt'];
																	echo '</p>';
																}
															echo '</div>';
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
				if( get_field('dp_ss5') == true ) { 
					echo do_shortcode('[company_profile]');
				}
			?>

		</main><!-- #main -->
		
		<?php //do_action( 'after_main_content' );?>

	</div><!-- #primary -->

<?php
get_footer();
