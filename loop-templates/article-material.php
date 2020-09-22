<?php
$id_post = get_the_ID();

// Excerpt lenght
$excerpt = get_query_var('article_excerpt');

// Date
$date_day = get_the_date('j');
$date_month = get_the_date('F');
$date_year = get_the_date('Y');
$date = ucfirst($date_month).' '.$date_day.', '.$date_year;

// Type
$article_types = get_the_terms( $id_post, 'types' );
?>
<div class="box box--radius box--stackable box--stackable-c-2 box--bg-white box--pad">
    <article class="article article--c-2">
        <div class="article__header">
            <?php if($article_types) { ?>
            <ul class="article__tag-list">
            <?php foreach ($article_types as $type) { ?>
                <li><span class="article__tag article__tag--bg-2"><?php echo $type->name; ?></span></li>
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
    </article>
    <!--/article-->
</div>
<!--/box-->