<?php
/**
 * Template Name: Page Win-Win-Offshore
 *
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Uni_Theme
 */

get_header(); 
wp_enqueue_style( 'winwinshore-style', UNI_DIR .'/assets/css/winwinshore.css' );
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
					echo '<div id="intro" class="wws">';
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
									if($description['text_blur']) {
										echo '<span class="text_blur">'.$description['text_blur'].'</span>';
									}	
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
					echo '<div id="ss2" class="wws">';
						echo '<div class="container">';
							echo '<div class="wrap">';
								if($tt_ss2) {
									echo '<h2 class="heading"><span>'.$tt_ss2.'</span></h2>';
								}
								if($list_ss2) {
									echo '<div class="list-ss2">';
										echo '<div class="row list-row justify-content-center">';
											foreach ($list_ss2 as $key => $value) {
												echo '<div class="col-md-6 col-sm-6 mb-5">';
													echo '<div class="item-ss2">';
														echo '<div class="item-info">';
															if($value['title']) {
																echo '<h2 class="heading">';
																	echo '<span>'.$value['title'].'</span>';
																echo '</h2>';
															}
															if($value['image']) {
																echo '<div class="item-image">';
																	echo '<img src="'.$value['image'].'" />';
																echo '</div>';
															}
															echo '<div class="item-content">';
																if($value['description']) {
																	echo $value['description'];
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
					$tt_ss3 = get_field('tt_ss3');
					$img_ss3 = get_field('img_ss3');
					$content_ss3 = get_field('content_ss3');
					$bg_ss3 = get_field('bg_ss3');
					echo '<div id="ss3" class="wws" style="background-image:url('.$bg_ss3.')">';
						echo '<div class="container">';
							if($tt_ss3) {
								echo '<h2 class="heading"><span>'.$tt_ss3.'</span></h2>';
							}
							echo '<div class="main-ss3">';
								echo '<div class="box-ss3">';
									if($content_ss3['excerpt']) {
										echo '<div class="ss3-desc">';
											echo $content_ss3['excerpt'];
										echo '</div>';
									}
									echo '<div class="ss3-middle">';
										echo '<div class="row ss3-row align-items-center">';
											echo '<div class="col-lg-5 col-sm-6 mb-sm-0 mb-5">';
												if($content_ss3['img']) {
													echo '<div class="ss3-image text-center"><span class="d-inline-block"><img src="'.$content_ss3['img'].'" alt="Image" /></span></div>';
												}
											echo '</div>';
											echo '<div class="col-lg-6 col-sm-6">';
												if($content_ss3['text']) {
													echo '<div class="ss3-text">';
														echo $content_ss3['text'];
													echo '</div>';
												}
											echo '</div>';
										echo '</div>';
									echo '</div>';
									if($content_ss3['list']) {
										echo '<div class="ss3-list">';
											echo '<div class="row">';
												foreach ($content_ss3['list'] as $key => $value) {
													echo '<div class="col-sm-4">';
														if($value['text']) {
															echo '<div class="ss3-list-desc">';
																echo $value['text'];
															echo '</div>';
														}
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
				if( get_field('dp_ss4') == true ) { 
					$tt_ss4 = get_field('tt_ss4');
					$list_ss4 = get_field('list_ss4');
					echo '<div id="ss4" class="wws">';
						echo '<div class="container">';
							if($tt_ss4) {
								echo '<h2 class="heading"><span>'.$tt_ss4.'</span></h2>';
							}
							if($list_ss4) {
								echo '<div class="ss4-block">';
									echo '<div class="ss4-box">';
										echo '<table width="100%">';
											echo '<tbody>';
												foreach ($list_ss4 as $key => $value) {
													echo '<tr>';
														$column_1 = $value['column_1'];
														$column_2 = $value['column_2'];
														$column_3 = $value['column_3'];
														$column_4 = $value['column_4'];
														
														echo '<td width="25%">';
															if($column_1) {
																echo '<div class="column">'.$column_1.'</div>';
															}
														echo '</td>';
														echo '<td width="25%">';
															if($column_2) {
																echo '<div class="column">'.$column_2.'</div>';
															}
														echo '</td>';
														echo '<td width="25%">';
															if($column_3) {
																echo '<div class="column">'.$column_3.'</div>';
															}
														echo '</td>';
														echo '<td width="25%">';
															if($column_4) {
																echo '<div class="column">'.$column_4.'</div>';
															}
														echo '</td>';
													echo '</tr>';
													
												}
											echo '</tbody>';
										echo '</table>';
									echo '</div>';
								echo '</div>';
							}
						echo '</div>';
					echo '</div>';
				}
				if( get_field('dp_ss5') == true ) {
					$tt_ss5 = get_field('tt_ss5');
					$permalink_ss5 = get_field('permalink_ss5');
					$bg_ss5 = get_field('bg_ss5');
					echo '<div id="company-profile" style="background-image: url('.$bg_ss5.')">';
						echo '<div class="container">';
							if($tt_ss5) {
								echo '<h2 class="cpf-title"><span>'.$tt_ss5.'</span></h2>';
							}
							if($permalink_ss5) {
								echo '<div class="cpf-permalink"><a href="'.$permalink_ss5.'"><span> <img src="'.get_stylesheet_directory_uri(  ).'/assets/img/icon/ic-permalink.svg" alt=""> '.__('Click here for details','shtheme').'</span></a></div>';
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
