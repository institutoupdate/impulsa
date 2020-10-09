<?php
$about_who_does_title = get_field('about-who-does_title');
$about_who_does_support_title = get_field('about-who-does_support-title');
$about_who_does_support_text = get_field('about-who-does_support-text');
?>
<div class="semiblock semiblock--m-bottom-xlg">

    <?php if($about_who_does_title) { ?>
    <h3 class="title-2 title-2--sm title-2--c-1 title-2--m-bottom-md"><?php echo $about_who_does_title; ?></h3>
    <?php } ?>

    <?php if( have_rows('about-who-does_items') ): ?>
    <div class="box box--m-bottom-xlg">
    <?php
    $i = 1;
    $rowCount = count( get_field('about-who-does_items') );
    while( have_rows('about-who-does_items') ) : the_row();
        $about_who_does_list_title = get_sub_field('about-who-does_items_title');
        $about_who_does_list_content = get_sub_field('about-who-does_items_content');
        $about_who_does_list_logo = get_sub_field('about-who-does_items_logo');
    ?>
    <div class="box <?php if($i !== $rowCount) { echo 'box--m-bottom-xlg'; } ?>">

        <?php if($about_who_does_list_title) { ?>
        <h4 class="title-3 title-3--uppercase title-3--m-bottom-sm "><?php echo $about_who_does_list_title; ?></h4>
        <?php } ?>

        <div class="grid grid--6y2">

            <?php if($about_who_does_list_content) { ?>
            <div class="text">
                <?php echo $about_who_does_list_content; ?>
            </div>
            <?php } ?>

            <?php if($about_who_does_list_logo) {
                $about_who_does_list_logo_url = $about_who_does_list_logo['url'];
            ?>
            <img class="img-logo img-logo--sm" src="<?php echo $about_who_does_list_logo_url; ?>" alt="<?php echo $about_who_does_list_title; ?>">
            <?php } ?>

        </div>
        <!--/grid-6y2-->

    </div>
    <!--/box-->
    <?php $i++; endwhile; ?>
    </div>
    <?php endif; ?>

    <div class="box">

        <?php if($about_who_does_support_title) { ?>
        <h4 class="title-3 title-3--uppercase title-3--m-bottom"><?php echo $about_who_does_support_title; ?></h4>
        <?php } ?>

        <?php if($about_who_does_support_text) { ?>
        <div class="grid grid--6y2">
            <div class="text">
                <?php echo $about_who_does_support_text; ?>
            </div>
            <!--/text-->
        </div>
        <!--/grid-6y2-->
        <?php } ?>

    </div>
    <!--/box-->

</div>
<!--/semiblock-->
