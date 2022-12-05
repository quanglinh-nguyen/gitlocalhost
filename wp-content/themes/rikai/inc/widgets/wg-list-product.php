<?php
add_action('widgets_init', 'register_widget_list_products');

function register_widget_list_products() {
    register_widget('Uni_List_Products_Widget');
}

class Uni_List_Products_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
            'list_products',
            __( 'Uni - List Products', 'shtheme' ),
            array(
                'description'  => __( 'Display list product', 'shtheme' )
            )
        );
    }

    function widget($args, $instance) {
        extract($args);
        echo $before_widget;

        if ($instance['title']) echo $before_title . apply_filters('widget_title', $instance['title']) . $after_title;

        echo '<div class="box-products">';
            echo '<div class="list-products">';
                $args   = array(
                    'post_type'         => 'product',
                    'tax_query'         => array(
                        array(
                            'taxonomy'  => 'product_cat',
                            'field'     => 'id',
                            'terms'     => $instance['cat'],
                        )
                    ),
                    'posts_per_page'    => $instance['numpro'],
                );
                $the_query = new WP_Query($args);
                while($the_query->have_posts()):
                $the_query->the_post();
                global $product;
                    echo '<div id="post-'.get_the_ID().'" class="item-product">';
                        echo '<div class="product-thumb '.$instance['image_alignment'].'">';
                            echo '<a class="d-block" href="'.get_the_permalink().'" title="'.get_the_title().'">';
                                if( has_post_thumbnail() ) : 
                                    echo '<img alt="'.get_the_title().'" src="'. get_the_post_thumbnail_url( get_the_ID(), $instance['image_size'] ) .'"/>';
                                else :
                                    echo '<img alt="'.get_the_title().'" src="'. get_stylesheet_directory_uri(  ) .'/assets/img/img-not-available.jpg"/>';
                                endif;
                            echo '</a>';
                        echo '</div>';
                        echo '<div class="product-content">';
                            echo '<h3 class="product-title">';
                                echo '<a href="'.get_the_permalink().'" title="'.get_the_title().'">'.get_the_title().'</a>';
                            echo '</h3>';
                            echo '<div class="price">' . $product->get_price_html() . '</div>';
                        echo '</div>';
                    echo '</div>';
                endwhile;
                wp_reset_postdata();
            echo '</div>';
        echo '</div>';

        echo $after_widget;
    }

    function update($new_instance, $old_instance) {
        return $new_instance;
    }

    function form($instance) {
        $instance = wp_parse_args(
        	(array)$instance, array(
        		'title' 			=> '',
                'type_slider'       => '1', 
        		'numpro' 			=> '3',  
        		'cat' 				=> '',
                'image_alignment'   => 'alignleft',
                'image_size'        => 'thumbnail',
    		)
    	);
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'shtheme'); ?>:</label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php  echo $this->get_field_name('title'); ?>" value="<?php  echo esc_attr( $instance['title'] ); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('numpro'); ?>"><?php _e('Number products', 'shtheme'); ?>:</label>
            <input type="number" class="widefat" id="<?php echo $this->get_field_id('numpro'); ?>" name="<?php  echo $this->get_field_name('numpro'); ?>" value="<?php  echo esc_attr( $instance['numpro'] ); ?>" />
        </p>
        
        <p>
            <label for="<?php echo $this-> get_field_id('cat'); ?>"><?php _e('Category','shtheme'); ?>:</label>
            <?php
            wp_dropdown_categories(array('name'=> $this->get_field_name('cat'),'selected'=>$instance['cat'],'orderby'=>'Name','hierarchical'=>1,'show_option_all'=>__('Select category','shtheme'),'hide_empty'=>'0', 'taxonomy' => 'product_cat'));
            ?>
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
    <?php
    }

}
