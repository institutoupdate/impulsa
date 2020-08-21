<?php
// Register Theme's custom post types.

function register_post_types() {

    // Materiales
    register_post_type(
        'materiales', array(
            'public' => true,
            'labels' => array(
                'name' => __('Materiales', 'theme'),
                'singular_name' => __('Material', 'theme'),
            ),
            'rewrite' => array(
                'slug' => 'materiales'
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

    // Senderos
    register_post_type(
        'senderos', array(
            'public' => true,
            'labels' => array(
                'name' => __('Senderos', 'theme'),
                'singular_name' => __('Sendero', 'theme'),
            ),
            'rewrite' => array(
                'slug' => 'senderos'
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