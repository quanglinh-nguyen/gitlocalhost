<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Uni_Theme
 */
global $post;
$post_type = 'recruitment';
$taxonomy = 'recruitment_cat';
postview_set( get_the_ID() );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?>>
    <?php //if( uni_option('display-pagetitlebar') == false ) : ?>
        <section class="single-post__header">
            <?php
                if ( is_single() ) :
                    the_title( '<h1 class="entry-title"><span>', '</span></h1>' );
                else :
                    the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
                endif;
            ?>
        </section><!-- .single-header -->
    <?php //endif;?>
    <?php if( uni_option('recruitment-single-time-view') == true ) : ?>
        <section class="single-post__meta">
                <span class="date-time"><i class="icon-clock"></i> <?php echo get_the_time('d/m/Y'); ?></span>
                <span class="entry-view"> <?php echo postview_get( get_the_ID() ); ?></span>
        </section>
    <?php endif; ?>
    <section class="single-post__content">
        <?php
            the_content( sprintf(
                /* translators: %s: Name of current post. */
                wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'shtheme' ), array( 'span' => array( 'class' => array() ) ) ),
                the_title( '<span class="screen-reader-text">"', '"</span>', false )
            ) );
            echo get_the_tag_list('<p><i class="fas fa-tags"></i> '. __('Tags','shtheme') .': ',', ','</p>');
        ?>
        <div class="form-recruitment">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 mb-5">
                    <div class="form-wrap">
                        <?php echo do_shortcode('[contact-form-7 id="700" title="Recruitment"]'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- .single-content -->
    <?php if( uni_option('recruitment-single-sharepost') == true ) : ?>
        <section class="single-post__socials">
            <?php 
                $post = get_post(get_the_ID());
            ?>
            <div class="share_unit"> 
                <a href="https://www.facebook.com/sharer.php?u=<?php esc_url(the_permalink());?>&t=<?php echo $post->post_name; ?>" target="_blank" class="social_facebook">
                    <i class="icon-facebook"></i>
                </a> 
                <a href="https://twitter.com/intent/tweet?text=<?php the_title() ?>+<?php the_permalink();?>" class="social_tweet" target="_blank">
                    <i class="icon-twitter"></i>
                </a> 
                <a href="https://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&media=<?php the_post_thumbnail_url( ) ?>&description=<?php esc_url(the_title()) ?>" target="_blank" class="social_pinterest">
                    <i class="icon-pinterest"></i>
                </a> 
            </div>
        </section>
    <?php endif;?>
    <?php
    if( uni_option('recruitment-single-navipost') == true && ( ! empty( get_next_post() ) || ! empty( get_previous_post() ) ) ) :
        $primaryID = get_primary_term('category',get_the_ID());

        $args = array( 
            'category' => $primaryID,
            'orderby'  => 'post_date',
            'order'    => 'DESC'
        );
        $posts = get_posts( $args );
        // get IDs of posts retrieved from get_posts
        $ids = array();
        foreach ( $posts as $thepost ) {
            $ids[] = $thepost->ID;
        }
        // get and echo previous and next post in the same category
        $thisindex = array_search( get_the_ID(), $ids );
        $previd    = isset( $ids[ $thisindex - 1 ] ) ? $ids[ $thisindex - 1 ] : false;
        $nextid    = isset( $ids[ $thisindex + 1 ] ) ? $ids[ $thisindex + 1 ] : false;
    ?>
        <section class="single-post__navi mb-5">
            <div class="post-next-prev-wrap">
                <div class="row">
                    <div class="col-sm-6">
                        <?php 
                            if (false !== $previd ) {
                                echo '<div class="post-next-prev-content">';
                                    echo '<span>'.__( 'Previous Post', 'shtheme' ).'</span>';
                                    echo '<div class="post-next-prev-block">';
                                            echo '<a class="img" rel="previous" href="'.get_permalink($previd).'"> <img src="'.get_the_post_thumbnail_url($previd,'large').'" alt=""> </a>';
                                            echo '<a class="title" rel="previous" href="'.get_permalink($previd).'">'.get_the_title($previd).'</a>';
                                        echo '</div>';
                                echo '</div>';
                            }
                        ?>
                    </div>
                    <div class="col-sm-6">
                        <?php 
                            if (false !== $nextid ) {
                                echo '<div class="post-next-prev-content">';
                                    echo '<span>'.__( 'Next Post', 'shtheme' ).'</span>';
                                    echo '<div class="post-next-prev-block">';
                                        echo '<a class="img" rel="next" href="'.get_permalink($nextid).'"> <img src="'.get_the_post_thumbnail_url($nextid,'large').'" alt=""> </a>';
                                        echo '<a class="title" rel="next" href="'.get_permalink($nextid).'">'.get_the_title($nextid).'</a>';
                                    echo '</div>';
                                echo '</div>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif;?>
    <section class="single-post__comment mb-5">
        <?php 
            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;
        ?>
    </section>
    <?php 
    if( uni_option('recruitment-single-relatedpost') == true ) {
        // $blogpost_layout     = uni_option('recruitment-layout');
        $blogpost_layout     = 3;
        $posts_per_page     = uni_option('recruitment-number-post-related');
        $new_post           = new uni_recruitment_shortcode();
        // $post_type          = 'post';
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
            $atts['post_meta']             = '2';
        } else {
            $atts['post_meta']             = '0';
        }
        if( uni_option('recruitment-link') == true ) {
            $atts['post_link']             = '1';
        } else {
            $atts['post_link']             = '0';
        }
        $atts['number_character']       = '140';

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
        // Get id category
        $primaryID = get_primary_term($taxonomy,get_the_ID());
        if($primaryID) {
            // Loop
            $the_query = new WP_Query( array(
                'post_type'         => $post_type,
                'tax_query'         => array(
                    array(
                        'taxonomy'  => $taxonomy, //change taxonomy
                        'field'     => 'id',
                        'terms'     => $primaryID,
                    )
                ),
                'posts_per_page'    => $posts_per_page,
                'post__not_in'      => array( get_the_ID() ),
            ));
            if( $the_query->have_posts() ) :
                echo '<section class="single-post__related">';
                    echo '<h4 class="related-title"><span>'. __( 'Related posts', 'shtheme' ) .'</span></h4>';
                    /* Start the Loop */
                    echo '<div class="blog-shortcode '. $style .'"><div class="row">';
                        while($the_query -> have_posts()) : $the_query -> the_post();
                            echo $new_post->general_post_html( $post_class, $atts, $image_size );
                        endwhile;
                    echo '</div></div>';
                echo '</section>';
            endif;
            wp_reset_postdata();
        }
    }
    ?>
</article><!-- #post-## -->