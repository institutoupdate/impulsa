<?php
$about_who_finances_title = get_field('about-who-finances_title');
$about_who_finances_content = get_field('about-who-finances_content');
$about_who_finances_links_title = get_field('about-who-finances_links-title');
$about_who_finances_links_text = get_field('about-who-finances_links-text');
?>
<div class="semiblock">

    <?php if($about_who_finances_title) { ?>
    <h3 class="title-2 title-2--sm title-2--c-1 title-2--m-bottom-md"><?php echo $about_who_finances_title; ?></h3>
    <?php } ?>

    <div class="box box--m-bottom-xlg">
        <div class="grid grid--6y2 grid--sponsor">

            <div class="grid__box">

                <?php if($about_who_finances_content) { ?>
                <div class="text text--m-bottom-sm">
                    <?php echo $about_who_finances_content; ?>
                </div>
                <!--/text-->
                <?php } ?>

                <?php if( have_rows('about-who-finances_logos') ): ?>
                <div class="svg-list">
                    <?php while( have_rows('about-who-finances_logos') ) : the_row(); 
                        $about_who_finances_logo_img = get_sub_field('about-who-finances_logos_img');
                        $about_who_finances_logo_link = get_sub_field('about-who-finances_logos_link');
                        if($about_who_finances_logo_img) {
                            $about_who_finances_logo_img_url = $about_who_finances_logo_img['url'];
                    ?>
                    <?php if($about_who_finances_logo_link) { ?>
                    <a href="<?php echo $about_who_finances_logo_link; ?>" target="_blank" class="svg-link">
                    <?php } else { ?>
                    <div class="svg-link">
                    <?php } ?>
                        <img src="<?php echo $about_who_finances_logo_img_url; ?>" alt="">
                    <?php if($about_who_finances_logo_link) { ?>
                    </a>
                    <?php } else { ?>
                    </div>
                    <?php } ?>
                    <?php } endwhile; ?>
                </div>
                <!--/svg-list-->
                <?php else : endif; ?>
                
            </div>
            <!--/grid__box-->

            <?php
                if( have_rows('about-who-finances_btns') ): 
                $i = 1;
                $rowCount = count( get_field('about-who-does_items') );
            ?>
            <div class="btn-box btn-box--column">
                <?php while( have_rows('about-who-finances_btns') ) : the_row(); 
                    $about_who_finances_btn = get_sub_field('about-who-finances_btns_btn');
                    if($about_who_finances_btn) {
                        $about_who_finances_btn_url = $about_who_finances_btn['url'];
                        $about_who_finances_btn_title = $about_who_finances_btn['title'];
                        $about_who_finances_btn_target = $about_who_finances_btn['target'] ? $about_who_finances_btn['target'] : '_self';
                ?>
                <a href="<?php echo $about_who_finances_btn_url; ?>" target="<?php echo $about_who_finances_btn_target; ?>" class="btn-bg btn-bg--border-1 <?php if($i !== $rowCount) { echo 'btn-bg--m-bottom'; } ?>"><?php echo $about_who_finances_btn_title; ?></a>
                <?php } $i++; endwhile; ?>
            </div>
            <!--/btn-box-grid-->
            <?php else : endif; ?>

        </div>
        <!--/grid-6y2-->
    </div>
    <!--/box-->

    <div class="box">

        <?php if($about_who_finances_links_title) { ?>
        <h4 class="title-3 title-3--uppercase title-3--m-bottom"><?php echo $about_who_finances_links_title; ?></h4>
        <?php } ?>

        <?php if($about_who_finances_links_text) { ?>
        <div class="grid grid--6y2">
            <div class="text">
                <?php echo $about_who_finances_links_text; ?>
            </div>
            <!--/text-->
        </div>
        <!--/grid-6y2-->
        <?php } ?>

    </div>
    <!--/box-->

</div>
<!--/semiblock-->