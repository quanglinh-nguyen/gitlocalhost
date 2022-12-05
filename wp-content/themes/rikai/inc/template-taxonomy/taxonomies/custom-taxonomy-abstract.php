<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Custom Taxonomy
 */

abstract class Custom_Taxonomy_Abstract
{
	function __construct()
	{
		add_action( 'sh_register_taxonomy', [ $this, 'register_taxonomy' ]);
	}

	public function register_taxonomy($taxonomy)
	{
		// 
	}

}