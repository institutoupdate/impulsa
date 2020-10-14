<?php
get_header();
if (have_posts()) : while (have_posts()) : the_post();

$id_post = get_the_ID();

// Author
$author_id = get_the_author_meta('ID');
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

<?php if(isset($_GET['track'])) {

// Track variables
$track_id = $_GET['track'];
$track_content_post = get_post($track_id);
$track_content = $track_content_post->post_content;
$track_author_id = get_post_field ('post_author', $track_id);
$track_author_name = get_the_author_meta('display_name', $track_author_id);
$track_author_description = get_the_author_meta('description', $track_author_id);
$track_related_posts = get_field('track_relationship', $track_id);

// Reading time total
$reading_time_array = array();
$id_array = array();
foreach( $track_related_posts as $post ):
    setup_postdata($post);
    $reading_time = get_field('reading-time');
    $reading_time_array[] = $reading_time;
    $id_array[] = get_the_ID();
endforeach;
$reading_time_total = array_sum($reading_time_array);
$track_related_count = count($track_related_posts);

$index = array_search($id_post, $id_array);
$prev = null;
$next = null;
if($index !== false && $index > 0 ) $prev = $id_array[$index-1];
if($index !== false && $index < count($id_array)-1) $next = $id_array[$index+1];
?>
<main class="block block--pad-3 js-first-block">
    <div class="container">

        <?php
        // Header Track
        require get_template_directory() . '/global-templates/track/header.php';
        ?>

        <div class="grid grid--4y8">

            <aside class="sidebar">
                <?php
                // Author Track
                require get_template_directory() . '/global-templates/track/author.php';

                // Sidebar Track
                $i=1; if( $track_related_posts ):
                    require get_template_directory() . '/global-templates/track/sidebar.php';
                wp_reset_postdata(); endif;
                ?>
            </aside>
            <!--/sidebar-->

            <section class="block__main">
                <?php
                // Content Track
                require get_template_directory() . '/global-templates/track/content.php';

                // Content Material
                require get_template_directory() . '/global-templates/material/content.php';

                // Pagination Track
                require get_template_directory() . '/global-templates/track/pagination.php';
                ?>
            </section>
            <!--/block-main-->

        </div>
        <!--/grid-4y8-->

    </div>
    <!--/container-->
</main>
<!--/block-->

<?php } else { ?>
<section class="block block--pad-3 js-first-block">
    <div class="container">
        <div class="grid grid--12">
            <div class="col-8 col-8--center">
                <?php require get_template_directory() . '/global-templates/material/content.php'; ?>
            </div>
            <!--/col-8-center-->
        </div>
        <!--/grid-12-->
    </div>
    <!--/container-->
</section>
<!--/block-->
<?php } ?>

<?php
if(function_exists('yarpp_related')) {
  yarpp_related(array(
      "template" => "yarpp-template-materials.php",
      "limit" => 3,
      "post_type" => isset($_GET['track']) ? array("tracks") : array("materials")
    ),
    isset($_GET['track']) ? $_GET['track'] : get_the_ID()
  );
}
?>

<?php
endwhile; else: endif;
get_footer();
?>
