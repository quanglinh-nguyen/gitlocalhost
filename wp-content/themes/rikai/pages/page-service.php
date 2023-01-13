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

				if( get_field('dp_ss5') == true ) {
					$title_ss5 = get_field('title_ss5');
					$permalink_ss4 = get_field('permalink_ss4');
					$background_ss4 = get_field('background_ss4');
					echo '<div id="ss5-service" class="service fadeInUp  " style="background: rgba(0, 134, 209, 0.1); visibility: visible; animation-name: fadeInUp;">';
						echo '<div class="section-cta__bg" >';
						echo '</div>';
						echo '<div class="bg-overlay"></div>';
						echo '<div class="container">';
							if($title_ss5) {
								echo '<div class="cpf-title5">'.$title_ss5.'</div>';
							}
							echo '<div class="wow fadeInUp  effect">';
								echo '<a href="https://rikai-mind.technology/contact-us/" class="btn btn-custom-link">Contact Us </a>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
			?>



		</main><!-- #main -->
		
		<?php //do_action( 'after_main_content' );?>

	</div><!-- #primary -->
<style>
	#ss5-service {
		position: relative;
		padding-top: 140px;
    	padding-bottom: 140px;
	}

	.section-cta__bg{
		position: absolute;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		z-index: -2;
		background-image: url(https://rikai-mind.technology/wp-content/uploads/2022/05/bg-recruitment-1.jpg);
		background-repeat: no-repeat;
		background-size: 100% 100%;
	}
	.bg-overlay{
		position: absolute;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background-color: #000;
		opacity: 0.4;
		z-index: -1;
	}
	.cpf-title5{
		margin-bottom: 50px;
		font-size: 60px;
		font-weight: 500;
		line-height: 1.17;
		color: #51b4eb;
	}

	.btn-custom-link{
		transition: all 0.3s ease;
		background-image: linear-gradient(to right,#82fefe 0%,#4eafe6 51%,#82fefe 100%);
		font-size: 20px;
		font-weight: 500;
		letter-spacing: 1px;
		text-transform: uppercase;
		color: #101e76;
		background-size: 200% auto;
		border-radius: 0;
		padding: 13px 45px;
		display: inline-block;
	}

	@media only screen and (max-width: 850px) {
		#ss5-service {
			padding-top: 90px;
			padding-bottom: 90px;
		}

		.cpf-title5{
			margin-bottom: 40px;
			font-size: 45px;
		}

		.btn-custom-link{
			font-size: 18px;
			padding: 11px 38px;
		}
	}
</style>
<?php
get_footer();
