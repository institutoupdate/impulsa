<section class="block block--bg-3-2 block--pad-lg block--bg block--contact">

	<div class="block__bg" style="background-image: url(<?php echo bloginfo('template_url'); ?>/images/bg2.jpg);"></div>

	<span class="block__bg-text">e-mail</span>

	<div class="container">

		<div class="grid grid--contact">

			<div class="block__content">
				<h3 class="block__title-2"><?php echo pll__('Fique por dentro!'); ?></h3>
				<p class="text"><?php echo pll__('Receba as novidades da Im.pulsa no seu e-mail'); ?></p>
			</div>
			<!--/block-content-->

			<div class="block__content">

				<form method="POST" class="form form--footer" action="https://voto.us10.list-manage.com/subscribe/post" method="post" target="popupwindow" onsubmit="window.open('https://voto.us10.list-manage.com/subscribe/post', 'popupwindow', 'scrollbars=yes,width=800,height=600');return true">
					<div class="form__grid">

						<input type="hidden" name="u" value="5fd1872fc9e6862c76e6066ef">
						<input type="hidden" name="id" value="09d33d31d3">

						<div class="input">
							<label class="input__label" for="input-name"><?php echo pll__('Nome'); ?></label>
							<div class="input__box">
								<input name="MERGE1" id="input-name" type="text" required>
							</div>
							<!--/input-box-->
						</div>
						<!--/input-->

						<div class="input">
							<label class="input__label" for="input-country"><?php echo pll__("País"); ?></label>
							<div class="input__box">
								<select name="MERGE2" id="input-country">
									<option value=""></option>
									<option value="AR"><?php pll_e("Argentina"); ?></option>
									<option value="BR"><?php pll_e("Brasil"); ?></option>
									<option value="CH"><?php pll_e("Chile"); ?></option>
									<option value="CO"><?php pll_e("Colômbia"); ?></option>
									<option value="MX"><?php pll_e("México"); ?></option>
									<option value=""><?php pll_e("Outro"); ?></option>
								</select>
							</div>
						</div>

						<div class="input">
							<label class="input__label" for="input-email"><?php echo pll__('E-mail'); ?></label>
							<div class="input__box">
								<input type="hidden" value="1" name="embed"/>
								<input name="MERGE0" id="input-email" type="email" required>
							</div>
							<!-- input-box-->
						</div>
						<!--/input-->

						<div class="btn-box">
							<button class="btn-bg btn-bg--shadow" type="submit"><?php echo pll__('Cadastrar'); ?></button>
						</div>
						<!--/btn-box-->

					</div>
					<!--/form-grid-->

				</form>
			    <!--/form-->

			</div>
			<!--/block-content-->

		</div>
		<!--/grid-4y8-->

	</div>
	<!--/container-->

</section>
<!--/block-->
