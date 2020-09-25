<?php
// Template name: About
get_header();
if (have_posts()) : while (have_posts()) : the_post(); 
?>

<section class="block block--pad-6 js-first-block">
    <div class="container">
        <div class="grid grid--12">
            <div class="col-8 col-8--center">

                <h2 class="title-2 title-2--m-bottom-md "><?php the_title(); ?></h2>

                <?php
                // Intro
                require get_template_directory() . '/global-templates/about/intro.php';

                // Who does
                require get_template_directory() . '/global-templates/about/who-does.php';

                // Who finances
                require get_template_directory() . '/global-templates/about/who-finances.php';
                ?>

            </div>
            <!--/col-8-center-->
        </div>
        <!--/grid-12-->
    </div>
    <!--/container-->
</section>
<!--/block-->

<?php 
endwhile; else: endif;
get_footer();
?>