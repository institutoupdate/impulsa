<?php
// Excerpt lenght
$search_classes = get_query_var('search_classes');
?>
<div class="search <?php if($search_classes) { echo $search_classes; } ?>">
    <input class="search__input" type="text" name="keyword" id="keyword" onkeyup="fetch()" autocomplete="off" placeholder="<?php echo pll__('Procura algo? Tente “redes sociais” ou “voluntariado”'); ?>" />
    <span class="search__btn" type="submit"><i class="icon-search"></i></span>
    <div class="search__dropdown" id="datafetch">
        <div class="search__container">
            <span class="loader"></span>   
        </div>            
    </div>
</div>
<!--/search-->