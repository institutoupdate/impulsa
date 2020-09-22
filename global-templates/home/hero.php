
<?php
$intro_title = get_field('intro-home-title');
?>
<section class="block block--hero js-first-block">
    <div class="container">

        <?php if($intro_title) { ?>
            <h2 class="title title--lg"><?php echo $intro_title; ?></h2>
        <?php } ?>

        <form action="<?php echo get_post_type_archive_link( 'materials' ); ?>?s=" method="GET" class="search">
            <input type="text" class="search__input" name="s" placeholder="Procura algo? Tente “redes sociais” ou “voluntariado”">
            <button class="search__btn" type="submit"><i class="icon-search"></i></button>
        </form>
        <!--/search-->

    </div>
    <!--/container-->
</section>
<!--/block-->