<?php
get_header();
$current_lng = pll_current_language('slug');
$featured_topcis = get_field('featured-topics', $current_lng);
$tracks_title = get_field('tracks-title', $current_lng);
$tracks_headline = get_field('tracks-headline', $current_lng);

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

if( $featured_topcis ):
?>
<section class="block block--pad-2 js-first-block">
    <div class="container">

        <?php
        // Search
        set_query_var( 'search_classes', 'search--m-bottom');
        get_template_part('global-templates/search');
        ?>

        <div class="block__header">
            <?php if($tracks_title) { ?>
            <h2 class="title-2"><?php echo $tracks_title; ?></h2>
            <?php } ?>
            <?php if($tracks_headline) { ?>
            <p class="block__headline"><?php echo $tracks_headline; ?></p>
            <?php } ?>
        </div>
        <!--/block-header-->

        <div class="grid grid--1-box">

            <?php foreach( $featured_topcis as $topic ): ?>

                <?php
                    if ($current_country)  {

                        $args = array(
                            'post_type' => array( 'tracks' ),
                            'order' => 'DESC',
                            'posts_per_page' => 3,
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'topics',
                                    'terms' => $topic->slug,
                                    'field' => 'slug',
                                ),
                                array(
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
                                )
                            ),
                        );
                    } else {
                        $args = array(
                            'post_type' => array( 'tracks' ),
                            'order' => 'DESC',
                            'posts_per_page' => 3,
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'topics',
                                    'terms' => $topic->slug,
                                    'field' => 'slug',
                                )
                            ),
                        );
                    }

                    $latestTracks = new WP_Query($args);
                    if($latestTracks->have_posts()) {
                ?>
                <div class="box box--border box--bg-gray box--pad-3">

                <div class="box__header">
                    <h4 class="title-3 title-3--uppercase"><a href="<?php echo esc_url( get_term_link( $topic ) ); ?>"><?php echo esc_html( $topic->name ); ?></a></h4>
                    <p class="box__header_fill">
                      <?php printf( _n("%d trilha nesta categoria", "%d trilhas nesta categoria", $latestTracks->found_posts, "impulsa"), $latestTracks->found_posts); ?>
                    </p>
                </div>
                <!-- box-header-->
                <div class="grid grid--3-box">
                    <?php
                    while($latestTracks->have_posts()) { $latestTracks->the_post();
                        set_query_var( 'article_excerpt', 125);
                        get_template_part('loop-templates/article-track');
                    }
                    ?>
                </div>
                <!--/grid-3-box-->
                </div>
                <!--/box-->
              <?php } ?>

            <?php endforeach; ?>

        </div>
        <!--/grid-1-box-->

    </div>
    <!--/container-->
</section>
<!--/block-->

<?php
endif;
get_footer();
?>
