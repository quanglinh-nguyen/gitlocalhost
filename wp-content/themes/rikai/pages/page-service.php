<?php
/**
 * Template Name: Page Service
 *
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Uni_Theme
 */

get_header(); 
wp_enqueue_style( 'service-style', UNI_DIR .'/assets/css/service.css' );
?>

	<div id="primary" class="content-sidebar-wrap">

		<?php do_action( 'before_main_content' ) ?>

		<main id="main" class="site-main" role="main">

			<?php do_action( 'before_loop_main_content' ) ?>

			<?php 
				if( get_field('dp_ss1') == true ) {
					$top_ss1 = get_field('top_ss1');
					echo '<div id="ss1" class="service">';
						echo '<div id="top-ss1" style="background-image:url('.$top_ss1['background'].')">';
							echo '<div class="container">';
								echo '<div class="wrap">';
									echo '<div class="row align-items-center">';
										echo '<div class="col-lg-7 col-md-7">';
											echo '<div class="top-content">';
												if($top_ss1['title']) {
													echo '<h2 class="heading"><span>'.$top_ss1['title'].'</span></h2>';
												}
												echo '<div class="row">';
													if($top_ss1['list']){
														foreach ($top_ss1['list'] as $key => $value) {
															echo '<div class="col-6 mb-5">';
																echo '<div class="top-info">';
																	if($value['icon']) {
																		echo '<div class="top-icon"><img src="'.$value['icon'].'" alt="Icon"></div>';
																	}
																	echo '<div class="top-content">';
																		if($value['title']) {
																			echo '<div class="top-title">'.$value['title'].'</div>';
																		}
																		if($value['content']) {
																			echo '<div class="top-description">'.$value['content'].'</div>';
																		}
																	echo '</div>';
																echo '</div>';
															echo '</div>';
														}
													}
												echo '</div>';
											echo '</div>';
										echo '</div>';
										echo '<div class="col-lg-5 col-md-5 text-center">';
											if($top_ss1['image']) {
												echo '<img src="'.$top_ss1['image'].'" alt="img" />';
											}
										echo '</div>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
						echo '<div id="bottom-ss1" class="bottom-service">';
							echo '<div class="container">';
								echo '<div class="wrap">';
									echo '<div class="wrap-search">';
										echo '<div class="col-lg-6 offset-lg-3">';
											echo get_search_form();
										echo '</div>';
									echo '</div>';
									echo '<div class="row">';
										$cat_service_ss1 = get_field('cat_service_ss1');
										foreach ($cat_service_ss1 as $key => $idcat) {
											echo '<div class="col-md-4">';
												echo '<div class="wrap-service">';
													echo '<h3 class="cat-title">'.get_dm_name($idcat,'service_cat').'</h3>';
													echo '<div class="posts-service">';
														echo do_shortcode('[uniservice posts_per_page="4" categories="'.$idcat.'" number_character="140" style="1"]');
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
					$top_ss2 = get_field('top_ss2');
					echo '<div id="ss2" class="service">';
						echo '<div id="top-ss2">';
							echo '<div class="container">';
								echo '<div class="wrap">';
									echo '<div class="top-content">';
										if($top_ss2['title']) {
											echo '<h2 class="heading"><span subtitle="'.$top_ss2['text_blur'].'">'.$top_ss2['title'].'</span></h2>';
										}
										echo '<div class="row justify-content-center">';
											if($top_ss2['list']){
												foreach ($top_ss2['list'] as $key => $value) {
													echo '<div class="col-lg-3 col-6 mb-sm-5 mb-2">';
														echo '<div class="top-info">';
															if($value['icon']) {
																echo '<div class="top-icon"><img src="'.$value['icon'].'" alt="Icon"></div>';
															}
															if($value['title']) {
																echo '<div class="top-title">'.$value['title'].'</div>';
															}
															if($value['content']) {
																echo '<div class="top-description">'.$value['content'].'</div>';
															}
														echo '</div>';
													echo '</div>';
												}
											}
										echo '</div>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
						echo '<div id="bottom-ss2" class="bottom-service">';
							echo '<div class="container">';
								echo '<div class="wrap">';
									echo '<div class="wrap-search">';
										echo '<div class="col-lg-6 offset-lg-3">';
											echo get_search_form();
										echo '</div>';
									echo '</div>';
									echo '<div class="row">';
										$cat_service_ss2 = get_field('cat_service_ss2');
										foreach ($cat_service_ss2 as $key => $idcat) {
											echo '<div class="col-md-4">';
												echo '<div class="wrap-service">';
													echo '<h3 class="cat-title">'.get_dm_name($idcat,'service_cat').'</h3>';
													echo '<div class="posts-service">';
														echo do_shortcode('[uniservice posts_per_page="4" categories="'.$idcat.'" number_character="140" style="1"]');
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
				if( get_field('dp_ss3') == true ) {
					$top_ss3 = get_field('top_ss3');
					echo '<div id="ss3" class="service">';
						echo '<div class="cir1"></div>';
						echo '<div class="cir2"></div>';
						echo '<div class="cir3"></div>';
						echo '<div id="top-ss3">';
							echo '<div class="container">';
								echo '<div class="wrap">';
									echo '<div class="top-content">';
										if($top_ss3['title']) {
											echo '<h2 class="heading"><span subtitle="'.$top_ss3['text_blur'].'">'.$top_ss3['title'].'</span></h2>';
										}
										echo '<div class="row justify-content-center">';
											if($top_ss3['list']){
												foreach ($top_ss3['list'] as $key => $value) {
													echo '<div class="col-md-4 mb-5">';
														echo '<div class="top-info">';
															if($value['icon']) {
																echo '<div class="top-icon"><img src="'.$value['icon'].'" alt="Icon"></div>';
															}
															echo '<div class="top-content">';
																if($value['title']) {
																	echo '<div class="top-title">'.$value['title'].'</div>';
																}
																if($value['content']) {
																	echo '<div class="top-description">'.$value['content'].'</div>';
																}
															echo '</div>';
														echo '</div>';
													echo '</div>';
												}
											}
										echo '</div>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
						echo '<div id="bottom-ss3" class="bottom-service">';
							echo '<div class="container">';
								echo '<div class="wrap">';
									echo '<div class="wrap-search">';
										echo '<div class="col-lg-6 offset-lg-3">';
											echo get_search_form();
										echo '</div>';
									echo '</div>';
									echo '<div class="row">';
										$cat_service_ss3 = get_field('cat_service_ss3');
										foreach ($cat_service_ss3 as $key => $idcat) {
											echo '<div class="col-md-4">';
												echo '<div class="wrap-service">';
													echo '<h3 class="cat-title">'.get_dm_name($idcat,'service_cat').'</h3>';
													echo '<div class="posts-service">';
														echo do_shortcode('[uniservice posts_per_page="4" categories="'.$idcat.'" number_character="140" style="1"]');
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

				if( get_field('dp_ss4') == true ) {
					$title_ss4 = get_field('title_ss4');
					$permalink_ss4 = get_field('permalink_ss4');
					$background_ss4 = get_field('background_ss4');
					echo '<div id="company-profile" style="background-image: url('.$background_ss4.')">';
						echo '<div class="container">';
							if($title_ss4) {
								echo '<h2 class="cpf-title"><span>'.$title_ss4.'</span></h2>';
							}
							if($permalink_ss4) {
								echo '<div class="cpf-permalink"><a href="'.$permalink_ss4.'"><span> <img src="'.get_stylesheet_directory_uri(  ).'/assets/img/icon/ic-permalink.svg" alt=""> '.__('Click here for details','shtheme').'</span></a></div>';
							}
						echo '</div>';
					echo '</div>';
				}
			?>

		</main><!-- #main -->
		
		<?php //do_action( 'after_main_content' );?>

	</div><!-- #primary -->

<?php
get_footer();
