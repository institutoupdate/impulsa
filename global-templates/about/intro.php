<?php 
// Intro
$about_intro_title = get_field('about-intro_title');
$about_intro_content = get_field('about-intro_content');
?>

<div class="grid grid--about grid--m-bottom-lg">

    <?php if($about_intro_content) { ?>
    <div class="text-3 text-3--strong-c-1">
        <?php echo $about_intro_content; ?>
    </div>
    <!--/text-->
    <?php } ?>

    <div class="grid__box">

        <?php if($about_intro_title) { ?>
        <p class="text text--c-black text--m-bottom-xsm"><?php echo $about_intro_title; ?></p>
        <?php } ?>

        <?php if( have_rows('about-intro_list') ): ?>
        <ul class="check-list check-list--c-black">
            <?php while( have_rows('about-intro_list') ) : the_row(); 
                $about_intro_list_item = get_sub_field('about-intro_list-item');
            ?>
            <li class="check-list__li"><i class="icon-check-circle"></i><?php echo $about_intro_list_item; ?></li>
            <?php endwhile; ?>
        </ul>
        <?php else : endif; ?>

    </div>
    <!--/grid-box-->
</div>
<!--/grid-about-->