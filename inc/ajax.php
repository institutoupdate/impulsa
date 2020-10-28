<?php


// the ajax function
add_action('wp_ajax_data_fetch' , 'data_fetch');
add_action('wp_ajax_nopriv_data_fetch','data_fetch');

function data_fetch(){

    $args = array(
        'post_status' => 'publish',
        'post_type' => array('post', 'materials', 'tracks'),
        'posts_per_page' => -1,
        's' => esc_attr( $_POST['s'] )
    );
    $the_query = new WP_Query($args);

    if( $the_query->have_posts() ) :

        while( $the_query->have_posts() ): $the_query->the_post();
            $post_type = get_post_type(get_the_ID());
            ?>

            <a href="<?php the_permalink(); ?>" class="search__item article article--sz-sm">
                <p class="article__title"><?php the_title(); ?></p>
                <?php if($post_type === 'post') { ?>
                <span class="article__tag article__tag--bg-3"><?php echo pll__('Blog'); ?></span>
                <?php } elseif($post_type == 'materials') { ?>
                <span class="article__tag article__tag--bg-2"><?php echo pll__('Material'); ?></span>
                <?php } else { ?>
                <span class="article__tag article__tag--bg-1"><?php echo pll__('Trilha'); ?></span>
                <?php } ?>
            </a>

        <?php endwhile;
        wp_reset_postdata();

        else :

        echo '<div class="search__container"><p>' . pll__('Não foram encontrados resultados. Tente outra busca.') . '</p></div>';

    endif;

    die();
}

function impulsa_get_user_votes() {
  $user_votes = array();
  $cookie = $_COOKIE['user_votes'];
  if($cookie) {
    $user_votes = json_decode(stripslashes($cookie), true);
  }
  return $user_votes;
}

function impulsa_vote($post_id, $vote) {
  header('Content-Type: application/json; charset=utf-8');
  if($vote == 'up') {
    $unvote = 'down';
  } elseif($vote == 'down') {
    $unvote = 'up';
  }
  $user_votes = impulsa_get_user_votes();
  $removed = false;

  $vote_count = intval(get_post_meta($post_id, 'impulsa_votes_' . $vote, true));

  // Unvote
  if($user_votes[$post_id] == $vote) {
    $user_votes[$post_id] = false;
    setcookie('user_votes', json_encode($user_votes, JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT), time() + (30*24*60*60), COOKIEPATH, COOKIE_DOMAIN);
    $vote_count = max(0, $vote_count - 1);
    update_post_meta($post_id, 'impulsa_votes_' . $vote, $vote_count);
    $removed = true;

  // Vote
  } else {

    // Clear opposite vote if exists
    if($user_votes[$post_id] == $unvote) {
      $unvote_count = intval(get_post_meta($post_id, 'impulsa_votes_' . $unvote, true));
      $unvote_count = max(0, $unvote_count - 1);
      update_post_meta($post_id, 'impulsa_votes_' . $unvote, $unvote_count);
    }

    $user_votes[$post_id] = $vote;
    setcookie('user_votes', json_encode($user_votes, JSON_HEX_QUOT | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT), time() + (30*24*60*60), COOKIEPATH, COOKIE_DOMAIN);
    $vote_count = $vote_count + 1;
    update_post_meta($post_id, 'impulsa_votes_' . $vote, $vote_count);
  }
  $result = array(
    "user_votes" => $user_votes,
    "vote" => $vote,
    "removed" => $removed
  );
  if(current_user_can("edit_pages")) {
    $result["total"] = $vote_count;
  }
  echo json_encode($result);
  die();
}

add_action('wp_ajax_post_upvote', 'impulsa_post_upvote');
add_action('wp_ajax_nopriv_post_upvote', 'impulsa_post_upvote');
function impulsa_post_upvote() {
  impulsa_vote($_POST['post_id'], 'up');
}

add_action('wp_ajax_post_downvote', 'impulsa_post_downvote');
add_action('wp_ajax_nopriv_post_downvote', 'impulsa_post_downvote');
function impulsa_post_downvote() {
  impulsa_vote($_POST['post_id'], 'down');
}
