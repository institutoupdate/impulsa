<?php
// Author
$author_id = get_the_author_id();
$author_name = get_the_author_meta('display_name', $author_id);

// Date
$date_day = get_the_date('j');
$date_month = get_the_date('F');
$date_year = get_the_date('Y');
$date = ucfirst($date_month).' '.$date_day.', '.$date_year;

if(has_post_thumbnail()) {
    $thumb = get_the_post_thumbnail_url(get_the_ID(), 'medium');
} else {
    $thumb = get_bloginfo('template_url').'/images/thumb-default.jpg'; // Imagen por defecto 
}
?>

<div class="box box--radius box--stackable box--stackable-c-3 box--bg-white box--pad">

    <article class="article article--2 article--c-3 article--horiz">

        <div class="article__img"><a href="<?php the_permalink(); ?>" class="article__bg" style="background-image:url(<?php echo $thumb; ?>);"></a></div>
        
        <div class="article__main">

            <div class="article__header">
                <span class="article__header__text"><?php echo $date; ?>. By <?php echo $author_name; ?></span>
            </div>
            <!--/article-header-->

            <div class="article__content">
                <h5 class="article__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                <p class="article__excerpt">
                    <?php echo the_excerpt_max_charlength(295); ?>
                </p>
            </div>
            <!--/article-content-->

        </div>
        <!--/article-main-->

    </article>
    <!--/article-->

</div>
<!--/box-->