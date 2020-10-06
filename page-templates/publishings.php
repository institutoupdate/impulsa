<?php
// Template name: Publishings
get_header();
if (have_posts()) : while (have_posts()) : the_post(); 
$headline = get_field('headline');

$contact_title = get_field('contact-title');
$contact_email = get_field('contact-email');
$contact_phone = get_field('contact-phone');
$contact_address = get_field('contact-address');

$downloads_title = get_field('downloads-title');
?>
<main class="block block--pad-3 block--search js-first-block">
    <div class="container">

        <h2 class="title-2 title-2--m-bottom"><?php the_title(); ?></h2>

        <div class="grid grid--4y8">

            <aside class="sidebar">

                <div class="box box--m-bottom">
                    <?php if($contact_title) { ?>
                    <h5 class="title-3 title-3--sm title-3--uppercase title-3--m-bottom-xsm"><?php echo $contact_title; ?></h5>
                    <?php } ?>
                    <ul class="list">
                        <?php if($contact_email) { ?>
                        <li><a href="mailto:<?php echo $contact_email; ?>"><?php echo $contact_email; ?></a></li>
                        <?php } ?>
                        <?php if($contact_phone) { ?>
                        <li><a href="tel:<?php echo $contact_email; ?>"><?php echo $contact_phone; ?></a></li>
                        <?php } ?>
                        <?php if($contact_address) { ?>
                        <li><?php echo $contact_address; ?></li>
                        <?php } ?>
                    </ul>
                </div>
                <!--/box-->

                <div class="box">
                    <?php if($downloads_title) { ?>
                    <h5 class="title-3 title-3--sm title-3--uppercase title-3--m-bottom-xsm"><?php echo $downloads_title; ?></h5>
                    <?php } ?>
                    
                    <?php if( have_rows('downloads-items') ): ?>
                    <ul class="list list--download">
                        <?php while( have_rows('downloads-items') ) : the_row(); 
                            $downloads_file = get_sub_field('downloads-items_file');
                            if($downloads_file) {
                                $downloads_file_id = $downloads_file['id'];
                                $downloads_file_url = $downloads_file['url'];
                                $downloads_file_title = $downloads_file['title'];
                                $downloads_file_ext = pathinfo($downloads_file_url, PATHINFO_EXTENSION);
                                $downloads_file_filesize = filesize( get_attached_file( $downloads_file_id ) );
                                $downloads_file_filesize = get_file_size($downloads_file_filesize);
                        ?>
                        <li>
                            <a href="<?php echo $downloads_file_url; ?>" download><i class="icon-download-cloud"></i>
                                <span class="list__title"><?php echo $downloads_file_title; ?> </span> 
                                <span class="list__data">(<?php echo $downloads_file_filesize; ?>, <?php echo $downloads_file_ext; ?>)</span>
                            </a>
                        </li>
                        <?php } endwhile; ?>
                    </ul>
                    <?php else : endif; ?>
                </div>
                <!--/box-->

            </aside>
            <!--/sidebar-->

            <section class="block__main">
                <?php if($headline) { ?>
                <h3 class="title title--strong-primary title--m-bottom">
                   <?php echo $headline; ?>
                </h3>
                <?php } ?>
                
                <?php if( have_rows('publishings-list') ): ?>
                <div class="grid grid--1-box">

                    <?php while( have_rows('publishings-list') ) : the_row(); 
                        $publishings_publishing_title = get_sub_field('publishings_publishing_title');
                        $publishings_publishing_excerpt = get_sub_field('publishings_publishing_excerpt');
                        $publishings_publishing_link = get_sub_field('publishings_publishing_link');
                        $publishings_publishing_date = get_sub_field('publishings_publishing_date');
                        $publishings_publishing_media = get_sub_field('publishings_publishing_media');
                    ?>
                    <div class="box box--radius box--stackable box--bg-white box--pad">
                        <article class="article article--2 article--c-2">

                            <div class="article__header">
                                <ul class="article__tag-list">
                                    <li><span class="article__tag article__tag--bg-2"><?php echo pll__('Midia'); ?></span></li>
                                </ul>
                                <?php if($publishings_publishing_media || $publishings_publishing_date) { ?>
                                <span class="article__header__text"><?php echo $publishings_publishing_media; ?>. <?php echo $publishings_publishing_date; ?></span>
                                <?php } ?>
                            </div>
                            <!--/article__header-->

                            <div class="article__content">

                                <?php if($publishings_publishing_link) { ?>
                                <h5 class="article__title"><a href="<?php echo $publishings_publishing_link; ?>" target="_blank" rel="nofollow"><?php echo $publishings_publishing_title; ?></a></h5>
                                <?php } else { ?>
                                <h5 class="article__title"><?php echo $publishings_publishing_title; ?></h5>
                                <?php } ?>

                                <?php if($publishings_publishing_excerpt) { ?>
                                <p class="article__excerpt"><?php echo $publishings_publishing_excerpt; ?></p>
                                <?php } ?>

                            </div>
                            <!--/article__content-->

                            <?php if($publishings_publishing_link) { ?>
                            <div class="article__footer">
                                <a href="<?php echo $publishings_publishing_link; ?>" class="btn" target="_blank" rel="nofollow"><?php echo pll__('Abrir em site externo'); ?> <i class="icon-external-link"></i></a>
                            </div>
                            <!--/article__footer-->
                            <?php } ?>

                        </article>
                        <!--/article-->
                    </div>
                    <!--/box-->
                    <?php endwhile; ?>

                </div>
                <!--/grid-1-box-->
                <?php else : endif; ?>

            </section>
            <!--/block-main-->

        </div>
        <!--/grid-4y8-->
    </div>
    <!--/container-->
</main>
<!--/block-->

<?php 
endwhile; else: endif;
get_footer();
?>