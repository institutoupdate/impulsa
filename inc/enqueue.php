<?php
// Enqueue script

if ( ! function_exists( 'enqueue_scripts' ) ) {
	/**
	 * Load theme's JavaScript sources.
	 */
	function enqueue_scripts() {

		//$the_theme = wp_get_theme();
		// Get the custom theme data.
		//wp_enqueue_style( 'styles', get_stylesheet_directory_uri() . '/css/screen.css', array(), false );

		//wp_enqueue_script( 'jquery-last', get_template_directory_uri() . '/vendor/js/jquery-3.2.1.min.js', array(), '', true);

		//wp_enqueue_script( 'theme-scripts', get_template_directory_uri() . '/js/app.min.js', array(), '', true );

		wp_localize_script( 'theme-scripts', 'config', array(
			'ajax_url'	=>	admin_url('admin-ajax.php'),
			'site_url'	=>	get_bloginfo( 'url' ),
			'theme_url'	=>	get_bloginfo( 'template_url' ),
		));

	}
} // endif function_exists( 'enqueue_scripts' ).

add_action( 'wp_enqueue_scripts', 'enqueue_scripts' );

add_filter( 'style_loader_tag', 'remove_type_attr', 10, 2);
add_filter( 'script_loader_tag', 'remove_type_attr', 10, 2);

function remove_type_attr($tag, $handle) {
    return preg_replace( "/type=['\"]text\/(javascript|css)['\"]/", '', $tag );
}