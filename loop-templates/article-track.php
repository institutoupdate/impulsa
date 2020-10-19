<?php
$id_post = get_the_ID();

// Excerpt lenght
$excerpt = get_query_var('article_excerpt');

// Date
$date_day = get_the_date('j');
$date_month = get_the_date('F');
$date_year = get_the_date('Y');
$date = ucfirst($date_month).' '.$date_day.', '.$date_year;

$article_footer = get_query_var('article_footer');

$track_related_posts = get_field('track_relationship', $id_post);

// Reading time total
if($track_related_posts) {
    $reading_time_array = array();
    foreach( $track_related_posts as $related_post ):
        $reading_time = get_field('reading-time', $related_post->ID);
        $reading_time_array[] = $reading_time;
    endforeach;
    $reading_time_total = array_sum($reading_time_array);
    $track_related_count = count($track_related_posts);
}

// Topics
$article_topics = get_the_terms( $id_post, 'topics' );
?>
<div class="box box--radius box--stackable box--stackable-c-1 box--bg-white box--pad">
    <article class="article article--c-1">
        <div class="article__header">
            <?php if($article_topics) { ?>
            <ul class="article__tag-list">
                <li><span class="article__tag article__tag--bg-1"><?php echo pll__('Trilha'); ?></span></li>
                <?php foreach ($article_topics as $topic) { ?>
                <li><span class="article__tag article__tag--bg-3"><?php echo $topic->name; ?></span></li>
                <?php } ?>
            </ul>
            <!--/article-tag-list-->
            <?php } ?>
            <?php if($track_related_posts) { ?>
            <span class="article__header__text"><?php echo $track_related_count.' '; if($track_related_count === 1) { echo pll__('Material'); } else { echo pll__('Materais'); } ?>, <?php echo $reading_time_total; if($reading_time_total == 1) { echo ' minuto'; } else { echo ' minutos'; } ?></span>
            <?php } else { ?>
            <span class="article__header__text"><?php echo $date; ?></span>
            <?php } ?>
        </div>
        <!--/article-header-->
        <div class="article__content">
            <h5 class="article__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
            <p class="article__excerpt">
                <?php echo the_excerpt_max_charlength($excerpt); ?>
            </p>
        </div>
        <!--/article-content-->

        <?php if($article_footer) { ?>
        <div class="article__footer">
            <a href="<?php the_permalink(); ?>" class="btn"><?php echo pll__('Ver mais'); ?> <i class="icon-arrow-right"></i></a>
        </div>
        <!--/article-footer-->
        <?php } ?>

    </article>
    <!--/article-->
</div>
<!--/box-->
