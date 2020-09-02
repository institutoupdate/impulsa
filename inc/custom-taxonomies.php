<?php 

function register_taxonomies() {

	// Countries
	$labels = array(
		'name'                       => 'Countries',
		'singular_name'              => 'Country',
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'countries', array( 'materials', 'tracks', 'post' ), $args );

	// Types
	$labels = array(
		'name'                       => 'Types',
		'singular_name'              => 'Type',
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'types', array( 'materials' ), $args );

	// Topics
	$labels = array(
		'name'                       => 'Topics',
		'singular_name'              => 'Topic',
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'topics', array( 'materials', 'tracks' ), $args );

	// Periods
	$labels = array(
		'name'                       => 'Periods',
		'singular_name'              => 'Period',
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'periods', array( 'materials', 'tracks' ), $args );

	// Audience
	$labels = array(
		'name'                       => 'Audience',
		'singular_name'              => 'Audience',
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'audience', array( 'materials', 'tracks' ), $args );

	// Environment
	$labels = array(
		'name'                       => 'Environment',
		'singular_name'              => 'Environment',
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'environment', array( 'materials', 'tracks' ), $args );

}

add_action( 'init', 'register_taxonomies' );