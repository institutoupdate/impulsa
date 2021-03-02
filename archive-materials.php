<?php
get_header();

// Type
$types = get_terms([
    'taxonomy' => 'types',
    'hide_empty' => true,
]);

// Topics
$topics = get_terms([
    'taxonomy' => 'topics',
    'hide_empty' => true,
]);

$topics_selected = isset($_GET['topic']) ? $_GET['topic'] : '';
$types_selected = isset($_GET['type']) ? $_GET['type'] : '';

// Count
global $wp_query;
$count = $wp_query->found_posts;
?>
<main class="block block--pad-3 js-first-block">
    <div class="container">
        <h2 class="title-2 title-2--m-bottom-lg "><?php echo pll__('Biblioteca'); ?></h2>
        <div class="grid grid--4y8">

            <aside class="sidebar">
              <form action="#" method="GET">
                <div class="dropdown dropdown--sticky">

                    <div class="dropdown__header">
                        <h5 class="title-3 title-3--sm title-3--uppercase"><?php echo pll__('Filtros'); ?></h5>
                        <button class="dropdown__btn js-dropdown__btn"><i class="icon-angle-down-solid"></i></button>
                    </div>
                    <!--/dropdwon-header-->

                    <div class="box box--bg-gray box--border box--pad box--dropdown">

                        <div class="form">

                            <?php if($topics) { ?>
                            <div class="form__box">
                                <h6 class="form__box__title">Tema</h6>
                                <ul class="checkbox-list checkbox-list--c-2">
                                    <?php foreach ($topics as $topic) { ?>
                                    <li>
                                        <label class="checkbox">
                                            <input type="checkbox" name="topic[]" onchange="this.form.submit()" value="<?php echo $topic->slug; ?>" <?php if( $topics_selected && in_array($topic->slug, $topics_selected ) ) { echo 'checked'; } ?> >
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
                                            <input type="checkbox" name="type[]" onchange="this.form.submit()" value="<?php echo $type->slug; ?>" <?php if( $types_selected && in_array($type->slug, $types_selected ) ) { echo 'checked'; } ?> >
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

                            <div class="btn-box btn-box--filter btn-box--m-top">
                                <button type="submit" class="btn-bg btn-bg--border-1 btn-bg--sz-sm">Filtrar</button>
                                <a href="<?php echo get_post_type_archive_link( 'materials' ); ?>" class="link-underline link-underline--c-1"><?php echo pll__('Limpar filtros'); ?></a>
                            </div>
                            <!--/btn-box-filter-->

                        </div>
                        <!--/form-->

                    </div>
                    <!--/box-gray-->
                </div>
                <!--/dropdown-->
              </form>
            </aside>
            <!--/sidebar-->

            <section class="block__main">

                <?php
                // Search
                set_query_var( 'search_classes', 'search--m-bottom');
                get_template_part('global-templates/search');
                ?>

                <div class="search-header">

                    <span class="title-3 title-3--sm2 title-3--strong-c-2 title--lowercase"><strong><?php echo $count; ?></strong> <?php if($count === 1) { echo pll__('Material'); } else { echo pll__('Materais'); } ?></span>

                    <div class="input input--order">
                        <label for="form__order" class="input__label"><?php echo pll__('Ordenar por'); ?></label>
                        <div class="input__select">
                            <select name="order" id="form__order" class="js-order">
                                <option value="DESC" <?php if(isset($_GET['order']) && ($_GET['order'] == 'DESC')) { echo 'selected'; } ?>><?php echo pll__('Mais recente'); ?></option>
                                <option value="ASC" <?php if(isset($_GET['order']) && ($_GET['order'] == 'ASC' )) { echo 'selected'; } ?>><?php echo pll__('Mais antiga'); ?></option>
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
                    <p class="text text--m-bottom"><?php echo pll__('Nenhum resultado encontrado'); ?>. <a href="<?php echo get_post_type_archive_link( 'materials' ); ?>"><?php echo pll__('Limpar filtros'); ?></a>.</p>
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

        </div>
        <!--/grid-4y8-->
    </div>
    <!--/container-->
</main>
<!--/block-->
<?php
get_footer();
?>
