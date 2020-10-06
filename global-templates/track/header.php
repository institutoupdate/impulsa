<?php

// Topics
$track_topics = get_the_terms( $track_id, 'topics' );
$topic = array_pop($track_topics);
$topic_link = get_term_link($topic->slug, 'topics');
?>
<ul class="breadcrum">
    <li><a href="<?php echo get_post_type_archive_link('tracks'); ?>"><?php echo pll__('Trilhas'); ?></a><i class="icon-angle-right-solid"></i></li>
    <li><a href="<?php echo $topic_link; ?>"><?php echo $topic->name; ?></a><i class="icon-angle-right-solid"></i></li>
    <li><?php echo pll__('Trilha'); ?> <strong><span>/</span><?php echo pll__('Você está na trilha'); ?></strong></li>
</ul>

<h2 class="title-4 title-4--c-1 title-4--m-bottom"><?php echo get_the_title($track_id); ?></h2>