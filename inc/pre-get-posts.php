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

    //echo '<pre>'; print_r($query);
    //die();

}
add_action( 'pre_get_posts', 'alter_main_query' );