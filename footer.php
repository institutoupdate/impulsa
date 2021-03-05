<?php
$current_country = isset($_COOKIE['current_country']) ? $_COOKIE['current_country'] : '';

// Redes sociales
$instagram_url = get_field( 'instagram_url', 'option' );
$youtube_url = get_field( 'youtube_url', 'option' );
$facebook_url = get_field( 'facebook_url', 'option' );
$twitter_url = get_field( 'twitter_url', 'option' );

$footer_main_nav_menu = wp_nav_menu( array(
   'theme_location' => $current_country ? 'footer-main-nav-' . strtolower($current_country) : 'footer-main-nav',
   'echo' => FALSE,
   'container' => FALSE,
   'menu_class' => 'footer__main_nav',
   'fallback_cb' => '__return_false'
) );

// About Menu
$footer_nav_menu = wp_nav_menu( array(
   'theme_location' => $current_country ? 'footer-nav-' . strtolower($current_country) : 'footer-nav',
   'echo' => FALSE,
   'container' => FALSE,
   'menu_class' => 'footer__nav',
   'fallback_cb' => '__return_false'
) );

// Alt Menu
$alt_nav_menu = wp_nav_menu( array(
   'theme_location' => $current_country ? 'alt-nav-' . strtolower($current_country) : 'alt-nav',
   'echo' => FALSE,
   'container' => FALSE,
   'menu_class' => 'footer__nav',
   'fallback_cb' => '__return_false'
) );

// Countries
$countries = get_terms([
    'taxonomy' => 'countries',
    'hide_empty' => false,
]);

$current_country = isset($_COOKIE['current_country']) ? $_COOKIE['current_country'] : '';

