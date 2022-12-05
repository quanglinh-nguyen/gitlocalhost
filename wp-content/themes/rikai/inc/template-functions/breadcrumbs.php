<?php
/**
 * Breadcrumbs
 * @package Uni_Theme
 * @author  
 * @license 
 * @link    
 */

function uni_create_breadcrumb(){
    if( uni_option('display-pagetitlebar') == true && ! is_front_page() && !is_page_template('pages/page-recruitment.php') && !is_page_template('pages/page-ses.php') && !is_page_template('pages/page-our-promise.php') && !is_page_template('pages/page-winwinshore.php') ) {
        if(is_page()) {
            $banner = get_field('banner',get_the_ID());
            $title = $banner['title'];
            $text_banner = $banner['text_banner'];
            $img_banner = $banner['img_banner'];
            $img = $banner['img'];
            if($img) {
                $banner = $img;
            } else {
                $banner = ' '.get_stylesheet_directory_uri().'/assets/img/bg-general.jpg ';
            }
        } elseif( is_archive() ) {
            $archive_object     = get_queried_object();
            $archive_id         = $archive_object->term_id;
            $archive_taxonomy   = $archive_object->taxonomy;
            $banner = get_field('banner',$archive_taxonomy.'_'.$archive_id);
            $title = $banner['title'];
            $text_banner = $banner['text_banner'];
            $img_banner = $banner['img_banner'];
            $img = $banner['img'];
            if($img) {
                $banner = $img;
            } else {
                $banner = ' '.get_stylesheet_directory_uri().'/assets/img/bg-general.jpg ';
            }
        } elseif( is_singular( 'post' ) ) {
            $slug_category = 'category';
            $primaryID = get_primary_term($slug_category,get_the_ID());
            $banner = get_field('banner',$slug_category.'_'.$primaryID);
            $title = $banner['title'];
            $text_banner = $banner['text_banner'];
            $img_banner = $banner['img_banner'];
            $img = $banner['img'];
            if($img) {
                $banner = $img;
            } else {
                $banner = ' '.get_stylesheet_directory_uri().'/assets/img/bg-general.jpg ';
            }
        } elseif( is_singular( 'recruitment' ) ) {
            $slug_category = 'recruitment_cat';
            $primaryID = get_primary_term($slug_category,get_the_ID());
            $banner = get_field('banner',$slug_category.'_'.$primaryID);
            $title = $banner['title'];
            $text_banner = $banner['text_banner'];
            $img_banner = $banner['img_banner'];
            $img = $banner['img'];
            if($img) {
                $banner = $img;
            } else {
                $banner = ' '.get_stylesheet_directory_uri().'/assets/img/bg-general.jpg ';
            }
        } else {
            $banner = ' '.get_stylesheet_directory_uri().'/assets/img/bg-general.jpg ';
        }
        echo '<div class="wtb-breadcrumb">';
            echo '<div class="breadcrumb-banner" style="background-image:url('.$banner.')"></div>';
            echo '<div class="breadcrumb-content">';
                echo '<div class="container">';
                    echo '<div class="d-flex page-title-bar">';
                        echo '<div class="title-bar-wrap w-100">';
                            if( is_page( ) ) {
                                if($title == 'text') {
                                    echo '<h1 class="title"><span>'. $text_banner .'</span></h1>';
                                } elseif($title == 'image') {
                                    echo '<h1 class="title"><span> <img src="'. $img_banner .'" alt=""> </span></h1>';
                                } else {
                                    echo '<h1 class="title"><span>'. get_the_title( ) .'</span></h1>';
                                }
                                if( is_page_template('pages/page-contact.php') ) {
                                    $excerpt = get_the_excerpt();
                                    echo '<p class="excerpt"> '.$excerpt.' </p>';
                                }
                            } elseif(is_singular('post')) {
                                $slug_category = 'category';
                                $primaryID = get_primary_term($slug_category,get_the_ID());
                                $banner = get_field('banner',$slug_category.'_'.$primaryID);
                                $title = $banner['title'];
                                $text_banner = $banner['text_banner'];
                                $img_banner = $banner['img_banner'];
                                $img = $banner['img'];
                                if($title == 'text') {
                                    echo '<h1 class="title"><span>'. $text_banner .'</span></h1>';
                                } elseif($title == 'image') {
                                    echo '<h1 class="title"><span> <img src="'. $img_banner .'" alt=""> </span></h1>';
                                } else {
                                    ?><h1 class="title"><span><?php echo get_dm_name($primaryID,$slug_category); ?></span></h1><?php
                                }
                            } elseif(is_singular('recruitment')) {
                                $slug_category = 'recruitment_cat';
                                $primaryID = get_primary_term($slug_category,get_the_ID());
                                $banner = get_field('banner',$slug_category.'_'.$primaryID);
                                $title = $banner['title'];
                                $text_banner = $banner['text_banner'];
                                $img_banner = $banner['img_banner'];
                                $img = $banner['img'];
                                if($title == 'text') {
                                    echo '<h1 class="title"><span>'. $text_banner .'</span></h1>';
                                } elseif($title == 'image') {
                                    echo '<h1 class="title"><span> <img src="'. $img_banner .'" alt=""> </span></h1>';
                                } else {
                                    ?><h1 class="title"><span><?php echo get_dm_name($primaryID,$slug_category); ?></span></h1><?php
                                }
                            } elseif(is_singular('service')) {
                                $slug_category = 'service_cat';
                                $primaryID = get_primary_term($slug_category,get_the_ID());
                                $banner = get_field('banner',$slug_category.'_'.$primaryID);
                                $title = $banner['title'];
                                $text_banner = $banner['text_banner'];
                                $img_banner = $banner['img_banner'];
                                $img = $banner['img'];
                                if($title == 'text') {
                                    // echo '<h1 class="title"><span>'. $text_banner .'</span></h1>';
                                } elseif($title == 'image') {
                                    // echo '<h1 class="title"><span> <img src="'. $img_banner .'" alt=""> </span></h1>';
                                } else {
                                    ?><h1 class="title"><span><?php //echo get_dm_name($primaryID,$slug_category); ?></span></h1><?php
                                }
                            } elseif( is_archive() ) {
                                if($title == 'text') {
                                    echo '<h1 class="title"><span>'. $text_banner .'</span></h1>';
                                } elseif($title == 'image') {
                                    echo '<h1 class="title"><span> <img src="'. $img_banner .'" alt=""> </span></h1>';
                                } else {
                                    ?><h1 class="title"><span><?php single_term_title(); ?></span></h1><?php
                                }
                            } elseif( is_search() ) {
                                echo '<h1 class="title">'.__('Search for keyword', 'shtheme').': '. get_search_query() .'</h1>';
                            } elseif( is_404() ) {
                                echo '<h1 class="title">'.__('404 Not Found', 'shtheme').'</h1>';
                            }
                            if ( class_exists( 'WooCommerce' ) ) {
                                if( is_shop() ) {
                                    echo '<h1 class="title">'.__('Products', 'shtheme').'</h1>';
                                }
                            }
                            if ( function_exists('yoast_breadcrumb') ) {
                                yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
                            }
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
    } elseif ( ! is_front_page() ) {
        if ( function_exists('yoast_breadcrumb') ) {
            yoast_breadcrumb( '<div class="wtb-breadcrumb"><div class="container"><p id="breadcrumbs">','</p></div></div>' );
        }
    }
}
add_action( 'before_content','uni_create_breadcrumb' );