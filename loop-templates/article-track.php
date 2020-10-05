<?php
$id_post = get_the_ID();

// Excerpt lenght
$excerpt = get_query_var('article_excerpt');

$article_footer = get_query_var('article_footer');

// Date
$date_day = get_the_date('j');
$date_month = get_the_date('F');
$date_year = get_the_date('Y');
$date = ucfirst($date_month).' '.$date_day.', '.$date_year;

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
            <span class="article__header__text"><?php echo $date; ?></span>
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