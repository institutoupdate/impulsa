<?php 
//if (have_posts()) : while (have_posts()) : the_post(); 

// Track ID
$track_id = get_the_ID();

// Material/Post ID
$track_posts = get_field('track_relationship');
if($track_posts) {
    // First ID
    $track_post_id = $track_posts['0']->ID;
    
    // Redirect to material/post
    wp_redirect( get_home_url().'/?p='.$track_post_id.'&track='.$track_id );
    exit;
} else {
    // Redirect home
    wp_redirect( get_home_url() );
    exit;
}
?>
