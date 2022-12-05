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
            <div class="menu-toggle d-lg-none" id="showmenu">
                <div class="showmenu-hamburger"><span></span><span></span><span></span></div>
            </div>
			<div class="row align-items-center">
				<div class="col-xl-3 col-lg-3">
					<div class="logo">
						<?php display_logo();?>
					</div>
				</div>
				<div class="col-xl-9 col-lg-9">
					<?php if ( has_nav_menu( 'menu-1' ) && !my_wp_is_mobile() ) { ?>
						<nav id="site-navigation" class="main-navigation" itemscope itemtype="https://schema.org/SiteNavigationElement">
							<?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_id' => 'primary-menu', 'menu_class' => 'menu clearfix' ) );?>
						</nav>
					<?php } // end check menu ?>
				</div>
			</div>
		</div>
		<?php //do_action( 'sh_after_menu' );?>
	</div>
</div>
