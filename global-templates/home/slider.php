<?php if( have_rows('slider-home') ): ?>
<div class="block block--slider block--bg-6">
    <div class="slider">

        <div class="swiper-container js-slider">

            <div class="swiper-wrapper">
                <?php while( have_rows('slider-home') ) : the_row();
                    $slider_home_title = get_sub_field('slider-home_title');
                    $slider_home_img = get_sub_field('slider-home_img');
                    $slider_home_url = get_sub_field('slider-home_url');
                ?>
                <div class="swiper-slide">
                    <div class="slide">
                        <?php if($slider_home_img) {
                            $slider_home_img_url = $slider_home_img['url'];
                        ?>
                        <div class="slide__bg" style="background-image:url(<?php echo $slider_home_img_url; ?>);"></div>
                        <?php } ?>
                        <?php if($slider_home_title) { ?>
                        <div class="container">
                            <h3 class="slide__title">
                              <?php if($slider_home_url) : ?>
                                <a href="<?php echo $slider_home_url; ?>">
                              <?php endif; ?>

                              <?php echo $slider_home_title; ?>

                              <?php if($slider_home_url) : ?>
                                </a>
                              <?php endif; ?>
                            </h3>
                        </div>
                        <!--/container-->
                        <?php } ?>
                    </div>
                    <!--/slide-->
                </div>
                <!--/swiper-slide-->
                <?php endwhile; ?>
            </div>
            <!-- swiper-wrapper -->
            <div class="swiper-pagination"></div>

            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
        <!--/swiper-container-->

    </div>
    <!--/slider-->
</div>
<!--/block-slider-->
<?php else : endif; ?>
