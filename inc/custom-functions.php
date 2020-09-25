<?php
// Custom excerpt
function the_excerpt_max_charlength($charlength) {
	$excerpt = get_the_excerpt();
	$charlength++;

	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			echo mb_substr( $subex, 0, $excut );
		} else {
			echo $subex;
		}
		echo '[...]';
	} else {
		echo $excerpt;
	}
}

// Custom previous and next posts link
add_filter('previous_posts_link_attributes', 'previous_posts_link_attributes');
add_filter('next_posts_link_attributes', 'next_posts_link_attributes');

function previous_posts_link_attributes() {
	return 'class="btn-bg btn-bg--sz-sm btn-bg--border-1 pagination__prev"';
}
function next_posts_link_attributes() {
	return 'class="btn-bg btn-bg--sz-sm btn-bg--border-1 pagination__next"';
}

// Get File Size
function get_file_size($size) {
	$units = array('Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB');
	return @round($size / pow(1024, ($i = floor(log($size, 1024))))).$units[$i];
}