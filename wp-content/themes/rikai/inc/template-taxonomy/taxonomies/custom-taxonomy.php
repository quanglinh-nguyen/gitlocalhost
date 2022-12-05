<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Custom Post Type.
 */

class Custom_Taxonomy

{
	public $custom_taxonomies = [];

	public $no_slug_taxonomies = [];

	function __construct()

	{
		do_action( 'sh_register_taxonomy', $this );

		if ( ! empty( $this->custom_taxonomies ) ) {

			add_action( 'init', [ $this, 'register_taxonomy' ], 0 );
		}

		if ( ! empty( $this->no_slug_taxonomies ) ) {

			add_filter( 'term_link', [ $this, 'remove_taxonomy_slug' ], 10, 3 );

			add_action( 'init', [ $this, 'taxonomy_rewrite_rule' ] );

			add_action( 'create_term', [ $this, 'fix_404_when_create_term' ], 10, 2 );
		}
	}

	public function set_taxonomy(array $taxonomy)
	{
		$this->custom_taxonomies[] = [
			'taxonomy'             	=> $taxonomy['taxonomy'],
			'post_type'             => $taxonomy['post_type'],
			// $labels array.
			'name'                  => $taxonomy['name'],
			'singular_name'         => $taxonomy['singular_name'],
			'menu_name'             => $taxonomy['name'],
			'public'                => !empty($taxonomy['public']) ? $taxonomy['public'] : true,
			'show_in_rest'          => !empty($taxonomy['show_in_rest']) ? $taxonomy['show_in_rest'] : true,
			'show_in_nav_menus'     => !empty($taxonomy['show_in_nav_menus']) ? $taxonomy['show_in_nav_menus'] : true,
			'show_admin_column'     => !empty($taxonomy['show_admin_column']) ? $taxonomy['show_admin_column'] : true,
			'hierarchical'          => !empty($taxonomy['hierarchical']) ? $taxonomy['hierarchical'] : true,
			'with_front'            => !empty($taxonomy['with_front']) ? $taxonomy['with_front'] : true,
			'show_tagcloud'         => !empty($taxonomy['show_tagcloud']) ? $taxonomy['show_tagcloud'] : true,
			'show_ui'               => !empty($taxonomy['show_ui']) ? $taxonomy['show_ui'] : true,
			'query_var'             => !empty($taxonomy['query_var']) ? $taxonomy['query_var'] : true,
			'rewrite'               => !empty($taxonomy['rewrite']) ? $taxonomy['rewrite'] : true,
			'capabilities'          => !empty($taxonomy['capabilities']) ? $taxonomy['capabilities'] : array(),
		];
	}

	public function set_no_slug_taxonomy($taxonomy)
	{
		$this->no_slug_taxonomies[] = $taxonomy;
	}


	public function register_taxonomy()
	{
		foreach ($this->custom_taxonomies as $taxonomy) {
			register_taxonomy(
				$taxonomy['taxonomy'],
				$taxonomy['post_type'],
				[
					'labels' => [
						'name'                  => $taxonomy['name'],
						'singular_name'         => $taxonomy['singular_name'],
						'menu_name'             => $taxonomy['name'],
					],
					'public'                => $taxonomy['public'],
					'show_in_nav_menus'     => $taxonomy['show_in_nav_menus'],
					'show_in_rest'     		=> $taxonomy['show_in_rest'],
					'show_admin_column'     => $taxonomy['show_admin_column'],
					'hierarchical'          => $taxonomy['hierarchical'],
					'with_front'            => $taxonomy['with_front'],
					'show_tagcloud'         => $taxonomy['show_tagcloud'],
					'show_ui'               => $taxonomy['show_ui'],
					'query_var'             => $taxonomy['query_var'],
					'rewrite'               => $taxonomy['rewrite'],
					'query_var'             => $taxonomy['query_var'],
					'capabilities'          => $taxonomy['capabilities'],
				]
			);
		}
	}

	public function remove_taxonomy_slug( $url, $term, $taxonomy )
	{
		if ( in_array( $taxonomy, $this->no_slug_taxonomies ) ) {
			$term_nicename = $term->slug;
			$url = trailingslashit( get_option( 'home' ) ) . user_trailingslashit( $term_nicename, $taxonomy );
		}
		return $url;
	}

	public function taxonomy_rewrite_rule( $flush = false )
	{
		$terms = get_terms( [
			'taxonomy'   => $this->no_slug_taxonomies,
			'hide_empty' => false,
		] );

		if ( $terms && ! is_wp_error( $terms ) ) {

			foreach ( $terms as $term ) {

				$term_slug = $term->slug;

				add_rewrite_rule( $term_slug . '/?$', 'index.php?'.$term->taxonomy.'=' . $term_slug, 'top' );

				add_rewrite_rule( $term_slug . '/page/([0-9]{1,})/?$', 'index.php?'.$term->taxonomy.'=' . $term_slug . '&paged=$matches[1]', 'top' );

				add_rewrite_rule( $term_slug . '/(?:feed/)?(feed|rdf|rss|rss2|atom)/?$', 'index.php?'.$term->taxonomy.'=' . $term_slug . '&feed=$matches[1]', 'top' );
			}
		}

		if ( $flush ) {
			flush_rewrite_rules( false );
		}

	}

	public function fix_404_when_create_term( $term_id, $taxonomy )
	{
		$this->taxonomy_rewrite_rule(true);

	}
}

new Custom_Taxonomy();