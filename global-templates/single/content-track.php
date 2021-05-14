<article class="article article--sz-lg">

    <div class="article__header">
        <span class="article__header__text">Blog</span>
    </div>
    <!--/article-header-->

    <h2 class="title-4 title-4--lg title-4--m-bottom-xs"><?php the_title(); ?></h2>

    <span class="article__date"><?php echo $date; ?></span>

    <div class="entry entry--m-top entry--m-bottom-md">
        <?php the_content(); ?>
    </div>
    <!--/entry-->

    <?php require get_template_directory() . '/global-templates/social-bar.php'; ?>

</article>
<!--/article-->