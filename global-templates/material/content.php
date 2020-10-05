<article class="article article--sz-lg">

    <div class="article__header">
        <?php if($article_type) { ?>
        <ul class="article__tag-list">
        <?php foreach ($article_type as $type) { ?>
            <li><span class="article__tag article__tag--bg-2"><?php echo $type->name; ?></span></li>
        <?php } foreach ($article_topics as $topic) { ?>
            <li><span class="article__tag article__tag--bg-3"><?php echo $topic->name; ?></span></li>
        <?php } ?>
        </ul>
        <!--/article-tag-list-->
        <?php } ?>
        <span class="article__header__text"><?php echo $date; ?>. By <?php echo $author_name; ?></span>
    </div>
    <!--/article-header-->

    <h2 class="title-4 title-4--lg title-4--m-bottom-sm"><?php the_title(); ?></h2>

    <div class="entry">
        <?php the_content(); ?>
    </div>
    <!--/entry-->

    <?php if($material_video && $material_video['material_video-url']) { 
        $material_video_url = $material_video['material_video-url'];
        if($material_video['material_video-preview']) {
            $material_video_bg = $material_video['material_video-preview'];
        } else {
            $material_video_bg = thumb_video_youtube($material_video_url);
        }
        
    ?>
    <a href="<?php echo $material_video_url; ?>" data-fancybox class="article__video">
        <span class="video-play"></span>
        <div class="article__bg" style="background-image:url(<?php echo $material_video_bg; ?>);"></div>
    </a>
    <!--/article-video-->
    <?php } ?>

    <?php if( have_rows('material_files') ): ?>
        <ul class="list list--btns">
        <?php while( have_rows('material_files') ) : the_row(); 
            $material_file = get_sub_field('material_files-file');
            if($material_file) {
            $material_file_url = $material_file['url'];
            $material_filename = $material_file['filename'];
        ?>
        <li>
            <a href="<?php echo $material_file_url; ?>" download class="btn-bg btn-bg--sz-sm btn-bg--border-2">Descargar materais</a>
            <span><?php echo $material_filename; ?></span>
        </li>
        <!--/pagination-flex-->
        <?php } endwhile; ?>
        </ul>
    <?php else : endif; ?>

    <?php if($author_description) { ?>
    <div class="box box--bg-gray box--border box--pad-sm box--m-bottom-lg">
        <h6 class="title-3 title-3--sm title-3--uppercase title-3--m-bottom-xsm"><?php echo $author_name; ?></h6>
        <p class="text-2 text-2--md"><?php echo $author_description; ?></p>
    </div>
    <!--/box-->
    <?php } ?>

    <?php require get_template_directory() . '/global-templates/social-bar.php'; ?>

</article>
<!--/article--> 