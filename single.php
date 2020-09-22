<?php 
get_header();
if (have_posts()) : while (have_posts()) : the_post(); 

// Fecha
$date_day = get_the_date('j');
$date_month = get_the_date('F');
$date_year = get_the_date('Y');
$date = ucfirst($date_day).' de '.$date_month.' de '.$date_year;
?>

<section class="block block--pad-6 js-first-block">
    <div class="container">

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

            <div class="grid grid--12">
                <div class="col-8 col-8--center">
                    <span class="article__date"><?php echo $date; ?></span>

                    <div class="entry entry--m-top entry--m-bottom-md">
						<?php the_content(); ?>
                    </div>
                    <!-- /entry -->

                    <div class="social-bar">
                        <div class="social-box">
                            <span class="social__text">Goustou?</span>
                            <div class="social social--bg">
                                <a class="btn-circle" href="#"><i class="icon-thumbs-up"></i></a>
                                <a class="btn-circle" href="#"><i class="icon-thumbs-down"></i></a>
                            </div>
                            <!-- /social -->
                        </div>
                        <!-- /social-box -->
                        <div class="social-box">
                            <span class="social__text">Compartilhe</span>
                            <div class="social social--bg">
                                <a class="btn-circle" href="https://facebook.com/"><i class="icon-facebook"></i></a>
                                <a class="btn-circle" href="https://twitter.com/"><i class="icon-twitter"></i></a>
                                <a class="btn-circle" href="https://web.whatsapp.com/"><i class="icon-whatsapp"></i></a>
                            </div>
                            <!-- /social -->
                        </div>
                        <!-- /social-box -->
                    </div>
                    <!-- /social-bar -->

                </div>
                <!-- /col-8-center -->

            </div>
            <!-- /grid-12 -->

        </article>

    </div>
    <!-- /container -->

</section>
<!--/block-->

<section class="block block--p-bottom-lg">
    <div class="container">
        <div class="grid grid--12">
            <div class="col-8 col-8--center">

                <h3 class="title-3 title-3--uppercase title-3--m-bottom">Entradas relacionadas</h3>

				<?php
				// latest 3 posts
				$args = array(
					'post_type' => array( 'post' ),
					'order' => 'DESC',
					'posts_per_page' => 3,
					'post__not_in' => array (get_the_ID()),
				);
				$latestPosts = new WP_Query($args);
				if($latestPosts->have_posts()) {
				?>
				<div class="grid grid--1-box">
					<?php 
					while($latestPosts->have_posts()) { $latestPosts->the_post(); 
						get_template_part('loop-templates/article-blog');
					}
					?>
				</div>
				<!--/grid-->
        		<?php } ?>
				
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