<?php 
get_header();
if (have_posts()) : while (have_posts()) : the_post(); 

$id_post = get_the_ID();

// Author
$author_id = get_the_author_id();
$author_name = get_the_author_meta('display_name', $author_id);
$author_description = get_the_author_meta('description', $author_id);

// Date
$date_day = get_the_date('j');
$date_month = get_the_date('F');
$date_year = get_the_date('Y');
$date = ucfirst($date_month).' '.$date_day.', '.$date_year;

// Video
$material_video = get_field('material_video');

// Type
$article_type = get_the_terms( $id_post, 'types' );

// Topics
$article_topics = get_the_terms( $id_post, 'topics' );
?>
<section class="block block--pad-3 js-first-block">
    <div class="container">
        <div class="grid grid--12">
            <div class="col-8 col-8--center">

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

                    <?php if($material_video && $material_video['material_video-url']) { ?>
                    <a href="<?php echo $material_video['material_video-url']; ?>" data-fancybox class="article__video">
                        <span class="video-play"></span>
                        <div class="article__bg" style="background-image:url(<?php echo $material_video['material_video-preview']; ?>);"></div>
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

                    <div class="social-bar">
                        <div class="social-box">
                            <span class="social__text">Goustou?</span>
                            <div class="social social--bg">
                                <a class="btn-circle" href="#"><i class="icon-thumbs-up"></i></a>
                                <a class="btn-circle" href="#"><i class="icon-thumbs-down"></i></a>
                            </div>
                            <!-- /social -->
                        </div>
                        <!-- /social-box -->
                        <div class="social-box">
                            <span class="social__text">Compartilhe</span>
                            <div class="social social--bg">
                                <a class="btn-circle" href="https://facebook.com/"><i class="icon-facebook"></i></a>
                                <a class="btn-circle" href="https://twitter.com/"><i class="icon-twitter"></i></a>
                                <a class="btn-circle" href="https://web.whatsapp.com/"><i class="icon-whatsapp"></i></a>
                            </div>
                            <!-- /social -->
                        </div>
                        <!-- /social-box -->
                    </div>
                    <!--/social-bar-->

                </article>
                <!--/article--> 

            </div>
            <!--/col-8-center-->
        </div>
        <!--/grid-12-->
    </div>
    <!--/container-->
</section>
<!--/block-->

<section class="block block--p-bottom-lg">
    <div class="container">
        <div class="box box--border box--bg-gray box--pad-3">

            <div class="box__header">
                <h4 class="title-3 title-3--uppercase">Materais relacionadas</h4>
            </div>
            <!--/box-header-->

            <?php
            // latest 3 posts
            $args = array(
                'post_type' => array( 'materials' ),
                'order' => 'DESC',
                'posts_per_page' => 3,
                'post__not_in' => array (get_the_ID()),
            );
            $latestPosts = new WP_Query($args);
            if($latestPosts->have_posts()) {
            ?>
            <div class="grid grid--3-box">
                <?php 
                while($latestPosts->have_posts()) { $latestPosts->the_post(); 
                    set_query_var( 'article_excerpt', 125);
                    get_template_part('loop-templates/article-material');
                }
                ?>
            </div>
            <!--/grid-->
            <?php } ?>
        </div>
        <!--/box--> 
    </div>
    <!--/container-->
</section>
<!--/block-->

<?php 
endwhile; else: endif;
get_footer();
?>