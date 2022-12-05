<?php
add_action('widgets_init', 'register_gtid_post_by_cat');

function register_gtid_post_by_cat() {
    register_widget('Uni_Post_Widget');
}

class Uni_Post_Widget extends WP_Widget {

    function __construct() {

        parent::__construct(
            'list_posts',
            __( 'Uni - Featured Posts', 'shtheme' ),
            array( 
                'description'  =>  __( 'Displays featured posts with thumbnails', 'shtheme' ),
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
            $args = array(
                'post_type' => 'post',
                'tax_query' => array(
                    array(
                        'taxonomy'  => 'category',
                        'field'     => 'id',
                        'terms'     => $instance['cat'],
                    )
                ),
                'posts_per_page' => $instance['numpro'],
            );
            $the_query = new WP_Query($args);
            while($the_query->have_posts()):
            $the_query->the_post();
            ?>
                <li id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
                    <?php if ( ! empty( $instance['show_image'] ) ) { ?>
                        <a class="img <?php echo $instance['image_alignment'];?>" href="<?php the_permalink();?>" title="<?php the_title();?>">
                            <?php if( has_post_thumbnail() ) the_post_thumbnail( $instance['image_size'] ,array( "alt" => get_the_title() ) );?>
                        </a>
                    <?php } ?>
                    <h3><a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_title();?></a></h3>
                    <?php
                    if ( $instance['show_content'] ) {
                        echo '<div class="entry-content">';
                            if ( 'excerpt' == $instance['show_content'] ) {
                                the_excerpt();
                            }
                            elseif ( 'content-limit' == $instance['show_content'] ) {
                                the_content_limit( (int) $instance['content_limit'], __( 'Read more', 'shtheme' ) );
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
            		'cat' 				=> '',
                    'show_image'        => '',
                    'image_alignment'   => '',
                    'image_size'        => '',
                    'show_content'      => 'content-limit',
                    'content_limit'     => '',
        		) 
        	);
        ?>
        <p>
            <label for="<?php  echo $this->get_field_id('title'); ?>"><?php _e('Title', 'shtheme'); ?>:</label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php  echo $this->get_field_name('title'); ?>" value="<?php  echo esc_attr( $instance['title'] ); ?>" />
        </p>

        <p>
            <label for="<?php  echo $this->get_field_id('numpro'); ?>"><?php _e('Number of Posts to Show', 'shtheme'); ?>:</label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('numpro'); ?>" name="<?php  echo $this->get_field_name('numpro'); ?>" value="<?php  echo esc_attr( $instance['numpro'] ); ?>" />
        </p>
        
        <p>
            <label for="<?php echo $this-> get_field_id('cat'); ?>"><?php _e('Category','shtheme'); ?>:</label>
            <?php
            wp_dropdown_categories(array('name'=> $this->get_field_name('cat'),'selected'=>$instance['cat'],'orderby'=>'Name','hierarchical'=>1,'show_option_all'=>__('Select category','shtheme'),'hide_empty'=>'0'));
            ?>
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
