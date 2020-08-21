<?php 

function register_taxonomies() {

	// Países
	$labels = array(
		'name'                       => 'Países',
		'singular_name'              => 'País',
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
	register_taxonomy( 'paises', array( 'materiales', 'post' ), $args );

	// Tipos
	$labels = array(
		'name'                       => 'Tipos',
		'singular_name'              => 'Tipo',
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
	register_taxonomy( 'tipos', array( 'materiales' ), $args );

	// Temas
	$labels = array(
		'name'                       => 'Temas',
		'singular_name'              => 'tema',
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
	register_taxonomy( 'temas', array( 'materiales' ), $args );

	// Periodos
	$labels = array(
		'name'                       => 'Periodos',
		'singular_name'              => 'Periodo',
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
	register_taxonomy( 'periodos', array( 'materiales' ), $args );

	// Público
	$labels = array(
		'name'                       => 'Público',
		'singular_name'              => 'Público',
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
	register_taxonomy( 'publico', array( 'materiales' ), $args );

	// Entornos
	$labels = array(
		'name'                       => 'Entorno',
		'singular_name'              => 'Entorno',
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
	register_taxonomy( 'entorno', array( 'materiales' ), $args );

}

add_action( 'init', 'register_taxonomies' );