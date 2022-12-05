<?php

class News extends CPT_Abstract
{
	public function register_post_type($cpt)
	{
		$cpt->set_post_type(array(
			'post_type' 	=> 'news',
			'name' 			=> _x( 'Bài viết khác', 'Post Type General Name', 'shtheme' ),
			'singular_name' => _x( 'Bài viết khác', 'Post Type Singular Name', 'shtheme' ),
			'supports'		=> [ 'title', 'editor', 'thumbnail', 'excerpt' , 'revisions' ],
			// 'menu_icon'		=> 'dashicons-money',
			'rewrite'		=> [ 'slug' => 'tin-tuc'],
			'menu_position'	=> 6,
			// 'has_archive'	=> false,
			// 'publicly_queryable' => false,
		));
		$cpt->set_no_slug_post_type( 'news' );
		//$cpt->set_no_gutenberg_post_types('product);
	}
}
new News();