// Newsletter
require get_template_directory() . '/global-templates/newsletter.php';
?>
<footer class="footer">
	<div class="container">
		<div class="footer__grid">
			<div class="footer__content">
        <?php if ( ! empty ( $footer_main_nav_menu ) ) { ?>
          <?php echo $footer_main_nav_menu; ?>
        <?php } ?>
				<div class="footer__columns">

					<?php if ( ! empty ( $footer_nav_menu ) ) { ?>
					<div class="footer__col">
						<h5 class="footer__col__title"><?php echo pll__('Sobre Im.pulsa'); ?></h5>
						<?php echo $footer_nav_menu; ?>
					</div>
					<!--/footer-col-->
					<?php } ?>

					<?php if ( ! empty ( $alt_nav_menu ) ) { ?>
					<div class="footer__col">
						<h5 class="footer__col__title"><?php echo pll__('Im.pulsa na media'); ?></h5>
						<?php echo $alt_nav_menu; ?>
					</div>
					<!--/footer-col-->
					<?php } ?>

          <?php if(pll_current_language() == "pt") : ?>
  					<?php if ( $instagram_url || $youtube_url || $facebook_url || $twitter_url ) { ?>
  					<div class="footer__col">
  						<h5 class="footer__col__title"><?php echo pll__('Redes'); ?></h5>
  						<div class="footer__nav footer__nav--social">
  							<?php echo ($instagram_url != '') ? '<a href="'.$instagram_url.'" rel="nofollow" target="_blank"><i class="icon-instagram"></i>Instagram</a>' : ''; ?>
  							<?php echo ($youtube_url != '') ? '</i><a href="'.$youtube_url.'" rel="nofollow" target="_blank"><i class="icon-youtube-play"></i>Youtube</a>' : ''; ?>
  							<?php echo ($facebook_url != '') ? '<a href="'.$facebook_url.'" rel="nofollow" target="_blank"><i class="icon-facebook"></i>Facebook</a>' : ''; ?>
  							<?php echo ($twitter_url != '') ? '<a href="'.$twitter_url.'" rel="nofollow" target="_blank"><i class="icon-twitter"></i>Twitter</a>' : ''; ?>
  						</div>
  						<!--/footer-nav-social-->
  					</div>
  					<!--/footer-col-->
  					<?php } ?>
          <?php endif; ?>

				</div>
				<!-- /footer__columns -->

				<div class="footer__bottom">

					<?php if($countries && count($countries) > 1) { ?>
					<div class="language">
						<div class="input input--btn">
							<div class="input__select">
								<select name="data-language" class="js-change-country">
                  <option <?php if(!$current_country || $current_country == "global") { echo 'selected'; } ?> value="global">
                    <?php if(!$current_country || $current_country == "global") : pll_e("País"); else : pll_e("Global"); endif; ?>
                  </option>
									<?php foreach ($countries as $country) {
										$countryCode = get_field('country_code', 'term_' . $country->term_id);
									?>
									<option <?php if($current_country === $countryCode) { echo 'selected'; } ?> value="<?php echo $countryCode; ?>"><?php echo $country->name; ?></option>
									<?php } ?>
								</select>
								<i class="icon-angle-down-regular"></i>
							</div>
							<!--/input-select-->
						</div>
						<!--/input-btn-->
					</div>
					<!--/language-->
					<?php } ?>

					<div class="footer__content">
						<div class="footer__copy">
							<img src="<?php echo bloginfo('template_url'); ?>/images/svg/cc-heart.svg" alt="">
							<span><?php echo pll__('Todo o conteúdo desta Plataforma está disponível em Creative Commons By-SA 4.0'); ?></span>
						</div>
						<!--/footer-copy-->
						<a href="https://onlines.com.ar" class="footer__logo" target="_blank">
							<span><?php echo pll__('Desenvolvido por'); ?> </span>
							<img src="<?php echo bloginfo('template_url'); ?>/images/logo-onlines.svg" alt="Onlines&amp;co">
						</a>
					</div>

				</div>
				<!--/footer-bottom-->
			</div>
			<!--/footer-content-->

			<div class="logos">

				<h5 class="logos__title"><?php echo pll__('Im.pulsa é um projeto das'); ?></h5>

				<div class="logos__content">

					<div class="logos__rows-2">
						<div class="logos__item">
							<a href="https://elasnopoder.org/" target="_blank" rel="external" class="logo"><img src="<?php echo bloginfo('template_url'); ?>/images/svg/elasnopoder.svg" alt=""></a>
						</div>
						<!-- /logo__item -->
						<div class="logos__item">
							<a href="https://institutoupdate.org.br" target="_blank" rel="external" class="logo"><img src="<?php echo bloginfo('template_url'); ?>/images/svg/update.svg" alt=""></a>
						</div>
						<!-- /logo__item -->
					</div>
					<!-- /logos__rows-2 -->

          <?php
          $current_country = impulsa_get_current_country();
          if($current_country == "CH") :
            ?>
            <div class="logos__rows-2">
  						<div class="logos__item">
  							<a href="https://twitter.com/votaxnosotras" rel="external" target="_blank" class="logo"><img src="<?php echo bloginfo('template_url'); ?>/images/vxn.png" alt="VOTA X NOSOTRAS"></a>
  						</div>
            </div>
          <?php
          endif;
          if($current_country == "BR") :
            ?>
  					<div class="logos__rows-5">
  						<div class="logos__item">
  							<a href="https://www.instagram.com/puxadinho__/" rel="external" target="_blank" class="logo"><img src="<?php echo bloginfo('template_url'); ?>/images/svg/puxadinho.svg" alt=""></a>
  						</div>
  						<!-- /logo__item -->
  						<div class="logos__item">
  							<a href="https://www.instagram.com/paviocriativo" rel="external" target="_blank" class="logo"><img src="<?php echo bloginfo('template_url'); ?>/images/svg/pavio-criativo.svg" alt=""></a>
  						</div>
  						<!-- /logo__item -->
  						<div class="logos__item">
  							<a href="https://www.facebook.com/votenelas2020/" rel="external" target="_blank" class="logo"><img src="<?php echo bloginfo('template_url'); ?>/images/svg/vote-nelas.svg" alt=""></a>
  						</div>
  						<!-- /logo__item -->
  						<div class="logos__item">
  							<a href="https://www.bancadaativista.org/" target="_blank" rel="external" class="logo"><img src="<?php echo bloginfo('template_url'); ?>/images/svg/bancada-ativista.svg" alt=""></a>
  						</div>
  						<!-- /logo__item -->
  						<div class="logos__item">
  							<a href="https://somosmuitas.com.br/" rel="external" target="_blank" class="logo"><img src="<?php echo bloginfo('template_url'); ?>/images/svg/muitas.svg" alt=""></a>
  						</div>
  						<!-- /logo__item -->
  					</div>
  					<!-- /logos__rows -->

  					<div class="logos__rows-4">
  						<div class="logos__item">
  							<a href="http://www.juventudenegrapolitica.org/" rel="external" target="_blank" class="logo"><img src="<?php echo bloginfo('template_url'); ?>/images/svg/juventude-negra-politica.svg" alt=""></a>
  						</div>
  						<!-- /logo__item -->
  						<div class="logos__item">
  							<a href="https://legislabrasil.org/" rel="external" target="_blank" class="logo"><img src="<?php echo bloginfo('template_url'); ?>/images/svg/legisla-brasil.svg" alt=""></a>
  						</div>
  						<!-- /logo__item -->
  						<div class="logos__item">
  							<a href="https://www.goianasnaurna.com.br/" rel="external" target="_blank" class="logo"><img src="<?php echo bloginfo('template_url'); ?>/images/svg/goianas.svg" alt=""></a>
  						</div>
  						<!-- /logo__item -->
  						<div class="logos__item">
  							<a href="https://www.instagram.com/cria.preta/" rel="external" target="_blank" class="logo"><img src="<?php echo bloginfo('template_url'); ?>/images/svg/cria-preto.svg" alt=""></a>
  						</div>
  						<!-- /logo__item -->
  					</div>
  					<!-- /logos__rows -->

  					<!-- A esta fila se le pueden agregar logos nuevos -->
  					<div class="logos__rows-5">
  						<div class="logos__item">
  							<a href="https://www.facebook.com/Allma-hub-criativo-101790571172853/" target="_blank" rel="external" class="logo"><img src="<?php echo bloginfo('template_url'); ?>/images/svg/allma.svg" alt=""></a>
  						</div>
  						<!-- /logo__item -->
  						<div class="logos__item">
  							<a href="https://www.instagram.com/institutocasamae" rel="external" target="_blank" class="logo"><img src="<?php echo bloginfo('template_url'); ?>/images/svg/casa-mae.svg" alt=""></a>
  						</div>
  						<!-- /logo__item -->
  						<div class="logos__item">
  							<a href="http://instagram.com/ocoletivomassa" rel="external" target="_blank" class="logo"><img src="<?php echo bloginfo('template_url'); ?>/images/svg/massa.svg" alt=""></a>
  						</div>
  						<!-- /logo__item -->
  						<div class="logos__item">
  							<a href="https://www.mefareiouvir.com.br/" rel="external" target="_blank" class="logo"><img src="<?php echo bloginfo('template_url'); ?>/images/svg/me-farei-ouvir.svg" alt=""></a>
  						</div>
  						<!-- /logo__item -->
  						<div class="logos__item">
  							<a href="https://www.atados.com.br/" rel="external" target="_blank" class="logo"><img src="<?php echo bloginfo('template_url'); ?>/images/svg/atados.svg" alt=""></a>
  						</div>
  						<!-- /logo__item -->
              <?php
            endif;
            ?>
					</div>
					<!-- /logos__rows -->

				</div>
				<!-- /logos__flex -->
			</div>
			<!-- /logos -->

		</div>
		<!--/footer__grid-->
	</div>
	<!--/container-->
</footer>
<!--/footer-->

<?php
	// Meta Scripts
	$meta_scripts = get_field('meta_scripts', 'option');
	if($meta_scripts) {
		echo $meta_scripts;
	}
?>

<?php wp_footer(); ?>

</body>
</html>
