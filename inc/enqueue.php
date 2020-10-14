<?php
// Enqueue script

if ( ! function_exists( 'enqueue_scripts' ) ) {
	/**
	 * Load theme's JavaScript sources.
	 */
	function enqueue_scripts() {

		//$the_theme = wp_get_theme();
		// Get the custom theme data.
		wp_enqueue_style( 'styles', get_stylesheet_directory_uri() . '/css/screen.css', array(), '2.0' );
		wp_enqueue_style( 'webfonts' , 'https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:ital,wght@0,300;0,700;1,300&family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,300;1,400;1,600;1,700;1,800&display=swap', array(), false);

		//wp_enqueue_script( 'jquery-last', get_template_directory_uri() . '/vendor/js/jquery-3.2.1.min.js', array(), '', true);
		wp_enqueue_script( 'jquery-fancybox', get_template_directory_uri() . '/vendor/js/jquery.fancybox.min.js', array(), '', true);
		wp_enqueue_script( 'swiper', get_template_directory_uri() . '/vendor/js/swiper.min.js', array(), '', true);

		wp_enqueue_script( 'theme-scripts', get_template_directory_uri() . '/js/app.min.js', array('jquery', 'jquery-fancybox', 'swiper'), '', true );

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

add_action( 'wp_footer', 'ajax_fetch' );
function ajax_fetch() {
	wp_enqueue_script( 'theme-scripts-ajax', get_template_directory_uri() . '/js/app-ajax.js', array(), '2.0', true );
}

function remove_type_attr($tag, $handle) {
    return preg_replace( "/type=['\"]text\/(javascript|css)['\"]/", '', $tag );
}
