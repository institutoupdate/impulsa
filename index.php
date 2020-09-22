<?php get_header(); ?>

<main class="block block--blog block--pad-3 js-first-block">
    <div class="container">

        <h2 class="title-2 title-2--m-bottom"><?php single_post_title(); ?></h2>

        <div class="grid grid--4y8">

            <aside class="sidebar">
                <h3 class="title title--m-bottom"><strong class="title__block title__900">Lorem ipsum</strong>Lorem ipsum dolor sit amet</h3>
                <p class="text-3">
                    Lorem ipsum dolor sit amet, consectetur <strong>adipiscing elit, sed do eiusmod tempor incididunt</strong> ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.
                </p>
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
                    <?php previous_posts_link('<span class="btn__mobile">Recientes</span><span class="btn__desktop">Entradas recientes</span>'); ?>
                    <?php next_posts_link('<span class="btn__mobile">Anteriores</span><span class="btn__desktop">Entradas anteriores</span>'); ?>
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