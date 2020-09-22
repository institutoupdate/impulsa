<?php
$items_title = get_field('items-home-title');
?>
<section class="block block--pad-2">
    <div class="container">
        <?php if($items_title) { ?>
            <h4 class="title title--m-bottom-md"><?php echo $items_title; ?></h4>
        <?php } ?>

        <?php if( have_rows('items-home') ): ?>

        <div class="grid grid--3-box">
            <?php while( have_rows('items-home') ) : the_row(); 
                $items_home_title = get_sub_field('items-home_title');
                $items_home_text = get_sub_field('items-home_text');
                $items_home_link = get_sub_field('items-home_link');
            ?>
            <div class="box box--pad-2 box--column box--bg-1">
                <?php if($items_home_title) { ?>
                <h5 class="box__title"><?php echo $items_home_title; ?></h5>
                <?php } ?>
                <?php if($items_home_text) { ?>
                <p class="text text--m-bottom-sm"><?php echo $items_home_text; ?></p>
                <?php } ?>
                <?php if($items_home_link) { 
                    $items_home_link_url = $items_home_link['url'];
                    $items_home_link_title = $items_home_link['title'];
                    $items_home_link_target = $items_home_link['target'] ? $items_home_link['target'] : '_self';
                ?>
                <div class="btn-box">
                    <a href="<?php echo $items_home_link_url; ?>" target="<?php echo $items_home_link_target; ?>" class="btn-bg btn-bg--shadow"><?php echo $items_home_link_title; ?></a>
                </div>
                <!--/btn-box-->
                <?php } ?>
            </div>
            <!--/box-1-->
            <?php endwhile; ?>

        </div>
        <!--/grid-3-box-->
        <?php else : endif; ?>

    </div>
    <!--/container-->
</section>
<!--/block-->