<?php

// Get Youtube thumbnail
function thumb_video_youtube( $src ){
    $data = array();
    if (strpos($src, 'youtube') > 0) {
        $matches = array();
    	preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $src, $matches);
        $data = 'https://img.youtube.com/vi/'.$matches[1].'/maxresdefault.jpg';
    } elseif (strpos($src, 'vimeo') > 0) {
        $src = strtok($src, '?'); //Delete GET variables
        $id = substr($src, strrpos($src, '/') + 1); //Get from last slash
        $hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$id.php"));
        $data = $hash;
    }
    return $data;
}

// Get User IP
function getUserIP() {
	if( array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER) && !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ) {
		if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',')>0) {
			$addr = explode(",",$_SERVER['HTTP_X_FORWARDED_FOR']);
			return trim($addr[0]);
		} else {
			return $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
	}
	else {
		return $_SERVER['REMOTE_ADDR'];
	}
}

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

// Get page url by template name
function get_page_url($template_name) {
	$pages = get_posts([
        'post_type' => 'page',
        'post_status' => 'publish',
        'meta_query' => [
            [
                'key' => '_wp_page_template',
                'value' => $template_name.'.php',
                'compare' => '='
            ]
        ]
    ]);
    if(!empty($pages)) {
      	foreach($pages as $pages__value) {
          	return get_permalink($pages__value->ID);
      	}
    }
    return get_bloginfo('url');
}