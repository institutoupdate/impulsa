<?php
get_header();
$current_lng = pll_current_language('slug');
$blog_headline = get_field('blog-headline', $current_lng);
$blog_txt = get_field('blog-txt', $current_lng);
?>
<main class="block block--blog block--pad-3 js-first-block">
    <div class="container">

        <h2 class="title-2 title-2--m-bottom"><?php single_post_title(); ?></h2>

        <div class="grid grid--4y8">

            <aside class="sidebar">
                <?php if($blog_headline) { ?>
                <h3 class="title title--strong-primary title--m-bottom primary-color">
                   <?php echo $blog_headline; ?>
                </h3>
                <?php } ?>

                <?php if($blog_txt) { ?>
                <div class="text-3">
                   <?php echo $blog_txt; ?>
                </div>
                <!--/text-->
                <?php } ?>
            </aside>
            <!--/sidebar-->

            <div class="block__main">

                <?php if (have_posts()) : ?>
                <div class="grid grid--1-box grid--m-bottom-lg">
                    <?php
                        while (have_posts()) : the_post();
                            get_template_part('loop-templates/article-blog');
                        endwhile;
                    ?>
                </div>
                <!--/grid-1-box-->
        		<?php else: endif; ?>

                <div class="pagination-flex">
                    <?php previous_posts_link('<span class="btn__mobile">'. pll__('Recentes'). '</span><span class="btn__desktop">'. pll__('Postagens recentes'). '</span>'); ?>
                    <?php next_posts_link('<span class="btn__mobile">'. pll__('Anteriores'). '</span><span class="btn__desktop">'. pll__('Postagens anteriores'). '</span>'); ?>
                </div>
                <!--/pagination-flex-->

            </div>
            <!--/block-main-->

        </div>
        <!--/grid-4y8-->

    </div>
    <!--/container-->
</main>
<!--/block-->

<?php get_footer(); ?>
