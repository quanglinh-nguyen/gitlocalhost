<?php

abstract class CPT_Abstract
{
	function __construct()
	{
		add_action( 'Cpt\register_post_type', array( $this, 'register_post_type' ) );
	}

	public function register_post_type($cpt)
	{
	}
}