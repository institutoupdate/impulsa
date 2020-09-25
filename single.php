<?php 
get_header();
if (have_posts()) : while (have_posts()) : the_post(); 

$id_post = get_the_ID();

// Fecha
$date_day = get_the_date('j');
$date_month = get_the_date('F');
$date_year = get_the_date('Y');
$date = ucfirst($date_day).' de '.$date_month.' de '.$date_year;
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
                require get_template_directory() . '/global-templates/single/content-track.php';

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

<section class="block block--p-bottom-lg">
    <div class="container">
        <div class="box box--border box--bg-gray box--pad-3">
            <div class="box__header">
                <h4 class="title-3 title-3--uppercase">Trilhas relacionadas</h4>
            </div>
            <!--/box-header-->
            <?php
                $args = array(
                    'post_type' => array( 'tracks' ),
                    'order' => 'DESC',
                    'posts_per_page' => 3,
                    'post__not_in' => array ($_GET['track']),
                );
                $latestPosts = new WP_Query($args);
                if($latestPosts->have_posts()) {
            ?>
            <div class="grid grid--3-box">
                <?php 
                while($latestPosts->have_posts()) { $latestPosts->the_post(); 
                    set_query_var( 'article_excerpt', 125);
                    get_template_part('loop-templates/article-track');
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

<?php } else { ?>

<section class="block block--pad-6 js-first-block">
    <div class="container">
        <?php require get_template_directory() . '/global-templates/single/content.php'; ?>
    </div>
    <!-- /container -->
</section>
<!--/block-->

<section class="block block--p-bottom-lg">
    <div class="container">
        <div class="grid grid--12">
            <div class="col-8 col-8--center">

                <h3 class="title-3 title-3--uppercase title-3--m-bottom">Entradas relacionadas</h3>

				<?php
				// latest 3 posts
				$args = array(
					'post_type' => array( 'post' ),
					'order' => 'DESC',
					'posts_per_page' => 3,
					'post__not_in' => array (get_the_ID()),
				);
				$latestPosts = new WP_Query($args);
				if($latestPosts->have_posts()) {
				?>
				<div class="grid grid--1-box">
					<?php 
					while($latestPosts->have_posts()) { $latestPosts->the_post(); 
						get_template_part('loop-templates/article-blog');
					}
					?>
				</div>
				<!--/grid-->
        		<?php } ?>
				
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
endwhile; else: endif;
get_footer();
?>