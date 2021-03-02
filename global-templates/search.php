<?php
// Excerpt lenght
$search_classes = get_query_var('search_classes');
$is_archive = is_post_type_archive();
?>
<div class="search <?php if($search_classes) { echo $search_classes; } ?>">
  <form action="<?php echo get_post_type_archive_link("materials"); ?>" method="get">
    <input class="search__input" type="text" name="s" id="keyword" onkeyup="<?php if(!$is_archive) : ?>fetch()<?php endif; ?>" autocomplete="off" placeholder="<?php echo pll__('Procura algo? Tente “redes sociais” ou “voluntariado”'); ?>" value="<?php the_search_query(); ?>" />
    <span class="search__btn" type="submit"><i class="icon-search"></i></span>
    <div class="search__dropdown" id="datafetch">
        <div class="search__container">
            <span class="loader"></span>
        </div>
    </div>
  </form>
</div>
<!--/search-->
