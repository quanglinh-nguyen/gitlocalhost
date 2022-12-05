<?php
function readmore_post_ajax(){

    $taxonomy                       = $_POST['taxonomy'];
    $category                       = $_POST['category'];
    $post_type                      = $_POST['post_type'];
    $posts_per_page                 = $_POST['posts_per_page'];
    $paged                          = $_POST['paged'];
    $post_thumb                     = $_POST['post_thumb'];
    $post_category                  = $_POST['post_category'];
    $post_desc                      = $_POST['post_desc'];
    $post_meta                      = $_POST['post_meta'];
    $post_link                      = $_POST['post_link'];
    $number_character               = $_POST['number_character'];
    
    // Settings Loop
    if( $post_type == 'recruitment' ) {
        $blogpost_layout                 = uni_option('recruitment-layout');
        $new_post                       = new uni_recruitment_shortcode();
    } else {
        $blogpost_layout                 = uni_option('blogpost-layout');
        $new_post                       = new uni_blog_shortcode();
    }
    $image_size                     = 'large';
    
    $post_class                     = array( 'element', 'hentry', 'post-item' );
    $atts['post_thumb']             = $post_thumb;
    $atts['post_category']          = $post_category;
    $atts['post_desc']              = $post_desc;
    $atts['post_meta']              = $post_meta;
    $atts['post_link']              = $post_link;
    $atts['number_character']       = $number_character;

    // Settings Style
    switch ( $blogpost_layout ) {
        case '1':
            $post_class[]               = 'col-md-12';
            $style                      = 'style-1';
            break;
        case '2':
            $post_class[]               = 'col-lg-6 col-md-6 col-sm-6';
            $style                      = 'style-2';
            break;
        case '3':
            $post_class[]               = 'col-lg-4 col-md-6 col-sm-6';
            $style                      = 'style-3';
            break;
        case '4':
            $post_class[]               = 'col-lg-3 col-md-6 col-sm-6';
            $style                      = 'style-4';
            break;
        case '5':
            $post_class[]               = 'col-lg-6 col-md-6 col-sm-6';
            $style                      = 'style-5';
            break;
        default:
            $post_class[]               = 'col-md-12';
            $style                      = 'style-1';
            break;
    }

    $args = array(
        'post_type' => $post_type,
        'tax_query' => array(
            array(
                'taxonomy'  => $taxonomy,
                'field'     => 'id',
                'terms'     => $category,
            )
        ),
        'posts_per_page' => $posts_per_page,
        'paged'         => $paged,
        'post_status'   => 'publish',
        'orderby'       => 'date',
        'order'         => 'desc',
    );
    $html = '';
    $the_query = new WP_Query($args);
    if ($the_query -> have_posts()) :  
        while($the_query -> have_posts()) : $the_query -> the_post();
            $html .= $new_post->general_post_html( $post_class, $atts, $image_size );
        endwhile;
        wp_reset_postdata();
    endif;
    echo json_encode(
        array(
            'content'       => $html,
        )
    );
    die();
    
}

add_action('wp_ajax_nopriv_readmore_post_ajax', 'readmore_post_ajax');
add_action('wp_ajax_readmore_post_ajax', 'readmore_post_ajax');