<?php
/*******************
 * Load Post via ajax with Pagination - Query post
 ********************/
/******************
 * Thêm shortcode ajax_pagination
 ********************/
function create_shortcode_ajax_pagination_post( $atts ){
    /** Thêm js vào website */
    wp_enqueue_script( 'univn-ajax', esc_url( trailingslashit( get_stylesheet_directory_uri() ) . 'assets/js/ajax-pagination/ajax-pagination-post.js' ), array( 'jquery' ), '1.0', true );
    wp_localize_script( 'univn-ajax', 'uni_array_ajaxp', array('url' => admin_url( 'admin-ajax.php' )) );

    extract( shortcode_atts( array(
        // 'style'                 => '3',
        'post_type'             => 'recruitment',
        'posts_per_page'        => '5',
        'paged'                 => '1',
        'taxonomy'              => 'recruitment_cat',
        'categories'            => '',
        'post_thumb'            => '',
        'post_category'         => '',
        'post_desc'             => '1',
        'post_meta'             => '',
        'post_link'             => '1',
        'number_character'      => '140',
        // 'order'                 => 'desc',
        // 'orderby'               => 'date',
    ), $atts ) );


    $html  = '<div id="result_pagination">';
        $html .= query_ajax_pagination_post( $meta_key,$order,$orderby,$taxonomy,$categories,$post_type,$posts_per_page , $paged,$post_thumb,$post_category,$post_desc,$post_meta,$post_link,$number_character );
    $html .= '</div>';

    return $html;
}
add_shortcode('ajax_pagination_post', 'create_shortcode_ajax_pagination_post');

function query_ajax_pagination_post( $meta_key,$order,$orderby,$taxonomy,$categories,$post_type,$posts_per_page , $paged,$post_thumb,$post_category,$post_desc,$post_meta,$post_link,$number_character ){
    if($taxonomy == '') {
        $args = array(
            'post_type'         => $post_type,
            'posts_per_page'    => $posts_per_page,
            'paged'             => $paged,
            'meta_key'          => $meta_key,
            'orderby'           => $orderby,
            'order'             => $order,
            'post_status' => 'publish'
        );
    } else {
        $args = array(
            'post_type' => $post_type,
            'tax_query' => array(
                array(
                    'taxonomy' 	=> $taxonomy,
                    'field' 	=> 'id',
                    'terms' 	=> $categories,
                )
            ),
            'posts_per_page' => $posts_per_page,
            'paged'         => $paged,
            'post_status'   => 'publish',
            'orderby'       => $orderby,
            'order'         => $order,
            'meta_key'      => $meta_key,
        );
    }

    $the_query = new WP_Query( $args );
    
    /*Tổng bài viết trong query trên*/
    $total_records = $the_query->found_posts;

    /*Tổng số page*/
    $total_pages = ceil($total_records/$posts_per_page);

    if($the_query->have_posts()):
        
        // Settings Loop
        if($post_type == 'recruitment') {
            $blogpost_layout            = uni_option('recruitment-layout');
            $new_post                   = new uni_recruitment_shortcode();
        } else {
            $blogpost_layout            = uni_option('blogpost-layout');
            $new_post                   = new uni_blog_shortcode();
        }
        $image_size                     = 'large';

        $post_class                     = array( 'element', 'hentry', 'post-item' );
        $od = $order;
        $odb = $orderby;
        $mtk = $meta_key;
        $atts['post_thumb']             = $post_thumb;
        $atts['post_category']          = $post_category;
        $atts['post_desc']              = $post_desc;
        $atts['post_meta']              = $post_meta;
        $atts['post_link']              = $post_link;
        $atts['number_character']       = $number_character;

        // Settings layout
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

        $html = '';
        $html .= '<div class="ajax_pagination" order="'.$od.'" orderby="'.$odb.'" meta_key="'.$meta_key.'" taxonomy="'.$taxonomy.'" categories='.$categories.' posts_per_page="'.$posts_per_page.'" post_type="'.$post_type.'" post_thumb="'.$post_thumb.'" post_category="'.$post_category.'" post_desc="'.$post_desc.'" post_meta="'.$post_meta.'" post_link="'.$post_link.'" number_character="'.$number_character.'">';
            $html .=  '<div class="blog-shortcode '.$style.'"><div class="row">';
                while($the_query->have_posts()):$the_query->the_post();
                    $html .= $new_post->general_post_html( $post_class, $atts, $image_size );
                endwhile;
            $html .=  '</div></div>';
            $html .=  '<div class="loading_pagination"><div class="animation_loading"><span class="sk-cube sk-cube1"></span><span class="sk-cube sk-cube2"></span><span class="sk-cube sk-cube3"></span><span class="sk-cube sk-cube4"></span><span class="sk-cube sk-cube5"></span><span class="sk-cube sk-cube6"></span><span class="sk-cube sk-cube7"></span><span class="sk-cube sk-cube8"></span><span class="sk-cube sk-cube9"></span></div></div>';
        $html .= '</div>';
        $html .= paginate_function_post( $posts_per_page, $paged, $total_records, $total_pages); 
    endif;
    wp_reset_query();

    return $html;
}

