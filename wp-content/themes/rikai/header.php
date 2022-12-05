<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(''); ?> itemscope="itemscope" itemtype="http://schema.org/WebPage">
<?php do_action( 'before_header' );?>

<div id="page" class="site">

	<header id="masthead" <?php header_class();?> role="banner" itemscope="itemscope" itemtype="http://schema.org/WPHeader">

		<!-- Start Top Header -->
		<?php if( uni_option('display-topheader-widget') == true ) : ?>
			<div class="top-header" data-aos="fade" data-aos-anchor-placement="top-bottom" data-aos-duration="500">
				<div class="container">
					<?php dynamic_sidebar( 'Top Header' );?>
				</div>
			</div>
		<?php endif; ?>
		<!-- End Top Header -->

		<?php uni_header_layout();?>

	</header><!-- #masthead -->
	
	<div id="content" class="site-content">

		<?php do_action( 'before_content' ) ?>

			<div class="container">
