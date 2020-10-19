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

$headline = get_field('headline');

if (have_posts()) : while (have_posts()) : the_post(); 
?>
<main class="block block--pad-3 js-first-block">
    <div class="container">

        <h2 class="title-2 title-2--m-bottom"><?php the_title(); ?></h2>

        <div class="grid grid--4y8">

            <aside class="sidebar">

                <?php if($headline) { ?>
                <h3 class="title title--strong-primary title--m-bottom">
                   <?php echo $headline; ?>
                </h3>
                <?php } ?>
                
                <div class="text-3 text-3--m-bottom">
                    <?php the_content(); ?>
                </div>
                <!--/text-->
                
                <ul class="social-list">
                    <?php echo ($instagram_url != '') ? '<li><a href="'.$instagram_url.'" rel="nofollow" target="_blank"><i class="icon-instagram"></i>Instagram</a></li>' : ''; ?>
                    <?php echo ($youtube_url != '') ? '<li><a href="'.$youtube_url.'" rel="nofollow" target="_blank"><i class="icon-youtube-play"></i>Youtube</a></li>' : ''; ?>
                    <?php echo ($facebook_url != '') ? '<li><a href="'.$facebook_url.'" rel="nofollow" target="_blank"><i class="icon-facebook"></i>Facebook</a></li>' : ''; ?>
                    <?php echo ($twitter_url != '') ? '<li><a href="'.$twitter_url.'" rel="nofollow" target="_blank"><i class="icon-twitter"></i>Twitter</a></li>' : ''; ?>
                </ul>
                <!--/social-list-->
                
            </aside>
            <!--/sidebar-->

            <div class="block__main">

                <div class="box box--bg-gray box--border box--pad-lg">

                    <?php if($form_result == 1 AND !empty($_POST['data-submit'])) { ?>
                    <p class="title-3 title-3--uppercase title-3--m-bottom-md"><?php echo pll__('A mensagem foi enviada com êxito. Iremos responder prontamente'); ?></p>
                    <?php } elseif($form_result == 0 AND !empty($_POST['data-submit'])) { ?>
                    <p class="title-3 title-3--uppercase title-3--m-bottom-md"><?php echo pll__('Ocorreu um erro ao enviar o formulário. Por favor, tente novamente.'); ?></p>
                    <?php } ?>
                    <form action="#" method="POST" class="form">

                        <div class="form__grid">

                            <div class="input">
                                <label class="input__label" for="input-name"><?php echo pll__('Nome'); ?></label>
                                <div class="input__box">
                                    <input name="data-name" id="input-name" type="text">
                                </div>
                                <!--/input-box-->
                            </div>
                            <!--/input-->

                            <div class="input">
                                <label class="input__label" for="input-email"><?php echo pll__('E-mail'); ?></label>
                                <div class="input__box">
                                    <input name="data-email" id="input-email" type="email">
                                </div>
                                <!--/input-box-->
                            </div>
                            <!--/input-->

                            <div class="input">
                                <label class="input__label" for="input-message"><?php echo pll__('Mensagem'); ?></label>
                                <textarea name="data-message" id="input-message"></textarea>
                            </div>
                            <!--/input-->

                            <div class="btn-box btn-box--right">
                                <input type="hidden" name="url" value="">
                                <input type="hidden" name="recaptcha_response" id="recaptchaResponse" />
                                <input class="btn-bg btn-bg--bg-1" name="data-submit" type="submit" value="<?php echo pll__('Enviar mensagem'); ?>" />
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