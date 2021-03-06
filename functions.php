<?php

// Polylang fallback functions.
require get_template_directory() . '/inc/pll-failsafe.php';

// Theme setup and custom theme supports.
require get_template_directory() . '/inc/setup.php';

// Enqueue scripts and styles.
require get_template_directory() . '/inc/enqueue.php';

// ACF
require get_template_directory() . '/inc/acf.php';

// Load Editor functions.
require get_template_directory() . '/inc/editor.php';

// Pre Get Posts
require get_template_directory() . '/inc/pre-get-posts.php';

// Country redirects
require get_template_directory() . '/inc/country-redirects.php';

// Custom Posts Types
require get_template_directory() . '/inc/custom-posts-types.php';

// Custom Taxonomies
require get_template_directory() . '/inc/custom-taxonomies.php';

// AJAX
require get_template_directory() . '/inc/ajax.php';

// Shortcodes
require get_template_directory() . '/inc/shortcodes.php';

// WP Popular Posts
require get_template_directory() . '/inc/popular-posts.php';

// Custom functions
require get_template_directory() . '/inc/custom-functions.php';

// REST API
require get_template_directory() . '/inc/rest-api.php';
