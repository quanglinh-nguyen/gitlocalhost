<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Photo Cat
 */

class recruitment_cat extends Custom_Taxonomy_Abstract
{
	public function register_taxonomy($taxonomy)
	{
		$taxonomy->set_taxonomy([
			'taxonomy' 			=> 'recruitment_cat',
			'post_type' 		=> 'recruitment',
			'name' 				=> __('Category', 'shtheme'),
			'singular_name' 	=> __('Category', 'shtheme'),
			'rewrite'			=> array(
				'slug'					=> 'recruitment-category',
			),
		]);
	}

}

new recruitment_cat();