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

    foreach (['es', 'pt'] as $lang) {
        $title_menu = '';
        if($lang == 'es') {
            $title_menu = 'Spanish';
        } else {
            $title_menu = 'Portuguese';
        }
        acf_add_options_sub_page([
            'page_title' => $title_menu,
            'menu_title' => $title_menu,
            'menu_slug' => "page-name-${lang}",
            'post_id' => $lang,
            'parent' => 'generic-content'
        ]);
    }

}

//Change the Options Page capability to 'manage_options'
if( function_exists('acf_set_options_page_capability') ) {
    acf_set_options_page_capability( 'edit_pages' );
}