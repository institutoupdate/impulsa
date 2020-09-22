<?php
$tracks_title = get_field('tracks-home-title');
$featured_tracks = get_field('tracks-home');
if( $featured_tracks ):
?>
<section class="block block--pad">
    <div class="container">
        <?php if($tracks_title) { ?>
            <h3 class="title title--md title--m-bottom-md"><?php echo $tracks_title; ?></h3>
        <?php } ?>

        <div class="grid grid--article">
            <?php foreach( $featured_tracks as $post ): 
                setup_postdata($post); 
            ?>
            <div class="box box--radius box--stackable box--stackable-c-1 box--bg-white box--pad">
                <article class="article article--c-1">

                    <div class="article__header">
                        <ul class="article__tag-list">
                            <li><span class="article__tag article__tag--bg-1">Trilha</span></li>
                            <li><span class="article__tag article__tag--bg-3">Comunicacao</span></li>
                        </ul>
                        <span class="article__header__text">2 materais, 9 minutos</span>
                    </div>
                    <!--/article-header-->

                    <div class="article__content">
                        <h5 class="article__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                        <p class="article__excerpt"><?php echo the_excerpt_max_charlength(123); ?></p>
                    </div>
                    <!--/articl-content-->

                    <div class="article__footer">
                        <a href="<?php the_permalink(); ?>" class="btn">Ver mais sobre comunicaçao <i class="icon-arrow-right"></i></a>
                    </div>
                    <!--/article-footer-->

                </article>
                <!--/article-->
            </div>
            <!--/box-->
            <?php endforeach; ?>
        </div>
        <!--/grid--article-->
        
    </div>
    <!--/container-->
</section>
<!--/block-->
<?php wp_reset_postdata(); endif; ?>