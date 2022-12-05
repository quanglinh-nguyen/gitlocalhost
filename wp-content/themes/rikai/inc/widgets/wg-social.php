<?php
add_action('widgets_init', 'register_widget_social');

function register_widget_social() {
    register_widget('Uni_Social_Widget');
}

class Uni_Social_Widget extends WP_Widget {

    function __construct() {

        parent::__construct(
            'social',
            __( 'Uni - Social', 'shtheme' ),
            array(
                'description'  =>  __( 'Display information social', 'shtheme' )
            )
        );
        
    }

    function widget($args, $instance) {
        extract($args);
        echo $before_widget;

        if ($instance['title']) echo $before_title . apply_filters('widget_title', $instance['title']) . $after_title;

        ?>
            <ul>
                <?php
                    if( get_field('social_facebook','option') ) {
                        echo '<li class="icon_social icon_facebook"><a title="Facebook" href="'. get_field('social_facebook','option') .'" rel="nofollow" target="_blank"><img src="'.get_stylesheet_directory_uri().'/assets/img/icon/ic-facebook.svg" alt="Facebook"></a></li>';
                    }
                    if( get_field('social_youtube','option') ) {
                        echo '<li class="icon_social icon_youtube"><a title="youtube" href="'. get_field('social_youtube','option') .'" rel="nofollow" target="_blank"><img src="'.get_stylesheet_directory_uri().'/assets/img/icon/ic-youtube.svg" alt="youtube"></a></li>';
                    }
                    // if( get_field('social_messenger','option') ) {
                    //     echo '<li class="icon_social icon_messenger"><a title="Messenger" href="'. get_field('social_messenger','option') .'" rel="nofollow" target="_blank"><img src="'.get_stylesheet_directory_uri().'/assets/img/ic-messenger.svg" alt="Messenger"></a></li>';
                    // }
                    if( get_field('social_instagram','option') ) {
                        echo '<li class="icon_social icon_instagram"><a title="Instagram" href="'. get_field('social_instagram','option') .'" rel="nofollow" target="_blank"><img src="'.get_stylesheet_directory_uri().'/assets/img/icon/ic-instagram.svg" alt="Instagram"></a></li>';
                    }
                    if( get_field('social_tiktok','option') ) {
                        echo '<li class="icon_social icon_tiktok"><a title="Tiktok" href="'. get_field('social_tiktok','option') .'" rel="nofollow" target="_blank"><img src="'.get_stylesheet_directory_uri().'/assets/img/icon/ic-tiktok.svg" alt="Tiktok"></a></li>';
                    }
                    if( get_field('social_twitter','option') ) {
                        echo '<li class="icon_social icon_twitter"><a title="Twitter" href="'. get_field('social_twitter','option') .'" rel="nofollow" target="_blank"><img src="'.get_stylesheet_directory_uri().'/assets/img/icon/ic-twitter.svg" alt="Twitter"></a></li>';
                    }
                    if( get_field('social_zalo','option') ) {
                        echo '<li class="icon_social icon_zalo"><a title="Zalo" href="https://zalo.me/'. get_field('social_zalo','option') .'" rel="nofollow" target="_blank"><img src="'.get_stylesheet_directory_uri().'/assets/img/icon/ic-zalo.svg" alt="Zalo"></a></li>';
                    }
                ?>
            </ul>
        <?php
        echo $after_widget;
    }

    function update($new_instance, $old_instance) {
        return $new_instance;
    }

    function form($instance) {
        $instance = wp_parse_args(
            (array)$instance, array(
                // 'title'             => '', 
                // 'numpro'            => '3',  
                // 'cat'               => '',
            )
        );
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'shtheme' ); ?>:</label>
            <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" />
        </p>
        <?php _e('<p>This widget content is displayed from <strong>Theme Options -> Social</strong></p>');?>
    <?php
    }

}
