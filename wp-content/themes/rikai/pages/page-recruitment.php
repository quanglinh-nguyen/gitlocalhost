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
wp_enqueue_style( 'contact-style', UNI_DIR .'/assets/css/contact.css' );

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
				if( get_field('dp_ss6_linh') == true ) { 
					$tt_ss6_linh = get_field('tt_ss6_linh');
					$desc_ss6_linh = get_field('desc_ss6_linh');
					$list_ss6_linh = get_field('list_ss6_linh');
					echo '<section id="sec-fostered" class="career-benefit wow fadeInUp " sryle="visibility: visible; animation-name: fadeInUp;">';
						echo '<div class="container">';
						echo '<h2 class="section-title heading text-center">'.$tt_ss6_linh.'</h2>';
						echo '<p class="section-desc text-center">'.$desc_ss6_linh.'</p>';
							echo '<div class="row">';
								if(count($list_ss6_linh) > 0){
									foreach ($list_ss6_linh as $key => $value) {
									echo '<div class="col-md-6 col-sm-12">';
										echo '<div class="career-benefit-item">';
											echo '<div class="black-box-wrapper">';
												echo '<div class="black-box">';
													echo '<img src="'.$value['imageicon']['url'].'" alt="nghề nghiệp, lợi ích của nhà thiết kế" data-loaded="true">';
												echo '</div>';
											echo '</div>';
											echo '<p><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">'.$value['description'].'</font></font></p>';
										echo '</div>';
									echo '</div>';
									}
								}
							echo '</div>';
						echo '</div>';
					echo '</section>';
				}

			
			?>
			<?php if( get_field('dp_ss7_linh') == true ) { ?>
				<section id="sec-contact" class="career-contact wow fadeInUp " sryle="visibility: visible; animation-name: fadeInUp;">
				<div class="container">
					<div class="row ">
						<div class="col-md-7 col-sm-12 career-contact-text">
							<h4>Nothing Here For You?</h4>
							<p>Keep in touch and we’ll let you know when there’s a position that fits you </p>
						</div>
						<div class="col-md-5 col-sm-12 career-contact-button">
							<button class="btn-send-cv btn-open-modal"><span>Send Your CV</span>
								<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
								viewBox="0 0 492.128 492.128" style="enable-background:new 0 0 492.128 492.128;" xml:space="preserve" width='60' height='25'>
								<path fill='#0086d1' id="XMLID_79_" d="M490.061,241.075L334.164,85.179c-2.017-2.018-5.046-2.614-7.686-1.528
									c-2.631,1.097-4.348,3.661-4.348,6.515v75.376H17.42c-9.619,0-17.42,7.802-17.42,17.421v126.202c0,9.619,7.802,17.421,17.42,17.421
									h304.709v75.377c0,2.854,1.717,5.419,4.348,6.515c2.64,1.087,5.669,0.489,7.686-1.527l155.897-155.898
									C492.817,248.296,492.817,243.833,490.061,241.075z M79.675,286.432c-22.293,0-40.369-18.076-40.369-40.368
									s18.076-40.369,40.369-40.369c22.292,0,40.369,18.077,40.369,40.369S101.968,286.432,79.675,286.432z"/>
								</svg>
							</button>
						</div>
					</div>
				</div>
				</section>

			<?php } ?>
			
			

<div class="modal-custom">
<div class="modal-content">
    <span class="close">&times;</span>
		<div class="form-recruitment">
			<div class="row">
				<div class="col-lg-12">
					<div class="form-wrap">
						<?php echo do_shortcode('[contact-form-7 id="700" title="Recruitment"]'); ?>
					</div>
				</div>
			</div>
		</div>
  </div>
</div>
			
		</main><!-- #main -->
		
		<?php //do_action( 'after_main_content' );?>

	</div><!-- #primary -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>

	var modal = $('.modal-custom');
  var btn = $('.btn-open-modal');
  var span = $('.close');

  btn.click(function () {
    modal.show();
  });

  span.click(function () {
    modal.hide();
  });

  $(window).on('click', function (e) {
    if ($(e.target).is('.modal-custom')) {
      modal.hide();
    }
  });
</script>
<?php
get_footer();
