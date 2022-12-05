<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Photo Cat
 */

class News_Cat extends Custom_Taxonomy_Abstract
{
	public function register_taxonomy($taxonomy)
	{
		$taxonomy->set_taxonomy([
			'taxonomy' 			=> 'news_cat',
			'post_type' 		=> 'news',
			'name' 				=> __('Danh mục', 'shtheme'),
			'singular_name' 	=> __('Danh mục', 'shtheme'),
			'rewrite'			=> array(
				'slug'					=> 'chuyen-muc-tin-tuc',
			),
		]);
	}

}

new News_Cat();