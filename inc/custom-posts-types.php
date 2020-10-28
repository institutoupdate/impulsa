<?php
// Register Theme's custom post types.

function register_post_types() {

    // Materials
    register_post_type(
        'materials', array(
            'public' => true,
            'labels' => array(
                'name' => pll__('Materials'),
                'singular_name' => pll__('Material'),
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
                'name' => pll__('Tracks'),
                'singular_name' => pll__('Track'),
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

add_action( 'init', 'register_post_types', 11);
