<?php
	//Google Analytics
	$meta_analytics = get_field('meta_analytics', 'option');
	if(!empty($meta_analytics)) {
		echo $meta_analytics;
	}
?>

<?php wp_footer(); ?>

</body>
</html>