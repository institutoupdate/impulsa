<article class="article article--sz-lg">

    <div class="grid grid--12 grid--m-bottom-sm">

        <div class="col-8 col-8--center">

            <div class="article__header">
                <span class="article__header__text">Blog</span>
            </div>
            <!--/article-header-->

            <h2 class="title-4 title-4--lg"><?php the_title(); ?></h2>

        </div>
        <!--/col-8-center-->

    </div>
    <!--/grid-12-->

    <?php
    /*
    <?php if(has_post_thumbnail()) {
        $thumb = get_the_post_thumbnail_url(get_the_ID(), 'large');
    ?>
    <div class="grid grid--12 grid--m-bottom-md">
        <div class="col-10 col-10--center">
            <div class="article__img"><div class="article__bg" style="background-image:url(<?php echo $thumb; ?>);"></div></div>
        </div>
        <!--/col-10-center-->
    </div>
    <!--/grid-12-->
    <?php } ?>
    */
    ?>

    <div class="grid grid--12">
        <div class="col-8 col-8--center">

            <span class="article__date"><?php echo $date; ?></span>

            <div class="entry entry--m-top entry--m-bottom-md">
                <?php the_content(); ?>
            </div>
            <!--/entry-->

            <?php require get_template_directory() . '/global-templates/social-bar.php'; ?>

        </div>
        <!--/col-8-center-->

    </div>
    <!--/grid-12-->

</article>
<!--/article-->
