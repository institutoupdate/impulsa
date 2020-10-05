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

        $order = isset($_GET['order']) ? $_GET['order'] : '';
        $topic = isset($_GET['topic']) ? $_GET['topic'] : '';
        $type = isset($_GET['type']) ? $_GET['type'] : '';
        $country = isset($_GET['country']) ? $_GET['country'] : '';
        
        $count = 0;
        $tax_arr = array($topic, $type, $country);
        foreach( $tax_arr as $tax ){
            if(!empty($tax)){
                $count++;
            }
        }
        if( $count > 1 ){
            $tax_query['relation'] = 'AND';
        }

        // Order
        if( $order ) {
            $query->set('order', $order);
        }
        
        // Taxonomies
        if( $topic || $type || $country ){
            $tax_query = array();

            // Topic
            if( $topic ) {
                $tax_query[] = array(
                    'taxonomy' => 'topics',
                    'field' => 'slug',
                    'terms' => $topic
                );
            }

            // Type
            if( $type ) {
                $tax_query[] = array(
                    'taxonomy' => 'types',
                    'field' => 'slug',
                    'terms' => $type
                );
            }

            // Country
            if( $country ) {
                $tax_query[] = array(
                    'taxonomy' => 'countries',
                    'field' => 'slug',
                    'terms' => $country
                );
            }

            $query->set('tax_query', $tax_query);


        }
    }

    // Change country query
    /*if (isset($_COOKIE['geo_country']) && $_COOKIE['geo_country'] !== 'null' )  {

        $query->set('post_type', array('materials', 'posts'));

        $tax_query = array();
        $tax_query[] = array(
            'taxonomy' => 'countries',
            'field' => 'slug',
            'terms' => $_COOKIE['geo_country']
        );
        $query->set('tax_query', $tax_query);
        
    }*/

    // echo '<pre>'; print_r($query); echo '</pre>';
    // die();

}
add_action( 'pre_get_posts', 'alter_main_query' );