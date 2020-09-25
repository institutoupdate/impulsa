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
                set_query_var( 'article_footer', true);
                set_query_var( 'article_excerpt', 125);
                get_template_part('loop-templates/article-track');
            endforeach; ?>
        </div>
        <!--/grid--article-->
        
    </div>
    <!--/container-->
</section>
<!--/block-->
<?php wp_reset_postdata(); endif; ?>