<?php
$track_related_post_id = $track_related_post->ID;
$reading_time = get_field('reading-time', $track_related_post_id);
$post_type = get_post_type($track_related_post_id);

// Type
$article_types = get_the_terms( $track_related_post_id, 'types' );
?>
<article class="article article--c-<?php if($post_type == 'post') { echo '3'; } else { echo '2'; } ?> article--number article--sz-sm article--border-bottom">
    <div class="article__sidebar">
        <span class="article__number"><?php echo $i; ?></span>
    </div>
    <!--/article-sidebar-->
    <div class="article__main">
        <div class="article__header">
            <ul class="article__tag-list">
                <?php if($post_type == 'post') { ?>
                <li><span class="article__tag article__tag--bg-3">Blog</span></li>
                <?php } elseif($article_types) { 
                    foreach ($article_types as $type) { ?>
                <li><span class="article__tag article__tag--bg-2"><?php echo $type->name; ?></span></li>
                <?php } } ?>
            </ul>
            <span class="article__header__text"><?php echo $reading_time; if($reading_time == 1) { echo ' minuto'; } else { echo ' minutos'; } ?></span>
        </div>
        <!--/article-header-->
        <div class="article__content">
            <h6 class="article__title"><a href="<?php echo get_permalink($track_related_post_id).'?track='.$track_id; ?>"><?php echo get_the_title($track_related_post_id); ?></a></h6>
        </div>
        <!--/article-content-->
    </div>
    <!--/article-main-->
</article>
<!--/article-->