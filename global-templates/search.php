<?php
// Excerpt lenght
$search_classes = get_query_var('search_classes');
$is_archive = is_post_type_archive("materials");
?>
<div class="search <?php if($search_classes) { echo $search_classes; } ?>">
  <?php if(!$is_archive) : ?>
    <form action="<?php echo get_post_type_archive_link("materials"); ?>" method="get">
  <?php endif; ?>
    <input class="search__input js-enter-submit" type="text" name="text" id="keyword" onkeyup="<?php if(!$is_archive) : ?>fetch()<?php endif; ?>" autocomplete="off" placeholder="<?php echo pll__('Procura algo? Tente “redes sociais” ou “voluntariado”'); ?>" value="<?php the_search_query(); ?>" />
    <span class="search__btn"><i class="icon-search"></i></span>
    <div class="search__dropdown" id="datafetch">
        <div class="search__container">
            <span class="loader"></span>
        </div>
    </div>
  <?php if(!$is_archive) : ?>
    </form>
  <?php endif; ?>
</div>
<!--/search-->
