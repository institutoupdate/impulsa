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
			'main-nav' => 'Main Menu',
			'alt-nav' => 'Alt Menu',
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

//Support SVG
function cc_mime_types($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

// Strings translations
add_action('init', function() {

	// General
	pll_register_string('Track', 'Trilha', 'General');
	pll_register_string('See more', 'Ver mais', 'General');

    // Newsletter
    pll_register_string('Newsletter title', 'Fique por dentro!', 'Newsletter');
    pll_register_string('Newsletter subtitle', 'Receba as novidades da Im.pulsa no seu e-mail', 'Newsletter');
	pll_register_string('Name', 'Nome', 'Newsletter');
	pll_register_string('E-mail', 'E-mail', 'Newsletter');
	pll_register_string('Submit', 'Cadastrar', 'Newsletter');

	// Footer
	pll_register_string('Copyright', 'Todo o conteúdo desta Plataforma está disponível em Creative Commons By-SA 4.0', 'Footer');
	pll_register_string('About Impulsa', 'Sobre Im.pulsa', 'Footer');
	pll_register_string('Impulsa in the media', 'Im.pulsa na media', 'Footer');
	pll_register_string('Social Networks', 'Redes', 'Footer');
	pll_register_string('Impulsa project', 'Im.pulsa é um projeto das', 'Footer');

	// Search
	pll_register_string('Placeholder', 'Procura algo? Tente “redes sociais” ou “voluntariado”', 'Search');

	// Library
	pll_register_string('Title', 'Biblioteca', 'Library');
	pll_register_string('Filters', 'Filtros', 'Library');

	// Contact
	pll_register_string('Title', 'Algo para nos contar?', 'Contact');
	pll_register_string('Success', 'A mensagem foi enviada com êxito. Iremos responder prontamente', 'Contact');
	pll_register_string('Error', 'Ocorreu um erro ao enviar o formulário. Por favor, tente novamente.', 'Contact');
	pll_register_string('Name', 'Nome', 'Contact');
	pll_register_string('E-mail', 'E-mail', 'Contact');
	pll_register_string('Message', 'Mensagem', 'Contact');
	pll_register_string('Submit', 'Enviar mensagem', 'Contact');

	// FAQ
	pll_register_string('Contact section', 'Dúvidas? Você pode nos escrever em nossa seção de contato', 'FAQ');

});