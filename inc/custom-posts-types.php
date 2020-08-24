<?php
// Register Theme's custom post types.

function register_post_types() {

    // Materials
    register_post_type(
        'materials', array(
            'public' => true,
            'labels' => array(
                'name' => __('Materials', 'theme'),
                'singular_name' => __('Material', 'theme'),
            ),
            'rewrite' => array(
                'slug' => 'materials'
            ),
            'has_archive' => true,
            'menu_icon' => 'dashicons-playlist-video',
            'menu_position' => 6,
            'supports' => array(
                'title',
                'thumbnail',
                'editor',
                'post-formats'
            ),
            'taxonomies' => array('post_tag'),
        )
    );

    // Trails
    register_post_type(
        'trails', array(
            'public' => true,
            'labels' => array(
                'name' => __('Trails', 'theme'),
                'singular_name' => __('Trail', 'theme'),
            ),
            'rewrite' => array(
                'slug' => 'trails'
            ),
            'has_archive' => true,
            'menu_icon' => 'dashicons-excerpt-view',
            'menu_position' => 7,
            'supports' => array(
                'title',
                'thumbnail',
                'editor',
            ),
        )
    );

    return;

}

add_action( 'init', 'register_post_types' );