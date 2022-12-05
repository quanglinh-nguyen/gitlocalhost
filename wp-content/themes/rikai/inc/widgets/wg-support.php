<?php
add_action('widgets_init', 'register_gtid_support');

function register_gtid_support() {
    register_widget('Uni_Support_Online');
}

class Uni_Support_Online extends WP_Widget {

	function __construct() {
        parent::__construct(
            'supports',
            __( 'Uni - Support', 'shtheme' ),
            array(
                'description'  => __( 'Display list support for website', 'shtheme' )
            )
        );
    }

	function widget($args, $instance) {
		extract($args);
		echo $before_widget;
		if ($instance['title']) echo $before_title . apply_filters('widget_title', $instance['title']) . $after_title;
        ?>
        <div class="wrap-support">
	        <div id="supporter-info" class="list-supporter support-style-<?php echo $instance['data_style'];?>">
	        	<?php get_layout_support( $instance, $instance['data_style'] );?>
			</div>
		</div>
		<?php
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		return $new_instance;
	}

	function form($instance) {
		
		$default_support = array(
			'title' 			=> __( 'Support Online', 'shtheme' ),
            'number_supporter' 	=> 1,
            'data_style' 		=> '',
		);

		$args_support = array();

		if( empty( $instance['number_supporter'] ) ) {
			$instance['number_supporter'] = 1;
		}

		for( $i = 1;$i<=$instance['number_supporter'];$i++ ) {
			$args_support['supporter_'.$i.'_name'] = '';
			$args_support['supporter_'.$i.'_phone'] = '';
			$args_support['supporter_'.$i.'_email'] = '';
			$args_support['supporter_'.$i.'_zalo'] = '';
			$args_support['supporter_'.$i.'_skype'] = '';
			$args_support['supporter_'.$i.'_viber'] = '';
		}

		$instance = wp_parse_args( 
			(array)$instance, array_merge( $default_support, $args_support )
		);

		$style =  $instance['data_style'];
		?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'shtheme'); ?>:</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>
        <p>
	    	<label for="<?php echo $this->get_field_id('number_supporter'); ?>">
	    		<?php _e('Number supporter', 'shtheme'); ?>:
	    	</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('number_supporter'); ?>" name="<?php echo $this->get_field_name('number_supporter'); ?>" value="<?php echo esc_attr( $instance['number_supporter'] ); ?>" />
		</p>
		<p>
	        <label for="<?php echo $this->get_field_id('data_style'); ?>">
	        	<?php _e('Appearance', 'shtheme'); ?>:
	        </label>
	    	<select class="widefat" id="<?php echo $this->get_field_id('data_style'); ?>" name="<?php echo $this->get_field_name('data_style'); ?>">
		        <?php for ($i=1; $i < 9; $i++) {?>
			  		<option value="<?php echo $i; ?>" <?php selected( $i , $instance['data_style']); ?>><?php _e('Layout', 'shtheme'); ?> <?php echo $i; ?></option>
		        <?php } ?>
	        </select>
	    </p>
	    <p>
	        <input type="submit" name="savewidget" id="savewidget" class="button-primary widget-control-save" value="<?php _e('Save change', 'shtheme'); ?>" />
    	</p>

    	<?php if( $style == '2' || $style == '3' ) { ?>
    		<p>
				<label for="<?php echo $this->get_field_id('supporter_email_general'); ?>">
					<?php _e('Email', 'shtheme'); ?>:
				</label>
	    		<input class="widefat" type="text" id="<?php echo $this->get_field_id('supporter_email_general'); ?>" name="<?php echo $this->get_field_name('supporter_email_general'); ?>" value="<?php echo esc_attr( $instance['supporter_email_general'] ); ?>" />
			</p>
    	<?php } ?>

        <?php 
        
