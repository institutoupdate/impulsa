<?php
/**
 * Alter the main query.
 *
 * @param type $query
 * @return type
 */
function alter_main_query( $query ) {

    if ( $query->is_admin || $query->is_singular() || !$query->is_main_query() )
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

    if ($query->is_home() && $current_country) {

        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        $query->set('post_type',array('post'));
        $query->set('posts_per_page',4);
        $query->set('paged',$paged);

        $tax_query = array();
        $tax_query[] = array(
            'relation' => 'OR',
            array(
                'taxonomy' => 'countries',
                'field' => 'id',
                'terms' => array( $current_country_id ),
                'operator' => 'IN'
            ),
            array(
                'taxonomy' => 'countries',
                'operator' => 'NOT EXISTS'
            )
        );
        $query->set('tax_query', $tax_query);

    }

}
add_action( 'pre_get_posts', 'alter_main_query' );

function materials_pre_get_posts($query) {

  if ($query->is_admin || !$query->is_main_query()) return;

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
      $text = isset($_GET['text']) ? $_GET['text'] : '';

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
      if( $order == "ASC" || $order == "DESC" ) {
          $query->set('order', $order);
      }
      if( $order == "POP" ) {
        $query->set("meta_key", "views_total");
        $query->set("orderby", "meta_value_num");
        $query->set("order", "DESC");
      }

      if($text) {
        $query->set("s", $text);
      }

      // Taxonomies
      $tax_query = array();
      if( $topic || $type ){
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
      }

      if ($current_country)  {
        $tax_query[] = array(
            'relation' => 'OR',
            array(
                'taxonomy' => 'countries',
                'field' => 'id',
                'terms' => array( $current_country_id ),
                'operator' => 'IN'
            ),
            array(
                'taxonomy' => 'countries',
                'operator' => 'NOT EXISTS'
            )
        );
      }

      if($tax_query && !empty($tax_query)) {
        $query->set('tax_query', $tax_query);
      }

  }

}
add_action( 'pre_get_posts', 'materials_pre_get_posts' );
