<?php
/**
 * Template Name: Page SES
 *
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Uni_Theme
 */

get_header(); 
wp_enqueue_style( 'ses-style', UNI_DIR .'/assets/css/ses.css' );
?>

	<div id="primary" class="content-sidebar-wrap">

		<?php do_action( 'before_main_content' ) ?>

		<main id="main" class="site-main" role="main">

			<?php do_action( 'before_loop_main_content' ) ?>

			<?php
				if( get_field('dp_intro') == true ) {
					$tt_intro = get_field('tt_intro');
					$desc_intro = get_field('desc_intro');
					$description = get_field('description');
					$bg_intro = get_field('bg_intro');
					echo '<div id="intro" class="ses">';
						echo '<div class="intro-wrap" style="background-image:url('.$bg_intro.')">';
							echo '<div class="intro-box">';
								if($tt_intro) {
									echo '<h3><span>'.$tt_intro.'</span></h3>';
								}
								if($desc_intro) {
									echo '<div class="desc_intro">'.$desc_intro.'</div>';
								}
							echo '</div>';
						echo '</div>';
						echo '<div class="intro-foot">';
							echo '<div class="container">';
								echo '<div class="intro-content">';
									echo '<div class="intro-icon">';
										if($description['icon']) {
											echo '<img src="'.$description['icon'].'" alt="Description">';
										}	
									echo '</div>';
									echo '<div class="intro-desc">';
										if($description['description']) {
											echo $description['description'];
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
					echo '<div id="problem" class="ses">';
						echo '<div class="cir1"></div>';
						echo '<div class="cir2"></div>';
						echo '<div class="cir3"></div>';
						echo '<div class="container">';
							echo '<div class="wrap">';
								if($tt_ss2) {
									echo '<h2 class="heading"><span>'.$tt_ss2.'</span></h2>';
								}
								if($list_ss2) {
									echo '<div class="list-problem">';
										echo '<div class="row list-row justify-content-center">';
											foreach ($list_ss2 as $key => $value) {
												echo '<div class="col-md-4 col-sm-6 mb-5">';
													echo '<div class="item-problem">';
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
																if($value['description']) {
																	echo '<p class="item-desc">';
																		echo $value['description'];
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
				if( get_field('dp_ss3') == true ) { 
					$img_ss3 = get_field('img_ss3');
					$list_ss3 = get_field('list_ss3');
					echo '<div id="ss3" class="ses">';
						echo '<div class="container">';
							echo '<div class="row ss3-row align-items-center">';
								echo '<div class="col-lg-6 col-md-5 mb-md-0 mb-5">';
									if($img_ss3) {
										echo '<div class="ss3-image text-center"><span class="d-inline-block"><img src="'.$img_ss3.'" alt="Image" /></span></div>';
									}
								echo '</div>';
								echo '<div class="col-lg-6 col-md-7">';
									if($list_ss3) {
										echo '<div class="ss3-content">';
											foreach ($list_ss3 as $key => $value) {
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
											}
										echo '</div>';
									}
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
				if( get_field('dp_ss4') == true ) {
					echo '<div id="ss4" class="ses">';
						echo '<div class="cir1"></div>';
						echo '<div class="cir2"></div>';
						echo '<div class="cir3"></div>';
						$tt_ss4 = get_field('tt_ss4');
						$text_blur_ss4 = get_field('text_blur_ss4');
						$description_ss4 = get_field('description_ss4');
						$img_ss4 = get_field('img_ss4');
						echo '<div class="container">';
							echo '<div class="wrap">';
								if($tt_ss4) {
									echo '<h2 class="heading"><span subtitle="'.$text_blur_ss4.'">'.$tt_ss4.'</span></h2>';
								}
								if($description_ss4) {
									echo '<div class="description col-lg-10 offset-lg-1 text-center">'.$description_ss4.'</div>';
								}
								if($img_ss4) {
									echo '<div class="image text-center"> <img src="'.$img_ss4.'" alt="IMG"></div>';
								}
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
				if( get_field('dp_ss5') == true ) {
					wp_enqueue_style( 'fancybox-css');
					wp_enqueue_script( 'fancybox-js');
					echo '<div id="ss5" class="ses">';
						$tt_ss5 = get_field('tt_ss5');
						$excerpt_ss5 = get_field('excerpt_ss5');
						$list_image_ss5 = get_field('list_image_ss5');
						echo '<div class="container">';
							echo '<div class="wrap">';
								if($tt_ss5) {
									echo '<h2 class="heading"><span>'.$tt_ss5.'</span></h2>';
								}
								if($excerpt_ss5) {
									echo '<div class="description text-center">'.$excerpt_ss5.'</div>';
								}
								if($list_image_ss5) {
									echo '<div class="gallery-row">';
										foreach ($list_image_ss5 as $key => $value) {
											echo '<div class="gallery-item item-'.$value['size'].'">';
												echo '<a class="d-block img1" data-fancybox="gallery" href="'.$value['image'].'"><img src="'.$value['image'].'" alt="IMG"></a>';
											echo '</div>';
										}
									echo '</div>';
								}
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
				if( get_field('dp_ss6') == true ) {
					echo '<div id="ss6" class="ses">';
						$tt_ss6 = get_field('tt_ss6');
						$excerpt_ss6 = get_field('excerpt_ss6');
						$list_ss6 = get_field('list_ss6');
						$bg_ss6 = get_field('bg_ss6');
						echo '<div class="container">';
							echo '<div class="wrap">';
								if($tt_ss6) {
									echo '<h2 class="heading"><span>'.$tt_ss6.'</span></h2>';
								}
								if($excerpt_ss6) {
									echo '<div class="description text-center">'.$excerpt_ss6.'</div>';
								}
							echo '</div>';
						echo '</div>';
						echo '<div class="ss6-foot" style="background-image:url('.$bg_ss6.')">';
							echo '<div class="container">';
								echo '<div class="foot-wrap">';
									if($list_ss6) {
										echo '<div class="list-application">';
											foreach ($list_ss6 as $key => $value) {
												echo '<div class="item-application">';
													if($value['title']) {
														echo '<h3 class="title-application">'.$value['title'].'</h3>';
													}
													if($value['image']) {
														echo '<div class="image-application"><img src="'.$value['image'].'" alt=""></div>';
													}
												echo '</div>';
											}
										echo '</div>';
									}
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
				if( get_field('dp_ss7') == true ) { 
					$tt_ss7 = get_field('tt_ss7');
					$list_ss7 = get_field('list_ss7');
					echo '<div id="ss7" class="ses">';
						echo '<div class="cir1"></div>';
						echo '<div class="cir2"></div>';
						echo '<div class="cir3"></div>';
						echo '<div class="container">';
							echo '<div class="wrap">';
								if($tt_ss7) {
									echo '<h2 class="heading"><span>'.$tt_ss7.'</span></h2>';
								}
								if($list_ss7) {
									echo '<div class="list-problem">';
										echo '<div class="row list-row justify-content-center">';
											foreach ($list_ss7 as $key => $value) {
												echo '<div class="col-md-4 col-sm-6 mb-5">';
													echo '<div class="item-problem">';
														echo '<div class="item-info">';
															if($value['image']) {
																echo '<div class="item-image">';
																	echo '<img src="'.$value['image'].'" />';
																echo '</div>';
															}
															echo '<div class="item-content">';
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
				if( get_field('dp_ss8') == true ) { 
					$img_ss8 = get_field('img_ss8');
					$list_ss8 = get_field('list_ss8');
					$permalink_ss8 = get_field('permalink_ss8');
					echo '<div id="ss8" class="ses">';
						echo '<div class="container">';
							echo '<div class="row ss3-row align-items-center">';
								echo '<div class="col-lg-6 col-md-5 mb-md-0 mb-5">';
									if($img_ss8) {
										echo '<div class="ss3-image text-center"><span class="d-inline-block"><img src="'.$img_ss8.'" alt="Image" /></span></div>';
									}
								echo '</div>';
								echo '<div class="col-lg-6 col-md-7">';
									if($list_ss8) {
										echo '<div class="ss3-content">';
											foreach ($list_ss8 as $key => $value) {
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
											}
										echo '</div>';
									}
									if($permalink_ss8) {
										echo '<div class="permalink_ss8"> <img src="'.get_stylesheet_directory_uri(  ).'/assets/img/icon/ic-permalink.svg" alt=""> <a href="'.$permalink_ss8.'">'.__('Click here for details','shtheme').'</a></div>';
									}
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
				if( get_field('dp_ss9') == true ) { 
					$tt_ss9 = get_field('tt_ss9');
					$description_ss9 = get_field('description_ss9');
					echo '<div id="ss9" class="ses">';
						echo '<div class="container">';
							echo '<div class="wrap">';
								if($tt_ss9) {
									echo '<h2 class="heading"><span>'.$tt_ss9.'</span></h2>';
								}
								if($description_ss9) {
									echo '<div class="description">'.$description_ss9.'</div>';
								}
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
				if( get_field('dp_ss10') == true ) {
					echo '<div id="ss10" class="ses">';
						$tt_ss10 = get_field('tt_ss10');
						$text_blur_ss10 = get_field('text_blur_ss10');
						$contact_form = get_field('contact_form');
						echo '<div id="ss10-top">';
							echo '<div class="container">';
								echo '<div class="wrap">';
									if($tt_ss10) {
										echo '<h2 class="heading heading-ct"><span subtitle="'.$text_blur_ss10.'">'.$tt_ss10.'</span></h2>';
									}
								echo '</div>';
							echo '</div>';
						echo '</div>';
						echo '<div id="form">';
						echo '<div class="bg-form" style="background-image:url('.$contact_form['background'].')"></div>';
							echo '<div class="container">';
								echo '<div class="col-lg-10">';
									if($contact_form['title']) {
										echo '<h2 class="heading"><span>'.$contact_form['title'].'</span></h2>';
									}
									echo '<div class="form-block">';
										if($contact_form['description_form']) {
											echo '<div class="form-desc">'.$contact_form['description_form'].'</div>';
										}
										if($contact_form['select_form']) {
											echo do_shortcode('[contact-form-7 id="'.$contact_form['select_form']->ID.'" title="'.$contact_form['select_form']->post_title.'"]');
										}
									echo '</div>';
								echo '</div>';
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
