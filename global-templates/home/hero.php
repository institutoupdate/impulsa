<?php
$intro_title = get_field('intro-home-title');
?>
<section class="block block--hero js-first-block">
    <div class="container">

        <?php if($intro_title) { ?>
            <h2 class="title title--lg"><?php echo $intro_title; ?></h2>
        <?php } ?>

        <?php
        // Search
        require get_template_directory() . '/global-templates/search.php';
        ?>

    </div>
    <!--/container-->
</section>
<!--/block-->