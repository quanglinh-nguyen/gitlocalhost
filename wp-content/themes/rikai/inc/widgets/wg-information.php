<?php
add_action('widgets_init', 'register_widget_information');

function register_widget_information() {
    register_widget('Gtid_Information_Widget');
}

class Gtid_Information_Widget extends WP_Widget {

    function __construct() {

        parent::__construct(
            'information',
            __( 'Uni - Information contact', 'shtheme' ),
            array( 
                'description'  => __( 'Display information contact', 'shtheme' ),
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
            $hide_label = ! empty( $instance['hide_label'] ) ? 'd-none' : '';
            $hide_icon  = ! empty( $instance['hide_icon'] ) ? 'd-none' : '';
            if( $instance['company'] ) {
                echo '<li class="label-company"><i class="'. $hide_icon .' fab fa-windows"></i>'. $instance['company'] .'</li>';
            }
            if( $instance['address'] ) {
                echo '<li><i class="'. $hide_icon .' icon-location"></i><span class="'. $hide_label .'">'. __( 'Address', 'shtheme' ) .':</span> '. $instance['address'] .'</li>';
            }
            if( $instance['tel'] ) {
                echo '<li><i class="'. $hide_icon .' icon-phone"></i><span class="'. $hide_label .'">'. __( 'Telephone', 'shtheme' ) .':</span> '. $instance['tel'] .'</li>';
            }
            if( $instance['hotline'] ) {
                echo '<li><i class="'. $hide_icon .' icon-tablet"></i><span class="'. $hide_label .'">'. __( 'Hotline', 'shtheme' ) .':</span> '. $instance['hotline'] .'</li>';
            }
            if( $instance['fax'] ) {
                echo '<li><i class="'. $hide_icon .' icon-print"></i><span class="'. $hide_label .'">'. __( 'Fax', 'shtheme' ) .':</span> '. $instance['fax'] .'</li>';
            }
            if( $instance['email'] ) {
                echo '<li><i class="'. $hide_icon .' icon-mail"></i><span class="'. $hide_label .'">'. __( 'Email', 'shtheme' ) .':</span> '. $instance['email'] .'</li>';
            }
            if( $instance['website'] ) {
                echo '<li><i class="'. $hide_icon .' icon-globe"></i></i><span class="'. $hide_label .'">'. __( 'Website', 'shtheme' ) .':</span> '. $instance['website'] .'</li>';
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
                'company'    => '',
        		'title' 	 => '', 
        		'address'    => '',  
        		'tel' 	     => '',
                'hotline'    => '',
                'fax'        => '',
                'email'      => '',
                'website'    => '',
                'hide_label' => '',
                'hide_icon'  => '',
    		) 
    	);
        ?>
        <p>
            <label for="<?php  echo $this->get_field_id('title'); ?>"><?php _e('Title', 'shtheme'); ?>:</label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php  echo $this->get_field_name('title'); ?>" value="<?php  echo esc_attr( $instance['title'] ); ?>" />
        </p>
        <p>
            <label for="<?php  echo $this->get_field_id('company'); ?>"><?php _e('Company', 'shtheme'); ?>:</label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('company'); ?>" name="<?php  echo $this->get_field_name('company'); ?>" value="<?php  echo esc_attr( $instance['company'] ); ?>" />
        </p>
        <p>
            <label for="<?php  echo $this->get_field_id('address'); ?>"><?php _e('Address', 'shtheme'); ?>:</label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('address'); ?>" name="<?php  echo $this->get_field_name('address'); ?>" value="<?php  echo esc_attr( $instance['address'] ); ?>" />
        </p>
        <p>
            <label for="<?php  echo $this->get_field_id('tel'); ?>"><?php _e('Telephone', 'shtheme'); ?>:</label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('tel'); ?>" name="<?php  echo $this->get_field_name('tel'); ?>" value="<?php  echo esc_attr( $instance['tel'] ); ?>" />
        </p>
        <p>
            <label for="<?php  echo $this->get_field_id('hotline'); ?>"><?php _e('Hotline', 'shtheme'); ?>:</label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('hotline'); ?>" name="<?php  echo $this->get_field_name('hotline'); ?>" value="<?php  echo esc_attr( $instance['hotline'] ); ?>" />
        </p>
        <p>
            <label for="<?php  echo $this->get_field_id('fax'); ?>"><?php _e('Fax', 'shtheme'); ?>:</label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('fax'); ?>" name="<?php  echo $this->get_field_name('fax'); ?>" value="<?php  echo esc_attr( $instance['fax'] ); ?>" />
        </p>
        <p>
            <label for="<?php  echo $this->get_field_id('email'); ?>"><?php _e('Email', 'shtheme'); ?>:</label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('email'); ?>" name="<?php  echo $this->get_field_name('email'); ?>" value="<?php  echo esc_attr( $instance['email'] ); ?>" />
        </p>
        <p>
            <label for="<?php  echo $this->get_field_id('website'); ?>"><?php _e('Website', 'shtheme'); ?>:</label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('website'); ?>" name="<?php  echo $this->get_field_name('website'); ?>" value="<?php  echo esc_attr( $instance['website'] ); ?>" />
        </p>
        <p>
            <input id="<?php echo esc_attr( $this->get_field_id( 'hide_label' ) ); ?>" type="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'hide_label' ) ); ?>" value="1" <?php checked( $instance['hide_label'] ); ?>/>
            <label for="<?php echo esc_attr( $this->get_field_id( 'hide_label' ) ); ?>"><?php _e( 'Hide label', 'shtheme' ); ?></label>
        </p>
        <p>
            <input id="<?php echo esc_attr( $this->get_field_id( 'hide_icon' ) ); ?>" type="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'hide_icon' ) ); ?>" value="1" <?php checked( $instance['hide_icon'] ); ?>/>
            <label for="<?php echo esc_attr( $this->get_field_id( 'hide_icon' ) ); ?>"><?php _e( 'Hide icon', 'shtheme' ); ?></label>
        </p>
    <?php
    }
}
