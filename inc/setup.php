<?php
/**
 * Theme basic setup.
 *
 * @package theme
 */


// Set the content width based on the theme's design and stylesheet.
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'theme_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function theme_setup() {

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'main-nav' => 'Menú header',
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		/*
		 * Adding Thumbnail basic support
		 */
		add_theme_support( 'post-thumbnails' );

		/**
		 * Thumb sizes used in the theme.
		 *
		 * @var array
		 */
		static $thumb_sizes = array(
			//'500x300' => array( 500, 300, true ),
		);
		foreach ( $thumb_sizes as $name => $size ) {
			add_image_size( $name, $size[0], $size[1], $size[2] );
		}

		/*
		 * Adding support for Widget edit icons in customizer
		 */
		// add_theme_support( 'customize-selective-refresh-widgets' );

		/*
		 * Enable support for Post Formats.
		 * See http://codex.wordpress.org/Post_Formats
		*/
		add_theme_support( 'post-formats', array(
			'aside',
			'link',
		));

		function rename_post_formats($translation, $text, $context, $domain) {
			$names = array(
				'Aside' => 'PDF',
			);
			if ($context == 'Post format') {
				$translation = str_replace(array_keys($names), array_values($names), $text);
			}
			return $translation;
		}
		add_filter('gettext_with_context', 'rename_post_formats', 10, 4);

		// Add excerpt in pages
		add_post_type_support( 'page', 'excerpt' );
		
		// remove wp version
		remove_action( 'wp_head', 'wp_generator' );
		

	}
endif; // theme_setup.
add_action( 'after_setup_theme', 'theme_setup' );


// old editor wordpress
add_filter('use_block_editor_for_post', '__return_false');

// remove top bar
add_filter( 'show_admin_bar', '__return_false' );

// Disable XML-RPC Pingback
// Stops abuse of your site's XML-RPC by simply removing some methods used by attackers. While you can use the rest of XML-RPC methods.
add_filter( 'xmlrpc_methods', 'sar_block_xmlrpc_attacks' );

function sar_block_xmlrpc_attacks( $methods ) {
   unset( $methods['pingback.ping'] );
   unset( $methods['pingback.extensions.getPingbacks'] );
   return $methods;
}

add_filter( 'wp_headers', 'sar_remove_x_pingback_header' );

function sar_remove_x_pingback_header( $headers ) {
   unset( $headers['X-Pingback'] );
   return $headers;
}

// Every error message are the same
function login_errors_message() {
	return 'Datos de acceso incorrectos';
}
add_filter('login_errors', 'login_errors_message');

// remove wp_head title
remove_action( 'wp_head', '_wp_render_title_tag', 1 );

// remove accents filenames
add_filter('sanitize_file_name', 'sa_sanitize_spanish_chars', 10);
function sa_sanitize_spanish_chars ($filename) {
  return remove_accents( $filename );
}