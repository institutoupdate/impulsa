<?php
// Template name: Select country

$current_country = isset($_COOKIE['current_country']) ? $_COOKIE['current_country'] : '';

if($current_country) { 
    wp_redirect(get_home_url());
    exit;
} else {
    get_template_part('head');
    // Countries
    $countries = get_terms([
        'taxonomy' => 'countries',
        'hide_empty' => false,
    ]);
?>
<div class="modal js-first-block">
    <div class="header__logo"><span><img src="<?php echo bloginfo('template_url'); ?>/images/svg/logo.svg" alt="<?php echo bloginfo('name'); ?>"></span></div>

    <?php if($countries) { ?>
    <div class="input input--btn">
        <div class="input__select">
            <select data-url="<?php echo get_home_url(); ?>" name="data-language" class="js-select-country">
                <option value="" selected disabled style="display:none;"><?php the_title(); ?></option>
                <?php foreach ($countries as $country) { 
                    $countryCode = get_field('country_code', 'term_' . $country->term_id);
                ?>
                <option value="<?php echo $countryCode; ?>"><?php echo $country->name; ?></option>
                <?php } ?>
            </select>
            <i class="icon-angle-down-regular"></i>
        </div>
        <!--/input-select-->
    </div>
    <!--/input-btn-->
    <?php } ?>
</div>
<?php wp_footer(); ?>
<?php } ?>