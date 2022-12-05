<?php
// namespace Uni\Admin;

class functions
{
    function __construct() {
        /* Include CSS / JS */
        add_action('wp_enqueue_scripts',array($this,'uni_lib_scripts'),50);
        /* Slider */
        add_action('before_loop_main_content',array($this,'uni_carousel'));
        /* Add new widget */
        add_action('widgets_init',array($this,'uni_widgets_init'));
        /* Add widget footer */
        add_action('uni_footer',array($this,'uni_footer_widget_areas'));
        /* Sidebar 1 */
        add_action('after_main_content',array($this,'uni_sidebar'));
        /* Setup SMTP */
        add_action('phpmailer_init',array($this,'phpmailer'));
        /* Insert code header */
        add_action('wp_head',array($this,'insert_code_to_header'));
        /* Insert code body */
        add_action('before_header',array($this,'insert_code_to_body_top'));
        /* Insert code footer */
        add_action('wp_footer',array($this,'insert_code_to_footer'));
        /* Add new roles */
        add_action('init',array($this,'add_new_role'));
    }
    function uni_lib_scripts(){

        /* Main js */
        wp_enqueue_script( 'main-js', UNI_DIR . '/assets/js/main.js', array('jquery'), '1.0', true );
        wp_localize_script(	'main-js', 'ajax', array( 'url' => admin_url('admin-ajax.php') ) );
    
        /* Font tello */
        wp_enqueue_style( 'fontello-style', UNI_DIR .'/assets/css/fontello.css' );
    
        /* Slick Slider */
        wp_register_script( 'slick-js', UNI_DIR . '/assets/js/slick.min.js', array('jquery'), '1.8.1', true );
        wp_register_style( 'slick-style', UNI_DIR .'/assets/css/slick/slick.css' );
        wp_register_style( 'slick-theme-style', UNI_DIR .'/assets/css/slick/slick-theme.css' );
    
        /* Fancybox */
        wp_register_script( 'fancybox-js', UNI_DIR .'/assets/js/fancybox.umd.js', array('jquery'), '4.0.10', true);
        wp_register_style( 'fancybox-css', UNI_DIR .'/assets/css/fancybox.css' );

        /* Fancybox */
        if( !my_wp_is_mobile() ) {
            wp_enqueue_script( 'aos-js', UNI_DIR .'/assets/js/aos.js', array('jquery'), '1.0.0', true);
            wp_enqueue_style( 'aos-css', UNI_DIR .'/assets/css/aos.css' );
        }
    
        /* Validate js */
        wp_register_script( 'validate-js', UNI_DIR .'/assets/js/jquery.validate.min.js', array('jquery'), '1.19.0', true );
    
        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
           /* Comment Form */
            if( is_single() || is_page() ) {
                wp_enqueue_style( 'comment-style', UNI_DIR .'/assets/css/comment.min.css' );
            }
        }
        
    }
    /**
     * Display Slider
     */
    function uni_carousel(){
        if( uni_option('btn-slide-switch') == true && is_front_page() ) {
            wp_enqueue_script( 'slick-js');
            wp_enqueue_style( 'slick-style');
            wp_enqueue_style( 'slick-theme-style');
            echo '<div id="slider">';
                $setting_slider = uni_option('setting-slider');
                // <!-- Slider -->
                if($setting_slider) {            
                    echo '<div class="slider-container slick-carousel" data-items="1" data-items_lg="1" data-items_md="1" data-items_sm="1" data-items_mb="1" data-dots="true" data-arrows="true" data-row="1" data-infinite="true" data-autoplay="true" data-vertical="false">';
                        foreach ($setting_slider as $key => $value) {
                            echo '<div class="slider-item">';
                                echo '<div class="slider-box">';
                                    echo '<div class="slider-thumbnail" style="background-image:url('.$value['slide_image'].')"></div>';
                                    echo '<div class="slider-caption" data-aos="zoom-in" data-aos-anchor-placement="top-bottom" data-aos-duration="1000">';
                                        echo '<div class="text-effect text-center"><img class="d-inline-block" src="'.$value['slide_title']['url'].'" alt="IMG"></div>';
                                        echo '<div class="slider-permalink">';
                                            if($value['slide_url']) {
                                                echo '<a href="'.$value['slide_url'].'"><span>'.__('Inquiry','shtheme').'</span></a>';
                                            }
                                        echo '</div>';
                                    echo '</div>';
                                echo '</div>';
                            echo' </div>';
                        }
                    echo' </div>';
                }
            echo '</div>';
        }
    }
    function uni_widgets_init() {
        if( uni_option('display-topheader-widget') == true ) {
            register_sidebar( array(
                'name'          => __( 'Top Header', 'shtheme' ),
                'id'            => 'top-header',
                'description'   => __( 'Top Header widget area', 'shtheme' ),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>',
            ) );
        }

        // Footer Widget
        $footer_widgets_number = intval( uni_option('opt-number-footer') );

        $counter = 1;
        while ( $counter <= $footer_widgets_number ) {
    
            register_sidebar( array(
                'name'          => sprintf( __( 'Footer %d', 'shtheme' ), $counter ),
                'id'            => sprintf( 'footer-%d', $counter ),
                'description'   => sprintf( __( 'Footer %d widget area', 'shtheme' ), $counter ),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>',
            ) );
    
            $counter++;
        }
    
        // Sidebar Widget
        register_sidebar( array(
            'name'          => esc_html__( 'Sidebar', 'shtheme' ),
            'id'            => 'sidebar-1',
            'description'   => esc_html__( 'Add widgets here.', 'shtheme' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ) );
    }
    function uni_footer_widget_areas(){ 
        // Footer Widget
        $footer_widgets_number = intval( uni_option('opt-number-footer') );

        switch ( $footer_widgets_number ) {
            case '1':
                $classes = 'ft-column col-md-12';
                break;
            case '2':
                $classes = 'ft-column col-md-6';
                break;
            case '3':
                $classes = 'ft-column col-md-4';
                break;
            case '4':
                $classes = 'ft-column col-md-3';
                break;
            case '5':
                $classes = 'ft-column col-lg-15 col-md-4 col-sm-6';
                break;
        }

        $counter = 1;
        while ( $counter <= $footer_widgets_number ) {
            echo '<div class="'. $classes .'">';
                dynamic_sidebar( 'footer-' . $counter );
            echo '</div>';
            $counter++;
        }
    }
    function uni_sidebar(){
        $layout = uni_option( 'opt-layout' );
        $blogpost_layout = uni_option( 'blogpost-grid' );
        $recruitment_layout = uni_option( 'recruitment-grid' );
        $blogpost_single_layout = uni_option( 'blogpost-single-grid' );
        if( class_exists( 'WooCommerce' )) {
            $product_layout = uni_option( 'product-grid' );
            $product_single_layout = uni_option( 'product-single-grid' );
        }
        if( class_exists( 'WooCommerce' ) && ( is_cart() || is_account_page() || is_checkout() ) ) {
            $classes[] = 'no-sidebar';
        } else {
            if( $layout != '1' && is_front_page() ) {
                get_sidebar();
            }
            if( $blogpost_layout != '1' && is_category() ) {
                get_sidebar();
            }
            if( $recruitment_layout != '1' && is_tax('recruitment_cat') ) {
                get_sidebar();
            }
            if( $blogpost_single_layout != '1' && is_singular('post') ) {
                get_sidebar();
            }
            if( is_page() && !is_page_template( 'pages/page-fullwidth.php' ) && !is_front_page() ) {
                get_sidebar();
            }
            if(class_exists( 'WooCommerce' )) {
                if( $product_layout != '1' && ( is_tax('product_cat') || is_shop() ) ) {
                    get_sidebar();
                }
                if( $product_single_layout != '1' && is_singular('product') ) {
                    get_sidebar();
                }
            }
        }
    }
    /*
    * PHP Mailer
    */
    function phpmailer( $phpmailer ) {
        $phpmailer->IsSMTP();
        $phpmailer->Host       = 'smtp.gmail.com';
        $phpmailer->Port       = '587';
        $phpmailer->SMTPAuth   = true;
        $phpmailer->Username   = 'trunggianuni.06@gmail.com'; // Email bạn dùng đăng ký mật khẩu ứng dụng
        $phpmailer->Password   = 'ezztrtenjxziubkt'; // Mật khẩu ứng dụng Gmail
        $phpmailer->SMTPSecure = 'TLS';
        $phpmailer->From       = 'trunggianuni.06@gmail.com';
        $phpmailer->FromName   = ''.get_bloginfo( 'name' ).'';
    }
    /**
     * Insert Code
     */
    function insert_code_to_header(){
        if( ! empty( uni_option('script-header') ) ) {
            echo uni_option('script-header');
        }
    }
    function insert_code_to_body_top(){
        if( ! empty( uni_option('script-body') ) ) {
            echo uni_option('script-body');
        }
    }
    function insert_code_to_footer(){
        if( ! empty( uni_option('script-footer') ) ) {
            echo uni_option('script-footer');
        }
    }
    function add_new_role() {
		add_role(
			'quantrivien',
			esc_html__( 'Quản trị viên', 'shtheme' ),
            array(
                'activate_plugins'          => false,
                'assign_product_terms'      => true,
                'assign_shop_coupon_terms'  => true,
                'assign_shop_order_terms'   => true,
                'copy_posts'                => true,
                'create_posts'              => true,
                'create_users'              => true,
                'delete_others_pages'       => true,
                'delete_others_posts'       => true,
                'delete_others_products'    => true,
                'delete_others_shop_coupons'    => true,
                'delete_others_shop_orders' => true,
                'delete_pages'              => true,
                'delete_plugins'            => false,
                'delete_posts'              => true,
                'delete_private_pages'      => true,
                'delete_private_posts'      => true,
                'delete_private_products'   => true,
                'delete_private_shop_coupons'   => true,
                'delete_private_shop_orders'    => true,
                'delete_product'            => true,
                'delete_product_terms'      => true,
                'delete_products'           => true,
                'delete_published_pages'    => true,
                'delete_published_posts'    => true,
                'delete_published_products' => true,
                'delete_published_shop_coupons' => true,
                'delete_published_shop_orders'  => true,
                'delete_shop_coupon'        => true,
                'delete_shop_coupon_terms'  => true,
                'delete_shop_coupons'       => true,
                'delete_shop_order'         => true,
                'delete_shop_order_terms'   => true,
                'delete_shop_orders'        => true,
                'delete_themes'             => false,
                'delete_users'              => true,
                'edit_dashboard'            => true,
                'edit_others_pages'         => true,
                'edit_others_posts'         => true,
                'edit_others_products'      => true,
                'edit_others_shop_coupons'  => true,
                'edit_others_shop_orders'   => true,
                'edit_pages'                => true,
                'edit_plugins'              => false,
                'edit_posts'                => true,
                'edit_private_pages'        => true,
                'edit_private_posts'        => true,
                'edit_private_products'     => true,
                'edit_private_shop_coupons' => true,
                'edit_private_shop_orders'  => true,
                'edit_product'              => true,
                'edit_product_terms'        => true,
                'edit_products'             => true,
                'edit_published_pages'      => true,
                'edit_published_posts'      => true,
                'edit_published_products'   => true,
                'edit_published_shop_coupons'   => true,
                'edit_published_shop_orders'    => true,
                'edit_shop_coupon'          => true,
                'edit_shop_coupon_terms'    => true,
                'edit_shop_coupons'         => true,
                'edit_shop_order'           => true,
                'edit_shop_order_terms'     => true,
                'edit_shop_orders'          => true,
                'edit_theme_options'        => true,
                'edit_themes'               => false,
                'edit_users'                => true,
                'export'                    => false,
                'import'                    => false,
                'install_languages'         => false,
                'install_plugins'           => false,
                'install_themes'            => false,
                'list_users'                => true,
                'manage_categories'         => true,
                'manage_links'              => true,
                'manage_options'            => true,
                'manage_product_terms'      => true,
                'manage_shop_coupon_terms'  => true,
                'manage_shop_order_terms'   => true,
                'manage_woocommerce'        => true,
                'moderate_comments'         => true,
                'promote_users'             => true,
                'publish_pages'             => true,
                'publish_posts'             => true,
                'publish_products'          => true,
                'publish_shop_coupons'      => true,
                'publish_shop_orders'       => true,
                'read'                      => true,
                'read_private_pages'        => true,
                'read_private_posts'        => true,
                'read_private_products'     => true, 
                'read_private_shop_coupons' => true, 
                'read_private_shop_orders'  => true, 
                'read_product'              => true, 
                'read_shop_coupon'          => true, 
                'read_shop_order'           => true, 
                'remove_users'              => true, 
                'resume_plugins'            => false,
                'resume_themes'             => false,
                'switch_themes'             => false,
                'unfiltered_html'           => true,
                'unfiltered_upload'         => true,
                'update_core'               => false,
                'update_plugins'            => false,
                'update_themes'             => false,
                'upload_files'              => true,
                'ure_create_capabilities'   => false,
                'ure_create_roles'          => false,
                'ure_delete_capabilities'   => false,
                'ure_delete_roles'          => false,
                'ure_edit_roles'            => false,
                'ure_manage_options'        => false,
                'ure_reset_roles'           => false,
                'view_site_health_checks'   => false,
                'view_woocommerce_reports'  => true,
                'wpcf7_edit_contact_forms'  => true,
                'wpseo_bulk_edit'           => false,
                'wpseo_edit_advanced_metadata'  => false,
                'wpseo_manage_options'      => false,
            ) 
        );
	}
}
$functions = new functions;