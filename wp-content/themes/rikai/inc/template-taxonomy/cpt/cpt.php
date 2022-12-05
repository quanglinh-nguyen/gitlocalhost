<?php

/**
 * Custom Post Type.
 */
class CPT
{
	public $custom_post_types = [];

	public $no_slug_post_types = [];

	public $no_gutenberg_post_types = [];

	function __construct()
	{
		do_action( 'Cpt\register_post_type', $this );

		if ( ! empty( $this->custom_post_types ) ) {
			add_action( 'init', array( $this, 'register_post_type' ), 0 );
		}

		if ( ! empty( $this->no_slug_post_types ) ) {
			add_filter( 'post_type_link', array( $this, 'remove_post_type_slug' ), 10, 3 );
			add_action( 'pre_get_posts', array( $this, 'parse_request_post_type' ) );
		}

		if ( ! empty( $this->no_gutenberg_post_types ) ) {
			add_filter( 'use_block_editor_for_post_type', array( $this, 'disable_gutenberg' ) );
		}
	}

	public function set_post_type(array $post_type)
	{
		$this->custom_post_types[] = array(
			'post_type'             => $post_type['post_type'],
			// $labels array.
			'name'                  => $post_type['name'],
			'singular_name'         => $post_type['singular_name'],
			'menu_name'             => $post_type['name'],
			'name_admin_bar'        => $post_type['name'],
			'archives'              => $post_type['name'],
			'attributes'            => $post_type['singular_name'],
			'parent_item_colon'     => sprintf( __( '%s cha', 'shtheme' ), $post_type['singular_name'] ),
			'all_items'             => sprintf( __( 'All %s', 'shtheme' ), $post_type['name'] ),
			'add_new_item'          => sprintf( __( 'Add New %s', 'shtheme' ), $post_type['singular_name'] ),
			'add_new'               => _x( 'Add New', 'shtheme', 'shtheme' ),
			'new_item'              => sprintf( __( '%s new', 'shtheme' ), $post_type['name'] ),
			'edit_item'             => __( 'Edit', 'shtheme' ),
			'view_item'             => sprintf( __( 'View %s', 'shtheme' ), $post_type['singular_name'] ),
			'search_items'          => sprintf( __( 'Search %s', 'shtheme' ), $post_type['singular_name'] ),
			'not_found'             => sprintf( __( 'No posts found.', 'shtheme' ), $post_type['singular_name'] ),
			'not_found_in_trash'    => sprintf( __( 'No posts found.', 'shtheme' ), $post_type['singular_name'] ),

			'supports'              => $post_type['supports'], //array( 'title', 'editor', 'thumbnail', 'comments', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes', 'post-formats' )
			'show_in_rest'			=> isset($post_type['show_in_rest']) ? $post_type['show_in_rest'] : true,
			'hierarchical'          => isset($post_type['hierarchical']) ? $post_type['hierarchical'] : true,
			'public'                => isset($post_type['public']) ? $post_type['public'] : true,
			'show_ui'               => isset($post_type['show_ui']) ? $post_type['show_ui'] : true,
			'show_in_menu'          => isset($post_type['show_in_menu']) ? $post_type['show_in_menu'] : true,
			'menu_icon'             => $post_type['menu_icon'],
			'menu_position'         => $post_type['menu_position'],
			'show_in_admin_bar'     => isset($post_type['show_in_admin_bar']) ? $post_type['show_in_admin_bar'] : true,
			'show_in_nav_menus'     => isset($post_type['show_in_nav_menus']) ? $post_type['show_in_nav_menus'] : true,
			'can_export'            => isset($post_type['can_export']) ? $post_type['can_export'] : true,
			'has_archive'           => isset($post_type['has_archive']) ? $post_type['has_archive'] : true,
			'exclude_from_search'   => isset($post_type['exclude_from_search']) ? $post_type['exclude_from_search'] : false,
			'publicly_queryable'    => isset($post_type['publicly_queryable']) ? $post_type['publicly_queryable'] : true,
			'rewrite'    			=> isset($post_type['rewrite']) ? $post_type['rewrite'] : true,
			'capability_type'       => isset($post_type['capability_type']) ? $post_type['capability_type'] : 'post'
		);
	}

	public function set_no_slug_post_type($post_type )
	{
		$this->no_slug_post_types[] = $post_type;
	}

	public function set_no_gutenberg_post_types(string $post_type)
	{
		$this->no_gutenberg_post_types[] = $post_type;
	}

	public function register_post_type()
	{
		foreach ($this->custom_post_types as $post_type) {
			register_post_type( $post_type['post_type'],
				[
					'labels' => [
						'name'                  => $post_type['name'],
						'singular_name'         => $post_type['singular_name'],
						'menu_name'             => $post_type['menu_name'],
						'name_admin_bar'        => $post_type['name_admin_bar'],
						'archives'              => $post_type['archives'],
						'attributes'            => $post_type['attributes'],
						'parent_item_colon'     => $post_type['parent_item_colon'],
						'all_items'             => $post_type['all_items'],
						'add_new_item'          => $post_type['add_new_item'],
						'add_new'               => $post_type['add_new'],
						'new_item'              => $post_type['new_item'],
						'edit_item'             => $post_type['edit_item'],
						'view_item'             => $post_type['view_item'],
						'search_items'          => $post_type['search_items'],
						'not_found'             => $post_type['not_found'],
						'not_found_in_trash'    => $post_type['not_found_in_trash'],
					],
					'label'                  	=> $post_type['name'],
					'supports'                  => $post_type['supports'],
					'show_in_rest'              => $post_type['show_in_rest'],
					'hierarchical'              => $post_type['hierarchical'],
					'public'                    => $post_type['public'],
					'show_ui'                   => $post_type['show_ui'],
					'show_in_menu'              => $post_type['show_in_menu'],
					'menu_icon'             	=> $post_type['menu_icon'],
					'menu_position'             => $post_type['menu_position'],
					'show_in_admin_bar'         => $post_type['show_in_admin_bar'],
					'show_in_nav_menus'         => $post_type['show_in_nav_menus'],
					'can_export'                => $post_type['can_export'],
					'has_archive'               => $post_type['has_archive'],
					'exclude_from_search'       => $post_type['exclude_from_search'],
					'publicly_queryable'        => $post_type['publicly_queryable'],
					'capability_type'           => $post_type['capability_type'],
					'rewrite'           		=> $post_type['rewrite']
				]
			);
		}
	}

	public function remove_post_type_slug( $post_link, $post, $leavename )
	{
		if ( ! in_array( $post->post_type, $this->no_slug_post_types ) ) {
			return $post_link;
		}

		$post_link = str_replace( '/' . $post->post_type . '/', '/', $post_link );
		return $post_link;
	}

	public function parse_request_post_type( $query ) {
		// Only noop the main query
		if ( ! $query->is_main_query() ) {
			return;
		}

		$query_temp = $query->query;

		// unset lang query_var for multilang avoid 404
		unset($query_temp['lang']);

		// Only noop our very specific rewrite rule match
		if ( 2 != count( $query_temp ) || ! isset( $query->query['page'] ) ) {
			return;
		}
		// 'name' will be set if post permalinks are just post_name, otherwise the page rule will match
		if ( ! empty( $query->query['name'] ) ) {
			$query->set( 'post_type', array_merge( [ 'post', 'page' ], $this->no_slug_post_types )  );
		}
	}

	public function disable_gutenberg( $current_status, string $post_type )
	{
		if ( in_array( $post_type, $this->no_gutenberg_post_types ) ) return false;
    	return $current_status;
	}
}

new CPT();