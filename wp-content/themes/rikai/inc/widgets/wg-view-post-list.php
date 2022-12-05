<?php
add_action('widgets_init', 'register_widget_top_view');

function register_widget_top_view() {
    register_widget('Uni_Post_Top_View_Widget');
}

class Uni_Post_Top_View_Widget extends WP_Widget {

    function __construct() {

        parent::__construct(
            'list_view_posts',
            __( 'Uni - Top view posts', 'shtheme' ),
            array(
                'description'  => __( 'Top list posts by views', 'shtheme' )
            )
        );
        
    }

    function widget($args, $instance) {
        extract($args);
        echo $before_widget;

        if ($instance['title']) echo $before_title . apply_filters('widget_title', $instance['title']) . $after_title;
        ?>
        <ul class="list-post-item">
            <?php
            function filter_where( $where = '' ) {
                global $postdate;
                $where .= " AND post_date > '" . date('Y-m-d', strtotime('-'.$postdate.' days')) . "'";
                return $where;
            }
            add_filter( 'posts_where', 'filter_where' );

            $args = array(
                'post_type'             => 'post',
                'posts_per_page'        => $instance['numpro'],
                'meta_key'              => 'postview_number',
                'orderby'               => 'meta_value_num',
                'order'                 => 'DESC',
                'ignore_sticky_posts'   => -1,
            );
            $the_query = new WP_Query($args);
            remove_filter( 'posts_where', 'filter_where' );
            while($the_query->have_posts()):
            $the_query->the_post();
            ?>
                <li id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
                    <?php if ( ! empty( $instance['show_image'] ) ) { ?>
                        <a class="img <?php echo $instance['image_alignment'];?>" href="<?php the_permalink();?>" title="<?php the_title();?>">
                            <?php if(has_post_thumbnail()) the_post_thumbnail( $instance['image_size'] ,array( "alt" => get_the_title() ) );?>
                        </a>
                    <?php } ?>
                    <h3>
                        <a href="<?php the_permalink();?>" title="<?php the_title();?>">
                            <?php the_title();?>
                        </a>
                    </h3>
                    <?php
                    if ( ! empty( $instance['show_content'] ) ) {
                        echo '<div class="entry-content">';
                            if ( 'excerpt' == $instance['show_content'] ) {
                                the_excerpt();
                            }
                            elseif ( 'content-limit' == $instance['show_content'] ) {
                                the_content_limit( (int) $instance['content_limit'], __( 'View more', 'shtheme' ) );
                            }
                            else {
                                the_content();
                            }
                        echo '</div>';
                    }
                    ?>
                </li>
            <?php
            endwhile;
            wp_reset_postdata(); ?>
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
            		'title' 			=> '', 
            		'numpro' 			=> '3',
                    'show_image'        => '',
                    'image_alignment'   => '',
                    'image_size'        => '',
                    'postdate'          => '30',
                    'show_content'      => 'content-limit',
                    'content_limit'     => '',
        		) 
        	);
        ?>
        <p>
            <label for="<?php  echo $this->get_field_id('title'); ?>"><?php _e('Title', 'shtheme'); ?>:</label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
        </p>

        <p>
            <label for="<?php  echo $this->get_field_id('numpro'); ?>"><?php _e('Number of Posts to Show', 'shtheme'); ?>:</label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('numpro'); ?>" name="<?php echo $this->get_field_name('numpro'); ?>" value="<?php echo esc_attr( $instance['numpro'] ); ?>" />
        </p>
        
        <p>
            <label for="<?php echo $this-> get_field_id('postdate'); ?>"><?php _e('Post date','shtheme'); ?>:</label>
            <input class="widefat" type="number" id="<?php echo $this->get_field_id('postdate'); ?>" name="<?php echo $this->get_field_name('postdate'); ?>" value="<?php echo esc_attr( $instance['postdate'] ); ?>" />
        </p>

        <p>
            <input id="<?php echo esc_attr( $this->get_field_id( 'show_image' ) ); ?>" type="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'show_image' ) ); ?>" value="1" <?php checked( $instance['show_image'] ); ?>/>
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_image' ) ); ?>"><?php _e( 'Show Featured Image', 'shtheme' ); ?></label>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'image_alignment' ); ?>"><?php _e( 'Image Alignment', 'shtheme' ); ?>:</label>
            <select id="<?php echo $this->get_field_id( 'image_alignment' ); ?>" name="<?php echo $this->get_field_name( 'image_alignment' ); ?>">
                <option value="alignnone">- <?php _e( 'None', 'shtheme' ); ?> -</option>
                <option value="alignleft" <?php selected( 'alignleft', $instance['image_alignment'] ); ?>><?php _e( 'Left', 'shtheme' ); ?></option>
                <option value="alignright" <?php selected( 'alignright', $instance['image_alignment'] ); ?>><?php _e( 'Right', 'shtheme' ); ?></option>
                <option value="aligncenter" <?php selected( 'aligncenter', $instance['image_alignment'] ); ?>><?php _e( 'Center', 'shtheme' ); ?></option>
            </select>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'image_size' ); ?>"><?php _e( 'Image Size', 'shtheme' ); ?>:</label>
            <select id="<?php echo $this->get_field_id( 'image_size' ); ?>" class="" name="<?php echo $this->get_field_name( 'image_size' ); ?>">
                <option value="thumbnail">thumbnail (<?php echo get_option( 'thumbnail_size_w' ); ?>x<?php echo get_option( 'thumbnail_size_h' ); ?>)</option>
                <?php
                $sizes = wp_get_additional_image_sizes();
                foreach( (array) $sizes as $name => $size )
                    echo '<option value="'.esc_attr( $name ).'" '.selected( $name, $instance['image_size'], FALSE ).'>'.esc_html( $name ).' ( '.$size['width'].'x'.$size['height'].' )</option>';
                ?>
            </select>
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_content' ) ); ?>"><?php _e( 'Content Type', 'shtheme' ); ?>:</label>
            <select id="<?php echo esc_attr( $this->get_field_id( 'show_content' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_content' ) ); ?>">
                <option value="content" <?php selected( 'content', $instance['show_content'] ); ?>><?php _e( 'Show Content', 'shtheme' ); ?></option>
                <option value="excerpt" <?php selected( 'excerpt', $instance['show_content'] ); ?>><?php _e( 'Show Excerpt', 'shtheme' ); ?></option>
                <option value="content-limit" <?php selected( 'content-limit', $instance['show_content'] ); ?>><?php _e( 'Show Content Limit', 'shtheme' ); ?></option>
                <option value="" <?php selected( '', $instance['show_content'] ); ?>><?php _e( 'No Content', 'shtheme' ); ?></option>
            </select>
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'content_limit' ) ); ?>"><?php _e( 'Limit content to', 'shtheme' ); ?>
                <input type="text" id="<?php echo esc_attr( $this->get_field_id( 'content_limit' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'content_limit' ) ); ?>" value="<?php echo esc_attr( intval( $instance['content_limit'] ) ); ?>" size="3" />
                <?php _e( 'character', 'shtheme' ); ?>
            </label>
        </p>
        
    <?php
    }
}
