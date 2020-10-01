<?php

function sc_twitter($atts) {
     $sc_return = '<div class="card card_twitter"><div class="card_content">';
     $sc_return .= '<blockquote class="twitter-tweet" lang="es"><a href="'.$atts['url'].'"></a></blockquote>';
     $sc_return .= '</div></div>';

     return $sc_return;
}
add_shortcode('twitter', 'sc_twitter');

function sc_facebook($atts) {
     $sc_return = '<div class="card card_facebook"><div class="card_content">';
     $sc_return .= '<div id="fb-root"></div><div class="fb-post" data-href="';
     $sc_return .= $atts['url'];
     $sc_return .= '" data-width="500px"><div class="fb-xfbml-parse-ignore"></div>';
     $sc_return .= '</div></div></div>';

     return $sc_return;
}
add_shortcode('facebook', 'sc_facebook');

function sc_youtube($atts) {
     $video_code = explode('?v=', $atts['url']);

          $sc_return = '<div class="card card_youtube"><div class="card_content">';
          $sc_return .= '<div class="youtube-embed-container"><iframe width="100%" src="//www.youtube.com/embed/';
          $sc_return .= $video_code[1];
               if(isset($atts['start'])) { $start = '&start='.$atts['start']; }
               if(isset($atts['end'])) { $end = '&end='.$atts['end']; }
               if(isset($atts['autoplay'])) { $autoplay = '&autoplay=1'; }
               $variables = $start.$end.$autoplay;
          $sc_return .= '?'.substr($variables, 1);
          $sc_return .= '" frameborder="0" allowfullscreen></iframe></div>';
          $sc_return .= '</div></div>';

     return $sc_return;
}
add_shortcode('youtube', 'sc_youtube');

function sc_vine($atts) {
     $video_code = explode('/v/', $atts['url']);
     $sc_return = '<div class="card card_vine"><div class="card_content">';
     $sc_return .= '<div class="vine-embed-container"><iframe class="vine-embed" src="https://vine.co/v/'.$video_code[1].'/embed/simple?related=0" frameborder="0" scrolling="no" allowtransparency="true"></iframe></div>';
     $sc_return .= '</div></div>';

     return $sc_return;
}
add_shortcode('vine', 'sc_vine');

function sc_vimeo($atts) {
     $video_code = explode('.com/', $atts['url']);
     $sc_return = '<div class="card card_vimeo"><div class="card_content ">';
     $sc_return .= '<div class="vimeo-embed-container"><iframe src="https://player.vimeo.com/video/'.$video_code[1].'" width="100%" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>';
     $sc_return .= '</div></div>';

     return $sc_return;
}
add_shortcode('vimeo', 'sc_vimeo');

function sc_instagram($atts) {
     $sc_return = '<div class="card card_instagram"><div class="card_content">';
     //$sc_return .= '<img src="'.$atts['url'].'media/?size=l" width="100%" alt="" />';
     $sc_return .= '<div class="instagram-embed-container"><iframe src="'.rtrim($atts['url'], '/').'/embed" scrolling="no" allowtransparency="true"></iframe></div>';
     $sc_return .= '</div></div>';

     return $sc_return;
}
add_shortcode('instagram', 'sc_instagram');

function sc_soundcloud($atts) {
     $sc_return = '<div class="card card_soundcloud"><div class="card_content">';
     $sc_return .= '<iframe width="100%" height="130" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url='.$atts['url'].'&amp;auto_play=false&amp;hide_related=false&amp;show_comments=false&amp;show_user=true&amp;show_reposts=false&amp;visual=false"></iframe>';
     $sc_return .= '</div></div>';

     return $sc_return;
}
add_shortcode('soundcloud', 'sc_soundcloud');

function sc_pinterest($atts) {
     $sc_return = '<div class="card card_pinterest"><div class="card_content">';
     $sc_return .= '<a data-pin-do="embedPin" href="'.$atts['url'].'"></a>';
     $sc_return .= '</div></div>';

     return $sc_return;
}
add_shortcode('pinterest', 'sc_pinterest');

function sc_giphy($atts) {
     if(strpos($atts['url'], '-') !== false) {
          $gif_code = strrev($atts['url']);
          $gif_code = explode('-', $gif_code);
          $gif_code = strrev($gif_code[0]);
     } else {
          $gif_code = explode('/gifs/', $atts['url']);
          $gif_code = $gif_code[1];
     }
     $sc_return = '<div class="card card_giphy"><div class="card_content">';
     $sc_return .= '<div class="giphy-embed-container"><iframe src="//giphy.com/embed/'.$gif_code.'?html5=true" width="480" frameborder="0" class="giphy-embed" allowfullscreen=""></iframe></div>';
     $sc_return .= '</div></div>';

     return $sc_return;
}
add_shortcode('giphy', 'sc_giphy');

function impulsa_shortcode_quote($atts = array(), $content = null) {
  ob_start();
  ?>
  <div class="impulsa-quote">
    <blockquote>
      <?php echo $content; ?>
    </blockquote>
  </div>
  <?php
  return ob_get_clean();
}
add_shortcode('quote', 'impulsa_shortcode_quote');

function impulsa_shortcode_content_snippet($atts = array()) {
  if(!$atts['id'])
    return '';
  $p = get_post($atts['id']);
  if(!$p)
    return '';
  global $post;
  $post = $p;
  setup_postdata($post);
  ob_start();
  ?>
    <div class="impulsa-content-snippet">
      <div class="snippet-icon">
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
          <img src="<?php echo get_template_directory_uri(); ?>/images/svg/snippet-icon.svg" />
        </a>
      </div>
      <div class="snippet-content">
        <h4>
          <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
        </h4>
        <?php the_excerpt(); ?>
      </div>
    </div>
  <?php
  wp_reset_postdata();
  return ob_get_clean();

}
add_shortcode('content_snippet', 'impulsa_shortcode_content_snippet');

?>
