<?php
// Template name: FAQ
get_header();
if (have_posts()) : while (have_posts()) : the_post(); 
$headline = get_field('headline');
?>

<main class="block block--pad-3 js-first-block">
    <div class="container">

        <h2 class="title-2 title-2--m-bottom"><?php the_title(); ?></h2>

        <div class="grid grid--4y8">

            <aside class="sidebar">

                <?php if($headline) { ?>
                <h3 class="title title--strong-primary title--m-bottom">
                   <?php echo $headline; ?>
                </h3>
                <?php } ?>

                <div class="text-3 text-3--m-bottom">
                    <?php the_content(); ?>
                </div>
                <!--/text-->
            
            </aside>
            <!--/sidebar-->

            <div class="block__main">

                <?php if( have_rows('faq-section') ): 
                    while( have_rows('faq-section') ) : the_row(); 
                    $faq_title = get_sub_field('faq-section_title');
                ?>
                <div class="questions">

                    <h4 class="questions__title"><?php echo $faq_title; ?></h4>
                    <?php 
                        if( have_rows('faq') ): 
                            while( have_rows('faq') ) : the_row(); 
                            $faq_question = get_sub_field('faq-question');
                            $faq_answer = get_sub_field('faq-answer');
                    ?>
                    <div class="question__item">
                        <p class="question"><?php echo $faq_question; ?><span>#</span></p>
                        <div class="text">
                            <?php echo $faq_answer; ?>
                        </div>
                    </div>
                    <!--/question-item-->
                    <?php endwhile; else : endif; ?>

                </div>      
                <!--/question-->
                <?php endwhile; else : endif; ?>

                <p class="title title--sm">¿Dudas? Podés escribirnos en nuestra <a href="<?php echo home_url();?>/contato">Sección de contacto</a></p>  
            
            </div>
            <!-- /block__main -->
        </div>
        <!-- /grid-4y8 -->
    </div>
    <!-- /container -->
</main>

<?php 
endwhile; else: endif;
get_footer();
?>