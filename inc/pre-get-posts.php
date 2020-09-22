<?php
/**
 * Alter the main query.
 *
 * @param type $query
 * @return type
 */
function alter_main_query( $query ) {
    if ( $query->is_admin || $query->is_single || !$query->is_main_query() )
        return $query;

    if ($query->is_post_type_archive('materials')) {
        
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        $query->set('post_type',array('materials'));
        $query->set('posts_per_page',10);
        $query->set('paged',$paged);

        // Order
        if( isset( $_GET['order'] ) ) {
            $query->set('order', $_GET['order']);
        }

        // Search
        if( isset( $_GET['s'] ) ) {
            $query->set('s', $_GET['s']);
        }

        // Taxonomies
        if( isset( $_GET['topic'] ) || isset( $_GET['type'] ) || isset( $_GET['country'] )){

            $tax_query = array();

            if( !empty($_GET['topic']) ){
                $tax_query[] = array(
                    'taxonomy' => 'topics',
                    'field' => 'slug',
                    'terms' => $_GET['topic']
                );
            }
            $query->set('tax_query', $tax_query);

            if( !empty($_GET['type']) ){
                $tax_query[] = array(
                    'taxonomy' => 'types',
                    'field' => 'slug',
                    'terms' => $_GET['type']
                );
            }
            $query->set('tax_query', $tax_query);

            if( !empty($_GET['country']) ){
                $tax_query[] = array(
                    'taxonomy' => 'countries',
                    'field' => 'slug',
                    'terms' => $_GET['country']
                );
            }
            $query->set('tax_query', $tax_query);

        }
    //$taxquery = array(array('taxonomy' => 'post_tags'));
    }

    //echo '<pre>'; print_r($query);
    //die();

}
add_action( 'pre_get_posts', 'alter_main_query' );