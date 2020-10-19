<?php
get_header();

// Vars
$term_slug = get_query_var('topics');
$term_description = term_description();

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

?>
<section class="block block--pad-4 js-first-block">
    <div class="container">
        
        <ul class="breadcrum">
            <li><a href="<?php echo get_post_type_archive_link('tracks'); ?>"><?php echo pll__('Trilhas'); ?></a><i class="icon-angle-right-solid"></i></li>
            <li><?php single_term_title(); ?></li>
        </ul>
        <div class="block__header">
            <h2 class="title-bg title-bg--bg-3 title-bg--m-bottom-xsm"><span class="title-3 title-3--lg title-3--uppercase"><?php single_term_title(); ?></span></h2>
            <?php if(term_description()) { ?>
            <p class="block__headline"><?php echo $term_description; ?></p>
            <?php } ?>
        </div>
        <!--/block-header-->

        <?php
            if ($current_country)  {

                // Get all terms in the taxonomy and exclude current country ID
                $countries = get_terms([
                    'taxonomy'   => 'countries',
                    'hide_empty' => false,
                    'exclude'    => $current_country_id,
                ]);
    
                // Convert array of term objects to array of term slugs
                $countries_slugs = wp_list_pluck( $countries, 'slug' );

                $args = array(
                    'post_type' => array( 'tracks' ),
                    'order' => 'DESC',
                    'posts_per_page' => -1,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'topics',
                            'terms' => $term_slug,
                            'field' => 'slug',
                        ),
                        array(
                            'taxonomy' => 'countries',
                            'field' => 'slug',
                            'terms' => $countries_slugs,
                            'operator' => 'NOT IN'
                        )
                    ),
                );
            } else {
                $args = array(
                    'post_type' => array( 'tracks' ),
                    'order' => 'DESC',
                    'posts_per_page' => -1,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'topics',
                            'terms' => $term_slug,
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
                <h4 class="title-3 title-3--uppercase"><?php echo pll__('Trilhas'); ?></h4>
            </div>
            <!--/box-header-->

            <div class="grid grid--3-box">
                <?php 
                while($latestTracks->have_posts()) { $latestTracks->the_post(); 
                    set_query_var( 'article_excerpt', 125);
                    get_template_part('loop-templates/article-track');
                }
                ?>
            </div>
            <!--/grid-->
        </div>
        <!--/box--> 
        <?php }  ?>

    </div>
    <!--/container-->
</section>
<!--/block-->

<?php
    if ($current_country)  {
        $args = array(
            'post_type' => array( 'materials' ),
            'order' => 'DESC',
            'posts_per_page' => 3,
            'tax_query' => array(
                array(
                    'taxonomy' => 'topics',
                    'terms' => $term_slug,
                    'field' => 'slug',
                ),
                array(
                    'taxonomy' => 'countries',
                    'field' => 'slug',
                    'terms' => $countries_slugs,
                    'operator' => 'NOT IN'
                )
            ),
        );
    } else {
        $args = array(
            'post_type' => array( 'materials' ),
            'order' => 'DESC',
            'posts_per_page' => 3,
            'tax_query' => array(
                array(
                    'taxonomy' => 'topics',
                    'terms' => $term_slug,
                    'field' => 'slug',
                )
            ),
        );
    }
    $latestMaterials = new WP_Query($args);
    if($latestMaterials->have_posts()) {
?>
<section class="block block--p-bottom-lg">
    <div class="container">
        <div class="grid grid--12">
            <div class="col-8 col-8--center">

                <h4 class="title-3 title-3--uppercase title-3--m-bottom"><?php echo pll__('Materiais mais recentes'); ?></h4>
                <div class="grid grid--1-box grid--m-bottom-lg">
                    <?php 
                    while($latestMaterials->have_posts()) { $latestMaterials->the_post(); 
                        set_query_var( 'article_excerpt', 335);
                        get_template_part('loop-templates/article-material');
                    }
                    ?>
                </div>
                <!--/grid-1-box-->

                <div class="pagination-flex">
                    <a href="<?php echo get_post_type_archive_link('materials').'?topic[]='.$term_slug; ?>" class="btn-bg btn-bg--sz-sm btn-bg--border-1 pagination__next"><?php echo pll__('Ver mais matérias de'); ?> <?php single_term_title(); ?></a>
                </div>
                <!--/pagination-flex-->

            </div>
            <!--/col-8-center-->
        </div>
        <!--/grid-12-->
    </div>
    <!--/container-->
</section>
<!--/block-->
<?php } ?>

<?php 
get_footer();
?>