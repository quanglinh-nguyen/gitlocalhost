<?php
/**
 * Template Name: Page Home
 *
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Uni_Theme
 */
get_header(); 

wp_enqueue_style( 'home-style', UNI_DIR .'/assets/css/home.css' );
// wp_enqueue_style( 'aos-css');
// wp_enqueue_script( 'aos-js');
?>
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
	<div id="primary" class="content-sidebar-wrap">

		<?php do_action( 'before_main_content' ) ?>

		<main id="main" class="site-main" role="main">

			<?php do_action( 'before_loop_main_content' ) ?>
			
			<?php 
				if( get_field('dp_ss1') == true ) { 
					$tt_ss1 = get_field('tt_ss1');
					$list_ss1 = get_field('list_ss1');
					echo '<div id="ss1" class="homepage">';
						echo '<div class="ss1-wrap">';
							echo '<div class="container">';
								echo '<div class="wrap">';
									if($tt_ss1) {
										echo '<h2 class="heading" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="1000"><span>'.$tt_ss1.'</span></h2>';
									}
									if($list_ss1) {
										echo '<div class="list-problem">';
											echo '<div class="row list-row justify-content-center">';
												foreach ($list_ss1 as $key => $value) {
													echo '<div class="col-md-4 col-sm-6 mb-md-0 mb-5"  data-aos="fade-up"
													data-aos-anchor-placement="top-bottom" data-aos-duration="1000">';
														echo '<a class="item-ss1 d-block" href="'.$value['permalink'].'">';
															echo '<div class="item-info">';
																if($value['icon']) {
																	echo '<div class="item-icon">';
																		echo '<img src="'.$value['icon'].'" />';
																	echo '</div>';
																}
																echo '<div class="item-content">';
																	if($value['title']) {
																		echo '<h3 class="item-title">';
																			echo $value['title'];
																		echo '</h3>';
																	}
																echo '</div>';
															echo '</div>';
														echo '</a>';
													echo '</div>';
												}
											echo '</div>';
										echo '</div>';
									}
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
				if( get_field('dp_ss2') == true ) { 
					$tt_ss2 = get_field('tt_ss2');
					$bg_ss2 = get_field('bg_ss2');
					$list_ss2 = get_field('list_ss2');
					echo '<div id="ss2" class="homepage" style="background-image:url('.$bg_ss2.')">';
						echo '<div class="container">';
							echo '<div class="wrap">';
								if($tt_ss2) {
									echo '<h2 class="heading text-center" data-aos="fade-up"
									data-aos-anchor-placement="top-bottom" data-aos-duration="1000"><span>'.$tt_ss2.'</span></h2>';
								}
								if($list_ss2) {
									echo '<div class="list-problem">';
										echo '<div class="col-lg-10 offset-lg-1">';
											echo '<div class="row list-row justify-content-center">';
												foreach ($list_ss2 as $key => $value) {
													echo '<div class="col-md-3 col-sm-6 mb-5" data-aos="fade-up"
													data-aos-anchor-placement="top-bottom" data-aos-duration="1000">';
														echo '<div class="item-ss2 d-block">';
															echo '<div class="item-info">';
																if($value['icon']) {
																	echo '<div class="item-icon">';
																		echo '<img src="'.$value['icon'].'" />';
																	echo '</div>';
																}
																echo '<div class="item-content">';
																	if($value['content']) {
																		echo $value['content'];
																	}
																echo '</div>';
															echo '</div>';
														echo '</div>';
													echo '</div>';
												}
											echo '</div>';
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
					$permalink_ss3 = get_field('permalink_ss3');
					$img_ss3 = get_field('img_ss3');
					$list_ss3 = get_field('list_ss3');
					echo '<div id="ss3" class="homepage">';
						echo '<div class="container">';
							echo '<div class="wrap">';
								echo '<div class="row">';
									echo '<div class="col-lg-6 col-md-5 text-center mb-md-0 mb-5" data-aos="fade-right" data-aos-anchor-placement="top-bottom" data-aos-duration="1000">';
										if($img_ss3) {
											echo '<img src="'.$img_ss3.'" alt="IMG" />';
										}
									echo '</div>';
									echo '<div class="col-lg-6 col-md-7" data-aos="fade-left"
									data-aos-anchor-placement="top-bottom" data-aos-duration="1000">';
										if($tt_ss3) {
											echo '<h2 class="heading"><span subtitle="'.$text_blur_ss3.'">'.$tt_ss3.'</span></h2>';
										}
										if($permalink_ss3) {
											echo '<p class="permalink_ss3" data-aos="fade-up"
											data-aos-anchor-placement="top-bottom" data-aos-duration="1000"><a href="'.$permalink_ss3.'"><img src="'.get_stylesheet_directory_uri(  ).'/assets/img/icon/ic-permalink.svg" alt=""> <span>'.__('Click here for details','shtheme').'</span></a></p>';
										}
										if($list_ss3) {
											echo '<div class="list-ss3">';
												echo '<div class="row list-row justify-content-center">';
													foreach ($list_ss3 as $key => $value) {
														echo '<div class="col-md-6 col-sm-6 col-6 mb-5" data-aos="fade-up"
														data-aos-anchor-placement="top-bottom" data-aos-duration="1000">';
															echo '<a class="item-ss3 d-block" href="'.$value['permalink'].'">';
																echo '<div class="item-info">';
																	if($value['icon']) {
																		echo '<div class="item-icon">';
																			echo '<img src="'.$value['icon'].'" />';
																		echo '</div>';
																	}
																	echo '<div class="item-content">';
																		if($value['title']) {
																			echo $value['title'];
																		}
																	echo '</div>';
																echo '</div>';
															echo '</a>';
														echo '</div>';
													}
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
					$tt_ss4 = get_field('tt_ss4');
					$text_blur_ss4 = get_field('text_blur_ss4');
					$permalink_ss4 = get_field('permalink_ss4');
					$img_ss4 = get_field('img_ss4');
					$content_ss4 = get_field('content_ss4');
					echo '<div id="ss4" class="homepage">';
						echo '<div class="container">';
							echo '<div class="wrap">';
								echo '<div class="row">';
									echo '<div class="col-lg-6 col-md-7 order-md-1 order-2" data-aos="fade-right"
									data-aos-anchor-placement="top-bottom" data-aos-duration="1000">';
										if($tt_ss4) {
											echo '<h2 class="heading"><span subtitle="'.$text_blur_ss4.'">'.$tt_ss4.'</span></h2>';
										}
										if($permalink_ss4) {
											echo '<p class="permalink_ss4"><a href="'.$permalink_ss4.'"><img src="'.get_stylesheet_directory_uri(  ).'/assets/img/icon/ic-permalink.svg" alt=""> <span>'.__('Click here for details','shtheme').'</span></a></p>';
										}
										if($content_ss4) {
											echo '<div class="content-ss4">'.$content_ss4.'</div>';
										}
									echo '</div>';
									echo '<div class="col-lg-6 col-md-5 order-md-2 order-1 text-center mb-md-0 mb-5" data-aos="fade-left"
									data-aos-anchor-placement="top-bottom" data-aos-duration="1000">';
										if($img_ss4) {
											echo '<img src="'.$img_ss4.'" alt="IMG" />';
										}
									echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
				if( get_field('dp_ss5') == true ) { 
					$tt_ss5 = get_field('tt_ss5');
					$permalink_ss5 = get_field('permalink_ss5');
					$content_ss5 = get_field('content_ss5');
					$bg_ss5 = get_field('bg_ss5');
					$list_ss5 = get_field('list_ss5');
					echo '<div id="ss5" class="homepage" style="background-image:url('.$bg_ss5.')">';
						echo '<div class="ss5-wrap">';
							echo '<div class="container">';
								echo '<div class="wrap">';
									if($tt_ss5) {
										echo '<h2 class="heading" data-aos="fade-up"
										data-aos-anchor-placement="top-bottom" data-aos-duration="1000"><span>'.$tt_ss5.'</span></h2>';
									}
									if($permalink_ss5) {
										echo '<p class="permalink_ss5" data-aos="fade-up"
										data-aos-anchor-placement="top-bottom" data-aos-duration="1000"><a href="'.$permalink_ss5.'"><img src="'.get_stylesheet_directory_uri(  ).'/assets/img/icon/ic-permalink.svg" alt=""> <span>'.__('Click here for details','shtheme').'</span></a></p>';
									}
									if($content_ss5) {
										echo '<div class="content-ss5 col-lg-8 offset-lg-2" data-aos="fade-up"
										data-aos-anchor-placement="top-bottom" data-aos-duration="1000">'.$content_ss5.'</div>';
									}
									if($list_ss5) {
										echo '<div class="list-problem" data-aos="fade-up"
										data-aos-anchor-placement="top-bottom" data-aos-duration="1000">';
											echo '<div class="row list-row justify-content-center">';
												foreach ($list_ss5 as $key => $value) {
													echo '<div class="col-md-4 col-sm-4 mb-2">';
														echo '<a class="item-ss5 d-block" href="'.$value['permalink'].'">';
															echo '<div class="item-info">';
																if($value['icon']) {
																	echo '<div class="item-icon">';
																		echo '<img src="'.$value['icon'].'" />';
																	echo '</div>';
																}
																echo '<div class="item-content">';
																	if($value['title']) {
																		echo '<h3 class="item-title">';
																			echo $value['title'];
																		echo '</h3>';
																	}
																echo '</div>';
															echo '</div>';
														echo '</a>';
													echo '</div>';
												}
											echo '</div>';
										echo '</div>';
									}
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
				if( get_field('dp_ss6') == true ) { 
					$tt_ss6 = get_field('tt_ss6');
					$text_blur_ss6 = get_field('text_blur_ss6');
					$permalink_ss6 = get_field('permalink_ss6');
					$content_ss6 = get_field('content_ss6');
					echo '<div id="ss6" class="homepage">';
						echo '<div class="container">';
							echo '<div class="wrap">';
								if($tt_ss6) {
									echo '<h2 class="heading" data-aos="fade-up"
									data-aos-anchor-placement="top-bottom" data-aos-duration="1000"><span subtitle="'.$text_blur_ss6.'">'.$tt_ss6.'</span></h2>';
								}
								if($permalink_ss6) {
									echo '<p class="permalink_ss6" data-aos="fade-up"
									data-aos-anchor-placement="top-bottom" data-aos-duration="1000"><a href="'.$permalink_ss6.'"><img src="'.get_stylesheet_directory_uri(  ).'/assets/img/icon/ic-permalink.svg" alt=""> <span>'.__('Click here for details','shtheme').'</span></a></p>';
								}
								echo '<div class="main-ss6">';
									if($content_ss6['title']) {
										echo '<h2 class="heading heading_ct text-center" data-aos="fade-up"
										data-aos-anchor-placement="top-bottom" data-aos-duration="1000">'.$content_ss6['title'].'</h2>';
									}
									if($content_ss6['list']) {
										echo '<div class="list-problem" data-aos="fade-up"
										data-aos-anchor-placement="top-bottom" data-aos-duration="1000">';
											echo '<div class="row list-row justify-content-center">';
												foreach ($content_ss6['list'] as $key => $value) {
													echo '<div class="col-md-4 col-sm-4 mb-5">';
														echo '<a class="item-ss6 d-block" href="'.$value['permalink'].'">';
															echo '<div class="item-info">';
																if($value['text']) {
																	echo '<h3 class="item-text">';
																		echo $value['text'];
																	echo '</h3>';
																}
															echo '</div>';
														echo '</a>';
													echo '</div>';
												}
											echo '</div>';
										echo '</div>';
									}
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
				if( get_field('dp_ss7') == true ) { 
					$tt_ss7 = get_field('tt_ss7');
					$text_blur_ss7 = get_field('text_blur_ss7');
					$permalink_ss7 = get_field('permalink_ss7');
					$excerpt_ss7 = get_field('excerpt_ss7');
					$list_ss7 = get_field('list_ss7');
					echo '<div id="ss7" class="homepage">';
						echo '<div class="container">';
							echo '<div class="wrap">';
								if($tt_ss7) {
									echo '<h2 class="heading text-left" data-aos="fade-up"
									data-aos-anchor-placement="top-bottom" data-aos-duration="1000"><span subtitle="'.$text_blur_ss7.'">'.$tt_ss7.'</span></h2>';
								}
								if($permalink_ss7) {
									echo '<p class="permalink_ss7" data-aos="fade-up"
									data-aos-anchor-placement="top-bottom" data-aos-duration="1000"><a href="'.$permalink_ss7.'"><img src="'.get_stylesheet_directory_uri(  ).'/assets/img/icon/ic-permalink.svg" alt=""> <span>'.__('Click here for details','shtheme').'</span></a></p>';
								}
								if($excerpt_ss7) {
									echo '<div class="excerpt_ss7" data-aos="fade-up"
									data-aos-anchor-placement="top-bottom" data-aos-duration="1000">'.$excerpt_ss7.'</div>';
								}
								echo '<div class="main-ss7">';
									if($list_ss7) {
										echo '<div class="list-problem" data-aos="fade-up"
										data-aos-anchor-placement="top-bottom" data-aos-duration="1000">';
											echo '<div class="row list-row justify-content-center">';
												foreach ($list_ss7 as $key => $value) {
													echo '<div class="col-md-4 col-sm-4 mb-5">';
														echo '<div class="item-ss7">';
															echo '<div class="item-top">';
																if($value['icon']) {
																	echo '<div class="item-icon">';
																		echo '<img src="'.$value['icon'].'" />';
																	echo '</div>';
																}
																if($value['title']) {
																	echo '<div class="item-title">';
																		echo $value['title'];
																	echo '</div>';
																}
															echo '</div>';
															echo '<div class="item-bottom">';
																if($value['text']) {
																	echo '<div class="item-text">';
																		echo $value['text'];
																	echo '</div>';
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
					echo '</div>';
				}
				if( get_field('dp_ss8') == true ) { 
					$tt_ss8 = get_field('tt_ss8');
					$bg_ss8 = get_field('bg_ss8');
					$permalink_ss8 = get_field('permalink_ss8');
					$excerpt_ss8 = get_field('excerpt_ss8');
					$list_ss8 = get_field('list_ss8');
					echo '<div id="ss8" class="homepage" style="background-image:url('.$bg_ss8.')">';
						echo '<div class="container">';
							echo '<div class="wrap">';
								if($tt_ss8) {
									echo '<h2 class="heading" data-aos="fade-up"
									data-aos-anchor-placement="top-bottom" data-aos-duration="1000"><span>'.$tt_ss8.'</span></h2>';
								}
								if($permalink_ss8) {
									echo '<p class="permalink_ss8" data-aos="fade-up"
									data-aos-anchor-placement="top-bottom" data-aos-duration="1000"><a href="'.$permalink_ss8.'"><img src="'.get_stylesheet_directory_uri(  ).'/assets/img/icon/ic-permalink.svg" alt=""> <span>'.__('Click here for details','shtheme').'</span></a></p>';
								}
								if($excerpt_ss8) {
									echo '<div class="excerpt_ss8" data-aos="fade-up"
									data-aos-anchor-placement="top-bottom" data-aos-duration="1000">'.$excerpt_ss8.'</div>';
								}
								echo '<div class="main-ss8">';
									if($list_ss8) {
										echo '<div class="list-image" data-aos="fade-up"
										data-aos-anchor-placement="top-bottom" data-aos-duration="1000">';
											echo '<div class="row list-row justify-content-center">';
												foreach ($list_ss8 as $key => $value) {
													echo '<div class="col-md-3 col-6 mb-5">';
														echo '<div class="item-ss8">';
															if($value['image']) {
																echo '<div class="item-image">';
																	echo '<img src="'.$value['image'].'" />';
																echo '</div>';
															}
														echo '</div>';
													echo '</div>';
												}
											echo '</div>';
										echo '</div>';
									}
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
				

				if( get_field('dp_ss10_linh') == true ) { 
					$tt_ss10_linh = get_field('tt_ss10_linh');
					$list_ss10_linh = get_field('list_ss10_linh');
					echo '<div id="ss10" class="homepage" >';
						echo '<div class="container">';
							echo '<div class="wrap">';
								echo '<h4 class="testimonials">Testimonials</h4>';
								if($tt_ss10_linh) {
									echo '<h2 class="heading" data-aos="fade-up"
									data-aos-anchor-placement="top-bottom" data-aos-duration="1000"><span>'.$tt_ss10_linh.'</span></h2>';
								}
								echo '<div class="main-ss10 ">';
									if($list_ss10_linh) {
										echo '<div class="list-testimonials" data-aos="fade-up"
										data-aos-anchor-placement="top-bottom" data-aos-duration="1000">';
											echo '<div class="box-testimonials">';
												foreach ($list_ss10_linh as $key => $value) {
													echo '<div class="item-ss10">';
														if($value['image']) {
															echo '<div class="item-image">';
																echo '<img src="'.$value['image'].'" />';
															echo '</div>';
														}
														echo '<div class="ss10-content">';
															if($value['decription']) {
																echo '<div class="description">'.$value['decription'].'</div>';
															}
														echo '</div>';
														echo '<div class="numberofstars">';
														for ($i=0; $i < $value['numberofstars']; $i++) { 
															echo '<svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
															<polygon fill="#ffd700" stroke="#ffd700" stroke-width="1.01" points="10 2 12.63 7.27 18.5 8.12 14.25 12.22 15.25 18 10 15.27 4.75 18 5.75 12.22 1.5 8.12 7.37 7.27">
															</polygon></svg>';
														}
														echo '</div>';
														echo '<h4 class="testimonial-name">'.$value['fullname'].'</h4>';
														echo '<p class="testimonial-company-name">'.$value['companyname'].'</p>';
													echo '</div>';
												}
											echo '</div>';
										echo '</div>';
									}
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}

				if( get_field('dp_ss9_linh') == true ) { 
					$tt_ss9_linh = get_field('tt_ss9_linh');
					$bg_ss9_linh = get_field('bg_ss9_linh');
					$list_ss9_linh = get_field('list_ss9_linh');
					echo '<div id="ss9" class="homepage" style="background-image:url('.$bg_ss9_linh.')">';
						echo '<div class="container">';
							echo '<div class="wrap">';
								if($tt_ss9_linh) {
									echo '<h2 class="heading" data-aos="fade-up"
									data-aos-anchor-placement="top-bottom" data-aos-duration="1000"><span>'.$tt_ss9_linh.'</span></h2>';
								}
								echo '<div class="main-ss9 ">';
									if($list_ss9_linh) {
										echo '<div class="list-image" data-aos="fade-up"
										data-aos-anchor-placement="top-bottom" data-aos-duration="1000">';
											echo '<div class="row list-row justify-content-center">';
												foreach ($list_ss9_linh as $key => $value) {
													echo '<div class="col-md-2 col-6 mb-5">';
														echo '<div class="item-ss9">';
															if($value['image']) {
																echo '<div class="item-image">';
																	echo '<img src="'.$value['image'].'" />';
																echo '</div>';
															}
														echo '</div>';
													echo '</div>';
												}
											echo '</div>';
										echo '</div>';
									}
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
			?>

		</main><!-- #main -->
		
		<?php do_action( 'after_main_content' );?>

	</div><!-- #primary -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
	<script type="text/javascript">
		$('.box-testimonials').slick();
	</script>
<?php
get_footer();
