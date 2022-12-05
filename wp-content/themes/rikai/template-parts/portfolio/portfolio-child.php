<?php

// GET thông tin danh mục
$archive_object     = get_queried_object();
$archive_id         = $archive_object->term_id;
$archive_taxonomy   = $archive_object->taxonomy;
// Settings Loop
if(is_tax('recruitment_cat')) {
    $blogpost_layout    = uni_option('recruitment-layout');
    $blogpost_style     = uni_option('recruitment-style');
    $posts_per_page     = uni_option('recruitment-number-post');
    $new_post           = new uni_recruitment_shortcode();
    $post_type          = 'recruitment';
    $image_size         = 'large';
    $paged              = 1;
    $post_class         = array( 'element', 'hentry', 'post-item' );

    if( uni_option('recruitment-thumb') == true ) {
        $atts['post_thumb']             = '1';
    } else {
        $atts['post_thumb']             = '0';
    }
    if( uni_option('recruitment-category') == true ) {
        $atts['post_category']             = '1';
    } else {
        $atts['post_category']             = '0';
    }
    if( uni_option('recruitment-desc') == true ) {
        $atts['post_desc']             = '1';
    } else {
        $atts['post_desc']             = '0';
    }
    if( uni_option('recruitment-meta') == true ) {
        $atts['post_meta']             = '1';
    } else {
        $atts['post_meta']             = '0';
    }
    if( uni_option('recruitment-link') == true ) {
        $atts['post_link']             = '1';
    } else {
        $atts['post_link']             = '0';
    }
    $atts['number_character']       = '120';
} if(is_tax('service_cat')) {
    $blogpost_layout    = 5;
    $blogpost_style     = 1;
    $posts_per_page     = 10;
    $new_post           = new uni_service_shortcode();
    $post_type          = 'service';
    $image_size         = 'large';
    $paged              = 1;
    $post_class         = array( 'element', 'hentry', 'post-item' );

    $atts['post_thumb']                 = '0';
    $atts['post_category']              = '0';
    $atts['post_desc']                  = '0';
    $atts['post_meta']                  = '0';
    $atts['post_link']                  = '0';
    $atts['number_character']           = '120';
} else {
    $blogpost_layout    = uni_option('blogpost-layout');
    $blogpost_style     = uni_option('blogpost-style');
    $posts_per_page     = uni_option('blogpost-number-post');
    $new_post           = new uni_blog_shortcode();
    $post_type          = 'post';
    $image_size         = 'large';
    $paged              = 1;
    $post_class         = array( 'element', 'hentry', 'post-item' );

    if( uni_option('blogpost-thumb') == true ) {
        $atts['post_thumb']             = '1';
    } else {
        $atts['post_thumb']             = '0';
    }
    if( uni_option('blogpost-category') == true ) {
        $atts['post_category']             = '1';
    } else {
        $atts['post_category']             = '0';
    }
    if( uni_option('blogpost-desc') == true ) {
        $atts['post_desc']             = '1';
    } else {
        $atts['post_desc']             = '0';
    }
    if( uni_option('blogpost-meta') == true ) {
        $atts['post_meta']             = '2';
    } else {
        $atts['post_meta']             = '0';
    }
    if( uni_option('blogpost-link') == true ) {
        $atts['post_link']             = '1';
    } else {
        $atts['post_link']             = '0';
    }
    $atts['number_character']       = '120';
}

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
// Content
$args = array(
    'parent'     	=> $archive_id,
    'hide_empty'  	=> 0,
    'taxonomy'    	=> $archive_object->taxonomy,
);
$categories = get_categories( $args );
if( $categories ) {
    /* Start the Loop */
    foreach ( $categories as $value ) {
        echo '<div class="list-categories mb-4">';
            echo '<h3 class="item-categories-title"><a href="' . get_term_link( $value->term_id, $archive_taxonomy ) . '">' . $value->name . '</a></h3>';
            $args = array(
                'post_type' => $post_type,
                'tax_query' => array(
                    array(
                        'taxonomy' 	=> $archive_taxonomy,
                        'field' 	=> 'id',
                        'terms' 	=> $value->term_id,
                    )
                ),
                'posts_per_page'    => $posts_per_page,
                'paged'		        => get_query_var('paged'),
            );
            /* Start the Loop */
            echo '<div class="blog-shortcode '. $style .'"><div class="row">';
                $the_query = new WP_Query( $args );
                while($the_query -> have_posts()) : $the_query -> the_post();
                    echo $new_post->general_post_html( $post_class, $atts, $image_size );
                endwhile;
            echo '</div></div>';
            echo '<div class="more-post text-center"><a class="btn post_link" href="' . get_term_link( $value->term_id, $archive_taxonomy ) . '">' . __('Read more','shtheme') . '</a></div>';
            wp_reset_postdata();
        echo '</div>';
    }
} else {
    if($blogpost_style == 1) {
        /*get posts website*/
        get_template_part( 'template-parts/portfolio/portfolio-pagination' );
    } else {
        /** Thêm js vào website */
        wp_enqueue_script( 'univn-ajax', UNI_DIR . '/assets/js/ajax-loadmore/ajax-loadmore-post.js', array('jquery'), '1.0', true );
        wp_localize_script( 'univn-ajax', 'uni_array_ajaxp', array('url' => admin_url( 'admin-ajax.php' )) );

        /*get posts website*/
        get_template_part( 'template-parts/portfolio/portfolio-loadmore');
    }
}