        for( $i = 1;$i<=$instance['number_supporter'];$i++ ) {
    	?>
            <div style="background: #eee;padding: 10px 10px;margin-bottom: 10px;">
         	
	            <strong><?php echo __('Number supporter', 'shtheme').' '.$i;?></strong>
	           	
	           	<p>
					<label for="<?php echo $this->get_field_id('supporter_'.$i.'_name'); ?>">
						<?php _e('Name', 'shtheme'); ?>:
					</label>
		    		<input class="widefat" type="text" id="<?php echo $this->get_field_id('supporter_'.$i.'_name'); ?>" name="<?php echo $this->get_field_name('supporter_'.$i.'_name'); ?>" value="<?php echo esc_attr( $instance['supporter_'.$i.'_name'] ); ?>" />
	    		</p>

	    		<p>
	    			<label for="<?php echo $this->get_field_id('supporter_'.$i.'_phone'); ?>">
	    				<?php _e('Phone', 'shtheme'); ?>:
	    			</label>
	    			<input class="widefat" type="tel" id="<?php echo $this->get_field_id('supporter_'.$i.'_phone'); ?>" name="<?php echo $this->get_field_name('supporter_'.$i.'_phone'); ?>" value="<?php echo esc_attr( $instance['supporter_'.$i.'_phone'] ); ?>" />
	    		</p>

	    		<?php if( $style == '1' ) : ?>
		    		<p>
			        	<label for="<?php echo $this->get_field_id('supporter_'.$i.'_email'); ?>">
			        		<?php _e('Email', 'shtheme'); ?>:
			        	</label>
						<input class="widefat" type="text" id="<?php echo $this->get_field_id('supporter_'.$i.'_email'); ?>" name="<?php echo $this->get_field_name('supporter_'.$i.'_email'); ?>" value="<?php echo esc_attr( $instance['supporter_'.$i.'_email'] ); ?>" />
					</p>
				<?php endif;?>

		    		<p>
		            	<label for="<?php echo $this->get_field_id('supporter_'.$i.'_skype'); ?>">
		            		<?php _e('Skype', 'shtheme'); ?>:
		            	</label>
		    			<input class="widefat" type="text" id="<?php echo $this->get_field_id('supporter_'.$i.'_skype'); ?>" name="<?php echo $this->get_field_name('supporter_'.$i.'_skype'); ?>" value="<?php echo esc_attr( $instance['supporter_'.$i.'_skype'] ); ?>" />
		    		</p>

	    		<?php if( $style == '3' ) : ?>
	    			<p>
		            	<label for="<?php echo $this->get_field_id('supporter_'.$i.'_zalo'); ?>">
		            		<?php _e('Zalo', 'shtheme'); ?>:
		            	</label>
		    			<input class="widefat" type="text" id="<?php echo $this->get_field_id('supporter_'.$i.'_zalo'); ?>" name="<?php echo $this->get_field_name('supporter_'.$i.'_zalo'); ?>" value="<?php echo esc_attr( $instance['supporter_'.$i.'_zalo'] ); ?>" />
		    		</p>
		    		<p>
		            	<label for="<?php echo $this->get_field_id('supporter_'.$i.'_viber'); ?>">
		            		<?php _e('Viber', 'shtheme'); ?>:
		            	</label>
		    			<input class="widefat" type="text" id="<?php echo $this->get_field_id('supporter_'.$i.'_viber'); ?>" name="<?php echo $this->get_field_name('supporter_'.$i.'_viber'); ?>" value="<?php echo esc_attr( $instance['supporter_'.$i.'_viber'] ); ?>" />
		    		</p>
	    		<?php endif;?>
    		
            </div>
		<?php
		}
	}
}

function get_layout_support($instance, $j = 1) {

	$instance = wp_parse_args( (array)$instance, array(
        'number_supporter' => 1,
	) );

	if( $j == '2' || $j == '3' ) {
		$email_general 	= 	$instance['supporter_email_general'];
	}

	for( $i = 1; $i <= $instance['number_supporter']; $i++ ) {
		$name 	= 	$instance['supporter_'.$i.'_name'];
		$phone 	= 	$instance['supporter_'.$i.'_phone'];
		if( $j == '1' ) {
			$email 	= 	$instance['supporter_'.$i.'_email'];
		}
		$skype 	= 	$instance['supporter_'.$i.'_skype'];
		if( $j == '3' ) {
			$zalo 	= 	$instance['supporter_'.$i.'_zalo'];
			$viber 	= 	$instance['supporter_'.$i.'_viber'];
		}
		?>
		<div id="support-<?php echo $i; ?>" class="supporter">
			<?php
			switch ($j) {
				case '1':
					echo '<ul>';
						if( $name ) {
							echo '<li><i class="icon-user"></i> ' .$name. '</li>';
						}
						if( $phone ) {
							echo '<li><i class="icon-phone-1"></i> ' .$phone. '</li>';
						}
						if( $email ) {
							echo '<li><i class="icon-mail-alt"></i> ' .$email. '</li>';
						}
						if( $skype ) {
							echo '<li><i class="icon-skype"></i> ' .$skype. '</li>';
						}
					echo '</ul>';
					break;
				case '2':
					echo '<ul>';
						if( $name ) {
							echo '<li class="name">' .$name. '</li>';
						}
						if( $phone ) {
							echo '<li class="phone">' .$phone. '</li>';
						}
						if( $skype ) {
							echo '<li class="skype"><a href="skype:'.$skype.'?chat"><img src="'.get_stylesheet_directory_uri().'/assets/img/ic-skype.png"></a></li>';
						}
					echo '</ul>';
					break;
				case '3':
					echo '<ul>';
						if( $name ) {
							echo '<li class="name">' .$name. '</li>';
						}
						if( $phone ) {
							echo '<li class="phone">' .$phone. '</li>';
						}
						echo '<div class="social">';
							if( ! empty( $zalo ) ) {
								echo '<a target="_blank" href="https://zalo.me/'.$zalo.'"><img src="'. get_stylesheet_directory_uri() .'/assets/img/icon-zalo2.png"></a>';
							}
							if( ! empty( $skype ) ) {
								echo '<a target="_blank" href="skype:'.$skype.'?chat"><img src="'. get_stylesheet_directory_uri() .'/assets/img/icon-skype.png"></a>';
							}
							if( ! empty( $viber ) ) {
								echo '<a target="_blank" href="viber://chat?number='.$viber.'"><img src="'. get_stylesheet_directory_uri() .'/assets/img/icon-viber.png"></a>';
							}
						echo '</div>';
					echo '</ul>';
					break;
				case '4':
					
					break;
				case '5':
					
					break;
			}
			?>
		</div>
		<?php
	}

	if( $j == '2' || $j == '3' ) {
		if( $email_general ) {
			echo '<div class="email">'. __('Email', 'shtheme') .' <a href="mailto:'. $email_general .'">'. $email_general .'</a></div>';
		}
	}

}
