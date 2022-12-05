<?php

class recruitment extends CPT_Abstract
{
	public function register_post_type($cpt)
	{
		$cpt->set_post_type(array(
			'post_type' 	=> 'recruitment',
			'name' 			=> _x( 'Posts Recruitment', 'Post Type General Name', 'shtheme' ),
			'singular_name' => _x( 'Posts Recruitment', 'Post Type Singular Name', 'shtheme' ),
			'supports'		=> [ 'title', 'editor', 'thumbnail', 'excerpt' ],
			// 'menu_icon'		=> 'dashicons-money',
			'rewrite'		=> [ 'slug' => 'recruitment-post'],
			'menu_position'	=> 6,
			// 'has_archive'	=> false,
			// 'publicly_queryable' => false,
		));
		$cpt->set_no_slug_post_type( 'recruitment' );
		//$cpt->set_no_gutenberg_post_types('product);
	}
}
new recruitment();