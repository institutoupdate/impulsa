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
                'post-formats',
                'author',
                'excerpt',
            ),
            'taxonomies' => array('post_tag'),
        )
    );

    // Tracks
    register_post_type(
        'tracks', array(
            'public' => true,
            'labels' => array(
                'name' => __('Tracks', 'theme'),
                'singular_name' => __('Track', 'theme'),
            ),
            'rewrite' => array(
                'slug' => 'tracks'
            ),
            'has_archive' => true,
            'menu_icon' => 'dashicons-excerpt-view',
            'menu_position' => 7,
            'supports' => array(
                'title',
                'thumbnail',
                'editor',
                'author',
                'excerpt',
            ),
            'taxonomies' => array('post_tag'),
        )
    );

    return;

}

add_action( 'init', 'register_post_types' );