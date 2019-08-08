<?php

// and POST requests.
use Rareloop\WordPress\Router\Router;
Router::init();
Router::get(
	'test/route/{id}',
	function ( $params ) {

		\get_header();
		var_dump( $params );
		\get_footer();

	}
)->name( 'test.show' );

$url = Router::url('test.show', ['id' => 123]);
var_dump( $url );

