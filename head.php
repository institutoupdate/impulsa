<?php
// Parámetros generales y para compartir en redes sociales 
$meta_description = get_field('meta_description', 'option');
$meta_thumb = get_field('meta_thumb', 'option');
$meta_twitter_user = get_field('meta_twitter_user', 'option');
$meta_facebook_id = get_field('meta_facebook_id', 'option');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>
		<?php 	
		if (is_front_page()) { bloginfo('name'); if ( get_bloginfo( 'description' ) ) { echo ' &mdash; '; bloginfo('description'); } }
		else {
			if (function_exists('is_tag') && is_tag()) { echo 'Etiqueta &quot;'.$tag.'&quot; &mdash; '; } 
			elseif (is_archive()) { wp_title(''); echo ' &mdash; Archivo &mdash; '; } 
			elseif (is_search()) { echo 'B&uacute;squeda para &quot;'.esc_html($s).'&quot; &mdash; '; } 

			elseif (!(is_404()) && (is_single()) || (is_page())) { // Si es post/page
				wp_title(''); echo ' &mdash; '; 
			} 

			elseif (is_404()) { echo 'No encontrado &mdash; '; }
			bloginfo('name');
		}	
		?>
	</title>

	<?php // Favicon
		$meta_favicon = get_field('meta_favicon', 'option');
		if(!empty($meta_favicon)) {
			echo '<link rel="icon" type="image/png" href="'.$meta_favicon.'" />';
		}
	?>

	<?php // Theme color
		$meta_theme_color = get_field('meta_theme_color', 'option');
		if(!empty($meta_theme_color)) {
			echo '<meta name="theme-color" content="'.$meta_theme_color.'" />';
		}
	?>

	<?php 

	if(is_single()) {
		while (have_posts()) : the_post(); // Hago el loop

			if(has_post_thumbnail()) { // Traigo el post thumbnail, sino cargo la imagen por defecto
				$image_id = get_post_thumbnail_id();
				$image_info = wp_get_attachment_image_src($image_id,'large', true);
				$image_url = $image_info[0];
			} else {
				$image_url = $meta_thumb; 
			}

			$excerpt = strip_tags( get_the_excerpt() );
			if(empty($excerpt)) {
				$excerpt = $meta_description;
			}

		?>

			<meta property="og:title" content="<?php the_title() ?> - <?php bloginfo('name') ?>" />
			<meta property="og:type" content="article" />
			<meta property="og:url" content="<?php the_permalink() ?>" />
			<meta property="og:image" content="<?php echo $image_url ?>" />
			<meta property="og:site_name" content="<?php bloginfo('name') ?>"/>

			<?php if(!empty($meta_facebook_id)) { ?>
			<meta property="fb:admins" content="<?php echo $meta_facebook_id ?>" />
			<?php } ?>
			<meta property="og:description" content="<?php echo $excerpt; ?>" />

			<meta name="twitter:card" content="summary_large_image">
			<meta name="twitter:site" content="@<?php echo $meta_twitter_user ?>">
			<meta name="twitter:title" content="<?php the_title() ?> — <?php bloginfo('name') ?>">
			<meta name="twitter:description" content="<?php echo $excerpt; ?>">
			<meta name="twitter:image:src" content="<?php echo $image_url ?>">

		<?php endwhile; } else { ?>

			<meta property="og:title" content="<?php bloginfo('name') ?> — <?php bloginfo('description') ?>" />
			<meta property="og:type" content="website" />
			<meta property="og:url" content="<?php bloginfo('url') ?>" />
			<meta property="og:image" content="<?php echo $meta_thumb ?>" />
			<meta property="og:site_name" content="<?php bloginfo('name') ?>"/>

			<?php if(!empty($meta_facebook_id)) { ?>
			<meta property="fb:admins" content="<?php echo $meta_facebook_id ?>" />
			<?php } ?>
			<meta property="og:description" content="<?php echo $meta_description ?>" />

			<meta name="twitter:card" content="summary_large_image">
			<meta name="twitter:site" content="<?php echo $meta_twitter_user ?>">
			<meta name="twitter:title" content="<?php bloginfo('name') ?>">
			<meta name="twitter:description" content="<?php echo $meta_description ?>">
			<meta name="twitter:image:src" content="<?php echo $meta_thumb ?>">  	  

	<?php } ?>

	<!-- SEO -->

	<meta name="robots" content="index, follow">

	<?php if(is_single()) { // Data SEO particular para páginas individuales ?>

		<meta name="author" content="<?php bloginfo('name') ?>">
		<meta name="description" content="<?php echo $excerpt ?>">

		<link rel="canonical" href="<?php the_permalink(); ?>">

	<?php } else { // Data SEO general para home y otras páginas ?>

		<meta name="author" content="<?php bloginfo('name') ?>">
		<meta name="description" content="<?php echo $meta_description ?>">

	<?php } ?>

	<script src="https://www.google.com/recaptcha/api.js?render=6LdSW88ZAAAAABfjCxhlUeUBm10CuQTBr4UEO_3P"></script>

	<?php wp_head(); ?>

</head>