/** Xử lý Ajax trong WordPress */
add_action( 'wp_ajax_LoadPostsPagination', 'LoadPostsPagination_init' );
add_action( 'wp_ajax_nopriv_LoadPostsPagination', 'LoadPostsPagination_init' );
function LoadPostsPagination_init() {
    $posts_per_page         = intval( $_POST['posts_per_page'] );
    $paged                  = intval( $_POST['data_page'] );
    $taxonomy               = sanitize_text_field( $_POST['taxonomy'] );
    $categories             = sanitize_text_field( $_POST['categories'] );
    $post_type              = sanitize_text_field( $_POST['post_type'] );
    $meta_key               = $_POST['meta_key'];
    $order                  = $_POST['order'];
    $orderby                = $_POST['orderby'];
    $post_thumb             = $_POST['post_thumb'];
    $post_category          = $_POST['post_category'];
    $post_desc              = $_POST['post_desc'];
    $post_meta              = $_POST['post_meta'];
    $post_link              = $_POST['post_link'];
    $number_character       = $_POST['number_character'];
    $html = query_ajax_pagination_post( $meta_key,$order,$orderby,$taxonomy,$categories,$post_type,$posts_per_page , $paged,$post_thumb,$post_category,$post_desc,$post_meta,$post_link,$number_character );
    echo $html;
    exit;
}

function query_ajax_pagination_search($keyword, $post_type,$posts_per_page ,$paged){
    $args = array(
        's'                     => $keyword,
        'post_type'             => $post_type,
        'posts_per_page'        => $posts_per_page,
        'paged'                 => $paged,
        'orderby'               => 'date',
        'order'                 => 'desc',
        'post_status'           => 'publish'
    );

    $the_query = new WP_Query( $args );
    
    /*Tổng bài viết trong query trên*/
    $total_records = $the_query->found_posts;

    /*Tổng số page*/
    $total_pages = ceil($total_records/$posts_per_page);

    if($the_query->have_posts()):

        // Settings Loop
        $new_post                       = new uni_blog_shortcode();
        $post_type                      = 'post';
        $blogpost_layout                = uni_option('blogpost-layout');
        $post_class                     = array( 'element', 'hentry', 'post-item' );
        $image_size                     = 'large';
        if( uni_option('blogpost-thumb') == true ) {
            $atts['post_thumb']             = '1';
        } else {
            $atts['post_thumb']             = '0';
        }
        if( uni_option('blogpost-category') == true ) {
            $atts['post_category']          = '1';
        } else {
            $atts['post_category']          = '0';
        }
        if( uni_option('blogpost-desc') == true ) {
            $atts['post_desc']              = '1';
        } else {
            $atts['post_desc']              = '0';
        }
        if( uni_option('blogpost-meta') == true ) {
            $atts['post_meta']              = '1';
        } else {
            $atts['post_meta']              = '0';
        }
        if( uni_option('blogpost-link') == true ) {
            $atts['post_link']              = '1';
        } else {
            $atts['post_link']              = '0';
        }
        $atts['number_character']           = '140';

        // Settings layout
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

        $html = '';
            $html .= '<div class="ajax_pagination" keyword="'.$keyword.'" posts_per_page="'.$posts_per_page.'" post_type="'.$post_type.'">';
                $html .=  '<div class="blog-shortcode '.$style.'"><div class="row">';
                    while($the_query->have_posts()):$the_query->the_post();
                    $html .= $new_post->general_post_html( $post_class, $atts, $image_size );
                    endwhile;
                $html .=  '</div></div>';
                $html .=  '<div class="loading_pagination"><div class="animation_loading"><span class="sk-cube sk-cube1"></span><span class="sk-cube sk-cube2"></span><span class="sk-cube sk-cube3"></span><span class="sk-cube sk-cube4"></span><span class="sk-cube sk-cube5"></span><span class="sk-cube sk-cube6"></span><span class="sk-cube sk-cube7"></span><span class="sk-cube sk-cube8"></span><span class="sk-cube sk-cube9"></span></div></div>';
            $html .= '</div>';
        $html .= paginate_function_post( $posts_per_page, $paged, $total_records, $total_pages);
    endif;
    wp_reset_query();

    return $html;
}
/** Xử lý Ajax trong WordPress */
add_action( 'wp_ajax_LoadSearchPostPagination', 'LoadSearchPostPagination_init' );
add_action( 'wp_ajax_nopriv_LoadSearchPostPagination', 'LoadSearchPostPagination_init' );
function LoadSearchPostPagination_init() {
    $keyword        = sanitize_text_field( $_POST['keyword'] );
    $posts_per_page = intval( $_POST['posts_per_page'] );
    $paged          = intval( $_POST['data_page'] );
    $post_type      = sanitize_text_field( $_POST['post_type'] );
    $html           = query_ajax_pagination_search( $keyword,$post_type,$posts_per_page , $paged );
    echo $html;
    exit;
}

