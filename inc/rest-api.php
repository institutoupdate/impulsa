<?php

function impulsa_rest_prepare_tracks($response, $post) {
  $track_related_posts = get_field('track_relationship', $post->ID);
  if($track_related_posts) {
      $reading_time_array = array();
      foreach( $track_related_posts as $related_post ) {
          $reading_time = get_field('reading-time', $related_post["ID"]);
          $reading_time_array[] = $reading_time;
      }
      $reading_time_total = array_sum($reading_time_array);
      $track_related_count = count($track_related_posts);
      $response->data["reading_time"] = $reading_time_total;
      $response->data["materials_count"] = $track_related_count;
      $countries = array();
      $country_terms = get_the_terms($post->ID, "countries");
      if($country_terms) {
        foreach($country_terms as $term) {
          $countries[] = $term->name;
        }
      }
      $response->data["countries"] = $countries;
  }
  return $response;
}

add_filter('rest_prepare_tracks', 'impulsa_rest_prepare_tracks', 10, 3);

function impulsa_rest_pre_get_posts($query) {
  if(defined("REST_REQUEST")) {
    if(isset($_GET["lang"]) && $_GET["lang"]) {
      $query->set("lang", $_GET["lang"]);
    }
  }
}
add_action("pre_get_posts", "impulsa_rest_pre_get_posts");
