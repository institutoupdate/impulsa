<?php
// Callback function for WP's <b>template_redirect</b> action hook.

function template_redirect() {
    global $post;

    //redirect author page temporary
    if( is_author() ) {
        wp_redirect( site_url('/') );
        exit;
    }  

}
add_action( 'template_redirect', 'template_redirect' );
