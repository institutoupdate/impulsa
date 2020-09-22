<?php
// Template name: Contact
get_header();

$form_result = null;
if(!empty($_POST['data-submit']) AND empty($_POST['url']))
    require get_template_directory() . '/global-templates/forms/contact.php';

// Redes sociales
$instagram_url = get_field( 'instagram_url', 'option' );
$youtube_url = get_field( 'youtube_url', 'option' );
$facebook_url = get_field( 'facebook_url', 'option' );
$twitter_url = get_field( 'twitter_url', 'option' );

if (have_posts()) : while (have_posts()) : the_post(); 
?>
<main class="block block--pad-3 js-first-block">
    <div class="container">

        <h2 class="title-2 title-2--m-bottom"><?php the_title(); ?></h2>

        <div class="grid grid--4y8">

            <aside class="sidebar">

                <h3 class="title title--m-bottom"><strong class="title__block title__900">Lorem ipsum</strong>Lorem ipsum dolor sit amet</h3>
                
                <div class="text-3 text-3--m-bottom">
                    <?php the_content(); ?>
                </div>
                <!--/text-->
                
                <ul class="social-list">
                    <?php echo ($instagram_url != '') ? '<li><i class="icon-instagram"></i><a href="'.$instagram_url.'" rel="nofollow" target="_blank">Instagram</a></li>' : ''; ?>
                    <?php echo ($youtube_url != '') ? '<li><i class="icon-youtube-play"></i><a href="'.$youtube_url.'" rel="nofollow" target="_blank">Youtube</a></li>' : ''; ?>
                    <?php echo ($facebook_url != '') ? '<li><i class="icon-facebook"></i><a href="'.$facebook_url.'" rel="nofollow" target="_blank">Facebook</a></li>' : ''; ?>
                    <?php echo ($twitter_url != '') ? '<li><i class="icon-twitter"></i><a href="'.$twitter_url.'" rel="nofollow" target="_blank">Twitter</a></li>' : ''; ?>
                </ul>
                <!--/social-list-->
                
            </aside>
            <!--/sidebar-->

            <div class="block__main">

                <div class="box box--bg-gray box--border box--pad-lg">

                    <?php if($form_result == 1 AND !empty($_POST['data-submit'])) { ?>
                    <p class="title-3 title-3--uppercase title-3--m-bottom-md">El mensaje se ha enviado correctamente. Le responderemos a la brevedad.</p>
                    <?php } elseif($form_result == 0 AND !empty($_POST['data-submit'])) { ?>
                    <p class="title-3 title-3--uppercase title-3--m-bottom-md">Se ha producido un error al enviar el formulario. Inténtelo nuevamente.</p>
                    <?php } else { ?>
                    <h3 class="title-3 title-3--uppercase title-3--m-bottom-md">¿Algo para decirnos?</h3>
                    <?php } ?>

                    <form action="#" method="POST" class="form">

                        <div class="form__grid">

                            <div class="input">
                                <label class="input__label" for="input-name">Nombre</label>
                                <div class="input__box">
                                    <input name="data-name" id="input-name" type="text">
                                </div>
                                <!--/input-box-->
                            </div>
                            <!--/input-->

                            <div class="input">
                                <label class="input__label" for="input-email">Correo electrónico</label>
                                <div class="input__box">
                                    <input name="data-email" id="input-email" type="email">
                                </div>
                                <!--/input-box-->
                            </div>
                            <!--/input-->

                            <div class="input">
                                <label class="input__label" for="input-message">Mensaje</label>
                                <textarea name="data-message" id="input-message"></textarea>
                            </div>
                            <!--/input-->

                            <div class="btn-box btn-box--right">
                                <input type="hidden" name="url" value="">
                                <input type="hidden" name="recaptcha_response" id="recaptchaResponse" />
                                <input class="btn-bg btn-bg--bg-1" name="data-submit" type="submit" value="Enviar mensaje" />
                            </div>
                            <!--/btn-box-->

                        </div>
                        <!--/form-grid-->

                    </form>
                    <!--/form-->

                </div>
                <!--/box-bg-gray-->

            </div>
            <!--/block-main-->

        </div>
        <!--/grid-4y8-->

    </div>
    <!--/container-->
</main>
<!--/block-->


<script>
grecaptcha.ready(function() {
	grecaptcha.execute('6LdSW88ZAAAAABfjCxhlUeUBm10CuQTBr4UEO_3P', {action: 'homepage'}).then(function(token) {
		var recaptchaResponse = document.getElementById('recaptchaResponse');
		recaptchaResponse.value = token;
	});
});
</script>

<?php 
endwhile; else: endif;
get_footer();
?>