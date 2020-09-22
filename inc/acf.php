<?php 
//ACF options subpages

if( function_exists('acf_add_options_page') ) {

    acf_add_options_page();

    acf_add_options_sub_page(array(
        'title' => 'Options',
        'capability' => 'edit_pages'
    ));

    acf_add_options_page(array(
        'page_title' 	=> 'Generic content',
        'menu_title'	=> 'Generic content',
        'menu_slug' 	=> 'generic-content',
        'capability'	=> 'edit_pages',
        'redirect'		=> true
    ));

   /* acf_add_options_sub_page(array(
        'page_title' 	=> 'General',
        'menu_title'	=> 'General',
        'parent_slug'	=> 'contenido',
        'capability' 	=> 'edit_pages',
    ));*/

}

//Change the Options Page capability to 'manage_options'
if( function_exists('acf_set_options_page_capability') ) {
    acf_set_options_page_capability( 'edit_pages' );
}