<?php
// Template name: Library
get_header();

// Type
$types = get_terms([
    'taxonomy' => 'types',
    'hide_empty' => false,
]);

// Topics
$topics = get_terms([
    'taxonomy' => 'topics',
    'hide_empty' => false,
]);

// Countries
$countries = get_terms([
    'taxonomy' => 'countries',
    'hide_empty' => false,
]);

// Count
$count = 0;

?>
<main class="block block--pad-3 js-first-block">
    <div class="container">
        <h2 class="title-2 title-2--m-bottom-lg ">Biblioteca</h2>
        <form action="#" method="GET" class="grid grid--4y8">

            <aside class="sidebar">

                <div class="dropdown dropdown--sticky">

                    <div class="dropdown__header">
                        <h5 class="title-3 title-3--sm title-3--uppercase">Filtros</h5>
                        <button class="dropdown__btn js-dropdown__btn"><i class="icon-angle-down-solid"></i></button>
                    </div>
                    <!--/dropdwon-header-->

                    <div class="box box--bg-gray box--border box--pad box--dropdown js-box--dropdown">

                        <div class="form">

                            <?php if($topics) { ?>
                            <div class="form__box">
                                <h6 class="form__box__title">Tema</h6>
                                <ul class="checkbox-list checkbox-list--c-2">
                                    <?php foreach ($topics as $topic) { ?>
                                    <li>
                                        <label class="checkbox">
                                            <input type="checkbox" name="topic" value="<?php echo $topic->slug; ?>" <?php if($topic->slug == $_GET['topic'] ) { echo 'checked'; } ?> >
                                            <span class="checkmark"><i class="icon-ok"></i></span>
                                            <span class="checkbox__text"><?php echo $topic->name; ?></span>
                                        </label>
                                    </li>
                                    <?php } ?>
                                </ul>
                                <!--/checkbox-list-->
                            </div>
                            <!--/form-box-->
                            <?php } ?>

                            <?php if($types) { ?>
                            <div class="form__box">
                                <h6 class="form__box__title">Tipo</h6>
                                <ul class="checkbox-list checkbox-list--c-2">
                                    <?php foreach ($types as $type) { ?>
                                    <li>
                                        <label class="checkbox">
                                            <input type="checkbox" name="type" value="<?php echo $type->slug; ?>" <?php if($type->slug == $_GET['type'] ) { echo 'checked'; } ?> >
                                            <span class="checkmark"><i class="icon-ok"></i></span>
                                            <span class="checkbox__text"><?php echo $type->name; ?></span>
                                        </label>
                                    </li>
                                    <?php } ?>
                                </ul>
                                <!--/checkbox-list-->
                            </div>
                            <!--/form-box-->
                            <?php } ?>

                            <?php if($countries) { ?>
                            <div class="form__box">
                                <h6 class="form__box__title">País</h6>
                                <ul class="checkbox-list checkbox-list--c-2">
                                    <?php foreach ($countries as $country) { ?>
                                    <li>
                                        <label class="checkbox">
                                            <input type="checkbox" name="country" value="<?php echo $country->slug; ?>" <?php if($country->slug == $_GET['country'] ) { echo 'checked'; } ?> >
                                            <span class="checkmark"><i class="icon-ok"></i></span>
                                            <span class="checkbox__text"><?php echo $country->name; ?></span>
                                        </label>
                                    </li>
                                    <?php } ?>
                                </ul>
                                <!--/checkbox-list-->
                            </div>
                            <!--/form-box-->
                            <?php } ?>

                            <div class="btn-box btn-box--filter btn-box--m-top">
                                <button type="submit" class="btn-bg btn-bg--border-1 btn-bg--sz-sm">Filtrar</button>
                                <a href="<?php echo get_post_type_archive_link( 'materials' ); ?>" class="link-underline link-underline--c-1">Limpiar filtros</a>
                            </div>
                            <!--/btn-box-filter-->

                        </div>
                        <!--/form-->

                    </div>
                    <!--/box-gray-->
                </div>
                <!--/dropdown-->

            </aside>
            <!--/sidebar-->

            <section class="block__main">

                <div class="search search--m-bottom">
                    <input type="text" class="search__input" name="s" placeholder="Procura algo? Tente “redes sociais” ou “voluntariado”" <?php if( isset($_GET['s']) ) { echo'value="'.$_GET['s'].'"'; } ?> >
                    <button class="search__btn" type="submit"><i class="icon-search"></i></button>
                </div>
                <!--/search-->

                <div class="search-header">
                
                    <?php if (have_posts()) : while (have_posts()) : the_post(); $count++; endwhile; ?>
                    <span class="title-3 title-3--sm2 title-3--strong-c-2"><strong><?php echo $count; ?></strong> materais</span>
                    <?php else: ?>
                    <span class="title-3 title-3--sm2 title-3--strong-c-2"><strong>0</strong> materais</span>
                    <?php endif; ?>
                    
                    <div class="input input--order">
                        <label for="form__order" class="input__label">Ordenar por</label>
                        <div class="input__select">
                            <select name="order" id="form__order" class="js-order">
                                <option value="DESC" <?php if($_GET['order'] == 'DESC') { echo 'selected'; } ?>>Más reciente</option>
                                <option value="ASC" <?php if($_GET['order'] == 'ASC' ) { echo 'selected'; } ?>>Más antigua</option>
                            </select>
                            <i class="icon-angle-down-solid"></i>
                        </div>
                        <!-- /input__select -->
                    </div>
                    <!-- /input-btn -->

                </div>
                <!--/search-header-->

                <?php if (have_posts()) : ?>
                <div class="grid grid--1-box grid--m-bottom-lg">
                <?php while (have_posts()) : the_post(); 
						get_template_part('loop-templates/article-material');
                    endwhile; ?>
                </div>
                <!-- /grid-1-box -->
                <?php else: ?>
                    <p class="text text--m-bottom">No se han encontrado resultados. <a href="<?php echo get_post_type_archive_link( 'materials' ); ?>">Limpiar filtros</a>.</p>
                <?php endif; ?>

                <div class="pagination pagiantion--c-1">
                    <?php 
                    $args_pagination = array(
                        'current'            => $paged,
                        'show_all'           => false,
                        'prev_next'          => true,
                        'prev_text'          => __('<i class="icon-angle-right-solid"></i>'),
                        'next_text'          => __('<i class="icon-angle-right-solid"></i>'),
                        'type'               => 'list'
                    );
                    echo paginate_links( $args_pagination ); 
                    ?>
                </div>
                <!--/pagination-->

            </section>
            <!--/block-main-->

        </form>
        <!--/grid-4y8-->
    </div>
    <!--/container-->
</main>
<!--/block-->
<?php 
get_footer();
?>