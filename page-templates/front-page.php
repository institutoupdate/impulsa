<?php
// Template name: Home

get_header();

if (have_posts()) : while (have_posts()) : the_post();

    global $wp_query;
    // echo '<pre>' . var_export($wp_query, true) . '</pre>';

    // Hero
    require get_template_directory() . '/global-templates/home/hero.php';

    // Slider
    require get_template_directory() . '/global-templates/home/slider.php';

    // Tracks
    require get_template_directory() . '/global-templates/home/tracks.php';

    // Items
    require get_template_directory() . '/global-templates/home/items.php';

endwhile; endif;

get_footer();
?>