/******************
Function phân trang PHP có dạng 1,2,3 ...
 ********************/
 function paginate_function_post($item_per_page, $current_page, $total_records, $total_pages) {
    $pagination = '';
    if($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages){ //verify total pages and current page number
        $pagination .= '<div class="pagination">';
            $pagination .= '<ul class="pagination_post">';

            $right_links = $current_page + 2;
            $previous = $current_page - 1; //previous link
            $next = $current_page + 1; //next link
            $first_link = true; //boolean var to decide our first link

            if($current_page > 1){
                $previous_link = ($previous==0)?1:$previous;
                $pagination .= '<li class="first"><a href="#" data-page="1" title="First">&laquo;</a></li>'; //first link
                // $pagination .= '<li><a href="#" data-page="'.$previous_link.'" title="Previous">&lt;</a></li>'; //previous link
                for($i = ($current_page-2); $i < $current_page; $i++){ //Create left-hand side links
                    if($i > 0){
                        $pagination .= '<li><a href="#" data-page="'.$i.'" title="Page'.$i.'">'.$i.'</a></li>';
                    }
                }
                $first_link = false; //set first link to false
            }

            if($first_link){ //if current active page is first link
                $pagination .= '<li class="first active"><span>'.$current_page.'</span></li>';
            }elseif($current_page == $total_pages){ //if it's the last active link
                $pagination .= '<li class="last active"><span>'.$current_page.'</span></li>';
            }else{ //regular current link
                $pagination .= '<li class="active"><span>'.$current_page.'</span></li>';
            }

            for($i = $current_page+1; $i < $right_links ; $i++){ //create right-hand side links
                if($i<=$total_pages){
                    $pagination .= '<li><a href="#" data-page="'.$i.'" title="Page '.$i.'">'.$i.'</a></li>';
                }
            }
            if($current_page < $total_pages){
                $next_link = ($i > $total_pages)? $total_pages : $i;
                // $pagination .= '<li><a href="#" data-page="'.$next_link.'" title="Next"> <i class="icon-angle-right"></i> </a></li>'; //next link
                $pagination .= '<li class="last"><a href="#" data-page="'.$total_pages.'" title="Last"><i class="icon-angle-double-right"></i></a></li>'; //last link
            }

            $pagination .= '</ul>';
        $pagination .= '</div>';
    }
    return $pagination; //return pagination links
}