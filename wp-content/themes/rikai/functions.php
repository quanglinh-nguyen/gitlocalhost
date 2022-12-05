<?php
define( 'PARENT_DIR', get_template_directory() );
define( 'UNI_DIR',  get_template_directory_uri() );
define( 'ADMINS_DIR', PARENT_DIR . '/admin' );
define( 'FUNCTIONS_DIR', PARENT_DIR . '/inc/template-functions' );
define( 'PAGINATION_DIR', PARENT_DIR . '/inc/template-functions/ajax-pagination' );

/**
 * Uni Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Uni_Theme
 */

if ( ! function_exists( 'unitheme_setup' ) ) :
	function uni_setup() {
		
		load_theme_textdomain( 'shtheme', PARENT_DIR . '/languages' );

		// Add theme support
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );

		// Switch default core markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support( 'html5', array('search-form','comment-form','comment-list','gallery','caption',) );

		// Set up the WordPress core custom background feature.
		// add_theme_support( 'custom-background', apply_filters( 'uni_custom_background_args', array('default-color' => 'ffffff','default-image' => '',) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'shtheme' ),
			'menu-mobile' => esc_html__( 'Menu Mobile', 'shtheme' ),
		) );

		// Load Theme Options
		require ADMINS_DIR . '/options.php';
        require ADMINS_DIR . '/function.php';

        // Load Custom Post Type
         require PARENT_DIR . '/inc/template-taxonomy/cpt/cpt-abstract.php';
        //  require PARENT_DIR . '/inc/template-taxonomy/cpt/news.php';
         require PARENT_DIR . '/inc/template-taxonomy/cpt/service.php';
         require PARENT_DIR . '/inc/template-taxonomy/cpt/recruitment.php';
         require PARENT_DIR . '/inc/template-taxonomy/cpt/cpt.php';
             
         // Load Custom Taxonomy
         require PARENT_DIR . '/inc/template-taxonomy/taxonomies/custom-taxonomy-abstract.php';
        //  require PARENT_DIR . '/inc/template-taxonomy/taxonomies/news_cat.php';
         require PARENT_DIR . '/inc/template-taxonomy/taxonomies/service_cat.php';
         require PARENT_DIR . '/inc/template-taxonomy/taxonomies/recruitment_cat.php';
         require PARENT_DIR . '/inc/template-taxonomy/taxonomies/custom-taxonomy.php';

        // Load Functions.
        // require_once( PAGINATION_DIR . '/ajax-pagination-post.php' );
        require_once( FUNCTIONS_DIR . '/ajax-loadmore/ajax-loadmore.php' );
        require_once( FUNCTIONS_DIR . '/ajax-pagination/ajax-pagination-post.php' );
        require_once( FUNCTIONS_DIR . '/breadcrumbs.php' );
        require_once( FUNCTIONS_DIR . '/init.php' );
        require_once( FUNCTIONS_DIR . '/mobilemenu.php' );

        // Load Shortcode
        require PARENT_DIR . '/inc/shortcode/shortcode-blog.php';
        require PARENT_DIR . '/inc/shortcode/shortcode-service.php';
        require PARENT_DIR . '/inc/shortcode/shortcode-recruitment.php';

        // Load Woocomerce
        if ( class_exists( 'WooCommerce' ) ) {
            add_theme_support( 'woocommerce' );
            require PARENT_DIR . '/inc/shortcode/shortcode-product.php';
            require PARENT_DIR . '/inc/widgets/wg-list-product.php';
            require PARENT_DIR . '/inc/woocommerce/function-woo.php';
            // require PAGINATION_DIR . '/ajax-pagination-product.php';
        }

        /* Load Widget */
        // require PARENT_DIR . '/inc/widgets/wg-post-list.php';
        // require PARENT_DIR . '/inc/widgets/wg-support.php';
        // require PARENT_DIR . '/inc/widgets/wg-fblikebox.php';
        // require PARENT_DIR . '/inc/widgets/wg-page.php';
        // require PARENT_DIR . '/inc/widgets/wg-view-post-list.php';
        require PARENT_DIR . '/inc/widgets/wg-information.php';
        require PARENT_DIR . '/inc/widgets/wg-social.php';
	}
endif;
add_action( 'after_setup_theme', 'uni_setup' );
add_action( 'init', 'uni_add_excerpts_to_pages' );
function uni_add_excerpts_to_pages() {
    add_post_type_support( 'page', 'excerpt' );
}
function add_company_profile() {
    $title_cpf = uni_option('title_cpf');
    $permalink_cpf = uni_option('permalink_cpf');
    $background_cpf = uni_option('background_cpf');
    echo '<div id="company-profile" style="background-image: url('.$background_cpf.')">';
        echo '<div class="container">';
            if($title_cpf) {
                echo '<h2 class="cpf-title"><span>'.$title_cpf.'</span></h2>';
            }
            if($permalink_cpf) {
                echo '<div class="cpf-permalink"><a href="'.$permalink_cpf.'"><span> <img src="'.get_stylesheet_directory_uri(  ).'/assets/img/icon/ic-permalink.svg" alt=""> '.__('Click here for details','shtheme').'</span></a></div>';
            }
        echo '</div>';
    echo '</div>';
}
add_shortcode( 'company_profile', 'add_company_profile' );