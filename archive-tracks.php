<?php
get_header();
$featured_topcis = get_field('featured-topics', 'options');
if( $featured_topcis ):
?>
<section class="block block--pad-2 js-first-block">
    <div class="container">

        <form action="#" method="POST" class="search search--m-bottom">
            <input type="text" class="search__input" placeholder="Procura algo? Tente “redes sociais” ou “voluntariado”">
            <button class="search__btn" type="submit"><i class="icon-search"></i></button>
        </form>
        <!--/search-->

        <div class="block__header">
            <h2 class="title-2">Trilhas</h2>
            <p class="block__headline">As trilhas são percursos para te ajudar a lerem iosum. Navegue pelos temas.</p>
        </div>
        <!--/block-header-->

        <div class="grid grid--1-box">

            <?php foreach( $featured_topcis as $topic ): ?>
            <div class="box box--border box--bg-gray box--pad-3">

                <div class="box__header">
                    <h4 class="title-3 title-3--uppercase"><?php echo esc_html( $topic->name ); ?></h4>
                    <a href="<?php echo esc_url( get_term_link( $topic ) ); ?>" class="btn btn--c-gray">Ver más <i class="icon-arrow-right"></i></a>
                </div>
                <!-- box-header-->
                
                <?php
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
                <!--/grid-3-box-->
                <?php } ?>

            </div>
            <!--/box--> 
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