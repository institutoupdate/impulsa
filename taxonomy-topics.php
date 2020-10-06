<?php
get_header();

// Vars
$term_slug = get_query_var('topics');
$term_description = term_description();
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

        <div class="box box--border box--bg-gray box--pad-3">

            <div class="box__header">
                <h4 class="title-3 title-3--uppercase"><?php echo pll__('Trilhas'); ?></h4>
            </div>
            <!--/box-header-->

            <?php
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
                $latestTracks = new WP_Query($args);
                if($latestTracks->have_posts()) {
            ?>
            <div class="grid grid--3-box">
                <?php 
                while($latestTracks->have_posts()) { $latestTracks->the_post(); 
                    set_query_var( 'article_excerpt', 125);
                    get_template_part('loop-templates/article-track');
                }
                ?>
            </div>
            <!--/grid-->
            <?php }  ?>

        </div>
        <!--/box--> 
    </div>
    <!--/container-->
</section>
<!--/block-->

<?php
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