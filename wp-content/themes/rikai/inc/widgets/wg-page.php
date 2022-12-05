<?php
add_action('widgets_init', 'Uni_register_widget_page');

function Uni_register_widget_page() {
    register_widget('Uni_Page_Widget');
}

class Uni_Page_Widget extends WP_Widget {

	function __construct() {

        parent::__construct(
            'featuredpage',
            __( 'Uni - Featured Page', 'shtheme' ),
            array( 
            	'description'  =>  __( 'Display featured page', 'shtheme' ),
            )
        );

    }

	function form( $instance ) {

		//* Merge with defaults
        $default = array(
			'title'           => '',
			'page_id'         => '',
			'show_image'      => 0,
			'image_alignment' => '',
			'image_size'      => '',
			'show_title'      => 0,
			'show_content'    => 0,
			'content_limit'   => '',
			'more_text'       => '',
		);
		$instance = wp_parse_args( (array) $instance, $default );

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'shtheme' ); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'page_id' ); ?>"><?php _e( 'Page', 'shtheme' ); ?>:</label>
			<?php wp_dropdown_pages( array( 'name' => $this->get_field_name( 'page_id' ), 'selected' => $instance['page_id'] ) ); ?>
		</p>

		<hr class="div" />

		<p>
			<input id="<?php echo $this->get_field_id( 'show_image' ); ?>" type="checkbox" name="<?php echo $this->get_field_name( 'show_image' ); ?>" value="1"<?php checked( $instance['show_image'] ); ?> />
			<label for="<?php echo $this->get_field_id( 'show_image' ); ?>"><?php _e( 'Show Featured Image', 'shtheme' ); ?></label>
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
			<label for="<?php echo $this->get_field_id( 'image_alignment' ); ?>"><?php _e( 'Image Alignment', 'shtheme' ); ?>:</label>
			<select id="<?php echo $this->get_field_id( 'image_alignment' ); ?>" name="<?php echo $this->get_field_name( 'image_alignment' ); ?>">
				<option value="alignnone">- <?php _e( 'None', 'shtheme' ); ?> -</option>
				<option value="alignleft" <?php selected( 'alignleft', $instance['image_alignment'] ); ?>><?php _e( 'Left', 'shtheme' ); ?></option>
				<option value="alignright" <?php selected( 'alignright', $instance['image_alignment'] ); ?>><?php _e( 'Right', 'shtheme' ); ?></option>
				<option value="aligncenter" <?php selected( 'aligncenter', $instance['image_alignment'] ); ?>><?php _e( 'Center', 'shtheme' ); ?></option>
			</select>
		</p>

		<hr class="div" />

		<p>
			<input id="<?php echo $this->get_field_id( 'show_title' ); ?>" type="checkbox" name="<?php echo $this->get_field_name( 'show_title' ); ?>" value="1"<?php checked( $instance['show_title'] ); ?> />
			<label for="<?php echo $this->get_field_id( 'show_title' ); ?>"><?php _e( 'Show Page Title', 'shtheme' ); ?></label>
		</p>

		<p>
			<input id="<?php echo $this->get_field_id( 'show_content' ); ?>" type="checkbox" name="<?php echo $this->get_field_name( 'show_content' ); ?>" value="1"<?php checked( $instance['show_content'] ); ?> />
			<label for="<?php echo $this->get_field_id( 'show_content' ); ?>"><?php _e( 'Show Page Content', 'shtheme' ); ?></label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'content_limit' ); ?>"><?php _e( 'Content Character Limit', 'shtheme' ); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'content_limit' ); ?>" name="<?php echo $this->get_field_name( 'content_limit' ); ?>" value="<?php echo esc_attr( $instance['content_limit'] ); ?>" size="3" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'more_text' ); ?>"><?php _e( 'More Text', 'shtheme' ); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'more_text' ); ?>" name="<?php echo $this->get_field_name( 'more_text' ); ?>" value="<?php echo esc_attr( $instance['more_text'] ); ?>" />
		</p>

		<?php

	}

	function update($new_instance, $old_instance) {
        return $new_instance;
    }

	function widget($args, $instance) {
		
		extract($args);
        echo $before_widget;

		if ($instance['title']) echo $before_title . apply_filters('widget_title', $instance['title']) . $after_title;

		global $wp_query;

		$wp_query = new WP_Query( array( 'page_id' => $instance['page_id'] ) );

		echo '<div class="content-feature-page">';

		if ( have_posts() ) : while ( have_posts() ) : the_post();

			$image = get_the_post_thumbnail( $instance['page_id'], $instance['image_size'] );

			if ( $instance['show_image'] && $image ) {

				printf( '<a href="%s" title="%s" class="%s">%s</a>', get_permalink(), the_title_attribute( 'echo=0' ), esc_attr( $instance['image_alignment'] ), $image );

			}

			if ( ! empty( $instance['show_title'] ) ) {

				printf( '<section class="entry-header"><h2 class="entry-title"><a href="%s">%s</a></h2></section>', get_permalink(), get_the_title( ) );

			}

			if ( ! empty( $instance['show_content'] ) ) {

				if ( empty( $instance['content_limit'] ) ) {

					global $more;

					$orig_more = $more;
					$more = 0;

					the_content( $instance['more_text'] );

					$more = $orig_more;

				} else {
					the_content_limit( (int) $instance['content_limit'], esc_html( $instance['more_text'] ) );
				}

			}

		endwhile;

		endif;

		echo '</div>';

		//* Restore original query
		wp_reset_query();

		echo $after_widget;

	}

}