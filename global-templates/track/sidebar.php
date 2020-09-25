<div class="dropdown dropdown--sticky">

    <div class="dropdown__header">
        <h5 class="title-3 title-3--sm title-3--uppercase"><?php echo $track_related_count; ?> Materais, <?php echo $reading_time_total; if($reading_time_total == 1) { echo ' minuto'; } else { echo ' minutos'; } ?></h5>
        <button class="dropdown__btn js-dropdown__btn"><i class="icon-angle-down-solid"></i></button>
    </div>
    <!--/dropdwon-header-->

    <div class="box box--bg-gray box--border box--pad-4 box--dropdown js-box--dropdown">
        <ul class="article-list">
            <?php foreach( $track_related_posts as $track_related_post ): 
            $track_related_post_id = $track_related_post->ID; ?>
            <li <?php if($id_post == $track_related_post_id) { echo 'class="active"'; } ?>>
                <?php 
                //set_query_var( 'article_excerpt', 125);
                require get_template_directory() . '/loop-templates/article-sidebar.php';
                ?>
            </li>
            <?php $i++; endforeach; ?>
        </ul>
    </div>
    <!--/box-gray-->

</div>
<!--/dropdown-->