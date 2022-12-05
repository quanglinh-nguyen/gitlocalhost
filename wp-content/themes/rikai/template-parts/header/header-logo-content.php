<?php
/**
 * Template for Logo Header
 *
 * @package Uni_Theme
 */

?>
<div class="header-main">
	<div class="container">
		<div class="site-branding">
			<?php
			if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php
			endif;
			$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			<?php
			endif; ?>
		</div><!-- .site-branding -->

		<div class="header-content">
			<div class="row align-items-center">
				<div class="col-3 d-lg-none">
					<div class="menu-toggle d-lg-none" id="showmenu">
						<div class="showmenu-hamburger"><span></span><span></span><span></span></div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-3 col-sm-3 col-6">
					<div class="logo" data-aos="fade-right" data-aos-anchor-placement="top-bottom" data-aos-duration="1000">
						<?php display_logo();?>
					</div>
				</div>
				<div class="col-xl-9 col-lg-6 col-sm-6 col-3">
					<div class="contact-box" data-aos="fade-left" data-aos-anchor-placement="top-bottom" data-aos-duration="1000">
						<?php 
							if( uni_option('contact_phone') ) {
								echo '<a class="contact-item contact-phone d-sm-block d-none" href="tel:'.uni_option('contact_phone').'">';
									echo '<span class="tt d-lg-block d-none">'.__('Phone us','shtheme').'</span>';
									echo '<span class="vl">'.uni_option('contact_phone').'</span>';
								echo '</a>';
							}
							if( uni_option('contact_email') ) {
								echo '<a class="contact-item contact-email d-sm-block d-none" href="mailto:'.uni_option('contact_email').'">';
									echo '<span class="tt d-lg-block d-none">'.__('Email us','shtheme').'</span>';
									echo '<span class="vl">'.uni_option('contact_email').'</span>';
								echo '</a>';
							}
							echo '<div class="contact-item contact-language">';
								echo '<span class="tt">'.__('Language','shtheme').'</span>';
								echo '<span class="vl">English</span>';
							echo '</div>';
						?>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>
<?php if ( has_nav_menu( 'menu-1' ) && !my_wp_is_mobile() ) { ?>
	<nav id="site-navigation" class="main-navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">
		<div class="wrap-menu" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="1000">
			<div class="container">
				<?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_id' => 'primary-menu', 'menu_class' => 'menu clearfix' ) ); ?>
			</div>
		</div>
	</nav>
<?php } // end check menu ?>