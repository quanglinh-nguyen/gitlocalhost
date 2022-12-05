<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Photo Cat
 */

class service_cat extends Custom_Taxonomy_Abstract
{
	public function register_taxonomy($taxonomy)
	{
		$taxonomy->set_taxonomy([
			'taxonomy' 			=> 'service_cat',
			'post_type' 		=> 'service',
			'name' 				=> __('Service Category', 'shtheme'),
			'singular_name' 	=> __('Service Category', 'shtheme'),
			'rewrite'			=> array(
				'slug'					=> 'service-category',
			),
		]);
	}

}

new service_cat();