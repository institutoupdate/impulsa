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

    $current_country = isset($_COOKIE['current_country']) ? $_COOKIE['current_country'] : '';

    $countries = get_terms([
        'taxonomy' => 'countries',
        'hide_empty' => false,
    ]);
    
    if($countries) {
        foreach ($countries as $country) { 
            $country_code = get_field('country_code', 'term_' . $country->term_id);
            if($country_code === $current_country) {
                $current_country_slug = $country->slug;
                $current_country_id = $country->term_id;
            }
        }
    }

    if ($query->is_post_type_archive('materials')) {
        
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        $query->set('post_type',array('materials'));
        $query->set('posts_per_page',10);
        $query->set('paged',$paged);

        $order = isset($_GET['order']) ? $_GET['order'] : '';
        $topic = isset($_GET['topic']) ? $_GET['topic'] : '';
        $type = isset($_GET['type']) ? $_GET['type'] : '';
        
        $count = 0;
        $tax_arr = array($topic, $type);
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
        if( $topic || $type ){
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

            $query->set('tax_query', $tax_query);
        }

        if ($current_country)  {

            // Get all terms in the taxonomy and exclude current country ID
            $countries = get_terms([
                'taxonomy'   => 'countries',
                'hide_empty' => false,
                'exclude'    => $current_country_id,
            ]);

            // Convert array of term objects to array of term slugs
            $countries_slugs = wp_list_pluck( $countries, 'slug' );

            $tax_query = array();
            $tax_query[] = array(
                'taxonomy' => 'countries',
                'field' => 'slug',
                'terms' => $countries_slugs,
                'operator' => 'NOT IN'
            );
            $query->set('tax_query', $tax_query);
        }

    }

    if ($query->is_home() && $current_country) {
        
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        $query->set('post_type',array('post'));
        $query->set('posts_per_page',4);
        $query->set('paged',$paged);

        // Get all terms in the taxonomy and exclude current country ID
        $countries = get_terms([
            'taxonomy'   => 'countries',
            'hide_empty' => false,
            'exclude'    => $current_country_id,
        ]);

        // Convert array of term objects to array of term slugs
        $countries_slugs = wp_list_pluck( $countries, 'slug' );

        $tax_query = array();
        $tax_query[] = array(
            'taxonomy' => 'countries',
            'field' => 'slug',
            'terms' => $countries_slugs,
            'operator' => 'NOT IN'
        );
        $query->set('tax_query', $tax_query);

    }

    // echo '<pre>'; print_r($query); echo '</pre>';
    // die();

}
add_action( 'pre_get_posts', 'alter_main_query' );