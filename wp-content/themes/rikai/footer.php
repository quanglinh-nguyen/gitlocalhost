<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Uni_Theme
 */


?>
		</div>
	</div><!-- #content -->

	<footer id="footer" class="site-footer" itemscope itemtype="https://schema.org/WPFooter">
		
		<div class="main-footer">
			<div class="container">
				<div class="wrap">
					<div class="row">
						<?php do_action( 'uni_footer' );?>
					</div>
				</div>
			</div>
		</div><!-- .footer-widgets -->

		<?php if( !empty(uni_option('footer-copyright'))) { ?>
			<div class="site-info">
				<div class="container">
					<div class="wrap">
						<div class="row">
							<div class="col-sm-12 text-center">
								<?php 
                                    echo '<p id="copyright">'.uni_option('footer-copyright').'</p>';
                                ?>
							</div>
						</div>
					</div>
				</div>
			</div><!-- .site-info -->
		<?php } ?>
		
	</footer><!-- #colophon -->
	<div id="back-top">
		<img src="<?php echo get_stylesheet_directory_uri() ?>/assets/img/icon/backtop.svg" alt="Backtop">
	</div>
    <?php do_action( 'after_footer' );?>
</div><!-- #page -->
<?php wp_footer(); ?>
<style>

	.main-footer, .main-footer .widget_information {
		color: var(--textcolor) !important;
	}
	.main-footer .widget_social ul {
		text-align: left !important;
	}

	.main-footer .menu-primary-menu-container,
	.main-footer .ft-column:nth-child(2) h3.widget-title{
		padding-left: 60px;
	}
	.main-footer #menu-primary-menu{
		flex-direction: column !important;
	}

	.widget_nav_menu ul li a{

	}

	.main-footer .widget_nav_menu ul li.menu-item-has-children .arrow{
		top: 12px;
		left: 67px;
	}

	.main-footer .widget-title{
		color: var(--primarycolor);
	}


	.main-footer .widget_information,.main-footer .custom-html-widget{
		color: #000;
		font-size: 16px;
    	font-weight: normal;
	}

	.main-footer .widget_nav_menu ul li a, .widget_information li i {
		font-size: 16px;
	}
</style>
</body>
</html>
